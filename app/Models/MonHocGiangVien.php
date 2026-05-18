<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonHocGiangVien extends Model
{
    protected $table = 'mon_hoc_giang_vien';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'ma_mon',
    ];
}