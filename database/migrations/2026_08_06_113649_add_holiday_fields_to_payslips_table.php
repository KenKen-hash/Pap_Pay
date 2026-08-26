<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payslips', function (Blueprint $table) {

            $table->integer('worked_holidays')
                ->default(0)
                ->after('present_days');

            $table->decimal('holiday_pay', 10, 2)
                ->default(0)
                ->after('daily_rate');

        });
    }

    public function down(): void
    {
        Schema::table('payslips', function (Blueprint $table) {

            $table->dropColumn([
                'worked_holidays',
                'holiday_pay'
            ]);

        });
    }
};