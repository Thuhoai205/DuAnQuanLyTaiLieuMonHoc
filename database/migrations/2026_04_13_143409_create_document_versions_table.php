<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng lưu phiên bản file của tài liệu
     */
    public function up(): void
    {
        Schema::create('document_versions', function (Blueprint $table) {

            $table->id('version_id');

            $table->foreignId('document_id')
                ->constrained('documents', 'document_id')
                ->cascadeOnDelete();

            $table->string('version_name', 50)->default('1.0');

            $table->text('version_note')->nullable();

            $table->string('original_file_name', 255);

            $table->string('stored_file_name', 255);

            $table->string('file_path', 500);

            $table->string('file_extension', 20)->nullable();

            $table->string('mime_type', 100)->nullable();

            $table->unsignedBigInteger('file_size')->default(0);

            $table->foreignId('uploaded_by')
                ->constrained('users', 'user_id')
                ->restrictOnDelete();

            $table->boolean('is_current')->default(false);

            $table->timestamp('created_at')->useCurrent();

            $table->index('document_id');
            $table->index('uploaded_by');
            $table->index('is_current');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_versions');
    }
};