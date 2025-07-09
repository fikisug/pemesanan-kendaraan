<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'driver_id',
        'approver_1_id',
        'approver_2_id',
        'start_time',
        'end_time',
        'purpose',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function approver1()
    {
        return $this->belongsTo(User::class, 'approver_1_id');
    }

    public function approver2()
    {
        return $this->belongsTo(User::class, 'approver_2_id');
    }

    public function approvals()
    {
        return $this->hasMany(ApprovalLog::class);
    }
}
