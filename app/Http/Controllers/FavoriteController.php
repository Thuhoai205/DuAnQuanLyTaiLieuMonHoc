<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Danh sách yêu thích
     */
    public function index()
    {
        $favorites = Favorite::with([
            'document.subject',
            'document.documentType',
            'document.currentVersion'
        ])
        ->where('user_id', Auth::id())
        ->latest()
        ->paginate(10);

        $totalFavorites = Favorite::where('user_id', Auth::id())->count();

$totalSubjects = Favorite::where('user_id', Auth::id())
    ->join('documents', 'favorites.document_id', '=', 'documents.document_id')
    ->distinct('documents.subject_code')
    ->count('documents.subject_code');

$totalDownloads = Favorite::where('user_id', Auth::id())
    ->join('documents', 'favorites.document_id', '=', 'documents.document_id')
    ->sum('documents.download_count');

return view('favorites.index', compact(
    'favorites',
    'totalFavorites',
    'totalSubjects',
    'totalDownloads'
));
    }

    /**
     * Thêm / bỏ yêu thích
     */
    public function toggle(Document $document)
{
    $favorite = Favorite::where('user_id', Auth::id())
        ->where('document_id', $document->document_id)
        ->first();

    if ($favorite) {

        $favorite->delete();

        return response()->json([
            'success' => true,
            'favorite' => false,
        ]);

    }

    Favorite::create([
        'user_id' => Auth::id(),
        'document_id' => $document->document_id,
    ]);

    return response()->json([
        'success' => true,
        'favorite' => true,
    ]);
}
}