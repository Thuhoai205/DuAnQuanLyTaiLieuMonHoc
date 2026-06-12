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

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;   

            $query->where(function ($q) use ($keyword) {
                $q->where('description', 'like', '%' . $keyword . '%')
                    ->orWhere('action', 'like', '%' . $keyword . '%')
                    ->orWhere('ip_address', 'like', '%' . $keyword . '%')
                    ->orWhere('user_agent', 'like', '%' . $keyword . '%')
                    ->orWhereHas('user', function ($userQuery) use ($keyword) {
                        $userQuery->where('full_name', 'like', '%' . $keyword . '%')
                            ->orWhere('username', 'like', '%' . $keyword . '%')
                            ->orWhere('email', 'like', '%' . $keyword . '%');
                    });
            });
        }

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        $logs = $query
            ->paginate(10)
            ->withQueryString();

        $totalLogs = ActivityLog::count();

        $totalLoginLogs = ActivityLog::where('action', 'login')->count();

        $totalLogoutLogs = ActivityLog::where('action', 'logout')->count();

        $unreadLogsCount = ActivityLog::where('is_read', false)->count();

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
        ActivityLog::where('is_read', false)->update([
            'is_read' => true,
        ]);

        return back()->with('success', 'Đã đánh dấu tất cả thông báo là đã đọc.');
    }

    public static function writeLog(string $action, string $description): void
    {
        ActivityLog::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'action' => $action,
            'description' => $description,
            'is_read' => false,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'login_at' => $action === 'login' ? now() : null,
            'logout_at' => $action === 'logout' ? now() : null,
        ]);
    }
}