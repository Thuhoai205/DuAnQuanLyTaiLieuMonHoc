<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubjectController extends Controller
{
    /**
     * Danh sách môn học
     */
    public function index(Request $request)
    {
        $query = Subject::with(['lecturers', 'documents']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('subject_code', 'like', "%{$search}%")
                    ->orWhere('subject_name', 'like', "%{$search}%");
            });
        }

        $subjects = $query->orderBy('subject_name', 'asc')
            ->paginate(10)
            ->withQueryString();

        $totalSubjects = Subject::count();
        $totalTeachers = User::where('role_id', 2)->count();
        $totalDocuments = Document::count();

        return view('admin.subjects.index', compact(
            'subjects',
            'totalSubjects',
            'totalTeachers',
            'totalDocuments'
        ));
    }

    /**
     * Form thêm môn học
     */
    public function create()
    {
        $teachers = User::where('role_id', 2)
            ->where('is_active', 1)
            ->orderBy('full_name')
            ->get();

        return view('admin.subjects.create', compact('teachers'));
    }

    /**
     * Lưu môn học mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_code' => 'required|string|max:20|unique:subjects,subject_code',
            'subject_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'teacher_ids' => 'nullable|array',
            'teacher_ids.*' => 'exists:users,user_id',
        ]);

        $subject = Subject::create([
            'subject_code' => strtoupper($request->subject_code),
            'subject_name' => $request->subject_name,
            'description' => $request->description,
            'slug' => Str::slug($request->subject_name),
            'color' => $request->color ?? 'blue',
            'total_documents' => 0,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => true,
        ]);

        if ($request->filled('teacher_ids')) {
            $subject->lecturers()->sync($request->teacher_ids);
        }

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Thêm môn học thành công');
    }

    /**
     * Chi tiết môn học
     */
    public function show(string $id)
    {
        $subject = Subject::with(['lecturers', 'documents'])
            ->findOrFail($id);

        return view('admin.subjects.show', compact('subject'));
    }

    /**
     * Form sửa môn học
     */
    public function edit(string $id)
    {
        $subject = Subject::with('lecturers')->findOrFail($id);

        $teachers = User::where('role_id', 2)
            ->where('is_active', 1)
            ->orderBy('full_name')
            ->get();

        return view('admin.subjects.edit', compact(
            'subject',
            'teachers'
        ));
    }

    /**
     * Cập nhật môn học
     */
    public function update(Request $request, string $id)
    {
        $subject = Subject::findOrFail($id);

        $request->validate([
            'subject_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'teacher_ids' => 'nullable|array',
            'teacher_ids.*' => 'exists:users,user_id',
        ]);

        $subject->update([
            'subject_name' => $request->subject_name,
            'description' => $request->description,
            'slug' => Str::slug($request->subject_name),
            'color' => $request->color ?? $subject->color,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        $subject->lecturers()->sync($request->teacher_ids ?? []);

        $redirectBack = $request->redirect_back;

        return redirect($redirectBack ?: route('admin.subjects.index'))
            ->with('success', 'Cập nhật môn học thành công');
    }

    /**
     * Xóa môn học
     */
    public function destroy(string $id)
    {
        $subject = Subject::withCount('documents')->findOrFail($id);

        if ($subject->documents_count > 0) {
            return back()->withErrors([
                'delete' => 'Không thể xóa môn học vì đang có tài liệu.'
            ]);
        }

        $subject->lecturers()->detach();

        $subject->delete();

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Xóa môn học thành công');
    }
}