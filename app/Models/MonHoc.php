<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MonHoc extends Model
{
    protected $table = 'mon_hocs';

    protected $primaryKey = 'ma_mon';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'ma_mon',
        'ten_mon',
        'mo_ta',
        'slug', 
    ];

    /**
     * MÔN HỌC CÓ NHIỀU TÀI LIỆU
     */
    public function taiLieus()
    {
        return $this->hasMany(
            TaiLieu::class,
            'ma_mon',
            'ma_mon'
        );
    }

    /**
     * MÔN HỌC CÓ NHIỀU GIẢNG VIÊN
     */
    public function giangViens()
    {
        return $this->belongsToMany(
            User::class,
            'mon_hoc_giang_vien',
            'ma_mon',
            'user_id',
            'ma_mon',
            'user_id'
        );
    }

protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        $model->slug = Str::slug($model->ten_mon);
    });
}
}