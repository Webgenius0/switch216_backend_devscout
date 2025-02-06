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
        return [
            'chatRoom_id' => $this->id,
            'customer' => [
                'id' => $this->customer->id,
                'name' => $this->customer->name,
                'avatar' => $this->customer->avatar,
                'is_online' => $this->customer->is_online,
            ],
            'last_message' => new MessageResource($this->messages->first()),
            'unread_count' => $this->messages->where('is_read', 0)->where('sender_id', '!=', Auth::user()->id)->count(),
        ];
    }
}
