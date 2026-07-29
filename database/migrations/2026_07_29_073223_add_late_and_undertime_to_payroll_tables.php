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
        /*
        |--------------------------------------------------------------------------
        | Department Salary Configuration
        |--------------------------------------------------------------------------
        */

        Schema::table('department_salary_configs', function (Blueprint $table) {

            $table->decimal('late_deduction_rate', 10, 2)
                ->default(2)
                ->after('overtime_rate');

            $table->decimal('undertime_deduction_rate', 10, 2)
                ->default(2)
                ->after('late_deduction_rate');

        });

        /*
        |--------------------------------------------------------------------------
        | Employee Salary Configuration
        |--------------------------------------------------------------------------
        */

        Schema::table('employee_salary_configs', function (Blueprint $table) {

            $table->decimal('late_deduction_rate', 10, 2)
                ->default(2)
                ->after('overtime_rate');

            $table->decimal('undertime_deduction_rate', 10, 2)
                ->default(2)
                ->after('late_deduction_rate');

        });

        /*
        |--------------------------------------------------------------------------
        | Attendance
        |--------------------------------------------------------------------------
        */

        Schema::table('attendances', function (Blueprint $table) {

            $table->integer('late_minutes')
                ->default(0)
                ->after('hours_worked');

            $table->integer('undertime_minutes')
                ->default(0)
                ->after('late_minutes');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('department_salary_configs', function (Blueprint $table) {

            $table->dropColumn([
                'late_deduction_rate',
                'undertime_deduction_rate'
            ]);

        });

        Schema::table('employee_salary_configs', function (Blueprint $table) {

            $table->dropColumn([
                'late_deduction_rate',
                'undertime_deduction_rate'
            ]);

        });

        Schema::table('attendances', function (Blueprint $table) {

            $table->dropColumn([
                'late_minutes',
                'undertime_minutes'
            ]);

        });
    }
};