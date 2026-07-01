@extends('layouts.app')

@section('title', 'Danh sách tài liệu')

@section('content')

<main class="min-h-screen bg-[#EAFBFF] py-12">
    <div class="max-w-7xl mx-auto px-6">

        <!-- HEADER -->
        <section class="mb-8 rounded-[32px] bg-cyan-600 text-white p-8 shadow-xl">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">
                <div>
                    <a href="javascript:history.back()"
                        class="inline-flex items-center gap-2 mb-6 px-5 py-2.5 rounded-full bg-slate-100 hover:bg-cyan-50 text-slate-600 hover:text-cyan-600 text-xs font-black uppercase tracking-wider transition-all">
                        <i class="fa-solid fa-arrow-left"></i>
                        Quay lại
                    </a>

                    <h1 class="text-4xl font-black mb-2">
                        Danh sách tài liệu
                    </h1>

                    <p class="text-cyan-50">
                        Tìm kiếm, lọc và tải tài liệu học tập theo từng môn học.
                    </p>
                </div>

                @auth
                @if(in_array(auth()->user()->role_id, [1,2]))
                <a href="{{ route('documents.create') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-cyan-300 text-cyan-950 font-black hover:bg-cyan-200 transition">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    Đăng tài liệu

                </a>
                @endif
                @endauth
            </div>
        </section>
        <!-- FILTER -->
        <section class="mb-8 bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden">

            <div class="px-7 py-5 border-b border-cyan-100 bg-cyan-50">
                <h2 class="text-lg font-black text-slate-800">
                    Tìm kiếm tài liệu
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Tìm kiếm theo tên tài liệu, môn học hoặc loại tài liệu.
                </p>
            </div>

            <form action="{{ route('documents.index') }}" method="GET" class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">

                    <!-- Từ khóa -->
                    <div class="lg:col-span-2 relative">

                        <i
                            class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-cyan-500"></i>

                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                            placeholder="Nhập tên tài liệu..."
                            class="w-full h-12 rounded-xl border border-cyan-100 bg-cyan-50 pl-11 pr-4">

                    </div>

                    <!-- Môn học -->
                    <select name="subject_code" class="h-12 rounded-xl border border-cyan-100 bg-cyan-50 px-4">

                        <option value="">Tất cả môn học</option>

                        @foreach($subjects as $subject)

                        <option value="{{ $subject->subject_code }}" @selected(request('subject_code')==$subject->
                            subject_code)>

                            {{ $subject->subject_name }}

                        </option>

                        @endforeach

                    </select>

                    <!-- Loại -->
                    <select name="document_type_id" class="h-12 rounded-xl border border-cyan-100 bg-cyan-50 px-4">

                        <option value="">Tất cả loại</option>

                        @foreach($documentTypes as $type)

                        <option value="{{ $type->document_type_id }}" @selected(request('document_type_id')==$type->
                            document_type_id)>

                            {{ $type->type_name }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="flex justify-end gap-3 mt-6">

                    <a href="{{ route('documents.index') }}"
                        class="px-6 py-3 rounded-xl border border-slate-200 hover:bg-slate-50">

                        Làm mới

                    </a>

                    <button type="submit"
                        class="px-7 py-3 rounded-xl bg-cyan-500 hover:bg-cyan-600 text-white font-bold">

                        <i class="fa-solid fa-search mr-2"></i>

                        Tìm kiếm

                    </button>

                </div>

            </form>

        </section>
        <!-- DOCUMENT LIST -->
        <section class="bg-white rounded-[32px] shadow-sm border border-cyan-100 overflow-hidden">

            <!-- HEADER -->
            <div id="course-files-list" class="px-7 py-5 border-b border-cyan-100 flex items-center justify-between">

                <div>
                    <h2 class="text-xl font-black text-slate-900">
                        Danh sách tài liệu
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Có {{ $documents->total() }} tài liệu
                    </p>
                </div>

                <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black">
                    {{ $documents->total() }} tài liệu
                </span>

            </div>

            <div id="course-files-list">

                <div class="divide-y divide-slate-100">

                    @forelse($documents as $document)

                    @php

                    $ext = strtolower($document->currentVersion?->file_extension);

                    switch ($ext) {

                    case 'pdf':
                    $icon = 'fa-file-pdf';
                    $color = 'bg-red-50 text-red-500 border-red-100';
                    break;

                    case 'doc':
                    case 'docx':
                    $icon = 'fa-file-word';
                    $color = 'bg-blue-50 text-blue-500 border-blue-100';
                    break;

                    case 'xls':
                    case 'xlsx':
                    $icon = 'fa-file-excel';
                    $color = 'bg-green-50 text-green-500 border-green-100';
                    break;

                    case 'ppt':
                    case 'pptx':
                    $icon = 'fa-file-powerpoint';
                    $color = 'bg-orange-50 text-orange-500 border-orange-100';
                    break;

                    default:
                    $icon = 'fa-file-lines';
                    $color = 'bg-cyan-50 text-cyan-500 border-cyan-100';
                    }

                    $isAdmin = auth()->check()
                    && auth()->user()->role->role_name == 'admin';

                    $isOwner = auth()->check()
                    && auth()->user()->role->role_name == 'lecturer'
                    && $document->uploaded_by == auth()->id();

                    @endphp

                    <div class="document-item flex items-center justify-between gap-6 px-6 py-5 hover:bg-cyan-50 transition"
                        data-owner="{{ auth()->check() && $document->uploaded_by == auth()->id() ? '1' : '0' }}">

                        <!-- LEFT -->
                        <div class="flex items-center gap-4 flex-1 min-w-0">

                            <div
                                class="w-14 h-14 rounded-2xl border {{ $color }} flex items-center justify-center shrink-0">
                                <i class="fa-solid {{ $icon }} text-2xl"></i>
                            </div>

                            <div class="flex-1 min-w-0">

                                <a href="{{ route('documents.show',$document->document_id) }}"
                                    class="block text-lg font-black text-slate-800 hover:text-cyan-600 truncate">

                                    {{ $document->title }}

                                </a>


                                <div class="flex flex-wrap items-center gap-3 mt-3 text-xs text-slate-500">

                                    <span>
                                        <i class="fa-solid fa-book text-cyan-500 mr-1"></i>
                                        {{ $document->subject?->subject_name }}
                                    </span>

                                    <span>•</span>

                                    <span>
                                        <i class="fa-solid fa-building-columns text-cyan-500 mr-1"></i>
                                        {{ $document->subject?->faculty?->faculty_name }}
                                    </span>

                                    <span>•</span>

                                    <span>
                                        <i class="fa-solid fa-user text-cyan-500 mr-1"></i>
                                        {{ $document->uploader?->full_name }}
                                    </span>

                                    <span>•</span>

                                    <span>
                                        <i class="fa-solid fa-calendar text-cyan-500 mr-1"></i>
                                        {{ $document->created_at->diffForHumans() }}
                                    </span>

                                    <span>•</span>

                                    <span class="font-semibold text-cyan-700">
                                        {{ $document->documentType?->type_name }}
                                    </span>

                                </div>

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="flex items-center gap-2 shrink-0">

                            @auth

                            <a href="{{ route('documents.download', $document) }}"
                                class="px-5 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-bold shadow-lg shadow-cyan-200">

                                <i class="fa-solid fa-cloud-arrow-down mr-1"></i>

                                Tải về

                            </a>
                            @else

                            <button onclick="showLoginRequiredModal()"
                                class="px-5 py-2.5 rounded-xl border border-cyan-200 text-cyan-600 hover:bg-cyan-50 text-sm font-bold">

                                <i class="fa-solid fa-lock mr-1"></i>

                                Đăng nhập

                            </button>

                            @endauth


                            @if($isAdmin || $isOwner)

                            <a href="{{ route('documents.edit',$document->document_id) }}"
                                class="w-10 h-10 rounded-xl border border-amber-200 text-amber-500 hover:bg-amber-500 hover:text-white flex items-center justify-center transition">

                                <i class="fa-solid fa-pen"></i>

                            </a>

                            <form action="{{ route('documents.destroy', $document) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc muốn xóa tài liệu này?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="w-10 h-10 rounded-xl border border-red-200 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition">

                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </form>

                            @endif

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

                <div class="flex items-center justify-center gap-2">

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
function showLoginRequiredModal() {
    const modal = document.getElementById('loginRequiredModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLoginRequiredModal() {
    const modal = document.getElementById('loginRequiredModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}
document.getElementById('searchForm').addEventListener('submit', function(e) {

    e.preventDefault();

    const form = this;
    const url = form.action + '?' + new URLSearchParams(new FormData(form));

    fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {

            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            const newList = doc.querySelector('#course-files-list');

            if (newList) {
                document.querySelector('#course-files-list').innerHTML = newList.innerHTML;
            }

        })
        .catch(error => console.error(error));

});
</script>