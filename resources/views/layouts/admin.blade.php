<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .admin-link {
        transition: all .25s ease;
    }

    .admin-link:hover {
        background: rgba(6, 182, 212, .12);
        color: #67e8f9;
        transform: translateX(4px);
    }

    .admin-link.active {
        background: #06b6d4;
        color: white;
        box-shadow: 0 12px 30px rgba(6, 182, 212, .25);
    }
    </style>
</head>

<body class="bg-[#EAFBFF] text-slate-800 h-screen overflow-hidden">

    <div class="flex h-screen">

        <!-- SIDEBAR -->
        <aside class="w-72 bg-slate-950 text-slate-300 flex flex-col border-r border-slate-800">

            <!-- LOGO -->
            <div class="p-6 border-b border-slate-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div
                        class="w-13 h-13 w-[52px] h-[52px] rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-500/25">
                        <i class="fa-solid fa-book-open text-xl"></i>
                    </div>

                    <div>
                        <h1 class="text-2xl font-black tracking-tight">
                            <span class="text-white">EDU</span><span class="text-cyan-400">DOC</span>
                        </h1>
                        <p class="text-[10px] uppercase tracking-[0.28em] text-slate-500 font-bold">
                            Admin Panel
                        </p>
                    </div>
                </a>
            </div>

            <!-- NAV -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">

                <a href="{{ route('admin.dashboard') }}"
                    class=" admin-link ajax-link {{ request()->is('admin/dashboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-2xl font-bold">
                    <i class="fa-solid fa-chart-line w-5"></i>
                    <span>Tổng quan</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="admin-link  {{ request()->is('admin/users*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-2xl font-bold">
                    <i class="fa-solid fa-users w-5"></i>
                    <span>Người dùng</span>
                </a>

                <a href="{{ url('/admin/subjects') }}"
                    class="admin-link {{ request()->is('admin/subjects*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-2xl font-bold">
                    <i class="fa-solid fa-graduation-cap w-5"></i>
                    <span>Môn học</span>
                </a>



                <a href="{{ url('/admin/categories') }}"
                    class="admin-link {{ request()->is('admin/categories*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-2xl font-bold">
                    <i class="fa-solid fa-layer-group w-5"></i>
                    <span>Loại tài liệu</span>
                </a>

                <a href="{{ url('/admin/statistics') }}"
                    class="admin-link {{ request()->is('admin/statistics*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-2xl font-bold">
                    <i class="fa-solid fa-chart-pie w-5"></i>
                    <span>Thống kê</span>
                </a>

                <a href="{{ url('/admin/logs') }}"
                    class="admin-link {{ request()->is('admin/logs*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-2xl font-bold">
                    <i class="fa-solid fa-clock-rotate-left w-5"></i>
                    <span>Nhật ký</span>
                </a>

                <a href="{{ url('/admin/settings') }}"
                    class="admin-link {{ request()->is('admin/settings*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-2xl font-bold">
                    <i class="fa-solid fa-gear w-5"></i>
                    <span>Cài đặt</span>
                </a>

            </nav>

            <!-- LOGOUT -->
            <div class="p-4 border-t border-slate-800 space-y-3">

                <a href="{{ route('home') }}"
                    class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-2xl bg-cyan-500/10 text-cyan-300 hover:bg-cyan-500 hover:text-white font-bold transition-all">
                    <i class="fa-solid fa-house"></i>
                    Về trang chủ
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-2xl bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white font-bold transition-all">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Đăng xuất
                    </button>
                </form>

            </div>

        </aside>

        <!-- MAIN -->
        <main class="flex-1 flex flex-col bg-[#EAFBFF]">
            <!-- HEADER -->
            <header
                class="relative z-[9999] h-20 bg-white/95 backdrop-blur-xl border-b border-cyan-100 flex items-center justify-between px-8 shadow-[0_8px_30px_rgba(8,145,178,0.06)]">
                <!-- LEFT -->
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.22em] text-cyan-600 mb-1">
                        Admin Dashboard
                    </p>

                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">
                        @yield('page-title', 'Tổng quan hệ thống')
                    </h2>
                </div>

                <!-- RIGHT -->
                <div class="flex items-center gap-4">

                    <!-- NOTIFICATION -->
                    <button
                        class="relative w-12 h-12 rounded-2xl bg-cyan-50 text-cyan-600 border border-cyan-100 flex items-center justify-center hover:bg-cyan-500 hover:text-white transition-all">
                        <i class="fa-solid fa-bell"></i>

                        <span
                            class="absolute top-3 right-3 w-2.5 h-2.5 rounded-full bg-red-500 border-2 border-white"></span>
                    </button>

                    <!-- USER DROPDOWN -->
                    <div class="relative group">

                        <div
                            class="flex items-center gap-3 cursor-pointer bg-cyan-50 hover:bg-cyan-100 border border-cyan-100 rounded-2xl px-4 py-2 transition-all">

                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->full_name) . '&background=06b6d4&color=fff' }}"
                                class="w-10 h-10 rounded-xl object-cover border-2 border-white shadow">

                            <div class="hidden sm:block leading-tight">
                                <p class="text-sm font-black text-slate-800">
                                    {{ auth()->user()->full_name }}
                                </p>

                                <p class="text-xs font-bold text-cyan-600">
                                    Quản trị viên
                                </p>
                            </div>

                            <i class="fa-solid fa-chevron-down text-xs text-cyan-600"></i>
                        </div>

                        <!-- MENU -->
                        <div
                            class="absolute right-0 top-[115%] w-56 bg-white rounded-2xl shadow-2xl border border-cyan-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible translate-y-2 group-hover:translate-y-0 transition-all duration-200 z-[9999]">
                            <a href="{{ route('profile') }}"
                                class="flex items-center gap-3 px-5 py-3 text-sm font-bold text-slate-600 hover:bg-cyan-50 hover:text-cyan-600 transition">
                                <i class="fa-solid fa-user w-4"></i>
                                Hồ sơ
                            </a>



                            <form action="{{ route('logout') }}" method="POST">
                                @csrf

                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-5 py-3 text-sm font-bold text-red-500 hover:bg-red-50 transition">
                                    <i class="fa-solid fa-right-from-bracket w-4"></i>
                                    Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

            </header>

            <!-- CONTENT -->
            <div id="admin-content" class="relative z-0 flex-1 overflow-y-auto p-8">
                @yield('content')
            </div>

        </main>

    </div>

</body>

</html>