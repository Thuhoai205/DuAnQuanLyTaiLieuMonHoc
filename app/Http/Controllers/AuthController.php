<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // ================= REGISTER =================

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        // Người dùng đăng ký mặc định là sinh viên
        User::create([
            'full_name' => $request->full_name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role_id'   => 3, // student
            'is_active' => true,
        ]);

        return redirect()->route('login')
            ->with('success', 'Đăng ký thành công!');
    }

    // ================= LOGIN =================

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        // Đăng nhập bằng email và password
        if (Auth::attempt($request->only('email', 'password'))) {

            /** @var User $user */
            $user = Auth::user();

            // Chặn tài khoản bị khóa
            if (!$user->is_active) {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.'
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            // Ghi nhật ký đăng nhập
           ActivityLog::create([
    'user_id' => $user->user_id,
    'ip_address' => $request->ip(),
    'user_agent' => $request->userAgent(),
    'login_at' => now(),
]);

            // Điều hướng theo role
            return match ((int) $user->role_id) {
                1 => redirect()->route('admin.dashboard'), // admin
                2 => redirect()->route('home'),            // lecturer
                3 => redirect()->route('home'),            // student
                default => redirect()->route('login'),
            };
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng'
        ])->onlyInput('email');
    }

    // ================= LOGOUT =================

    public function logout(Request $request)
    {
        /** @var User|null $user */
        $user = Auth::user();

        // Ghi nhật ký trước khi logout
        if ($user) {
           ActivityLog::where('user_id', $user->user_id)
    ->whereNull('logout_at')
    ->latest('login_at')
    ->first()?->update([
        'logout_at' => now(),
    ]);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    // ================= PROFILE =================

    public function profile()
    {
        return view('auth.profile', [
            'user' => Auth::user()
        ]);
    }

    // ================= UPDATE PROFILE =================

    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'full_name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $user->user_id . ',user_id',
        ], [
            'full_name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.unique' => 'Email đã tồn tại.',
        ]);

        $user->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Cập nhật thông tin thành công!');
    }

    // ================= UPDATE AVATAR =================

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        /** @var User $user */
        $user = Auth::user();

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');

        $user->update([
            'avatar' => $path
        ]);

        return back()->with('success', 'Cập nhật avatar thành công!');
    }

    // ================= UPDATE PASSWORD =================

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', Password::min(6)],
        ], [
            'current_password.current_password' => 'Mật khẩu hiện tại không chính xác.',
            'new_password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        /** @var User $user */
        $user = Auth::user();

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }
}