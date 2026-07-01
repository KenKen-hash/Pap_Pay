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

        $table->string('gender')->nullable();

        $table->date('birth_date')->nullable();

        $table->text('address')->nullable();

        $table->string('emergency_contact_person')->nullable();

        $table->string('emergency_contact_number')->nullable();

        $table->date('hire_date')->nullable();

        $table->string('employment_type')->nullable();

        $table->string('salary_grade')->nullable();

        $table->text('bio')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
