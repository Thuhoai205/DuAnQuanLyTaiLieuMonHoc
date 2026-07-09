<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Faculty;
use App\Models\DocumentType;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Danh sách môn học
     */
    public function index()
    {
        $query = Subject::with([
                'faculty',
                'lecturers'
            ])
            ->withCount('documents')
            ->where('status', 'active');

        // Nếu đã đăng nhập thì phân quyền theo vai trò
        if (Auth::check()) {

            $user = Auth::user();

            // Giảng viên chỉ xem môn được phân công
          // Giảng viên
if ($user->role->role_name === 'lecturer') {

    $query->where('faculty_id', $user->faculty_id);

}

            // Sinh viên chỉ xem môn thuộc khoa
            elseif ($user->role->role_name === 'student') {

                $query->where(
                    'faculty_id',
                    $user->faculty_id
                );

            }

            // Admin: không cần lọc
        }

        $subjects = $query
            ->orderBy('subject_name')
            ->paginate(8);

        $faculties = Faculty::where('is_active', true)
            ->orderBy('faculty_name')
            ->get();

        return view('subjects.index', compact(
            'subjects',
            'faculties'
        ));
    }

    /**
     * Chi tiết môn học
     */
    public function show($subjectCode)
    {
        $subject = Subject::with([
                'faculty',
                'lecturers',
            ])
            ->withCount([
                'documents',
                'lecturers',
            ])
            ->where('subject_code', $subjectCode)
            ->where('status', 'active')
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Phân quyền xem môn học
        |--------------------------------------------------------------------------
        */

        if (Auth::check()) {

            $user = Auth::user();

            // Sinh viên
            if ($user->role->role_name === 'student') {

                if ($subject->faculty_id != $user->faculty_id) {

                    abort(403);

                }

            }

            // Giảng viên
         elseif ($user->role->role_name === 'lecturer') {

    if ($subject->faculty_id != $user->faculty_id) {

        abort(403);

    }



}
            // Admin luôn được xem
        }

        /*
        |--------------------------------------------------------------------------
        | Danh sách tài liệu
        |--------------------------------------------------------------------------
        */

        $documents = $subject->documents()
            ->with([
                'currentVersion',
                'documentType',
                'uploader',
            ])
            ->where('is_active', true)
            ->latest()
            ->paginate(10);

        $documentTypes = DocumentType::where('is_active', true)
            ->orderBy('type_name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Quyền upload
        |--------------------------------------------------------------------------
        */

        $canUploadDocument = false;

        if (Auth::check()) {

            $user = Auth::user();

            if ($user->role->role_name === 'admin') {

                $canUploadDocument = true;

            }

            elseif ($user->role->role_name === 'lecturer') {

                $canUploadDocument = $subject->lecturers()
                    ->where('users.user_id', $user->user_id)
                    ->exists();

            }

        }

        return view('subjects.show', compact(
            'subject',
            'documents',
            'documentTypes',
            'canUploadDocument'
        ));
    }
}