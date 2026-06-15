<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Faculty;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Subject::with(['faculty', 'lecturers'])
            ->withCount('documents');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('subject_code', 'like', "%{$search}%")
                    ->orWhere('subject_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('faculty_id')) {
            $query->where('faculty_id', $request->faculty_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $subjects = $query
            ->orderBy('subject_name', 'asc')
            ->paginate(6)
            ->withQueryString();

        $faculties = Faculty::where('is_active', true)
            ->orderBy('faculty_name')
            ->get();

        $totalSubjects = Subject::count();

        $totalTeachers = User::where('role_id', 2)
            ->where('is_active', true)
            ->count();

        $totalDocuments = Document::count();

        return view('admin.subjects.index', compact(
            'subjects',
            'faculties',
            'totalSubjects',
            'totalTeachers',
            'totalDocuments'
        ));
    }

    public function create()
    {
        $teachers = User::where('role_id', 2)
            ->where('is_active', true)
            ->orderBy('full_name')
            ->get();

        $faculties = Faculty::where('is_active', true)
            ->orderBy('faculty_name')
            ->get();

        return view('admin.subjects.create', compact('teachers', 'faculties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_code' => [
                'required',
                'string',
                'max:20',
                'unique:subjects,subject_code',
            ],
            'subject_name' => [
                'required',
                'string',
                'max:150',
            ],
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:30',
            'status' => 'required|string|in:active,inactive',
            'faculty_id' => 'required|exists:faculties,faculty_id',
            'teacher_ids' => 'nullable|array',
            'teacher_ids.*' => [
                'integer',
                Rule::exists('users', 'user_id')->where(function ($query) {
                    $query->where('role_id', 2)
                        ->where('is_active', true);
                }),
            ],
        ], [
            'subject_code.required' => 'Vui lòng nhập mã môn học.',
            'subject_code.unique' => 'Mã môn học đã tồn tại.',
            'subject_name.required' => 'Vui lòng nhập tên môn học.',
            'faculty_id.required' => 'Vui lòng chọn khoa.',
            'faculty_id.exists' => 'Khoa không hợp lệ.',
            'teacher_ids.*.exists' => 'Giảng viên được chọn không hợp lệ.',
        ]);

        $thumbnailPath = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('subjects', 'public');
        }

        $subjectCode = strtoupper($request->subject_code);

        $subject = Subject::create([
            'subject_code' => $subjectCode,
            'subject_name' => $request->subject_name,
            'slug' => $this->makeUniqueSlug($request->subject_name),
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'icon' => $request->icon ?: 'fa-solid fa-book-open',
            'color' => $request->color ?: 'blue',
            'status' => $request->status,
            'faculty_id' => $request->faculty_id,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        $this->syncLecturers($subject, $request->teacher_ids ?? []);

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Thêm môn học thành công.');
    }

    public function show(string $id)
    {
        $subject = Subject::with([
            'faculty',
            'lecturers',
            'documents.documentType',
            'documents.currentVersion',
            'creator',
            'updater',
        ])
            ->withCount('documents')
            ->findOrFail($id);

        return view('admin.subjects.show', compact('subject'));
    }

    public function edit(string $id)
    {
        $subject = Subject::with(['lecturers', 'faculty'])
            ->withCount('documents')
            ->findOrFail($id);

        $teachers = User::where('role_id', 2)
            ->where('is_active', true)
            ->orderBy('full_name')
            ->get();

        $faculties = Faculty::where('is_active', true)
            ->orderBy('faculty_name')
            ->get();

        return view('admin.subjects.edit', compact(
            'subject',
            'teachers',
            'faculties'
        ));
    }

    public function update(Request $request, string $id)
    {
        $subject = Subject::findOrFail($id);

        $request->validate([
            'subject_name' => [
                'required',
                'string',
                'max:150',
            ],
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:30',
            'status' => 'required|string|in:active,inactive',
            'faculty_id' => 'required|exists:faculties,faculty_id',
            'teacher_ids' => 'nullable|array',
            'teacher_ids.*' => [
                'integer',
                Rule::exists('users', 'user_id')->where(function ($query) {
                    $query->where('role_id', 2)
                        ->where('is_active', true);
                }),
            ],
        ], [
            'subject_name.required' => 'Vui lòng nhập tên môn học.',
            'faculty_id.required' => 'Vui lòng chọn khoa.',
            'faculty_id.exists' => 'Khoa không hợp lệ.',
            'teacher_ids.*.exists' => 'Giảng viên được chọn không hợp lệ.',
        ]);

        $thumbnailPath = $subject->thumbnail;

        if ($request->hasFile('thumbnail')) {
            if ($subject->thumbnail && Storage::disk('public')->exists($subject->thumbnail)) {
                Storage::disk('public')->delete($subject->thumbnail);
            }

            $thumbnailPath = $request->file('thumbnail')->store('subjects', 'public');
        }

        $subject->update([
            'subject_name' => $request->subject_name,
            'slug' => $this->makeUniqueSlug($request->subject_name, $subject->subject_code),
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'icon' => $request->icon ?: 'fa-solid fa-book-open',
            'color' => $request->color ?: $subject->color,
            'status' => $request->status,
            'faculty_id' => $request->faculty_id,
            'updated_by' => Auth::id(),
        ]);

        $this->syncLecturers($subject, $request->teacher_ids ?? []);

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Cập nhật môn học thành công.');
    }

    public function toggleStatus(string $id)
    {
        $subject = Subject::findOrFail($id);

        $newStatus = $subject->status === 'active' ? 'inactive' : 'active';

        $subject->update([
            'status' => $newStatus,
            'updated_by' => Auth::id(),
        ]);

        $message = $newStatus === 'active'
            ? 'Môn học đã được kích hoạt lại.'
            : 'Môn học đã được chuyển sang trạng thái ngừng hoạt động.';

        return back()->with('success', $message);
    }

    public function destroy(string $id)
    {
        $subject = Subject::findOrFail($id);

        // Không xóa cứng môn học, chỉ chuyển sang trạng thái ngừng hoạt động
        $subject->update([
            'status' => 'inactive',
            'updated_by' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Môn học đã được chuyển sang trạng thái ngừng hoạt động.');
    }

    private function makeUniqueSlug(string $subjectName, ?string $ignoreSubjectCode = null): string
    {
        $baseSlug = Str::slug($subjectName);
        $slug = $baseSlug;
        $counter = 2;

        while (
            Subject::where('slug', $slug)
                ->when($ignoreSubjectCode, function ($query) use ($ignoreSubjectCode) {
                    $query->where('subject_code', '!=', $ignoreSubjectCode);
                })
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function syncLecturers(Subject $subject, array $teacherIds): void
    {
        $syncData = collect($teacherIds)
            ->mapWithKeys(function ($teacherId) {
                return [
                    $teacherId => [
                        'assigned_at' => now(),
                        'created_by' => Auth::id(),
                        'updated_by' => Auth::id(),
                    ],
                ];
            })
            ->toArray();

        $subject->lecturers()->sync($syncData);
    }
}