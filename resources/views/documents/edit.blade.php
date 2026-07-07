@extends('layouts.app')

@section('title', 'Chỉnh sửa tài liệu')

@section('content')

<main class="min-h-screen">

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">

        <!-- BACK -->
        <a href="javascript:history.back()"
            class="mb-6 inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 shadow-sm transition-all duration-300 hover:border-amber-300 hover:bg-amber-50 hover:text-amber-600">

            <i class="fa-solid fa-arrow-left"></i>

            Quay lại danh sách

        </a>

        <!-- PAGE HEADER -->
        <section class="relative overflow-hidden rounded-3xl border border-amber-200  bg-amber-500 shadow-lg">

            <!-- Background -->
            <div class="absolute inset-0 bg-black/5"></div>

            <div class="flex flex-col gap-8 px-12 py-8 lg:flex-row lg:items-center lg:justify-between">
                <!-- LEFT -->
                <div class="flex items-center gap-5">

                    <!-- Icon -->
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-white shadow-md">

                        <i class="fa-solid fa-file-pen text-3xl text-amber-500"></i>

                    </div>

                    <!-- Text -->
                    <div>

                        <span
                            class="inline-flex items-center rounded-full bg-white/20 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.2em] text-white">

                            QUẢN LÝ TÀI LIỆU

                        </span>

                        <h1 class="mt-3 text-3xl font-black text-white">

                            Cập nhật tài liệu

                        </h1>

                        <p class="mt-2 max-w-2xl text-sm leading-6 text-amber-50">

                            Chỉnh sửa thông tin, thay thế tệp và cập nhật nội dung tài liệu
                            trước khi chia sẻ cho người dùng.

                        </p>

                    </div>

                </div>

                <!-- RIGHT -->
                <div
                    class="flex items-center gap-4 rounded-2xl border border-white/20 bg-white/15 px-5 py-4 backdrop-blur-md">

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white shadow">

                        <i class="fa-solid fa-file-lines text-amber-500"></i>

                    </div>

                    <div>

                        <p class="text-[11px] font-bold uppercase tracking-widest text-amber-100">

                            Tệp hiện tại

                        </p>

                        <p class="mt-1 max-w-[220px] truncate text-sm font-semibold text-white">

                            {{ $document->currentVersion?->original_file_name ?? 'Chưa có tệp tài liệu' }}

                        </p>

                    </div>

                </div>

            </div>

        </section>


        <!-- FORM -->
        <section class="grid grid-cols-1 xl:grid-cols-3 gap-8 py-10">

            <!-- LEFT -->
            <div class="xl:col-span-2">

                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                    <!-- HEADER -->
                    <div class="border-b border-slate-200 bg-slate-50 px-7 py-6">

                        <h2 class="text-2xl font-black text-slate-800">

                            Thông tin tài liệu

                        </h2>

                        <p class="mt-2 text-sm font-medium text-slate-500">

                            Cập nhật thông tin cơ bản của tài liệu.

                        </p>

                    </div>

                    <form action="{{ route('documents.update',$document) }}" method="POST" enctype="multipart/form-data"
                        class="space-y-7 p-7">

                        @csrf
                        @method('PUT')

                        <!-- TIÊU ĐỀ -->
                        <div>

                            <label class="mb-3 block text-sm font-bold text-slate-700">

                                Tiêu đề tài liệu

                                <span class="text-red-500">*</span>

                            </label>

                            <input id="title" type="text" name="title" value="{{ old('title',$document->title) }}"
                                placeholder="Nhập tiêu đề tài liệu..." class="h-12
                        w-full
                        rounded-xl
                        border
                        @error('title')
                            border-red-400
                        @else
                            border-slate-200
                        @enderror
                        bg-slate-50
                        px-4
                        text-slate-700
                        font-medium
                        placeholder:text-slate-400
                        outline-none
                        transition-all
                        duration-300
                        hover:border-amber-300
                        focus:border-amber-500
                        focus:bg-white
                        focus:ring-4
                        focus:ring-amber-100">

                            @error('title')

                            <p class="mt-2 text-sm font-medium text-red-500">

                                {{ $message }}

                            </p>

                            @enderror

                        </div>

                        <!-- SUBJECT + TYPE -->
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                            <!-- SUBJECT -->
                            <div>

                                <label class="mb-3 block text-sm font-bold text-slate-700">

                                    Môn học

                                    <span class="text-red-500">*</span>

                                </label>

                                <select name="subject_code" class="h-12
                            w-full
                            rounded-xl
                            border
                            border-slate-200
                            bg-slate-50
                            px-4
                            text-slate-700
                            font-medium
                            outline-none
                            transition-all
                            duration-300
                            hover:border-amber-300
                            focus:border-amber-500
                            focus:bg-white
                            focus:ring-4
                            focus:ring-amber-100">

                                    @foreach($subjects as $subject)

                                    <option value="{{ $subject->subject_code }}"
                                        @selected(old('subject_code',$document->subject_code)==$subject->subject_code)>

                                        {{ $subject->subject_name }}

                                    </option>

                                    @endforeach

                                </select>

                                @error('subject_code')

                                <p class="mt-2 text-sm font-medium text-red-500">

                                    {{ $message }}

                                </p>

                                @enderror

                            </div>

                            <!-- DOCUMENT TYPE -->
                            <div>

                                <label class="mb-3 block text-sm font-bold text-slate-700">

                                    Loại tài liệu

                                    <span class="text-red-500">*</span>

                                </label>

                                <select name="document_type_id" class="h-12
                            w-full
                            rounded-xl
                            border
                            border-slate-200
                            bg-slate-50
                            px-4
                            text-slate-700
                            font-medium
                            outline-none
                            transition-all
                            duration-300
                            hover:border-amber-300
                            focus:border-amber-500
                            focus:bg-white
                            focus:ring-4
                            focus:ring-amber-100">

                                    @foreach($documentTypes as $type)

                                    <option value="{{ $type->document_type_id }}"
                                        @selected(old('document_type_id',$document->
                                        document_type_id)==$type->document_type_id)>

                                        {{ $type->type_name }}

                                    </option>

                                    @endforeach

                                </select>

                                @error('document_type_id')

                                <p class="mt-2 text-sm font-medium text-red-500">

                                    {{ $message }}

                                </p>

                                @enderror

                            </div>

                        </div><!-- FILE HIỆN TẠI -->
                        <div>

                            <label class="mb-3 block text-sm font-bold text-slate-700">

                                Tệp tài liệu hiện tại

                            </label>

                            @php
                            $ext = strtolower($document->currentVersion?->file_extension ?? '');
                            @endphp

                            <div
                                class="flex flex-col gap-5 rounded-2xl border border-slate-200 bg-slate-50 p-5 lg:flex-row lg:items-center lg:justify-between">

                                <div class="flex items-center gap-4">

                                    <div class="flex h-16 w-16 flex-col items-center justify-center rounded-2xl border

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
                        bg-slate-100 text-slate-500 border-slate-200

                @endswitch">

                                        @switch($ext)

                                        @case('pdf')
                                        <i class="fa-solid fa-file-pdf text-3xl"></i>
                                        @break

                                        @case('doc')
                                        @case('docx')
                                        <i class="fa-solid fa-file-word text-3xl"></i>
                                        @break

                                        @case('xls')
                                        @case('xlsx')
                                        <i class="fa-solid fa-file-excel text-3xl"></i>
                                        @break

                                        @case('ppt')
                                        @case('pptx')
                                        <i class="fa-solid fa-file-powerpoint text-3xl"></i>
                                        @break

                                        @default
                                        <i class="fa-solid fa-file text-3xl"></i>

                                        @endswitch

                                        <span class="mt-1 text-[10px] font-black uppercase">

                                            {{ strtoupper($ext ?: 'FILE') }}

                                        </span>

                                    </div>

                                    <div>

                                        <h4 class="font-bold text-slate-800 break-all">

                                            {{ $document->currentVersion?->original_file_name ?? 'Chưa có tệp' }}

                                        </h4>

                                        <div class="mt-2 flex flex-wrap gap-3 text-sm text-slate-500">

                                            <span>

                                                <i class="fa-solid fa-hard-drive mr-1 text-amber-500"></i>

                                                {{ number_format(($document->currentVersion?->file_size ?? 0)/1024/1024,2) }}
                                                MB

                                            </span>

                                            <span>

                                                <i class="fa-solid fa-download mr-1 text-amber-500"></i>

                                                {{ number_format($document->download_count) }}
                                                lượt tải

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                @php
                                $version = $document->currentVersion;
                                @endphp

                                @if($version->preview_file)

                                <a href="{{ asset('storage/'.$version->preview_file) }}" target="_blank" class="inline-flex
    items-center
    gap-2
    h-11
    px-5
    rounded-xl
    border
    border-slate-200
    bg-white
    text-slate-700
    text-sm
    font-bold
    shadow-sm
    transition-all
    duration-300
    hover:border-amber-300
    hover:bg-amber-50
    hover:text-amber-600
    hover:shadow-md">

                                    <i class="fa-solid fa-eye"></i>

                                    Xem tài liệu

                                </a>

                                @else

                                <a href="{{ asset('storage/'.$version->file_path) }}" target="_blank" class="inline-flex
    items-center
    gap-2
    h-11
    px-5
    rounded-xl
    border
    border-slate-200
    bg-white
    text-slate-700
    text-sm
    font-bold
    shadow-sm
    transition-all
    duration-300
    hover:border-amber-300
    hover:bg-amber-50
    hover:text-amber-600
    hover:shadow-md">
                                    <i class="fa-solid fa-file"></i>
                                    Mở file

                                </a>

                                @endif

                            </div>

                        </div>


                        <!-- THAY FILE -->
                        <div>

                            <label class="mb-3 block text-sm font-bold text-slate-700">

                                Thay thế tệp mới

                            </label>

                            <label
                                class="group block cursor-pointer rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 p-8 text-center transition-all duration-300 hover:border-amber-400 hover:bg-amber-50">

                                <input id="fileInput" type="file" name="file" class="hidden"
                                    accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip">

                                <div
                                    class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-amber-500 text-white shadow-lg transition-all duration-300 group-hover:-translate-y-1 group-hover:scale-105">

                                    <i class="fa-solid fa-cloud-arrow-up text-2xl"></i>

                                </div>

                                <h4 class="text-lg font-black text-slate-800">

                                    Chọn tệp mới

                                </h4>

                                <p class="mt-2 text-sm font-medium text-slate-500">

                                    Hỗ trợ PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX và ZIP.

                                </p>

                                <span id="fileName"
                                    class="mt-5 inline-flex rounded-full bg-amber-50 px-4 py-2 text-sm font-bold text-amber-600">

                                    Chưa chọn tệp

                                </span>

                            </label>

                        </div>

                        <!-- MÔ TẢ -->
                        <div>

                            <label class="mb-3 block text-sm font-bold text-slate-700">

                                Mô tả tài liệu

                            </label>

                            <textarea name="description" rows="6" placeholder="Nhập mô tả ngắn về tài liệu..." class="w-full
        rounded-2xl
        border
        border-slate-200
        bg-slate-50
        px-5
        py-4
        text-slate-700
        font-medium
        placeholder:text-slate-400
        outline-none
        resize-none
        transition-all
        duration-300
        hover:border-amber-300
        focus:border-amber-500
        focus:bg-white
        focus:ring-4
        focus:ring-amber-100">{{ old('description',$document->description) }}</textarea>

                            <p class="mt-2 text-xs text-slate-500">

                                Mô tả sẽ giúp người dùng hiểu rõ hơn về nội dung của tài liệu.

                            </p>

                        </div>


                        <!-- ACTION -->
                        <div class="border-t border-slate-200 pt-6">

                            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                                <!-- CANCEL -->
                                <a href="javascript:history.back()" class="inline-flex
            items-center
            justify-center
            gap-2
            rounded-xl
            border
            border-slate-200
            bg-white
            px-6
            py-3
            text-sm
            font-bold
            text-slate-700
            transition-all
            duration-300
            hover:border-slate-300
            hover:bg-slate-100">

                                    <i class="fa-solid fa-arrow-left"></i>

                                    Quay lại

                                </a>

                                <!-- SAVE -->
                                <button type="submit" class="inline-flex
            items-center
            justify-center
            gap-2
            rounded-xl
            bg-amber-500
            px-7
            py-3
            text-sm
            font-bold
            text-white
            shadow-lg
            shadow-amber-200
            transition-all
            duration-300
            hover:-translate-y-0.5
            hover:bg-amber-600
            hover:shadow-xl
            active:scale-95">

                                    <i class="fa-solid fa-floppy-disk"></i>

                                    Lưu thay đổi

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

            <!-- RIGHT INFO -->
            <aside class="space-y-6">

                <!-- PREVIEW -->
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                    <!-- HEADER -->
                    <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">

                        <h3 class="text-xl font-black text-slate-800">

                            Xem nhanh

                        </h3>

                        <p class="mt-1 text-sm text-slate-500">

                            Thông tin hiển thị của tài liệu hiện tại.

                        </p>

                    </div>

                    @php
                    $version = $document->currentVersion;
                    $extension = strtolower($version?->file_extension ?? '');
                    @endphp

                    <div class="p-6">

                        <div class="rounded-3xl border-2 border-dashed border-slate-200 bg-slate-50 p-8 text-center">

                            @switch($extension)

                            @case('pdf')

                            <div
                                class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-3xl bg-red-50 text-red-500">

                                <i class="fa-solid fa-file-pdf text-5xl"></i>

                            </div>

                            @break

                            @case('doc')
                            @case('docx')

                            <div
                                class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-3xl bg-blue-50 text-blue-600">

                                <i class="fa-solid fa-file-word text-5xl"></i>

                            </div>

                            @break

                            @case('xls')
                            @case('xlsx')

                            <div
                                class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-3xl bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-file-excel text-5xl"></i>

                            </div>

                            @break

                            @case('ppt')
                            @case('pptx')

                            <div
                                class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-3xl bg-orange-50 text-orange-500">

                                <i class="fa-solid fa-file-powerpoint text-5xl"></i>

                            </div>

                            @break

                            @default

                            <div
                                class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-3xl bg-slate-100 text-slate-500">

                                <i class="fa-solid fa-file text-5xl"></i>

                            </div>

                            @endswitch

                            <h4 class="text-lg font-black text-slate-800 break-words">

                                {{ $document->title }}

                            </h4>

                            <p class="mt-2 break-all text-sm font-medium text-slate-500">

                                {{ $version?->original_file_name ?? 'Chưa có tệp' }}

                            </p>

                            @if($version)

                            <a href="{{ route('documents.download',$document) }}"
                                class="mt-6 inline-flex items-center gap-2 rounded-xl bg-amber-500 px-5 py-3 text-sm font-bold text-white transition-all duration-300 hover:bg-amber-600 hover:shadow-lg">

                                <i class="fa-solid fa-download"></i>

                                Tải xuống

                            </a>

                            @endif

                        </div>

                    </div>

                </div>
                <!-- META -->
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                    <!-- HEADER -->
                    <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">

                        <h3 class="text-xl font-black text-slate-800">

                            Thông tin hệ thống

                        </h3>

                        <p class="mt-1 text-sm text-slate-500">

                            Thông tin chi tiết của tài liệu trong hệ thống.

                        </p>

                    </div>

                    <div class="divide-y divide-slate-100">

                        <!-- SLUG -->
                        <div class="flex items-center gap-4 px-6 py-5">

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-500">

                                <i class="fa-solid fa-link"></i>

                            </div>

                            <div class="flex-1">

                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">

                                    Slug

                                </p>

                                <p class="mt-1 break-all font-semibold text-slate-700">

                                    {{ $document->slug }}

                                </p>

                            </div>

                        </div>

                        <!-- NGƯỜI UPLOAD -->
                        <div class="flex items-center gap-4 px-6 py-5">

                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-600">

                                <i class="fa-solid fa-user"></i>

                            </div>

                            <div class="flex-1">

                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">

                                    Người tải lên

                                </p>

                                <p class="mt-1 font-semibold text-slate-700">

                                    {{ $document->uploader->full_name ?? 'Không xác định' }}

                                </p>

                            </div>

                        </div>

                        <!-- MÔN HỌC -->
                        <div class="flex items-center gap-4 px-6 py-5">

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">

                                <i class="fa-solid fa-book-open"></i>

                            </div>

                            <div class="flex-1">

                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">

                                    Môn học

                                </p>

                                <p class="mt-1 font-semibold text-slate-700">

                                    {{ $document->subject->subject_name ?? '-' }}

                                </p>

                            </div>

                        </div>

                        <!-- LOẠI TÀI LIỆU -->
                        <div class="flex items-center gap-4 px-6 py-5">

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">

                                <i class="fa-solid fa-folder-open"></i>

                            </div>

                            <div class="flex-1">

                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">

                                    Loại tài liệu

                                </p>

                                <p class="mt-1 font-semibold text-slate-700">

                                    {{ $document->documentType->type_name ?? '-' }}

                                </p>

                            </div>

                        </div>

                        <!-- LƯỢT TẢI -->
                        <div class="flex items-center gap-4 px-6 py-5">

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-50 text-orange-500">

                                <i class="fa-solid fa-download"></i>

                            </div>

                            <div class="flex-1">

                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">

                                    Lượt tải

                                </p>

                                <p class="mt-1 font-semibold text-slate-700">

                                    {{ number_format($document->download_count) }} lượt

                                </p>

                            </div>

                        </div>

                        <!-- NGÀY ĐĂNG -->
                        <div class="flex items-center gap-4 px-6 py-5">

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-50 text-violet-600">

                                <i class="fa-solid fa-calendar-days"></i>

                            </div>

                            <div class="flex-1">

                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">

                                    Ngày đăng

                                </p>

                                <p class="mt-1 font-semibold text-slate-700">

                                    {{ $document->created_at->format('d/m/Y H:i') }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>
                <!-- DANGER ZONE -->
                <div class="overflow-hidden rounded-3xl border border-red-200 bg-white shadow-sm">

                    <!-- HEADER -->
                    <div class="border-b border-red-100 bg-gradient-to-r from-red-50 to-white px-6 py-5">

                        <div class="flex items-center gap-4">

                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-red-500">

                                <i class="fa-solid fa-triangle-exclamation text-lg"></i>

                            </div>

                            <div>

                                <h3 class="text-xl font-black text-red-600">

                                    Vùng nguy hiểm

                                </h3>

                                <p class="mt-1 text-sm text-slate-500">

                                    Thao tác dưới đây có thể làm mất dữ liệu.

                                </p>

                            </div>

                        </div>

                    </div>

                    <!-- CONTENT -->
                    <div class="p-6">

                        <div class="rounded-2xl border border-red-100 bg-red-50 p-5">

                            <div class="flex items-start gap-4">

                                <div
                                    class="mt-1 flex h-10 w-10 items-center justify-center rounded-xl bg-white text-red-500">

                                    <i class="fa-solid fa-trash-can"></i>

                                </div>

                                <div>

                                    <h4 class="font-black text-slate-800">

                                        Xóa tài liệu

                                    </h4>

                                    <p class="mt-2 text-sm leading-6 text-slate-600">

                                        Sau khi xóa, tài liệu sẽ không còn hiển thị trong hệ thống.
                                        Nếu tài liệu đang được người dùng sử dụng, hãy cân nhắc trước khi thực hiện.

                                    </p>

                                </div>

                            </div>

                        </div>

                        <form action="{{ route('documents.destroy', $document) }}" method="POST" class="mt-6"
                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài liệu này?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="flex w-full items-center justify-center gap-2 rounded-2xl bg-red-500 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-red-200 transition-all duration-300 hover:-translate-y-0.5 hover:bg-red-600 active:scale-95">

                                <i class="fa-solid fa-trash"></i>

                                Xóa tài liệu

                            </button>

                        </form>

                    </div>

                </div>

            </aside>

        </section>























    </div>

</main>



@endsection
@push('scripts')
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
@endpush