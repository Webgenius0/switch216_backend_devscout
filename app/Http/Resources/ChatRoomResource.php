<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ChatRoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $authUser = Auth::user();
        $isContractor = $authUser->role === 'contractor';

        return [
            'chatRoom_id' => $this->id,
            'other_user' => [
                'id' => $isContractor ? $this->customer->id : $this->contractor->id,
                'name' => $isContractor ? $this->customer->name : $this->contractor->name,
                'avatar' => $isContractor ? $this->customer->avatar : $this->contractor->avatar,
                'is_online' => $this->other_user_is_online,
            ],
            'user_role' => $authUser->role,
            'last_message' => new MessageResource($this->messages->first()),
            'unread_count' => $this->messages
                ->where('is_read', 0)
                ->where('sender_id', '!=', $authUser->id)
                ->count(),
        ];
    }
}
