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
        Schema::create('tai_lieus', function (Blueprint $table) {

            $table->id('tai_lieu_id');

            /**
             * TIÊU ĐỀ
             */
            $table->string('tieu_de', 255);

            /**
             * TÊN FILE
             */
            $table->string('ten_file');

            /**
             * ĐƯỜNG DẪN FILE
             */
            $table->text('duong_dan');

            /**
             * KÍCH THƯỚC FILE
             */
            $table->bigInteger('kich_thuoc')->nullable();

            /**
             * LƯỢT TẢI
             */
            $table->integer('luot_tai')->default(0);

            /**
             * MÔ TẢ
             */
            $table->text('mo_ta')->nullable();

            /**
             * MÔN HỌC
             */
            $table->string('ma_mon', 20);

            $table->foreign('ma_mon')
                ->references('ma_mon')
                ->on('mon_hocs')
                ->cascadeOnDelete();

            /**
             * LOẠI TÀI LIỆU
             */
            $table->foreignId('loai_id')
                ->constrained('loai_tai_lieus', 'loai_id')
                ->restrictOnDelete();

            /**
             * NGƯỜI UPLOAD
             */
            $table->foreignId('nguoi_upload')
                ->references('user_id')
                ->on('users')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tai_lieus');
    }
};