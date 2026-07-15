<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentType extends Model
{
    use SoftDeletes;

    protected $table = 'document_types';

    protected $primaryKey = 'document_type_id';

    protected $fillable = [
        'type_name',
        'description',
        'icon',
        'color',
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

    public function documents()
    {
        return $this->hasMany(
            Document::class,
            'document_type_id',
            'document_type_id'
        );
    }

    public function searchHistories()
    {
        return $this->hasMany(
            SearchHistory::class,
            'document_type_id',
            'document_type_id'
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
    public function favorites()
{
    return $this->hasMany(
        Favorite::class,
        'document_id',
        'document_id'
    );
}
}