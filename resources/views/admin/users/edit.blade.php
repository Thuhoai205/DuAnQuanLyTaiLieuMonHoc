@extends('layouts.admin')

@section('title', 'Chỉnh sửa người dùng')
@section('page-title', 'Chỉnh sửa người dùng')

@section('content')

<div class="max-w-6xl mx-auto">

    <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-50 border border-cyan-100 text-cyan-700 text-xs font-black uppercase tracking-wider mb-4">
                <i class="fa-solid fa-user-pen"></i>
                Edit User
            </div>

            <h1 class="text-4xl font-black text-slate-900 tracking-tight">
                Chỉnh sửa người dùng
            </h1>

            <p class="text-slate-500 font-semibold mt-2">
                Cập nhật thông tin tài khoản trong hệ thống.
            </p>
        </div>

        <a href="{{ route('admin.users.index') }}"
            class="inline-flex items-center justify-center gap-3 px-6 py-3.5 rounded-2xl bg-white border border-cyan-100 text-cyan-700 font-black hover:bg-cyan-50 transition-all">
            <i class="fa-solid fa-arrow-left"></i>
            Quay lại
        </a>
    </div>

    <div
        class="bg-white rounded-[34px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] overflow-hidden">

        <div class="relative bg-gradient-to-r from-cyan-500 to-cyan-600 px-10 py-12 overflow-hidden">
            <div
                class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl translate-x-20 -translate-y-20">
            </div>

            <div class="relative flex flex-col lg:flex-row lg:items-center gap-8">

                <div class="flex flex-col items-center">
                    <div class="relative group">
                        <img id="avatarPreview"
                            src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->full_name) . '&background=06b6d4&color=fff' }}"
                            class="w-36 h-36 rounded-[30px] object-cover border-4 border-white shadow-2xl">

                        <label
                            class="absolute inset-0 bg-black/40 rounded-[30px] flex items-center justify-center opacity-0 group-hover:opacity-100 transition cursor-pointer">
                            <div class="text-center text-white">
                                <i class="fa-solid fa-camera text-2xl mb-2"></i>
                                <p class="text-sm font-bold">Đổi ảnh</p>
                            </div>

                            <input type="file" name="avatar" form="editUserForm" class="hidden" accept="image/*"
                                onchange="previewAvatar(this)">
                        </label>
                    </div>
                </div>

                <div class="text-white">
                    <h2 class="text-4xl font-black">
                        {{ $user->full_name }}
                    </h2>

                    <p class="text-cyan-100 font-semibold mt-2 text-lg">
                        {{ '@' . $user->username }}
                    </p>

                    <div class="flex items-center gap-3 mt-5 flex-wrap">
                        <span
                            class="px-4 py-2 rounded-full bg-white/15 backdrop-blur text-sm font-black border border-white/10">
                            {{ $user->role->role_name ?? 'Chưa có vai trò' }}
                        </span>

                        @if($user->is_active)
                        <span
                            class="px-4 py-2 rounded-full bg-emerald-400/20 text-emerald-100 text-sm font-black border border-emerald-200/20">
                            Hoạt động
                        </span>
                        @else
                        <span
                            class="px-4 py-2 rounded-full bg-red-400/20 text-red-100 text-sm font-black border border-red-200/20">
                            Bị khóa
                        </span>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <form id="editUserForm" action="{{ route('admin.users.update', $user->user_id) }}" method="POST"
            enctype="multipart/form-data" class="p-8 lg:p-10 space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-7">

                <div>
                    <label class="block text-sm font-black text-slate-600 mb-3">
                        Họ và tên
                    </label>

                    <div class="relative">
                        <i class="fa-solid fa-user absolute left-5 top-1/2 -translate-y-1/2 text-cyan-600"></i>

                        <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}"
                            placeholder="Nhập họ tên..."
                            class="w-full h-14 pl-14 pr-5 rounded-2xl bg-cyan-50 border border-cyan-100 outline-none focus:ring-2 focus:ring-cyan-300 font-semibold">
                    </div>

                    @error('full_name')
                    <p class="text-red-500 text-sm font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-black text-slate-600 mb-3">
                        Username
                    </label>

                    <div class="relative">
                        <i class="fa-solid fa-at absolute left-5 top-1/2 -translate-y-1/2 text-cyan-600"></i>

                        <input type="text" name="username" value="{{ old('username', $user->username) }}"
                            placeholder="Nhập username..."
                            class="w-full h-14 pl-14 pr-5 rounded-2xl bg-cyan-50 border border-cyan-100 outline-none focus:ring-2 focus:ring-cyan-300 font-semibold">
                    </div>

                    @error('username')
                    <p class="text-red-500 text-sm font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-black text-slate-600 mb-3">
                        Email
                    </label>

                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-5 top-1/2 -translate-y-1/2 text-cyan-600"></i>

                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            placeholder="Nhập email..."
                            class="w-full h-14 pl-14 pr-5 rounded-2xl bg-cyan-50 border border-cyan-100 outline-none focus:ring-2 focus:ring-cyan-300 font-semibold">
                    </div>

                    @error('email')
                    <p class="text-red-500 text-sm font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-black text-slate-600 mb-3">
                        Vai trò
                    </label>

                    <select name="role_id"
                        class="w-full h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100 outline-none focus:ring-2 focus:ring-cyan-300 font-semibold text-slate-700">
                        @foreach($roles as $role)
                        <option value="{{ $role->role_id }}" @selected((int) old('role_id', $user->role_id) === (int)
                            $role->role_id)>
                            {{ $role->role_name }}
                        </option>
                        @endforeach
                    </select>

                    @error('role_id')
                    <p class="text-red-500 text-sm font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-black text-slate-600 mb-3">
                        Mật khẩu mới
                    </label>

                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-5 top-1/2 -translate-y-1/2 text-cyan-600"></i>

                        <input type="password" name="password"
                            placeholder="Để trống nếu không muốn thay đổi mật khẩu..."
                            class="w-full h-14 pl-14 pr-5 rounded-2xl bg-cyan-50 border border-cyan-100 outline-none focus:ring-2 focus:ring-cyan-300 font-semibold">
                    </div>

                    @error('password')
                    <p class="text-red-500 text-sm font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div
                class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 p-6 rounded-[28px] bg-cyan-50 border border-cyan-100">
                <div>
                    <h3 class="font-black text-slate-800 text-lg">
                        Trạng thái tài khoản
                    </h3>

                    <p class="text-slate-500 font-semibold text-sm mt-1">
                        Bật hoặc tắt quyền đăng nhập hệ thống.
                    </p>
                </div>

                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="hidden" name="is_active" value="0">

                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" @checked((bool)
                        old('is_active', $user->is_active))>

                    <div class="w-16 h-9 bg-slate-200 rounded-full peer peer-checked:bg-cyan-500 transition-all"></div>

                    <div
                        class="absolute left-1 top-1 w-7 h-7 bg-white rounded-full shadow transition-all peer-checked:translate-x-7">
                    </div>
                </label>
            </div>

            <div class="pt-8 border-t border-cyan-100 flex flex-col sm:flex-row items-center justify-end gap-4">
                <a href="{{ route('admin.users.index') }}"
                    class="w-full sm:w-auto px-6 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-black transition-all text-center">
                    Hủy
                </a>

                <button type="submit"
                    class="w-full sm:w-auto px-7 py-3 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-black shadow-lg shadow-cyan-200 transition-all">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Lưu thay đổi
                </button>
            </div>
        </form>

    </div>
</div>

<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection