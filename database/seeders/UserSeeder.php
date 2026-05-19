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
                'full_name' => 'Quản trị viên',
                'email' => 'admin@gmail.com',
                'avatar' => 'avatars/admin.jpg',
                'role_id' => 1,
                'is_active' => true,
            ],

            // GIẢNG VIÊN
            [
                'username' => 'gv001',
                'password' => Hash::make('123456'),
                'full_name' => 'Nguyễn Văn A',
                'email' => 'gv@gmail.com',
                'avatar' => 'avatars/gv1.jpg',
                'role_id' => 2,
                'is_active' => true,
            ],

            // SINH VIÊN
            [
                'username' => 'sv001',
                'password' => Hash::make('123456'),
                'full_name' => 'Lê Văn C',
                'email' => 'sv@gmail.com',
                'avatar' => 'avatars/sv1.jpg',
                'role_id' => 3,
                'is_active' => true,
            ],
        ]);
    }
}