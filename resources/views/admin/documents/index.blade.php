@extends('layouts.admin')

@section('title', 'Quản lý tài liệu')
@section('page-title', 'Quản lý tài liệu')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white border rounded-md shadow-sm p-5 flex justify-between items-center">

        <div>
            <h2 class="text-lg font-black">
                Danh sách tài liệu
            </h2>

            <p class="text-sm text-slate-500">
                Quản lý tài liệu môn học
            </p>
        </div>

        <div class="flex gap-3">

            <!-- THÙNG RÁC -->
            <a href="#"
                class="inline-flex items-center gap-2 h-11 px-4 rounded-md bg-white border border-red-200 text-red-500 text-sm font-black hover:bg-red-500 hover:text-white transition">

                <i class="fa-solid fa-trash-can-arrow-up"></i>

                @if($totalTrashedDocuments > 0)
                <span
                    class="min-w-6 h-6 px-2 rounded-full bg-red-500 text-white text-xs font-black flex items-center justify-center">

                    {{ $totalTrashedDocuments }}

                </span>
                @endif

            </a>

            <!-- THÊM TÀI LIỆU -->
            <a href="#"
                class="h-11 px-4 flex items-center bg-sky-500 text-white rounded-md font-black hover:bg-sky-600 transition">

                <i class="fa-solid fa-plus mr-2"></i>

                Thêm tài liệu

            </a>

        </div>

    </div>
    <!-- FILTER -->
    <div class="bg-white border rounded-md shadow-sm p-5">

        <form id="filter-form" class="grid grid-cols-12 gap-4">

            <!-- SEARCH -->
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm tài liệu..."
                class="col-span-5 h-11 px-4 bg-slate-50 border rounded-md">

            <!-- SUBJECT -->
            <select name="subject_code" class="col-span-2 h-11 px-4 bg-slate-50 border rounded-md">

                <option value="">
                    Tất cả môn học
                </option>

                @foreach($subjects as $subject)
                <option value="{{ $subject->subject_code }}">
                    {{ $subject->subject_name }}
                </option>
                @endforeach

            </select>

            <!-- TYPE -->
            <select name="document_type_id" class="col-span-2 h-11 px-4 bg-slate-50 border rounded-md">

                <option value="">
                    Tất cả loại
                </option>

                @foreach($documentTypes as $type)
                <option value="{{ $type->document_type_id }}">
                    {{ $type->type_name }}
                </option>
                @endforeach

            </select>

            <!-- STATUS -->
            <select name="status" class="col-span-1 h-11 px-4 bg-slate-50 border rounded-md">

                <option value="">
                    Tất cả
                </option>

                <option value="1">
                    Hoạt động
                </option>

                <option value="0">
                    Đã khóa
                </option>

            </select>

            <!-- BUTTON -->
            <div class="col-span-2 flex gap-2">

                <button type="submit" class="w-full bg-sky-500 text-white rounded-md font-black hover:bg-sky-600">

                    Lọc

                </button>
                <button type="button" id="btnReset"
                    class="w-full bg-slate-100 flex items-center justify-center rounded-md font-black hover:bg-slate-200">

                    Reset

                </button>

            </div>

        </form>

    </div>
    <!-- BẢNG -->
    <div id="documentTable" class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">
        <div id="table-body">
            <div class="px-5 py-4 border-b flex justify-between items-center">

                <div>
                    <h2 class="font-black text-slate-700">
                        Danh sách tài liệu
                    </h2>

                    <p class="text-xs text-slate-400 mt-1">
                        Quản lý tài liệu môn học
                    </p>
                </div>

                <span class="px-3 py-1 rounded-md bg-sky-50 text-sky-600 text-xs font-black">

                    {{ $totalDocuments }} tài liệu

                </span>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full table-fixed">

                    <thead class="bg-slate-50 border-b border-slate-200">

                        <tr class="text-xs font-black uppercase text-slate-500">

                            <th class="w-16 px-5 py-4 text-center">
                                STT
                            </th>

                            <th class="px-5 py-4 text-left">
                                Tài liệu
                            </th>

                            <th class="w-[250px] px-5 py-4 text-left">
                                Người tạo
                            </th>

                            <th class="w-[120px] px-5 py-4 text-center">
                                Lượt tải
                            </th>

                            <th class="w-[140px] px-5 py-4 text-center">
                                Trạng thái
                            </th>

                            <th class="w-[120px] px-5 py-4 text-center">
                                Thao tác
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($documents as $document)

                        @php
                        $ext = strtolower(
                        $document->currentVersion->file_extension ?? ''
                        );
                        @endphp

                        <tr class="hover:bg-slate-50 transition align-middle">
                            <!-- STT -->
                            <td class="px-5 py-5 align-middle">

                                <div class="flex items-center justify-center">

                                    <span class="inline-flex items-center justify-center
                   w-8 h-8 rounded-md
                   bg-slate-100 text-slate-600
                   text-xs font-black">

                                        {{ $documents->firstItem() + $loop->index }}

                                    </span>

                                </div>

                            </td>

                            <!-- TÀI LIỆU -->
                            <td class="px-5 py-5 align-middle">
                                <div class="flex items-center gap-4">
                                    <!-- ICON -->
                                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0

                            @if(in_array($ext,['pdf']))
                                bg-red-50 text-red-500
                            @elseif(in_array($ext,['doc','docx']))
                                bg-blue-50 text-blue-600
                            @elseif(in_array($ext,['xls','xlsx']))
                                bg-green-50 text-green-600
                            @elseif(in_array($ext,['ppt','pptx']))
                                bg-orange-50 text-orange-600
                            @elseif(in_array($ext,['zip','rar']))
                                bg-yellow-50 text-yellow-600
                            @elseif(in_array($ext,['jpg','jpeg','png','gif','webp']))
                                bg-pink-50 text-pink-600
                            @elseif(in_array($ext,['mp4','avi','mov']))
                                bg-purple-50 text-purple-600
                            @else
                                bg-slate-100 text-slate-500
                            @endif">

                                        @if(in_array($ext,['pdf']))
                                        <i class="fa-solid fa-file-pdf text-lg"></i>

                                        @elseif(in_array($ext,['doc','docx']))
                                        <i class="fa-solid fa-file-word text-lg"></i>

                                        @elseif(in_array($ext,['xls','xlsx']))
                                        <i class="fa-solid fa-file-excel text-lg"></i>

                                        @elseif(in_array($ext,['ppt','pptx']))
                                        <i class="fa-solid fa-file-powerpoint text-lg"></i>

                                        @elseif(in_array($ext,['zip','rar']))
                                        <i class="fa-solid fa-file-zipper text-lg"></i>

                                        @elseif(in_array($ext,['jpg','jpeg','png','gif','webp']))
                                        <i class="fa-solid fa-file-image text-lg"></i>

                                        @elseif(in_array($ext,['mp4','avi','mov']))
                                        <i class="fa-solid fa-file-video text-lg"></i>

                                        @else
                                        <i class="fa-solid fa-file text-lg"></i>
                                        @endif

                                    </div>

                                    <!-- THÔNG TIN -->
                                    <div class="flex-1 min-w-0">

                                        <h4 class="font-black text-slate-700 text-[15px] truncate"
                                            title="{{ $document->title }}">

                                            {{ $document->title }}

                                        </h4>

                                        <p class="text-sm text-slate-400 truncate mt-1"
                                            title="{{ $document->description }}">

                                            {{ $document->description ?? 'Không có mô tả' }}

                                        </p>

                                        <div class="flex flex-wrap gap-2 mt-2">

                                            <span
                                                class="px-2 py-0.5 rounded bg-slate-100 text-slate-500 text-[11px] font-bold">

                                                {{ $document->subject->subject_code ?? '-' }}

                                            </span>

                                            <span
                                                class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-600 text-[11px] font-bold">

                                                {{ $document->subject->subject_name ?? '-' }}

                                            </span>

                                            <span
                                                class="px-2 py-0.5 rounded bg-sky-50 text-sky-600 text-[11px] font-bold">

                                                {{ $document->documentType->type_name ?? '-' }}

                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </td>

                            <!-- NGƯỜI TẠO -->
                            <td class="px-5 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="w-9 h-9 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center shrink-0">

                                        <i class="fa-solid fa-user text-sm"></i>

                                    </div>

                                    <span class="text-sm font-semibold text-slate-700">

                                        {{ $document->uploader->full_name ?? '-' }}

                                    </span>

                                </div>

                            </td>

                            <!-- LƯỢT TẢI -->
                            <td class="px-5 py-5 text-center">

                                <span class="font-black text-slate-700">

                                    {{ number_format($document->download_count) }}

                                </span>

                            </td>

                            <td class="px-5 py-5 text-center">

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

                            </td>

                            <!-- THAO TÁC -->
                            <td class="px-5 py-5">

                                <div class="flex justify-center items-center gap-2">

                                    <a href="{{ route('admin.documents.show',$document->document_id) }}"
                                        class="w-9 h-9 rounded-md bg-sky-50 text-sky-600 flex items-center justify-center hover:bg-sky-100 transition">

                                        <i class="fa-solid fa-eye"></i>

                                    </a>

                                    <a href="{{ route('admin.documents.edit',$document->document_id) }}"
                                        class="w-9 h-9 rounded-md bg-amber-50 text-amber-600 flex items-center justify-center hover:bg-amber-100 transition">

                                        <i class="fa-solid fa-pen"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="py-12 text-center">

                                <div
                                    class="w-16 h-16 mx-auto rounded-md bg-slate-100 text-slate-400 flex items-center justify-center mb-3">

                                    <i class="fa-solid fa-file-circle-xmark text-2xl"></i>

                                </div>

                                <p class="text-sm font-black text-slate-500">

                                    Chưa có tài liệu nào

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
@endsection @push('scripts') <script>
document.addEventListener('DOMContentLoaded', function() {

    const form = document.getElementById('filter-form');
    const resetBtn = document.getElementById('btnReset');

    async function load(url = null) {

        const params = new URLSearchParams(
            new FormData(form)
        );

        let requestUrl = url ??
            "{{ route('admin.documents.index') }}?" +
            params.toString();

        const response = await fetch(requestUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const html = await response.text();

        const doc = new DOMParser()
            .parseFromString(html, 'text/html');

        document.getElementById('documentTable').innerHTML =
            doc.getElementById('documentTable').innerHTML;

        history.pushState({}, '', requestUrl);
    }

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        load();
    });

    resetBtn.addEventListener('click', function() {

        form.reset();

        load(
            "{{ route('admin.documents.index') }}"
        );
    });

});
</script>
@endpush