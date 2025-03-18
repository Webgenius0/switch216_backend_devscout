<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContractorSubscriptionPackage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'price', 'description', 'button_text', 'button_link'];

    protected $casts = [
        'title' => 'string',
        'price' => 'decimal',
        'description' => 'string',
        'button_text' => 'string',
        'button_link' => 'string',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


}
