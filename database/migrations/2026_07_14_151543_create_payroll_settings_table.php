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
        Schema::create('payroll_settings', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('basic_salary', 10, 2)->default(0);

            $table->decimal('monthly_rate', 10, 2)->default(0);

            $table->decimal('daily_rate', 10, 2)->default(0);

            $table->decimal('hourly_rate', 10, 2)->default(0);

            /*
    |--------------------------------------------------------------------------
    | Tertiary Loads
    |--------------------------------------------------------------------------
    */

            $table->integer('regular_units')->default(0);

            $table->integer('overload_units')->default(0);

            $table->decimal('per_unit_rate', 10, 2)->default(0);

            $table->decimal('research_pay', 10, 2)->default(0);

            $table->decimal('extension_pay', 10, 2)->default(0);

            $table->decimal('advisory_pay', 10, 2)->default(0);

            /*
    |--------------------------------------------------------------------------
    | Allowances
    |--------------------------------------------------------------------------
    */

            $table->decimal('rice_allowance', 10, 2)->default(0);

            $table->decimal('transport_allowance', 10, 2)->default(0);

            $table->decimal('communication_allowance', 10, 2)->default(0);

            $table->decimal('clothing_allowance', 10, 2)->default(0);

            $table->decimal('hazard_pay', 10, 2)->default(0);

            /*
    |--------------------------------------------------------------------------
    | Government Deductions
    |--------------------------------------------------------------------------
    */

            $table->decimal('sss', 10, 2)->default(0);

            $table->decimal('philhealth', 10, 2)->default(0);

            $table->decimal('pagibig', 10, 2)->default(0);

            $table->decimal('withholding_tax', 10, 2)->default(0);

            /*
    |--------------------------------------------------------------------------
    | Other Deductions
    |--------------------------------------------------------------------------
    */

            $table->decimal('loan', 10, 2)->default(0);

            $table->decimal('cash_advance', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_settings');
    }
};