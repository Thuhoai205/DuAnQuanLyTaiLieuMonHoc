<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng phân công giảng viên phụ trách môn học
     */
    public function up(): void
    {
        Schema::create('subject_teachers', function (Blueprint $table) {

            // Khóa chính
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | GIẢNG VIÊN
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->constrained('users', 'user_id')
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | MÔN HỌC
            |--------------------------------------------------------------------------
            */

            $table->string('subject_code', 20);

            $table->foreign('subject_code')
                ->references('subject_code')
                ->on('subjects')
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | MỘT GIẢNG VIÊN KHÔNG ĐƯỢC PHÂN CÔNG
            | TRÙNG CÙNG MỘT MÔN HỌC
            |--------------------------------------------------------------------------
            */

            $table->unique(
                ['user_id', 'subject_code'],
                'unique_teacher_subject'
            );

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index('user_id');
            $table->index('subject_code');
        });
    }

    /**
     * Rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_teachers');
    }
};