@extends('layouts.admin')

@section('title', 'Chi tiết tài liệu')
@section('page-title', 'Chi tiết tài liệu')

@section('content')
@php
$versionExt = strtolower($document->currentVersion->file_extension ?? '');
@endphp
<div class="space-y-6">


    <!-- HEADER -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">

        <div class="flex items-start justify-between gap-4">

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
                        {{ $document->title }}
                    </h1>

                    <p class="text-sm text-slate-500 mt-1">
                        {{ $document->description ?? 'Không có mô tả' }}
                    </p>

                </div>

            </div>

            <div class="flex items-center gap-2">

                <a href="{{ route('admin.documents.edit', $document->document_id) }}"
                    class="h-10 px-4 rounded-md bg-amber-500 text-white text-sm font-black flex items-center hover:bg-amber-600">

                    <i class="fa-solid fa-pen mr-2"></i>
                    Chỉnh sửa

                </a>
                {{-- BACK --}}
                <a href="{{ urldecode(request('return', route('admin.documents.index'))) }}"
                    class="h-10 px-4 flex items-center bg-slate-100 text-slate-700 rounded-md font-black hover:bg-slate-200 transition">
                    ← Quay lại
                </a>

            </div>

        </div>

    </div>

    <!-- THÔNG TIN -->
    <div class="lg:col-span-2 space-y-6">

        <!-- THÔNG TIN TÀI LIỆU -->
        <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">

            <!-- HEADER -->
            <div class="px-5 py-4 border-b border-slate-200">

                <h2 class="text-sm font-black text-slate-700">
                    Thông tin tài liệu
                </h2>

            </div>

            <!-- BODY -->
            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">

                    <!-- Tiêu đề -->
                    <div>

                        <p class="text-xs font-bold uppercase tracking-wide text-slate-400">
                            Tiêu đề
                        </p>

                        <p class="mt-2 font-semibold text-slate-700">
                            {{ $document->title }}
                        </p>

                    </div>

                    <!-- Môn học -->
                    <div>

                        <p class="text-xs font-bold uppercase tracking-wide text-slate-400">
                            Môn học
                        </p>

                        <p class="mt-2 font-semibold text-slate-700">
                            {{ $document->subject->subject_name ?? '-' }}
                        </p>

                    </div>

                    <!-- Loại tài liệu -->
                    <div>

                        <p class="text-xs font-bold uppercase tracking-wide text-slate-400">
                            Loại tài liệu
                        </p>

                        <p class="mt-2 font-semibold text-slate-700">
                            {{ $document->documentType->type_name ?? '-' }}
                        </p>

                    </div>

                    <!-- Người tạo -->
                    <div>

                        <p class="text-xs font-bold uppercase tracking-wide text-slate-400">
                            Người tạo
                        </p>

                        <p class="mt-2 font-semibold text-slate-700">
                            {{ $document->uploader->full_name ?? '-' }}
                        </p>

                    </div>

                    <!-- Ngày tạo -->
                    <div>

                        <p class="text-xs font-bold uppercase tracking-wide text-slate-400">
                            Ngày tạo
                        </p>

                        <p class="mt-2 font-semibold text-slate-700">
                            {{ $document->created_at->format('d/m/Y H:i') }}
                        </p>

                    </div>

                    <!-- Cập nhật lần cuối -->
                    <div>

                        <p class="text-xs font-bold uppercase tracking-wide text-slate-400">
                            Cập nhật lần cuối
                        </p>

                        <p class="mt-2 font-semibold text-slate-700">
                            {{ $document->updater->full_name ?? $document->uploader->full_name ?? '-' }}
                        </p>

                        <p class="text-xs text-slate-400 mt-1">
                            {{ $document->updated_at ? $document->updated_at->format('d/m/Y H:i') : '-' }}
                        </p>

                    </div>

                    <!-- Trạng thái -->
                    <div>

                        <p class="text-xs font-bold uppercase tracking-wide text-slate-400 mb-2">
                            Trạng thái
                        </p>

                        @if($document->is_active)

                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-emerald-50 text-emerald-600 text-xs font-black">

                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                            Hoạt động

                        </span>

                        @else

                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-red-50 text-red-500 text-xs font-black">

                            <span class="w-2 h-2 rounded-full bg-red-500"></span>

                            Đã khóa

                        </span>

                        @endif

                    </div>

                </div>

                <!-- Mô tả -->
                <div class="mt-8">

                    <p class="text-xs font-bold uppercase tracking-wide text-slate-400 mb-2">
                        Mô tả
                    </p>

                    <div class="rounded-md border border-slate-200 bg-slate-50 p-4 text-sm leading-7 text-slate-600">

                        {{ $document->description ?: 'Không có mô tả cho tài liệu này.' }}

                    </div>

                </div>

            </div>

        </div>

        <!-- FILE HIỆN TẠI -->

        @if($document->currentVersion)

        <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-200">
                <h2 class="text-sm font-black text-slate-700">
                    File hiện tại
                </h2>

                <p class="text-xs text-slate-400 mt-1">
                    Tệp tài liệu đang được sử dụng
                </p>
            </div>

            <div class="p-5">

                <div class="flex items-center justify-between gap-4">

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

                            <h3 class="font-black text-slate-700 break-all">
                                {{ $document->currentVersion->original_file_name }}
                            </h3>

                            <div class="flex items-center gap-2 mt-1">

                                <span class="px-2 py-1 rounded bg-slate-100 text-slate-600 text-xs font-bold uppercase">
                                    {{ $document->currentVersion->file_extension }}
                                </span>

                                <span class="text-xs text-slate-400">
                                    {{ number_format($document->currentVersion->file_size / 1024, 2) }} KB
                                </span>

                            </div>

                        </div>

                    </div>

                    <a href="{{ asset('storage/' . $document->currentVersion->file_path) }}" target="_blank"
                        class="inline-flex items-center gap-2 h-11 px-4 rounded-md bg-sky-500 text-white text-sm font-black hover:bg-sky-600 transition">

                        <i class="fa-solid fa-eye"></i>
                        Xem file

                    </a>

                </div>

            </div>

        </div>

        @endif
        <!-- DANH SÁCH PHIÊN BẢN -->
        <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">


            <div class="px-5 py-4 border-b border-slate-200">

                <h2 class="text-sm font-black text-slate-700">
                    Lịch sử phiên bản
                </h2>

                <p class="text-xs text-slate-400 mt-1">
                    Danh sách các phiên bản của tài liệu
                </p>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full table-fixed">

                    <!-- HEADER -->
                    <div class="grid grid-cols-12 px-6 py-4 bg-slate-50 text-xs font-black uppercase text-slate-500">

                        <div class="col-span-1">STT</div>

                        <div class="col-span-1">Phiên bản</div>

                        <div class="col-span-4 text-center"> Tên file</div>

                        <div class="col-span-2 text-center"> Kích thước</div>

                        <div class="col-span-2 text-center">Người tải lên</div>
                        <div class="col-span-2 text-center">Ngày tải</div>


                    </div>


                    <div class="divide-y divide-slate-100">

                        @forelse($document->documentVersions as $version)

                        @php
                        $versionExt = strtolower($version->file_extension ?? '');
                        @endphp

                        <div class="grid grid-cols-12 items-center px-6 py-4 hover:bg-slate-50 transition">

                            <!-- STT -->
                            <div class="col-span-1">

                                <span class="font-black text-slate-500">

                                    {{ $loop->iteration }}

                                </span>

                            </div>

                            <!-- PHIÊN BẢN -->
                            <div class="col-span-1">

                                <span class="inline-flex items-center justify-center
                px-3 py-1 rounded-md bg-sky-50
                text-sky-600 text-xs font-black">

                                    {{ $version->version_name }}

                                </span>

                            </div>

                            <!-- TÊN FILE -->
                            <div class="col-span-4">

                                <div class="flex items-center gap-3">

                                    <!-- ICON -->
                                    <div class="w-9 h-9 rounded-md flex items-center justify-center shrink-0

                    @if(in_array($versionExt,['pdf']))
                        bg-red-50 text-red-500
                    @elseif(in_array($versionExt,['doc','docx']))
                        bg-blue-50 text-blue-600
                    @elseif(in_array($versionExt,['xls','xlsx']))
                        bg-green-50 text-green-600
                    @elseif(in_array($versionExt,['ppt','pptx']))
                        bg-orange-50 text-orange-600
                    @else
                        bg-slate-100 text-slate-500
                    @endif">

                                        @if(in_array($versionExt,['pdf']))
                                        <i class="fa-solid fa-file-pdf"></i>

                                        @elseif(in_array($versionExt,['doc','docx']))
                                        <i class="fa-solid fa-file-word"></i>

                                        @elseif(in_array($versionExt,['xls','xlsx']))
                                        <i class="fa-solid fa-file-excel"></i>

                                        @elseif(in_array($versionExt,['ppt','pptx']))
                                        <i class="fa-solid fa-file-powerpoint"></i>

                                        @else
                                        <i class="fa-solid fa-file"></i>

                                        @endif

                                    </div>

                                    <div class="flex-1 min-w-0">

                                        <p class="font-black text-sm text-slate-700 truncate"
                                            title="{{ $version->original_file_name }}">

                                            {{ $version->original_file_name }}

                                        </p>

                                        <p class="text-xs text-slate-400  mt-1">

                                            {{ $version->version_note }}

                                        </p>

                                    </div>

                                </div>

                            </div>

                            <!-- KÍCH THƯỚC -->
                            <div class="col-span-2 text-center">

                                <span class="font-semibold text-slate-700">

                                    {{ number_format($version->file_size / 1024,2) }} KB

                                </span>

                            </div>

                            <!-- NGƯỜI TẢI -->
                            <div class="col-span-2">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="w-8 h-8 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center">

                                        <i class="fa-solid fa-user text-xs"></i>

                                    </div>

                                    <span class="font-semibold text-sm truncate">

                                        {{ $version->uploader->full_name ?? '-' }}

                                    </span>

                                </div>

                            </div>

                            <!-- NGÀY -->
                            <div class="col-span-2 text-center">

                                <div class="font-semibold text-sm text-slate-700">

                                    {{ $version->created_at->format('d/m/Y') }}

                                </div>

                                <div class="text-xs text-slate-400">

                                    {{ $version->created_at->format('H:i') }}

                                </div>

                            </div>

                        </div>

                        @empty

                        <div class="py-16 text-center text-slate-500">

                            <i class="fa-solid fa-clock-rotate-left text-4xl mb-3"></i>

                            <p>Chưa có phiên bản nào.</p>

                        </div>

                        @endforelse

                    </div>

                </table>

            </div>


        </div>


    </div>

</div>

@endsection