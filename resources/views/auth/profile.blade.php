@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Roboto', sans-serif;
}
</style>

<div class="min-h-screen
bg-gradient-to-br
from-slate-100
via-white
to-slate-200
relative
overflow-hidden
py-8">

    <!-- Background -->
    <div class="absolute -top-40 -left-40
        w-[420px]
        h-[420px]
        rounded-full
        bg-slate-300/40
        blur-[120px]">
    </div>

    <div class="absolute -bottom-40 -right-40
        w-[420px]
        h-[420px]
        rounded-full
        bg-amber-200/30
        blur-[120px]">
    </div>

    <div class="relative
        max-w-7xl
        mx-auto
        px-5">

        <!-- HEADER -->
        <div class="flex
            items-center
            justify-between
            flex-wrap
            gap-5
            mb-8">

            <div>



                <h1 class="text-3xl font-bold text-slate-900">
                    Hồ sơ của tôi
                </h1>

                <p class="mt-2
                    text-slate-500">

                    Quản lý thông tin và bảo mật tài khoản của bạn.

                </p>

            </div>

            <div class="hidden
                md:flex
                items-center
                gap-4
                rounded-3xl
                border
                border-slate-200
                bg-white/90
                backdrop-blur-xl
                px-5
                py-4
                shadow-[0_15px_40px_rgba(15,23,42,.08)]">

                <div class="w-12
                    h-12
                    rounded-2xl
                    bg-slate-900
                    text-amber-400
                    flex
                    items-center
                    justify-center">

                    <i class="fa-solid fa-shield-halved text-lg"></i>

                </div>

                <div>

                    <p class="font-bold text-slate-900">

                        Bảo mật tài khoản

                    </p>

                    <p class="text-sm text-slate-500">

                        Dữ liệu được bảo vệ an toàn.

                    </p>

                </div>

            </div>

        </div>

        <!-- GRID -->
        <div class="grid
            grid-cols-1
            lg:grid-cols-12
            gap-6">

            <!-- LEFT -->
            <div class="lg:col-span-4">

                <div class="rounded-3xl
                    overflow-hidden
                    bg-white/90
                    backdrop-blur-xl
                    border
                    border-slate-200
                    shadow-[0_20px_60px_rgba(15,23,42,.08)]">

                    <!-- TOP -->
                    <div class="h-28
                        bg-gradient-to-r
                        from-slate-900
                        via-slate-800
                        to-slate-700">
                    </div>

                    <div class="px-6
                        pb-6
                        relative">

                        <!-- Avatar -->
                        <div class="flex justify-center -mt-14">

                            <form id="avatar-form" action="{{ route('profile.update.avatar') }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf

                                <div class="relative group">

                                    <label for="avatar-upload" class="cursor-pointer">

                                        <div class="w-28
                                            h-28
                                            rounded-full
                                            bg-white
                                            p-2
                                            shadow-xl">

                                            @if(Auth::user()->avatar)

                                            <img id="avatar-preview" src="{{ asset('storage/'.Auth::user()->avatar) }}"
                                                class="w-full
                                                    h-full
                                                    rounded-full
                                                    object-cover">

                                            @else

                                            <div id="avatar-placeholder" class="w-full
                                                    h-full
                                                    rounded-full
                                                    bg-gradient-to-br
                                                    from-slate-900
                                                    to-slate-700
                                                    flex
                                                    items-center
                                                    justify-center
                                                    text-4xl
                                                    font-black
                                                    text-white">

                                                {{ strtoupper(substr(Auth::user()->full_name,0,1)) }}

                                            </div>

                                            @endif

                                        </div>

                                        <div class="absolute
                                            bottom-1
                                            right-1
                                            w-10
                                            h-10
                                            rounded-full
                                            bg-white
                                            border
                                            border-slate-200
                                            shadow-lg
                                            flex
                                            items-center
                                            justify-center
                                            text-amber-500
                                            transition
                                            group-hover:scale-110">

                                            <i class="fa-solid fa-camera"></i>

                                        </div>

                                    </label>

                                    <input id="avatar-upload" type="file" name="avatar" class="hidden" accept="image/*"
                                        onchange="previewAndSubmit(this)">

                                </div>

                            </form>

                        </div>

                        <!-- INFO -->
                        <div class="text-center mt-5">

                            <h2 class="text-2xl
                                font-black
                                text-slate-900">

                                {{ Auth::user()->full_name }}

                            </h2>

                            <p class="mt-2
                                text-slate-500">

                                {{ Auth::user()->email }}

                            </p>

                            <div class="inline-flex
                                items-center
                                gap-2
                                mt-5
                                rounded-full
                                bg-amber-50
                                border
                                border-amber-200
                                px-4
                                py-2">

                                <span class="w-2.5
                                    h-2.5
                                    rounded-full
                                    bg-amber-500
                                    animate-pulse">
                                </span>

                                <span class="text-sm
                                    font-semibold
                                    text-amber-700">

                                    Đang hoạt động

                                </span>

                            </div>

                        </div>

                        <!-- STATS -->
                        <div class="grid
                            grid-cols-2
                            gap-4
                            mt-7">

                            <div class="rounded-2xl
                                bg-slate-50
                                border
                                border-slate-200
                                p-4
                                text-center">

                                <p class="text-xs
                                    uppercase
                                    tracking-widest
                                    text-slate-400
                                    font-bold">

                                    Thành viên

                                </p>

                                <h4 class="mt-2
                                    font-bold
                                    text-slate-900">

                                    Chính thức

                                </h4>

                            </div>

                            <div class="rounded-2xl
                                bg-slate-50
                                border
                                border-slate-200
                                p-4
                                text-center">

                                <p class="text-xs
                                    uppercase
                                    tracking-widest
                                    text-slate-400
                                    font-bold">

                                    Tham gia

                                </p>

                                <h4 class="mt-2
                                    font-bold
                                    text-slate-900">

                                    {{ Auth::user()->created_at ? Auth::user()->created_at->format('m/Y') : 'Mới' }}

                                </h4>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="lg:col-span-8 space-y-6">
                <!-- ================= THÔNG TIN CÁ NHÂN ================= -->

                <div class="rounded-3xl
                    border
                    border-slate-200
                    bg-white/90
                    backdrop-blur-xl
                    p-6
                    shadow-[0_20px_60px_rgba(15,23,42,.08)]">

                    <!-- Header -->

                    <div class="flex
                        items-center
                        justify-between
                        mb-6">

                        <div>

                            <h3 class="text-2xl
                                font-black
                                text-slate-900">

                                Thông tin cá nhân

                            </h3>

                            <p class="mt-1
                                text-sm
                                text-slate-500">

                                Cập nhật thông tin tài khoản.

                            </p>

                        </div>

                        <div class="w-14
                            h-14
                            rounded-2xl
                            bg-slate-900
                            text-amber-400
                            flex
                            items-center
                            justify-center">

                            <i class="fa-solid fa-user-pen text-xl"></i>

                        </div>

                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">

                        @csrf
                        @method('PUT')

                        <div class="grid
                            grid-cols-1
                            md:grid-cols-2
                            gap-5">

                            <!-- Họ tên -->

                            <div>

                                <label class="block
                                    mb-2
                                    text-xs
                                    uppercase
                                    tracking-wider
                                    font-bold
                                    text-slate-500">

                                    Họ và tên

                                </label>

                                <div class="relative">

                                    <i class="fa-solid fa-user
                                        absolute
                                        left-5
                                        top-1/2
                                        -translate-y-1/2
                                        text-slate-400">
                                    </i>

                                    <input type="text" name="full_name" value="{{ Auth::user()->full_name }}" class="w-full
                                        h-12
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-slate-50
                                        pl-12
                                        pr-4
                                        text-sm
                                        font-medium
                                        text-slate-700
                                        focus:outline-none
                                        focus:border-amber-400
                                        focus:ring-4
                                        focus:ring-amber-100">

                                </div>

                            </div>

                            <!-- Email -->

                            <div>

                                <label class="block
                                    mb-2
                                    text-xs
                                    uppercase
                                    tracking-wider
                                    font-bold
                                    text-slate-500">

                                    Email

                                </label>

                                <div class="relative">

                                    <i class="fa-solid fa-envelope
                                        absolute
                                        left-5
                                        top-1/2
                                        -translate-y-1/2
                                        text-slate-400">
                                    </i>

                                    <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full
                                        h-12
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-slate-50
                                        pl-12
                                        pr-4
                                        text-sm
                                        font-medium
                                        text-slate-700
                                        focus:outline-none
                                        focus:border-amber-400
                                        focus:ring-4
                                        focus:ring-amber-100">

                                </div>

                            </div>
                            @if(Auth::user()->role->role_name !=='1')
                            <div>
                                <label class="block mb-2 text-xs uppercase tracking-wider font-bold text-slate-500">
                                    Khoa
                                </label>

                                <div class="relative">

                                    <i class="fa-solid fa-building-columns
                                                absolute
                                                left-5
                                                top-1/2
                                                -translate-y-1/2
                                                text-slate-400"></i>

                                    <input type="text"
                                        value="{{ Auth::user()->faculty?->faculty_name ?? 'Chưa có khoa' }}" readonly
                                        disabled class="w-full
                                    h-12
                                    rounded-xl
                                    border
                                    border-slate-200
                                    bg-slate-100
                                    pl-12
                                    pr-4
                                    text-sm
                                    font-medium
                                    text-slate-700
                                    cursor-not-allowed">
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="flex justify-end">

                            <button type="submit" class="inline-flex
                                items-center
                                gap-2
                                rounded-xl
                                bg-gradient-to-r
                                from-slate-900
                                via-slate-800
                                to-slate-700
                                px-7
                                py-3
                                text-sm
                                font-bold
                                text-white
                                shadow-lg
                                shadow-slate-900/20
                                transition-all
                                duration-300
                                hover:-translate-y-0.5
                                hover:shadow-xl">

                                <i class="fa-solid fa-floppy-disk"></i>

                                Lưu thay đổi

                            </button>

                        </div>

                    </form>

                </div>
                <!-- ================= BẢO MẬT TÀI KHOẢN ================= -->

                <div class="rounded-3xl
                    border
                    border-slate-200
                    bg-white/90
                    backdrop-blur-xl
                    p-6
                    shadow-[0_20px_60px_rgba(15,23,42,.08)]">

                    <!-- Header -->

                    <div class="flex
                        items-center
                        justify-between
                        mb-6">

                        <div>

                            <h3 class="text-2xl
                                font-black
                                text-slate-900">

                                Bảo mật tài khoản

                            </h3>

                            <p class="mt-1
                                text-sm
                                text-slate-500">

                                Thay đổi mật khẩu để tăng cường bảo mật.

                            </p>

                        </div>

                        <div class="w-14
                            h-14
                            rounded-2xl
                            bg-slate-900
                            text-amber-400
                            flex
                            items-center
                            justify-center">

                            <i class="fa-solid fa-lock"></i>

                        </div>

                    </div>

                    <form action="{{ route('profile.password') }}" method="POST" class="space-y-5">

                        @csrf
                        @method('PUT')

                        <div class="grid
                            grid-cols-1
                            md:grid-cols-3
                            gap-5">

                            <!-- Current Password -->

                            <div>

                                <label class="block
                                    mb-2
                                    text-xs
                                    font-bold
                                    uppercase
                                    tracking-wider
                                    text-slate-500">

                                    Mật khẩu hiện tại

                                </label>

                                <input type="password" name="current_password" placeholder="Nhập mật khẩu" class="w-full
                                    h-12
                                    rounded-xl
                                    border
                                    border-slate-200
                                    bg-slate-50
                                    px-4
                                    text-sm
                                    focus:outline-none
                                    focus:border-amber-400
                                    focus:ring-4
                                    focus:ring-amber-100">

                            </div>

                            <!-- New Password -->

                            <div>

                                <label class="block
                                    mb-2
                                    text-xs
                                    font-bold
                                    uppercase
                                    tracking-wider
                                    text-slate-500">

                                    Mật khẩu mới

                                </label>

                                <input type="password" name="new_password" placeholder="Nhập mật khẩu mới" class="w-full
                                    h-12
                                    rounded-xl
                                    border
                                    border-slate-200
                                    bg-slate-50
                                    px-4
                                    text-sm
                                    focus:outline-none
                                    focus:border-amber-400
                                    focus:ring-4
                                    focus:ring-amber-100">

                            </div>

                            <!-- Confirm Password -->

                            <div>

                                <label class="block
                                    mb-2
                                    text-xs
                                    font-bold
                                    uppercase
                                    tracking-wider
                                    text-slate-500">

                                    Xác nhận mật khẩu

                                </label>

                                <input type="password" name="new_password_confirmation" placeholder="Nhập lại mật khẩu"
                                    class="w-full
                                    h-12
                                    rounded-xl
                                    border
                                    border-slate-200
                                    bg-slate-50
                                    px-4
                                    text-sm
                                    focus:outline-none
                                    focus:border-amber-400
                                    focus:ring-4
                                    focus:ring-amber-100">

                            </div>

                        </div>

                        <div class="flex justify-end">

                            <button type="submit" class="inline-flex
                                items-center
                                gap-2
                                rounded-xl
                                bg-gradient-to-r
                                from-slate-900
                                via-slate-800
                                to-slate-700
                                px-7
                                py-3
                                text-sm
                                font-bold
                                text-white
                                shadow-lg
                                shadow-slate-900/20
                                transition-all
                                duration-300
                                hover:-translate-y-0.5
                                hover:shadow-xl">

                                <i class="fa-solid fa-key"></i>

                                Đổi mật khẩu

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
function previewAndSubmit(input) {

    if (input.files && input.files[0]) {

        const reader = new FileReader();

        reader.onload = function(e) {

            const img = document.getElementById('avatar-preview');

            const placeholder = document.getElementById('avatar-placeholder');

            if (img) {

                img.src = e.target.result;

            } else if (placeholder) {

                const newImg = document.createElement('img');

                newImg.id = 'avatar-preview';

                newImg.src = e.target.result;

                newImg.className = 'w-full h-full rounded-full object-cover';

                placeholder.parentNode.replaceChild(newImg, placeholder);

            }

            document.getElementById('avatar-form').submit();

        }

        reader.readAsDataURL(input.files[0]);

    }

}
</script>

@endsection