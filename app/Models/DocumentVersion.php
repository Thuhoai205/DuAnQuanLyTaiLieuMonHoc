<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentVersion extends Model
{
    protected $table = 'document_versions';

    protected $primaryKey = 'version_id';

    public $timestamps = false;

    protected $fillable = [
        'document_id',
        'version_name',
        'version_note',
        'original_file_name',
        'stored_file_name',
        'file_path',
        'file_extension',
        'mime_type',
        'file_size',
        'uploaded_by',
        'is_current',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'is_current' => 'boolean',
        'created_at' => 'datetime',
    ];

    /**
     * Tài liệu cha
     */
    public function document()
    {
        return $this->belongsTo(
            Document::class,
            'document_id',
            'document_id'
        );
    }

    /**
     * Người upload phiên bản này
     */
    public function uploader()
    {
        return $this->belongsTo(
            User::class,
            'uploaded_by',
            'user_id'
        );
    }

    /**
     * Lịch sử tải phiên bản này
     */
    public function downloadHistories()
    {
        return $this->hasMany(
            DownloadHistory::class,
            'version_id',
            'version_id'
        );
    }
}