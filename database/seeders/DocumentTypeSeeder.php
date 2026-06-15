<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = DB::table('users')->where('email', 'admin@gmail.com')->value('user_id');

        $types = [
            [
                'type_name' => 'Đề cương',
                'description' => 'Tài liệu mô tả nội dung, mục tiêu và kế hoạch học tập của môn học.',
                'icon' => 'clipboard-list',
                'color' => 'blue',
            ],
            [
                'type_name' => 'Bài giảng',
                'description' => 'Slide hoặc tài liệu bài giảng do giảng viên cung cấp.',
                'icon' => 'presentation',
                'color' => 'green',
            ],
            [
                'type_name' => 'Bài tập',
                'description' => 'Bài tập thực hành, bài tập về nhà hoặc bài tập nhóm.',
                'icon' => 'pencil',
                'color' => 'orange',
            ],
            [
                'type_name' => 'Tài liệu tham khảo',
                'description' => 'Tài liệu mở rộng phục vụ quá trình học tập và nghiên cứu.',
                'icon' => 'book-open',
                'color' => 'purple',
            ],
            [
                'type_name' => 'Đề ôn tập',
                'description' => 'Tài liệu ôn tập trước kiểm tra hoặc thi kết thúc môn.',
                'icon' => 'file-search',
                'color' => 'yellow',
            ],
            [
                'type_name' => 'Đề thi',
                'description' => 'Đề kiểm tra, đề thi giữa kỳ hoặc cuối kỳ.',
                'icon' => 'file-check',
                'color' => 'red',
            ],
        ];

        foreach ($types as $type) {
            DB::table('document_types')->updateOrInsert(
                ['type_name' => $type['type_name']],
                [
                    'description' => $type['description'],
                    'icon' => $type['icon'],
                    'color' => $type['color'],
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