<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    protected $table = 'search_histories';

    protected $primaryKey = 'search_id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'keyword',
        'subject_code',
        'document_type_id',
        'result_count',
        'ip_address',
        'searched_at',
    ];

    protected $casts = [
        'result_count' => 'integer',
        'searched_at' => 'datetime',
    ];

    /**
     * Người thực hiện tìm kiếm
     */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'user_id'
        );
    }

    /**
     * Môn học được tìm kiếm
     */
    public function subject()
    {
        return $this->belongsTo(
            Subject::class,
            'subject_code',
            'subject_code'
        );
    }

    /**
     * Loại tài liệu được tìm kiếm
     */
    public function documentType()
    {
        return $this->belongsTo(
            DocumentType::class,
            'document_type_id',
            'document_type_id'
        );
    }
}