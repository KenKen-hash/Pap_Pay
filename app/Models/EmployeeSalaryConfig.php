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

        'honorarium',

        /*
        |--------------------------------------------------------------------------
        | Additional Teaching Load Units
        |--------------------------------------------------------------------------
        |
        | Example:
        | Required department units = 3
        | Employee additional units = 6
        |
        */

        'teaching_load_units_taken',

        /*
        |--------------------------------------------------------------------------
        | Legacy Teaching Load Fields
        |--------------------------------------------------------------------------
        |
        | Keep these only if these columns still exist in your database.
        | They are not used by the current payroll calculation.
        |
        */

        'teaching_load_unit_required',

        'teaching_load_price',

        'teaching_load',

        'use_department_default',
    ];

    protected $casts = [

        'basic_salary' => 'decimal:2',

        'daily_rate' => 'decimal:2',

        'overtime_rate' => 'decimal:2',

        'late_deduction_rate' => 'decimal:2',

        'undertime_deduction_rate' => 'decimal:2',

        'sss' => 'decimal:2',

        'philhealth' => 'decimal:2',

        'pagibig' => 'decimal:2',

        'hmo' => 'decimal:2',

        'honorarium' => 'decimal:2',

        /*
        |--------------------------------------------------------------------------
        | Teaching Load
        |--------------------------------------------------------------------------
        */

        'teaching_load_units_taken' => 'integer',

        'teaching_load_unit_required' => 'integer',

        'teaching_load_price' => 'decimal:2',

        'teaching_load' => 'decimal:2',

        'use_department_default' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
