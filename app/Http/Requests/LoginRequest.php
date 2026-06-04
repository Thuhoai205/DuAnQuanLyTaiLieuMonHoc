<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Cho phép tất cả người dùng gửi request đăng nhập.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Quy tắc validate form đăng nhập.
     */
    public function rules(): array
    {
        return [
            // Email đăng nhập
            'email' => ['required', 'email'],

            // Mật khẩu
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    /**
     * Thông báo lỗi validate.
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',

            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.string' => 'Mật khẩu không hợp lệ.',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự.',
        ];
    }
}