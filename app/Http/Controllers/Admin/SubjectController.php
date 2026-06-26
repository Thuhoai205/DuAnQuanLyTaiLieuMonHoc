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

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('subject_code', 'like', "%{$search}%")
                    ->orWhere('subject_name', 'like', "%{$search}%");
            });
        }

        // FACULTY FILTER
        if ($request->filled('faculty_id')) {
            $query->where('faculty_id', $request->faculty_id);
        }

        // STATUS (0/1)
    if ($request->filled('status')) {
        $query->where('is_active', (int) $request->status);
    }

        $subjects = $query->orderBy('subject_name')
            ->paginate(6)
            ->withQueryString();
        $totalTrashedSubjects = Subject::onlyTrashed()->count();

        return view('admin.subjects.index', [
            'subjects' => $subjects,
            
            'faculties' => Faculty::where('is_active', true)
                ->orderBy('faculty_name')
                ->get(),

            'totalSubjects' => Subject::count(),
            'totalTeachers' => User::where('role_id', 2)->where('is_active', true)->count(),
            'totalDocuments' => Document::count(),

            'totalTrashedSubjects'
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
        ]);

        $subject = Subject::create([
            'subject_code' => strtoupper($request->subject_code),
            'subject_name' => $request->subject_name,
            'slug' => Str::slug($request->subject_name),
            'description' => $request->description,
            'thumbnail' => $request->thumbnail ?? '01.jpg',
            'icon' => $request->icon ?? 'fa-solid fa-book-open',
            'color' => $request->color ?? 'blue',
            'status' => 'active',
            'faculty_id' => $request->faculty_id,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        $this->syncLecturers($subject, $request->teacher_ids ?? []);

        return redirect()->route('admin.subjects.index')
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

    // FIX THUMBNAIL PATH
   $subject->thumbnail_url = $subject->thumbnail
    ? asset('img/subjects/' . $subject->thumbnail)
    : asset('img/subjects/01.jpg');
    return view('admin.subjects.show', compact('subject'));
}

    /* =========================
     * EDIT
     * ========================= */
   public function edit(string $id)
{
    $subject = Subject::with(['faculty', 'lecturers'])
        ->withCount(['documents', 'lecturers'])
        ->where('subject_code', $id)
        ->firstOrFail();

    $subjectImages = [
        '01' => '01.jpg',
        '02' => '02.jpg',
        '03' => '03.jpg',
        '04' => '04.jpg',
        '05' => '05.jpg',
    ];

    return view('admin.subjects.edit', [
        'subject' => $subject,
        'teachers' => User::where('role_id', 2)->where('is_active', true)->get(),
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
    $subject = Subject::where(
        'subject_code',
        $id
    )->firstOrFail();
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

$subject->refresh();

Document::where(
    'subject_code',
    $subject->subject_code
)->update([
    'is_active' => $subject->status === 'active'
]);


    // Đồng bộ trạng thái tài liệu theo môn học
  
    $this->syncLecturers(
        $subject,
        $request->teacher_ids ?? []
    );

    return redirect()
        ->route('admin.subjects.index')
        ->with(
            'success',
            'Cập nhật môn học thành công.'
        );
}
    /* =========================
     * SOFT DELETE (AJAX SUPPORT)
     * ========================= */
   public function destroy(string $id)
{
    $subject = Subject::where('subject_code', $id)
        ->firstOrFail();

    $subject->delete();

    return response()->json([
        'success' => true,
        'trashed_count' => Subject::onlyTrashed()->count()
    ]);
}

    /* =========================
     * TRASH LIST
     * ========================= */
    public function trashed()
    {
        $subjects = Subject::onlyTrashed()
            ->with('faculty')
            ->withCount(['documents', 'lecturers'])
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
     * TOGGLE STATUS (AJAX)
     * ========================= */
 public function toggleStatus(string $id)
{
    $subject = Subject::where(
        'subject_code',
        $id
    )->firstOrFail();

    $subject->status =
        $subject->status === 'active'
        ? 'archived'
        : 'active';

    $subject->updated_by = Auth::id();
    $subject->save();

    // Đồng bộ trạng thái tài liệu
    Document::where(
        'subject_code',
        $subject->subject_code
    )->update([
        'is_active' => $subject->status === 'active' ? 1 : 0
    ]);

    return response()->json([
        'success' => true,
        'status' => $subject->status,
        'label' => $subject->status === 'active'
            ? 'Hoạt động'
            : 'Đã khóa'
    ]);
}
    /* =========================
     * SYNC LECTURERS + NOTIFICATION
     * ========================= */
   private function syncLecturers(Subject $subject, array $teacherIds): void
{
    // Danh sách giảng viên cũ
    $oldTeacherIds = $subject->lecturers()
        ->pluck('users.user_id')
        ->toArray();

    // Cập nhật phân công
    $subject->lecturers()->sync($teacherIds);

    /*
    |--------------------------------------------------------------------------
    | Thông báo phân công mới
    |--------------------------------------------------------------------------
    */
    foreach ($teacherIds as $teacherId) {

        if (!in_array($teacherId, $oldTeacherIds)) {

            Notification::create([
                'user_id' => $teacherId,
                'title' => 'Bạn được phân công môn học',
                'content' => 'Bạn được phân công giảng dạy môn "' .
                    $subject->subject_name . '".',
                'type' => 'subject_assignment',
                'related_type' => 'subject',
                'related_id' => $subject->subject_code,
                'is_read' => false,
            ]);

        }
    }

    /*
    |--------------------------------------------------------------------------
    | Thông báo hủy phân công
    |--------------------------------------------------------------------------
    */
    $removedTeacherIds = array_diff($oldTeacherIds, $teacherIds);

    foreach ($removedTeacherIds as $teacherId) {

        Notification::create([
            'user_id' => $teacherId,
            'title' => 'Hủy phân công môn học',
            'content' => 'Bạn không còn phụ trách môn "' .
                $subject->subject_name . '".',
            'type' => 'subject_removed',
            'related_type' => 'subject',
            'related_id' => $subject->subject_code,
            'is_read' => false,
        ]);

    }
}
}