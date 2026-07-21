@extends('layouts.admin')

@section('title', 'Quản lý bình luận')
@section('page-title', 'Quản lý bình luận')

@section('content')

@php
$totalComments = $totalComments ?? $comments->total();
$activeComments = $activeComments ?? 0;
$hiddenComments = $hiddenComments ?? 0;
@endphp

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h2 class="text-2xl font-black text-slate-800">

                    Danh sách bình luận

                </h2>

                <p class="mt-2 text-sm text-slate-500">

                    Quản lý các bình luận của người dùng trên hệ thống.

                </p>

            </div>

            <div class="flex items-center gap-3">

                <!-- ĐANG HOẠT ĐỘNG -->
                <span class="inline-flex
                    items-center
                    gap-2
                    h-11
                    px-5
                    rounded-xl
                    border
                    border-emerald-100
                    bg-emerald-50
                    text-emerald-600
                    text-sm
                    font-bold">

                    <i class="fa-solid fa-circle-check"></i>

                    {{ number_format($activeComments) }} hiển thị

                </span>

                <!-- ĐÃ ẨN -->
                <span class="inline-flex
                    items-center
                    gap-2
                    h-11
                    px-5
                    rounded-xl
                    border
                    border-red-100
                    bg-red-50
                    text-red-600
                    text-sm
                    font-bold">

                    <i class="fa-solid fa-eye-slash"></i>

                    {{ number_format($hiddenComments) }} đã ẩn

                </span>

            </div>

        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">

        <form id="filter-form" class="grid grid-cols-12 gap-4">

            <!-- SEARCH -->
            <input type="text" name="keyword" value="{{ request('keyword') }}"
                placeholder="Tìm theo nội dung, người dùng, tài liệu..." class="col-span-7
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

                    Hiển thị

                </option>

                <option value="0" @selected(request('status')=='0' )>

                    Đã ẩn

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

                    Danh sách bình luận

                </h2>

                <p class="mt-1 text-sm text-slate-500">

                    Toàn bộ bình luận hiện có trong hệ thống.

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

                <i class="fa-solid fa-comments"></i>

                {{ $totalComments }} bình luận

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

            <!-- USER -->
            <div class="col-span-2">

                Người bình luận

            </div>

            <!-- CONTENT -->
            <div class="col-span-5">

                Nội dung / Tài liệu

            </div>

            <!-- STATUS -->
            <div class="col-span-2 text-center">

                Trạng thái

            </div>

            <!-- ACTION -->
            <div class="col-span-2 text-center">

                Thao tác

            </div>

        </div>

        <!-- TABLE BODY -->
        <div id="table-body" class="divide-y divide-slate-100">

            @forelse($comments as $comment)

            @php
            $active = $comment->is_active;
            @endphp
            <div id="comment-{{ $comment->comment_id }}" class="grid
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

                        {{ ($comments->currentPage()-1) * $comments->perPage() + $loop->iteration }}

                    </span>

                </div>

                <!-- NGƯỜI BÌNH LUẬN -->
                <div class="col-span-2">

                    <div class="flex items-center gap-3">

                        <!-- AVATAR -->
                        <div class="w-10
                            h-10
                            rounded-xl
                            bg-amber-50
                            text-amber-600
                            flex
                            items-center
                            justify-center
                            shrink-0
                            font-black
                            uppercase">

                            {{ mb_substr($comment->user->full_name ?? '?', 0, 1) }}

                        </div>

                        <!-- INFO -->
                        <div class="min-w-0">

                            <h4 class="text-sm
                                font-black
                                text-slate-800
                                truncate">

                                {{ $comment->user->full_name ?? 'Người dùng đã xóa' }}

                            </h4>

                            <p class="mt-1
                                text-xs
                                text-slate-500
                                truncate">

                                {{ $comment->created_at?->format('d/m/Y H:i') }}

                            </p>

                        </div>

                    </div>

                </div>

                <!-- NỘI DUNG / TÀI LIỆU -->
                <div class="col-span-5 min-w-0">

                    <p class="text-sm font-semibold text-slate-700 line-clamp-2">

                        {{ $comment->content }}

                    </p>

                    @if($comment->document)

                    <p class="mt-1 text-xs text-slate-500 truncate">

                        <i class="fa-solid fa-file-lines mr-1 text-slate-400"></i>

                        {{ $comment->document->title }}

                    </p>

                    @endif

                    @if($comment->replies_count ?? $comment->replies?->count())

                    <span class="mt-2 inline-flex
                        items-center
                        gap-1
                        rounded-full
                        bg-slate-100
                        px-2.5
                        py-0.5
                        text-[11px]
                        font-bold
                        text-slate-600">

                        <i class="fa-solid fa-reply"></i>

                        {{ $comment->replies_count ?? $comment->replies->count() }} phản hồi

                    </span>

                    @endif

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

                        Hiển thị

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

                        Đã ẩn

                    </span>

                    @endif

                </div>

                <!-- ACTION -->
                <div class="col-span-2 flex justify-center">
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
                            transition-all duration-300" data-id="{{ $comment->comment_id }}">

                            <i class="fa-solid fa-ellipsis-vertical"></i>

                        </button>

                        <!-- DROPDOWN -->
                        <div id="action-menu-{{ $comment->comment_id }}" class="hidden
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
                            <a href="{{ route('admin.comments.show',[
                                'comment'=>$comment->comment_id,
                                'return'=>urlencode(request()->fullUrl().'#comment-'.$comment->comment_id)
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

                            <!-- LOCK -->
                            <button type="button" onclick="toggleStatus('{{ $comment->comment_id }}',this)" class="w-full
                                flex
                                items-center
                                gap-3
                                px-4
                                py-3
                                text-sm
                                font-medium
                                {{ $active
                                    ? 'text-red-600 hover:bg-red-50'
                                    : 'text-emerald-600 hover:bg-emerald-50' }}">

                                <i class="fa-solid {{ $active ? 'fa-eye-slash' : 'fa-eye' }} w-5"></i>

                                {{ $active ? 'Ẩn bình luận' : 'Hiển thị bình luận' }}

                            </button>

                            <!-- DELETE -->
                            <button type="button" onclick="deleteComment('{{ $comment->comment_id }}')" class="w-full
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

                        <i class="fa-solid fa-comment-slash text-3xl text-amber-400"></i>

                    </div>

                    <h3 class="mt-5 text-lg font-black text-slate-800">

                        Chưa có bình luận nào

                    </h3>

                    <p class="mt-2 text-sm font-medium text-slate-500">

                        Bình luận từ người dùng sẽ hiển thị tại đây.

                    </p>

                </div>

            </div>

            @endforelse

        </div>

        <!-- PAGINATION -->
        @if($comments->count())

        <div id="pagination-wrapper" class="border-t border-slate-200 bg-slate-50 px-6 py-5">

            <div class="flex flex-col md:flex-row items-center justify-between gap-4">

                <!-- INFO -->
                <p class="text-sm font-medium text-slate-500">

                    Hiển thị

                    <span class="font-bold text-amber-500">
                        {{ $comments->firstItem() ?? 0 }}
                    </span>

                    -

                    <span class="font-bold text-amber-500">
                        {{ $comments->lastItem() ?? 0 }}
                    </span>

                    trong tổng

                    <span class="font-bold text-amber-500">
                        {{ $comments->total() }}
                    </span>

                    bình luận

                </p>

                <!-- PAGINATION -->
                <div class="pagination flex items-center gap-2">

                    {{-- Previous --}}
                    @if ($comments->onFirstPage())

                    <span class="w-10 h-10 rounded-xl
                        bg-white
                        border border-slate-200
                        text-slate-300
                        flex items-center justify-center
                        cursor-not-allowed">

                        <i class="fa-solid fa-angle-left"></i>

                    </span>

                    @else

                    <a href="{{ $comments->previousPageUrl() }}" class="w-10 h-10
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
                    @for ($page = 1; $page <= max($comments->lastPage(),1); $page++)

                        @if ($page == $comments->currentPage())

                        <span class="w-10 h-10
                            rounded-xl
                            bg-amber-500
                            text-white
                            font-bold
                            flex items-center justify-center">

                            {{ $page }}

                        </span>

                        @else

                        <a href="{{ $comments->url($page) }}" class="w-10 h-10
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
                        @if ($comments->hasMorePages())

                        <a href="{{ $comments->nextPageUrl() }}" class="w-10 h-10
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
    } else if (oldPagination && !newPagination) {
        oldPagination.remove();
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

    document.querySelectorAll('#pagination-wrapper a').forEach(link => {

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

    const res = await fetch(`/admin/comments/${id}/status`, {

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
async function deleteComment(id) {

    if (!confirm('Bạn có chắc muốn xóa bình luận này?')) {

        return;

    }

    const res = await fetch(`/admin/comments/${id}`, {

        method: 'DELETE',

        headers: {

            'X-CSRF-TOKEN': '{{ csrf_token() }}',

            'Accept': 'application/json',

            'X-Requested-With': 'XMLHttpRequest'

        }

    });

    const data = await res.json();

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