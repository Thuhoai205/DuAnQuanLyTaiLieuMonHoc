<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiTaiLieu extends Model
{
    protected $table = 'loai_tai_lieus';

    protected $primaryKey = 'loai_id';

    protected $fillable = [
        'ten_loai',
        'mo_ta',
    ];

    /**
     * LOẠI TÀI LIỆU CÓ NHIỀU TÀI LIỆU
     */
    public function taiLieus()
    {
        return $this->hasMany(
            TaiLieu::class,
            'loai_id',
            'loai_id'
        );
    }
}