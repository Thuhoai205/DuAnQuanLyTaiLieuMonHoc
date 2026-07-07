@extends('layouts.admin')

@section('title', 'Quản lý loại tài liệu')
@section('page-title', 'Quản lý loại tài liệu')

@section('content')

@php
$totalTypes = $totalTypes ?? $documentTypes->total();
$totalTrashedDocumentTypes = $totalTrashedDocumentTypes ?? 0;

$colorMap = [
'cyan' => 'bg-cyan-50 text-cyan-600',
'blue' => 'bg-blue-50 text-blue-600',
'orange' => 'bg-orange-50 text-orange-600',
'red' => 'bg-red-50 text-red-600',
'green' => 'bg-green-50 text-green-600',
'purple' => 'bg-purple-50 text-purple-600',
'emerald' => 'bg-emerald-50 text-emerald-600',
];
$totalTrashedDocumentTypes = $totalTrashedDocumentTypes ?? 0;

@endphp
<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h2 class="text-2xl font-black text-slate-800">

                    Danh sách loại tài liệu

                </h2>

                <p class="mt-2 text-sm text-slate-500">

                    Quản lý các loại tài liệu được sử dụng trong hệ thống.

                </p>

            </div>

            <div class="flex items-center gap-3">

                <!-- THÙNG RÁC -->
                <a href="{{ route('admin.document-types.trashed') }}" class="inline-flex
                    items-center
                    gap-2
                    h-11
                    px-5
                    rounded-xl
                    border
                    border-red-100
                    bg-white
                    text-red-600
                    text-sm
                    font-semibold
                    hover:bg-red-50
                    transition-all duration-300">

                    <i class="fa-solid fa-trash-can"></i>



                    @if($totalTrashedDocumentTypes > 0)

                    <span class="min-w-6
                        h-6
                        px-2
                        rounded-full
                        bg-red-600
                        text-white
                        text-xs
                        font-bold
                        flex
                        items-center
                        justify-center">

                        {{ $totalTrashedDocumentTypes }}

                    </span>

                    @endif

                </a>

                <!-- THÊM -->
                <a href="{{ route('admin.document-types.create') }}" class="inline-flex
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

                    Thêm loại tài liệu

                </a>

            </div>

        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">

        <form id="filter-form" class="grid grid-cols-12 gap-4">

            <!-- SEARCH -->
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm loại tài liệu..."
                class="col-span-7
                h-11
                px-4
                rounded-xl
                border
                border-slate-200
                bg-slate-50
                text-sm
                font-medium
                text-slate-700
                placeholder:text-slate-400
                outline-none
                transition-all duration-300
                focus:bg-white
                focus:border-amber-500
                focus:ring-4
                focus:ring-amber-100">

            <!-- STATUS -->
            <select name="status" class="col-span-3
                h-11
                px-4
                rounded-xl
                border
                border-slate-200
                bg-slate-50
                text-sm
                font-medium
                text-slate-700
                outline-none
                transition-all duration-300
                focus:bg-white
                focus:border-amber-500
                focus:ring-4
                focus:ring-amber-100">

                <option value="">Tất cả trạng thái</option>

                <option value="1" @selected(request('status')=='1' )>

                    Hoạt động

                </option>

                <option value="0" @selected(request('status')=='0' )>

                    Đã khóa

                </option>

            </select>

            <!-- BUTTON -->
            <div class="col-span-2 flex gap-2">

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

                <button type="button" id="btnReset"
                    class="flex-1 inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-700 text-sm font-semibold hover:bg-slate-50">

                    Reset

                </button>

            </div>

        </form>

    </div>
    <!-- TABLE -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-visible">

        <!-- CARD HEADER -->
        <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">

            <div>

                <h2 class="text-base font-black text-slate-800">

                    Danh sách loại tài liệu

                </h2>

                <p class="mt-1 text-sm text-slate-500">

                    Danh sách các loại tài liệu hiện có trong hệ thống.

                </p>

            </div>

            <span class="inline-flex
                items-center
                gap-2
                rounded-full
                border
                border-amber-100
                bg-amber-50
                px-4
                py-2
                text-sm
                font-bold
                text-amber-600">

                <i class="fa-solid fa-layer-group"></i>

                {{ $totalTypes }} loại

            </span>

        </div>

        <!-- TABLE HEADER -->
        <div class="grid
            grid-cols-12
            items-center
            px-6
            py-4
            bg-slate-50/80
            border-b
            border-slate-200
            text-[13px]
            font-black
            uppercase
            tracking-wide
            text-slate-600">

            <!-- STT -->
            <div class="col-span-1">

                STT

            </div>

            <!-- NAME -->
            <div class="col-span-4">

                Loại tài liệu

            </div>

            <!-- COUNT -->
            <div class="col-span-2">

                Số tài liệu

            </div>

            <!-- STATUS -->
            <div class="col-span-2 text-center">

                Trạng thái

            </div>

            <!-- ACTION -->
            <div class="col-span-3 text-center">

                Thao tác

            </div>

        </div>

        <!-- TABLE BODY -->
        <div id="table-body" class="divide-y divide-slate-100">

            @forelse($documentTypes as $type)

            @php
            $active = $type->is_active;
            $colorClass = $colorMap[$type->color] ?? $colorMap['cyan'];
            @endphp
            <div id="document-type-{{ $type->document_type_id }}" class="grid
                grid-cols-12
                items-center
                px-6
                py-5
                hover:bg-amber-50/40
                transition-all
                duration-300">

                <!-- STT -->
                <div class="col-span-1">

                    <span class="font-black text-slate-500">

                        {{ ($documentTypes->currentPage()-1) * $documentTypes->perPage() + $loop->iteration }}

                    </span>

                </div>

                <!-- LOẠI TÀI LIỆU -->
                <div class="col-span-4">

                    <div class="flex items-center gap-4">

                        <!-- ICON -->
                        <div class="w-11
                            h-11
                            rounded-xl
                            flex
                            items-center
                            justify-center
                            shrink-0
                            {{ $colorClass }}">

                            <i class="{{ $type->icon }} text-base"></i>

                        </div>

                        <!-- INFO -->
                        <div class="min-w-0">

                            <h4 class="text-sm
                                font-black
                                text-slate-800
                                truncate">

                                {{ $type->type_name }}

                            </h4>

                            @if($type->description)

                            <p class="mt-1
                                text-xs
                                text-slate-500
                                truncate">

                                {{ $type->description }}

                            </p>

                            @else

                            <p class="mt-1
                                text-xs
                                italic
                                text-slate-400">

                                Không có mô tả

                            </p>

                            @endif

                        </div>

                    </div>

                </div>

                <!-- SỐ TÀI LIỆU -->
                <div class="col-span-2">

                    <span class="inline-flex
        items-center
        rounded-full
        bg-slate-100
        px-3
        py-1
        text-xs
        font-bold
        text-slate-700">

                        {{ number_format($type->documents_count) }} tài liệu

                    </span>

                </div>

                <!-- TRẠNG THÁI -->
                <div class="col-span-2 flex justify-center">

                    @if($active)

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

                <!-- ACTION -->
                <div class="col-span-3 flex justify-center">
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
                            transition-all duration-300" data-id="{{ $type->document_type_id }}">

                            <i class="fa-solid fa-ellipsis-vertical"></i>

                        </button>

                        <!-- DROPDOWN -->
                        <div id="action-menu-{{ $type->document_type_id }}" class="hidden
                            absolute
                            right-0
                            top-12
                            w-56
                            rounded-xl
                            bg-white
                            border
                            border-slate-200
                            shadow-xl
                            overflow-hidden
                            z-[9999]">

                            <!-- VIEW -->
                            <a href="{{ route('admin.document-types.show',[
                                'document_type'=>$type->document_type_id,
                                'return'=>urlencode(request()->fullUrl().'#document-type-'.$type->document_type_id)
                            ]) }}" class="flex
                                items-center
                                gap-3
                                px-4
                                py-3
                                text-sm
                                font-medium
                                text-slate-700
                                hover:bg-slate-50">

                                <i class="fa-solid fa-eye w-5 text-slate-500"></i>

                                Xem chi tiết

                            </a>

                            <!-- EDIT -->
                            <a href="{{ route('admin.document-types.edit',$type->document_type_id) }}" class="flex
                                items-center
                                gap-3
                                px-4
                                py-3
                                text-sm
                                font-medium
                                text-amber-600
                                hover:bg-amber-50">

                                <i class="fa-solid fa-pen w-5"></i>

                                Chỉnh sửa

                            </a>

                            <!-- LOCK -->
                            <button type="button" onclick="toggleStatus('{{ $type->document_type_id }}',this)" class="w-full
                                flex
                                items-center
                                gap-3
                                px-4
                                py-3
                                text-sm
                                font-medium
                                {{ $active
                                    ? 'text-emerald-600 hover:bg-emerald-50'
                                    : 'text-yellow-600 hover:bg-yellow-50' }}">

                                <i class="fa-solid {{ $active ? 'fa-lock-open' : 'fa-lock' }} w-5"></i>

                                {{ $active ? 'Khóa loại tài liệu' : 'Mở khóa loại tài liệu' }}

                            </button>

                            <!-- DELETE -->
                            <form action="{{ route('admin.document-types.destroy',$type->document_type_id) }}"
                                method="POST" class="delete-type-form">

                                @csrf
                                @method('DELETE')

                                <button type="button" onclick="deleteType('{{ $type->document_type_id }}')" class="w-full
                                    flex
                                    items-center
                                    gap-3
                                    px-4
                                    py-3
                                    text-sm
                                    font-medium
                                    text-red-600
                                    hover:bg-red-50">

                                    <i class="fa-solid fa-trash w-5"></i>

                                    Xóa

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

            @empty

            <!-- EMPTY -->
            <div class="py-20">

                <div class="flex flex-col items-center">

                    <div class="w-20
                        h-20
                        rounded-full
                        bg-amber-50
                        flex
                        items-center
                        justify-center">

                        <i class="fa-solid fa-folder-open text-3xl text-amber-400"></i>

                    </div>

                    <h3 class="mt-5 text-lg font-black text-slate-800">

                        Chưa có loại tài liệu

                    </h3>

                    <p class="mt-2 text-sm font-medium text-slate-500">

                        Hãy tạo loại tài liệu đầu tiên cho hệ thống.

                    </p>

                    <a href="{{ route('admin.document-types.create') }}" class="mt-6
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
                        transition-all duration-300">

                        <i class="fa-solid fa-plus"></i>

                        Thêm loại tài liệu

                    </a>

                </div>

            </div>

            @endforelse

        </div>

        <!-- PAGINATION -->

        {{-- PAGINATION --}}
        {{-- PAGINATION --}}
        @if($documentTypes->count())

        <div class="border-t border-slate-200 bg-slate-50 px-6 py-5">

            <div class="flex flex-col md:flex-row items-center justify-between gap-4">

                <!-- INFO -->
                <p class="text-sm font-medium text-slate-500">

                    Hiển thị

                    <span class="font-bold text-amber-500">
                        {{ $documentTypes->firstItem() ?? 0 }}
                    </span>

                    -

                    <span class="font-bold text-amber-500">
                        {{ $documentTypes->lastItem() ?? 0 }}
                    </span>

                    trong tổng

                    <span class="font-bold text-amber-500">
                        {{ $documentTypes->total() }}
                    </span>

                    loại tài liệu

                </p>

                <!-- PAGINATION -->
                <div class="flex items-center gap-2">

                    {{-- Previous --}}
                    @if ($documentTypes->onFirstPage())

                    <span class="w-10 h-10 rounded-xl
                bg-white
                border border-slate-200
                text-slate-300
                flex items-center justify-center
                cursor-not-allowed">

                        <i class="fa-solid fa-angle-left"></i>

                    </span>

                    @else

                    <a href="{{ $documentTypes->previousPageUrl() }}" class="ajax-document-type-page
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
                    @for ($page = 1; $page <= max($documentTypes->lastPage(),1); $page++)

                        @if ($page == $documentTypes->currentPage())

                        <span class="w-10 h-10
                    rounded-xl
                    bg-amber-500
                    text-white
                    font-bold
                    flex items-center justify-center">

                            {{ $page }}

                        </span>

                        @else

                        <a href="{{ $documentTypes->url($page) }}" class="ajax-document-type-page
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
                        @if ($documentTypes->hasMorePages())

                        <a href="{{ $documentTypes->nextPageUrl() }}" class="ajax-document-type-page
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
// =========================
// LOAD TABLE AJAX
// =========================
async function load(url) {

    const res = await fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    });

    const html = await res.text();

    const doc = new DOMParser().parseFromString(html, 'text/html');

    // body
    const newBody = doc.getElementById('table-body');
    if (newBody) {
        document.getElementById('table-body').innerHTML = newBody.innerHTML;
    }

    // pagination
    const newPagination = doc.querySelector('#pagination-wrapper');
    const oldPagination = document.querySelector('#pagination-wrapper');

    if (newPagination && oldPagination) {
        oldPagination.innerHTML = newPagination.innerHTML;
    }

    initActionMenu();
    initPagination();

    history.pushState({}, '', url);
}

// =========================
// FILTER
// =========================
document.getElementById('filter-form')?.addEventListener('submit', function(e) {

    e.preventDefault();

    const url = window.location.pathname + '?' +
        new URLSearchParams(new FormData(this));

    load(url);

});

// =========================
// RESET
// =========================
document.getElementById('btnReset')?.addEventListener('click', function() {

    document.getElementById('filter-form').reset();

    load(window.location.pathname);

});

// =========================
// PAGINATION AJAX
// =========================
function initPagination() {

    document.querySelectorAll('.pagination a').forEach(link => {

        link.onclick = function(e) {

            e.preventDefault();

            load(this.href);

        }

    });

}

// =========================
// ACTION MENU
// =========================
function initActionMenu() {

    document.querySelectorAll('.action-btn').forEach(btn => {

        btn.onclick = function(e) {

            e.stopPropagation();

            const id = this.dataset.id;

            document.querySelectorAll('[id^="action-menu-"]').forEach(menu => {

                if (menu.id !== 'action-menu-' + id) {

                    menu.classList.add('hidden');

                }

            });

            document
                .getElementById('action-menu-' + id)
                ?.classList.toggle('hidden');

        };

    });

}

// click ngoài menu
document.addEventListener('click', function() {

    document.querySelectorAll('[id^="action-menu-"]').forEach(menu => {

        menu.classList.add('hidden');

    });

});

// =========================
// TOGGLE STATUS
// =========================
async function toggleStatus(id) {

    const res = await fetch(`/admin/document-types/${id}/status`, {

        method: 'PATCH',

        headers: {

            'X-CSRF-TOKEN': '{{ csrf_token() }}',

            'Accept': 'application/json'

        }

    });

    const data = await res.json();

    if (!data.success) return;

    load(location.pathname + location.search);

}

// =========================
// DELETE
// =========================
async function deleteType(id) {

    if (!confirm('Bạn có chắc muốn xóa loại tài liệu này?')) {

        return;

    }

    const res = await fetch(`/admin/document-types/${id}`, {

        method: 'DELETE',

        headers: {

            'X-CSRF-TOKEN': '{{ csrf_token() }}',

            'Accept': 'application/json',

            'X-Requested-With': 'XMLHttpRequest'

        }

    });

    const data = await res.json();
    if (data.type === 'locked') {

        alert(data.message);

        await load(location.pathname + location.search);

        return;

    }

    if (data.success) {

        load(location.pathname + location.search);

    }

}

// =========================
// BACK BUTTON
// =========================
window.addEventListener('popstate', function() {

    load(location.href);

});

// =========================
// INIT
// =========================
document.addEventListener('DOMContentLoaded', function() {

    initActionMenu();

    initPagination();

});
</script>
@endpush