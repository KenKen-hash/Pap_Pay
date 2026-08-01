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
        Schema::create('payslips', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();



            /*
        |--------------------------------------------------------------------------
        | Payroll Period
        |--------------------------------------------------------------------------
        */

            $table->date('period_start');

            $table->date('period_end');

            /*
        |--------------------------------------------------------------------------
        | Attendance
        |--------------------------------------------------------------------------
        */

            $table->integer('present_days')->default(0);

            $table->integer('late_minutes')->default(0);

            $table->integer('undertime_minutes')->default(0);

            /*
        |--------------------------------------------------------------------------
        | Earnings
        |--------------------------------------------------------------------------
        */

            $table->decimal('daily_rate', 10, 2)->default(0);

            $table->decimal('ot', 10, 2)->default(0);

            $table->decimal('honorarium', 10, 2)->default(0);

            $table->decimal('teaching_load', 10, 2)->default(0);

            /*
        |--------------------------------------------------------------------------
        | Deductions
        |--------------------------------------------------------------------------
        */

            $table->decimal('sss', 10, 2)->default(0);

            $table->decimal('philhealth', 10, 2)->default(0);

            $table->decimal('pagibig', 10, 2)->default(0);

            $table->decimal('hmo', 10, 2)->default(0);

            $table->decimal('late_deduction', 10, 2)->default(0);

            $table->decimal('undertime_deduction', 10, 2)->default(0);

            /*
        |--------------------------------------------------------------------------
        | Totals
        |--------------------------------------------------------------------------
        */

            $table->decimal('gross_salary', 10, 2)->default(0);

            $table->decimal('benefits', 10, 2)->default(0);

            $table->decimal('net_salary', 10, 2)->default(0);

            /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

            $table->enum('status', [
                'Generated',
                'Sent',
                'Viewed'
            ])->default('Generated');

           

            $table->timestamps();

             $table->unique([
                'user_id',
                'period_start',
                'period_end'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payslips');
    }
};
