<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {

            $table->id('favorite_id');

            $table->foreignId('user_id')
                ->constrained('users', 'user_id')
                ->cascadeOnDelete();

            $table->foreignId('document_id')
                ->constrained('documents', 'document_id')
                ->cascadeOnDelete();

            $table->timestamp('created_at')->useCurrent();

            $table->unique(
                ['user_id', 'document_id'],
                'unique_user_document_favorite'
            );

            $table->index('user_id');
            $table->index('document_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};