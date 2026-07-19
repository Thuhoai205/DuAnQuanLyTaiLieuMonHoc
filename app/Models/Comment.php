<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'comments';

    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'document_id',
        'user_id',
        'parent_id',
        'content',
        'is_active',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function document()
    {
        return $this->belongsTo(
            Document::class,
            'document_id',
            'document_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'user_id'
        );
    }

    /**
     * Bình luận cha
     */
    public function parent()
    {
        return $this->belongsTo(
            Comment::class,
            'parent_id',
            'comment_id'
        );
    }

    /**
     * Các phản hồi của bình luận
     */
    public function replies()
    {
        return $this->hasMany(
            Comment::class,
            'parent_id',
            'comment_id'
        )
        ->where('is_active', true)
        ->with('user')
        ->latest();
    }
}