<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE attendances
            MODIFY status ENUM(
                'Present',
                'Late',
                'Absent',
                'Leave',
                'Official Business',
                'Work on Holiday'
            ) NOT NULL DEFAULT 'Absent'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE attendances
            MODIFY status ENUM(
                'Present',
                'Late',
                'Absent',
                'Leave',
                'Official Business'
            ) NOT NULL DEFAULT 'Absent'
        ");
    }
};

