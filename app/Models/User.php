<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\MonHoc;
use App\Models\TaiLieu;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'user_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'username',
        'password',
        'full_name',
        'email',
        'avatar',
        'role_id',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |---------------------------------------
    | ROLE (1 user -> 1 role)
    |---------------------------------------
    */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    /*
    |---------------------------------------
    | GIẢNG VIÊN - MÔN HỌC (N-N)
    |---------------------------------------
    */
    public function monHocs()
    {
        return $this->belongsToMany(
            MonHoc::class,
            'mon_hoc_giang_vien',
            'user_id',
            'ma_mon'
        );
    }

    /*
    |---------------------------------------
    | USER UPLOAD TÀI LIỆU (1-N)
    |---------------------------------------
    */
    public function taiLieus()
    {
        return $this->hasMany(
            TaiLieu::class,
            'nguoi_upload',
            'user_id'
        );
    }
}