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
        Schema::create('comments', function (Blueprint $table) {

            $table->id('comment_id');

            $table->unsignedBigInteger('document_id');

            $table->unsignedBigInteger('user_id');

            // Bình luận cha (null = bình luận gốc)
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->text('content');

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Foreign Keys
            |--------------------------------------------------------------------------
            */

            $table->foreign('document_id')
                ->references('document_id')
                ->on('documents')
                ->cascadeOnDelete();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('parent_id')
                ->references('comment_id')
                ->on('comments')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};