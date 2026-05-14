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
        Schema::create('loai_tai_lieu', function (Blueprint $table) {
            $table->id('loai_id'); // khóa chính (theo ERD)

            $table->string('ten_loai'); // tên loại (Slide, Bài tập, Đề thi...)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loai_tai_lieu');
    }
};