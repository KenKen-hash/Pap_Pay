<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryConfig extends Model
{
    protected $fillable = [

        'user_id',

        'basic_salary',

        'payroll_period',

        'daily_rate',

        'overtime_rate',

        'late_deduction_rate',

        'undertime_deduction_rate',

        'sss',

        'philhealth',

        'pagibig',

        'hmo',

        'ot_rate',

        'honorarium',

        'teaching_load',

        'use_department_default'



    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
