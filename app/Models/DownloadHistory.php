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
        'document_id',
        'downloaded_at',
    ];

    protected $casts = [
        'downloaded_at' => 'datetime',
    ];

    /**
     * Lịch sử tải thuộc về một người dùng
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
     * Lịch sử tải thuộc về một tài liệu
     */
    public function document()
    {
        return $this->belongsTo(
            Document::class,
            'document_id',
            'document_id'
        );
    }
}