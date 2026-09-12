<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $fillable = [

        'user_id',

        'holiday_id',

        'date',

        /*
        |--------------------------------------------------------------------------
        | Two-Scan Attendance
        |--------------------------------------------------------------------------
        |
        | First kiosk scan  = Time In
        | Second kiosk scan = Time Out
        |
        */

        'time_in',
        'time_out',

        /*
        |--------------------------------------------------------------------------
        | Attendance Calculations
        |--------------------------------------------------------------------------
        */

        'hours_worked',

        'late_minutes',
        'undertime_minutes',
        'overtime_minutes',

        /*
        |--------------------------------------------------------------------------
        | Attendance Status
        |--------------------------------------------------------------------------
        */

        'status',

        'remarks',
    ];


    protected $casts = [

        /*
        |--------------------------------------------------------------------------
        | Date
        |--------------------------------------------------------------------------
        */

        'date' => 'date',


        /*
        |--------------------------------------------------------------------------
        | Two-Scan Times
        |--------------------------------------------------------------------------
        */

        'time_in' => 'datetime',
        'time_out' => 'datetime',


        /*
        |--------------------------------------------------------------------------
        | Worked Hours
        |--------------------------------------------------------------------------
        */

        'hours_worked' => 'decimal:2',


        /*
        |--------------------------------------------------------------------------
        | Attendance Calculations
        |--------------------------------------------------------------------------
        */

        'late_minutes' => 'integer',

        'undertime_minutes' => 'integer',

        'overtime_minutes' => 'integer',
    ];


    /*
    |--------------------------------------------------------------------------
    | Automatically Load Relationships
    |--------------------------------------------------------------------------
    |
    | This allows attendance records to automatically include:
    |
    | $attendance->user
    | $attendance->holiday
    |
    */

    protected $with = [
        'user',
        'holiday',
    ];


    /**
     * Attendance belongs to one employee.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }


    /**
     * Attendance may belong to one holiday.
     */
    public function holiday(): BelongsTo
    {
        return $this->belongsTo(
            Holiday::class,
            'holiday_id'
        );
    }
}

