<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        $lecturerAId = DB::table('users')
            ->where('email', 'hoaihoai@gmail.com')
            ->value('user_id');

        $lecturerBId = DB::table('users')
            ->where('email', 'minhhau@gmail.com')
            ->value('user_id');
        $notifications = [
            [
                'user_id' => $lecturerAId,
                'title' => 'Thông báo phân công giảng viên',
                'content' => 'Bạn đã được phân công phụ trách môn Cơ sở dữ liệu.',
                'type' => 'assign_teacher',
                'related_type' => 'subjects',
                'related_id' => null,
            ],
            [
                'user_id' => $lecturerBId,
                'title' => 'Thông báo phân công giảng viên',
                'content' => 'Bạn đã được phân công phụ trách môn Lập trình Web.',
                'type' => 'assign_teacher',
                'related_type' => 'subjects',
                'related_id' => null,
            ],
        ];

        foreach ($notifications as $notification) {
            DB::table('notifications')->insert([
                'user_id' => $notification['user_id'],
                'title' => $notification['title'],
                'content' => $notification['content'],
                'type' => $notification['type'],
                'related_type' => $notification['related_type'],
                'related_id' => $notification['related_id'],
                'is_read' => false,
                'created_at' => now(),
            ]);
        }
    }
}