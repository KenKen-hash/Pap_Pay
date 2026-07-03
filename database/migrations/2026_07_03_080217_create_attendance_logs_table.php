<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_logs', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->date('attendance_date');

            $table->time('morning_in')->nullable();

            $table->time('morning_out')->nullable();

            $table->time('afternoon_in')->nullable();

            $table->time('afternoon_out')->nullable();

            $table->decimal('work_hours',5,2)->default(0);

            $table->timestamps();

            $table->unique([
                'user_id',
                'attendance_date'
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_logs');
    }
};