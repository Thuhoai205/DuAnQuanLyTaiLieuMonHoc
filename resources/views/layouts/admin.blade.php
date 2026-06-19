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
        width: 5px;
    }

    .sidebar-scroll::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, 0.25);
        border-radius: 999px;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 18px;
        color: #a8b3c2;
        font-size: 13px;
        font-weight: 700;
        transition: all 0.22s ease;
        border-left: 3px solid transparent;
    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.045);
        color: #ffffff;
        border-left-color: #38bdf8;
    }

    .nav-link.active {
        background: rgba(56, 189, 248, 0.12);
        color: #ffffff;
        border-left-color: #38bdf8;
    }

    .nav-link .nav-icon {
        width: 18px;
        text-align: center;
        color: #7f8ea3;
    }

    .nav-link:hover .nav-icon,
    .nav-link.active .nav-icon {
        color: #38bdf8;
    }

    .menu-title {
        color: #6b7a90;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        padding: 18px 18px 8px;
    }

    .top-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        transition: all 0.2s ease;
    }

    .top-icon:hover {
        background: #f1f5f9;
        color: #0ea5e9;
    }
    </style>
</head>

<body class="h-screen overflow-hidden bg-[#eef2f7] text-slate-700">

    @php
    $todayLogCount = \App\Models\ActivityLog::whereDate('created_at', today())->count();
    $adminUser = Auth::user();
    @endphp

    <div class="flex h-screen">

        <!-- SIDEBAR -->
        <aside class="w-[230px] min-w-[230px] h-screen bg-[#263445] text-slate-300 flex flex-col">

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


            <!-- NAVIGATION -->
            <nav class="sidebar-scroll flex-1 overflow-y-auto py-3">

                <div class="menu-title">
                    Navigation
                </div>

                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-house"></i>
                    <span>Dashboard</span>

                    <i class="fa-solid fa-chevron-down ml-auto text-[10px] opacity-50"></i>
                </a>

                <div class="menu-title">
                    Quản lý
                </div>

                <a href="{{ route('admin.users.index') }}"
                    class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-users"></i>
                    <span>Người dùng</span>
                </a>

                <a href="{{ route('admin.subjects.index') }}"
                    class="nav-link {{ request()->routeIs('admin.subjects.*') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-book-open"></i>
                    <span>Môn học</span>
                </a>

                <a href="{{ route('admin.document-types.index') }}"
                    class="nav-link {{ request()->routeIs('admin.document-types.*') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-layer-group"></i>
                    <span>Loại tài liệu</span>

                    <span class="ml-auto text-[10px] px-2 py-0.5 rounded bg-orange-400 text-white font-black">
                        New
                    </span>
                </a>

                <div class="menu-title">
                    Báo cáo
                </div>

                <a href="{{ route('admin.statistics.index') }}"
                    class="nav-link {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-chart-pie"></i>
                    <span>Thống kê</span>

                    <span class="ml-auto text-[10px] px-2 py-0.5 rounded bg-cyan-500 text-white font-black">
                        Info
                    </span>
                </a>

                <a href="{{ route('admin.logs.index') }}"
                    class="nav-link {{ request()->routeIs('admin.logs.*') ? 'active' : '' }}">
                    <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
                    <span>Nhật ký</span>

                    @if($todayLogCount > 0)
                    <span class="ml-auto text-[10px] px-2 py-0.5 rounded bg-pink-500 text-white font-black">
                        {{ $todayLogCount > 10 ? '10+' : $todayLogCount }}
                    </span>
                    @endif
                </a>

                <div class="menu-title">
                    Khác
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
            <header
                class="h-[58px] min-h-[58px] bg-white border-b border-slate-200 flex items-center px-5 shadow-sm z-40">

                <!-- LEFT ICONS -->
                <div class="relative flex items-center gap-1">

                    <!-- SEARCH BUTTON -->
                    <button type="button" id="adminSearchToggle" class="top-icon">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </button>

                    <!-- SEARCH BOX -->
                    <div id="adminSearchBox"
                        class="hidden absolute left-0 top-[115%] w-[320px] bg-white border border-slate-200 rounded-2xl shadow-xl p-3 z-[9999]">
                        <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-slate-50 border border-slate-100">
                            <i class="fa-solid fa-magnifying-glass text-slate-400 text-sm"></i>

                            <input type="text" id="adminSearchInput" placeholder="Nhập từ khóa tìm kiếm..."
                                class="w-full bg-transparent outline-none text-sm font-semibold text-slate-700 placeholder:text-slate-400">
                        </div>

                        <p class="mt-2 text-[11px] font-semibold text-slate-400">
                            Nhấn Enter để tìm kiếm trong trang hiện tại
                        </p>
                    </div>

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
                        class="hidden lg:flex items-center gap-2 px-3 py-2 rounded-xl text-slate-500 text-xs font-bold">
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
                                <p class="text-sm font-black text-slate-800 truncate">
                                    {{ $adminUser->full_name }}
                                </p>

                                <p class="text-xs font-semibold text-slate-500 truncate mt-0.5">
                                    {{ $adminUser->email }}
                                </p>
                            </div>

                            <a href="{{ route('profile') }}"
                                class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-600 hover:bg-slate-50">
                                <i class="fa-solid fa-user text-sky-500 w-5"></i>
                                <span>Hồ sơ cá nhân</span>
                            </a>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf

                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold text-red-500 hover:bg-red-50">
                                    <i class="fa-solid fa-right-from-bracket w-5"></i>
                                    <span>Đăng xuất</span>
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            </header>

            <!-- PAGE HEADER -->
            <div
                class="h-[76px] min-h-[76px] bg-[#eef2f7] px-7 flex items-center justify-between border-b border-slate-200/60">

                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-sky-500 text-white flex items-center justify-center shadow">
                        <i class="fa-solid fa-house"></i>
                    </div>

                    <div>
                        <h2 class="text-lg font-bold text-slate-700">
                            @yield('page-title', 'Dashboard')
                        </h2>

                        <p class="text-xs font-semibold text-slate-400 mt-0.5">
                            Hệ thống quản lý tài liệu môn học
                        </p>
                    </div>
                </div>

                <div class="hidden md:flex items-center gap-2 text-xs font-bold text-slate-500">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-sky-500">
                        <i class="fa-solid fa-house text-[11px]"></i>
                    </a>

                    <span>/</span>

                    <span>@yield('page-title', 'Dashboard')</span>
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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchToggle = document.getElementById('adminSearchToggle');
        const searchBox = document.getElementById('adminSearchBox');
        const searchInput = document.getElementById('adminSearchInput');

        const fullscreenToggle = document.getElementById('adminFullscreenToggle');
        const fullscreenIcon = document.getElementById('adminFullscreenIcon');

        // Mở / đóng ô tìm kiếm
        if (searchToggle && searchBox && searchInput) {
            searchToggle.addEventListener('click', function(event) {
                event.stopPropagation();

                searchBox.classList.toggle('hidden');

                if (!searchBox.classList.contains('hidden')) {
                    setTimeout(function() {
                        searchInput.focus();
                    }, 100);
                }
            });

            searchBox.addEventListener('click', function(event) {
                event.stopPropagation();
            });

            document.addEventListener('click', function() {
                searchBox.classList.add('hidden');
            });

            searchInput.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    const keyword = searchInput.value.trim();

                    if (keyword === '') {
                        return;
                    }

                    const currentPath = window.location.pathname;

                    const routes = {
                        users: "{{ route('admin.users.index') }}",
                        subjects: "{{ route('admin.subjects.index') }}",
                        documentTypes: "{{ route('admin.document-types.index') }}",
                        logs: "{{ route('admin.logs.index') }}",
                    };

                    let url;
                    let paramName;

                    if (currentPath.includes('/admin/users')) {
                        url = new URL(routes.users, window.location.origin);
                        paramName = 'search';
                    } else if (currentPath.includes('/admin/subjects')) {
                        url = new URL(routes.subjects, window.location.origin);
                        paramName = 'search';
                    } else if (currentPath.includes('/admin/document-types')) {
                        url = new URL(routes.documentTypes, window.location.origin);
                        paramName = 'keyword';
                    } else if (currentPath.includes('/admin/logs')) {
                        url = new URL(routes.logs, window.location.origin);
                        paramName = 'keyword';
                    } else {
                        url = new URL(routes.subjects, window.location.origin);
                        paramName = 'search';
                    }

                    url.searchParams.set(paramName, keyword);

                    window.location.href = url.toString();
                }
            });
        }

        // Bật / tắt toàn màn hình
        if (fullscreenToggle && fullscreenIcon) {
            fullscreenToggle.addEventListener('click', function() {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen();
                } else {
                    document.exitFullscreen();
                }
            });

            document.addEventListener('fullscreenchange', function() {
                if (document.fullscreenElement) {
                    fullscreenIcon.classList.remove('fa-expand');
                    fullscreenIcon.classList.add('fa-compress');
                } else {
                    fullscreenIcon.classList.remove('fa-compress');
                    fullscreenIcon.classList.add('fa-expand');
                }
            });
        }
    });
    </script>
    @stack('scripts')

</body>

</html>