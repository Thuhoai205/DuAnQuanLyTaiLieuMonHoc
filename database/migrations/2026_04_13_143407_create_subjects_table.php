<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng môn học
     */
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {

            // Mã môn học
            $table->string('subject_code', 20)->primary();

            // Tên môn học
            $table->string('subject_name', 150);

            // Đường dẫn thân thiện
            $table->string('slug')->unique();

            // Mô tả môn học
            $table->text('description')->nullable();

            // Ảnh đại diện môn học
            $table->string('thumbnail', 255)->nullable();

            // Icon hiển thị
            $table->string('icon', 255)->nullable();

            // Màu giao diện
            $table->string('color', 30)->default('blue');

            // Tổng số tài liệu của môn học
            $table->unsignedInteger('total_documents')->default(0);

            // Môn học nổi bật
            $table->boolean('is_featured')->default(false);

            // Trạng thái hoạt động
            $table->boolean('is_active')->default(true);

            // Thời gian tạo và cập nhật
            $table->timestamps();

            // Xóa mềm
            $table->softDeletes();

            // Index hỗ trợ tìm kiếm
            $table->index('subject_name');
            $table->index('is_active');
            $table->index('deleted_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};