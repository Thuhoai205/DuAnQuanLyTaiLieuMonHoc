<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tạo bảng users
     * Bảng này lưu thông tin tài khoản người dùng:
     * Admin, Giảng viên, Sinh viên.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            // Khóa chính của bảng users
            $table->id('user_id');

            // Tên đăng nhập, không được trùng
            $table->string('username', 50)->unique();

            // Mật khẩu đã mã hóa
            $table->string('password', 255);

            // Họ tên người dùng
            $table->string('full_name', 100);

            // Email người dùng, không được trùng
            $table->string('email', 100)->unique();

            // Ảnh đại diện, có thể để trống
            $table->string('avatar', 255)->nullable();

            // Vai trò người dùng: admin, lecturer, student
            $table->foreignId('role_id')
                ->constrained('roles', 'role_id')
                ->restrictOnDelete();

            // Trạng thái tài khoản: 1 hoạt động, 0 bị khóa
            $table->boolean('is_active')->default(true);

            // Token ghi nhớ đăng nhập của Laravel
            $table->rememberToken();

            // created_at, updated_at
            $table->timestamps();

            // deleted_at - xóa mềm tài khoản
            $table->softDeletes();

            // Index hỗ trợ truy vấn nhanh
            $table->index('role_id');
            $table->index('is_active');
            $table->index('deleted_at');
        });
    }

    /**
     * Xóa bảng users khi rollback migration
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};