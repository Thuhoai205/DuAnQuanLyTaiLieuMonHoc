<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadHistory extends Model
{
    protected $table = 'download_histories';

    protected $primaryKey = 'download_id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'version_id',
    ];

    protected $casts = [
        'downloaded_at' => 'datetime',
    ];

    /**
     * Người dùng tải tài liệu
     */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'user_id'
        );
    }

    /**
     * Phiên bản tài liệu được tải
     */
    public function version()
    {
        return $this->belongsTo(
            DocumentVersion::class,
            'version_id',
            'version_id'
        );
    }
}