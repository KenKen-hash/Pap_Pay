<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payslip extends Model
{
    protected $fillable = [
        'batch_id',
        'user_id',
        'employee_name',
        'employee_id',
        'department',
        'position',
        'present_days',
        'absent_days',
        'late_days',
        'basic_salary',
        'daily_rate',
        'overtime_rate',
        'ot_amount',
        'honorarium',
        'teaching_load',
        'gross_salary',
        'sss',
        'philhealth',
        'pagibig',
        'hmo',
        'total_deductions',
        'net_salary',
        'status',
    ];

    public function batch(): BelongsTo
    {
        return $this->belongsTo(PayrollBatch::class, 'batch_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}