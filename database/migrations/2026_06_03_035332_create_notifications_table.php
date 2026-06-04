<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng thông báo người dùng
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {

            // Mã thông báo
            $table->id('notification_id');

            /*
            |--------------------------------------------------------------------------
            | NGƯỜI NHẬN THÔNG BÁO
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users', 'user_id')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | NỘI DUNG THÔNG BÁO
            |--------------------------------------------------------------------------
            */

            // Tiêu đề
            $table->string('title', 255);

            // Nội dung chi tiết
            $table->text('content');

            /*
            |--------------------------------------------------------------------------
            | LOẠI THÔNG BÁO
            |--------------------------------------------------------------------------
            */

            // document_uploaded
            // document_approved
            // document_rejected
            // new_document
            // system
            $table->string('type', 50)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | ĐỐI TƯỢNG LIÊN QUAN
            |--------------------------------------------------------------------------
            */

            // documents
            // users
            // subjects
            $table->string('related_type', 100)
                ->nullable();

            // ID của đối tượng liên quan
            $table->unsignedBigInteger('related_id')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | TRẠNG THÁI ĐÃ ĐỌC
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_read')
                ->default(false);

            /*
            |--------------------------------------------------------------------------
            | THỜI GIAN TẠO
            |--------------------------------------------------------------------------
            */

            $table->timestamp('created_at')
                ->useCurrent();

            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index('user_id');
            $table->index('is_read');
            $table->index('type');
            $table->index(['related_type', 'related_id']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};