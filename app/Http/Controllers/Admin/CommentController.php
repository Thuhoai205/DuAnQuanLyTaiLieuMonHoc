<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::with(['user', 'document']);

        if ($request->filled('keyword')) {

            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {

                $q->where('content', 'like', "%{$keyword}%")

                    ->orWhereHas('user', function ($user) use ($keyword) {
                        $user->where('full_name', 'like', "%{$keyword}%");
                    })

                    ->orWhereHas('document', function ($doc) use ($keyword) {
                        $doc->where('title', 'like', "%{$keyword}%");
                    });

            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', (bool) $request->status);
        }

        $comments = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.comments.index', [
            'comments' => $comments,
            'totalComments' => Comment::count(),
            'activeComments' => Comment::where('is_active', true)->count(),
            'hiddenComments' => Comment::where('is_active', false)->count(),
        ]);
    }

    public function show($id)
    {
        $comment = Comment::with(['user', 'document', 'replies.user'])->findOrFail($id);

        return view('admin.comments.show', compact('comment'));
    }

    public function toggleStatus($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->is_active = !$comment->is_active;
        $comment->save();

        return response()->json([
            'success'   => true,
            'is_active' => $comment->is_active,
            'message'   => $comment->is_active ? 'Đã hiển thị bình luận.' : 'Đã ẩn bình luận.',
        ]);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa bình luận.',
        ]);
    }
}