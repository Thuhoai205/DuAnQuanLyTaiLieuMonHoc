@extends('layouts.admin')

@section('title', 'Thêm người dùng')
@section('page-title', 'Thêm người dùng')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                Thêm người dùng mới
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Tạo tài khoản và phân quyền cho thành viên mới tham gia hệ thống.
            </p>
        </div>

        <a href="{{ url()->previous() }}"
            class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-white border border-slate-200 text-slate-700 font-black shadow-sm hover:bg-slate-50 transition">
            <span class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">
                <i class="fa-solid fa-arrow-left"></i>
            </span>
            Quay lại
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200/80 shadow-sm overflow-hidden">

        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off"
            class="p-6 sm:p-8 space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Họ và tên
                    </label>

                    <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="Ví dụ: Nguyễn Văn A"
                        class="w-full h-10 px-4 rounded-xl bg-slate-50 border @error('full_name') border-rose-400 @else border-slate-200 @enderror outline-none">

                    @error('full_name')
                    <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Tên tài khoản
                    </label>

                    <input type="text" name="username" value="{{ old('username') }}" placeholder="vanya.nguyen"
                        class="w-full h-10 px-4 rounded-xl bg-slate-50 border @error('username') border-rose-400 @else border-slate-200 @enderror outline-none">

                    @error('username')
                    <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Email
                    </label>

                    <input type="email" name="email" value="{{ old('email') }}" placeholder="example@domain.com"
                        class="w-full h-10 px-4 rounded-xl bg-slate-50 border @error('email') border-rose-400 @else border-slate-200 @enderror outline-none">

                    @error('email')
                    <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Mật khẩu
                    </label>

                    <input type="password" name="password" placeholder="Tối thiểu 6 ký tự"
                        class="w-full h-10 px-4 rounded-xl bg-slate-50 border @error('password') border-rose-400 @else border-slate-200 @enderror outline-none">

                    @error('password')
                    <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Vai trò
                    </label>

                    <select name="role_id"
                        class="w-full h-10 px-4 rounded-xl bg-slate-50 border @error('role_id') border-rose-400 @else border-slate-200 @enderror outline-none">
                        <option value="">Chọn vai trò hệ thống</option>

                        @foreach($roles as $role)
                        <option value="{{ $role->role_id }}" @selected((int) old('role_id')===(int) $role->role_id)>
                            {{ $role->role_name }}
                        </option>
                        @endforeach
                    </select>

                    @error('role_id')
                    <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">
                        Trạng thái hoạt động
                    </label>

                    <div class="h-10 flex items-center">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">

                            <input type="checkbox" name="is_active" value="1" class="w-5 h-5 accent-cyan-600"
                                @checked(old('is_active', 1))>

                            <span class="ml-3 text-sm font-medium text-slate-600">
                                Kích hoạt ngay tài khoản
                            </span>
                        </label>
                    </div>
                </div>

                <div class="sm:col-span-2 space-y-1.5">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Ảnh đại diện
                    </label>

                    <input type="file" name="avatar" accept="image/*"
                        class="w-full rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:bg-cyan-50 file:text-cyan-700 file:font-bold hover:file:bg-cyan-100">

                    @error('avatar')
                    <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                <button type="reset"
                    class="px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold text-sm">
                    Xóa nhập liệu
                </button>

                <button type="submit"
                    class="px-5 py-2.5 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-semibold text-sm flex items-center gap-2">
                    <i class="fa-solid fa-plus text-xs"></i>
                    Tạo người dùng
                </button>
            </div>

        </form>
    </div>

</div>

@endsection