<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatRoom extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'contractor_id',
        'service_id',
        'service_item_id',
    ];

    protected $casts = [
        'customer_id' => 'integer',
        'contractor_id' => 'integer',
        'service_id' => 'integer',
        'service_item_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime', // For soft deletes
    ];

    /**
     * Get all messages for the chat room.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the customer who owns this chat room.
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Get the contractor associated with this chat room.
     */
    public function contractor()
    {
        return $this->belongsTo(User::class, 'contractor_id');
    }

    /**
     * Get the service associated with this chat room.
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * Get the service item associated with this chat room.
     */
    public function serviceItem()
    {
        return $this->belongsTo(ServiceItem::class, 'service_item_id');
    }
}
