<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    protected $fillable = [
        'user_id',
        'pay_period',
        'basic_pay',
        'net_pay',
        'sss',
        'philhealth',
        'pagibig',
        'tax',
        'status',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}
}
