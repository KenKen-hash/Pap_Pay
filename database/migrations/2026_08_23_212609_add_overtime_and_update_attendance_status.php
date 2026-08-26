<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {

            $table->unsignedInteger('overtime_minutes')
                ->default(0)
                ->after('undertime_minutes');

            $table->string('status', 100)
                ->default('Absent')
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {

            $table->dropColumn('overtime_minutes');

            $table->enum('status', [
                'Present',
                'Late',
                'Absent',
                'Leave',
                'Official Business'
            ])
            ->default('Absent')
            ->change();
        });
    }
};
