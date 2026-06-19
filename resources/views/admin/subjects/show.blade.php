@extends('layouts.admin')

@section('title', 'Chi tiết môn học')
@section('page-title', 'Chi tiết môn học')

@section('content')

@php
$totalDocuments = $subject->documents_count ?? ($subject->documents?->count() ?? 0);
$totalLecturers = $subject->lecturers?->count() ?? 0;
$isActive = $subject->status === 'active';

$colorMap = [
'blue' => 'sky',
'red' => 'red',
'green' => 'emerald',
'yellow' => 'amber',
'purple' => 'violet',
'cyan' => 'cyan',
'gray' => 'slate',
];

$color = $colorMap[$subject->color] ?? 'sky';
$subjectIcon = $subject->icon ?: 'fa-solid fa-book-open';
@endphp

<div class="min-h-screen bg-slate-50 px-4 lg:px-8 py-6">

    <div class="max-w-7xl mx-auto space-y-6">

        {{-- HEADER --}}
        <div class="bg-white border rounded-xl shadow-sm p-5 flex justify-between items-center">

            <div>
                <h1 class="text-xl font-black text-slate-800">
                    {{ $subject->subject_name }}
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                    Chi tiết môn học trong hệ thống
                </p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.subjects.edit', $subject->subject_code) }}"
                    class="px-4 py-2 rounded-lg bg-amber-50 text-amber-600 font-black text-sm hover:bg-amber-500 hover:text-white transition">
                    <i class="fa-solid fa-pen mr-1"></i> Chỉnh sửa
                </a>

                <a href="{{ url()->previous() }}"
                    class="px-4 py-2 rounded-md bg-white border border-slate-200 text-slate-600 text-sm font-black hover:bg-slate-100 transition">
                    <i class="fa-solid fa-arrow-left mr-1"></i>
                    Quay lại
                </a>
            </div>

        </div>

        {{-- TOP STATS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            <div class="bg-white rounded-xl border p-5 shadow-sm">
                <p class="text-xs text-slate-400 font-bold uppercase">Tài liệu</p>
                <p class="text-3xl font-black mt-2">{{ $totalDocuments }}</p>
            </div>

            <div class="bg-white rounded-xl border p-5 shadow-sm">
                <p class="text-xs text-slate-400 font-bold uppercase">Giảng viên</p>
                <p class="text-3xl font-black mt-2">{{ $totalLecturers }}</p>
            </div>

            <div class="bg-white rounded-xl border p-5 shadow-sm">
                <p class="text-xs text-slate-400 font-bold uppercase">Trạng thái</p>
                <p class="mt-2 font-black text-lg {{ $isActive ? 'text-emerald-600' : 'text-red-500' }}">
                    {{ $isActive ? 'Hoạt động' : 'Ẩn' }}
                </p>
            </div>

        </div>

        {{-- MAIN CONTENT --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT --}}
            <div class="lg:col-span-1 space-y-6">

                {{-- SUBJECT CARD --}}
                <div class="bg-white border rounded-xl shadow-sm p-6 text-center">

                    <div class="w-16 h-16 mx-auto rounded-xl flex items-center justify-center
                        bg-{{ $color }}-50 text-{{ $color }}-600">

                        <i class="{{ $subjectIcon }} text-xl"></i>
                    </div>

                    <h2 class="mt-4 font-black text-lg text-slate-800">
                        {{ $subject->subject_code }}
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        {{ $subject->faculty->faculty_name ?? 'Chưa có khoa' }}
                    </p>

                    <div class="mt-4">
                        <span class="px-3 py-1 rounded-full text-xs font-black
                            {{ $isActive ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-500' }}">
                            {{ $isActive ? 'Hoạt động' : 'Ẩn' }}
                        </span>
                    </div>

                </div>

                {{-- DESCRIPTION --}}
                <div class="bg-white border rounded-xl shadow-sm p-6">
                    <h3 class="font-black text-slate-700 mb-3">Mô tả</h3>
                    <p class="text-sm text-slate-600 leading-6">
                        {{ $subject->description ?? 'Chưa có mô tả' }}
                    </p>
                </div>

            </div>

            {{-- RIGHT --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- LECTURERS --}}
                <div class="bg-white border rounded-xl shadow-sm p-6">

                    <h3 class="font-black text-slate-700 mb-4">
                        Giảng viên phụ trách
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        @forelse($subject->lecturers as $teacher)

                        <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-xl border">

                            <img src="{{ $teacher->avatar ? asset('storage/'.$teacher->avatar) : 'https://ui-avatars.com/api/?name='.$teacher->full_name }}"
                                class="w-10 h-10 rounded-lg object-cover">

                            <div>
                                <p class="font-black text-slate-800">
                                    {{ $teacher->full_name }}
                                </p>
                                <p class="text-xs text-slate-500">
                                    {{ $teacher->email }}
                                </p>
                            </div>

                        </div>

                        @empty
                        <p class="text-sm text-slate-500 col-span-2">
                            Chưa có giảng viên
                        </p>
                        @endforelse

                    </div>

                </div>

                {{-- INFO CARD --}}
                <div class="bg-white border rounded-xl shadow-sm p-6">

                    <h3 class="font-black text-slate-700 mb-3">
                        Thông tin môn học
                    </h3>

                    <div class="text-sm text-slate-600 space-y-2">
                        <p><b>Mã môn:</b> {{ $subject->subject_code }}</p>
                        <p><b>Khoa:</b> {{ $subject->faculty->faculty_name ?? '---' }}</p>
                        <p><b>Trạng thái:</b> {{ $subject->status }}</p>
                    </div>

                </div>
                {{-- DOCUMENT PREVIEW --}}
                <div class="bg-white border rounded-xl shadow-sm p-6">

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-black text-slate-700">
                            Tài liệu gần đây
                        </h3>

                        <a href="#" class="text-sm font-black text-sky-600 hover:underline">
                            Xem tất cả
                        </a>
                    </div>

                    <div class="space-y-2">

                        @forelse($subject->documents->take(5) as $doc)

                        <div class="p-3 bg-slate-50 rounded-lg border">

                            <p class="font-semibold text-slate-800">
                                {{ $doc->title }}
                            </p>

                            {{-- DATE --}}
                            <p class="text-xs text-slate-500">
                                {{ $doc->created_at->format('d/m/Y') }}
                            </p>

                            {{-- ⭐ ADD LECTURER --}}
                            <p class="text-xs text-slate-400 mt-1">
                                👨‍🏫 {{ $doc->uploader->full_name ?? 'Không rõ giảng viên' }} </p>

                        </div>

                        @empty
                        <p class="text-sm text-slate-500">
                            Chưa có tài liệu
                        </p>
                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection