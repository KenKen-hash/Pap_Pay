<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Attendance;
use Carbon\Carbon;

class AutoAfternoonTimeout extends Command
{
    protected $signature = 'attendance:auto-timeout';

    protected $description =
    'Automatically sets Afternoon Time Out to 5:00 PM';

    public function handle()
{
    $attendances = Attendance::whereDate('date', today())->get();

    foreach ($attendances as $attendance) {

        /*
        -------------------------
        AUTO MORNING OUT
        -------------------------
        */

        if (
            $attendance->morning_time_in &&
            !$attendance->morning_time_out
        ) {

            $attendance->morning_time_out =
                now()->setTime(12,0,0);

        }

        /*
        -------------------------
        AUTO AFTERNOON OUT
        -------------------------
        */

        if (
            $attendance->afternoon_time_in &&
            !$attendance->afternoon_time_out
        ) {

            $attendance->afternoon_time_out =
                now()->setTime(17,0,0);

        }

        /*
        -------------------------
        RECALCULATE HOURS
        -------------------------
        */

        $totalMinutes = 0;

        if (
            $attendance->morning_time_in &&
            $attendance->morning_time_out
        ) {

            $totalMinutes +=
                $attendance->morning_time_in
                    ->diffInMinutes(
                        $attendance->morning_time_out
                    );

        }

        if (
            $attendance->afternoon_time_in &&
            $attendance->afternoon_time_out
        ) {

            $totalMinutes +=
                $attendance->afternoon_time_in
                    ->diffInMinutes(
                        $attendance->afternoon_time_out
                    );

        }

        $attendance->hours_worked =
            round($totalMinutes / 60,2);

        $attendance->save();
    }

    return Command::SUCCESS;
}
}
