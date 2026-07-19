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
        Schema::create('subject_follows', function (Blueprint $table) {

            $table->id('follow_id');

            $table->unsignedBigInteger('user_id');

            $table->string('subject_code', 20);

            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('subject_code')
                ->references('subject_code')
                ->on('subjects')
                ->cascadeOnDelete();

            // Mỗi sinh viên chỉ được theo dõi một môn học một lần
            $table->unique(['user_id', 'subject_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_follows');
    }
};