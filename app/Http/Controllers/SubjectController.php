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
    $subjects = Subject::with([
            'faculty',
            'lecturers'
        ])
        ->withCount('documents')
        ->where('status', 'active')
        ->orderBy('subject_name')
        ->paginate(8); // Hiển thị 8 môn học mỗi trang

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

    // Phân trang tài liệu
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

    $canUploadDocument = false;

    $canUploadDocument = false;

if (Auth::check()) {

    $user = Auth::user();

    if ($user->role->role_name === 'admin') {

        $canUploadDocument = true;

    } elseif ($user->role->role_name === 'lecturer') {

        // Không dùng belongsToMany()
        $canUploadDocument = \App\Models\SubjectTeacher::where(
                'user_id',
                $user->user_id
            )
            ->where(
                'subject_code',
                $subject->subject_code
            )
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