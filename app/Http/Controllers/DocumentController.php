<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Subject;
use App\Models\Faculty;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\DocumentVersion;
use App\Models\DownloadHistory;
use App\Models\User;
use App\Models\SubjectTeacher;
use App\Jobs\GeneratePreviewJob;
use App\Services\DocumentPreviewService;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    private DocumentPreviewService $previewService;

public function __construct(DocumentPreviewService $previewService)
{
    $this->previewService = $previewService;
}
    public function index(Request $request)
    {
        $query = Document::with([
            'subject',
            'documentType',
            'uploader',
            'currentVersion'
        ])
        ->where('is_active', true);

        /*
        |--------------------------------------------------------------------------
        | Keyword
        |--------------------------------------------------------------------------
        */

        if ($request->filled('keyword')) {

            $keyword = trim($request->keyword);

            $query->where(function ($q) use ($keyword) {

                $q->where('title', 'like', "%{$keyword}%")
                ->orWhere('description', 'like', "%{$keyword}%")

                ->orWhereHas('subject', function ($sub) use ($keyword) {

                        $sub->where('subject_name', 'like', "%{$keyword}%")
                            ->orWhere('subject_code', 'like', "%{$keyword}%");

                })

                ->orWhereHas('documentType', function ($type) use ($keyword) {

                        $type->where('type_name', 'like', "%{$keyword}%");

                })

                ->orWhereHas('uploader', function ($user) use ($keyword) {

                        $user->where('full_name', 'like', "%{$keyword}%");

                });

            });
        }

        /*
        |--------------------------------------------------------------------------
        | Subject
        |--------------------------------------------------------------------------
        */

        if ($request->filled('subject_code')) {

            $query->where('subject_code', $request->subject_code);

        }

        /*
        |--------------------------------------------------------------------------
        | Document Type
        |--------------------------------------------------------------------------
        */

        if ($request->filled('document_type_id')) {

            $query->where(
                'document_type_id',
                $request->document_type_id
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Sort
        |--------------------------------------------------------------------------
        */

        switch ($request->sort) {

            case 'download':
                $query->orderByDesc('download_count');
                break;

            case 'az':
                $query->orderBy('title');
                break;

            default:
                $query->latest();
                break;
        }

        $documents = $query
            ->paginate(5)
            ->withQueryString();

        $subjects = Subject::where('status', 'active')
            ->orderBy('subject_name')
            ->get();

        $documentTypes = DocumentType::where('is_active', true)
            ->orderBy('type_name')
            ->get();

        $faculties = Faculty::where('is_active', true)
            ->orderBy('faculty_name')
            ->get();

        return view('documents.index', compact(
            'documents',
            'subjects',
            'documentTypes',
            'faculties'
        ));
    }
    public function edit(Document $document)
    {
        $document->load([
            'currentVersion',
            'subject.faculty',
            'documentType',
            'uploader',
        ]);

        $subjects = Subject::where('status', 'active')
            ->orderBy('subject_name')
            ->get();

        $documentTypes = DocumentType::where('is_active', true)
            ->orderBy('type_name')
            ->get();

        return view('documents.edit', [
            'document'      => $document,
            'subjects'      => $subjects,
            'documentTypes' => $documentTypes,
        ]);
    }
    public function update(Request $request, Document $document)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'subject_code'     => 'required|exists:subjects,subject_code',
            'document_type_id' => 'required|exists:document_types,document_type_id',
            'file'             => 'nullable|file|max:51200',
        ]);

        DB::beginTransaction();

        try {

            $document->update([
                'title'            => $request->title,
                'description'      => $request->description,
                'subject_code'     => $request->subject_code,
                'document_type_id' => $request->document_type_id,
                'updated_by'       => Auth::id(),
            ]);

            /*
            |--------------------------------------------------------------------------
            | Nếu có upload file mới
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('file')) {

                // Bỏ phiên bản cũ
                DocumentVersion::where(
                    'document_id',
                    $document->document_id
                )->update([
                    'is_current' => false
                ]);

                $file = $request->file('file');

                $extension = strtolower(
                    $file->getClientOriginalExtension()
                );

                $storedName =
                    time().'_'.
                    Str::random(10).
                    '.'.$extension;

                $filePath = $file->storeAs(
                    'documents',
                    $storedName,
                    'public'
                );
                                    /*
                    |--------------------------------------------------------------------------
                    | Tạo file preview
                    |--------------------------------------------------------------------------
                    */

                    $previewFile = null;

                    // PDF dùng luôn
                    if ($extension === 'pdf') {

                        $previewFile = $filePath;

                    }

                    // Ảnh dùng luôn
                    elseif (in_array($extension, [
                        'jpg',
                        'jpeg',
                        'png',
                        'gif',
                        'webp'
                    ])) {

                        $previewFile = $filePath;

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
                            ->convertToPdf($filePath);

                    }

                $latestVersion = DocumentVersion::where(
                    'document_id',
                    $document->document_id
                )->count();

              DocumentVersion::create([

                'document_id'        => $document->document_id,

                'version_name'       => ($latestVersion + 1).'.0',

                'version_note'       => 'Updated version',

                'original_file_name' => $file->getClientOriginalName(),

                'stored_file_name'   => $storedName,

                'file_path'          => $filePath,

                'preview_file'       => $previewFile,

                'file_extension'     => $extension,

                'file_size'          => $file->getSize(),

                'uploaded_by'        => Auth::id(),

                'is_current'         => true,

            ]);
            }

            DB::commit();

            return redirect()
                ->route('documents.show', $document)
                ->with('success', 'Cập nhật tài liệu thành công.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
    public function destroy(Document $document)
    {
        DB::beginTransaction();

        try {

            // Khóa tài liệu
            $document->update([
                'is_active' => false,
                'deleted_by' => Auth::id(),
            ]);

            // Soft Delete
            $document->delete();

            DB::commit();

            return redirect()
                ->route('documents.index')
                ->with('success', 'Đã xóa tài liệu.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }
    public function search(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Query
        |--------------------------------------------------------------------------
        */

        $query = Document::with([
                'subject',
                'currentVersion',
                'documentType',
                'uploader'
            ])
            ->where('is_active', true)
            ->whereHas('currentVersion')
            ->whereHas('subject', function ($q) {
                $q->where('status', 'active');
            });

        /*
        |--------------------------------------------------------------------------
        | Keyword
        |--------------------------------------------------------------------------
        */

        if ($request->filled('keyword')) {

            $keyword = trim($request->keyword);

            $query->where(function ($q) use ($keyword) {

                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%")

                  ->orWhereHas('subject', function ($sub) use ($keyword) {

                        $sub->where('subject_name', 'like', "%{$keyword}%")
                            ->orWhere('subject_code', 'like', "%{$keyword}%");

                  })

                  ->orWhereHas('documentType', function ($type) use ($keyword) {

                        $type->where('type_name', 'like', "%{$keyword}%");

                  })

                  ->orWhereHas('uploader', function ($user) use ($keyword) {

                        $user->where('full_name', 'like', "%{$keyword}%");

                  });

            });
        }

        /*
        |--------------------------------------------------------------------------
        | Subject
        |--------------------------------------------------------------------------
        */

        if ($request->filled('subject_code')) {

            $query->where(
                'subject_code',
                $request->subject_code
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Document Type
        |--------------------------------------------------------------------------
        */

        if ($request->filled('document_type_id')) {

            $query->where(
                'document_type_id',
                $request->document_type_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Faculty
        |--------------------------------------------------------------------------
        */

        if ($request->filled('faculty_id')) {

            $query->whereHas('subject', function ($q) use ($request) {

                $q->where(
                    'faculty_id',
                    $request->faculty_id
                );

            });
        }

        /*
        |--------------------------------------------------------------------------
        | Sort
        |--------------------------------------------------------------------------
        */

        switch ($request->get('sort', 'latest')) {

            case 'download':

                $query->orderByDesc('download_count');

                break;

            case 'az':

                $query->orderBy('title');

                break;

            default:

                $query->latest();

                break;
        }

        /*
        |--------------------------------------------------------------------------
        | Documents
        |--------------------------------------------------------------------------
        */

        $documents = $query
            ->paginate(9)
            ->withQueryString();

        $totalResult = $documents->total();

        /*
        |--------------------------------------------------------------------------
        | Filter Data
        |--------------------------------------------------------------------------
        */

        $subjects = Subject::where('status', 'active')
            ->orderBy('subject_name')
            ->get();

        $documentTypes = DocumentType::where('is_active', true)
            ->orderBy('type_name')
            ->get();

        $faculties = Faculty::where('is_active', true)
            ->orderBy('faculty_name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Ajax
        |--------------------------------------------------------------------------
        */

        if ($request->ajax()) {

            return response()->view(
                'documents.search',
                compact(
                    'documents',
                    'subjects',
                    'documentTypes',
                    'faculties',
                    'totalResult'
                )
            );
        }

        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */

        return view(
            'documents.search',
            compact(
                'documents',
                'subjects',
                'documentTypes',
                'faculties',
                'totalResult'
            )
        );
    }
    public function myDocuments(Request $request)
    {
        $user = Auth::user();

        $query = Document::with([
            'subject',
            'documentType',
            'currentVersion'
        ])
        ->where('uploaded_by', $user->user_id)
        ->where('is_active', true);

        // Tìm kiếm
        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        // Môn học
        if ($request->filled('subject_code')) {
            $query->where('subject_code', $request->subject_code);
        }

        // Loại tài liệu
        if ($request->filled('document_type_id')) {
            $query->where('document_type_id', $request->document_type_id);
        }

        $myDocuments = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Danh sách môn học
        $subjects = Subject::where('status', 'active')
            ->orderBy('subject_name')
            ->get();

        // Danh sách loại tài liệu
        $documentTypes = DocumentType::where('is_active', true)
            ->orderBy('type_name')
            ->get();

        // Thống kê
        $totalDocuments = Document::where('uploaded_by', $user->user_id)
            ->where('is_active', true)
            ->count();

        $totalSubjects = SubjectTeacher::where('user_id', $user->user_id)
            ->count();

        $totalDownloads = Document::where('uploaded_by', $user->user_id)
            ->sum('download_count');

        // Nếu là Ajax chỉ trả về bảng
        if ($request->ajax()) {
            return view(
                'documents.partials.table',
                compact('myDocuments')
            );
        }

        return view(
            'documents.my-documents',
            compact(
                'myDocuments',
                'subjects',
                'documentTypes',
                'totalDocuments',
                'totalSubjects',
                'totalDownloads'
            )
        );
    }
    public function view(Document $document)
    {
        $version = $document->currentVersion;

        if (!$version) {
            abort(404);
        }

        $path = storage_path('app/public/' . $version->file_path);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
    public function show($id)
    {
        $document = Document::with([
            'subject.faculty',
            'documentType',
            'uploader',
            'currentVersion',
            'documentVersions'
        ])->findOrFail($id);

        // Tài liệu liên quan
        $relatedDocuments = Document::with([
                'subject',
                'documentType',
                'uploader',
                'currentVersion'
            ])
            ->where('document_id', '!=', $document->document_id)
            ->where('subject_code', $document->subject_code)
            ->where('is_active', true)
            ->latest()
            ->take(3)
            ->get();

        return view('documents.show', compact(
            'document',
            'relatedDocuments'
        ));
    }
    public function create()
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            abort(403);
        }

        $role = $user->role?->role_name;

        if ($role === 'admin') {

            // Admin được xem tất cả môn học
            $subjects = Subject::where('status', 'active')
                ->orderBy('subject_name')
                ->get();

        } elseif ($role === 'lecturer') {

            // Giảng viên chỉ xem môn được phân công
            $subjects = $user->subjects()
                ->where('subjects.status', 'active')
                ->orderBy('subjects.subject_name')
                ->get();

        } else {

            abort(403);

        }

        $documentTypes = DocumentType::where('is_active', true)
            ->orderBy('type_name')
            ->get();

        return view('documents.create', compact(
            'subjects',
            'documentTypes'
        ));
    }
    public function store(Request $request)
{
    $request->validate([
        'title'            => 'required|string|max:255',
        'description'      => 'nullable|string',
        'subject_code'     => 'required|exists:subjects,subject_code',
        'document_type_id' => 'required|exists:document_types,document_type_id',
        'file'             => 'required|file|max:51200',
    ]);

    $user = Auth::user();

    if (!$user instanceof User) {
        abort(403);
    }

    $subject = Subject::where(
        'subject_code',
        $request->subject_code
    )->firstOrFail();

    /*
    |--------------------------------------------------------------------------
    | Kiểm tra quyền upload
    |--------------------------------------------------------------------------
    */

    $canUpload = $user->role->role_name === 'admin';

    if (!$canUpload && $user->role->role_name === 'lecturer') {

        $canUpload = SubjectTeacher::where(
            'user_id',
            $user->user_id
        )
        ->where(
            'subject_code',
            $subject->subject_code
        )
        ->exists();
    }

    if (!$canUpload) {
        abort(403, 'Bạn không có quyền upload tài liệu cho môn học này.');
    }

    DB::beginTransaction();

    try {

        /*
        |--------------------------------------------------------------------------
        | Upload file
        |--------------------------------------------------------------------------
        */

        $file = $request->file('file');

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        $storedName =
            time() . '_' .
            Str::random(10) .
            '.' . $extension;

        $filePath = $file->storeAs(
            'documents',
            $storedName,
            'public'
        );

        /*
        |--------------------------------------------------------------------------
        | PDF và ảnh xem trực tiếp
        |--------------------------------------------------------------------------
        */

        $previewFile = null;

        if (
            $extension === 'pdf' ||
            in_array($extension, [
                'jpg',
                'jpeg',
                'png',
                'gif',
                'webp'
            ])
        ) {
            $previewFile = $filePath;
        }

        /*
        |--------------------------------------------------------------------------
        | Tạo tài liệu
        |--------------------------------------------------------------------------
        */

        $document = Document::create([

            'title'            => $request->title,
            'slug'             => Str::slug($request->title) . '-' . Str::random(6),
            'description'      => $request->description,
            'subject_code'     => $subject->subject_code,
            'document_type_id' => $request->document_type_id,
            'uploaded_by'      => $user->user_id,
            'is_active'        => true,

        ]);

        /*
        |--------------------------------------------------------------------------
        | Phiên bản đầu tiên
        |--------------------------------------------------------------------------
        */

        $version = DocumentVersion::create([

            'document_id'        => $document->document_id,
            'version_name'       => '1.0',
            'version_note'       => 'Initial version',

            'original_file_name' => $file->getClientOriginalName(),
            'stored_file_name'   => $storedName,

            'file_path'          => $filePath,
            'preview_file'       => $previewFile,

            'file_extension'     => $extension,
            'file_size'          => $file->getSize(),

            'uploaded_by'        => $user->user_id,
            'is_current'         => true,

        ]);

        DB::commit();

        /*
        |--------------------------------------------------------------------------
        | Convert Office sang PDF bằng Queue
        |--------------------------------------------------------------------------
        */

        if (in_array($extension, [
            'doc',
            'docx',
            'xls',
            'xlsx',
            'ppt',
            'pptx'
        ])) {

            GeneratePreviewJob::dispatch(
                $version->version_id
            );

        }

        return redirect()
            ->route('subjects.show', $subject->subject_code)
            ->with('success', 'Đăng tải tài liệu thành công.');

    } catch (\Throwable $e) {

        DB::rollBack();

        if (isset($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        Log::error('Upload document failed', [
            'message' => $e->getMessage(),
            'trace'   => $e->getTraceAsString(),
        ]);

        return back()
            ->withInput()
            ->with('error', 'Đã xảy ra lỗi khi đăng tải tài liệu.');

    }
}
    public function uploadVersion(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|max:51200',
            'version_note' => 'nullable|string|max:2000',
        ]);

        $document = Document::findOrFail($id);
        $user = Auth::user();

        DB::transaction(function () use ($document, $request, $user) {

            $file = $request->file('file');

            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $storedName = time().'_'.Str::random(10).'.'.$extension;

            $filePath = $file->storeAs('documents', $storedName, 'public');
            $previewFile = null;

            if (
                $extension === 'pdf' ||
                in_array($extension, [
                    'jpg',
                    'jpeg',
                    'png',
                    'gif',
                    'webp'
                ])
            ) {
                $previewFile = $filePath;
            }
            // 1. disable old version
            DocumentVersion::where('document_id', $document->document_id)
                ->update(['is_current' => false]);

            // 2. get next version safely
            $last = DocumentVersion::where('document_id', $document->document_id)
                ->orderByDesc('created_at')
                ->first();

            $nextVersionNumber = $last ? ((int)$last->id + 1) : 1;
            $versionName = $nextVersionNumber . '.0';

            // 3. create new version
            DocumentVersion::create([
                'document_id' => $document->document_id,
                'version_name' => $versionName,
                'version_note' => $request->version_note,
                'original_file_name' => $originalName,
                'stored_file_name' => $storedName,
                'file_path' => $filePath,
                'file_extension' => $extension,
                'file_size' => $file->getSize(),
                'uploaded_by' => $user->user_id,
                'is_current' => true,
            ]);
        });

        return back()->with('success', 'Tạo version mới thành công');
    }
    public function restoreVersion($versionId)
    {
        $version = DocumentVersion::findOrFail($versionId);

        DB::transaction(function () use ($version) {

            DocumentVersion::where('document_id', $version->document_id)
                ->update(['is_current' => false]);

            $version->update(['is_current' => true]);
        });

        return back()->with('success', 'Restore thành công');
    }
    public function download(Document $document)
    {
        if (!$document->is_active) {
            abort(404);
        }

        $version = $document->currentVersion;

        if (!$version) {
            abort(404, 'Không tìm thấy file.');
        }

        if (!Storage::disk('public')->exists($version->file_path)) {
            abort(404, 'File không tồn tại.');
        }

        // Tăng lượt tải
        $document->increment('download_count');

        // Lưu lịch sử tải
        DownloadHistory::create([
            'user_id'       => Auth::id(),
            'version_id'    => $version->version_id,
            'downloaded_at' => now(),
        ]);

        // Trả file về cho người dùng
        return response()->download(
            Storage::disk('public')->path($version->file_path),
            $version->original_file_name
        );
    }
}