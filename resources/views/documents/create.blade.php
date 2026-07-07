@extends('layouts.app')

@section('title', 'Đăng tải tài liệu')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">

    <div class="mx-auto max-w-6xl px-6">

        <!-- PAGE HEADER -->
        <section class="mb-8 overflow-hidden rounded-3xl border border-amber-200 bg-amber-500 shadow-lg">

            <div class="flex flex-col gap-8 px-10 py-8 lg:flex-row lg:items-center lg:justify-between">

                <!-- LEFT -->
                <div class="flex items-center gap-5">

                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white shadow-md">

                        <i class="fa-solid fa-cloud-arrow-up text-3xl text-amber-500"></i>

                    </div>

                    <div>

                        <span
                            class="inline-flex items-center rounded-full bg-white/20 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.2em] text-white">

                            QUẢN LÝ TÀI LIỆU

                        </span>

                        <h1 class="mt-3 text-3xl font-black text-white">

                            Đăng tải tài liệu

                        </h1>

                        <p class="mt-2 max-w-2xl text-sm leading-6 text-amber-50">

                            Thêm tài liệu mới vào hệ thống để chia sẻ với sinh viên
                            thuộc các môn học được phân công giảng dạy.

                        </p>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="rounded-2xl border border-white/20 bg-white/10 px-6 py-4 backdrop-blur-sm">

                    <div class="flex items-center gap-4">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white">

                            <i class="fa-solid fa-file-arrow-up text-amber-500"></i>

                        </div>

                        <div>

                            <p class="text-xs font-bold uppercase tracking-widest text-amber-100">

                                Trạng thái

                            </p>

                            <p class="mt-1 text-sm font-semibold text-white">

                                Sẵn sàng tải lên

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

                <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">

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
                                class="group flex cursor-pointer flex-col items-center justify-center rounded-3xl border-2 border-dashed border-amber-200 bg-amber-50 px-8 py-10 transition-all duration-300 hover:border-amber-400 hover:bg-amber-100">

                                <input id="fileInput" type="file" name="file" required
                                    accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip" class="hidden">

                                <!-- ICON -->
                                <div
                                    class="mb-5 flex h-20 w-20 items-center justify-center rounded-full bg-amber-500 text-white shadow-lg shadow-amber-200 transition group-hover:scale-105">

                                    <i class="fa-solid fa-cloud-arrow-up text-3xl"></i>

                                </div>

                                <!-- TITLE -->
                                <h3 class="text-lg font-black text-slate-800">

                                    Chọn tệp để tải lên

                                </h3>

                                <!-- DESC -->
                                <p class="mt-2 text-center text-sm text-slate-500">

                                    Hỗ trợ:
                                    <span class="font-semibold">

                                        PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, ZIP

                                    </span>

                                </p>

                                <!-- FILE NAME -->
                                <div id="fileName"
                                    class="mt-5 inline-flex items-center gap-2 rounded-full bg-white px-5 py-2 text-sm font-bold text-amber-600 shadow-sm">

                                    <i class="fa-solid fa-file"></i>

                                    Chưa chọn tệp

                                </div>

                            </label>

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
                            <button type="submit"
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
</script>
@endpush