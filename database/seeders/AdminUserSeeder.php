<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        User::updateOrCreate(
            ['email' => 'admin@elixify.local'],
            [
                'fullname' => 'Admin User',
                'password' => bcrypt('password123'),
                'contact' => '0240000000',
                'role' => 'admin',
            ]
        );
    }
}
