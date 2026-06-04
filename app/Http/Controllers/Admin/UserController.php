<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Danh sách người dùng
     */
    public function index(Request $request)
    {
        $query = User::with('role');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role_id')) {
            $query->where('role_id', $request->role_id);
        }

        $users = $query->latest('user_id')
            ->paginate(10)
            ->withQueryString();

        $roles = Role::all();

        $totalUsers = User::count();
        $totalTeachers = User::where('role_id', 2)->count();
        $totalStudents = User::where('role_id', 3)->count();

        return view('admin.users.index', compact(
            'users',
            'roles',
            'totalUsers',
            'totalTeachers',
            'totalStudents'
        ));
    }

    /**
     * Form thêm người dùng
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Lưu người dùng
     */
    public function store(Request $request)
    {
        $request->validate([
            'username'  => 'required|string|max:50|unique:users,username',
            'full_name' => 'required|string|max:100',
            'email'     => 'required|email|max:100|unique:users,email',
            'password'  => 'required|string|min:6',
            'role_id'   => 'required|exists:roles,role_id',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $avatarPath = null;

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')
                ->store('avatars', 'public');
        }

        User::create([
            'username'  => $request->username,
            'full_name' => $request->full_name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'role_id'   => $request->role_id,
            'avatar'    => $avatarPath,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Thêm người dùng thành công');
    }

    /**
     * Chi tiết người dùng
     */
    public function show(string $id)
    {
        $user = User::with([
            'role',
            'documents',
            'subjects',
            'downloadHistories',
            'activityLogs',
            'favorites',
            'searchHistories',
        ])->findOrFail($id);

        $totalDocuments = $user->documents->count();
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

    /**
     * Form sửa người dùng
     */
    public function edit(string $id)
    {
        $user = User::with('role')->findOrFail($id);

        $roles = Role::all();

        return view('admin.users.edit', compact(
            'user',
            'roles'
        ));
    }

    /**
     * Cập nhật người dùng
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username'  => 'required|string|max:50|unique:users,username,' . $id . ',user_id',
            'full_name' => 'required|string|max:100',
            'email'     => 'required|email|max:100|unique:users,email,' . $id . ',user_id',
            'role_id'   => 'required|exists:roles,role_id',
            'password'  => 'nullable|string|min:6',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $user->username = $request->username;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->is_active = $request->boolean('is_active');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->avatar = $request->file('avatar')
                ->store('avatars', 'public');
        }

        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Cập nhật người dùng thành công');
    }

    /**
     * Xóa mềm người dùng
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Xóa người dùng thành công');
    }

    /**
     * Khóa / mở khóa tài khoản
     */
    public function toggleStatus(string $id)
    {
        $user = User::findOrFail($id);

        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', 'Cập nhật trạng thái thành công');
    }

    /**
     * Upload avatar riêng
     */
    public function uploadAvatar(Request $request, string $id)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = User::findOrFail($id);

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->avatar = $request->file('avatar')
            ->store('avatars', 'public');

        $user->save();

        return back()->with('success', 'Cập nhật avatar thành công');
    }
}