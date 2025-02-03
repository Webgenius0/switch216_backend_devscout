<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'service_id',
        'booking_date',
        'status',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'service_id' => 'integer',
        'booking_date' => 'datetime',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the customer who made the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the service that is booked.
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
