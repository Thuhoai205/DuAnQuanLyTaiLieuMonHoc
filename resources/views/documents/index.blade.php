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
<main class="min-h-screen bg-[#EAFBFF] ">
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
    <div class="bg-cyan-50 py-3 border-b border-cyan-100">
        <div class="max-w-7xl mx-auto px-4 md:px-6 flex items-center text-sm">
            <a href="/" class="text-slate-600 hover:text-cyan-600 transition">
                Trang chủ
            </a>

            <span class="mx-2 text-slate-400">
                /
            </span>

            <span class="font-medium text-cyan-600">
                Tra cứu tài liệu
            </span>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 pt-10 pb-10">
        <!-- ================= FILTER ================= -->
        <section class="mb-10">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-2xl bg-cyan-50 border border-cyan-100
                       flex items-center justify-center">

                    <i class="fa-solid fa-file-lines text-cyan-600 text-2xl"></i>

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
                            <i class="fa-solid fa-magnifying-glass text-cyan-500 text-lg"></i>
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
        focus:border-cyan-500
        focus:ring-4
        focus:ring-cyan-100">

                    </div>

                    <!-- Subject -->
                    <div class="relative">

                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="fa-solid fa-book text-cyan-500 text-lg"></i>
                        </div>

                        <select name="subject_code" class="w-full h-14 rounded-2xl
        border border-slate-200
        bg-white
        pl-12 pr-10
        text-slate-700
        transition
        focus:outline-none
        focus:border-cyan-500
        focus:ring-4
        focus:ring-cyan-100">

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
                            <i class="fa-solid fa-folder-open text-cyan-500 text-lg"></i>
                        </div>

                        <select name="document_type_id" class="w-full h-14 rounded-2xl
                    border border-slate-200
                    bg-white
                    pl-12 pr-10
                    text-slate-700
                    transition
                    focus:outline-none
                    focus:border-cyan-500
                    focus:ring-4
                    focus:ring-cyan-100">

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

                <!-- Buttons -->
                <div class="mt-8 flex flex-wrap justify-end gap-4">

                    <button type="button" id="resetBtn" class="inline-flex items-center justify-center
            h-12 px-6 rounded-xl
            border border-slate-200
            bg-white
            text-slate-600
            hover:bg-slate-50
            transition">

                        <i class="fa-solid fa-rotate-left mr-2"></i>

                        Làm mới

                    </button>

                    <button type="submit" class="inline-flex items-center justify-center
                h-12
                px-8
                rounded-xl
                bg-cyan-500
                text-white
                font-semibold
                hover:bg-cyan-600
                transition">

                        <i class="fa-solid fa-search mr-2"></i>

                        Tìm kiếm

                    </button>

                </div>

            </form>

        </section>
        <div id="document-list">
            <!-- ================= DOCUMENT LIST ================= -->
            <section class="rounded-3xl bg-white border border-slate-200 shadow-sm overflow-hidden">

                <!-- Header -->
                <div class="flex items-center justify-between px-8 py-6 border-b border-slate-100">

                    <div>

                        <h2 class="text-2xl font-bold text-slate-800">
                            Danh sách tài liệu
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Hiện có <span class="font-semibold text-cyan-600">{{ $documents->total() }}</span> tài liệu.
                        </p>

                    </div>

                    <div class="hidden md:flex items-center gap-2">

                        <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-sm font-semibold">
                            {{ $documents->total() }} tài liệu
                        </span>

                    </div>

                </div>

                <div class="p-6">

                    <div class="space-y-4">

                        @forelse($documents as $document)

                        @php

                        $ext = strtolower($document->currentVersion?->file_extension);

                        switch ($ext) {

                        case 'pdf':
                        $icon='fa-file-pdf';
                        $iconColor='text-red-500';
                        $bg='bg-red-50';
                        break;

                        case 'doc':
                        case 'docx':
                        $icon='fa-file-word';
                        $iconColor='text-blue-500';
                        $bg='bg-blue-50';
                        break;

                        case 'xls':
                        case 'xlsx':
                        $icon='fa-file-excel';
                        $iconColor='text-green-500';
                        $bg='bg-green-50';
                        break;

                        case 'ppt':
                        case 'pptx':
                        $icon='fa-file-powerpoint';
                        $iconColor='text-orange-500';
                        $bg='bg-orange-50';
                        break;

                        default:
                        $icon='fa-file-lines';
                        $iconColor='text-cyan-500';
                        $bg='bg-cyan-50';

                        }

                        $isAdmin = auth()->check()
                        && auth()->user()->role->role_name == 'admin';

                        $isOwner = auth()->check()
                        && auth()->user()->role->role_name == 'lecturer'
                        && $document->uploaded_by == auth()->id();

                        @endphp

                        <div
                            class="group rounded-2xl border border-slate-200 bg-white p-6 hover:border-cyan-300 hover:shadow-md transition duration-300">

                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                                <!-- Left -->
                                <div class="flex gap-4 flex-1 min-w-0">

                                    <div
                                        class="w-14 h-14 rounded-2xl {{ $bg }} flex items-center justify-center shrink-0">

                                        <i class="fa-solid {{ $icon }} {{ $iconColor }} text-2xl"></i>

                                    </div>

                                    <div class="flex-1 min-w-0">

                                        <a href="{{ route('documents.show',$document->document_id) }}"
                                            class="text-lg font-semibold text-slate-800 hover:text-cyan-600 transition line-clamp-1">

                                            {{ $document->title }}

                                        </a>

                                        <div class="mt-4 flex flex-wrap gap-2">

                                            <span
                                                class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-600">

                                                <i class="fa-solid fa-book text-cyan-500"></i>

                                                {{ $document->subject?->subject_name }}

                                            </span>

                                            <span
                                                class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-600">

                                                <i class="fa-solid fa-building-columns text-cyan-500"></i>

                                                {{ $document->subject?->faculty?->faculty_name }}

                                            </span>

                                            <span
                                                class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-600">

                                                <i class="fa-solid fa-user text-cyan-500"></i>

                                                {{ $document->uploader?->full_name }}

                                            </span>

                                            <span
                                                class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-600">

                                                <i class="fa-solid fa-clock text-cyan-500"></i>

                                                {{ $document->created_at->diffForHumans() }}

                                            </span>

                                            <span
                                                class="inline-flex items-center rounded-full bg-cyan-50 px-3 py-1 text-xs font-semibold text-cyan-700">

                                                {{ $document->documentType?->type_name }}

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <!-- Right -->
                                <div class="flex items-center flex-wrap gap-2">


                                    @auth

                                    <a href="{{ route('documents.download',$document) }}"
                                        class="inline-flex items-center justify-center h-11 px-5 rounded-xl bg-cyan-500 hover:bg-cyan-600 text-white font-medium transition">

                                        <i class="fa-solid fa-download mr-2"></i>

                                        Tải xuống

                                    </a>

                                    @else

                                    <button onclick="showLoginRequiredModal()"
                                        class="inline-flex items-center justify-center h-11 px-5 rounded-xl border border-cyan-200 text-cyan-600 hover:bg-cyan-50 transition">

                                        <i class="fa-solid fa-lock mr-2"></i>

                                        Đăng nhập

                                    </button>

                                    @endauth

                                    @if($isAdmin || $isOwner)

                                    <a href="{{ route('documents.edit',$document->document_id) }}"
                                        class="w-11 h-11 rounded-xl border border-amber-200 text-amber-500 hover:bg-amber-500 hover:text-white transition flex items-center justify-center">

                                        <i class="fa-solid fa-pen"></i>

                                    </a>

                                    <form action="{{ route('documents.destroy',$document) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc muốn xóa tài liệu này?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="w-11 h-11 rounded-xl border border-red-200 text-red-500 hover:bg-red-500 hover:text-white transition flex items-center justify-center">

                                            <i class="fa-solid fa-trash"></i>

                                        </button>

                                    </form>

                                    @endif

                                </div>

                            </div>

                        </div>

                        @empty

                        <div id="emptyDocumentResult" class="py-20 text-center">

                            <div class="w-20 h-20 mx-auto rounded-full bg-cyan-50 flex items-center justify-center">
                                <i class="fa-solid fa-folder-open text-3xl text-cyan-500"></i>
                            </div>

                            <h3 class="mt-5 text-xl font-black text-slate-800">
                                Chưa có tài liệu
                            </h3>

                            <p class="mt-2 text-slate-500">
                                Hiện chưa có tài liệu nào trong hệ thống.
                            </p>

                        </div>

                        @endforelse

                    </div>

                </div>

                @if($documents->hasPages())

                <div class="px-6 py-6 border-t border-slate-100">

                    <div class="pagination flex items-center justify-center gap-2">
                        {{-- Previous --}}
                        @if($documents->onFirstPage())

                        <span
                            class="w-11 h-11 rounded-2xl border border-cyan-100 bg-white text-slate-300 flex items-center justify-center cursor-not-allowed">

                            <i class="fa-solid fa-chevron-left"></i>

                        </span>

                        @else

                        <a href="{{ $documents->previousPageUrl() }}"
                            class="w-11 h-11 rounded-2xl border border-cyan-100 bg-white text-slate-600 hover:bg-cyan-50 hover:text-cyan-600 transition flex items-center justify-center">

                            <i class="fa-solid fa-chevron-left"></i>

                        </a>

                        @endif


                        {{-- Page Number --}}
                        @foreach($documents->getUrlRange(1, $documents->lastPage()) as $page => $url)

                        @if($page == $documents->currentPage())

                        <span
                            class="w-11 h-11 rounded-2xl bg-cyan-500 text-white font-black shadow-lg shadow-cyan-200 flex items-center justify-center">

                            {{ $page }}

                        </span>

                        @else

                        <a href="{{ $url }}"
                            class="w-11 h-11 rounded-2xl border border-cyan-100 bg-white text-slate-600 font-bold hover:bg-cyan-50 hover:text-cyan-600 transition flex items-center justify-center">

                            {{ $page }}

                        </a>

                        @endif

                        @endforeach


                        {{-- Next --}}
                        @if($documents->hasMorePages())

                        <a href="{{ $documents->nextPageUrl() }}"
                            class="w-11 h-11 rounded-2xl border border-cyan-100 bg-white text-slate-600 hover:bg-cyan-50 hover:text-cyan-600 transition flex items-center justify-center">

                            <i class="fa-solid fa-chevron-right"></i>

                        </a>

                        @else

                        <span
                            class="w-11 h-11 rounded-2xl border border-cyan-100 bg-white text-slate-300 flex items-center justify-center cursor-not-allowed">

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
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {

    const form = document.getElementById("searchForm");
    const resetBtn = document.getElementById("resetBtn");

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
    if (resetBtn) {

        resetBtn.addEventListener("click", function() {

            form.reset();

            loadDocuments();

        });

    }

    // Phân trang AJAX
    document.addEventListener("click", function(e) {

        const link = e.target.closest('a[href*="page="]');

        if (!link) return;

        e.preventDefault();

        loadDocuments(link.href);

    });

});
</script>
@endpush