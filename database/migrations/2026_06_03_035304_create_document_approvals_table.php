<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng lịch sử duyệt tài liệu
     */
    public function up(): void
    {
        Schema::create('document_approvals', function (Blueprint $table) {

            // Mã duyệt
            $table->id('approval_id');

            /*
            |--------------------------------------------------------------------------
            | TÀI LIỆU ĐƯỢC DUYỆT
            |--------------------------------------------------------------------------
            */

            $table->foreignId('document_id')
                ->constrained('documents', 'document_id')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | NGƯỜI DUYỆT (ADMIN)
            |--------------------------------------------------------------------------
            */

            $table->foreignId('approved_by')
                ->constrained('users', 'user_id')
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | KẾT QUẢ DUYỆT
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'pending',
                'approved',
                'rejected'
            ]);

            /*
            |--------------------------------------------------------------------------
            | GHI CHÚ
            |--------------------------------------------------------------------------
            */

            $table->text('note')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | THỜI GIAN DUYỆT
            |--------------------------------------------------------------------------
            */

            $table->timestamp('approved_at')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | THỜI GIAN TẠO BẢN GHI
            |--------------------------------------------------------------------------
            */

            $table->timestamp('created_at')
                ->useCurrent();

            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index('document_id');
            $table->index('approved_by');
            $table->index('status');
            $table->index('approved_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_approvals');
    }
};