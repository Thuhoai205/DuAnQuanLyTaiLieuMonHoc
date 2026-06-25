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
                <a href="{{ route('admin.documents.index') }}"
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

            <div class="px-5 py-4 border-b border-slate-200">
                <h2 class="text-sm font-black text-slate-700">
                    Thông tin tài liệu
                </h2>
            </div>

            <div class="p-5">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <p class="text-xs font-bold uppercase text-slate-400">
                            Tiêu đề
                        </p>

                        <p class="mt-1 font-semibold text-slate-700">
                            {{ $document->title }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase text-slate-400">
                            Môn học
                        </p>

                        <p class="mt-1 font-semibold text-slate-700">
                            {{ $document->subject->subject_name ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase text-slate-400">
                            Loại tài liệu
                        </p>

                        <p class="mt-1 font-semibold text-slate-700">
                            {{ $document->documentType->type_name ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase text-slate-400">
                            Người đăng </p>

                        <p class="mt-1 font-semibold text-slate-700">
                            {{ $document->uploader->full_name ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase text-slate-400">
                            Ngày tạo
                        </p>

                        <p class="mt-1 font-semibold text-slate-700">
                            {{ $document->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase text-slate-400">
                            Trạng thái
                        </p>

                        @if($document->is_active)
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 rounded-md bg-emerald-50 text-emerald-600 text-xs font-black">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Hoạt động
                        </span>
                        @else
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 rounded-md bg-red-50 text-red-500 text-xs font-black">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            Đã khóa
                        </span>
                        @endif

                    </div>

                </div>

                <div class="mt-6">

                    <p class="text-xs font-bold uppercase text-slate-400">
                        Mô tả
                    </p>

                    <div class="mt-2 p-4 rounded-md bg-slate-50 border border-slate-200 text-slate-600">
                        {{ $document->description ?? 'Không có mô tả cho tài liệu này.' }}
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

                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr class="text-xs font-black uppercase text-slate-500">

                            <th class="px-5 py-4 text-center">
                                STT
                            </th>

                            <th class="px-5 py-4 text-center">
                                Phiên bản
                            </th>

                            <th class="px-5 py-4">
                                Tên file
                            </th>

                            <th class="px-5 py-4 text-center">
                                Kích thước
                            </th>

                            <th class="px-5 py-4">
                                Người tải lên
                            </th>

                            <th class="px-5 py-4 text-center">
                                Ngày tải
                            </th>

                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($document->documentVersions as $version)
                        @php
                        $versionExt = strtolower($version->file_extension ?? '');
                        @endphp
                        <tr class="hover:bg-slate-50 transition">

                            <!-- STT -->
                            <td class="px-5 py-5 text-center whitespace-nowrap">

                                <span
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-slate-100 text-slate-600 text-xs font-black">

                                    {{ $loop->iteration }}

                                </span>

                            </td>

                            <!-- PHIÊN BẢN -->
                            <td class="px-5 py-5 text-center whitespace-nowrap">

                                <span
                                    class="inline-flex items-center justify-center min-w-[60px] px-3 py-1 rounded-md bg-sky-50 text-sky-600 text-xs font-black">

                                    1.{{ $loop->index }}
                                </span>

                            </td>

                            <!-- TÊN FILE -->
                            <td class="px-5 py-5">
                                <div class="flex items-center gap-3">

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
                @endif">

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
                                        <p class="font-black text-slate-700">
                                            {{ $version->original_file_name }}
                                        </p>

                                        <p class="text-xs text-slate-400 uppercase">
                                            {{ $version->file_extension }}
                                        </p>
                                    </div>

                                </div>
                            </td>

                            <!-- KÍCH THƯỚC -->
                            <td class="px-5 py-5 text-center whitespace-nowrap">

                                <span class="font-black text-slate-700">

                                    {{ number_format($version->file_size / 1024, 2) }} KB

                                </span>

                            </td>

                            <td class="px-5 py-5 whitespace-nowrap">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="w-9 h-9 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center shrink-0">

                                        <i class="fa-solid fa-user text-sm"></i>

                                    </div>

                                    <span class="font-semibold text-slate-700">

                                        {{ $version->uploader->full_name ?? '-' }}

                                    </span>

                                </div>

                            </td>

                            <!-- NGÀY TẢI -->
                            <td class="px-5 py-5 text-center whitespace-nowrap">

                                <div class="font-semibold text-slate-700">

                                    {{ $version->created_at->format('d/m/Y') }}

                                </div>

                                <div class="text-xs text-slate-400 mt-1">

                                    {{ $version->created_at->format('H:i') }}

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="py-12 text-center">

                                <div
                                    class="w-14 h-14 mx-auto rounded-md bg-slate-100 text-slate-400 flex items-center justify-center mb-3">

                                    <i class="fa-solid fa-clock-rotate-left text-xl"></i>

                                </div>

                                <p class="text-sm font-bold text-slate-500">
                                    Chưa có phiên bản nào.
                                </p>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


        </div>


    </div>

</div>

@endsection