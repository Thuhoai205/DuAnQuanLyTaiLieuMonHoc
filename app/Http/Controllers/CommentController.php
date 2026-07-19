<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
class CommentController extends Controller
{
    /**
     * Lưu bình luận mới.
     */
    public function store(Request $request, Document $document)
{
    $request->validate([
        'content' => ['required', 'string', 'max:1000'],
    ], [
        'content.required' => 'Vui lòng nhập nội dung bình luận.',
        'content.max'      => 'Bình luận không được vượt quá 1000 ký tự.',
    ]);

    // Lưu bình luận
    Comment::create([
        'document_id' => $document->document_id,
        'user_id'     => Auth::id(),
        'content'     => $request->content,
        'is_active'   => true,
    ]);

    // ==============================
    // Thông báo cho giảng viên upload tài liệu
    // ==============================
    if ($document->uploaded_by != Auth::id()) {

        Notification::create([
            'user_id'      => $document->uploaded_by,
            'title'        => 'Bình luận mới',
            'content'      => Auth::user()->full_name . ' đã bình luận về tài liệu "' . $document->title . '".',
            'type'         => 'comment',
            'related_type' => 'document',
            'related_id'   => $document->document_id,
        ]);
    }

    
    return back()->with('success', 'Bình luận đã được gửi.');
}
    /**
     * Xóa bình luận.
     */
    public function destroy(Comment $comment)
{
    $user = Auth::user();

    // Admin được xóa tất cả
    if ($user->role->role_name === 'admin') {

        $comment->delete();

        return back()->with('success', 'Đã xóa bình luận.');
    }

    // Giảng viên upload tài liệu được xóa mọi bình luận trên tài liệu của mình
    if (
        $user->role->role_name === 'lecturer' &&
        $comment->document->uploaded_by == $user->user_id
    ) {

        $comment->delete();

        return back()->with('success', 'Đã xóa bình luận.');
    }

    // Người tạo bình luận được xóa bình luận của mình
    if ($comment->user_id == $user->user_id) {

        $comment->delete();

        return back()->with('success', 'Đã xóa bình luận.');
    }

    abort(403);
}
   public function reply(Request $request, Comment $comment)
{
    $request->validate([
        'content' => ['required', 'string', 'max:1000'],
    ]);

    $document = $comment->document;
    $user = Auth::user();

    // Admin được trả lời tất cả
    if ($user->role->role_name !== 'admin') {

        // Chỉ giảng viên upload tài liệu mới được trả lời
        if (
            $user->role->role_name !== 'lecturer' ||
            $document->uploaded_by != $user->user_id
        ) {
            abort(403);
        }
    }

    // Lưu phản hồi
    Comment::create([
        'document_id' => $document->document_id,
        'user_id'     => $user->user_id,
        'parent_id'   => $comment->comment_id,
        'content'     => $request->content,
        'is_active'   => true,
    ]);

    // ==================================================
    // THÔNG BÁO
    // ==================================================

    // 1. Thông báo cho người đã bình luận
    if ($comment->user_id != $user->user_id) {

        Notification::create([
            'user_id'      => $comment->user_id,
            'title'        => 'Có phản hồi mới',
            'content'      => $user->full_name . ' đã trả lời bình luận của bạn về tài liệu "' . $document->title . '".',
            'type'         => 'reply',
            'related_type' => 'document',
            'related_id'   => $document->document_id,
        ]);
    }

  
    // 3. Nếu ADMIN trả lời -> thông báo cho giảng viên upload tài liệu
    if (
        $user->role->role_name == 'admin' &&
        $document->uploaded_by != $user->user_id &&
        $document->uploaded_by != $comment->user_id
    ) {

        Notification::create([
            'user_id'      => $document->uploaded_by,
            'title'        => 'Có phản hồi mới',
            'content'      => 'Quản trị viên đã phản hồi một bình luận về tài liệu "' . $document->title . '".',
            'type'         => 'reply',
            'related_type' => 'document',
            'related_id'   => $document->document_id,
        ]);
    }

    return back()->with('success', 'Đã trả lời bình luận.');
}

}