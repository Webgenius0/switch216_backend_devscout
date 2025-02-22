<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarService extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'car_type',
        'brand',
        'model',
        'year',
        'fuel_type',
        'transmission',
        'kilometers_driven',
        'location',
        'price',
        'transaction_type',
    ];

    protected $casts = [
        'service_id' => 'integer',
        'car_type' => 'string',
        'brand' => 'string',
        'model' => 'string',
        'year' => 'integer',
        'fuel_type' => 'string',
        'transmission' => 'string',
        'kilometers_driven' => 'string',
        'location' => 'string',
        'price' => 'decimal:2',
        'transaction_type' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
