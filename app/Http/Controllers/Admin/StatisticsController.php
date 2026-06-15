<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\DownloadHistory;
use App\Models\User;

class StatisticsController extends Controller
{
    public function index()
    {
        // Tổng số tài liệu
        $totalDocuments = Document::count();

        // Tổng lượt tải
        $totalDownloads = DownloadHistory::count();

        // Tổng loại tài liệu
        $totalTypes = DocumentType::count();

        // Tổng người dùng
        $totalUsers = User::count();

        // Top 5 tài liệu có lượt tải nhiều nhất
        $topDownloads = Document::query()
            ->select('document_id', 'title', 'download_count')
            ->orderByDesc('download_count')
            ->take(5)
            ->get();

        // Top 5 loại tài liệu có nhiều tài liệu nhất
        $documentsByType = DocumentType::query()
            ->withCount('documents')
            ->orderByDesc('documents_count')
            ->take(5)
            ->get();

        // 4 lượt tải gần đây
        $recentDownloads = DownloadHistory::query()
            ->with([
                'user',
                'version.document',
            ])
            ->whereNotNull('downloaded_at')
            ->orderByDesc('downloaded_at')
            ->take(4)
            ->get();

        // Thống kê lượt tải theo tháng trong năm hiện tại
        $downloadsByMonth = DownloadHistory::query()
            ->selectRaw('MONTH(downloaded_at) as month, COUNT(*) as total')
            ->whereNotNull('downloaded_at')
            ->whereYear('downloaded_at', now()->year)
            ->groupByRaw('MONTH(downloaded_at)')
            ->pluck('total', 'month');

        // Chuẩn hóa dữ liệu 12 tháng
        $chartData = collect(range(1, 12))->map(function ($month) use ($downloadsByMonth) {
            return [
                'month' => $month,
                'total' => (int) ($downloadsByMonth->get($month, 0)),
            ];
        });

        return view('admin.statistics.index', compact(
            'totalDocuments',
            'totalDownloads',
            'totalTypes',
            'totalUsers',
            'topDownloads',
            'documentsByType',
            'recentDownloads',
            'chartData'
        ));
    }
}