<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faculty;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        Faculty::insert([

            [
                'faculty_code' => 'CNTT',
                'faculty_name' => 'Công nghệ Thông tin',
                'description' => 'Khoa Công nghệ Thông tin',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'faculty_code' => 'QTKD',
                'faculty_name' => 'Quản trị Kinh doanh',
                'description' => 'Khoa Quản trị Kinh doanh',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'faculty_code' => 'KT',
                'faculty_name' => 'Kế toán',
                'description' => 'Khoa Kế toán',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'faculty_code' => 'NN',
                'faculty_name' => 'Ngoại ngữ',
                'description' => 'Khoa Ngoại ngữ',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}