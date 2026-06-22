<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = DB::table('users')->where('email', 'admin@gmail.com')->value('user_id');

        $cnttId = DB::table('faculties')->where('faculty_code', 'CNTT')->value('faculty_id');
        $ktId = DB::table('faculties')->where('faculty_code', 'KT')->value('faculty_id');
        $nnId = DB::table('faculties')->where('faculty_code', 'NN')->value('faculty_id');

        $subjects = [
    [
        'subject_code' => 'CSDL',
        'subject_name' => 'Cơ sở dữ liệu',
        'faculty_id' => $cnttId,
        'description' => 'Môn học cung cấp kiến thức về mô hình dữ liệu, SQL và thiết kế cơ sở dữ liệu.',
        'color' => 'blue',
        'icon' => 'fa-solid fa-database',
    ],
    [
        'subject_code' => 'LTW',
        'subject_name' => 'Lập trình Web',
        'faculty_id' => $cnttId,
        'description' => 'Môn học cung cấp kiến thức về HTML, CSS, JavaScript và xây dựng website.',
        'color' => 'green',
        'icon' => 'fa-solid fa-code',
    ],
    [
        'subject_code' => 'CTDLGT',
        'subject_name' => 'Cấu trúc dữ liệu và giải thuật',
        'faculty_id' => $cnttId,
        'description' => 'Môn học về cấu trúc dữ liệu, giải thuật sắp xếp, tìm kiếm và đồ thị.',
        'color' => 'purple',
        'icon' => 'fa-solid fa-diagram-project',
    ],
    [
        'subject_code' => 'QTKD',
        'subject_name' => 'Quản trị kinh doanh',
        'faculty_id' => $ktId,
        'description' => 'Môn học cung cấp kiến thức cơ bản về quản trị doanh nghiệp.',
        'color' => 'orange',
        'icon' => 'fa-solid fa-briefcase',
    ],
    [
        'subject_code' => 'TACB',
        'subject_name' => 'Tiếng Anh căn bản',
        'faculty_id' => $nnId,
        'description' => 'Môn học hỗ trợ sinh viên rèn luyện kỹ năng tiếng Anh cơ bản.',
        'color' => 'red',
        'icon' => 'fa-solid fa-language',
    ],
];

        foreach ($subjects as $subject) {
            DB::table('subjects')->updateOrInsert(
                ['subject_code' => $subject['subject_code']],
                [
                    'subject_name' => $subject['subject_name'],
                    'slug' => Str::slug($subject['subject_name']),
                    'description' => $subject['description'],
                    'thumbnail' => null,
                    'icon' => $subject['icon'],
                    'color' => $subject['color'],
                    'status' => 'active',
                    'faculty_id' => $subject['faculty_id'],
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