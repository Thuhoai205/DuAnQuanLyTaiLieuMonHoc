@extends('layouts.admin')

@section('title', 'Chi tiết môn học')
@section('page-title', 'Chi tiết môn học')

@section('content')

@php
$totalDocuments = $subject->documents?->count() ?? 0;
$totalLecturers = $subject->lecturers?->count() ?? 0;
@endphp

<div class="max-w-7xl mx-auto px-2 lg:px-4">

    <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="text-3xl font-black text-slate-900">
                Chi tiết môn học
            </h1>

            <p class="text-slate-500 font-semibold mt-2">
                Xem thông tin môn học, giảng viên phụ trách và tài liệu liên quan.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.subjects.edit', $subject->subject_code) }}"
                class="group inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-cyan-600 text-white font-black shadow-lg shadow-cyan-100 hover:bg-cyan-700 hover:-translate-y-0.5 transition-all">
                <span class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-pen"></i>
                </span>
                Chỉnh sửa
            </a>

            <button onclick="history.back()"
                class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-white border border-slate-200 text-slate-700 font-black shadow-sm hover:bg-slate-50 transition">
                <span class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">
                    <i class="fa-solid fa-arrow-left"></i>
                </span>
                Quay lại
            </button>
        </div>
    </div>

    <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-cyan-600 to-sky-500 px-8 py-8 text-white">
            <div class="flex flex-col md:flex-row md:items-center gap-6">
                <div
                    class="w-28 h-28 rounded-[30px] bg-white/20 border border-white/30 flex items-center justify-center shadow-xl">
                    <i class="fa-solid fa-book-open text-5xl"></i>
                </div>

                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        <span
                            class="px-4 py-2 rounded-full bg-white/20 text-white text-xs font-black border border-white/20">
                            {{ $subject->subject_code }}
                        </span>

                        @if($subject->is_active)
                        <span
                            class="px-4 py-2 rounded-full bg-emerald-400/20 text-emerald-50 text-xs font-black border border-emerald-200/20">
                            Hoạt động
                        </span>
                        @else
                        <span
                            class="px-4 py-2 rounded-full bg-red-400/20 text-red-50 text-xs font-black border border-red-200/20">
                            Ngừng hoạt động
                        </span>
                        @endif
                    </div>

                    <h2 class="text-4xl font-black leading-tight">
                        {{ $subject->subject_name }}
                    </h2>

                    <p class="text-cyan-50 font-semibold mt-3 max-w-3xl">
                        {{ $subject->description ?: 'Chưa có mô tả cho môn học này.' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 border-t border-cyan-100">
            <div class="p-6 border-b md:border-b-0 md:border-r border-cyan-100">
                <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">
                    Mã môn học
                </p>
                <h3 class="text-2xl font-black text-cyan-700 mt-2">
                    {{ $subject->subject_code }}
                </h3>
            </div>

            <div class="p-6 border-b md:border-b-0 md:border-r border-cyan-100">
                <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">
                    Slug
                </p>
                <h3 class="text-xl font-black text-slate-900 mt-2 break-all">
                    {{ $subject->slug }}
                </h3>
            </div>

            <div class="p-6">
                <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">
                    Ngày tạo
                </p>
                <h3 class="text-2xl font-black text-slate-900 mt-2">
                    {{ $subject->created_at ? $subject->created_at->format('d/m/Y') : 'Chưa có' }}
                </h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Tài liệu</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">
                {{ number_format($totalDocuments) }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Giảng viên</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">
                {{ number_format($totalLecturers) }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Trạng thái</p>
            <h3 class="text-3xl font-black mt-2 {{ $subject->is_active ? 'text-emerald-600' : 'text-red-500' }}">
                {{ $subject->is_active ? 'Hoạt động' : 'Ngừng' }}
            </h3>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        <div class="xl:col-span-2 space-y-8">

            <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-cyan-100">
                    <h2 class="text-xl font-black text-slate-900">
                        Mô tả môn học
                    </h2>

                    <p class="text-sm text-slate-500 font-semibold mt-1">
                        Thông tin tổng quan về môn học.
                    </p>
                </div>

                <div class="p-6">
                    <div class="rounded-2xl bg-cyan-50 border border-cyan-100 p-5">
                        <p class="text-slate-600 leading-8 font-semibold">
                            {{ $subject->description ?: 'Chưa có mô tả cho môn học này.' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden">
                <div
                    class="px-6 py-5 border-b border-cyan-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-black text-slate-900">
                            Tài liệu môn học
                        </h2>

                        <p class="text-sm text-slate-500 font-semibold mt-1">
                            Danh sách học liệu thuộc môn học này.
                        </p>
                    </div>

                    <span
                        class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black border border-cyan-100">
                        {{ number_format($totalDocuments) }} tài liệu
                    </span>
                </div>

                <div class="divide-y divide-cyan-100">
                    @forelse($subject->documents as $document)
                    <div
                        class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-5 hover:bg-cyan-50/50 transition">
                        <div class="flex items-center gap-4 min-w-0">
                            <div
                                class="w-12 h-12 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center border border-cyan-100 flex-shrink-0">
                                <i class="fa-solid fa-file-lines"></i>
                            </div>

                            <div class="min-w-0">
                                <h3 class="font-black text-slate-900 truncate">
                                    {{ $document->title }}
                                </h3>

                                <div class="flex flex-wrap items-center gap-2 mt-2">
                                    <span
                                        class="px-3 py-1 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black border border-cyan-100 uppercase">
                                        {{ $document->file_extension ?? 'file' }}
                                    </span>

                                    <span
                                        class="px-3 py-1 rounded-full bg-slate-50 text-slate-500 text-xs font-black border border-slate-100">
                                        {{ number_format($document->download_count ?? 0) }} lượt tải
                                    </span>
                                </div>
                            </div>
                        </div>

                        @if(Route::has('documents.show'))
                        <a href="{{ route('documents.show', $document->document_id) }}"
                            class="w-11 h-11 rounded-xl bg-cyan-50 text-cyan-600 hover:bg-cyan-500 hover:text-white flex items-center justify-center transition"
                            title="Xem tài liệu">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        @endif
                    </div>
                    @empty
                    <div class="px-6 py-16 text-center">
                        <div
                            class="w-20 h-20 mx-auto rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-5">
                            <i class="fa-solid fa-file-circle-xmark text-3xl"></i>
                        </div>

                        <h3 class="text-2xl font-black text-slate-900">
                            Chưa có tài liệu
                        </h3>

                        <p class="text-slate-500 font-semibold mt-2">
                            Môn học này hiện chưa có học liệu nào.
                        </p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>

        <div class="space-y-6">

            <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-cyan-100">
                    <h2 class="text-xl font-black text-slate-900">
                        Giảng viên phụ trách
                    </h2>

                    <p class="text-sm text-slate-500 font-semibold mt-1">
                        Danh sách giảng viên được phân công.
                    </p>
                </div>

                <div class="p-6 space-y-4">
                    @forelse($subject->lecturers as $teacher)
                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-cyan-50 border border-cyan-100">
                        <img src="{{ $teacher->avatar ? asset('storage/' . $teacher->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->full_name) . '&background=06b6d4&color=fff' }}"
                            class="w-12 h-12 rounded-2xl object-cover">

                        <div class="min-w-0">
                            <h3 class="font-black text-slate-900 truncate">
                                {{ $teacher->full_name }}
                            </h3>

                            <p class="text-sm text-slate-500 font-semibold truncate">
                                {{ $teacher->email }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="rounded-2xl bg-slate-50 border border-slate-100 p-5 text-slate-600 font-bold text-sm">
                        <i class="fa-solid fa-user-plus mr-2"></i>
                        Chưa phân công giảng viên.
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm p-6">
                <h2 class="text-xl font-black text-slate-900 mb-5">
                    Thao tác nhanh
                </h2>

                <div class="space-y-3">
                    <a href="{{ route('admin.subjects.edit', $subject->subject_code) }}"
                        class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-cyan-600 text-white font-black hover:bg-cyan-700 transition">
                        <i class="fa-solid fa-pen"></i>
                        Chỉnh sửa môn học
                    </a>

                    <form action="{{ route('admin.subjects.destroy', $subject->subject_code) }}" method="POST"
                        onsubmit="return confirm('Bạn có chắc muốn xóa môn học này không?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-red-50 text-red-500 font-black hover:bg-red-500 hover:text-white transition border border-red-100">
                            <i class="fa-solid fa-trash"></i>
                            Xóa môn học
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection