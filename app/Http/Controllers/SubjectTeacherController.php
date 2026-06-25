<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectTeacher;
use App\Models\Subject;
use App\Models\Notification;

class SubjectTeacherController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Phân công giảng viên
    |--------------------------------------------------------------------------
    */
    public function assign(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'subject_code' => 'required|exists:subjects,subject_code',
        ]);

        $subject = Subject::where(
            'subject_code',
            $request->subject_code
        )->firstOrFail();

        // Đã phân công?
        $exists = SubjectTeacher::where('user_id', $request->user_id)
            ->where('subject_code', $request->subject_code)
            ->exists();

        if ($exists) {
            return back()->with(
                'error',
                'Giảng viên đã được phân công môn học này.'
            );
        }

        // Thêm phân công
        SubjectTeacher::create([
            'user_id' => $request->user_id,
            'subject_code' => $request->subject_code,
        ]);

        // Gửi thông báo
        Notification::create([
            'user_id' => $request->user_id,
            'title' => 'Phân công môn học',
            'content' => 'Bạn đã được phân công giảng dạy môn "' .
                $subject->subject_name . '".',
            'type' => 'assignment',
            'related_type' => 'subject',
            'related_id' => $subject->subject_code,
            'is_read' => false,
        ]);

        return back()->with(
            'success',
            'Phân công giảng viên thành công.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Hủy phân công
    |--------------------------------------------------------------------------
    */
    public function remove($id)
    {
        $assignment = SubjectTeacher::findOrFail($id);

        $teacherId = $assignment->user_id;

        $subject = Subject::where(
            'subject_code',
            $assignment->subject_code
        )->firstOrFail();

        // Xóa phân công
        $assignment->delete();

        // Gửi thông báo
        Notification::create([
            'user_id' => $teacherId,
            'title' => 'Hủy phân công môn học',
            'content' => 'Bạn không còn được phân công giảng dạy môn "' .
                $subject->subject_name . '".',
            'type' => 'assignment_removed',
            'related_type' => 'subject',
            'related_id' => $subject->subject_code,
            'is_read' => false,
        ]);

        return back()->with(
            'success',
            'Đã hủy phân công giảng viên.'
        );
    }
}