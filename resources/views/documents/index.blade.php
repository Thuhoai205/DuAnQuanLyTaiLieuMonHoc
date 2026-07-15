@extends('layouts.app')

@section('title', 'Danh sách tài liệu')

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
<main class="min-h-screen  ">
    <!-- HERO BANNER: Khối banner ảnh nền chứa chữ "Giới thiệu" giống hệt image_5ea826.jpg -->
    <div class="relative w-full h-[260px] md:h-[320px] overflow-hidden">
        <!-- Ảnh nền (Đã được thay bằng hình ảnh thư viện học thuật/công nghệ số hiện đại) -->
        <img src="{{ asset('img/02.jpg') }}" alt="Educational Resources Banner"
            class="w-full h-full object-cover opacity-60">

        <!-- Lớp phủ tối (Overlay) để làm nổi bật chữ trắng phía trên giống hình mẫu -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Chữ "Giới thiệu" căn giữa tuyệt đối -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">

            <h1 class="banner-title italic text-5xl font-bold text-white drop-shadow-2xl">
                Tra cứu tài liệu
            </h1>

            <p class="banner-subtitle mt-3 text-white/90 text-lg md:text-xl font-medium max-w-2xl leading-relaxed">
                Tìm kiếm và truy cập tài liệu học tập theo môn học, loại tài liệu hoặc từ khóa.
            </p>

        </div>
    </div>
    <div class="bg-slate-100 py-3 border-b border-slate-200">

        <div class="max-w-7xl mx-auto px-4 md:px-6 flex items-center text-sm">

            <a href="/" class="text-slate-500 hover:text-slate-900 transition-colors duration-300">

                Trang chủ

            </a>

            <span class="mx-3 text-slate-300">
                /
            </span>

            <span class="font-semibold text-slate-700">

                Tra cứu tài liệu

            </span>

        </div>

    </div>
    <div class="max-w-7xl mx-auto px-6 pt-10 pb-10">

        <!-- ================= FILTER ================= -->
        <section class="mb-10">

            <div class="flex items-center gap-4">

                <div
                    class="w-14 h-14 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center">

                    <i class="fa-solid fa-book-open text-amber-500 text-2xl"></i>
                </div>

                <div>

                    <h1 class="text-3xl font-bold text-slate-900">
                        Tra cứu tài liệu
                    </h1>

                    <p class="mt-2 text-sm text-slate-500 leading-7 max-w-2xl">
                        Tìm kiếm và truy cập tài liệu học tập theo môn học, loại tài liệu hoặc từ khóa.
                    </p>

                </div>

            </div>

            <form id="searchForm" action="{{ route('documents.index') }}" method="GET"
                class="mt-6 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">

                <div class="grid grid-cols-1 lg:grid-cols-4 gap-5">

                    <!-- Keyword -->
                    <div class="relative lg:col-span-2">

                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-slate-400 text-lg"></i>
                        </div>

                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                            placeholder="Nhập tên tài liệu..." class="w-full h-14 rounded-2xl
                        border border-slate-200
                        bg-white
                        pl-12 pr-4
                        text-slate-700
                        placeholder:text-slate-400
                        transition
                        focus:outline-none
                        focus:border-amber-400
                        focus:ring-4
                        focus:ring-amber-100">

                    </div>

                    <!-- Subject -->
                    <div class="relative">

                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="fa-solid fa-book text-amber-500 text-lg"></i>
                        </div>

                        <select name="subject_code" class="w-full h-14 rounded-2xl
                        border border-slate-200
                        bg-white
                        pl-12 pr-10
                        text-slate-700
                        transition
                        focus:outline-none
                        focus:border-amber-400
                        focus:ring-4
                        focus:ring-amber-100">

                            <option value="">Tất cả môn học</option>

                            @foreach($subjects as $subject)

                            <option value="{{ $subject->subject_code }}" @selected(request('subject_code')==$subject->
                                subject_code)>

                                {{ $subject->subject_name }}

                            </option>

                            @endforeach

                        </select>

                    </div>
                    <!-- Document Type -->
                    <div class="relative">

                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="fa-solid fa-folder-open text-amber-500 text-lg"></i>
                        </div>

                        <select name="document_type_id" class="w-full h-14 rounded-2xl
                        border border-slate-200
                        bg-white
                        pl-12 pr-10
                        text-slate-700
                        transition
                        focus:outline-none
                        focus:border-amber-400
                        focus:ring-4
                        focus:ring-amber-100">

                            <option value="">Tất cả loại tài liệu</option>

                            @foreach($documentTypes as $type)

                            <option value="{{ $type->document_type_id }}" @selected(request('document_type_id')==$type->
                                document_type_id)>

                                {{ $type->type_name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <!-- ACTION -->
                <div class="mt-6 flex items-center justify-between flex-wrap gap-4">

                    <p class="text-sm text-slate-500">
                        Nhập từ khóa hoặc sử dụng bộ lọc để tìm tài liệu.
                    </p>

                    <div class="flex items-center gap-3">


                        <button type="button" id="resetButton" class="inline-flex items-center gap-2
                    rounded-xl
                    border border-slate-300
                    bg-white
                    px-5 py-3
                    text-sm
                    font-medium
                    text-slate-700
                    transition-all duration-300
                    hover:border-slate-400
                    hover:bg-slate-100">
                            <i class="fa-solid fa-rotate-left text-sm"></i>

                            Đặt lại

                        </button>


                        <button type="submit" class="inline-flex items-center gap-2
                        rounded-xl
                        bg-slate-900
                        px-6 py-3
                        text-sm
                        font-semibold
                        text-white
                        transition-all duration-300
                        hover:-translate-y-0.5
                        hover:bg-amber-500
                        hover:shadow-lg">

                            <i class="fa-solid fa-magnifying-glass"></i>

                            Tìm kiếm

                        </button>

                    </div>

                </div>

            </form>

        </section>
        <!-- ================= DOCUMENT LIST ================= -->
        <div id="document-list">
            <section>

                <!-- HEADER -->
                <div class="flex items-center justify-between mb-8">

                    <div>

                        <h2 class="text-2xl font-bold text-slate-900">
                            Danh sách tài liệu
                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Có {{ $documents->total() }} tài liệu được tìm thấy.
                        </p>

                    </div>

                </div>
                <!-- LIST -->
                <div class="space-y-5">

                    @forelse($documents as $document)

                    <div
                        class="group flex items-center justify-between gap-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:border-slate-300 hover:shadow-md">

                        <!-- LEFT -->
                        @auth
                        <a href="{{ route('documents.show', $document->document_id) }}"
                            class="flex flex-1 items-center gap-5 min-w-0">
                            @endauth

                            @guest
                            <a href="javascript:void(0)" class="flex flex-1 items-center gap-5 min-w-0 cursor-default">
                                @endguest
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
                                        $title = e($document->title);

                                        if(request()->filled('keyword')) {

                                        foreach(explode(' ', trim(request('keyword'))) as $word) {

                                        if($word === '') continue;

                                        $title = preg_replace(
                                        '/(' . preg_quote($word, '/') . ')/i',
                                        '<mark class="bg-yellow-300 text-red-600 font-bold px-1 rounded">$1</mark>',
                                        $title
                                        );
                                        }
                                        }
                                        @endphp

                                        {!! $title !!}

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

                            </a>

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

                    <!-- EMPTY -->
                    <div class="rounded-3xl border border-slate-200 bg-white px-10 py-20 text-center shadow-sm">

                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-slate-100">

                            <i class="fa-solid fa-folder-open text-3xl text-slate-500"></i>

                        </div>

                        <h3 class="mt-6 text-2xl font-bold text-slate-900">

                            Không tìm thấy tài liệu

                        </h3>

                        <p class="mt-3 text-slate-500 leading-7">

                            Không có tài liệu nào phù hợp với điều kiện tìm kiếm.

                        </p>

                        <a href="{{ route('documents.index') }}"
                            class="mt-8 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800 transition">

                            <i class="fa-solid fa-rotate-left"></i>

                            Xem tất cả tài liệu

                        </a>

                    </div>

                    @endforelse

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
        </div>
    </div>
</main>
<!-- LOGIN REQUIRED MODAL -->
<div id="loginRequiredModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm px-4">

    <div class="w-full max-w-md overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl">

        <!-- HEADER -->
        <div class="border-b border-slate-200 bg-slate-50 px-8 py-8 text-center">

            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-amber-50">

                <i class="fa-solid fa-lock text-3xl text-amber-500"></i>

            </div>

            <h2 class="mt-6 text-2xl font-black text-slate-800">

                Yêu cầu đăng nhập

            </h2>

            <p class="mt-3 text-sm leading-7 text-slate-500">

                Bạn cần đăng nhập để có thể tải xuống tài liệu học tập và
                sử dụng đầy đủ các chức năng của hệ thống.

            </p>

        </div>

        <!-- CONTENT -->
        <div class="px-8 py-6">

            <div class="flex items-start gap-3 rounded-2xl border border-amber-100 bg-amber-50 p-4">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white">

                    <i class="fa-solid fa-circle-info text-amber-500"></i>

                </div>

                <div>

                    <h4 class="text-sm font-bold text-slate-800">

                        Thông tin

                    </h4>

                    <p class="mt-1 text-sm leading-6 text-slate-600">

                        Sau khi đăng nhập, bạn có thể tải tài liệu,
                        lưu lịch sử tải xuống và truy cập đầy đủ các tài nguyên học tập.

                    </p>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-8 flex gap-3">

                <!-- CLOSE -->
                <button type="button" onclick="closeLoginRequiredModal()" class="flex-1
                    rounded-xl
                    border
                    border-slate-200
                    bg-white
                    py-3
                    text-sm
                    font-bold
                    text-slate-700
                    hover:bg-slate-50
                    transition-all
                    duration-300">

                    Đóng

                </button>

                <!-- LOGIN -->
                <a href="{{ route('login') }}" class="flex-1
                    rounded-xl
                    bg-amber-500
                    py-3
                    text-center
                    text-sm
                    font-bold
                    text-white
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
document.addEventListener("DOMContentLoaded", function() {

    const form = document.getElementById("searchForm");

    // Hàm tải danh sách tài liệu
    function loadDocuments(url = null) {

        let requestUrl;

        if (url) {
            requestUrl = url;
        } else {
            const params = new URLSearchParams(new FormData(form));
            requestUrl = "{{ route('documents.index') }}?" + params.toString();
        }

        fetch(requestUrl, {
                method: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
            .then(response => response.text())
            .then(html => {

                const parser = new DOMParser();
                const doc = parser.parseFromString(html, "text/html");

                const newList = doc.querySelector("#document-list");

                if (newList) {
                    document.querySelector("#document-list").innerHTML = newList.innerHTML;

                    // Cập nhật URL trên trình duyệt
                    window.history.pushState({}, "", requestUrl);
                }

            })
            .catch(error => {
                console.error("AJAX Error:", error);
            });
    }

    // Submit form tìm kiếm
    form.addEventListener("submit", function(e) {

        e.preventDefault();

        loadDocuments();

    });

    // Nút Làm mới
    document.getElementById('resetButton')?.addEventListener('click', function(e) {

        e.preventDefault();

        form.reset();

        loadDocuments("{{ route('documents.index') }}");

    });
    // Phân trang AJAX
    document.addEventListener("click", function(e) {

        const link = e.target.closest('a[href*="page="]');

        if (!link) return;

        e.preventDefault();

        loadDocuments(link.href);

    });

});

function showLoginRequiredModal() {

    const modal = document.getElementById('loginRequiredModal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

}

function closeLoginRequiredModal() {

    const modal = document.getElementById('loginRequiredModal');

    modal.classList.remove('flex');
    modal.classList.add('hidden');

}
</script>
@endpush