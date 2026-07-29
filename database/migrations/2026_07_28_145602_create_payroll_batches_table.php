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
        Schema::create('payroll_batches', function (Blueprint $table) {

            $table->id();

            // Example: PAY-202607-001
            $table->string('batch_number')->unique();

            // Payroll period
            $table->date('period_start');
            $table->date('period_end');

            // Admin who generated it
            $table->foreignId('generated_by')
                ->constrained('admins')
                ->cascadeOnDelete();

            // Number of employees included
            $table->integer('total_employees')->default(0);

            // Total payroll amount
            $table->decimal('total_amount', 12, 2)->default(0);

            // Departments included
            $table->json('departments');

            // Draft / Completed / Cancelled
            $table->enum('status', [
                'Draft',
                'Completed',
                'Cancelled'
            ])->default('Completed');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_batches');
    }
};
