<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MonHoc;
use App\Models\LoaiTaiLieu;
use App\Models\User;

class TaiLieu extends Model
{
    protected $table = 'tai_lieus';

    protected $primaryKey = 'tai_lieu_id';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'tieu_de',
        'ten_file',
        'duong_dan',
        'kich_thuoc',
        'luot_tai',
        'ma_mon',
        'loai_id',
        'nguoi_upload',
        'mo_ta',
    ];

    protected $casts = [
        'luot_tai' => 'integer',
        'kich_thuoc' => 'integer',
    ];

    /*
    |---------------------------------------
    | MÔN HỌC
    |---------------------------------------
    */
    public function monHoc()
    {
        return $this->belongsTo(
            MonHoc::class,
            'ma_mon',
            'ma_mon'
        );
    }

    /*
    |---------------------------------------
    | LOẠI TÀI LIỆU
    |---------------------------------------
    */
    public function loaiTaiLieu()
    {
        return $this->belongsTo(
            LoaiTaiLieu::class,
            'loai_id',
            'loai_id'
        );
    }

    /*
    |---------------------------------------
    | NGƯỜI UPLOAD
    |---------------------------------------
    */
    public function nguoiUpload()
    {
        return $this->belongsTo(
            User::class,
            'nguoi_upload',
            'user_id'
        );
    }
}