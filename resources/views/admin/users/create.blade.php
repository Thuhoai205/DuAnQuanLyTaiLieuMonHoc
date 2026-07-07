@extends('layouts.admin')

@section('title', 'Thêm người dùng')
@section('page-title', 'Thêm người dùng')

@section('content')
<div class="max-w-6xl mx-auto px-2 lg:px-4">

    <!-- HEADER -->
    <div class="mb-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

        <div>

            <h1 class="text-4xl font-extrabold tracking-tight text-slate-900">

                Thêm người dùng mới

            </h1>

            <p class="mt-2 text-base font-medium text-slate-500">

                Tạo tài khoản và phân quyền cho người dùng trong hệ thống.

            </p>

        </div>

        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-3
            px-5 py-3
            rounded-2xl
            border border-amber-300
            bg-white
            text-slate-800
            font-semibold
            shadow-sm
            transition-all duration-300
            hover:bg-amber-500
            hover:border-amber-500
            hover:text-white">

            <span class="w-10 h-10 rounded-xl
                bg-amber-50
                text-amber-500
                flex items-center justify-center">

                <i class="fa-solid fa-arrow-left"></i>

            </span>

            <span>Quay lại</span>

        </a>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <!-- ================= LEFT ================= -->
        <div class="lg:col-span-4">

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                <!-- AVATAR -->
                <div class="bg-gradient-to-br
                    from-slate-900
                    via-slate-800
                    to-slate-700
                    px-8 py-10
                    text-center">

                    <img id="avatarPreview" src="https://ui-avatars.com/api/?name=User&background=0f172a&color=fff"
                        class="w-28 h-28
                        rounded-3xl
                        object-cover
                        border-4
                        border-white
                        shadow-2xl
                        mx-auto">

                    <h2 class="mt-6 text-2xl font-bold text-white">

                        Tài khoản mới

                    </h2>

                    <p class="mt-2 text-sm font-medium text-slate-300">

                        Ảnh đại diện sẽ hiển thị tại đây.

                    </p>

                </div>

                <!-- INFORMATION -->
                <div class="p-6 space-y-5">

                    <div class="rounded-2xl
                        border border-amber-200
                        bg-amber-50
                        p-5">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl
                                bg-amber-500
                                text-white
                                flex items-center justify-center">

                                <i class="fa-solid fa-circle-info"></i>

                            </div>

                            <div>

                                <h3 class="text-sm font-bold text-slate-800">

                                    Lưu ý

                                </h3>

                                <p class="mt-1 text-sm font-medium text-slate-600 leading-6">

                                    Sau khi tạo, tài khoản có thể đăng nhập nếu được kích hoạt.

                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="rounded-2xl
                        border border-slate-200
                        bg-slate-50
                        p-5">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl
                                bg-slate-900
                                text-white
                                flex items-center justify-center">

                                <i class="fa-solid fa-user-shield"></i>

                            </div>

                            <div>

                                <h3 class="text-sm font-bold text-slate-800">

                                    Vai trò

                                </h3>

                                <p class="mt-1 text-sm font-medium text-slate-600 leading-6">

                                    Hệ thống hỗ trợ Admin, Giảng viên và Sinh viên.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- ================= RIGHT ================= -->
        <div class="lg:col-span-8">

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="px-8 py-6
                    border-b border-slate-200
                    bg-slate-50">

                    <h3 class="text-2xl font-bold text-slate-900">

                        Thông tin người dùng

                    </h3>

                    <p class="mt-2 text-sm font-medium text-slate-500">

                        Nhập đầy đủ thông tin để tạo tài khoản mới.

                    </p>

                </div>

                <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data"
                    autocomplete="off" class="p-8 space-y-6">

                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- HỌ VÀ TÊN -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Họ và tên
                            </label>

                            <input type="text" name="full_name" value="{{ old('full_name') }}"
                                placeholder="Ví dụ: Nguyễn Văn A" class="w-full h-12 px-4 rounded-xl
        bg-white
        border
        outline-none
        text-sm
        font-medium
        placeholder:text-slate-400
        focus:ring-4
        focus:ring-amber-100
        focus:border-amber-500
        @error('full_name') border-red-400 @else border-slate-300 @enderror">

                            @error('full_name')
                            <p class="mt-2 text-xs font-semibold text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- USERNAME -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Tên tài khoản
                            </label>

                            <input type="text" name="username" value="{{ old('username') }}"
                                placeholder="Ví dụ: nguyenvana" class="w-full h-12 px-4 rounded-xl
        bg-white
        border
        outline-none
        text-sm
        font-medium
        placeholder:text-slate-400
        focus:ring-4
        focus:ring-amber-100
        focus:border-amber-500
        @error('username') border-red-400 @else border-slate-300 @enderror">

                            @error('username')
                            <p class="mt-2 text-xs font-semibold text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- EMAIL -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Email
                            </label>

                            <input type="email" name="email" value="{{ old('email') }}" placeholder="example@gmail.com"
                                class="w-full h-12 px-4 rounded-xl
        bg-white
        border
        outline-none
        text-sm
        font-medium
        placeholder:text-slate-400
        focus:ring-4
        focus:ring-amber-100
        focus:border-amber-500
        @error('email') border-red-400 @else border-slate-300 @enderror">

                            @error('email')
                            <p class="mt-2 text-xs font-semibold text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- PASSWORD -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Mật khẩu
                            </label>

                            <input type="password" name="password" placeholder="Tối thiểu 6 ký tự" class="w-full h-12 px-4 rounded-xl
        bg-white
        border
        outline-none
        text-sm
        font-medium
        placeholder:text-slate-400
        focus:ring-4
        focus:ring-amber-100
        focus:border-amber-500
        @error('password') border-red-400 @else border-slate-300 @enderror">

                            @error('password')
                            <p class="mt-2 text-xs font-semibold text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- ROLE -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Vai trò
                            </label>

                            <select name="role_id" class="w-full h-12 px-4 rounded-xl
        bg-white
        border
        outline-none
        text-sm
        font-medium
        focus:ring-4
        focus:ring-amber-100
        focus:border-amber-500
        @error('role_id') border-red-400 @else border-slate-300 @enderror">

                                <option value="">
                                    Chọn vai trò hệ thống
                                </option>

                                @foreach($roles as $role)

                                <option value="{{ $role->role_id }}" @selected((int)old('role_id')===(int)$role->
                                    role_id)>

                                    {{ $role->role_name }}

                                </option>

                                @endforeach

                            </select>

                            @error('role_id')
                            <p class="mt-2 text-xs font-semibold text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- STATUS -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Trạng thái
                            </label>

                            <div class="h-12 px-4 rounded-xl
        bg-amber-50
        border border-amber-200
        flex items-center">

                                <label class="inline-flex items-center cursor-pointer">

                                    <input type="hidden" name="is_active" value="0">

                                    <input type="checkbox" name="is_active" value="1" class="w-5 h-5 accent-amber-500"
                                        @checked((bool) old('is_active', true))>

                                    <span class="ml-3 text-sm font-semibold text-slate-700">

                                        Kích hoạt tài khoản

                                    </span>

                                </label>

                            </div>

                        </div>
                        <!-- AVATAR -->
                        <div class="sm:col-span-2">

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
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
        file:py-3
        file:px-5
        file:rounded-xl
        file:border-0
        file:bg-amber-50
        file:text-amber-600
        file:font-semibold
        hover:file:bg-amber-100">

                            <p class="mt-2 text-xs font-medium text-slate-500">

                                Hỗ trợ JPG, JPEG, PNG, WEBP.

                                Dung lượng tối đa <strong>2MB</strong>.

                            </p>

                            @error('avatar')

                            <p class="mt-2 text-xs font-semibold text-red-500">

                                {{ $message }}

                            </p>

                            @enderror

                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="pt-8
    border-t
    border-slate-200
    flex
    flex-col
    sm:flex-row
    sm:justify-end
    gap-3">

                        <!-- RESET -->
                        <button type="reset" class="inline-flex
        items-center
        justify-center
        gap-2
        h-12
        px-6
        rounded-xl
        border
        border-slate-300
        bg-white
        text-slate-700
        text-sm
        font-semibold
        transition-all
        duration-300
        hover:bg-slate-100">

                            <i class="fa-solid fa-rotate-left"></i>

                            Xóa nhập liệu

                        </button>

                        <!-- SUBMIT -->
                        <button type="submit" class="inline-flex
        items-center
        justify-center
        gap-2
        h-12
        px-6
        rounded-xl
        bg-slate-900
        text-white
        text-sm
        font-semibold
        shadow-sm
        transition-all
        duration-300
        hover:bg-amber-500">

                            <i class="fa-solid fa-user-plus"></i>

                            Tạo người dùng

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