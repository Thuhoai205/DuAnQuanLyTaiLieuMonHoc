<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = DocumentType::query();

        $totalTrashedDocumentTypes = DocumentType::onlyTrashed()->count();

        if ($request->filled('keyword')) {
            $query->where('type_name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->sort === 'az') {
            $query->orderBy('type_name', 'asc');
        } elseif ($request->sort === 'za') {
            $query->orderBy('type_name', 'desc');
        } else {
            $query->orderByDesc('document_type_id');
        }

        $documentTypes = $query
            ->withCount('documents')
            ->paginate(5)
            ->withQueryString();

        return view('admin.document-types.index', compact(
            'documentTypes',
            'totalTrashedDocumentTypes'
        ));
    }

    public function create()
    {
        return view('admin.document-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|max:100|unique:document_types,type_name',
            'description' => 'nullable|string|max:1000',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:30',
        ], [
            'type_name.required' => 'Vui lòng nhập tên loại tài liệu',
            'type_name.unique' => 'Tên loại tài liệu đã tồn tại',
        ]);

        DocumentType::create([
            'type_name' => $request->type_name,
            'description' => $request->description,
            'icon' => $request->icon ?? 'fa-solid fa-file-lines',
            'color' => $request->color ?? 'cyan',
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.document-types.index')
            ->with('success', 'Thêm loại tài liệu thành công');
    }

    public function edit($id)
    {
        $documentType = DocumentType::withCount('documents')->findOrFail($id);

        return view('admin.document-types.edit', compact('documentType'));
    }

    public function update(Request $request, $id)
    {
        $documentType = DocumentType::findOrFail($id);

        $request->validate([
            'type_name' => 'required|string|max:100|unique:document_types,type_name,' . $id . ',document_type_id',
            'description' => 'nullable|string|max:1000',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:30',
            'is_active' => 'nullable|boolean',
        ]);

        $documentType->update([
            'type_name' => $request->type_name,
            'description' => $request->description,
            'icon' => $request->icon ?? $documentType->icon,
            'color' => $request->color ?? $documentType->color,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.document-types.index')
            ->with('success', 'Cập nhật loại tài liệu thành công');
    }

    public function destroy($id)
    {
        $documentType = DocumentType::withCount('documents')->findOrFail($id);

        if ($documentType->documents_count > 0) {
            $documentType->update([
                'is_active' => false,
            ]);

            return redirect()
                ->route('admin.document-types.index')
                ->with('success', 'Loại tài liệu đã được chuyển sang trạng thái ngừng hoạt động.');
        }

        $documentType->delete();

        return redirect()
            ->route('admin.document-types.index')
            ->with('success', 'Xóa loại tài liệu thành công.');
    }

    public function toggleStatus($id)
    {
        $documentType = DocumentType::findOrFail($id);

        $documentType->update([
            'is_active' => !$documentType->is_active,
        ]);

        return back()->with('success', 'Cập nhật trạng thái thành công.');
    }

    public function trashed()
    {
        $documentTypes = DocumentType::onlyTrashed()
            ->withCount('documents')
            ->orderByDesc('deleted_at')
            ->paginate(10);

        return view('admin.document-types.trashed', compact('documentTypes'));
    }

    public function restore($id)
    {
        $documentType = DocumentType::onlyTrashed()->findOrFail($id);

        $documentType->restore();

        return redirect()
            ->route('admin.document-types.trashed')
            ->with('success', 'Khôi phục loại tài liệu thành công.');
    }
}