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
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 2,
                'ma_mon' => 'CSDL',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 2,
                'ma_mon' => 'JAVA101',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}