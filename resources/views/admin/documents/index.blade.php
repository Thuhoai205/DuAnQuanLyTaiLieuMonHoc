@extends('layouts.admin')

@section('title', 'Quản lý tài liệu')
@section('page-title', 'Quản lý tài liệu')

@section('content')

<div class="space-y-6">


    <!-- THỐNG KÊ -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-xs uppercase font-bold text-slate-400">
                        Tổng tài liệu
                    </p>

                    <h3 class="text-2xl font-black text-slate-700 mt-2">
                        {{ number_format($totalDocuments) }}
                    </h3>
                </div>

                <div class="w-11 h-11 rounded-md bg-purple-500 text-white flex items-center justify-center">
                    <i class="fa-solid fa-file-lines"></i>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-xs uppercase font-bold text-slate-400">
                        Lượt tải
                    </p>

                    <h3 class="text-2xl font-black text-slate-700 mt-2">
                        {{ number_format($totalDownloads) }}
                    </h3>
                </div>

                <div class="w-11 h-11 rounded-md bg-rose-500 text-white flex items-center justify-center">
                    <i class="fa-solid fa-download"></i>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-xs uppercase font-bold text-slate-400">
                        Đang hoạt động
                    </p>

                    <h3 class="text-2xl font-black text-slate-700 mt-2">
                        {{ \App\Models\Document::where('is_active',1)->count() }}
                    </h3>
                </div>

                <div class="w-11 h-11 rounded-md bg-emerald-500 text-white flex items-center justify-center">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-xs uppercase font-bold text-slate-400">
                        Thùng rác
                    </p>

                    <h3 class="text-2xl font-black text-slate-700 mt-2">
                        {{ $totalTrashedDocuments }}
                    </h3>
                </div>

                <div class="w-11 h-11 rounded-md bg-orange-500 text-white flex items-center justify-center">
                    <i class="fa-solid fa-trash"></i>
                </div>
            </div>
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

                <h2 class="font-black text-slate-700">
                    Danh sách tài liệu
                </h2>

                <a href="{{ route('admin.documents.create') }}"
                    class="h-10 px-4 bg-sky-500 hover:bg-sky-600 text-white rounded-md text-sm font-black flex items-center">

                    <i class="fa-solid fa-plus mr-2"></i>
                    Thêm tài liệu

                </a>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-50 border-b">

                        <tr class="text-xs uppercase font-black text-slate-500">

                            <th class="px-5 py-3 text-center w-16">STT</th>
                            <th class="px-5 py-3">Tài liệu</th>
                            <th class="px-5 py-3">Môn học</th>
                            <th class="px-5 py-3">Loại</th>
                            <th class="px-5 py-3">Người đăng</th>
                            <th class="px-5 py-3 text-center">Lượt tải</th>
                            <th class="px-5 py-3 text-center">Trạng thái</th>
                            <th class="px-5 py-3 text-center">Thao tác</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($documents as $document)

                        <tr class="hover:bg-slate-50">

                            <td class="px-5 py-4 text-center">
                                {{ $documents->firstItem() + $loop->index }}
                            </td>

                            <td class="px-5 py-4">
                                <div class="font-black text-slate-700">
                                    {{ $document->title }}
                                </div>

                                <div class="text-xs text-slate-400 mt-1">
                                    {{ Str::limit($document->description,60) }}
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                {{ $document->subject->subject_name ?? '-' }}
                            </td>

                            <td class="px-5 py-4">
                                {{ $document->documentType->type_name ?? '-' }}
                            </td>

                            <td class="px-5 py-4 whitespace-nowrap">
                                {{ $document->uploader->full_name ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-center">
                                {{ number_format($document->download_count) }}
                            </td>

                            <td class="px-5 py-4 text-center">

                                @if($document->is_active)
                                <span class="px-3 py-1 rounded-md bg-emerald-50 text-emerald-600 text-xs font-black">
                                    Hoạt động
                                </span>
                                @else
                                <span class="px-3 py-1 rounded-md bg-red-50 text-red-500 text-xs font-black">
                                    Đã khóa
                                </span>
                                @endif

                            </td>

                            <td class="px-5 py-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.documents.show',$document->document_id) }}"
                                        class="w-9 h-9 rounded-md bg-sky-50 text-sky-600 flex items-center justify-center">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.documents.edit',$document->document_id) }}"
                                        class="w-9 h-9 rounded-md bg-amber-50 text-amber-600 flex items-center justify-center">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="8" class="py-10 text-center text-slate-500">
                                Chưa có tài liệu nào.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="p-5 border-t">
                {{ $documents->links() }}
            </div>

        </div>
    </div>


</div>

@endsection
@push('scripts')
<script>
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