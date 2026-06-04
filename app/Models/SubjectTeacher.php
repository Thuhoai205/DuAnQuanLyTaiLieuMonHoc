<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    protected $table = 'subject_teachers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'subject_code',
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