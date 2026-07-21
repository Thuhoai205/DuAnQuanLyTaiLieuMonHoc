<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\DownloadHistory;
use App\Models\SearchHistory;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
class StatisticsController extends Controller
{
    public function index()
    {
        // Tổng số tài liệu
        $totalDocuments = Document::count();

        // Tổng lượt tải
        $totalDownloads = DownloadHistory::count();


        // Tổng người dùng
        $totalUsers = User::count();

        // Top 5 tài liệu có lượt tải nhiều nhất
        $topDownloads = Document::query()
            ->select('document_id', 'title', 'download_count')
            ->orderByDesc('download_count')
            ->take(5)
            ->get();
           $topTeachers = User::query()
    ->withCount('documents')
    ->whereHas('role', function ($q) {
        $q->where('role_name', 'Giảng viên');
    })
    ->orderByDesc('documents_count')
    ->take(5)
    ->get();
$totalComments = Comment::count();

$activeComments = Comment::where('is_active', 1)->count();

$hiddenComments = Comment::where('is_active', 0)->count();

$replyComments = Comment::whereNotNull('parent_id')->count();
$topSubjects = DB::table('download_histories')
    ->join('document_versions', 'download_histories.version_id', '=', 'document_versions.version_id')
    ->join('documents', 'document_versions.document_id', '=', 'documents.document_id')
    ->join('subjects', 'documents.subject_code', '=', 'subjects.subject_code')
    ->select(
        'subjects.subject_name',
        DB::raw('COUNT(download_histories.download_id) as total_downloads')
    )
    ->groupBy('subjects.subject_code', 'subjects.subject_name')
    ->orderByDesc('total_downloads')
    ->take(5)
    ->get();
$topKeywords = SearchHistory::query()
    ->select('keyword')
    ->selectRaw('COUNT(*) as total')
    ->groupBy('keyword')
    ->orderByDesc('total')
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
            'totalUsers',
            'topKeywords',
            'topDownloads',
            'topTeachers',
            'topSubjects',
            'documentsByType',
            'recentDownloads',
            'chartData',
            'totalComments',
            'activeComments',
            'hiddenComments',
            'replyComments'
        ));
    }
}