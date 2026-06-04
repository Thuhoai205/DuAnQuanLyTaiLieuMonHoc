<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng lưu lịch sử tải tài liệu
     */
    public function up(): void
    {
        Schema::create('download_histories', function (Blueprint $table) {

            // Khóa chính
            $table->id('download_id');

            /*
            |--------------------------------------------------------------------------
            | NGƯỜI TẢI
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users', 'user_id')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | TÀI LIỆU ĐƯỢC TẢI
            |--------------------------------------------------------------------------
            */

            $table->foreignId('document_id')
                ->constrained('documents', 'document_id')
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | THỜI GIAN TẢI
            |--------------------------------------------------------------------------
            */

            $table->timestamp('downloaded_at')
                ->useCurrent();

            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index('user_id');
            $table->index('document_id');
            $table->index('downloaded_at');
        });
    }

    /**
     * Rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('download_histories');
    }
};