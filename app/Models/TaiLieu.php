<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaiLieu extends Model
{
    protected $table = 'tai_lieu';
    protected $primaryKey = 'tai_lieu_id';
    const CREATED_AT = 'ngay_upload'; // Ánh xạ cột của bạn vào Laravel
    const UPDATED_AT = 'ngay_cap_nhat';

    protected $fillable = [
        'ten_tai_lieu', 'file_path', 'kich_thuoc', 'dinh_dang', 
        'ma_mon', 'loai_id', 'nguoi_upload', 'mo_ta', 'trang_thai'
    ];

    public function monHoc() {
        return $this->belongsTo(MonHoc::class, 'ma_mon', 'ma_mon');
    }

    public function loaiTaiLieu() {
        return $this->belongsTo(LoaiTaiLieu::class, 'loai_id', 'loai_id');
    }

    public function nguoiDang() {
        return $this->belongsTo(User::class, 'nguoi_upload', 'user_id');
    }
}