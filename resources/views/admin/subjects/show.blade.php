@extends('layouts.admin')

@section('title', 'Chi tiết môn học')
@section('page-title', 'Chi tiết môn học')

@section('content')

<div class="max-w-7xl mx-auto px-2 lg:px-4">

    <section
        class="relative overflow-hidden rounded-[40px] bg-gradient-to-br from-cyan-600 via-cyan-500 to-sky-500 text-white p-8 lg:p-10 mb-10 shadow-2xl shadow-cyan-200">

        <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

            <div class="flex items-start gap-6">
                <div
                    class="w-24 h-24 rounded-[28px] bg-white/15 backdrop-blur-xl border border-white/20 flex items-center justify-center shadow-2xl">
                    <i class="fa-solid fa-book-open text-4xl"></i>
                </div>

                <div>
                    <span
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 text-cyan-50 text-xs font-black uppercase tracking-[0.18em] mb-5">
                        <i class="fa-solid fa-graduation-cap"></i>
                        Subject Detail
                    </span>

                    <h1 class="text-4xl md:text-5xl font-black leading-tight">
                        {{ $subject->subject_name }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-3 mt-5">
                        <span class="px-4 py-2 rounded-2xl bg-white/15 border border-white/20 text-sm font-black">
                            {{ $subject->subject_code }}
                        </span>

                        @if($subject->is_active)
                        <span
                            class="px-4 py-2 rounded-2xl bg-emerald-400/20 border border-emerald-300/20 text-sm font-black text-emerald-50">
                            Đang hoạt động
                        </span>
                        @else
                        <span
                            class="px-4 py-2 rounded-2xl bg-red-400/20 border border-red-300/20 text-sm font-black text-red-50">
                            Ngừng hoạt động
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.subjects.edit', $subject->subject_code) }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-white text-cyan-700 font-black hover:bg-cyan-50 transition shadow-xl">
                    <i class="fa-solid fa-pen"></i>
                    Chỉnh sửa
                </a>

                <a href="{{ route('admin.subjects.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-white/15 border border-white/20 text-white font-black hover:bg-white/25 transition">
                    <i class="fa-solid fa-arrow-left"></i>
                    Quay lại
                </a>
            </div>

        </div>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white rounded-[34px] border border-cyan-100 p-7 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-xs font-black uppercase tracking-[0.18em]">Tài liệu</p>
                    <h3 class="text-5xl font-black text-slate-900 mt-3">
                        {{ $subject->documents->count() }}
                    </h3>
                </div>

                <div class="w-16 h-16 rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                    <i class="fa-solid fa-file-lines text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[34px] border border-cyan-100 p-7 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-xs font-black uppercase tracking-[0.18em]">Giảng viên</p>
                    <h3 class="text-5xl font-black text-slate-900 mt-3">
                        {{ $subject->lecturers->count() }}
                    </h3>
                </div>

                <div class="w-16 h-16 rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                    <i class="fa-solid fa-chalkboard-user text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[34px] border border-cyan-100 p-7 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-xs font-black uppercase tracking-[0.18em]">Slug</p>
                    <h3 class="text-2xl font-black text-slate-900 mt-3 break-all">
                        {{ $subject->slug }}
                    </h3>
                </div>

                <div class="w-16 h-16 rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                    <i class="fa-solid fa-link text-2xl"></i>
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        <div class="xl:col-span-2 space-y-8">

            <div
                class="bg-white rounded-[36px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] overflow-hidden">
                <div class="px-7 py-6 border-b border-cyan-100">
                    <h2 class="text-3xl font-black text-cyan-950">Mô tả môn học</h2>
                    <p class="text-slate-500 text-sm font-semibold mt-2">Thông tin tổng quan về môn học.</p>
                </div>

                <div class="p-7">
                    <p class="text-slate-600 leading-8 font-medium">
                        {{ $subject->description ?: 'Chưa có mô tả cho môn học này.' }}
                    </p>
                </div>
            </div>

            <div
                class="bg-white rounded-[36px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] overflow-hidden">

                <div
                    class="px-7 py-6 border-b border-cyan-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h2 class="text-3xl font-black text-cyan-950">Tài liệu môn học</h2>
                        <p class="text-slate-500 text-sm font-semibold mt-2">Danh sách học liệu thuộc môn học này.</p>
                    </div>

                    <span
                        class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black border border-cyan-100">
                        {{ $subject->documents->count() }} tài liệu
                    </span>
                </div>

                <div class="divide-y divide-cyan-100">

                    @forelse($subject->documents as $document)
                    <div class="p-6 flex items-center justify-between gap-5 hover:bg-cyan-50/50 transition">
                        <div class="flex items-center gap-5">
                            <div
                                class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center border border-cyan-100">
                                <i class="fa-solid fa-file-lines text-xl"></i>
                            </div>

                            <div>
                                <h3 class="font-black text-slate-900">
                                    {{ $document->title }}
                                </h3>

                                <div class="flex flex-wrap items-center gap-3 mt-2">
                                    <span
                                        class="text-xs font-black text-cyan-700 bg-cyan-50 border border-cyan-100 rounded-full px-3 py-1 uppercase">
                                        {{ $document->file_extension }}
                                    </span>

                                    <span class="text-xs font-semibold text-slate-400">
                                        {{ number_format($document->download_count) }} lượt tải
                                    </span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('documents.show', $document->document_id) }}"
                            class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 hover:bg-cyan-500 hover:text-white flex items-center justify-center transition"
                            title="Xem tài liệu">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </div>
                    @empty
                    <div class="p-12 text-center">
                        <div
                            class="w-20 h-20 mx-auto rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-5">
                            <i class="fa-solid fa-file-circle-xmark text-3xl"></i>
                        </div>

                        <h3 class="text-2xl font-black text-slate-900">Chưa có tài liệu</h3>

                        <p class="text-slate-500 font-semibold mt-2">
                            Môn học này hiện chưa có học liệu nào.
                        </p>
                    </div>
                    @endforelse

                </div>
            </div>

        </div>

        <div class="space-y-8">

            <div
                class="bg-white rounded-[36px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] overflow-hidden">
                <div class="px-7 py-6 border-b border-cyan-100">
                    <h2 class="text-2xl font-black text-cyan-950">Giảng viên phụ trách</h2>
                    <p class="text-slate-500 text-sm font-semibold mt-2">Danh sách giảng viên được phân công.</p>
                </div>

                <div class="p-6 space-y-4">
                    @forelse($subject->lecturers as $teacher)
                    <div class="flex items-center gap-4 p-4 rounded-3xl bg-cyan-50 border border-cyan-100">
                        <img src="{{ $teacher->avatar ? asset('storage/' . $teacher->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->full_name) . '&background=06b6d4&color=fff' }}"
                            class="w-14 h-14 rounded-2xl object-cover">

                        <div>
                            <h3 class="font-black text-slate-900">
                                {{ $teacher->full_name }}
                            </h3>

                            <p class="text-sm text-slate-500 font-semibold">
                                {{ $teacher->email }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="rounded-3xl bg-amber-50 border border-amber-100 p-5 text-amber-600 font-bold text-sm">
                        <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                        Chưa có giảng viên phụ trách.
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-[36px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-7">
                <h2 class="text-2xl font-black text-cyan-950 mb-6">Thao tác nhanh</h2>

                <div class="space-y-4">
                    <a href="{{ route('admin.subjects.edit', $subject->subject_code) }}"
                        class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-cyan-500 text-white font-black hover:bg-cyan-600 transition shadow-lg shadow-cyan-200">
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