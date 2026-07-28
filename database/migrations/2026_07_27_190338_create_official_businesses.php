<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('official_businesses', function (Blueprint $table) {

            $table->id();

            // Employee
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Official Business Information
            $table->text('purpose');

            $table->string('destination');

            $table->date('ob_date');

            /*
            |--------------------------------------------------------------------------
            | Attendance Schedule
            |--------------------------------------------------------------------------
            | Used by the attendance system to determine which time logs
            | are covered by the Official Business.
            */

            $table->time('morning_time_out')->nullable();

            $table->time('morning_time_in')->nullable();

            $table->time('afternoon_time_out')->nullable();

            $table->time('afternoon_time_in')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Proof Documents
            |--------------------------------------------------------------------------
            */

            $table->json('proof_images')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Approval
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'Pending',
                'Approved',
                'Rejected'
            ])->default('Pending');

            $table->foreignId('approved_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamp('approved_at')->nullable();

            $table->text('rejection_reason')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('official_businesses');
    }
};