<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Subject;
use App\Models\Document;

class HomeController extends Controller
{
   public function index()
    {
        // Danh sách môn học
        $subjects = Subject::withCount('documents')
            ->latest()
            ->take(4)
            ->get();

        // Tài liệu mới nhất
        $latestDocuments = Document::with('subject')
            ->latest()
            ->take(4)
            ->get();

        // Tài liệu tải nhiều
        $topDocuments = Document::with('subject')
            ->orderByDesc('download_count')
            ->take(4)
            ->get();

        // Thống kê
        $totalDocuments = Document::count();
        $totalSubjects = Subject::count();
        $totalFaculties = Faculty::count();

        return view('home', compact(
            'subjects',
            'latestDocuments',
            'topDocuments',
            'totalDocuments',
            'totalSubjects',
            'totalFaculties'
        ));
    }
}