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

        <a href="{{ route('admin.users.index') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50 hover:text-slate-900 transition-all shadow-sm">
            <i class="fa-solid fa-arrow-left text-xs"></i>
            Quay lại
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200/80 shadow-sm overflow-hidden">

        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data"
            class="p-6 sm:p-8 space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Họ và tên
                    </label>

                    <div class="relative">
                        <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                        <input type="text" name="full_name" value="{{ old('full_name') }}"
                            placeholder="Ví dụ: Nguyễn Văn A"
                            class="w-full h-10 pl-11 pr-4 rounded-xl bg-slate-50 border @error('full_name') border-rose-400 focus:ring-rose-500/10 @else border-slate-200 focus:border-cyan-500 focus:ring-cyan-500/10 @enderror text-sm text-slate-800 placeholder-slate-400 transition-all outline-none focus:bg-white focus:ring-4">
                    </div>

                    @error('full_name')
                    <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Tên tài khoản
                    </label>

                    <div class="relative">
                        <i class="fa-solid fa-at absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                        <input type="text" name="username" value="{{ old('username') }}" placeholder="vanya.nguyen"
                            class="w-full h-10 pl-11 pr-4 rounded-xl bg-slate-50 border @error('username') border-rose-400 focus:ring-rose-500/10 @else border-slate-200 focus:border-cyan-500 focus:ring-cyan-500/10 @enderror text-sm text-slate-800 placeholder-slate-400 transition-all outline-none focus:bg-white focus:ring-4">
                    </div>

                    @error('username')
                    <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Email
                    </label>

                    <div class="relative">
                        <i
                            class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                        <input type="email" name="email" value="{{ old('email') }}" placeholder="example@domain.com"
                            class="w-full h-10 pl-11 pr-4 rounded-xl bg-slate-50 border @error('email') border-rose-400 focus:ring-rose-500/10 @else border-slate-200 focus:border-cyan-500 focus:ring-cyan-500/10 @enderror text-sm text-slate-800 placeholder-slate-400 transition-all outline-none focus:bg-white focus:ring-4">
                    </div>

                    @error('email')
                    <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Mật khẩu
                    </label>

                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                        <input type="password" name="password" placeholder="Tối thiểu 6 ký tự"
                            class="w-full h-10 pl-11 pr-4 rounded-xl bg-slate-50 border @error('password') border-rose-400 focus:ring-rose-500/10 @else border-slate-200 focus:border-cyan-500 focus:ring-cyan-500/10 @enderror text-sm text-slate-800 placeholder-slate-400 transition-all outline-none focus:bg-white focus:ring-4">
                    </div>

                    @error('password')
                    <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Vai trò
                    </label>

                    <div class="relative">
                        <i
                            class="fa-solid fa-shield-halved absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                        <select name="role_id"
                            class="w-full h-10 pl-11 pr-10 rounded-xl bg-slate-50 border @error('role_id') border-rose-400 focus:ring-rose-500/10 @else border-slate-200 focus:border-cyan-500 focus:ring-cyan-500/10 @enderror text-sm text-slate-700 font-medium transition-all outline-none focus:bg-white focus:ring-4 appearance-none cursor-pointer">
                            <option value="">Chọn vai trò hệ thống</option>

                            @foreach($roles as $role)
                            <option value="{{ $role->role_id }}" @selected((int) old('role_id')===(int) $role->role_id)>
                                {{ $role->role_name }}
                            </option>
                            @endforeach
                        </select>

                        <i
                            class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                    </div>

                    @error('role_id')
                    <p class="text-xs text-rose-500 font-medium mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block">
                        Trạng thái hoạt động
                    </label>

                    <div class="h-10 flex items-center">
                        <label class="relative inline-flex items-center cursor-pointer select-none">

                            <input type="hidden" name="is_active" value="0">

                            <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                @checked(old('is_active', 1))>

                            <div
                                class="w-11 h-6 bg-slate-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-cyan-500/10 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-cyan-600">
                            </div>

                            <span class="ml-3 text-sm font-medium text-slate-600 peer-checked:text-slate-800">
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

            <div
                class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3 bg-slate-50/30 -mx-6 -mb-6 p-6 sm:-mx-8 sm:-mb-8 sm:p-6">
                <button type="reset"
                    class="px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-slate-800 hover:bg-slate-50 font-semibold text-sm transition shadow-sm cursor-pointer">
                    Xóa nhập liệu
                </button>

                <button type="submit"
                    class="px-5 py-2.5 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-semibold text-sm shadow-sm shadow-cyan-600/10 transition flex items-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-plus text-xs"></i>
                    Tạo người dùng
                </button>
            </div>

        </form>
    </div>

</div>

@endsection