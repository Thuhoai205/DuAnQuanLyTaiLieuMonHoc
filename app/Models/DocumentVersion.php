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

        // File PDF dùng để xem trước
        'preview_file',

        'file_extension',
        'file_size',

        'uploaded_by',

        'is_current',
    ];

    protected $casts = [
        'file_size'  => 'integer',
        'is_current' => 'boolean',
        'created_at' => 'datetime',
    ];

    /**
     * Tài liệu
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
     * Người upload
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
     * Lịch sử tải
     */
    public function downloadHistories()
    {
        return $this->hasMany(
            DownloadHistory::class,
            'version_id',
            'version_id'
        );
    }

    /**
     * Có xem trực tiếp được không
     */
    public function canPreview(): bool
    {
        return !empty($this->preview_file);
    }

    /**
     * Có phải PDF
     */
    public function isPdf(): bool
    {
        return strtolower($this->file_extension) === 'pdf';
    }

    /**
     * Có phải ảnh
     */
    public function isImage(): bool
    {
        return in_array(
            strtolower($this->file_extension),
            [
                'jpg',
                'jpeg',
                'png',
                'gif',
                'webp',
            ]
        );
    }

    /**
     * Có phải Office
     */
    public function isOffice(): bool
    {
        return in_array(
            strtolower($this->file_extension),
            [
                'doc',
                'docx',
                'xls',
                'xlsx',
                'ppt',
                'pptx',
            ]
        );
    }

    /**
     * Link file gốc
     */
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    /**
     * Link file xem trước
     */
    public function getPreviewUrlAttribute()
    {
        return $this->preview_file
            ? asset('storage/' . $this->preview_file)
            : null;
    }
}