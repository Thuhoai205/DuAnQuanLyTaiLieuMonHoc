<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    // ================= REGISTER =================

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        User::create([
            'full_name' => $request->full_name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role_id'   => 3,
            'is_active' => 1,
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Đăng ký thành công!');
    }

    // ================= LOGIN =================

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();

            $user = Auth::user();

            return match ((int)$user->role_id) {
                1 => redirect()->intended('/admin/dashboard'),
                2, 3 => redirect()->intended('/home'),
                default => redirect('/login'),
            };
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng'
        ])->withInput($request->only('email'));
    }

    // ================= LOGOUT =================

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('/home');
    }

    // ================= PROFILE =================

    public function profile()
    {
        $user = Auth::user();

        return view('auth.profile', compact('user'));
    }

    // ================= UPDATE PROFILE =================

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
        ], [
            'full_name.required' => 'Vui lòng nhập họ tên.',
            'email.required'     => 'Vui lòng nhập email.',
            'email.unique'       => 'Email đã tồn tại.',
        ]);

        $user->full_name = $request->full_name;
        $user->email = $request->email;

        $user->save();

        return back()->with('success', 'Cập nhật thông tin thành công!');
    }

    // ================= UPDATE AVATAR =================

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Xóa avatar cũ
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

    // Upload avatar mới
    $path = $request->file('avatar')->store('avatars', 'public');

    // Save DB
    $user->avatar = $path;
    $user->save();

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
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->password = Hash::make($request->new_password);

        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }
}