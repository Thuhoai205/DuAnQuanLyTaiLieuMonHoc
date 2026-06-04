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
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Một loại tài liệu có nhiều tài liệu
     */
    public function documents()
    {
        return $this->hasMany(
            Document::class,
            'document_type_id',
            'document_type_id'
        );
    }

    /**
     * Lịch sử tìm kiếm theo loại tài liệu
     */
    public function searchHistories()
    {
        return $this->hasMany(
            SearchHistory::class,
            'document_type_id',
            'document_type_id'
        );
    }
}