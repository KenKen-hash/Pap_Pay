<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payslips', function (Blueprint $table) {

            if (!Schema::hasColumn('payslips', 'overtime_minutes')) {
                $table->decimal('overtime_minutes', 8, 2)
                    ->default(0)
                    ->after('undertime_minutes');
            }

            if (!Schema::hasColumn('payslips', 'overtime_hours')) {
                $table->decimal('overtime_hours', 8, 2)
                    ->default(0)
                    ->after('overtime_minutes');
            }

            if (!Schema::hasColumn('payslips', 'daily_rate')) {
                $table->decimal('daily_rate', 12, 2)
                    ->default(0)
                    ->after('overtime_hours');
            }

            if (!Schema::hasColumn('payslips', 'holiday_pay')) {
                $table->decimal('holiday_pay', 12, 2)
                    ->default(0)
                    ->after('daily_rate');
            }

            if (!Schema::hasColumn('payslips', 'ot')) {
                $table->decimal('ot', 12, 2)
                    ->default(0)
                    ->after('holiday_pay');
            }

            if (!Schema::hasColumn('payslips', 'honorarium')) {
                $table->decimal('honorarium', 12, 2)
                    ->default(0)
                    ->after('ot');
            }

            if (!Schema::hasColumn('payslips', 'sss')) {
                $table->decimal('sss', 12, 2)
                    ->default(0)
                    ->after('honorarium');
            }

            if (!Schema::hasColumn('payslips', 'philhealth')) {
                $table->decimal('philhealth', 12, 2)
                    ->default(0)
                    ->after('sss');
            }

            if (!Schema::hasColumn('payslips', 'pagibig')) {
                $table->decimal('pagibig', 12, 2)
                    ->default(0)
                    ->after('philhealth');
            }

            if (!Schema::hasColumn('payslips', 'hmo')) {
                $table->decimal('hmo', 12, 2)
                    ->default(0)
                    ->after('pagibig');
            }

        });
    }

    public function down(): void
    {
        Schema::table('payslips', function (Blueprint $table) {

            $columns = [
                'overtime_minutes',
                'overtime_hours',
                'daily_rate',
                'holiday_pay',
                'ot',
                'honorarium',
                'sss',
                'philhealth',
                'pagibig',
                'hmo',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('payslips', $column)) {
                    $table->dropColumn($column);
                }
            }

        });
    }
};
