<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng lịch sử tìm kiếm
     */
    public function up(): void
    {
        Schema::create('search_histories', function (Blueprint $table) {

            // Mã lịch sử tìm kiếm
            $table->id('search_id');

            /*
            |--------------------------------------------------------------------------
            | NGƯỜI TÌM KIẾM
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users', 'user_id')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | THÔNG TIN TÌM KIẾM
            |--------------------------------------------------------------------------
            */

            // Từ khóa tìm kiếm
            $table->string('keyword', 255);

            // Môn học được lọc
            $table->string('subject_code', 20)
                ->nullable();

            $table->foreign('subject_code')
                ->references('subject_code')
                ->on('subjects')
                ->nullOnDelete();

            // Loại tài liệu được lọc
            $table->foreignId('document_type_id')
                ->nullable()
                ->constrained('document_types', 'document_type_id')
                ->nullOnDelete();

            // Số kết quả tìm được
            $table->unsignedInteger('result_count')
                ->default(0);

            // Địa chỉ IP
            $table->string('ip_address', 45)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | THỜI GIAN TÌM KIẾM
            |--------------------------------------------------------------------------
            */

            $table->timestamp('searched_at')
                ->useCurrent();

            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index('user_id');
            $table->index('keyword');
            $table->index('subject_code');
            $table->index('document_type_id');
            $table->index('searched_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('search_histories');
    }
};