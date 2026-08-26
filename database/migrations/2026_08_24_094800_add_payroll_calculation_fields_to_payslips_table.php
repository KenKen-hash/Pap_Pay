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
        | Payslips should use honorarium.
        | Never create stipend.
        |
        */

        if (
            Schema::hasColumn('payslips', 'stipend')
            && !Schema::hasColumn('payslips', 'honorarium')
        ) {
            Schema::table('payslips', function (Blueprint $table) {
                $table->renameColumn('stipend', 'honorarium');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | If neither exists, create honorarium.
        |--------------------------------------------------------------------------
        */

        if (
            !Schema::hasColumn('payslips', 'stipend')
            && !Schema::hasColumn('payslips', 'honorarium')
        ) {
            Schema::table('payslips', function (Blueprint $table) {
                $table->decimal(
                    'honorarium',
                    12,
                    2
                )->default(0);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Remove duplicate stipend if both exist.
        |--------------------------------------------------------------------------
        */

        if (
            Schema::hasColumn('payslips', 'stipend')
            && Schema::hasColumn('payslips', 'honorarium')
        ) {
            Schema::table('payslips', function (Blueprint $table) {
                $table->dropColumn('stipend');
            });
        }

        /*
        |--------------------------------------------------------------------------
        | TEACHING LOAD UNIT REQUIRED
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn(
            'payslips',
            'teaching_load_unit_required'
        )) {
            Schema::table('payslips', function (Blueprint $table) {
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
            'payslips',
            'teaching_load_price'
        )) {
            Schema::table('payslips', function (Blueprint $table) {
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
        */

        if (!Schema::hasColumn(
            'payslips',
            'teaching_load_units_taken'
        )) {
            Schema::table('payslips', function (Blueprint $table) {
                $table->decimal(
                    'teaching_load_units_taken',
                    8,
                    2
                )->default(0);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | TEACHING LOAD
        |--------------------------------------------------------------------------
        |
        | DO NOT create "teaching_load" here.
        |
        | Your database already has this field.
        | It will contain the calculated teaching-load amount.
        |
        */

        /*
        |--------------------------------------------------------------------------
        | SEMI-MONTHLY TEACHING LOAD
        |--------------------------------------------------------------------------
        |
        | Payroll is every 15 days, therefore:
        |
        | Full Teaching Load / 2
        |
        */

        if (!Schema::hasColumn(
            'payslips',
            'teaching_load_semi_monthly'
        )) {
            Schema::table('payslips', function (Blueprint $table) {
                $table->decimal(
                    'teaching_load_semi_monthly',
                    12,
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
            'teaching_load_semi_monthly',
        ] as $column) {

            if (Schema::hasColumn(
                'payslips',
                $column
            )) {
                $columns[] = $column;
            }
        }

        if (!empty($columns)) {
            Schema::table('payslips', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }
    }
};
