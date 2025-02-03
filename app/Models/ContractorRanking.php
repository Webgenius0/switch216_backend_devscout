<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorRanking extends Model
{
    use HasFactory;

    protected $table = 'contractor_rankings';

    protected $fillable = [
        'user_id',
        'rank',
        'completed_services',
        'average_rating',
        'response_rate',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'rank' => 'string',
        'completed_services' => 'integer',
        'average_rating' => 'decimal:2',
        'response_rate' => 'decimal:2',
    ];

    /**
     * Get the user associated with the ranking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
