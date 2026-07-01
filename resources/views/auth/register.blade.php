<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- BƯỚC NHÚNG FONT TỪ GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>

<!-- TÍNH HỢP FONT-FAMILY ĐỒNG BỘ TOÀN HỆ THỐNG + THÊM py-4 TRÁNH DÍNH MÀN HÌNH -->

<body
    class="min-h-screen bg-[#EAFBFF] flex items-center justify-center px-4 py-4 relative overflow-hidden font-['Roboto',_sans-serif]">

    <!-- BACKGROUND -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-cyan-200/60 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-cyan-300/50 rounded-full blur-3xl"></div>

    <!-- CONTAINER (Đã giảm max-w-3xl xuống max-w-2xl và giới hạn chiều cao tối đa) -->
    <div class="relative w-full max-w-2xl bg-white/95 backdrop-blur-xl rounded-[24px]
        shadow-[0_20px_50px_rgba(8,145,178,0.12)]
        overflow-hidden grid grid-cols-1 md:grid-cols-2 items-stretch border border-cyan-100">

        <!-- LEFT (Khối màu xanh thu nhỏ padding để cân bằng vertical space) -->
        <div class="hidden md:flex flex-col justify-between p-6 bg-cyan-600 text-white relative">

            <!-- BACK BUTTON -->
            <div class="mb-2">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2
                    px-3 py-1.5 rounded-xl bg-white/95 backdrop-blur-md text-cyan-700
                    text-[11px] font-black uppercase tracking-wider shadow-md hover:bg-cyan-50 
                    hover:-translate-x-0.5 transition-all duration-300">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span>Quay lại</span>
                </a>
            </div>

            <!-- MIDDLE INTRO CONTENT -->
            <div class="my-auto text-center flex flex-col items-center py-2">
                <!-- ICON -->
                <div
                    class="w-12 h-12 rounded-2xl bg-cyan-300 text-cyan-950 flex items-center justify-center shadow-md mb-3">
                    <i class="fa-solid fa-graduation-cap text-2xl"></i>
                </div>

                <!-- LOGO -->
                <h1 class="text-2xl font-black tracking-tight">
                    EDU<span class="text-cyan-200">DOC</span>
                </h1>

                <!-- DESC -->
                <p class="text-cyan-100 text-center mt-2 leading-relaxed max-w-xs text-xs">
                    Nền tảng chia sẻ tài liệu học tập dành cho sinh viên và giảng viên.
                </p>
            </div>

            <!-- STATS (Thu nhỏ kích thước khối) -->
            <div class="grid grid-cols-2 gap-2 mt-auto w-full">
                <div class="bg-cyan-700/60 rounded-xl p-2 text-center border border-cyan-400/10">
                    <p class="text-lg font-black">1.2K+</p>
                    <p class="text-[10px] text-cyan-100 font-bold">Tài liệu</p>
                </div>

                <div class="bg-cyan-700/60 rounded-xl p-2 text-center border border-cyan-400/10">
                    <p class="text-lg font-black">24/7</p>
                    <p class="text-[10px] text-cyan-100 font-bold">Truy cập</p>
                </div>
            </div>

        </div>

        <!-- RIGHT: FORM CONTAINER (Đã thu nhỏ p-8 xuống p-5) -->
        <div class="p-5 flex flex-col justify-center">

            <!-- LOGO & TITLE -->
            <div class="text-center mb-3">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-1">
                    <div
                        class="w-8 h-8 rounded-lg bg-cyan-500 text-white flex items-center justify-center shadow-md shadow-cyan-200">
                        <i class="fa-solid fa-graduation-cap text-sm"></i>
                    </div>
                    <div class="text-lg font-black text-slate-900">
                        EDU<span class="text-cyan-600">DOC</span>
                    </div>
                </a>

                <h3 class="text-lg font-black text-cyan-950">
                    Đăng ký tài khoản
                </h3>
                <p class="text-slate-500 text-[11px] font-semibold">
                    Tạo tài khoản để sử dụng hệ thống học liệu
                </p>
            </div>

            <!-- ERROR INTERFACE -->
            @if ($errors->any())
            <div class="bg-red-50 text-red-500 border border-red-100 p-2 rounded-xl text-xs font-semibold mb-2">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- REGISTRATION FORM (Đã đổi space-y-3 thành space-y-2 để thu gọn khoảng cách dọc) -->
            <form method="POST" action="{{ route('postRegister') }}" class="space-y-2">
                @csrf

                <!-- NAME -->
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-wider">
                        Họ và tên
                    </label>
                    <div
                        class="flex items-center bg-cyan-50 border border-cyan-100 rounded-xl px-3 mt-1 focus-within:ring-2 focus-within:ring-cyan-300 transition">
                        <i class="fa-solid fa-user text-cyan-600 mr-2 text-xs"></i>
                        <!-- Đổi py-2.5 thành py-2 để form ngắn lại -->
                        <input type="text" name="full_name"
                            class="w-full bg-transparent py-2 outline-none text-xs font-semibold text-slate-700 placeholder-slate-400"
                            placeholder="Nhập họ tên..." required>
                    </div>
                </div>

                <!-- USERNAME -->
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-wider">
                        Username
                    </label>
                    <div
                        class="flex items-center bg-cyan-50 border border-cyan-100 rounded-xl px-3 mt-1 focus-within:ring-2 focus-within:ring-cyan-300 transition">
                        <i class="fa-solid fa-id-badge text-cyan-600 mr-2 text-xs"></i>
                        <input type="text" name="username"
                            class="w-full bg-transparent py-2 outline-none text-xs font-semibold text-slate-700 placeholder-slate-400"
                            placeholder="Nhập username..." required>
                    </div>
                </div>

                <!-- EMAIL -->
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-wider">
                        Email
                    </label>
                    <div
                        class="flex items-center bg-cyan-50 border border-cyan-100 rounded-xl px-3 mt-1 focus-within:ring-2 focus-within:ring-cyan-300 transition">
                        <i class="fa-solid fa-envelope text-cyan-600 mr-2 text-xs"></i>
                        <input type="email" name="email"
                            class="w-full bg-transparent py-2 outline-none text-xs font-semibold text-slate-700 placeholder-slate-400"
                            placeholder="Nhập email..." required>
                    </div>
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-wider">
                        Mật khẩu
                    </label>
                    <div
                        class="flex items-center bg-cyan-50 border border-cyan-100 rounded-xl px-3 mt-1 focus-within:ring-2 focus-within:ring-cyan-300 transition">
                        <i class="fa-solid fa-lock text-cyan-600 mr-2 text-xs"></i>
                        <input type="password" name="password"
                            class="w-full bg-transparent py-2 outline-none text-xs font-semibold text-slate-700 placeholder-slate-400"
                            placeholder="Nhập mật khẩu..." required>
                    </div>
                </div>

                <!-- CONFIRM PASSWORD -->
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-wider">
                        Nhập lại mật khẩu
                    </label>
                    <div
                        class="flex items-center bg-cyan-50 border border-cyan-100 rounded-xl px-3 mt-1 focus-within:ring-2 focus-within:ring-cyan-300 transition">
                        <i class="fa-solid fa-shield-halved text-cyan-600 mr-2 text-xs"></i>
                        <input type="password" name="password_confirmation"
                            class="w-full bg-transparent py-2 outline-none text-xs font-semibold text-slate-700 placeholder-slate-400"
                            placeholder="Nhập lại mật khẩu..." required>
                    </div>
                </div>

                <!-- BUTTON SUBMIT -->
                <div class="pt-1">
                    <button type="submit"
                        class="w-full bg-cyan-500 hover:bg-cyan-600 text-white py-2.5 rounded-xl font-black text-xs shadow-md shadow-cyan-200 hover:-translate-y-0.5 transition-all duration-300">
                        <i class="fa-solid fa-user-plus mr-1.5"></i>
                        Đăng ký
                    </button>
                </div>

            </form>

            <!-- SWITCH TO LOGIN -->
            <p class="text-center text-xs text-slate-500 mt-4 font-semibold">
                Đã có tài khoản?
                <a href="{{ route('login') }}" class="text-cyan-600 font-black hover:text-cyan-700 ml-1">
                    Đăng nhập
                </a>
            </p>

        </div>
    </div>

</body>

</html>