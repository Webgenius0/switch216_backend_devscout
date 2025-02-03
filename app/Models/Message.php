<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'chat_room_id',
        'sender_id',
        'receiver_id',
        'content',
        'is_read',
        'sent_at',
    ];

    protected $casts = [
        'chat_room_id' => 'integer',
        'sender_id' => 'integer',
        'receiver_id' => 'integer',
        'content' => 'string',
        'is_read' => 'boolean',
        'sent_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime', // For soft deletes
    ];

    /**
     * Get the chat room that owns the message.
     */
    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }

    /**
     * Get the sender of the message.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the receiver of the message.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
