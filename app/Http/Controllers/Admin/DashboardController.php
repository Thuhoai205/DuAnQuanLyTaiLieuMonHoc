<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subject;
use App\Models\Document;
use App\Models\DownloadHistory;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Thống kê tài liệu theo tháng trong năm hiện tại
        $documentsByMonth = Document::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        // Thống kê người dùng theo tháng trong năm hiện tại
        $usersByMonth = User::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        $chartLabels = [];
        $documentChartData = [];
        $userChartData = [];

        for ($i = 1; $i <= 12; $i++) {
            $chartLabels[] = 'T' . $i;
            $documentChartData[] = $documentsByMonth[$i] ?? 0;
            $userChartData[] = $usersByMonth[$i] ?? 0;
        }

        // Hoạt động gần đây
        $recentActivities = ActivityLog::with('user')
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalSubjects' => Subject::count(),
            'totalDocuments' => Document::count(),
            'totalDownloads' => DownloadHistory::count(),

            // Thống kê nhật ký đăng nhập / đăng xuất
            'totalLogs' => ActivityLog::count(),
            'totalLoginLogs' => ActivityLog::whereNotNull('login_at')->count(),
            'totalLogoutLogs' => ActivityLog::whereNotNull('logout_at')->count(),
            'todayLogs' => ActivityLog::whereDate('created_at', today())->count(),

            'recentActivities' => $recentActivities,

            'chartLabels' => $chartLabels,
            'documentChartData' => $documentChartData,
            'userChartData' => $userChartData,
        ]);
    }
}