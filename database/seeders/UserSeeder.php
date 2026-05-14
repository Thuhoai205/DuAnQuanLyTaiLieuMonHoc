<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'full_name' => 'Quản trị',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'role_id' => 1
            ],
            [
                'username' => 'gv01',
                'full_name' => 'Giảng viên A',
                'email' => 'gv@gmail.com',
                'password' => Hash::make('123456'),
                'role_id' => 2
            ],
            [
                'username' => 'sv01',
                'full_name' => 'Sinh viên 1',
                'email' => 'sv@gmail.com',
                'password' => Hash::make('123456'),
                'role_id' => 3
            ]
        ]);
    }
}