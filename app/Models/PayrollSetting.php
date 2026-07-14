<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollSetting extends Model
{
    protected $fillable = [

        'user_id',

        'basic_salary',

        'monthly_rate',

        'daily_rate',

        'hourly_rate',

        'regular_units',

        'overload_units',

        'per_unit_rate',

        'research_pay',

        'extension_pay',

        'advisory_pay',

        'rice_allowance',

        'transport_allowance',

        'communication_allowance',

        'clothing_allowance',

        'hazard_pay',

        'sss',

        'philhealth',

        'pagibig',

        'withholding_tax',

        'loan',

        'cash_advance'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
