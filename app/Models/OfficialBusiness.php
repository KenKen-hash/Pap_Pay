<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficialBusiness extends Model
{
    protected $fillable = [

        'user_id',

        'purpose',

        'destination',

        'ob_date',

        'departure_time',

        'expected_return_time',

        'proof_images',

        'status',

        'approved_by',

        'approved_at',

        'rejection_reason'

    ];

    protected $casts = [

        'proof_images' => 'array',

        'ob_date' => 'date',

        'approved_at' => 'datetime',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
