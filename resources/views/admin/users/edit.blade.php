@extends('layouts.admin')

@section('title', 'Chỉnh sửa người dùng')
@section('page-title', 'Chỉnh sửa người dùng')

@section('content')
<div class="space-y-8">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <!-- LEFT -->
            <div>

                <h2 class="text-2xl font-extrabold text-slate-900">

                    Chỉnh sửa người dùng

                </h2>

                <p class="mt-2 text-sm font-medium text-slate-500">

                    Cập nhật thông tin tài khoản, vai trò và trạng thái hoạt động của người dùng.

                </p>

            </div>

            <!-- RIGHT -->
            <a href="{{ url()->previous() }}" class="inline-flex items-center gap-3
                h-11
                px-5
                rounded-xl
                border-2 border-amber-300
                bg-white
                text-slate-800
                text-sm
                font-semibold
                transition-all duration-300
                hover:bg-amber-50
                hover:border-amber-500
                w-fit">

                <i class="fa-solid fa-arrow-left"></i>

                <span>Quay lại</span>

            </a>

        </div>

    </div>


    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <!-- USER INFO -->
        <div class="lg:col-span-4">

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <!-- HEADER -->
                <div class="bg-gradient-to-r from-slate-900 to-slate-800 p-8 text-center">

                    <img id="avatarPreview"
                        src="{{ $user->avatar
                            ? asset('storage/'.$user->avatar)
                            : 'https://ui-avatars.com/api/?name='.urlencode($user->full_name).'&background=0f172a&color=fff' }}" class="w-32 h-32
                        rounded-3xl
                        object-cover
                        border-4 border-white
                        shadow-xl
                        mx-auto">

                    <h2 class="mt-5 text-2xl font-bold text-white">

                        {{ $user->full_name }}

                    </h2>

                    <p class="mt-2 text-sm text-slate-300">

                        {{ '@'.$user->username }}

                    </p>

                </div>

                <!-- INFO -->
                <div class="p-6 space-y-4">

                    <div class="flex items-center justify-between
                        rounded-xl
                        border border-slate-200
                        bg-slate-50
                        px-5 py-4">

                        <span class="text-sm font-medium text-slate-500">

                            Vai trò

                        </span>

                        <span class="px-3 py-1
                            rounded-full
                            bg-amber-100
                            text-amber-700
                            text-xs
                            font-semibold">

                            {{ $user->role->role_name ?? 'Chưa có' }}

                        </span>

                    </div>

                    <div class="flex items-center justify-between
                        rounded-xl
                        border border-slate-200
                        bg-slate-50
                        px-5 py-4">

                        <span class="text-sm font-medium text-slate-500">

                            Trạng thái

                        </span>

                        @if($user->is_active)

                        <span class="px-3 py-1
                            rounded-full
                            bg-emerald-100
                            text-emerald-700
                            text-xs
                            font-semibold">

                            Hoạt động

                        </span>

                        @else

                        <span class="px-3 py-1
                            rounded-full
                            bg-red-100
                            text-red-600
                            text-xs
                            font-semibold">

                            Bị khóa

                        </span>

                        @endif

                    </div>

                    <div class="flex items-center justify-between
                        rounded-xl
                        border border-slate-200
                        bg-slate-50
                        px-5 py-4">

                        <span class="text-sm font-medium text-slate-500">

                            Ngày tạo

                        </span>

                        <span class="text-sm font-semibold text-slate-800">

                            {{ optional($user->created_at)->format('d/m/Y') ?? 'Chưa có' }}

                        </span>

                    </div>

                    <div class="flex items-center justify-between
                        rounded-xl
                        border border-slate-200
                        bg-slate-50
                        px-5 py-4">

                        <span class="text-sm font-medium text-slate-500">

                            Cập nhật

                        </span>

                        <span class="text-sm font-semibold text-slate-800">

                            {{ optional($user->updated_at)->format('d/m/Y') ?? 'Chưa có' }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

        <!-- FORM -->
        <div class="lg:col-span-8">

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <!-- FORM HEADER -->
                <div class="px-7 py-6 border-b border-slate-200 bg-slate-50">

                    <h3 class="text-xl font-bold text-slate-900">

                        Thông tin người dùng

                    </h3>

                    <p class="mt-1 text-sm text-slate-500">

                        Cập nhật các thông tin cơ bản của tài khoản.

                    </p>

                </div>

                <form action="{{ route('admin.users.update',$user->user_id) }}" method="POST"
                    enctype="multipart/form-data" autocomplete="off" class="p-7 space-y-7">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- FULL NAME -->
                        <div>

                            <label class="block mb-2 text-xs font-semibold uppercase tracking-wide text-slate-500">

                                Họ và tên

                            </label>

                            <input type="text" name="full_name" value="{{ old('full_name',$user->full_name) }}"
                                placeholder="Nhập họ và tên" class="w-full h-12
                                rounded-xl
                                border
                                bg-white
                                px-4
                                text-sm
                                font-medium
                                text-slate-700
                                outline-none
                                transition-all
                                focus:border-amber-400
                                focus:ring-4
                                focus:ring-amber-100
                                @error('full_name')
                                border-red-400
                                @else
                                border-slate-300
                                @enderror">

                            @error('full_name')

                            <p class="mt-2 text-xs font-medium text-red-500">

                                {{ $message }}

                            </p>

                            @enderror

                        </div>

                        <!-- USERNAME -->
                        <div>

                            <label class="block mb-2 text-xs font-semibold uppercase tracking-wide text-slate-500">

                                Tên tài khoản

                            </label>

                            <input type="text" name="username" value="{{ old('username',$user->username) }}"
                                placeholder="Nhập username" class="w-full h-12
                                rounded-xl
                                border
                                bg-white
                                px-4
                                text-sm
                                font-medium
                                text-slate-700
                                outline-none
                                transition-all
                                focus:border-amber-400
                                focus:ring-4
                                focus:ring-amber-100
                                @error('username')
                                border-red-400
                                @else
                                border-slate-300
                                @enderror">

                            @error('username')

                            <p class="mt-2 text-xs font-medium text-red-500">

                                {{ $message }}

                            </p>

                            @enderror

                        </div>

                        <!-- EMAIL -->
                        <div>

                            <label class="block mb-2 text-xs font-semibold uppercase tracking-wide text-slate-500">

                                Email

                            </label>

                            <input type="email" name="email" value="{{ old('email',$user->email) }}"
                                placeholder="example@gmail.com" class="w-full h-12
                                rounded-xl
                                border
                                bg-white
                                px-4
                                text-sm
                                font-medium
                                text-slate-700
                                outline-none
                                transition-all
                                focus:border-amber-400
                                focus:ring-4
                                focus:ring-amber-100
                                @error('email')
                                border-red-400
                                @else
                                border-slate-300
                                @enderror">

                            @error('email')

                            <p class="mt-2 text-xs font-medium text-red-500">

                                {{ $message }}

                            </p>

                            @enderror

                        </div>

                        <!-- ROLE -->
                        <div>

                            <label class="block mb-2 text-xs font-semibold uppercase tracking-wide text-slate-500">

                                Vai trò

                            </label>

                            <select name="role_id" class="w-full h-12
                                rounded-xl
                                border
                                bg-white
                                px-4
                                text-sm
                                font-medium
                                text-slate-700
                                outline-none
                                transition-all
                                focus:border-amber-400
                                focus:ring-4
                                focus:ring-amber-100
                                @error('role_id')
                                border-red-400
                                @else
                                border-slate-300
                                @enderror">

                                @foreach($roles as $role)

                                <option value="{{ $role->role_id }}" @selected((int)old('role_id',$user->
                                    role_id)===(int)$role->role_id)>

                                    {{ $role->role_name }}

                                </option>

                                @endforeach

                            </select>

                            @error('role_id')

                            <p class="mt-2 text-xs font-medium text-red-500">

                                {{ $message }}

                            </p>

                            @enderror

                        </div>
                        <!-- PASSWORD -->
                        <div class="md:col-span-2">

                            <label class="block mb-2 text-xs font-semibold uppercase tracking-wide text-slate-500">

                                Mật khẩu mới

                            </label>

                            <input type="password" name="password"
                                placeholder="Để trống nếu không muốn thay đổi mật khẩu" class="w-full h-12
                                rounded-xl
                                border
                                border-slate-300
                                bg-white
                                px-4
                                text-sm
                                font-medium
                                text-slate-700
                                outline-none
                                transition-all
                                focus:border-amber-400
                                focus:ring-4
                                focus:ring-amber-100
                                @error('password')
                                border-red-400
                                @enderror">

                            @error('password')

                            <p class="mt-2 text-xs font-medium text-red-500">

                                {{ $message }}

                            </p>

                            @enderror

                        </div>

                        <!-- AVATAR -->
                        <div class="md:col-span-2">

                            <label class="block mb-2 text-xs font-semibold uppercase tracking-wide text-slate-500">

                                Ảnh đại diện

                            </label>

                            <input type="file" name="avatar" accept="image/*" onchange="previewAvatar(this)" class="w-full
                                rounded-xl
                                border
                                border-slate-300
                                bg-white
                                text-sm
                                text-slate-600

                                file:mr-4
                                file:px-5
                                file:py-3
                                file:rounded-l-xl
                                file:border-0
                                file:bg-amber-500
                                file:text-white
                                file:font-semibold
                                hover:file:bg-amber-600">

                            <p class="mt-2 text-xs text-slate-400">

                                Hỗ trợ JPG, JPEG, PNG, WEBP. Dung lượng tối đa 2MB.

                            </p>

                            @error('avatar')

                            <p class="mt-2 text-xs font-medium text-red-500">

                                {{ $message }}

                            </p>

                            @enderror

                        </div>

                        <!-- STATUS -->
                        <div class="md:col-span-2">

                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">

                                <label class="block mb-4 text-xs font-semibold uppercase tracking-wide text-slate-500">

                                    Trạng thái tài khoản

                                </label>

                                <label class="inline-flex items-center cursor-pointer">

                                    <input type="hidden" name="is_active" value="0">

                                    <input type="checkbox" name="is_active" value="1" class="w-5 h-5 accent-amber-500"
                                        @checked((bool) old('is_active',$user->is_active))>

                                    <span class="ml-3 text-sm font-medium text-slate-700">

                                        Cho phép người dùng đăng nhập hệ thống

                                    </span>

                                </label>

                                <p class="mt-3 text-xs text-slate-500">

                                    Nếu tắt, tài khoản sẽ không thể đăng nhập cho đến khi được kích hoạt lại.

                                </p>

                            </div>

                        </div>

                    </div>
                    <!-- ACTIONS -->
                    <div class="pt-6 border-t border-slate-200">

                        <div class="flex flex-col sm:flex-row sm:justify-end gap-3">

                            <!-- Hủy -->
                            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center gap-2
                                h-12
                                px-6
                                rounded-xl
                                border border-slate-300
                                bg-white
                                text-slate-700
                                text-sm
                                font-semibold
                                transition-all duration-300
                                hover:bg-slate-900
                                hover:border-slate-900
                                hover:text-white">

                                <i class="fa-solid fa-xmark"></i>

                                Hủy

                            </a>

                            <!-- Lưu -->
                            <button type="submit" class="inline-flex items-center justify-center gap-2
                                h-12
                                px-7
                                rounded-xl
                                bg-amber-500
                                text-white
                                text-sm
                                font-semibold
                                shadow-lg shadow-amber-200
                                transition-all duration-300
                                hover:bg-amber-600">

                                <i class="fa-solid fa-floppy-disk"></i>

                                Lưu thay đổi

                            </button>

                        </div>

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