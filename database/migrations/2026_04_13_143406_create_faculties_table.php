<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bảng khoa
     */
    public function up(): void
    {
        Schema::create('faculties', function (Blueprint $table) {

            $table->id('faculty_id');

            $table->string('faculty_code', 20)->unique();

            $table->string('faculty_name', 150)->unique();

            $table->text('description')->nullable();

            $table->boolean('is_active')->default(true);

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users', 'user_id')
                ->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users', 'user_id')
                ->nullOnDelete();

            $table->timestamps();

            $table->softDeletes();

            $table->index('faculty_code');
            $table->index('faculty_name');
            $table->index('is_active');
        });
    }

    /**
     * Rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('faculties');
    }
};