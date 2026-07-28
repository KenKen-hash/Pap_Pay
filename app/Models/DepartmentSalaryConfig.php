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

        'payroll_period',

        'sss',

        'philhealth',

        'pagibig',

        'hmo'

    ];
}
