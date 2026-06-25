<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Document extends Model
{
    use SoftDeletes;

    protected $table = 'documents';
    protected $primaryKey = 'document_id';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'download_count',
        'subject_code',
        'document_type_id',
        'uploaded_by',
        'updated_by',
        'is_active',
    ];

    protected $casts = [
        'download_count' => 'integer',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /*
    |-----------------------------
    | VERSION SYSTEM
    |-----------------------------
    */

    // Version hiện tại (theo is_current = true)
    public function currentVersion()
    {
        return $this->hasOne(DocumentVersion::class, 'document_id', 'document_id')
            ->where('is_current', true);
    }

    // Tất cả version
    public function versions()
    {
        return $this->hasMany(DocumentVersion::class, 'document_id', 'document_id')
            ->orderByDesc('created_at');
    }

    /*
    |-----------------------------
    | RELATIONS
    |-----------------------------
    */

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_code', 'subject_code');
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id', 'document_type_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by', 'user_id');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by', 'user_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'document_id', 'document_id');
    }

    /*
    |-----------------------------
    | AUTO SLUG
    |-----------------------------
    */

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title) . '-' . Str::random(6);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title')) {
                $model->slug = Str::slug($model->title) . '-' . Str::random(6);
            }
        });
    }
}