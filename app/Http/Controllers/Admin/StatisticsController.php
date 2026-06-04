<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaiLieu;
use App\Models\LichSuTai;
use App\Models\LoaiTaiLieu;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        $totalDocuments = TaiLieu::count();

        $totalDownloads = LichSuTai::count();

        $totalTypes = LoaiTaiLieu::count();

        $totalUsers = User::count();

        $topDownloads = TaiLieu::withCount('lichSuTais')
            ->orderByDesc('lich_su_tais_count')
            ->take(5)
            ->get();

        $documentsByType = LoaiTaiLieu::withCount('taiLieus')
            ->orderByDesc('tai_lieus_count')
            ->take(5)
            ->get();

        $chartData = LichSuTai::select(
                DB::raw('MONTH(ngay_tai) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('ngay_tai', now()->year)
            ->groupBy(DB::raw('MONTH(ngay_tai)'))
            ->orderBy(DB::raw('MONTH(ngay_tai)'))
            ->get();

        $recentDownloads = LichSuTai::with(['user', 'taiLieu'])
            ->orderByDesc('ngay_tai')
            ->take(5)
            ->get();

        return view('admin.statistics.index', compact(
            'totalDocuments',
            'totalDownloads',
            'totalTypes',
            'totalUsers',
            'topDownloads',
            'documentsByType',
            'chartData',
            'recentDownloads'
        ));
    }
}