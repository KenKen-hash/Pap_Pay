<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payslip extends Model
{
    protected $fillable = [

        'user_id',

        'period_start',

        'period_end',

        /*
        |--------------------------------------------------------------------------
        | Attendance
        |--------------------------------------------------------------------------
        */

        'present_days',

        'worked_holidays',

        'late_minutes',

        'undertime_minutes',

        'overtime_minutes',

        'overtime_hours',

        /*
        |--------------------------------------------------------------------------
        | Rates
        |--------------------------------------------------------------------------
        */

        'daily_rate',

        'overtime_rate',

        'late_deduction_rate',

        'undertime_deduction_rate',

        /*
        |--------------------------------------------------------------------------
        | Earnings
        |--------------------------------------------------------------------------
        */

        'basic_pay',

        'holiday_pay',

        /*
        | Actual calculated overtime pay.
        */
        'ot',

        /*
        | Stipend / Honorarium
        */
        'honorarium',

        /*
        | Teaching Load
        */
        'teaching_load_unit_required',

        'teaching_load_price',

        'teaching_load_units_taken',

        'teaching_load_pay',

        /*
        |--------------------------------------------------------------------------
        | Contributions
        |--------------------------------------------------------------------------
        */

        'sss',

        'philhealth',

        'pagibig',

        'hmo',

        /*
        |--------------------------------------------------------------------------
        | Deductions
        |--------------------------------------------------------------------------
        */

        'late_deduction',

        'undertime_deduction',

        /*
        |--------------------------------------------------------------------------
        | Totals
        |--------------------------------------------------------------------------
        */

        'gross_salary',

        'benefits',

        'net_salary',

        /*
        |--------------------------------------------------------------------------
        | Corrections / Versioning
        |--------------------------------------------------------------------------
        */

        'version',

        'corrected_from',

        'status',
    ];

    protected $casts = [

        'period_start' => 'date',

        'period_end' => 'date',

        /*
        |--------------------------------------------------------------------------
        | Attendance
        |--------------------------------------------------------------------------
        */

        'present_days' => 'integer',

        'worked_holidays' => 'integer',

        'late_minutes' => 'integer',

        'undertime_minutes' => 'integer',

        'overtime_minutes' => 'integer',

        'overtime_hours' => 'decimal:2',

        /*
        |--------------------------------------------------------------------------
        | Rates
        |--------------------------------------------------------------------------
        */

        'daily_rate' => 'decimal:2',

        'overtime_rate' => 'decimal:2',

        'late_deduction_rate' => 'decimal:2',

        'undertime_deduction_rate' => 'decimal:2',

        /*
        |--------------------------------------------------------------------------
        | Earnings
        |--------------------------------------------------------------------------
        */

        'basic_pay' => 'decimal:2',

        'holiday_pay' => 'decimal:2',

        'ot' => 'decimal:2',

        'honorarium' => 'decimal:2',

        /*
        |--------------------------------------------------------------------------
        | Teaching Load
        |--------------------------------------------------------------------------
        */

        'teaching_load_unit_required' => 'decimal:2',

        'teaching_load_price' => 'decimal:2',

        'teaching_load_units_taken' => 'decimal:2',

        'teaching_load_pay' => 'decimal:2',

        /*
        |--------------------------------------------------------------------------
        | Contributions
        |--------------------------------------------------------------------------
        */

        'sss' => 'decimal:2',

        'philhealth' => 'decimal:2',

        'pagibig' => 'decimal:2',

        'hmo' => 'decimal:2',

        /*
        |--------------------------------------------------------------------------
        | Deductions
        |--------------------------------------------------------------------------
        */

        'late_deduction' => 'decimal:2',

        'undertime_deduction' => 'decimal:2',

        /*
        |--------------------------------------------------------------------------
        | Totals
        |--------------------------------------------------------------------------
        */

        'gross_salary' => 'decimal:2',

        'benefits' => 'decimal:2',

        'net_salary' => 'decimal:2',
    ];

    /**
     * Payslip belongs to one employee.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Original payslip that this correction came from.
     */
    public function correctedFrom(): BelongsTo
    {
        return $this->belongsTo(
            Payslip::class,
            'corrected_from'
        );
    }

    /**
     * Payslips created as corrections of this payslip.
     */
    public function corrections()
    {
        return $this->hasMany(
            Payslip::class,
            'corrected_from'
        );
    }
}
