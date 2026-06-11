<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;
use Illuminate\Support\Str;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        Document::insert([

            [
                'title' => 'Slide Laravel Cơ Bản',
                'slug' => Str::slug('Slide Laravel Cơ Bản'),
                'description' => 'Tài liệu giới thiệu framework Laravel.',
                'thumbnail' => null,
                'view_count' => 120,
                'download_count' => 45,
                'subject_code' => 'WEB101',
                'document_type_id' => 1,
                'uploaded_by' => 2,
                'updated_by' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Đề Thi Cơ Sở Dữ Liệu',
                'slug' => Str::slug('Đề Thi Cơ Sở Dữ Liệu'),
                'description' => 'Đề thi cuối kỳ môn Cơ sở dữ liệu.',
                'thumbnail' => null,
                'view_count' => 250,
                'download_count' => 180,
                'subject_code' => 'DB101',
                'document_type_id' => 2,
                'uploaded_by' => 2,
                'updated_by' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Bài Tập Java OOP',
                'slug' => Str::slug('Bài Tập Java OOP'),
                'description' => 'Bài tập hướng đối tượng Java.',
                'thumbnail' => null,
                'view_count' => 90,
                'download_count' => 35,
                'subject_code' => 'JAVA101',
                'document_type_id' => 3,
                'uploaded_by' => 2,
                'updated_by' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}