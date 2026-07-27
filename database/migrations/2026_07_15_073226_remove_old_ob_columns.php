<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('official_businesses', function (Blueprint $table){

        $table->dropColumn([
            'departure_time',
            'expected_return_time',
            'attendance_period'
        ]);

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
