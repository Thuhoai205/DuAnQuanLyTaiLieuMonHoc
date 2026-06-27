<?php

namespace App\Http\Controllers;
use App\Models\Document;
use App\Models\Subject;
use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController  extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Danh sách khoa
    |--------------------------------------------------------------------------
    */
    public function index()
{
    $faculties = Faculty::withCount('subjects')
        ->with([
            'subjects' => function ($query) {
                $query->where('status', 'active')
                    ->withCount('documents')
                    ->orderBy('subject_name');
            }
        ])
        ->where('is_active', true)
        ->orderBy('faculty_name')
        ->get();

    $totalFaculties = Faculty::where('is_active', true)->count();

    $totalSubjects = Subject::where('status', 'active')->count();

    $totalDocuments = Document::where('is_active', true)->count();

    return view('faculties.index', compact(
        'faculties',
        'totalFaculties',
        'totalSubjects',
        'totalDocuments'
    ));
}

    /*
    |--------------------------------------------------------------------------
    | Chi tiết khoa
    |--------------------------------------------------------------------------
    */
 public function show($id)
{
    $faculty = Faculty::with([
        'subjects' => function ($query) {
            $query->where('status', 'active')
                ->withCount('documents')
                ->with('lecturers')
                ->orderBy('subject_name');
        },

        'subjects.documents' => function ($query) {
            $query->where('is_active', true)
                ->with([
                    'currentVersion',
                    'documentType',
                    'uploader'
                ])
                ->latest();
        }
    ])
    ->withCount([
        'subjects',
        'documents'
    ])
    ->find($id);   // <-- phải là find()

    return view('faculties.show', compact('faculty'));
}
}