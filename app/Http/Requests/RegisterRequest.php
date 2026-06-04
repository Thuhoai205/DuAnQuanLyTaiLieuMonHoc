<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Cho phép gửi request đăng ký
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Quy tắc validate
     */
    public function rules(): array
    {
        return [
            // Họ tên
            'full_name' => [
                'required',
                'string',
                'max:100',
            ],

            // Tên đăng nhập
            'username' => [
                'required',
                'string',
                'max:50',
                'unique:users,username',
            ],

            // Email
            'email' => [
                'required',
                'email',
                'max:100',
                'unique:users,email',
            ],

            // Mật khẩu
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],
        ];
    }

    /**
     * Thông báo lỗi
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'Vui lòng nhập họ tên.',
            'full_name.max' => 'Họ tên tối đa 100 ký tự.',

            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'username.unique' => 'Tên đăng nhập đã tồn tại.',
            'username.max' => 'Tên đăng nhập tối đa 50 ký tự.',

            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'email.max' => 'Email tối đa 100 ký tự.',

            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ];
    }
}