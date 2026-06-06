<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([

            
            // GIẢNG VIÊN
            [
                'username' => 'lecturer01',
                'password' => Hash::make('123456'),
                'full_name' => 'Nguyễn Văn A',
                'email' => 'lecturer01@gmail.com',
                'avatar' => null,
                'role_id' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // SINH VIÊN
            [
                'username' => 'student01',
                'password' => Hash::make('123456'),
                'full_name' => 'Lê Văn C',
                'email' => 'student01@gmail.com',
                'avatar' => null,
                'role_id' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}