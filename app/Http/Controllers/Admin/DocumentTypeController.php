<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    /**
     * Danh sách loại tài liệu
     */
    public function index(Request $request)
    {
        $query = DocumentType::query();

        // Tìm kiếm theo tên loại tài liệu
        if ($request->filled('keyword')) {
            $query->where(
                'type_name',
                'like',
                '%' . $request->keyword . '%'
            );
        }

        // Sắp xếp A-Z hoặc Z-A
        if ($request->sort === 'az') {
            $query->orderBy('type_name', 'asc');
        } elseif ($request->sort === 'za') {
            $query->orderBy('type_name', 'desc');
        } else {
            $query->orderByDesc('document_type_id');
        }

        // Đếm số tài liệu thuộc từng loại
        $documentTypes = $query
            ->withCount('documents')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.categories.index',
            compact('documentTypes')
        );
    }

    /**
     * Form thêm loại tài liệu
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Lưu loại tài liệu mới
     */
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
            'icon' => $request->icon,
            'color' => $request->color ?? 'blue',
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Thêm loại tài liệu thành công');
    }

    /**
     * Form sửa loại tài liệu
     */
    public function edit($id)
    {
        $documentType = DocumentType::findOrFail($id);

        return view(
            'admin.categories.edit',
            compact('documentType')
        );
    }

    /**
     * Cập nhật loại tài liệu
     */
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
            'icon' => $request->icon,
            'color' => $request->color ?? $documentType->color,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Cập nhật loại tài liệu thành công');
    }

    /**
     * Xóa loại tài liệu
     */
    public function destroy($id)
    {
        $documentType = DocumentType::withCount('documents')
            ->findOrFail($id);

        // Không cho xóa nếu loại tài liệu đang có tài liệu
        if ($documentType->documents_count > 0) {
            return redirect()
                ->route('admin.categories.index')
                ->with(
                    'error',
                    'Không thể xóa vì loại tài liệu đang chứa tài liệu.'
                );
        }

        $documentType->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Xóa loại tài liệu thành công');
    }
}