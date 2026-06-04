<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng loại tài liệu
     */
    public function up(): void
    {
        Schema::create('document_types', function (Blueprint $table) {

            // Khóa chính
            $table->id('document_type_id');

            /*
            |--------------------------------------------------------------------------
            | THÔNG TIN LOẠI TÀI LIỆU
            |--------------------------------------------------------------------------
            */

            // Tên loại tài liệu
            // Ví dụ:
            // Slide bài giảng
            // Bài tập
            // Đề thi
            // Giáo trình
            $table->string('type_name', 100);

            // Mô tả
            $table->text('description')->nullable();

            // Icon hiển thị
            $table->string('icon', 255)->nullable();

            // Màu hiển thị
            $table->string('color', 30)->default('blue');

            // Trạng thái hoạt động
            $table->boolean('is_active')->default(true);

            /*
            |--------------------------------------------------------------------------
            | THỜI GIAN
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            // Xóa mềm
            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index('type_name');
            $table->index('is_active');
            $table->index('deleted_at');
        });
    }

    /**
     * Rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('document_types');
    }
};