<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentVersion;

class DocumentVersionSeeder extends Seeder
{
    public function run(): void
    {
        DocumentVersion::insert([

            [
                'document_id' => 1,
                'version_name' => '1.0',
                'version_note' => 'Phiên bản đầu tiên',
                'original_file_name' => 'slide-laravel.pdf',
                'stored_file_name' => 'laravel_v1.pdf',
                'file_path' => 'documents/laravel_v1.pdf',
                'file_extension' => 'pdf',
                'mime_type' => 'application/pdf',
                'file_size' => 2048000,
                'uploaded_by' => 2,
                'is_current' => true,
                'created_at' => now(),
            ],

            [
                'document_id' => 2,
                'version_name' => '1.0',
                'version_note' => 'Đề thi cuối kỳ',
                'original_file_name' => 'de-thi-csdl.pdf',
                'stored_file_name' => 'csdl_exam.pdf',
                'file_path' => 'documents/csdl_exam.pdf',
                'file_extension' => 'pdf',
                'mime_type' => 'application/pdf',
                'file_size' => 1024000,
                'uploaded_by' => 2,
                'is_current' => true,
                'created_at' => now(),
            ],

            [
                'document_id' => 3,
                'version_name' => '1.0',
                'version_note' => 'Bài tập OOP',
                'original_file_name' => 'java-oop.docx',
                'stored_file_name' => 'java_oop.docx',
                'file_path' => 'documents/java_oop.docx',
                'file_extension' => 'docx',
                'mime_type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'file_size' => 512000,
                'uploaded_by' => 2,
                'is_current' => true,
                'created_at' => now(),
            ],

        ]);
    }
}