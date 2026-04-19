<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password'=> bcrypt('admin'),
            'remember_token' => null,
        ]);

        User::create([
            'name' => 'manager',
            'email' => 'manager@example.com',
            'role' => 'manager',
            'password'=> bcrypt('manager'),
            'remember_token' => null,
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@example.com',
            'role' => 'user',
            'password'=> bcrypt('user'),
            'remember_token' => null,
        ]);
    }
}
