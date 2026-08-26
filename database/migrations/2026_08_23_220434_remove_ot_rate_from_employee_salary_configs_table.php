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
        Schema::table('employee_salary_configs', function (Blueprint $table) {
            $table->dropColumn('ot_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_salary_configs', function (Blueprint $table) {
            $table->decimal('ot_rate', 10, 2)->default(0);
        });
    }
};
