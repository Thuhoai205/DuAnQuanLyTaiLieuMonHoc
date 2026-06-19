<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;

return new class extends Migration

{

    /**

     * Bảng môn học

     */

    public function up(): void

    {

    Schema::create('subjects', function (Blueprint $table) {

        $table->string('subject_code', 20)->primary();

        $table->string('subject_name', 150);

        $table->string('slug')->unique();

        $table->text('description')->nullable();

        $table->string('thumbnail', 255)->nullable();

        $table->string('icon', 255)->nullable();

        $table->string('color', 30)->default('blue');

        $table->string('status', 20)->default('active');

        $table->foreignId('faculty_id')
            ->constrained('faculties', 'faculty_id')
            ->restrictOnDelete();

        $table->foreignId('created_by')
            ->nullable()
            ->constrained('users', 'user_id')
            ->nullOnDelete();

        $table->foreignId('updated_by')
            ->nullable()
            ->constrained('users', 'user_id')
            ->nullOnDelete();

        $table->foreignId('deleted_by')
            ->nullable()
            ->constrained('users', 'user_id')
            ->nullOnDelete();

        $table->timestamps();

        $table->softDeletes();

        $table->index('faculty_id');
        $table->index('subject_name');
        $table->index('status');
        $table->index('created_by');
        $table->index('updated_by');
        $table->index('deleted_by');
    });    }



    public function down(): void

    {

        Schema::dropIfExists('subjects');

    }

};