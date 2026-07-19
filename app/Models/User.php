<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'username',
        'password',
        'full_name',
        'email',
        'avatar',
        'role_id',
        'faculty_id',
        'is_active',
        'remember_token',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'password' => 'hashed',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function faculty()
{
    return $this->belongsTo(
        Faculty::class,
        'faculty_id',
        'faculty_id'
    );
}
    public function subjects()
    {
        return $this->belongsToMany(
            Subject::class,
            'subject_teachers',
            'user_id',
            'subject_code',
            'user_id',
            'subject_code'
        )
        ->withPivot('assigned_at')
        ->withTimestamps();
    }

    public function subjectTeachers()
    {
        return $this->hasMany(SubjectTeacher::class, 'user_id', 'user_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'uploaded_by', 'user_id');
    }

    public function uploadedDocuments()
    {
        return $this->hasMany(Document::class, 'uploaded_by', 'user_id');
    }

    public function updatedDocuments()
    {
        return $this->hasMany(Document::class, 'updated_by', 'user_id');
    }

    public function documentVersions()
    {
        return $this->hasMany(DocumentVersion::class, 'uploaded_by', 'user_id');
    }

    public function downloadHistories()
    {
        return $this->hasMany(DownloadHistory::class, 'user_id', 'user_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id', 'user_id');
    }

    public function favoriteDocuments()
    {
        return $this->belongsToMany(
            Document::class,
            'favorites',
            'user_id',
            'document_id',
            'user_id',
            'document_id'
        );
    }
    public function comments()
{
    return $this->hasMany(
        Comment::class,
        'user_id',
        'user_id'
    );
}

    public function userNotifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'user_id');
    }

    public function searchHistories()
    {
        return $this->hasMany(SearchHistory::class, 'user_id', 'user_id');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class, 'user_id', 'user_id');
    }
    public function subjectFollows()
{
    return $this->hasMany(SubjectFollow::class, 'user_id', 'user_id');
}
}