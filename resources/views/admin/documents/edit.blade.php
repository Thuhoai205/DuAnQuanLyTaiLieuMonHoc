@extends('layouts.admin')

@section('title', 'Chỉnh sửa tài liệu')
@section('page-title', 'Chỉnh sửa tài liệu')

@section('content')
@php
$versionExt = strtolower($document->currentVersion->file_extension ?? '');
@endphp
<form action="{{ route('admin.documents.update', $document->document_id) }}" method="POST"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-4">

                    <div class="w-10 h-10 rounded-md flex items-center justify-center shrink-0

    @if(in_array(  $versionExt,['pdf']))
        bg-red-50 text-red-500
    @elseif(in_array(  $versionExt,['doc','docx']))
        bg-blue-50 text-blue-600
    @elseif(in_array(  $versionExt,['xls','xlsx']))
        bg-green-50 text-green-600
    @elseif(in_array(  $versionExt,['ppt','pptx']))
        bg-orange-50 text-orange-600
    @else
        bg-slate-100 text-slate-500
    @endif
">

                        @if(in_array( $versionExt,['pdf']))
                        <i class="fa-solid fa-file-pdf"></i>

                        @elseif(in_array( $versionExt,['doc','docx']))
                        <i class="fa-solid fa-file-word"></i>

                        @elseif(in_array( $versionExt,['xls','xlsx']))
                        <i class="fa-solid fa-file-excel"></i>

                        @elseif(in_array( $versionExt,['ppt','pptx']))
                        <i class="fa-solid fa-file-powerpoint"></i>

                        @else
                        <i class="fa-solid fa-file"></i>
                        @endif

                    </div>

                    <div>

                        <h1 class="text-xl font-black text-slate-700">
                            Chỉnh sửa tài liệu
                        </h1>

                        <p class="text-sm text-slate-500">
                            Cập nhật thông tin tài liệu môn học
                        </p>

                    </div>

                </div>

                <div class="flex gap-2">

                    <a href="{{ route('admin.documents.show',$document->document_id) }}"
                        class="h-10 px-4 rounded-md border border-slate-200 bg-white text-slate-600 text-sm font-black flex items-center">

                        <i class="fa-solid fa-arrow-left mr-2"></i>
                        Quay lại

                    </a>

                    <button type="submit" {{ $document->subject?->status !== 'active' ? 'disabled' : '' }}
                        class="h-11 px-5 bg-sky-500 text-white rounded-md font-black disabled:opacity-50 disabled:cursor-not-allowed">

                        Lưu thay đổi

                    </button>

                </div>

            </div>

        </div>

        <div class="grid grid-cols-12 gap-6">

            <!-- LEFT -->
            <div class="col-span-12 xl:col-span-8">

                <div class="bg-white border border-slate-200 rounded-md shadow-sm">

                    <div class="px-5 py-4 border-b">

                        <h2 class="text-sm font-black text-slate-700">
                            Thông tin tài liệu
                        </h2>

                    </div>

                    <div class="p-5 space-y-5">

                        <!-- Tiêu đề -->
                        <div>

                            <label class="block text-sm font-black text-slate-600 mb-2">
                                Tiêu đề
                            </label>

                            <input type="text" name="title" value="{{ old('title',$document->title) }}"
                                class="w-full h-11 px-4 border border-slate-300 rounded-md focus:ring-2 focus:ring-sky-200">

                        </div>

                        <!-- Môn học -->
                        <div>

                            <label class="block text-sm font-black text-slate-600 mb-2">
                                Môn học
                            </label>

                            <select name="subject_code" class="w-full h-11 px-4 border border-slate-300 rounded-md">

                                @foreach($subjects as $subject)

                                <option value="{{ $subject->subject_code }}" @selected($document->subject_code ==
                                    $subject->subject_code)>

                                    {{ $subject->subject_name }}

                                </option>

                                @endforeach

                            </select>

                        </div>

                        <!-- Loại tài liệu -->
                        <div>

                            <label class="block text-sm font-black text-slate-600 mb-2">
                                Loại tài liệu
                            </label>

                            <select name="document_type_id" class="w-full h-11 px-4 border border-slate-300 rounded-md">

                                @foreach($documentTypes as $type)

                                <option value="{{ $type->document_type_id }}" @selected($document->document_type_id ==
                                    $type->document_type_id)>

                                    {{ $type->type_name }}

                                </option>

                                @endforeach

                            </select>

                        </div>
                        <!-- TRẠNG THÁI -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Trạng thái
                            </label>

                            @if($document->subject?->status !== 'active')

                            <div class="mb-3 p-3 rounded-md bg-red-50 border border-red-200">
                                <p class="text-sm text-red-600 font-semibold">
                                    Môn học đã bị khóa. Không thể thay đổi trạng thái tài liệu.
                                </p>
                            </div>

                            @endif

                            <div class="flex gap-6">

                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="is_active" value="1"
                                        {{ $document->is_active ? 'checked' : '' }}
                                        {{ $document->subject?->status !== 'active' ? 'disabled' : '' }}>

                                    <span class="text-emerald-600 font-semibold">
                                        Hoạt động
                                    </span>
                                </label>

                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="is_active" value="0"
                                        {{ !$document->is_active ? 'checked' : '' }}
                                        {{ $document->subject?->status !== 'active' ? 'disabled' : '' }}>

                                    <span class="text-red-500 font-semibold">
                                        Đã khóa
                                    </span>
                                </label>

                            </div>
                        </div>
                        <!-- Mô tả -->
                        <div>

                            <label class="block text-sm font-black text-slate-600 mb-2">
                                Mô tả
                            </label>

                            <textarea name="description" rows="6"
                                class="w-full p-4 border border-slate-300 rounded-md resize-none">{{ old('description',$document->description) }}</textarea>

                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="col-span-12 xl:col-span-4">

                <div class="space-y-6">

                    <!-- FILE HIỆN TẠI -->
                    <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">

                        <div class="px-5 py-4 border-b border-slate-200">

                            <h2 class="text-sm font-black text-slate-700">
                                File hiện tại
                            </h2>

                            <p class="text-xs text-slate-400 mt-1">
                                Phiên bản đang được sử dụng
                            </p>

                        </div>

                        <div class="p-5">

                            @if($document->currentVersion)

                            <div class="flex items-center gap-4">

                                <div
                                    class="w-14 h-14 rounded-md bg-red-50 text-red-500 flex items-center justify-center shrink-0">

                                    <i class="fa-solid fa-file-pdf text-2xl"></i>

                                </div>

                                <div class="flex-1 min-w-0">

                                    <h3 class="font-black text-slate-700 break-all">
                                        {{ $document->currentVersion->original_file_name }}
                                    </h3>

                                    <div class="flex items-center gap-2 mt-2">

                                        <span
                                            class="px-2 py-1 rounded bg-slate-100 text-slate-600 text-xs font-bold uppercase">

                                            {{ $document->currentVersion->file_extension }}

                                        </span>

                                        <span class="text-xs text-slate-400">

                                            {{ number_format($document->currentVersion->file_size / 1024, 2) }} KB

                                        </span>

                                    </div>

                                </div>

                            </div>

                            <a href="{{ asset('storage/' . $document->currentVersion->file_path) }}" target="_blank"
                                class="mt-5 h-11 w-full rounded-md bg-sky-500 hover:bg-sky-600 text-white text-sm font-black flex items-center justify-center">

                                <i class="fa-solid fa-eye mr-2"></i>
                                Xem file hiện tại

                            </a>

                            @else

                            <div class="text-center py-8">

                                <div
                                    class="w-14 h-14 mx-auto rounded-md bg-slate-100 text-slate-400 flex items-center justify-center mb-3">

                                    <i class="fa-solid fa-file-circle-xmark text-xl"></i>

                                </div>

                                <p class="text-sm text-slate-500">
                                    Chưa có file đính kèm
                                </p>

                            </div>

                            @endif

                        </div>

                    </div>

                    <!-- CẬP NHẬT FILE -->
                    <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">

                        <div class="px-5 py-4 border-b border-slate-200">

                            <h2 class="text-sm font-black text-slate-700">
                                Cập nhật phiên bản mới
                            </h2>

                            <p class="text-xs text-slate-400 mt-1">
                                Upload file mới để tạo version tiếp theo
                            </p>

                        </div>

                        <div class="p-5">

                            <!-- FILE -->
                            <div>

                                <label class="block text-sm font-bold text-slate-700 mb-2">
                                    Chọn file mới
                                </label>

                                <input type="file" name="file" class="block w-full text-sm text-slate-600
            file:mr-4
            file:px-4
            file:py-2
            file:rounded-md
            file:border-0
            file:bg-sky-50
            file:text-sky-600
            file:font-black
            hover:file:bg-sky-100">

                            </div>

                            <!-- VERSION NOTE -->
                            <div class="mt-5">

                                <label class="block text-sm font-bold text-slate-700 mb-2">
                                    Ghi chú phiên bản
                                </label>

                                <textarea name="version_note" rows="3"
                                    placeholder="Ví dụ: Chuyển tài liệu sang PDF, cập nhật chương 5, sửa lỗi nội dung..."
                                    class="w-full rounded-md border border-slate-300 px-4 py-3 text-sm
            focus:border-sky-500 focus:ring-2 focus:ring-sky-200">{{ old('version_note') }}</textarea>

                                <p class="mt-2 text-xs text-slate-400">
                                    Ghi chú giúp theo dõi những thay đổi của từng phiên bản tài liệu.
                                </p>

                            </div>

                            <!-- INFO -->
                            <div class="mt-5 p-3 rounded-md bg-amber-50 border border-amber-200">

                                <div class="flex gap-2">

                                    <i class="fa-solid fa-circle-info text-amber-500 mt-0.5"></i>

                                    <div class="text-xs text-amber-700">

                                        <p class="font-bold">
                                            Lưu ý
                                        </p>

                                        <p class="mt-1">
                                            Nếu chọn file mới, hệ thống sẽ tự tạo phiên bản tiếp theo
                                            và lưu lại toàn bộ lịch sử các phiên bản cũ.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</form>

@endsection