<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@newbie.com',
            'password' => Hash::make('password'),
            'role' => UserRole::ADMIN,
        ]);

        // Retailer
        User::create([
            'name' => 'Retailer User',
            'email' => 'retailer@newbie.com',
            'password' => Hash::make('password'),
            'role' => UserRole::RETAILER,
        ]);

        // Customer
        User::create([
            'name' => 'Demo User',
            'email' => 'user@newbie.com',
            'password' => Hash::make('password'),
            'role' => UserRole::USER,
        ]);

        $this->call(ProductSeeder::class);
    }
}
