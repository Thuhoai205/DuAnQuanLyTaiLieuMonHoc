@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
<style>
.banner-slider {
    display: flex;
    width: 500%;
    height: 100%;

    animation: slideBanner 20s ease-in-out infinite;
}

.banner-slider img {

    width: 20%;
    height: 100%;

    flex-shrink: 0;

    object-fit: cover;
}

@keyframes slideBanner {

    0%,
    18% {
        transform: translateX(0);
    }

    23%,
    43% {
        transform: translateX(-20%);
    }

    48%,
    68% {
        transform: translateX(-40%);
    }

    73%,
    93% {
        transform: translateX(-60%);
    }

    100% {
        transform: translateX(-80%);
    }

}
</style>
<!-- HERO -->
<!-- ================= HERO ================= -->
<header class="relative overflow-hidden bg-gradient-to-br from-cyan-700 via-cyan-600 to-sky-600 text-white">


    <div class="absolute inset-0 overflow-hidden">

        <div class="banner-slider">

            <img src="{{ asset('img/01.jpg') }}" alt="Banner 1">

            <img src="{{ asset('img/02.jpg') }}" alt="Banner 2">

            <img src="{{ asset('img/03.jpg') }}" alt="Banner 3">

            <img src="{{ asset('img/04.jpg') }}" alt="Banner 4">

            <!-- Lặp lại ảnh đầu -->
            <img src="{{ asset('img/01.jpg') }}" alt="Banner 1">

        </div>

        <div class="absolute inset-0 bg-slate-900/40"></div>

    </div>

    <div class="absolute inset-0 bg-slate-900/35"></div>

    </div>
    <div class="absolute inset-0 bg-gradient-to-r from-cyan-900/40 to-cyan-600/30"></div>

    <!-- Blur -->
    <div class="absolute -top-32 -left-24 w-80 h-80 rounded-full bg-cyan-300/20 blur-3xl"></div>

    <div class="absolute bottom-0 right-0 w-[420px] h-[420px] rounded-full bg-white/10 blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-6 py-16">

        <div class="grid lg:grid-cols-5 gap-12 items-center">
            <!-- ================= LEFT ================= -->
            <div class="lg:col-span-3">

                <!-- Badge -->
                <span class="inline-flex items-center gap-2
                    px-5 py-2 rounded-full
                    bg-gradient-to-r from-orange-500 to-pink-500
                    text-white
                    shadow-lg shadow-orange-500/20
                    text-sm font-bold">

                    <i class="fa-solid fa-bolt text-yellow-300"></i>

                    Hệ thống quản lý học liệu

                </span>

                <!-- Title -->
                <h1 class="mt-6 text-5xl font-black leading-tight text-white">

                    Khám phá

                    <span class="text-amber-200 drop-shadow-sm">
                        kho tài liệu
                    </span>

                    học tập hiện đại

                </h1>

                <!-- Description -->
                <p class="mt-6 max-w-xl text-lg leading-8 text-white/90">

                    Tìm kiếm giáo trình, slide, bài giảng,
                    đề thi và tài liệu học tập theo từng
                    môn học, khoa và loại tài liệu.

                </p>

                <!-- ================= SEARCH ================= -->

                <form action="{{ route('documents.search') }}" method="GET" class="mt-10
                    rounded-[32px]
                    border border-white/20
                    bg-white/10
                    backdrop-blur-2xl
                    p-6
                    shadow-[0_20px_60px_rgba(0,0,0,0.25)]">

                    <!-- SEARCH BOX -->
                    <div class="relative">

                        <div class="absolute inset-y-0 left-5 flex items-center">

                            <i class="fa-solid fa-magnifying-glass text-white/70 text-lg"></i>

                        </div>

                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                            placeholder="Tìm tên tài liệu hoặc từ khóa..." class="w-full
                            h-16
                            rounded-2xl
                            border border-white/20
                            bg-white/10
                            backdrop-blur-md
                            pl-14
                            pr-5
                            text-base
                            text-white
                            placeholder:text-white/60
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-300
                            focus:border-slate-300
                            transition">

                    </div>

                    <!-- FILTER -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">

                        <!-- SUBJECT -->
                        <select name="subject_code" class="h-14
                            rounded-xl
                            border border-white/20
                            bg-white/10
                            backdrop-blur-md
                            px-4
                            text-white
                            focus:ring-2
                            focus:ring-slate-300
                            focus:border-slate-300">

                            <option value="" class="text-slate-700">Tất cả môn học</option>

                            @foreach($subjects as $subject)

                            <option value="{{$subject->subject_code }} " class="text-slate-700"
                                {{ request('subject_code') == $subject->subject_code ? 'selected' : '' }}>

                                {{$subject->subject_name }}

                            </option>

                            @endforeach
                        </select>

                        <!-- TYPE -->
                        <select name="document_type_id" class="h-14
                      rounded-xl
                                        border border-white/20
                                        bg-white/10
                                        backdrop-blur-md
                                        px-4
                                        text-white
                                        focus:ring-2
                                        focus:ring-slate-300
                                        focus:border-slate-300">

                            <option value="" class="text-slate-700">
                                Loại tài liệu
                            </option>

                            @foreach($documentTypes as $type)

                            <option value="{{ $type->document_type_id }}" class="text-slate-700"
                                {{ request('document_type_id')==$type->document_type_id ? 'selected' : '' }}>

                                {{ $type->type_name }}

                            </option>

                            @endforeach

                        </select>
                        <button type="submit" class="group h-14 w-full rounded-xl
                                bg-gradient-to-r
                                from-slate-700
                                via-slate-800
                                to-slate-900
                                hover:from-slate-800
                                hover:via-slate-900
                                hover:to-black
                                text-white
                                font-semibold
                                tracking-wide
                                transition-all
                                duration-300
                                shadow-lg
                                shadow-slate-900/25
                                hover:shadow-2xl
                                hover:shadow-slate-900/35
                                hover:-translate-y-0.5
                                active:scale-[0.98]">

                            <i
                                class="fa-solid fa-search mr-2 transition-transform duration-300 group-hover:rotate-12"></i>

                            Tìm kiếm
                        </button>

                    </div>

                </form>
                {{-- ================= TOP KEYWORDS ================= --}}
                @if(isset($topKeywords) && $topKeywords->count())

                <div class="mt-6">

                    <div class="flex items-center gap-2 mb-3">

                        <i class="fa-solid fa-fire text-orange-400"></i>

                        <span class="text-sm font-semibold text-white">

                            Từ khóa được tìm kiếm nhiều

                        </span>

                    </div>

                    <div class="flex flex-wrap gap-3">

                        @foreach($topKeywords as $item)

                        <a href="{{ route('documents.search',[
                            'keyword' => $item->keyword
                        ]) }}" class="group inline-flex items-center gap-2
                            rounded-full
                            border border-white/20
                            bg-white/10
                            backdrop-blur-md
                            px-4
                            py-2
                            text-sm
                            text-white
                            transition-all
                            duration-300
                            hover:bg-amber-500
                            hover:border-amber-500
                            hover:scale-105">

                            <i class="fa-solid fa-fire text-xs text-orange-300 group-hover:text-white"></i>

                            {{ $item->keyword }}

                            <span class="rounded-full
                            bg-white/20
                            px-2
                            py-0.5
                            text-xs">

                                {{ $item->total }}

                            </span>

                        </a>

                        @endforeach

                    </div>

                </div>

                @endif

            </div>
            <div class="hidden lg:block lg:col-span-2 self-center">
                <!-- CONTAINER NGOÀI CÙNG CHỨA HIỆU ỨNG VIỀN KHÔNG GIAN -->
                <div
                    class="relative overflow-hidden rounded-[31px] bg-slate-700/35 backdrop-blur-3xl p-6 z-10 border border-white/15 shadow-[0_20px_40px_rgba(15,23,42,0.15)]">
                    <!-- 1. HIỆU ỨNG VIỀN PHÁT SÁNG CHẠY VÒNG SIÊU MỊN -->
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-sky-500/50 via-amber-500/50 to-emerald-500/50 rounded-[32px] animate-[spin_8s_linear_infinite] opacity-70 group-hover/main:opacity-100 transition-opacity duration-500">
                    </div>

                    <!-- 2. CÁC KHỐI CẦU ĐÈN NEON DI CHUYỂN NGẦM PHÍA SAU -->
                    <div
                        class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-amber-500/15 blur-[90px] pointer-events-none animate-[pulse_4s_infinite_ease-in-out]">
                    </div>
                    <div
                        class="absolute -bottom-24 -left-24 w-80 h-80 rounded-full bg-sky-500/15 blur-[90px] pointer-events-none animate-[pulse_6s_infinite_ease-in-out]">
                    </div>

                    <!-- 3. KHỐI KÍNH MỜ CHÍNH ĐÃ ĐƯỢC CHỈNH NHẠT HƠN (SLATE GLASSMORPHISM LIGHTER) -->
                    <!-- Chuyển từ bg-slate-900/90 (đen sâu) sang bg-slate-800/80 (xanh đen nhạt, trong suốt hơn) -->
                    <div
                        class="relative overflow-hidden rounded-[31px] bg-slate-800/80 backdrop-blur-2xl p-6 z-10 border border-slate-700/40">

                        <!-- 📄 CARD TRÊN: KHO HỌC LIỆU SỐ -->
                        <!-- Hạ tone nền card trong suốt hơn để hài hòa với tổng thể -->
                        <div
                            class="w-full rounded-[24px] bg-slate-700/30 border border-slate-600/40 p-5 relative overflow-hidden group/top hover:bg-slate-700/50 hover:border-amber-500/40 transition-all duration-500">

                            <!-- Hiệu ứng tia sáng quét ngang (Laser Shine Effect) -->
                            <div
                                class="absolute inset-0 translate-x-[-100%] bg-gradient-to-r from-transparent via-white/10 to-transparent group-hover/top:translate-x-[100%] transition-transform duration-1000 ease-out pointer-events-none">
                            </div>

                            <div class="grid grid-cols-12 gap-4 items-center relative z-10">
                                <!-- Nội dung bên trái -->
                                <div class="col-span-8">
                                    <div class="flex items-center gap-3.5">
                                        <!-- Icon Box phát sáng Cam Thương Hiệu -->
                                        <div class="relative">
                                            <div
                                                class="absolute inset-0 bg-amber-500/30 blur-md rounded-xl animate-ping opacity-70">
                                            </div>
                                            <div
                                                class="relative w-11 h-11 rounded-xl bg-gradient-to-br from-amber-400 to-orange-500 text-white flex items-center justify-center shadow-[0_4px_20px_rgba(245,158,11,0.4)] shrink-0 group-hover/top:scale-110 transition-transform duration-300">
                                                <i class="fa-solid fa-book-open text-base"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <p
                                                class="text-sky-400 text-[10px] font-black uppercase tracking-widest flex items-center gap-1.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-sky-400 animate-pulse"></span>
                                                CLOUD RESOURCE
                                            </p>
                                            <h3
                                                class="text-white text-lg font-bold mt-0.5 tracking-tight group-hover/top:text-amber-400 transition-colors">
                                                Kho Học Liệu Số
                                            </h3>
                                        </div>
                                    </div>

                                    <div
                                        class="my-3.5 h-px bg-gradient-to-r from-slate-600/80 via-slate-600/30 to-transparent">
                                    </div>

                                    <p class="text-xs leading-relaxed text-slate-200 font-normal opacity-90">
                                        Học liệu phân loại thông minh theo môn học, khoa và định dạng. Hỗ trợ tìm kiếm
                                        nhanh, chia sẻ và tải xuống một chạm.
                                    </p>
                                </div>

                                <!-- Hình vẽ đồ họa lơ lửng 3D -->
                                <div class="col-span-4 flex justify-center items-center relative h-22">
                                    <div
                                        class="relative w-14 h-14 bg-gradient-to-b from-slate-600/50 to-slate-700/50 rounded-xl flex items-center justify-center border border-slate-500 shadow-inner animate-[float_4s_infinite_ease-in-out] group-hover/top:border-sky-500/40 transition-colors">
                                        <i
                                            class="fa-solid fa-layer-group text-2xl text-sky-400 drop-shadow-[0_0_10px_rgba(56,189,248,0.6)]"></i>
                                        <div
                                            class="absolute -top-1.5 -right-1.5 w-4 h-4 rounded-full bg-amber-500 animate-bounce">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 📊 KHỐI THỐNG KÊ 3 THẺ PHÍA DƯỚI -->
                        <div class="grid grid-cols-3 gap-3 mt-4">

                            <!-- Thẻ 1: TÀI LIỆU -->
                            <div
                                class="bg-slate-700/20 border border-slate-600/30 rounded-[20px] p-3.5 flex flex-col items-center relative overflow-hidden group/card hover:bg-slate-700/60 hover:border-sky-500/50 hover:shadow-[0_15px_30px_rgba(14,165,233,0.2)] hover:-translate-y-1.5 transition-all duration-300 cursor-pointer">
                                <div
                                    class="absolute inset-0 translate-x-[-100%] bg-gradient-to-r from-transparent via-sky-500/5 to-transparent group-hover/card:translate-x-[100%] transition-transform duration-700 pointer-events-none">
                                </div>

                                <div
                                    class="w-9 h-9 rounded-lg bg-sky-500/10 border border-sky-500/20 flex items-center justify-center text-sky-400 group-hover/card:bg-sky-500 group-hover/card:text-white group-hover/card:shadow-[0_0_15px_rgba(14,165,233,0.5)] transition-all duration-300">
                                    <i class="fa-solid fa-file-lines text-xs"></i>
                                </div>

                                <h4 class="text-2xl font-black text-white mt-3 leading-none group-hover/card:text-sky-400 transition-colors"
                                    data-target="{{ $totalDocuments }}">{{ $totalDocuments }}</h4>
                                <p class="text-[11px] font-medium text-slate-300 mt-1.5">Tài liệu</p>

                                <div
                                    class="w-full flex items-center justify-between mt-3.5 pt-2 border-t border-slate-700/60 px-0.5">
                                    <svg class="w-8 h-2.5 text-sky-400 drop-shadow-[0_0_3px_rgba(56,189,248,0.5)]"
                                        viewBox="0 0 50 20" fill="none" stroke="currentColor" stroke-width="3.5"
                                        stroke-linecap="round">
                                        <path d="M0 15 Q10 5, 20 12 T40 8 T50 5" />
                                    </svg>
                                    <span
                                        class="text-[9px] font-bold text-sky-400 bg-sky-500/10 px-1 py-0.5 rounded-md">
                                        +18%
                                    </span>
                                </div>
                            </div>

                            <!-- Thẻ 2: MÔN HỌC -->
                            <div
                                class="bg-slate-700/20 border border-slate-600/30 rounded-[20px] p-3.5 flex flex-col items-center relative overflow-hidden group/card hover:bg-slate-700/60 hover:border-emerald-500/50 hover:shadow-[0_15px_30px_rgba(16,185,129,0.2)] hover:-translate-y-1.5 transition-all duration-300 cursor-pointer">
                                <div
                                    class="absolute inset-0 translate-x-[-100%] bg-gradient-to-r from-transparent via-emerald-500/5 to-transparent group-hover/card:translate-x-[100%] transition-transform duration-700 pointer-events-none">
                                </div>

                                <div
                                    class="w-9 h-9 rounded-lg bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 group-hover/card:bg-emerald-500 group-hover/card:text-white group-hover/card:shadow-[0_0_15px_rgba(16,185,129,0.5)] transition-all duration-300">
                                    <i class="fa-solid fa-graduation-cap text-xs"></i>
                                </div>

                                <h4 class="text-2xl font-black text-white mt-3 leading-none group-hover/card:text-emerald-400 transition-colors"
                                    data-target="{{ $totalSubjects }}">{{ $totalSubjects }}</h4>
                                <p class="text-[11px] font-medium text-slate-300 mt-1.5">Môn học</p>

                                <div
                                    class="w-full flex items-center justify-between mt-3.5 pt-2 border-t border-slate-700/60 px-0.5">
                                    <svg class="w-8 h-2.5 text-emerald-400 drop-shadow-[0_0_3px_rgba(52,211,153,0.5)]"
                                        viewBox="0 0 50 20" fill="none" stroke="currentColor" stroke-width="3.5"
                                        stroke-linecap="round">
                                        <path d="M0 12 Q12 18, 22 10 T38 12 T50 4" />
                                    </svg>
                                    <span
                                        class="text-[9px] font-bold text-emerald-400 bg-emerald-500/10 px-1 py-0.5 rounded-md">
                                        +12%
                                    </span>
                                </div>
                            </div>

                            <!-- Thẻ 3: KHOA -->
                            <div
                                class="bg-slate-700/20 border border-slate-600/30 rounded-[20px] p-3.5 flex flex-col items-center relative overflow-hidden group/card hover:bg-slate-700/60 hover:border-amber-500/50 hover:shadow-[0_15px_30px_rgba(245,158,11,0.2)] hover:-translate-y-1.5 transition-all duration-300 cursor-pointer">
                                <div
                                    class="absolute inset-0 translate-x-[-100%] bg-gradient-to-r from-transparent via-amber-500/5 to-transparent group-hover/card:translate-x-[100%] transition-transform duration-700 pointer-events-none">
                                </div>

                                <div
                                    class="w-9 h-9 rounded-lg bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 group-hover/card:bg-amber-500 group-hover/card:text-white group-hover/card:shadow-[0_0_15px_rgba(245,158,11,0.5)] transition-all duration-300">
                                    <i class="fa-solid fa-building-columns text-xs"></i>
                                </div>

                                <h4 class="text-2xl font-black text-white mt-3 leading-none group-hover/card:text-amber-400 transition-colors"
                                    data-target="{{ $totalFaculties }}">{{ $totalFaculties }}</h4>
                                <p class="text-[11px] font-medium text-slate-300 mt-1.5">Khoa</p>

                                <div
                                    class="w-full flex items-center justify-between mt-3.5 pt-2 border-t border-slate-700/60 px-0.5">
                                    <svg class="w-8 h-2.5 text-amber-400 drop-shadow-[0_0_3px_rgba(251,146,60,0.5)]"
                                        viewBox="0 0 50 20" fill="none" stroke="currentColor" stroke-width="3.5"
                                        stroke-linecap="round">
                                        <path d="M0 16 Q10 10, 25 15 T40 10 T50 12" />
                                    </svg>
                                    <span
                                        class="text-[9px] font-bold text-amber-400 bg-amber-500/10 px-1 py-0.5 rounded-md">
                                        +5%
                                    </span>
                                </div>
                            </div>

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


<main class="max-w-7xl mx-auto px-6 pt-10 pb-10">
    <!-- Phần khách vãng lai -->
    @guest
    <style>
    /* ==================================================
   FLOATING ANIMATION
================================================== */

    @keyframes floatBlob {

        0%,
        100% {
            transform: translate(0, 0) scale(1);
        }

        50% {
            transform: translate(15px, -18px) scale(1.05);
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

    @keyframes floating {

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

    .float-animation {

        animation: floating 4s ease-in-out infinite;

    }

    /* ==================================================
   ROLE SECTION
================================================== */

    .role-section {

        position: relative;

        overflow: hidden;

    }

    .role-section::before,
    .role-section::after {

        display: none;

    }

    /* ==================================================
   ROLE CARD
================================================== */

    .role-card {

        position: relative;

        overflow: hidden;

        background: #ffffff;

        border: 1px solid #e5e7eb;

        border-radius: 28px;

        box-shadow:
            0 12px 35px rgba(15, 23, 42, .05);

        transition:
            all .35s ease;

    }

    .role-card:hover {

        transform: translateY(-8px);

        box-shadow:
            0 24px 50px rgba(15, 23, 42, .10);

    }

    /* Thanh màu */

    .role-card-top {

        height: 4px;

        background: #f59e0b;

    }

    /* ==================================================
   ROLE ICON
================================================== */

    .role-icon {

        width: 64px;

        height: 64px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 20px;

        background: #f8fafc;

        border: 1px solid #e5e7eb;

        color: #475569;

        font-size: 28px;

        transition: .35s ease;

    }

    .role-card:hover .role-icon {

        background: #f59e0b;

        color: #ffffff;

        transform:
            rotate(-8deg) scale(1.08);

    }

    /* ==================================================
   ROLE FEATURE
================================================== */

    .role-feature {

        display: flex;

        align-items: center;

        gap: 12px;

        padding: 14px 16px;

        border-radius: 16px;

        background: #f8fafc;

        border: 1px solid #e5e7eb;

        transition: all .3s ease;

    }

    .role-feature:hover {

        background: #ffffff;

        border-color: #fbbf24;

        transform: translateX(5px);

        box-shadow:
            0 8px 18px rgba(15, 23, 42, .05);

    }

    .role-feature i {

        width: 30px;

        height: 30px;

        border-radius: 999px;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #fff7ed;

        color: #f59e0b;

        font-size: 13px;

        flex-shrink: 0;

    }

    .role-feature span {

        font-size: 14px;

        font-weight: 600;

        color: #475569;

    }

    /* ==================================================
   ROLE LINK
================================================== */

    .role-link {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        margin-top: 24px;

        color: #f59e0b;

        font-size: 14px;

        font-weight: 700;

        transition: all .3s ease;

    }

    .role-link:hover {

        gap: 14px;

        color: #d97706;

    }

    /* ==================================================
   SCROLL REVEAL
================================================== */

    .reveal {

        opacity: 0;

        transform: translateY(60px);

        transition: all .9s ease;

    }

    .reveal.active {

        opacity: 1;

        transform: none;

    }

    .reveal-item {

        opacity: 0;

        transform: translateY(40px) scale(.96);

        transition: all .8s ease;

    }

    .reveal.active .reveal-item {

        opacity: 1;

        transform: none;

    }

    .reveal.active .reveal-item:nth-child(1) {

        transition-delay: .15s;

    }

    .reveal.active .reveal-item:nth-child(2) {

        transition-delay: .35s;

    }

    .reveal.active .reveal-item:nth-child(3) {

        transition-delay: .55s;

    }

    /* ==================================================
   HERO IMAGE
================================================== */

    .hero-image {

        transition: transform .8s ease;

    }

    .hero-image:hover {

        transform: scale(1.03);

    }

    /* ==================================================
   STAT CARD
================================================== */

    .stat-card {

        background: #ffffff;

        border: 1px solid #e5e7eb;

        border-radius: 24px;

        box-shadow:
            0 10px 25px rgba(15, 23, 42, .05);

        transition: all .35s ease;

    }

    .stat-card:hover {

        transform: translateY(-8px);

        box-shadow:
            0 22px 45px rgba(15, 23, 42, .10);

    }

    .stat-card i {

        transition: .35s ease;

    }

    .stat-card:hover i {

        transform: rotate(-10deg) scale(1.08);

    }

    /* ==================================================
   QUICK CARD
================================================== */

    .quick-card {

        background: #ffffff;

        border: 1px solid #e5e7eb;

        border-radius: 28px;

        box-shadow:
            0 10px 28px rgba(15, 23, 42, .05);

        transition: all .35s ease;

    }

    .quick-card:hover {

        transform: translateY(-8px);

        box-shadow:
            0 22px 45px rgba(15, 23, 42, .10);

    }

    .quick-card .quick-icon {

        transition: all .35s ease;

    }

    .quick-card:hover .quick-icon {

        transform: rotate(-8deg) scale(1.08);

    }

    /* ==================================================
   HERO BUTTON
================================================== */

    .hero-btn {

        transition: all .3s ease;

    }

    .hero-btn:hover {

        transform: translateY(-3px);

    }

    /* ==================================================
   SHINE EFFECT
================================================== */

    .shine {

        position: relative;

        overflow: hidden;

    }

    .shine::before {

        content: "";

        position: absolute;

        top: 0;

        left: -120%;

        width: 80%;

        height: 100%;

        background:
            linear-gradient(120deg,
                transparent,
                rgba(255, 255, 255, .55),
                transparent);

    }

    .shine:hover::before {

        animation: shine 1s;

    }

    @keyframes shine {

        from {

            left: -120%;

        }

        to {

            left: 130%;

        }

    }
    </style>
    <!-- ===========================
     ROLE INTRO SECTION
    =========================== -->
    <section class="role-section reveal mt-20 mb-24">

        <div class="relative max-w-7xl mx-auto">

            <!-- Background Blur -->
            <div class="absolute -top-24 left-1/2 -translate-x-1/2
            w-[450px]
            h-[450px]
            rounded-full
            bg-amber-200/20
            blur-[120px]
            pointer-events-none">
            </div>

            <!-- Badge -->
            <div class="relative text-center">

                <span class="inline-flex
                items-center
                gap-2
                px-5
                py-2.5
                rounded-full
                bg-slate-900
                text-amber-400
                text-xs
                font-black
                uppercase
                tracking-[0.22em]
                shadow-lg
                shadow-slate-900/10">

                    <i class="fa-solid fa-users"></i>

                    Vai trò người dùng

                </span>

            </div>

            <!-- Heading -->
            <div class="relative mt-8 text-center">

                <h2 class="text-4xl
                md:text-5xl
                font-black
                tracking-tight
                text-slate-900
                leading-tight">

                    Hệ thống hỗ trợ

                    <span class="text-amber-500">

                        nhiều nhóm người dùng

                    </span>

                </h2>

                <p class="mt-6
                max-w-3xl
                mx-auto
                text-lg
                leading-8
                text-slate-500">

                    EDU DOC được xây dựng nhằm hỗ trợ sinh viên, giảng viên và
                    quản trị viên quản lý, chia sẻ và khai thác học liệu
                    một cách trực quan, hiện đại và hiệu quả.

                </p>

            </div>

            <!-- Main Card -->
            <div class="relative
            mt-16
            rounded-[32px]
            border
            border-slate-200
            bg-white/90
            backdrop-blur-xl
            shadow-[0_20px_60px_rgba(15,23,42,.08)]
            p-8
            lg:p-10">

                <div class="grid
                grid-cols-1
                lg:grid-cols-3
                gap-7">

                    <!-- ===================== STUDENT ===================== -->
                    <div class="role-card group">

                        <div class="role-card-top"></div>

                        <div class="p-8">

                            <div class="role-icon">

                                <i class="fa-solid fa-user-graduate"></i>

                            </div>

                            <h3 class="mt-6
                            text-2xl
                            font-black
                            text-slate-900">

                                Sinh viên

                            </h3>

                            <p class="mt-4
                            text-slate-500
                            leading-7">

                                Sinh viên có thể tra cứu tài liệu theo môn học,
                                tìm kiếm nhanh và tải học liệu phục vụ học tập.

                            </p>

                            <div class="mt-7 space-y-3">

                                <div class="role-feature">

                                    <i class="fa-solid fa-check"></i>

                                    <span>Xem tài liệu môn học</span>

                                </div>

                                <div class="role-feature">

                                    <i class="fa-solid fa-check"></i>

                                    <span>Tìm kiếm theo từ khóa</span>

                                </div>

                                <div class="role-feature">

                                    <i class="fa-solid fa-check"></i>

                                    <span>Tải tài liệu học tập</span>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- ===================== LECTURER ===================== -->
                    <div class="role-card group">

                        <div class="role-card-top"></div>

                        <div class="p-8">

                            <div class="role-icon">

                                <i class="fa-solid fa-chalkboard-user"></i>

                            </div>

                            <h3 class="mt-6
                            text-2xl
                            font-black
                            text-slate-900">

                                Giảng viên

                            </h3>

                            <p class="mt-4
                            text-slate-500
                            leading-7">

                                Giảng viên có thể đăng tải, cập nhật và quản lý
                                học liệu của các môn học được phân công giảng dạy.

                            </p>

                            <div class="mt-7 space-y-3">

                                <div class="role-feature">

                                    <i class="fa-solid fa-check"></i>

                                    <span>Đăng tải học liệu</span>

                                </div>

                                <div class="role-feature">

                                    <i class="fa-solid fa-check"></i>

                                    <span>Quản lý tài liệu</span>

                                </div>

                                <div class="role-feature">

                                    <i class="fa-solid fa-check"></i>

                                    <span>Cập nhật phiên bản</span>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- ===================== ADMIN ===================== -->
                    <div class="role-card group">

                        <div class="role-card-top"></div>

                        <div class="p-8">

                            <div class="role-icon">

                                <i class="fa-solid fa-shield-halved"></i>

                            </div>

                            <h3 class="mt-6
                            text-2xl
                            font-black
                            text-slate-900">

                                Quản trị viên

                            </h3>

                            <p class="mt-4
                            text-slate-500
                            leading-7">

                                Quản trị viên chịu trách nhiệm quản lý toàn bộ
                                hệ thống, người dùng, môn học và thống kê hoạt động.

                            </p>

                            <div class="mt-7 space-y-3">

                                <div class="role-feature">

                                    <i class="fa-solid fa-check"></i>

                                    <span>Quản lý người dùng</span>

                                </div>

                                <div class="role-feature">

                                    <i class="fa-solid fa-check"></i>

                                    <span>Quản lý học liệu</span>

                                </div>

                                <div class="role-feature">

                                    <i class="fa-solid fa-check"></i>

                                    <span>Thống kê & Nhật ký</span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- GUEST SECTION -->
    <section class="guest-section mb-20">

        <div class="relative
        overflow-hidden
        rounded-[36px]
        bg-gradient-to-br
        from-white
        via-slate-50
        to-slate-100
        border
        border-slate-200
        shadow-[0_25px_70px_rgba(15,23,42,.08)]">

            <!-- Background Blur -->
            <div class="absolute
            -top-32
            -left-32
            w-[420px]
            h-[420px]
            rounded-full
            bg-amber-300/10
            blur-[120px]">
            </div>

            <div class="absolute
            -bottom-32
            -right-32
            w-[420px]
            h-[420px]
            rounded-full
            bg-slate-300/20
            blur-[120px]">
            </div>

            <!-- Dot Pattern -->
            <div class="absolute inset-0 opacity-[0.05]">

                <div class="absolute inset-0" style="
                background-image:radial-gradient(circle,#64748b 1px,transparent 1px);
                background-size:28px 28px;">

                </div>

            </div>

            <div class="relative
            max-w-5xl
            mx-auto
            text-center
            py-20
            px-8">

                <!-- Badge -->

                <span class="inline-flex
                items-center
                gap-2
                rounded-full
                
                px-5
                py-2.5
                text-xs
                font-black
                uppercase
                tracking-[0.22em]
                bg-slate-100
                border border-slate-200
                text-slate-700
                shadow-none
                shadow-lg
                shadow-slate-900/10">

                    <i class="fa-solid fa-graduation-cap"></i>

                    EDU DOC

                </span>

                <!-- Title -->

                <h1 class="mt-8
                text-4xl
                md:text-5xl
                leading-tight
                font-black
                tracking-tight
                text-slate-900">

                    Quản lý

                    <span class="text-amber-500">

                        học liệu

                    </span>



                    thông minh

                </h1>

                <!-- Description -->

                <p class="mt-7
                max-w-3xl
                mx-auto
                text-lg
                leading-9
                text-slate-500">

                    EDU DOC giúp sinh viên và giảng viên quản lý,
                    chia sẻ và tìm kiếm tài liệu theo khoa,
                    môn học và loại tài liệu trên một nền tảng
                    tập trung, hiện đại và dễ sử dụng.

                </p>

                <!-- ================= BUTTONS ================= -->

                <div class="mt-10
                flex
                justify-center
                flex-wrap
                gap-5">

                    <!-- LOGIN -->

                    <a href="{{ route('login') }}" class="inline-flex
                    items-center
                    gap-3
                    rounded-2xl
                    bg-gradient-to-r
                    from-slate-900
                    via-slate-800
                    to-slate-700
                    px-8
                    py-4
                    text-sm
                    font-bold
                    tracking-wide
                    text-white
                    shadow-lg
                    shadow-slate-900/20
                    transition-all
                    duration-300
                    hover:-translate-y-1
                    hover:shadow-xl">

                        Đăng nhập

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                    <!-- 

                    <a href="{{ route('register') }}" class="inline-flex
                    items-center
                    gap-3
                    rounded-2xl
                    border
                    border-slate-200
                    bg-white
                    px-8
                    py-4
                    text-sm
                    font-bold
                    text-slate-700
                    transition-all
                    duration-300
                    hover:-translate-y-1
                    hover:border-amber-300
                    hover:bg-amber-50
                    hover:text-amber-600
                    hover:shadow-lg">

                        <i class="fa-solid fa-user-plus"></i>

                        Tạo tài khoản

                    </a>
REGISTER -->
                </div>

                <!-- ================= STATISTICS ================= -->

                <div class="mt-20
                grid
                grid-cols-1
                md:grid-cols-3
                gap-6">

                    <!-- DOCUMENTS -->

                    <div class="rounded-3xl
                    border
                    border-slate-200
                    bg-white/90
                    backdrop-blur-xl
                    p-7
                    text-center
                    shadow-md
                    transition-all
                    duration-300
                    hover:-translate-y-2
                    hover:shadow-xl">

                        <div class="mx-auto
                        flex
                        h-16
                        w-16
                        items-center
                        justify-center
                        rounded-2xl
                      bg-slate-100
                        text-slate-700">

                            <i class="fa-solid fa-file-lines text-2xl"></i>

                        </div>

                        <h3 class="mt-6
                        text-5xl
                        font-black
                        text-slate-900">

                            {{ number_format($totalDocuments) }}

                        </h3>

                        <p class="mt-3
                        font-semibold
                        text-slate-500">

                            Tài liệu

                        </p>

                    </div>

                    <!-- SUBJECTS -->

                    <div class="rounded-3xl
                    border
                    border-slate-200
                    bg-white/90
                    backdrop-blur-xl
                    p-7
                    text-center
                    shadow-md
                    transition-all
                    duration-300
                    hover:-translate-y-2
                    hover:shadow-xl">

                        <div class="mx-auto
                        flex
                        h-16
                        w-16
                        items-center
                        justify-center
                        rounded-2xl
                        bg-slate-100
                        text-slate-700">

                            <i class="fa-solid fa-book-open text-2xl"></i>

                        </div>

                        <h3 class="mt-6
                        text-5xl
                        font-black
                        text-slate-900">

                            {{ number_format($totalSubjects) }}

                        </h3>

                        <p class="mt-3
                        font-semibold
                        text-slate-500">

                            Môn học

                        </p>

                    </div>

                    <!-- FACULTIES -->

                    <div class="rounded-3xl
                    border
                    border-slate-200
                    bg-white/90
                    backdrop-blur-xl
                    p-7
                    text-center
                    shadow-md
                    transition-all
                    duration-300
                    hover:-translate-y-2
                    hover:shadow-xl">

                        <div class="mx-auto
                        flex
                        h-16
                        w-16
                        items-center
                        justify-center
                        rounded-2xl
                        bg-slate-100
                        text-slate-700">

                            <i class="fa-solid fa-building-columns text-2xl"></i>

                        </div>

                        <h3 class="mt-6
                        text-5xl
                        font-black
                        text-slate-900">

                            {{ number_format($totalFaculties) }}

                        </h3>

                        <p class="mt-3
                        font-semibold
                        text-slate-500">

                            Khoa

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- Lợi ích của hệ thống -->
    <div class="mt-10 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">

        <div class="mb-8 text-center">

            <h3 class="text-2xl font-bold text-slate-900">
                Vì sao chọn EDU DOC?
            </h3>

            <p class="mt-2 max-w-3xl mx-auto text-slate-500 leading-7">
                EDU DOC mang đến một môi trường quản lý học liệu hiện đại, giúp việc lưu trữ,
                chia sẻ và khai thác tài liệu trở nên nhanh chóng, thuận tiện và hiệu quả.
            </p>

        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">

            <!-- Card 1 -->
            <div
                class="rounded-2xl border border-slate-200 bg-white p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

                <div
                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-200 bg-slate-100">

                    <i class="fa-solid fa-bolt text-xl text-amber-500"></i>

                </div>

                <h4 class="mt-5 text-lg font-semibold text-slate-900">
                    Nhanh chóng
                </h4>

                <p class="mt-3 text-sm leading-7 text-slate-600">
                    Tra cứu và truy cập tài liệu chỉ trong vài giây với bộ lọc và tìm kiếm thông minh.
                </p>

            </div>

            <!-- Card 2 -->
            <div
                class="rounded-2xl border border-slate-200 bg-white p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

                <div
                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-200 bg-slate-100">

                    <i class="fa-solid fa-shield-halved text-xl text-amber-500"></i>

                </div>

                <h4 class="mt-5 text-lg font-semibold text-slate-900">
                    An toàn
                </h4>

                <p class="mt-3 text-sm leading-7 text-slate-600">
                    Quản lý quyền truy cập theo từng vai trò, đảm bảo tài liệu được sử dụng đúng đối tượng.
                </p>

            </div>

            <!-- Card 3 -->
            <div
                class="rounded-2xl border border-slate-200 bg-white p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

                <div
                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-200 bg-slate-100">

                    <i class="fa-solid fa-layer-group text-xl text-amber-500"></i>

                </div>

                <h4 class="mt-5 text-lg font-semibold text-slate-900">
                    Quản lý tập trung
                </h4>

                <p class="mt-3 text-sm leading-7 text-slate-600">
                    Tất cả học liệu được lưu trữ trên một hệ thống thống nhất, dễ dàng quản lý và cập nhật.
                </p>

            </div>

            <!-- Card 4 -->
            <div
                class="rounded-2xl border border-slate-200 bg-white p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

                <div
                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-200 bg-slate-100">

                    <i class="fa-solid fa-hand-pointer text-xl text-amber-500"></i>

                </div>

                <h4 class="mt-5 text-lg font-semibold text-slate-900">
                    Dễ sử dụng
                </h4>

                <p class="mt-3 text-sm leading-7 text-slate-600">
                    Giao diện trực quan, thân thiện với người dùng và phù hợp cho cả giảng viên lẫn sinh viên.
                </p>

            </div>

        </div>

    </div>

    <!-- ==========================================
        QUICK ACTIONS
    =========================================== -->
    <section class="mt-20">

        <!-- Heading -->
        <div class="text-center mb-12">

            <!-- Badge -->
            <span class="inline-flex
            items-center
            gap-2
            px-5
            py-2.5
            rounded-full
            bg-slate-900
            text-amber-400
            text-xs
            font-black
            uppercase
            tracking-[0.20em]
            shadow-lg
            shadow-slate-900/10">

                <i class="fa-solid fa-compass"></i>

                Khám phá hệ thống

            </span>

            <!-- Title -->
            <h2 class="mt-6
            text-4xl
            md:text-5xl
            font-black
            tracking-tight
            text-slate-900">

                Truy cập

                <span class="text-amber-500">

                    nhanh

                </span>

            </h2>

            <!-- Description -->
            <p class="mt-5
            max-w-2xl
            mx-auto
            text-lg
            leading-8
            text-slate-500">

                Khám phá danh sách khoa, môn học và kho tài liệu
                chỉ với một lần nhấp chuột trên hệ thống EDUDOC.

            </p>

        </div>

        <!-- Cards -->
        <div class="grid
        grid-cols-1
        md:grid-cols-3
        gap-7">

            <!-- ========================= -->
            <!-- FACULTY -->
            <!-- ========================= -->

            <a href="{{ route('faculties.index') }}" class="group
            quick-card
            relative
            overflow-hidden
            rounded-[30px]
            bg-white
            border
            border-slate-200
            p-8
            shadow-[0_15px_40px_rgba(15,23,42,.06)]
            hover:-translate-y-2
            hover:shadow-[0_25px_60px_rgba(15,23,42,.12)]
            transition-all
            duration-300">

                <!-- Hover Background -->
                <div class="absolute
                -top-12
                -right-12
                w-40
                h-40
                rounded-full
                bg-amber-100/40
                opacity-0
                group-hover:opacity-100
                transition
                duration-300">
                </div>

                <div class="relative">

                    <!-- Icon -->
                    <div class="quick-icon
                    w-16
                    h-16
                    rounded-3xl
                    bg-slate-900
                    text-amber-400
                    flex
                    items-center
                    justify-center
                    text-2xl
                    transition-all
                    duration-300
                    group-hover:bg-amber-500
                    group-hover:text-white">

                        <i class="fa-solid fa-building-columns"></i>

                    </div>

                    <h3 class="mt-7
                    text-2xl
                    font-black
                    text-slate-900">

                        Khoa

                    </h3>

                    <p class="mt-3
                    text-slate-500
                    leading-7">

                        Xem toàn bộ danh sách các khoa
                        đang có trong hệ thống.

                    </p>
                    <!-- Bottom -->
                    <div class="mt-8
                    flex
                    items-center
                    justify-between">

                        <span class="font-bold text-amber-600">

                            Khám phá

                        </span>

                        <div class="w-11
                        h-11
                        rounded-full
                        bg-slate-100
                        flex
                        items-center
                        justify-center
                        transition-all
                        duration-300
                        group-hover:bg-amber-500
                        group-hover:text-white">

                            <i class="fa-solid fa-arrow-right"></i>

                        </div>

                    </div>

                </div>

            </a>

            <!-- ========================= -->
            <!-- SUBJECT -->
            <!-- ========================= -->

            <a href="{{ route('subjects.index') }}" class="group
            quick-card
            relative
            overflow-hidden
            rounded-[30px]
            bg-white
            border
            border-slate-200
            p-8
            shadow-[0_15px_40px_rgba(15,23,42,.06)]
            hover:-translate-y-2
            hover:shadow-[0_25px_60px_rgba(15,23,42,.12)]
            transition-all
            duration-300">

                <!-- Hover Background -->
                <div class="absolute
                -top-12
                -right-12
                w-40
                h-40
                rounded-full
                bg-amber-100/40
                opacity-0
                group-hover:opacity-100
                transition
                duration-300">
                </div>

                <div class="relative">

                    <!-- Icon -->
                    <div class="quick-icon
                    w-16
                    h-16
                    rounded-3xl
                    bg-slate-900
                    text-amber-400
                    flex
                    items-center
                    justify-center
                    text-2xl
                    transition-all
                    duration-300
                    group-hover:bg-amber-500
                    group-hover:text-white">

                        <i class="fa-solid fa-book-open"></i>

                    </div>

                    <h3 class="mt-7
                    text-2xl
                    font-black
                    text-slate-900">

                        Môn học

                    </h3>

                    <p class="mt-3
                    text-slate-500
                    leading-7">

                        Duyệt toàn bộ danh sách môn học
                        và học liệu được phân loại
                        theo từng chuyên ngành.

                    </p>

                    <div class="mt-8
                    flex
                    items-center
                    justify-between">

                        <span class="font-bold text-amber-600">

                            Khám phá

                        </span>

                        <div class="w-11
                        h-11
                        rounded-full
                        bg-slate-100
                        flex
                        items-center
                        justify-center
                        transition-all
                        duration-300
                        group-hover:bg-amber-500
                        group-hover:text-white">

                            <i class="fa-solid fa-arrow-right"></i>

                        </div>

                    </div>

                </div>

            </a>
            <!-- ========================= -->
            <!-- DOCUMENT -->
            <!-- ========================= -->

            <a href="{{ route('documents.index') }}" class="group
            quick-card
            relative
            overflow-hidden
            rounded-[30px]
            bg-white
            border
            border-slate-200
            p-8
            shadow-[0_15px_40px_rgba(15,23,42,.06)]
            hover:-translate-y-2
            hover:shadow-[0_25px_60px_rgba(15,23,42,.12)]
            transition-all
            duration-300">

                <!-- Hover Background -->
                <div class="absolute
                -top-12
                -right-12
                w-40
                h-40
                rounded-full
                bg-amber-100/40
                opacity-0
                group-hover:opacity-100
                transition
                duration-300">
                </div>

                <div class="relative">

                    <!-- Icon -->
                    <div class="quick-icon
                    w-16
                    h-16
                    rounded-3xl
                    bg-slate-900
                    text-amber-400
                    flex
                    items-center
                    justify-center
                    text-2xl
                    transition-all
                    duration-300
                    group-hover:bg-amber-500
                    group-hover:text-white">

                        <i class="fa-solid fa-file-lines"></i>

                    </div>

                    <!-- Title -->
                    <h3 class="mt-7
                    text-2xl
                    font-black
                    text-slate-900">

                        Tài liệu

                    </h3>

                    <!-- Description -->
                    <p class="mt-3
                    text-slate-500
                    leading-7">

                        Khám phá giáo trình, bài giảng,
                        slide, đề thi và nhiều tài liệu học tập
                        được cập nhật thường xuyên.

                    </p>

                    <!-- Bottom -->
                    <div class="mt-8
                    flex
                    items-center
                    justify-between">

                        <span class="font-bold text-amber-600">

                            Xem ngay

                        </span>

                        <div class="w-11
                        h-11
                        rounded-full
                        bg-slate-100
                        flex
                        items-center
                        justify-center
                        transition-all
                        duration-300
                        group-hover:bg-amber-500
                        group-hover:text-white">

                            <i class="fa-solid fa-arrow-right"></i>

                        </div>

                    </div>

                </div>

            </a>

        </div>

    </section>
    @endguest
    <!-- Phần Tài liệu sẽ chia quyền giảng viên và sinh viên -->
    @auth
    <!--DANH MỤC MÔN HỌC (SINH VIÊN xem đc tất cả các file, giảng viên xem đc tất cả các file)-->
    <div class="mb-12 py-15 my-10">

        <div class="mb-8">

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-4">


                    <div>



                        <h1 class="text-3xl font-bold text-slate-900">
                            Danh sách môn học
                        </h1>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Danh sách các môn học được quản lý và cập nhật trong hệ thống.
                        </p>

                    </div>

                </div>

                <a href="{{ route('subjects.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">

                    Xem tất cả

                    <i class="fa-solid fa-arrow-right text-xs"></i>

                </a>

            </div>



            <div class="mt-5 h-px bg-slate-200"></div>

        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @foreach($topSubjects as $subject)

            <a href="{{ route('subjects.show',$subject->subject_code) }}" class="group flex flex-col overflow-hidden
        rounded-3xl
        border border-slate-200
        bg-white
        shadow-sm
        transition-all duration-300
        hover:-translate-y-1
        hover:border-slate-300
        hover:shadow-xl">

                <!-- IMAGE -->
                <div class="relative h-44 overflow-hidden">

                    <img src="{{ $subject->thumbnail_url }}" alt="{{ $subject->subject_name }}"
                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent">
                    </div>

                    @if($subject->faculty)

                    <span class="absolute
                top-4
                left-4
                rounded-full
                border
                border-white/60
                bg-white/90
                backdrop-blur
                px-3
                py-1
                text-xs
                font-semibold
                text-slate-700">

                        {{ $subject->faculty->faculty_name }}

                    </span>

                    @endif

                </div>

                <!-- CONTENT -->
                <div class="flex flex-1 flex-col p-5">

                    <!-- Subject Code -->
                    <span class="inline-flex
                w-fit
                rounded-full
                bg-amber-50
                px-3
                py-1
                text-[11px]
                font-bold
                uppercase
                tracking-[0.18em]
                text-amber-600">

                        {{ $subject->subject_code }}

                    </span>

                    <!-- Title -->
                    <h3 class="mt-3
                line-clamp-2
                text-lg
                font-black
                text-slate-900
                transition-colors
                group-hover:text-amber-500">

                        {{ $subject->subject_name }}

                    </h3>

                    <div class="mt-auto pt-6">

                        <div class="flex items-center justify-between border-t border-slate-100 pt-4">

                            <div>

                                <p class="text-2xl font-black text-slate-900">

                                    {{ number_format($subject->documents_count) }}

                                </p>

                                <p class="mt-1 text-xs font-medium text-slate-500">

                                    Tài liệu

                                </p>

                            </div>

                            <!-- Arrow -->
                            <div class="flex
                        h-11
                        w-11
                        items-center
                        justify-center
                        rounded-full
                        border
                        border-slate-200
                        bg-slate-100
                        text-slate-600
                        transition-all
                        duration-300
                        group-hover:border-amber-300
                        group-hover:bg-amber-500
                        group-hover:text-white">

                                <i class="fa-solid fa-arrow-right"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </a>

            @endforeach

        </div>
    </div>
    <!-- ================= TÀI LIỆU NỔI BẬT ================= -->
    <section class="py-14">

        <div class="mb-8">

            <div class="flex items-center justify-between">

                <div>

                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100">

                            <i class="fa-solid fa-star text-xl text-amber-500"></i>

                        </div>

                        <div>

                            <h2 class="text-3xl font-bold text-slate-900">
                                Tài liệu nổi bật
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Những tài liệu được tải nhiều và được quan tâm nhất.
                            </p>

                        </div>

                    </div>

                </div>

                <a href="{{ route('documents.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50">

                    Xem tất cả

                    <i class="fa-solid fa-arrow-right text-xs"></i>

                </a>

            </div>

            <div class="mt-5 h-px bg-slate-200"></div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            @foreach($featuredDocuments as $document)

            <a href="{{ route('documents.show',$document->document_id) }}"
                class="group flex flex-col rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-amber-300 hover:shadow-xl">


                <!-- Icon + Badge -->
                <div class="mt-6 flex items-start justify-between">

                    <!-- File Icon -->
                    <div
                        class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-500 transition-all duration-300 group-hover:bg-amber-100 group-hover:text-amber-500">

                        <i class="fa-solid fa-file-lines text-3xl"></i>

                    </div>

                    <!-- Badge -->
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-600">

                        <i class="fa-solid fa-star text-[10px]"></i>

                        Nổi bật

                    </span>

                </div>
                <!-- Title -->
                <h3 class="mt-5 truncate text-lg font-bold text-slate-900 transition-colors duration-300 group-hover:text-amber-500"
                    title="{{ $document->title }}">

                    {{ $document->title }}

                </h3>

                <!-- Subject -->
                <div class="mt-4">

                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-600">

                        <i class="fa-solid fa-book text-amber-500"></i>

                        {{ $document->subject->subject_name }}

                    </span>

                </div>

                <!-- Document Type -->
                <div class="mt-3">

                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-600">

                        <i class="fa-solid fa-folder-open"></i>

                        {{ $document->documentType->type_name }}

                    </span>

                </div>

                <!-- Footer -->
                <div class="mt-auto pt-6">

                    <div class="border-t border-slate-100 pt-4">

                        <div class="flex items-center justify-between">

                            <div class="space-y-2">

                                <div class="flex items-center gap-2 text-sm font-medium text-slate-600">

                                    <i class="fa-solid fa-download text-amber-500"></i>

                                    {{ number_format($document->download_count) }} lượt tải

                                </div>

                                <div class="flex items-center gap-2 text-sm text-slate-500">

                                    <i class="fa-solid fa-calendar text-amber-500"></i>

                                    {{ $document->created_at->format('d/m/Y') }}

                                </div>

                            </div>

                            <span
                                class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition-all duration-300 group-hover:bg-amber-500">

                                Xem

                            </span>

                        </div>

                    </div>

                </div>

            </a>

            @endforeach

        </div>

    </section>



    <!-- Phần Tài liệu sẽ chia quyền sinh viên -->
    @if(auth()->user()->role_id !=2)
    <!-- ========================= -->
    <!-- TÀI LIỆU -->
    <!-- ========================= -->
    <div class="grid grid-cols-1 xl:grid-cols-[2fr_1fr] gap-8 mt-14">

        <!-- ================= LEFT ================= -->
        <div class="flex flex-col h-full">

            <!-- HEADER -->
            <div class="mb-6 flex items-center justify-between">

                <div class="flex items-center gap-4">

                    <div>

                        <h1 class="text-3xl font-bold text-slate-900">
                            Tài liệu mới nhất
                        </h1>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Những tài liệu vừa được cập nhật trong hệ thống.
                        </p>

                    </div>

                </div>

                <!-- Icon -->
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">

                    <i class="fa-solid fa-clock-rotate-left text-2xl"></i>

                </div>

            </div>

            <!-- CARD -->
            <div class="overflow-hidden
            rounded-3xl
            border
            border-slate-200
            bg-white
            shadow-sm">

                @foreach($latestDocuments as $document)

                @php
                $ext = strtolower($document->currentVersion->file_extension ?? '');
                @endphp


                <div class="group
                flex
                items-center
                justify-between
                gap-6
                border-b
                border-slate-100
                px-6
                py-5
                transition
                hover:bg-slate-50">

                    <!-- LEFT -->
                    <a href="{{ route('documents.show', $document->document_id) }}"
                        class="flex flex-1 items-center gap-5 min-w-0">

                        <!-- FILE ICON -->
                        <div class="flex h-14 w-14 items-center justify-center
                            rounded-2xl
                            border border-slate-200
                            bg-slate-100
                            text-slate-600
                            transition-all duration-300
                            group-hover:border-amber-300
                            group-hover:bg-amber-50
                            group-hover:text-amber-500">

                            <i class="fa-solid fa-folder-open text-xl"></i>

                        </div>
                        <!-- CONTENT -->
                        <div class="min-w-0 flex-1">

                            <h3 class="truncate
                            text-lg
                            font-bold
                            text-slate-900
                            transition-colors
                            group-hover:text-amber-500">

                                {{ $document->title }}

                            </h3>

                            <div class="mt-3 flex flex-wrap gap-2">

                                <!-- Subject -->
                                <span class="inline-flex
                                items-center
                                rounded-full
                                bg-slate-100
                                px-3
                                py-1
                                text-xs
                                font-medium
                                text-slate-700">

                                    <i class="fa-solid fa-book mr-1 text-amber-500"></i>

                                    {{ $document->subject?->subject_name ?? 'Chưa có môn học' }}

                                </span>

                                <!-- Download -->
                                <span class="inline-flex
                                items-center
                                rounded-full
                                bg-amber-50
                                px-3
                                py-1
                                text-xs
                                font-medium
                                text-amber-600">

                                    <i class="fa-solid fa-download mr-1"></i>

                                    {{ number_format($document->download_count) }}

                                </span>

                                <!-- Date -->
                                <span class="inline-flex
                                items-center
                                rounded-full
                                bg-slate-100
                                px-3
                                py-1
                                text-xs
                                font-medium
                                text-slate-600">

                                    <i class="fa-solid fa-calendar mr-1 text-amber-500"></i>

                                    {{ $document->created_at->format('d/m/Y') }}

                                </span>

                            </div>

                        </div>

                    </a>

                    <!-- DOWNLOAD BUTTON -->
                    <div class="shrink-0">

                        <a href="{{ route('documents.download',$document) }}" class="inline-flex
                        items-center
                        gap-2
                        rounded-xl
                        bg-slate-900
                        px-5
                        py-3
                        text-sm
                        font-semibold
                        text-white
                        transition-all
                        duration-300
                        hover:-translate-y-0.5
                        hover:bg-slate-800">

                            <i class="fa-solid fa-download"></i>

                            Tải

                        </a>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

        <!-- ================= RIGHT ================= -->
        <div class="flex flex-col h-full">

            <!-- HEADER -->
            <div class="mb-6 flex items-center justify-between">

                <div class="flex items-center gap-4">

                    <div>

                        <h1 class="text-3xl font-bold text-slate-900">
                            Tài liệu truy cập nhiều
                        </h1>

                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Những tài liệu được người dùng truy cập và xem nhiều nhất.
                        </p>

                    </div>

                </div>

                <!-- Icon -->
                <div
                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-violet-100 text-violet-600 shadow-sm">

                    <i class="fa-solid fa-eye text-2xl"></i>

                </div>

            </div>

            <!-- CARD -->
            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">

                <div class="space-y-4">

                    @foreach($topViewedDocuments as $index => $document)

                    <a href="{{ route('documents.show', $document->document_id) }}"
                        class="group flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-4 transition-all duration-300 hover:-translate-y-1 hover:border-violet-300 hover:shadow-lg">

                        <!-- RANK -->
                        <div class="shrink-0">

                            @if($index == 0)

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-full bg-amber-500 text-white font-bold">
                                #1
                            </div>

                            @elseif($index == 1)

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-500 text-white font-bold">
                                #2
                            </div>

                            @else

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-700 text-white font-bold">
                                #3
                            </div>

                            @endif

                        </div>

                        <!-- CONTENT -->
                        <div class="flex-1 min-w-0">

                            <h3 class="truncate text-base font-bold text-slate-900 transition-colors duration-300 group-hover:text-violet-600"
                                title="{{ $document->title }}">

                                {{ $document->title }}

                            </h3>

                            <div class="mt-2">

                                <span
                                    class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700">

                                    <i class="fa-solid fa-book mr-2 text-violet-500"></i>

                                    {{ $document->subject?->subject_name }}

                                </span>

                            </div>

                            <div class="mt-3 flex items-center justify-between">

                                <span class="text-sm font-semibold text-violet-600">

                                    <i class="fa-solid fa-eye mr-1"></i>

                                    {{ number_format($document->view_count) }} lượt xem

                                </span>

                                <span class="text-xs text-slate-400">

                                    {{ $document->created_at->format('d/m/Y') }}

                                </span>

                            </div>

                        </div>

                        <!-- ARROW -->
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-slate-100 text-slate-600 transition-all duration-300 group-hover:border-violet-300 group-hover:bg-violet-500 group-hover:text-white">

                            <i class="fa-solid fa-arrow-right text-xs"></i>

                        </div>

                    </a>

                    @endforeach

                </div>

            </div>

        </div>
    </div>
    @endif
    <!-- Phần Tài liệu sẽ chia quyền  giảng viên -->
    @if(auth()->user()->role_id==2)
    <!-- ======================================== -->
    <!-- TÀI LIỆU GIẢNG VIÊN ĐÃ ĐĂNG -->
    <!-- ======================================== -->
    <div class="grid grid-cols-1 xl:grid-cols-[2fr_1fr] gap-8 mt-14 items-start">

        <!-- ================= LEFT ================= -->
        <!-- ================= LEFT ================= -->
        <div class="flex flex-col h-full">

            <!-- HEADER -->
            <div class="flex items-center gap-4 mb-6">

                <div>

                    <h1 class="text-3xl font-bold text-slate-900">
                        Tài liệu đã đăng
                    </h1>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Quản lý các tài liệu mà bạn đã tải lên hệ thống.
                    </p>

                </div>

            </div>

            <!-- CARD -->
            <div class="flex-1
                overflow-hidden
                rounded-3xl
                border
                border-slate-200
                bg-white
                shadow-sm">

                @forelse($myDocuments as $document)

                @php
                $ext = strtolower($document->currentVersion->file_extension ?? '');
                @endphp

                <div class="group
            flex
            items-center
            justify-between
            gap-6
            border-b
            border-slate-100
            px-6
            py-5
            transition
            hover:bg-slate-50">

                    <!-- LEFT -->
                    <a href="{{ route('documents.show',$document->document_id) }}"
                        class="flex flex-1 items-center gap-5 min-w-0">

                        <!-- FILE ICON -->
                        <div class="flex h-14 w-14 items-center justify-center
                            rounded-2xl
                            border border-slate-200
                            bg-slate-100
                            text-slate-600
                            transition-all duration-300
                            group-hover:border-amber-300
                            group-hover:bg-amber-50
                            group-hover:text-amber-500">

                            <i class="fa-solid fa-folder-open text-xl"></i>

                        </div>

                        <!-- INFO -->
                        <div class="min-w-0 flex-1">

                            <h3 class="truncate
                        text-lg
                        font-semibold
                        text-slate-800
                        transition-colors
                        group-hover:text-amber-500">

                                {{ $document->title }}

                            </h3>

                            <div class="mt-3 flex flex-wrap gap-2">

                                <span class="rounded-full
                            bg-slate-100
                            px-3
                            py-1
                            text-xs
                            text-slate-700">

                                    <i class="fa-solid fa-book mr-1 text-amber-500"></i>

                                    {{ $document->subject->subject_name }}

                                </span>

                                <span class="rounded-full
                            bg-amber-50
                            px-3
                            py-1
                            text-xs
                            text-amber-700">

                                    <i class="fa-solid fa-download mr-1"></i>

                                    {{ number_format($document->download_count) }}

                                </span>

                                <span class="rounded-full
                            bg-slate-100
                            px-3
                            py-1
                            text-xs
                            text-slate-600">

                                    <i class="fa-solid fa-calendar mr-1 text-amber-500"></i>

                                    {{ $document->created_at->format('d/m/Y') }}

                                </span>

                            </div>

                        </div>

                    </a>
                    <!-- BUTTON -->
                    <div class="shrink-0">

                        <a href="{{ route('documents.download',$document) }}" class="inline-flex
                    items-center
                    gap-2
                    rounded-xl
                    bg-slate-900
                    px-5
                    py-3
                    text-sm
                    font-semibold
                    text-white
                    transition-all
                    duration-300
                    hover:bg-amber-500
                    hover:-translate-y-0.5
                    hover:shadow-lg">

                            <i class="fa-solid fa-download"></i>

                            Tải

                        </a>

                    </div>

                </div>

                @empty

                <!-- EMPTY -->
                <div class="py-20 text-center">

                    <div class="mx-auto
                flex
                h-20
                w-20
                items-center
                justify-center
                rounded-full
                bg-slate-100">

                        <i class="fa-solid fa-folder-open text-3xl text-slate-400"></i>

                    </div>

                    <h3 class="mt-6 text-lg font-bold text-slate-800">

                        Chưa có tài liệu

                    </h3>

                    <p class="mt-2 text-sm leading-6 text-slate-500">

                        Bạn chưa đăng tải tài liệu nào lên hệ thống.

                    </p>

                </div>

                @endforelse

            </div>

        </div>
        <!-- ================= RIGHT ================= -->
        <div class="flex flex-col h-full">

            <!-- HEADER -->
            <div class="flex items-center gap-4 mb-6">


                <div>



                    <h1 class="text-3xl font-bold text-slate-900">

                        Thống kê tương tác

                    </h1>

                    <p class="mt-2 text-sm leading-6 text-slate-500">

                        Theo dõi hiệu quả các tài liệu mà bạn đã đăng tải.

                    </p>

                </div>

            </div>

            <!-- CARD -->
            <div class="flex-1
                    rounded-3xl
                    border
                    border-slate-200
                    bg-white
                    p-6
                    shadow-sm">

                <div class="grid grid-cols-2 gap-4 h-full">

                    <!-- Tổng tài liệu -->
                    <div class="rounded-2xl
                border
                border-slate-200
                bg-white
                p-5
                transition-all
                duration-300
                hover:-translate-y-1
                hover:shadow-md">

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-xs uppercase tracking-wider text-slate-400 font-semibold">

                                    Tài liệu

                                </p>

                                <h3 class="mt-2 text-3xl font-black text-slate-900">

                                    {{ number_format($totalDocuments) }}

                                </h3>

                            </div>

                            <div class="flex
                        h-11
                        w-11
                        items-center
                        justify-center
                        rounded-xl
                        bg-slate-100">

                                <i class="fa-solid fa-file-lines text-lg text-amber-500"></i>

                            </div>

                        </div>

                    </div>

                    <!-- Tổng lượt tải -->
                    <div class="rounded-2xl
                border
                border-slate-200
                bg-white
                p-5
                transition-all
                duration-300
                hover:-translate-y-1
                hover:shadow-md">

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-xs uppercase tracking-wider text-slate-400 font-semibold">

                                    Lượt tải

                                </p>

                                <h3 class="mt-2 text-3xl font-black text-slate-900">

                                    {{ number_format($totalDownloads) }}

                                </h3>

                            </div>

                            <div class="flex
                        h-11
                        w-11
                        items-center
                        justify-center
                        rounded-xl
                        bg-slate-100">

                                <i class="fa-solid fa-download text-lg text-slate-700"></i>

                            </div>

                        </div>

                    </div>

                    @if($topDocument->count())

                    <!-- TOP DOCUMENT -->
                    <a href="{{ route('documents.show',$topDocument->first()->document_id) }}" class="col-span-2
                        block
                        rounded-2xl
                        border
                        border-slate-200
                        bg-white
                        p-5
                        transition-all
                        duration-300
                        hover:-translate-y-1
                        hover:border-amber-300
                        hover:shadow-lg">

                        <div class="flex items-center justify-between gap-4">

                            <div class="min-w-0 flex-1">

                                <p class="text-xs
                            font-bold
                            uppercase
                            tracking-[0.2em]
                            text-amber-500">

                                    Tài liệu nổi bật

                                </p>

                                <h4 class="mt-2
                            truncate
                            text-base
                            font-bold
                            text-slate-900">

                                    {{ $topDocument->first()->title }}

                                </h4>

                                <p class="mt-2 text-sm text-slate-500">

                                    {{ number_format($topDocument->first()->download_count) }}
                                    lượt tải

                                </p>

                            </div>

                            <div class="flex items-center gap-3">

                                <span class="rounded-full
                            bg-amber-50
                            px-3
                            py-1
                            text-sm
                            font-semibold
                            text-amber-700">

                                    Top 1

                                </span>

                                <div class="flex
                            h-10
                            w-10
                            items-center
                            justify-center
                            rounded-full
                            border
                            border-slate-200
                            bg-slate-100
                            text-slate-600
                            transition-all
                            duration-300
                            group-hover:border-amber-300
                            group-hover:bg-amber-500
                            group-hover:text-white">

                                    <i class="fa-solid fa-arrow-right text-xs"></i>

                                </div>

                            </div>

                        </div>

                    </a>

                    @endif
                    @if($topViewedDocuments)

                    <a href="{{ route('documents.show',$topViewedDocuments->document_id) }}" class="col-span-2
                        block
                        rounded-2xl
                        border
                        border-slate-200
                        bg-white
                        p-5
                        transition-all
                        duration-300
                        hover:-translate-y-1
                        hover:border-sky-300
                        hover:shadow-lg">

                        <div class="flex items-center justify-between gap-4">

                            <div class="min-w-0 flex-1">

                                <p class="text-xs
                                font-bold
                                uppercase
                                tracking-[0.2em]
                                text-sky-500">

                                    Tài liệu xem nhiều nhất

                                </p>

                                <h4 class="mt-2
                                truncate
                                text-base
                                font-bold
                                text-slate-900">

                                    {{ $topViewedDocuments->title }}

                                </h4>

                                <p class="mt-2 text-sm text-slate-500">

                                    {{ number_format($topViewedDocuments->view_count) }}
                                    lượt xem

                                </p>

                            </div>

                            <div class="flex items-center gap-3">

                                <span class="rounded-full
                                bg-sky-50
                                px-3
                                py-1
                                text-sm
                                font-semibold
                                text-sky-700">

                                    Top View

                                </span>

                                <div class="flex
                            h-10
                            w-10
                            items-center
                            justify-center
                            rounded-full
                            border
                            border-slate-200
                            bg-slate-100
                            text-slate-600
                            transition-all
                            duration-300
                            group-hover:border-amber-300
                            group-hover:bg-amber-500
                            group-hover:text-white">

                                    <i class="fa-solid fa-arrow-right text-xs"></i>

                                </div>

                            </div>

                        </div>

                    </a>

                    @endif

                </div>

            </div>

        </div>

    </div>

    @endif

    @endauth
</main>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const reveals = document.querySelectorAll('.reveal');

    const observer = new IntersectionObserver(function(entries) {

        entries.forEach(function(entry) {

            if (entry.isIntersecting) {

                entry.target.classList.add('active');

                // Chỉ chạy 1 lần
                observer.unobserve(entry.target);

            }

        });

    }, {
        threshold: 0.2
    });

    reveals.forEach(function(section) {
        observer.observe(section);
    });

});
</script>
@endpush