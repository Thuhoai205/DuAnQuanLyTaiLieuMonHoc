<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichSuTai extends Model
{
    protected $table = 'lich_su_tai';

    // Khóa chính là 'id' (mặc định của Laravel nên không cần khai báo $primaryKey)
    
    // Tắt timestamps mặc định vì bạn chỉ có cột 'ngay_tai'
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'tai_lieu_id',
        'ngay_tai'
    ];

    /**
     * Quan hệ: Lịch sử này thuộc về một người dùng
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Quan hệ: Lịch sử này thuộc về một tài liệu
     */
    public function taiLieu()
    {
        return $this->belongsTo(TaiLieu::class, 'tai_lieu_id', 'tai_lieu_id');
    }
}