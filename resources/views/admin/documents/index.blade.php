@extends('layouts.admin')

@section('title', 'Quản lý tài liệu')
@section('page-title', 'Quản lý tài liệu')

@section('content')

<div id="documents-area" class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <!-- LEFT -->
            <div>

                <h1 class="text-2xl font-black text-slate-900">

                    Quản lý tài liệu

                </h1>

                <p class="mt-2 text-sm font-medium text-slate-500">

                    Quản lý danh sách tài liệu môn học trong hệ thống.

                </p>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-3">

                <!-- THÙNG RÁC -->
                <a href="{{ route('admin.documents.trashed') }}" class="inline-flex
                items-center
                gap-2
                h-11
                px-5
                rounded-xl
                border
                border-red-200
                bg-white
                text-red-600
                text-sm
                font-bold
                hover:bg-red-500
                hover:text-white
                transition-all duration-300">

                    <i class="fa-solid fa-trash-can-arrow-up"></i>


                    @if($totalTrashedDocuments > 0)

                    <span class="min-w-6
                        h-6
                        px-2
                        rounded-full
                        bg-red-500
                        text-white
                        text-xs
                        font-black
                        flex
                        items-center
                        justify-center">

                        {{ $totalTrashedDocuments }}

                    </span>

                    @endif

                </a>

                <!-- ADD -->
                <a href="{{ route('admin.documents.create') }}" class="inline-flex
                    items-center
                    gap-2
                    h-11
                    px-5
                    rounded-xl
                    bg-amber-500
                    text-white
                    text-sm
                    font-bold
                    hover:bg-amber-600
                    transition-all duration-300">

                    <i class="fa-solid fa-plus"></i>

                    Thêm tài liệu

                </a>

            </div>

        </div>

    </div>
    <!-- FILTER -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

        <form id="filter-form" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

            <!-- SEARCH -->
            <div class="md:col-span-5">

                <label class="block text-xs font-bold uppercase tracking-wide text-slate-500 mb-2">

                    Tìm kiếm

                </label>

                <div class="relative">

                    <i class="fa-solid fa-magnifying-glass
                    absolute
                    left-4
                    top-1/2
                    -translate-y-1/2
                    text-slate-400">
                    </i>

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Tìm theo tên hoặc mã tài liệu..." class="w-full
                    h-11
                    pl-11
                    pr-4
                    rounded-xl
                    border border-slate-200
                    bg-slate-50
                    text-sm
                    font-medium
                    focus:bg-white
                    focus:border-amber-500
                    focus:ring-4
                    focus:ring-amber-100">

                </div>

            </div>
            <!-- SUBJECT -->
            <div class="md:col-span-3">

                <label class="block text-xs font-bold uppercase tracking-wide text-slate-500 mb-2">

                    Môn học

                </label>

                <select name="subject_code" class="w-full
        h-11
        px-4
        rounded-xl
        border border-slate-200
        bg-slate-50
        text-sm
        font-medium
        text-slate-700
        focus:bg-white
        focus:border-amber-500
        focus:ring-4
        focus:ring-amber-100">

                    <option value="">Tất cả môn học</option>

                    @foreach($subjects as $subject)

                    <option value="{{ $subject->subject_code }}" @selected(request('subject_code')==$subject->
                        subject_code)>

                        {{ $subject->subject_name }}

                    </option>

                    @endforeach

                </select>

            </div>

            <!-- DOCUMENT TYPE -->
            <div class="md:col-span-2">

                <label class="block text-xs font-bold uppercase tracking-wide text-slate-500 mb-2">

                    Loại tài liệu

                </label>

                <select name="document_type_id" class="w-full
        h-11
        px-4
        rounded-xl
        border border-slate-200
        bg-slate-50
        text-sm
        font-medium
        text-slate-700
        focus:bg-white
        focus:border-amber-500
        focus:ring-4
        focus:ring-amber-100">

                    <option value="">Tất cả loại</option>

                    @foreach($documentTypes as $type)

                    <option value="{{ $type->document_type_id }}" @selected(request('document_type_id')==$type->
                        document_type_id)>

                        {{ $type->type_name }}

                    </option>

                    @endforeach

                </select>

            </div>

            <!-- STATUS -->
            <div class="md:col-span-2">

                <label class="block text-xs font-bold uppercase tracking-wide text-slate-500 mb-2">

                    Trạng thái

                </label>

                <select name="status" class="w-full
        h-11
        px-4
        rounded-xl
        border border-slate-200
        bg-slate-50
        text-sm
        font-medium
        text-slate-700
        focus:bg-white
        focus:border-amber-500
        focus:ring-4
        focus:ring-amber-100">

                    <option value="">Tất cả</option>

                    <option value="1" @selected(request('status')=='1' )>
                        Hoạt động
                    </option>

                    <option value="0" @selected(request('status')=='0' )>
                        Đã khóa
                    </option>

                </select>

            </div>

            <!-- BUTTON -->
            <div class="md:col-span-2 flex gap-3">

                <button type="submit" class="flex-1
                    rounded-xl
                    bg-amber-500
                    text-white
                    text-sm
                    font-bold
                    hover:bg-amber-600
                    transition-all duration-300">

                    Lọc

                </button>

                <button type="button" id="btnReset" class="flex-1
        h-11
        rounded-xl
        border border-slate-200
        bg-slate-100
        text-slate-700
        text-sm
        font-bold
        hover:bg-slate-200
        transition-all duration-300">

                    <i class="fa-solid fa-rotate-left mr-2"></i>

                    Đặt lại

                </button>

            </div>


    </div>
    <!-- BẢNG -->
    <div id="documentTable" class="bg-white border rounded-md shadow-sm overflow-hidden">
        <div id="table-body">
            <!-- TABLE HEADER -->
            <div class="px-6 py-5 border-b border-slate-200 bg-white">

                <div class="flex items-center justify-between">

                    <!-- LEFT -->
                    <div>

                        <h2 class="text-lg font-black text-slate-900">

                            Danh sách tài liệu

                        </h2>

                        <p class="mt-1 text-sm font-medium text-slate-500">

                            Quản lý và cập nhật tài liệu môn học trong hệ thống.

                        </p>

                    </div>

                    <!-- TOTAL -->
                    <span class="inline-flex
            items-center
            rounded-full
            border
            border-amber-300
            bg-amber-50
            px-5
            py-2
            text-sm
            font-bold
            text-amber-700">

                        {{ $totalDocuments }} tài liệu

                    </span>

                </div>

            </div>
            <div class="overflow-x-auto overflow-y-visible">

                <table class="w-full table-fixed">

                    <!-- TABLE HEADER -->
                    <div class="grid
            grid-cols-12
            px-6
            py-5
            bg-slate-50/80
            border-b
            border-slate-200
            text-[13px]
            font-blackg 
            uppercase
            tracking-wide
            text-slate-600">

                        <!-- STT -->
                        <div class="col-span-1">

                            STT

                        </div>

                        <!-- DOCUMENT -->
                        <div class="col-span-4">

                            Thông tin tài liệu

                        </div>

                        <!-- UPLOADER -->
                        <div class="col-span-2">

                            Người tải lên

                        </div>

                        <!-- STATUS -->
                        <div class="col-span-2 text-center">

                            Trạng thái

                        </div>

                        <!-- DOWNLOAD -->
                        <div class="col-span-1 text-center">

                            Lượt tải

                        </div>

                        <!-- ACTION -->
                        <div class="col-span-2 text-right">

                            Thao tác

                        </div>

                    </div>

                    <!-- TABLE BODY -->
                    <div class="divide-y divide-slate-100">

                        @forelse($documents as $document)

                        @php
                        $ext = strtolower($document->currentVersion->file_extension ?? '');
                        $active = $document->is_active;
                        @endphp

                        <div id="document-{{ $document->document_id }}" class="grid
                grid-cols-12
                items-center
                px-6
                py-5
                hover:bg-amber-50/40
                transition-all
                duration-300">

                            <!-- STT -->
                            <div class="col-span-1">

                                <span class="text-sm font-black text-slate-700">

                                    {{ ($documents->currentPage() - 1) * $documents->perPage() + $loop->iteration }}

                                </span>

                            </div>

                            <!-- THÔNG TIN TÀI LIỆU -->
                            <div class="col-span-4">

                                <div class="flex items-center gap-4">

                                    <!-- ICON -->
                                    <div class="w-11
                            h-11
                            rounded-xl
                            flex
                            items-center
                            justify-center
                            shadow-sm
                            shrink-0

                            @if(in_array($ext,['pdf']))
                                bg-red-50 text-red-600
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
                                        <i class="fa-solid fa-file-pdf"></i>

                                        @elseif(in_array($ext,['doc','docx']))
                                        <i class="fa-solid fa-file-word"></i>

                                        @elseif(in_array($ext,['xls','xlsx']))
                                        <i class="fa-solid fa-file-excel"></i>

                                        @elseif(in_array($ext,['ppt','pptx']))
                                        <i class="fa-solid fa-file-powerpoint"></i>

                                        @elseif(in_array($ext,['zip','rar']))
                                        <i class="fa-solid fa-file-zipper"></i>

                                        @elseif(in_array($ext,['jpg','jpeg','png','gif','webp']))
                                        <i class="fa-solid fa-file-image"></i>

                                        @elseif(in_array($ext,['mp4','avi','mov']))
                                        <i class="fa-solid fa-file-video"></i>

                                        @else
                                        <i class="fa-solid fa-file"></i>
                                        @endif

                                    </div>

                                    <!-- INFO -->
                                    <div class="flex-1 min-w-0">
                                        <!-- TITLE -->
                                        <h4 class="text-sm
                                font-black
                                text-slate-800
                                truncate
                                transition-colors
                                duration-300
                                group-hover:text-amber-600" title="{{ $document->title }}">

                                            {{ $document->title }}

                                        </h4>

                                        <!-- DESCRIPTION -->
                                        <p class="mt-1
                                text-xs
                                font-medium
                                text-slate-500
                                truncate" title="{{ $document->description }}">

                                            {{ $document->description ?? 'Không có mô tả' }}

                                        </p>

                                        <!-- TAG -->
                                        <div class="flex flex-wrap gap-2 mt-3">

                                            <!-- SUBJECT CODE -->
                                            <span class="inline-flex
                                    items-center
                                    rounded-full
                                    bg-amber-50
                                    px-3
                                    py-1
                                    text-[11px]
                                    font-semibold
                                    text-amber-700">

                                                {{ $document->subject->subject_code ?? '-' }}

                                            </span>

                                            <!-- SUBJECT NAME -->
                                            <span class="inline-flex
                                    items-center
                                    rounded-full
                                    bg-slate-100
                                    px-3
                                    py-1
                                    text-[11px]
                                    font-semibold
                                    text-slate-600">

                                                {{ $document->subject->subject_name ?? '-' }}

                                            </span>

                                            <!-- DOCUMENT TYPE -->
                                            <span class="inline-flex
                                    items-center
                                    rounded-full
                                    bg-sky-50
                                    px-3
                                    py-1
                                    text-[11px]
                                    font-semibold
                                    text-sky-700">

                                                {{ $document->documentType->type_name ?? '-' }}

                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- NGƯỜI TẠO -->
                            <div class="col-span-2">

                                <div class="flex items-center gap-3">

                                    <div class="w-10
                            h-10
                            rounded-full
                            bg-amber-50
                            text-amber-600
                            flex
                            items-center
                            justify-center">

                                        <i class="fa-solid fa-user"></i>

                                    </div>

                                    <div class="min-w-0">

                                        <p class="text-sm
                                font-black
                                text-slate-800
                                truncate">

                                            {{ $document->uploader->full_name ?? '-' }}

                                        </p>

                                        <p class="text-xs
                                text-slate-500
                                truncate">

                                            Người tải lên

                                        </p>

                                    </div>

                                </div>

                            </div>
                            <!-- TRẠNG THÁI -->
                            <div class="col-span-2 flex justify-center">

                                @if($document->is_active)

                                <span class="inline-flex
                        items-center
                        gap-2
                        rounded-full
                        bg-emerald-50
                        px-3
                        py-1
                        text-xs
                        font-bold
                        text-emerald-600">

                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                                    Hoạt động

                                </span>

                                @else

                                <span class="inline-flex
                        items-center
                        gap-2
                        rounded-full
                        bg-red-50
                        px-3
                        py-1
                        text-xs
                        font-bold
                        text-red-600">

                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>

                                    Đã khóa

                                </span>

                                @endif

                            </div>

                            <!-- LƯỢT TẢI -->
                            <div class="col-span-1 text-center">

                                <span class="text-sm font-black text-slate-800">

                                    {{ number_format($document->download_count) }}

                                </span>

                            </div>

                            <!-- ACTION -->
                            <div class="col-span-2 flex justify-end">

                                <div class="relative">

                                    <!-- BUTTON -->
                                    <button type="button" class="action-btn
                w-10
                h-10
                rounded-xl
                border
                border-slate-200
                bg-white
                text-slate-500
                hover:bg-amber-50
                hover:text-amber-500
                transition-all
                duration-300" data-id="{{ $document->document_id }}">

                                        <i class="fa-solid fa-ellipsis-vertical"></i>

                                    </button>

                                    <!-- MENU -->
                                    <div id="action-menu-{{ $document->document_id }}" class="hidden
                absolute
                right-0
                top-12
                w-52
                rounded-xl
                bg-white
                border
                border-slate-200
                shadow-xl
                z-[9999]
                ">

                                        <!-- VIEW -->
                                        <a href="{{ route('admin.documents.show',[
                    'document'=>$document->document_id,
                    'return'=>urlencode(request()->fullUrl().'#document-'.$document->document_id)
                ]) }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-50">

                                            <i class="fa-solid fa-eye w-5 text-slate-500"></i>

                                            Xem chi tiết

                                        </a>

                                        <!-- EDIT -->
                                        <a href="{{ route('admin.documents.edit',$document->document_id) }}"
                                            class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-amber-600 hover:bg-amber-50">

                                            <i class="fa-solid fa-pen w-5"></i>

                                            Chỉnh sửa

                                        </a>

                                        <!-- STATUS -->
                                        <button type="button"
                                            onclick="toggleStatus('{{ $document->document_id }}', this)" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium
                {{ $active
                    ? 'text-emerald-600 hover:bg-emerald-50'
                    : 'text-yellow-600 hover:bg-yellow-50'
                }}">

                                            <i class="fa-solid {{ $active ? 'fa-lock-open' : 'fa-lock' }} w-5"></i>

                                            {{ $active ? 'Khóa tài liệu' : 'Mở khóa tài liệu' }}

                                        </button>

                                        <!-- DELETE -->
                                        <form action="{{ route('admin.documents.destroy',$document->document_id) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="button"
                                                onclick="deleteDocument('{{ $document->document_id }}', this)"
                                                class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-50">

                                                <i class="fa-solid fa-trash w-5"></i>

                                                Xóa tài liệu

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>
                        </div>
                        @empty

                        <div class="py-24 text-center">

                            <div class="flex flex-col items-center">

                                <!-- ICON -->
                                <div class="w-24
                        h-24
                        rounded-full
                        bg-amber-50
                        flex
                        items-center
                        justify-center">

                                    <i class="fa-solid fa-folder-open text-4xl text-amber-400"></i>

                                </div>

                                <!-- TITLE -->
                                <h3 class="mt-6
                        text-xl
                        font-black
                        text-slate-800">

                                    Chưa có tài liệu nào

                                </h3>

                                <!-- DESCRIPTION -->
                                <p class="mt-2
                        text-sm
                        font-medium
                        text-slate-500">

                                    Hiện tại hệ thống chưa có tài liệu nào được thêm.

                                </p>

                                <!-- BUTTON -->
                                <a href="{{ route('admin.documents.create') }}" class="mt-6
                        inline-flex
                        items-center
                        gap-2
                        rounded-xl
                        bg-amber-500
                        px-5
                        py-3
                        text-sm
                        font-bold
                        text-white
                        hover:bg-amber-600
                        transition-all
                        duration-300">

                                    <i class="fa-solid fa-plus"></i>

                                    Thêm tài liệu

                                </a>

                            </div>

                        </div>

                        @endforelse

                    </div>

                </table>

            </div>
        </div>
        {{-- PAGINATION --}}
        @if($documents->count())

        <div class="border-t border-slate-200 bg-slate-50 px-6 py-5">

            <div class="flex flex-col md:flex-row items-center justify-between gap-4">

                <!-- INFO -->
                <p class="text-sm font-medium text-slate-500">

                    Hiển thị

                    <span class="font-bold text-slate-900">
                        {{ $documents->firstItem() ?? 0 }}
                    </span>

                    -

                    <span class="font-bold text-slate-900">
                        {{ $documents->lastItem() ?? 0 }}
                    </span>

                    trong tổng

                    <span class="font-bold text-slate-900">
                        {{ $documents->total() }}
                    </span>

                    tài liệu
                </p>

                <!-- PAGINATION -->
                <div class="flex items-center gap-2">

                    {{-- Previous --}}
                    @if ($documents->onFirstPage())

                    <span class="w-10 h-10 rounded-xl
                        bg-white
                        border border-slate-200
                        text-slate-300
                        flex items-center justify-center
                        cursor-not-allowed">

                        <i class="fa-solid fa-angle-left"></i>

                    </span>

                    @else

                    <a href="{{ $documents->previousPageUrl() }}" class="ajax-subject-page
                        w-10 h-10
                        rounded-xl
                        bg-white
                        border border-slate-200
                        text-slate-600
                        hover:bg-amber-500
                        hover:border-amber-500
                        hover:text-white
                        flex items-center justify-center
                        transition-all duration-300">

                        <i class="fa-solid fa-angle-left"></i>

                    </a>

                    @endif


                    {{-- Page Number --}}
                    @for ($page = 1; $page <= max($documents->lastPage(),1); $page++)

                        @if ($page == $documents->currentPage())

                        <span class="w-10 h-10
                            rounded-xl
                            bg-slate-900
                            text-white
                            font-bold
                            flex items-center justify-center">

                            {{ $page }}

                        </span>

                        @else

                        <a href="{{ $documents->url($page) }}" class="ajax-subject-page
                            w-10 h-10
                            rounded-xl
                            bg-white
                            border border-slate-200
                            text-slate-600
                            font-semibold
                            hover:bg-amber-500
                            hover:border-amber-500
                            hover:text-white
                            flex items-center justify-center
                            transition-all duration-300">

                            {{ $page }}

                        </a>

                        @endif

                        @endfor


                        {{-- Next --}}
                        @if ($documents->hasMorePages())

                        <a href="{{ $documents->nextPageUrl() }}" class="ajax-subject-page
                        w-10 h-10
                        rounded-xl
                        bg-white
                        border border-slate-200
                        text-slate-600
                        hover:bg-amber-500
                        hover:border-amber-500
                        hover:text-white
                        flex items-center justify-center
                        transition-all duration-300">

                            <i class="fa-solid fa-angle-right"></i>

                        </a>

                        @else

                        <span class="w-10 h-10
                        rounded-xl
                        bg-white
                        border border-slate-200
                        text-slate-300
                        flex items-center justify-center
                        cursor-not-allowed">

                            <i class="fa-solid fa-angle-right"></i>

                        </span>

                        @endif

                </div>

            </div>

        </div>

        @endif
    </div>
</div>
@endsection
@push('scripts')
<script>
function getForm() {
    return document.getElementById('filter-form');
}

async function load(url = null) {

    const params = new URLSearchParams(new FormData(getForm()));

    const requestUrl = url ??
        "{{ route('admin.documents.index') }}?" + params.toString();

    try {

        const response = await fetch(requestUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const html = await response.text();

        const doc = new DOMParser().parseFromString(html, 'text/html');

        const newArea = doc.getElementById('documents-area');

        if (newArea) {

            document.getElementById('documents-area').innerHTML =
                newArea.innerHTML;

            history.pushState({}, '', requestUrl);

        }

    } catch (e) {

        console.error(e);

    }

}

async function deleteDocument(id, btn) {

    if (!confirm("Bạn có chắc muốn xóa tài liệu này?")) {
        return;
    }

    try {

        const response = await fetch(`/admin/documents/${id}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "X-Requested-With": "XMLHttpRequest",
                "Accept": "application/json"
            }
        });

        const data = await response.json();

        if (!data.success) {

            alert("Không thể xóa tài liệu.");

            return;

        }

        // Load lại toàn bộ vùng danh sách
        await load();

    } catch (error) {

        console.error(error);

        alert("Có lỗi xảy ra.");

    }

}

async function toggleStatus(id, btn) {

    try {

        const response = await fetch(`/admin/documents/${id}/status`, {
            method: "PATCH",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            }
        });

        const data = await response.json();

        if (!data.success) {

            alert(data.message ?? "Không thể thay đổi trạng thái.");

            return;

        }

        // Load lại danh sách
        await load();

    } catch (error) {

        console.error(error);

        alert("Có lỗi xảy ra.");

    }

}

/*
|--------------------------------------------------------------------------
| EVENT DELEGATION
| Gắn 1 lần duy nhất vào document, không bị mất khi #documents-area
| bị thay innerHTML sau mỗi lần load().
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', function() {

    // Submit filter form (delegation vì form cũng bị thay thế sau mỗi load)
    document.addEventListener('submit', function(e) {

        if (e.target.id === 'filter-form') {

            e.preventDefault();

            load();

        }

    });

    // Reset filter
    document.addEventListener('click', function(e) {

        if (e.target.id === 'btnReset') {

            e.preventDefault();

            getForm().reset();

            load("{{ route('admin.documents.index') }}");

            return;

        }

        // Pagination (ajax-subject-page)
        const pageLink = e.target.closest('.ajax-subject-page');

        if (pageLink) {

            e.preventDefault();

            load(pageLink.href);

            return;

        }

        // Toggle action menu (nút ba chấm)
        const actionBtn = e.target.closest('.action-btn');

        if (actionBtn) {

            e.stopPropagation();

            const id = actionBtn.dataset.id;

            document.querySelectorAll('[id^="action-menu-"]').forEach(menu => {

                if (menu.id !== 'action-menu-' + id) {
                    menu.classList.add('hidden');
                }

            });

            document
                .getElementById('action-menu-' + id)
                .classList.toggle('hidden');

            return;

        }

        // Click ra ngoài -> đóng hết menu đang mở
        document.querySelectorAll('[id^="action-menu-"]').forEach(menu => {

            menu.classList.add('hidden');

        });

    });

});
</script>
@endpush