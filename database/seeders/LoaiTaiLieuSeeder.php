<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LoaiTaiLieu;

class LoaiTaiLieuSeeder extends Seeder
{
    public function run(): void
    {
        LoaiTaiLieu::insert([

            [
                'ten_loai' => 'Slide bài giảng',
                'mo_ta' => 'Slide học tập',
            ],

            [
                'ten_loai' => 'Đề thi',
                'mo_ta' => 'Đề thi môn học',
            ],

            [
                'ten_loai' => 'Bài tập',
                'mo_ta' => 'Tài liệu bài tập',
            ],

            [
                'ten_loai' => 'Giáo trình',
                'mo_ta' => 'Tài liệu giáo trình',
            ],

        ]);
    }
}