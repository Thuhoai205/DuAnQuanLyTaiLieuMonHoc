<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng thông báo người dùng
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {

            $table->id('notification_id');

            $table->foreignId('user_id')
                ->constrained('users', 'user_id')
                ->cascadeOnDelete();

            $table->string('title', 255);

            $table->text('content');

            $table->string('type', 50)->nullable();
            // new_document
            // update_document
            // assign_teacher
            // system

            $table->string('related_type', 50)->nullable();

            $table->unsignedBigInteger('related_id')->nullable();

            $table->boolean('is_read')->default(false);

            $table->timestamp('created_at')->useCurrent();

            $table->index('user_id');
            $table->index('type');
            $table->index('is_read');
            $table->index('created_at');
        });
    }

    /**
     * Rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};