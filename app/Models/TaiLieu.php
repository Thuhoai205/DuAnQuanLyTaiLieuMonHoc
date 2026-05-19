<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class TaiLieu extends Model
{
    use SoftDeletes;

    protected $table = 'tai_lieus';

    protected $primaryKey = 'tai_lieu_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'tieu_de',
        'slug',
        'ten_file',
        'duong_dan',
        'file_extension',
        'kich_thuoc',
        'luot_tai',
        'ma_mon',
        'loai_id',
        'nguoi_upload',
        'mo_ta',
        'is_public',
    ];

    protected $casts = [
        'luot_tai' => 'integer',
        'kich_thuoc' => 'integer',
        'is_public' => 'boolean',
    ];

    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'ma_mon', 'ma_mon');
    }

    public function loaiTaiLieu()
    {
        return $this->belongsTo(LoaiTaiLieu::class, 'loai_id', 'loai_id');
    }

    public function nguoiUpload()
    {
        return $this->belongsTo(User::class, 'nguoi_upload', 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->tieu_de);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('tieu_de')) {
                $model->slug = Str::slug($model->tieu_de);
            }
        });
    }
}