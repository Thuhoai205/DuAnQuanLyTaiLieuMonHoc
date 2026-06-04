<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng tài liệu yêu thích
     */
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {

            // Mã yêu thích
            $table->id('favorite_id');

            /*
            |--------------------------------------------------------------------------
            | NGƯỜI DÙNG
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->constrained('users', 'user_id')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | TÀI LIỆU ĐƯỢC YÊU THÍCH
            |--------------------------------------------------------------------------
            */

            $table->foreignId('document_id')
                ->constrained('documents', 'document_id')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | THỜI GIAN THÊM VÀO YÊU THÍCH
            |--------------------------------------------------------------------------
            */

            $table->timestamp('created_at')
                ->useCurrent();

            /*
            |--------------------------------------------------------------------------
            | MỘT USER CHỈ ĐƯỢC THÍCH 1 LẦN
            |--------------------------------------------------------------------------
            */

            $table->unique(
                ['user_id', 'document_id'],
                'unique_user_document_favorite'
            );

            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index('user_id');
            $table->index('document_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};