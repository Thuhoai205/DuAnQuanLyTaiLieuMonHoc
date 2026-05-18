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
        Schema::create('users', function (Blueprint $table) {

            // Khóa chính
            $table->id('user_id');

            // Thông tin tài khoản
            $table->string('username', 50)->unique();
            $table->string('password');

            // Thông tin cá nhân
            $table->string('full_name', 100)->nullable();
            $table->string('email', 100)->unique()->nullable();

            // Ảnh đại diện
            $table->text('avatar')->nullable();

            // Vai trò
            $table->foreignId('role_id')
                ->constrained('roles', 'role_id')
                ->onDelete('cascade');

            // Trạng thái hoạt động
            $table->boolean('is_active')->default(true);

            // Ghi nhớ đăng nhập
            $table->rememberToken();

            // created_at + updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};