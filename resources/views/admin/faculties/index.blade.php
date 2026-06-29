@extends('layouts.admin')

@section('title', 'Quản lý khoa')
@section('page-title', 'Quản lý khoa')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white border rounded-md shadow-sm p-5">

        <div class="flex justify-between items-center">

            <div>

                <h2 class="text-lg font-black">
                    Danh sách khoa
                </h2>

                <p class="text-sm text-slate-500">
                    Danh sách các khoa trong hệ thống
                </p>

            </div>

            <div class="flex items-center gap-3">

                {{-- Thùng rác --}}
                <a href="{{ route('admin.faculties.trashed') }}" class="inline-flex items-center gap-2 h-11 px-4 rounded-md
        bg-white border border-red-200 text-red-500 text-sm font-black
        hover:bg-red-500 hover:text-white transition">

                    <i class="fa-solid fa-trash-can-arrow-up"></i>

                    <span id="trash-count" class="min-w-6 h-6 px-2 rounded-full
    bg-red-500 text-white text-xs font-black
    flex items-center justify-center
    {{ $totalTrashedFaculties == 0 ? 'hidden' : '' }}">

                        {{ $totalTrashedFaculties }}

                    </span>

                </a>

                {{-- Thêm khoa --}}
                <a href="{{ route('admin.faculties.create') }}" class="h-11 px-4 flex items-center
                bg-sky-500 text-white rounded-md font-black
                hover:bg-sky-600 transition">

                    <i class="fa-solid fa-plus mr-2"></i>

                    Thêm khoa

                </a>

            </div>

        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5 mb-6">

        <form id="faculties-filter-form" method="GET" action="{{ route('admin.faculties.index') }}"
            class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <!-- Tìm kiếm -->
            <div class="md:col-span-8 relative">

                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Tìm theo mã khoa hoặc tên khoa..."
                    class="w-full h-11 pl-11 pr-4 rounded-md bg-slate-50 border text-sm font-semibold">

            </div>

            <!-- Trạng thái -->
            <div class="md:col-span-2">

                <select name="status" class="w-full h-11 px-4 rounded-md bg-slate-50 border text-sm font-semibold">

                    <option value="">Trạng thái</option>

                    <option value="1" @selected(request('status')=='1' )>

                        Hoạt động

                    </option>

                    <option value="0" @selected(request('status')=='0' )>

                        Đã khóa

                    </option>

                </select>

            </div>

            <!-- Lọc -->
            <div class="md:col-span-1">

                <button type="submit"
                    class="w-full h-11 bg-sky-500 text-white rounded-md text-sm font-black hover:bg-sky-600 transition">

                    Lọc

                </button>

            </div>

            <!-- Reset -->
            <div class="md:col-span-1">

                <a href="{{ route('admin.faculties.index') }}"
                    class="h-11 flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-black rounded-md">

                    Reset

                </a>

            </div>

        </form>

    </div>

    <!-- CARD -->
    <div id="faculties-area" class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

        <!-- HEADER -->
        <div class="px-5 py-4 border-b flex justify-between">
            <div>
                <h2 class="text-sm font-black">Khoa hệ thống</h2>
                <p class="text-xs text-slate-400">Thông tin Khoa</p>
            </div>

            <span class="px-3 py-1 bg-sky-50 text-sky-600 text-xs font-black rounded-md border">
                {{ $faculties->total() ?? 0 }} khoa
            </span>
        </div>
        <!-- TABLE -->
        <div class="divide-y divide-slate-200">

            <!-- HEADER -->
            <div class="grid grid-cols-12 px-6 py-4 bg-slate-50 text-xs font-black uppercase text-slate-500">

                <div class="col-span-1">STT</div>

                <div class="col-span-5">Khoa</div>

                <div class="col-span-2 text-center">Môn học</div>

                <div class="col-span-2 text-center">Trạng thái</div>

                <div class="col-span-2 text-center">Hành động</div>

            </div>

            @forelse($faculties as $faculty)

            <div class="grid grid-cols-12 items-center px-6 py-6 hover:bg-slate-50 transition">

                <!-- STT -->
                <div class="col-span-1">

                    <span class="col-span-1 font-black text-slate-500">
                        {{ $loop->iteration }}
                    </span>

                </div>

                <!-- KHOA -->
                <div class="col-span-5">

                    <div class="flex items-center gap-4">

                        <div class=" w-9 h-9 rounded-md bg-cyan-50 text-cyan-600 flex items-center justify-center">

                            <i class="fa-solid fa-building-columns text-xl"></i>

                        </div>

                        <div>

                            <h4 class="font-black text-slate-700 truncate text-sm">

                                {{ $faculty->faculty_name }}

                            </h4>

                            <div class="flex gap-2 mt-1">

                                <span class="text-[10px] bg-slate-100 px-2 rounded">

                                    {{ $faculty->faculty_code }}

                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- MÔN HỌC -->
                <div class="col-span-2 text-center">

                    <span class="font-black text-slate-700 truncate text-sm">

                        {{ $faculty->subjects_count }}

                    </span>

                </div>

                <!-- TRẠNG THÁI -->
                <div class="col-span-2 text-center">

                    <span id="status-{{ $faculty->faculty_id }}" class="inline-flex items-center gap-2 px-3 py-1 rounded-lg
    {{ $faculty->is_active
        ? 'bg-emerald-50 text-emerald-600'
        : 'bg-red-50 text-red-600' }}
    text-sm font-bold">

                        <span class="w-2 h-2 rounded-full
        {{ $faculty->is_active ? 'bg-emerald-500' : 'bg-red-500' }}">
                        </span>

                        {{ $faculty->is_active ? 'Hoạt động' : 'Đã khóa' }}

                    </span>
                </div>

                <!-- ACTION -->
                <div class="col-span-2">

                    <div class="flex justify-center gap-2">

                        <a href="{{ route('admin.faculties.show', $faculty->faculty_id) }}" class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600
    hover:bg-sky-500 hover:text-white
    flex items-center justify-center transition">

                            <i class="fa-solid fa-eye"></i>

                        </a>

                        <a href="{{ route('admin.faculties.edit', $faculty->faculty_id) }}" class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600
    hover:bg-amber-500 hover:text-white
    flex items-center justify-center transition">

                            <i class="fa-solid fa-pen"></i>

                        </a>

                        @php
                        $active = $faculty->is_active;
                        @endphp

                        <!-- TOGGLE STATUS (AJAX) -->
                        <button type="button" onclick="toggleStatus('{{ $faculty->faculty_id }}', this)" class="w-9 h-9 flex items-center justify-center rounded-md
    {{ $active ? 'bg-emerald-50 text-emerald-600' : 'bg-yellow-50 text-yellow-600' }}">

                            <i class="fa-solid {{ $active ? 'fa-lock-open' : 'fa-lock' }}"></i>

                        </button>
                        <!-- DELETE -->
                        <form action="{{ route('admin.faculties.destroy', $faculty->faculty_id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="button" onclick="deleteFaculty('{{ $faculty->faculty_id }}', this)" class="w-9 h-9 flex items-center justify-center rounded-md
        bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition">

                                <i class="fa-solid fa-trash"></i>

                            </button>

                        </form>

                    </div>

                </div>

            </div>

            @empty

            <div class="py-20 text-center text-slate-500">

                <i class="fa-solid fa-building-columns text-5xl mb-4"></i>

                <p>Chưa có khoa nào.</p>

            </div>

            @endforelse

        </div>

    </div>

    <div class="mt-6">
        {{ $faculties->links() }}
    </div>


</div>

@endsection
@push('scripts')
<script>
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

        const data = await response.json();

        if (!data.success) {
            alert(data.message);
            return;
        }

        // Load lại danh sách
        loadFaculties(window.location.href);

        // Cập nhật badge thùng rác
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
async function toggleStatus(id, btn) {

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

    if (data.status) {

        badge.className =
            "inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-sm font-bold";

        badge.innerHTML =
            '<span class="w-2 h-2 rounded-full bg-emerald-500"></span>Hoạt động';

        btn.className =
            "w-9 h-9 flex items-center justify-center rounded-md bg-emerald-50 text-emerald-600";

        icon.className = "fa-solid fa-lock-open";

    } else {

        badge.className =
            "inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-red-50 text-red-600 text-sm font-bold";

        badge.innerHTML =
            '<span class="w-2 h-2 rounded-full bg-red-500"></span>Đã khóa';

        btn.className =
            "w-9 h-9 flex items-center justify-center rounded-md bg-yellow-50 text-yellow-600";

        icon.className = "fa-solid fa-lock";

    }

}
document.addEventListener('DOMContentLoaded', () => {

    // Submit form tìm kiếm/lọc
    document.addEventListener('submit', function(e) {

        const form = e.target.closest('#faculties-filter-form');

        if (!form) return;

        e.preventDefault();

        const url =
            form.action + '?' + new URLSearchParams(new FormData(form));

        loadFaculties(url);
    });

    // Reset
    document.addEventListener('click', function(e) {

        const btn = e.target.closest('#reset-faculty-filter');

        if (!btn) return;

        e.preventDefault();

        document.getElementById('faculties-filter-form').reset();

        loadFaculties(btn.href);

    });

    // Phân trang Ajax
    document.addEventListener('click', function(e) {

        const link = e.target.closest('#faculties-area .pagination a');

        if (!link) return;

        e.preventDefault();

        loadFaculties(link.href);

    });

});


async function loadFaculties(url) {
    const area = document.getElementById('faculties-area');

    if (!area) return;

    area.classList.add('opacity-50');

    try {

        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const html = await response.text();

        const parser = new DOMParser();

        const doc = parser.parseFromString(html, 'text/html');

        const newArea = doc.querySelector('#faculties-area');

        if (newArea) {

            area.innerHTML = newArea.innerHTML;

            history.pushState({}, '', url);

        }

    } catch (e) {

        console.error(e);

    }

    area.classList.remove('opacity-50');
}
</script>
@endpush