<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAttribute extends Model
{
    use HasFactory;

    protected $table = 'service_attributes';

    protected $fillable = [
        'category_id',
        'name',
        'is_required',
        'status',
    ];

    protected $casts = [
        'category_id' => 'integer',
        'is_required' => 'boolean',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the category associated with this service attribute.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the attribute values associated with this service attribute.
     */
    public function attributeValues()
    {
        return $this->hasMany(ServiceAttributeValue::class, 'service_attribute_id');
    }
}
