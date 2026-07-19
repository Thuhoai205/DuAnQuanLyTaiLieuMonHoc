<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Danh sách thông báo
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('notifications.index', compact('notifications'));
    }

    /*
    |--------------------------------------------------------------------------
    | Đánh dấu một thông báo đã đọc
    |--------------------------------------------------------------------------
    */
   public function read($id)
{
    $notification = Notification::where('notification_id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    if (!$notification->is_read) {
        $notification->update([
            'is_read' => true,
        ]);
    }

    switch ($notification->related_type) {

        case 'document':
            return redirect()->route(
                'documents.show',
                $notification->related_id
            );

        case 'subject':
            // Thay bằng route xem môn học thực tế của bạn
            return redirect()->route(
                'lecturer.subjects.show',
                $notification->related_id
            );

        default:
            return redirect()->route('notifications.index');
    }
}

    /*
    |--------------------------------------------------------------------------
    | Đánh dấu tất cả đã đọc
    |--------------------------------------------------------------------------
    */
    public function readAll()
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update([
                'is_read' => true,
            ]);

        return redirect()->route('notifications.index');
    }

    /*
    |--------------------------------------------------------------------------
    | Xóa một thông báo (tùy chọn)
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $notification = Notification::where('notification_id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notification->delete();

        return back()->with('success', 'Đã xóa thông báo.');
    }
}