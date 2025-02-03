<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'contractor_id',
        'service_id',
        'status',
        'completed_at'
    ];

    protected $casts = [
        'customer_id' => 'integer',
        'contractor_id' => 'integer',
        'service_id' => 'integer',
        'status' => 'string',
        'completed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function contractor()
    {
        return $this->belongsTo(User::class, 'contractor_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
