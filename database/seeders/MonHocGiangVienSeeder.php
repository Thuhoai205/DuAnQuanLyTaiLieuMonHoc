<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonHocGiangVienSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mon_hoc_giang_vien')->insert([

            [
                'user_id' => 2,
                'ma_mon' => 'WEB101',
            ],

            [
                'user_id' => 2,
                'ma_mon' => 'CSDL',
            ],

            [
                'user_id' => 3,
                'ma_mon' => 'WEB101',
            ],

            [
                'user_id' => 3,
                'ma_mon' => 'CTDL',
            ],

            [
                'user_id' => 3,
                'ma_mon' => 'JAVA101',
            ],
        ]);
    }
}