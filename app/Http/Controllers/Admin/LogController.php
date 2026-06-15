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
            ->orderByDesc('created_at');

        // Tìm kiếm nhật ký
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('description', 'like', '%' . $keyword . '%')
                    ->orWhere('ip_address', 'like', '%' . $keyword . '%')
                    ->orWhere('user_agent', 'like', '%' . $keyword . '%')
                    ->orWhereHas('user', function ($userQuery) use ($keyword) {
                        $userQuery->where('full_name', 'like', '%' . $keyword . '%')
                            ->orWhere('username', 'like', '%' . $keyword . '%')
                            ->orWhere('email', 'like', '%' . $keyword . '%');
                    });
            });
        }

        // Lọc theo loại: login / logout
        if ($request->filled('action')) {
            if ($request->action === 'login') {
                $query->whereNotNull('login_at');
            }

            if ($request->action === 'logout') {
                $query->whereNotNull('logout_at');
            }
        }

        $logs = $query
            ->paginate(10)
            ->withQueryString();

        // Thống kê nhật ký
        $totalLogs = ActivityLog::count();

        $totalLoginLogs = ActivityLog::whereNotNull('login_at')->count();

        $totalLogoutLogs = ActivityLog::whereNotNull('logout_at')->count();

        // Bảng activity_logs hiện tại không có cột is_read
        $unreadLogsCount = 0;

        return view('admin.logs.index', compact(
            'logs',
            'totalLogs',
            'totalLoginLogs',
            'totalLogoutLogs',
            'unreadLogsCount'
        ));
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