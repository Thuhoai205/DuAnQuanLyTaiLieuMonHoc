<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Danh sách khoa
     */
    public function index(Request $request)
    {
        $query = Faculty::withCount('subjects');

        $totalTrashedFaculties = Faculty::onlyTrashed()->count();

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('faculty_name', 'like', '%' . $request->search . '%')
                  ->orWhere('faculty_code', 'like', '%' . $request->search . '%');

            });

        }

        if ($request->filled('status')) {

            $query->where('is_active', $request->status);

        }

        $faculties = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.faculties.index', compact(
            'faculties',
            'totalTrashedFaculties'
        ));
    }
    public function show($id)
{
    $faculty = Faculty::with([
        'subjects' => function ($q) {
            $q->withCount('documents');
        }
    ])
    ->withCount('subjects')
    ->findOrFail($id);

    $faculty->documents_count = $faculty->subjects->sum('documents_count');

    return view('admin.faculties.show', compact('faculty'));
}
public function edit(Faculty $faculty)
{
    return view('admin.faculties.edit', compact('faculty'));
}

public function update(Request $request, Faculty $faculty)
{
    $request->validate([
        'faculty_name' => 'required|max:255|unique:faculties,faculty_name,' . $faculty->faculty_id . ',faculty_id',
        'description'  => 'nullable|string',
        'is_active'    => 'required|boolean',
    ]);

    $faculty->update([
        'faculty_name' => $request->faculty_name,
        'description'  => $request->description,
        'is_active'    => $request->is_active,
    ]);

    return redirect()
        ->route('admin.faculties.index')
        ->with('success', 'Cập nhật khoa thành công.');
}
public function create()
{
    return view('admin.faculties.create');
}

public function store(Request $request)
{
    $request->validate([
        'faculty_code' => 'required|max:20|unique:faculties,faculty_code',
        'faculty_name' => 'required|max:255|unique:faculties,faculty_name',
        'description'  => 'nullable|string',
        'is_active'    => 'required|boolean',
    ]);

    Faculty::create([
        'faculty_code' => strtoupper($request->faculty_code),
        'faculty_name' => $request->faculty_name,
        'description'  => $request->description,
        'is_active'    => $request->is_active,
    ]);

    return redirect()
        ->route('admin.faculties.index')
        ->with('success', 'Thêm khoa thành công.');
}
    /**
     * Danh sách khoa đã xóa
     */
    public function trashed()
    {
        $faculties = Faculty::onlyTrashed()
            ->withCount('subjects')
            ->latest('deleted_at')
            ->paginate(10);

        return view('admin.faculties.trashed', compact('faculties'));
    }

    /**
     * Khôi phục một khoa
     */
    public function restore($id)
    {
        $faculty = Faculty::onlyTrashed()->findOrFail($id);

        $faculty->restore();

        return back()->with(
            'success',
            'Khôi phục khoa thành công.'
        );
    }

    /**
     * Khôi phục nhiều khoa
     */
    public function restoreMultiple(Request $request)
    {
        $request->validate([
            'faculty_ids' => 'required|array',
            'faculty_ids.*' => 'exists:faculties,faculty_id',
        ]);

        Faculty::onlyTrashed()
            ->whereIn('faculty_id', $request->faculty_ids)
            ->restore();

        return back()->with(
            'success',
            'Khôi phục các khoa thành công.'
        );
    }

    /**
     * Xóa vĩnh viễn
     */
    public function forceDelete($id)
    {
        $faculty = Faculty::onlyTrashed()->findOrFail($id);

        $faculty->forceDelete();

        return back()->with(
            'success',
            'Đã xóa vĩnh viễn khoa.'
        );
    }
    public function destroy($id)
{
    $faculty = Faculty::findOrFail($id);

    $hasActiveSubject = $faculty->subjects()
        ->where('status', 'active')
        ->exists();

    if ($hasActiveSubject) {
        return response()->json([
            'success' => false,
            'message' => 'Không thể xóa khoa vì vẫn còn môn học đang hoạt động.'
        ], 422);
    }

    $faculty->delete();

    return response()->json([
        'success'       => true,
        'message'       => 'Đã chuyển khoa vào thùng rác.',
        'trashedCount'  => Faculty::onlyTrashed()->count(),
    ]);
}
public function toggleStatus($id)
{
    $faculty = Faculty::findOrFail($id);

    // Đang hoạt động -> muốn khóa
    if ($faculty->is_active) {

        $hasActiveSubject = $faculty->subjects()
            ->whereNull('deleted_at')
            ->where('status', 'active')
            ->exists();

        if ($hasActiveSubject) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể khóa khoa vì vẫn còn môn học đang hoạt động.'
            ], 422);
        }

        $faculty->is_active = false;
    }

    // Đang khóa -> mở khóa
    else {

        $faculty->is_active = true;
    }

    $faculty->save();

    return response()->json([
        'success' => true,
        'status' => $faculty->is_active
    ]);
}
}