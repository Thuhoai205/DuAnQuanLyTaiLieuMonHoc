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
use App\Services\DocumentPreviewService;

class DocumentController extends Controller
{
    private DocumentPreviewService $previewService;

    public function __construct(DocumentPreviewService $previewService)
{
    $this->previewService = $previewService;
}
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
     * Form thêm tài liệu
     */
    public function create()
    {
        $subjects = Subject::where('status', 'active')
            ->orderBy('subject_name')
            ->get();

        $documentTypes = DocumentType::where('is_active', true)
            ->orderBy('type_name')
            ->get();

        return view('admin.documents.create', compact(
            'subjects',
            'documentTypes'
        ));
    }

    /**
     * Lưu tài liệu mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'subject_code'     => 'required|exists:subjects,subject_code',
            'document_type_id' => 'required|exists:document_types,document_type_id',
            'description'      => 'nullable|string',
            'file'             => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar|max:51200',
        ], [
            'title.required'            => 'Vui lòng nhập tên tài liệu.',
            'subject_code.required'     => 'Vui lòng chọn môn học.',
            'document_type_id.required' => 'Vui lòng chọn loại tài liệu.',
            'file.required'             => 'Vui lòng chọn tệp tài liệu.',
            'file.mimes'                => 'Định dạng tệp không được hỗ trợ.',
            'file.max'                  => 'Dung lượng tệp tối đa là 50MB.',
        ]);

        // Kiểm tra môn học
        $subject = Subject::findOrFail($request->subject_code);

        if ($subject->status !== 'active') {

            return back()
                ->withInput()
                ->withErrors([
                    'subject_code' => 'Môn học đã bị khóa.'
                ]);
        }

        // Kiểm tra loại tài liệu
        $documentType = DocumentType::findOrFail($request->document_type_id);

        if (!$documentType->is_active) {

            return back()
                ->withInput()
                ->withErrors([
                    'document_type_id' => 'Loại tài liệu đã bị khóa.'
                ]);
        }

        DB::beginTransaction();

        try {

            $file = $request->file('file');

            $storedName = time() . '_' . $file->getClientOriginalName();

            $path = $file->storeAs(
                'documents',
                $storedName,
                'public'
            );
            $extension = strtolower($file->getClientOriginalExtension());

            $previewFile = null;

            // PDF dùng luôn
            if ($extension === 'pdf') {

                $previewFile = $path;

            }

            // Ảnh dùng luôn
            elseif (in_array($extension, [
                'jpg',
                'jpeg',
                'png',
                'gif',
                'webp',
            ])) {

                $previewFile = $path;

            }

            // Office -> Convert sang PDF
            elseif (in_array($extension, [
                'doc',
                'docx',
                'xls',
                'xlsx',
                'ppt',
                'pptx',
            ])) {

                $previewFile = $this->previewService
                    ->convertToPdf($path);

            }

            // Tạo tài liệu
            $document = Document::create([
                'title'            => $request->title,
                'slug'             => Str::slug($request->title) . '-' . time(),
                'description'      => $request->description,
                'subject_code'     => $request->subject_code,
                'document_type_id' => $request->document_type_id,
                'uploaded_by'      => Auth::id(),
                'updated_by'       => Auth::id(),
                'download_count'   => 0,
                'is_active'        => true,
            ]);

            // Tạo phiên bản đầu tiên
           DocumentVersion::create([

                'document_id'        => $document->document_id,

                'version_name'       => '1.0',

                'version_note'       => 'Phiên bản đầu tiên',

                'original_file_name' => $file->getClientOriginalName(),

                'stored_file_name'   => $storedName,

                'file_path'          => $path,

                'preview_file'       => $previewFile,

                'file_extension'     => $extension,

                'file_size'          => $file->getSize(),

                'uploaded_by'        => Auth::id(),

                'is_current'         => true,

            ]);

            DB::commit();

            return redirect()
                ->route('admin.documents.index')
                ->with('success', 'Thêm tài liệu thành công.');

        } catch (\Exception $e) {

            DB::rollBack();

            if (isset($path) && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
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
      * Cập nhật tài liệu
     */
    public function update(Request $request, string $id)
    {
        $document = Document::with('subject')->findOrFail($id);

        $request->validate([
            'title'            => 'required|string|max:255',
            'subject_code'     => 'required|exists:subjects,subject_code',
            'document_type_id' => 'required|exists:document_types,document_type_id',
            'description'      => 'nullable|string',
            'is_active'        => 'required|boolean',
            'file'             => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar|max:51200',
            'version_note'     => 'nullable|string|max:255',
        ]);

        // Kiểm tra môn học
        $subject = Subject::findOrFail($request->subject_code);

        if ($subject->status !== 'active') {
            return back()
                ->withInput()
                ->withErrors([
                    'subject_code' => 'Môn học đã bị khóa.'
                ]);
        }

        // Kiểm tra loại tài liệu
        $documentType = DocumentType::findOrFail($request->document_type_id);

        if (!$documentType->is_active) {
            return back()
                ->withInput()
                ->withErrors([
                    'document_type_id' => 'Loại tài liệu đã bị khóa.'
                ]);
        }

        DB::beginTransaction();

        try {

            // Cập nhật thông tin tài liệu
            $document->update([
                'title'            => $request->title,
                'slug'             => Str::slug($request->title) . '-' . $document->document_id,
                'description'      => $request->description,
                'subject_code'     => $request->subject_code,
                'document_type_id' => $request->document_type_id,
                'is_active'        => $request->boolean('is_active'),
                'updated_by'       => Auth::id(),
            ]);

            // Upload file mới => tạo phiên bản mới
            if ($request->hasFile('file')) {

                // Bỏ đánh dấu version hiện tại
                DocumentVersion::where(
                    'document_id',
                    $document->document_id
                )->update([
                    'is_current' => false
                ]);

                $file = $request->file('file');

                $storedName = time() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs(
                    'documents',
                    $storedName,
                    'public'
                );
                $extension = strtolower($file->getClientOriginalExtension());

                $previewFile = null;

                // PDF
                if ($extension === 'pdf') {

                    $previewFile = $path;

                }

                // Image
                elseif (in_array($extension, [
                    'jpg',
                    'jpeg',
                    'png',
                    'gif',
                    'webp',
                ])) {

                    $previewFile = $path;

                }

                // Office
                elseif (in_array($extension, [
                    'doc',
                    'docx',
                    'xls',
                    'xlsx',
                    'ppt',
                    'pptx',
                ])) {

                    $previewFile = $this->previewService
                        ->convertToPdf($path);

                }

                // Lấy version hiện tại
                $lastVersion = DocumentVersion::where(
                    'document_id',
                    $document->document_id
                )
                ->orderByDesc('version_id')
                ->first();

                if ($lastVersion) {

                    $parts = explode('.', $lastVersion->version_name);

                    $major = (int)($parts[0] ?? 1);
                    $minor = (int)($parts[1] ?? 0);

                    $minor++;

                    $newVersion = $major . '.' . $minor;

                } else {

                    $newVersion = '1.0';

                }

                // Tạo version mới
               DocumentVersion::create([

                'document_id'        => $document->document_id,

                'version_name'       => $newVersion,

                'version_note'       => $request->filled('version_note')
                    ? $request->version_note
                    : 'Cập nhật phiên bản',

                'original_file_name' => $file->getClientOriginalName(),

                'stored_file_name'   => $storedName,

                'file_path'          => $path,

                'preview_file'       => $previewFile,

                'file_extension'     => $extension,

                'file_size'          => $file->getSize(),

                'uploaded_by'        => Auth::id(),

                'is_current'         => true,

            ]);
            }

            DB::commit();

            return redirect()
                ->route('admin.documents.show', $document->document_id)
                ->with('success', 'Cập nhật tài liệu thành công.');

        } catch (\Exception $e) {

            DB::rollBack();

            if (isset($path) && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
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
        ->with('documentVersions')
        ->findOrFail($id);

    // Không cho xóa nếu tài liệu đã được sử dụng
  if (
    $document->download_count > 0 ||
    $document->view_count > 0
) {

    return back()->with(
        'error',
        'Không thể xóa vĩnh viễn vì tài liệu đã được sử dụng. Bạn chỉ có thể giữ tài liệu trong thùng rác hoặc khôi phục lại.'
    );

}

    // Xóa tất cả file vật lý
    foreach ($document->documentVersions as $version) {

        if (
            $version->file_path &&
            Storage::disk('public')->exists($version->file_path)
        ) {
            Storage::disk('public')->delete($version->file_path);
        }

        // Xóa luôn file preview nếu có
        if (
            $version->preview_file &&
            Storage::disk('public')->exists($version->preview_file)
        ) {
            Storage::disk('public')->delete($version->preview_file);
        }
    }

    // Xóa vĩnh viễn khỏi CSDL
    $document->forceDelete();

    return back()->with(
        'success',
        'Đã xóa vĩnh viễn tài liệu.'
    );
}
}