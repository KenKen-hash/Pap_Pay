<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('official_businesses', function (Blueprint $table) {

            $table->time('morning_time_out')->nullable()->after('ob_date');
            $table->time('morning_time_in')->nullable()->after('morning_time_out');

            $table->time('afternoon_time_out')->nullable()->after('morning_time_in');
            $table->time('afternoon_time_in')->nullable()->after('afternoon_time_out');

        });
    }

    public function down(): void
    {
        Schema::table('official_businesses', function (Blueprint $table) {

            $table->dropColumn([
                'morning_time_out',
                'morning_time_in',
                'afternoon_time_out',
                'afternoon_time_in',
            ]);

        });
    }
};