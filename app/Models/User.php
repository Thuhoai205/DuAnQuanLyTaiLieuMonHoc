<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Role;
use App\Models\MonHoc;
use App\Models\TaiLieu;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

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
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function monHocs()
    {
        return $this->belongsToMany(
            MonHoc::class,
            'mon_hoc_giang_vien',
            'user_id',
            'ma_mon'
        );
    }

    public function taiLieus()
    {
        return $this->hasMany(
            TaiLieu::class,
            'nguoi_upload',
            'user_id'
        );
    }
}