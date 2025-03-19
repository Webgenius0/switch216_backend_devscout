<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContractorSubscriptionPackage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'price', 'description','days', 'button_text', 'button_link', 'status'];



}
