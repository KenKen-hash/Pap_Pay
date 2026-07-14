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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Personal Information
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name');

            // Login Information
            $table->string('email')->unique();
            $table->string('role')->default('employee');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('force_password_change')->default(true);
            $table->rememberToken();

            // Employee Information
            $table->string('employee_id')->nullable()->index();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->string('contact_number')->nullable();

            // Profile
            $table->string('photo')->nullable();

            // Face Recognition
            $table->boolean('face_registered')->default(false);
            $table->longText('face_embedding')->nullable();
            $table->timestamp('face_registered_at')->nullable();

            // Employment Status
            $table->enum('status', ['Active', 'Inactive'])->default('Active');

            // Additional Information
            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->text('address')->nullable();

            // Emergency Contact
            $table->string('emergency_contact_person')->nullable();
            $table->string('emergency_contact_number')->nullable();

            // Employment Details
            $table->date('hire_date')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('salary_grade')->nullable();

            // Biography
            $table->text('bio')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};