<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE admins
            MODIFY category ENUM(
                'HR',
                'VP',
                'Department Heads',
                'Accounts Receivable',
                'Accounts Payable'
            ) NOT NULL
        ");

        // Rename existing VP Finance records to VP
        DB::table('admins')
            ->where('category', 'VP Finance')
            ->update([
                'category' => 'VP',
            ]);
    }

    public function down(): void
    {
        // Change existing VP records back to VP Finance
        DB::table('admins')
            ->where('category', 'VP')
            ->update([
                'category' => 'VP Finance',
            ]);

        DB::statement("
            ALTER TABLE admins
            MODIFY category ENUM(
                'HR',
                'VP Finance',
                'Department Heads',
                'Accounts Receivable',
                'Accounts Payable'
            ) NOT NULL
        ");
    }
};
