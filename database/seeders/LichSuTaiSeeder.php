<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LichSuTaiSeeder extends Seeder
{
    public function run(): void
{
    $user = DB::table('users')->where('username', 'sv01')->first();
    $taiLieu = DB::table('tai_lieus')->first();

    if ($user && $taiLieu) {
        DB::table('lich_su_tai')->insert([
            [
                'user_id' => $user->user_id,
                'tai_lieu_id' => $taiLieu->tai_lieu_id,
                'ngay_tai' => '2026-04-12 10:00:00' // Định dạng Y-m-d H:i:s
            ],
            [
                'user_id' => $user->user_id,
                'tai_lieu_id' => $taiLieu->tai_lieu_id,
                'ngay_tai' => '2026-04-13 15:30:00'
            ]
        ]);
    }
}
}