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
                'type_name' => 'Đề cương môn học',
                'description' => 'Đề cương chi tiết môn học',
                'icon' => 'fa-solid fa-book-open',
                'color' => 'cyan',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'type_name' => 'Giáo trình',
                'description' => 'Giáo trình chính thức của môn học',
                'icon' => 'fa-solid fa-book',
                'color' => 'blue',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'type_name' => 'Slide bài giảng',
                'description' => 'Slide phục vụ giảng dạy và học tập',
                'icon' => 'fa-solid fa-file-powerpoint',
                'color' => 'orange',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'type_name' => 'Tài liệu tham khảo',
                'description' => 'Tài liệu tham khảo bổ sung',
                'icon' => 'fa-solid fa-file-lines',
                'color' => 'purple',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'type_name' => 'Bài tập',
                'description' => 'Bài tập về nhà và bài tập tự luyện',
                'icon' => 'fa-solid fa-pencil',
                'color' => 'green',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'type_name' => 'Bài thực hành',
                'description' => 'Tài liệu thực hành và hướng dẫn thực hành',
                'icon' => 'fa-solid fa-laptop-code',
                'color' => 'indigo',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'type_name' => 'Đề thi',
                'description' => 'Đề thi giữa kỳ và cuối kỳ',
                'icon' => 'fa-solid fa-file-circle-check',
                'color' => 'red',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'type_name' => 'Đáp án',
                'description' => 'Đáp án và hướng dẫn giải',
                'icon' => 'fa-solid fa-circle-check',
                'color' => 'emerald',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}