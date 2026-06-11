<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectTeacher extends Model
{
    use SoftDeletes;

    protected $table = 'subject_teachers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'subject_code',
        'assigned_at',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Giảng viên được phân công
     */
    public function lecturer()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'user_id'
        );
    }

    /**
     * Môn học được phân công
     */
    public function subject()
    {
        return $this->belongsTo(
            Subject::class,
            'subject_code',
            'subject_code'
        );
    }
}