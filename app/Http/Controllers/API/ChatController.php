<?php

namespace App\Http\Controllers\API;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\ChatRoomUserVisibility;
use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\User;
use Auth;
use App\Events\MessageEvent;

class ChatController extends Controller
{
    public function startChat(Request $request)
    {
        $request->validate([
            'job_post_id' => 'nullable|exists:job_posts,id',
            'receiver_id' => 'required|exists:users,id',
        ]);
        try {
            $authUser = Auth::user();

            // Check if the user has an associated contractor record and verify status
            if ($authUser->role === 'contractor') {
                $contractor = $authUser->contractor;
                if (!$contractor || $contractor->verify_at === null || in_array($contractor->status, ['rejected', 'pending'])) {
                    return Helper::jsonErrorResponse('You are not a verified contractor. Apply for verification.', 403);
                }
            }

            // here set receiver 
            if ($authUser->role === 'customer') {
                $customer = $authUser;
                $contractorId = $request->receiver_id;
            } elseif ($authUser->role === 'contractor') {
                $contractor = $authUser;
                $customerId = $request->receiver_id;
            } else {
                return Helper::jsonErrorResponse('Unauthorized', 403);
            }

            $chatRoom = ChatRoom::firstOrCreate([
                'customer_id' => $customer->id ?? $customerId,
                'contractor_id' => $contractor->id ?? $contractorId,
                'job_post_id' => $request->job_post_id,
            ]);

            ChatRoomUserVisibility::updateOrCreate(
                ['chat_room_id' => $chatRoom->id, 'user_id' => $authUser->id],
                ['is_visible' => true]
            );

            return Helper::jsonResponse(true, 'Create chat room successfully', 201, $chatRoom);
        } catch (\Exception $e) {
            return Helper::jsonErrorResponse('Failed to create chat room', 500);
        }
    }

    // send message
    public function sendMessage(Request $request)
    {
        $request->validate([
            'chat_room_id' => 'required|exists:chat_rooms,id',
            'content' => 'required|string',
        ]);

        try {
            $authUser = Auth::user();
            $chatRoom = ChatRoom::findOrFail($request->chat_room_id);

            // Check if the user has an associated contractor record and verify status
            if ($authUser->role === 'contractor') {
                $contractor = $authUser->contractor;
                if (!$contractor || $contractor->verify_at === null || in_array($contractor->status, ['rejected', 'pending'])) {
                    return Helper::jsonErrorResponse('You are not a verified contractor. Apply for verification.', 403);
                }
            }

            // check  is authorize for this chat rooms
            if (!in_array($authUser->id, [$chatRoom->customer_id, $chatRoom->contractor_id])) {
                return Helper::jsonErrorResponse('Unauthorized to send messages in this chat room.', 403);
            }

            $message = Message::create([
                'chat_room_id' => $request->chat_room_id,
                'sender_id' => $authUser->id,
                'content' => $request->content,
                'sent_at' => now(),
            ]);

            ChatRoomUserVisibility::where('chat_room_id', $request->chat_room_id)
                ->where('user_id', $authUser->id)
                ->update(['is_visible' => true]);


            // Get the receiver ID based on the sender's role in the chat room
            $receiverId = $authUser->id === $chatRoom->customer_id ? $chatRoom->contractor_id : $chatRoom->customer_id;

            // Check if a visibility record already exists for the receiver
            $receiverVisibility = ChatRoomUserVisibility::where([
                'chat_room_id' => $request->chat_room_id,
                'user_id' => $receiverId
            ])->first();

            // Update visibility only if it is currently set to false
            if (!$receiverVisibility) {
                ChatRoomUserVisibility::updateOrCreate(
                    ['chat_room_id' => $request->chat_room_id, 'user_id' => $receiverId],
                    ['is_visible' => true]
                );
            }

            // Broadcast the message
            broadcast(new MessageEvent($message))->toOthers();

            return Helper::jsonResponse(true, 'Successfully sent message', 201, $message);
        } catch (\Exception $e) {
            return Helper::jsonErrorResponse('Failed to send message', 403);
        }
    }

    public function getMessages(Request $request, string $chatRoomId)
    {
        try {
            // Get 'per_page' from the request or default to 1000
            $per_page = $request->get('per_page', 1000);

            $authUser = Auth::user();
            $chatRoom = ChatRoom::findOrFail($chatRoomId);

            if (!in_array($authUser->id, [$chatRoom->customer_id, $chatRoom->contractor_id])) {
                return Helper::jsonErrorResponse('Unauthorized to get messages in this chat room.', 403);
            }
            $messages = $chatRoom->messages()
                ->with('sender')
                ->orderBy('sent_at', 'asc')
                ->paginate($per_page);

            return Helper::jsonResponse(true, 'Messages fetched successfully.', 201, $messages, true);
        } catch (\Exception $e) {
            return Helper::jsonErrorResponse('Failed to fetch messages.', 403);
        }
    }

    public function markMessagesAsRead(Request $request, string $chatRoomId)
    {
        try {
            $authUser = Auth::user();

            $chatRoom = ChatRoom::findOrFail($chatRoomId);
            if (!in_array($authUser->id, [$chatRoom->customer_id, $chatRoom->contractor_id])) {
                return Helper::jsonErrorResponse('Unauthorized.', 403);
            }

            // Update only messages that are unread and not sent by the current user
            $chatRoom->messages()
                ->where('sender_id', '!=', $authUser->id)
                ->where('is_read', false)
                ->update(['is_read' => true]);

            return Helper::jsonResponse(true, 'Messages marked as read.', 201);
        } catch (\Exception $e) {
            return Helper::jsonErrorResponse('Failed to mark messages as read.', 403);
        }
    }

    public function getChatRooms(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 1000);
            $authUser = Auth::user();
            $authUserId = $authUser->id;

            // Build the base query
            $chatRoomsQuery = ChatRoom::whereHas('visibility', function ($query) use ($authUserId) {
                $query->where('user_id', $authUserId)->where('is_visible', true);
            })
                ->with(['lastMessage'])
                ->withCount([
                    'messages as unread_count' => function ($query) use ($authUserId) {
                        $query->where('sender_id', '!=', $authUserId) // Only count messages sent by other users
                            ->where('is_read', false); // Assuming `is_read` tracks if the message is read
                    }
                ]);
                
            // Conditionally add relationships based on user role
            if ($authUser->role === 'customer') {
                $chatRoomsQuery->with([
                    'contractor:id,name,email,avatar'
                ]);
            } elseif ($authUser->role === 'contractor') {
                $chatRoomsQuery->with([
                    'customer:id,name,email,avatar'
                ]);
            }

            $chatRooms = $chatRoomsQuery->paginate($perPage);
            // dd($chatRooms->toArray());
            return Helper::jsonResponse(true, 'Successfully fetched chat rooms', 201, $chatRooms, true);
        } catch (\Exception $e) {
            return Helper::jsonErrorResponse('Failed to fetch chat rooms.', 403);
        }
    }

    public function deleteChatRoom(string $chatRoomId)
    {
        try {
            $authUser = Auth::user();
            $chatRoom = ChatRoom::findOrFail($chatRoomId);

            if (!in_array($authUser->id, [$chatRoom->customer_id, $chatRoom->contractor_id])) {
                return Helper::jsonErrorResponse('Unauthorized.', 403);
            }
            ChatRoomUserVisibility::where('chat_room_id', $chatRoomId)
                ->where('user_id', $authUser->id)
                ->update(['is_visible' => false]);

            return Helper::jsonResponse(true, 'Chat room deleted for you only', 201);
        } catch (\Exception $e) {
            return Helper::jsonErrorResponse('Failed to delete chat room.', 403);
        }
    }
}
