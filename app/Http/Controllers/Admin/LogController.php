<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LogController extends Controller
{
    /**
     * Trang danh sách nhật ký hoạt động hệ thống
     */
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')
            ->orderByDesc('created_at');

        // Tìm kiếm theo nội dung, hành động, đối tượng
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('description', 'like', '%' . $keyword . '%')
                    ->orWhere('action', 'like', '%' . $keyword . '%')
                    ->orWhere('object_type', 'like', '%' . $keyword . '%')
                    ->orWhere('ip_address', 'like', '%' . $keyword . '%');
            });
        }

        // Lọc theo hành động
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        $logs = $query
            ->paginate(10)
            ->appends($request->query());

        return view('admin.logs.index', compact('logs'));
    }

    /**
     * Hàm ghi nhật ký dùng lại trong các controller khác
     */
    public static function writeLog(
        string $action,
        ?string $objectType,
        ?int $objectId,
        string $description
    ): void {
        ActivityLog::create([
            'user_id'     => Auth::check() ? Auth::user()->user_id : null,
            'action'      => $action,
            'object_type' => $objectType,
            'object_id'   => $objectId,
            'description' => $description,
            'ip_address'  => request()->ip(),
            'user_agent'  => request()->userAgent(),
        ]);
    }
}