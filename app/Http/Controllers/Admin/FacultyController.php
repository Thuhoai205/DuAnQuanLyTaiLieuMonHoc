<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faculty;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = Faculty::withCount('subjects')
            ->latest()
            ->paginate(10);

        return view('admin.faculties.index', compact('faculties'));
    }
}