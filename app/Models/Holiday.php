<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;
use App\Models\Attendance;

class Holiday extends Model
{
    protected $fillable = [

        'holiday_name',

        'holiday_date',

        'holiday_type',

        'pay_rate',

        'department',

        'remarks',

        'is_active',
    ];

    protected $casts = [

        'holiday_date' => 'date',

        'pay_rate' => 'decimal:2',

        'is_active' => 'boolean',
    ];


    /**
     * Holiday has many attendance records.
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }


    /**
     * Check whether a specific date is a holiday
     * for the given employee department.
     *
     * Returns the matching Holiday model
     * or null if there is no applicable holiday.
     */
    public static function isHoliday($date, $department = null)
    {
        return self::whereDate(
                'holiday_date',
                Carbon::parse($date)
            )
            ->where('is_active', true)
            ->where(function ($query) use ($department) {

                // Holiday applies to all departments
                $query->whereNull('department');

                // Holiday applies to this specific department
                if ($department) {

                    $query->orWhere(
                        'department',
                        $department
                    );
                }

            })
            ->first();
    }
}
