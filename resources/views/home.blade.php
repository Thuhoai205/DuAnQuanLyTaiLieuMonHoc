@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

<!-- HERO -->
<!-- ================= HERO ================= -->
<header class="relative overflow-hidden bg-gradient-to-br from-cyan-700 via-cyan-600 to-sky-600 text-white">


    <div class="absolute inset-0">
        <img src="https://i.pinimg.com/1200x/96/d3/c9/96d3c90189af11a192ba76519fb7cf2a.jpg"
            class="w-full h-full object-cover">
        <!-- Lớp phủ này sẽ giúp chữ trắng hiển thị rõ mồn một -->
        <div class="absolute inset-0 bg-slate-900/40"></div>
    </div>

    <div class="absolute inset-0 bg-gradient-to-r from-cyan-900/40 to-cyan-600/30"></div>

    <!-- Blur -->
    <div class="absolute -top-32 -left-24 w-80 h-80 rounded-full bg-cyan-300/20 blur-3xl"></div>

    <div class="absolute bottom-0 right-0 w-[420px] h-[420px] rounded-full bg-white/10 blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-6 py-16">

        <div class="grid lg:grid-cols-5 gap-12 items-center">
            <!-- ================= LEFT ================= -->
            <div class="lg:col-span-3">
                <!-- Badge - GRADIENT CÔNG NGHỆ -->
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
                <h1 class="mt-6 text-5xl leading-tight font-black">
                    <!-- Trong thẻ H1, sửa lại span điểm nhấn -->
                    Khám phá <span class="text-yellow-300">kho tài liệu</span> học tập hiện đại

                </h1>

                <!-- Description -->
                <p class="mt-6 text-cyan-50/90 text-lg leading-8 max-w-lg">

                    Tìm kiếm giáo trình, slide, bài giảng,
                    đề thi và tài liệu học tập theo từng
                    môn học, khoa và loại tài liệu.

                </p>

                <!-- SEARCH -->
                <form action="{{ route('documents.search') }}" method="GET"
                    class="mt-10 bg-white rounded-[28px] p-5 shadow-2xl">

                    <div class="relative">

                        <!-- Icon -->
                        <div class="absolute inset-y-0 left-5 flex items-center">

                            <i class="fa-solid fa-magnifying-glass text-cyan-500 text-lg"></i>

                        </div>

                        <!-- Input -->
                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                            placeholder="Tìm tên tài liệu hoặc từ khóa..." class="w-full h-16
                            rounded-2xl
                            border border-slate-200
                            bg-white
                            pl-14 pr-5
                            text-base text-slate-700
                            placeholder:text-slate-400
                            focus:outline-none
                            focus:ring-4
                            focus:ring-cyan-100
                            focus:border-cyan-500
                            transition">
                    </div>

                    <!-- FILTER -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

                        <!-- SUBJECT -->
                        <select name="subject_code" class="h-14 rounded-xl border border-slate-200 px-4 text-slate-700">

                            <option value="">

                                Tất cả môn học

                            </option>

                            @foreach($subjects as $subject)

                            <option value="{{ $subject->subject_code }}"
                                {{ request('subject_code')==$subject->subject_code?'selected':'' }}>

                                {{ $subject->subject_name }}

                            </option>

                            @endforeach

                        </select>

                        <!-- TYPE -->
                        <select name="document_type_id"
                            class="h-14 rounded-xl border border-slate-200 px-4 text-slate-700">

                            <option value="">

                                Loại tài liệu

                            </option>

                            @foreach($documentTypes as $type)

                            <option value="{{ $type->document_type_id }}"
                                {{ request('document_type_id')==$type->document_type_id?'selected':'' }}>

                                {{ $type->type_name }}

                            </option>

                            @endforeach

                        </select>

                        <!-- FACULTY -->
                        <select name="faculty_id" class="h-14 rounded-xl border border-slate-200 px-4 text-slate-700">

                            <option value="">

                                Tất cả khoa

                            </option>

                            @foreach($faculties as $faculty)

                            <option value="{{ $faculty->faculty_id }}"
                                {{ request('faculty_id')==$faculty->faculty_id?'selected':'' }}>

                                {{ $faculty->faculty_name }}

                            </option>

                            @endforeach

                        </select>

                        <!-- BUTTON -->
                        <!-- BUTTON - MÀU VÀNG AMBER -->
                        <button type="submit" class="h-14 rounded-xl
                            bg-amber-500
                            hover:bg-amber-600
                            text-white
                            font-bold
                            transition-all
                            shadow-lg">
                            <i class="fa-solid fa-search mr-2"></i>
                            Tìm kiếm
                        </button>
                    </div>

                </form>

            </div>
            <div class="hidden lg:block lg:col-span-2 self-center">
                <div class="relative">

                    <!-- GLOW NHẸ ĐẰNG SAU -->
                    <div
                        class="absolute -top-8 -left-8 w-64 h-64 rounded-full bg-amber-400/10 blur-[80px] pointer-events-none">
                    </div>

                    <!-- CONTAINER CHÍNH (Đã sửa từ p-4.5 thành p-5 chuẩn Tailwind để tạo khoảng cách rìa cực đẹp) -->
                    <div
                        class="relative overflow-hidden rounded-[32px] bg-white/80 backdrop-blur-md border-[3px] border-white shadow-[0_20px_50px_rgba(139,126,116,0.15)] p-5">

                        <!-- 📄 THÈ TRÊN: KHO HỌC LIỆU ONLINE -->
                        <div
                            class="w-full rounded-[24px] bg-white border border-slate-100 shadow-[0_10px_25px_rgba(0,0,0,0.01)] p-4 relative overflow-hidden">
                            <div class="grid grid-cols-12 gap-3 items-center">

                                <!-- Nội dung bên trái -->
                                <div class="col-span-8">
                                    <div class="flex items-center gap-3">
                                        <!-- ICON SÁCH TRÊN -->
                                        <div
                                            class="w-12 h-12 rounded-[16px] bg-orange-500 text-white flex items-center justify-center shadow-[0_6px_12px_rgba(245,158,11,0.3)] shrink-0">
                                            <i class="fa-solid fa-book-open text-xl text-white"></i>
                                        </div>
                                        <div>
                                            <p
                                                class="text-slate-400 text-[10px] font-bold uppercase tracking-widest leading-none">
                                                Kho học liệu</p>
                                            <h3
                                                class="text-slate-800 text-2xl font-black mt-0.5 tracking-tight leading-none">
                                                Online</h3>
                                            <div class="w-8 h-[3px] rounded-full bg-orange-500 mt-1"></div>
                                        </div>
                                    </div>

                                    <div class="my-3 h-px bg-slate-100"></div>

                                    <p class="text-xs leading-5 text-slate-500 font-medium">
                                        Học liệu được phân loại theo môn học, khoa và loại tài liệu, hỗ trợ tìm kiếm,
                                        chia sẻ và tải xuống nhanh chóng.
                                    </p>
                                </div>

                                <!-- Hình ảnh minh họa thu nhỏ gọn gàng -->
                                <div class="col-span-4 flex justify-center items-center relative">
                                    <div class="relative w-full h-24 flex items-center justify-center text-slate-300">
                                        <i
                                            class="fa-solid fa-layer-group text-5xl text-sky-400/80 absolute -bottom-1"></i>
                                        <i
                                            class="fa-solid fa-cloud-arrow-up text-3xl text-amber-500 absolute -top-2 right-2"></i>
                                        <i
                                            class="fa-solid fa-file-lines text-4xl text-slate-200 absolute right-0 rotate-12 shadow-sm"></i>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- 📊 KHỐI THỐNG KÊ 3 THẺ PHÍA DƯỚI (Đã tăng mt-5 để giãn cách với thẻ trên thoáng hơn) -->
                        <div class="grid grid-cols-3 gap-3 mt-5">

                            <!-- Thẻ 1: TÀI LIỆU (Màu Xanh Dương) -->
                            <div
                                class="bg-white rounded-[22px] border border-slate-100 shadow-[0_8px_20px_rgba(0,0,0,0.02)] p-3 flex flex-col items-center relative group hover:-translate-y-0.5 transition-all duration-300">
                                <button class="absolute top-2.5 right-2.5 text-slate-400">
                                    <i class="fa-solid fa-ellipsis-vertical text-[10px]"></i>
                                </button>

                                <!-- VÒNG TRÒN VÀ ICON -->
                                <div
                                    class="w-11 h-11 rounded-full bg-sky-500 flex items-center justify-center shadow-[0_6px_12px_rgba(14,165,233,0.3)] mt-1">
                                    <i class="fa-solid fa-file-lines text-base text-white"></i>
                                </div>

                                <h4 class="text-2xl font-black text-sky-900 mt-2 leading-none count-up"
                                    data-target="{{ $totalDocuments }}">0</h4>
                                <p class="text-xs font-extrabold text-slate-700 mt-1">Tài liệu</p>

                                <span
                                    class="mt-1.5 px-2 py-0.5 rounded-full bg-sky-50 text-[9px] font-bold text-sky-600 whitespace-nowrap">
                                    Tổng tài liệu
                                </span>

                                <div class="w-full flex items-center justify-between mt-3 px-0.5">
                                    <svg class="w-10 h-4 text-sky-500" viewBox="0 0 50 20" fill="none"
                                        stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M0 15 Q10 5, 20 12 T40 8 T50 5" />
                                    </svg>
                                    <span class="text-[10px] font-black text-sky-600 flex items-center">
                                        <i class="fa-solid fa-arrow-up text-[8px] mr-0.5"></i>18%
                                    </span>
                                </div>
                            </div>

                            <!-- Thẻ 2: MÔN HỌC (Màu Xanh Lá) -->
                            <div
                                class="bg-white rounded-[22px] border border-slate-100 shadow-[0_8px_20px_rgba(0,0,0,0.02)] p-3 flex flex-col items-center relative group hover:-translate-y-0.5 transition-all duration-300">
                                <button class="absolute top-2.5 right-2.5 text-slate-400">
                                    <i class="fa-solid fa-ellipsis-vertical text-[10px]"></i>
                                </button>

                                <!-- VÒNG TRÒN VÀ ICON -->
                                <div
                                    class="w-11 h-11 rounded-full bg-emerald-500 flex items-center justify-center shadow-[0_6px_12px_rgba(16,185,129,0.3)] mt-1">
                                    <i class="fa-solid fa-graduation-cap text-base text-white"></i>
                                </div>

                                <h4 class="text-2xl font-black text-emerald-900 mt-2 leading-none count-up"
                                    data-target="{{ $totalSubjects }}">0</h4>
                                <p class="text-xs font-extrabold text-slate-700 mt-1">Môn học</p>

                                <span
                                    class="mt-1.5 px-2 py-0.5 rounded-full bg-emerald-50 text-[9px] font-bold text-emerald-600 whitespace-nowrap">
                                    Tổng môn học
                                </span>

                                <div class="w-full flex items-center justify-between mt-3 px-0.5">
                                    <svg class="w-10 h-4 text-emerald-500" viewBox="0 0 50 20" fill="none"
                                        stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M0 12 Q12 18, 22 10 T38 12 T50 4" />
                                    </svg>
                                    <span class="text-[10px] font-black text-emerald-600 flex items-center">
                                        <i class="fa-solid fa-arrow-up text-[8px] mr-0.5"></i>12%
                                    </span>
                                </div>
                            </div>

                            <!-- Thẻ 3: KHOA (Màu Cam) -->
                            <div
                                class="bg-white rounded-[22px] border border-slate-100 shadow-[0_8px_20px_rgba(0,0,0,0.02)] p-3 flex flex-col items-center relative group hover:-translate-y-0.5 transition-all duration-300">
                                <button class="absolute top-2.5 right-2.5 text-slate-400">
                                    <i class="fa-solid fa-ellipsis-vertical text-[10px]"></i>
                                </button>

                                <!-- VÒNG TRÒN VÀ ICON -->
                                <div
                                    class="w-11 h-11 rounded-full bg-orange-500 flex items-center justify-center shadow-[0_6px_12px_rgba(249,115,22,0.3)] mt-1">
                                    <i class="fa-solid fa-building-columns text-base text-white"></i>
                                </div>

                                <h4 class="text-2xl font-black text-orange-600 mt-2 leading-none count-up"
                                    data-target="{{ $totalFaculties }}">0</h4>
                                <p class="text-xs font-extrabold text-slate-700 mt-1">Khoa</p>

                                <span
                                    class="mt-1.5 px-2 py-0.5 rounded-full bg-orange-50 text-[9px] font-bold text-orange-600 whitespace-nowrap">
                                    Tổng khoa
                                </span>

                                <div class="w-full flex items-center justify-between mt-3 px-0.5">
                                    <svg class="w-10 h-4 text-orange-400" viewBox="0 0 50 20" fill="none"
                                        stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M0 16 Q10 10, 25 15 T40 10 T50 12" />
                                    </svg>
                                    <span class="text-[10px] font-black text-orange-500 flex items-center">
                                        <i class="fa-solid fa-arrow-up text-[8px] mr-0.5"></i>5%
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- ĐOẠN SCRIPT XỬ LÝ SỐ NHẢY (Đặt đoạn này ở cuối trang) -->
            <script>
            document.addEventListener("DOMContentLoaded", () => {
                const counters = document.querySelectorAll('.count-up');

                counters.forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-target'), 10) || 0;

                    if (target === 0) {
                        counter.innerText = "0";
                        return;
                    }

                    let count = 0;
                    // Tốc độ nhảy số (giá trị càng lớn nhảy càng nhanh để tất cả các cột dừng lại cùng lúc)
                    const speed = target / 40;

                    const updateCount = () => {
                        count += speed;
                        if (count < target) {
                            counter.innerText = Math.floor(count);
                            requestAnimationFrame(updateCount);
                        } else {
                            // Khi hoàn thành, định dạng số theo chuẩn Việt Nam (ví dụ: 1.250 thay vì 1250)
                            counter.innerText = target.toLocaleString('vi-VN');
                        }
                    };
                    updateCount();
                });
            });
            </script>
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


<main class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-8">
    <!-- Phần khách vãng lai -->
    @guest
    <style>
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

    .guest-blob {
        animation: floatBlob 8s ease-in-out infinite;
    }

    .guest-card-float {
        animation: floatCard 5s ease-in-out infinite;
    }

    /*==============================
            =         Section nền          =
            ==============================*/

    .role-section {
        position: relative;
        overflow: hidden;
    }

    .role-section::before {
        content: "";
        position: absolute;
        top: -120px;
        left: -120px;
        width: 320px;
        height: 320px;
        border-radius: 9999px;
        background: #cffafe;
        filter: blur(90px);
        opacity: .55;
    }

    .role-section::after {
        content: "";
        position: absolute;
        right: -120px;
        bottom: -120px;
        width: 300px;
        height: 300px;
        border-radius: 9999px;
        background: #e0f2fe;
        filter: blur(90px);
        opacity: .45;
    }

    /*==============================
            =          Card Role           =
            ==============================*/

    .role-card {

        position: relative;

        overflow: hidden;

        background: #fff;

        border: 1px solid #d9f4fb;

        border-radius: 30px;

        box-shadow: 0 18px 45px rgba(8, 145, 178, .08);

        transition: .35s ease;

    }

    .role-card:hover {

        transform: translateY(-10px);

        box-shadow: 0 30px 65px rgba(8, 145, 178, .18);

    }

    /* Thanh màu trên */

    .role-card-top {

        height: 5px;

        background: linear-gradient(90deg, #06b6d4, #0891b2);

    }

    /*==============================
            =            Icon              =
            ==============================*/

    .role-icon {

        width: 68px;

        height: 68px;

        border-radius: 22px;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #ecfeff;

        color: #0891b2;

        font-size: 26px;

        box-shadow: 0 12px 28px rgba(8, 145, 178, .12);

        transition: .3s;

    }

    .role-card:hover .role-icon {

        background: #0891b2;

        color: #fff;

        transform: rotate(-8deg) scale(1.08);

    }

    /*==============================
            =         Feature item         =
            ==============================*/

    .role-feature {

        display: flex;

        align-items: center;

        gap: 12px;

        padding: 12px 16px;

        background: #f8fdff;

        border: 1px solid #ecfeff;

        border-radius: 14px;

        transition: .25s;

    }

    .role-feature:hover {

        background: #ecfeff;

        transform: translateX(6px);

    }

    .role-feature i {

        color: #0891b2;

        font-size: 14px;

    }

    /*==============================
            =        Button link           =
            ==============================*/

    .role-link {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        margin-top: 24px;

        font-size: 14px;

        font-weight: 800;

        color: #0891b2;

        transition: .25s;

    }

    .role-link:hover {

        gap: 14px;

        color: #0e7490;

    }

    /*==============================
            =       Scroll Reveal          =
            ==============================*/

    .reveal {

        opacity: 0;

        transform: translateY(60px);

        transition: 1s ease;

    }

    .reveal.active {

        opacity: 1;

        transform: none;

    }

    .reveal-item {

        opacity: 0;

        transform: translateY(40px) scale(.95);

        transition: .8s ease;

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

    .role-card {

        transition:
            transform .35s ease,
            box-shadow .35s ease;

    }

    .role-card:hover {

        transform:
            translateY(-10px) scale(1.03);

    }

    .role-icon {

        transition:
            .35s;

    }

    .role-card:hover .role-icon {

        transform:
            rotate(-8deg) scale(1.1);

    }

    /* ==================================================
        FLOATING ANIMATION
                ================================================== */

    @keyframes floating {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }

    }

    .float-animation {

        animation: floating 4s ease-in-out infinite;

    }

    /* ==================================================
        HERO IMAGE
                ================================================== */

    .hero-image {

        transition: .8s;

    }

    .hero-image:hover {

        transform: scale(1.04);

    }

    /* ==================================================
                STAT CARD
                ================================================== */

    .stat-card {

        transition: all .35s ease;

    }

    .stat-card:hover {

        transform: translateY(-8px);

        box-shadow:
            0 28px 55px rgba(15, 23, 42, .15);

    }

    .stat-card i {

        transition: .35s;

    }

    .stat-card:hover i {

        transform: rotate(-12deg) scale(1.15);

    }

    /* ==================================================
        QUICK CARD
                ================================================== */

    .quick-card {

        transition: .35s ease;

    }

    .quick-card:hover {

        transform:
            translateY(-8px);

    }

    .quick-card .quick-icon {

        transition: .35s;

    }

    .quick-card:hover .quick-icon {

        transform:
            rotate(-8deg) scale(1.1);

    }

    /* ==================================================
                BUTTON
                ================================================== */

    .hero-btn {

        transition: .3s;

    }

    .hero-btn:hover {

        transform:
            translateY(-3px);

    }

    /* ==================================================
        SCROLL REVEAL
        ================================================== */

    .reveal {

        opacity: 0;

        transform: translateY(70px);

        transition: 1s;

    }

    .reveal.active {

        opacity: 1;

        transform: translateY(0);

    }

    .reveal-item {

        opacity: 0;

        transform: translateY(50px);

        transition: .9s;

    }

    .reveal.active .reveal-item:nth-child(1) {

        opacity: 1;

        transform: none;

        transition-delay: .15s;

    }

    .reveal.active .reveal-item:nth-child(2) {

        opacity: 1;

        transform: none;

        transition-delay: .35s;

    }

    .reveal.active .reveal-item:nth-child(3) {

        opacity: 1;

        transform: none;

        transition-delay: .55s;

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

                rgba(255, 255, 255, .6),

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
    <section class="role-section reveal mt-14 mb-20">
        <div class="relative z-10">

            <!-- Badge -->
            <div class="text-center">

                <span class="inline-flex items-center gap-2
           px-5 py-2
           rounded-full
           bg-orange-50
           border border-orange-100
           text-orange-600
           text-xs
           font-black
           uppercase
           tracking-[0.18em]
           shadow-sm">

                    <i class="fa-solid fa-users"></i>

                    Vai trò người dùng

                </span>

            </div>
            <!-- Title -->
            <div class="mt-6 text-center">

                <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight">

                    Hệ thống hỗ trợ

                    <span class="text-cyan-600">

                        nhiều nhóm người dùng

                    </span>

                </h2>

                <p class="mt-5 max-w-3xl mx-auto
                      text-slate-500
                      text-lg
                      leading-8">

                    EDU DOC được xây dựng nhằm hỗ trợ sinh viên, giảng viên và
                    quản trị viên trong việc quản lý, chia sẻ và khai thác học liệu
                    một cách nhanh chóng, trực quan và hiệu quả.

                </p>

            </div>

            <!-- Cards -->
            <div class="mt-14 grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- ===========================
                STUDENT
                    =========================== -->
                <div class="role-card reveal-item">

                    <div class="role-card-top"></div>

                    <div class="p-8">

                        <div class="role-icon">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>

                        <h3 class="mt-6 text-2xl font-black text-slate-900">
                            Sinh viên
                        </h3>

                        <p class="mt-4 text-slate-500 leading-7">
                            Sinh viên có thể tra cứu học liệu theo khoa, môn học và tải tài
                            liệu phục vụ cho quá trình học tập một cách nhanh chóng.
                        </p>

                        <div class="mt-7 space-y-3">

                            <div class="role-feature">
                                <i class="fa-solid fa-check"></i>
                                <span class="font-semibold text-slate-700">
                                    Xem tài liệu môn học
                                </span>
                            </div>

                            <div class="role-feature">
                                <i class="fa-solid fa-check"></i>
                                <span class="font-semibold text-slate-700">
                                    Tìm kiếm theo từ khóa
                                </span>
                            </div>

                            <div class="role-feature">
                                <i class="fa-solid fa-check"></i>
                                <span class="font-semibold text-slate-700">
                                    Tải tài liệu học tập
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- ===========================
                     LECTURER
                        =========================== -->
                <div class="role-card reveal-item">

                    <div class="role-card-top"></div>

                    <div class="p-8">

                        <div class="role-icon">
                            <i class="fa-solid fa-chalkboard-user"></i>
                        </div>

                        <h3 class="mt-6 text-2xl font-black text-slate-900">
                            Giảng viên
                        </h3>

                        <p class="mt-4 text-slate-500 leading-7">
                            Giảng viên có thể đăng tải, cập nhật phiên bản và quản lý các tài
                            liệu của những môn học được phân công giảng dạy.
                        </p>

                        <div class="mt-7 space-y-3">

                            <div class="role-feature">
                                <i class="fa-solid fa-check"></i>
                                <span class="font-semibold text-slate-700">
                                    Đăng tải học liệu
                                </span>
                            </div>

                            <div class="role-feature">
                                <i class="fa-solid fa-check"></i>
                                <span class="font-semibold text-slate-700">
                                    Quản lý tài liệu của mình
                                </span>
                            </div>

                            <div class="role-feature">
                                <i class="fa-solid fa-check"></i>
                                <span class="font-semibold text-slate-700">
                                    Cập nhật phiên bản tài liệu
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- ===========================
                    ADMIN
                =========================== -->
                <div class="role-card reveal-item">

                    <div class="role-card-top"></div>

                    <div class="p-8">

                        <div class="role-icon">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>

                        <h3 class="mt-6 text-2xl font-black text-slate-900">
                            Quản trị viên
                        </h3>

                        <p class="mt-4 text-slate-500 leading-7">
                            Quản trị viên quản lý toàn bộ hệ thống, người dùng, khoa, môn học,
                            loại tài liệu và theo dõi các hoạt động trên website.
                        </p>

                        <div class="mt-7 space-y-3">

                            <div class="role-feature">
                                <i class="fa-solid fa-check"></i>
                                <span class="font-semibold text-slate-700">
                                    Quản lý người dùng
                                </span>
                            </div>

                            <div class="role-feature">
                                <i class="fa-solid fa-check"></i>
                                <span class="font-semibold text-slate-700">
                                    Quản lý học liệu
                                </span>
                            </div>

                            <div class="role-feature">
                                <i class="fa-solid fa-check"></i>
                                <span class="font-semibold text-slate-700">
                                    Thống kê & Nhật ký hệ thống
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>
    <!-- GUEST SECTION -->

    <section class="guest-section mb-16">

        <div class="relative overflow-hidden rounded-[40px]
        bg-gradient-to-br from-white via-cyan-50 to-sky-100
        border border-cyan-100
        shadow-[0_25px_70px_rgba(8,145,178,.12)]">

            <!-- Background Blur -->
            <div class="absolute -top-32 -left-32 w-[450px] h-[450px] rounded-full bg-cyan-300/20 blur-3xl"></div>
            <div class="absolute -bottom-32 -right-32 w-[450px] h-[450px] rounded-full bg-sky-300/20 blur-3xl"></div>

            <!-- Dot Pattern -->
            <div class="absolute inset-0 opacity-[0.05]">
                <div class="absolute inset-0" style="
                    background-image: radial-gradient(circle,#0891b2 1px,transparent 1px);
                    background-size:26px 26px;">
                </div>
            </div>

            <div class="relative max-w-5xl mx-auto text-center py-20 px-8">

                <!-- Badge -->
                <span class="inline-flex items-center gap-2
                px-5 py-2.5
                rounded-full
                bg-orange-50
                border border-orange-200
                text-orange-600
                text-xs
                font-black
                uppercase
                tracking-[0.28em]
                shadow-sm">

                    <i class="fa-solid fa-graduation-cap"></i>

                    EDU DOC

                </span>
                <!-- Title -->
                <h1 class="mt-8
                text-5xl
                md:text-7xl
                leading-[1.05]
                font-black
                tracking-[-0.05em]
                text-slate-900">

                    Quản lý

                    <span class="text-cyan-600">

                        học liệu

                    </span>

                    <br>

                    thông minh

                </h1>

                <!-- Description -->
                <p class="mt-8
                max-w-3xl
                mx-auto
                text-lg
                leading-9
                text-slate-500
                font-medium">

                    EDU DOC giúp sinh viên và giảng viên quản lý,
                    chia sẻ và tìm kiếm tài liệu môn học theo khoa,
                    môn học và loại tài liệu trên một nền tảng
                    tập trung, hiện đại và dễ sử dụng.

                </p>

                <!-- Button -->
                <div class="mt-10 flex justify-center flex-wrap gap-5">

                    <a href="{{ route('login') }}" class="inline-flex items-center gap-3
                    px-8 py-4
                    rounded-2xl
                    bg-cyan-500
                    text-white
                    font-black
                    shadow-xl shadow-cyan-200
                    hover:bg-cyan-600
                    hover:-translate-y-1
                    transition-all">

                        Đăng nhập

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                    <a href="{{ route('register') }}" class="inline-flex items-center gap-3
                    px-8 py-4
                    rounded-2xl
                    bg-white
                    border border-cyan-100
                    text-cyan-700
                    font-black
                    transition-all duration-300
                    hover:bg-orange-50
                    hover:border-orange-300
                    hover:text-orange-600
                    hover:-translate-y-1
                    hover:shadow-lg hover:shadow-orange-100">

                        Tạo tài khoản

                    </a>
                </div>

                <!-- Statistics -->
                <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div
                        class="bg-white/90 backdrop-blur rounded-3xl p-7 border border-cyan-100 shadow-lg hover:-translate-y-2 transition">

                        <div
                            class="w-16 h-16 mx-auto rounded-2xl bg-cyan-100 text-cyan-600 flex items-center justify-center">

                            <i class="fa-solid fa-file-lines text-2xl"></i>

                        </div>

                        <h3 class="mt-6 text-5xl font-black text-cyan-600">
                            {{ number_format($totalDocuments) }}
                        </h3>

                        <p class="mt-2 font-bold text-slate-500">
                            Tài liệu
                        </p>

                    </div>

                    <div
                        class="bg-white/90 backdrop-blur rounded-3xl p-7 border border-emerald-100 shadow-lg hover:-translate-y-2 transition">

                        <div
                            class="w-16 h-16 mx-auto rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center">

                            <i class="fa-solid fa-book-open text-2xl"></i>

                        </div>

                        <h3 class="mt-6 text-5xl font-black text-emerald-600">
                            {{ number_format($totalSubjects) }}
                        </h3>

                        <p class="mt-2 font-bold text-slate-500">
                            Môn học
                        </p>

                    </div>

                    <div
                        class="bg-white/90 backdrop-blur rounded-3xl p-7 border border-violet-100 shadow-lg hover:-translate-y-2 transition">

                        <div
                            class="w-16 h-16 mx-auto rounded-2xl bg-violet-100 text-violet-600 flex items-center justify-center">

                            <i class="fa-solid fa-building-columns text-2xl"></i>

                        </div>

                        <h3 class="mt-6 text-5xl font-black text-violet-600">
                            {{ number_format($totalFaculties) }}
                        </h3>

                        <p class="mt-2 font-bold text-slate-500">
                            Khoa
                        </p>

                    </div>
                </div>

            </div>

        </div>

    </section>
    <!-- ==========================================
        QUICK ACTIONS
    =========================================== -->
    <section class="mt-20">

        <!-- Heading -->
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-2
                    px-5 py-2
                    rounded-full
                    bg-orange-50
                    border border-orange-100
                    text-orange-600
                    text-xs
                    font-black
                    uppercase
                    tracking-[0.2em]
                    shadow-sm">

                <i class="fa-solid fa-compass"></i>

                Khám phá hệ thống

            </span>

            <h2 class="mt-5 text-4xl font-black text-slate-900">

                Truy cập nhanh

            </h2>

            <p class="mt-3 text-slate-500 text-lg max-w-2xl mx-auto leading-8">

                Khám phá danh sách khoa, môn học và kho tài liệu
                chỉ với một lần nhấp chuột.

            </p>

        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">

            <!-- ========================= -->
            <!-- FACULTY -->
            <!-- ========================= -->

            <a href="{{ route('faculties.index') }}" class="group relative overflow-hidden
            rounded-[32px]
            bg-white
            border border-cyan-100
            p-8
            shadow-[0_15px_40px_rgba(8,145,178,.08)]
            hover:-translate-y-2
            hover:shadow-[0_25px_60px_rgba(8,145,178,.16)]
            transition-all duration-300">

                <!-- Background -->
                <div class="absolute
                -top-10
                -right-10
                w-40
                h-40
                rounded-full
                bg-cyan-100
                opacity-0
                group-hover:opacity-100
                transition">
                </div>

                <div class="relative">

                    <div class="w-16 h-16
                    rounded-3xl
                    bg-cyan-50
                    text-cyan-600
                    flex items-center justify-center
                    text-2xl
                    group-hover:bg-cyan-500
                    group-hover:text-white
                    transition">

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

                    <div class="mt-8
                    flex items-center
                    justify-between">

                        <span class="font-black
                        text-cyan-600">

                            Khám phá

                        </span>

                        <div class="w-11 h-11
                        rounded-full
                        bg-cyan-50
                        flex items-center justify-center
                        group-hover:bg-cyan-500
                        group-hover:text-white
                        transition">

                            <i class="fa-solid fa-arrow-right"></i>

                        </div>

                    </div>

                </div>

            </a>

            <!-- ========================= -->
            <!-- SUBJECT -->
            <!-- ========================= -->

            <a href="{{ route('subjects.index') }}" class="group relative overflow-hidden
            rounded-[32px]
            bg-white
            border border-sky-100
            p-8
            shadow-[0_15px_40px_rgba(14,165,233,.08)]
            hover:-translate-y-2
            hover:shadow-[0_25px_60px_rgba(14,165,233,.16)]
            transition-all duration-300">

                <div class="absolute
                -top-10
                -right-10
                w-40
                h-40
                rounded-full
                bg-sky-100
                opacity-0
                group-hover:opacity-100
                transition">
                </div>

                <div class="relative">

                    <div class="w-16 h-16
                    rounded-3xl
                    bg-sky-50
                    text-sky-600
                    flex items-center justify-center
                    text-2xl
                    group-hover:bg-sky-500
                    group-hover:text-white
                    transition">

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

                        Duyệt toàn bộ môn học và
                        học liệu tương ứng.

                    </p>

                    <div class="mt-8
                    flex items-center justify-between">

                        <span class="font-black
                        text-sky-600">

                            Khám phá

                        </span>

                        <div class="w-11 h-11
                        rounded-full
                        bg-sky-50
                        flex items-center justify-center
                        group-hover:bg-sky-500
                        group-hover:text-white
                        transition">

                            <i class="fa-solid fa-arrow-right"></i>

                        </div>

                    </div>

                </div>

            </a>

            <!-- ========================= -->
            <!-- DOCUMENT -->
            <!-- ========================= -->

            <a href="{{ route('documents.index') }}" class="group relative overflow-hidden
            rounded-[32px]
            bg-white
            border border-emerald-100
            p-8
            shadow-[0_15px_40px_rgba(16,185,129,.08)]
            hover:-translate-y-2
            hover:shadow-[0_25px_60px_rgba(16,185,129,.16)]
            transition-all duration-300">

                <div class="absolute
                -top-10
                -right-10
                w-40
                h-40
                rounded-full
                bg-emerald-100
                opacity-0
                group-hover:opacity-100
                transition">
                </div>

                <div class="relative">

                    <div class="w-16 h-16
                    rounded-3xl
                    bg-emerald-50
                    text-emerald-600
                    flex items-center justify-center
                    text-2xl
                    group-hover:bg-emerald-500
                    group-hover:text-white
                    transition">

                        <i class="fa-solid fa-file-lines"></i>

                    </div>

                    <h3 class="mt-7
                    text-2xl
                    font-black
                    text-slate-900">

                        Tài liệu

                    </h3>

                    <p class="mt-3
                    text-slate-500
                    leading-7">

                        Giáo trình, slide,
                        đề thi và nhiều học liệu
                        hữu ích khác.

                    </p>

                    <div class="mt-8
                    flex items-center justify-between">

                        <span class="font-black
                        text-emerald-600">

                            Xem ngay

                        </span>

                        <div class="w-11 h-11
                        rounded-full
                        bg-emerald-50
                        flex items-center justify-center
                        group-hover:bg-emerald-500
                        group-hover:text-white
                        transition">

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
    <div class="mb-12 py-15 my-10" style="font-family: 'Roboto', sans-serif;">

        <div class="flex items-center mb-6">

            <div class="w-12 h-12 rounded-2xl
                bg-cyan-500 text-white
                flex items-center justify-center
                shadow-lg shadow-cyan-200 mr-4">

                <i class="fa-solid fa-book text-lg"></i>
            </div>
            <div>
                <!-- Điều chỉnh size từ text-3xl xuống text-2xl để Roboto không bị quá to thô -->
                <h4 class="text-2xl font-black text-cyan-950 tracking-tight">
                    Danh mục Môn học
                </h4>
                <!-- Điều chỉnh size text-sm font-semibold thành text-xs font-medium để chữ Roboto phụ nhìn mềm mại hơn -->
                <p class="text-slate-500 text-xs font-medium mt-1">Tất cả môn học được hiển thị
                </p>
            </div>
            <!-- Đồng bộ text-sm sang text-xs và font-bold để nút Xem tất cả thanh thoát -->
            <a href="{{ route('subjects.index') }}" class="ml-auto text-xs font-bold home-link-primary flex items-center gap-1 transition-colors  gap-2
                    text-cyan-600 hover:text-cyan-700
                    transition-all">
                Xem tất cả
                <i class="fa-solid fa-angle-right"></i>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @foreach($subjects as $subject)
            <a href="{{ route('subjects.show', $subject->subject_code) }}"
                class="group overflow-hidden rounded-3xl bg-white border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_20px_40px_rgba(8,145,178,0.1)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">

                <div>
                    <!-- IMAGE SECTION -->
                    <div class="relative overflow-hidden h-48 w-full bg-slate-100">

                        <img src="{{ $subject->thumbnail ? asset('img/subjects/'.$subject->thumbnail) : asset('images/default-subject.jpg') }}"
                            class="w-full h-full object-cover transition duration-700 ease-out group-hover:scale-105"
                            alt="{{ $subject->subject_name }}">

                        <!-- Overlay mượt mà hơn để text hoặc tag nổi bật -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent"></div>

                        <!-- Tag Faculty (Tên Khoa) - Làm mới sang trọng hơn -->
                        @if($subject->faculty)
                        <div class="absolute top-4 left-4 z-10">
                            <!-- Hạ size tag khoa xuống text-[10px] để hiển thị gọn trên ảnh kèm font Roboto -->
                            <span
                                class="px-3 py-1.5 rounded-xl bg-white/80 backdrop-blur-md border border-white/40 text-[10px] font-bold uppercase tracking-wider text-slate-800 shadow-sm">
                                <i class="fa-solid fa-graduation-cap mr-1 text-cyan-600"></i>
                                {{ $subject->faculty->faculty_name }}
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- CONTENT SECTION -->
                    <div class="p-5 pb-0">
                        <!-- Hạ size mã môn học xuống text-[10px] font-black để có điểm nhấn tương phản rộng -->
                        <span class="text-[10px] font-black text-cyan-600/80 uppercase tracking-widest block mb-1">
                            {{ $subject->subject_code }}
                        </span>

                        <!-- Tiêu đề môn học hạ nhẹ từ text-lg sang text-base giúp hiển thị trọn vẹn 2 dòng không bị thô cứng -->
                        <h3
                            class="font-black text-base text-slate-800 leading-snug group-hover:text-cyan-600 transition-colors duration-300 line-clamp-2 min-h-[44px]">
                            {{ $subject->subject_name }}
                        </h3>
                    </div>
                </div>
                <!-- FOOTER SECTION (Luôn nằm sát đáy card nhờ flex-col) -->
                <div class="p-5 pt-0">
                    <!-- Divider thanh mảnh -->
                    <div class="my-4 border-t border-slate-100"></div>

                    <div class="flex items-center justify-between">
                        <!-- Thống kê số tài liệu -->
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center font-bold">
                                <i class="fa-solid fa-folder-open text-base"></i>
                            </div>
                            <div>
                                <!-- Giữ nguyên text-lg font-black cho con số nổi bật, hạ text phụ xuống text-[11px] font-semibold -->
                                <h4 class="text-lg font-black text-slate-800 leading-none mb-0.5">
                                    {{ number_format($subject->documents_count) }}
                                </h4>
                                <p class="text-[11px] text-slate-400 font-semibold">Tài liệu sẵn có</p>
                            </div>
                        </div>

                        <!-- Nút mũi tên chuyển động mượt mà khi hover card -->
                        <div
                            class="w-10 h-10 rounded-xl bg-slate-50 text-slate-400 flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white group-hover:translate-x-1 shadow-sm group-hover:shadow-lg group-hover:shadow-cyan-200 transition-all duration-300">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </div>
                    </div>
                </div>

            </a>
            @endforeach

        </div>
    </div>
    <!-- Phần Tài liệu sẽ chia quyền sinh viên -->
    @if(auth()->user()->role_id !=2)
    <!-- ========================= -->
    <!-- TÀI LIỆU -->
    <!-- ========================= -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-14">

        <!-- LEFT -->
        <div class="lg:col-span-2" style="font-family: 'Roboto', sans-serif;">
            <!-- TITLE -->
            <div class="flex items-center mb-6">

                <div
                    class="w-12 h-12 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200 mr-4">
                    <i class="fa-solid fa-clock text-lg"></i>
                </div>

                <div>
                    <!-- Điều chỉnh từ text-3xl xuống text-2xl giúp tiêu đề Roboto gọn gàng hơn -->
                    <h4 class="text-2xl font-black text-cyan-950 tracking-tight">
                        Tài liệu mới nhất
                    </h4>

                    <!-- Điều chỉnh text-sm xuống text-xs font-medium để dòng mô tả phụ mềm mại, dễ nhìn -->
                    <p class="text-slate-500 text-xs font-medium mt-1">
                        Học liệu vừa được cập nhật gần đây
                    </p>
                </div>
            </div>

            <!-- CARD -->
            <div
                class="bg-white rounded-[32px] border border-cyan-100 overflow-hidden shadow-[0_15px_45px_rgba(8,145,178,0.08)]">

                <!-- CONTENT -->
                @foreach($latestDocuments as $document)

                @php
                $ext = strtolower($document->currentVersion->file_extension ?? '');
                @endphp

                <!-- Khung bọc trung gian để định vị absolute và giữ hover effect -->
                <div class="group relative border-b border-cyan-100 hover:bg-cyan-50/60 transition-all duration-300">

                    <!-- LINK CHI TIẾT TÀI LIỆU -->
                    <a href="{{ route('documents.show', $document->document_id) }}"
                        class="p-6 flex items-center gap-5 pr-44 block">
                        <!-- pr-44 giúp thông tin không đè lên nút -->

                        <!-- ICON FILE -->
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center shrink-0
                    @if(in_array($ext,['pdf'])) bg-red-50 text-red-500
                    @elseif(in_array($ext,['doc','docx'])) bg-blue-50 text-blue-600
                    @elseif(in_array($ext,['xls','xlsx'])) bg-green-50 text-green-600
                    @elseif(in_array($ext,['ppt','pptx'])) bg-orange-50 text-orange-600
                    @elseif(in_array($ext,['zip','rar'])) bg-yellow-50 text-yellow-600
                    @elseif(in_array($ext,['jpg','jpeg','png','gif','webp'])) bg-pink-50 text-pink-600
                    @elseif(in_array($ext,['mp4','avi','mov'])) bg-purple-50 text-purple-600
                    @else bg-slate-100 text-slate-500
                    @endif">

                            @if(in_array($ext,['pdf'])) <i class="fa-solid fa-file-pdf text-2xl"></i>
                            @elseif(in_array($ext,['doc','docx'])) <i class="fa-solid fa-file-word text-2xl"></i>
                            @elseif(in_array($ext,['xls','xlsx'])) <i class="fa-solid fa-file-excel text-2xl"></i>
                            @elseif(in_array($ext,['ppt','pptx'])) <i class="fa-solid fa-file-powerpoint text-2xl"></i>
                            @elseif(in_array($ext,['zip','rar'])) <i class="fa-solid fa-file-zipper text-2xl"></i>
                            @elseif(in_array($ext,['jpg','jpeg','png','gif','webp'])) <i
                                class="fa-solid fa-file-image text-2xl"></i>
                            @elseif(in_array($ext,['mp4','avi','mov'])) <i class="fa-solid fa-file-video text-2xl"></i>
                            @else <i class="fa-solid fa-file text-2xl"></i>
                            @endif
                        </div>

                        <!-- THÔNG TIN -->
                        <div class="flex-1 min-w-0">
                            <!-- Tiêu đề tài liệu hạ nhẹ xuống text-base để hiển thị thanh thoát khi dùng font Roboto -->
                            <h3
                                class="text-base font-black leading-relaxed text-slate-800 group-hover:text-cyan-600 transition-colors line-clamp-2">
                                {{ $document->title }}
                            </h3>

                            <!-- Điều chỉnh thanh thông tin phụ từ text-sm xuống text-xs font-semibold giúp tăng độ tương phản layout -->
                            <div class="flex flex-wrap gap-3 mt-2.5 text-xs text-slate-500 font-semibold">
                                <span>
                                    <i class="fa-solid fa-book mr-1 text-cyan-600"></i>
                                    {{ $document->subject?->subject_name ?? 'Chưa có môn học' }}
                                </span>
                                <span>•</span>
                                <span>
                                    <i class="fa-solid fa-download mr-1 text-cyan-600"></i>
                                    {{ number_format($document->download_count) }} lượt tải
                                </span>
                                <span>•</span>
                                <span>
                                    <i class="fa-solid fa-calendar mr-1 text-cyan-600"></i>
                                    {{ $document->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    </a>

                    <!-- NÚT TẢI VỀ (Căn giữa dọc tuyệt đối ở bên phải) -->
                    <div class="absolute top-8 right-6 z-10">
                        <!-- Đồng bộ nút bấm sang text-xs và font-bold giúp text nút Roboto sắc nét vừa vặn -->
                        <a href="{{ route('documents.download', $document) }}"
                            class="shrink-0 px-5 py-2.5 rounded-xl bg-cyan-500 text-white text-xs font-bold hover:bg-cyan-600 shadow-lg shadow-cyan-200 transition-all duration-300 flex items-center gap-2 hover:-translate-y-0.5">
                            <i class="fa-solid fa-cloud-arrow-down"></i>
                            <span>Tải về</span>
                        </a>
                    </div>

                </div>
                @endforeach

            </div>
        </div>

        <!-- RIGHT -->
        <div style="font-family: 'Roboto', sans-serif;">

            <!-- TITLE -->
            <div class="flex items-center mb-6">

                <div class="w-12 h-12 rounded-2xl
                bg-cyan-500 text-white
                flex items-center justify-center
                shadow-lg shadow-cyan-200 mr-4">
                    <i class="fa-solid fa-fire text-lg"></i>
                </div>

                <div>
                    <!-- Điều chỉnh từ text-3xl xuống text-2xl để font Roboto không bị thô cứng -->
                    <h4 class="text-2xl font-black text-cyan-950 tracking-tight">
                        Tài liệu tải nhiều
                    </h4>

                    <!-- Tinh chỉnh text-sm thành text-xs font-medium giúp dòng mô tả phụ nhỏ gọn, thanh lịch hơn -->
                    <p class="text-slate-500 text-xs font-medium mt-1">
                        Những tài liệu được quan tâm nhiều nhất
                    </p>
                </div>
            </div>

            <div class="rounded-[32px] bg-white border border-cyan-100 p-5 shadow-[0_20px_60px_rgba(8,145,178,0.12)]">

                <div class="space-y-4">

                    @foreach($topDocuments as $index => $document)

                    <a href="{{ route('documents.show', $document->document_id) }}"
                        class="group flex items-center gap-4 p-4 rounded-2xl border border-slate-200 bg-white hover:border-cyan-300 hover:shadow-lg transition-all duration-300">

                        <!-- TOP -->
                        <!-- Đồng bộ font chữ hiển thị số thứ hạng thứ tự (#1, #2, #3) -->
                        <div class="shrink-0 text-sm tracking-tighter">

                            @if($index == 0)
                            <div
                                class="w-11 h-11 rounded-full bg-amber-500 text-white flex items-center justify-center font-black shadow">
                                #1
                            </div>

                            @elseif($index == 1)
                            <div
                                class="w-11 h-11 rounded-full bg-slate-400 text-white flex items-center justify-center font-black shadow">
                                #2
                            </div>

                            @else
                            <div
                                class="w-11 h-11 rounded-full bg-orange-600 text-white flex items-center justify-center font-black shadow">
                                #3
                            </div>
                            @endif

                        </div>

                        <!-- CONTENT -->
                        <div class="flex-1 min-w-0">

                            <!-- TITLE -->
                            <!-- Điều chỉnh nhẹ text-[15px] xuống text-sm để tối ưu không gian hiển thị text truncate trên một hàng -->
                            <h3 class="truncate text-sm font-bold text-slate-800 group-hover:text-cyan-600"
                                title="{{ $document->title }}">
                                {{ $document->title }}
                            </h3>

                            <!-- SUBJECT -->
                            <div class="mt-2">
                                <!-- Hạ cỡ chữ tag môn học xuống text-[11px] font-bold để text Roboto hiển thị gọn gàng trong kén (pill) -->
                                <span
                                    class="inline-flex items-center rounded-full bg-cyan-50 px-3 py-1 text-[11px] font-bold text-cyan-700">
                                    <i class="fa-solid fa-book mr-1"></i>
                                    {{ $document->subject?->subject_name }}
                                </span>
                            </div>

                            <!-- INFO -->
                            <!-- Hạ nhẹ văn bản phụ cuối từ text-xs xuống text-[11px] font-semibold để phân cấp thông tin rõ ràng hơn -->
                            <div class="mt-3 flex items-center justify-between text-[11px]">

                                <span class="font-bold text-cyan-600">
                                    <i class="fa-solid fa-download mr-1"></i>
                                    {{ number_format($document->download_count) }} lượt tải
                                </span>

                                <span class="text-slate-400 font-medium">
                                    <i class="fa-regular fa-calendar mr-1"></i>
                                    {{ $document->created_at->format('d/m/Y') }}
                                </span>

                            </div>

                        </div>

                        <!-- ARROW -->
                        <div
                            class="shrink-0 w-10 h-10 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white transition">
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
    <!-- Bọc toàn bộ grid bằng font-roboto (Đảm bảo font Roboto đã được nhúng trong project của bạn) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-14" style="font-family: 'Roboto', sans-serif;">

        <!-- LEFT -->
        <div class="lg:col-span-2">

            <!-- TITLE -->
            <div class="flex items-center mb-6">
                <div
                    class="w-12 h-12 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200 mr-4">
                    <i class="fa-solid fa-clock text-lg"></i>
                </div>

                <div>
                    <!-- Giảm từ text-3xl xuống text-2xl để tiêu đề Roboto gọn và sang hơn -->
                    <h4 class="text-2xl font-black text-cyan-950 tracking-tight">
                        Tài liệu bạn đã đăng
                    </h4>
                    <!-- Giảm xuống text-xs font-medium giúp dòng mô tả phụ mềm mại, không lấn lướt tiêu đề -->
                    <p class="text-slate-500 text-xs font-medium mt-1">
                        Quản lý học liệu giảng viên đã tải lên
                    </p>
                </div>
            </div>

            <!-- CARD -->
            <div
                class="bg-white rounded-[32px] border border-cyan-100 overflow-hidden shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
                @forelse($myDocuments as $document)

                @php
                $ext = strtolower($document->currentVersion->file_extension ?? '');
                @endphp

                <div class="group relative border-b border-cyan-100 hover:bg-cyan-50/60 transition-all duration-300">

                    <!-- LINK CLICK TOÀN BỘ HÀNG -->
                    <a href="{{ route('documents.show', $document->document_id) }}"
                        class="p-6 flex items-center gap-5 pr-36 block">

                        <!-- ICON -->
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center shrink-0
                        @if(in_array($ext,['pdf'])) bg-red-50 text-red-500
                        @elseif(in_array($ext,['doc','docx'])) bg-blue-50 text-blue-600
                        @elseif(in_array($ext,['xls','xlsx'])) bg-green-50 text-green-600
                        @elseif(in_array($ext,['ppt','pptx'])) bg-orange-50 text-orange-600
                        @elseif(in_array($ext,['zip','rar'])) bg-yellow-50 text-yellow-600
                        @elseif(in_array($ext,['jpg','jpeg','png','gif','webp'])) bg-pink-50 text-pink-600
                        @elseif(in_array($ext,['mp4','avi','mov'])) bg-purple-50 text-purple-600
                        @else bg-slate-100 text-slate-500
                        @endif">

                            @if(in_array($ext,['pdf'])) <i class="fa-solid fa-file-pdf text-2xl"></i>
                            @elseif(in_array($ext,['doc','docx'])) <i class="fa-solid fa-file-word text-2xl"></i>
                            @elseif(in_array($ext,['xls','xlsx'])) <i class="fa-solid fa-file-excel text-2xl"></i>
                            @elseif(in_array($ext,['ppt','pptx'])) <i class="fa-solid fa-file-powerpoint text-2xl"></i>
                            @elseif(in_array($ext,['zip','rar'])) <i class="fa-solid fa-file-zipper text-2xl"></i>
                            @elseif(in_array($ext,['jpg','jpeg','png','gif','webp'])) <i
                                class="fa-solid fa-file-image text-2xl"></i>
                            @elseif(in_array($ext,['mp4','avi','mov'])) <i class="fa-solid fa-file-video text-2xl"></i>
                            @else <i class="fa-solid fa-file text-2xl"></i>
                            @endif
                        </div>

                        <!-- THÔNG TIN -->
                        <div class="flex-1 min-w-0">
                            <!-- Chuyển sang text-base font-bold để tiêu đề tài liệu thanh thoát và không bị thô đứng -->
                            <h3
                                class="font-bold text-base text-slate-800 truncate group-hover:text-cyan-600 transition-colors">
                                {{ $document->title }}
                            </h3>

                            <!-- Đưa về text-xs font-semibold giúp các thông số phụ hiển thị sắc nét -->
                            <div class="flex items-center flex-wrap gap-3 mt-2.5 text-xs text-slate-500 font-semibold">
                                <span>
                                    <i class="fa-solid fa-book mr-1 text-cyan-600"></i>
                                    {{ $document->subject->subject_name }}
                                </span>
                                <span>•</span>
                                <span>
                                    <i class="fa-solid fa-download mr-1 text-cyan-600"></i>
                                    {{ number_format($document->download_count) }} lượt tải
                                </span>
                                <span>•</span>
                                <span>
                                    <i class="fa-solid fa-calendar mr-1 text-cyan-600"></i>
                                    {{ $document->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    </a>

                    <!-- NÚT TẢI VỀ -->
                    <div class="absolute top-8 right-6 z-10">
                        <!-- Đồng bộ về text-xs font-bold để nội dung nút vừa vặn, chuẩn UI hơn -->
                        <a href="{{ route('documents.download', $document) }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-600 text-white font-bold shadow-lg shadow-cyan-200 transition-all duration-300 hover:-translate-y-0.5 text-xs">
                            <i class="fa-solid fa-download"></i>
                            <span>Tải về</span>
                        </a>
                    </div>

                </div>

                @empty
                <div class="py-16 text-center">
                    <div class="w-20 h-20 mx-auto rounded-full bg-slate-100 flex items-center justify-center">
                        <i class="fa-solid fa-file-circle-xmark text-3xl text-slate-400"></i>
                    </div>
                    <!-- Đưa về text-sm font-medium tạo cảm giác nhẹ nhàng khi trống dữ liệu -->
                    <p class="mt-4 text-slate-500 text-sm font-medium">
                        Bạn chưa đăng tài liệu nào.
                    </p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- RIGHT -->
        <div class="lg:col-span-1">

            <!-- TITLE -->
            <div class="flex items-center mb-6">
                <div
                    class="w-12 h-12 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200 mr-4">
                    <i class="fa-solid fa-chart-line text-lg"></i>
                </div>

                <div>
                    <!-- Đồng bộ tiêu đề cột phải về text-2xl -->
                    <h4 class="text-2xl font-black text-cyan-950 tracking-tight">
                        Thống kê tương tác
                    </h4>
                    <!-- Đồng bộ dòng mô tả phụ về text-xs font-medium -->
                    <p class="text-slate-500 text-xs font-medium mt-1">
                        Theo dõi hiệu quả tài liệu của bạn
                    </p>
                </div>
            </div>

            <!-- CARD -->
            <div class="bg-white rounded-[32px] border border-cyan-100 p-6 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">

                <!-- TOP GRID -->
                <div class="grid grid-cols-2 gap-5">

                    <!-- Tổng tài liệu -->
                    <div class="rounded-2xl border border-cyan-100 bg-cyan-50 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <!-- Chuyển sang text-[11px] font-bold giúp các thẻ uppercase trông hiện đại, gọn gàng -->
                                <p class="text-[11px] uppercase tracking-wider font-bold text-slate-400">
                                    Tài liệu
                                </p>
                                <!-- Hạ chỉ số từ text-3xl xuống text-2xl tăng độ tinh tế -->
                                <h3 class="mt-2 text-2xl font-black text-cyan-600">
                                    {{ $totalDocuments }}
                                </h3>
                            </div>
                            <div
                                class="w-12 h-12 rounded-xl bg-cyan-500 text-white flex items-center justify-center shadow shrink-0">
                                <i class="fa-solid fa-file-lines text-base"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Tổng lượt tải -->
                    <div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[11px] uppercase tracking-wider font-bold text-slate-400">
                                    Lượt tải
                                </p>
                                <h3 class="mt-2 text-2xl font-black text-emerald-600">
                                    {{ number_format($totalDownloads) }}
                                </h3>
                            </div>
                            <div
                                class="w-12 h-12 rounded-xl bg-emerald-500 text-white flex items-center justify-center shadow shrink-0">
                                <i class="fa-solid fa-download text-base"></i>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Môn học -->
                <div class="mt-5 rounded-2xl border border-blue-100 bg-blue-50 p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[11px] uppercase tracking-wider font-bold text-slate-400">
                                Môn học
                            </p>
                            <h3 class="mt-2 text-2xl font-black text-blue-600">
                                {{ $totalSubjects }}
                            </h3>
                        </div>
                        <div
                            class="w-12 h-12 rounded-xl bg-blue-500 text-white flex items-center justify-center shadow shrink-0">
                            <i class="fa-solid fa-book text-base"></i>
                        </div>
                    </div>
                </div>

                <!-- Tài liệu nổi bật -->
                @if($topDocuments->count())
                <div class="mt-5 rounded-2xl border border-orange-100 bg-orange-50 p-5">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 min-w-0">
                            <p class="text-[11px] uppercase tracking-wider font-bold text-orange-600">
                                Tài liệu nổi bật
                            </p>
                            <!-- Giảm nhẹ tiêu đề tài liệu nổi bật về text-sm font-bold giúp chuỗi text không đè icon bên phải -->
                            <h4 class="mt-2 text-sm font-bold text-slate-800 truncate"
                                title="{{ $topDocuments->first()->title }}">
                                {{ $topDocuments->first()->title }}
                            </h4>
                            <!-- Giảm thông số xuống text-xs font-semibold -->
                            <p class="mt-1 text-xs font-semibold text-slate-500">
                                {{ number_format($topDocuments->first()->download_count) }} lượt tải
                            </p>
                        </div>
                        <div
                            class="ml-4 w-12 h-12 rounded-xl bg-orange-500 text-white flex items-center justify-center shadow-lg shrink-0">
                            <i class="fa-solid fa-fire text-lg"></i>
                        </div>
                    </div>
                </div>
                @endif

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