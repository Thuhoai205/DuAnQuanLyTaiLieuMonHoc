<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng tài liệu môn học
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {

            // Khóa chính
            $table->id('document_id');

            // Tiêu đề tài liệu
            $table->string('title', 255);

            // Slug dùng cho URL
            $table->string('slug', 255)->unique();

            // Tên file gốc khi upload
            $table->string('original_file_name', 255);

            // Đường dẫn lưu file
            $table->string('file_path', 500);

            // Định dạng file: pdf, docx, pptx...
            $table->string('file_extension', 20)->nullable();

            // Kích thước file
            $table->unsignedBigInteger('file_size')->default(0);

            // Số lượt tải
            $table->unsignedInteger('download_count')->default(0);

            // Mô tả tài liệu
            $table->text('description')->nullable();

            // Công khai hay không
            $table->boolean('is_public')->default(true);

            // Trạng thái duyệt tài liệu
            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('approved');

            // Lý do từ chối nếu tài liệu bị rejected
            $table->text('rejection_reason')->nullable();

            // Mã môn học
            $table->string('subject_code', 20);

            $table->foreign('subject_code')
                ->references('subject_code')
                ->on('subjects')
                ->restrictOnDelete();

            // Loại tài liệu
            $table->foreignId('document_type_id')
                ->constrained('document_types', 'document_type_id')
                ->restrictOnDelete();

            // Người upload
            $table->foreignId('uploaded_by')
                ->nullable()
                ->references('user_id')
                ->on('users')
                ->nullOnDelete();

            // created_at, updated_at
            $table->timestamps();

            // deleted_at
            $table->softDeletes();

            // Index hỗ trợ tìm kiếm/lọc
            $table->index('title');
            $table->index('subject_code');
            $table->index('document_type_id');
            $table->index('uploaded_by');
            $table->index('status');
            $table->index('is_public');
            $table->index('deleted_at');

            // Index tổng hợp cho bộ lọc tài liệu
            $table->index(
                ['subject_code', 'document_type_id', 'status', 'is_public'],
                'idx_documents_filter'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};