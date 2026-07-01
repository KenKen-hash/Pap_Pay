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
    Schema::table('leave_requests', function (Blueprint $table) {

        $table->string('emergency_contact')->nullable()->after('attachment');

        $table->string('contact_number')->nullable()->after('emergency_contact');

        $table->foreignId('approved_by')
              ->nullable()
              ->constrained('users')
              ->nullOnDelete()
              ->after('status');

        $table->timestamp('approved_at')
              ->nullable()
              ->after('approved_by');

        $table->text('remarks')
              ->nullable()
              ->change();

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
