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
        Schema::create('mon_hocs', function (Blueprint $table) {

            /**
             * MÃ MÔN HỌC
             * Ví dụ:
             * WEB101
             * CSDL
             */
            $table->string('ma_mon', 20)->primary();

            /**
             * TÊN MÔN
             */
            $table->string('ten_mon', 150);

            /**
             * SLUG URL
             */
            $table->string('slug')->unique();

            /**
             * MÔ TẢ
             */
            $table->text('mo_ta')->nullable();

            /**
             * ẢNH ĐẠI DIỆN
             */
            $table->string('thumbnail')->nullable();

            /**
             * ICON UI
             */
            $table->string('icon')->nullable();

            /**
             * MÀU HIỂN THỊ
             */
            $table->string('color', 30)->default('blue');

            /**
             * TỔNG TÀI LIỆU
             */
            $table->integer('tong_tai_lieu')->default(0);

            /**
             * HIỂN THỊ NỔI BẬT
             */
            $table->boolean('is_featured')->default(false);

            /**
             * TRẠNG THÁI
             */
            $table->boolean('is_active')->default(true);

            /**
             * TIMESTAMPS
             */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mon_hocs');
    }
};