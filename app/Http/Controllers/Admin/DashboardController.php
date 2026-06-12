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
        $documentsByMonth = Document::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

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

        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalSubjects' => Subject::count(),
            'totalDocuments' => Document::count(),
            'totalDownloads' => DownloadHistory::count(),

            'recentActivities' => ActivityLog::with('user')
                ->latest('created_at')
                ->take(5)
                ->get(),

            'chartLabels' => $chartLabels,
            'documentChartData' => $documentChartData,
            'userChartData' => $userChartData,
        ]);
    }
}