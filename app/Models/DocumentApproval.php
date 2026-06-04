<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentApproval extends Model
{
    protected $table = 'document_approvals';

    protected $primaryKey = 'approval_id';

    public $timestamps = false;

    protected $fillable = [
        'document_id',
        'approved_by',
        'status',
        'note',
        'approved_at',
        'created_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * Tài liệu được duyệt
     */
    public function document()
    {
        return $this->belongsTo(
            Document::class,
            'document_id',
            'document_id'
        );
    }

    /**
     * Người duyệt (Admin)
     */
    public function approver()
    {
        return $this->belongsTo(
            User::class,
            'approved_by',
            'user_id'
        );
    }
}