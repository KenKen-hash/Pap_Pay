<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {

            $table->id();

            $table->string('admin_id')->unique();

            $table->string('name')->nullable();

            $table->string('email')->unique();

            $table->string('password');

            $table->enum('category', [

                'HR',

                'VP Finance',

                'Accounts Receivable',

                'Accounts Payable'

            ]);

            $table->boolean('force_password_change')->default(true);

            $table->rememberToken();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};