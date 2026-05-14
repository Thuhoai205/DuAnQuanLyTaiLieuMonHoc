<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://0cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .sidebar-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .sidebar-item.active {
        background-color: #3b82f6;
        color: white;
    }
    </style>
</head>

<body class="bg-gray-50 flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="bg-slate-900 text-gray-300 w-64 flex flex-col">

        <div class="p-6 border-b border-slate-800 text-white font-bold text-xl">
            <i class="fas fa-book-open text-blue-500 mr-2"></i> EDU-DOC
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">

            <a href="{{ url('/admin/dashboard') }}" class="sidebar-item flex items-center p-3 rounded-lg">
                <i class="fas fa-chart-line w-6"></i>
                <span class="ml-3">Tổng quan</span>
            </a>

            <a href="{{ url('/admin/users') }}" class="sidebar-item flex items-center p-3 rounded-lg">
                <i class="fas fa-users"></i>
                <span class="ml-3">Người dùng</span>
            </a>

            <a href="{{ url('/admin/subjects') }}" class="sidebar-item flex items-center p-3 rounded-lg">
                <i class="fas fa-graduation-cap"></i>
                <span class="ml-3">Môn học</span>
            </a>

            <a href="{{ url('/admin/docs') }}" class="sidebar-item flex items-center p-3 rounded-lg">
                <i class="fas fa-file-alt"></i>
                <span class="ml-3">Tài liệu</span>
            </a>

        </nav>

        <div class="p-4 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-red-400">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </button>
            </form>
        </div>

    </aside>

    <!-- MAIN -->
    <main class="flex-1 flex flex-col">

        <!-- HEADER -->
        <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6">
            <h2 class="text-xl font-semibold">@yield('page-title')</h2>

            <div class="flex items-center space-x-3">
                <img src="https://ui-avatars.com/api/?name=Admin" class="w-8 h-8 rounded-full">
                <span>Quản trị viên</span>
            </div>
        </header>

        <!-- CONTENT -->
        <div class="p-6 overflow-y-auto flex-1">
            @yield('content')
        </div>

    </main>

</body>

</html>