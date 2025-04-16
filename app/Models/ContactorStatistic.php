<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactorStatistic extends Model
{
    protected $table = 'contactor_statistics';

    protected $fillable = [
        'user_id',
        'rank',
        'average_rating',
        'review_count',
        'complete_booking_count',
        'pending_booking_count',
        'last_60_days_complete_booking_count',
        'last_60_days_average_rating',
        'last_60_days_response_rate',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'rank' => 'string',
        'average_rating' => 'float',
        'review_count' => 'integer',
        'complete_booking_count' => 'integer',
        'pending_booking_count' => 'integer',
        'last_60_days_complete_booking_count' => 'integer',
        'last_60_days_average_rating' => 'float',
        'last_60_days_response_rate' => 'float',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
