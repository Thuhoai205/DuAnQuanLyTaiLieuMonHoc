@extends('layouts.admin')

@section('title', 'Chỉnh sửa người dùng')
@section('page-title', 'Chỉnh sửa người dùng')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                Chỉnh sửa người dùng
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Cập nhật thông tin tài khoản, vai trò và trạng thái hoạt động.
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

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <div class="lg:col-span-4">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="bg-gradient-to-br from-cyan-500 to-sky-600 p-6 text-white text-center">
                    <div class="relative inline-block">
                        <img id="avatarPreview"
                            src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->full_name) . '&background=06b6d4&color=fff' }}"
                            class="w-28 h-28 rounded-3xl object-cover border-4 border-white shadow-xl mx-auto">



                    </div>

                    <h2 class="text-xl font-black mt-5">
                        {{ $user->full_name }}
                    </h2>

                    <p class="text-cyan-50 text-sm font-semibold mt-1">
                        {{ '@' . $user->username }}
                    </p>
                </div>

                <div class="p-5 space-y-3">
                    <div
                        class="flex items-center justify-between rounded-xl bg-cyan-50 border border-cyan-100 px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">Vai trò</span>
                        <span class="text-sm font-black text-cyan-700">
                            {{ $user->role->role_name ?? 'Chưa có' }}
                        </span>
                    </div>

                    <div
                        class="flex items-center justify-between rounded-xl bg-slate-50 border border-slate-100 px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">Trạng thái</span>

                        @if($user->is_active)
                        <span class="text-sm font-black text-emerald-600">Hoạt động</span>
                        @else
                        <span class="text-sm font-black text-red-500">Bị khóa</span>
                        @endif
                    </div>

                    <div
                        class="flex items-center justify-between rounded-xl bg-slate-50 border border-slate-100 px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">Ngày tạo</span>
                        <span class="text-sm font-black text-slate-700">
                            {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Chưa có' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-8">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/70">
                    <h3 class="text-lg font-black text-slate-900">
                        Thông tin chỉnh sửa
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        Các trường có thể cập nhật cho tài khoản người dùng.
                    </p>
                </div>

                <form id="editUserForm" action="{{ route('admin.users.update', $user->user_id) }}" method="POST"
                    enctype="multipart/form-data" autocomplete="off" class="p-6 sm:p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                                Họ và tên
                            </label>

                            <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}"
                                class="w-full h-10 px-4 rounded-xl bg-slate-50 border @error('full_name') border-rose-400 @else border-slate-200 @enderror outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500">

                            @error('full_name')
                            <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                                Tên tài khoản
                            </label>

                            <input type="text" name="username" value="{{ old('username', $user->username) }}"
                                class="w-full h-10 px-4 rounded-xl bg-slate-50 border @error('username') border-rose-400 @else border-slate-200 @enderror outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500">

                            @error('username')
                            <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                                Email
                            </label>

                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="w-full h-10 px-4 rounded-xl bg-slate-50 border @error('email') border-rose-400 @else border-slate-200 @enderror outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500">

                            @error('email')
                            <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                                Vai trò
                            </label>

                            <select name="role_id"
                                class="w-full h-10 px-4 rounded-xl bg-slate-50 border @error('role_id') border-rose-400 @else border-slate-200 @enderror outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500">
                                @foreach($roles as $role)
                                <option value="{{ $role->role_id }}" @selected((int) old('role_id', $user->role_id) ===
                                    (int) $role->role_id)>
                                    {{ $role->role_name }}
                                </option>
                                @endforeach
                            </select>

                            @error('role_id')
                            <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5 sm:col-span-2">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                                Mật khẩu mới
                            </label>

                            <input type="password" name="password" placeholder="Để trống nếu không muốn đổi mật khẩu"
                                class="w-full h-10 px-4 rounded-xl bg-slate-50 border @error('password') border-rose-400 @else border-slate-200 @enderror outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500">

                            @error('password')
                            <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5 sm:col-span-2">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                                Ảnh đại diện
                            </label>

                            <input type="file" name="avatar" accept="image/*" onchange="previewAvatar(this)"
                                class="w-full rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:bg-cyan-50 file:text-cyan-700 file:font-bold hover:file:bg-cyan-100">

                            @error('avatar')
                            <p class="text-xs text-rose-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2 rounded-xl border border-cyan-100 bg-cyan-50 p-4">
                            <label class="text-xs font-bold text-slate-700 uppercase tracking-wider block mb-3">
                                Trạng thái hoạt động
                            </label>

                            <label class="inline-flex items-center cursor-pointer">
                                <input type="hidden" name="is_active" value="0">

                                <input type="checkbox" name="is_active" value="1" class="w-5 h-5 accent-cyan-600"
                                    @checked((bool) old('is_active', $user->is_active))>

                                <span class="ml-3 text-sm font-medium text-slate-600">
                                    Cho phép tài khoản đăng nhập hệ thống
                                </span>
                            </label>
                        </div>

                    </div>

                    <div class="pt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                        <a href="{{ route('admin.users.index') }}"
                            class="px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold text-sm">
                            Hủy
                        </a>

                        <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-semibold text-sm flex items-center gap-2">
                            <i class="fa-solid fa-floppy-disk text-xs"></i>
                            Lưu thay đổi
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>

</div>

<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection