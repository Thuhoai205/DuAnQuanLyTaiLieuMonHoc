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
                'mo_ta' => 'Slide phục vụ học tập',
            ],

            [
                'ten_loai' => 'Đề cương',
                'mo_ta' => 'Đề cương môn học',
            ],

            [
                'ten_loai' => 'Bài tập',
                'mo_ta' => 'Bài tập thực hành',
            ],

            [
                'ten_loai' => 'Đề thi',
                'mo_ta' => 'Đề thi tham khảo',
            ],

            [
                'ten_loai' => 'Tài liệu tham khảo',
                'mo_ta' => 'Tài liệu học tập thêm',
            ],
        ]);
    }
}