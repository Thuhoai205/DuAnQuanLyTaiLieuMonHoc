<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng lịch sử tìm kiếm
     */
    public function up(): void
    {
        Schema::create('search_histories', function (Blueprint $table) {
            $table->id('search_id');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users', 'user_id')
                ->nullOnDelete();

            $table->string('keyword', 255);

            $table->string('subject_code', 20)->nullable();

            $table->foreign('subject_code')
                ->references('subject_code')
                ->on('subjects')
                ->nullOnDelete();

            $table->foreignId('document_type_id')
                ->nullable()
                ->constrained('document_types', 'document_type_id')
                ->nullOnDelete();

            $table->unsignedInteger('result_count')->default(0);

            $table->timestamp('searched_at')->useCurrent();

            $table->index('user_id');
            $table->index('keyword');
            $table->index('subject_code');
            $table->index('document_type_id');
            $table->index('searched_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('search_histories');
    }
};