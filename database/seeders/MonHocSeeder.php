<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonHocSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mon_hoc')->insert([
            ['ten_mon' => 'Lập trình PHP', 'mo_ta' => 'Học về ngôn ngữ PHP và Laravel Framework'],
            ['ten_mon' => 'Cơ sở dữ liệu', 'mo_ta' => 'Thiết kế và quản trị SQL Server'],
            ['ten_mon' => 'Lập trình di động', 'mo_ta' => 'Phát triển ứng dụng Android/iOS'],
        ]);
    }
}