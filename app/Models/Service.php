<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'user_id',
        'category_id',
        'subcategory_id',
        'title',
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
        'user_id' => 'integer',
        'category_id' => 'integer',
        'subcategory_id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'cover_image' => 'string',
        'gallery_images' => 'array', // JSON stored as an array
        'video_url' => 'string',
        'price' => 'decimal:2',
        'is_emergency' => 'boolean',
        'type' => 'string',
        'verify' => 'string',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user (contractor) who owns the service.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that the service belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the subcategory that the service belongs to.
     */
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    /**
     * Get the bookings associated with the service.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'service_id');
    }

    /**
     * Get the service attribute values associated with the service.
     */
    public function serviceAttributeValues()
    {
        return $this->hasMany(ServiceAttributeValue::class, 'service_id');
    }

    public function items()
    {
        return $this->hasMany(ServiceItem::class, 'service_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
}
