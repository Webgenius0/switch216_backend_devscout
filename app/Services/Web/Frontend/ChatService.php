<?php

namespace App\Services\Web\Frontend;

use App\Events\MessageEvent;
use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\Service;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChatService
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }
    /**
     * Fetch all resources.
     *
     * @return mixed
     */
    public function getLastChatRoomMessage()
    {
        try {
            return ChatRoom::where("contractor_id", $this->user->id)
                ->orWhere("customer_id", $this->user->id)
                ->with([
                    'messages',
                    'customer',
                    'contractor'
                ])
                ->orderBy('focus_at', 'desc')
                ->first();
        } catch (Exception $e) {
            throw $e;
        }
    }


    public function getChatRooms()
    {
        try {
            return ChatRoom::when($this->user->role === 'contractor', function ($query) {
                return $query->where('contractor_id', $this->user->id);
            })
                ->when($this->user->role === 'customer', function ($query) {
                    return $query->where('customer_id', $this->user->id);
                })
                ->with([
                    'customer:id,name,avatar,last_seen',
                    'contractor:id,name,avatar,last_seen',
                    'messages' => function ($query) {
                        $query->latest();
                    }
                ])
                ->orderBy('focus_at', 'desc')
                ->get()
                ->map(function ($chatRoom) {
                    $otherUser = $this->user->role === 'contractor' ? $chatRoom->customer : $chatRoom->contractor;
                    $chatRoom->other_user_is_online = $this->isUserOnline($otherUser);
                    return $chatRoom;
                });
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getMessages(string $chatRoomId)
    {
        try {
            $chatRoom = ChatRoom::where('id', $chatRoomId)
                ->where(function ($query) {
                    $query->where('contractor_id', $this->user->id)
                        ->orWhere('customer_id', $this->user->id);
                })
                ->with(['customer:id,name,avatar,last_seen', 'contractor:id,name,avatar,last_seen', 'messages.sender:id,name,avatar', 'messages.receiver:id,name,avatar'])
                ->first();

            if (!$chatRoom) {
                throw new Exception('Unauthorized or chat room not found.');
            }

            $otherUser = $this->user->role === 'contractor' ? $chatRoom->customer : $chatRoom->contractor;
            $otherUser->is_online = $this->isUserOnline($otherUser);

            Message::where('chat_room_id', $chatRoomId)
                ->where('receiver_id', $this->user->id)
                ->update(['is_read' => true]);

            return [
                'chatRoomId' => $chatRoom->id,
                'receiverName' => $otherUser->name,
                'avatar' => $otherUser->avatar,
                'is_online' => $otherUser->is_online,
                'messages' => $chatRoom->messages,
            ];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function sendMessage($validateData, $chatRoomId)
    {


        try {
            DB::beginTransaction();
            // Find chat room owned by the contractor
            $chatRoom = ChatRoom::where(function ($query) {
                $query->where('contractor_id', $this->user->id)
                    ->orWhere('customer_id', $this->user->id);
            })->findOrFail($chatRoomId);

            // Create new message
            $message = Message::create([
                'chat_room_id' => $chatRoom->id,
                'sender_id' => $this->user->id,
                'receiver_id' => $chatRoom->customer_id,
                'content' => $validateData['content'],
                'sent_at' => now(),
                'message_type' => 'text',
            ]);

            // Mark previous messages as read
            Message::where('chat_room_id', $chatRoom->id)
                ->where('sender_id', '!=', $this->user->id)
                ->update(['is_read' => true]);

            // Update last activity
            $chatRoom->update(['focus_at' => now()]);
            $message->load([
                'sender' => function ($query) {
                    $query->select('id', 'name', 'avatar');
                }
            ]);
            // Broadcast message
            broadcast(new MessageEvent($message, $chatRoom->id, $this->user->id))->toOthers();

            DB::commit();
            return $message;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function startChat($serviceId)
    {
        try {
            DB::beginTransaction();
            if ($this->user->role !== 'customer') {
                throw new Exception('Only customers can create a chat.');
            }
            $service = Service::findOrFail($serviceId);

            // Check if a chatroom already exists
            $chatroom = ChatRoom::where('customer_id', $this->user->id)
                ->where('contractor_id', $service->user_id)
                ->first();

            // If no chatroom exists, create a new one
            if (!$chatroom) {
                $chatroom = ChatRoom::create([
                    'customer_id' => $this->user->id,
                    'contractor_id' => $service->user_id,
                    'service_id' => $serviceId,
                    'focus_at' => now(),
                ]);
            }
            $chatroom->update(['focus_at' => now()]);
            DB::commit();
            return $chatroom;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    private function isUserOnline($user)
    {
        try {
            if ($user && $user->last_seen) {
                return Carbon::parse($user->last_seen)->greaterThanOrEqualTo(now()->subMinutes(5)) ? 'online' : 'offline';
            }
            return 'offline';
        } catch (Exception $e) {
            throw $e;
        }
    }
}