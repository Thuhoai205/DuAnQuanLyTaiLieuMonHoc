@extends('layouts.admin')

@section('title', 'Loại tài liệu đã xóa')
@section('page-title', 'Loại tài liệu đã xóa')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>
                <h2 class="text-lg font-black text-slate-700">
                    Loại tài liệu đã xóa
                </h2>

                <p class="text-sm text-slate-500 font-semibold mt-1">
                    Danh sách loại tài liệu đã bị xóa mềm. Có thể khôi phục khi cần.
                </p>
            </div>

            <a href="{{ route('admin.document-types.index') }}" class="inline-flex items-center gap-2 h-11 px-4 rounded-md bg-white border border-slate-200
                      text-slate-600 text-sm font-black hover:bg-slate-100 transition">

                <i class="fa-solid fa-arrow-left"></i>
                <span>Quay lại</span>
            </a>

        </div>
    </div>

    <!-- RESTORE MULTIPLE FORM -->
    <form action="{{ route('admin.document-types.restoreMultiple') }}" method="POST" id="restore-multiple-form">
        @csrf
    </form>

    <!-- TABLE -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">

        <!-- HEADER -->
        <div class="px-5 py-4 border-b border-slate-200 flex justify-between items-center">

            <div>
                <h2 class="text-sm font-black text-slate-700">
                    Danh sách loại tài liệu đã xóa
                </h2>

                <p class="text-xs text-slate-400 font-semibold mt-1">
                    Các loại tài liệu trong thùng rác
                </p>
            </div>

            <span class="px-3 py-1 rounded bg-red-50 text-red-500 text-xs font-black border border-red-100">
                {{ $documentTypes->total() }} loại
            </span>

        </div>

        <!-- TABLE -->
        <table class="w-full text-left">

            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>

                    <!-- CHECK ALL -->
                    <th class="px-5 py-4 w-12">
                        <input type="checkbox" id="check-all" class="w-5 h-5 accent-emerald-500">
                    </th>

                    <th class="px-5 py-4 text-xs font-black uppercase text-slate-500">
                        Loại tài liệu
                    </th>

                    <th class="px-5 py-4 text-xs font-black uppercase text-slate-500">
                        Số tài liệu
                    </th>

                    <th class="px-5 py-4 text-xs font-black uppercase text-slate-500">
                        Trạng thái
                    </th>

                    <th class="px-5 py-4 text-xs font-black uppercase text-slate-500">
                        Thời gian xóa
                    </th>

                    <th class="px-5 py-4 text-xs font-black uppercase text-slate-500 text-right">
                        Hành động
                    </th>

                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($documentTypes as $type)

                <tr class="hover:bg-slate-50 transition">

                    <!-- CHECKBOX -->
                    <td class="px-5 py-4">
                        <input type="checkbox" name="document_type_ids[]" value="{{ $type->document_type_id }}"
                            form="restore-multiple-form" class="w-5 h-5 accent-emerald-500">
                    </td>

                    <!-- NAME -->
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-md bg-sky-50 flex items-center justify-center">
                                <i class="fa-solid fa-file-lines text-sky-600"></i>
                            </div>

                            <div>
                                <p class="font-black text-slate-700">
                                    {{ $type->type_name }}
                                </p>

                                <p class="text-xs text-slate-400">
                                    ID: {{ $type->document_type_id }}
                                </p>
                            </div>

                        </div>
                    </td>

                    <!-- COUNT -->
                    <td class="px-5 py-4 text-sm font-semibold text-slate-600">
                        {{ $type->documents_count ?? 0 }}
                    </td>

                    <!-- STATUS -->
                    <td class="px-5 py-4">
                        <span class="px-3 py-1 rounded bg-red-50 text-red-500 text-xs font-black">
                            Đã xóa
                        </span>
                    </td>

                    <!-- DELETED AT -->
                    <td class="px-5 py-4 text-sm text-slate-500 font-semibold">
                        {{ $type->deleted_at ? $type->deleted_at->format('d/m/Y H:i') : '---' }}
                    </td>

                    <!-- ACTION -->
                    <td class="px-5 py-4">
                        <div class="flex justify-end gap-2">

                            <!-- RESTORE -->
                            <form action="{{ route('admin.document-types.restore', $type->document_type_id) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')

                                <button class="h-9 px-3 rounded-md bg-emerald-50 text-emerald-600
                                               hover:bg-emerald-500 hover:text-white transition">
                                    <i class="fa-solid fa-rotate-left"></i>
                                </button>
                            </form>

                            <!-- FORCE DELETE -->
                            <form action="{{ route('admin.document-types.forceDelete', $type->document_type_id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Xóa vĩnh viễn loại tài liệu này?')" class="h-9 px-3 rounded-md bg-red-50 text-red-500
                                               hover:bg-red-500 hover:text-white transition">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="px-5 py-14 text-center text-slate-500">
                        Không có loại tài liệu đã xóa
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

        <!-- PAGINATION -->
        @if($documentTypes->hasPages())
        <div class="px-5 py-4 border-t border-slate-200">
            {{ $documentTypes->links() }}
        </div>
        @endif

    </div>

</div>

@endsection