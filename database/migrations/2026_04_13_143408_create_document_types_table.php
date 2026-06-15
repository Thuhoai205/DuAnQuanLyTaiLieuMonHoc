<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_types', function (Blueprint $table) {

    $table->id('document_type_id');

    $table->string('type_name', 100)->unique();

    $table->text('description')->nullable();

    $table->string('icon', 255)->nullable();

    $table->string('color', 30)->default('blue');

    $table->boolean('is_active')->default(true);

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

    $table->index('is_active');
    $table->index('created_by');
    $table->index('updated_by');
    $table->index('deleted_by');
});
    }

    public function down(): void
    {
        Schema::dropIfExists('document_types');
    }
};