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
@endphp

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white border rounded-md shadow-sm p-5 flex justify-between items-center">

        <div>
            <h2 class="text-lg font-black">Danh sách loại tài liệu</h2>
            <p class="text-sm text-slate-500">Quản lý loại tài liệu</p>
        </div>

        <div class="flex gap-3">

            <a href="{{ route('admin.document-types.trashed') }}"
                class="relative h-11 px-4 flex items-center gap-2 bg-red-50 text-red-600 rounded-md font-black">

                <i class="fa-solid fa-trash"></i>

                <span id="trash-count"
                    class="min-w-5 h-5 px-2 bg-red-500 text-white text-[10px] rounded-full flex items-center justify-center">
                    {{ $totalTrashedDocumentTypes }}
                </span>
            </a>

            <a href="{{ route('admin.document-types.create') }}"
                class="h-11 px-4 flex items-center bg-sky-500 text-white rounded-md font-black">
                + Thêm loại
            </a>

        </div>
    </div>

    <!-- FILTER -->
    <div class="bg-white border rounded-md shadow-sm p-5">
        <form id="filter-form" class="grid grid-cols-12 gap-4">

            <input type="text" name="search" class="col-span-7 h-11 px-4 bg-slate-50 border rounded-md"
                placeholder="Tìm loại tài liệu...">

            <select name="status" class="col-span-3 h-11 px-4 bg-slate-50 border rounded-md">
                <option value="">Tất cả</option>
                <option value="1">Hoạt động</option>
                <option value="0">Ẩn</option>
            </select>

            <div class="col-span-2 flex gap-2">
                <button class="w-full bg-sky-500 text-white rounded-md font-black">Lọc</button>
                <a href="{{ route('admin.document-types.index') }}"
                    class="w-full bg-slate-100 flex items-center justify-center rounded-md font-black">
                    Reset
                </a>
            </div>

        </form>
    </div>

    <!-- TABLE -->
    <div class="bg-white border rounded-md overflow-hidden">

        <!-- HEADER -->
        <div class="px-5 py-4 border-b flex justify-between">
            <div>
                <h2 class="text-sm font-black">Loại tài liệu</h2>
                <p class="text-xs text-slate-400">Danh sách hệ thống</p>
            </div>

            <span class="px-3 py-1 bg-sky-50 text-sky-600 text-xs font-black rounded-md">
                {{ $totalTypes }} loại
            </span>
        </div>

        <!-- GRID HEADER -->
        <div class="px-5 py-3 bg-slate-50 border-b grid grid-cols-12 text-xs font-black text-slate-500 uppercase">
            <div class="col-span-1">STT</div>
            <div class="col-span-4">Tên loại</div>
            <div class="col-span-2">Tài liệu</div>
            <div class="col-span-2">Trạng thái</div>
            <div class="col-span-3 text-right">Hành động</div>
        </div>

        <!-- BODY -->
        <div id="table-body" class="divide-y">

            @foreach($documentTypes as $type)

            @php
            $active = $type->is_active;
            $colorClass = $colorMap[$type->color] ?? $colorMap['cyan'];
            @endphp

            <div class="grid grid-cols-12 px-5 py-4 items-center hover:bg-slate-50">

                <!-- STT -->
                <div class="col-span-1 font-black text-slate-500">
                    {{ $loop->iteration }}
                </div>

                <!-- NAME + ICON + COLOR -->
                <div class="col-span-4 flex items-center gap-2">

                    <span class="w-8 h-8 flex items-center justify-center rounded-md {{ $colorClass }}">
                        <i class="{{ $type->icon }} text-sm"></i>
                    </span>
                    <span class="font-semibold">
                        {{ $type->type_name }}
                    </span>
                </div>

                <!-- COUNT -->
                <div class="col-span-2 font-black">
                    {{ $type->documents_count }}
                </div>

                <!-- STATUS -->
                <div class="col-span-2">
                    <span id="status-{{ $type->document_type_id }}" class="text-xs px-2 py-1 rounded font-black inline-flex items-center gap-1
                            {{ $active ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-500' }}">

                        <span class="w-1.5 h-1.5 rounded-full
                                {{ $active ? 'bg-emerald-500' : 'bg-red-500' }}"></span>

                        {{ $active ? 'Hoạt động' : 'Ẩn' }}
                    </span>
                </div>

                <!-- ACTION -->
                <div class="col-span-3 flex justify-end gap-2">

                    <!-- VIEW -->
                    <a href="{{ route('admin.document-types.show', $type->document_type_id) }}"
                        class="w-9 h-9 flex items-center justify-center rounded-md bg-sky-50 text-sky-600">
                        <i class="fa-solid fa-eye"></i>
                    </a>

                    <!-- EDIT -->
                    <a href="{{ route('admin.document-types.edit', $type->document_type_id) }}"
                        class="w-9 h-9 flex items-center justify-center rounded-md bg-amber-50 text-amber-500">
                        <i class="fa-solid fa-pen"></i>
                    </a>

                    <!-- TOGGLE -->
                    <button type="button" onclick="toggleStatus('{{ $type->document_type_id }}', this)" class="w-9 h-9 flex items-center justify-center rounded-md
                            {{ $active ? 'bg-emerald-50 text-emerald-600' : 'bg-yellow-50 text-yellow-600' }}">

                        <i class="fa-solid {{ $active ? 'fa-lock-open' : 'fa-lock' }}"></i>
                    </button>

                    <!-- DELETE -->
                    <button type="button" onclick="deleteType('{{ $type->document_type_id }}', this)"
                        class="w-9 h-9 flex items-center justify-center rounded-md bg-red-50 text-red-500">
                        <i class="fa-solid fa-trash"></i>
                    </button>

                </div>
            </div>

            @endforeach

        </div>
    </div>

</div>
@endsection
@push('scripts')
<script>
// =========================
// FILTER AJAX
// =========================
document.getElementById('filter-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const url = window.location.pathname + '?' + new URLSearchParams(new FormData(this));
    load(url);
});

// =========================
// LOAD TABLE (AJAX)
// =========================
async function load(url) {

    const res = await fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    });

    const html = await res.text();
    const doc = new DOMParser().parseFromString(html, 'text/html');

    const newTable = doc.getElementById('table-body');
    const oldTable = document.getElementById('table-body');

    if (newTable && oldTable) {
        oldTable.innerHTML = newTable.innerHTML;
    }

    history.pushState({}, '', url);
}

// =========================
// TOGGLE STATUS (FIX ICON + MÀU)
// =========================
async function toggleStatus(id, btn) {

    const res = await fetch(`/admin/document-types/${id}/status`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    });

    const data = await res.json();
    if (!data.success) return;

    const badge = document.getElementById(`status-${id}`);
    const icon = btn.querySelector('i');

    if (data.status) {

        // ACTIVE
        badge.className =
            "text-xs px-2 py-1 rounded font-black inline-flex items-center gap-1 bg-emerald-50 text-emerald-600";

        badge.innerHTML =
            `<span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Hoạt động`;

        btn.className =
            "w-9 h-9 flex items-center justify-center rounded-md bg-emerald-50 text-emerald-600 hover:bg-emerald-100";

        icon.className = "fa-solid fa-lock-open text-sm";

    } else {

        // INACTIVE
        badge.className =
            "text-xs px-2 py-1 rounded font-black inline-flex items-center gap-1 bg-red-50 text-red-500";

        badge.innerHTML =
            `<span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Ẩn`;

        btn.className =
            "w-9 h-9 flex items-center justify-center rounded-md bg-yellow-50 text-yellow-600 hover:bg-yellow-100";

        icon.className = "fa-solid fa-lock text-sm";
    }
}

// =========================
// DELETE (SOFT DELETE + LOCK LOGIC)
// =========================
async function deleteType(id, btn) {

    if (!confirm('Bạn có chắc muốn xóa loại tài liệu này?')) return;

    const res = await fetch(`/admin/document-types/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    });

    const data = await res.json();

    // CASE 1: bị khóa (có tài liệu)
    if (data.type === 'locked') {

        alert(data.message);

        const row = btn.closest('.grid');
        const badge = row.querySelector('[id^="status-"]');

        if (badge) {
            badge.className =
                "text-xs px-2 py-1 rounded font-black inline-flex items-center gap-1 bg-red-50 text-red-500";

            badge.innerHTML =
                `<span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Ẩn`;
        }

        return;
    }

    // CASE 2: xóa thành công
    if (data.success) {

        btn.closest('.grid').remove();

        const badge = document.getElementById('trash-count');
        if (badge) badge.textContent = data.trashed_count;
    }
}

// =========================
// BACK BUTTON FIX HISTORY
// =========================
window.addEventListener('popstate', function() {
    location.reload();
});
</script>
@endpush