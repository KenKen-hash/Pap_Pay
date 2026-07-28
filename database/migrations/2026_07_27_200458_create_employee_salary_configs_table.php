<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_salary_configs', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                  ->unique()
                  ->constrained()
                  ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Salary Overrides
            |--------------------------------------------------------------------------
            | NULL means use Department Default
            */

            $table->decimal('basic_salary',10,2)->nullable();

            $table->enum('payroll_period',[
                'Monthly',
                'Every 15 Days',
                'Weekly'
            ])->nullable();

            /*
            |--------------------------------------------------------------------------
            | Government Benefits Overrides
            |--------------------------------------------------------------------------
            */

            $table->decimal('sss',10,2)->nullable();

            $table->decimal('philhealth',10,2)->nullable();

            $table->decimal('pagibig',10,2)->nullable();

            $table->decimal('hmo',10,2)->nullable();

            /*
            |--------------------------------------------------------------------------
            | Additional Earnings
            |--------------------------------------------------------------------------
            */

            $table->decimal('ot_rate',10,2)->default(0);

            $table->decimal('honorarium',10,2)->default(0);

            $table->decimal('teaching_load',10,2)->default(0);

            /*
            |--------------------------------------------------------------------------
            | Remarks
            |--------------------------------------------------------------------------
            */

            $table->boolean('use_department_default')
                  ->default(true);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_salary_configs');
    }
};