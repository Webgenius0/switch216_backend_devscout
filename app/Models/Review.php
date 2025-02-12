<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'contactor_id',
        'booking_id',
        'user_id',
        'rating',
        'review',
    ];

    protected $casts = [
        'service_id' => 'integer',
        'contactor_id' => 'integer',
        'booking_id' => 'integer',
        'user_id' => 'integer',
        'rating' => 'integer',
        'review' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the service that owns the review.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the user who created the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the booking that this review is associated with.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

}
