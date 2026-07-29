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

        /*
        |--------------------------------------------------------------------------
        | Relationships
        |--------------------------------------------------------------------------
        */

        $table->foreignId('batch_id')
            ->constrained('payroll_batches')
            ->cascadeOnDelete();

        $table->foreignId('user_id')
            ->constrained('users')
            ->cascadeOnDelete();

        /*
        |--------------------------------------------------------------------------
        | Employee Information Snapshot
        |--------------------------------------------------------------------------
        */

        $table->string('employee_name');

        $table->string('employee_id');

        $table->string('department');

        $table->string('position')->nullable();

        /*
        |--------------------------------------------------------------------------
        | Attendance Summary
        |--------------------------------------------------------------------------
        */

        $table->integer('present_days')->default(0);

        $table->integer('absent_days')->default(0);

        $table->integer('late_days')->default(0);

        /*
        |--------------------------------------------------------------------------
        | Salary Information Snapshot
        |--------------------------------------------------------------------------
        */

        $table->decimal('basic_salary',12,2)->default(0);

        $table->decimal('daily_rate',12,2)->default(0);

        $table->decimal('overtime_rate',12,2)->default(0);

        /*
        |--------------------------------------------------------------------------
        | Additional Earnings
        |--------------------------------------------------------------------------
        */

        $table->decimal('ot_amount',12,2)->default(0);

        $table->decimal('honorarium',12,2)->default(0);

        $table->decimal('teaching_load',12,2)->default(0);

        /*
        |--------------------------------------------------------------------------
        | Gross Salary
        |--------------------------------------------------------------------------
        */

        $table->decimal('gross_salary',12,2)->default(0);

        /*
        |--------------------------------------------------------------------------
        | Government Deductions
        |--------------------------------------------------------------------------
        */

        $table->decimal('sss',12,2)->default(0);

        $table->decimal('philhealth',12,2)->default(0);

        $table->decimal('pagibig',12,2)->default(0);

        $table->decimal('hmo',12,2)->default(0);

        /*
        |--------------------------------------------------------------------------
        | Totals
        |--------------------------------------------------------------------------
        */

        $table->decimal('total_deductions',12,2)->default(0);

        $table->decimal('net_salary',12,2)->default(0);

        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        $table->enum('status',[
            'Generated',
            'Released',
            'Cancelled'
        ])->default('Generated');

        $table->timestamps();

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
