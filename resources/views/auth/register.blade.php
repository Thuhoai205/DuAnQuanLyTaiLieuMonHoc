<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-slate-50 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-5xl bg-white rounded-3xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

        <!-- LEFT: LOGO -->
        <div class="flex flex-col justify-center items-center p-10 bg-white">

            <div class="flex items-start gap-3 mb-4">

                <!-- Icon (giữ style cũ) -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-700 
                    p-3 rounded-2xl shadow-lg shadow-blue-500/30 -translate-y-1">
                    <i class="fas fa-graduation-cap text-white text-2xl"></i>
                </div>

                <!-- Logo -->
                <h1 class="text-3xl font-extrabold flex items-center text-slate-800">
                    EDU
                    <span class="relative text-blue-600 ml-1">
                        DOC
                        <span class="absolute -top-2 -right-4 text-[10px] text-blue-400 font-bold">
                            HH
                        </span>
                    </span>
                </h1>

            </div>

            <!-- Slogan -->
            <p class="text-sm text-slate-400 text-center max-w-xs">
                Nền tảng chia sẻ tài liệu học tập dành cho sinh viên và giảng viên
            </p>

        </div>
        <!-- RIGHT: FORM -->
        <div class="p-8 md:p-10 bg-white shadow-2xl">

            <h3 class="text-xl font-bold text-center mb-6 text-slate-800">
                Đăng ký tài khoản
            </h3>

            {{-- ERROR --}}
            @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-3 rounded-xl text-sm mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('postRegister') }}" class="space-y-4">
                @csrf

                <!-- HỌ TÊN -->
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase">Họ và tên</label>
                    <div class="flex items-center bg-slate-100 rounded-xl px-4 mt-1">
                        <i class="fas fa-user text-slate-400 mr-2"></i>
                        <input type="text" name="full_name" class="w-full bg-transparent py-3 outline-none text-sm"
                            placeholder="Nhập họ tên..." required>
                    </div>
                </div>

                <!-- USERNAME -->
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase">Username</label>
                    <div class="flex items-center bg-slate-100 rounded-xl px-4 mt-1">
                        <i class="fas fa-id-badge text-slate-400 mr-2"></i>
                        <input type="text" name="username" class="w-full bg-transparent py-3 outline-none text-sm"
                            placeholder="Nhập username..." required>
                    </div>
                </div>

                <!-- EMAIL -->
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase">Email</label>
                    <div class="flex items-center bg-slate-100 rounded-xl px-4 mt-1">
                        <i class="fas fa-envelope text-slate-400 mr-2"></i>
                        <input type="email" name="email" class="w-full bg-transparent py-3 outline-none text-sm"
                            placeholder="Nhập email..." required>
                    </div>
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase">Mật khẩu</label>
                    <div class="flex items-center bg-slate-100 rounded-xl px-4 mt-1">
                        <i class="fas fa-lock text-slate-400 mr-2"></i>
                        <input type="password" name="password" class="w-full bg-transparent py-3 outline-none text-sm"
                            placeholder="Nhập mật khẩu..." required>
                    </div>
                </div>

                <!-- CONFIRM -->
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase">Xác nhận mật khẩu</label>
                    <div class="flex items-center bg-slate-100 rounded-xl px-4 mt-1">
                        <i class="fas fa-lock text-slate-400 mr-2"></i>
                        <input type="password" name="password_confirmation"
                            class="w-full bg-transparent py-3 outline-none text-sm" placeholder="Nhập lại mật khẩu..."
                            required>
                    </div>
                </div>

                <!-- BUTTON -->
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-800 
                       text-white py-3 rounded-xl font-bold 
                       shadow-lg shadow-blue-500/30 
                       hover:shadow-blue-500/50 hover:-translate-y-0.5 transition">
                    Đăng ký
                </button>
            </form>

            <p class="text-center text-sm text-slate-500 mt-5">
                Đã có tài khoản?
                <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">
                    Đăng nhập
                </a>
            </p>

        </div>

    </div>

</body>

</html>