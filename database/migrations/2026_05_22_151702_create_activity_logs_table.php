<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng nhật ký hoạt động hệ thống
     */
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {

            // Mã nhật ký
            $table->id('log_id');

            /*
            |--------------------------------------------------------------------------
            | NGƯỜI THỰC HIỆN
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users', 'user_id')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | THÔNG TIN HÀNH ĐỘNG
            |--------------------------------------------------------------------------
            */

            // login, logout, upload_document, delete_document...
            $table->string('action', 100);

            // documents, users, subjects...
            $table->string('object_type', 100)
                ->nullable();

            // id của đối tượng
            $table->unsignedBigInteger('object_id')
                ->nullable();

            // mô tả chi tiết
            $table->text('description');

            /*
            |--------------------------------------------------------------------------
            | THÔNG TIN THIẾT BỊ
            |--------------------------------------------------------------------------
            */

            // địa chỉ IP
            $table->string('ip_address', 45)
                ->nullable();

            // trình duyệt / thiết bị
            $table->text('user_agent')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | THỜI GIAN
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
            $table->index('action');
            $table->index(['object_type', 'object_id']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};