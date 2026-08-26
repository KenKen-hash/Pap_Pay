<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | HONORARIUM
        |--------------------------------------------------------------------------
        |
        | EmployeeSalaryConfig already had "honorarium" in your database.
        | Therefore we do NOT create stipend.
        |
        | If an old "stipend" column exists and honorarium does not,
        | rename it.
        |
        */

        if (
            Schema::hasColumn('employee_salary_configs', 'stipend')
            && !Schema::hasColumn('employee_salary_configs', 'honorarium')
        ) {
            Schema::table('employee_salary_configs', function (Blueprint $table) {
                $table->renameColumn('stipend', 'honorarium');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | If neither exists, create honorarium.
        |--------------------------------------------------------------------------
        */

        if (
            !Schema::hasColumn('employee_salary_configs', 'stipend')
            && !Schema::hasColumn('employee_salary_configs', 'honorarium')
        ) {
            Schema::table('employee_salary_configs', function (Blueprint $table) {
                $table->decimal(
                    'honorarium',
                    12,
                    2
                )->default(0);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Remove duplicate stipend if both somehow exist.
        |--------------------------------------------------------------------------
        */

        if (
            Schema::hasColumn('employee_salary_configs', 'stipend')
            && Schema::hasColumn('employee_salary_configs', 'honorarium')
        ) {
            Schema::table('employee_salary_configs', function (Blueprint $table) {
                $table->dropColumn('stipend');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | TEACHING LOAD UNIT REQUIRED
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn(
            'employee_salary_configs',
            'teaching_load_unit_required'
        )) {
            Schema::table('employee_salary_configs', function (Blueprint $table) {
                $table->decimal(
                    'teaching_load_unit_required',
                    8,
                    2
                )->default(0);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | TEACHING LOAD PRICE
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn(
            'employee_salary_configs',
            'teaching_load_price'
        )) {
            Schema::table('employee_salary_configs', function (Blueprint $table) {
                $table->decimal(
                    'teaching_load_price',
                    12,
                    2
                )->default(0);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | TEACHING LOAD UNITS TAKEN
        |--------------------------------------------------------------------------
        |
        | This is employee-specific.
        |
        */

        if (!Schema::hasColumn(
            'employee_salary_configs',
            'teaching_load_units_taken'
        )) {
            Schema::table('employee_salary_configs', function (Blueprint $table) {
                $table->decimal(
                    'teaching_load_units_taken',
                    8,
                    2
                )->default(0);
            });
        }
    }

    public function down(): void
    {
        $columns = [];

        foreach ([
            'teaching_load_unit_required',
            'teaching_load_price',
            'teaching_load_units_taken',
        ] as $column) {

            if (Schema::hasColumn(
                'employee_salary_configs',
                $column
            )) {
                $columns[] = $column;
            }
        }

        if (!empty($columns)) {
            Schema::table('employee_salary_configs', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }
    }
};
