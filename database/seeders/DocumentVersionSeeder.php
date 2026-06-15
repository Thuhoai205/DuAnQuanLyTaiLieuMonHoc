<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DocumentVersionSeeder extends Seeder
{
    public function run(): void
    {
        $documents = DB::table('documents')->get();

        foreach ($documents as $document) {
            $storedFileName = Str::slug($document->title) . '-v1.pdf';

            DB::table('document_versions')->updateOrInsert(
                [
                    'document_id' => $document->document_id,
                    'version_name' => '1.0',
                ],
                [
                    'version_note' => 'Phiên bản đầu tiên',
                    'original_file_name' => $document->title . '.pdf',
                    'stored_file_name' => $storedFileName,
                    'file_path' => 'documents/' . $storedFileName,
                    'file_extension' => 'pdf',
                    'file_size' => 1024 * 500,
                    'uploaded_by' => $document->uploaded_by,
                    'is_current' => true,
                    'created_at' => now(),
                ]
            );
        }
    }
}