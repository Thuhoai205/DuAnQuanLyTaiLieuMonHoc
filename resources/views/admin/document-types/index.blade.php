 @extends('layouts.admin')

 @section('title', 'Quản lý loại tài liệu')
 @section('page-title', 'Quản lý loại tài liệu')

 @section('content')

 @php
 $documentTypes = $documentTypes ?? $loaiTaiLieus;
 $totalTypes = $totalTypes ?? $documentTypes->total();
 $totalDocuments = $totalDocuments ?? 0;

 $colorMap = [
 'blue' => [
 'iconBox' => 'bg-blue-50 text-blue-600 border-blue-100 group-hover:bg-blue-500',
 'soft' => 'bg-blue-50 text-blue-700 border-blue-100',
 ],
 'green' => [
 'iconBox' => 'bg-green-50 text-green-600 border-green-100 group-hover:bg-green-500',
 'soft' => 'bg-green-50 text-green-700 border-green-100',
 ],
 'emerald' => [
 'iconBox' => 'bg-emerald-50 text-emerald-600 border-emerald-100 group-hover:bg-emerald-500',
 'soft' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
 ],
 'red' => [
 'iconBox' => 'bg-red-50 text-red-600 border-red-100 group-hover:bg-red-500',
 'soft' => 'bg-red-50 text-red-700 border-red-100',
 ],
 'purple' => [
 'iconBox' => 'bg-purple-50 text-purple-600 border-purple-100 group-hover:bg-purple-500',
 'soft' => 'bg-purple-50 text-purple-700 border-purple-100',
 ],
 'cyan' => [
 'iconBox' => 'bg-cyan-50 text-cyan-600 border-cyan-100 group-hover:bg-cyan-500',
 'soft' => 'bg-cyan-50 text-cyan-700 border-cyan-100',
 ],
 'orange' => [
 'iconBox' => 'bg-orange-50 text-orange-600 border-orange-100 group-hover:bg-orange-500',
 'soft' => 'bg-orange-50 text-orange-700 border-orange-100',
 ],
 'amber' => [
 'iconBox' => 'bg-amber-50 text-amber-600 border-amber-100 group-hover:bg-amber-500',
 'soft' => 'bg-amber-50 text-amber-700 border-amber-100',
 ],
 'indigo' => [
 'iconBox' => 'bg-indigo-50 text-indigo-600 border-indigo-100 group-hover:bg-indigo-500',
 'soft' => 'bg-indigo-50 text-indigo-700 border-indigo-100',
 ],
 'gray' => [
 'iconBox' => 'bg-slate-50 text-slate-600 border-slate-100 group-hover:bg-slate-500',
 'soft' => 'bg-slate-50 text-slate-700 border-slate-100',
 ],
 ];
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

         <a href="{{ route('admin.document-types.create') }}"
             class="group inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-cyan-600 text-white font-black shadow-lg shadow-cyan-100 hover:bg-cyan-700 hover:-translate-y-0.5 transition-all">

             <span class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                 <i class="fa-solid fa-plus"></i>
             </span>

             <span>Thêm loại tài liệu</span>
         </a>
     </div>

     <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
         <div
             class="group bg-white rounded-[28px] border border-cyan-100 p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-cyan-100/70 transition-all">
             <div class="flex items-center justify-between">
                 <div>
                     <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                         Tổng loại tài liệu
                     </p>

                     <h3 class="text-4xl font-black text-cyan-700 mt-2">
                         {{ number_format($totalTypes) }}
                     </h3>
                 </div>

                 <div
                     class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white transition">
                     <i class="fa-solid fa-folder-tree text-xl"></i>
                 </div>
             </div>
         </div>

         <div
             class="group bg-white rounded-[28px] border border-purple-100 p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-purple-100/70 transition-all">
             <div class="flex items-center justify-between">
                 <div>
                     <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                         Tổng tài liệu
                     </p>

                     <h3 class="text-4xl font-black text-purple-700 mt-2">
                         {{ number_format($totalDocuments) }}
                     </h3>
                 </div>

                 <div
                     class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center group-hover:bg-purple-500 group-hover:text-white transition">
                     <i class="fa-solid fa-file-lines text-xl"></i>
                 </div>
             </div>
         </div>

         <div
             class="group bg-white rounded-[28px] border border-emerald-100 p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-100/70 transition-all">
             <div class="flex items-center justify-between">
                 <div>
                     <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                         Đang hiển thị
                     </p>

                     <h3 class="text-4xl font-black text-emerald-700 mt-2">
                         {{ number_format($documentTypes->count()) }}
                     </h3>
                 </div>

                 <div
                     class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition">
                     <i class="fa-solid fa-list-check text-xl"></i>
                 </div>
             </div>
         </div>
     </div>

     <div id="category-area" class="space-y-8">

         <div
             class="bg-white rounded-[34px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] overflow-hidden">
             <div
                 class="px-7 py-6 bg-gradient-to-r from-cyan-50 to-sky-50 border-b border-cyan-100 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                 <div class="flex items-start gap-4">
                     <div
                         class="w-14 h-14 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-100">
                         <i class="fa-solid fa-tags text-xl"></i>
                     </div>

                     <div>
                         <h2 class="text-2xl font-black text-slate-900">
                             Loại tài liệu hệ thống
                         </h2>

                         <p class="text-slate-500 font-semibold mt-1">
                             Danh sách loại tài liệu đang được quản lý trong hệ thống.
                         </p>
                     </div>
                 </div>

                 <span
                     class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-white text-cyan-700 text-sm font-black border border-cyan-100 shadow-sm">
                     {{ number_format($documentTypes->total()) }} loại tài liệu
                 </span>
             </div>

             <div class="p-5">
                 <form id="category-filter-form" action="{{ route('admin.document-types.index') }}" method="GET"
                     class="grid grid-cols-1 md:grid-cols-6 gap-4">

                     <div class="md:col-span-3 relative">
                         <i
                             class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-cyan-600"></i>

                         <input type="text" name="keyword" value="{{ request('keyword') }}"
                             placeholder="Tìm theo tên loại tài liệu..."
                             class="w-full h-12 pl-14 pr-5 rounded-xl bg-slate-50 border border-slate-200 outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700">
                     </div>

                     <select name="status"
                         class="h-12 px-4 rounded-xl bg-slate-50 border border-slate-200 outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700">
                         <option value="">Tất cả trạng thái</option>
                         <option value="1" @selected(request('status')==='1' )>Hoạt động</option>
                         <option value="0" @selected(request('status')==='0' )>Ngừng hoạt động</option>
                     </select>

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
         </div>

         <div
             class="bg-white rounded-[34px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] overflow-hidden">
             <div class="overflow-x-auto">
                 <table class="w-full text-left">
                     <thead class="bg-slate-50 border-b border-cyan-100">
                         <tr>
                             <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500">
                                 STT
                             </th>

                             <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500">
                                 <a href="{{ route('admin.document-types.index', array_merge(request()->query(), [
                                    'sort' => request('sort') === 'az' ? 'za' : 'az'
                                ])) }}"
                                     class="ajax-category-page inline-flex items-center gap-2 hover:text-cyan-700 transition">
                                     Loại tài liệu
                                     <i
                                         class="fa-solid fa-chevron-down text-xs transition {{ request('sort') === 'za' ? 'rotate-180' : '' }}"></i>
                                 </a>
                             </th>

                             <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500">
                                 Mô tả
                             </th>

                             <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500">
                                 Số tài liệu
                             </th>

                             <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500">
                                 Trạng thái
                             </th>

                             <th
                                 class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500 text-right">
                                 Hành động
                             </th>
                         </tr>
                     </thead>

                     <tbody class="divide-y divide-slate-100">
                         @forelse($documentTypes as $index => $type)
                         @php
                         $id = $type->document_type_id ?? $type->loai_id;
                         $name = $type->type_name ?? $type->ten_loai;
                         $description = $type->description ?? $type->mo_ta ?? 'Chưa có mô tả';
                         $count = $type->documents_count ?? $type->tai_lieus_count ?? 0;
                         $isActive = (bool) ($type->is_active ?? true);
                         $icon = $type->icon ?: 'fa-solid fa-file-lines';
                         $typeColor = $type->color ?: 'cyan';
                         $theme = $colorMap[$typeColor] ?? $colorMap['cyan'];
                         @endphp

                         <tr class="group hover:bg-slate-50/80 transition">
                             <td class="px-6 py-5 text-sm font-bold text-slate-500">
                                 {{ $documentTypes->firstItem() + $index }}
                             </td>

                             <td class="px-6 py-5">
                                 <div class="flex items-center gap-4 min-w-[240px]">
                                     <div
                                         class="w-12 h-12 rounded-2xl {{ $theme['iconBox'] }} flex items-center justify-center border group-hover:text-white transition">
                                         <i class="{{ $icon }} fa-fw"></i>
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
                                     class="inline-flex items-center whitespace-nowrap px-4 py-2 rounded-full {{ $theme['soft'] }} text-xs font-black border">
                                     {{ number_format($count) }} tài liệu
                                 </span>
                             </td>

                             <td class="px-6 py-5">
                                 @if($isActive)
                                 <span
                                     class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 text-emerald-600 text-xs font-black border border-emerald-100">
                                     <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                     Hoạt động
                                 </span>
                                 @else
                                 <span
                                     class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-50 text-red-500 text-xs font-black border border-red-100">
                                     <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                     Ngừng hoạt động
                                 </span>
                                 @endif
                             </td>

                             <td class="px-6 py-5">
                                 <div class="flex items-center justify-end gap-2">
                                     <a href="{{ route('admin.document-types.show', $id) }}"
                                         class="w-11 h-11 rounded-xl bg-cyan-50 text-cyan-600 hover:bg-cyan-500 hover:text-white inline-flex items-center justify-center shrink-0 transition"
                                         title="Xem chi tiết">
                                         <i class="fa-solid fa-eye fa-fw text-[16px] leading-none"></i>
                                     </a>

                                     <a href="{{ route('admin.document-types.edit', $id) }}"
                                         class="w-11 h-11 rounded-xl bg-amber-50 text-amber-500 hover:bg-amber-500 hover:text-white inline-flex items-center justify-center shrink-0 transition"
                                         title="Chỉnh sửa">
                                         <i class="fa-solid fa-pen fa-fw text-[16px] leading-none"></i>
                                     </a>

                                     <form action="{{ route('admin.document-types.status', $id) }}" method="POST"
                                         class="document-type-status-form m-0 p-0 inline-flex">
                                         @csrf
                                         @method('PATCH')

                                         <button type="submit"
                                             class="w-11 h-11 rounded-xl
                                                {{ $isActive
                                                    ? 'bg-orange-50 text-orange-500 hover:bg-orange-500'
                                                    : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-500' }}
                                                hover:text-white inline-flex items-center justify-center shrink-0 transition"
                                             title="{{ $isActive ? 'Ngừng hoạt động' : 'Kích hoạt lại' }}">

                                             @if($isActive)
                                             <i class="fa-solid fa-ban fa-fw text-[18px] leading-none"></i>
                                             @else
                                             <i class="fa-solid fa-rotate-left fa-fw text-[17px] leading-none"></i>
                                             @endif
                                         </button>
                                     </form>
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

                                 <div class="mt-6">
                                     <a href="{{ route('admin.document-types.create') }}"
                                         class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-cyan-600 text-white font-black hover:bg-cyan-700 transition">
                                         <i class="fa-solid fa-plus"></i>
                                         Thêm loại tài liệu
                                     </a>
                                 </div>
                             </td>
                         </tr>
                         @endforelse
                     </tbody>
                 </table>
             </div>
         </div>

         <div
             class="px-7 py-6 bg-white rounded-[30px] border border-cyan-100 flex flex-col md:flex-row items-center justify-between gap-5 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
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

 <script>
document.addEventListener('submit', async function(e) {
    const filterForm = e.target.closest('#category-filter-form');

    if (filterForm) {
        e.preventDefault();

        const url = filterForm.action + '?' + new URLSearchParams(new FormData(filterForm)).toString();

        await loadCategoryArea(url);
        return;
    }

    const statusForm = e.target.closest('.document-type-status-form');

    if (statusForm) {
        e.preventDefault();

        await submitDocumentTypeStatus(statusForm);
        return;
    }
});

document.addEventListener('click', async function(e) {
    const link = e.target.closest('.ajax-category-page, #reset-category-filter');

    if (!link) return;

    e.preventDefault();

    await loadCategoryArea(link.href);
});

async function submitDocumentTypeStatus(form) {
    const area = document.getElementById('category-area');
    const button = form.querySelector('button[type="submit"]');

    if (!area) return;

    area.classList.add('opacity-50', 'pointer-events-none');

    if (button) {
        button.disabled = true;
        button.classList.add('opacity-60', 'cursor-not-allowed');
    }

    try {
        await fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        await loadCategoryArea(window.location.href);
    } catch (error) {
        console.error(error);
    } finally {
        area.classList.remove('opacity-50', 'pointer-events-none');

        if (button) {
            button.disabled = false;
            button.classList.remove('opacity-60', 'cursor-not-allowed');
        }
    }
}

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
    } catch (error) {
        console.error(error);
    } finally {
        area.classList.remove('opacity-50', 'pointer-events-none');
    }
}
 </script>

 @endsection