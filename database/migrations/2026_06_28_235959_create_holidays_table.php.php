<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('holidays', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Holiday Information
            |--------------------------------------------------------------------------
            */

            $table->string('holiday_name');

            $table->date('holiday_date');

            /*
            |--------------------------------------------------------------------------
            | Holiday Category
            |--------------------------------------------------------------------------
            */

            $table->string('holiday_type');

            /*
            |--------------------------------------------------------------------------
            | Payroll
            |--------------------------------------------------------------------------
            */

            // 0 = No Pay
            // 100 = Regular Pay
            // 130 = 30% Premium
            // 150 = 50% Premium
            // 200 = Double Pay
            // 300 = Triple Pay

            $table->decimal('pay_rate',5,2)->default(100);

            /*
            |--------------------------------------------------------------------------
            | Department
            |--------------------------------------------------------------------------
            */

            $table->string('department')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Others
            |--------------------------------------------------------------------------
            */

            $table->text('remarks')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique([
                'holiday_date',
                'department'
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('holidays');
    }
};