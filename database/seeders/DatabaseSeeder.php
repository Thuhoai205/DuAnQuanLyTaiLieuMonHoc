<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
{
    $this->call([
        RoleSeeder::class,      // Tạo quyền trước
        UserSeeder::class,       // Tạo người dùng
        MonHocSeeder::class,     // Tạo môn học
        LoaiTaiLieuSeeder::class,       // Tạo loại tài liệu (Slide, Đề thi...)
        TaiLieuSeeder::class,    // Tạo tài liệu (Phải có môn và loại mới tạo được cái này)
        LichSuTaiSeeder::class,  // CHẠY CUỐI CÙNG (Sau khi đã có tài liệu và người dùng)
    ]);
}
}