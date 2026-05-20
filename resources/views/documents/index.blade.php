@extends('layouts.app')

@section('title', 'Danh sách tài liệu')

@section('content')

<main class="min-h-screen bg-[#EAFBFF] py-12">
    <div class="max-w-7xl mx-auto px-6">

        <!-- HEADER -->
        <section class="mb-8 rounded-[32px] bg-cyan-600 text-white p-8 shadow-xl">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">
                <div>
                    <span
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-700 text-cyan-50 text-xs font-bold mb-4">
                        <i class="fa-solid fa-folder-open"></i>
                        Kho học liệu
                    </span>

                    <h1 class="text-4xl font-black mb-2">
                        Danh sách tài liệu
                    </h1>

                    <p class="text-cyan-50">
                        Tìm kiếm, lọc và tải tài liệu học tập theo từng môn học.
                    </p>
                </div>

                @auth
                @if(auth()->user()->role_id == 2)
                <a href="#"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-cyan-300 text-cyan-950 font-black hover:bg-cyan-200 transition">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    Đăng tài liệu
                </a>
                @endif
                @endauth
            </div>
        </section>

        <!-- FILTER -->
        <section class="mb-8 bg-white rounded-[28px] p-5 shadow-sm border border-cyan-100">
            <form method="GET" action="{{ url()->current() }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <div class="md:col-span-2">
                    <label class="block text-xs font-black uppercase text-slate-400 mb-2">
                        Tìm kiếm
                    </label>
                    <div class="relative">
                        <i
                            class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-cyan-600"></i>
                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                            placeholder="Nhập tên tài liệu..."
                            class="w-full h-12 pl-11 pr-4 rounded-2xl bg-cyan-50 border border-cyan-100 text-sm font-semibold outline-none focus:ring-2 focus:ring-cyan-300">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-slate-400 mb-2">
                        Môn học
                    </label>
                    <select name="subject_id"
                        class="w-full h-12 px-4 rounded-2xl bg-cyan-50 border border-cyan-100 text-sm font-bold text-slate-700 outline-none">
                        <option value="">Tất cả môn học</option>
                        <option value="1">Lập trình Web</option>
                        <option value="2">Cơ sở dữ liệu</option>
                        <option value="3">Mạng máy tính</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-slate-400 mb-2">
                        Loại tài liệu
                    </label>
                    <select name="type_id"
                        class="w-full h-12 px-4 rounded-2xl bg-cyan-50 border border-cyan-100 text-sm font-bold text-slate-700 outline-none">
                        <option value="">Tất cả loại</option>
                        <option value="1">Slide</option>
                        <option value="2">Đề thi</option>
                        <option value="3">Bài tập</option>
                        <option value="4">Giáo trình</option>
                    </select>
                </div>

                <div class="md:col-span-4 flex justify-end gap-3">
                    <a href="{{ url()->current() }}"
                        class="px-6 py-3 rounded-2xl bg-slate-100 text-slate-600 font-bold hover:bg-slate-200 transition">
                        Làm mới
                    </a>

                    <button type="submit"
                        class="px-8 py-3 rounded-2xl bg-cyan-600 text-white font-black hover:bg-cyan-700 shadow-lg shadow-cyan-200 transition">
                        <i class="fa-solid fa-filter mr-2"></i>
                        Lọc tài liệu
                    </button>
                </div>
            </form>
        </section>

        <!-- DOCUMENT LIST -->
        <section class="bg-white rounded-[32px] shadow-sm border border-cyan-100 overflow-hidden">

            <div class="px-7 py-5 border-b border-cyan-100 flex items-center justify-between">
                <h2 class="text-xl font-black text-slate-900">
                    Tất cả tài liệu
                </h2>

                <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black">
                    120 tài liệu
                </span>
            </div>

            <div class="divide-y divide-cyan-100">

                <!-- ITEM 1 -->
                <div class="p-6 flex flex-col lg:flex-row lg:items-center gap-5 hover:bg-cyan-50/60 transition">

                    <div class="w-16 h-16 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-file-pdf text-2xl"></i>
                    </div>

                    <div class="flex-1">
                        <h3 class="text-lg font-black text-slate-900 hover:text-cyan-700 transition">
                            Slide Bài 1: Tổng quan Laravel Framework
                        </h3>

                        <div class="flex flex-wrap gap-3 mt-2 text-sm font-semibold text-slate-500">
                            <span><i class="fa-solid fa-book mr-1 text-cyan-600"></i> Lập trình Web</span>
                            <span>•</span>
                            <span><i class="fa-solid fa-user-tie mr-1 text-cyan-600"></i> ThS. Trần Văn B</span>
                            <span>•</span>
                            <span><i class="fa-solid fa-calendar mr-1 text-cyan-600"></i> Hôm nay</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black">
                            Slide
                        </span>

                        <a href="#"
                            class="px-5 py-3 rounded-2xl bg-cyan-600 text-white font-black hover:bg-cyan-700 transition">
                            <i class="fa-solid fa-download mr-2"></i>
                            Tải về
                        </a>
                    </div>
                </div>

                <!-- ITEM 2 -->
                <div class="p-6 flex flex-col lg:flex-row lg:items-center gap-5 hover:bg-cyan-50/60 transition">

                    <div
                        class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-file-word text-2xl"></i>
                    </div>

                    <div class="flex-1">
                        <h3 class="text-lg font-black text-slate-900 hover:text-cyan-700 transition">
                            Đề cương ôn tập giữa kỳ CSDL 2023-2024
                        </h3>

                        <div class="flex flex-wrap gap-3 mt-2 text-sm font-semibold text-slate-500">
                            <span><i class="fa-solid fa-book mr-1 text-cyan-600"></i> Cơ sở dữ liệu</span>
                            <span>•</span>
                            <span><i class="fa-solid fa-user-tie mr-1 text-cyan-600"></i> TS. Lê Thị C</span>
                            <span>•</span>
                            <span><i class="fa-solid fa-calendar mr-1 text-cyan-600"></i> Hôm qua</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black">
                            Đề cương
                        </span>

                        <a href="#"
                            class="px-5 py-3 rounded-2xl bg-cyan-600 text-white font-black hover:bg-cyan-700 transition">
                            <i class="fa-solid fa-download mr-2"></i>
                            Tải về
                        </a>
                    </div>
                </div>

                <!-- ITEM 3 -->
                <div class="p-6 flex flex-col lg:flex-row lg:items-center gap-5 hover:bg-cyan-50/60 transition">

                    <div
                        class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-file-excel text-2xl"></i>
                    </div>

                    <div class="flex-1">
                        <h3 class="text-lg font-black text-slate-900 hover:text-cyan-700 transition">
                            Danh sách chia nhóm & Bài tập lớn Mạng máy tính
                        </h3>

                        <div class="flex flex-wrap gap-3 mt-2 text-sm font-semibold text-slate-500">
                            <span><i class="fa-solid fa-book mr-1 text-cyan-600"></i> Mạng máy tính</span>
                            <span>•</span>
                            <span><i class="fa-solid fa-user-tie mr-1 text-cyan-600"></i> Phạm Văn D</span>
                            <span>•</span>
                            <span><i class="fa-solid fa-calendar mr-1 text-cyan-600"></i> 2 ngày trước</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black">
                            Bài tập
                        </span>

                        <a href="#"
                            class="px-5 py-3 rounded-2xl bg-cyan-600 text-white font-black hover:bg-cyan-700 transition">
                            <i class="fa-solid fa-download mr-2"></i>
                            Tải về
                        </a>
                    </div>
                </div>

            </div>

            <!-- PAGINATION -->
            <div
                class="px-7 py-5 bg-cyan-50/60 border-t border-cyan-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm text-slate-500 font-semibold">
                    Hiển thị 1 - 10 trong tổng 120 tài liệu
                </p>

                <div class="flex items-center gap-2">
                    <button
                        class="w-10 h-10 rounded-xl bg-white text-slate-500 font-bold hover:bg-cyan-600 hover:text-white transition">
                        <i class="fa-solid fa-angle-left"></i>
                    </button>

                    <button class="w-10 h-10 rounded-xl bg-cyan-600 text-white font-black">
                        1
                    </button>

                    <button
                        class="w-10 h-10 rounded-xl bg-white text-slate-500 font-bold hover:bg-cyan-600 hover:text-white transition">
                        2
                    </button>

                    <button
                        class="w-10 h-10 rounded-xl bg-white text-slate-500 font-bold hover:bg-cyan-600 hover:text-white transition">
                        3
                    </button>

                    <button
                        class="w-10 h-10 rounded-xl bg-white text-slate-500 font-bold hover:bg-cyan-600 hover:text-white transition">
                        <i class="fa-solid fa-angle-right"></i>
                    </button>
                </div>
            </div>

        </section>

    </div>
</main>

@endsection