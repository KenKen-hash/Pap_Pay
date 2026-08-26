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
        | Your database previously used "stipend".
        | The system will now use "honorarium".
        |
        */

        if (
            Schema::hasColumn('department_salary_configs', 'stipend')
            && !Schema::hasColumn('department_salary_configs', 'honorarium')
        ) {
            Schema::table('department_salary_configs', function (Blueprint $table) {
                $table->renameColumn('stipend', 'honorarium');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | If neither exists, create honorarium.
        |--------------------------------------------------------------------------
        */

        if (
            !Schema::hasColumn('department_salary_configs', 'stipend')
            && !Schema::hasColumn('department_salary_configs', 'honorarium')
        ) {
            Schema::table('department_salary_configs', function (Blueprint $table) {
                $table->decimal(
                    'honorarium',
                    12,
                    2
                )->default(0);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | TEACHING LOAD UNIT REQUIRED
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn(
            'department_salary_configs',
            'teaching_load_unit_required'
        )) {
            Schema::table('department_salary_configs', function (Blueprint $table) {
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
            'department_salary_configs',
            'teaching_load_price'
        )) {
            Schema::table('department_salary_configs', function (Blueprint $table) {
                $table->decimal(
                    'teaching_load_price',
                    12,
                    2
                )->default(0);
            });
        }
    }

    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | We intentionally do not automatically rename honorarium back to
        | stipend because "honorarium" is now the official field in the system.
        |--------------------------------------------------------------------------
        */

        $columns = [];

        foreach ([
            'teaching_load_unit_required',
            'teaching_load_price',
        ] as $column) {

            if (Schema::hasColumn(
                'department_salary_configs',
                $column
            )) {
                $columns[] = $column;
            }
        }

        if (!empty($columns)) {
            Schema::table('department_salary_configs', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }
    }
};
