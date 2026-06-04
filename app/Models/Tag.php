<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $table = 'tags';

    protected $primaryKey = 'tag_id';

    protected $fillable = [
        'tag_name',
        'slug',
    ];

    /**
     * Một tag có nhiều tài liệu
     */
    public function documents()
    {
        return $this->belongsToMany(
            Document::class,
            'document_tags',
            'tag_id',
            'document_id'
        )->withPivot('created_at');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->tag_name);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('tag_name')) {
                $model->slug = Str::slug($model->tag_name);
            }
        });
    }
}