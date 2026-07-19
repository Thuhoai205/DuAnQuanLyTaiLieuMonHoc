<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        'status',
        'faculty_id',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function faculty()
    {
        return $this->belongsTo(
            Faculty::class,
            'faculty_id',
            'faculty_id'
        );
    }

    public function creator()
    {
        return $this->belongsTo(
            User::class,
            'created_by',
            'user_id'
        );
    }

    public function updater()
    {
        return $this->belongsTo(
            User::class,
            'updated_by',
            'user_id'
        );
    }

    public function documents()
    {
        return $this->hasMany(
            Document::class,
            'subject_code',
            'subject_code'
        );
    }

   public function lecturers()
{
    return $this->belongsToMany(
        User::class,
        'subject_teachers',
        'subject_code',
        'user_id',
        'subject_code',
        'user_id'
    )
    ->withPivot('assigned_at')
    ->withTimestamps();
}
    public function subjectTeachers()
    {
        return $this->hasMany(
            SubjectTeacher::class,
            'subject_code',
            'subject_code'
        );
    }

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
    public function getThumbnailUrlAttribute()
{
    // Không có ảnh
    if (empty($this->thumbnail)) {
        return asset('img/subjects/01.jpg');
    }

    // Nếu là ảnh upload trong storage
    if (Storage::disk('public')->exists('subjects/' . $this->thumbnail)) {
        return asset('storage/subjects/' . $this->thumbnail);
    }

    // Nếu là ảnh mặc định trong public/img/subjects
    return asset('img/subjects/' . $this->thumbnail);
}
public function followers()
{
    return $this->hasMany(SubjectFollow::class, 'subject_code', 'subject_code');
}
}