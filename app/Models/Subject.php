<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Subject extends Model
{
    use SoftDeletes;

    protected $table = 'subjects';

    protected $primaryKey = 'subject_code';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'subject_code',
        'subject_name',
        'slug',
        'description',
        'thumbnail',
        'icon',
        'color',
        'total_documents',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'total_documents' => 'integer',
    ];

    /**
     * Một môn học có nhiều tài liệu
     */
    public function documents()
    {
        return $this->hasMany(
            Document::class,
            'subject_code',
            'subject_code'
        );
    }

    /**
     * Một môn học có nhiều giảng viên
     */
    public function lecturers()
    {
        return $this->belongsToMany(
            User::class,
            'subject_teachers',
            'subject_code',
            'user_id',
            'subject_code',
            'user_id'
        )->withTimestamps();
    }

    /**
     * Lịch sử tìm kiếm theo môn học
     */
    public function searchHistories()
    {
        return $this->hasMany(
            SearchHistory::class,
            'subject_code',
            'subject_code'
        );
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->subject_name);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('subject_name')) {
                $model->slug = Str::slug($model->subject_name);
            }
        });
    }
}