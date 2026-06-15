<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $adminId = DB::table('users')
            ->where('email', 'admin@gmail.com')
            ->value('user_id');

        $lecturerId = DB::table('users')
            ->where('email', 'hoaihoai@gmail.com')
            ->value('user_id');

        DB::table('activity_logs')->insert([
            [
                'user_id' => $adminId,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Seeder',
                'login_at' => now()->subHours(3),
                'logout_at' => now()->subHours(2),
                'created_at' => now()->subHours(3),
            ],
            [
                'user_id' => $lecturerId,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Seeder',
                'login_at' => now()->subHours(2),
                'logout_at' => now()->subHour(),
                'created_at' => now()->subHours(2),
            ],
            [
                'user_id' => $adminId,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Seeder',
                'login_at' => now()->subMinutes(30),
                'logout_at' => null,
                'created_at' => now()->subMinutes(30),
            ],
        ]);
    }
}