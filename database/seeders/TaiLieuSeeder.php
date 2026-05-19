<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaiLieu;
use Illuminate\Support\Str;

class TaiLieuSeeder extends Seeder
{
    public function run(): void
    {
        TaiLieu::insert([

            [
                'tieu_de' => 'Slide HTML CSS',
                'slug' => Str::slug('Slide HTML CSS'),
                'ten_file' => 'html-css.pdf',
                'duong_dan' => 'uploads/html-css.pdf',
                'file_extension' => 'pdf',
                'kich_thuoc' => 2048000,
                'luot_tai' => 12,
                'ma_mon' => 'WEB101',
                'loai_id' => 1,
                'nguoi_upload' => 2,
                'mo_ta' => 'Slide HTML CSS cơ bản',
                'is_public' => true,
            ],

            [
                'tieu_de' => 'Đề thi Java',
                'slug' => Str::slug('Đề thi Java'),
                'ten_file' => 'de-thi-java.docx',
                'duong_dan' => 'uploads/de-thi-java.docx',
                'file_extension' => 'docx',
                'kich_thuoc' => 1024000,
                'luot_tai' => 5,
                'ma_mon' => 'JAVA101',
                'loai_id' => 2,
                'nguoi_upload' => 2,
                'mo_ta' => 'Đề thi Java giữa kỳ',
                'is_public' => true,
            ],

        ]);
    }
}