<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-[#EAFBFF] flex items-center justify-center px-4 relative overflow-hidden">

    <!-- BACKGROUND DECOR -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-cyan-200/60 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-cyan-300/50 rounded-full blur-3xl"></div>

    <div class="relative w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

        <!-- LEFT INTRO -->
        <div class="hidden lg:block">
            <div class="rounded-[40px] bg-cyan-600 text-white p-10 shadow-2xl shadow-cyan-200">
                <div class="w-20 h-20 rounded-3xl bg-cyan-300 text-cyan-950 flex items-center justify-center mb-8">
                    <i class="fa-solid fa-book-open text-4xl"></i>
                </div>

                <h1 class="text-5xl font-black leading-tight mb-6">
                    Kho học liệu môn học hiện đại
                </h1>

                <p class="text-cyan-50 text-lg leading-relaxed">
                    Đăng nhập để tìm kiếm, tải tài liệu học tập và quản lý học liệu theo từng môn học.
                </p>

                <div class="grid grid-cols-2 gap-4 mt-10">
                    <div class="bg-cyan-700/60 rounded-3xl p-5">
                        <p class="text-4xl font-black">1.2K+</p>
                        <p class="text-cyan-100 text-sm font-bold mt-1">Tài liệu</p>
                    </div>

                    <div class="bg-cyan-700/60 rounded-3xl p-5">
                        <p class="text-4xl font-black">24/7</p>
                        <p class="text-cyan-100 text-sm font-bold mt-1">Truy cập</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- LOGIN CARD -->
        <div class="w-full max-w-md mx-auto">

            <!-- LOGO -->
            <div class="flex flex-col items-center mb-8">
                <div class="flex items-center gap-3">

                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-2xl bg-cyan-500 text-white shadow-lg shadow-cyan-200">
                        <i class="fa-solid fa-graduation-cap text-2xl"></i>
                    </div>

                    <a href="{{ route('home') }}"
                        class="text-3xl font-black tracking-tight text-slate-900 flex items-center">
                        EDU
                        <span class="relative text-cyan-600 ml-1">
                            DOC
                            <span class="absolute -top-2 -right-4 text-[10px] text-cyan-500 font-black">
                                HH
                            </span>
                        </span>
                    </a>

                </div>

                <p class="text-xs text-slate-400 uppercase tracking-[0.3em] mt-3 font-bold">
                    Hệ thống học liệu
                </p>
            </div>

            <!-- CARD -->
            <div
                class="bg-white/95 backdrop-blur-xl p-8 rounded-[32px] shadow-[0_20px_60px_rgba(8,145,178,0.12)] border border-cyan-100">

                <div class="text-center mb-7">
                    <h3 class="text-2xl font-black text-cyan-950">
                        Đăng nhập hệ thống
                    </h3>

                    <p class="text-slate-500 text-sm font-semibold mt-2">
                        Vui lòng nhập thông tin tài khoản của bạn
                    </p>
                </div>

                {{-- SUCCESS --}}
                @if (session('success'))
                <div
                    class="bg-emerald-50 text-emerald-600 border border-emerald-100 p-3 rounded-2xl text-sm font-semibold mb-4">
                    {{ session('success') }}
                </div>
                @endif

                {{-- ERROR --}}
                @if ($errors->any())
                <div class="bg-red-50 text-red-500 border border-red-100 p-3 rounded-2xl text-sm font-semibold mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- FORM -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- EMAIL -->
                    <div>
                        <label class="text-xs font-black text-slate-400 uppercase tracking-wider">
                            Email
                        </label>

                        <div
                            class="flex items-center bg-cyan-50 border border-cyan-100 rounded-2xl px-4 mt-2 focus-within:ring-2 focus-within:ring-cyan-300 transition">
                            <i class="fa-solid fa-envelope text-cyan-600 mr-3"></i>

                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full bg-transparent py-4 outline-none text-sm font-semibold text-slate-700 placeholder-slate-400"
                                placeholder="Nhập email..." required>
                        </div>
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="text-xs font-black text-slate-400 uppercase tracking-wider">
                            Mật khẩu
                        </label>

                        <div
                            class="flex items-center bg-cyan-50 border border-cyan-100 rounded-2xl px-4 mt-2 focus-within:ring-2 focus-within:ring-cyan-300 transition">
                            <i class="fa-solid fa-lock text-cyan-600 mr-3"></i>

                            <input type="password" name="password"
                                class="w-full bg-transparent py-4 outline-none text-sm font-semibold text-slate-700 placeholder-slate-400"
                                placeholder="Nhập mật khẩu..." required>
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-full bg-cyan-500 hover:bg-cyan-600 text-white py-4 rounded-2xl font-black shadow-lg shadow-cyan-200 hover:-translate-y-0.5 transition-all duration-300">
                        <i class="fa-solid fa-right-to-bracket mr-2"></i>
                        Đăng nhập
                    </button>
                </form>

                <!-- REGISTER -->
                <p class="text-center text-sm text-slate-500 mt-6 font-semibold">
                    Chưa có tài khoản?
                    <a href="{{ route('register') }}" class="text-cyan-600 font-black hover:text-cyan-700">
                        Đăng ký
                    </a>
                </p>

            </div>

        </div>
    </div>

</body>

</html>