<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('part_time_subjects', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('subject_name');

            $table->decimal('rate_per_subject', 10, 2);

            $table->unsignedInteger('classes_per_month')
                ->default(1);

            $table->string('day_of_week');

            $table->time('start_time');

            $table->time('end_time');

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->index([
                'user_id',
                'is_active'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('part_time_subjects');
    }
};
