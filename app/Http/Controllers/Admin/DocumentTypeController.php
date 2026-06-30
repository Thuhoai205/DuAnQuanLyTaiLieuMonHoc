<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DocumentTypeController extends Controller
{
    /* =========================
     * INDEX
     * ========================= */
    public function index(Request $request)
    {
        $query = DocumentType::withCount('documents');

        // SEARCH
        if ($request->filled('search')) {
            $query->where('type_name', 'like', '%' . $request->search . '%');
        }

        // STATUS (0/1)
        if ($request->filled('status')) {
            $query->where('is_active', (int) $request->status);
        }

        // SORT
        $sort = $request->get('sort', 'newest');

        if ($sort === 'az') {
            $query->orderBy('type_name', 'asc');
        } elseif ($sort === 'za') {
            $query->orderBy('type_name', 'desc');
        } else {
            $query->orderByDesc('document_type_id');
        }

        $documentTypes = $query->paginate(10)->withQueryString();

        // AJAX SUPPORT
        if ($request->ajax()) {
            return view('admin.document-types.index', compact(
                'documentTypes'
            ))->render();
        }

        return view('admin.document-types.index', [
            'documentTypes' => $documentTypes,
            'totalTypes' => DocumentType::count(),
            'totalDocuments' => Document::count(),
            'totalTrashedDocumentTypes' => DocumentType::onlyTrashed()->count(),
        ]);
    }
    /* =========================
     * TRASH
     * ========================= */
    public function trashed()
    {
        $documentTypes = DocumentType::onlyTrashed()
            ->withCount('documents')
            ->orderByDesc('deleted_at')
            ->paginate(10);

        return view('admin.document-types.trashed', compact('documentTypes'));
    }

    /* =========================
     * RESTORE
     * ========================= */
    public function restore(string $id)
    {
        DocumentType::onlyTrashed()
            ->where('document_type_id', $id)
            ->firstOrFail()
            ->restore();

        return back()->with('success', 'Khôi phục thành công.');
    }

    /* =========================
     * RESTORE MULTIPLE
     * ========================= */
    public function restoreMultiple(Request $request)
    {
        DocumentType::onlyTrashed()
            ->whereIn('document_type_id', $request->document_type_ids ?? [])
            ->restore();

        return back()->with('success', 'Khôi phục thành công.');
    }

    /* =========================
     * FORCE DELETE
     * ========================= */
    public function forceDelete(string $id)
    {
        $type = DocumentType::onlyTrashed()
            ->withCount('documents')
            ->findOrFail($id);

        if ($type->documents_count > 0) {
            return back()->with('error', 'Không thể xóa vĩnh viễn vì loại tài liệu vẫn còn tài liệu sử dụng.');
        }

        $type->forceDelete();

        return back()->with('success', 'Đã xóa vĩnh viễn.');
    }
    /* =========================
     * STORE
     * ========================= */
    public function store(Request $request)
{
    $request->validate([
        'type_name' => 'required|string|max:100|unique:document_types,type_name',
        'description' => 'nullable|string|max:255',
        'icon' => 'nullable|string|max:100',
        'color' => 'nullable|string|max:50',
        'is_active' => 'required|boolean',
    ], [
        'type_name.required' => 'Vui lòng nhập tên loại tài liệu.',
        'type_name.unique' => 'Tên loại tài liệu đã tồn tại.',
        'type_name.max' => 'Tên loại tài liệu không được vượt quá 100 ký tự.',

        'description.max' => 'Mô tả không được vượt quá 255 ký tự.',

        'is_active.required' => 'Vui lòng chọn trạng thái.',
        'is_active.boolean' => 'Trạng thái không hợp lệ.',
    ]);

    DocumentType::create([
        'type_name'  => trim($request->type_name),
        'description'=> $request->description,
        'icon'       => $request->icon ?: 'fa-solid fa-file-lines',
        'color'      => $request->color ?: 'cyan',
        'is_active'  => $request->boolean('is_active'),
        'created_by' => Auth::id(),
        'updated_by' => Auth::id(),
    ]);

    return redirect()
        ->route('admin.document-types.index')
        ->with('success', 'Thêm loại tài liệu thành công.');
}

    /* =========================
     * UPDATE
     * ========================= */
    public function update(Request $request, string $id)
    {
        $type = DocumentType::findOrFail($id);

        $request->validate([
            'type_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('document_types', 'type_name')
                    ->ignore($type->document_type_id, 'document_type_id'),
            ],
        ]);

        $type->update([
            'type_name' => $request->type_name,
            'description' => $request->description,
            'icon' => $request->icon ?? 'fa-solid fa-file-lines',
            'color' => $request->color ?? 'cyan',
            'updated_by' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.document-types.index')
            ->with('success', 'Cập nhật thành công.');
    }

    /* =========================
     * TOGGLE STATUS (AJAX)
     * ========================= */
    public function toggleStatus(string $id)
    {
        $type = DocumentType::findOrFail($id);

        $type->update([
            'is_active' => ! $type->is_active,
            'updated_by' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'status' => $type->is_active,
            'label' => $type->is_active ? 'Hoạt động' : 'Đã khóa'
        ]);
    }
    /* =========================
     * DESTROY (SOFT DELETE + AJAX)
     * ========================= */
    public function destroy(string $id)
    {
        $type = DocumentType::withCount('documents')->findOrFail($id);

        // ❗ CASE 1: có tài liệu → CHỈ KHÓA
        if ($type->documents_count > 0) {

            $type->update([
                'is_active' => false,
                'updated_by' => Auth::id()
            ]);

            return response()->json([
                'success' => false,
                'type' => 'locked',
                'message' => 'Loại này đang có tài liệu nên chỉ có thể khóa!',
                'status' => false
            ]);
        }

        // ❗ CASE 2: không có tài liệu → XÓA MỀM
        $type->delete();

        return response()->json([
            'success' => true,
            'type' => 'deleted',
            'trashed_count' => DocumentType::onlyTrashed()->count()
        ]);
    }

    /* =========================
     * SHOW
     * ========================= */
    public function show(string $id)
    {
        $documentType = DocumentType::with([
        'documents' => function ($q) {
            $q->latest()->limit(5);
        }
        ])
        ->withCount('documents')
        ->findOrFail($id);
            return view('admin.document-types.show', compact('documentType'));
    }

    /* =========================
     * EDIT
     * ========================= */
    public function edit(string $id)
    {
        $documentType = DocumentType::withCount('documents')
            ->findOrFail($id);

        $icons = [
            ['label' => 'Đề cương môn học', 'value' => 'fa-solid fa-book-open'],
            ['label' => 'Giáo trình', 'value' => 'fa-solid fa-book'],
            ['label' => 'Slide bài giảng', 'value' => 'fa-solid fa-file-powerpoint'],
            ['label' => 'Tài liệu tham khảo', 'value' => 'fa-solid fa-file-lines'],
            ['label' => 'Bài tập', 'value' => 'fa-solid fa-pencil'],
            ['label' => 'Bài thực hành', 'value' => 'fa-solid fa-laptop-code'],
            ['label' => 'Đề thi', 'value' => 'fa-solid fa-file-circle-check'],
            ['label' => 'Đáp án', 'value' => 'fa-solid fa-circle-check'],
            ['label' => 'Video bài giảng', 'value' => 'fa-solid fa-video'],
            ['label' => 'Mã nguồn', 'value' => 'fa-solid fa-code'],
            ['label' => 'Tệp PDF', 'value' => 'fa-solid fa-file-pdf'],
            ['label' => 'Tệp Word', 'value' => 'fa-solid fa-file-word'],
        ];

        return view('admin.document-types.edit', compact('documentType', 'icons'));
    }
    public function create()
    {
        $icons = [
            ['label' => 'Đề cương môn học', 'value' => 'fa-solid fa-book-open'],
            ['label' => 'Giáo trình', 'value' => 'fa-solid fa-book'],
            ['label' => 'Slide bài giảng', 'value' => 'fa-solid fa-file-powerpoint'],
            ['label' => 'Tài liệu tham khảo', 'value' => 'fa-solid fa-file-lines'],
            ['label' => 'Bài tập', 'value' => 'fa-solid fa-pencil'],
            ['label' => 'Bài thực hành', 'value' => 'fa-solid fa-laptop-code'],
            ['label' => 'Đề thi', 'value' => 'fa-solid fa-file-circle-check'],
            ['label' => 'Đáp án', 'value' => 'fa-solid fa-circle-check'],
            ['label' => 'Video bài giảng', 'value' => 'fa-solid fa-video'],
            ['label' => 'Mã nguồn', 'value' => 'fa-solid fa-code'],
            ['label' => 'Tệp PDF', 'value' => 'fa-solid fa-file-pdf'],
            ['label' => 'Tệp Word', 'value' => 'fa-solid fa-file-word'],
        ];

        return view('admin.document-types.create', compact('icons'));
    }
}