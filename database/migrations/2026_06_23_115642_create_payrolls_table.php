<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('pay_period');

            $table->decimal('basic_pay', 10, 2);

            $table->decimal('allowances', 10, 2)->default(0);

            $table->decimal('overtime', 10, 2)->default(0);

            $table->decimal('tax', 10, 2)->default(0);

            $table->decimal('sss', 10, 2)->default(0);

            $table->decimal('philhealth', 10, 2)->default(0);

            $table->decimal('pagibig', 10, 2)->default(0);

            $table->decimal('other_deductions', 10, 2)->default(0);

            $table->decimal('net_pay', 10, 2);

            $table->date('pay_date');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};