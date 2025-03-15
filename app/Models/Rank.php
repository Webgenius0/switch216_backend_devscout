<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rank extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'role',
        'rank',
        'completed_services',
        'average_rating',
        'response_rate',
        'status',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'rank' => 'string',
        'completed_services' => 'integer',
        'average_rating' => 'decimal:2',
        'response_rate' => 'decimal:2',
        'status' => 'string',  
    ];

    /**
     * Get the user associated with the rank.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
