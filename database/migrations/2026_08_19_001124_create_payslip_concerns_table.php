<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payslip_concerns', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('payslip_id')
                ->constrained('payslips')
                ->cascadeOnDelete();

            $table->text('reason');

            $table->string('attachment')->nullable();

            $table->enum('status', [
                'Pending',
                'Reviewed',
                'Resolved',
                'Rejected'
            ])->default('Pending');

            $table->text('admin_response')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payslip_concerns');
    }
};
