<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Document;

public function dashboard()
{
    $myDocuments = Document::with('subject')
        ->where('uploaded_by', Auth::id())
        ->latest()
        ->take(5)
        ->get();

    $totalDownloads = Document::where('uploaded_by', Auth::id())
        ->sum('download_count');

    $totalSubjects = Document::where('uploaded_by', Auth::id())
        ->distinct('subject_code')
        ->count('subject_code');

    $featuredDocument = Document::where('uploaded_by', Auth::id())
        ->orderByDesc('download_count')
        ->first();

    return view('lecturer.dashboard', compact(
        'myDocuments',
        'totalDownloads',
        'totalSubjects',
        'featuredDocument'
    ));
}