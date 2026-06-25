<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentVersion extends Model
{
    protected $table = 'document_versions';
    protected $primaryKey = 'version_id';

    public $timestamps = true; 

    protected $fillable = [
        'document_id',
        'version_name',
        'version_note',
        'original_file_name',
        'stored_file_name',
        'file_path',
        'file_extension',
        'file_size',
        'uploaded_by',
        'is_current',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'is_current' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /*
    |-----------------------------
    | RELATIONS
    |-----------------------------
    */

    // thuộc document
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'document_id');
    }

    // người upload
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by', 'user_id');
    }

    // lịch sử download
    public function downloadHistories()
    {
        return $this->hasMany(DownloadHistory::class, 'version_id', 'version_id');
    }

    /*
    |-----------------------------
    | SCOPES (RẤT QUAN TRỌNG)
    |-----------------------------
    */

    // version hiện tại
    public function scopeCurrent($query)
    {
        return $query->where('is_current', true);
    }

    // sort mới nhất
    public function scopeLatest($query)
    {
        return $query->orderByDesc('created_at');
    }
}