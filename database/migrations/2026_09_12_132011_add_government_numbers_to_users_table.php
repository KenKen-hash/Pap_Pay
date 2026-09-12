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
        Schema::table('users', function (Blueprint $table) {
            $table->string('sss_number', 30)->nullable()->after('salary_grade');
            $table->string('philhealth_number', 30)->nullable()->after('sss_number');
            $table->string('pagibig_number', 30)->nullable()->after('philhealth_number');
            $table->string('tin', 30)->nullable()->after('pagibig_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'sss_number',
                'philhealth_number',
                'pagibig_number',
                'tin',
            ]);
        });
    }
};
