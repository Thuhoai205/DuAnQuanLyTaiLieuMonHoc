@extends('layouts.admin')

@section('title', 'Loại tài liệu đã xóa')
@section('page-title', 'Loại tài liệu đã xóa')

@section('content')
<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h2 class="text-2xl font-black text-slate-800">

                    Thùng rác loại tài liệu

                </h2>

                <p class="mt-2 text-sm text-slate-500">

                    Quản lý các loại tài liệu đã bị xóa mềm và có thể khôi phục khi cần.

                </p>

            </div>

            <a href="{{ route('admin.document-types.index') }}" class="inline-flex
                items-center
                gap-2
                h-11
                px-5
                rounded-xl
                border
                border-slate-200
                bg-white
                text-slate-700
                text-sm
                font-semibold
                hover:bg-slate-50
                transition-all
                duration-300">

                <i class="fa-solid fa-arrow-left"></i>

                Quay lại

            </a>

        </div>

    </div>

    <!-- RESTORE MULTIPLE FORM -->
    <form action="{{ route('admin.document-types.restoreMultiple') }}" method="POST" id="restore-multiple-form">

        @csrf

    </form>

    <!-- TABLE CARD -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        <!-- CARD HEADER -->
        <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">

            <div>

                <h2 class="text-base font-black text-slate-800">

                    Danh sách loại tài liệu đã xóa

                </h2>

                <p class="mt-1 text-sm text-slate-500">

                    Các loại tài liệu đang nằm trong thùng rác.

                </p>

            </div>

            <span class="inline-flex
                items-center
                rounded-full
                border
                border-red-100
                bg-red-50
                px-4
                py-2
                text-sm
                font-bold
                text-red-600">

                <i class="fa-solid fa-trash-can mr-2"></i>

                {{ $documentTypes->total() }} loại

            </span>

        </div>
        <!-- TABLE -->
        <table class="w-full text-left">

            <!-- TABLE HEADER -->
            <thead class="bg-slate-50/80 border-b border-slate-200">

                <tr>

                    <!-- CHECKBOX -->
                    <th class="w-14 px-6 py-4">

                        <input type="checkbox" id="check-all" class="w-5 h-5 rounded border-slate-300 accent-amber-500">

                    </th>

                    <!-- DOCUMENT TYPE -->
                    <th class="px-6 py-4 text-[13px] font-black uppercase tracking-wide text-slate-600">

                        Loại tài liệu

                    </th>

                    <!-- DOCUMENT COUNT -->
                    <th class="px-6 py-4 text-[13px] font-black uppercase tracking-wide text-slate-600">

                        Số tài liệu

                    </th>

                    <!-- STATUS -->
                    <th class="px-6 py-4 text-[13px] font-black uppercase tracking-wide text-slate-600">

                        Trạng thái

                    </th>

                    <!-- DELETED TIME -->
                    <th class="px-6 py-4 text-[13px] font-black uppercase tracking-wide text-slate-600">

                        Thời gian xóa

                    </th>

                    <!-- ACTION -->
                    <th class="px-6 py-4 text-right text-[13px] font-black uppercase tracking-wide text-slate-600">

                        Hành động

                    </th>

                </tr>

            </thead>

            <!-- TABLE BODY -->
            <tbody class="divide-y divide-slate-100">

                @forelse($documentTypes as $type)

                <tr class="hover:bg-amber-50/40 transition-all duration-300">


                    <!-- CHECKBOX -->
                    <td class="px-6 py-5">

                        <input type="checkbox" name="document_type_ids[]" value="{{ $type->document_type_id }}"
                            form="restore-multiple-form" class="w-5 h-5 rounded accent-amber-500">

                    </td>

                    <!-- LOẠI TÀI LIỆU -->
                    <td class="px-6 py-5">

                        <div class="flex items-center gap-4">

                            <!-- ICON -->
                            <div class="w-11
            h-11
            rounded-xl
            bg-amber-50
            flex
            items-center
            justify-center">

                                <i class="{{ $type->icon ?? 'fa-solid fa-file-lines' }} text-amber-600"></i>

                            </div>

                            <!-- INFO -->
                            <div>

                                <h4 class="text-sm font-black text-slate-800">

                                    {{ $type->type_name }}

                                </h4>

                                <p class="mt-1 text-xs font-medium text-slate-500">

                                    ID: {{ $type->document_type_id }}

                                </p>

                            </div>

                        </div>

                    </td>

                    <!-- SỐ TÀI LIỆU -->
                    <td class="px-6 py-5">

                        <span class="inline-flex
        items-center
        rounded-full
        bg-slate-100
        px-3
        py-1
        text-xs
        font-bold
        text-slate-700">

                            {{ number_format($type->documents_count ?? 0) }}

                            tài liệu

                        </span>

                    </td>

                    <!-- TRẠNG THÁI -->
                    <td class="px-6 py-5">

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

                            Đã xóa

                        </span>

                    </td>

                    <!-- THỜI GIAN XÓA -->
                    <td class="px-6 py-5">

                        <span class="text-sm font-medium text-slate-600">

                            {{ optional($type->deleted_at)->format('d/m/Y H:i') }}

                        </span>

                    </td>


                    <!-- HÀNH ĐỘNG -->
                    <td class="px-6 py-5">

                        <div class="flex justify-end gap-2">

                            <!-- KHÔI PHỤC -->
                            <form action="{{ route('admin.document-types.restore', $type->document_type_id) }}"
                                method="POST" class="restore-document-type-form">

                                @csrf
                                @method('PATCH')

                                <button type="submit" class="inline-flex
                items-center
                justify-center
                w-10
                h-10
                rounded-xl
                bg-emerald-50
                text-emerald-600
                hover:bg-emerald-500
                hover:text-white
                transition-all
                duration-300">

                                    <i class="fa-solid fa-rotate-left"></i>

                                </button>

                            </form>



                        </div>

                    </td>

                </tr>

                @empty
                <tr>

                    <td colspan="6" class="px-6 py-20 text-center">

                        <div class="flex flex-col items-center">

                            <!-- ICON -->
                            <div class="w-20
                h-20
                rounded-full
                bg-red-50
                flex
                items-center
                justify-center">

                                <i class="fa-solid fa-trash-can text-3xl text-red-400"></i>

                            </div>

                            <!-- TITLE -->
                            <h3 class="mt-5 text-lg font-black text-slate-800">

                                Không có loại tài liệu đã xóa

                            </h3>

                            <!-- DESCRIPTION -->
                            <p class="mt-2 text-sm font-medium text-slate-500">

                                Hiện tại chưa có loại tài liệu nào trong thùng rác.

                            </p>

                            <!-- BUTTON -->
                            <a href="{{ route('admin.document-types.index') }}" class="mt-6
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
                transition-all
                duration-300">

                                <i class="fa-solid fa-arrow-left"></i>

                                Quay lại danh sách

                            </a>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        {{-- PAGINATION --}}
        @if($documentTypes->hasPages())

        <div class="px-6
    py-5
    border-t
    border-slate-200
    bg-slate-50">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                <p class="text-sm font-semibold text-slate-500">

                    Hiển thị

                    <span class="font-black text-amber-500">

                        {{ $documentTypes->firstItem() }}

                    </span>

                    -

                    <span class="font-black text-amber-500">

                        {{ $documentTypes->lastItem() }}

                    </span>

                    trong tổng số

                    <span class="font-black text-amber-500">

                        {{ $documentTypes->total() }}

                    </span>

                    loại tài liệu

                </p>

                <div>

                    {{ $documentTypes->links() }}

                </div>

            </div>

        </div>

        @endif

    </div>

</div>

@endsection