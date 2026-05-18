@extends('layouts.app')

@section('title', 'Tài liệu mới cập nhật')

@section('content')

@php

$documents = [
[
'type' => 'PDF',
'title' => 'Giáo trình Java cơ bản',
'subject' => 'Java',
'author' => 'Nguyễn Văn A',
'date' => '12/05/2026',
'downloads' => 120,
'icon' => 'fa-file-pdf',
'color' => 'text-red-500 bg-red-50 border-red-100',
'button' => 'bg-red-500 hover:bg-red-600'
],
[
'type' => 'DOC',
'title' => 'Bài tập SQL nâng cao',
'subject' => 'SQL',
'author' => 'Trần Văn B',
'date' => '11/05/2026',
'downloads' => 95,
'icon' => 'fa-file-word',
'color' => 'text-blue-500 bg-blue-50 border-blue-100',
'button' => 'bg-blue-500 hover:bg-blue-600'
],
[
'type' => 'PPT',
'title' => 'Thiết kế UI/UX cơ bản',
'subject' => 'UI/UX',
'author' => 'Lê Văn C',
'date' => '10/05/2026',
'downloads' => 70,
'icon' => 'fa-file-powerpoint',
'color' => 'text-amber-500 bg-amber-50 border-amber-100',
'button' => 'bg-amber-500 hover:bg-amber-600'
]

];

@endphp

<!-- BACKGROUND -->
<div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">

    <div
        class="absolute top-[-5%] right-[-10%] w-[600px] h-[600px] rounded-full bg-blue-500/5 blur-[130px] animate-[pulse_7s_infinite]">
    </div>

    <div
        class="absolute bottom-[15%] left-[-5%] w-[500px] h-[500px] rounded-full bg-cyan-500/5 blur-[120px] animate-[pulse_9s_infinite]">
    </div>

</div>

<!-- MAIN -->
<main class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-12">

    <!-- HEADER -->
    <div class="mb-12">

        <a href="javascript:history.back()"
            class="group inline-flex items-center gap-3 text-slate-700 hover:text-blue-600 transition-all duration-300 font-black text-2xl">

            <div
                class="w-11 h-11 rounded-full bg-white border border-slate-200 flex items-center justify-center shadow-sm group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">

                <i class="fas fa-arrow-left text-sm"></i>

            </div>

            <span>Tài liệu mới cập nhật</span>

        </a>

    </div>

    <!-- SEARCH -->
    <div class="mb-8">

        <div
            class="bg-white/95 backdrop-blur-xl rounded-[2rem] border border-slate-100 shadow-[0_15px_50px_-15px_rgba(0,0,0,0.05)] p-3">

            <div class="relative">

                <i class="fas fa-search absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 text-sm">
                </i>

                <input type="text" placeholder="Tìm kiếm tài liệu................................"
                    class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-14 pr-5 py-4 text-sm font-semibold outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all">

            </div>

        </div>

    </div>

    <!-- FILTER -->
    <div
        class="bg-white border border-slate-100 rounded-[2rem] p-6 lg:p-8 shadow-[0_15px_50px_-15px_rgba(0,0,0,0.05)] mb-10">

        <div class="flex items-center gap-3 mb-8">

            <div
                class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white shadow-lg shadow-blue-200">

                <i class="fas fa-filter text-sm"></i>

            </div>

            <h3 class="text-2xl font-black text-slate-800">
                Bộ lọc
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- SUBJECT -->
            <div>

                <label class="block text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-3">
                    Môn học
                </label>

                <select
                    class="w-full px-5 py-3.5 rounded-2xl border border-slate-200 bg-slate-50 font-bold text-sm outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all">

                    <option>Tất cả</option>
                    <option>Java</option>
                    <option>SQL</option>
                    <option>UI/UX</option>

                </select>

            </div>

            <!-- TYPE -->
            <div>

                <label class="block text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-3">
                    Loại tài liệu
                </label>

                <select
                    class="w-full px-5 py-3.5 rounded-2xl border border-slate-200 bg-slate-50 font-bold text-sm outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all">

                    <option>Tất cả</option>
                    <option>PDF</option>
                    <option>DOC</option>
                    <option>PPT</option>

                </select>

            </div>

            <!-- SORT -->
            <div>

                <label class="block text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-3">
                    Sắp xếp
                </label>

                <select
                    class="w-full px-5 py-3.5 rounded-2xl border border-slate-200 bg-slate-50 font-bold text-sm outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all">

                    <option>Mới nhất</option>
                    <option>Tải nhiều nhất</option>

                </select>

            </div>

        </div>

    </div>

    <!-- DOCUMENT LIST -->
    <div class="space-y-7">

        @foreach($documents as $doc)

        <div
            class="group bg-white border border-slate-100 rounded-[2rem] p-6 lg:p-8 shadow-[0_12px_40px_-15px_rgba(0,0,0,0.04)] hover:shadow-[0_25px_60px_-15px_rgba(59,130,246,0.12)] hover:-translate-y-1 transition-all duration-500">

            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8">

                <!-- LEFT -->
                <div class="flex items-start gap-5 flex-1 min-w-0">

                    <!-- FILE ICON -->
                    <div
                        class="w-16 h-16 rounded-2xl border flex flex-col items-center justify-center shrink-0 transition-all duration-300 group-hover:scale-105 {{ $doc['color'] }}">

                        <i class="fas {{ $doc['icon'] }} text-2xl"></i>

                        <span class="text-[10px] font-black mt-1 uppercase">
                            {{ $doc['type'] }}
                        </span>

                    </div>

                    <!-- CONTENT -->
                    <div class="flex-1 min-w-0">

                        <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400 mb-3">
                            {{ $doc['type'] }}
                        </p>

                        <h2
                            class="text-xl lg:text-2xl font-black text-slate-800 mb-4 group-hover:text-blue-600 transition-colors duration-300 truncate">

                            {{ $doc['title'] }}

                        </h2>

                        <div class="flex flex-wrap items-center gap-3 text-sm text-slate-500 font-semibold mb-4">

                            <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-bold">
                                {{ $doc['subject'] }}
                            </span>

                            <span class="text-slate-300">•</span>

                            <span>{{ $doc['author'] }}</span>

                            <span class="text-slate-300">•</span>

                            <span>{{ $doc['date'] }}</span>

                        </div>

                        <div class="flex items-center gap-2 text-sm font-bold text-slate-600">

                            <i class="fas fa-download text-slate-400"></i>

                            <span>{{ $doc['downloads'] }} lượt tải</span>

                        </div>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="flex justify-end">

                    <button
                        class="px-7 py-3.5 text-white rounded-2xl font-black text-sm transition-all duration-300 active:scale-95 shadow-lg hover:shadow-xl {{ $doc['button'] }}">

                        <i class="fas fa-eye mr-2"></i>
                        Xem chi tiết

                    </button>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    <!-- LOAD MORE -->
    <div class="text-center mt-14">

        <button
            class="px-9 py-4 bg-slate-900 hover:bg-blue-600 text-white rounded-2xl font-black text-sm shadow-xl transition-all duration-300 hover:shadow-blue-200 hover:-translate-y-0.5 active:scale-95">

            <i class="fas fa-plus-circle mr-2"></i>
            Tải thêm

        </button>

    </div>

</main>

@endsection