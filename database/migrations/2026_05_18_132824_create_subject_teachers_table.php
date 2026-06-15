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

    $table->foreignId('created_by')
        ->nullable()
        ->constrained('users', 'user_id')
        ->nullOnDelete();

    $table->foreignId('updated_by')
        ->nullable()
        ->constrained('users', 'user_id')
        ->nullOnDelete();

    $table->foreignId('deleted_by')
        ->nullable()
        ->constrained('users', 'user_id')
        ->nullOnDelete();

    $table->timestamps();

    $table->softDeletes();

    $table->unique(
        ['user_id', 'subject_code'],
        'unique_teacher_subject'
    );

    $table->index('user_id');
    $table->index('subject_code');
    $table->index('created_by');
    $table->index('updated_by');
    $table->index('deleted_by');
});
    }

    public function down(): void
    {
        Schema::dropIfExists('subject_teachers');
    }
};