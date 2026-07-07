@extends('layouts.admin')

@section('title', 'Quản lý khoa')
@section('page-title', 'Quản lý khoa')

@section('content')
<div class="space-y-8">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <!-- LEFT -->
            <div>

                <h2 class="text-2xl font-extrabold text-slate-900">

                    Danh sách khoa

                </h2>

                <p class="mt-2 text-sm font-medium text-slate-500">

                    Quản lý các khoa trong hệ thống quản lý tài liệu.

                </p>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-3">

                <!-- TRASH -->
                <a href="{{ route('admin.faculties.trashed') }}" class="inline-flex items-center gap-2
                    h-11
                    px-4
                    rounded-xl
                    border border-red-200
                    bg-white
                    text-red-600
                    text-sm
                    font-semibold
                    transition-all duration-300
                    hover:bg-red-500
                    hover:text-white">

                    <i class="fa-solid fa-trash-can-arrow-up"></i>

                    @if($totalTrashedFaculties > 0)

                    <span class="min-w-6 h-6 px-2
                        rounded-full
                        bg-red-500
                        text-white
                        text-[11px]
                        font-bold
                        flex items-center justify-center">

                        {{ $totalTrashedFaculties }}

                    </span>

                    @endif

                </a>

                <!-- CREATE -->
                <a href="{{ route('admin.faculties.create') }}" class="inline-flex items-center gap-2
                    h-11
                    px-5
                    rounded-xl
                    bg-amber-500
                    text-white
                    text-sm
                    font-semibold
                    shadow-sm
                    transition-all duration-300
                    hover:bg-amber-600">

                    <i class="fa-solid fa-plus"></i>

                    <span>Thêm khoa</span>

                </a>

            </div>

        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

        <form id="faculties-filter-form" method="GET" action="{{ route('admin.faculties.index') }}"
            class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

            <!-- SEARCH -->
            <div class="md:col-span-8 relative">

                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Tìm theo mã khoa hoặc tên khoa..." class="w-full
                    h-12
                    pl-11
                    pr-4
                    rounded-xl
                    border border-slate-300
                    bg-white
                    text-sm
                    font-medium
                    text-slate-700
                    placeholder:text-slate-400
                    outline-none
                    transition-all
                    focus:border-amber-400
                    focus:ring-4
                    focus:ring-amber-100">

            </div>

            <!-- STATUS -->
            <div class="md:col-span-2">

                <select name="status" class="w-full
                    h-12
                    px-4
                    rounded-xl
                    border border-slate-300
                    bg-white
                    text-sm
                    font-medium
                    text-slate-700
                    outline-none
                    transition-all
                    focus:border-amber-400
                    focus:ring-4
                    focus:ring-amber-100">

                    <option value="">Trạng thái</option>

                    <option value="1" @selected(request('status')=='1' )>

                        Hoạt động

                    </option>

                    <option value="0" @selected(request('status')=='0' )>

                        Đã khóa

                    </option>

                </select>

            </div>

            <!-- FILTER BUTTON -->
            <div class="md:col-span-1">

                <button type="submit" class="w-full
                    h-12
                    rounded-xl
                    bg-amber-500
                    text-white
                    text-sm
                    font-semibold
                    transition-all duration-300
                    hover:bg-amber-600">

                    Lọc

                </button>

            </div>

            <!-- RESET -->
            <div class="md:col-span-1">

                <a href="{{ route('admin.faculties.index') }}" class="h-12
                    flex
                    items-center
                    justify-center
                    rounded-xl
                    border border-slate-300
                    bg-white
                    text-slate-700
                    text-sm
                    font-semibold
                    transition-all duration-300
                    hover:bg-slate-900
                    hover:text-white">

                    Reset

                </a>

            </div>

        </form>

    </div>
    <!-- CARD -->
    <div id="faculties-area" class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-visible">
        <!-- CARD HEADER -->
        <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">

            <div>

                <h2 class="text-lg font-bold text-slate-900">

                    Danh sách khoa

                </h2>

                <p class="mt-1 text-sm text-slate-500">

                    Thông tin các khoa trong hệ thống.

                </p>

            </div>

            <span class="inline-flex items-center
                px-4 py-2
                rounded-full
                bg-amber-50
                border border-amber-200
                text-amber-700
                text-sm
                font-semibold">

                {{ $faculties->total() ?? 0 }} khoa

            </span>

        </div>

        <!-- TABLE -->
        <div class="divide-y divide-slate-200">

            <!-- TABLE HEADER -->
            <div class="grid grid-cols-12
                px-6 py-4
                bg-slate-50
                text-xs
                uppercase
                tracking-wide
                font-semibold
                text-slate-500">

                <div class="col-span-1">

                    STT

                </div>

                <div class="col-span-5">

                    Khoa

                </div>

                <div class="col-span-2 text-center">

                    Môn học

                </div>

                <div class="col-span-2 text-center">

                    Trạng thái

                </div>

                <div class="col-span-2 text-center">

                    Hành động

                </div>

            </div>

            @forelse($faculties as $faculty)

            <div id="faculty-{{ $faculty->faculty_id }}" class="grid grid-cols-12
                            items-center
                            px-6 py-6
                            hover:bg-slate-50
                            transition-all duration-300">

                <!-- STT -->
                <div class="col-span-1">

                    <span class="text-sm font-semibold text-slate-600">

                        {{ ($faculties->currentPage()-1) * $faculties->perPage() + $loop->iteration }}

                    </span>

                </div>

                <!-- FACULTY -->
                <div class="col-span-5">

                    <div class="flex items-center gap-4">

                        <div class="w-11 h-11
                            rounded-xl
                            bg-amber-100
                            text-amber-600
                            flex items-center justify-center">

                            <i class="fa-solid fa-building-columns text-lg"></i>

                        </div>

                        <div>

                            <h4 class="text-sm font-bold text-slate-800">

                                {{ $faculty->faculty_name }}

                            </h4>

                            <span class="inline-flex items-center
                                mt-2
                                px-3 py-1
                                rounded-full
                                bg-slate-100
                                text-slate-600
                                text-xs
                                font-semibold">

                                {{ $faculty->faculty_code }}

                            </span>

                        </div>

                    </div>

                </div>

                <!-- SUBJECT COUNT -->
                <div class="col-span-2 text-center">

                    <span class="text-base font-bold text-slate-700">

                        {{ $faculty->subjects_count }}

                    </span>

                </div>

                <!-- STATUS -->
                <div class="col-span-2 text-center">

                    <span id="status-{{ $faculty->faculty_id }}" class="inline-flex items-center gap-2
                        px-3 py-2
                        rounded-full
                        text-xs
                        font-semibold

                        {{ $faculty->is_active
                            ? 'bg-emerald-100 text-emerald-700'
                            : 'bg-red-100 text-red-600' }}">

                        <span class="w-2 h-2 rounded-full
                            {{ $faculty->is_active ? 'bg-emerald-500' : 'bg-red-500' }}">
                        </span>

                        {{ $faculty->is_active ? 'Hoạt động' : 'Đã khóa' }}

                    </span>

                </div>
                <!-- ACTION -->
                <div class="col-span-2">

                    <div class="relative flex justify-center">

                        <!-- BUTTON -->
                        <button type="button" class="action-btn
                            w-10 h-10
                            rounded-xl
                            border border-slate-200
                            bg-white
                            text-slate-500
                            hover:bg-amber-50
                            hover:text-amber-500
                            transition-all duration-300" data-id="{{ $faculty->faculty_id }}">

                            <i class="fa-solid fa-ellipsis-vertical"></i>

                        </button>
                        <!-- MENU -->
                        <div id="action-menu-{{ $faculty->faculty_id }}"
                            class="hidden absolute right-0 mt-2 w-48 rounded-xl bg-white border border-slate-200 shadow-xl z-[9999]">
                            <!-- VIEW -->
                            <a href="{{ route('admin.faculties.show',[
                                    'faculty'=>$faculty->faculty_id,
                                    'return'=>urlencode(request()->fullUrl().'#faculty-'.$faculty->faculty_id)
                                ]) }}" class="flex items-center gap-3
                                px-4 py-3
                                text-sm font-medium
                                text-slate-700
                                hover:bg-slate-50">

                                <i class="fa-solid fa-eye w-5 text-slate-500"></i>

                                Xem chi tiết

                            </a>

                            <!-- EDIT -->
                            <a href="{{ route('admin.faculties.edit',$faculty->faculty_id) }}" class="flex items-center gap-3
                                px-4 py-3
                                text-sm font-medium
                                text-amber-600
                                hover:bg-amber-50">

                                <i class="fa-solid fa-pen w-5"></i>

                                Chỉnh sửa

                            </a>

                            <!-- STATUS -->
                            <button type="button" onclick="toggleStatus('{{ $faculty->faculty_id }}', this)" class="w-full
                                flex items-center gap-3
                                px-4 py-3
                                text-sm font-medium
                                {{ $faculty->is_active
                                    ? 'text-emerald-600 hover:bg-emerald-50'
                                    : 'text-yellow-600 hover:bg-yellow-50' }}">

                                <i class="fa-solid {{ $faculty->is_active ? 'fa-lock-open' : 'fa-lock' }} w-5"></i>

                                {{ $faculty->is_active ? 'Khóa khoa' : 'Mở khóa' }}

                            </button>

                            <!-- DELETE -->
                            <form action="{{ route('admin.faculties.destroy',$faculty->faculty_id) }}" method="POST"
                                class="delete-faculty-form">

                                @csrf
                                @method('DELETE')

                                <button type="button" onclick="deleteFaculty('{{ $faculty->faculty_id }}', this)" class="w-full
                                    flex items-center gap-3
                                    px-4 py-3
                                    text-sm font-medium
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

            <div class="py-20 text-center">

                <div class="mx-auto
                    w-16 h-16
                    rounded-2xl
                    bg-slate-100
                    text-slate-400
                    flex items-center justify-center">

                    <i class="fa-solid fa-building-columns text-2xl"></i>

                </div>

                <h3 class="mt-5 text-lg font-bold text-slate-700">

                    Không có khoa nào

                </h3>

                <p class="mt-2 text-sm text-slate-500">

                    Hiện chưa có dữ liệu khoa trong hệ thống.

                </p>

            </div>

            @endforelse

        </div>
        <!-- PAGINATION -->
        <div class="px-6 py-5
            bg-white
            border-t border-slate-200
            flex flex-col md:flex-row
            items-center
            justify-between
            gap-4">

            <!-- INFO -->
            <p class="text-sm font-medium text-slate-500">

                Hiển thị

                <span class="font-semibold text-slate-800">

                    {{ $faculties->firstItem() ?? 0 }}

                </span>

                -

                <span class="font-semibold text-slate-800">

                    {{ $faculties->lastItem() ?? 0 }}

                </span>

                trong tổng

                <span class="font-semibold text-amber-600">

                    {{ $faculties->total() }}

                </span>

                khoa

            </p>

            <!-- PAGE -->
            <div class="flex items-center gap-2">

                {{-- PREVIOUS --}}
                @if ($faculties->onFirstPage())

                <span class="w-10 h-10
                    rounded-xl
                    border border-slate-200
                    bg-slate-100
                    text-slate-300
                    flex items-center justify-center
                    cursor-not-allowed">

                    <i class="fa-solid fa-angle-left"></i>

                </span>

                @else

                <a href="{{ $faculties->previousPageUrl() }}" class="ajax-faculty-page
                    w-10 h-10
                    rounded-xl
                    border border-slate-200
                    bg-white
                    text-slate-600
                    flex items-center justify-center
                    transition-all duration-300
                    hover:bg-amber-500
                    hover:border-amber-500
                    hover:text-white">

                    <i class="fa-solid fa-angle-left"></i>

                </a>

                @endif

                {{-- PAGE NUMBER --}}
                @for ($page = 1; $page <= max($faculties->lastPage(),1); $page++)

                    @if ($page == $faculties->currentPage())

                    <span class="w-10 h-10
                        rounded-xl
                        bg-amber-500
                        text-white
                        font-semibold
                        flex items-center justify-center
                        shadow">

                        {{ $page }}

                    </span>

                    @else

                    <a href="{{ $faculties->url($page) }}" class="ajax-faculty-page
                        w-10 h-10
                        rounded-xl
                        border border-slate-200
                        bg-white
                        text-slate-600
                        font-medium
                        flex items-center justify-center
                        transition-all duration-300
                        hover:bg-amber-500
                        hover:border-amber-500
                        hover:text-white">

                        {{ $page }}

                    </a>

                    @endif

                    @endfor

                    {{-- NEXT --}}
                    @if ($faculties->hasMorePages())

                    <a href="{{ $faculties->nextPageUrl() }}" class="ajax-faculty-page
                    w-10 h-10
                    rounded-xl
                    border border-slate-200
                    bg-white
                    text-slate-600
                    flex items-center justify-center
                    transition-all duration-300
                    hover:bg-amber-500
                    hover:border-amber-500
                    hover:text-white">

                        <i class="fa-solid fa-angle-right"></i>

                    </a>

                    @else

                    <span class="w-10 h-10
                    rounded-xl
                    border border-slate-200
                    bg-slate-100
                    text-slate-300
                    flex items-center justify-center
                    cursor-not-allowed">

                        <i class="fa-solid fa-angle-right"></i>

                    </span>

                    @endif

            </div>

        </div>

    </div>

</div>
@endsection
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {

    // =========================
    // FILTER
    // =========================
    document.addEventListener("submit", function(e) {

        const form = e.target.closest("#faculties-filter-form");

        if (!form) return;

        e.preventDefault();

        const url = form.action + "?" + new URLSearchParams(new FormData(form));

        loadFaculties(url);

    });

    // =========================
    // RESET
    // =========================
    document.addEventListener("click", function(e) {

        const btn = e.target.closest("#reset-faculty-filter");

        if (!btn) return;

        e.preventDefault();

        document.getElementById("faculties-filter-form").reset();

        loadFaculties(btn.href);

    });

    // =========================
    // PAGINATION AJAX
    // =========================
    document.addEventListener("click", function(e) {

        const link = e.target.closest(".ajax-faculty-page");

        if (!link) return;

        e.preventDefault();

        loadFaculties(link.href);

    });

});


// =====================================================
// LOAD FACULTIES
// =====================================================
async function loadFaculties(url) {

    const area = document.getElementById("faculties-area");

    if (!area) return;

    area.style.pointerEvents = "none";
    area.classList.add("opacity-60", "transition", "duration-200");

    try {

        const response = await fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "Accept": "text/html"
            }
        });

        if (!response.ok) {
            throw new Error("Load failed");
        }

        const html = await response.text();

        const parser = new DOMParser();

        const doc = parser.parseFromString(html, "text/html");

        const newArea = doc.querySelector("#faculties-area");

        if (newArea) {

            area.innerHTML = newArea.innerHTML;

            history.pushState({}, "", url);

        }

    } catch (error) {

        console.error(error);

        alert("Không thể tải dữ liệu.");

    }

    area.classList.remove("opacity-60");

    area.style.pointerEvents = "";

}



// =====================================================
// DELETE FACULTY
// =====================================================
async function deleteFaculty(id) {

    if (!confirm("Bạn có chắc muốn xóa khoa này?")) {
        return;
    }

    try {

        const response = await fetch(`/admin/faculties/${id}`, {

            method: "DELETE",

            headers: {

                "X-CSRF-TOKEN": "{{ csrf_token() }}",

                "X-Requested-With": "XMLHttpRequest",

                "Accept": "application/json"

            }

        });

        if (!response.ok) {
            throw new Error("Delete failed");
        }

        const data = await response.json();

        if (!data.success) {

            alert(data.message);

            return;

        }

        loadFaculties(window.location.href);

        const badge = document.getElementById("trash-count");

        if (badge) {

            badge.textContent = data.trashedCount;

            if (data.trashedCount > 0) {

                badge.classList.remove("hidden");

            } else {

                badge.classList.add("hidden");

            }

        }

    } catch (error) {

        console.error(error);

        alert("Có lỗi xảy ra.");

    }

}



// =====================================================
// TOGGLE STATUS
// =====================================================
async function toggleStatus(id, btn) {

    try {

        const response = await fetch(`/admin/faculties/${id}/status`, {

            method: "PATCH",

            headers: {

                "X-CSRF-TOKEN": "{{ csrf_token() }}",

                "X-Requested-With": "XMLHttpRequest",

                "Accept": "application/json"

            }

        });

        const data = await response.json();

        if (!response.ok || !data.success) {

            alert(data.message ?? "Không thể thay đổi trạng thái.");

            return;

        }

        const badge = document.getElementById(`status-${id}`);

        const icon = btn.querySelector("i");

        btn.classList.remove(
            "bg-emerald-50",
            "text-emerald-600",
            "bg-yellow-50",
            "text-yellow-600"
        );

        if (data.status) {

            badge.className =
                "inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-sm font-bold";

            badge.innerHTML =
                '<span class="w-2 h-2 rounded-full bg-emerald-500"></span>Hoạt động';

            btn.classList.add(
                "bg-emerald-50",
                "text-emerald-600"
            );

            icon.className = "fa-solid fa-lock-open";

        } else {

            badge.className =
                "inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-red-50 text-red-600 text-sm font-bold";

            badge.innerHTML =
                '<span class="w-2 h-2 rounded-full bg-red-500"></span>Đã khóa';

            btn.classList.add(
                "bg-yellow-50",
                "text-yellow-600"
            );

            icon.className = "fa-solid fa-lock";

        }

    } catch (error) {

        console.error(error);

        alert("Có lỗi xảy ra.");

    }

}

document.addEventListener('click', function(e) {

    const btn = e.target.closest('.action-btn');

    // đóng tất cả menu
    document.querySelectorAll('[id^="action-menu-"]').forEach(menu => {

        if (!btn || menu.id !== 'action-menu-' + btn.dataset.id) {

            menu.classList.add('hidden');

        }

    });

    if (!btn) return;

    e.stopPropagation();

    const id = btn.dataset.id;

    document
        .getElementById('action-menu-' + id)
        .classList.toggle('hidden');

});
</script>
@endpush