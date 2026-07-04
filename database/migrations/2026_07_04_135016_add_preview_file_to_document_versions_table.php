<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('document_versions', function (Blueprint $table) {

            // File PDF hoặc ảnh dùng để xem trước
            $table->string('preview_file')->nullable()->after('file_path');

        });
    }

    public function down(): void
    {
        Schema::table('document_versions', function (Blueprint $table) {

            $table->dropColumn('preview_file');

        });
    }
};