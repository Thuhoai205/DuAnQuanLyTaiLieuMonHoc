@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

<!-- HERO -->
<!-- ================= HERO ================= -->
<header class="relative overflow-hidden bg-gradient-to-br from-cyan-700 via-cyan-600 to-sky-600 text-white">

    <!-- Background -->
    <div class="absolute inset-0 opacity-15">
        <img src="https://i.pinimg.com/1200x/24/ed/83/24ed836955512e6d98b14fa2b4bbe879.jpg"
            class="w-full h-full object-cover">
    </div>

    <div class="absolute inset-0 bg-gradient-to-r from-cyan-900/40 to-cyan-600/30"></div>

    <!-- Blur -->
    <div class="absolute -top-32 -left-24 w-80 h-80 rounded-full bg-cyan-300/20 blur-3xl"></div>

    <div class="absolute bottom-0 right-0 w-[420px] h-[420px] rounded-full bg-white/10 blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-6 py-20">

        <div class="grid lg:grid-cols-5 gap-12 items-center">
            <!-- ================= LEFT ================= -->
            <div class="lg:col-span-3">
                <!-- Badge -->
                <span
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white/15 border border-white/20 text-sm font-bold">

                    <i class="fa-solid fa-bolt"></i>

                    Hệ thống quản lý học liệu

                </span>

                <!-- Title -->
                <h1 class="mt-6 text-5xl leading-tight font-black">

                    Khám phá
                    <span class="text-cyan-200">

                        kho tài liệu

                    </span>

                    học tập hiện đại

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

                    <!-- INPUT -->
                    <div class="relative">

                        <i class="fa-solid fa-magnifying-glass
                            absolute left-5 top-1/2
                            -translate-y-1/2
                            text-cyan-500 text-lg">
                        </i>

                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                            placeholder="Tìm tên tài liệu hoặc từ khóa..." class="w-full h-16 rounded-2xl border border-slate-200
                            pl-14 pr-5 text-slate-700
                            placeholder:text-slate-400
                            focus:ring-4 focus:ring-cyan-100
                            focus:border-cyan-500 outline-none">

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
                        <button type="submit" class="h-14 rounded-xl
                            bg-cyan-500
                            hover:bg-cyan-600
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
            <div class="hidden lg:block lg:col-span-2">

                <div class="relative">

                    <!-- Glow -->
                    <div class="absolute -top-10 left-10 w-64 h-64 rounded-full bg-cyan-300/30 blur-3xl">
                    </div>

                    <!-- IMAGE -->
                    <div class="relative overflow-hidden rounded-[36px] border border-white/20 shadow-2xl">

                        <img src="https://i.pinimg.com/1200x/a7/3b/29/a73b2914ed37eb4f1e4a4f06ef0c06a8.jpg"
                            class="w-full h-[450px] object-cover">

                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-cyan-950/80 via-transparent to-transparent">
                        </div>

                        <!-- Card giới thiệu -->
                        <div
                            class="absolute top-6 left-6 bg-white/95 backdrop-blur rounded-3xl px-5 py-4 shadow-xl max-w-[260px]">

                            <div class="flex items-center gap-3">

                                <div
                                    class="w-12 h-12 rounded-2xl bg-cyan-500 text-white flex items-center justify-center">

                                    <i class="fa-solid fa-book-open text-xl"></i>

                                </div>

                                <div>

                                    <p class="text-slate-400 text-sm font-semibold">

                                        Kho học liệu

                                    </p>

                                    <h3 class="text-cyan-700 text-xl font-black">

                                        Online

                                    </h3>

                                </div>

                            </div>

                            <p class="mt-3 text-slate-600 text-sm leading-6">

                                Học liệu được phân loại theo
                                môn học, khoa và loại tài liệu,
                                hỗ trợ tìm kiếm nhanh chóng.

                            </p>

                        </div>
                        <!-- Bottom Stats -->
                        <div class="absolute bottom-6 left-6 right-6">

                            <div class="grid grid-cols-3 gap-3">

                                <!-- Documents -->
                                <div class="bg-white rounded-3xl p-4 shadow-xl">

                                    <div
                                        class="w-12 h-12 rounded-2xl bg-cyan-100 text-cyan-600 flex items-center justify-center">

                                        <i class="fa-solid fa-file-lines text-xl"></i>

                                    </div>

                                    <h3 class="mt-3 text-3xl font-black text-cyan-600">

                                        {{ number_format($totalDocuments) }}

                                    </h3>

                                    <p class="mt-1 text-slate-500 text-sm font-semibold">

                                        Tài liệu

                                    </p>

                                </div>

                                <!-- Downloads -->
                                <div class="bg-white rounded-3xl p-4 shadow-xl">

                                    <div
                                        class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center">

                                        <i class="fa-solid fa-download text-xl"></i>

                                    </div>

                                    <h3 class="mt-3 text-3xl font-black text-emerald-600">

                                        {{ number_format($totalDownloads) }}

                                    </h3>

                                    <p class="mt-1 text-slate-500 text-sm font-semibold">

                                        Lượt tải

                                    </p>

                                </div>

                                <!-- Subjects -->
                                <div class="bg-white rounded-3xl p-4 shadow-xl">

                                    <div
                                        class="w-12 h-12 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center">

                                        <i class="fa-solid fa-book text-xl"></i>

                                    </div>

                                    <h3 class="mt-3 text-3xl font-black text-orange-500">

                                        {{ number_format($totalSubjects) }}

                                    </h3>

                                    <p class="mt-1 text-slate-500 text-sm font-semibold">

                                        Môn học

                                    </p>

                                </div>

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

    .home-section-icon {
        background: #0891B2 !important;
        box-shadow: 0 12px 28px rgba(8, 145, 178, 0.25) !important;
    }

    .home-link-primary {
        color: #0891B2 !important;
    }

    .home-link-primary:hover {
        color: #0E7490 !important;
    }

    .home-card {
        border: 1px solid #CFFAFE !important;
        box-shadow: 0 12px 35px rgba(8, 145, 178, 0.08) !important;
        transition: all .3s ease;
    }

    .home-card:hover {
        background: #ECFEFF !important;
        box-shadow: 0 18px 45px rgba(8, 145, 178, 0.16) !important;
        transform: translateY(-4px);
    }

    .home-file-btn {
        border: 2px solid #0891B2 !important;
        color: #0891B2 !important;
        transition: all .3s ease;
    }

    .home-file-btn:hover {
        background: #0891B2 !important;
        color: white !important;
    }

    .home-soft-bg {
        background: #ECFEFF !important;
    }

    .home-soft-text {
        color: #0891B2 !important;
    }

    .home-download-card {
        background: linear-gradient(135deg, #0891B2, #0EA5E9);
        color: white;
        box-shadow: 0 18px 40px rgba(14, 165, 233, 0.18);
    }

    .home-download-item {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .home-download-item:hover {
        background: rgba(255, 255, 255, 0.14);
    }
    </style>
    <!-- ROLE INTRO SECTION -->
    <section class="guest-section mb-14">
        <div class="mb-7 text-center">
            <p
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-50 border border-cyan-100 text-cyan-700 text-xs font-extrabold uppercase tracking-wider mb-4">
                <i class="fa-solid fa-users"></i>
                Vai trò người dùng
            </p>

            <h2 class="text-3xl md:text-4xl font-black text-cyan-950 tracking-[-0.03em]">
                Hệ thống hỗ trợ nhiều nhóm người dùng
            </h2>

            <p class="text-slate-500 text-base font-medium mt-3 max-w-2xl mx-auto leading-7">
                EDU DOC được thiết kế để giúp việc quản lý, đăng tải và tra cứu tài liệu môn học trở nên dễ
                dàng hơn.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- STUDENT -->
            <div
                class="group bg-white rounded-[2rem] border border-cyan-100 p-7 shadow-[0_15px_45px_rgba(8,145,178,0.08)] hover:-translate-y-2 hover:shadow-[0_20px_60px_rgba(8,145,178,0.16)] transition-all duration-300">
                <div
                    class="w-16 h-16 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-6 group-hover:bg-cyan-500 group-hover:text-white transition-all">
                    <i class="fa-solid fa-user-graduate text-2xl"></i>
                </div>

                <h3 class="text-xl font-black text-slate-900 mb-3">
                    Sinh viên
                </h3>

                <p class="text-slate-500 text-sm font-medium leading-7">
                    Sinh viên có thể xem danh sách khoa, môn học, tìm kiếm tài liệu và tải học liệu phục vụ
                    quá trình
                    học tập.
                </p>

                <div class="mt-6 space-y-3">
                    <div class="flex items-center gap-3 text-sm font-bold text-slate-600">
                        <i class="fa-solid fa-check text-cyan-600"></i>
                        Xem tài liệu môn học
                    </div>

                    <div class="flex items-center gap-3 text-sm font-bold text-slate-600">
                        <i class="fa-solid fa-check text-cyan-600"></i>
                        Tìm kiếm theo từ khóa
                    </div>

                    <div class="flex items-center gap-3 text-sm font-bold text-slate-600">
                        <i class="fa-solid fa-check text-cyan-600"></i>
                        Tải tài liệu học tập
                    </div>
                </div>
            </div>

            <!-- TEACHER -->
            <div
                class="group bg-white rounded-[2rem] border border-cyan-100 p-7 shadow-[0_15px_45px_rgba(8,145,178,0.08)] hover:-translate-y-2 hover:shadow-[0_20px_60px_rgba(8,145,178,0.16)] transition-all duration-300">
                <div
                    class="w-16 h-16 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-6 group-hover:bg-cyan-500 group-hover:text-white transition-all">
                    <i class="fa-solid fa-chalkboard-user text-2xl"></i>
                </div>

                <h3 class="text-xl font-black text-slate-900 mb-3">
                    Giảng viên
                </h3>

                <p class="text-slate-500 text-sm font-medium leading-7">
                    Giảng viên có thể đăng tải, chỉnh sửa và cập nhật tài liệu cho các môn học mà mình được
                    phân công
                    phụ trách.
                </p>

                <div class="mt-6 space-y-3">
                    <div class="flex items-center gap-3 text-sm font-bold text-slate-600">
                        <i class="fa-solid fa-check text-cyan-600"></i>
                        Upload tài liệu
                    </div>

                    <div class="flex items-center gap-3 text-sm font-bold text-slate-600">
                        <i class="fa-solid fa-check text-cyan-600"></i>
                        Quản lý học liệu của mình
                    </div>

                    <div class="flex items-center gap-3 text-sm font-bold text-slate-600">
                        <i class="fa-solid fa-check text-cyan-600"></i>
                        Cập nhật tài liệu môn học
                    </div>
                </div>
            </div>

            <!-- ADMIN -->
            <div
                class="group bg-white rounded-[2rem] border border-cyan-100 p-7 shadow-[0_15px_45px_rgba(8,145,178,0.08)] hover:-translate-y-2 hover:shadow-[0_20px_60px_rgba(8,145,178,0.16)] transition-all duration-300">
                <div
                    class="w-16 h-16 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-6 group-hover:bg-cyan-500 group-hover:text-white transition-all">
                    <i class="fa-solid fa-shield-halved text-2xl"></i>
                </div>

                <h3 class="text-xl font-black text-slate-900 mb-3">
                    Quản trị viên
                </h3>

                <p class="text-slate-500 text-sm font-medium leading-7">
                    Admin quản lý toàn bộ hệ thống như người dùng, khoa, môn học, loại tài liệu và theo dõi
                    hoạt động hệ
                    thống.
                </p>

                <div class="mt-6 space-y-3">
                    <div class="flex items-center gap-3 text-sm font-bold text-slate-600">
                        <i class="fa-solid fa-check text-cyan-600"></i>
                        Quản lý người dùng
                    </div>

                    <div class="flex items-center gap-3 text-sm font-bold text-slate-600">
                        <i class="fa-solid fa-check text-cyan-600"></i>
                        Quản lý môn học
                    </div>

                    <div class="flex items-center gap-3 text-sm font-bold text-slate-600">
                        <i class="fa-solid fa-check text-cyan-600"></i>
                        Thống kê và nhật ký
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- GUEST SECTION -->
    <style>
    .guest-section {
        font-family: 'Be Vietnam Pro', sans-serif;
    }
    </style>

    <section class="guest-section mb-14">
        <div
            class="relative overflow-hidden rounded-[36px] bg-gradient-to-br from-white via-cyan-50 to-sky-100 border border-cyan-100 shadow-[0_20px_60px_rgba(8,145,178,0.12)]">

            <!-- DECOR -->
            <div
                class="absolute top-0 right-0 w-[420px] h-[420px] bg-cyan-200/50 rounded-full blur-3xl translate-x-1/3 -translate-y-1/3">
            </div>

            <div
                class="absolute bottom-0 left-0 w-[320px] h-[320px] bg-sky-200/50 rounded-full blur-3xl -translate-x-1/3 translate-y-1/3">
            </div>

            <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-10 items-center p-8 md:p-12 lg:p-14">

                <!-- LEFT -->
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-cyan-100 text-cyan-700 text-xs font-extrabold uppercase tracking-wider mb-6 shadow-sm">
                        <i class="fa-solid fa-graduation-cap"></i>
                        EDU DOC Learning Resources
                    </div>

                    <h1
                        class="text-[34px] md:text-[52px] leading-[1.12] font-black tracking-[-0.04em] text-slate-950 mb-6">
                        Quản lý và tra cứu
                        <span class="text-cyan-600">tài liệu môn học</span>
                        dễ dàng
                    </h1>

                    <p class="text-slate-500 text-base md:text-lg leading-8 font-medium max-w-xl mb-8">
                        Hệ thống giúp sinh viên tìm kiếm tài liệu theo khoa, môn học và loại học liệu. Giảng
                        viên có thể
                        đăng tải tài liệu cho các môn học mình phụ trách.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center gap-2 px-7 py-4 rounded-2xl bg-cyan-500 text-white text-sm font-extrabold hover:bg-cyan-600 shadow-lg shadow-cyan-200 transition-all hover:-translate-y-0.5">
                            Đăng nhập ngay
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>

                        <a href="{{ route('register') }}"
                            class="inline-flex items-center justify-center gap-2 px-7 py-4 rounded-2xl bg-white border border-cyan-100 text-cyan-700 text-sm font-extrabold hover:bg-cyan-50 shadow-sm transition-all">
                            Tạo tài khoản
                        </a>
                    </div>

                    <!-- STATS -->
                    <div class="grid grid-cols-3 gap-4 max-w-2xl">

                        <!-- Tài liệu -->
                        <div
                            class="bg-white rounded-2xl border border-cyan-100 p-5 shadow-sm hover:shadow-lg transition">

                            <div class="flex items-center justify-between">

                                <div>
                                    <p class="text-3xl font-black text-cyan-600">
                                        {{ number_format($totalDocuments) }}
                                    </p>

                                    <p class="mt-2 text-sm font-bold text-slate-500">
                                        Tài liệu
                                    </p>
                                </div>

                                <div
                                    class="w-12 h-12 rounded-xl bg-cyan-100 text-cyan-600 flex items-center justify-center">

                                    <i class="fa-solid fa-file-lines text-xl"></i>

                                </div>

                            </div>

                        </div>

                        <!-- Môn học -->
                        <div
                            class="bg-white rounded-2xl border border-emerald-100 p-5 shadow-sm hover:shadow-lg transition">

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-3xl font-black text-emerald-600">
                                        {{ $totalSubjects }}
                                    </p>

                                    <p class="mt-2 text-sm font-bold text-slate-500">
                                        Môn học
                                    </p>

                                </div>

                                <div
                                    class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">

                                    <i class="fa-solid fa-book-open text-xl"></i>

                                </div>

                            </div>

                        </div>

                        <!-- Khoa -->
                        <div
                            class="bg-white rounded-2xl border border-orange-100 p-5 shadow-sm hover:shadow-lg transition">

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-3xl font-black text-orange-500">
                                        {{ $totalFaculties }}
                                    </p>

                                    <p class="mt-2 text-sm font-bold text-slate-500">
                                        Khoa
                                    </p>

                                </div>

                                <div
                                    class="w-12 h-12 rounded-xl bg-orange-100 text-orange-500 flex items-center justify-center">

                                    <i class="fa-solid fa-building-columns text-xl"></i>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- RIGHT -->
                <div class="relative">
                    <div
                        class="bg-white/80 backdrop-blur-xl border border-white rounded-[32px] p-5 md:p-6 shadow-[0_18px_45px_rgba(8,145,178,0.12)]">

                        <!-- SEARCH PREVIEW -->
                        <div class="bg-white rounded-[26px] border border-cyan-100 p-5 mb-5 shadow-sm">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-100">
                                    <i class="fa-solid fa-magnifying-glass text-xl"></i>
                                </div>

                                <div>
                                    <h3 class="text-lg font-black text-slate-900">
                                        Tìm tài liệu nhanh
                                    </h3>
                                    <p class="text-sm font-semibold text-slate-500 mt-1">
                                        Theo khoa, môn học và loại tài liệu
                                    </p>
                                </div>
                            </div>

                            <div
                                class="mt-5 flex items-center gap-3 bg-cyan-50 border border-cyan-100 rounded-2xl px-4 py-3">
                                <i class="fa-solid fa-search text-cyan-600"></i>
                                <span class="text-sm font-semibold text-slate-400">
                                    Nhập tên tài liệu cần tìm...
                                </span>
                            </div>
                        </div>

                        <!-- QUICK LINKS -->
                        <div class="grid grid-cols-1 gap-4">
                            <a href="{{ route('faculties.index') }}"
                                class="group bg-white border border-cyan-100 rounded-[24px] p-5 flex items-center justify-between hover:bg-cyan-50 hover:border-cyan-200 transition shadow-sm">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white transition">
                                        <i class="fa-solid fa-building-columns"></i>
                                    </div>

                                    <div>
                                        <h4 class="font-black text-slate-900">Khoa</h4>
                                        <p class="text-xs font-bold text-slate-400 mt-1">Danh sách khoa đào
                                            tạo</p>
                                    </div>
                                </div>

                                <i class="fa-solid fa-angle-right text-cyan-600"></i>
                            </a>

                            <a href="{{ route('subjects.index') }}"
                                class="group bg-white border border-cyan-100 rounded-[24px] p-5 flex items-center justify-between hover:bg-cyan-50 hover:border-cyan-200 transition shadow-sm">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center group-hover:bg-sky-500 group-hover:text-white transition">
                                        <i class="fa-solid fa-book-open"></i>
                                    </div>

                                    <div>
                                        <h4 class="font-black text-slate-900">Môn học</h4>
                                        <p class="text-xs font-bold text-slate-400 mt-1">Tài liệu theo từng
                                            môn</p>
                                    </div>
                                </div>

                                <i class="fa-solid fa-angle-right text-cyan-600"></i>
                            </a>

                            <a href="{{ route('documents.index') }}"
                                class="group bg-white border border-cyan-100 rounded-[24px] p-5 flex items-center justify-between hover:bg-cyan-50 hover:border-cyan-200 transition shadow-sm">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition">
                                        <i class="fa-solid fa-file-lines"></i>
                                    </div>

                                    <div>
                                        <h4 class="font-black text-slate-900">Tài liệu</h4>
                                        <p class="text-xs font-bold text-slate-400 mt-1">Kho học liệu môn
                                            học</p>
                                    </div>
                                </div>

                                <i class="fa-solid fa-angle-right text-cyan-600"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @endguest
    <!-- Phần Tài liệu sẽ chia quyền giảng viên và sinh viên -->
    @auth
    <!--DANH MỤC MÔN HỌC (SINH VIÊN xem đc tất cả các file, giảng viên xem đc tất cả các file)-->
    <div class="mb-12 py-15 my-10">

        <div class="flex items-center mb-6">

            <div class="w-12 h-12 rounded-2xl
                bg-cyan-500 text-white
                flex items-center justify-center
                shadow-lg shadow-cyan-200 mr-4">

                <i class="fa-solid fa-book text-lg"></i>
            </div>

            <h4 class="text-2xl font-extrabold text-slate-800">
                Danh mục Môn học
            </h4>

            <a href="{{ route('subjects.index') }}" class="ml-auto text-sm font-semibold home-link-primary flex items-center gap-1 transition-colors  gap-2
                    text-cyan-600 hover:text-cyan-700
                    font-black transition-all">
                Xem tất cả
                <i class="fa-solid fa-angle-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($subjects as $subject)

            <a href="{{ route('subjects.show', $subject->subject_code) }}"
                class="group bg-white home-card p-6 rounded-2xl shadow-sm text-center">
                @php
                $colors = match($subject->color) {
                'blue' => 'bg-blue-50 text-blue-600',
                'red' => 'bg-red-50 text-red-600',
                'green' => 'bg-emerald-50 text-emerald-600',
                'yellow' => 'bg-yellow-50 text-yellow-600',
                'orange' => 'bg-orange-50 text-orange-600',
                'purple' => 'bg-purple-50 text-purple-600',
                'pink' => 'bg-pink-50 text-pink-600',
                'indigo' => 'bg-indigo-50 text-indigo-600',
                'cyan' => 'bg-cyan-50 text-cyan-600',
                default => 'bg-slate-100 text-slate-600',
                };
                @endphp

                <div
                    class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition {{ $colors }}">

                    <i class="{{ $subject->icon ?? 'fa-solid fa-book' }} text-2xl"></i>

                </div>

                <h6 class="font-bold text-slate-800">
                    {{ $subject->subject_name }}
                </h6>
                <p class="text-xs text-cyan-600 font-semibold mt-2">
                    {{ $subject->documents_count }} tài liệu
                </p>

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
        <div class="lg:col-span-2">
            <!-- TITLE -->
            <div class="flex items-center mb-6">

                <div
                    class="w-12 h-12 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200 mr-4">

                    <i class="fa-solid fa-clock text-lg"></i>
                </div>

                <div>
                    <h4 class="text-3xl font-black text-cyan-950 tracking-tight">
                        Tài liệu mới nhất
                    </h4>

                    <p class="text-slate-500 text-sm font-semibold mt-1">
                        Học liệu vừa được cập nhật gần đây
                    </p>
                </div>
            </div>

            <!-- CARD -->
            <div class="bg-white rounded-[32px] border border-cyan-100 overflow-hidden
            shadow-[0_15px_45px_rgba(8,145,178,0.08)]">

                <!-- CONTENT -->
                @foreach($latestDocuments as $document)

                @php
                $ext = strtolower($document->currentVersion->file_extension ?? '');
                @endphp

                <a href="{{ route('documents.show', $document->document_id) }}" class="group p-6 flex items-center gap-5 border-b border-cyan-100
          hover:bg-cyan-50/60 transition-all duration-300">

                    <!-- ICON FILE -->
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center shrink-0

            @if(in_array($ext,['pdf']))
                bg-red-50 text-red-500

            @elseif(in_array($ext,['doc','docx']))
                bg-blue-50 text-blue-600

            @elseif(in_array($ext,['xls','xlsx']))
                bg-green-50 text-green-600

            @elseif(in_array($ext,['ppt','pptx']))
                bg-orange-50 text-orange-600

            @elseif(in_array($ext,['zip','rar']))
                bg-yellow-50 text-yellow-600

            @elseif(in_array($ext,['jpg','jpeg','png','gif','webp']))
                bg-pink-50 text-pink-600

            @elseif(in_array($ext,['mp4','avi','mov']))
                bg-purple-50 text-purple-600

            @else
                bg-slate-100 text-slate-500
            @endif">

                        @if(in_array($ext,['pdf']))
                        <i class="fa-solid fa-file-pdf text-2xl"></i>

                        @elseif(in_array($ext,['doc','docx']))
                        <i class="fa-solid fa-file-word text-2xl"></i>

                        @elseif(in_array($ext,['xls','xlsx']))
                        <i class="fa-solid fa-file-excel text-2xl"></i>

                        @elseif(in_array($ext,['ppt','pptx']))
                        <i class="fa-solid fa-file-powerpoint text-2xl"></i>

                        @elseif(in_array($ext,['zip','rar']))
                        <i class="fa-solid fa-file-zipper text-2xl"></i>

                        @elseif(in_array($ext,['jpg','jpeg','png','gif','webp']))
                        <i class="fa-solid fa-file-image text-2xl"></i>

                        @elseif(in_array($ext,['mp4','avi','mov']))
                        <i class="fa-solid fa-file-video text-2xl"></i>

                        @else
                        <i class="fa-solid fa-file text-2xl"></i>
                        @endif

                    </div>

                    <!-- THÔNG TIN -->
                    <div class="flex-1 min-w-0">

                        <h3
                            class="text-lg font-black leading-relaxed text-slate-800 group-hover:text-cyan-600 transition-colors line-clamp-2">
                            {{ $document->title }}
                        </h3>

                        <div class="flex flex-wrap gap-3 mt-3 text-sm text-slate-500 font-semibold">

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

                    <!-- NÚT -->
                    <div
                        class="shrink-0 px-6 py-3 rounded-2xl bg-cyan-500 text-white font-black hover:bg-cyan-600 shadow-lg shadow-cyan-200 transition-all duration-300 flex items-center gap-2">

                        <i class="fa-solid fa-eye"></i>
                        Xem

                    </div>

                </a>

                @endforeach
            </div>
        </div>

        <!-- RIGHT -->
        <div>

            <!-- TITLE -->
            <div class="flex items-center mb-6">

                <div class="w-12 h-12 rounded-2xl
                bg-cyan-500 text-white
                flex items-center justify-center
                shadow-lg shadow-cyan-200 mr-4">

                    <i class="fa-solid fa-fire text-lg"></i>
                </div>

                <div>
                    <h4 class="text-3xl font-black text-cyan-950 tracking-tight">
                        Tài liệu tải nhiều
                    </h4>

                    <p class="text-slate-500 text-sm font-semibold mt-1">
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
                        <div class="shrink-0">

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
                            <h3 class="truncate text-[15px] font-bold text-slate-800 group-hover:text-cyan-600"
                                title="{{ $document->title }}">

                                {{ $document->title }}

                            </h3>

                            <!-- SUBJECT -->
                            <div class="mt-2">

                                <span
                                    class="inline-flex items-center rounded-full bg-cyan-50 px-3 py-1 text-xs font-semibold text-cyan-700">

                                    <i class="fa-solid fa-book mr-1"></i>

                                    {{ $document->subject?->subject_name }}

                                </span>

                            </div>

                            <!-- INFO -->
                            <div class="mt-3 flex items-center justify-between text-xs">

                                <span class="font-semibold text-cyan-600">

                                    <i class="fa-solid fa-download mr-1"></i>

                                    {{ number_format($document->download_count) }} lượt tải

                                </span>

                                <span class="text-slate-400">

                                    <i class="fa-regular fa-calendar mr-1"></i>

                                    {{ $document->created_at->format('d/m/Y') }}

                                </span>

                            </div>

                        </div>

                        <!-- ARROW -->
                        <div
                            class="shrink-0 w-10 h-10 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white transition">

                            <i class="fa-solid fa-arrow-right"></i>

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
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-14">
        <!-- LEFT -->
        <div class="lg:col-span-2">

            <!-- TITLE -->
            <div class="flex items-center mb-6">

                <div class="w-12 h-12 rounded-2xl
                bg-cyan-500 text-white
                flex items-center justify-center
                shadow-lg shadow-cyan-200 mr-4">

                    <i class="fa-solid fa-clock text-lg"></i>
                </div>

                <div>
                    <h4 class="text-3xl font-black text-cyan-950 tracking-tight">
                        Tài liệu bạn đã đăng
                    </h4>

                    <p class="text-slate-500 text-sm font-semibold mt-1">
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

                <a href="{{ route('documents.show', $document->document_id) }}"
                    class="group p-6 flex items-center gap-5 border-b border-cyan-100 hover:bg-cyan-50/60 transition-all duration-300">

                    <!-- ICON -->
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center shrink-0

                    @if(in_array($ext,['pdf']))
                        bg-red-50 text-red-500
                    @elseif(in_array($ext,['doc','docx']))
                        bg-blue-50 text-blue-600
                    @elseif(in_array($ext,['xls','xlsx']))
                        bg-green-50 text-green-600
                    @elseif(in_array($ext,['ppt','pptx']))
                        bg-orange-50 text-orange-600
                    @elseif(in_array($ext,['zip','rar']))
                        bg-yellow-50 text-yellow-600
                    @elseif(in_array($ext,['jpg','jpeg','png','gif','webp']))
                        bg-pink-50 text-pink-600
                    @elseif(in_array($ext,['mp4','avi','mov']))
                        bg-purple-50 text-purple-600
                    @else
                        bg-slate-100 text-slate-500
                    @endif">

                        @if(in_array($ext,['pdf']))
                        <i class="fa-solid fa-file-pdf text-2xl"></i>

                        @elseif(in_array($ext,['doc','docx']))
                        <i class="fa-solid fa-file-word text-2xl"></i>

                        @elseif(in_array($ext,['xls','xlsx']))
                        <i class="fa-solid fa-file-excel text-2xl"></i>

                        @elseif(in_array($ext,['ppt','pptx']))
                        <i class="fa-solid fa-file-powerpoint text-2xl"></i>

                        @elseif(in_array($ext,['zip','rar']))
                        <i class="fa-solid fa-file-zipper text-2xl"></i>

                        @elseif(in_array($ext,['jpg','jpeg','png','gif','webp']))
                        <i class="fa-solid fa-file-image text-2xl"></i>

                        @elseif(in_array($ext,['mp4','avi','mov']))
                        <i class="fa-solid fa-file-video text-2xl"></i>

                        @else
                        <i class="fa-solid fa-file text-2xl"></i>
                        @endif

                    </div>

                    <!-- THÔNG TIN -->
                    <div class="flex-1 min-w-0">

                        <h3 class="font-black text-xl text-slate-800 truncate">

                            {{ $document->title }}

                        </h3>

                        <div class="flex items-center flex-wrap gap-3 mt-2 text-sm text-slate-500">

                            <span>
                                <i class="fa-solid fa-book mr-1 text-cyan-600"></i>
                                {{ $document->subject->subject_name }}
                            </span>

                            <span>•</span>

                            <span>
                                <i class="fa-solid fa-download mr-1 text-cyan-600"></i>
                                {{ $document->download_count }} lượt tải
                            </span>

                            <span>•</span>

                            <span>
                                <i class="fa-solid fa-calendar mr-1 text-cyan-600"></i>
                                {{ $document->created_at->format('d/m/Y') }}
                            </span>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="shrink-0">

                        <button class="px-6 py-3 rounded-xl bg-cyan-500 text-white font-black
            hover:bg-cyan-600 transition flex items-center gap-2 shadow">

                            <i class="fa-solid fa-download"></i>

                            Tải về

                        </button>

                    </div>


                    @empty

                    <div class="py-16 text-center">

                        <div class="w-20 h-20 mx-auto rounded-full bg-slate-100 flex items-center justify-center">

                            <i class="fa-solid fa-file-circle-xmark text-3xl text-slate-400"></i>

                        </div>

                        <p class="mt-4 text-slate-500 font-semibold">
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

                    <h4 class="text-3xl font-black text-cyan-950 tracking-tight">
                        Thống kê tương tác
                    </h4>

                    <p class="text-slate-500 text-sm font-semibold mt-1">
                        Theo dõi hiệu quả tài liệu của bạn
                    </p>

                </div>

            </div>

            <!-- CARD -->
            <div class="bg-white rounded-[32px] border border-cyan-100 p-6 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">

                <!-- TOP -->
                <div class="grid grid-cols-2 gap-5">

                    <!-- Tổng tài liệu -->
                    <div class="rounded-2xl border border-cyan-100 bg-cyan-50 p-6">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-xs uppercase tracking-wider font-bold text-slate-500">
                                    Tài liệu
                                </p>

                                <h3 class="mt-3 text-3xl font-black text-cyan-600">
                                    {{ $totalDocuments }}
                                </h3>

                            </div>

                            <div
                                class="w-14 h-14 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow">

                                <i class="fa-solid fa-file-lines text-lg"></i>

                            </div>

                        </div>

                    </div>

                    <!-- Tổng lượt tải -->
                    <div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-6">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-xs uppercase tracking-wider font-bold text-slate-500">
                                    Lượt tải
                                </p>

                                <h3 class="mt-3 text-3xl font-black text-emerald-600">
                                    {{ number_format($totalDownloads) }}
                                </h3>

                            </div>

                            <div
                                class="w-14 h-14 rounded-2xl bg-emerald-500 text-white flex items-center justify-center shadow">

                                <i class="fa-solid fa-download text-lg"></i>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Môn học -->
                <div class="mt-5 rounded-2xl border border-blue-100 bg-blue-50 p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-xs uppercase tracking-wider font-bold text-slate-500">
                                Môn học
                            </p>

                            <h3 class="mt-3 text-3xl font-black text-blue-600">
                                {{ $totalSubjects }}
                            </h3>

                        </div>

                        <div
                            class="w-14 h-14 rounded-2xl bg-blue-500 text-white flex items-center justify-center shadow">

                            <i class="fa-solid fa-book text-lg"></i>

                        </div>

                    </div>

                </div>

                <!-- Tài liệu nổi bật -->
                @if($topDocuments->count())

                <div class="mt-5 rounded-2xl border border-orange-100 bg-orange-50 p-6">

                    <div class="flex items-center justify-between">

                        <div class="flex-1 min-w-0">

                            <p class="text-xs uppercase tracking-wider font-bold text-orange-600">
                                Tài liệu nổi bật
                            </p>

                            <h4 class="mt-2 text-lg font-black text-slate-800 truncate"
                                title="{{ $topDocuments->first()->title }}">

                                {{ $topDocuments->first()->title }}

                            </h4>

                            <p class="mt-2 text-sm font-semibold text-slate-500">

                                {{ number_format($topDocuments->first()->download_count) }}
                                lượt tải

                            </p>

                        </div>

                        <div
                            class="ml-4 w-14 h-14 rounded-2xl bg-orange-500 text-white flex items-center justify-center shadow-lg">

                            <i class="fa-solid fa-fire text-xl"></i>

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