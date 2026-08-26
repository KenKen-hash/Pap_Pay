<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payslips', function (Blueprint $table) {

            $table->unsignedInteger('version')
                ->default(1)
                ->after('status');

            $table->foreignId('corrected_from')
                ->nullable()
                ->after('version')
                ->constrained('payslips')
                ->nullOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('payslips', function (Blueprint $table) {

            $table->dropForeign(['corrected_from']);

            $table->dropColumn([
                'version',
                'corrected_from',
            ]);

        });
    }
};
