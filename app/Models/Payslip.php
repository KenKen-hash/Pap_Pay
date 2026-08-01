<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payslip extends Model
{
    protected $fillable = [

        'user_id',

        'period_start',

        'period_end',

        'present_days',

        'late_minutes',

        'undertime_minutes',

        'daily_rate',

        'ot',

        'honorarium',

        'teaching_load',

        'sss',

        'philhealth',

        'pagibig',

        'hmo',

        'late_deduction',

        'undertime_deduction',

        'gross_salary',

        'benefits',

        'net_salary',

        'status',

    ];

    protected $casts = [

        'period_start' => 'date',

        'period_end' => 'date',

        'gross_salary' => 'decimal:2',

        'benefits' => 'decimal:2',

        'net_salary' => 'decimal:2',

    ];

    /**
     * Payslip belongs to one employee.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}