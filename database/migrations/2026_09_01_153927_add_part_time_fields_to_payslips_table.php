<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payslips', function (Blueprint $table) {

            $table->integer('part_time_subject_count')
                ->default(0)
                ->after('present_days');

            $table->integer('part_time_present_classes')
                ->default(0)
                ->after('part_time_subject_count');

            $table->decimal('part_time_pay', 10, 2)
                ->default(0)
                ->after('part_time_present_classes');
        });
    }

    public function down(): void
    {
        Schema::table('payslips', function (Blueprint $table) {

            $table->dropColumn([
                'part_time_subject_count',
                'part_time_present_classes',
                'part_time_pay',
            ]);
        });
    }
};  
