<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Membuat User Admin
        User::create([
            'name' => 'Admin ReadyLab',
            'email' => 'admin@readylab.com',
            'password' => Hash::make('password'), // Ganti 'password' dengan password aman
            'role' => User::ROLE_ADMIN, // Menggunakan konstanta dari model User
        ]);

        // 2. Membuat User Biasa (Opsional)
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_USER,
        ]);
    }
}
