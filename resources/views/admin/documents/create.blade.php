@extends('layouts.admin')

@section('title', 'Thêm tài liệu')
@section('page-title', 'Thêm tài liệu')

@section('content')

<div class="max-w-5xl mx-auto">

    <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        {{-- HEADER --}}
        <div class="bg-white border border-slate-200 rounded-md shadow-sm mb-6">

            <div class="px-6 py-5 border-b border-slate-200">

                <h2 class="text-lg font-black text-slate-700">

                    Thêm tài liệu mới

                </h2>

                <p class="text-sm text-slate-500 mt-1">

                    Điền đầy đủ thông tin để tải tài liệu lên hệ thống.

                </p>

            </div>

            <div class="px-6 py-5">

                @if ($errors->any())

                <div class="rounded-md border border-red-200 bg-red-50 p-4">

                    <div class="flex items-center gap-2 mb-2">

                        <i class="fa-solid fa-circle-exclamation text-red-500"></i>

                        <span class="font-black text-red-600">

                            Vui lòng kiểm tra lại thông tin

                        </span>

                    </div>

                    <ul class="list-disc list-inside text-sm text-red-600 space-y-1">

                        @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

                @endif

            </div>

        </div>

        {{-- ========================= --}}
        {{-- THÔNG TIN TÀI LIỆU --}}
        {{-- ========================= --}}

        <div class="bg-white border border-slate-200 rounded-md shadow-sm">

            <div class="px-6 py-4 border-b border-slate-200">

                <h3 class="font-black text-slate-700">

                    Thông tin tài liệu

                </h3>

                <p class="text-xs text-slate-500 mt-1">

                    Thông tin cơ bản của tài liệu.

                </p>

            </div>

            <div class="p-6 space-y-6">

                {{-- TÊN --}}
                <div>

                    <label class="block text-sm font-black text-slate-700 mb-2">

                        Tên tài liệu
                        <span class="text-red-500">*</span>

                    </label>

                    <input type="text" name="title" value="{{ old('title') }}"
                        placeholder="Ví dụ: Slide Chương 1 Laravel" class="w-full h-11 px-4 rounded-md border border-slate-300
                        focus:ring-2 focus:ring-sky-500 focus:border-sky-500">

                    @error('title')

                    <p class="text-red-500 text-sm mt-2">

                        {{ $message }}

                    </p>

                    @enderror

                </div>

                {{-- MÔN HỌC + LOẠI --}}
                <div class="grid grid-cols-2 gap-6">

                    {{-- MÔN HỌC --}}
                    <div>

                        <label class="block text-sm font-black text-slate-700 mb-2">

                            Môn học
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="subject_code" class="w-full h-11 px-4 rounded-md border border-slate-300
                            focus:ring-2 focus:ring-sky-500">

                            <option value="">

                                -- Chọn môn học --

                            </option>

                            @foreach($subjects as $subject)

                            <option value="{{ $subject->subject_code }}" @selected(old('subject_code')==$subject->
                                subject_code)>

                                {{ $subject->subject_code }}
                                -
                                {{ $subject->subject_name }}

                            </option>

                            @endforeach

                        </select>

                        @error('subject_code')

                        <p class="text-red-500 text-sm mt-2">

                            {{ $message }}

                        </p>

                        @enderror

                    </div>

                    {{-- LOẠI --}}
                    <div>

                        <label class="block text-sm font-black text-slate-700 mb-2">

                            Loại tài liệu
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="document_type_id" class="w-full h-11 px-4 rounded-md border border-slate-300
                            focus:ring-2 focus:ring-sky-500">

                            <option value="">

                                -- Chọn loại tài liệu --

                            </option>

                            @foreach($documentTypes as $type)

                            <option value="{{ $type->document_type_id }}" @selected(old('document_type_id')==$type->
                                document_type_id)>

                                {{ $type->type_name }}

                            </option>

                            @endforeach

                        </select>

                        @error('document_type_id')

                        <p class="text-red-500 text-sm mt-2">

                            {{ $message }}

                        </p>

                        @enderror

                    </div>

                </div>

                {{-- MÔ TẢ --}}
                <div>

                    <label class="block text-sm font-black text-slate-700 mb-2">

                        Mô tả

                    </label>

                    <textarea name="description" rows="5" placeholder="Nhập mô tả tài liệu..." class="w-full rounded-md border border-slate-300
                        px-4 py-3 resize-none
                        focus:ring-2 focus:ring-sky-500">{{ old('description') }}</textarea>

                    @error('description')

                    <p class="text-red-500 text-sm mt-2">

                        {{ $message }}

                    </p>

                    @enderror

                </div>

            </div>

        </div>

        {{-- ========================= --}}
        {{-- THÔNG TIN PHIÊN BẢN --}}
        {{-- ========================= --}}

        <div class="bg-white border border-slate-200 rounded-md shadow-sm mt-6">

            <div class="px-6 py-4 border-b border-slate-200">

                <h3 class="font-black text-slate-700">

                    Thông tin phiên bản

                </h3>

                <p class="text-xs text-slate-500 mt-1">

                    Phiên bản đầu tiên của tài liệu.

                </p>

            </div>

            <div class="p-6 space-y-6">

                {{-- VERSION --}}
                <div>

                    <label class="block text-sm font-black text-slate-700 mb-2">

                        Phiên bản

                    </label>

                    <input type="text" value="1.0" readonly class="w-full h-11 px-4 rounded-md
                        bg-slate-100 border border-slate-200
                        text-slate-600 font-black">

                </div>

                {{-- VERSION NOTE --}}
                <div>

                    <label class="block text-sm font-black text-slate-700 mb-2">

                        Ghi chú phiên bản

                    </label>

                    <input type="text" name="version_note" value="{{ old('version_note') }}"
                        placeholder="Ví dụ: Phiên bản đầu tiên" class="w-full h-11 px-4 rounded-md border border-slate-300
                        focus:ring-2 focus:ring-sky-500">

                    @error('version_note')

                    <p class="text-red-500 text-sm mt-2">

                        {{ $message }}

                    </p>

                    @enderror

                </div>

            </div>

        </div>
        {{-- ========================= --}}
        {{-- TẢI LÊN TÀI LIỆU --}}
        {{-- ========================= --}}

        <div class="bg-white border border-slate-200 rounded-md shadow-sm mt-6">

            <div class="px-6 py-4 border-b border-slate-200">

                <h3 class="font-black text-slate-700">

                    Tải lên tài liệu

                </h3>

                <p class="text-xs text-slate-500 mt-1">

                    Chọn file để tạo phiên bản đầu tiên của tài liệu.

                </p>

            </div>

            <div class="p-6">

                {{-- FILE --}}
                <label for="document-file" id="drop-area" class="flex flex-col items-center justify-center
                    border-2 border-dashed border-slate-300
                    rounded-md p-10 cursor-pointer
                    hover:border-sky-400 hover:bg-sky-50 transition">

                    <div id="preview-icon" class="w-16 h-16 rounded-full bg-sky-100
                        text-sky-600 flex items-center justify-center">

                        <i class="fa-solid fa-cloud-arrow-up text-2xl"></i>

                    </div>

                    <h4 class="mt-4 font-black text-slate-700">

                        Kéo & thả file vào đây

                    </h4>

                    <p class="text-sm text-slate-500 mt-2">

                        hoặc

                    </p>

                    <span class="mt-3 px-4 py-2 rounded-md
                        bg-sky-500 text-white text-sm font-black">

                        Chọn file

                    </span>

                    <p class="text-xs text-slate-400 mt-5 text-center">

                        Hỗ trợ:
                        PDF, DOC, DOCX,
                        XLS, XLSX,
                        PPT, PPTX,
                        ZIP, RAR

                        <br>

                        Dung lượng tối đa:
                        <span class="font-black">

                            50 MB

                        </span>

                    </p>

                </label>

                <input id="document-file" type="file" name="file" hidden
                    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar">

                @error('file')

                <p class="text-red-500 text-sm mt-2">

                    {{ $message }}

                </p>

                @enderror

                {{-- PREVIEW --}}
                <div id="file-preview" class="hidden mt-6 border border-slate-200 rounded-md p-5 bg-slate-50">

                    <div class="flex items-center gap-4">
                        <div id="file-icon"
                            class="file-icon w-12 h-12 rounded-md bg-sky-100 text-sky-600 flex items-center justify-center">

                            <i class="fa-solid fa-file-lines text-xl"></i>

                        </div>

                        <div class="flex-1 min-w-0">

                            <p id="file-name" class="font-black text-slate-700 truncate">

                            </p>

                            <p id="file-size" class="text-sm text-slate-500 mt-1">

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- ========================= --}}
        {{-- FOOTER --}}
        {{-- ========================= --}}

        <div class="flex justify-end gap-3 mt-6">

            <a href="{{ route('admin.documents.index') }}" class="inline-flex items-center gap-2
                h-11 px-5 rounded-md
                bg-white border border-slate-300
                text-slate-700 font-black
                hover:bg-slate-100 transition">

                <i class="fa-solid fa-arrow-left"></i>

                Quay lại

            </a>

            <button id="submitBtn" type="submit" class="inline-flex items-center gap-2
                h-11 px-6 rounded-md
                bg-sky-500 text-white
                font-black
                hover:bg-sky-600 transition">

                <i class="fa-solid fa-upload"></i>

                Tải lên tài liệu

            </button>

        </div>

    </form>

</div>

@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const form = document.querySelector('form');

    const input = document.getElementById('document-file');

    const preview = document.getElementById('file-preview');

    const fileName = document.getElementById('file-name');

    const fileSize = document.getElementById('file-size');

    const iconBox = document.getElementById('file-icon');

    const icon = iconBox.querySelector('i');

    const submitBtn = form.querySelector('button[type="submit"]');

    const MAX_SIZE = 50 * 1024 * 1024;

    const allowExtensions = [
        'pdf',
        'doc',
        'docx',
        'ppt',
        'pptx',
        'xls',
        'xlsx',
        'zip',
        'rar'
    ];

    //-------------------------------------
    // Preview File
    //-------------------------------------

    input.addEventListener('change', function() {

        if (!this.files.length) {

            preview.classList.add('hidden');

            return;

        }

        previewFile(this.files[0]);

    });

    //-------------------------------------
    // Drag & Drop
    //-------------------------------------

    preview.addEventListener('dragover', function(e) {

        e.preventDefault();

        preview.classList.add('ring-2', 'ring-sky-400');

    });

    preview.addEventListener('dragleave', function() {

        preview.classList.remove('ring-2', 'ring-sky-400');

    });

    preview.addEventListener('drop', function(e) {

        e.preventDefault();

        preview.classList.remove('ring-2', 'ring-sky-400');

        if (!e.dataTransfer.files.length) return;

        input.files = e.dataTransfer.files;

        previewFile(e.dataTransfer.files[0]);

    });

    //-------------------------------------
    // Submit Loading
    //-------------------------------------

    form.addEventListener('submit', function() {

        submitBtn.disabled = true;

        submitBtn.innerHTML =
            '<i class="fa-solid fa-spinner fa-spin mr-2"></i>Đang tải lên...';

    });

    //-------------------------------------
    // Hàm Preview
    //-------------------------------------

    function previewFile(file) {

        const ext = file.name.split('.').pop().toLowerCase();

        if (!allowExtensions.includes(ext)) {

            alert('Định dạng file không được hỗ trợ.');

            input.value = '';

            preview.classList.add('hidden');

            return;

        }

        if (file.size > MAX_SIZE) {

            alert('Dung lượng tối đa là 50MB.');

            input.value = '';

            preview.classList.add('hidden');

            return;

        }

        fileName.textContent = file.name;

        fileSize.textContent =
            formatSize(file.size);

        setIcon(ext);

        preview.classList.remove('hidden');

    }

    //-------------------------------------
    // Đổi icon
    //-------------------------------------

    function setIcon(ext) {

        icon.className = '';

        iconBox.className = 'file-icon w-12 h-12 rounded-md flex items-center justify-center';

        switch (ext) {

            case 'pdf':

                icon.className = 'fa-solid fa-file-pdf text-xl';

                iconBox.classList.add(
                    'bg-red-50',
                    'text-red-500'
                );

                break;

            case 'doc':
            case 'docx':

                icon.className = 'fa-solid fa-file-word text-xl';

                iconBox.classList.add(
                    'bg-blue-50',
                    'text-blue-600'
                );

                break;

            case 'xls':
            case 'xlsx':

                icon.className = 'fa-solid fa-file-excel text-xl';

                iconBox.classList.add(
                    'bg-green-50',
                    'text-green-600'
                );

                break;

            case 'ppt':
            case 'pptx':

                icon.className = 'fa-solid fa-file-powerpoint text-xl';

                iconBox.classList.add(
                    'bg-orange-50',
                    'text-orange-600'
                );

                break;

            case 'zip':
            case 'rar':

                icon.className = 'fa-solid fa-file-zipper text-xl';

                iconBox.classList.add(
                    'bg-yellow-50',
                    'text-yellow-600'
                );

                break;

            default:

                icon.className = 'fa-solid fa-file-lines text-xl';

                iconBox.classList.add(
                    'bg-slate-100',
                    'text-slate-600'
                );

        }

    }

    //-------------------------------------
    // Format Size
    //-------------------------------------

    function formatSize(bytes) {

        if (bytes >= 1024 * 1024) {

            return (bytes / 1024 / 1024).toFixed(2) + ' MB';

        }

        return (bytes / 1024).toFixed(2) + ' KB';

    }

});
</script>
@endpush