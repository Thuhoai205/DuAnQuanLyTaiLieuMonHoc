@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

<!-- HERO -->
<header class="relative py-20 lg:py-20 text-white text-center overflow-hidden">

    <!-- Background Slider -->
    <div class="absolute inset-0">

        <!-- Slide 1 -->
        <img src="https://i.pinimg.com/736x/3f/3e/e6/3f3ee63d36c5938d1744264288d3c1cd.jpg"
            class="hero-slide absolute inset-0 w-full h-full object-cover active" />

        <!-- Slide 2 -->
        <img src="https://i.pinimg.com/1200x/e4/5f/a5/e45fa598385b82780c59d7fc382b709c.jpg"
            class="hero-slide absolute inset-0 w-full h-full object-cover" />

        <!-- Slide 3 -->
        <img src="https://i.pinimg.com/1200x/91/92/ec/9192ec49cbcbc1edf414963da9361909.jpg"
            class="hero-slide absolute inset-0 w-full h-full object-cover" />

        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-blue-950/90 via-blue-950/80 to-slate-950/90"></div>

    </div>

    <!-- CONTENT -->
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-8 lg:px-12">

        <!-- BADGE -->
        <div
            class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white/10 border border-white/20 backdrop-blur-xl mb-8">

            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>

            <span class="text-sm font-semibold text-white/90 tracking-wide">
                Hệ thống quản lý tài liệu học tập
            </span>

        </div>

        <!-- TITLE -->
        <h1 class="text-4xl sm:text-5xl lg:text-7xl font-black leading-[1.1] tracking-tight drop-shadow-2xl mb-6">

            Khám phá kho
            <span class="text-blue-400">tri thức</span>
            học tập

        </h1>

        <!-- SUBTITLE -->
        <p class="max-w-3xl mx-auto text-slate-200 text-lg lg:text-xl leading-relaxed mb-12 font-medium">

            Tìm kiếm giáo trình, slide bài giảng, đề thi và tài liệu học tập chất lượng
            dành cho sinh viên và giảng viên.

        </p>

        <!-- SEARCH -->
        <form action="{{ route('documents.search') }}" method="GET" class="max-w-6xl mx-auto">

            <div
                class="bg-white/95 backdrop-blur-2xl rounded-[2rem] shadow-[0_25px_80px_-15px_rgba(0,0,0,0.35)] border border-white/40 overflow-hidden p-3">

                <div class="flex flex-col lg:flex-row items-stretch lg:items-center gap-3">

                    <!-- INPUT -->
                    <div class="flex items-center flex-1 px-4 lg:px-6">

                        <i class="fas fa-search text-slate-400 text-lg mr-4"></i>

                        <input type="text" name="keyword" placeholder="Nhập tên tài liệu, đề thi hoặc từ khóa..."
                            class="w-full py-4 bg-transparent outline-none text-slate-700 placeholder-slate-400 font-medium text-sm lg:text-base">

                    </div>

                    <!-- DIVIDER -->
                    <div class="hidden lg:block w-px h-12 bg-slate-200"></div>

                    <!-- SELECT -->
                    <div class="flex items-center px-4 lg:px-2">

                        <i class="fas fa-book-open text-slate-400 mr-3"></i>

                        <select name="subject_id"
                            class="bg-transparent text-slate-700 font-semibold border-none outline-none focus:ring-0 py-4 pr-8 cursor-pointer text-sm">

                            <option value="">Tất cả môn học</option>
                            <option value="1">Lập trình Web</option>
                            <option value="2">Cơ sở dữ liệu</option>
                            <option value="3">Mạng máy tính</option>

                        </select>

                    </div>

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-black px-10 py-5 rounded-full transition-all duration-300 uppercase text-xs tracking-[0.2em] shadow-xl shadow-blue-600/30 hover:scale-[1.02] active:scale-95 whitespace-nowrap">

                        TÌM KIẾM

                    </button>

                </div>

            </div>

        </form>

        <!-- TAGS -->
        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">

            <span class="text-sm text-white/70 font-medium">
                Xu hướng:
            </span>

            <span
                class="px-4 py-2 rounded-full bg-white/10 border border-white/10 text-xs font-semibold backdrop-blur-md">
                #ASP.NETCore
            </span>

            <span
                class="px-4 py-2 rounded-full bg-white/10 border border-white/10 text-xs font-semibold backdrop-blur-md">
                #ĐềThiWeb
            </span>

            <span
                class="px-4 py-2 rounded-full bg-white/10 border border-white/10 text-xs font-semibold backdrop-blur-md">
                #SQLServer
            </span>

        </div>

    </div>

</header>

<!-- STYLE -->
<style>
.hero-slide {
    opacity: 0;
    transition: opacity 1s ease-in-out, transform 8s ease;
    transform: scale(1.05);
}

.hero-slide.active {
    opacity: 1;
    transform: scale(1);
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
    <section class="mb-14">
        <div class="text-center mb-10">
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-600 text-sm font-black mb-4">
                <i class="fas fa-star"></i>
                Tính năng nổi bật
            </span>

            <h3 class="text-4xl font-black text-slate-900 mb-3">
                Tất cả tài liệu học tập trong một nơi
            </h3>

            <p class="text-slate-500 font-medium">
                Giao diện dễ dùng, tìm kiếm nhanh và phân loại rõ ràng theo môn học.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
                class="group bg-white rounded-[2rem] p-8 border border-blue-100 shadow-sm hover:shadow-2xl hover:shadow-blue-100 hover:-translate-y-2 transition">
                <div
                    class="w-16 h-16 rounded-3xl bg-blue-600 text-white flex items-center justify-center text-2xl mb-6 shadow-lg shadow-blue-200 group-hover:scale-110 group-hover:rotate-6 transition">
                    <i class="fas fa-search"></i>
                </div>
                <h4 class="text-xl font-black text-slate-900 mb-3">Tìm kiếm nhanh</h4>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Tìm tài liệu theo tên, môn học, loại tài liệu hoặc từ khóa liên quan.
                </p>
            </div>

            <div
                class="group bg-white rounded-[2rem] p-8 border border-violet-100 shadow-sm hover:shadow-2xl hover:shadow-violet-100 hover:-translate-y-2 transition">
                <div
                    class="w-16 h-16 rounded-3xl bg-violet-600 text-white flex items-center justify-center text-2xl mb-6 shadow-lg shadow-violet-200 group-hover:scale-110 group-hover:rotate-6 transition">
                    <i class="fas fa-layer-group"></i>
                </div>
                <h4 class="text-xl font-black text-slate-900 mb-3">Phân loại rõ ràng</h4>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Slide, bài tập, đề thi và giáo trình được sắp xếp theo từng môn học.
                </p>
            </div>

            <div
                class="group bg-white rounded-[2rem] p-8 border border-orange-100 shadow-sm hover:shadow-2xl hover:shadow-orange-100 hover:-translate-y-2 transition">
                <div
                    class="w-16 h-16 rounded-3xl bg-orange-500 text-white flex items-center justify-center text-2xl mb-6 shadow-lg shadow-orange-200 group-hover:scale-110 group-hover:rotate-6 transition">
                    <i class="fas fa-lock"></i>
                </div>
                <h4 class="text-xl font-black text-slate-900 mb-3">Tải về an toàn</h4>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Đăng nhập để tải tài liệu, giúp hệ thống quản lý và bảo vệ tài nguyên tốt hơn.
                </p>
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
                    <a href="{{ route('documents.index') }}"
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