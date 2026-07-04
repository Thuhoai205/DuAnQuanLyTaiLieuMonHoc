<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Đăng ký | EDUDOC</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

</head>

<body class="min-h-screen
bg-gradient-to-br
from-slate-100
via-white
to-slate-200
font-['Roboto',sans-serif]
relative
overflow-hidden">

    <!-- Background -->
    <div class="absolute
        -top-36
        -left-36
        w-[380px]
        h-[380px]
        rounded-full
        bg-slate-300/40
        blur-[120px]">
    </div>

    <div class="absolute
        -bottom-36
        -right-36
        w-[380px]
        h-[380px]
        rounded-full
        bg-amber-200/30
        blur-[120px]">
    </div>

    <!-- Container -->
    <div class="relative
        min-h-screen
        flex
        items-center
        justify-center
        px-4
        py-4">

        <div class="w-full
            max-w-[880px]
            grid
            lg:grid-cols-[1.05fr_0.95fr]
            gap-4
            items-stretch">

            <!-- ================= HERO ================= -->

            <div class="hidden lg:block">

                <div class="h-full
                    rounded-[24px]
                    bg-gradient-to-br
                    from-slate-900
                    via-slate-800
                    to-slate-700
                    p-5
                    text-white
                    shadow-[0_18px_45px_rgba(15,23,42,0.22)]
                    flex
                    flex-col">

                    <!-- BACK -->

                    <a href="javascript:history.back()" class="inline-flex
                        self-start
                        items-center
                        gap-2
                        rounded-full
                        bg-white/10
                        border
                        border-white/10
                        backdrop-blur-xl
                        px-4
                        py-2
                        text-[11px]
                        font-bold
                        uppercase
                        tracking-wider
                        transition
                        hover:bg-white/20">

                        <i class="fa-solid fa-arrow-left"></i>

                        Quay lại

                    </a>

                    <!-- CONTENT -->

                    <div class="flex-1 flex flex-col justify-center">

                        <!-- Logo -->

                        <div class="w-14
                            h-14
                            rounded-2xl
                            bg-white
                            shadow-lg
                            flex
                            items-center
                            justify-center
                            p-2
                            mb-4">

                            <img src="{{ asset('img/logo01.png') }}" alt="EDUDOC" class="w-full h-full object-contain">

                        </div>

                        <!-- Badge -->

                        <span class="inline-flex
                            w-fit
                            items-center
                            gap-2
                            rounded-full
                            bg-white/10
                            px-3
                            py-1
                            text-[10px]
                            font-bold
                            uppercase
                            tracking-[0.25em]
                            text-amber-300">

                            <i class="fa-solid fa-graduation-cap"></i>

                            EDUDOC

                        </span>

                        <!-- Title -->

                        <h1 class="mt-5
                            text-[32px]
                            font-black
                            leading-tight">

                            Tạo tài khoản

                            <span class="text-amber-300">

                                mới

                            </span>

                        </h1>

                        <!-- Description -->

                        <p class="mt-4
                            max-w-sm
                            text-[15px]
                            leading-6
                            text-slate-300">

                            Tham gia hệ thống quản lý tài liệu môn học,
                            lưu trữ và chia sẻ giáo trình, slide,
                            bài giảng và đề thi một cách nhanh chóng.

                        </p>

                    </div>

                    <!-- Statistics -->

                    <div class="grid
                        grid-cols-2
                        gap-3
                        mt-4">

                        <div class="rounded-xl
                            border
                            border-white/10
                            bg-white/10
                            backdrop-blur-xl
                            p-3">

                            <p class="text-2xl
                                font-black
                                text-amber-300">

                                1.2K+

                            </p>

                            <p class="mt-1
                                text-xs
                                text-slate-300">

                                Tài liệu

                            </p>

                        </div>

                        <div class="rounded-xl
                            border
                            border-white/10
                            bg-white/10
                            backdrop-blur-xl
                            p-3">

                            <p class="text-lg
                                font-black
                                text-amber-300">

                                {{ now()->format('d/m/Y') }}

                            </p>

                            <p class="mt-1
                                text-xs
                                text-slate-300">

                                Hôm nay

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ================= REGISTER ================= -->

            <div class="w-full
                max-w-[360px]
                mx-auto">
                <!-- ================= LOGO ================= -->

                <div class="text-center mb-4">

                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">

                        <!-- Logo -->
                        <div class="w-12 h-12 flex items-center justify-center">

                            <img src="{{ asset('img/logo01.png') }}" alt="EDUDOC Logo"
                                class="w-12 h-12 object-contain transition duration-300 group-hover:scale-105">

                        </div>

                        <!-- Brand -->
                        <div class="text-left">

                            <h1 class="text-[28px] font-black tracking-tight leading-none">

                                <span class="text-slate-900">
                                    EDU
                                </span>

                                <span class="text-amber-500">
                                    DOC
                                </span>

                            </h1>

                            <p class="mt-1
                                text-[10px]
                                uppercase
                                tracking-[0.30em]
                                font-semibold
                                text-slate-400">

                                Learning Resources

                            </p>

                        </div>

                    </a>

                </div>

                <!-- ================= CARD ================= -->

                <div class="rounded-[22px]
                    border
                    border-slate-200
                    bg-white/90
                    backdrop-blur-xl
                    p-5
                    shadow-[0_15px_40px_rgba(15,23,42,0.08)]">

                    <!-- Title -->

                    <div class="text-center mb-4">

                        <h2 class="text-[28px]
                            font-black
                            text-slate-900">

                            Đăng ký

                        </h2>

                        <p class="mt-1
                            text-xs
                            text-slate-500">

                            Tạo tài khoản để sử dụng hệ thống.

                        </p>

                    </div>

                    {{-- ERROR --}}
                    @if ($errors->any())

                    <div class="mb-3
                        rounded-xl
                        border
                        border-red-200
                        bg-red-50
                        p-3">

                        <ul class="space-y-1 text-xs text-red-600">

                            @foreach ($errors->all() as $error)

                            <li>• {{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                    @endif

                    <!-- FORM -->

                    <form method="POST" action="{{ route('postRegister') }}" autocomplete="off" class="space-y-2.5">

                        @csrf

                        <!-- Họ và tên -->

                        <div>

                            <label class="block
                                mb-1
                                text-[11px]
                                font-bold
                                uppercase
                                tracking-wider
                                text-slate-500">

                                Họ và tên

                            </label>

                            <div class="flex
                                items-center
                                rounded-xl
                                border
                                border-slate-200
                                bg-slate-50
                                px-3
                                transition
                                focus-within:border-amber-400
                                focus-within:ring-2
                                focus-within:ring-amber-100">

                                <i class="fa-solid fa-user text-slate-500 text-sm"></i>

                                <input type="text" name="full_name" value="{{ old('full_name') }}" required
                                    placeholder="Nhập họ và tên..." autocomplete="off" class="w-full
                                    bg-transparent
                                    px-3
                                    py-2.5
                                    text-sm
                                    text-slate-700
                                    outline-none
                                    placeholder:text-slate-400">

                            </div>

                        </div>

                        <!-- Username -->

                        <div>

                            <label class="block
                                mb-1
                                text-[11px]
                                font-bold
                                uppercase
                                tracking-wider
                                text-slate-500">

                                Username

                            </label>

                            <div class="flex
                                items-center
                                rounded-xl
                                border
                                border-slate-200
                                bg-slate-50
                                px-3
                                transition
                                focus-within:border-amber-400
                                focus-within:ring-2
                                focus-within:ring-amber-100">

                                <i class="fa-solid fa-id-badge text-slate-500 text-sm"></i>

                                <input type="text" name="username" value="{{ old('username') }}" required
                                    placeholder="Nhập username..." autocomplete="off" class="w-full
                                    bg-transparent
                                    px-3
                                    py-2.5
                                    text-sm
                                    text-slate-700
                                    outline-none
                                    placeholder:text-slate-400">

                            </div>

                        </div> <!-- EMAIL -->
                        <div>

                            <label class="block
                                mb-1
                                text-[11px]
                                font-bold
                                uppercase
                                tracking-wider
                                text-slate-500">

                                Email

                            </label>

                            <div class="flex
                                items-center
                                rounded-xl
                                border
                                border-slate-200
                                bg-slate-50
                                px-3
                                transition
                                focus-within:border-amber-400
                                focus-within:ring-2
                                focus-within:ring-amber-100">

                                <i class="fa-solid fa-envelope text-slate-500 text-sm"></i>

                                <input type="email" name="email" value="{{ old('email') }}" required
                                    placeholder="Nhập email..." autocomplete="off" class="w-full
                                    bg-transparent
                                    px-3
                                    py-2.5
                                    text-sm
                                    text-slate-700
                                    outline-none
                                    placeholder:text-slate-400">

                            </div>

                        </div>

                        <!-- PASSWORD -->
                        <div>

                            <label class="block
                                mb-1
                                text-[11px]
                                font-bold
                                uppercase
                                tracking-wider
                                text-slate-500">

                                Mật khẩu

                            </label>

                            <div class="flex
                                items-center
                                rounded-xl
                                border
                                border-slate-200
                                bg-slate-50
                                px-3
                                transition
                                focus-within:border-amber-400
                                focus-within:ring-2
                                focus-within:ring-amber-100">

                                <i class="fa-solid fa-lock text-slate-500 text-sm"></i>

                                <input type="password" name="password" required placeholder="Nhập mật khẩu..."
                                    autocomplete="off" class="w-full
                                    bg-transparent
                                    px-3
                                    py-2.5
                                    text-sm
                                    text-slate-700
                                    outline-none
                                    placeholder:text-slate-400">

                            </div>

                        </div>

                        <!-- CONFIRM PASSWORD -->
                        <div>

                            <label class="block
                                mb-1
                                text-[11px]
                                font-bold
                                uppercase
                                tracking-wider
                                text-slate-500">

                                Xác nhận mật khẩu

                            </label>

                            <div class="flex
                                items-center
                                rounded-xl
                                border
                                border-slate-200
                                bg-slate-50
                                px-3
                                transition
                                focus-within:border-amber-400
                                focus-within:ring-2
                                focus-within:ring-amber-100">

                                <i class="fa-solid fa-shield-halved text-slate-500 text-sm"></i>

                                <input type="password" name="password_confirmation" required
                                    placeholder="Nhập lại mật khẩu..." class="w-full
                                    bg-transparent
                                    px-3
                                    py-2.5
                                    text-sm
                                    text-slate-700
                                    outline-none
                                    placeholder:text-slate-400">

                            </div>

                        </div>

                        <!-- BUTTON -->

                        <button type="submit" class="w-full
                            rounded-xl
                            bg-gradient-to-r
                            from-slate-900
                            via-slate-800
                            to-slate-700
                            py-2.5
                            text-sm
                            font-bold
                            tracking-wide
                            text-white
                            shadow-lg
                            shadow-slate-900/20
                            transition-all
                            duration-300
                            hover:-translate-y-0.5
                            hover:shadow-xl">

                            <i class="fa-solid fa-user-plus mr-2"></i>

                            Đăng ký

                        </button>

                    </form>

                    <!-- LOGIN -->

                    <div class="mt-4 text-center">

                        <p class="text-sm text-slate-500">

                            Đã có tài khoản?

                            <a href="{{ route('login') }}" class="ml-1
                                font-semibold
                                text-amber-600
                                hover:text-amber-700
                                transition">

                                Đăng nhập

                            </a>

                        </p>

                    </div>

                    <!-- DIVIDER -->

                    <div class="relative my-4">

                        <div class="border-t border-slate-200"></div>

                        <span class="absolute
                            left-1/2
                            -translate-x-1/2
                            -translate-y-1/2
                            bg-white
                            px-3
                            text-[10px]
                            uppercase
                            tracking-[0.30em]
                            text-slate-400">

                            EDUDOC

                        </span>

                    </div>

                    <!-- FOOTER -->

                    <div class="text-center">

                        <p class="text-[11px]
                            leading-5
                            text-slate-400">

                            © {{ date('Y') }}

                            <span class="font-semibold text-slate-600">

                                EDUDOC

                            </span>

                            · Hệ thống quản lý tài liệu môn học

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>