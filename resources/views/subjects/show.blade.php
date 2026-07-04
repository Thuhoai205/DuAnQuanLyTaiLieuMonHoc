@extends('layouts.app')

@section('title', 'Chi tiết môn học')

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
<main id="view-course-detail" class="min-h-screen ">
    <!-- HERO -->
    <section class="relative overflow-hidden text-white">

        <!-- Ảnh nền môn học -->
        <div class="absolute inset-0">
            <img src="{{ asset('img/subjects/' . $subject->thumbnail) }}" alt="{{ $subject->subject_name }}"
                class="w-full h-full object-cover">
        </div>

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/30"></div>

        <!-- Nội dung -->
        <div class="relative max-w-7xl mx-auto px-6 py-16">
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
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                <div class="flex items-center gap-6">

                    @php
                    $colorMap = [
                    'blue' => ['bg'=>'bg-sky-50','text'=>'text-sky-600'],
                    'green'=> ['bg'=>'bg-emerald-50','text'=>'text-emerald-600'],
                    'red'=> ['bg'=>'bg-red-50','text'=>'text-red-600'],
                    'yellow'=> ['bg'=>'bg-yellow-50','text'=>'text-yellow-600'],
                    'purple'=> ['bg'=>'bg-purple-50','text'=>'text-purple-600'],
                    ];

                    $cls = $colorMap[$subject->color ?? 'blue'] ?? $colorMap['blue'];
                    @endphp

                    <!-- Icon -->
                    <div class=" banner-title w-28 h-28 rounded-3xl bg-white/90 backdrop-blur-md
                           flex items-center justify-center shadow-2xl">

                        <i class="{{ $subject->icon ?? 'fa-solid fa-book' }} {{ $cls['text'] }} text-6xl"></i>

                    </div>

                    <!-- Thông tin -->
                    <div>

                        <p class=" banner-title text-cyan-100 text-sm font-black uppercase tracking-[0.25em] mb-3">
                            Chi tiết môn học
                        </p>

                        <h1 class="banner-title text-4xl md:text-5xl font-black drop-shadow-lg">
                            {{ $subject->subject_name }}
                        </h1>

                        <p class=" banner-subtitle text-white/90 mt-4 text-lg max-w-2xl leading-relaxed">
                            {{ $subject->description ?? 'Chưa có mô tả.' }}
                        </p>

                    </div>

                </div>

                @if($canUploadDocument)
                <button type="button" onclick="openSubjectUploadModal()" class="banner-title inline-flex items-center gap-2
    px-7 py-4
    rounded-2xl
    bg-slate-900
    text-white
    font-bold
    shadow-lg
    transition-all duration-300
    hover:bg-amber-500
    hover:-translate-y-0.5
    hover:shadow-xl">

                    <i class="fa-solid fa-cloud-arrow-up"></i>

                    Đăng tài liệu

                </button>
                @endif

            </div>

        </div>

    </section>

    <!-- CONTENT -->
    <section class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-12">

        <!-- STATS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 -mt-24 relative z-10 mb-10">

            <!-- Tổng tài liệu -->
            <div
                class="banner-subtitle bg-white rounded-[2rem] p-6 border border-slate-200 shadow-sm hover:shadow-lg transition-all duration-300">

                <div
                    class="w-14 h-14 rounded-2xl bg-slate-100 border border-slate-200 text-amber-500 flex items-center justify-center text-2xl mb-4">

                    <i class="fa-solid fa-file-lines"></i>

                </div>

                <p class="text-slate-500 font-semibold text-sm">
                    Tổng tài liệu
                </p>

                <h3 class="text-3xl font-black text-slate-900 mt-1">
                    {{ $subject->documents_count }}
                </h3>

            </div>

            <!-- Lượt tải -->
            <div
                class="banner-subtitle bg-white rounded-[2rem] p-6 border border-slate-200 shadow-sm hover:shadow-lg transition-all duration-300">

                <div
                    class="w-14 h-14 rounded-2xl bg-slate-100 border border-slate-200 text-amber-500 flex items-center justify-center text-2xl mb-4">

                    <i class="fa-solid fa-download"></i>

                </div>

                <p class="text-slate-500 font-semibold text-sm">
                    Lượt tải
                </p>

                <h3 class="text-3xl font-black text-slate-900 mt-1">
                    {{ $subject->documents->sum('download_count') }}
                </h3>

            </div>

        </div>
        <!-- TOOLBAR -->
        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-6 mb-8">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <!-- LEFT -->
                <div>

                    <h4 class="text-2xl font-black text-slate-900">
                        Tài liệu môn học
                        <span class="text-amber-500">
                            ({{ $subject->documents_count }})
                        </span>
                    </h4>

                    <p class="text-slate-500 text-sm mt-2">
                        Danh sách tài liệu, bài tập và slide của môn học.
                    </p>

                </div>

                <!-- RIGHT -->
                <div class="flex flex-col sm:flex-row items-center gap-4">

                    <div class="relative">

                        <div class="absolute inset-y-0 left-5 flex items-center">

                            <i class="fa-solid fa-magnifying-glass text-amber-500 text-lg"></i>

                        </div>

                        <input type="text" id="documentSearch" onkeyup="searchDocuments()"
                            placeholder="Tìm kiếm môn học..." class="w-full
        rounded-2xl
        border
        border-slate-200
        py-4
        pl-14
        pr-5
        text-slate-700
        placeholder:text-slate-400
        focus:border-amber-400
        focus:ring-4
        focus:ring-amber-100">

                    </div>

                    @auth
                    @if(auth()->user()->role->role_name === 'lecturer')

                    <div class="flex items-center bg-white border border-slate-200 rounded-2xl p-1 shadow-sm">

                        <button id="btnAllDocuments" type="button" onclick="filterDocuments('all')"
                            class="px-5 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-bold transition-all duration-300 hover:bg-amber-500">

                            Tất cả ({{ $subject->documents_count }})

                        </button>

                        <button id="btnMyDocuments" type="button" onclick="filterDocuments('mine')"
                            class="px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-amber-600 text-sm font-bold transition-all duration-300">

                            Của tôi

                        </button>

                    </div>

                    @endif
                    @endauth

                </div>

            </div>

        </div>
        <!-- DOCUMENT LIST -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">

            <div class="divide-y divide-slate-100">

                @forelse($documents as $document)


                <div id="course-files-list"
                    class="document-item p-6 hover:bg-cyan-50/60 transition-colors flex items-center gap-5 group"
                    data-owner="{{ Auth::check() && $document->uploaded_by == Auth::id() ? '1' : '0' }}">
                    <a href="{{ route('documents.show',$document->document_id) }}"
                        class="flex flex-1 items-center gap-5 min-w-0">

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

                            <h3 class="document-title truncate
                        text-lg
                        font-semibold
                        text-slate-800
                        transition-colors
                        group-hover:text-amber-500">

                                {{ $document->title }}

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


                <div id="emptyDocumentResult"
                    class="rounded-3xl border border-slate-200 bg-white px-10 py-20 text-center shadow-sm">

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
                <!-- EMPTY -->

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

<!-- UPLOAD MODAL -->
<!-- UPLOAD MODAL -->
<div id="subjectUploadModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">

    <div
        class="relative w-full max-w-xl max-h-[90vh] overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl">

        <!-- HEADER -->
        <div class="flex items-center justify-between border-b border-slate-200 bg-slate-50 px-6 py-5">

            <div class="flex items-center gap-4">

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-white shadow-md">

                    <i class="fa-solid fa-cloud-arrow-up text-lg"></i>

                </div>

                <div>

                    <h3 class="text-xl font-bold text-slate-900">

                        Upload tài liệu

                    </h3>

                    <p class="mt-1 text-sm text-slate-500">

                        Thêm tài liệu cho môn

                        <span class="font-semibold text-amber-600">

                            {{ $subject->subject_name }}

                        </span>

                    </p>

                </div>

            </div>

            <button type="button" onclick="closeSubjectUploadModal()"
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-600 transition-all duration-300 hover:bg-red-500 hover:text-white">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>

        <!-- FORM -->
        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data"
            class="max-h-[calc(90vh-88px)] overflow-y-auto p-6 space-y-5">

            @csrf

            <!-- Subject -->
            <input type="hidden" name="subject_code" value="{{ $subject->subject_code }}">

            {{-- Validation --}}
            @if ($errors->any())

            <div class="rounded-2xl border border-red-200 bg-red-50 p-4">

                <ul class="space-y-1 text-sm text-red-600">

                    @foreach ($errors->all() as $error)

                    <li>• {{ $error }}</li>

                    @endforeach

                </ul>

            </div>

            @endif
            <!-- FILE -->
            <div>

                <label class="group flex flex-col items-center justify-center
        w-full h-40
        rounded-3xl
        border-2 border-dashed border-slate-300
        bg-slate-50
        cursor-pointer
        transition-all duration-300
        hover:border-amber-400
        hover:bg-amber-50">

                    <input type="file" required name="file" id="subjectFileInput" class="hidden"
                        accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip,.rar" onchange="updateSubjectFileName(this)">

                    <div class="text-center">

                        <!-- ICON -->
                        <div id="uploadIcon" class="mx-auto mb-4
                flex h-16 w-16
                items-center justify-center
                rounded-2xl
                bg-slate-900
                text-white
                transition-all duration-300">

                            <i class="fa-solid fa-file-arrow-up text-2xl"></i>

                        </div>

                        <!-- File name -->
                        <p id="subjectUploadPrompt" class="text-base font-bold text-slate-800">

                            Chọn tài liệu để tải lên

                        </p>

                        <!-- File info -->
                        <p id="subjectFileTypesHint" class="mt-2 text-sm leading-6 text-slate-500">

                            PDF, DOCX, PPTX, XLSX, ZIP, RAR

                            <br>

                            Kích thước tối đa: <strong>50 MB</strong>

                        </p>

                    </div>

                </label>

            </div>
            <!-- TITLE -->
            <div>

                <label class="block mb-2 text-sm font-semibold text-slate-700">
                    Tên tài liệu
                </label>

                <input type="text" required name="title" value="{{ old('title') }}" placeholder="Nhập tên tài liệu..."
                    class="w-full h-12
        rounded-2xl
        border border-slate-300
        bg-white
        px-4
        text-sm
        text-slate-700
        placeholder:text-slate-400
        transition-all duration-300
        focus:outline-none
        focus:border-amber-400
        focus:ring-4
        focus:ring-amber-100">

            </div>

            <!-- Faculty + Subject -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- Faculty -->
                <div>

                    <label class="block mb-2 text-sm font-semibold text-slate-700">
                        Khoa
                    </label>

                    <input type="text" readonly value="{{ $subject->faculty?->faculty_name }}" class="w-full h-12
            rounded-2xl
            border border-slate-200
            bg-slate-100
            px-4
            text-sm
            font-medium
            text-slate-600
            cursor-not-allowed">

                </div>

                <!-- Subject -->
                <div>

                    <label class="block mb-2 text-sm font-semibold text-slate-700">
                        Môn học
                    </label>

                    <input type="text" readonly value="{{ $subject->subject_name }}" class="w-full h-12
            rounded-2xl
            border border-slate-200
            bg-slate-100
            px-4
            text-sm
            font-medium
            text-slate-600
            cursor-not-allowed">

                </div>

            </div>

            <!-- Document Type -->
            <div>

                <label class="block mb-2 text-sm font-semibold text-slate-700">
                    Loại tài liệu
                </label>

                <select name="document_type_id" required class="w-full h-12
        rounded-2xl
        border border-slate-300
        bg-white
        px-4
        text-sm
        text-slate-700
        transition-all duration-300
        focus:outline-none
        focus:border-amber-400
        focus:ring-4
        focus:ring-amber-100">

                    @foreach ($documentTypes as $type)

                    <option value="{{ $type->document_type_id }}" @selected(old('document_type_id')==$type->
                        document_type_id)>

                        {{ $type->type_name }}

                    </option>

                    @endforeach

                </select>

            </div>

            <!-- Description -->
            <div>

                <label class="block mb-2 text-sm font-semibold text-slate-700">
                    Mô tả
                </label>

                <textarea rows="4" name="description" placeholder="Nhập mô tả tài liệu..." class="w-full
        rounded-2xl
        border border-slate-300
        bg-white
        px-4 py-3
        text-sm
        text-slate-700
        placeholder:text-slate-400
        resize-none
        transition-all duration-300
        focus:outline-none
        focus:border-amber-400
        focus:ring-4
        focus:ring-amber-100">{{ old('description') }}</textarea>

            </div>



            <!-- BUTTONS -->
            <div class="flex justify-end gap-3 pt-5 border-t border-slate-200">

                <!-- Hủy -->
                <button type="button" onclick="closeSubjectUploadModal()" class="inline-flex items-center gap-2
        rounded-2xl
        border border-slate-300
        bg-white
        px-6 py-3
        text-sm
        font-semibold
        text-slate-700
        transition-all duration-300
        hover:bg-slate-100">

                    <i class="fa-solid fa-xmark"></i>

                    Hủy

                </button>

                <!-- Upload -->
                <button id="uploadBtn" type="submit" class="inline-flex items-center gap-2
        rounded-2xl
        bg-slate-900
        px-7 py-3
        text-sm
        font-semibold
        text-white
        transition-all duration-300
        hover:bg-amber-500
        hover:shadow-lg">

                    <i class="fa-solid fa-cloud-arrow-up"></i>

                    Upload tài liệu

                </button>

            </div>

        </form>

    </div>

</div>










<!-- LOGIN REQUIRED MODAL -->
<div id="loginRequiredModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 backdrop-blur-sm px-4">

    <div class="w-full max-w-md rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-2xl">

        <!-- ICON -->
        <div
            class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full border border-slate-200 bg-slate-100">

            <i class="fa-solid fa-lock text-3xl text-amber-500"></i>

        </div>

        <!-- TITLE -->
        <h3 class="text-2xl font-bold text-slate-900">

            Yêu cầu đăng nhập

        </h3>

        <!-- DESCRIPTION -->
        <p class="mt-3 leading-7 text-slate-500">

            Bạn cần đăng nhập để tải tài liệu học tập.
            Vui lòng đăng nhập để tiếp tục.

        </p>

        <!-- BUTTON -->
        <div class="mt-8 flex items-center justify-center gap-3">

            <!-- Close -->
            <button onclick="closeLoginRequiredModal()"
                class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">

                Đóng

            </button>

            <!-- Login -->
            <a href="{{ route('login') }}"
                class="rounded-xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-amber-500">

                Đăng nhập

            </a>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
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

function removeVietnameseTones(str) {
    if (!str) return "";

    return str
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .replace(/đ/g, "d")
        .replace(/Đ/g, "D")
        .trim()
        .toLowerCase();
}
let currentFilter = 'all';

function searchDocuments() {

    const keyword = removeVietnameseTones(
        document.getElementById('documentSearch').value.trim()
    );

    const cards = document.querySelectorAll('.document-item');
    const empty = document.getElementById('emptyDocumentResult');

    let hasVisible = false;

    cards.forEach(card => {

        const title = removeVietnameseTones(
            card.querySelector('.document-title').innerText
        );

        const owner = card.dataset.owner === '1';

        const matchKeyword = title.includes(keyword);

        const matchFilter =
            currentFilter === 'all' ?
            true :
            owner;

        if (matchKeyword && matchFilter) {

            card.style.display = 'flex';
            hasVisible = true;

        } else {

            card.style.display = 'none';

        }

    });

    empty.classList.toggle('hidden', hasVisible);

}

function filterDocuments(type) {

    currentFilter = type;

    document.getElementById('btnAllDocuments').className =
        type === 'all' ?
        'px-5 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-bold transition-all duration-300 hover:bg-amber-500' :
        'px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-amber-600 text-sm font-bold transition-all duration-300';

    document.getElementById('btnMyDocuments').className =
        type === 'mine' ?
        'px-5 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-bold transition-all duration-300 hover:bg-amber-500' :
        'px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 hover:text-amber-600 text-sm font-bold transition-all duration-300';

    searchDocuments();

}

function openSubjectUploadModal() {

    const modal = document.getElementById('subjectUploadModal');

    if (!modal) {
        console.log('Không tìm thấy modal');
        return;
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.body.style.overflow = 'hidden';
}

function closeSubjectUploadModal() {

    const modal = document.getElementById('subjectUploadModal');

    modal.classList.remove('flex');
    modal.classList.add('hidden');

    document.body.style.overflow = '';
}

function updateSubjectFileName(input) {

    const prompt = document.getElementById('subjectUploadPrompt');
    const hint = document.getElementById('subjectFileTypesHint');
    const icon = document.getElementById('uploadIcon');

    if (input.files.length === 0) {

        prompt.innerHTML = "Chọn tài liệu để tải lên";

        hint.innerHTML = `
            PDF, DOCX, PPTX, XLSX, ZIP, RAR
            <br>
            Kích thước tối đa: <strong>50 MB</strong>
        `;

        icon.classList.remove("bg-emerald-500");
        icon.classList.add("bg-slate-900");

        return;
    }

    const file = input.files[0];

    const size = (file.size / 1024 / 1024).toFixed(2);

    prompt.innerHTML = `
        <span class="text-emerald-600">
            <i class="fa-solid fa-circle-check mr-1"></i>
            ${file.name}
        </span>
    `;

    hint.innerHTML = `
        Dung lượng:
        <strong>${size} MB</strong>
    `;

    icon.classList.remove("bg-slate-900");
    icon.classList.add("bg-emerald-500");

}
</script>
@endpush