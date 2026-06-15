<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $lecturerAId = DB::table('users')
            ->where('email', 'hoaihoai@gmail.com')
            ->value('user_id');

        $lecturerBId = DB::table('users')
            ->where('email', 'minhhau@gmail.com')
            ->value('user_id');

        $baiGiangId = DB::table('document_types')
            ->where('type_name', 'Bài giảng')
            ->value('document_type_id');

        $baiTapId = DB::table('document_types')
            ->where('type_name', 'Bài tập')
            ->value('document_type_id');

        $deCuongId = DB::table('document_types')
            ->where('type_name', 'Đề cương')
            ->value('document_type_id');

        $thamKhaoId = DB::table('document_types')
            ->where('type_name', 'Tài liệu tham khảo')
            ->value('document_type_id');

        if (!$lecturerAId || !$lecturerBId) {
            throw new RuntimeException('Không tìm thấy giảng viên. Kiểm tra lại UserSeeder.');
        }

        if (!$baiGiangId || !$baiTapId || !$deCuongId || !$thamKhaoId) {
            throw new RuntimeException('Không tìm thấy loại tài liệu. Kiểm tra lại DocumentTypeSeeder.');
        }

        $documents = [
            [
                'title' => 'Đề cương môn Cơ sở dữ liệu',
                'subject_code' => 'CSDL',
                'document_type_id' => $deCuongId,
                'uploaded_by' => $lecturerAId,
                'description' => 'Đề cương chi tiết môn học Cơ sở dữ liệu.',
            ],
            [
                'title' => 'Bài giảng SQL cơ bản',
                'subject_code' => 'CSDL',
                'document_type_id' => $baiGiangId,
                'uploaded_by' => $lecturerAId,
                'description' => 'Tài liệu bài giảng về câu lệnh SQL cơ bản.',
            ],
            [
                'title' => 'Bài tập thực hành truy vấn SQL',
                'subject_code' => 'CSDL',
                'document_type_id' => $baiTapId,
                'uploaded_by' => $lecturerAId,
                'description' => 'Danh sách bài tập thực hành truy vấn SQL.',
            ],
            [
                'title' => 'Bài giảng HTML CSS căn bản',
                'subject_code' => 'LTW',
                'document_type_id' => $baiGiangId,
                'uploaded_by' => $lecturerBId,
                'description' => 'Tài liệu giới thiệu HTML, CSS và bố cục trang web.',
            ],
            [
                'title' => 'Tài liệu tham khảo Laravel căn bản',
                'subject_code' => 'LTW',
                'document_type_id' => $thamKhaoId,
                'uploaded_by' => $lecturerBId,
                'description' => 'Tài liệu tham khảo phục vụ học Laravel căn bản.',
            ],
        ];

        foreach ($documents as $document) {
            DB::table('documents')->updateOrInsert(
                ['slug' => Str::slug($document['title'])],
                [
                    'title' => $document['title'],
                    'description' => $document['description'],
                    'thumbnail' => null,
                    'download_count' => 0,
                    'subject_code' => $document['subject_code'],
                    'document_type_id' => $document['document_type_id'],
                    'uploaded_by' => $document['uploaded_by'],
                    'updated_by' => $document['uploaded_by'],
                    'deleted_by' => null,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ]
            );
        }
    }
}