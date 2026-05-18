<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaiLieu;

class TaiLieuSeeder extends Seeder
{
    public function run(): void
    {
        TaiLieu::insert([

            [
                'tieu_de' => 'Slide HTML CSS',
                'ten_file' => 'html_css.pdf',
                'duong_dan' => 'documents/html_css.pdf',
                'kich_thuoc' => 2048000,
                'luot_tai' => 120,
                'ma_mon' => 'WEB101',
                'loai_id' => 1,
                'nguoi_upload' => 2,
                'mo_ta' => 'Slide HTML CSS căn bản',
            ],

            [
                'tieu_de' => 'Đề cương Web',
                'ten_file' => 'de_cuong_web.pdf',
                'duong_dan' => 'documents/de_cuong_web.pdf',
                'kich_thuoc' => 1024000,
                'luot_tai' => 95,
                'ma_mon' => 'WEB101',
                'loai_id' => 2,
                'nguoi_upload' => 2,
                'mo_ta' => 'Đề cương môn lập trình web',
            ],

            [
                'tieu_de' => 'Bài tập Linked List',
                'ten_file' => 'linked_list.docx',
                'duong_dan' => 'documents/linked_list.docx',
                'kich_thuoc' => 500000,
                'luot_tai' => 60,
                'ma_mon' => 'CTDL',
                'loai_id' => 3,
                'nguoi_upload' => 3,
                'mo_ta' => 'Bài tập linked list',
            ],

            [
                'tieu_de' => 'Đề thi SQL Server',
                'ten_file' => 'de_thi_sql.pdf',
                'duong_dan' => 'documents/de_thi_sql.pdf',
                'kich_thuoc' => 1500000,
                'luot_tai' => 210,
                'ma_mon' => 'CSDL',
                'loai_id' => 4,
                'nguoi_upload' => 2,
                'mo_ta' => 'Đề thi SQL Server tham khảo',
            ],
        ]);
    }
}