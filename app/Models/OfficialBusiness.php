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

    'morning_time_out',
    'morning_time_in',

    'afternoon_time_out',
    'afternoon_time_in',

    'status'

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
