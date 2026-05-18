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
        Schema::create('mon_hoc_giang_vien', function (Blueprint $table) {

            $table->id();

            /**
             * GIẢNG VIÊN
             */
            $table->foreignId('user_id')
                ->constrained('users', 'user_id')
                ->cascadeOnDelete();

            /**
             * MÔN HỌC
             */
            $table->string('ma_mon', 20);

            $table->foreign('ma_mon')
                ->references('ma_mon')
                ->on('mon_hocs')
                ->cascadeOnDelete();

            /**
             * KHÔNG CHO TRÙNG
             */
            $table->unique(['user_id', 'ma_mon']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mon_hoc_giang_vien');
    }
};