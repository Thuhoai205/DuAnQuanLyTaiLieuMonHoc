<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng thẻ (tag) tài liệu
     */
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {

            // Mã tag
            $table->id('tag_id');

            /*
            |--------------------------------------------------------------------------
            | THÔNG TIN TAG
            |--------------------------------------------------------------------------
            */

            // Tên tag
            // Ví dụ:
            // laravel
            // php
            // web-design
            $table->string('tag_name', 100)->unique();

            // Slug dùng cho URL
            $table->string('slug', 150)->unique();

            /*
            |--------------------------------------------------------------------------
            | THỜI GIAN
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index('tag_name');
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};