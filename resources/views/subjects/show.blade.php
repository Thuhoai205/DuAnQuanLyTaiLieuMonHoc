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
<main id="view-course-detail" class="min-h-screen bg-[#EAFBFF]">
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
                <button type="button" onclick="openSubjectUploadModal()" class="banner-title inline-flex items-center gap-2 px-7 py-4 rounded-2xl
                       bg-cyan-400 hover:bg-cyan-300 text-cyan-950
                       font-black shadow-2xl transition">

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
                class="banner-subtitle bg-white rounded-[2rem] p-6 border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">

                <div
                    class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-2xl mb-4">
                    <i class="fa-solid fa-file-lines"></i>
                </div>

                <p class="text-slate-500 font-bold text-sm">
                    Tổng tài liệu
                </p>

                <h3 class="text-3xl font-black text-cyan-600 mt-1">
                    {{ $subject->documents_count }}
                </h3>

            </div>

            <!-- Lượt tải -->
            <div
                class="banner-subtitle bg-white rounded-[2rem] p-6 border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">

                <div
                    class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-2xl mb-4">
                    <i class="fa-solid fa-download"></i>
                </div>

                <p class="text-slate-500 font-bold text-sm">
                    Lượt tải
                </p>

                <h3 class="text-3xl font-black text-cyan-600 mt-1">
                    {{ $subject->documents->sum('download_count') }}
                </h3>

            </div>

        </div>


        <!-- TOOLBAR -->
        <div class="bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-6 mb-8">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <!-- LEFT -->
                <div>

                    <h4 class="text-2xl font-black text-slate-900">
                        Tài liệu môn học
                        <span class="text-cyan-600">
                            ({{ $subject->documents_count }})
                        </span>
                    </h4>

                    <p class="text-slate-500 text-sm mt-2">
                        Danh sách tài liệu, bài tập và slide của môn học.
                    </p>

                </div>

                <!-- RIGHT -->
                <div class="flex flex-col sm:flex-row items-center gap-4">

                    <!-- SEARCH -->
                    <div class="relative w-full sm:w-80">

                        <i
                            class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-cyan-600 text-sm"></i>

                        <input type="text" id="documentSearch" onkeyup="searchDocuments()"
                            placeholder="Tìm theo tên tài liệu..."
                            class="w-full pl-11 pr-4 py-3 bg-cyan-50 border border-cyan-100 rounded-2xl text-sm font-semibold text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-300 focus:border-cyan-500 transition-all">

                    </div>

                    @auth
                    @if(auth()->user()->role->role_name === 'lecturer')

                    <div class="flex items-center bg-cyan-50 border border-cyan-100 rounded-2xl p-1 shadow-sm">

                        <button id="btnAllDocuments" type="button" onclick="filterDocuments('all')"
                            class="px-5 py-2.5 rounded-xl bg-cyan-500 text-white text-sm font-bold transition-all">

                            Tất cả ({{ $subject->documents_count }})

                        </button>

                        <button id="btnMyDocuments" type="button" onclick="filterDocuments('mine')"
                            class="px-5 py-2.5 rounded-xl text-cyan-700 hover:bg-white text-sm font-bold transition-all">

                            Của tôi

                        </button>

                    </div>

                    @endif
                    @endauth

                </div>

            </div>

        </div>
        <!-- DOCUMENT LIST -->
        <div id="course-files-list" class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">

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
                @endphp

                <div class="document-item p-6 hover:bg-cyan-50/60 transition-colors flex items-center gap-5 group"
                    data-owner="{{ Auth::check() && $document->uploaded_by == Auth::id() ? '1' : '0' }}">
                    <!-- ICON -->
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center shrink-0 border {{ $color }}">
                        <i class="fa-solid {{ $icon }} text-2xl"></i>
                    </div>

                    <!-- CONTENT -->
                    <a href="{{ route('documents.show',$document->document_id) }}" class="flex-grow min-w-0">

                        <h6
                            class="document-title font-bold text-slate-800 text-lg group-hover:text-cyan-600 transition truncate">

                            {{ $document->title }}

                        </h6>

                        <div class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">

                            <span>
                                <i class="fa-solid fa-book text-cyan-600 mr-1"></i>
                                {{ $subject->subject_name }}
                            </span>

                            <span>•</span>

                            <span>
                                <i class="fa-solid fa-building-columns text-cyan-600 mr-1"></i>
                                {{ $subject->faculty?->faculty_name }}
                            </span>

                            <span>•</span>

                            <span>
                                <i class="fa-solid fa-user-graduate text-cyan-600 mr-1"></i>
                                {{ $document->uploader?->full_name }}
                            </span>

                            <span>•</span>

                            <span>
                                <i class="fa-solid fa-calendar-check text-cyan-600 mr-1"></i>
                                {{ $document->created_at->diffForHumans() }}
                            </span>

                        </div>

                    </a>

                    <!-- BUTTON -->
                    <div class="shrink-0 flex items-center gap-2">

                        @auth

                        <a href="{{ route('documents.download', $document) }}"
                            class="px-5 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-bold shadow-lg shadow-cyan-200">

                            <i class="fa-solid fa-download mr-1"></i>

                            Tải xuống

                        </a>

                        @else

                        <button onclick="showLoginRequiredModal()"
                            class="px-5 py-2.5 border-2 border-cyan-100 text-cyan-700 font-bold rounded-xl hover:bg-cyan-50 transition flex items-center gap-2 text-sm">

                            <i class="fa-solid fa-lock"></i>

                            Đăng nhập để tải

                        </button>

                        @endauth


                        @auth

                        @if(Auth::user()->role->role_name === 'lecturer'
                        && $document->uploaded_by == Auth::id())

                        <a href="{{ route('documents.edit',$document->document_id) }}"
                            class="w-10 h-10 flex items-center justify-center text-amber-500 hover:bg-amber-500 hover:text-white rounded-xl transition bg-white border border-amber-100">

                            <i class="fa-solid fa-pen-to-square"></i>

                        </a>

                        <form action="{{ route('documents.destroy', $document->document_id) }}" method="POST"
                            onsubmit="return confirm('Bạn có chắc muốn xóa tài liệu này?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition border border-red-100">

                                <i class="fa-solid fa-trash"></i>

                            </button>

                        </form>

                        @endif

                        @endauth

                    </div>

                </div>

                @empty



                @endforelse
                <div id="emptyDocumentResult" class="hidden py-16 text-center">

                    <div class="w-20 h-20 mx-auto rounded-full bg-cyan-50 flex items-center justify-center">
                        <i class="fa-solid fa-magnifying-glass text-3xl text-cyan-500"></i>
                    </div>

                    <h3 class="mt-5 text-xl font-black text-slate-800">
                        Không tìm thấy tài liệu
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Không có tài liệu nào phù hợp.
                    </p>

                </div>

            </div>

        </div>

        <!-- PAGINATION -->
        @if($documents->hasPages())
        <div class="mt-10">
            {{ $documents->links() }}
        </div>
        @endif

    </section>
</main>

<!-- UPLOAD MODAL -->
<div id="subjectUploadModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/40 backdrop-blur-sm px-4">

    <div class="relative w-full max-w-2xl bg-white rounded-3xl border border-cyan-100 shadow-2xl overflow-hidden">

        <!-- HEADER -->
        <div class="px-6 py-5 border-b border-cyan-100 bg-cyan-50 flex items-center justify-between">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg">

                    <i class="fa-solid fa-cloud-arrow-up text-lg"></i>

                </div>

                <div>

                    <h3 class="text-xl font-black text-slate-800">
                        Upload tài liệu
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        Thêm tài liệu cho môn
                        <span class="font-bold text-cyan-700">
                            {{ $subject->subject_name }}
                        </span>
                    </p>

                </div>

            </div>

            <button type="button" onclick="closeSubjectUploadModal()"
                class="w-10 h-10 rounded-full bg-slate-100 hover:bg-red-500 hover:text-white transition">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>

        <!-- FORM -->
        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">

            @csrf

            <!-- Subject -->
            <input type="hidden" name="subject_code" value="{{ $subject->subject_code }}">

            {{-- Validation --}}
            @if ($errors->any())
            <div class="rounded-2xl bg-red-50 border border-red-200 p-4">
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
                   w-full h-44
                   border-2 border-dashed border-cyan-200
                   rounded-3xl cursor-pointer
                   hover:border-cyan-500 hover:bg-cyan-50
                   transition">

                    <input type="file" required name="file" id="subjectFileInput" class="hidden"
                        accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip,.rar" onchange="updateSubjectFileName(this)">

                    <div class="text-center">

                        <div class="w-16 h-16 mx-auto rounded-2xl
                            bg-cyan-500 text-white
                            flex items-center justify-center
                            mb-4 shadow-lg">

                            <i class="fa-solid fa-file-arrow-up text-2xl"></i>

                        </div>

                        <p id="subjectUploadPrompt" class="font-bold text-slate-700">

                            Chọn tài liệu để upload

                        </p>

                        <p id="subjectFileTypesHint" class="text-sm text-slate-500 mt-2">

                            PDF, DOCX, PPTX, XLSX, ZIP, RAR
                            <br>
                            Tối đa 50MB

                        </p>

                    </div>

                </label>
            </div>

            <!-- TITLE -->
            <div>

                <label class="block mb-2 text-sm font-bold text-slate-700">
                    Tên tài liệu
                </label>

                <input type="text" required name="title" value="{{ old('title') }}" placeholder="Nhập tên tài liệu..."
                    class="w-full rounded-2xl
                   border border-slate-300
                   px-4 py-3
                   focus:border-cyan-500
                   focus:ring-4
                   focus:ring-cyan-100
                   outline-none">

            </div>

            <!-- Faculty + Subject -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- Faculty -->
                <div>

                    <label class="block mb-2 text-sm font-bold text-slate-700">
                        Khoa
                    </label>

                    <input type="text" readonly value="{{ $subject->faculty?->faculty_name }}" class="w-full h-12 rounded-2xl
                       bg-cyan-50
                       border border-cyan-100
                       px-4
                       text-cyan-700
                       font-semibold
                       cursor-not-allowed">

                </div>

                <!-- Subject -->
                <div>

                    <label class="block mb-2 text-sm font-bold text-slate-700">
                        Môn học
                    </label>

                    <input type="text" readonly value="{{ $subject->subject_name }}" class="w-full h-12 rounded-2xl
                       bg-cyan-50
                       border border-cyan-100
                       px-4
                       text-cyan-700
                       font-semibold
                       cursor-not-allowed">

                </div>

            </div>

            <!-- Document Type -->
            <div>

                <label class="block mb-2 text-sm font-bold text-slate-700">
                    Loại tài liệu
                </label>

                <select name="document_type_id" required class="w-full h-12 rounded-2xl
                   border border-slate-300
                   px-4
                   focus:border-cyan-500
                   focus:ring-4
                   focus:ring-cyan-100">

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

                <label class="block mb-2 text-sm font-bold text-slate-700">
                    Mô tả
                </label>

                <textarea rows="4" name="description" placeholder="Nhập mô tả tài liệu..." class="w-full rounded-2xl
                   border border-slate-300
                   px-4 py-3
                   resize-none
                   focus:border-cyan-500
                   focus:ring-4
                   focus:ring-cyan-100">{{ old('description') }}</textarea>

            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">

                <button type="button" onclick="closeSubjectUploadModal()" class="px-6 py-3 rounded-2xl
                   border border-slate-300
                   font-bold
                   hover:bg-slate-100">

                    Hủy

                </button>

                <button id="uploadBtn" type="submit" class="px-8 py-3 rounded-2xl
                   bg-cyan-500
                   text-white
                   font-bold
                   hover:bg-cyan-600
                   shadow-lg shadow-cyan-200">

                    <i class="fa-solid fa-cloud-arrow-up mr-2"></i>

                    Upload tài liệu

                </button>

            </div>

        </form>

    </div>

</div>


<!-- LOGIN REQUIRED MODAL -->
<!-- LOGIN REQUIRED MODAL -->
<div id="loginRequiredModal"
    class="fixed inset-0 z-[99999] hidden items-center justify-center bg-black/50 backdrop-blur-sm px-4">
    <div
        class="relative z-[100000] w-full max-w-md bg-white rounded-[2rem] shadow-2xl border border-cyan-100 overflow-hidden">
        <!-- Nút đóng -->
        <button type="button" onclick="closeLoginRequiredModal()"
            class="absolute top-4 right-4 w-10 h-10 rounded-full bg-slate-100 text-slate-500 hover:bg-red-500 hover:text-white transition">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="p-8 text-center">

            <!-- Icon -->
            <div class="w-24 h-24 mx-auto rounded-full bg-cyan-50 flex items-center justify-center mb-6">

                <i class="fa-solid fa-lock text-4xl text-cyan-600"></i>

            </div>

            <!-- Title -->
            <h2 class="text-2xl font-black text-slate-900">
                Yêu cầu đăng nhập
            </h2>

            <!-- Description -->
            <p class="mt-4 text-slate-500 leading-7">
                Bạn cần đăng nhập để có thể tải tài liệu, xem chi tiết và sử dụng đầy đủ các chức năng của hệ thống.
            </p>

            <!-- Buttons -->
            <div class="flex items-center justify-center gap-4 mt-8">

                <button type="button" onclick="closeLoginRequiredModal()"
                    class="px-6 py-3 rounded-2xl border border-cyan-100 text-slate-600 font-bold hover:bg-slate-50 transition">

                    Để sau

                </button>

                <a href="{{ route('login') }}"
                    class="px-6 py-3 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-bold shadow-lg shadow-cyan-200 transition">

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

    document.body.style.overflow = '';
}
let currentDocumentFilter = 'all';

function searchDocuments() {

    const keyword = document
        .getElementById('documentSearch')
        .value
        .trim()
        .toLowerCase();

    const items = document.querySelectorAll('.document-item');
    const empty = document.getElementById('emptyDocumentResult');

    let hasVisible = false;

    items.forEach(item => {

        const title = item.querySelector('.document-title')
            .innerText
            .toLowerCase();

        const isMine = item.dataset.owner === '1';

        const matchKeyword = title.includes(keyword);

        const matchFilter =
            currentDocumentFilter === 'all' ?
            true :
            isMine;

        if (matchKeyword && matchFilter) {

            item.style.display = '';
            hasVisible = true;

        } else {

            item.style.display = 'none';

        }

    });

    if (empty) {
        empty.classList.toggle('hidden', hasVisible);
    }
}

function filterDocuments(type) {

    currentDocumentFilter = type;

    document.getElementById('btnAllDocuments').className =
        type === 'all' ?
        'px-5 py-2.5 rounded-xl bg-cyan-500 text-white text-sm font-bold transition-all' :
        'px-5 py-2.5 rounded-xl text-cyan-700 hover:bg-white text-sm font-bold transition-all';

    document.getElementById('btnMyDocuments').className =
        type === 'mine' ?
        'px-5 py-2.5 rounded-xl bg-cyan-500 text-white text-sm font-bold transition-all' :
        'px-5 py-2.5 rounded-xl text-cyan-700 hover:bg-white text-sm font-bold transition-all';

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
</script>
@endpush