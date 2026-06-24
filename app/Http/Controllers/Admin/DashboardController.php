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

        $currentYear = now()->year;

        // Người dùng mới theo tháng
        $usersByMonth = User::query()
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereNotNull('created_at')
            ->whereYear('created_at', $currentYear)
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'month');

        // Môn học mới theo tháng
        $subjectsByMonth = Subject::query()
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereNotNull('created_at')
            ->whereYear('created_at', $currentYear)
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'month');

        // Loại tài liệu mới theo tháng
        $documentTypesByMonth = DocumentType::query()
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereNotNull('created_at')
            ->whereYear('created_at', $currentYear)
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total', 'month');

        $latestDocuments = Document::with([
        'subject',
        'uploader'
    ])
    ->latest()
    ->take(5)
    ->get();
        $chartLabels = [];
        $userChartData = [];
        $subjectChartData = [];
        $documentTypeChartData = [];

        for ($i = 1; $i <= 12; $i++) {
            $chartLabels[] = 'T' . $i;
            $userChartData[] = (int) ($usersByMonth[$i] ?? 0);
            $subjectChartData[] = (int) ($subjectsByMonth[$i] ?? 0);
            $documentTypeChartData[] = (int) ($documentTypesByMonth[$i] ?? 0);
        }

        $recentActivities = ActivityLog::with('user')
            ->latest('created_at')
            ->take(6)
            ->get();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalSubjects' => $totalSubjects,
            'totalDocumentTypes' => $totalDocumentTypes,

            'totalLogs' => ActivityLog::count(),
            'totalLoginLogs' => ActivityLog::whereNotNull('login_at')->count(),
            'totalLogoutLogs' => ActivityLog::whereNotNull('logout_at')->count(),
            'todayLogs' => ActivityLog::whereDate('created_at', today())->count(),

            'recentActivities' => $recentActivities,
'latestDocuments' => $latestDocuments,
            'chartLabels' => $chartLabels,
            'userChartData' => $userChartData,
            'subjectChartData' => $subjectChartData,
            'documentTypeChartData' => $documentTypeChartData,
            'totalDocuments' => Document::count(),

'totalDownloads' => DownloadHistory::count(),

'topDocuments' => Document::with('subject')
    ->orderByDesc('download_count')
    ->take(5)
    ->get(),
        ]);
    }
}