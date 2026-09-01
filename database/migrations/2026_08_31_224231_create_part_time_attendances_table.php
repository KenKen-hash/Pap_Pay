<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('part_time_attendances', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('part_time_subject_id')
                ->constrained('part_time_subjects')
                ->cascadeOnDelete();

            $table->date('attendance_date');

            $table->time('time_in')->nullable();

            $table->time('time_out')->nullable();

            $table->enum('status', [
                'Present',
                'Absent'
            ])->default('Absent');

            $table->timestamps();

            $table->unique(
                [
                    'user_id',
                    'part_time_subject_id',
                    'attendance_date'
                ],
                'pt_attendance_unique'
            );

            $table->index([
                'user_id',
                'attendance_date'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('part_time_attendances');
    }
};
