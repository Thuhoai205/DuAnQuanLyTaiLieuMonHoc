<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Subject;
use App\Models\Faculty;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
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
            ->paginate(12)
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
}