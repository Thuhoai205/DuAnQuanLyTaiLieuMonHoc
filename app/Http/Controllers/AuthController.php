<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
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
            'role_id'   => 3, // LUÔN SINH VIÊN
            'is_active' => 1,
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công!');
    }

    // =========================
    // LOGIN
    // =========================
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
{
    // Kiểm tra thông tin đăng nhập
    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();
        $user = Auth::user();

        // Sử dụng switch hoặc match (PHP 8+)
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

    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended('/home');
    }
}