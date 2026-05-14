<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaiLieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Lấy danh sách ID để đảm bảo có dữ liệu cha
        $maMonIds = DB::table('mon_hoc')->pluck('ma_mon')->toArray();
        $loaiIds = DB::table('loai_tai_lieu')->pluck('loai_id')->toArray();
        $userIds = DB::table('users')->pluck('user_id')->toArray();

        // 2. Kiểm tra nếu các bảng cha có dữ liệu thì mới tiến hành seed
        if (!empty($maMonIds) && !empty($loaiIds) && !empty($userIds)) {
            DB::table('tai_lieu')->insert([
                [
                    'ten_tai_lieu' => 'Slide chương 1: Nhập môn lập trình',
                    'file_path' => 'uploads/tai-lieu/slide-c1.pdf',
                    'kich_thuoc' => 1024, // 1MB
                    'dinh_dang' => 'pdf',
                    'ma_mon' => $maMonIds[0], 
                    'loai_id' => $loaiIds[0], // Giả sử là Slide
                    'nguoi_upload' => $userIds[0], 
                    'ngay_upload' => now(),
                    'luot_tai' => 10,
                    'mo_ta' => 'Tài liệu hướng dẫn cơ bản cho người mới bắt đầu.',
                    'trang_thai' => 1
                ],
                [
                    'ten_tai_lieu' => 'Đề thi mẫu kỳ 1 - Năm 2024',
                    'file_path' => 'uploads/tai-lieu/de-thi-mau.docx',
                    'kich_thuoc' => 512,
                    'dinh_dang' => 'docx',
                    'ma_mon' => $maMonIds[0], 
                    'loai_id' => $loaiIds[2] ?? $loaiIds[0], // Giả sử là Đề thi mẫu
                    'nguoi_upload' => $userIds[1] ?? $userIds[0], 
                    'ngay_upload' => now(),
                    'luot_tai' => 5,
                    'mo_ta' => 'Đề thi tham khảo cho sinh viên khóa 15.',
                    'trang_thai' => 1
                ],
            ]);
        } else {
            // Thông báo nếu thiếu dữ liệu cha
            $this->command->warn('TaiLieuSeeder: Chua co du lieu trong bang MonHoc, LoaiTaiLieu hoac Users!');
        }
    }
}