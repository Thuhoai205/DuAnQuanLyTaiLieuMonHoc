@extends('layouts.app')

@section('title', 'Tìm kiếm tài liệu')

@section('content')
<style>
.banner-title {

    animation: titleZoom .8s ease;

}

.banner-subtitle {

    animation: titleZoom 1.2s ease;

}

@keyframes titleZoom {

    from {

        opacity: 0;

        transform:
            scale(.85) translateY(20px);

    }

    to {

        opacity: 1;

        transform:
            scale(1) translateY(0);

    }

}
</style>
<main class="min-h-screen bg-[#EAFBFF]">

    <!-- HERO SEARCH -->
    <section class="relative overflow-hidden  text-white py-14">

        <!-- BG -->
        <div class="absolute inset-0 opacity-50">
            <img src="https://i.pinimg.com/1200x/96/d3/c9/96d3c90189af11a192ba76519fb7cf2a.jpg"
                class="w-full h-full object-cover">
        </div>
        <div class="absolute inset-0 bg-black/30"></div>

        <div class="relative max-w-7xl mx-auto px-6 sm:px-10 lg:px-16">

            <!-- BACK -->
            <a href="javascript:history.back()" class="inline-flex items-center gap-2
           px-5 py-2.5
           rounded-full
           bg-white/15
           backdrop-blur-md
           border border-white/20
           text-white
           text-xs
           font-black
           uppercase
           tracking-wider
           transition-all duration-300

           hover:bg-cyan-500
           hover:border-cyan-500
           hover:text-white

           active:bg-cyan-600
           active:border-cyan-600
           active:scale-95

           focus:outline-none
           focus:ring-4
           focus:ring-cyan-300

           mb-8">

                <i class="fa-solid fa-arrow-left"></i>

                Quay lại

            </a>
            <!-- TITLE -->
            <div class="max-w-3xl">
                <p class="banner-title uppercase tracking-[0.25em] text-cyan-100 text-xs font-black mb-4">
                    Tra cứu học liệu
                </p>

                <h1 class="banner-title text-4xl md:text-5xl font-black leading-tight">
                    Tìm kiếm tài liệu học tập
                </h1>

                <p class="banner-title mt-5 text-cyan-50/90 text-lg">
                    Tìm slide, giáo trình, bài tập, đề thi và tài liệu mới nhất từ giảng viên.
                </p>
            </div>

            <!-- SEARCH -->
            <div
                class="banner-subtitle mt-10 bg-white/95 backdrop-blur-xl rounded-[2rem] p-5 border border-white/30 shadow-[0_20px_60px_rgba(0,0,0,0.15)]">

                <form id="sortForm" action="{{ route('documents.search') }}" method="GET"
                    class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                    <!-- Từ khóa -->
                    <div class="lg:col-span-4 relative">

                        <i
                            class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-cyan-600"></i>

                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                            placeholder="Tên tài liệu, môn học..." class="w-full h-14 pl-14 pr-4 rounded-2xl bg-cyan-50 border border-cyan-100
                   text-slate-700 font-semibold placeholder-slate-400
                   focus:outline-none focus:ring-2 focus:ring-cyan-300">

                    </div>

                    <!-- Môn học -->
                    <div class="lg:col-span-2">

                        <select name="subject_code" class="w-full h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100
                   text-slate-700 font-semibold focus:ring-2 focus:ring-cyan-300">

                            <option value="">Tất cả môn học</option>

                            @foreach($subjects as $subject)

                            <option value="{{ $subject->subject_code }}"
                                {{ request('subject_code') == $subject->subject_code ? 'selected' : '' }}>

                                {{ $subject->subject_name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Loại tài liệu -->
                    <div class="lg:col-span-2">

                        <select name="document_type_id" class="w-full h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100
                   text-slate-700 font-semibold focus:ring-2 focus:ring-cyan-300">

                            <option value="">Loại tài liệu</option>

                            @foreach($documentTypes as $type)

                            <option value="{{ $type->document_type_id }}"
                                {{ request('document_type_id') == $type->document_type_id ? 'selected' : '' }}>

                                {{ $type->type_name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Khoa -->
                    <div class="lg:col-span-2">

                        <select name="faculty_id" class="w-full h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100
                   text-slate-700 font-semibold focus:ring-2 focus:ring-cyan-300">

                            <option value="">Tất cả khoa</option>

                            @foreach($faculties as $faculty)

                            <option value="{{ $faculty->faculty_id }}"
                                {{ request('faculty_id') == $faculty->faculty_id ? 'selected' : '' }}>

                                {{ $faculty->faculty_name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Button -->
                    <div class="lg:col-span-2">

                        <button type="submit" class="w-full h-14 rounded-2xl bg-cyan-500 hover:bg-cyan-600
                   text-white font-black shadow-lg shadow-cyan-200 transition">

                            <i class="fa-solid fa-magnifying-glass mr-2"></i>
                            Tìm kiếm

                        </button>

                    </div>

                </form>
            </div>

        </div>
    </section>

    <!-- CONTENT -->
    <section class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-12">

        <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">

            <!-- FILTER -->
            <aside class="xl:col-span-1">

                <form id="filterForm" method="GET" action="{{ route('documents.search') }}">

                    @if(request('keyword'))
                    <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                    @endif

                    @if(request('subject_code'))
                    <input type="hidden" name="subject_code" value="{{ request('subject_code') }}">
                    @endif

                    @if(request('faculty_id'))
                    <input type="hidden" name="faculty_id" value="{{ request('faculty_id') }}">
                    @endif

                    <div class="mb-8">

                        <h4 class="text-sm font-black uppercase tracking-[0.15em] text-slate-400 mb-4">
                            Loại tài liệu
                        </h4>
                        <div class="space-y-4">

                            <!-- Tất cả -->
                            <label class="flex items-center gap-3 cursor-pointer">

                                <input type="radio" name="document_type_id" value="" class="accent-cyan-500 w-5 h-5"
                                    {{ request('document_type_id') == '' ? 'checked' : '' }}>

                                <span class="font-semibold text-cyan-600">
                                    Tất cả
                                </span>

                            </label>

                            @foreach($documentTypes as $type)

                            <label class="flex items-center gap-3 cursor-pointer">

                                <input type="radio" name="document_type_id" value="{{ $type->document_type_id }}"
                                    class="accent-cyan-500 w-5 h-5"
                                    {{ request('document_type_id') == $type->document_type_id ? 'checked' : '' }}>

                                <span class="font-semibold text-slate-700">
                                    {{ $type->type_name }}
                                </span>

                            </label>

                            @endforeach

                        </div>

                    </div>

                    <button class="w-full py-3 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-black">

                        Áp dụng bộ lọc

                    </button>

                </form>
            </aside>

            <!-- RESULT -->
            <div id="document-list" class="xl:col-span-3">

                <!-- TOP -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                    <div>
                        <h2 class="text-3xl font-black text-slate-900">
                            Kết quả tìm kiếm
                        </h2>

                        <p class="text-slate-500 font-semibold mt-2">

                            Tìm thấy

                            <span class="text-cyan-600 font-black">

                                {{ $documents->total() }}

                            </span>

                            tài liệu

                        </p>
                    </div>

                    <form method="GET" action="{{ route('documents.search') }}">

                        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                        <input type="hidden" name="subject_code" value="{{ request('subject_code') }}">
                        <input type="hidden" name="faculty_id" value="{{ request('faculty_id') }}">
                        <input type="hidden" name="document_type_id" value="{{ request('document_type_id') }}">

                        <select id="sort" name="sort" class="h-12 px-5 rounded-2xl border border-cyan-100 bg-white">
                            <option value="latest" {{ request('sort','latest')=='latest'?'selected':'' }}>
                                Mới nhất
                            </option>

                            <option value="download" {{ request('sort')=='download'?'selected':'' }}>
                                Tải nhiều
                            </option>

                            <option value="az" {{ request('sort')=='az'?'selected':'' }}>
                                A-Z
                            </option>

                        </select>

                    </form>
                </div>

                <!-- LIST -->
                <div
                    class="bg-white rounded-[2rem] border border-cyan-100 overflow-hidden shadow-[0_15px_45px_rgba(8,145,178,0.08)]">

                    @forelse($documents as $document)

                    @php
                    $ext = strtolower($document->currentVersion->file_extension ?? '');
                    @endphp

                    <div
                        class="group p-6 border-b border-cyan-100 hover:bg-cyan-50/60 transition flex flex-col lg:flex-row gap-5">

                        <!-- ICON -->
                        <div class="w-16 h-16 rounded-2xl flex flex-col items-center justify-center shrink-0

                    @if($ext=='pdf')
                        bg-red-50 text-red-500 border border-red-100
                    @elseif(in_array($ext,['doc','docx']))
                        bg-blue-50 text-blue-500 border border-blue-100
                    @elseif(in_array($ext,['xls','xlsx']))
                        bg-green-50 text-green-500 border border-green-100
                    @elseif(in_array($ext,['ppt','pptx']))
                        bg-orange-50 text-orange-500 border border-orange-100
                    @else
                        bg-slate-50 text-slate-500 border border-slate-100
                    @endif">

                            @switch($ext)

                            @case('pdf')
                            <i class="fa-solid fa-file-pdf text-2xl"></i>
                            @break

                            @case('doc')
                            @case('docx')
                            <i class="fa-solid fa-file-word text-2xl"></i>
                            @break

                            @case('xls')
                            @case('xlsx')
                            <i class="fa-solid fa-file-excel text-2xl"></i>
                            @break

                            @case('ppt')
                            @case('pptx')
                            <i class="fa-solid fa-file-powerpoint text-2xl"></i>
                            @break

                            @default
                            <i class="fa-solid fa-file text-2xl"></i>

                            @endswitch

                            <span class="text-[10px] font-black mt-1">

                                {{ strtoupper($ext ?: 'FILE') }}

                            </span>

                        </div>

                        <!-- CONTENT -->
                        <a href="{{ route('documents.show',$document->document_id) }}" class="flex-grow">

                            <h3 class="text-lg font-black text-slate-800 group-hover:text-cyan-600 transition">

                                {{ $document->title }}

                            </h3>

                            <!-- Hàng 1 -->
                            <div class="flex flex-wrap items-center gap-5 mt-3 text-sm">

                                <span class="inline-flex items-center font-semibold text-slate-600">

                                    <i class="fa-solid fa-book text-cyan-600 mr-2"></i>

                                    {{ $document->subject->subject_name }}

                                </span>

                                <span class="inline-flex items-center font-semibold text-slate-600">

                                    <i class="fa-solid fa-user text-cyan-600 mr-2"></i>

                                    {{ $document->uploader->full_name }}

                                </span>

                            </div>

                            <!-- Hàng 2 -->
                            <div class="flex flex-wrap items-center gap-5 mt-2 text-sm text-slate-500">


                                <span class="inline-flex items-center">

                                    <i class="fa-solid fa-folder text-cyan-600 mr-2"></i>

                                    {{ $document->documentType->type_name }}

                                </span>
                                <span class="inline-flex items-center">

                                    <i class="fa-solid fa-calendar text-cyan-600 mr-2"></i>

                                    {{ $document->created_at->format('d/m/Y') }}

                                </span>


                            </div>

                        </a>
                        <!-- BUTTON -->
                        <div class="flex items-center gap-3">

                            @auth

                            <a href="{{ route('documents.download', $document) }}"
                                class="px-5 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-bold shadow-lg shadow-cyan-200">

                                <i class="fa-solid fa-download mr-1"></i>

                                Tải xuống

                            </a>
                            @else

                            <button onclick="showLoginRequiredModal()"
                                class="px-5 py-3 border border-cyan-200 rounded-xl">

                                <i class="fa-solid fa-lock"></i>

                                Đăng nhập

                            </button>

                            @endauth

                        </div>

                    </div>

                    @empty

                    <div class="py-24 text-center">

                        <i class="fa-solid fa-folder-open text-6xl text-slate-300"></i>

                        <h3 class="mt-6 text-2xl font-black text-slate-700">

                            Không tìm thấy tài liệu

                        </h3>

                        <p class="mt-2 text-slate-500">

                            Hãy thử thay đổi từ khóa hoặc bộ lọc.

                        </p>

                    </div>

                    @endforelse
                </div>

                @if ($documents->hasPages())

                <div class="mt-10 flex items-center justify-between flex-wrap gap-4">

                    <!-- Thông tin -->
                    <div class="text-sm text-slate-500">
                        Hiển thị
                        <span class="font-bold text-slate-700">
                            {{ $documents->firstItem() }}
                        </span>
                        -
                        <span class="font-bold text-slate-700">
                            {{ $documents->lastItem() }}
                        </span>
                        /
                        <span class="font-bold text-cyan-600">
                            {{ $documents->total() }}
                        </span>
                        tài liệu
                    </div>

                    <!-- Pagination -->
                    <div class="flex items-center gap-2">

                        {{-- Previous --}}
                        @if ($documents->onFirstPage())

                        <span
                            class="w-11 h-11 rounded-2xl bg-slate-100 text-slate-300 flex items-center justify-center cursor-not-allowed">
                            <i class="fa-solid fa-chevron-left"></i>
                        </span>

                        @else

                        <a href="{{ $documents->previousPageUrl() }}"
                            class="w-11 h-11 rounded-2xl bg-white border border-slate-200 hover:border-cyan-400 hover:bg-cyan-50 text-slate-600 flex items-center justify-center transition">

                            <i class="fa-solid fa-chevron-left"></i>

                        </a>

                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($documents->getUrlRange(1, $documents->lastPage()) as $page => $url)

                        @if ($page == $documents->currentPage())

                        <span
                            class="w-11 h-11 rounded-2xl bg-cyan-500 text-white font-bold flex items-center justify-center shadow-lg shadow-cyan-200">

                            {{ $page }}

                        </span>

                        @else

                        <a href="{{ $url }}"
                            class="w-11 h-11 rounded-2xl bg-white border border-slate-200 hover:border-cyan-400 hover:bg-cyan-50 text-slate-700 font-semibold flex items-center justify-center transition">

                            {{ $page }}

                        </a>

                        @endif

                        @endforeach

                        {{-- Next --}}
                        @if ($documents->hasMorePages())

                        <a href="{{ $documents->nextPageUrl() }}"
                            class="w-11 h-11 rounded-2xl bg-white border border-slate-200 hover:border-cyan-400 hover:bg-cyan-50 text-slate-600 flex items-center justify-center transition">

                            <i class="fa-solid fa-chevron-right"></i>

                        </a>

                        @else

                        <span
                            class="w-11 h-11 rounded-2xl bg-slate-100 text-slate-300 flex items-center justify-center cursor-not-allowed">

                            <i class="fa-solid fa-chevron-right"></i>

                        </span>

                        @endif

                    </div>

                </div>

                @endif
            </div>

        </div>

    </section>

</main>

<!-- LOGIN REQUIRED MODAL -->
<div id="loginRequiredModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/40 backdrop-blur-sm px-4">

    <div class="w-full max-w-md bg-white rounded-3xl p-8 text-center shadow-2xl border border-cyan-100">

        <div
            class="w-20 h-20 mx-auto rounded-full bg-cyan-50 text-cyan-600 flex items-center justify-center text-3xl mb-5">
            <i class="fa-solid fa-lock"></i>
        </div>

        <h3 class="text-2xl font-black text-slate-900 mb-3">
            Yêu cầu đăng nhập
        </h3>

        <p class="text-slate-500 leading-relaxed mb-6">
            Bạn cần đăng nhập để tải tài liệu học tập.
        </p>

        <div class="flex items-center justify-center gap-3">
            <button onclick="closeLoginRequiredModal()"
                class="px-5 py-3 rounded-2xl border border-cyan-100 text-slate-600 font-bold hover:bg-cyan-50 transition">
                Đóng
            </button>

            <a href="{{ route('login') }}"
                class="px-6 py-3 rounded-2xl bg-cyan-500 text-white font-bold hover:bg-cyan-600 transition shadow-lg shadow-cyan-200">
                Đăng nhập ngay
            </a>
        </div>
    </div>
</div>
@endsection

<script>
document.addEventListener("DOMContentLoaded", () => {

    //==============================
    // Modal
    //==============================
    window.showLoginRequiredModal = function() {

        const modal = document.getElementById("loginRequiredModal");

        modal.classList.remove("hidden");
        modal.classList.add("flex");

        document.body.style.overflow = "hidden";
    };

    window.closeLoginRequiredModal = function() {

        const modal = document.getElementById("loginRequiredModal");

        modal.classList.remove("flex");
        modal.classList.add("hidden");

        document.body.style.overflow = "auto";
    };



    //==============================
    // Ajax Load
    //==============================
    async function loadDocuments(url) {

        try {

            const response = await fetch(url, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            });

            const html = await response.text();

            const parser = new DOMParser();

            const doc = parser.parseFromString(html, "text/html");

            const newList = doc.querySelector("#document-list");

            if (!newList) return;

            document.querySelector("#document-list").innerHTML =
                newList.innerHTML;

            history.replaceState({}, "", url);

            bindEvents();

        } catch (e) {

            console.error(e);

        }

    }



    //==============================
    // Gắn lại toàn bộ event
    //==============================
    function bindEvents() {

        //--------------------------------
        // Sort
        //--------------------------------
        const sort = document.getElementById("sort");

        if (sort) {

            sort.onchange = function() {

                const params = new URLSearchParams(window.location.search);

                params.set("sort", this.value);

                params.delete("page");

                loadDocuments(
                    "{{ route('documents.search') }}?" + params.toString()
                );

            };

        }

        //--------------------------------
        // Pagination
        //--------------------------------
        document.querySelectorAll(".pagination a").forEach(link => {

            link.onclick = function(e) {

                e.preventDefault();

                loadDocuments(this.href);

            };

        });

    }



    //==============================
    // Search Form
    //==============================
    const searchForm = document.getElementById("searchForm");

    if (searchForm) {

        searchForm.addEventListener("submit", function(e) {

            e.preventDefault();

            const url =
                this.action +
                "?" +
                new URLSearchParams(new FormData(this));

            loadDocuments(url);

        });

    }



    //==============================
    // Filter Form
    //==============================
    const filterForm = document.getElementById("filterForm");

    if (filterForm) {

        //--------------------------------
        // Button Apply
        //--------------------------------
        filterForm.addEventListener("submit", function(e) {

            e.preventDefault();

            const url =
                this.action +
                "?" +
                new URLSearchParams(new FormData(this));

            loadDocuments(url);

        });



        //--------------------------------
        // Radio auto filter
        //--------------------------------
        filterForm.querySelectorAll("input[type=radio]").forEach(radio => {

            radio.addEventListener("change", function() {

                const url =
                    filterForm.action +
                    "?" +
                    new URLSearchParams(new FormData(filterForm));

                loadDocuments(url);

            });

        });

    }



    //==============================
    // Bind lần đầu
    //==============================
    bindEvents();

});
</script>