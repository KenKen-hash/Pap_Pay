<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leave_requests', function (Blueprint $table) {

            $table->id();

            // Employee who filed the leave request
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Leave information
            $table->string('leave_type');

            $table->enum('leave_pay_type', [
                'Leave with pay',
                'Leave without pay'
            ]);

            $table->date('start_date');

            $table->date('end_date');

            $table->date('return_date');

            $table->integer('days');

            $table->text('reason');

            $table->string('attachment')->nullable();

            // Leave request status
            $table->enum('status', [
                'Pending',
                'Approved',
                'Rejected',
                'Cancelled'
            ])->default('Pending');

            // Admin who approved/rejected the request
            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('approved_at')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
