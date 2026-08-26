<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('department_salary_configs', function (Blueprint $table) {

            $table->decimal('late_deduction_rate', 10, 2)
                ->default(0)
                ->after('overtime_rate');

            $table->decimal('undertime_deduction_rate', 10, 2)
                ->default(0)
                ->after('late_deduction_rate');

        });
    }


    public function down(): void
    {
        Schema::table('department_salary_configs', function (Blueprint $table) {

            $table->dropColumn([
                'late_deduction_rate',
                'undertime_deduction_rate'
            ]);

        });
    }
};