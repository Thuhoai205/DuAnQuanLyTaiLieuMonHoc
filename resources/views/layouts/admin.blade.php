<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo01.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .sidebar-scroll::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar-scroll::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, 0.25);
        border-radius: 999px;
    }

    /* ================= MENU ================= */

    .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 18px;
        color: #a8b3c2;
        font-size: 11px;
        font-weight: 700;
        transition: all .25s ease;
        border-left: 3px solid transparent;
    }

    .nav-link:hover {
        background: rgba(245, 158, 11, .08);
        color: #ffffff;
        border-left-color: #f59e0b;
    }

    .nav-link.active {
        background: rgba(245, 158, 11, .14);
        color: #ffffff;
        border-left-color: #f59e0b;
    }

    .nav-link .nav-icon {
        width: 18px;
        text-align: center;
        color: #7f8ea3;
        transition: .25s;
    }

    .nav-link:hover .nav-icon,
    .nav-link.active .nav-icon {
        color: #f59e0b;
    }

    /* ================= MENU TITLE ================= */

    .menu-title {
        color: #6b7280;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
        padding: 18px 18px 8px;
    }

    /* ================= TOP ICON ================= */

    .top-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        transition: all .25s ease;
    }

    .top-icon i {
        font-size: 13px;
    }

    .top-icon:hover {
        background: #fef3c7;
        color: #f59e0b;
    }
    </style>
</head>

<body class="h-screen overflow-hidden  text-slate-700">

    @php
    $todayLogCount = \App\Models\ActivityLog::whereDate('created_at', today())->count();
    $adminUser = Auth::user();
    @endphp

    <div class="flex h-screen">

        <!-- SIDEBAR -->
        <aside class="w-[200px] h-screen bg-[#263445] text-slate-300 flex flex-col">
            <!-- LOGO -->
            <div class="relative h-16 min-h-16 px-5 border-b border-slate-800/60 flex items-center overflow-hidden">

                <!-- background glow -->
                <div class="absolute -top-10 -right-10 w-28 h-28 rounded-full bg-cyan-500/10 blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 w-28 h-28 rounded-full bg-sky-500/10 blur-2xl"></div>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group flex-shrink-0">

                    <div class="w-10 h-10 rounded-[14px]
    overflow-hidden
    bg-white
    shadow-md
    ring-1 ring-slate-200">

                        <img src="{{ asset('img/logo01.png') }}" class="w-full h-full object-cover">

                    </div>
                    <div class="leading-tight">

                        <h1 class="text-xl font-black tracking-tight">
                            <span class="text-white">EDU</span>
                            <span class="text-amber-500">DOC</span>
                        </h1>

                        <p class="mt-0.5 text-[9px] uppercase tracking-[0.28em] text-slate-500 font-semibold">
                            Admin Panel
                        </p>
                    </div>

                </a>
                </a>
            </div>

            <!-- NAVIGATION -->
            <nav class="sidebar-scroll flex-1 overflow-y-auto py-3">

                <div class="menu-title flex items-center gap-2">
                    <i class="fa-solid fa-compass text-[10px] text-amber-500"></i>
                    <span>Tổng quan</span>
                </div>


                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-house"></i>
                    <span>Dashboard</span>

                </a>

                <div class="menu-title flex items-center gap-2">
                    <i class="fa-solid fa-folder-tree text-[10px] text-amber-500"></i>
                    <span>Quản lý</span>
                </div>

                <a href="{{ route('admin.users.index') }}"
                    class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-users"></i>
                    <span>Người dùng</span>
                </a>
                <a href="{{ route('admin.faculties.index') }}"
                    class="nav-link {{ request()->routeIs('admin.faculties.*') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-building-columns"></i>
                    <span>Khoa</span>
                </a>
                <a href="{{ route('admin.subjects.index') }}"
                    class="nav-link {{ request()->routeIs('admin.subjects.*') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-book-open"></i>
                    <span>Môn học</span>
                </a>
                <a href="{{ route('admin.documents.index') }}"
                    class="nav-link {{ request()->routeIs('admin.documents.*') ? 'active' : '' }}">

                    <i class="nav-icon fa-solid fa-file-lines"></i>
                    <span>Tài liệu</span>

                </a>
                <a href="{{ route('admin.document-types.index') }}"
                    class="nav-link {{ request()->routeIs('admin.document-types.*') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-layer-group"></i>
                    <span>Loại tài liệu</span>


                </a>

                <div class="menu-title flex items-center gap-2">
                    <i class="fa-solid fa-chart-line text-[10px] text-amber-500"></i>
                    <span>Phân tích dữ liệu</span>
                </div>

                <a href="{{ route('admin.statistics.index') }}"
                    class="nav-link {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-chart-column"></i>
                    <span>Thống kê</span>
                </a>

                <a href="{{ route('admin.logs.index') }}"
                    class="nav-link {{ request()->routeIs('admin.logs.*') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-right-to-bracket"></i>
                    <span>Nhật ký</span>

                    @if($todayLogCount > 0)
                    <span class="ml-auto text-[10px] px-2 py-0.5 rounded bg-pink-500 text-white font-black">
                        {{ $todayLogCount > 10 ? '10+' : $todayLogCount }}
                    </span>
                    @endif
                </a>
                <div class="menu-title flex items-center gap-2">
                    <i class="fa-solid fa-gear text-[10px] text-amber-500"></i>
                    <span>Hệ thống</span>
                </div>

                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fa-solid fa-globe"></i>
                    <span>Trang chủ</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" class="mt-1">
                    @csrf

                    <button type="submit" class="nav-link w-full text-left">
                        <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                        <span>Đăng xuất</span>
                    </button>
                </form>

            </nav>
        </aside>

        <!-- MAIN -->
        <main class="flex-1 h-screen flex flex-col overflow-hidden">

            <!-- TOP BAR -->
            <header class="h-16 min-h-16 bg-white border-b border-slate-200 flex items-center px-5 shadow-sm z-40">
                <!-- LEFT ICONS -->
                <div class="relative flex items-center gap-1">
                    <!-- FULLSCREEN BUTTON -->
                    <button type="button" id="adminFullscreenToggle" class="top-icon">
                        <i id="adminFullscreenIcon" class="fa-solid fa-expand text-sm"></i>
                    </button>
                </div>
                <!-- RIGHT -->
                <div class="ml-auto flex items-center gap-2">
                    <!-- NOTIFICATION -->
                    <div class="relative">
                        @includeIf('admin.partials.notifications')
                    </div>
                    <!-- DATE -->
                    <div
                        class="hidden lg:flex items-center gap-2 px-3 py-2 rounded-xl text-slate-500 text-[13px] font-bold">
                        <i class="fa-regular fa-calendar"></i>
                        <span>{{ now()->format('d/m/Y') }}</span>
                    </div>
                    <!-- USER -->
                    <div class="relative group">
                        <button type="button"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-slate-50 transition">

                            <img src="{{ $adminUser->avatar ? asset('storage/' . $adminUser->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($adminUser->full_name) . '&background=263445&color=fff' }}"
                                class="w-9 h-9 rounded-full object-cover border border-slate-200">

                            <span class="hidden md:block text-sm font-bold text-slate-600">
                                {{ $adminUser->full_name }}
                            </span>

                            <i class="fa-solid fa-angle-down text-xs text-slate-400"></i>
                        </button>
                        <!-- DROPDOWN -->
                        <div
                            class="absolute right-0 top-[115%] w-64 bg-white rounded-xl shadow-xl border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible translate-y-2 group-hover:translate-y-0 transition-all duration-200 z-[9999] overflow-hidden">

                            <div class="px-4 py-3 border-b border-slate-100 bg-slate-50">
                                <p class="text-[15px] font-black text-slate-800 truncate">
                                    {{ $adminUser->full_name }}
                                </p>

                                <p class="text-xs font-semibold text-slate-500 truncate mt-0.5">
                                    {{ $adminUser->email }}
                                </p>
                            </div>

                            <a href="{{ route('profile') }}"
                                class="flex items-center gap-3 px-4 py-3 text-[13px] font-bold text-slate-600 hover:bg-slate-50">
                                <i class="fa-solid fa-user text-amber-500 w-5"></i> <span>Hồ sơ cá nhân</span>
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-3 text-[13px] font-bold text-red-500 hover:bg-red-50">
                                    <i class="fa-solid fa-right-from-bracket w-5"></i>
                                    <span>Đăng xuất</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            <!-- PAGE HEADER -->
            <div class="h-[76px] min-h-[76px]
    bg-amber-50
    px-7
    flex items-center justify-between
    border-b border-amber-100">

                <!-- LEFT -->
                <div class="flex items-center gap-4">

                    <div class="w-10 h-10
            rounded-lg
            bg-slate-900
            text-white
            flex items-center justify-center
            shadow-sm">

                        <i class="fa-solid fa-house"></i>

                    </div>

                    <div>

                        <h2 class="text-[15px] font-bold text-slate-800">

                            @yield('page-title', 'Dashboard')

                        </h2>

                        <p class="text-[13px] font-medium text-slate-500 mt-0.5">

                            Hệ thống quản lý tài liệu môn học

                        </p>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="hidden md:flex items-center gap-2 text-xs font-bold text-slate-500">

                    <a href="{{ route('admin.dashboard') }}" class="transition hover:text-amber-500">

                        <i class="fa-solid fa-house text-[11px]"></i>

                    </a>

                    <span class="text-slate-300">/</span>

                    <span class="text-slate-700">

                        @yield('page-title', 'Dashboard')

                    </span>

                </div>

            </div>
            <!-- CONTENT -->
            <section class="flex-1 overflow-y-auto bg-[#eef2f7] p-7">

                <div class="max-w-full">
                    @yield('content')
                </div>

            </section>

        </main>

    </div>

    @stack('scripts')

</body>

</html>
<script>
document.addEventListener('DOMContentLoaded', function() {

    const fullscreenToggle = document.getElementById('adminFullscreenToggle');
    const fullscreenIcon = document.getElementById('adminFullscreenIcon');

    if (!fullscreenToggle || !fullscreenIcon) return;

    fullscreenToggle.addEventListener('click', async function() {

        try {

            if (!document.fullscreenElement) {

                await document.documentElement.requestFullscreen();

            } else {

                await document.exitFullscreen();

            }

        } catch (error) {

            console.error('Fullscreen Error:', error);

        }

    });

    document.addEventListener('fullscreenchange', function() {

        const isFullscreen = !!document.fullscreenElement;

        fullscreenIcon.classList.toggle('fa-expand', !isFullscreen);
        fullscreenIcon.classList.toggle('fa-compress', isFullscreen);

    });

});
</script>