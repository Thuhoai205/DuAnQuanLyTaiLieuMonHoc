<?php

namespace App\Http\Controllers;

use App\Models\DownloadHistory;
use Illuminate\Support\Facades\Auth;

class DownloadController extends Controller
{
    public function history()
    {
        $histories = DownloadHistory::with([
            'version.document.subject',
            'version.document.documentType',
        ])
        ->where('user_id', Auth::id())
        ->latest('downloaded_at')
        ->paginate(10);

        return view(
            'downloads.history',
            compact('histories')
        );
    }
    
}