<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
    protected $casts = [
        'contractor_id' => 'integer',
        'subscription_package_id' => 'integer',
        'amount_paid' => 'float',
        'payment_status' => 'string',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'status' => 'string',
    ];

    public function contractor()
    {
        return $this->belongsTo(User::class, 'contractor_id');
    }

    public function package()
    {
        return $this->belongsTo(SubcriptionPackage::class, 'subscription_package_id');
    }
    /**
     * Get the remaining days for the active subscription.
     */
    public function getRemainingDays()
    {
        if (
            $this->status !== 'active' ||
            Carbon::now()->greaterThanOrEqualTo($this->end_date)
        ) {
            return '0 days, 0 hours, 0 minutes';
        }

        $now = Carbon::now();
        $end = Carbon::parse($this->end_date); // make sure it's Carbon instance

        $totalMinutes = $now->diffInMinutes($end);

        $days = floor($totalMinutes / (60 * 24));
        $hours = floor(($totalMinutes % (60 * 24)) / 60);
        $minutes = $totalMinutes % 60;

        return "{$days} days, {$hours} hours, {$minutes} minutes";
    }
}
