<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">
    <title>Đăng ký tài khoản</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-[#EAFBFF] flex items-center justify-center px-4 relative overflow-hidden">

    <!-- BACKGROUND -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-cyan-200/60 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-cyan-300/50 rounded-full blur-3xl"></div>

    <!-- CONTAINER -->
    <div class="relative w-full max-w-2xl bg-white/95 backdrop-blur-xl rounded-[30px]
        shadow-[0_25px_70px_rgba(8,145,178,0.16)]
        overflow-hidden grid grid-cols-1 md:grid-cols-2 border border-cyan-100">

        <!-- LEFT -->
        <div class="hidden md:flex flex-col justify-center items-center p-6 bg-cyan-600 text-white relative">

            <!-- BACK BUTTON -->
            <a href="{{ route('home') }}" class="absolute top-6 left-6 inline-flex items-center gap-2
        px-4 py-2.5 rounded-2xl
        bg-white/95 backdrop-blur-md
        text-cyan-700
        text-xs font-black uppercase tracking-[0.18em]
        shadow-lg shadow-cyan-900/10
        hover:bg-cyan-50
        hover:-translate-x-1
        hover:shadow-xl
        transition-all duration-300">

                <i class="fa-solid fa-arrow-left text-[11px]"></i>

                <span>
                    Quay lại
                </span>
            </a>

            <!-- ICON -->
            <div class="w-16 h-16 rounded-3xl bg-cyan-300 text-cyan-950
        flex items-center justify-center shadow-xl mb-6">

                <i class="fa-solid fa-graduation-cap text-3xl"></i>
            </div>

            <!-- LOGO -->
            <h1 class="text-3xl font-black tracking-tight">
                EDU<span class="text-cyan-200">DOC</span>
            </h1>

            <!-- DESC -->
            <p class="text-cyan-100 text-center mt-4 leading-relaxed max-w-sm text-sm">
                Nền tảng chia sẻ tài liệu học tập dành cho sinh viên và giảng viên.
            </p>

            <!-- STATS -->
            <div class="grid grid-cols-2 gap-4 mt-8 w-full">

                <div class="bg-cyan-700/60 rounded-3xl p-4 text-center
            border border-cyan-400/10">

                    <p class="text-3xl font-black">
                        1.2K+
                    </p>

                    <p class="text-sm text-cyan-100 font-bold mt-1">
                        Tài liệu
                    </p>
                </div>

                <div class="bg-cyan-700/60 rounded-3xl p-4 text-center
            border border-cyan-400/10">

                    <p class="text-3xl font-black">
                        24/7
                    </p>

                    <p class="text-sm text-cyan-100 font-bold mt-1">
                        Truy cập
                    </p>
                </div>

            </div>

        </div>
        <!-- FORM -->
        <div class="p-6 md:p-6">

            <!-- LOGO -->
            <div class="text-center mb-6">

                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-5">

                    <div class="w-12 h-12 rounded-2xl bg-cyan-500 text-white
                        flex items-center justify-center shadow-lg shadow-cyan-200">

                        <i class="fa-solid fa-graduation-cap text-xl"></i>
                    </div>

                    <div class="text-2xl font-black text-slate-900">
                        EDU<span class="text-cyan-600">DOC</span>
                    </div>

                </a>

                <h3 class="text-xl font-black text-cyan-950">
                    Đăng ký tài khoản
                </h3>

                <p class="text-slate-500 text-sm font-semibold mt-2">
                    Tạo tài khoản để sử dụng hệ thống học liệu
                </p>

            </div>

            <!-- ERROR -->
            @if ($errors->any())
            <div class="bg-red-50 text-red-500 border border-red-100
                p-3 rounded-2xl text-sm font-semibold mb-4">

                <ul>
                    @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                    @endforeach
                </ul>

            </div>
            @endif

            <!-- FORM -->
            <form method="POST" action="{{ route('postRegister') }}" class="space-y-3">

                @csrf

                <!-- NAME -->
                <div>
                    <label class="text-xs font-black text-slate-400 uppercase tracking-wider">
                        Họ và tên
                    </label>

                    <div class="flex items-center bg-cyan-50 border border-cyan-100
                        rounded-2xl px-4 mt-2
                        focus-within:ring-2 focus-within:ring-cyan-300 transition">

                        <i class="fa-solid fa-user text-cyan-600 mr-3"></i>

                        <input type="text" name="full_name" class="w-full bg-transparent py-2.5 outline-none
                            text-sm font-semibold text-slate-700" placeholder="Nhập họ tên..." required>

                    </div>
                </div>

                <!-- USERNAME -->
                <div>
                    <label class="text-xs font-black text-slate-400 uppercase tracking-wider">
                        Username
                    </label>

                    <div class="flex items-center bg-cyan-50 border border-cyan-100
                        rounded-2xl px-4 mt-2
                        focus-within:ring-2 focus-within:ring-cyan-300 transition">

                        <i class="fa-solid fa-id-badge text-cyan-600 mr-3"></i>

                        <input type="text" name="username" class="w-full bg-transparent py-2.5 outline-none
                            text-sm font-semibold text-slate-700" placeholder="Nhập username..." required>

                    </div>
                </div>

                <!-- EMAIL -->
                <div>
                    <label class="text-xs font-black text-slate-400 uppercase tracking-wider">
                        Email
                    </label>

                    <div class="flex items-center bg-cyan-50 border border-cyan-100
                        rounded-2xl px-4 mt-2
                        focus-within:ring-2 focus-within:ring-cyan-300 transition">

                        <i class="fa-solid fa-envelope text-cyan-600 mr-3"></i>

                        <input type="email" name="email" class="w-full bg-transparent py-2.5 outline-none
                            text-sm font-semibold text-slate-700" placeholder="Nhập email..." required>

                    </div>
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="text-xs font-black text-slate-400 uppercase tracking-wider">
                        Mật khẩu
                    </label>

                    <div class="flex items-center bg-cyan-50 border border-cyan-100
                        rounded-2xl px-4 mt-2
                        focus-within:ring-2 focus-within:ring-cyan-300 transition">

                        <i class="fa-solid fa-lock text-cyan-600 mr-3"></i>

                        <input type="password" name="password" class="w-full bg-transparent py-2.5 outline-none
                            text-sm font-semibold text-slate-700" placeholder="Nhập mật khẩu..." required>

                    </div>
                </div>

                <!-- CONFIRM -->
                <div>
                    <label class="text-xs font-black text-slate-400 uppercase tracking-wider">
                        Nhập lại mật khẩu
                    </label>

                    <div class="flex items-center bg-cyan-50 border border-cyan-100
                        rounded-2xl px-4 mt-2
                        focus-within:ring-2 focus-within:ring-cyan-300 transition">

                        <i class="fa-solid fa-shield-halved text-cyan-600 mr-3"></i>

                        <input type="password" name="password_confirmation" class="w-full bg-transparent py-2.5 outline-none
                            text-sm font-semibold text-slate-700" placeholder="Nhập lại mật khẩu..." required>

                    </div>
                </div>

                <!-- BUTTON -->
                <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-600
                    text-white py-3 rounded-2xl font-black
                    shadow-lg shadow-cyan-200
                    hover:-translate-y-0.5
                    transition-all duration-300">

                    <i class="fa-solid fa-user-plus mr-2"></i>
                    Đăng ký

                </button>

            </form>

            <!-- LOGIN -->
            <p class="text-center text-sm text-slate-500 mt-5 font-semibold">
                Đã có tài khoản?

                <a href="{{ route('login') }}" class="text-cyan-600 font-black hover:text-cyan-700">

                    Đăng nhập

                </a>
            </p>

        </div>
    </div>

</body>

</html>