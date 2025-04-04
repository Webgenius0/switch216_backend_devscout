<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'subscription_id',
        'amount',
        'payment_method',
        'transaction_id',
        'status',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'subscription_id' => 'integer',
        'amount' => 'float',
        'payment_method' => 'string',
        'transaction_id' => 'string',
        'status' => 'string',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subscription()
    {
        return $this->belongsTo(ContractorSubscription::class, 'subscription_id');
    }
}
