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
        'is_active',
        'remember_token',
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

    public function role()
    {
        return $this->belongsTo(
            Role::class,
            'role_id',
            'role_id'
        );
    }

    /**
     * Các môn học mà giảng viên được phân công
     */
    public function subjects()
    {
        return $this->belongsToMany(
            Subject::class,
            'subject_teachers',
            'user_id',
            'subject_code',
            'user_id',
            'subject_code'
        )->withTimestamps();
    }

    /**
     * Danh sách phân công giảng viên - môn học
     */
    public function subjectTeachers()
    {
        return $this->hasMany(
            SubjectTeacher::class,
            'user_id',
            'user_id'
        );
    }

    /**
     * Tài liệu do người dùng upload
     */
    public function documents()
    {
        return $this->hasMany(
            Document::class,
            'uploaded_by',
            'user_id'
        );
    }

    /**
     * Lịch sử tải tài liệu
     */
    public function downloadHistories()
    {
        return $this->hasMany(
            DownloadHistory::class,
            'user_id',
            'user_id'
        );
    }

    /**
     * Nhật ký hoạt động
     */
    public function activityLogs()
    {
        return $this->hasMany(
            ActivityLog::class,
            'user_id',
            'user_id'
        );
    }

    /**
     * Lịch sử duyệt tài liệu
     */
    public function documentApprovals()
    {
        return $this->hasMany(
            DocumentApproval::class,
            'approved_by',
            'user_id'
        );
    }

    /**
     * Danh sách tài liệu yêu thích
     */
    public function favorites()
    {
        return $this->hasMany(
            Favorite::class,
            'user_id',
            'user_id'
        );
    }

    /**
     * Tài liệu yêu thích của người dùng
     */
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

    /**
     * Thông báo của người dùng
     */
    public function userNotifications()
    {
        return $this->hasMany(
            Notification::class,
            'user_id',
            'user_id'
        );
    }

    /**
     * Lịch sử tìm kiếm
     */
    public function searchHistories()
    {
        return $this->hasMany(
            SearchHistory::class,
            'user_id',
            'user_id'
        );
    }
}