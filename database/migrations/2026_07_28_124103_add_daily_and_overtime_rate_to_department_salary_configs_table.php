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
        Schema::table('department_salary_configs', function (Blueprint $table) {

            $table->decimal('daily_rate', 10, 2)->default(0)->after('default_basic_salary');

            $table->decimal('overtime_rate', 10, 2)->default(0)->after('daily_rate');
        });
    }

    public function down(): void
    {
        Schema::table('department_salary_configs', function (Blueprint $table) {

            $table->dropColumn([
                'daily_rate',
                'overtime_rate'
            ]);
        });
    }
};
