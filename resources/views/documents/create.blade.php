@extends('layouts.app')

@section('title', 'Đăng tải tài liệu')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">

    <div class="mx-auto max-w-6xl px-6">
        <!-- PAGE HEADER -->
        <section
            class="mb-8 overflow-hidden rounded-3xl border border-slate-200 bg-slate-800 shadow-lg shadow-slate-300/30">

            <div class="flex flex-col gap-8 px-10 py-8 lg:flex-row lg:items-center lg:justify-between">

                <!-- LEFT -->
                <div class="flex items-center gap-5">

                    <!-- ICON -->
                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white shadow-md">

                        <i class="fa-solid fa-cloud-arrow-up text-3xl text-slate-700"></i>

                    </div>

                    <!-- CONTENT -->
                    <div>

                        <span
                            class="inline-flex items-center rounded-full border border-slate-500 bg-slate-700 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.2em] text-slate-100">

                            HỆ THỐNG QUẢN LÝ TÀI LIỆU

                        </span>

                        <h1 class="mt-3 text-3xl font-black text-white">

                            Đăng tải tài liệu

                        </h1>

                        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-300">

                            Thêm tài liệu mới vào hệ thống, quản lý học liệu và chia sẻ
                            cho sinh viên thuộc các môn học được phân công giảng dạy.

                        </p>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="rounded-2xl border border-slate-600 bg-slate-700 px-6 py-4">

                    <div class="flex items-center gap-4">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white">

                            <i class="fa-solid fa-file-arrow-up text-slate-700"></i>

                        </div>

                        <div>

                            <p class="text-xs font-bold uppercase tracking-widest text-slate-300">

                                Trạng thái

                            </p>

                            <p class="mt-1 text-sm font-semibold text-white">

                                Sẵn sàng đăng tải

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- SUCCESS -->
        @if(session('success'))

        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-700 shadow-sm">

            <div class="flex items-center gap-3">

                <i class="fa-solid fa-circle-check text-lg"></i>

                <span class="font-semibold">

                    {{ session('success') }}

                </span>

            </div>

        </div>

        @endif

        <!-- ERROR -->
        @if($errors->any())

        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-6 py-5 shadow-sm">

            <div class="flex items-center gap-3 mb-3">

                <i class="fa-solid fa-circle-exclamation text-red-500"></i>

                <h4 class="font-black text-red-600">

                    Không thể đăng tải tài liệu

                </h4>

            </div>

            <ul class="space-y-2 text-sm text-red-500">

                @foreach($errors->all() as $error)

                <li>• {{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif

        <!-- FORM -->
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

            <!-- HEADER -->
            <div class="border-b border-slate-200 bg-slate-50 px-8 py-6">

                <h2 class="text-2xl font-black text-slate-800">

                    Thông tin tài liệu

                </h2>

                <p class="mt-2 text-sm text-slate-500">

                    Nhập đầy đủ thông tin trước khi tải tài liệu lên hệ thống.

                </p>

            </div>

            <div class="p-8">

                <form id="uploadForm" action="{{ route('documents.store') }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        <!-- TÊN -->
                        <div class="md:col-span-2">

                            <label class="mb-2 block text-sm font-bold text-slate-700">

                                Tiêu đề tài liệu
                                <span class="text-red-500">*</span>

                            </label>

                            <input type="text" name="title" required value="{{ old('title') }}"
                                placeholder="Nhập tiêu đề tài liệu..." class="h-12 w-full rounded-xl border
                                @error('title')
                                    border-red-400
                                @else
                                    border-slate-200
                                @enderror
                                bg-slate-50 px-4 text-slate-700 font-medium
                                placeholder:text-slate-400
                                focus:border-amber-500
                                focus:bg-white
                                focus:ring-4
                                focus:ring-amber-100
                                outline-none transition">

                        </div>

                        <!-- SUBJECT -->
                        <div>

                            <label class="mb-2 block text-sm font-bold text-slate-700">

                                Môn học
                                <span class="text-red-500">*</span>

                            </label>

                            <select name="subject_code" required class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 font-medium
                                text-slate-700 focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-100
                                outline-none">

                                <option value="">

                                    -- Chọn môn học --

                                </option>

                                @foreach($subjects as $subject)

                                <option value="{{ $subject->subject_code }}" @selected(old('subject_code')==$subject->
                                    subject_code)>

                                    {{ $subject->subject_name }}

                                </option>

                                @endforeach

                            </select>

                        </div>

                        <!-- DOCUMENT TYPE -->
                        <div>

                            <label class="mb-2 block text-sm font-bold text-slate-700">

                                Loại tài liệu
                                <span class="text-red-500">*</span>

                            </label>

                            <select name="document_type_id" required class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 font-medium
                                text-slate-700 focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-100
                                outline-none">

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

                        </div>

                        <!-- DESCRIPTION -->
                        <div class="md:col-span-2">

                            <label class="mb-2 block text-sm font-bold text-slate-700">

                                Mô tả tài liệu

                            </label>

                            <textarea name="description" rows="5" placeholder="Nhập mô tả ngắn về tài liệu..."
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 font-medium text-slate-700 placeholder:text-slate-400 focus:border-amber-500 focus:bg-white focus:ring-4 focus:ring-amber-100 outline-none resize-none transition">{{ old('description') }}</textarea>

                        </div>

                        <!-- FILE TÀI LIỆU -->
                        <div class="md:col-span-2">

                            <label class="mb-3 block text-sm font-bold text-slate-700">

                                Tệp tài liệu
                                <span class="text-red-500">*</span>

                            </label>

                            <label
                                class="group relative flex cursor-pointer flex-col items-center justify-center rounded-3xl border-2 border-dashed border-slate-300 bg-slate-50 px-8 py-10 transition-all duration-300 hover:border-slate-500 hover:bg-slate-100">

                                <!-- INPUT -->
                                <input id="fileInput" type="file" name="file" required
                                    accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip"
                                    class="absolute inset-0 h-full w-full cursor-pointer opacity-0">

                                <!-- ICON -->
                                <div
                                    class="mb-5 flex h-20 w-20 items-center justify-center rounded-full bg-slate-800 text-white shadow-lg transition duration-300 group-hover:scale-105">

                                    <i class="fa-solid fa-cloud-arrow-up text-3xl"></i>

                                </div>

                                <!-- TITLE -->
                                <h3 class="text-lg font-black text-slate-800">

                                    Chọn tệp để tải lên

                                </h3>

                                <!-- DESCRIPTION -->
                                <p class="mt-2 text-center text-sm text-slate-500">

                                    Hỗ trợ:
                                    <span class="font-semibold">

                                        PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, ZIP

                                    </span>

                                </p>

                                <!-- FILE NAME -->
                                <div id="fileName"
                                    class="mt-5 inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-2 text-sm font-bold text-slate-600 shadow-sm">

                                    <i class="fa-solid fa-file"></i>

                                    Chưa chọn tệp

                                </div>

                            </label>

                            {{-- Lỗi validate --}}
                            @error('file')

                            <p class="mt-3 flex items-center gap-2 text-sm font-semibold text-red-500">

                                <i class="fa-solid fa-circle-exclamation"></i>

                                {{ $message }}

                            </p>

                            @enderror

                        </div>

                    </div>

                    <!-- ACTION -->
                    <div class="mt-10 border-t border-slate-200 pt-6">

                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                            <!-- CANCEL -->
                            <a href="{{ url()->previous() }}"
                                class="inline-flex h-11 items-center justify-center rounded-xl border border-slate-200 bg-white px-6 text-sm font-bold text-slate-700 transition-all duration-300 hover:border-slate-300 hover:bg-slate-100">

                                <i class="fa-solid fa-arrow-left mr-2"></i>

                                Quay lại

                            </a>

                            <!-- SAVE -->
                            <button id="uploadButton" type="submit"
                                class="inline-flex h-11 items-center justify-center rounded-xl bg-amber-500 px-7 text-sm font-bold text-white shadow-lg shadow-amber-200 transition-all duration-300 hover:bg-amber-600">

                                <i class="fa-solid fa-cloud-arrow-up mr-2"></i>

                                Đăng tải tài liệu

                            </button>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Upload Loading -->
    <div id="uploadLoading"
        class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 backdrop-blur-sm">

        <div class="w-[360px] rounded-3xl bg-white p-8 text-center shadow-2xl">

            <!-- Spinner -->
            <div class="mx-auto mb-5 h-16 w-16 rounded-full border-4 border-slate-200 border-t-slate-800 animate-spin">
            </div>

            <h3 class="text-xl font-black text-slate-800">

                Đang tải tài liệu...

            </h3>

            <p class="mt-2 text-sm text-slate-500">

                Vui lòng không đóng trình duyệt.
                Hệ thống đang xử lý tệp của bạn.

            </p>

        </div>

    </div>
</div>
@endsection
@push('scripts')
<script>
const input = document.getElementById('fileInput');
const fileName = document.getElementById('fileName');

input.addEventListener('change', function() {

    if (this.files.length > 0) {

        fileName.innerHTML = `
            <i class="fa-solid fa-file-circle-check text-emerald-500"></i>
            ${this.files[0].name}
        `;

    } else {

        fileName.innerHTML = `
            <i class="fa-solid fa-file"></i>
            Chưa chọn tệp
        `;

    }

});
document.addEventListener('DOMContentLoaded', function() {

    const form = document.getElementById('uploadForm');
    const button = document.getElementById('uploadButton');
    const loading = document.getElementById('uploadLoading');

    form.addEventListener('submit', function() {

        loading.classList.remove('hidden');
        loading.classList.add('flex');

        button.disabled = true;

        button.innerHTML = `
            <i class="fa-solid fa-spinner animate-spin mr-2"></i>
            Đang tải...
        `;

    });

});
</script>
@endpush