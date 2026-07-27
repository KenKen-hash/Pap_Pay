<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentSalaryConfig extends Model
{
    protected $fillable = [

        'department',

        'default_basic_salary',

        'payroll_period',

        'sss',

        'philhealth',

        'pagibig',

        'hmo'

    ];
}