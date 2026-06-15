<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRoleId = DB::table('roles')
            ->where('role_name', 'admin')
            ->value('role_id');

        $lecturerRoleId = DB::table('roles')
            ->where('role_name', 'lecturer')
            ->value('role_id');

        $studentRoleId = DB::table('roles')
            ->where('role_name', 'student')
            ->value('role_id');

        DB::table('users')->updateOrInsert(
            ['username' => 'admin'],
            [
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'full_name' => 'Quản trị viên',
                'avatar' => null,
                'role_id' => $adminRoleId,
                'is_active' => true,
                'remember_token' => null,
                'created_by' => null,
                'updated_by' => null,
                'deleted_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        );

        $adminId = DB::table('users')
            ->where('username', 'admin')
            ->value('user_id');

        $users = [
            [
                'username' => 'thuhoai',
                'email' => 'hoaihoai@gmail.com',
                'full_name' => 'Nguyễn Thị Thu Hoài',
                'role_id' => $lecturerRoleId,
            ],
            [
                'username' => 'minhhau',
                'email' => 'minhhau@gmail.com',
                'full_name' => 'Bùi Minh Hậu',
                'role_id' => $lecturerRoleId,
            ],
            [
                'username' => 'nguyenvanan',
                'email' => 'vanan@gmail.com',
                'full_name' => 'Lê Văn An',
                'role_id' => $studentRoleId,
            ],
            [
                'username' => 'phamthidung',
                'email' => 'phamthidung@gmail.com',
                'full_name' => 'Phạm Thị Dung',
                'role_id' => $studentRoleId,
            ],
            [
                'username' => 'hoangvanchuong',
                'email' => 'hoangvanchuong@gmail.com',
                'full_name' => 'Hoàng Văn Chương',
                'role_id' => $studentRoleId,
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['username' => $user['username']],
                [
                    'email' => $user['email'],
                    'password' => Hash::make('12345678'),
                    'full_name' => $user['full_name'],
                    'avatar' => null,
                    'role_id' => $user['role_id'],
                    'is_active' => true,
                    'remember_token' => null,
                    'created_by' => $adminId,
                    'updated_by' => $adminId,
                    'deleted_by' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ]
            );
        }
    }
}