<?php

namespace Database\Seeders;

use App\Models\User;
use App\Traits\TruncatableTables;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use TruncatableTables;

    public function run(): void
    {
        $this->truncateTables(['users']);

        // 1. Admin User
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // 2. Regular Student User
        User::firstOrCreate(
            ['email' => 'student@student.com'],
            [
                'name' => 'Student User',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'email_verified_at' => now(),
            ]
        );
    }
}
