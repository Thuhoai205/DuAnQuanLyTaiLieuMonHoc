<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\SubjectFollow;
use Illuminate\Support\Facades\Auth;

class SubjectFollowController extends Controller
{
    /**
     * Danh sách môn học đang theo dõi
     */
    public function index()
    {
        $subjectCodes = SubjectFollow::where('user_id', Auth::id())
            ->pluck('subject_code');

        $subjects = Subject::whereIn('subject_code', $subjectCodes)
            ->withCount('documents')
            ->orderBy('subject_name')
            ->paginate(12);

        return view('subjects.following', compact('subjects'));
    }

    /**
     * Theo dõi môn học
     */
    public function store($subject_code)
    {
        SubjectFollow::firstOrCreate([
            'user_id'      => Auth::id(),
            'subject_code' => $subject_code,
        ]);

        return back()->with('success', 'Đã theo dõi môn học.');
    }

    /**
     * Bỏ theo dõi môn học
     */
    public function destroy($subject_code)
    {
        SubjectFollow::where('user_id', Auth::id())
            ->where('subject_code', $subject_code)
            ->delete();

        return back()->with('success', 'Đã bỏ theo dõi môn học.');
    }
}