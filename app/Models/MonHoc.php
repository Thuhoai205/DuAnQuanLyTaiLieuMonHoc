<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    protected $table = 'mon_hoc';
    
    // Khai báo khóa chính tùy chỉnh
    protected $primaryKey = 'ma_mon';

    // Bảng này không dùng timestamps (created_at/updated_at) trong migration của bạn
    public $timestamps = false;

    protected $fillable = [
        'ten_mon',
        'mo_ta',
        'is_active'
    ];

    /**
     * Quan hệ: Một môn học có nhiều tài liệu
     */
    public function taiLieus()
    {
        return $this->hasMany(TaiLieu::class, 'ma_mon', 'ma_mon');
    }
}