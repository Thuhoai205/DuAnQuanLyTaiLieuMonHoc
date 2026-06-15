<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('users', function (Blueprint $table) {

    $table->id('user_id');

    $table->string('username', 50)->unique();

    $table->string('password');

    $table->string('full_name', 100);

    $table->string('email', 100)->unique();

    $table->string('avatar', 255)->nullable();

    $table->foreignId('role_id')
        ->constrained('roles', 'role_id')
        ->restrictOnDelete();

    $table->boolean('is_active')->default(true);

    $table->rememberToken();

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

    $table->index('role_id');
    $table->index('is_active');
    $table->index('created_by');
    $table->index('updated_by');
    $table->index('deleted_by');
});
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};