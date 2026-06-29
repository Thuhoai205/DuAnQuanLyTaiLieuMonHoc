<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\DocumentVersion;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Danh sách tài liệu
     */
    public function index(Request $request)
    {
        $query = Document::with([
            'subject',
            'documentType',
            'uploader',
            'currentVersion'
        ]);

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Subject filter
        if ($request->filled('subject_code')) {

            $query->where(
                'subject_code',
                $request->subject_code
            );
        }

        // Document type filter
        if ($request->filled('document_type_id')) {

            $query->where(
                'document_type_id',
                $request->document_type_id
            );
        }

        // Status filter
        if (
            $request->status !== null &&
            $request->status !== ''
        ) {

            $query->where(
                'is_active',
                $request->status
            );
        }

        $documents = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $subjects = Subject::where(
            'status',
            'active'
        )->get();

        $documentTypes = DocumentType::where(
            'is_active',
            true
        )->get();

        $totalDocuments = Document::count();

        $totalDownloads = Document::sum(
            'download_count'
        );

        $totalTrashedDocuments = Document::onlyTrashed()
            ->count();

        // AJAX request
        if ($request->ajax()) {

            return view(
                'admin.documents.index',
                compact(
                    'documents',
                    'subjects',
                    'documentTypes',
                    'totalDocuments',
                    'totalDownloads',
                    'totalTrashedDocuments'
                )
            )->render();
        }

        return view(
            'admin.documents.index',
            compact(
                'documents',
                'subjects',
                'documentTypes',
                'totalDocuments',
                'totalDownloads',
                'totalTrashedDocuments'
            )
        );
    }
    /**
     * Show tài liệu
     */
    public function show(string $id)
    {
        $document = Document::with([
            'subject',
            'documentType',
            'uploader',
            'updater',
            'currentVersion',
            'documentVersions.uploader'
        ])
        ->where('document_id', $id)
        ->firstOrFail();

        return view('admin.documents.show', compact('document'));
    }
    /**
     * Form thêm
     */
    public function create()
    {
        return view('admin.documents.create', [
            'subjects' => Subject::where('status', 'active')->get(),
            'documentTypes' => DocumentType::where('is_active', true)->get(),
        ]);
    }

    /**
     * Lưu tài liệu mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'subject_code' => 'required|exists:subjects,subject_code',
            'document_type_id' => 'required|exists:document_types,document_type_id',
            'file' => 'required|file|max:51200',
        ]);

        DB::beginTransaction();

        try {

            $document = Document::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'subject_code' => $request->subject_code,
                'document_type_id' => $request->document_type_id,
                'uploaded_by' => Auth::id(),
                'updated_by' => Auth::id(),
                'is_active' => true,
            ]);

            $file = $request->file('file');

            $storedName = time() . '_' . $file->getClientOriginalName();

            $path = $file->storeAs(
                'documents',
                $storedName,
                'public'
            );

            DocumentVersion::create([
            'document_id'        => $document->document_id,
            'version_name'       => '1.0',
            'version_note'       => 'Phiên bản đầu tiên',
            'original_file_name' => $file->getClientOriginalName(),
            'stored_file_name'   => $storedName,
            'file_path'          => $path,
            'file_extension'     => $file->getClientOriginalExtension(),
            'file_size'          => $file->getSize(),
            'uploaded_by'        => Auth::id(),
            'is_current'         => true,
            ]);

                DB::commit();

                return redirect()
                    ->route('admin.documents.index')
                    ->with('success', 'Thêm tài liệu thành công');
            } catch (\Exception $e) {

                DB::rollBack();

                return back()
                    ->withInput()
                    ->with('error', $e->getMessage());
            }
        }

    /**
     * Form sửa
     */
    public function edit(string $id)
    {
        $document = Document::with([
            'subject',
            'documentType',
            'currentVersion'
        ])->findOrFail($id);

        return view('admin.documents.edit', [
            'document' => $document,

            'subjects' => Subject::where(
                'status',
                'active'
            )->get(),

            'documentTypes' => DocumentType::where(
                'is_active',
                true
            )->get(),
        ]);
    }
    /**
     * Cập nhật
     */
 public function update(Request $request, string $id)
{
    $document = Document::with('subject')
        ->findOrFail($id);

    // Môn học đã khóa
    if (
        $document->subject &&
        $document->subject->status !== 'active'
    ) {
        return back()
            ->with(
                'error',
                'Môn học đã bị khóa, không thể cập nhật tài liệu.'
            );
    }

    $request->validate([
        'title'            => 'required|max:255',
        'subject_code'     => 'required|exists:subjects,subject_code',
        'document_type_id' => 'required|exists:document_types,document_type_id',
        'file'             => 'nullable|file|max:51200',
    ]);

    DB::beginTransaction();

    try {

        // Cập nhật thông tin tài liệu
        $document->update([
            'title'            => $request->title,
            'slug'             => Str::slug($request->title),
            'description'      => $request->description,
            'subject_code'     => $request->subject_code,
            'document_type_id' => $request->document_type_id,
            'is_active'        => $request->is_active,
            'updated_by'       => Auth::id(),
        ]);

        // Upload file mới => tạo version mới
        if ($request->hasFile('file')) {

            // Bỏ version hiện tại
            DocumentVersion::where(
                'document_id',
                $document->document_id
            )->update([
                'is_current' => false
            ]);

            $file = $request->file('file');

            $storedName =
                time() . '_' .
                $file->getClientOriginalName();

            $path = $file->storeAs(
                'documents',
                $storedName,
                'public'
            );

            // Lấy version gần nhất
            $lastVersion = DocumentVersion::where(
                'document_id',
                $document->document_id
            )
            ->orderByDesc('version_id')
            ->first();

            if ($lastVersion) {

                $parts = explode(
                    '.',
                    $lastVersion->version_name
                );

                $major = (int) ($parts[0] ?? 1);
                $minor = (int) ($parts[1] ?? 0);

                $minor++;

                $newVersion =
                    $major . '.' . $minor;

            } else {

                $newVersion = '1.0';
            }

            // Tạo version mới
           DocumentVersion::create([
    'document_id'        => $document->document_id,
    'version_name'       => $newVersion,

    // thêm dòng này
'version_note' => $request->version_note ?: 'Cập nhật phiên bản',
    'original_file_name' => $file->getClientOriginalName(),
    'stored_file_name'   => $storedName,
    'file_path'          => $path,
    'file_extension'     => $file->getClientOriginalExtension(),
    'file_size'          => $file->getSize(),
    'uploaded_by'        => Auth::id(),
    'is_current'         => true,
]);
        }

        DB::commit();

        return redirect()
            ->route(
                'admin.documents.show',
                $document->document_id
            )
            ->with(
                'success',
                'Cập nhật tài liệu thành công'
            );

    } catch (\Exception $e) {

        DB::rollBack();

        return back()
            ->withInput()
            ->with(
                'error',
                $e->getMessage()
            );
    }
}

    /**
     * Khóa / Mở khóa
     */
   public function toggleStatus(string $id)
{
    $document = Document::with('subject')
        ->findOrFail($id);

    // Môn học đã khóa
    if (
        $document->subject &&
        $document->subject->status !== 'active'
    ) {
        return response()->json([
            'success' => false,
            'message' => 'Môn học đã bị khóa, không thể thay đổi trạng thái tài liệu.'
        ], 422);
    }

    $document->is_active = ! $document->is_active;
    $document->updated_by = Auth::id();
    $document->save();

    return response()->json([
        'success' => true,
        'status' => $document->is_active,
    ]);
}
    /**
     * Xóa mềm
     */
    public function destroy(string $id)
    {
        $document = Document::findOrFail($id);

        $document->deleted_by = Auth::id();
        $document->save();

        $document->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Danh sách thùng rác
     */
    public function trashed()
    {
        $documents = Document::onlyTrashed()
            ->with([
                'subject',
                'documentType',
                'uploader'
            ])
            ->latest('deleted_at')
            ->paginate(10);

        return view('admin.documents.trashed', compact('documents'));
    }

    /**
     * Khôi phục
     */
    public function restore(string $id)
    {
        Document::onlyTrashed()
            ->findOrFail($id)
            ->restore();

        return back()->with(
            'success',
            'Khôi phục tài liệu thành công'
        );
    }

    /**
     * Xóa vĩnh viễn
     */
    public function forceDelete(string $id)
    {
        $document = Document::onlyTrashed()
            ->findOrFail($id);

        foreach ($document->documentVersions as $version) {

            if (
                $version->file_path &&
                Storage::disk('public')->exists($version->file_path)
            ) {
                Storage::disk('public')->delete(
                    $version->file_path
                );
            }
        }

        $document->forceDelete();

        return back()->with(
            'success',
            'Đã xóa vĩnh viễn tài liệu'
        );
    }
}