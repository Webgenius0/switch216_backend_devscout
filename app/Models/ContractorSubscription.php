<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'contractor_id',
        'subscription_package_id',
        'amount_paid',
        'payment_status',
        'start_date',
        'end_date',
        'status',
    ];

    public function contractor()
    {
        return $this->belongsTo(User::class, 'contractor_id');
    }

    public function package()
    {
        return $this->belongsTo(SubcriptionPackage::class, 'subscription_package_id');
    }
}
