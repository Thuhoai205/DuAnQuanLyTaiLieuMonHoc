<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Subject;
use App\Models\Document;
use App\Models\DownloadHistory;
use App\Models\DocumentType;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Top 4 môn học có nhiều tài liệu nhất
        |--------------------------------------------------------------------------
        */
        $topSubjects = Subject::where('status', 'active')
            ->withCount([
                'documents' => function ($query) {
                    $query->where('is_active', true);
                }
            ])
            ->having('documents_count', '>', 0)
            ->orderByDesc('documents_count')
            ->take(4)
            ->get();

        if ($topSubjects->count() < 4) {

            $moreSubjects = Subject::where('status', 'active')
                ->whereNotIn(
                    'subject_code',
                    $topSubjects->pluck('subject_code')
                )
                ->withCount([
                    'documents' => function ($query) {
                        $query->where('is_active', true);
                    }
                ])
                ->take(4 - $topSubjects->count())
                ->get();

            $subjects = $topSubjects->merge($moreSubjects);

        } else {

            $subjects = $topSubjects;
        }

        /*
        |--------------------------------------------------------------------------
        | 4 tài liệu mới nhất
        |--------------------------------------------------------------------------
        */
        $latestDocuments = Document::with([
                'subject',
                'currentVersion'
            ])
            ->where('is_active', true)
            ->whereHas('subject', function ($query) {
                $query->where('status', 'active');
            })
            ->whereHas('currentVersion')
            ->latest()
            ->take(4)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Top 3 tài liệu tải nhiều
        |--------------------------------------------------------------------------
        */
        $topDocuments = Document::with([
                'subject',
                'currentVersion'
            ])
            ->where('is_active', true)
            ->whereHas('subject', function ($query) {
                $query->where('status', 'active');
            })
            ->whereHas('currentVersion')
            ->orderByDesc('download_count')
            ->take(3)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Thống kê toàn hệ thống
        |--------------------------------------------------------------------------
        */
        $totalDocuments = Document::where('is_active', true)->count();

        $totalDownloads = DownloadHistory::count();

        $totalSubjects = Subject::where('status', 'active')->count();

        $totalFaculties = Faculty::where('is_active', true)->count();

        /*
        |--------------------------------------------------------------------------
        | Dữ liệu mặc định
        |--------------------------------------------------------------------------
        */
        $myDocuments = collect();

        $topDocument = null;

        /*
        |--------------------------------------------------------------------------
        | Nếu đã đăng nhập (Giảng viên)
        |--------------------------------------------------------------------------
        */
        if (Auth::check()) {

            // 3 tài liệu mới nhất của giảng viên
            $myDocuments = Document::with([
                    'subject',
                    'currentVersion'
                ])
                ->where('uploaded_by', Auth::id())
                ->where('is_active', true)
                ->whereHas('subject', function ($query) {
                    $query->where('status', 'active');
                })
                ->latest()
                ->take(3)
                ->get();

            // Tài liệu nổi bật của giảng viên
            $topDocument = Document::with([
                    'subject',
                    'currentVersion'
                ])
                ->where('uploaded_by', Auth::id())
                ->where('is_active', true)
                ->orderByDesc('download_count')
                ->first();
        }

        /*
        |--------------------------------------------------------------------------
        | Dữ liệu bộ lọc
        |--------------------------------------------------------------------------
        */
        $documentTypes = DocumentType::where('is_active', true)
            ->orderBy('type_name')
            ->get();

        $faculties = Faculty::where('is_active', true)
            ->orderBy('faculty_name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */
        return view('home', compact(
            'subjects',
            'latestDocuments',
            'topDocuments',
            'myDocuments',
            'topDocument',
            'documentTypes',
            'faculties',
            'totalDocuments',
            'totalDownloads',
            'totalSubjects',
            'totalFaculties'
        ));
    }
}