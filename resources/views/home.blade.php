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

                            @foreach($subjects as $subject)
                            <option value="{{ $subject->subject_id }}">
                                {{ $subject->subject_name }}
                            </option>
                            @endforeach
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
                            <p class="text-3xl font-black">
                                {{ $totalDocuments }}
                            </p>
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
                EDU DOC được thiết kế để giúp việc quản lý, đăng tải và tra cứu tài liệu môn học trở nên dễ dàng hơn.
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
                    Sinh viên có thể xem danh sách khoa, môn học, tìm kiếm tài liệu và tải học liệu phục vụ quá trình
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
                    Giảng viên có thể đăng tải, chỉnh sửa và cập nhật tài liệu cho các môn học mà mình được phân công
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
                    Admin quản lý toàn bộ hệ thống như người dùng, khoa, môn học, loại tài liệu và theo dõi hoạt động hệ
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
                        Hệ thống giúp sinh viên tìm kiếm tài liệu theo khoa, môn học và loại học liệu. Giảng viên có thể
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
                    <div class="grid grid-cols-3 gap-3 max-w-xl">
                        <div class="rounded-2xl bg-white border border-cyan-100 p-4 shadow-sm">
                            <p class="text-2xl font-black text-cyan-600">{{ $totalDocuments }}</p>
                            <p class="text-xs font-bold text-slate-500 mt-1">Tài liệu</p>
                        </div>

                        <div class="rounded-2xl bg-white border border-cyan-100 p-4 shadow-sm">
                            <p class="text-2xl font-black text-cyan-600">{{ $totalSubjects }}</p>
                            <p class="text-xs font-bold text-slate-500 mt-1">Môn học</p>
                        </div>

                        <div class="rounded-2xl bg-white border border-cyan-100 p-4 shadow-sm">
                            <p class="text-2xl font-black text-cyan-600">{{ $totalFaculties }}</p>
                            <p class="text-xs font-bold text-slate-500 mt-1">Khoa</p>
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
                                        <p class="text-xs font-bold text-slate-400 mt-1">Danh sách khoa đào tạo</p>
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
                                        <p class="text-xs font-bold text-slate-400 mt-1">Tài liệu theo từng môn</p>
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
                                        <p class="text-xs font-bold text-slate-400 mt-1">Kho học liệu môn học</p>
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

            <!-- ITEM -->
            @foreach($subjects as $subject)

                <a href="{{ route('subjects.show', $subject->subject_code) }}"
                    class="group bg-white home-card p-6 rounded-2xl shadow-sm text-center cursor-pointer">

                    <div
                        class="w-16 h-16 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">

                        <i class="fa-solid fa-book text-2xl"></i>
                    </div>

                    <h6 class="font-bold text-slate-800 mb-1 group-hover:text-cyan-600 transition-colors">
                        {{ $subject->subject_name }}
                    </h6>

                    <p class="text-xs text-slate-400 font-medium">
                        {{ $subject->subject_code }}
                    </p>

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

                    <a href="{{ route('documents.show', $document->document_id) }}"
                        class="group p-6 flex items-center gap-5 border-b border-cyan-100
                        hover:bg-cyan-50/60 transition-all duration-300">

                        <div class="w-16 h-16 rounded-2xl bg-red-50 text-red-500
                            flex items-center justify-center shrink-0">

                            <i class="fa-solid fa-file-pdf text-2xl"></i>

                        </div>

                        <div class="flex-1">

                            <h3 class="text-lg font-black leading-relaxed text-slate-800
                                group-hover:text-cyan-600 transition-colors">

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
                                    {{ $document->download_count }} lượt tải
                                </span>

                                <span>•</span>

                                <span>
                                    <i class="fa-solid fa-calendar mr-1 text-cyan-600"></i>
                                    {{ $document->created_at->format('d/m/Y') }}
                                </span>

                            </div>

                        </div>

                        <button
                            class="shrink-0 px-6 py-3 rounded-2xl
                            bg-cyan-500 text-white font-black
                            hover:bg-cyan-600
                            shadow-lg shadow-cyan-200
                            transition-all duration-300 flex items-center gap-2">

                            <i class="fa-solid fa-eye"></i>
                            Xem

                        </button>

                    </a>

                    @endforeach

                <!-- FOOTER -->
                <div class="border-t border-cyan-100 p-5 text-center bg-cyan-50/40">

                    <a href="{{ route('documents.latest') }}" class="inline-flex items-center gap-2
                    text-cyan-600 hover:text-cyan-700
                    font-black transition-all">

                        Xem thêm tài liệu
                        <i class="fa-solid fa-arrow-down"></i>
                    </a>
                </div>
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
                        class="block rounded-2xl p-5 bg-cyan-50 border border-cyan-100 hover:bg-cyan-100 transition">

                        <div class="flex items-start gap-4">

                            <span class="text-4xl font-black text-cyan-500">
                                {{ $index + 1 }}
                            </span>

                            <div class="flex-1">

                                <div class="flex items-center gap-2">

                                    <h3 class="text-lg font-black leading-relaxed text-slate-800">

                                        {{ \Illuminate\Support\Str::limit($document->title, 35) }}

                                    </h3>

                                    @if($index == 0)
                                    <span class="px-2 py-1 rounded-full bg-cyan-500 text-white text-[10px] font-black">
                                        HOT
                                    </span>
                                    @endif

                                </div>

                                <p class="text-slate-500 text-sm mt-2 font-semibold">
                                    <i class="fa-solid fa-book mr-1 text-cyan-600"></i>

                                    {{ $document->subject?->subject_name ?? 'Chưa có môn học' }}
                                </p>

                                <p class="text-cyan-600 text-sm mt-2 font-semibold">
                                    <i class="fa-solid fa-download mr-1"></i>

                                    {{ number_format($document->download_count) }}
                                    lượt tải
                                </p>

                            </div>

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
            <div class="bg-white rounded-[32px] border border-cyan-100 overflow-hidden shadow-[0_15px_45px_rgba(8,145,178,0.08)]">

                <!-- ITEM -->
                <a href="{{ route('documents.show', 1) }}" class="group p-6 flex items-center gap-5 border-b border-cyan-100 hover:bg-cyan-50/60 transition-all duration-300">

                    <!-- FILE ICON -->
                    <div class="w-16 h-16 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center shrink-0">

                        <i class="fa-solid fa-file-pdf text-2xl"></i>
                    </div>

                    <!-- CONTENT -->
                    <div class="flex-1">

                        <h3 class="text-lg font-black leading-relaxed text-slate-800 group-hover:text-cyan-600 transition-colors">

                            Slide Bài 1: Tổng quan Laravel Framework
                        </h3>

                        <div class="flex flex-wrap gap-3 mt-3 text-sm text-slate-500 font-semibold">

                            <span>
                                <i class="fa-solid fa-book mr-1 text-cyan-600"></i>
                                Môn: Lập trình Web
                            </span>

                            <span>•</span>

                            <span>
                                <i class="fa-solid fa-user-tie mr-1 text-cyan-600"></i>
                                GV: ThS. Trần Văn B
                            </span>

                            <span>•</span>

                            <span>
                                <i class="fa-solid fa-calendar mr-1 text-cyan-600"></i>
                                Hôm nay
                            </span>
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <button class="shrink-0 px-6 py-3 rounded-2xl bg-cyan-500 text-white font-black hover:bg-cyan-600 shadow-lg shadow-cyan-200 transition-all duration-300 flex items-center gap-2">

                        <i class="fa-solid fa-download"></i>
                        Tải về
                    </button>

                </a>

                <!-- ITEM -->
                <div class="group p-6 flex items-center gap-5 border-b border-cyan-100 hover:bg-cyan-50/60 transition-all duration-300">

                    <!-- FILE ICON -->
                    <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-500  flex items-center justify-center shrink-0">

                        <i class="fa-solid fa-file-word text-2xl"></i>
                    </div>

                    <!-- CONTENT -->
                    <div class="flex-1">

                        <h3 class="text-lg font-black leading-relaxed text-slate-800 group-hover:text-cyan-600 transition-colors">
                            Đề cương ôn tập giữa kỳ CSDL 2023-2024
                        </h3>

                        <div class="flex flex-wrap gap-3 mt-3 text-sm text-slate-500 font-semibold">

                            <span>
                                <i class="fa-solid fa-book mr-1 text-cyan-600"></i>
                                Môn: Cơ sở dữ liệu
                            </span>

                            <span>•</span>

                            <span>
                                <i class="fa-solid fa-user-tie mr-1 text-cyan-600"></i>
                                GV: TS. Lê Thị C
                            </span>

                            <span>•</span>

                            <span>
                                <i class="fa-solid fa-calendar mr-1 text-cyan-600"></i>
                                Hôm qua
                            </span>
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <button class="shrink-0 px-6 py-3 rounded-2xl bg-cyan-500 text-white font-black  hover:bg-cyan-600  shadow-lg shadow-cyan-200 transition-all duration-300 flex items-center gap-2">

                        <i class="fa-solid fa-download"></i>
                        Tải về
                    </button>
                </div>

                <!-- ITEM -->
                <div class="group p-6 flex items-center gap-5  hover:bg-cyan-50/60 transition-all duration-300">

                    <!-- FILE ICON -->
                    <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-500  flex items-center justify-center shrink-0">

                        <i class="fa-solid fa-file-excel text-2xl"></i>
                    </div>

                    <!-- CONTENT -->
                    <div class="flex-1">

                        <h3 class="text-lg font-black leading-relaxed text-slate-800 group-hover:text-cyan-600 transition-colors">

                            Danh sách chia nhóm & Bài tập lớn Mạng máy tính
                        </h3>

                        <div class="flex flex-wrap gap-3 mt-3   text-sm text-slate-500 font-semibold">

                            <span>
                                <i class="fa-solid fa-book mr-1 text-cyan-600"></i>
                                Môn: Mạng máy tính
                            </span>

                            <span>•</span>

                            <span>
                                <i class="fa-solid fa-user-tie mr-1 text-cyan-600"></i>
                                GV: Phạm Văn D
                            </span>

                            <span>•</span>

                            <span>
                                <i class="fa-solid fa-calendar mr-1 text-cyan-600"></i>
                                2 ngày trước
                            </span>
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <button class="shrink-0 px-6 py-3 rounded-2xl
                    bg-cyan-500 text-white font-black
                    hover:bg-cyan-600
                    shadow-lg shadow-cyan-200
                    transition-all duration-300
                    flex items-center gap-2">

                        <i class="fa-solid fa-download"></i>
                        Tải về
                    </button>
                </div>

                <!-- FOOTER -->
                <div class="border-t border-cyan-100
                p-5 text-center bg-cyan-50/40">

                    <a href="{{ route('documents.my-documents') }}" class="inline-flex items-center gap-2
                    text-cyan-600 hover:text-cyan-700
                    font-black transition-all">

                        Xem thêm tài liệu
                        <i class="fa-solid fa-arrow-down"></i>
                    </a>
                </div>
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

                    <i class="fa-solid fa-chart-line text-lg"></i>
                </div>

                <div>
                    <h4 class="text-3xl font-black text-cyan-950 tracking-tight">
                        Thống kê tương tác
                    </h4>

                    <p class="text-slate-500 text-sm font-semibold mt-1">
                        Theo dõi lượt tải và đánh giá tài liệu
                    </p>
                </div>
            </div>

            <!-- STATS CARD -->
            <!-- STATS CARD -->
            <div class="rounded-[32px] bg-white border border-cyan-100 p-6 shadow-[0_20px_60px_rgba(8,145,178,0.12)]">

                <!-- TOP -->
                <div class="grid grid-cols-2 gap-4">

                    <!-- LƯỢT TẢI -->
                    <div class="bg-cyan-50 border border-cyan-100 rounded-2xl p-6 text-center">

                        <h3 class="text-4xl font-black text-cyan-600">
                            1.2k
                        </h3>

                        <p class="mt-3 text-cyan-700 text-sm font-black uppercase tracking-[0.15em]">
                            Lượt tải
                        </p>
                    </div>

                    <!-- MÔN HỌC -->
                    <div class="bg-cyan-50 border border-cyan-100 rounded-2xl p-6 text-center">

                        <h3 class="text-4xl font-black text-cyan-600">
                            5
                        </h3>

                        <p class="mt-3 text-cyan-700 text-sm font-black uppercase tracking-[0.15em]">
                            Môn học
                        </p>
                    </div>

                </div>

                <!-- TÀI LIỆU NỔI BẬT -->
                <div class="mt-5 bg-cyan-50 border border-cyan-100 rounded-2xl p-5">

                    <div class="flex items-center justify-between gap-4">

                        <div>
                            <p class="text-cyan-700 text-sm font-bold">
                                Tài liệu nổi bật
                            </p>

                            <h5 class="text-slate-800 text-lg font-black mt-1 leading-snug">
                                Laravel Framework
                            </h5>

                            <p class="text-slate-500 text-sm mt-2 font-semibold">
                                520 lượt tải xuống
                            </p>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200 shrink-0">
                            <i class="fa-solid fa-fire text-xl"></i>
                        </div>

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