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
    public function index(Request $request)
    {
        $query = DocumentType::withCount('documents');

        // Tìm kiếm theo tên loại tài liệu
        if ($request->filled('keyword')) {
            $query->where('type_name', 'like', '%' . $request->keyword . '%');
        }

        // Lọc trạng thái
        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }

        // Sắp xếp
        if ($request->sort === 'az') {
            $query->orderBy('type_name', 'asc');
        } elseif ($request->sort === 'za') {
            $query->orderBy('type_name', 'desc');
        } else {
            $query->orderByDesc('document_type_id');
        }

        $documentTypes = $query
            ->paginate(5)
            ->withQueryString();

        $totalTypes = DocumentType::count();

        $totalDocuments = Document::count();

        return view('admin.document-types.index', compact(
            'documentTypes',
            'totalTypes',
            'totalDocuments'
        ));
    }

    public function create()
    {
        return view('admin.document-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_name' => [
                'required',
                'string',
                'max:100',
                'unique:document_types,type_name',
            ],
            'description' => 'nullable|string|max:1000',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:30',
            'is_active' => 'nullable|boolean',
        ], [
            'type_name.required' => 'Vui lòng nhập tên loại tài liệu.',
            'type_name.unique' => 'Tên loại tài liệu đã tồn tại.',
            'type_name.max' => 'Tên loại tài liệu không được vượt quá 100 ký tự.',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
        ]);

        DocumentType::create([
            'type_name' => $request->type_name,
            'description' => $request->description,
            'icon' => $request->icon ?: 'fa-solid fa-file-lines',
            'color' => $request->color ?: 'cyan',
            'is_active' => $request->boolean('is_active'),
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.document-types.index')
            ->with('success', 'Thêm loại tài liệu thành công.');
    }

    public function show(string $id)
    {
        $documentType = DocumentType::withCount('documents')
            ->findOrFail($id);

        return view('admin.document-types.show', compact('documentType'));
    }

    public function edit(string $id)
    {
        $documentType = DocumentType::withCount('documents')
            ->findOrFail($id);

        return view('admin.document-types.edit', compact('documentType'));
    }

    public function update(Request $request, string $id)
    {
        $documentType = DocumentType::findOrFail($id);

        $request->validate([
            'type_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('document_types', 'type_name')
                    ->ignore($documentType->document_type_id, 'document_type_id'),
            ],
            'description' => 'nullable|string|max:1000',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:30',
            'is_active' => 'nullable|boolean',
        ], [
            'type_name.required' => 'Vui lòng nhập tên loại tài liệu.',
            'type_name.unique' => 'Tên loại tài liệu đã tồn tại.',
            'type_name.max' => 'Tên loại tài liệu không được vượt quá 100 ký tự.',
            'description.max' => 'Mô tả không được vượt quá 1000 ký tự.',
        ]);

        $documentType->update([
            'type_name' => $request->type_name,
            'description' => $request->description,
            'icon' => $request->icon ?: 'fa-solid fa-file-lines',
            'color' => $request->color ?: 'cyan',
            'is_active' => $request->boolean('is_active'),
            'updated_by' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.document-types.index')
            ->with('success', 'Cập nhật loại tài liệu thành công.');
    }

    public function toggleStatus(string $id)
    {
        $documentType = DocumentType::findOrFail($id);

        $documentType->update([
            'is_active' => !$documentType->is_active,
            'updated_by' => Auth::id(),
        ]);

        return back()
            ->with('success', 'Cập nhật trạng thái loại tài liệu thành công.');
    }

    public function destroy(string $id)
    {
        $documentType = DocumentType::findOrFail($id);

        // Không xóa cứng loại tài liệu, chỉ chuyển sang trạng thái ngừng hoạt động
        $documentType->update([
            'is_active' => false,
            'updated_by' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.document-types.index')
            ->with('success', 'Loại tài liệu đã được chuyển sang trạng thái ngừng hoạt động.');
    }
}