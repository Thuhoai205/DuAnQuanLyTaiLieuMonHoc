<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $primaryKey = 'role_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'role_name',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Danh sách người dùng thuộc vai trò này
     */
    public function users()
    {
        return $this->hasMany(
            User::class,
            'role_id',
            'role_id'
        );
    }
}