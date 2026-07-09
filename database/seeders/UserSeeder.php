<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy Role ID
        $adminRoleId = DB::table('roles')
            ->where('role_name', 'admin')
            ->value('role_id');

        $lecturerRoleId = DB::table('roles')
            ->where('role_name', 'lecturer')
            ->value('role_id');

        $studentRoleId = DB::table('roles')
            ->where('role_name', 'student')
            ->value('role_id');

        // Lấy Faculty ID
        $itFacultyId = DB::table('faculties')
            ->where('faculty_code', 'CNTT')
            ->value('faculty_id');

        $businessFacultyId = DB::table('faculties')
            ->where('faculty_code', 'QTKD')
            ->value('faculty_id');

        $languageFacultyId = DB::table('faculties')
            ->where('faculty_code', 'NN')
            ->value('faculty_id');

        // ==========================
        // Tạo tài khoản Admin
        // ==========================
        DB::table('users')->updateOrInsert(
            ['username' => 'admin'],
            [
                'email'            => 'admin@gmail.com',
                'password'         => Hash::make('12345678'),
                'full_name'        => 'Quản trị viên',
                'avatar'           => null,
                'role_id'          => $adminRoleId,
                'faculty_id'       => null,
                'is_active'        => true,
                'remember_token'   => null,
                'created_by'       => null,
                'updated_by'       => null,
                'deleted_by'       => null,
                'created_at'       => now(),
                'updated_at'       => now(),
                'deleted_at'       => null,
            ]
        );

        // Lấy ID Admin
        $adminId = DB::table('users')
            ->where('username', 'admin')
            ->value('user_id');

        // ==========================
        // Danh sách người dùng
        // ==========================
        $users = [

            // Giảng viên
            [
                'username'   => 'thuhoai',
                'email'      => 'hoaihoai@gmail.com',
                'full_name'  => 'Nguyễn Thị Thu Hoài',
                'role_id'    => $lecturerRoleId,
                'faculty_id' => $itFacultyId,
            ],
            [
                'username'   => 'minhhau',
                'email'      => 'minhhau@gmail.com',
                'full_name'  => 'Bùi Minh Hậu',
                'role_id'    => $lecturerRoleId,
                'faculty_id' => $itFacultyId,
            ],

            // Sinh viên
            [
                'username'   => 'nguyenvanan',
                'email'      => 'vanan@gmail.com',
                'full_name'  => 'Lê Văn An',
                'role_id'    => $studentRoleId,
                'faculty_id' => $itFacultyId,
            ],
            [
                'username'   => 'phamthidung',
                'email'      => 'phamthidung@gmail.com',
                'full_name'  => 'Phạm Thị Dung',
                'role_id'    => $studentRoleId,
                'faculty_id' => $businessFacultyId,
            ],
            [
                'username'   => 'hoangvanchuong',
                'email'      => 'hoangvanchuong@gmail.com',
                'full_name'  => 'Hoàng Văn Chương',
                'role_id'    => $studentRoleId,
                'faculty_id' => $languageFacultyId,
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['username' => $user['username']],
                [
                    'email'            => $user['email'],
                    'password'         => Hash::make('12345678'),
                    'full_name'        => $user['full_name'],
                    'avatar'           => null,
                    'role_id'          => $user['role_id'],
                    'faculty_id'       => $user['faculty_id'],
                    'is_active'        => true,
                    'remember_token'   => null,
                    'created_by'       => $adminId,
                    'updated_by'       => $adminId,
                    'deleted_by'       => null,
                    'created_at'       => now(),
                    'updated_at'       => now(),
                    'deleted_at'       => null,
                ]
            );
        }
    }
}