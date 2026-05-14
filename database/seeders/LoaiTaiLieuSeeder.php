<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoaiTaiLieuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('loai_tai_lieu')->insert([
            ['ten_loai' => 'Slide bài giảng'],
            ['ten_loai' => 'Bài tập thực hành'],
            ['ten_loai' => 'Đề thi mẫu'],
            ['ten_loai' => 'Video hướng dẫn'],
        ]);
    }
}