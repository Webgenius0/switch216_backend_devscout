<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'user_id',
        'rating',
        'review',
    ];

    protected $casts = [
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
}
