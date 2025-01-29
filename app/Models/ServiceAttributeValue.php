<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAttributeValue extends Model
{
    use HasFactory;

    protected $table = 'service_attribute_values';

    protected $fillable = [
        'service_id',
        'service_attribute_id',
        'value',
    ];

    protected $casts = [
        'service_id' => 'integer',
        'service_attribute_id' => 'integer',
        'value' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the service associated with this attribute value.
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * Get the attribute associated with this value.
     */
    public function serviceAttribute()
    {
        return $this->belongsTo(ServiceAttribute::class, 'service_attribute_id');
    }
}
