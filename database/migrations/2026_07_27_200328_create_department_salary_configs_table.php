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
    Schema::create('department_salary_configs', function (Blueprint $table) {

        $table->id();

        $table->string('department')->unique();

        $table->decimal('default_basic_salary', 10, 2)->default(0);

        $table->enum('payroll_period', [
            'Monthly',
            'Every 15 Days',
            'Weekly'
        ])->default('Monthly');

        $table->decimal('sss', 10, 2)->default(0);

        $table->decimal('philhealth', 10, 2)->default(0);

        $table->decimal('pagibig', 10, 2)->default(0);

        $table->decimal('hmo', 10, 2)->default(0);

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_salary_configs');
    }
};