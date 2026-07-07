@extends('layouts.admin')

@section('title', 'Chi tiết khoa')
@section('page-title', 'Chi tiết khoa')

@section('content')
<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <!-- LEFT -->
            <div class="flex items-center gap-5">

                <div class="w-16 h-16 rounded-2xl
                    bg-slate-900
                    text-white
                    flex items-center justify-center
                    shadow-sm">

                    <i class="fa-solid fa-building-columns text-2xl"></i>

                </div>

                <div>

                    <h2 class="text-2xl font-extrabold text-slate-900">

                        {{ $faculty->faculty_name }}

                    </h2>

                    <p class="mt-2 text-sm font-medium text-slate-500">

                        Mã khoa:
                        <span class="font-bold text-amber-600">

                            {{ $faculty->faculty_code }}

                        </span>

                    </p>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="flex flex-wrap items-center gap-3">

                <a href="{{ route('admin.faculties.edit', $faculty->faculty_id) }}" class="inline-flex items-center gap-2
                    h-11
                    px-5
                    rounded-xl
                    bg-slate-900
                    text-white
                    text-sm
                    font-semibold
                    hover:bg-amber-500
                    transition-all duration-300">

                    <i class="fa-solid fa-pen"></i>

                    <span>Chỉnh sửa</span>

                </a>

                <a href="{{ urldecode(request('return', route('admin.faculties.index'))) }}" class="inline-flex items-center gap-2
                    h-11
                    px-5
                    rounded-xl
                    border border-slate-200
                    bg-white
                    text-slate-700
                    text-sm
                    font-semibold
                    hover:bg-slate-100
                    transition-all duration-300">

                    <i class="fa-solid fa-arrow-left"></i>

                    <span>Quay lại</span>

                </a>

            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- LEFT -->
        <div class="xl:col-span-2 space-y-6">
            <!-- INFORMATION -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <!-- CARD HEADER -->
                <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

                    <h3 class="text-lg font-bold text-slate-800">

                        Thông tin khoa

                    </h3>

                    <p class="mt-1 text-sm font-medium text-slate-500">

                        Thông tin chi tiết của khoa trong hệ thống.

                    </p>

                </div>

                <!-- CONTENT -->
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- Mã khoa -->
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">

                            Mã khoa

                        </p>

                        <h4 class="mt-3 text-lg font-bold text-slate-800">

                            {{ $faculty->faculty_code }}

                        </h4>

                    </div>

                    <!-- Tên khoa -->
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">

                            Tên khoa

                        </p>

                        <h4 class="mt-3 text-lg font-bold text-slate-800">

                            {{ $faculty->faculty_name }}

                        </h4>

                    </div>

                    <!-- Trạng thái -->
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">

                            Trạng thái

                        </p>

                        @if($faculty->is_active)

                        <span class="inline-flex items-center gap-2
                            mt-3
                            px-4 py-2
                            rounded-full
                            bg-emerald-50
                            text-emerald-600
                            text-sm
                            font-semibold">

                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                            Hoạt động

                        </span>

                        @else

                        <span class="inline-flex items-center gap-2
                            mt-3
                            px-4 py-2
                            rounded-full
                            bg-red-50
                            text-red-600
                            text-sm
                            font-semibold">

                            <span class="w-2 h-2 rounded-full bg-red-500"></span>

                            Đã khóa

                        </span>

                        @endif

                    </div>

                    <!-- Ngày tạo -->
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">

                            Ngày tạo

                        </p>

                        <h4 class="mt-3 text-base font-semibold text-slate-700">

                            {{ $faculty->created_at->format('d/m/Y H:i') }}

                        </h4>

                    </div>

                    <!-- Mô tả -->
                    <div class="md:col-span-2">

                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">

                            Mô tả

                        </p>

                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">

                            @if($faculty->description)

                            <p class="text-slate-700 text-sm leading-7 font-medium">

                                {{ $faculty->description }}

                            </p>

                            @else

                            <p class="italic text-slate-400 font-medium">

                                Chưa có mô tả cho khoa này.

                            </p>

                            @endif

                        </div>

                    </div>

                </div>

            </div>
            <!-- SUBJECTS -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <!-- HEADER -->
                <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

                    <div class="flex items-center justify-between">

                        <div>

                            <h3 class="text-lg font-bold text-slate-800">

                                Danh sách môn học

                            </h3>

                            <p class="mt-1 text-sm font-medium text-slate-500">

                                Các môn học thuộc khoa này.

                            </p>

                        </div>

                        <span class="inline-flex items-center
                            px-3 py-1.5
                            rounded-full
                            bg-amber-50
                            text-amber-600
                            text-sm
                            font-semibold">

                            {{ $faculty->subjects->count() }} môn học

                        </span>

                    </div>

                </div>

                <!-- BODY -->
                <div class="divide-y divide-slate-200">

                    @forelse($faculty->subjects as $subject)

                    <div class="flex items-center justify-between px-6 py-5 hover:bg-slate-50 transition">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-xl
                                bg-slate-900
                                text-white
                                flex items-center justify-center">

                                <i class="fa-solid fa-book-open"></i>

                            </div>

                            <div>

                                <h4 class="text-base font-bold text-slate-800">

                                    {{ $subject->subject_name }}

                                </h4>

                                <p class="mt-1 text-sm font-medium text-slate-500">

                                    {{ $subject->subject_code }}

                                </p>

                            </div>

                        </div>

                        <div class="text-right">

                            <span class="inline-flex items-center
                                px-3 py-1.5
                                rounded-full
                                bg-slate-100
                                text-slate-700
                                text-sm
                                font-semibold">

                                {{ $subject->documents_count ?? 0 }} tài liệu

                            </span>

                        </div>

                    </div>

                    @empty

                    <div class="py-16 text-center">

                        <div class="w-16 h-16 mx-auto rounded-2xl
                            bg-slate-100
                            text-slate-400
                            flex items-center justify-center">

                            <i class="fa-solid fa-book-open text-2xl"></i>

                        </div>

                        <h4 class="mt-5 text-lg font-bold text-slate-700">

                            Chưa có môn học

                        </h4>

                        <p class="mt-2 text-sm font-medium text-slate-500">

                            Khoa này hiện chưa được gán môn học nào.

                        </p>

                    </div>

                    @endforelse

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="space-y-6">
            <!-- RIGHT -->
            <div class="space-y-6">

                <!-- STATISTICS -->
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                    <!-- HEADER -->
                    <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

                        <h3 class="text-lg font-bold text-slate-800">

                            Thống kê

                        </h3>

                        <p class="mt-1 text-sm font-medium text-slate-500">

                            Tổng quan dữ liệu của khoa.

                        </p>

                    </div>

                    <!-- CONTENT -->
                    <div class="p-6 space-y-5">

                        <!-- SUBJECT -->
                        <div class="flex items-center justify-between">

                            <div class="flex items-center gap-3">

                                <div class="w-11 h-11 rounded-xl
                                bg-slate-900
                                text-white
                                flex items-center justify-center">

                                    <i class="fa-solid fa-book-open"></i>

                                </div>

                                <div>

                                    <p class="text-sm font-medium text-slate-500">

                                        Môn học

                                    </p>

                                    <h4 class="text-lg font-bold text-slate-800">

                                        {{ number_format($faculty->subjects_count) }}

                                    </h4>

                                </div>

                            </div>

                        </div>

                        <!-- DOCUMENT -->
                        <div class="flex items-center justify-between">

                            <div class="flex items-center gap-3">

                                <div class="w-11 h-11 rounded-xl
                                bg-amber-100
                                text-amber-600
                                flex items-center justify-center">

                                    <i class="fa-solid fa-file-lines"></i>

                                </div>

                                <div>

                                    <p class="text-sm font-medium text-slate-500">

                                        Tài liệu

                                    </p>

                                    <h4 class="text-lg font-bold text-slate-800">

                                        {{ number_format($faculty->documents_count ?? 0) }}

                                    </h4>

                                </div>

                            </div>

                        </div>

                        <!-- LECTURER -->
                        <div class="flex items-center justify-between">

                            <div class="flex items-center gap-3">

                                <div class="w-11 h-11 rounded-xl
                                bg-emerald-100
                                text-emerald-600
                                flex items-center justify-center">

                                    <i class="fa-solid fa-user-tie"></i>

                                </div>

                                <div>

                                    <p class="text-sm font-medium text-slate-500">

                                        Giảng viên

                                    </p>

                                    <h4 class="text-lg font-bold text-slate-800">

                                        {{ number_format($faculty->lecturers_count ?? 0) }}

                                    </h4>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- STATUS -->
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

                        <h3 class="text-lg font-bold text-slate-800">

                            Trạng thái

                        </h3>

                    </div>

                    <div class="p-6">

                        @if($faculty->is_active)

                        <div class="flex items-center gap-3
                        rounded-xl
                        bg-emerald-50
                        border border-emerald-100
                        px-4 py-4">

                            <div class="w-10 h-10 rounded-xl
                            bg-emerald-500
                            text-white
                            flex items-center justify-center">

                                <i class="fa-solid fa-circle-check"></i>

                            </div>

                            <div>

                                <p class="text-sm font-semibold text-slate-700">

                                    Khoa đang hoạt động

                                </p>

                                <p class="text-xs text-slate-500 mt-1">

                                    Có thể quản lý môn học và tài liệu.

                                </p>

                            </div>

                        </div>

                        @else

                        <div class="flex items-center gap-3
                        rounded-xl
                        bg-red-50
                        border border-red-100
                        px-4 py-4">

                            <div class="w-10 h-10 rounded-xl
                            bg-red-500
                            text-white
                            flex items-center justify-center">

                                <i class="fa-solid fa-lock"></i>

                            </div>

                            <div>

                                <p class="text-sm font-semibold text-slate-700">

                                    Khoa đã bị khóa

                                </p>

                                <p class="text-xs text-slate-500 mt-1">

                                    Không thể thêm hoặc quản lý dữ liệu.

                                </p>

                            </div>

                        </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>









    @endsection