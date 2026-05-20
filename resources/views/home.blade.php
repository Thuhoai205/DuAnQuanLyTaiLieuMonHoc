@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

<!-- HERO -->
<header class="relative overflow-hidden bg-[#0891B2] text-white">

    <div class="absolute inset-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?q=80&w=1600"
            class="w-full h-full object-cover">
    </div>

    <div class="absolute inset-0 bg-[#0891B2]/90"></div>

    <div class="relative max-w-7xl mx-auto px-6 py-20 lg:py-24">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">

            <div>
                <span
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-cyan-700/60 border border-cyan-300/30 text-cyan-50 text-sm font-bold mb-6">
                    <i class="fa-solid fa-bolt"></i>
                    Hệ thống quản lý học liệu
                </span>

                <h1 class="text-4xl md:text-6xl font-black leading-tight mb-6">
                    Khám phá kho tài liệu học tập hiện đại
                </h1>

                <p class="text-cyan-50/90 text-lg leading-relaxed max-w-xl mb-8">
                    Tìm kiếm slide, giáo trình, bài tập và đề thi theo từng môn học.
                    Hỗ trợ sinh viên học tập và giảng viên quản lý tài liệu dễ dàng hơn.
                </p>

                <form action="{{ route('documents.search') }}" method="GET"
                    class="bg-cyan-700/70 border border-cyan-300/30 rounded-[28px] p-3 shadow-2xl">

                    <div class="flex flex-col lg:flex-row gap-3">
                        <div class="flex-1 flex items-center px-5 bg-cyan-800/50 rounded-2xl">
                            <i class="fa-solid fa-magnifying-glass text-cyan-100 mr-3"></i>
                            <input name="keyword" type="text" placeholder="Nhập tên tài liệu, môn học hoặc từ khóa..."
                                class="w-full py-4 bg-transparent text-white placeholder-cyan-100/70 outline-none font-semibold">
                        </div>

                        <select name="subject_id"
                            class="px-5 py-4 rounded-2xl bg-cyan-800/50 text-white font-bold outline-none">
                            <option value="">Tất cả môn học</option>
                            <option value="1">Lập trình Web</option>
                            <option value="2">Cơ sở dữ liệu</option>
                            <option value="3">Mạng máy tính</option>
                        </select>

                        <button
                            class="px-8 py-4 rounded-2xl bg-cyan-300 text-cyan-950 font-black hover:bg-cyan-200 transition shadow-xl">
                            Tìm kiếm
                        </button>
                    </div>
                </form>
            </div>

            <div class="hidden lg:block">
                <div class="relative float-soft">
                    <div class="absolute inset-0 bg-cyan-300/40 blur-3xl rounded-full"></div>

                    <div class="relative rounded-[40px] bg-cyan-700/70 border border-cyan-300/30 p-8 shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1200"
                            class="rounded-[32px] h-[360px] w-full object-cover opacity-90">

                        <div class="absolute -bottom-8 -left-8 bg-cyan-300 text-cyan-950 rounded-[28px] p-6 shadow-2xl">
                            <i class="fa-solid fa-book-open text-4xl mb-3"></i>
                            <p class="text-3xl font-black">1.2K+</p>
                            <p class="text-sm font-bold">Tài liệu học tập</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>

<style>
@keyframes floatSoft {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-14px);
    }
}

.float-soft {
    animation: floatSoft 5s ease-in-out infinite;
}
</style>

<!-- SCRIPT -->
<script>
const slides = document.querySelectorAll('.hero-slide');

let current = 0;

setInterval(() => {

    slides[current].classList.remove('active');

    current = (current + 1) % slides.length;

    slides[current].classList.add('active');

}, 5000);
</script>


<main class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-12">

    <!-- Phần khách vãng lai -->
    @guest
    <style>
    @keyframes floatBlob {

        0%,
        100% {
            transform: translateY(0) translateX(0) scale(1);
        }

        50% {
            transform: translateY(-18px) translateX(14px) scale(1.05);
        }
    }

    @keyframes floatCard {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .guest-blob {
        animation: floatBlob 8s ease-in-out infinite;
    }

    .guest-card-float {
        animation: floatCard 5s ease-in-out infinite;
    }
    </style>

    <!-- GUEST MODERN SECTION -->
    <section
        class="relative overflow-hidden rounded-[3rem] bg-gradient-to-br from-[#0F172A] via-[#1E3A8A] to-[#0E7490] p-8 md:p-12 mb-14 text-white shadow-2xl">

        <div class="absolute -top-24 -right-24 w-96 h-96 bg-cyan-400/25 rounded-full blur-[120px] guest-blob"></div>
        <div class="absolute -bottom-28 -left-20 w-96 h-96 bg-blue-500/25 rounded-full blur-[130px] guest-blob"></div>
        <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-indigo-500/20 rounded-full blur-[120px] guest-blob"></div>

        <div class="absolute inset-0 opacity-[0.08]"
            style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 28px 28px;">
        </div>

        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div>
                <span
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/15 text-cyan-100 text-sm font-bold mb-6 backdrop-blur">
                    <i class="fas fa-bolt text-cyan-300"></i>
                    Kho học liệu thông minh
                </span>

                <h2 class="text-4xl md:text-6xl font-black leading-tight mb-6">
                    Học nhanh hơn với
                    <span class="bg-gradient-to-r from-cyan-200 via-blue-200 to-white bg-clip-text text-transparent">
                        tài liệu chuẩn
                    </span>
                </h2>

                <p class="text-blue-50/90 text-lg leading-relaxed mb-8 max-w-xl">
                    Khám phá slide, đề thi, giáo trình và bài tập theo từng môn học. Đăng nhập để tải tài liệu và lưu
                    lại tài liệu yêu thích.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-2xl bg-cyan-300 text-slate-950 font-black hover:bg-cyan-200 shadow-xl shadow-cyan-400/20 transition hover:-translate-y-1">
                        Đăng nhập ngay
                        <i class="fas fa-arrow-right"></i>
                    </a>

                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-2xl bg-white/10 border border-white/20 text-white font-black hover:bg-white/20 backdrop-blur transition">
                        Tạo tài khoản
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div
                    class="rounded-3xl bg-white/10 border border-white/15 p-6 backdrop-blur-xl hover:bg-white/15 transition guest-card-float">
                    <div
                        class="w-12 h-12 rounded-2xl bg-cyan-300 text-slate-950 flex items-center justify-center text-xl mb-5 shadow-lg shadow-cyan-400/20">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="text-4xl font-black">1.2K+</h3>
                    <p class="text-blue-100 text-sm font-bold mt-1">Tài liệu học tập</p>
                </div>

                <div
                    class="rounded-3xl bg-white/10 border border-white/15 p-6 backdrop-blur-xl hover:bg-white/15 transition guest-card-float [animation-delay:1s]">
                    <div
                        class="w-12 h-12 rounded-2xl bg-emerald-300 text-slate-950 flex items-center justify-center text-xl mb-5 shadow-lg shadow-emerald-400/20">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3 class="text-4xl font-black">50+</h3>
                    <p class="text-blue-100 text-sm font-bold mt-1">Môn học</p>
                </div>

                <div
                    class="col-span-2 rounded-3xl bg-white/10 border border-white/15 p-6 backdrop-blur-xl hover:bg-white/15 transition guest-card-float [animation-delay:2s]">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h3 class="text-4xl font-black">5K+</h3>
                            <p class="text-blue-100 text-sm font-bold mt-1">Lượt tải tài liệu</p>
                        </div>

                        <div
                            class="w-16 h-16 rounded-3xl bg-amber-300 text-slate-950 flex items-center justify-center text-2xl shadow-lg shadow-amber-400/20">
                            <i class="fas fa-download"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- FEATURES -->
    <section class="relative overflow-hidden rounded-[3rem]
    bg-gradient-to-br from-cyan-500 via-sky-500 to-blue-600
    p-8 md:p-12 mb-14 text-white shadow-[0_25px_80px_rgba(14,165,233,0.25)]">

        <!-- Background Blur -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-[120px] animate-pulse">
        </div>

        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-cyan-300/20 rounded-full blur-[120px] animate-pulse">
        </div>

        <!-- Grid Pattern -->
        <div class="absolute inset-0 opacity-[0.06]" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0);
        background-size: 28px 28px;">
        </div>

        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- LEFT -->
            <div>

                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                bg-white/15 border border-white/20
                text-white text-sm font-bold mb-6 backdrop-blur-xl">

                    <i class="fa-solid fa-bolt text-cyan-100"></i>
                    Kho học liệu thông minh
                </span>

                <h2 class="text-4xl md:text-6xl font-black leading-tight mb-6">
                    Học nhanh hơn với
                    <span class="text-cyan-100">
                        tài liệu chuẩn
                    </span>
                </h2>

                <p class="text-white/90 text-lg leading-relaxed mb-8 max-w-xl">
                    Khám phá slide, đề thi, giáo trình và bài tập theo từng môn học.
                    Đăng nhập để tải tài liệu và quản lý học liệu dễ dàng hơn.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">

                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2
                    px-8 py-4 rounded-2xl
                    bg-white text-cyan-600
                    font-black
                    hover:bg-cyan-50
                    shadow-xl
                    transition-all duration-300 hover:-translate-y-1">

                        Đăng nhập ngay
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2
                    px-8 py-4 rounded-2xl
                    bg-white/10 border border-white/20
                    text-white font-black
                    hover:bg-white/20 backdrop-blur-xl transition-all">

                        Tạo tài khoản
                    </a>
                </div>

                <!-- TAGS -->
                <div class="mt-8 flex flex-wrap items-center gap-3">

                    <span
                        class="px-4 py-2 rounded-full bg-white/10 border border-white/10 text-xs font-bold backdrop-blur-xl">
                        #ASP.NETCore
                    </span>

                    <span
                        class="px-4 py-2 rounded-full bg-white/10 border border-white/10 text-xs font-bold backdrop-blur-xl">
                        #Laravel
                    </span>

                    <span
                        class="px-4 py-2 rounded-full bg-white/10 border border-white/10 text-xs font-bold backdrop-blur-xl">
                        #SQLServer
                    </span>

                </div>
            </div>

            <!-- RIGHT -->
            <div class="hidden lg:flex justify-center">

                <div class="relative">

                    <div class="absolute inset-0 bg-white/20 blur-3xl rounded-full scale-125">
                    </div>

                    <div class="relative w-[420px] h-[420px]
                    rounded-[3rem]
                    bg-white/10 border border-white/20
                    backdrop-blur-xl
                    flex items-center justify-center
                    shadow-2xl">

                        <div class="w-44 h-44 rounded-[2rem]
                        bg-white
                        text-cyan-600
                        flex items-center justify-center
                        shadow-[0_20px_60px_rgba(255,255,255,0.25)]">

                            <i class="fa-solid fa-book-open text-7xl"></i>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    @endguest
    <!-- Phần Tài liệu sẽ chia quyền giảng viên và sinh viên -->
    @auth
    @if(auth()->user()->role_id !=1)
    <!--DANH MỤC MÔN HỌC (SINH VIÊN xem đc tất cả các file, giảng viên xem đc tất cả các file)-->
    <div class="mb-12 py-15 my-10">
        <div class="flex  items-center mb-6">
            <div
                class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white mr-3 shadow-lg shadow-blue-200">
                <i class="fas fa-layer-group"></i>
            </div>
            <h4 class="text-2xl font-extrabold text-slate-800">Danh mục Môn học</h4>
            <a href="{{ route('subjects.index') }}"
                class="ml-auto text-sm font-semibold text-blue-600 hover:text-blue-700 flex items-center gap-1 transition-colors">
                Xem tất cả <i class="fas fa-angle-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <a href="{{ route('subjects.show', ['id' => 1]) }}"
                class="group bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center cursor-pointer">
                <div
                    class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-laptop-code text-2xl"></i>
                </div>
                <h6 class="font-bold text-slate-800 mb-1 group-hover:text-blue-600 transition-colors">Lập trình Web
                </h6>
                <p class="text-xs text-slate-400 font-medium">120 tài liệu</p>
            </a>

            <a
                class="group bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center cursor-pointer">
                <div
                    class="w-16 h-16 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-database text-2xl"></i>
                </div>
                <h6 class="font-bold text-slate-800 mb-1 group-hover:text-green-600 transition-colors">Cơ sở dữ liệu
                </h6>
                <p class="text-xs text-slate-400 font-medium">85 tài liệu</p>
            </a>

            <a
                class="group bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center cursor-pointer">
                <div
                    class="w-16 h-16 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-network-wired text-2xl"></i>
                </div>
                <h6 class="font-bold text-slate-800 mb-1 group-hover:text-cyan-600 transition-colors">Mạng máy tính
                </h6>
                <p class="text-xs text-slate-400 font-medium">64 tài liệu</p>
            </a>

            <a
                class="group bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center cursor-pointer">
                <div
                    class="w-16 h-16 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-project-diagram text-2xl"></i>
                </div>
                <h6 class="font-bold text-slate-800 mb-1 group-hover:text-red-600 transition-colors">Cấu trúc dữ
                    liệu
                </h6>
                <p class="text-xs text-slate-400 font-medium">150 tài liệu</p>
            </a>
        </div>
    </div>
    @endif
    <!-- Phần Tài liệu sẽ chia quyền sinh viên -->
    @if(auth()->user()->role_id==3)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!--SV TÀI LIỆU MỚI NHẤT -->
        <div class="lg:col-span-2">
            <div class="flex items-center mb-6">
                <div
                    class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white mr-3 shadow-lg shadow-blue-200">
                    <i class="fas fa-clock"></i>
                </div>
                <h4 class="text-2xl font-extrabold text-slate-800">Tài liệu mới nhất</h4>
            </div>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="divide-y divide-slate-100">

                    <div class="p-6 hover:bg-slate-50 transition-colors flex items-center gap-5 group">
                        <div
                            class="w-16 h-16 bg-red-50 text-red-500 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-red-100">
                            <i class="fas fa-file-pdf text-2xl"></i>
                            <span class="text-[10px] font-black mt-1">PDF</span>
                        </div>
                        <div class="flex-grow min-w-0">
                            <h6
                                class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors truncate">
                                Slide Bài 1: Tổng quan về Laravel Framework
                            </h6>
                            <div class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                                <span class="flex items-center"><i class="fas fa-book text-slate-400 mr-1.5"></i>
                                    Môn:
                                    Lập trình Web</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-user-graduate text-slate-400 mr-1.5"></i> GV: ThS. Trần Văn
                                    B</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-calendar-check text-slate-400 mr-1.5"></i> Hôm nay</span>
                            </div>
                        </div>
                        <button
                            class="shrink-0 px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm shadow-sm shadow-blue-100">
                            <i class="fas fa-cloud-download-alt"></i> Tải về
                        </button>
                    </div>

                    <div class="p-6 hover:bg-slate-50 transition-colors flex items-center gap-5 group">
                        <div
                            class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-blue-100">
                            <i class="fas fa-file-word text-2xl"></i>
                            <span class="text-[10px] font-black mt-1">W</span>
                        </div>
                        <div class="flex-grow min-w-0">
                            <h6
                                class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors truncate">
                                Đề cương ôn tập giữa kỳ CSDL 2023-2024
                            </h6>
                            <div class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                                <span class="flex items-center"><i class="fas fa-book text-slate-400 mr-1.5"></i>
                                    Môn:
                                    Cơ sở dữ liệu</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-user-graduate text-slate-400 mr-1.5"></i> GV: TS. Lê Thị
                                    C</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-calendar-check text-slate-400 mr-1.5"></i> Hôm qua</span>
                            </div>
                        </div>
                        <button
                            class="shrink-0 px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm">
                            <i class="fas fa-cloud-download-alt"></i> Tải về
                        </button>
                    </div>

                    <div class="p-6 hover:bg-slate-50 transition-colors flex items-center gap-5 group">
                        <div
                            class="w-16 h-16 bg-green-50 text-green-600 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-green-100">
                            <i class="fas fa-file-excel text-2xl"></i>
                            <span class="text-[10px] font-black mt-1">X</span>
                        </div>
                        <div class="flex-grow min-w-0">
                            <h6
                                class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors truncate">
                                Danh sách chia nhóm & Bài tập lớn Mạng máy tính
                            </h6>
                            <div class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                                <span class="flex items-center"><i class="fas fa-book text-slate-400 mr-1.5"></i>
                                    Môn:
                                    Mạng máy tính</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-user-graduate text-slate-400 mr-1.5"></i> GV: Phạm Văn
                                    D</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-calendar-check text-slate-400 mr-1.5"></i> 2 ngày trước</span>
                            </div>
                        </div>
                        <button
                            class="shrink-0 px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm">
                            <i class="fas fa-cloud-download-alt"></i> Tải về
                        </button>
                    </div>
                </div>

                <div class="p-4 bg-slate-50/50 border-t border-slate-100 text-center">
                    <a href="{{ route('documents.latest') }}"
                        class="text-blue-600 font-bold text-sm hover:text-blue-700 flex items-center justify-center gap-2">
                        Xem thêm tài liệu <i class="fas fa-arrow-down animate-bounce"></i>
                    </a>
                </div>
            </div>
        </div>
        <!--SV TÀI LIỆU TẢI NHIỀU -->
        <div>
            <div>
                <div class="flex items-center mb-6">
                    <div
                        class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center text-white mr-3 shadow-lg shadow-red-200">
                        <i class="fas fa-fire"></i>
                    </div>
                    <h4 class="text-2xl font-extrabold text-slate-800">Tài liệu tải nhiều</h4>
                </div>

                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden p-2">
                    <div class="flex flex-col">

                        <a href="#" class="flex items-center p-4 rounded-2xl hover:bg-slate-50 transition-all group">
                            <span class="text-2xl font-black text-orange-400 w-8 italic">1</span>
                            <div class="flex-grow min-w-0 px-3">
                                <div class="flex items-center gap-2">
                                    <h6
                                        class="font-bold text-slate-800 truncate group-hover:text-blue-600 transition-colors">
                                        Đề thi mẫu cuối kỳ CSDL...</h6>
                                    <span
                                        class="bg-yellow-400 text-[9px] text-white font-black px-1.5 py-0.5 rounded-md uppercase tracking-tighter">Hot</span>
                                </div>
                                <p class="text-xs text-slate-400 mt-1 font-medium"><i
                                        class="fas fa-download mr-1 text-slate-300"></i> 1,245 lượt tải</p>
                            </div>
                        </a>

                        <a href="#"
                            class="flex items-center p-4 rounded-2xl hover:bg-slate-50 transition-all group border-t border-slate-50">
                            <span class="text-2xl font-black text-slate-300 w-8 italic">2</span>
                            <div class="flex-grow min-w-0 px-3">
                                <h6
                                    class="font-bold text-slate-800 truncate group-hover:text-blue-600 transition-colors">
                                    Đồ
                                    án mẫu Lập trình We...</h6>
                                <p class="text-xs text-slate-400 mt-1 font-medium"><i
                                        class="fas fa-download mr-1 text-slate-300"></i> 980 lượt tải</p>
                            </div>
                        </a>

                        <a href="#"
                            class="flex items-center p-4 rounded-2xl hover:bg-slate-50 transition-all group border-t border-slate-50">
                            <span class="text-2xl font-black text-rose-400 w-8 italic">3</span>
                            <div class="flex-grow min-w-0 px-3">
                                <h6
                                    class="font-bold text-slate-800 truncate group-hover:text-blue-600 transition-colors">
                                    Giáo trình Mạng máy tín...</h6>
                                <p class="text-xs text-slate-400 mt-1 font-medium"><i
                                        class="fas fa-download mr-1 text-slate-300"></i> 750 lượt tải</p>
                            </div>
                        </a>

                        <a href="#"
                            class="flex items-center p-4 rounded-2xl hover:bg-slate-50 transition-all group border-t border-slate-50">
                            <span class="text-2xl font-black text-slate-300 w-8 italic">4</span>
                            <div class="flex-grow min-w-0 px-3">
                                <h6
                                    class="font-bold text-slate-800 truncate group-hover:text-blue-600 transition-colors">
                                    100 Câu hỏi trắc nghiệm...</h6>
                                <p class="text-xs text-slate-400 mt-1 font-medium"><i
                                        class="fas fa-download mr-1 text-slate-300"></i> 620 lượt tải</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Phần Tài liệu sẽ chia quyền  giảng viên -->
    @if(auth()->user()->role_id==2)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!--GV TÀI LIỆU BẠN ĐÃ ĐĂNG -->
        <div class="lg:col-span-2">
            <div class="flex items-center mb-6">
                <div
                    class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white mr-3 shadow-lg shadow-blue-200">
                    <i class="fas fa-clock"></i>
                </div>
                <h4 class="text-2xl font-extrabold text-slate-800">Tài liệu bạn đã đăng</h4>
            </div>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="divide-y divide-slate-100">

                    <div class="p-6 hover:bg-slate-50 transition-colors flex items-center gap-5 group">
                        <div
                            class="w-16 h-16 bg-red-50 text-red-500 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-red-100">
                            <i class="fas fa-file-pdf text-2xl"></i>
                            <span class="text-[10px] font-black mt-1">PDF</span>
                        </div>
                        <div class="flex-grow min-w-0">
                            <h6
                                class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors truncate">
                                Slide Bài 1: Tổng quan về Laravel Framework
                            </h6>
                            <div class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                                <span class="flex items-center"><i class="fas fa-book text-slate-400 mr-1.5"></i>
                                    Môn:
                                    Lập trình Web</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-user-graduate text-slate-400 mr-1.5"></i> GV: ThS. Trần Văn
                                    B</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-calendar-check text-slate-400 mr-1.5"></i> Hôm nay</span>
                            </div>
                        </div>
                        <button
                            class="shrink-0 px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm shadow-sm shadow-blue-100">
                            <i class="fas fa-cloud-download-alt"></i> Tải về
                        </button>
                    </div>

                    <div class="p-6 hover:bg-slate-50 transition-colors flex items-center gap-5 group">
                        <div
                            class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-blue-100">
                            <i class="fas fa-file-word text-2xl"></i>
                            <span class="text-[10px] font-black mt-1">W</span>
                        </div>
                        <div class="flex-grow min-w-0">
                            <h6
                                class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors truncate">
                                Đề cương ôn tập giữa kỳ CSDL 2023-2024
                            </h6>
                            <div class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                                <span class="flex items-center"><i class="fas fa-book text-slate-400 mr-1.5"></i>
                                    Môn:
                                    Cơ sở dữ liệu</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-user-graduate text-slate-400 mr-1.5"></i> GV: TS. Lê Thị
                                    C</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-calendar-check text-slate-400 mr-1.5"></i> Hôm qua</span>
                            </div>
                        </div>
                        <button
                            class="shrink-0 px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm">
                            <i class="fas fa-cloud-download-alt"></i> Tải về
                        </button>
                    </div>

                    <div class="p-6 hover:bg-slate-50 transition-colors flex items-center gap-5 group">
                        <div
                            class="w-16 h-16 bg-green-50 text-green-600 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-green-100">
                            <i class="fas fa-file-excel text-2xl"></i>
                            <span class="text-[10px] font-black mt-1">X</span>
                        </div>
                        <div class="flex-grow min-w-0">
                            <h6
                                class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors truncate">
                                Danh sách chia nhóm & Bài tập lớn Mạng máy tính
                            </h6>
                            <div class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                                <span class="flex items-center"><i class="fas fa-book text-slate-400 mr-1.5"></i>
                                    Môn:
                                    Mạng máy tính</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-user-graduate text-slate-400 mr-1.5"></i> GV: Phạm Văn
                                    D</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-calendar-check text-slate-400 mr-1.5"></i> 2 ngày trước</span>
                            </div>
                        </div>
                        <button
                            class="shrink-0 px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm">
                            <i class="fas fa-cloud-download-alt"></i> Tải về
                        </button>
                    </div>
                </div>

                <div class="p-4 bg-slate-50/50 border-t border-slate-100 text-center">
                    <a href="{{ route('documents.my-documents') }}"
                        class="text-blue-600 font-bold text-sm hover:text-blue-700 flex items-center justify-center gap-2">
                        Xem thêm tài liệu <i class="fas fa-arrow-down animate-bounce"></i>
                    </a>
                </div>
            </div>
        </div>
        <!--GV Thống kê tương tác dạng biểu đồ đường -->
        <div>
            <div class="flex items-center mb-6">
                <div
                    class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center text-white mr-3 shadow-lg shadow-red-200">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h4 class="text-2xl font-extrabold text-slate-800">Thống kê tương tác</h4>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8 flex flex-col">
                <div class="flex-1 flex flex-col justify-center">
                    <div class="chart-container">
                        <canvas id="statChart"></canvas>
                    </div>
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <div class="bg-slate-50 p-4 rounded-xl text-center">
                            <p class="text-2xl font-black text-blue-600">1.2k</p>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Lượt tải</p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl text-center">
                            <p class="text-2xl font-black text-green-600">4.8</p>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Đánh giá</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endif

    @endauth
</main>
@endsection