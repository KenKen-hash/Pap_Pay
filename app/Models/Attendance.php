<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $fillable = [

        'user_id',

        'date',

        'morning_time_in',
        'morning_time_out',

        'afternoon_time_in',
        'afternoon_time_out',

        'hours_worked',

        'status',

        'remarks',
    ];

   protected $casts = [

    'date' => 'date',

    'morning_time_in' => 'datetime',
    'morning_time_out' => 'datetime',

    'afternoon_time_in' => 'datetime',
    'afternoon_time_out' => 'datetime',

    'hours_worked' => 'decimal:2',
];
    
    protected $with = ['user'];

    /**
     * Attendance belongs to one employee.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}