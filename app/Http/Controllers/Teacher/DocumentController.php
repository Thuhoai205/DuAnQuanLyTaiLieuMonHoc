<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\DocumentVersion;

class DocumentController extends Controller
{
    public function myDocuments()
    {
        $myDocuments = Document::with([
            'subject',
            'documentType',
            'currentVersion'
        ])
        ->where('uploaded_by', Auth::id())
        ->latest()
        ->get();

        return view('documents.my-documents', compact('myDocuments'));
    }

    public function show($id)
    {
        $document = Document::with([
            'subject',
            'documentType',
            'uploader',
            'currentVersion',
            'versions'
        ])->findOrFail($id);

        return view('documents.show', compact('document'));
    }

    public function create()
    {
        $user = Auth::user();

        $subjects = $user->subjects()->orderBy('subject_name')->get();

        $documentTypes = DocumentType::where('is_active', true)
            ->orderBy('type_name')
            ->get();

        return view('documents.create', compact('subjects', 'documentTypes'));
    }

    /*
    |-----------------------------
    | STORE (VERSION 1)
    |-----------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'file' => 'required|file|max:51200',
            'subject_code' => 'required',
            'document_type_id' => 'required',
        ]);

        $user = Auth::user();

        DB::beginTransaction();

        try {

            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $storedName = time().'_'.Str::random(10).'.'.$extension;

            $filePath = $file->storeAs('documents', $storedName, 'public');

            $document = Document::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title).'-'.time(),
                'description' => $request->description,
                'subject_code' => $request->subject_code,
                'document_type_id' => $request->document_type_id,
                'uploaded_by' => $user->user_id,
                'is_active' => true,
            ]);

            // tắt tất cả (an toàn)
            DocumentVersion::where('document_id', $document->document_id)
                ->update(['is_current' => false]);

            DocumentVersion::create([
                'document_id' => $document->document_id,
                'version_name' => '1.0',
                'version_note' => 'Initial version',
                'original_file_name' => $originalName,
                'stored_file_name' => $storedName,
                'file_path' => $filePath,
                'file_extension' => $extension,
                'file_size' => $file->getSize(),
                'uploaded_by' => $user->user_id,
                'is_current' => true,
            ]);

            DB::commit();

            return redirect()->route('documents.show', $document->document_id)
                ->with('success', 'Upload thành công');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /*
    |-----------------------------
    | UPLOAD VERSION (FIXED)
    |-----------------------------
    */
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

    /*
    |-----------------------------
    | RESTORE VERSION
    |-----------------------------
    */
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

    /*
    |-----------------------------
    | DOWNLOAD (SAFE)
    |-----------------------------
    */
    public function download($id)
    {
        $document = Document::with('currentVersion')->findOrFail($id);

        if (!$document->currentVersion) {
            return back()->with('error', 'Không có file');
        }

        return Storage::disk('public')->download(
            $document->currentVersion->file_path,
            $document->currentVersion->original_file_name
        );
    }
}