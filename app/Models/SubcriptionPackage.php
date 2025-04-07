<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubcriptionPackage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'subcription_packages';

    protected $fillable = [
        'title',
        'price',
        'description',
        'button_text',
        'days',
        'status',
    ];

    protected $casts = [
        'title' => 'string',
        'price' => 'decimal:2',
        'description' => 'string',
        'button_text' => 'string',
        'days' => 'integer',
        'status' => 'string',
    ];
}
