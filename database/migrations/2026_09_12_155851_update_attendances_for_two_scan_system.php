<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | New two-scan fields
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('attendances', 'time_in')) {

                $table->dateTime('time_in')
                    ->nullable()
                    ->after('date');
            }

            if (!Schema::hasColumn('attendances', 'time_out')) {

                $table->dateTime('time_out')
                    ->nullable()
                    ->after('time_in');
            }

            /*
            |--------------------------------------------------------------------------
            | Total worked hours
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('attendances', 'hours_worked')) {

                $table->decimal(
                    'hours_worked',
                    8,
                    2
                )
                ->default(0)
                ->after('time_out');
            }

            /*
            |--------------------------------------------------------------------------
            | Late
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('attendances', 'late_minutes')) {

                $table->unsignedInteger('late_minutes')
                    ->default(0)
                    ->after('hours_worked');
            }

            /*
            |--------------------------------------------------------------------------
            | Undertime
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('attendances', 'undertime_minutes')) {

                $table->unsignedInteger('undertime_minutes')
                    ->default(0)
                    ->after('late_minutes');
            }

            /*
            |--------------------------------------------------------------------------
            | Overtime
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('attendances', 'overtime_minutes')) {

                $table->unsignedInteger('overtime_minutes')
                    ->default(0)
                    ->after('undertime_minutes');
            }

            /*
            |--------------------------------------------------------------------------
            | Holiday
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('attendances', 'holiday_id')) {

                $table->foreignId('holiday_id')
                    ->nullable()
                    ->after('user_id')
                    ->constrained('holidays')
                    ->nullOnDelete();
            }

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('attendances', 'status')) {

                $table->string('status')
                    ->default('Present')
                    ->after('overtime_minutes');
            }

            /*
            |--------------------------------------------------------------------------
            | Remarks
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('attendances', 'remarks')) {

                $table->text('remarks')
                    ->nullable()
                    ->after('status');
            }
        });


        /*
        |--------------------------------------------------------------------------
        | Remove old four-scan fields
        |--------------------------------------------------------------------------
        |
        | These fields are no longer needed because the system now uses
        | only time_in and time_out.
        |
        */

        Schema::table('attendances', function (Blueprint $table) {

            $columnsToDrop = [];

            if (Schema::hasColumn(
                'attendances',
                'morning_time_in'
            )) {
                $columnsToDrop[] =
                    'morning_time_in';
            }

            if (Schema::hasColumn(
                'attendances',
                'morning_time_out'
            )) {
                $columnsToDrop[] =
                    'morning_time_out';
            }

            if (Schema::hasColumn(
                'attendances',
                'afternoon_time_in'
            )) {
                $columnsToDrop[] =
                    'afternoon_time_in';
            }

            if (Schema::hasColumn(
                'attendances',
                'afternoon_time_out'
            )) {
                $columnsToDrop[] =
                    'afternoon_time_out';
            }

            if (!empty($columnsToDrop)) {

                $table->dropColumn(
                    $columnsToDrop
                );
            }
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Restore old fields
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn(
                'attendances',
                'morning_time_in'
            )) {

                $table->dateTime(
                    'morning_time_in'
                )->nullable();
            }

            if (!Schema::hasColumn(
                'attendances',
                'morning_time_out'
            )) {

                $table->dateTime(
                    'morning_time_out'
                )->nullable();
            }

            if (!Schema::hasColumn(
                'attendances',
                'afternoon_time_in'
            )) {

                $table->dateTime(
                    'afternoon_time_in'
                )->nullable();
            }

            if (!Schema::hasColumn(
                'attendances',
                'afternoon_time_out'
            )) {

                $table->dateTime(
                    'afternoon_time_out'
                )->nullable();
            }
        });


        /*
        |--------------------------------------------------------------------------
        | Remove new fields
        |--------------------------------------------------------------------------
        */

        Schema::table('attendances', function (Blueprint $table) {

            $columns = [];

            foreach ([
                'time_in',
                'time_out',
                'hours_worked',
                'late_minutes',
                'undertime_minutes',
                'overtime_minutes',
                'holiday_id',
                'status',
                'remarks',
            ] as $column) {

                if (Schema::hasColumn(
                    'attendances',
                    $column
                )) {

                    $columns[] = $column;
                }
            }

            if (!empty($columns)) {

                /*
                | Drop foreign key before holiday_id.
                */

                if (
                    in_array(
                        'holiday_id',
                        $columns
                    )
                ) {

                    $table->dropForeign([
                        'holiday_id'
                    ]);
                }

                $table->dropColumn($columns);
            }
        });
    }
};
