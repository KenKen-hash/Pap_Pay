<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('employee_id')->unique()->nullable();

            $table->string('department')->nullable();

            $table->string('position')->nullable();

            $table->string('contact_number')->nullable();

            $table->string('photo')->nullable();

            $table->enum('status', [
                'Active',
                'Inactive'
            ])->default('Active');

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'employee_id',
                'department',
                'position',
                'contact_number',
                'photo',
                'status'
            ]);

        });
    }
};