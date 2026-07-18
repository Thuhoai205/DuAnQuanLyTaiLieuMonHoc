<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EDU DOC')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo01.png') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap');

    body {
        font-family: 'Lexend', sans-serif;
    }

    .glass-nav {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
    }

    .hero-gradient {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
    }

    .doc-card {
        transition: all 0.3s;
    }

    .doc-card:hover {
        transform: translateY(-8px);
    }

    /* Ẩn trang khi load */
    .loading-hidden {
        opacity: 0;
    }

    /* Hiện mượt */
    .loading-show {
        opacity: 1;
        transition: opacity 0.4s ease;
    }

    .line {
        height: 6px;
        width: 80px;
        border-radius: 999px;
        background: linear-gradient(to right, #2563eb, #22d3ee);
        position: relative;
        overflow: hidden;
    }

    /* Đảo gradient bên phải */
    .line.right {
        background: linear-gradient(to left, #2563eb, #22d3ee);
    }

    /* Hiệu ứng ánh sáng chạy */
    .line::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.7), transparent);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        100% {
            left: 100%;
        }
    }

    /* Dot giữa */
    .dot {
        width: 10px;
        height: 10px;
        background: #2563eb;
        border-radius: 999px;
        margin: 0 10px;
        animation: pulse 1.5s infinite;
        box-shadow: 0 0 10px rgba(37, 99, 235, 0.6);
    }

    /* Nhịp đập */
    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.4);
            opacity: 0.6;
        }
    }
    </style>

    <!-- Ngăn FOUC tốt hơn -->
    <script>
    document.documentElement.classList.add('loading-hidden');
    </script>
</head>

<body class="bg-slate-50 text-slate-900" style="font-family: 'Roboto', sans-serif;">
    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Nội dung --}}
    @yield('content')

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Script --}}
    @stack('scripts')

    <script>
    window.addEventListener("load", function() {
        document.documentElement.classList.remove("loading-hidden");
        document.documentElement.classList.add("loading-show");
    });
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>