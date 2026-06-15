<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class SubjectTeacherSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = DB::table('users')
            ->where('email', 'admin@gmail.com')
            ->value('user_id');

        $lecturerAId = DB::table('users')
            ->where('email', 'hoaihoai@gmail.com')
            ->value('user_id');

        $lecturerBId = DB::table('users')
            ->where('email', 'minhhau@gmail.com')
            ->value('user_id');

        if (!$adminId || !$lecturerAId || !$lecturerBId) {
            throw new RuntimeException('Không tìm thấy admin hoặc giảng viên. Kiểm tra lại UserSeeder.');
        }

        $assignments = [
            [
                'user_id' => $lecturerAId,
                'subject_code' => 'CSDL',
            ],
            [
                'user_id' => $lecturerAId,
                'subject_code' => 'CTDLGT',
            ],
            [
                'user_id' => $lecturerBId,
                'subject_code' => 'LTW',
            ],
            [
                'user_id' => $lecturerBId,
                'subject_code' => 'TACB',
            ],
        ];

        foreach ($assignments as $assignment) {
            DB::table('subject_teachers')->updateOrInsert(
                [
                    'user_id' => $assignment['user_id'],
                    'subject_code' => $assignment['subject_code'],
                ],
                [
                    'assigned_at' => now(),
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