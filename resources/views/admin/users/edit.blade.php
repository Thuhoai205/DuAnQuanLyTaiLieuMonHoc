@extends('layouts.admin')

@section('title', 'Chỉnh sửa người dùng')
@section('page-title', 'Chỉnh sửa người dùng')

@section('content')

<div class="max-w-6xl mx-auto px-2 lg:px-4">

    <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="text-3xl font-black text-slate-900">
                Chỉnh sửa người dùng
            </h1>

            <p class="text-slate-500 font-semibold mt-2">
                Cập nhật thông tin tài khoản, vai trò và trạng thái hoạt động.
            </p>
        </div>

        <a href="{{ route('admin.users.index') }}"
            class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-white border border-cyan-100 text-slate-700 font-black shadow-sm hover:bg-cyan-50 hover:text-cyan-700 transition">

            <span class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                <i class="fa-solid fa-arrow-left"></i>
            </span>

            <span>Quay lại</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <div class="lg:col-span-4">
            <div class="bg-white rounded-2xl border border-cyan-100 shadow-sm overflow-hidden">

                <div class="bg-gradient-to-br from-cyan-500 to-sky-600 p-7 text-white text-center">
                    <img id="avatarPreview"
                        src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->full_name) . '&background=06b6d4&color=fff' }}"
                        class="w-28 h-28 rounded-3xl object-cover border-4 border-white shadow-xl mx-auto">

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
                        <span class="text-sm font-bold text-slate-500">
                            Vai trò
                        </span>

                        <span class="text-sm font-black text-cyan-700">
                            {{ $user->role->role_name ?? 'Chưa có' }}
                        </span>
                    </div>

                    <div
                        class="flex items-center justify-between rounded-xl bg-slate-50 border border-slate-100 px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">
                            Trạng thái
                        </span>

                        @if($user->is_active)
                        <span class="text-sm font-black text-emerald-600">
                            Hoạt động
                        </span>
                        @else
                        <span class="text-sm font-black text-red-500">
                            Bị khóa
                        </span>
                        @endif
                    </div>

                    <div
                        class="flex items-center justify-between rounded-xl bg-slate-50 border border-slate-100 px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">
                            Ngày tạo
                        </span>

                        <span class="text-sm font-black text-slate-700">
                            {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Chưa có' }}
                        </span>
                    </div>

                    <div
                        class="flex items-center justify-between rounded-xl bg-slate-50 border border-slate-100 px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">
                            Cập nhật
                        </span>

                        <span class="text-sm font-black text-slate-700">
                            {{ $user->updated_at ? $user->updated_at->format('d/m/Y') : 'Chưa có' }}
                        </span>
                    </div>
                </div>

            </div>
        </div>

        <div class="lg:col-span-8">
            <div class="bg-white rounded-2xl border border-cyan-100 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-cyan-100 bg-cyan-50/50">
                    <h3 class="text-xl font-black text-slate-900">
                        Thông tin chỉnh sửa
                    </h3>

                    <p class="text-sm text-slate-500 font-semibold mt-1">
                        Các trường có thể cập nhật cho tài khoản người dùng.
                    </p>
                </div>

                <form action="{{ route('admin.users.update', $user->user_id) }}" method="POST"
                    enctype="multipart/form-data" autocomplete="off" class="p-6 sm:p-8 space-y-6">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase mb-2">
                                Họ và tên
                            </label>

                            <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}"
                                placeholder="Nhập họ và tên" class="w-full h-12 px-4 rounded-xl bg-slate-50 border outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500
                                @error('full_name') border-red-400 @else border-slate-200 @enderror">

                            @error('full_name')
                            <p class="text-xs text-red-500 font-bold mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase mb-2">
                                Tên tài khoản
                            </label>

                            <input type="text" name="username" value="{{ old('username', $user->username) }}"
                                placeholder="Nhập username" class="w-full h-12 px-4 rounded-xl bg-slate-50 border outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500
                                @error('username') border-red-400 @else border-slate-200 @enderror">

                            @error('username')
                            <p class="text-xs text-red-500 font-bold mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase mb-2">
                                Email
                            </label>

                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                placeholder="Nhập email" class="w-full h-12 px-4 rounded-xl bg-slate-50 border outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500
                                @error('email') border-red-400 @else border-slate-200 @enderror">

                            @error('email')
                            <p class="text-xs text-red-500 font-bold mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase mb-2">
                                Vai trò
                            </label>

                            <select name="role_id" class="w-full h-12 px-4 rounded-xl bg-slate-50 border outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500
                                @error('role_id') border-red-400 @else border-slate-200 @enderror">

                                @foreach($roles as $role)
                                <option value="{{ $role->role_id }}" @selected((int) old('role_id', $user->role_id) ===
                                    (int) $role->role_id)>
                                    {{ $role->role_name }}
                                </option>
                                @endforeach

                            </select>

                            @error('role_id')
                            <p class="text-xs text-red-500 font-bold mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-black text-slate-500 uppercase mb-2">
                                Mật khẩu mới
                            </label>

                            <input type="password" name="password" placeholder="Để trống nếu không muốn đổi mật khẩu"
                                class="w-full h-12 px-4 rounded-xl bg-slate-50 border outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500
                                @error('password') border-red-400 @else border-slate-200 @enderror">

                            @error('password')
                            <p class="text-xs text-red-500 font-bold mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-black text-slate-500 uppercase mb-2">
                                Ảnh đại diện
                            </label>

                            <input type="file" name="avatar" accept="image/*" onchange="previewAvatar(this)" class="w-full rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-600
                                file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0
                                file:bg-cyan-50 file:text-cyan-700 file:font-black hover:file:bg-cyan-100">

                            <p class="text-xs text-slate-400 font-semibold mt-2">
                                Chỉ hỗ trợ JPG, JPEG, PNG, WEBP. Dung lượng tối đa 2MB.
                            </p>

                            @error('avatar')
                            <p class="text-xs text-red-500 font-bold mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2 rounded-2xl border border-cyan-100 bg-cyan-50 p-5">
                            <label class="block text-xs font-black text-slate-500 uppercase mb-3">
                                Trạng thái hoạt động
                            </label>

                            <label class="inline-flex items-center cursor-pointer">
                                <input type="hidden" name="is_active" value="0">

                                <input type="checkbox" name="is_active" value="1" class="w-5 h-5 accent-cyan-600"
                                    @checked((bool) old('is_active', $user->is_active))>

                                <span class="ml-3 text-sm font-bold text-slate-600">
                                    Cho phép tài khoản đăng nhập hệ thống
                                </span>
                            </label>
                        </div>

                    </div>

                    <div
                        class="pt-6 border-t border-cyan-100 flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3">
                        <a href="{{ route('admin.users.index') }}"
                            class="h-12 px-5 rounded-xl bg-slate-100 text-slate-700 font-black flex items-center justify-center hover:bg-slate-200 transition">
                            Hủy
                        </a>

                        <button type="submit"
                            class="h-12 px-6 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-black flex items-center justify-center gap-2 shadow-lg shadow-cyan-100 transition">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Lưu thay đổi
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
function previewAvatar(input) {
    const avatarPreview = document.getElementById('avatarPreview');

    if (!avatarPreview) return;

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            avatarPreview.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush