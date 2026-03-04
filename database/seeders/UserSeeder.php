<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@brivora.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '1234567890',
            'email_verified_at' => now(),
        ]);

        // Customer User
        User::create([
            'name' => 'Customer User',
            'email' => 'customer@brivora.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'phone' => '0987654321',
            'email_verified_at' => now(),
        ]);
    }
}
