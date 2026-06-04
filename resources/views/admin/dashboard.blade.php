@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('page-title', 'Tổng quan hệ thống')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HERO -->
    <section
        class="relative overflow-hidden rounded-[40px] bg-[#0891B2] text-white p-8 lg:p-10 mb-10 shadow-2xl shadow-cyan-200">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-cyan-300/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-sky-300/20 rounded-full blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
            <div>
                <span
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-cyan-700/60 border border-cyan-300/30 text-cyan-50 text-sm font-bold mb-6">
                    <i class="fa-solid fa-chart-line"></i>
                    Admin Dashboard
                </span>

                <h1 class="text-4xl md:text-5xl font-black leading-tight mb-4">
                    Tổng quan hệ thống
                </h1>

                <p class="text-cyan-50/90 text-lg leading-relaxed max-w-2xl">
                    Theo dõi người dùng, môn học, tài liệu và hoạt động mới nhất trong hệ thống EDU DOC.
                </p>
            </div>

            <div class="bg-cyan-700/50 border border-cyan-300/20 rounded-[28px] p-6 min-w-[220px]">
                <p class="text-cyan-100 text-sm font-bold">Trạng thái</p>
                <h3 class="text-3xl font-black mt-2">Đang hoạt động</h3>
                <p class="text-cyan-100 text-sm mt-2">Cập nhật hôm nay</p>
            </div>
        </div>
    </section>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

        <div class="bg-white rounded-[32px] p-7 border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">Người dùng</p>
                    <h3 class="text-5xl font-black text-cyan-950 mt-4">1,240</h3>
                </div>
                <div class="w-16 h-16 rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                    <i class="fa-solid fa-users text-2xl"></i>
                </div>
            </div>
            <p class="mt-5 text-sm font-bold text-cyan-600">
                <i class="fa-solid fa-arrow-trend-up mr-1"></i>
                +12 người dùng mới
            </p>
        </div>

        <div class="bg-white rounded-[32px] p-7 border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">Môn học</p>
                    <h3 class="text-5xl font-black text-cyan-950 mt-4">45</h3>
                </div>
                <div class="w-16 h-16 rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                    <i class="fa-solid fa-graduation-cap text-2xl"></i>
                </div>
            </div>
            <p class="mt-5 text-sm font-bold text-cyan-600">
                <i class="fa-solid fa-book-open mr-1"></i>
                Đang hoạt động
            </p>
        </div>

        <div class="bg-white rounded-[32px] p-7 border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">Tài liệu</p>
                    <h3 class="text-5xl font-black text-cyan-950 mt-4">856</h3>
                </div>
                <div class="w-16 h-16 rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                    <i class="fa-solid fa-file-lines text-2xl"></i>
                </div>
            </div>
            <p class="mt-5 text-sm font-bold text-cyan-600">
                <i class="fa-solid fa-cloud-arrow-up mr-1"></i>
                +24 tài liệu mới
            </p>
        </div>

        <div class="bg-white rounded-[32px] p-7 border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">Lượt tải</p>
                    <h3 class="text-5xl font-black text-cyan-950 mt-4">3,521</h3>
                </div>
                <div class="w-16 h-16 rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                    <i class="fa-solid fa-download text-2xl"></i>
                </div>
            </div>
            <p class="mt-5 text-sm font-bold text-cyan-600">
                <i class="fa-solid fa-chart-line mr-1"></i>
                Tăng trưởng ổn định
            </p>
        </div>

    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        <!-- CHART -->
        <div
            class="xl:col-span-2 bg-white rounded-[36px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-8">
            <div class="flex items-center justify-between mb-7">
                <div>
                    <h3 class="text-3xl font-black text-cyan-950">
                        Thống kê hệ thống
                    </h3>
                    <p class="text-slate-500 text-sm font-semibold mt-2">
                        Tổng quan hoạt động trong tháng
                    </p>
                </div>

                <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black border border-cyan-100">
                    Tháng này
                </span>
            </div>

            <div class="h-80 rounded-[30px] bg-cyan-50 border border-cyan-100 flex items-center justify-center">
                <div class="text-center">
                    <div
                        class="w-20 h-20 mx-auto rounded-3xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200 mb-4">
                        <i class="fa-solid fa-chart-column text-3xl"></i>
                    </div>
                    <p class="text-slate-600 font-bold">
                        Khu vực biểu đồ Chart.js
                    </p>
                </div>
            </div>
        </div>

        <!-- ACTIVITY -->
        <div class="bg-white rounded-[36px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-8">
            <h3 class="text-3xl font-black text-cyan-950 mb-7">
                Hoạt động gần đây
            </h3>

            <div class="space-y-6">
                <div class="flex gap-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-file-arrow-up"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-800">Giảng viên đăng tài liệu mới</h4>
                        <p class="text-sm text-slate-500 font-semibold mt-1">Slide HTML CSS • 5 phút trước</p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-800">Người dùng mới đăng ký</h4>
                        <p class="text-sm text-slate-500 font-semibold mt-1">Sinh viên Nguyễn Văn A • 20 phút trước</p>
                    </div>
                </div>

                <div class="flex gap-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-download"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-800">Tài liệu được tải nhiều</h4>
                        <p class="text-sm text-slate-500 font-semibold mt-1">Đề thi Java • 120 lượt tải</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection