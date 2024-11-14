<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        User::firstOrCreate(
            ['email' => 'alejo@example.com'],
            [
                'name' => 'alejomi',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );
        User::firstOrCreate(
            ['email' => 'edgar@example.com'],
            [
                'name' => 'edgar',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );
        User::firstOrCreate(
            ['email' => 'pablo@example.com'],
            [
                'name' => 'pablo',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
        User::firstOrCreate(
            ['email' => 'bryant@example.com'],
            [
                'name' => 'bryant',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );
    }
}
