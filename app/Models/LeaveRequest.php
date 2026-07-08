<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $fillable = [

        'user_id',

        'leave_type',

        'supervisor',

        'start_date',

        'end_date',

        'return_date',

        'days',

        'reason',

        'attachment',

        'status',

        'approved_by',

        'approved_at',

        'remarks',

    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Employee who filed the leave
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Admin who approved/declined
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function isPending()
    {
        return $this->status === 'Pending';
    }

    public function isApproved()
    {
        return $this->status === 'Approved';
    }

    public function isDeclined()
    {
        return $this->status === 'Declined';
    }
    public function isCancelled()
    {
        return $this->status === 'Cancelled';
    }
}
