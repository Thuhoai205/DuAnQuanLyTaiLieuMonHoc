@extends('layouts.admin')

@section('title', 'Chỉnh sửa người dùng')
@section('page-title', 'Chỉnh sửa người dùng')

@section('content')

<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <h2 class="text-lg font-black text-slate-700">
                    Chỉnh sửa người dùng
                </h2>

                <p class="text-sm text-slate-500 font-semibold mt-1">
                    Cập nhật thông tin tài khoản, vai trò và trạng thái hoạt động.
                </p>
            </div>
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center gap-2 h-11 px-4 rounded-md bg-white border border-slate-200 text-slate-600 text-sm font-black hover:bg-slate-100 transition w-fit">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Quay lại</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        <!-- USER INFO CARD -->
        <div class="lg:col-span-4">
            <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">

                <div class="bg-slate-50 border-b border-slate-200 p-6 text-center">
                    <img id="avatarPreview"
                        src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->full_name) . '&background=0ea5e9&color=fff' }}"
                        class="w-28 h-28 rounded-md object-cover border-4 border-white shadow-sm mx-auto">

                    <h2 class="text-lg font-black text-slate-700 mt-5">
                        {{ $user->full_name }}
                    </h2>

                    <p class="text-slate-400 text-sm font-semibold mt-1">
                        {{ '@' . $user->username }}
                    </p>
                </div>

                <div class="p-5 space-y-3">

                    <div
                        class="flex items-center justify-between rounded-md bg-slate-50 border border-slate-200 px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">
                            Vai trò
                        </span>

                        <span class="text-sm font-black text-sky-600">
                            {{ $user->role->role_name ?? 'Chưa có' }}
                        </span>
                    </div>

                    <div
                        class="flex items-center justify-between rounded-md bg-slate-50 border border-slate-200 px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">
                            Trạng thái
                        </span>

                        @if($user->is_active)
                        <span class="px-3 py-1 rounded bg-emerald-50 text-emerald-600 text-xs font-black">
                            Hoạt động
                        </span>
                        @else
                        <span class="px-3 py-1 rounded bg-red-50 text-red-500 text-xs font-black">
                            Bị khóa
                        </span>
                        @endif
                    </div>

                    <div
                        class="flex items-center justify-between rounded-md bg-slate-50 border border-slate-200 px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">
                            Ngày tạo
                        </span>

                        <span class="text-sm font-black text-slate-700">
                            {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Chưa có' }}
                        </span>
                    </div>

                    <div
                        class="flex items-center justify-between rounded-md bg-slate-50 border border-slate-200 px-4 py-3">
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

        <!-- EDIT FORM -->
        <div class="lg:col-span-8">
            <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">

                <div class="px-5 py-4 border-b border-slate-200 bg-white">
                    <h3 class="text-sm font-black text-slate-700">
                        Thông tin chỉnh sửa
                    </h3>

                    <p class="text-xs text-slate-400 font-semibold mt-1">
                        Các trường có thể cập nhật cho tài khoản người dùng.
                    </p>
                </div>

                <form action="{{ route('admin.users.update', $user->user_id) }}" method="POST"
                    enctype="multipart/form-data" autocomplete="off" class="p-5 space-y-6">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        <!-- FULL NAME -->
                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase mb-2">
                                Họ và tên
                            </label>

                            <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}"
                                placeholder="Nhập họ và tên" class="w-full h-11 px-4 rounded-md bg-slate-50 border text-sm font-semibold text-slate-600 outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500
                                @error('full_name') border-red-400 @else border-slate-200 @enderror">

                            @error('full_name')
                            <p class="text-xs text-red-500 font-bold mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- USERNAME -->
                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase mb-2">
                                Tên tài khoản
                            </label>

                            <input type="text" name="username" value="{{ old('username', $user->username) }}"
                                placeholder="Nhập username" class="w-full h-11 px-4 rounded-md bg-slate-50 border text-sm font-semibold text-slate-600 outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500
                                @error('username') border-red-400 @else border-slate-200 @enderror">

                            @error('username')
                            <p class="text-xs text-red-500 font-bold mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- EMAIL -->
                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase mb-2">
                                Email
                            </label>

                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                placeholder="Nhập email" class="w-full h-11 px-4 rounded-md bg-slate-50 border text-sm font-semibold text-slate-600 outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500
                                @error('email') border-red-400 @else border-slate-200 @enderror">

                            @error('email')
                            <p class="text-xs text-red-500 font-bold mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- ROLE -->
                        <div>
                            <label class="block text-xs font-black text-slate-500 uppercase mb-2">
                                Vai trò
                            </label>

                            <select name="role_id" class="w-full h-11 px-4 rounded-md bg-slate-50 border text-sm font-semibold text-slate-600 outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500
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

                        <!-- PASSWORD -->
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-black text-slate-500 uppercase mb-2">
                                Mật khẩu mới
                            </label>

                            <input type="password" name="password" placeholder="Để trống nếu không muốn đổi mật khẩu"
                                class="w-full h-11 px-4 rounded-md bg-slate-50 border text-sm font-semibold text-slate-600 outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500
                                @error('password') border-red-400 @else border-slate-200 @enderror">

                            @error('password')
                            <p class="text-xs text-red-500 font-bold mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- AVATAR -->
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-black text-slate-500 uppercase mb-2">
                                Ảnh đại diện
                            </label>

                            <input type="file" name="avatar" accept="image/*" onchange="previewAvatar(this)" class="w-full rounded-md bg-slate-50 border border-slate-200 text-sm text-slate-600
                                file:mr-4 file:py-3 file:px-5 file:rounded-md file:border-0
                                file:bg-sky-50 file:text-sky-600 file:font-black hover:file:bg-sky-100">

                            <p class="text-xs text-slate-400 font-semibold mt-2">
                                Chỉ hỗ trợ JPG, JPEG, PNG, WEBP. Dung lượng tối đa 2MB.
                            </p>

                            @error('avatar')
                            <p class="text-xs text-red-500 font-bold mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- STATUS -->
                        <div class="sm:col-span-2 rounded-md border border-slate-200 bg-slate-50 p-5">
                            <label class="block text-xs font-black text-slate-500 uppercase mb-3">
                                Trạng thái hoạt động
                            </label>

                            <label class="inline-flex items-center cursor-pointer">
                                <input type="hidden" name="is_active" value="0">

                                <input type="checkbox" name="is_active" value="1" class="w-5 h-5 accent-sky-500"
                                    @checked((bool) old('is_active', $user->is_active))>

                                <span class="ml-3 text-sm font-bold text-slate-600">
                                    Cho phép tài khoản đăng nhập hệ thống
                                </span>
                            </label>
                        </div>

                    </div>

                    <!-- ACTIONS -->
                    <div
                        class="pt-5 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3">
                        <a href="{{ route('admin.users.index') }}"
                            class="h-11 px-5 rounded-md bg-slate-100 text-slate-600 text-sm font-black flex items-center justify-center hover:bg-slate-200 transition">
                            Hủy
                        </a>

                        <button type="submit"
                            class="h-11 px-5 rounded-md bg-sky-500 hover:bg-sky-600 text-white text-sm font-black flex items-center justify-center gap-2 transition">
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

    if (!avatarPreview) {
        return;
    }

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