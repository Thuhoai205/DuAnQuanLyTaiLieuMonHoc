<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    // Cực kỳ quan trọng: Khai báo lại khóa chính
    protected $primaryKey = 'user_id';

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
    ];

    // Thiết lập quan hệ với Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
}