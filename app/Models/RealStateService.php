<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealStateService extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'location',
        'property_type',
        'transaction_type',
        'price',
        'bedrooms',
        'bathrooms',
        'is_furnished',
    ];

    protected $casts = [
        'id' => 'integer',
        'service_id' => 'integer',
        'location' => 'string',
        'property_type' => 'string',
        'transaction_type' => 'string',
        'price' => 'decimal:2',
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'is_furnished' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship: A real estate service belongs to a service.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
