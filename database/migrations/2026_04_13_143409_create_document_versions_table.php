<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng lưu các phiên bản của tài liệu
     */
    public function up(): void
    {
        Schema::create('document_versions', function (Blueprint $table) {

            $table->id('version_id');

            $table->foreignId('document_id')
                ->constrained('documents', 'document_id')
                ->cascadeOnDelete();

            // Phiên bản
            $table->string('version_name', 50)->default('1.0');

            $table->text('version_note')->nullable();

            // File gốc
            $table->string('original_file_name');
            $table->string('stored_file_name');
            $table->string('file_path');

            
            $table->string('file_extension', 20)->nullable();

            $table->unsignedBigInteger('file_size')->default(0);

            // Người upload
            $table->foreignId('uploaded_by')
                ->constrained('users', 'user_id')
                ->restrictOnDelete();

            // Phiên bản hiện tại
            $table->boolean('is_current')->default(false);

            $table->timestamp('created_at')->useCurrent();

            // Index
            $table->index('document_id');
            $table->index('uploaded_by');
            $table->index('is_current');
            $table->index('file_extension');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_versions');
    }
};