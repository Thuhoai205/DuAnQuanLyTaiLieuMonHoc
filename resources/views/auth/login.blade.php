<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Đăng nhập | EDUDOC</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

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

    <!-- BACKGROUND DECOR -->
    <div class="absolute -top-44 -left-44 w-[500px] h-[500px]
        rounded-full
        bg-slate-300/40
        blur-[140px]">
    </div>

    <div class="absolute -bottom-44 -right-44 w-[500px] h-[500px]
        rounded-full
        bg-amber-200/30
        blur-[140px]">
    </div>

    <!-- GRID -->
    <div class="relative
min-h-screen
flex
items-center
justify-center
px-4
py-6">
        <div class="w-full max-w-[1020px] scale-[0.9] origin-center grid lg:grid-cols-2 gap-5 items-stretch">
            <!-- ================= LEFT HERO ================= -->
            <div class="hidden lg:block">

                <div class="h-full rounded-[28px]
                    bg-gradient-to-br
                    from-slate-900
                    via-slate-800
                    to-slate-700
                    text-white
                    p-7
                    shadow-[0_25px_60px_rgba(15,23,42,0.25)]
                    flex
                    flex-col">

                    <!-- BACK -->
                    <a href="javascript:history.back()" class="inline-flex items-center gap-2
                        self-start
                        rounded-full
                        border border-white/10
                        bg-white/10
                        backdrop-blur-xl
                        px-4 py-2
                        text-xs
                        font-semibold
                        uppercase
                        tracking-wider
                        transition
                        hover:bg-white/20">

                        <i class="fa-solid fa-arrow-left"></i>

                        Quay lại

                    </a>

                    <!-- CONTENT -->
                    <div class="flex-1 flex flex-col justify-center">

                        <!-- LOGO -->
                        <div class="mb-8
    flex
    h-20
    w-20
    items-center
    justify-center
    rounded-2xl
    bg-white
    p-2
    shadow-lg">

                            <img src="{{ asset('img/logo01.png') }}" alt="EDUDOC Logo"
                                class="w-full h-full object-contain">

                        </div>
                        <!-- BADGE -->
                        <span class="inline-flex
                            w-fit
                            items-center
                            gap-2
                            rounded-full
                            bg-white/10
                            px-3
py-1
                            text-xs
                            font-bold
                            uppercase
                            tracking-[0.25em]
                            text-amber-300">

                            <i class="fa-solid fa-graduation-cap"></i>

                            EDUDOC

                        </span>

                        <!-- TITLE -->
                        <h1 class="mt-5
                            text-4xl
                            font-black
                            leading-tight">

                            Kho học liệu

                            <span class=" text-amber-300">

                                hiện đại

                            </span>

                        </h1>

                        <!-- DESCRIPTION -->
                        <p class="mt-6
                            max-w-md
                            text-base
leading-7
                            text-slate-300">

                            Đăng nhập để truy cập hệ thống quản lý tài liệu môn học,
                            tìm kiếm giáo trình, bài giảng, slide,
                            đề thi và chia sẻ học liệu nhanh chóng.

                        </p>

                    </div>

                    <!-- STATISTICS -->
                    <div class="grid grid-cols-2 gap-5 mt-5">

                        <div class="rounded-2xl
                            border border-white/10
                            bg-white/10
                            backdrop-blur-xl
                            p-4">

                            <p class="text-4xl font-black text-amber-300">

                                1.2K+

                            </p>

                            <p class="mt-2 text-sm font-medium text-slate-300">

                                Tài liệu

                            </p>

                        </div>

                        <div class="rounded-2xl
    border border-white/10
    bg-white/10
    backdrop-blur-xl
    p-4">

                            <p class="text-2xl font-black text-amber-300">
                                {{ now()->format('d/m/Y') }}
                            </p>

                            <p class="mt-2 text-sm font-medium text-slate-300">
                                Hôm nay
                            </p>
                        </div>
                    </div>

                </div>

            </div>
            <!-- ================= LOGIN CARD ================= -->
            <div class="flex items-center justify-center">

                <div class="w-full max-w-md">

                    <!-- ================= LOGO ================= -->
                    <div class="text-center mb-6">

                        <a href="{{ route('home') }}" class="inline-flex items-center gap-4 group">

                            <!-- Logo -->
                            <div class="w-14 h-14 flex items-center justify-center"> <img
                                    src="{{ asset('img/logo01.png') }}" alt="EDUDOC Logo"
                                    class="w-14 h-14 object-contain"> </div>
                            <!-- Brand -->
                            <div class="text-left">

                                <h1 class="text-[34px] font-black tracking-tight leading-none">

                                    <span class="text-slate-900">EDU</span>

                                    <span class="text-amber-500">DOC</span>

                                </h1>

                                <p class="mt-1
                                    text-[11px]
                                    uppercase
                                    tracking-[0.35em]
                                    font-semibold
                                    text-slate-400">

                                    Learning Resources

                                </p>

                            </div>

                        </a>

                    </div>

                    <!-- CARD -->
                    <div class="rounded-[28px]
                        border
                        border-slate-200
                        bg-white/90
                        backdrop-blur-2xl
                        p-6
                        shadow-[0_20px_60px_rgba(15,23,42,0.08)]">

                        <!-- TITLE -->
                        <div class="text-center mb-6">

                            <h2 class="text-3xl font-black text-slate-900">

                                Đăng nhập

                            </h2>

                            <p class="mt-3 text-sm text-slate-500">

                                Vui lòng đăng nhập để tiếp tục sử dụng hệ thống.

                            </p>

                        </div>

                        {{-- SUCCESS --}}
                        @if(session('success'))

                        <div class="mb-5
                            rounded-2xl
                            border
                            border-emerald-200
                            bg-emerald-50
                            p-4
                            text-sm
                            font-medium
                            text-emerald-700">

                            {{ session('success') }}

                        </div>

                        @endif

                        {{-- ERROR --}}
                        @if($errors->any())

                        <div class="mb-5
                rounded-2xl
                border
                border-red-200
                bg-red-50
                p-4">

                            <ul class="space-y-1 text-sm text-red-600">

                                @foreach($errors->all() as $error)

                                <li>

                                    • {{ $error }}

                                </li>

                                @endforeach

                            </ul>

                        </div>

                        @endif

                        <!-- FORM -->
                        <form method="POST" action="{{ route('login') }}" class="space-y-4">

                            @csrf

                            <!-- EMAIL -->
                            <div>

                                <label class="mb-2 block
                        text-xs
                        font-bold
                        uppercase
                        tracking-wider
                        text-slate-500">

                                    Email

                                </label>

                                <div class="flex items-center
                        rounded-2xl
                        border
                        border-slate-200
                        bg-slate-50
                        px-4

                        focus-within:border-amber-400
                        focus-within:ring-4
                        focus-within:ring-amber-100
                        transition">

                                    <i class="fa-solid fa-envelope text-slate-500"></i>

                                    <input type="email" name="email" value="{{ old('email') }}" required
                                        placeholder="Nhập email..." class="w-full
                            bg-transparent
                            px-4
                            py-3
                            text-sm
                            font-medium
                            text-slate-700
                            placeholder:text-slate-400
                            outline-none">

                                </div>

                            </div>

                            <!-- PASSWORD -->
                            <div>

                                <label class="mb-2 block
                        text-xs
                        font-bold
                        uppercase
                        tracking-wider
                        text-slate-500">

                                    Mật khẩu

                                </label>

                                <div class="flex items-center
                        rounded-2xl
                        border
                        border-slate-200
                        bg-slate-50
                        px-4

                        focus-within:border-amber-400
                        focus-within:ring-4
                        focus-within:ring-amber-100
                        transition">

                                    <i class="fa-solid fa-lock text-slate-500"></i>

                                    <input type="password" name="password" required placeholder="Nhập mật khẩu..."
                                        class="w-full
                            bg-transparent
                            px-4
                            py-3
                            text-sm
                            font-medium
                            text-slate-700
                            placeholder:text-slate-400
                            outline-none">

                                </div>

                            </div>

                            <!-- REMEMBER -->
                            <div class="flex items-center justify-between">

                                <label class="flex items-center gap-2
                        text-sm
                        text-slate-600">

                                    <input type="checkbox" name="remember"
                                        class="rounded border-slate-300 text-amber-500 focus:ring-amber-300">

                                    Ghi nhớ đăng nhập

                                </label>

                                @if(Route::has('password.request'))

                                <a href="{{ route('password.request') }}" class="text-sm
                        font-semibold
                        text-amber-600
                        hover:text-amber-700">

                                    Quên mật khẩu?

                                </a>

                                @endif

                            </div>

                            <!-- LOGIN BUTTON -->
                            <button type="submit" class="w-full
                    rounded-2xl
                    bg-gradient-to-r
                    from-slate-900
                    via-slate-800
                    to-slate-700

                    py-3

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

                                <i class="fa-solid fa-right-to-bracket mr-2"></i>

                                Đăng nhập

                            </button>
                        </form>

                        <!-- 
                        <div class="mt-5 text-center">

                            <p class="text-sm text-slate-500">

                                Chưa có tài khoản?

                                <a href="{{ route('register') }}" class="ml-1
                        font-semibold
                        text-amber-600
                        transition-colors
                        hover:text-amber-700">

                                    Đăng ký ngay

                                </a>

                            </p>

                        </div>
REGISTER -->
                        <!-- DIVIDER -->
                        <div class="relative my-5">

                            <div class="border-t border-slate-200"></div>

                            <span class="absolute left-1/2 -translate-x-1/2 -translate-y-1/2
                    bg-white
                    px-4
                    text-xs
                    uppercase
                    tracking-widest
                    text-slate-400">

                                EDUDOC

                            </span>

                        </div>

                        <!-- FOOTER -->
                        <div class="text-center">

                            <p class="text-xs text-slate-400 leading-5">

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