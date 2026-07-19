<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectFollow extends Model
{
    protected $table = 'subject_follows';

    protected $primaryKey = 'follow_id';

    protected $fillable = [
        'user_id',
        'subject_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_code', 'subject_code');
    }
}