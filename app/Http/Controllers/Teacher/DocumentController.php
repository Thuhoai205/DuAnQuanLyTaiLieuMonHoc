<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;


class DocumentController extends Controller
{
    public function myDocuments()
    {
        $myDocuments = Document::with('subject')
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
            'currentVersion'
        ])->findOrFail($id);

        return view('documents.show', compact('document'));
        
    }
}