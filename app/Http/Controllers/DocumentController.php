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
use App\Models\SearchHistory;
use App\Models\SubjectFollow;
use App\Models\Notification;
use App\Mail\NewDocumentMail;

use Illuminate\Support\Facades\Mail;

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
        | Phân quyền theo khoa
        |--------------------------------------------------------------------------
        */

        if (Auth::check()) {

            $user = Auth::user();

            // Giảng viên
            if ($user->role->role_name === 'lecturer') {

                $query->whereHas('subject', function ($q) use ($user) {

                    $q->where('faculty_id', $user->faculty_id);

                });

            }

            // Sinh viên
            elseif ($user->role->role_name === 'student') {

                $query->whereHas('subject', function ($q) use ($user) {

                    $q->where('faculty_id', $user->faculty_id);

                });

            }

          // Admin không lọc

        }   

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
            ->paginate(10)
            ->withQueryString();
        /*
        |--------------------------------------------------------------------------
        | Lưu lịch sử tìm kiếm
        |--------------------------------------------------------------------------
        */
        if ($request->filled('keyword')) {

            $keyword = trim($request->keyword);

            $lastSearch = SearchHistory::where('user_id', Auth::id())
                ->where('keyword', $keyword)
                ->where('searched_at', '>=', now()->subMinutes(5))
                ->first();

            if (!$lastSearch) {

            SearchHistory::create([
                'user_id'          => Auth::id(),
                'faculty_id'       => Auth::check() ? Auth::user()->faculty_id : null,
                'keyword'          => trim($request->keyword),
                'subject_code'     => $request->subject_code,
                'document_type_id' => $request->document_type_id,
                'result_count'     => $documents->total(),
                'searched_at'      => now(),
            ]);


            }

        }
            $subjectsQuery = Subject::where('status', 'active');

        if (Auth::check()) {

            $user = Auth::user();

            if (in_array($user->role->role_name, ['lecturer', 'student'])) {

                $subjectsQuery->where(
                    'faculty_id',
                    $user->faculty_id
                );

            }

        }

        $subjects = $subjectsQuery
            ->orderBy('subject_name')
            ->get();

        $documentTypes = DocumentType::where('is_active', true)
            ->orderBy('type_name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Top từ khóa tìm kiếm
        |--------------------------------------------------------------------------
        */

        $topKeywords = SearchHistory::select(
                'keyword',
                DB::raw('COUNT(*) as total')
            )
            ->whereNotNull('keyword')
            ->where('keyword', '<>', '')
            ->groupBy('keyword')
            ->orderByDesc('total')
            ->limit(10)
            ->get();     

                return view('documents.index', compact(
            'documents',
            'subjects',
            'documentTypes',
            'topKeywords'
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

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Phân quyền
        |--------------------------------------------------------------------------
        */

        if ($user->role->role_name === 'student') {

            abort(403);

        }

        // Giảng viên chỉ được sửa tài liệu của mình
        if (
            $user->role->role_name === 'lecturer' &&
            $document->uploaded_by != $user->user_id
        ) {

            abort(403);

        }

        /*
        |--------------------------------------------------------------------------
        | Danh sách môn học
        |--------------------------------------------------------------------------
        */

        if ($user->role->role_name === 'admin') {

            $subjects = Subject::where('status', 'active')
                ->orderBy('subject_name')
                ->get();

        } else {

            // Giảng viên chỉ thấy môn của khoa mình
            $subjects = Subject::where('status', 'active')
                ->where('faculty_id', $user->faculty_id)
                ->orderBy('subject_name')
                ->get();

        }

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
                $subject = Subject::with('faculty')
                ->where('subject_code', $request->subject_code)
                ->firstOrFail();

                $facultyFolder = Str::slug($subject->faculty->faculty_name);

                $subjectFolder = Str::slug($subject->subject_name);

                $documentFolder = 'document_' . $document->document_id;

                $folder = "documents/{$facultyFolder}/{$subjectFolder}/{$documentFolder}";

                $file = $request->file('file');

                $extension = strtolower(
                    $file->getClientOriginalExtension()
                );

               $latestVersion = DocumentVersion::where(
                    'document_id',
                    $document->document_id
                )->count();

                $versionName = ($latestVersion + 1);

                $storedName = "version_{$versionName}.{$extension}";

                $filePath = $file->storeAs(
                    $folder,
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
        /*
        |--------------------------------------------------------------------------
        | Kiểm tra quyền
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();

        // Giảng viên chỉ được xóa tài liệu của mình
        if (
            $user->role->role_name === 'lecturer' &&
            $document->uploaded_by != $user->user_id
        ) {

            abort(403);

        }

        // Sinh viên không được xóa
        if ($user->role->role_name === 'student') {

            abort(403);

        }

        DB::beginTransaction();

        try {

            $document->update([
                'is_active'  => false,
                'deleted_by' => $user->user_id,
                'updated_by' => $user->user_id,
            ]);

            $document->delete();

            DB::commit();

            return redirect()
                ->route('documents.index')
                ->with(
                    'success',
                    'Đã chuyển tài liệu vào thùng rác.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Không thể xóa tài liệu: '.$e->getMessage()
            );

        }
    }
    public function destroyMyDocument(Document $document)
    {
        $user = Auth::user();

        if (
            $user->role->role_name !== 'lecturer' ||
            $document->uploaded_by != $user->user_id
        ) {
            abort(403);
        }

        DB::beginTransaction();

        try {

            $document->update([
                'is_active'  => false,
                'deleted_by' => $user->user_id,
                'updated_by' => $user->user_id,
            ]);

            $document->delete();

            DB::commit();

            return redirect()
                ->route('documents.my-documents')
                ->with('success', 'Đã chuyển tài liệu vào thùng rác.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Không thể xóa tài liệu: ' . $e->getMessage()
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
        | Phân quyền theo khoa
        |--------------------------------------------------------------------------
        */

        if (Auth::check()) {

            $user = Auth::user();

            // Giảng viên
            if ($user->role->role_name === 'lecturer') {

                $query->whereHas('subject', function ($q) use ($user) {

                    $q->where('faculty_id', $user->faculty_id);

                });

            }

            // Sinh viên
            elseif ($user->role->role_name === 'student') {

                $query->whereHas('subject', function ($q) use ($user) {

                    $q->where('faculty_id', $user->faculty_id);

                });

            }

            // Admin không cần lọc

        }

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
        /*
        |--------------------------------------------------------------------------
        | Lưu lịch sử tìm kiếm
        |--------------------------------------------------------------------------
        */
        if ($request->filled('keyword')) {

            $keyword = trim($request->keyword);

            $lastSearch = SearchHistory::where('user_id', Auth::id())
                ->where('keyword', $keyword)
                ->where('searched_at', '>=', now()->subMinutes(5))
                ->first();

            if (!$lastSearch) {

            SearchHistory::create([
                'user_id'          => Auth::id(),
                'faculty_id'       => Auth::check() ? Auth::user()->faculty_id : null,
                'keyword'          => trim($request->keyword),
                'subject_code'     => $request->subject_code,
                'document_type_id' => $request->document_type_id,
                'result_count'     => $documents->total(),
                'searched_at'      => now(),
            ]);


            }

        }

        $totalResult = $documents->total();

        /*
        |--------------------------------------------------------------------------
        | Filter Data
        |--------------------------------------------------------------------------
        */

        $subjects = Subject::where('status', 'active');

        if (Auth::check()) {

            $user = Auth::user();

            if (in_array($user->role->role_name, ['lecturer', 'student'])) {

                $subjects->where(
                    'faculty_id',
                    $user->faculty_id
                );

            }

        }

        $subjects = $subjects
            ->orderBy('subject_name')
            ->get();

        $documentTypes = DocumentType::where('is_active', true)
            ->orderBy('type_name')
            ->get();
        /*
        |--------------------------------------------------------------------------
        | Top từ khóa tìm kiếm
        |--------------------------------------------------------------------------
        */

        $topKeywords = SearchHistory::select(
                'keyword',
                DB::raw('COUNT(*) as total')
        )
        ->whereNotNull('keyword')
        ->where('keyword', '<>', '')
        ->groupBy('keyword')
        ->orderByDesc('total')
        ->limit(10)
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

        /*
        |--------------------------------------------------------------------------
        | Query
        |--------------------------------------------------------------------------
        */

        $query = Document::with([
            'subject',
            'documentType',
            'currentVersion',
            'documentVersions',
        ])
        ->where('uploaded_by', $user->user_id)
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
                ->orWhere('description', 'like', "%{$keyword}%");

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
        | Documents
        |--------------------------------------------------------------------------
        */

        $documents = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Subjects
        |--------------------------------------------------------------------------
        */

        $subjects = Subject::where('status', 'active');

        if ($user->role->role_name === 'lecturer') {

            $subjects->where(
                'faculty_id',
                $user->faculty_id
            );

        }

        $subjects = $subjects
            ->orderBy('subject_name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Document Types
        |--------------------------------------------------------------------------
        */

        $documentTypes = DocumentType::where('is_active', true)
            ->orderBy('type_name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalDocuments = Document::where(
            'uploaded_by',
            $user->user_id
        )
        ->where('is_active', true)
        ->count();

        $totalViews = Document::where(
            'uploaded_by',
            $user->user_id
        )
        ->where('is_active', true)
        ->sum('view_count');

        $totalDownloads = Document::where(
            'uploaded_by',
            $user->user_id
        )
        ->where('is_active', true)
        ->sum('download_count');

        $totalSubjects = SubjectTeacher::where(
            'user_id',
            $user->user_id
        )->count();

        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */

        if ($request->ajax()) {

        return response()->view(
            'documents.my-documents',
            compact(
                'documents',
                'subjects',
                'documentTypes',
                'totalDocuments',
                'totalViews',
                'totalDownloads',
                'totalSubjects'
            )
        );

        }

        return view(
            'documents.my-documents',
            compact(
                'documents',
                'subjects',
                'documentTypes',
                'totalDocuments',
                'totalViews',
                'totalDownloads',
                'totalSubjects'
            )
        );
    }
    public function trash()
    {
        $documents = Document::onlyTrashed()
            ->where('uploaded_by', Auth::id())
            ->latest()
            ->paginate(10);

        return view('documents.trash', compact('documents'));
    }
    public function restore($document)
    {
        $document = Document::onlyTrashed()
            ->where('document_id', $document)
            ->where('uploaded_by', Auth::id())
            ->firstOrFail();

        $document->restore();

        return redirect()
            ->route('documents.trash')
            ->with('success', 'Khôi phục tài liệu thành công.');
    }
    public function view(Document $document)
    {
        /*
        |--------------------------------------------------------------------------
        | Kiểm tra tài liệu
        |--------------------------------------------------------------------------
        */

        if (
            !$document->is_active ||
            !$document->subject ||
            $document->subject->status !== 'active'
        ) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Phân quyền
        |--------------------------------------------------------------------------
        */

        if (Auth::check()) {

            $user = Auth::user();

            // Sinh viên chỉ xem tài liệu thuộc khoa mình
            if ($user->role->role_name === 'student') {

                if ($document->subject->faculty_id != $user->faculty_id) {
                    abort(403);
                }

            }

            // Giảng viên chỉ xem tài liệu thuộc khoa mình
            elseif ($user->role->role_name === 'lecturer') {

                if ($document->subject->faculty_id != $user->faculty_id) {
                    abort(403);
                }

            }

            // Admin xem tất cả
        }

        /*
        |--------------------------------------------------------------------------
        | File
        |--------------------------------------------------------------------------
        */

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
            'documentVersions',
            'comments'
        ])
        ->withCount([
            'favorites',
            'comments'
        ])
        ->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Kiểm tra trạng thái
        |--------------------------------------------------------------------------
        */

        if (
            !$document->is_active ||
            !$document->subject ||
            $document->subject->status !== 'active'
        ) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Phân quyền
        |--------------------------------------------------------------------------
        */

        if (Auth::check()) {

            $user = Auth::user();

            // Giảng viên
            if ($user->role->role_name === 'lecturer') {

                if ($document->subject->faculty_id != $user->faculty_id) {
                    abort(403);
                }

            }

            // Sinh viên
            elseif ($user->role->role_name === 'student') {

                if ($document->subject->faculty_id != $user->faculty_id) {
                    abort(403);
                }

            }

            // Admin được xem tất cả
        }

        /*
        |--------------------------------------------------------------------------
        | Tăng lượt xem (chỉ tính 1 lần mỗi phiên)
        |--------------------------------------------------------------------------
        */

        $sessionKey = 'viewed_document_' . $document->document_id;

        if (!session()->has($sessionKey)) {

            $document->increment('view_count');

            session()->put($sessionKey, true);

        }

        /*
        |--------------------------------------------------------------------------
        | Tài liệu liên quan
        |--------------------------------------------------------------------------
        */

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

            // Admin xem tất cả môn
            $subjects = Subject::where('status', 'active')
                ->orderBy('subject_name')
                ->get();

        } elseif ($role === 'lecturer') {

            // Giảng viên xem tất cả môn thuộc khoa mình
            $subjects = Subject::where('status', 'active')
                ->where('faculty_id', $user->faculty_id)
                ->with('lecturers')
                ->orderBy('subject_name')
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

        $subject = Subject::with('faculty')
            ->where('subject_code', $request->subject_code)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Kiểm tra quyền upload
        |--------------------------------------------------------------------------
        */

        $canUpload = false;

        // Admin
        if ($user->role->role_name === 'admin') {

            $canUpload = true;

        }

        // Giảng viên
        elseif ($user->role->role_name === 'lecturer') {

            // Không được upload sang khoa khác
            if ($subject->faculty_id != $user->faculty_id) {

                abort(403, 'Bạn không thuộc khoa quản lý môn học này.');

            }

            // Chỉ được upload khi được phân công môn học
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

        // Sinh viên
        else {

            abort(403);

        }

        if (!$canUpload) {

            abort(403, 'Bạn chưa được phân công giảng dạy môn học này.');

        }

        DB::beginTransaction();

        try {
            /*
        |--------------------------------------------------------------------------
        | Tạo Document trước để lấy document_id
        |--------------------------------------------------------------------------
        */

        $document = Document::create([

            'title'            => $request->title,

            'slug'             => Str::slug($request->title).'-'.Str::random(6),

            'description'      => $request->description,

            'subject_code'     => $subject->subject_code,

            'document_type_id' => $request->document_type_id,

            'uploaded_by'      => $user->user_id,

            'is_active'        => true,

        ]);

        /*
        |--------------------------------------------------------------------------
        | Tạo thư mục lưu file
        |--------------------------------------------------------------------------
        */

        $facultyFolder = Str::slug($subject->faculty->faculty_name);

        $subjectFolder = Str::slug($subject->subject_name);

        $documentFolder = 'document_'.$document->document_id;

        $folder = "documents/{$facultyFolder}/{$subjectFolder}/{$documentFolder}";

        /*
        |--------------------------------------------------------------------------
        | Upload file
        |--------------------------------------------------------------------------
        */

        $file = $request->file('file');

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        /*
        |--------------------------------------------------------------------------
        | Phiên bản đầu tiên
        |--------------------------------------------------------------------------
        */

        $storedName = "version_1.{$extension}";

        /*
        |--------------------------------------------------------------------------
        | Lưu file vào đúng thư mục
        |--------------------------------------------------------------------------
        */

        $filePath = $file->storeAs(
            $folder,
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
                'webp',
            ])
        ) {

            $previewFile = $filePath;

        }
        /*
        |--------------------------------------------------------------------------
        | Tạo Preview cho Office
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

            // Sẽ được GeneratePreviewJob chuyển sang PDF
            $previewFile = null;

        }

        /*
        |--------------------------------------------------------------------------
        | Lưu phiên bản đầu tiên
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
                /*
                |--------------------------------------------------------------------------
                | Commit
                |--------------------------------------------------------------------------
                */

                DB::commit();
        $follows = SubjectFollow::with('user')
            ->where('subject_code', $subject->subject_code)
            ->get();

        foreach ($follows as $follow) {

            // Không gửi cho chính người upload
            if ($follow->user_id == $user->user_id) {
                continue;
            }

            // Thông báo trong hệ thống
            Notification::create([
                'user_id'      => $follow->user_id,
                'title'        => 'Có tài liệu mới',
                'content'      => 'Môn học "' . $subject->subject_name .
                                '" vừa có tài liệu mới: "' . $document->title . '".',
                'type'         => 'new_document',
                'related_type' => 'document',
                'related_id'   => $document->document_id,
            ]);

            // Gửi email
            if (!empty($follow->user?->email)) {

                Mail::to($follow->user->email)
                    ->queue(
                        new NewDocumentMail(
                            $follow->user,
                            $subject,
                            $document
                        )
                    );
            }
        }
                /*
                |--------------------------------------------------------------------------
                | Generate Preview (Office)
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

                /*
                |--------------------------------------------------------------------------
                | Xóa file nếu upload lỗi
                |--------------------------------------------------------------------------
                */

                if (isset($filePath)) {

                    Storage::disk('public')->delete($filePath);

                }

                /*
                |--------------------------------------------------------------------------
                | Xóa document nếu đã tạo
                |--------------------------------------------------------------------------
                */

                if (isset($document)) {

                    $document->forceDelete();

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