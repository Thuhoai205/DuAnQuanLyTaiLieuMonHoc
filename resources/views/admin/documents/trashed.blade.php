@extends('layouts.admin')

@section('title', 'Tài liệu đã xóa')
@section('page-title', 'Tài liệu đã xóa')

@section('content')
@if(session('success'))
<div class="mb-5 rounded-md border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-700">
    <div class="flex items-center gap-3">
        <i class="fa-solid fa-circle-check text-lg"></i>
        <span class="font-semibold">{{ session('success') }}</span>
    </div>
</div>
@endif

@if(session('error'))
<div class="mb-5 rounded-md border border-red-200 bg-red-50 px-5 py-4 text-red-700">
    <div class="flex items-center gap-3">
        <i class="fa-solid fa-circle-exclamation text-lg"></i>
        <span class="font-semibold">{{ session('error') }}</span>
    </div>
</div>
@endif
<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h2 class="text-lg font-black text-slate-700">
                    Tài liệu đã xóa
                </h2>

                <p class="text-sm text-slate-500 font-semibold mt-1">
                    Danh sách tài liệu đã bị xóa mềm. Có thể khôi phục khi cần.
                </p>

            </div>

            <a href="{{ route('admin.documents.index') }}"
                class="inline-flex items-center gap-2 h-11 px-4 rounded-md bg-white border border-slate-200 text-slate-600 text-sm font-black hover:bg-slate-100 transition">

                <i class="fa-solid fa-arrow-left"></i>
                <span>Quay lại</span>

            </a>

        </div>

    </div>

    <!-- RESTORE MULTIPLE -->
    <form action="{{ route('admin.documents.restoreMultiple') }}" method="POST" id="restore-multiple-form">
        @csrf
    </form>

    <!-- TABLE -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">

        <!-- HEADER -->
        <div class="px-5 py-4 border-b border-slate-200 flex justify-between items-center">

            <div>

                <h2 class="text-sm font-black text-slate-700">
                    Danh sách tài liệu đã xóa
                </h2>

                <p class="text-xs text-slate-400 font-semibold mt-1">
                    Các tài liệu đang nằm trong thùng rác.
                </p>

            </div>

            <span class="px-3 py-1 rounded bg-red-50 text-red-500 text-xs font-black border border-red-100">

                {{ $documents->total() }} tài liệu

            </span>

        </div>
        <table class="w-full">

            <thead class="bg-slate-50 border-b border-slate-200">

                <tr>

                    <th class="px-5 py-4 w-12">
                        <input type="checkbox" id="check-all" class="w-5 h-5 accent-emerald-500">
                    </th>

                    <th class="px-5 py-4 text-xs font-black uppercase text-slate-500">
                        Tài liệu
                    </th>

                    <th class="px-5 py-4 text-xs font-black uppercase text-slate-500">
                        Người tải lên
                    </th>

                    <th class="px-5 py-4 text-xs font-black uppercase text-slate-500">
                        Trạng thái
                    </th>

                    <th class="px-5 py-4 text-xs font-black uppercase text-slate-500">
                        Thời gian xóa
                    </th>

                    <th class="px-5 py-4 text-right text-xs font-black uppercase text-slate-500">
                        Hành động
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($documents as $document)
                <tr class="hover:bg-slate-50 transition">

                    <!-- CHECKBOX -->
                    <td class="px-5 py-4">

                        <input type="checkbox" name="document_ids[]" value="{{ $document->document_id }}"
                            form="restore-multiple-form" class="w-5 h-5 accent-emerald-500">

                    </td>

                    <td class="px-5 py-4">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-md bg-sky-50 flex items-center justify-center">

                                <i class="fa-solid fa-file-lines text-sky-600"></i>

                            </div>

                            <div>

                                <p class="font-black text-slate-700">

                                    {{ $document->title }}

                                </p>

                                <p class="text-xs text-slate-400">

                                    {{ $document->subject->subject_name ?? '-' }}

                                </p>

                            </div>

                        </div>

                    </td>

                    <td class="px-5 py-4 text-sm font-semibold text-slate-600">

                        {{ $document->uploader->full_name ?? '-' }}

                    </td>

                    <td class="px-5 py-4">

                        <span class="px-3 py-1 rounded bg-red-50 text-red-500 text-xs font-black">

                            Đã xóa

                        </span>

                    </td>
                    <td class="px-5 py-4 text-sm text-slate-500 font-semibold">

                        {{ optional($document->deleted_at)->format('d/m/Y H:i') }}

                    </td>
                    <!-- ACTION -->
                    <td class="px-5 py-4">

                        <div class="flex justify-end gap-2">

                            <!-- Restore -->
                            <form action="{{ route('admin.documents.restore',$document->document_id) }}" method="POST">

                                @csrf
                                @method('PATCH')

                                <button
                                    class="h-9 px-3 rounded-md bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white transition">

                                    <i class="fa-solid fa-rotate-left"></i>

                                </button>

                            </form>



                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="px-5 py-16 text-center text-slate-500">

                        <i class="fa-solid fa-file-circle-xmark text-5xl mb-3"></i>

                        <p>Không có tài liệu nào trong thùng rác.</p>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        @if($documents->hasPages())

        <div class="px-5 py-4 border-t border-slate-200">

            {{ $documents->links() }}

        </div>

        @endif
    </div>

</div>

@endsection