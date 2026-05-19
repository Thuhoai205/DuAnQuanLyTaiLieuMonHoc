<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonHocGiangVien extends Model
{
    protected $table = 'mon_hoc_giang_vien';

    protected $fillable = [
        'user_id',
        'ma_mon',
    ];

    public function giangVien()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'ma_mon', 'ma_mon');
    }
}