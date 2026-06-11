<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng lưu lịch sử tải tài liệu
     */
    public function up(): void
    {
        Schema::create('download_histories', function (Blueprint $table) {

            $table->id('download_id');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users', 'user_id')
                ->nullOnDelete();

            $table->foreignId('version_id')
                ->constrained('document_versions', 'version_id')
                ->restrictOnDelete();

            $table->timestamp('downloaded_at')
                ->useCurrent();

            $table->index('user_id');
            $table->index('version_id');
            $table->index('downloaded_at');
        });
    }

    /**
     * Rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('download_histories');
    }
};