<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-slate-50 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md">

        <!-- LOGO -->
        <div class="flex flex-col items-center mb-8">

            <div class="flex items-center gap-3">

                <div class="bg-gradient-to-br from-blue-500 to-blue-700 p-3 rounded-2xl shadow-lg shadow-blue-500/30">
                    <i class="fas fa-graduation-cap text-white text-2xl"></i>
                </div>

                <a href="{{ route('home') }}"
                    class="text-3xl font-extrabold tracking-tight text-slate-800 flex items-center">
                    EDU
                    <span class="relative text-blue-600 ml-1">
                        DOC
                        <span class="absolute -top-2 -right-4 text-[10px] text-blue-400 font-bold">
                            HH
                        </span>
                    </span>
                </a>

            </div>

            <p class="text-xs text-slate-400 uppercase tracking-widest mt-3">
                Hệ thống học liệu
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white p-8 rounded-3xl shadow-xl border border-slate-100">

            <h3 class="text-xl font-bold text-center mb-6 text-slate-800">
                Đăng nhập hệ thống
            </h3>

            {{-- SUCCESS --}}
            @if (session('success'))
            <div class="bg-green-100 text-green-600 p-3 rounded-xl text-sm mb-4">
                {{ session('success') }}
            </div>
            @endif

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

            <!-- FORM -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- EMAIL -->
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase">Email</label>
                    <div class="flex items-center bg-slate-100 rounded-xl px-4 mt-1">
                        <i class="fas fa-envelope text-slate-400 mr-2"></i>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full bg-transparent py-3 outline-none text-sm" placeholder="Nhập email..."
                            required>
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

                <!-- BUTTON -->
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-800 
                           text-white py-3 rounded-xl font-bold 
                           shadow-lg shadow-blue-500/30 
                           hover:shadow-blue-500/50 hover:-translate-y-0.5 
                           transition-all duration-300">
                    Đăng nhập
                </button>
            </form>

            <!-- REGISTER -->
            <p class="text-center text-sm text-slate-500 mt-5">
                Chưa có tài khoản?
                <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">
                    Đăng ký
                </a>
            </p>

        </div>

    </div>

</body>

</html>