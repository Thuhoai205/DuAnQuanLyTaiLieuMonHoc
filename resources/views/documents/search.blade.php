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
<main class="min-h-screen ">

    <!-- HERO SEARCH -->
    <section class="relative overflow-hidden  text-white py-14">

        <!-- BG -->
        <div class="absolute inset-0 opacity-50">
            <img src="{{ asset('img/02.jpg') }}" alt="Educational Resources Banner"
                class="w-full h-full object-cover opacity-60">
        </div>
        <div class="absolute inset-0 bg-black/30"></div>

        <div class="relative max-w-7xl mx-auto px-6 sm:px-10 lg:px-16">

            <!-- BACK -->
            <a href="javascript:history.back()" class="inline-flex items-center gap-2
                px-5 py-2.5
                rounded-xl

                bg-white
                border border-amber-300

                text-slate-800
                text-sm
                font-semibold

                shadow-sm
                transition-all duration-300

                hover:bg-amber-500
                hover:border-amber-500
                hover:text-white

                active:scale-95

                focus:outline-none
                focus:ring-4
                focus:ring-amber-200

                mb-8">

                <i class="fa-solid fa-arrow-left"></i>

                Quay lại

            </a>
            <!-- TITLE -->
            <p class="banner-title uppercase tracking-[0.25em] text-amber-200 text-xs font-black mb-4">
                Tra cứu học liệu
            </p>

            <h1 class="banner-title text-4xl md:text-5xl font-black leading-tight text-white">
                Tìm kiếm tài liệu học tập
            </h1>

            <p class="banner-title mt-5 text-slate-200 text-lg">
                Tìm slide, giáo trình, bài tập, đề thi và tài liệu mới nhất từ giảng viên.
            </p>
            <!-- SEARCH -->
            <div class="banner-subtitle mt-10
                            bg-white/95
                            backdrop-blur-xl
                            rounded-[2rem]
                            p-5
                            border border-slate-200
                            shadow-xl">
                <form id="searchForm" action="{{ route('documents.search') }}" method="GET"
                    class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                    <!-- Từ khóa -->
                    <div class="lg:col-span-4 relative">

                        <i
                            class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-amber-500"></i>

                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                            placeholder="Tên tài liệu, môn học..." class="w-full h-14
                            pl-14 pr-4
                            rounded-2xl
                            bg-white
                            border border-slate-200
                            text-slate-700
                            font-semibold
                            placeholder:text-slate-400
                            focus:outline-none
                            focus:border-amber-400
                            focus:ring-4
                            focus:ring-amber-100">
                    </div>

                    <!-- Môn học -->
                    <div class="lg:col-span-3">

                        <select name="subject_code" class="w-full h-14 px-5 rounded-2xl
                        bg-white
                        border border-slate-200
                        text-slate-700
                        font-semibold
                        focus:outline-none
                        focus:border-amber-400
                        focus:ring-4
                        focus:ring-amber-100">

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

                        <select name="document_type_id" class="w-full h-14 px-5 rounded-2xl
                        bg-white
                        border border-slate-200
                        text-slate-700
                        font-semibold
                        focus:outline-none
                        focus:border-amber-400
                        focus:ring-4
                        focus:ring-amber-100">

                            <option value="">Loại tài liệu</option>

                            @foreach($documentTypes as $type)

                            <option value="{{ $type->document_type_id }}"
                                {{ request('document_type_id') == $type->document_type_id ? 'selected' : '' }}>

                                {{ $type->type_name }}

                            </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- Button -->
                    <div class="lg:col-span-3">

                        <button type="submit" class="w-full h-14
                            rounded-2xl
                            bg-slate-900
                            hover:bg-amber-500
                            text-white
                            font-bold
                            shadow-lg
                            transition-all duration-300">

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

                                <input type="radio" name="document_type_id" value="" class="accent-amber-500 w-5 h-5"
                                    {{ request('document_type_id') == '' ? 'checked' : '' }}>

                                <span class="font-semibold text-amber-600">
                                    Tất cả
                                </span>

                            </label>

                            @foreach($documentTypes as $type)

                            <label class="flex items-center gap-3 cursor-pointer">

                                <input type="radio" name="document_type_id" value="{{ $type->document_type_id }}"
                                    class="accent-amber-500 w-5 h-5"
                                    {{ request('document_type_id') == $type->document_type_id ? 'checked' : '' }}>

                                <span class="font-semibold text-slate-700">
                                    {{ $type->type_name }}
                                </span>

                            </label>

                            @endforeach

                        </div>

                    </div>

                    <button class="w-full py-3 rounded-2xl
                    bg-slate-900
                    hover:bg-amber-500
                    text-white
                    font-black
                    transition-all duration-300">

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

                            <span class="text-amber-600 font-black">

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

                        <select id="sort" name="sort" class="h-12 px-5 rounded-2xl
                        border border-slate-200
                        bg-white
                        text-slate-700
                        focus:outline-none
                        focus:border-amber-400
                        focus:ring-2
                        focus:ring-amber-100">

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
                <div class="bg-white rounded-[2rem] border border-slate-200 overflow-hidden shadow-sm">


                    @forelse($documents as $document)



                    <div
                        class="group p-6 border-b border-slate-100 hover:bg-slate-50 transition flex flex-col lg:flex-row gap-5">

                        <!-- ICON -->
                        <div class="flex h-14 w-14 items-center justify-center
                            rounded-2xl
                            border border-slate-200
                            bg-slate-100
                            text-slate-600
                            transition-all duration-300
                            group-hover:border-amber-300
                            group-hover:bg-amber-50
                            group-hover:text-amber-500">

                            <i class="fa-solid fa-folder-open text-xl"></i>

                        </div>
                        <!-- CONTENT -->
                        <div class="min-w-0 flex-1">

                            <h3 class="truncate
    text-lg
    font-semibold
    text-slate-800
    transition-colors
    group-hover:text-amber-500">

                                @php
                                $title = $document->title;

                                if(request('keyword')){
                                $title = preg_replace(
                                '/(' . preg_quote(request('keyword'), '/') . ')/i',
                                '<mark class="bg-yellow-300 text-red-600 font-bold px-1 rounded">$1</mark>',
                                e($title)
                                );
                                }else{
                                $title = e($title);
                                }
                                @endphp

                                @auth
                                <a href="{{ route('documents.show', $document->document_id) }}"
                                    class="hover:text-amber-500 transition-colors">
                                    {!! $title !!}
                                </a>
                                @else
                                {!! $title !!}
                                @endauth

                            </h3>

                            <div class="mt-3 flex flex-wrap gap-2">

                                <span class="rounded-full
                            bg-slate-100
                            px-3
                            py-1
                            text-xs
                            text-slate-700">

                                    <i class="fa-solid fa-book mr-1 text-slate-500"></i>

                                    {{ $document->subject?->subject_name }}

                                </span>
                                <span class="rounded-full
                            bg-slate-100
                            px-3
                            py-1
                            text-xs
                            text-slate-700">

                                    <i class="fa-solid fa-user-tie mr-1 text-slate-500"></i>

                                    {{ $document->uploader?->full_name ?? 'Không xác định' }}

                                </span>
                                <span class="rounded-full
                            bg-amber-50
                            px-3
                            py-1
                            text-xs
                            text-amber-700">

                                    <i class="fa-solid fa-download mr-1"></i>

                                    {{ number_format($document->download_count) }}

                                </span>

                                <span class="rounded-full
                            bg-slate-100
                            px-3
                            py-1
                            text-xs
                            text-slate-700">

                                    <i class="fa-solid fa-calendar mr-1 text-slate-500"></i>

                                    {{ $document->created_at->format('d/m/Y') }}

                                </span>

                            </div>

                        </div>

                        <!-- ACTION -->
                        <div class="flex items-center gap-2 flex-wrap justify-end">


                            @auth

                            {{-- ADMIN --}}
                            @if(Auth::user()->role_id == 1)


                            <a href="{{ route('documents.show',$document->document_id) }}"
                                class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 transition">

                                Chi tiết

                            </a>
                            <a href="{{ route('documents.download',$document) }}" class="inline-flex items-center gap-2
                                rounded-xl
                                bg-slate-900
                                px-4 py-2
                                text-sm font-medium
                                text-white
                                transition
                                hover:bg-amber-500">

                                <i class="fa-solid fa-download"></i>

                                Tải

                            </a>

                            {{-- GIẢNG VIÊN --}}
                            @elseif(Auth::user()->role_id == 2)

                            @if($document->uploaded_by == Auth::id())

                            <a href="{{ route('documents.show',$document->document_id) }}"
                                class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 transition">

                                Chi tiết

                            </a>

                            @endif

                            <a href="{{ route('documents.download',$document) }}" class="inline-flex items-center gap-2
                                rounded-xl
                                bg-slate-900
                                px-4 py-2
                                text-sm font-medium
                                text-white
                                transition
                                hover:bg-amber-500">

                                <i class="fa-solid fa-download"></i>

                                Tải

                            </a>
                            {{-- SINH VIÊN --}}
                            @else

                            <a href="{{ route('documents.download',$document) }}" class="inline-flex items-center gap-2
                                rounded-xl
                                bg-slate-900
                                px-4 py-2
                                text-sm font-medium
                                text-white
                                transition
                                hover:bg-amber-500">

                                <i class="fa-solid fa-download"></i>

                                Tải

                            </a>
                            @endif

                            @else

                            <a onclick="showLoginRequiredModal()" class="inline-flex items-center gap-2
                                rounded-xl
                                border border-slate-300
                                bg-white
                                px-4 py-2
                                text-sm font-semibold
                                text-slate-700
                                transition-all duration-300
                                hover:border-yellow-600
                                hover:bg-yellow-50
                                hover:text-yellow-700
                                shadow-sm">
                                <i class="fa-solid fa-lock text-xs"></i>
                                Đăng nhập để tải
                            </a>

                            @endauth

                        </div>

                    </div>



                    @empty

                    <div class="py-24 text-center">

                        <i class="fa-solid fa-folder-open text-6xl text-amber-500"></i>

                        <h3 class="mt-6 text-2xl font-black text-slate-700">

                            Không tìm thấy tài liệu

                        </h3>

                        <p class="mt-2 text-slate-500">

                            Hãy thử thay đổi từ khóa hoặc bộ lọc.

                        </p>

                    </div>

                    @endforelse

                </div>
            </div>

        </div>
        <!-- PAGINATION -->
        @if($documents->hasPages())
        <div class="px-6 py-6 border-t border-slate-200">

            <div class="flex items-center justify-center gap-2">

                {{-- Previous --}}
                @if($documents->onFirstPage())

                <span
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 text-slate-300 cursor-not-allowed">

                    <i class="fa-solid fa-chevron-left"></i>

                </span>

                @else

                <a href="{{ $documents->previousPageUrl() }}"
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:border-slate-300 hover:bg-slate-100">

                    <i class="fa-solid fa-chevron-left"></i>

                </a>

                @endif

                {{-- Page Number --}}
                @foreach($documents->getUrlRange(1, $documents->lastPage()) as $page => $url)

                @if($page == $documents->currentPage())

                <span
                    class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-900 text-white font-bold shadow-md">

                    {{ $page }}

                </span>

                @else

                <a href="{{ $url }}"
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white font-semibold text-slate-600 transition hover:border-amber-300 hover:text-amber-600 hover:bg-amber-50">

                    {{ $page }}

                </a>

                @endif

                @endforeach

                {{-- Next --}}
                @if($documents->hasMorePages())

                <a href="{{ $documents->nextPageUrl() }}"
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:border-slate-300 hover:bg-slate-100">

                    <i class="fa-solid fa-chevron-right"></i>

                </a>

                @else

                <span
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 text-slate-300 cursor-not-allowed">

                    <i class="fa-solid fa-chevron-right"></i>

                </span>

                @endif

            </div>

        </div>
        @endif

    </section>
</main>
<!-- LOGIN REQUIRED MODAL -->
<div id="loginRequiredModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm">

    <div class="w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-2xl">

        <!-- HEADER -->
        <div class="px-8 py-7 border-b border-slate-200 bg-slate-50">

            <div class="mx-auto w-16 h-16 rounded-2xl bg-amber-50 flex items-center justify-center">

                <i class="fa-solid fa-lock text-2xl text-amber-500"></i>

            </div>

            <h2 class="mt-5 text-center text-2xl font-black text-slate-800">

                Yêu cầu đăng nhập

            </h2>

            <p class="mt-2 text-center text-sm text-slate-500 leading-6">

                Bạn cần đăng nhập để có thể tải xuống tài liệu này.

            </p>

        </div>

        <!-- CONTENT -->
        <div class="px-8 py-6">

            <div class="rounded-2xl border border-amber-100 bg-amber-50 p-4">

                <div class="flex items-start gap-3">

                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center">

                        <i class="fa-solid fa-circle-info text-amber-500"></i>

                    </div>

                    <div>

                        <h4 class="font-bold text-slate-800">

                            Tại sao cần đăng nhập?

                        </h4>

                        <p class="mt-1 text-sm text-slate-600 leading-6">

                            Sau khi đăng nhập, bạn có thể tải tài liệu, lưu lịch sử tải xuống
                            và sử dụng đầy đủ các chức năng của hệ thống.

                        </p>

                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-8 flex gap-3">

                <button type="button" onclick="closeLoginRequiredModal()" class="flex-1
                    h-11
                    rounded-xl
                    border
                    border-slate-200
                    bg-white
                    text-slate-700
                    text-sm
                    font-bold
                    hover:bg-slate-50
                    transition-all
                    duration-300">

                    Đóng

                </button>

                <a href="{{ route('login') }}" class="flex-1
                    h-11
                    rounded-xl
                    bg-amber-500
                    text-white
                    text-sm
                    font-bold
                    flex
                    items-center
                    justify-center
                    hover:bg-amber-600
                    transition-all
                    duration-300">

                    <i class="fa-solid fa-right-to-bracket mr-2"></i>

                    Đăng nhập

                </a>

            </div>

        </div>

    </div>

</div>
@endsection
@push('scripts')
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
@endpush