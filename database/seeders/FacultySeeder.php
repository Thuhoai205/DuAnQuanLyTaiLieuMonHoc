<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        $adminId = DB::table('users')->where('email', 'admin@gmail.com')->value('user_id');

        $faculties = [
            [
                'faculty_code' => 'CNTT',
                'faculty_name' => 'Công nghệ thông tin',
                'description' => 'Khoa đào tạo các ngành liên quan đến công nghệ thông tin.',
            ],
            [
                'faculty_code' => 'KT',
                'faculty_name' => 'Kinh tế',
                'description' => 'Khoa đào tạo các ngành kinh tế, quản trị và tài chính.',
            ],
            [
                'faculty_code' => 'NN',
                'faculty_name' => 'Ngoại ngữ',
                'description' => 'Khoa đào tạo các ngành ngôn ngữ và ngoại ngữ.',
            ],
        ];

        foreach ($faculties as $faculty) {
            DB::table('faculties')->updateOrInsert(
                ['faculty_code' => $faculty['faculty_code']],
                [
                    'faculty_name' => $faculty['faculty_name'],
                    'description' => $faculty['description'],
                    'is_active' => true,
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