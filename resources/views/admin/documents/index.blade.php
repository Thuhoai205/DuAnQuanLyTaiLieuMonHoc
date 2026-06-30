@extends('layouts.admin')

@section('title', 'Quản lý tài liệu')
@section('page-title', 'Quản lý tài liệu')

@section('content')

<div id="documents-area" class="space-y-6">

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
            <a href="{{ route('admin.documents.trashed') }}" class="inline-flex items-center gap-2 h-11 px-4 rounded-md
                bg-white border border-red-200 text-red-500 text-sm font-black
                hover:bg-red-500 hover:text-white transition">

                <i class="fa-solid fa-trash-can-arrow-up"></i>

                @if($totalTrashedDocuments > 0)

                <span class="min-w-6 h-6 px-2 rounded-full
        bg-red-500 text-white text-xs font-black
        flex items-center justify-center">

                    {{ $totalTrashedDocuments }}

                </span>

                @endif

            </a>

            <!-- THÊM TÀI LIỆU -->
            <a href="{{ route('admin.documents.create') }}"
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
    <div id="documentTable" class="bg-white border rounded-md shadow-sm overflow-hidden">
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


                    <!-- HEADER -->
                    <div class="grid grid-cols-12 px-6 py-4 bg-slate-50 text-xs font-black uppercase text-slate-500">

                        <div class="col-span-1">STT</div>

                        <div class="col-span-4">Tài liệu</div>

                        <div class="col-span-2 "> Người tạo</div>

                        <div class="col-span-2 text-center"> Trạng thái</div>

                        <div class="col-span-1 text-center">Lượt tải</div>
                        <div class="col-span-2 text-right">Thao tác</div>


                    </div>

                    <div class="divide-y divide-slate-100">

                        @forelse($documents as $document)

                        @php
                        $ext = strtolower($document->currentVersion->file_extension ?? '');
                        $active = $document->is_active;
                        @endphp

                        <div id="document-{{ $document->document_id }}"
                            class="grid grid-cols-12 items-center px-6 py-4 hover:bg-slate-50 transition">

                            <!-- STT -->
                            <div class="col-span-1 ">

                                <span class="font-black text-slate-500">

                                    {{ ($documents->currentPage() - 1) * $documents->perPage() + $loop->iteration }}

                                </span>

                            </div>

                            <!-- TÀI LIỆU -->
                            <div class="col-span-4">

                                <div class="flex items-center gap-3">

                                    <!-- ICON -->
                                    <div class="w-9 h-9 rounded-md flex items-center justify-center shrink-0

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

                                    <!-- THÔNG TIN -->
                                    <div class="flex-1 min-w-0">

                                        <h4 class="font-black text-sm text-slate-700 truncate"
                                            title="{{ $document->title }}">

                                            {{ $document->title }}

                                        </h4>

                                        <p class="text-xs text-slate-500 truncate" title="{{ $document->description }}">

                                            {{ $document->description ?? 'Không có mô tả' }}

                                        </p>

                                        <div class="flex flex-wrap gap-2 mt-2">

                                            <span class="text-[10px] bg-slate-100 px-2 rounded">

                                                {{ $document->subject->subject_code ?? '-' }}

                                            </span>

                                            <span class="text-[10px] bg-slate-100 px-2 rounded">

                                                {{ $document->subject->subject_name ?? '-' }}

                                            </span>

                                            <span class="text-[10px] bg-slate-100 px-2 rounded">

                                                {{ $document->documentType->type_name ?? '-' }}

                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- NGƯỜI TẠO -->
                            <div class="col-span-2">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="w-9 h-9 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center">

                                        <i class="fa-solid fa-user text-sm"></i>

                                    </div>

                                    <span class="font-black text-sm text-slate-700 truncate">

                                        {{ $document->uploader->full_name ?? '-' }}

                                    </span>

                                </div>

                            </div>

                            <!-- TRẠNG THÁI -->
                            <div class="col-span-2 flex justify-center">

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

                            <!-- LƯỢT TẢI -->
                            <div class="col-span-1 text-center">

                                <span class="font-black text-slate-700">

                                    {{ number_format($document->download_count) }}

                                </span>

                            </div>

                            <!-- THAO TÁC -->
                            <div class="col-span-2">

                                <div class="flex justify-end gap-2">

                                    <a href="{{ route('admin.documents.show', [
                                        'document' => $document->document_id,
                                        'return' => urlencode(request()->fullUrl() . '#document-' . $document->document_id)
                                    ]) }}"
                                        class="w-9 h-9 rounded-md bg-sky-50 text-sky-600 hover:bg-sky-500 hover:text-white flex items-center justify-center transition">

                                        <i class="fa-solid fa-eye"></i>

                                    </a>

                                    <a href="{{ route('admin.documents.edit',$document->document_id) }}"
                                        class="w-9 h-9 rounded-md bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white flex items-center justify-center transition">

                                        <i class="fa-solid fa-pen"></i>

                                    </a>

                                    <button type="button" onclick="toggleStatus('{{ $document->document_id }}',this)"
                                        class="w-9 h-9 rounded-md flex items-center justify-center
                                        {{ $active ? 'bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white' : 'bg-yellow-50 text-yellow-600 hover:bg-yellow-500 hover:text-white' }}
                                        transition">

                                        <i class="fa-solid {{ $active ? 'fa-lock-open' : 'fa-lock' }}"></i>

                                    </button>

                                    <form action="{{ route('admin.documents.destroy', $document->document_id) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                            onclick="deleteDocument('{{ $document->document_id }}', this)" class="w-9 h-9 rounded-md
                                                bg-red-50 text-red-500
                                                hover:bg-red-500 hover:text-white
                                                flex items-center justify-center transition">

                                            <i class="fa-solid fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                        @empty

                        <div class="py-20 text-center text-slate-500">

                            <i class="fa-solid fa-file-circle-xmark text-5xl mb-4"></i>

                            <p>Chưa có tài liệu nào.</p>

                        </div>

                        @endforelse

                    </div>

                </table>

            </div>

        </div>
        {{-- PAGINATION --}}
        @if($documents->count())

        <div
            class="mt-5 bg-white border border-slate-200 rounded-md shadow-sm px-5 py-4 flex flex-col md:flex-row items-center justify-between gap-4">

            <p class="text-sm font-bold text-slate-500">

                Hiển thị
                <span class="text-sky-600">

                    {{ $documents->firstItem() ?? 0 }}

                </span>

                -

                <span class="text-sky-600">

                    {{ $documents->lastItem() ?? 0 }}

                </span>

                trong tổng

                <span class="text-sky-600">

                    {{ $documents->total() }}

                </span>

                tài liệu

            </p>

            <div class="flex items-center gap-2">

                {{-- Previous --}}
                @if($documents->onFirstPage())

                <span
                    class="w-10 h-10 rounded-md bg-slate-50 border border-slate-200 text-slate-300 flex items-center justify-center cursor-not-allowed">

                    <i class="fa-solid fa-angle-left"></i>

                </span>

                @else

                <a href="{{ $documents->previousPageUrl() }}"
                    class="ajax-document-page w-10 h-10 rounded-md bg-white border border-slate-200 text-slate-500 hover:bg-sky-500 hover:text-white hover:border-sky-500 flex items-center justify-center transition">

                    <i class="fa-solid fa-angle-left"></i>

                </a>

                @endif


                {{-- Number --}}
                @for($page = 1; $page <= max($documents->lastPage(),1); $page++)

                    @if($page == $documents->currentPage())

                    <span
                        class="w-10 h-10 rounded-md bg-sky-500 text-white flex items-center justify-center font-black">

                        {{ $page }}

                    </span>

                    @else

                    <a href="{{ $documents->url($page) }}"
                        class="ajax-document-page w-10 h-10 rounded-md bg-white border border-slate-200 text-slate-500 hover:bg-sky-500 hover:text-white hover:border-sky-500 flex items-center justify-center font-bold transition">

                        {{ $page }}

                    </a>

                    @endif

                    @endfor


                    {{-- Next --}}
                    @if($documents->hasMorePages())

                    <a href="{{ $documents->nextPageUrl() }}"
                        class="ajax-document-page w-10 h-10 rounded-md bg-white border border-slate-200 text-slate-500 hover:bg-sky-500 hover:text-white hover:border-sky-500 flex items-center justify-center transition">

                        <i class="fa-solid fa-angle-right"></i>

                    </a>

                    @else

                    <span
                        class="w-10 h-10 rounded-md bg-slate-50 border border-slate-200 text-slate-300 flex items-center justify-center cursor-not-allowed">

                        <i class="fa-solid fa-angle-right"></i>

                    </span>

                    @endif

            </div>

        </div>

        @endif
    </div>
</div>
@endsection
@push('scripts')
<script>
const form = document.getElementById('filter-form');

async function load(url = null) {

    const params = new URLSearchParams(new FormData(form));

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

document.addEventListener('DOMContentLoaded', function() {

    const resetBtn = document.getElementById('btnReset');

    form.addEventListener('submit', function(e) {

        e.preventDefault();

        load();

    });

    resetBtn.addEventListener('click', function(e) {

        e.preventDefault();

        form.reset();

        load("{{ route('admin.documents.index') }}");

    });

});

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
</script>
@endpush