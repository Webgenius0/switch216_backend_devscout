<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'thumbnail',
        'status',
    ];

    protected $casts = [
        'category_id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'thumbnail' => 'string',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the category that owns the subcategory.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

     /**
     * Get the services under this subcategory.
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'subcategory_id');
    }
}
