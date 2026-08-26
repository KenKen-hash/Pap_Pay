<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('department_salary_configs', function (Blueprint $table) {
            $table->integer('teaching_load_unit_required')
                ->default(0)
                ->change();
        });

        Schema::table('employee_salary_configs', function (Blueprint $table) {
            $table->integer('teaching_load_units_taken')
                ->default(0)
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('department_salary_configs', function (Blueprint $table) {
            $table->decimal('teaching_load_unit_required', 8, 2)
                ->default(0)
                ->change();
        });

        Schema::table('employee_salary_configs', function (Blueprint $table) {
            $table->decimal('teaching_load_units_taken', 8, 2)
                ->default(0)
                ->change();
        });
    }
};
