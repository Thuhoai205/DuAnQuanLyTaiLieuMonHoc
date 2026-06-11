<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';

    protected $primaryKey = 'log_id';

    public $timestamps = false;

    protected $fillable = [
    'user_id',
    'ip_address',
    'user_agent',
    'login_at',
    'logout_at',
];

protected $casts = [
    'login_at' => 'datetime',
    'logout_at' => 'datetime',
    'created_at' => 'datetime',
];
    /**
     * Người dùng thực hiện hành động
     */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'user_id'
        );
    }
}