<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentSalaryConfig extends Model
{
    protected $fillable = [

        'department',

        'default_basic_salary',

        'daily_rate',

        'overtime_rate',

        'late_deduction_rate',

        'undertime_deduction_rate',

        'payroll_period',

        'sss',

        'philhealth',

        'pagibig',

        'hmo',

        'honorarium',

        /*
        |--------------------------------------------------------------------------
        | Teaching Load
        |--------------------------------------------------------------------------
        |
        | Example:
        |
        | Required Units = 3
        | Price = ₱1,000
        |
        */

        'teaching_load_unit_required',

        'teaching_load_price',
    ];


    protected $casts = [

        'default_basic_salary' =>
            'decimal:2',

        'daily_rate' =>
            'decimal:2',

        'overtime_rate' =>
            'decimal:2',

        'late_deduction_rate' =>
            'decimal:2',

        'undertime_deduction_rate' =>
            'decimal:2',

        'sss' =>
            'decimal:2',

        'philhealth' =>
            'decimal:2',

        'pagibig' =>
            'decimal:2',

        'hmo' =>
            'decimal:2',

        'honorarium' =>
            'decimal:2',

        /*
        |--------------------------------------------------------------------------
        | Teaching Load
        |--------------------------------------------------------------------------
        */

        'teaching_load_unit_required' =>
            'integer',

        'teaching_load_price' =>
            'decimal:2',
    ];
}
