<?php

namespace App\Http\Controllers\Web\Frontend\Contractor;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatRoomResource;
use App\Models\ChatRoom;
use App\Models\Message;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChatController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function index(Request $request)
    {
        $lastChatRommMessage = ChatRoom::where("contractor_id", $this->user->id)->orWhere("customer_id", $this->user->id)->orderBy(
            'created_at',
            'desc'
        )->with(['messages', 'customer', 'contractor'])->first();
        return view('frontend.dashboard.contractor.layouts.chat.index', compact('lastChatRommMessage'));
    }
    public function chatRooms()
    {
        try {
            // Load chat rooms with customer and latest message
            $chatRooms = ChatRoom::where('contractor_id', $this->user->id)
                ->with(['customer:id,name,avatar,last_seen'])
                ->with([
                    'messages' => function ($query) {
                        $query->latest(); // Only the latest message
                    }
                ])
                ->select('chat_rooms.*')
                ->orderByDesc(function ($query) {
                    $query->select('created_at')
                        ->from('messages')
                        ->whereColumn('messages.chat_room_id', 'chat_rooms.id')
                        ->latest()
                        ->limit(1);
                })
                ->get()
                ->map(function ($chatRoom) {
                    // Ensure the 'customer' relationship is loaded and check if the customer is online
                    if ($chatRoom->customer && $chatRoom->customer->last_seen) {
                        $lastSeen = Carbon::parse($chatRoom->customer->last_seen);
                        $chatRoom->customer->is_online = $lastSeen->greaterThanOrEqualTo(now()->subMinutes(5)) ? 'online' : 'offline';
                    } else {
                        $chatRoom->customer->is_online = false ? 'offline' : '';
                    }
                    return $chatRoom;
                });

            // Return the chat rooms as a resource collection
            return response()->json([
                'success' => true,
                'data' => ChatRoomResource::collection($chatRooms),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage(),
            ], 500);
        }
    }

    // Manager sends a message to a specific chat room
    public function getMessages(string $chatRoomId)
    {
        try {
            // Fetch chat room details along with guest and messages
            $chatRoom = ChatRoom::where('contractor_id', $this->user->id)
                ->where('id', $chatRoomId)
                ->with([
                    'customer:id,name,avatar,last_seen',
                    'messages' => function ($query) {
                        $query->select('id', 'chat_room_id', 'sender_id', 'receiver_id', 'content', 'is_read', 'sent_at')
                            ->with([
                                'sender:id,name,avatar',
                                'receiver:id,name,avatar'
                            ]);
                    }
                ])
                ->first();

            if ($chatRoom->customer && $chatRoom->customer->last_seen) {
                $lastSeen = Carbon::parse($chatRoom->customer->last_seen);
                $chatRoom->customer->is_online = $lastSeen->greaterThanOrEqualTo(now()->subMinutes(5)) ? 'online' : 'offline';
            } else {
                $chatRoom->customer->is_online = false ? 'offline' : '';
            }

            // Check if chat room exists and belongs to the identified hotel
            if (!$chatRoom || $this->user->id !== $chatRoom->contractor_id) {
                return response()->json(['error' => 'Unauthorized or chat room not found.'], 403);
            }

            Message::where('chat_room_id', $chatRoomId)
                ->where('receiver_id', '!=', Auth::id())->update(['is_read' => true]);

            // Return the chat room data in the response
            return response()->json([
                'chatRoomId' => $chatRoom->id,
                'receverName' => $chatRoom->customer->name,
                'avatar' => $chatRoom->customer->avatar,
                'is_online' => $chatRoom->customer->is_online,
                'messages' => $chatRoom->messages,
            ], 200);
        } catch (Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                ],
                500
            );
        }
    }


    public function sendMessage(Request $request, $chatRoomId)
    {
        $validateData = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();
            $chatRoom = ChatRoom::where('contractor_id', $this->user->id)->findOrFail($chatRoomId);
            // Check if chat room exists and belongs to the identified hotel
            if (!$chatRoom || $this->user->id !== $chatRoom->contractor_id) {
                return response()->json(['error' => 'Unauthorized or chat room not found.'], 403);
            }
            // Create a new message and set the sender as the identified hotel and set the receiver as the customer of the chat room
            $message = Message::create([
                'chat_room_id' => $chatRoom->id,
                'sender_id' => $this->user->id,
                'receiver_id' => $chatRoom->customer_id,
                'content' => $request->content,
                'sent_at' => now(),
                'message_type' => 'text',
            ]);

            // update to is read true 
            Message::where('chat_room_id', $chatRoom->id)
                ->where('sender_id', '!=', $this->user->id)->update(['is_read' => true]);

            // //get sender manager or guest
            // $message->user_name = in_array($message->user_id, $managerIds) ? 'manager' : 'guest';

            $message->load([
                'sender' => function ($query) {
                    $query->select('id', 'name', 'avatar');
                }
            ]);
            // MessageEvent::dispatch($message, $chatRoom->id, Auth::id());

            broadcast(new MessageEvent($message, $chatRoom->id, $this->user->id))->toOthers();
            DB::commit();
            return response()->json([
                'success' => true,
                'messages' => $message,
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
