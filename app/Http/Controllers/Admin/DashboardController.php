<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\DocumentType;
use App\Models\Subject;
use App\Models\User;
use App\Models\Document;
use App\Models\DownloadHistory;
class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalSubjects = Subject::count();
        $totalDocumentTypes = DocumentType::count();

      

        $latestDocuments = Document::with([
        'subject',
        'uploader'
    ])
    ->latest()
    ->take(5)
    ->get();
       

        $recentActivities = ActivityLog::with('user')
            ->latest('created_at')
            ->take(6)
            ->get();
            /*
|--------------------------------------------------------------------------
| Top giảng viên đăng nhiều tài liệu
|--------------------------------------------------------------------------
*/

$topLecturers = User::whereHas('role', function ($q) {
        $q->where('role_name', 'lecturer');
    })
    ->withCount([
        'documents' => function ($q) {
            $q->where('is_active', true);
        }
    ])
    ->orderByDesc('documents_count')
    ->take(3)
    ->get();

/*
|--------------------------------------------------------------------------
| Top môn học nhiều tài liệu
|--------------------------------------------------------------------------
*/

$topSubjects = Subject::withCount([
        'documents' => function ($q) {
            $q->where('is_active', true);
        }
    ])
    ->orderByDesc('documents_count')
    ->take(3)
    ->get();
    $totalLogin = ActivityLog::whereNotNull('login_at')->count();

$todayLogin = ActivityLog::whereDate(
    'login_at',
    today()
)->count();

$weekLogin = ActivityLog::whereBetween(
    'login_at',
    [
        now()->startOfWeek(),
        now()->endOfWeek(),
    ]
)->count();

$monthLogin = ActivityLog::whereMonth(
    'login_at',
    now()->month
)->whereYear(
    'login_at',
    now()->year
)->count();

       return view('admin.dashboard', [

    'totalUsers' => $totalUsers,
    'totalSubjects' => $totalSubjects,
    'totalDocumentTypes' => $totalDocumentTypes,
    'totalDocuments' => Document::count(),
    'totalDownloads' => DownloadHistory::count(),

    'totalLogs' => ActivityLog::count(),
    'totalLoginLogs' => ActivityLog::whereNotNull('login_at')->count(),
    'totalLogoutLogs' => ActivityLog::whereNotNull('logout_at')->count(),
    'todayLogs' => ActivityLog::whereDate('created_at', today())->count(),

    'latestDocuments' => $latestDocuments,
    'recentActivities' => $recentActivities,

    'topDocuments' => Document::with('subject')
        ->orderByDesc('download_count')
        ->take(5)
        ->get(),

    'topLecturers' => $topLecturers,
    'topSubjects' => $topSubjects,
    'totalLogin' => $totalLogin,
'todayLogin' => $todayLogin,
'weekLogin' => $weekLogin,
'monthLogin' => $monthLogin,

]);
    }
}