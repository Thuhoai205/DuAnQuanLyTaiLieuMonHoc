<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subject_teachers', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained('users', 'user_id')
                ->restrictOnDelete();

            $table->string('subject_code', 20);

            $table->foreign('subject_code')
                ->references('subject_code')
                ->on('subjects')
                ->restrictOnDelete();

            $table->timestamp('assigned_at')
                ->useCurrent();

            $table->timestamps();

            $table->unique(
                ['user_id', 'subject_code'],
                'unique_teacher_subject'
            );

            $table->index('user_id');
            $table->index('subject_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subject_teachers');
    }
};