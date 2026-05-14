<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiTaiLieu extends Model
{
    protected $table = 'loai_tai_lieu';
    
    // Khai báo khóa chính vì bạn đặt là loai_id
    protected $primaryKey = 'loai_id';

    // Bảng này bạn CÓ dùng $table->timestamps() trong migration
    public $timestamps = true;

    protected $fillable = [
        'ten_loai'
    ];

    /**
     * Quan hệ: Một loại có nhiều tài liệu
     */
    public function taiLieus()
    {
        return $this->hasMany(TaiLieu::class, 'loai_id', 'loai_id');
    }
}