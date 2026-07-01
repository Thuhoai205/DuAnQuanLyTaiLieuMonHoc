@extends('layouts.app')

@section('title', 'Chỉnh sửa tài liệu')

@section('content')

<main class="min-h-screen bg-[#EAFBFF] py-12">

    <div class="max-w-6xl mx-auto px-6 sm:px-10 lg:px-16">

        <!-- BACK -->
        <a href="javascript:history.back()"
            class="inline-flex items-center gap-2 px-5 py-2.5 mb-8 rounded-full bg-white border border-cyan-100 text-cyan-700 font-bold text-sm hover:bg-cyan-50 transition">

            <i class="fa-solid fa-arrow-left"></i>

            Quay lại

        </a>

        <!-- HEADER -->
        <section class="mb-8 rounded-[32px] bg-cyan-600 text-white p-8 shadow-xl shadow-cyan-200/70">

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">

                <div class="flex items-center gap-5">

                    <div
                        class="w-20 h-20 rounded-3xl bg-cyan-300 text-cyan-950 flex items-center justify-center shadow-xl">

                        <i class="fa-solid fa-pen-to-square text-3xl"></i>

                    </div>

                    <div>

                        <p class="text-cyan-100 text-xs font-black uppercase tracking-[0.25em] mb-2">

                            Quản lý học liệu

                        </p>

                        <h1 class="text-4xl font-black">

                            Chỉnh sửa tài liệu

                        </h1>

                        <p class="text-cyan-50 mt-2 font-semibold">

                            Cập nhật thông tin học liệu đã đăng tải.

                        </p>

                    </div>

                </div>

                <span
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-700/60 border border-cyan-300/30 text-cyan-50 text-xs font-black">

                    <i class="fa-solid fa-file"></i>

                    {{ $document->currentVersion?->original_file_name ?? 'Chưa có file' }}

                </span>

            </div>

        </section>

        <!-- FORM -->
        <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- LEFT -->
            <div
                class="lg:col-span-2 bg-white rounded-[32px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-7">

                <h2 class="text-2xl font-black text-cyan-950 mb-6">

                    Thông tin tài liệu

                </h2>

                <form action="{{ route('documents.update',$document) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">

                    @csrf
                    @method('PUT')

                    <!-- TIÊU ĐỀ -->
                    <div>

                        <label class="block text-xs font-black uppercase tracking-[0.18em] text-slate-400 mb-2">

                            Tiêu đề tài liệu

                        </label>

                        <input type="text" name="title" value="{{ old('title',$document->title) }}" class="w-full h-14 px-5 rounded-2xl bg-cyan-50 border
                            @error('title')
                                border-red-400
                            @else
                                border-cyan-100
                            @enderror
                            text-slate-800 font-bold outline-none
                            focus:ring-2 focus:ring-cyan-300
                            focus:border-cyan-500 transition">

                        @error('title')

                        <p class="mt-2 text-sm text-red-500">

                            {{ $message }}

                        </p>

                        @enderror

                    </div>

                    <!-- MÔN HỌC + LOẠI -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <!-- SUBJECT -->
                        <div>

                            <label class="block text-xs font-black uppercase tracking-[0.18em] text-slate-400 mb-2">

                                Môn học

                            </label>

                            <select name="subject_code" class="w-full h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100
                                text-slate-800 font-bold outline-none
                                focus:ring-2 focus:ring-cyan-300
                                focus:border-cyan-500 transition">

                                @foreach($subjects as $subject)

                                <option value="{{ $subject->subject_code }}" @selected(old('subject_code',$document->
                                    subject_code)==$subject->subject_code)>

                                    {{ $subject->subject_name }}

                                </option>

                                @endforeach

                            </select>

                            @error('subject_code')

                            <p class="mt-2 text-sm text-red-500">

                                {{ $message }}

                            </p>

                            @enderror

                        </div>

                        <!-- DOCUMENT TYPE -->
                        <div>

                            <label class="block text-xs font-black uppercase tracking-[0.18em] text-slate-400 mb-2">

                                Loại tài liệu

                            </label>

                            <select name="document_type_id" class="w-full h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100
                                text-slate-800 font-bold outline-none
                                focus:ring-2 focus:ring-cyan-300
                                focus:border-cyan-500 transition">

                                @foreach($documentTypes as $type)

                                <option value="{{ $type->document_type_id }}"
                                    @selected(old('document_type_id',$document->
                                    document_type_id)==$type->document_type_id)>

                                    {{ $type->type_name }}

                                </option>

                                @endforeach

                            </select>

                            @error('document_type_id')

                            <p class="mt-2 text-sm text-red-500">

                                {{ $message }}

                            </p>

                            @enderror

                        </div>

                    </div>
                    <!-- FILE HIỆN TẠI -->
                    <div>

                        <label class="block text-xs font-black uppercase tracking-[0.18em] text-slate-400 mb-2">

                            File hiện tại

                        </label>

                        <div
                            class="flex items-center justify-between gap-4 p-5 rounded-2xl bg-cyan-50 border border-cyan-100">

                            <div class="flex items-center gap-4">

                                @php
                                $ext = strtolower($document->currentVersion?->file_extension ?? '');
                                @endphp

                                <div class="w-14 h-14 rounded-2xl flex flex-col items-center justify-center border
                                    @switch($ext)
                                        @case('pdf')
                                            bg-red-50 text-red-500 border-red-100
                                            @break

                                        @case('doc')
                                        @case('docx')
                                            bg-blue-50 text-blue-600 border-blue-100
                                            @break

                                        @case('xls')
                                        @case('xlsx')
                                            bg-emerald-50 text-emerald-600 border-emerald-100
                                            @break

                                        @case('ppt')
                                        @case('pptx')
                                            bg-orange-50 text-orange-500 border-orange-100
                                            @break

                                        @default
                                            bg-slate-50 text-slate-500 border-slate-200
                                    @endswitch">

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

                                    <span class="text-[9px] font-black mt-0.5">

                                        {{ strtoupper($ext ?: 'FILE') }}

                                    </span>

                                </div>

                                <div>

                                    <h4 class="font-black text-slate-800">

                                        {{ $document->currentVersion?->original_file_name }}

                                    </h4>

                                    <p class="text-sm text-slate-500 font-semibold mt-1">

                                        {{ number_format(($document->currentVersion?->file_size ?? 0)/1024/1024,2) }}
                                        MB

                                        •

                                        {{ number_format($document->download_count) }}
                                        lượt tải

                                    </p>

                                </div>

                            </div>

                            @if($document->currentVersion)

                            <a href="{{ route('documents.view',$document) }}" target="_blank"
                                class="px-4 py-2 rounded-xl bg-white border border-cyan-100 text-cyan-700 font-bold hover:bg-cyan-100 transition">

                                <i class="fa-solid fa-eye mr-1"></i>

                                Xem

                            </a>

                            @endif

                        </div>

                    </div>

                    <!-- THAY FILE -->
                    <div>

                        <label class="block text-xs font-black uppercase tracking-[0.18em] text-slate-400 mb-2">

                            Thay file mới (Không bắt buộc)

                        </label>

                        <label
                            class="block cursor-pointer rounded-[28px] border-2 border-dashed border-cyan-200 bg-cyan-50/70 p-8 text-center hover:bg-cyan-50 transition">

                            <input id="fileInput" type="file" name="file" class="hidden"
                                accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip">

                            <div
                                class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200">

                                <i class="fa-solid fa-cloud-arrow-up text-2xl"></i>

                            </div>

                            <h4 class="font-black text-slate-800">

                                Chọn file mới

                            </h4>

                            <p class="text-slate-500 text-sm font-semibold mt-2">

                                PDF, DOCX, XLSX, PPTX, ZIP...

                            </p>

                            <span id="fileName" class="block mt-4 text-cyan-600 font-bold">

                                Chưa chọn file

                            </span>

                        </label>

                    </div>

                    <!-- MÔ TẢ -->
                    <div>

                        <label class="block text-xs font-black uppercase tracking-[0.18em] text-slate-400 mb-2">

                            Mô tả tài liệu

                        </label>

                        <textarea name="description" rows="5"
                            class="w-full px-5 py-4 rounded-2xl bg-cyan-50 border border-cyan-100 text-slate-800 font-semibold outline-none resize-none focus:ring-2 focus:ring-cyan-300 focus:border-cyan-500 transition">{{ old('description',$document->description) }}</textarea>

                    </div>

                    <!-- ACTION -->
                    <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-4">

                        <a href="javascript:history.back()"
                            class="w-full sm:w-auto px-7 py-3 rounded-2xl border border-cyan-100 text-slate-600 font-black hover:bg-cyan-50 transition text-center">

                            Hủy

                        </a>

                        <button type="submit"
                            class="w-full sm:w-auto px-8 py-3 rounded-2xl bg-cyan-500 text-white font-black hover:bg-cyan-600 shadow-lg shadow-cyan-200 transition">

                            <i class="fa-solid fa-floppy-disk mr-2"></i>

                            Lưu thay đổi

                        </button>

                    </div>

                </form>

            </div>
            <!-- RIGHT INFO -->
            <aside class="space-y-6">

                <!-- PREVIEW -->
                <div
                    class="bg-white rounded-[32px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-6">

                    <h3 class="text-xl font-black text-cyan-950 mb-5">

                        Xem nhanh

                    </h3>

                    @php
                    $version = $document->currentVersion;
                    $extension = strtolower($version?->file_extension ?? '');
                    @endphp

                    <div
                        class="min-h-[260px] rounded-[28px] bg-cyan-50 border-2 border-dashed border-cyan-200 flex flex-col items-center justify-center text-center p-6">

                        @switch($extension)

                        @case('pdf')

                        <div class="w-20 h-20 rounded-3xl bg-red-50 text-red-500 flex items-center justify-center mb-4">

                            <i class="fa-solid fa-file-pdf text-4xl"></i>

                        </div>

                        @break

                        @case('doc')
                        @case('docx')

                        <div
                            class="w-20 h-20 rounded-3xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4">

                            <i class="fa-solid fa-file-word text-4xl"></i>

                        </div>

                        @break

                        @case('xls')
                        @case('xlsx')

                        <div
                            class="w-20 h-20 rounded-3xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">

                            <i class="fa-solid fa-file-excel text-4xl"></i>

                        </div>

                        @break

                        @case('ppt')
                        @case('pptx')

                        <div
                            class="w-20 h-20 rounded-3xl bg-orange-50 text-orange-500 flex items-center justify-center mb-4">

                            <i class="fa-solid fa-file-powerpoint text-4xl"></i>

                        </div>

                        @break

                        @default

                        <div
                            class="w-20 h-20 rounded-3xl bg-slate-100 text-slate-500 flex items-center justify-center mb-4">

                            <i class="fa-solid fa-file text-4xl"></i>

                        </div>

                        @endswitch

                        <h4 class="font-black text-slate-800">

                            {{ $document->title }}

                        </h4>

                        <p class="text-slate-500 text-sm font-semibold mt-2 break-all">

                            {{ $version?->original_file_name }}

                        </p>

                        @if($version)

                        <a href="{{ route('documents.download',$document) }}"
                            class="mt-6 inline-flex items-center gap-2 px-5 py-2 rounded-xl bg-cyan-500 text-white font-bold hover:bg-cyan-600 transition">

                            <i class="fa-solid fa-download"></i>

                            Tải file

                        </a>

                        @endif

                    </div>

                </div>

                <!-- META -->
                <div
                    class="bg-white rounded-[32px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-6">

                    <h3 class="text-xl font-black text-cyan-950 mb-5">

                        Thông tin hệ thống

                    </h3>

                    <div class="space-y-5">

                        <!-- Slug -->
                        <div class="flex items-center gap-4">

                            <div
                                class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">

                                <i class="fa-solid fa-link"></i>

                            </div>

                            <div>

                                <p class="text-xs text-slate-400 font-black uppercase">

                                    Slug

                                </p>

                                <p class="text-slate-800 font-bold break-all">

                                    {{ $document->slug }}

                                </p>

                            </div>

                        </div>

                        <!-- Người upload -->
                        <div class="flex items-center gap-4">

                            <div
                                class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">

                                <i class="fa-solid fa-user"></i>

                            </div>

                            <div>

                                <p class="text-xs text-slate-400 font-black uppercase">

                                    Người upload

                                </p>

                                <p class="text-slate-800 font-bold">

                                    {{ $document->uploader->full_name ?? 'Không xác định' }}

                                </p>

                            </div>

                        </div>

                        <!-- Môn học -->
                        <div class="flex items-center gap-4">

                            <div
                                class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">

                                <i class="fa-solid fa-book"></i>

                            </div>

                            <div>

                                <p class="text-xs text-slate-400 font-black uppercase">

                                    Môn học

                                </p>

                                <p class="text-slate-800 font-bold">

                                    {{ $document->subject->subject_name ?? '-' }}

                                </p>

                            </div>

                        </div>

                        <!-- Loại tài liệu -->
                        <div class="flex items-center gap-4">

                            <div
                                class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">

                                <i class="fa-solid fa-folder-open"></i>

                            </div>

                            <div>

                                <p class="text-xs text-slate-400 font-black uppercase">

                                    Loại tài liệu

                                </p>

                                <p class="text-slate-800 font-bold">

                                    {{ $document->documentType->type_name ?? '-' }}

                                </p>

                            </div>

                        </div>

                        <!-- Lượt tải -->
                        <div class="flex items-center gap-4">

                            <div
                                class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">

                                <i class="fa-solid fa-download"></i>

                            </div>

                            <div>

                                <p class="text-xs text-slate-400 font-black uppercase">

                                    Lượt tải

                                </p>

                                <p class="text-slate-800 font-bold">

                                    {{ number_format($document->download_count) }} lượt

                                </p>

                            </div>

                        </div>

                        <!-- Ngày tạo -->
                        <div class="flex items-center gap-4">

                            <div
                                class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">

                                <i class="fa-solid fa-calendar"></i>

                            </div>

                            <div>

                                <p class="text-xs text-slate-400 font-black uppercase">

                                    Ngày đăng

                                </p>

                                <p class="text-slate-800 font-bold">

                                    {{ $document->created_at->format('d/m/Y H:i') }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>
                <!-- DANGER -->
                <div class="bg-white rounded-[32px] border border-red-100 shadow-sm p-6">

                    <h3 class="text-xl font-black text-red-500 mb-3">

                        Vùng nguy hiểm

                    </h3>

                    <p class="text-slate-500 text-sm font-semibold leading-relaxed mb-5">

                        Xóa tài liệu sẽ làm tài liệu không còn hiển thị trong hệ thống.
                        Hành động này không thể hoàn tác.

                    </p>

                    <form action="{{ route('documents.destroy', $document) }}" method="POST"
                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài liệu này?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="w-full py-3 rounded-2xl bg-red-50 text-red-500 font-black border border-red-100 hover:bg-red-500 hover:text-white transition">

                            <i class="fa-solid fa-trash mr-2"></i>

                            Xóa tài liệu

                        </button>

                    </form>

                </div>

            </aside>

        </section>

    </div>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const input = document.getElementById('fileInput');

    if (input) {

        input.addEventListener('change', function() {

            const name = this.files.length ?
                this.files[0].name :
                'Chưa chọn file';

            document.getElementById('fileName').innerText = name;

        });

    }

});
</script>

@endsection