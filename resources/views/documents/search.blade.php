@extends('layouts.app')

@section('title', 'Tìm kiếm tài liệu')

@section('content')

<main class="min-h-screen bg-[#EAFBFF]">

    <!-- HERO SEARCH -->
    <section class="relative overflow-hidden bg-gradient-to-br from-cyan-700 via-cyan-600 to-cyan-500 text-white py-14">

        <!-- BG -->
        <div class="absolute inset-0 opacity-10">
            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1600"
                class="w-full h-full object-cover">
        </div>

        <div class="relative max-w-7xl mx-auto px-6 sm:px-10 lg:px-16">

            <!-- BACK -->
            <a href="{{ route('home') }}"
                class="inline-flex items-center gap-2 mb-8 px-5 py-2.5 bg-cyan-800/40 hover:bg-cyan-700/50 border border-cyan-300/20 rounded-full text-sm font-bold transition">

                <i class="fa-solid fa-arrow-left"></i>
                Quay lại
            </a>

            <!-- TITLE -->
            <div class="max-w-3xl">
                <p class="uppercase tracking-[0.25em] text-cyan-100 text-xs font-black mb-4">
                    Tra cứu học liệu
                </p>

                <h1 class="text-4xl md:text-5xl font-black leading-tight">
                    Tìm kiếm tài liệu học tập
                </h1>

                <p class="mt-5 text-cyan-50/90 text-lg">
                    Tìm slide, giáo trình, bài tập, đề thi và tài liệu mới nhất từ giảng viên.
                </p>
            </div>

            <!-- SEARCH -->
            <div
                class="mt-10 bg-white/95 backdrop-blur-xl rounded-[2rem] p-5 border border-white/30 shadow-[0_20px_60px_rgba(0,0,0,0.15)]">

                <form class="grid grid-cols-1 lg:grid-cols-12 gap-4">

                    <!-- INPUT -->
                    <div class="lg:col-span-5 relative">

                        <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-cyan-600">
                        </i>

                        <input type="text" placeholder="Nhập tên tài liệu, môn học hoặc giảng viên..."
                            class="w-full h-14 pl-14 pr-4 rounded-2xl bg-cyan-50 border border-cyan-100 text-slate-700 font-semibold placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-300 transition-all">
                    </div>

                    <!-- SUBJECT -->
                    <div class="lg:col-span-3">

                        <select
                            class="w-full h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100 text-slate-700 font-bold focus:outline-none focus:ring-2 focus:ring-cyan-300">

                            <option>Tất cả môn học</option>
                            <option>Lập trình Web</option>
                            <option>Cơ sở dữ liệu</option>
                            <option>Mạng máy tính</option>

                        </select>
                    </div>

                    <!-- TYPE -->
                    <div class="lg:col-span-2">

                        <select
                            class="w-full h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100 text-slate-700 font-bold focus:outline-none focus:ring-2 focus:ring-cyan-300">

                            <option>Tất cả loại</option>
                            <option>PDF</option>
                            <option>Word</option>
                            <option>Excel</option>

                        </select>
                    </div>

                    <!-- BUTTON -->
                    <div class="lg:col-span-2">

                        <button type="submit"
                            class="w-full h-14 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-black shadow-lg shadow-cyan-200 transition-all">

                            <i class="fa-solid fa-magnifying-glass mr-2"></i>
                            Tìm kiếm
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </section>

    <!-- CONTENT -->
    <section class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-12">

        <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">

            <!-- FILTER -->
            <aside class="xl:col-span-1">

                <div
                    class="bg-white rounded-[2rem] border border-cyan-100 p-6 shadow-[0_15px_45px_rgba(8,145,178,0.08)] sticky top-24">

                    <h3 class="text-xl font-black text-slate-800 mb-6">
                        Bộ lọc
                    </h3>

                    <!-- FILE TYPE -->
                    <div class="mb-8">

                        <h4 class="text-sm font-black uppercase tracking-[0.15em] text-slate-400 mb-4">
                            Loại tài liệu
                        </h4>

                        <div class="space-y-4">

                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" class="accent-cyan-500 w-5 h-5">
                                <span class="font-semibold text-slate-700">Bài tập</span>
                            </label>

                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" class="accent-cyan-500 w-5 h-5">
                                <span class="font-semibold text-slate-700">Đề thi</span>
                            </label>

                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" class="accent-cyan-500 w-5 h-5">
                                <span class="font-semibold text-slate-700">Giáo trình</span>
                            </label>

                        </div>
                    </div>


                    <!-- BUTTON -->
                    <button
                        class="w-full py-3 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-black shadow-lg shadow-cyan-200 transition-all">

                        Áp dụng bộ lọc
                    </button>

                </div>
            </aside>

            <!-- RESULT -->
            <div class="xl:col-span-3">

                <!-- TOP -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                    <div>
                        <h2 class="text-3xl font-black text-slate-900">
                            Kết quả tìm kiếm
                        </h2>

                        <p class="text-slate-500 font-semibold mt-2">
                            Tìm thấy <span class="text-cyan-600 font-black">24 tài liệu</span>
                        </p>
                    </div>

                    <select
                        class="h-12 px-5 rounded-2xl border border-cyan-100 bg-white text-slate-700 font-bold focus:outline-none">

                        <option>Mới nhất</option>
                        <option>Tải nhiều</option>
                        <option>A-Z</option>

                    </select>
                </div>

                <!-- LIST -->
                <div
                    class="bg-white rounded-[2rem] border border-cyan-100 overflow-hidden shadow-[0_15px_45px_rgba(8,145,178,0.08)]">

                    <!-- ITEM -->
                    <div
                        class="group p-6 hover:bg-cyan-50/60 transition-colors flex flex-col lg:flex-row lg:items-center gap-5 border-b border-cyan-100">

                        <!-- ICON -->
                        <div
                            class="w-16 h-16 bg-red-50 text-red-500 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-red-100">

                            <i class="fa-solid fa-file-pdf text-2xl"></i>
                            <span class="text-[10px] font-black mt-1">PDF</span>
                        </div>

                        <!-- CONTENT -->
                        <a href="{{ route('documents.show', 1) }}" class="flex-grow">

                            <h3 class="text-lg font-black text-slate-800 group-hover:text-cyan-600 transition-colors">

                                Slide Bài 1: Tổng quan Laravel Framework
                            </h3>

                            <div class="flex flex-wrap items-center gap-3 text-slate-500 text-sm mt-3 font-medium">

                                <span>
                                    <i class="fa-solid fa-book text-cyan-600 mr-1.5"></i>
                                    Lập trình Web
                                </span>

                                <span>•</span>

                                <span>
                                    <i class="fa-solid fa-user-tie text-cyan-600 mr-1.5"></i>
                                    GV: Bạn
                                </span>

                                <span>•</span>

                                <span>
                                    <i class="fa-solid fa-calendar text-cyan-600 mr-1.5"></i>
                                    Hôm nay
                                </span>

                            </div>



                        </a>

                        <!-- BUTTON -->
                        <div class="shrink-0 flex items-center gap-3">

                            @if(Auth::check())
                            <button
                                class="px-5 py-2.5 bg-cyan-500 text-white font-bold rounded-xl hover:bg-cyan-600 transition-all flex items-center gap-2 text-sm shadow-lg shadow-cyan-200">
                                <i class="fa-solid fa-cloud-arrow-down"></i>
                                Tải về
                            </button>
                            @else
                            <button onclick="showLoginRequiredModal()"
                                class="px-5 py-2.5 border-2 border-cyan-100 text-cyan-700 font-bold rounded-xl hover:bg-cyan-50 transition-all flex items-center gap-2 text-sm">
                                <i class="fa-solid fa-lock"></i>
                                Đăng nhập để tải
                            </button>
                            @endif

                            @if(Auth::check() && Auth::user()->role_id == 2)

                            <a href="{{ route('documents.edit', 1) }}" class="w-10 h-10 flex items-center justify-center
    text-amber-500 hover:bg-amber-500 hover:text-white
    rounded-xl transition-all duration-300
    shadow-sm bg-white border border-amber-100" title="Sửa">

                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                            </a>
                            <button
                                class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition flex items-center justify-center border border-red-100">
                                <i class="fa-solid fa-trash"></i>
                            </button>

                            @endif
                        </div>

                    </div>

                    <!-- ITEM -->
                    <div
                        class="group p-6 hover:bg-cyan-50/60 transition-colors flex flex-col lg:flex-row lg:items-center gap-5">

                        <!-- ICON -->
                        <div
                            class="w-16 h-16 bg-blue-50 text-blue-500 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-blue-100">

                            <i class="fa-solid fa-file-word text-2xl"></i>
                            <span class="text-[10px] font-black mt-1">DOCX</span>
                        </div>

                        <!-- CONTENT -->
                        <div class="flex-grow">

                            <h3 class="text-lg font-black text-slate-800 group-hover:text-cyan-600 transition-colors">

                                Đề cương ôn tập giữa kỳ CSDL 2023-2024
                            </h3>

                            <div class="flex flex-wrap items-center gap-3 text-slate-500 text-sm mt-3 font-medium">

                                <span>
                                    <i class="fa-solid fa-book text-cyan-600 mr-1.5"></i>
                                    Cơ sở dữ liệu
                                </span>

                                <span>•</span>

                                <span>
                                    <i class="fa-solid fa-user-tie text-cyan-600 mr-1.5"></i>
                                    TS. Lê Thị C
                                </span>

                                <span>•</span>

                                <span>
                                    <i class="fa-solid fa-calendar text-cyan-600 mr-1.5"></i>
                                    Hôm qua
                                </span>

                            </div>


                        </div>

                        <!-- BUTTON -->
                        <div class="shrink-0 flex items-center gap-3">

                            @if(Auth::check())
                            <button
                                class="px-5 py-2.5 bg-cyan-500 text-white font-bold rounded-xl hover:bg-cyan-600 transition-all flex items-center gap-2 text-sm shadow-lg shadow-cyan-200">
                                <i class="fa-solid fa-cloud-arrow-down"></i>
                                Tải về
                            </button>
                            @else
                            <button onclick="showLoginRequiredModal()"
                                class="px-5 py-2.5 border-2 border-cyan-100 text-cyan-700 font-bold rounded-xl hover:bg-cyan-50 transition-all flex items-center gap-2 text-sm">
                                <i class="fa-solid fa-lock"></i>
                                Đăng nhập để tải
                            </button>
                            @endif
                        </div>

                    </div>

                </div>

                <!-- PAGINATION -->
                <div
                    class="mt-8 px-8 py-6 bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] flex flex-col md:flex-row items-center justify-between gap-5">

                    <p class="text-sm font-black uppercase tracking-[0.15em] text-slate-400">
                        Trang 1 của 5
                    </p>

                    <div class="flex items-center gap-3">

                        <button
                            class="h-12 px-5 rounded-2xl bg-white border border-cyan-100 text-slate-500 font-black hover:bg-cyan-500 hover:text-white hover:border-cyan-500 transition-all duration-300 shadow-sm">

                            <i class="fa-solid fa-angle-left mr-2"></i>
                            Trước
                        </button>

                        <button
                            class="w-12 h-12 rounded-2xl bg-cyan-500 text-white font-black shadow-lg shadow-cyan-200">
                            1
                        </button>

                        <button
                            class="w-12 h-12 rounded-2xl bg-white border border-cyan-100 text-slate-600 font-black hover:bg-cyan-500 hover:text-white hover:border-cyan-500 transition-all duration-300">
                            2
                        </button>

                        <button
                            class="w-12 h-12 rounded-2xl bg-white border border-cyan-100 text-slate-600 font-black hover:bg-cyan-500 hover:text-white hover:border-cyan-500 transition-all duration-300">
                            3
                        </button>

                        <button
                            class="h-12 px-5 rounded-2xl bg-cyan-500 text-white font-black hover:bg-cyan-600 transition-all duration-300 shadow-lg shadow-cyan-200">

                            Sau
                            <i class="fa-solid fa-angle-right ml-2"></i>
                        </button>

                    </div>
                </div>

            </div>

        </div>

    </section>

</main>

<!-- LOGIN REQUIRED MODAL -->
<div id="loginRequiredModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/40 backdrop-blur-sm px-4">

    <div class="w-full max-w-md bg-white rounded-3xl p-8 text-center shadow-2xl border border-cyan-100">

        <div
            class="w-20 h-20 mx-auto rounded-full bg-cyan-50 text-cyan-600 flex items-center justify-center text-3xl mb-5">
            <i class="fa-solid fa-lock"></i>
        </div>

        <h3 class="text-2xl font-black text-slate-900 mb-3">
            Yêu cầu đăng nhập
        </h3>

        <p class="text-slate-500 leading-relaxed mb-6">
            Bạn cần đăng nhập để tải tài liệu học tập.
        </p>

        <div class="flex items-center justify-center gap-3">
            <button onclick="closeLoginRequiredModal()"
                class="px-5 py-3 rounded-2xl border border-cyan-100 text-slate-600 font-bold hover:bg-cyan-50 transition">
                Đóng
            </button>

            <a href="{{ route('login') }}"
                class="px-6 py-3 rounded-2xl bg-cyan-500 text-white font-bold hover:bg-cyan-600 transition shadow-lg shadow-cyan-200">
                Đăng nhập ngay
            </a>
        </div>
    </div>
</div>
@endsection
<script>
function showLoginRequiredModal() {
    const modal = document.getElementById('loginRequiredModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLoginRequiredModal() {
    const modal = document.getElementById('loginRequiredModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>