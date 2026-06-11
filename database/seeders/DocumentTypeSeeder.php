<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentType;

class DocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        DocumentType::insert([

            [
                'type_name' => 'Slide bài giảng',
                'description' => 'Slide phục vụ giảng dạy và học tập',
                'icon' => 'fa-file-powerpoint',
                'color' => 'blue',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'type_name' => 'Đề thi',
                'description' => 'Đề thi giữa kỳ, cuối kỳ',
                'icon' => 'fa-file-alt',
                'color' => 'red',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'type_name' => 'Bài tập',
                'description' => 'Bài tập thực hành và bài tập về nhà',
                'icon' => 'fa-tasks',
                'color' => 'green',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'type_name' => 'Giáo trình',
                'description' => 'Giáo trình chính thức của môn học',
                'icon' => 'fa-book',
                'color' => 'amber',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'type_name' => 'Tài liệu tham khảo',
                'description' => 'Tài liệu tham khảo bổ sung',
                'icon' => 'fa-folder-open',
                'color' => 'purple',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'type_name' => 'Đề cương môn học',
                'description' => 'Đề cương chi tiết môn học',
                'icon' => 'fa-file-lines',
                'color' => 'cyan',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'type_name' => 'Bài thực hành',
                'description' => 'Tài liệu thực hành trên phòng máy',
                'icon' => 'fa-laptop-code',
                'color' => 'indigo',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}