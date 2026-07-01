<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@pappay.com',
            ],
            [
                'name' => 'System Administrator',
                'email' => 'admin@pappay.com',
                'password' => Hash::make('Admin12345'),

                // Your existing fields
                'role' => 'admin',
                'employee_id' => 'ADMIN001',
                'department' => 'Administration',
                'position' => 'System Administrator',
                'status' => 'Active',
            ]
        );
    }
}