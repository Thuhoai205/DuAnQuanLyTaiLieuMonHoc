<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loai_tai_lieus', function (Blueprint $table) {

            // PRIMARY KEY
            $table->id('loai_id');

            /*
            |--------------------------------------------------------------------------
            | THÔNG TIN LOẠI TÀI LIỆU
            |--------------------------------------------------------------------------
            */

            // Tên loại
            // VD: Slide bài giảng, Đề thi, Bài tập...
            $table->string('ten_loai', 100);

            // Mô tả
            $table->text('mo_ta')->nullable();

            // Icon frontend
            // VD: fa-file-pdf
            $table->string('icon')->nullable();

            // Màu badge UI
            // VD: blue / red / amber
            $table->string('color', 30)->default('blue');

            // Trạng thái
            $table->boolean('is_active')->default(true);

            /*
            |--------------------------------------------------------------------------
            | TIMESTAMPS
            |--------------------------------------------------------------------------
            */

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loai_tai_lieus');
    }
};