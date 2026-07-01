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
        Schema::create('attendances', function (Blueprint $table) {

            $table->id();

            // Employee
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Attendance Date
            $table->date('date');

            // Morning
            $table->time('morning_time_in')->nullable();
            $table->time('morning_time_out')->nullable();

            // Afternoon
            $table->time('afternoon_time_in')->nullable();
            $table->time('afternoon_time_out')->nullable();

            // Computed Values
            $table->decimal('hours_worked',5,2)->default(0);

            $table->enum('status',[
                'Present',
                'Late',
                'Absent',
                'Leave',
                'Official Business'
            ])->default('Absent');

            $table->text('remarks')->nullable();

            $table->timestamps();

            // One attendance per employee per day
            $table->unique(['user_id','date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};