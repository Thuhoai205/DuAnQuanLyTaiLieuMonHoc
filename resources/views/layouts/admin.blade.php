<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    <style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .sidebar-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-scroll::-webkit-scrollbar-thumb {
        background: rgba(34, 211, 238, 0.25);
        border-radius: 999px;
    }

    .admin-link {
        position: relative;
        transition: all .25s ease;
    }

    .admin-link::before {
        content: "";
        position: absolute;
        left: -16px;
        top: 50%;
        width: 4px;
        height: 0;
        transform: translateY(-50%);
        border-radius: 999px;
        background: #22d3ee;
        transition: all .25s ease;
    }

    .admin-link:hover {
        background: rgba(34, 211, 238, .10);
        color: #e0faff;
        transform: translateX(4px);
    }

    .admin-link:hover .menu-icon {
        background: rgba(34, 211, 238, .18);
        color: #67e8f9;
    }

    .admin-link.active {
        background: linear-gradient(135deg, #06b6d4, #0891b2);
        color: #ffffff;
        box-shadow: 0 16px 35px rgba(6, 182, 212, .28);
    }

    .admin-link.active::before {
        height: 34px;
    }

    .admin-link.active .menu-icon {
        background: rgba(255, 255, 255, .2);
        color: #ffffff;
    }
    </style>
</head>

<body class="bg-[#EAFBFF] text-slate-800 h-screen overflow-hidden">

    @php
    $unreadMenuLogs = \App\Models\ActivityLog::where('is_read', false)->count();
    $adminUser = Auth::user();
    @endphp

    <div class="flex h-screen bg-[#020617]">

        <!-- SIDEBAR -->
        <aside class="w-72 bg-[#020617] text-slate-300 flex flex-col border-r border-slate-800/80">
            <!-- LOGO -->
            <div class="relative h-20 min-h-20 px-6 border-b border-slate-800/80 flex items-center overflow-hidden">
                <div class="absolute -top-16 -right-16 w-36 h-36 rounded-full bg-cyan-500/10 blur-2xl"></div>
                <div class="absolute -bottom-16 -left-16 w-36 h-36 rounded-full bg-sky-500/10 blur-2xl"></div>

                <a href="{{ route('admin.dashboard') }}" class="relative flex items-center gap-4 group">
                    <div
                        class="w-12 h-12 rounded-[18px] bg-gradient-to-br from-cyan-400 via-cyan-500 to-sky-600 text-white flex items-center justify-center shadow-lg shadow-cyan-500/25 ring-1 ring-white/10 group-hover:scale-105 transition-all duration-300">
                        <i class="fa-solid fa-graduation-cap text-xl"></i>
                    </div>

                    <div class="leading-none">
                        <h1 class="text-[26px] font-black tracking-[-0.06em]">
                            <span class="text-white drop-shadow-sm">EDU</span><span
                                class="text-cyan-400 drop-shadow-sm">DOC</span>
                        </h1>

                        <p class="mt-2 text-[10px] font-black uppercase tracking-[0.32em] text-slate-500">
                            Admin Panel
                        </p>
                    </div>
                </a>
            </div>


            <!-- NAV -->
            <nav class="sidebar-scroll flex-1 px-4 py-6 overflow-y-auto">

                <p class="px-4 mb-3 text-[11px] uppercase tracking-[0.22em] font-black text-slate-500">
                    Hệ thống
                </p>

                <div class="space-y-2 mb-7">
                    <a href="{{ route('admin.dashboard') }}"
                        class="admin-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-2xl font-bold">
                        <span
                            class="menu-icon w-10 h-10 rounded-xl bg-white/5 text-cyan-300 flex items-center justify-center transition">
                            <i class="fa-solid fa-chart-line"></i>
                        </span>
                        <span>Tổng quan</span>
                    </a>
                </div>

                <p class="px-4 mb-3 text-[11px] uppercase tracking-[0.22em] font-black text-slate-500">
                    Quản lý
                </p>

                <div class="space-y-2 mb-7">
                    <a href="{{ route('admin.users.index') }}"
                        class="admin-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-2xl font-bold">
                        <span
                            class="menu-icon w-10 h-10 rounded-xl bg-white/5 text-cyan-300 flex items-center justify-center transition">
                            <i class="fa-solid fa-users"></i>
                        </span>
                        <span>Người dùng</span>
                    </a>

                    <a href="{{ route('admin.subjects.index') }}"
                        class="admin-link {{ request()->routeIs('admin.subjects.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-2xl font-bold">
                        <span
                            class="menu-icon w-10 h-10 rounded-xl bg-white/5 text-cyan-300 flex items-center justify-center transition">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </span>
                        <span>Môn học</span>
                    </a>

                    <a href="{{ route('admin.document-types.index') }}"
                        class="admin-link {{ request()->routeIs('admin.document-types.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-2xl font-bold">
                        <span
                            class="menu-icon w-10 h-10 rounded-xl bg-white/5 text-cyan-300 flex items-center justify-center transition">
                            <i class="fa-solid fa-layer-group"></i>
                        </span>
                        <span>Loại tài liệu</span>
                    </a>
                </div>

                <p class="px-4 mb-3 text-[11px] uppercase tracking-[0.22em] font-black text-slate-500">
                    Báo cáo
                </p>

                <div class="space-y-2">
                    <a href="{{ route('admin.statistics.index') }}"
                        class="admin-link {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-2xl font-bold">
                        <span
                            class="menu-icon w-10 h-10 rounded-xl bg-white/5 text-cyan-300 flex items-center justify-center transition">
                            <i class="fa-solid fa-chart-pie"></i>
                        </span>
                        <span>Thống kê</span>
                    </a>

                    <a href="{{ route('admin.logs.index') }}"
                        class="admin-link {{ request()->routeIs('admin.logs.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-3 rounded-2xl font-bold">
                        <span
                            class="menu-icon w-10 h-10 rounded-xl bg-white/5 text-cyan-300 flex items-center justify-center transition">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </span>

                        <span>Nhật ký</span>

                        @if($unreadMenuLogs > 0)
                        <span
                            class="ml-auto min-w-[24px] h-6 px-2 rounded-full bg-red-500 text-white text-xs font-black flex items-center justify-center">
                            {{ $unreadMenuLogs >10 ? '10+' : $unreadMenuLogs }}
                        </span>
                        @endif
                    </a>
                </div>

            </nav>

            <!-- LOGOUT -->
            <div class="p-4 border-t border-slate-800/80 space-y-3">

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
        <main class="flex-1 flex flex-col bg-[#EAFBFF] overflow-hidden">

            <!-- TOP BAR -->
            <header
                class="h-18 min-h-18 bg-[#020617] border-b border-slate-800 flex items-center justify-end px-8 shadow-[0_8px_30px_rgba(2,6,23,0.22)]">

                <!-- RIGHT -->
                <div class="ml-auto flex items-center justify-end gap-4">

                    <!-- DATE -->
                    <div
                        class="hidden xl:flex items-center gap-3 px-4 py-3 rounded-2xl bg-white/10 border border-white/10 text-white backdrop-blur">
                        <div class="w-10 h-10 rounded-xl bg-cyan-400/15 text-cyan-300 flex items-center justify-center">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>

                        <div class="leading-tight">
                            <p class="text-xs font-bold text-slate-400">
                                Hôm nay
                            </p>

                            <p class="text-sm font-black text-white">
                                {{ now()->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- NOTIFICATION -->
                    <div class="relative">
                        @includeIf('admin.partials.notifications')
                    </div>

                    <!-- USER DROPDOWN -->
                    <div class="relative group">

                        <div
                            class="flex items-center gap-3 cursor-pointer bg-white/10 hover:bg-white/15 border border-white/10 rounded-2xl px-4 py-2 transition-all backdrop-blur">

                            <img src="{{ $adminUser->avatar ? asset('storage/' . $adminUser->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($adminUser->full_name) . '&background=06b6d4&color=fff' }}"
                                class="w-11 h-11 rounded-2xl object-cover border-2 border-white/40 shadow">

                            <div class="hidden sm:block leading-tight max-w-[170px]">
                                <p class="text-sm font-black text-white truncate">
                                    {{ $adminUser->full_name }}
                                </p>

                                <p class="text-xs font-bold text-cyan-300">
                                    Quản trị viên
                                </p>
                            </div>

                            <div
                                class="w-8 h-8 rounded-xl bg-white/10 text-cyan-300 flex items-center justify-center border border-white/10">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>

                        <!-- MENU -->
                        <div
                            class="absolute right-0 top-[118%] w-72 bg-white rounded-[26px] shadow-2xl shadow-cyan-950/20 border border-cyan-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible translate-y-2 group-hover:translate-y-0 transition-all duration-200 z-[9999] overflow-hidden">



                            <a href="{{ route('profile') }}"
                                class="flex items-center gap-3 px-5 py-4 text-sm font-bold text-slate-600 hover:bg-cyan-50 hover:text-cyan-600 transition">
                                <span
                                    class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                                    <i class="fa-solid fa-user"></i>
                                </span>

                                <span>Hồ sơ cá nhân</span>
                            </a>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf

                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-5 py-4 text-sm font-bold text-red-500 hover:bg-red-50 transition">
                                    <span
                                        class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                    </span>

                                    <span>Đăng xuất</span>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

            </header>

            <!-- CONTENT -->
            <div id="admin-content" class="relative flex-1 overflow-y-auto bg-[#EAFBFF] p-8">
                <div class="pointer-events-none fixed top-24 right-12 w-80 h-80 rounded-full bg-cyan-300/20 blur-3xl">
                </div>
                <div class="pointer-events-none fixed bottom-10 left-96 w-80 h-80 rounded-full bg-sky-300/20 blur-3xl">
                </div>

                <div class="relative z-10">
                    @yield('content')
                </div>
            </div>

        </main>

    </div>

    @stack('scripts')
</body>

</html>