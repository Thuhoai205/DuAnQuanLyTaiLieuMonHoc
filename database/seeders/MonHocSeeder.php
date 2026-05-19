<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MonHoc;
use Illuminate\Support\Str;

class MonHocSeeder extends Seeder
{
    public function run(): void
    {
        MonHoc::insert([

            [
                'ma_mon' => 'WEB101',
                'ten_mon' => 'Lập trình Web',
                'slug' => Str::slug('Lập trình Web'),
                'mo_ta' => 'Môn học phát triển website',
                'color' => 'blue',
                'tong_tai_lieu' => 0,
                'is_featured' => true,
                'is_active' => true,
            ],

            [
                'ma_mon' => 'CSDL',
                'ten_mon' => 'Cơ sở dữ liệu',
                'slug' => Str::slug('Cơ sở dữ liệu'),
                'mo_ta' => 'Môn học SQL Server',
                'color' => 'green',
                'tong_tai_lieu' => 0,
                'is_featured' => false,
                'is_active' => true,
            ],

            [
                'ma_mon' => 'JAVA101',
                'ten_mon' => 'Lập trình Java',
                'slug' => Str::slug('Lập trình Java'),
                'mo_ta' => 'Java cơ bản',
                'color' => 'red',
                'tong_tai_lieu' => 0,
                'is_featured' => false,
                'is_active' => true,
            ],

        ]);
    }
}