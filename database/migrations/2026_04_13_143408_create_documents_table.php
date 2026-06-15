<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
    $table->id('document_id');

    $table->string('title', 255);

    $table->string('slug', 255)->unique();

    $table->text('description')->nullable();

    $table->string('thumbnail', 255)->nullable();

    $table->unsignedInteger('download_count')->default(0);

    $table->string('subject_code', 20);

    $table->foreign('subject_code')
        ->references('subject_code')
        ->on('subjects')
        ->restrictOnDelete();

    $table->foreignId('document_type_id')
        ->constrained('document_types', 'document_type_id')
        ->restrictOnDelete();

    $table->foreignId('uploaded_by')
        ->constrained('users', 'user_id')
        ->restrictOnDelete();

    $table->foreignId('updated_by')
        ->nullable()
        ->constrained('users', 'user_id')
        ->nullOnDelete();

    $table->foreignId('deleted_by')
        ->nullable()
        ->constrained('users', 'user_id')
        ->nullOnDelete();

    $table->boolean('is_active')->default(true);

    $table->timestamps();

    $table->softDeletes();

    $table->index('subject_code');
    $table->index('document_type_id');
    $table->index('uploaded_by');
    $table->index('updated_by');
    $table->index('deleted_by');
    $table->index('title');
    $table->index('is_active');
});
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};