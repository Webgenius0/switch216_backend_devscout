<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    use HasFactory;

    protected $table = 'service_items';

    protected $fillable = [
        'service_id',
        'name',
        'description',
        'cover_image',
        'gallery_images',
        'video_url',
        'price',
        'is_emergency',
        'type',
        'verify',
        'status',
    ];

    protected $casts = [
        'service_id' => 'integer',
        'gallery_images' => 'array', // Store gallery images as an array
        'price' => 'decimal:2',
        'is_emergency' => 'boolean',
        'type' => 'string',
        'verify' => 'string',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the service that owns this item.
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    
}
