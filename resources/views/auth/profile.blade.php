@extends('layouts.app')

@section('title', 'Tài liệu mới cập nhật')

@section('content')

@php
use Illuminate\Support\Str;

$subjects = [
['name' => 'Tất cả', 'slug' => 'all'],
['name' => 'Java', 'slug' => 'java'],
['name' => 'SQL', 'slug' => 'sql'],
['name' => 'UI/UX', 'slug' => 'ui-ux'],
['name' => 'Frontend', 'slug' => 'frontend'],
['name' => 'Backend', 'slug' => 'backend']
];

$types = [
['name' => 'Tất cả', 'slug' => 'all'],
['name' => 'PDF', 'slug' => 'pdf'],
['name' => 'DOC', 'slug' => 'doc'],
['name' => 'PPT', 'slug' => 'ppt']
];
@endphp

<!-- Background Effect -->
<div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
    <div
        class="absolute top-[-5%] right-[-10%] w-[600px] h-[600px] rounded-full bg-blue-500/5 blur-[130px] animate-pulse">
    </div>

    <div
        class="absolute bottom-[15%] left-[-5%] w-[500px] h-[500px] rounded-full bg-cyan-500/5 blur-[120px] animate-pulse">
    </div>
</div>

<main class="container mx-auto px-4 md:px-6 py-10 max-w-7xl">

    <!-- Back Button -->
    <div class="mb-10">
        <a href="javascript:history.back()"
            class="group inline-flex items-center gap-2.5 px-6 h-12 bg-white border border-slate-100 text-slate-600 hover:text-orange-500 font-bold text-xs uppercase tracking-wider rounded-full shadow-sm hover:shadow-orange-500/20 hover:-translate-x-1 transition-all duration-300">

            <i class="fas fa-arrow-left text-slate-400 group-hover:text-orange-500 transition-all duration-300"></i>

            <span>Quay lại</span>
        </a>
    </div>

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-6">

        <div class="space-y-1">

            <div class="flex items-center gap-4">

                <div
                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                    <i class="fas fa-clock text-lg"></i>
                </div>

                <div>
                    <h1 class="text-3xl font-black tracking-tight text-slate-900">
                        Tài liệu mới cập nhật
                    </h1>

                    <p class="text-slate-400 font-medium text-sm mt-1">
                        Tổng hợp toàn bộ học liệu mới nhất vừa được đăng tải.
                    </p>
                </div>

            </div>

        </div>

    </div>

    <!-- Filter -->
    <div
        class="bg-white p-5 md:p-6 rounded-[2rem] border border-slate-100 shadow-[0_12px_40px_-15px_rgba(0,0,0,0.03)] mb-8 space-y-5">

        <!-- Search -->
        <div class="relative flex items-center">

            <i class="fas fa-search absolute left-5 text-slate-400 text-sm"></i>

            <input type="text" id="docSearch" onkeyup="filterDocuments()"
                placeholder="Tìm kiếm tài liệu nhanh theo từ khóa..."
                class="w-full pl-12 pr-5 h-14 bg-slate-50 border border-slate-200 rounded-full text-sm font-semibold text-slate-700 focus:outline-none focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 transition-all duration-200">
        </div>

        <!-- Filters -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <!-- Subject -->
            <div class="space-y-2">

                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 pl-2">
                    Môn học
                </label>

                <select id="filterSubject" onchange="filterDocuments()"
                    class="w-full h-12 px-4 bg-white border border-slate-200 rounded-full text-sm font-bold text-slate-700 focus:outline-none focus:ring-4 focus:ring-blue-500/5">

                    @foreach($subjects as $subject)
                    <option value="{{ $subject['slug'] }}">
                        {{ $subject['name'] }}
                    </option>
                    @endforeach

                </select>

            </div>

            <!-- Type -->
            <div class="space-y-2">

                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 pl-2">
                    Loại tài liệu
                </label>

                <select id="filterType" onchange="filterDocuments()"
                    class="w-full h-12 px-4 bg-white border border-slate-200 rounded-full text-sm font-bold text-slate-700 focus:outline-none focus:ring-4 focus:ring-blue-500/5">

                    @foreach($types as $type)
                    <option value="{{ $type['slug'] }}">
                        {{ $type['name'] }}
                    </option>
                    @endforeach

                </select>

            </div>

            <!-- Sort -->
            <div class="space-y-2">

                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 pl-2">
                    Sắp xếp
                </label>

                <select id="filterSort" onchange="sortDocuments()"
                    class="w-full h-12 px-4 bg-white border border-slate-200 rounded-full text-sm font-bold text-slate-700 focus:outline-none focus:ring-4 focus:ring-blue-500/5">

                    <option value="latest">Mới nhất</option>
                    <option value="downloads">Tải nhiều nhất</option>

                </select>

            </div>

        </div>

    </div>

    <!-- Empty State -->
    <div id="emptyState" class="hidden text-center py-20">

        <div class="w-24 h-24 mx-auto rounded-full bg-slate-100 flex items-center justify-center mb-5">
            <i class="fas fa-folder-open text-3xl text-slate-400"></i>
        </div>

        <h3 class="text-xl font-black text-slate-700 mb-2">
            Không tìm thấy tài liệu
        </h3>

        <p class="text-slate-400 font-medium">
            Hãy thử thay đổi từ khóa hoặc bộ lọc tìm kiếm.
        </p>

    </div>

    <!-- Document Grid -->
    <div id="documentGrid" class="space-y-5 mb-10">

        @foreach($taiLieus as $doc)

        @php

        $extension = strtolower($doc->dinh_dang);

        $icon = match($extension) {
        'pdf' => 'fa-file-pdf',
        'doc', 'docx' => 'fa-file-word',
        'ppt', 'pptx' => 'fa-file-powerpoint',
        default => 'fa-file'
        };

        $theme = match($extension) {
        'pdf' => 'from-red-50 to-orange-50/50 text-red-500 shadow-red-100',
        'doc', 'docx' => 'from-blue-50 to-cyan-50/50 text-blue-500 shadow-blue-100',
        'ppt', 'pptx' => 'from-amber-50 to-yellow-50/50 text-amber-600 shadow-amber-100',
        default => 'from-slate-50 to-slate-100 text-slate-500 shadow-slate-100'
        };

        $btn = match($extension) {
        'pdf' => 'bg-red-50 hover:bg-red-100 text-red-600',
        'doc', 'docx' => 'bg-blue-50 hover:bg-blue-100 text-blue-600',
        'ppt', 'pptx' => 'bg-amber-50 hover:bg-amber-100 text-amber-600',
        default => 'bg-slate-50 hover:bg-slate-100 text-slate-600'
        };

        @endphp

        <div class="document-card group relative bg-white rounded-[2rem] border border-slate-100 hover:border-blue-100 p-5 md:p-6 shadow-[0_12px_40px_-15px_rgba(0,0,0,0.03)] hover:shadow-[0_24px_60px_-15px_rgba(59,130,246,0.1)] hover:-translate-y-1 transition-all duration-500 flex flex-col md:flex-row md:items-center justify-between gap-4 overflow-hidden"
            data-subject="{{ Str::slug($doc->monHoc->ten_mon ?? '') }}" data-type="{{ strtolower($doc->dinh_dang) }}"
            data-downloads="{{ rand(50,2000) }}" data-id="{{ $doc->tai_lieu_id }}">

            <!-- Background Circle -->
            <div
                class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-slate-50 to-blue-50/30 rounded-full group-hover:scale-125 transition-transform duration-700">
            </div>

            <!-- Left -->
            <div class="flex items-start gap-4 relative z-10 min-w-0">

                <!-- Icon -->
                <div
                    class="w-14 h-14 rounded-2xl bg-gradient-to-br {{ $theme }} flex flex-col items-center justify-center shrink-0 shadow-sm group-hover:scale-105 transition-transform duration-300">

                    <i class="fas {{ $icon }} text-lg"></i>

                    <span class="text-[9px] font-black uppercase tracking-wide mt-0.5">
                        {{ strtoupper($doc->dinh_dang) }}
                    </span>

                </div>

                <!-- Info -->
                <div class="space-y-1 min-w-0">

                    <h3
                        class="doc-title text-base md:text-lg font-extrabold text-slate-900 tracking-tight leading-tight group-hover:text-blue-600 transition-colors duration-300 truncate">

                        {{ $doc->ten_tai_lieu }}

                    </h3>

                    <p class="text-slate-400 font-semibold text-xs flex flex-wrap items-center gap-2">

                        <span class="text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md text-[10px] font-bold">
                            {{ $doc->monHoc->ten_mon ?? 'Chưa cập nhật' }}
                        </span>

                        <span>•</span>

                        <span>
                            {{ $doc->nguoiDang->name ?? 'Ẩn danh' }}
                        </span>

                        <span>•</span>

                        <span>
                            {{ \Carbon\Carbon::parse($doc->ngay_upload)->format('d/m/Y') }}
                        </span>

                    </p>

                </div>

            </div>

            <!-- Right -->
            <div
                class="flex items-center justify-between md:justify-end gap-6 border-t border-slate-50 md:border-0 pt-4 md:pt-0 relative z-10 shrink-0">

                <!-- Downloads -->
                <div class="flex flex-col space-y-1 md:text-right">

                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">
                        Tương tác
                    </span>

                    <span class="text-sm font-black text-slate-700">

                        <i class="fas fa-download text-slate-400 text-xs mr-1"></i>

                        {{ rand(50,2000) }}

                        <span class="text-[10px] text-slate-400 font-bold">
                            lượt
                        </span>

                    </span>

                </div>

                <!-- Button -->
                <a href="#"
                    class="inline-flex items-center justify-center h-11 px-5 {{ $btn }} text-xs font-black uppercase tracking-wider rounded-full transition-all duration-300 active:scale-95">

                    Tải xuống

                </a>

            </div>

        </div>

        @endforeach

    </div>

    <!-- Load More -->
    <div class="text-center">

        <button
            class="group inline-flex items-center gap-2.5 px-8 h-14 bg-slate-950 text-white font-bold text-xs uppercase tracking-wider rounded-full shadow-lg shadow-slate-950/10 hover:bg-blue-600 hover:-translate-y-0.5 transition-all duration-300 active:scale-95">

            <span>Tải thêm tài liệu</span>

        </button>

    </div>

</main>

@endsection

<script>
function filterDocuments() {

    const searchInput = document.getElementById('docSearch').value.toUpperCase();
    const subjectFilter = document.getElementById('filterSubject').value;
    const typeFilter = document.getElementById('filterType').value;

    const cards = document.querySelectorAll('.document-card');
    const emptyState = document.getElementById('emptyState');

    let visibleCount = 0;

    cards.forEach(card => {

        const title = card.querySelector('.doc-title').innerText.toUpperCase();

        const cardSubject = card.getAttribute('data-subject');
        const cardType = card.getAttribute('data-type');

        const matchesSearch = title.indexOf(searchInput) > -1;

        const matchesSubject =
            (subjectFilter === 'all' || cardSubject === subjectFilter);

        const matchesType =
            (typeFilter === 'all' || cardType === typeFilter);

        if (matchesSearch && matchesSubject && matchesType) {

            card.classList.remove('hidden');
            visibleCount++;

        } else {

            card.classList.add('hidden');

        }

    });

    if (visibleCount === 0) {
        emptyState.classList.remove('hidden');
    } else {
        emptyState.classList.add('hidden');
    }
}

function sortDocuments() {

    const sortValue = document.getElementById('filterSort').value;

    const grid = document.getElementById('documentGrid');

    const cards = Array.from(grid.querySelectorAll('.document-card'));

    cards.sort((a, b) => {

        if (sortValue === 'downloads') {

            return parseInt(b.getAttribute('data-downloads')) -
                parseInt(a.getAttribute('data-downloads'));

        } else {

            return parseInt(b.getAttribute('data-id')) -
                parseInt(a.getAttribute('data-id'));

        }

    });

    cards.forEach(card => grid.appendChild(card));
}
</script>