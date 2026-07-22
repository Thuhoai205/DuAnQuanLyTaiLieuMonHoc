<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function index(Request $request)
{
    $query = ActivityLog::with('user')
        ->where(function ($q) {
            // Chỉ lấy log đăng nhập hoặc đăng xuất, bỏ hẳn log đăng ký
            $q->whereNotNull('login_at')
              ->orWhereNotNull('logout_at');
        })
        ->orderByDesc('created_at');

    // ======================
    // SEARCH
    // ======================
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;

        $query->where(function ($q) use ($keyword) {
            $q->where('description', 'like', "%{$keyword}%")
              ->orWhere('ip_address', 'like', "%{$keyword}%")
              ->orWhereHas('user', function ($u) use ($keyword) {
                  $u->where('full_name', 'like', "%{$keyword}%")
                    ->orWhere('username', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
              });
        });
    }

    // ======================
    // FILTER ACTION
    // ======================
    if ($request->filled('action')) {

        switch ($request->action) {

            case 'login':
                $query->whereNotNull('login_at');
                break;

            case 'logout':
                $query->whereNotNull('logout_at');
                break;
        }
    }

    // ======================
    // PAGINATION
    // ======================
    $logs = $query->paginate(10)->withQueryString();

    return view('admin.logs.index', [
        'logs' => $logs,
        'totalLogs' => ActivityLog::where(function ($q) {
            $q->whereNotNull('login_at')->orWhereNotNull('logout_at');
        })->count(),
        'totalLoginLogs' => ActivityLog::whereNotNull('login_at')->count(),
        'totalLogoutLogs' => ActivityLog::whereNotNull('logout_at')->count(),
        'unreadLogsCount' => 0,
    ]);
}
    public function markAllAsRead()
    {
        // Bảng activity_logs hiện tại không có cột is_read
        // Giữ hàm này để tránh lỗi route nếu view cũ còn gọi đến

        return back()->with('success', 'Nhật ký hiện tại không sử dụng trạng thái đã đọc.');
    }

    public static function writeLog(string $action, string $description): void
    {
        ActivityLog::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'login_at' => $action === 'login' ? now() : null,
            'logout_at' => $action === 'logout' ? now() : null,
            'created_at' => now(),
        ]);
    }
}