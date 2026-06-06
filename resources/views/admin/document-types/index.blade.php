@extends('layouts.admin')

@section('title', 'Quản lý loại tài liệu')
@section('page-title', 'Quản lý loại tài liệu')

@section('content')

@php
$documentTypes = $documentTypes ?? $loaiTaiLieus;
$totalTrashedDocumentTypes = $totalTrashedDocumentTypes ?? 0;
@endphp

<div class="max-w-7xl mx-auto px-2 lg:px-4">

    <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="text-3xl font-black text-slate-900">
                Quản lý loại tài liệu
            </h1>

            <p class="text-slate-500 font-semibold mt-2">
                Quản lý các loại tài liệu dùng để phân loại học liệu trong hệ thống.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            @if(Route::has('admin.document-types.trashed'))
            <a href="{{ route('admin.document-types.trashed') }}"
                class="group inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-white border border-red-100 text-red-500 font-black shadow-sm hover:bg-red-500 hover:text-white transition-all">
                <span
                    class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center group-hover:bg-white/20 group-hover:text-white transition">
                    <i class="fa-solid fa-trash-restore"></i>
                </span>
                Loại đã xóa
            </a>
            @endif

            <a href="{{ route('admin.document-types.create') }}"
                class="group inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-cyan-600 text-white font-black shadow-lg shadow-cyan-100 hover:bg-cyan-700 hover:-translate-y-0.5 transition-all">
                <span class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-plus"></i>
                </span>
                Thêm loại tài liệu
            </a>
        </div>
    </div>

    <div id="category-area">

        <div class="bg-white rounded-2xl border border-cyan-100 p-5 mb-8 shadow-sm">
            <form id="category-filter-form" action="{{ route('admin.document-types.index') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-5 gap-4">

                <div class="md:col-span-3 relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-cyan-600"></i>

                    <input type="text" name="keyword" value="{{ request('keyword') }}"
                        placeholder="Tìm theo tên loại tài liệu..."
                        class="w-full h-12 pl-14 pr-5 rounded-xl bg-slate-50 border border-slate-200 outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700">
                </div>

                <button type="submit"
                    class="h-12 rounded-xl bg-cyan-600 text-white font-black hover:bg-cyan-700 transition">
                    <i class="fa-solid fa-filter mr-2"></i>
                    Lọc
                </button>

                <a href="{{ route('admin.document-types.index') }}" id="reset-category-filter"
                    class="h-12 rounded-xl bg-slate-100 text-slate-700 font-black flex items-center justify-center hover:bg-slate-200 transition">
                    Reset
                </a>
            </form>
        </div>

        <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-cyan-100 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-black text-slate-900">
                        Danh sách loại tài liệu
                    </h2>

                    <p class="text-sm text-slate-500 font-semibold mt-1">
                        Tổng số {{ number_format($documentTypes->total()) }} loại tài liệu.
                    </p>
                </div>

                <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black border border-cyan-100">
                    {{ number_format($documentTypes->total()) }} loại
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-cyan-50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-black uppercase text-slate-500">STT</th>

                            <th class="px-6 py-4 text-xs font-black uppercase text-slate-500">
                                <a href="{{ route('admin.document-types.index', array_merge(request()->query(), [
                                    'sort' => request('sort') === 'az' ? 'za' : 'az'
                                ])) }}" class="ajax-category-page inline-flex items-center gap-2">
                                    Loại tài liệu
                                    <i
                                        class="fa-solid fa-chevron-down text-xs {{ request('sort') === 'za' ? 'rotate-180' : '' }}"></i>
                                </a>
                            </th>

                            <th class="px-6 py-4 text-xs font-black uppercase text-slate-500">Mô tả</th>
                            <th class="px-6 py-4 text-xs font-black uppercase text-slate-500">Số tài liệu</th>
                            <th class="px-6 py-4 text-xs font-black uppercase text-slate-500">Trạng thái</th>
                            <th class="px-6 py-4 text-xs font-black uppercase text-slate-500 text-right">Hành động</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-cyan-100">
                        @forelse($documentTypes as $index => $type)
                        @php
                        $id = $type->document_type_id ?? $type->loai_id;
                        $name = $type->type_name ?? $type->ten_loai;
                        $description = $type->description ?? $type->mo_ta ?? 'Chưa có mô tả';
                        $count = $type->documents_count ?? $type->tai_lieus_count ?? 0;
                        @endphp

                        <tr class="hover:bg-cyan-50/50 transition">
                            <td class="px-6 py-5 text-sm font-bold text-slate-500">
                                {{ $documentTypes->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center border border-cyan-100">
                                        @php
                                        $colors = [
                                        'red' => 'bg-red-50 text-red-500 border-red-100',
                                        'green' => 'bg-green-50 text-green-500 border-green-100',
                                        'blue' => 'bg-blue-50 text-blue-500 border-blue-100',
                                        'cyan' => 'bg-cyan-50 text-cyan-500 border-cyan-100',
                                        'purple' => 'bg-purple-50 text-purple-500 border-purple-100',
                                        'amber' => 'bg-amber-50 text-amber-500 border-amber-100',
                                        'orange' => 'bg-orange-50 text-orange-500 border-orange-100',
                                        'indigo' => 'bg-indigo-50 text-indigo-500 border-indigo-100',
                                        'emerald' => 'bg-emerald-50 text-emerald-500 border-emerald-100',
                                        ];

                                        $colorClass = $colors[$type->color] ?? 'bg-slate-50 text-slate-500
                                        border-slate-100';
                                        @endphp

                                        <div
                                            class="w-12 h-12 rounded-2xl border flex items-center justify-center {{ $colorClass }}">
                                            <i class="{{ $type->icon }}"></i>
                                        </div>
                                    </div>

                                    <div class="min-w-0">
                                        <h4 class="font-black text-slate-800 truncate">
                                            {{ $name }}
                                        </h4>

                                        <p class="text-sm text-slate-400 font-semibold">
                                            Mã loại: #{{ $id }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5 max-w-sm">
                                <p class="text-sm font-semibold text-slate-500 truncate">
                                    {{ $description }}
                                </p>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="inline-flex items-center whitespace-nowrap px-4 py-2 rounded-full bg-slate-50 text-slate-600 text-xs font-black border border-slate-100">
                                    {{ $count }} tài liệu
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                @if($type->is_active)
                                <span
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 text-emerald-600 text-xs font-black">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    Hoạt động
                                </span>
                                @else
                                <span
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-50 text-red-500 text-xs font-black">
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                    Ngừng
                                </span>
                                @endif
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.document-types.edit', $id) }}"
                                        class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 hover:bg-amber-500 hover:text-white flex items-center justify-center transition">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <button type="button" data-id="{{ $id }}" data-name="{{ $name }}"
                                        data-count="{{ $count }}" onclick="openDeleteModal(this)"
                                        class="w-10 h-10 rounded-xl {{ $count > 0 ? 'bg-orange-50 text-orange-500 hover:bg-orange-500' : 'bg-red-50 text-red-500 hover:bg-red-500' }} hover:text-white flex items-center justify-center transition">

                                        <i class="fa-solid {{ $count > 0 ? 'fa-ban' : 'fa-trash' }}"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div
                                    class="w-20 h-20 mx-auto rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-5">
                                    <i class="fa-solid fa-folder-open text-3xl"></i>
                                </div>

                                <h3 class="text-2xl font-black text-slate-900">
                                    Chưa có loại tài liệu
                                </h3>

                                <p class="text-slate-500 font-semibold mt-2">
                                    Hãy thêm loại tài liệu đầu tiên cho hệ thống.
                                </p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>



        </div>
        <div
            class="mt-8 px-7 py-6 bg-white rounded-[30px] border border-cyan-100 flex flex-col md:flex-row items-center justify-between gap-5 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <p class="text-sm font-bold text-slate-500">
                Hiển thị
                <span class="text-cyan-700">{{ $documentTypes->firstItem() ?? 0 }}</span>
                -
                <span class="text-cyan-700">{{ $documentTypes->lastItem() ?? 0 }}</span>
                trong tổng
                <span class="text-cyan-700">{{ $documentTypes->total() }}</span>
                loại tài liệu
            </p>

            <div class="flex items-center gap-3">
                @if ($documentTypes->onFirstPage())
                <span
                    class="w-12 h-12 rounded-2xl bg-white border border-slate-100 text-slate-300 flex items-center justify-center cursor-not-allowed">
                    <i class="fa-solid fa-angle-left"></i>
                </span>
                @else
                <a href="{{ $documentTypes->previousPageUrl() }}"
                    class="ajax-category-page w-12 h-12 rounded-2xl bg-white border border-cyan-100 text-slate-500 hover:bg-cyan-500 hover:text-white flex items-center justify-center transition-all">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
                @endif

                @for ($page = 1; $page <= max($documentTypes->lastPage(), 1); $page++)
                    @if ($page == $documentTypes->currentPage())
                    <span
                        class="w-12 h-12 rounded-2xl bg-cyan-500 text-white shadow-lg shadow-cyan-200 flex items-center justify-center font-black">
                        {{ $page }}
                    </span>
                    @else
                    <a href="{{ $documentTypes->url($page) }}"
                        class="ajax-category-page w-12 h-12 rounded-2xl bg-white border border-cyan-100 text-slate-500 hover:bg-cyan-500 hover:text-white flex items-center justify-center font-bold transition-all">
                        {{ $page }}
                    </a>
                    @endif
                    @endfor

                    @if ($documentTypes->hasMorePages())
                    <a href="{{ $documentTypes->nextPageUrl() }}"
                        class="ajax-category-page w-12 h-12 rounded-2xl bg-white border border-cyan-100 text-slate-500 hover:bg-cyan-500 hover:text-white flex items-center justify-center transition-all">
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                    @else
                    <span
                        class="w-12 h-12 rounded-2xl bg-white border border-slate-100 text-slate-300 flex items-center justify-center cursor-not-allowed">
                        <i class="fa-solid fa-angle-right"></i>
                    </span>
                    @endif
            </div>
        </div>
    </div>
</div>

<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="w-full max-w-md rounded-[28px] bg-white p-7 shadow-2xl">
        <div id="deleteIcon"
            class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-red-50 text-red-500">
            <i class="fa-solid fa-trash text-2xl"></i>
        </div>

        <h2 id="deleteTitle" class="text-center text-xl font-black text-slate-900">
            Xác nhận xóa
        </h2>

        <p id="deleteMessage" class="mt-3 text-center text-sm leading-6 text-slate-500 font-semibold"></p>

        <div class="mt-6 flex items-center justify-center gap-3">
            <button type="button" onclick="closeDeleteModal()"
                class="px-5 py-3 rounded-xl bg-slate-100 text-slate-700 font-black hover:bg-slate-200 transition">
                Hủy
            </button>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')

                <button id="deleteSubmit" type="submit"
                    class="px-5 py-3 rounded-xl bg-red-500 text-white font-black hover:bg-red-600 transition">
                    Xác nhận
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('submit', async function(e) {
    const form = e.target.closest('#category-filter-form');

    if (!form) return;

    e.preventDefault();

    const url = form.action + '?' + new URLSearchParams(new FormData(form)).toString();

    await loadCategoryArea(url);
});

document.addEventListener('click', async function(e) {
    const link = e.target.closest('.ajax-category-page, #reset-category-filter');

    if (!link) return;

    e.preventDefault();

    await loadCategoryArea(link.href);
});

async function loadCategoryArea(url) {
    const area = document.getElementById('category-area');

    if (!area) return;

    area.classList.add('opacity-50', 'pointer-events-none');

    try {
        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const html = await response.text();
        const doc = new DOMParser().parseFromString(html, 'text/html');
        const newArea = doc.querySelector('#category-area');

        if (newArea) {
            area.innerHTML = newArea.innerHTML;
            window.history.pushState({}, '', url);
        }
    } finally {
        area.classList.remove('opacity-50', 'pointer-events-none');
    }
}

function openDeleteModal(button) {
    const id = button.dataset.id;
    const name = button.dataset.name;
    const count = Number(button.dataset.count || 0);

    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    const title = document.getElementById('deleteTitle');
    const message = document.getElementById('deleteMessage');
    const submit = document.getElementById('deleteSubmit');
    const icon = document.getElementById('deleteIcon');

    form.action = `/admin/document-types/${id}`;

    if (count > 0) {
        title.innerText = 'Ngừng hoạt động loại tài liệu';
        message.innerHTML =
            `Loại tài liệu <b>${name}</b> đang có ${count} tài liệu. Hệ thống sẽ chuyển sang trạng thái ngừng hoạt động thay vì xóa.`;
        submit.innerText = 'Ngừng hoạt động';
        submit.className = 'px-5 py-3 rounded-xl bg-orange-500 text-white font-black hover:bg-orange-600 transition';
        icon.className =
            'mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 text-orange-500';
        icon.innerHTML = '<i class="fa-solid fa-ban text-2xl"></i>';
    } else {
        title.innerText = 'Xác nhận xóa';
        message.innerHTML = `Bạn có chắc muốn xóa loại tài liệu <b>${name}</b> không?`;
        submit.innerText = 'Xóa';
        submit.className = 'px-5 py-3 rounded-xl bg-red-500 text-white font-black hover:bg-red-600 transition';
        icon.className =
            'mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-red-50 text-red-500';
        icon.innerHTML = '<i class="fa-solid fa-trash text-2xl"></i>';
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');

    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

document.addEventListener('click', function(e) {
    const modal = document.getElementById('deleteModal');

    if (e.target === modal) {
        closeDeleteModal();
    }
});
</script>

@endsection