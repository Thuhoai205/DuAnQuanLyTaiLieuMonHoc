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

         // ADMIN
            [
                'username' => 'admin',
                'password' => Hash::make('123456'),
                'full_name' => 'Quản Trị Viên',
                'email' => 'admin@gmail.com',
                'avatar' => null,
                'role_id' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // GIẢNG VIÊN
            [
                'username' => 'Thu Hoài',
                'password' => Hash::make('123456'),
                'full_name' => 'Nguyễn Thị Thu Hoài',
                'email' => 'hoaihoai@gmail.com',
                'avatar' => null,
                'role_id' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // SINH VIÊN
            [
                'username' => 'Minh Hậu',
                'password' => Hash::make('123456'),
                'full_name' => 'Bùi Minh Hậu',
                'email' => 'hauhau@gmail.com',
                'avatar' => null,
                'role_id' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}