<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng liên kết tài liệu và tag
     */
    public function up(): void
    {
        Schema::create('document_tags', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | TÀI LIỆU
            |--------------------------------------------------------------------------
            */

            $table->foreignId('document_id')
                ->constrained('documents', 'document_id')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | TAG
            |--------------------------------------------------------------------------
            */

            $table->foreignId('tag_id')
                ->constrained('tags', 'tag_id')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | THỜI GIAN GẮN TAG
            |--------------------------------------------------------------------------
            */

            $table->timestamp('created_at')
                ->useCurrent();

            /*
            |--------------------------------------------------------------------------
            | PRIMARY KEY KÉP
            |--------------------------------------------------------------------------
            */

            $table->primary([
                'document_id',
                'tag_id'
            ]);

            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            */

            $table->index('document_id');
            $table->index('tag_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_tags');
    }
};