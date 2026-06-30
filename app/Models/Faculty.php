<?php

namespace App\Models;
use App\Models\Subject;
use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use SoftDeletes;

    protected $table = 'faculties';

    protected $primaryKey = 'faculty_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'faculty_code',
        'faculty_name',
        'description',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function subjects()
    {
        return $this->hasMany(
            Subject::class,
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
    return $this->hasManyThrough(
        Document::class,
        Subject::class,
        'faculty_id',      // FK trong bảng subjects
        'subject_code',    // FK trong bảng documents
        'faculty_id',      // PK của faculties
        'subject_code'     // PK của subjects
    );
}
}