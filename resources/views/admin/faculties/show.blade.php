@extends('layouts.admin')

@section('title', 'Chi tiết khoa')
@section('page-title', 'Chi tiết khoa')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm p-6">

        <div class="flex items-center justify-between">

            <div class="flex items-center gap-5">



                <div>

                    <h2 class="text-xl font-black text-slate-800">

                        {{ $faculty->faculty_name }}

                    </h2>

                    <p class="text-sm text-slate-500 mt-1">

                        Mã khoa:
                        <span class="font-bold">
                            {{ $faculty->faculty_code }}
                        </span>

                    </p>

                </div>

            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.faculties.edit', $faculty->faculty_id) }}"
                    class="px-4 py-2 rounded-lg bg-amber-50 text-amber-600 font-black text-sm hover:bg-amber-500 hover:text-white transition">
                    <i class="fa-solid fa-pen mr-1"></i> Chỉnh sửa
                </a>

                <a href="{{ route('admin.faculties.index')}}"
                    class="px-4 py-2 rounded-md bg-white border border-slate-200 text-slate-600 text-sm font-black hover:bg-slate-100 transition">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Quay lại
                </a>
            </div>


        </div>

    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT -->
        <div class="lg:col-span-2 space-y-6">

            <!-- INFORMATION -->
            <div class="bg-white border border-slate-200 rounded-md shadow-sm">

                <div class="px-5 py-4 border-b">

                    <h3 class="font-black">

                        Thông tin khoa

                    </h3>

                </div>

                <div class="p-6 grid grid-cols-2 gap-6">

                    <div>
                        <p class="text-xs uppercase text-slate-400 font-bold">
                            Mã khoa
                        </p>

                        <p class="mt-2 font-bold">
                            {{ $faculty->faculty_code }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-slate-400 font-bold">
                            Tên khoa
                        </p>

                        <p class="mt-2 font-bold">
                            {{ $faculty->faculty_name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase text-slate-400 font-bold">
                            Trạng thái
                        </p>

                        @if($faculty->is_active)
                        <span class="inline-flex mt-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 font-bold">
                            Hoạt động
                        </span>
                        @else
                        <span class="inline-flex mt-2 px-3 py-1 rounded-full bg-red-50 text-red-600 font-bold">
                            Đã khóa
                        </span>
                        @endif
                    </div>

                    <div>
                        <p class="text-xs uppercase text-slate-400 font-bold">
                            Ngày tạo
                        </p>

                        <p class="mt-2 font-bold">
                            {{ $faculty->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    <!-- MÔ TẢ -->
                    <div class="col-span-2">

                        <p class="text-xs uppercase text-slate-400 font-bold mb-2">
                            Mô tả
                        </p>

                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                            @if($faculty->description)

                            <p class="text-slate-700 leading-7">
                                {{ $faculty->description }}
                            </p>

                            @else

                            <p class="italic text-slate-400">
                                Chưa có mô tả.
                            </p>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

            <!-- SUBJECTS -->
            <div class="bg-white border border-slate-200 rounded-md shadow-sm">

                <div class="px-5 py-4 border-b">

                    <h3 class="font-black">

                        Danh sách môn học

                    </h3>

                </div>

                <div class="divide-y">

                    @forelse($faculty->subjects as $subject)

                    <div class="flex items-center justify-between px-5 py-4">

                        <div>

                            <p class="font-black">

                                {{ $subject->subject_name }}

                            </p>

                            <p class="text-sm text-slate-500">

                                {{ $subject->subject_code }}

                            </p>

                        </div>

                        <span class="text-sm">

                            {{ $subject->documents_count ?? 0 }} tài liệu

                        </span>

                    </div>

                    @empty

                    <div class="py-12 text-center text-slate-500">

                        Chưa có môn học.

                    </div>

                    @endforelse

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="space-y-5">

            <div class="bg-white border border-slate-200 rounded-md shadow-sm p-6">

                <h4 class="font-black mb-5">

                    Thống kê

                </h4>

                <div class="space-y-4">

                    <div class="flex justify-between">

                        <span>Số môn học</span>

                        <span class="font-black">

                            {{ $faculty->subjects_count }}

                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span>Tài liệu</span>

                        <span class="font-black">

                            {{ $faculty->documents_count ?? 0 }}

                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span>Giảng viên</span>

                        <span class="font-black">

                            {{ $faculty->lecturers_count ?? 0 }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection