<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faculties', function (Blueprint $table) {

            $table->id('faculty_id');

            $table->string('faculty_code', 20)->unique();

            $table->string('faculty_name', 150)->unique();

            $table->text('description')->nullable();

            $table->boolean('is_active')->default(true);

            // Không tạo khóa ngoại tới users để tránh vòng lặp
            $table->unsignedBigInteger('created_by')->nullable();

            $table->unsignedBigInteger('updated_by')->nullable();

            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->timestamps();

            $table->softDeletes();

            $table->index('is_active');
            $table->index('created_by');
            $table->index('updated_by');
            $table->index('deleted_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faculties');
    }
};