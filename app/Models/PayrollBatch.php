<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PayrollBatch extends Model
{
    protected $fillable = [
        'batch_number',
        'period_start',
        'period_end',
        'generated_by',
        'total_employees',
        'total_amount',
        'departments',
        'status',
    ];

    protected $casts = [
        'departments' => 'array',
        'period_start' => 'date',
        'period_end' => 'date',
    ];

    public function payslips(): HasMany
    {
        return $this->hasMany(Payslip::class, 'batch_id');
    }
}