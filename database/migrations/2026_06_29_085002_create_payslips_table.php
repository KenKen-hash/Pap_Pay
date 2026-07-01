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

        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        $table->string('pay_period'); // e.g. "June 1-15, 2026"

        $table->decimal('basic_pay', 10, 2)->default(0);
        $table->decimal('net_pay', 10, 2)->default(0);

        $table->decimal('sss', 10, 2)->default(0);
        $table->decimal('philhealth', 10, 2)->default(0);
        $table->decimal('pagibig', 10, 2)->default(0);
        $table->decimal('tax', 10, 2)->default(0);

        $table->string('status')->default('released');

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
