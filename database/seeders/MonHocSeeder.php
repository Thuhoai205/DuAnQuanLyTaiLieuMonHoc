<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\MonHoc;

class MonHocSeeder extends Seeder
{
    public function run(): void
    {
        MonHoc::insert([

            [
                'ma_mon' => 'WEB101',
                'ten_mon' => 'Lập trình Web',
                'mo_ta' => 'Môn học về phát triển website',
                'slug' => Str::slug('Lập trình Web'),
            ],

            [
                'ma_mon' => 'CTDL',
                'ten_mon' => 'Cấu trúc dữ liệu',
                'mo_ta' => 'Môn học về giải thuật và cấu trúc dữ liệu',
                'slug' => Str::slug('Cấu trúc dữ liệu'),
            ],

            [
                'ma_mon' => 'CSDL',
                'ten_mon' => 'Cơ sở dữ liệu',
                'mo_ta' => 'Môn học về SQL Server và quản trị dữ liệu',
                'slug' => Str::slug('Cơ sở dữ liệu'),
            ],

            [
                'ma_mon' => 'JAVA101',
                'ten_mon' => 'Lập trình Java',
                'mo_ta' => 'Môn học Java căn bản',
                'slug' => Str::slug('Lập trình Java'),
            ],
        ]);
    }
}