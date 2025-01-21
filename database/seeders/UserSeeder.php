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
        $users = [
            ['id' => 1, 'name' => 'Test User', 'email' => 'test@example.com', 'email_verified_at' => '2021-01-01 00:00:00', 'password' => Hash::make('password')],
        ];

        User::upsert(
            $users,
            ['id'],
            ['name', 'email', 'password']
        );
    }
}
