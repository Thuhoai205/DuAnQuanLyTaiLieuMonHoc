<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('role');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role_id')) {
            $query->where('role_id', $request->role_id);
        }

        $users = $query
            ->orderByDesc('user_id')
            ->paginate(3)
            ->withQueryString();

        $roles = Role::all();

        $totalUsers = User::count();

        $totalTeachers = User::where('role_id', 2)->count();

        $totalStudents = User::where('role_id', 3)->count();

        $totalTrashedUsers = User::onlyTrashed()->count();

        return view('admin.users.index', compact(
            'users',
            'roles',
            'totalUsers',
            'totalTeachers',
            'totalStudents',
            'totalTrashedUsers'
        ));
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => [
                'required',
                'string',
                'max:50',
                'unique:users,username',
            ],
            'full_name' => [
                'required',
                'string',
                'max:100',
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
            ],
            'role_id' => [
                'required',
                'exists:roles,role_id',
            ],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ], [
            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'username.unique' => 'Tên đăng nhập đã tồn tại.',
            'full_name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'role_id.required' => 'Vui lòng chọn vai trò.',
            'role_id.exists' => 'Vai trò không hợp lệ.',
            'avatar.image' => 'Avatar phải là hình ảnh.',
            'avatar.mimes' => 'Avatar phải có định dạng jpg, jpeg, png hoặc webp.',
            'avatar.max' => 'Avatar không được vượt quá 2MB.',
        ]);

        $avatarPath = null;

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        User::create([
            'username' => $request->username,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'avatar' => $avatarPath,
            'is_active' => $request->boolean('is_active'),
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Thêm người dùng thành công.');
    }

    public function show(string $id)
    {
        $user = User::with([
            'role',
            'uploadedDocuments.currentVersion',
            'subjects',
            'downloadHistories',
            'activityLogs',
            'favorites',
            'searchHistories',
        ])->findOrFail($id);

        $totalDocuments = $user->uploadedDocuments->count();

        $totalSubjects = $user->subjects->count();

        $totalDownloads = $user->downloadHistories->count();

        $totalFavorites = $user->favorites->count();

        $totalLogs = $user->activityLogs->count();

        $totalSearches = $user->searchHistories->count();

        return view('admin.users.show', compact(
            'user',
            'totalDocuments',
            'totalSubjects',
            'totalDownloads',
            'totalFavorites',
            'totalLogs',
            'totalSearches'
        ));
    }

    public function edit(string $id)
    {
        $user = User::with('role')->findOrFail($id);

        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users', 'username')->ignore($user->user_id, 'user_id'),
            ],
            'full_name' => [
                'required',
                'string',
                'max:100',
            ],
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($user->user_id, 'user_id'),
            ],
            'role_id' => [
                'required',
                'exists:roles,role_id',
            ],
            'password' => [
                'nullable',
                'string',
                'min:6',
            ],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ], [
            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'username.unique' => 'Tên đăng nhập đã tồn tại.',
            'full_name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'role_id.required' => 'Vui lòng chọn vai trò.',
            'role_id.exists' => 'Vai trò không hợp lệ.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'avatar.image' => 'Avatar phải là hình ảnh.',
            'avatar.mimes' => 'Avatar phải có định dạng jpg, jpeg, png hoặc webp.',
            'avatar.max' => 'Avatar không được vượt quá 2MB.',
        ]);

        $user->username = $request->username;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->is_active = $request->boolean('is_active');
        $user->updated_by = Auth::id();

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Cập nhật người dùng thành công.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->user_id == Auth::id()) {
            return back()->with('error', 'Bạn không thể tự xóa tài khoản của mình.');
        }

        if ($user->role_id == 1) {
            $adminCount = User::where('role_id', 1)->count();

            if ($adminCount <= 1) {
                return back()->with('error', 'Hệ thống phải có ít nhất một tài khoản quản trị.');
            }
        }

        $user->update([
            'deleted_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Xóa người dùng thành công.');
    }

    public function toggleStatus(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->user_id == Auth::id()) {
            return back()->with('error', 'Bạn không thể tự khóa tài khoản của mình.');
        }

        $user->update([
            'is_active' => !$user->is_active,
            'updated_by' => Auth::id(),
        ]);

        return back()
            ->with('success', 'Cập nhật trạng thái thành công.');
    }

    public function uploadAvatar(Request $request, string $id)
    {
        $request->validate([
            'avatar' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'avatar.required' => 'Vui lòng chọn ảnh đại diện.',
            'avatar.image' => 'Avatar phải là hình ảnh.',
            'avatar.mimes' => 'Avatar phải có định dạng jpg, jpeg, png hoặc webp.',
            'avatar.max' => 'Avatar không được vượt quá 2MB.',
        ]);

        $user = User::findOrFail($id);

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->update([
            'avatar' => $request->file('avatar')->store('avatars', 'public'),
            'updated_by' => Auth::id(),
        ]);

        return back()
            ->with('success', 'Cập nhật avatar thành công.');
    }

    public function trashed()
    {
        $users = User::onlyTrashed()
            ->with('role')
            ->orderByDesc('deleted_at')
            ->paginate(10);

        return view('admin.users.trashed', compact('users'));
    }

    public function restore(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        $user->restore();

        $user->update([
            'deleted_by' => null,
            'updated_by' => Auth::id(),
        ]);

        return redirect()
            ->route('admin.users.trashed')
            ->with('success', 'Khôi phục người dùng thành công.');
    }

    public function restoreMultiple(Request $request)
    {
        $ids = $request->user_ids ?? [];

        if (empty($ids)) {
            return back()->with('error', 'Vui lòng chọn ít nhất một người dùng.');
        }

        $users = User::onlyTrashed()
            ->whereIn('user_id', $ids)
            ->get();

        foreach ($users as $user) {
            $user->restore();

            $user->update([
                'deleted_by' => null,
                'updated_by' => Auth::id(),
            ]);
        }

        return redirect()
            ->route('admin.users.trashed')
            ->with('success', 'Khôi phục các người dùng đã chọn thành công.');
    }
}