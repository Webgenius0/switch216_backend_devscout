<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faqs';

    protected $fillable = [
        'question',
        'position',
        'answer',
        'status',
    ];

    protected $casts = [
        'question' => 'string',      
        'answer' => 'string',        
        'position' => 'integer', 
        'status' => 'string',       
    ];
}
