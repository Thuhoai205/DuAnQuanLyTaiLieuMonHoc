@extends('layouts.app')

@section('title', 'Tài liệu mới nhất')

@section('content')

<main class="min-h-screen bg-[#EAFBFF] py-12">

    <div class="max-w-7xl mx-auto px-6">

        <!-- HEADER -->
        <section class="mb-8 rounded-[36px] bg-cyan-600 text-white p-8 shadow-xl">
            <a href="javascript:history.back()"
                class="inline-flex items-center gap-2 mb-6 px-5 py-2.5 rounded-full bg-slate-100 hover:bg-cyan-50 text-slate-600 hover:text-cyan-600 text-xs font-black uppercase tracking-wider transition-all">
                <i class="fa-solid fa-arrow-left"></i>
                Quay lại
            </a>


            <div class="flex items-center gap-5">
                <div class="w-20 h-20 rounded-3xl bg-cyan-300 text-cyan-950 flex items-center justify-center shadow-xl">
                    <i class="fa-solid fa-clock text-3xl"></i>
                </div>

                <div>
                    <h1 class="text-4xl md:text-5xl font-black">
                        Tài liệu mới nhất
                    </h1>
                    <p class="text-cyan-50 mt-3 font-semibold">
                        Danh sách học liệu vừa được giảng viên cập nhật gần đây.
                    </p>
                </div>
            </div>
        </section>

        <!-- SEARCH -->
        <section class="mb-8 bg-white rounded-[28px] p-5 border border-cyan-100 shadow-sm">
            <form method="GET" action="{{ url()->current() }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <div class="md:col-span-2 relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-cyan-600"></i>
                    <input type="text" name="keyword" placeholder="Tìm tài liệu mới nhất..."
                        class="w-full h-14 pl-14 pr-5 rounded-2xl bg-cyan-50 border border-cyan-100 outline-none font-semibold">
                </div>

                <select name="subject_id"
                    class="h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100 text-slate-700 font-bold outline-none">
                    <option value="">Tất cả môn học</option>
                    <option value="1">Lập trình Web</option>
                    <option value="2">Cơ sở dữ liệu</option>
                    <option value="3">Mạng máy tính</option>
                </select>

                <button
                    class="h-14 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-black shadow-lg shadow-cyan-200">
                    <i class="fa-solid fa-filter mr-2"></i>
                    Lọc
                </button>
            </form>
        </section>

        <!-- LIST -->
        <section
            class="bg-white rounded-[32px] border border-cyan-100 overflow-hidden shadow-[0_15px_45px_rgba(8,145,178,0.08)]">

            <div class="px-7 py-5 border-b border-cyan-100 flex items-center justify-between">
                <h2 class="text-2xl font-black text-cyan-950">
                    Học liệu vừa đăng
                </h2>

                <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black">
                    Mới nhất
                </span>
            </div>

            <a href="{{ route('documents.show', 1) }}" class="divide-y divide-cyan-100">


                <!-- LIST -->
                <div
                    class="bg-white rounded-[2rem] border border-cyan-100 overflow-hidden shadow-[0_15px_45px_rgba(8,145,178,0.08)]">

                    <!-- ITEM -->
                    <a href="{{ route('documents.show', 1) }}"
                        class="group p-6 hover:bg-cyan-50/60 transition-colors flex flex-col lg:flex-row lg:items-center gap-5 border-b border-cyan-100">

                        <!-- ICON -->
                        <div
                            class="w-16 h-16 bg-red-50 text-red-500 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-red-100">

                            <i class="fa-solid fa-file-pdf text-2xl"></i>
                        </div>

                        <!-- CONTENT -->
                        <div class="flex-grow">

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



                        </div>

                        <!-- BUTTON -->
                        <div class="shrink-0 flex items-center gap-3">


                            <button
                                class="px-5 py-2.5 bg-cyan-500 text-white font-bold rounded-xl hover:bg-cyan-600 transition-all flex items-center gap-2 text-sm shadow-lg shadow-cyan-200">
                                <i class="fa-solid fa-cloud-arrow-down"></i>
                                Tải về
                            </button>

                        </div>


                    </a>

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

                            <button
                                class="px-5 py-2.5 bg-cyan-500 text-white font-bold rounded-xl hover:bg-cyan-600 transition-all flex items-center gap-2 text-sm shadow-lg shadow-cyan-200">
                                <i class="fa-solid fa-cloud-arrow-down"></i>
                                Tải về
                            </button>

                        </div>

                    </div>

                </div>

            </a>

            <!-- PAGINATION -->
            <div class="px-8 py-6 bg-cyan-50/40 border-t border-cyan-100
    flex flex-col md:flex-row items-center justify-between gap-5">

                <!-- INFO -->
                <p class="text-sm font-black uppercase tracking-[0.15em] text-slate-400">
                    Trang 1 của 5
                </p>

                <!-- PAGINATION BUTTON -->
                <div class="flex items-center gap-3">

                    <!-- PREV -->
                    <button class="h-12 px-5 rounded-2xl
            bg-white border border-cyan-100
            text-slate-500 font-black
            hover:bg-cyan-500 hover:text-white
            hover:border-cyan-500
            transition-all duration-300 shadow-sm">

                        <i class="fa-solid fa-angle-left mr-2"></i>
                        Trước
                    </button>

                    <!-- NUMBER -->
                    <button class="w-12 h-12 rounded-2xl
            bg-cyan-500 text-white font-black
            shadow-lg shadow-cyan-200">
                        1
                    </button>

                    <button class="w-12 h-12 rounded-2xl
            bg-white border border-cyan-100
            text-slate-600 font-black
            hover:bg-cyan-500 hover:text-white
            hover:border-cyan-500
            transition-all duration-300">
                        2
                    </button>

                    <button class="w-12 h-12 rounded-2xl
            bg-white border border-cyan-100
            text-slate-600 font-black
            hover:bg-cyan-500 hover:text-white
            hover:border-cyan-500
            transition-all duration-300">
                        3
                    </button>

                    <!-- NEXT -->
                    <button class="h-12 px-5 rounded-2xl
            bg-cyan-500 text-white font-black
            hover:bg-cyan-600
            transition-all duration-300
            shadow-lg shadow-cyan-200">

                        Sau
                        <i class="fa-solid fa-angle-right ml-2"></i>
                    </button>

                </div>
            </div>
        </section>

    </div>
</main>

@endsection