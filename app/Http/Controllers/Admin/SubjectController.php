<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Faculty;
use App\Models\Subject;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubjectController extends Controller
{
    /* =========================
     * INDEX
     * ========================= */
    public function index(Request $request)
    {
        $query = Subject::with(['faculty', 'lecturers'])
            ->withCount(['documents', 'lecturers']);

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

        $subjects = $query->orderBy('subject_name')
            ->paginate(6)
            ->withQueryString();

        return view('admin.subjects.index', [
            'subjects' => $subjects,
            'faculties' => Faculty::where('is_active', true)->orderBy('faculty_name')->get(),

            'totalSubjects' => Subject::count(),
            'totalTeachers' => User::where('role_id', 2)->where('is_active', true)->count(),
            'totalDocuments' => Document::count(),

            'totalTrashedSubjects' => Subject::onlyTrashed()->count(),
        ]);
    }

    /* =========================
     * CREATE
     * ========================= */
    public function create()
    {
        $subjectImages = [
            '01' => '01.jpg',
            '02' => '02.jpg',
            '03' => '03.jpg',
            '04' => '04.jpg',
            '05' => '05.jpg',
        ];

        return view('admin.subjects.create', [
            'faculties' => Faculty::where('is_active', true)->get(),
            'teachers' => User::where('role_id', 2)->where('is_active', true)->get(),
            'subjectImages' => $subjectImages,
        ]);
    }

    /* =========================
     * STORE
     * ========================= */
    public function store(Request $request)
    {
        $request->validate([
            'subject_code' => 'required|string|max:20|unique:subjects,subject_code',
            'subject_name' => 'required|string|max:150',
            'faculty_id' => 'required|exists:faculties,faculty_id',
            'thumbnail' => 'nullable|string',
            'teacher_ids' => 'nullable|array',
        ]);

        $subject = Subject::create([
            'subject_code' => strtoupper($request->subject_code),
            'subject_name' => $request->subject_name,
            'slug' => Str::slug($request->subject_name),
            'description' => $request->description,
            'thumbnail' => $request->thumbnail ?? '01.jpg',
            'icon' => $request->icon ?? 'fa-solid fa-book-open',
            'color' => $request->color ?? 'blue',
            'status' => $request->status ?? 'active',
            'faculty_id' => $request->faculty_id,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        // 🔔 sync + notification
        $this->syncLecturers($subject, $request->teacher_ids ?? []);

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Thêm môn học thành công.');
    }

    /* =========================
     * SHOW
     * ========================= */
   public function show(string $id)
{
    $subject = Subject::with([
    'faculty',
    'lecturers',
    'documents.documentType',
    'documents.currentVersion',
    'documents.uploader' 
])
->withCount(['documents', 'lecturers'])
->where('subject_code', $id)
->firstOrFail();

    return view('admin.subjects.show', compact('subject'));
}
    /* =========================
     * EDIT
     * ========================= */
    public function edit(string $id)
{
    $subjectImages = [
        '01' => '01.jpg',
        '02' => '02.jpg',
        '03' => '03.jpg',
        '04' => '04.jpg',
        '05' => '05.jpg',
    ];

    $subject = Subject::with(['faculty', 'lecturers'])
        ->withCount(['documents', 'lecturers'])
        ->findOrFail($id);

    return view('admin.subjects.edit', [
        'subject' => $subject,

        // danh sách giảng viên để chọn checkbox
        'teachers' => User::where('role_id', 2)
            ->where('is_active', true)
            ->get(),

        // ⭐ FIX QUAN TRỌNG: danh sách ID giảng viên đã gán
'selectedLecturers' => $subject->lecturers->pluck('user_id')->toArray(),
        'faculties' => Faculty::where('is_active', true)->get(),

        'subjectImages' => $subjectImages,
    ]);
}

    /* =========================
     * UPDATE
     * ========================= */
    public function update(Request $request, string $id)
    {
        $subject = Subject::findOrFail($id);

        $subject->update([
            'subject_name' => $request->subject_name,
            'slug' => Str::slug($request->subject_name),
            'description' => $request->description,
            'thumbnail' => $request->thumbnail ?? $subject->thumbnail,
            'icon' => $request->icon ?? $subject->icon,
            'color' => $request->color ?? $subject->color,
            'status' => $request->status,
            'faculty_id' => $request->faculty_id,
            'updated_by' => Auth::id(),
        ]);

        // 🔔 chỉ sync khi có gửi teacher_ids
       $teacherIds = $request->input('teacher_ids', []);
$this->syncLecturers($subject, $teacherIds);
        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Cập nhật môn học thành công.');
    }

    /* =========================
     * DELETE
     * ========================= */
    public function destroy(string $id)
    {
        $subject = Subject::withCount(['lecturers', 'documents'])
            ->findOrFail($id);

        if ($subject->lecturers_count > 0 || $subject->documents_count > 0) {
            $subject->update([
                'status' => 'inactive',
                'updated_by' => Auth::id(),
            ]);

            return back()->with('success', 'Môn học đã được ẩn.');
        }

        $subject->delete();

        return back()->with('success', 'Đã xóa môn học.');
    }

    /* =========================
     * TRASH
     * ========================= */
    public function trashed()
    {
        $subjects = Subject::onlyTrashed()
            ->with('faculty')
            ->latest('deleted_at')
            ->paginate(10);

        return view('admin.subjects.trashed', compact('subjects'));
    }

    /* =========================
     * RESTORE
     * ========================= */
    public function restore(string $id)
    {
        Subject::onlyTrashed()
            ->where('subject_code', $id)
            ->firstOrFail()
            ->restore();

        return back()->with('success', 'Khôi phục thành công.');
    }

    /* =========================
     * FORCE DELETE
     * ========================= */
    public function forceDelete(string $id)
    {
        Subject::onlyTrashed()
            ->where('subject_code', $id)
            ->firstOrFail()
            ->forceDelete();

        return back()->with('success', 'Đã xóa vĩnh viễn.');
    }

    /* =========================
     * SYNC + NOTIFICATION
     * ========================= */
    private function syncLecturers(Subject $subject, array $teacherIds): void
    {
        // sync bảng pivot
        $subject->lecturers()->sync($teacherIds);

        foreach ($teacherIds as $teacherId) {

            // tránh spam notification
            $exists = Notification::where('user_id', $teacherId)
                ->where('type', 'subject_assignment')
                ->where('related_id', $subject->subject_code)
                ->exists();

            if ($exists) continue;

            Notification::create([
                'user_id' => $teacherId,
                'title' => 'Bạn được phân công môn học',
                'content' => 'Bạn đã được phân công giảng dạy môn: ' . $subject->subject_name,
                'type' => 'subject_assignment',
                'related_type' => 'subject',
'related_id' => $subject->getKey(),    
            'is_read' => false,
            ]);
        }
    }
}