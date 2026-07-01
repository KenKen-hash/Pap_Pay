<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'user_id',
        'pay_period',
        'basic_pay',
        'allowances',
        'overtime',
        'tax',
        'sss',
        'philhealth',
        'pagibig',
        'other_deductions',
        'net_pay',
        'pay_date',
    ];

    protected $casts = [
        'pay_date' => 'date',
        'basic_pay' => 'decimal:2',
        'allowances' => 'decimal:2',
        'overtime' => 'decimal:2',
        'tax' => 'decimal:2',
        'sss' => 'decimal:2',
        'philhealth' => 'decimal:2',
        'pagibig' => 'decimal:2',
        'other_deductions' => 'decimal:2',
        'net_pay' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}