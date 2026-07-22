@extends('layouts.admin')

@section('title', 'Khoa đã xóa')
@section('page-title', 'Khoa đã xóa')

@section('content')
<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h2 class="text-2xl font-extrabold text-slate-900">

                    Khoa đã xóa

                </h2>

                <p class="mt-2 text-sm font-medium text-slate-500">

                    Danh sách các khoa đã bị xóa mềm và có thể khôi phục bất cứ lúc nào.

                </p>

            </div>

            <a href="{{ route('admin.faculties.index') }}" class="inline-flex items-center gap-2
                h-11
                px-5
                rounded-xl
                border border-slate-200
                bg-white
                text-slate-700
                text-sm
                font-semibold
                hover:bg-amber-50
                hover:border-amber-300
                hover:text-amber-600
                transition-all duration-300">

                <i class="fa-solid fa-arrow-left"></i>

                <span>Quay lại</span>

            </a>

        </div>

    </div>

    <!-- FORM -->
    <form action="{{ route('admin.faculties.restoreMultiple') }}" method="POST" id="restore-multiple-form">

        @csrf

    </form>

    <!-- TABLE -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

        <!-- TABLE HEADER -->
        <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">

            <div>

                <h3 class="text-lg font-bold text-slate-800">

                    Danh sách khoa đã xóa

                </h3>

                <p class="mt-1 text-sm font-medium text-slate-500">

                    Các khoa hiện đang nằm trong thùng rác của hệ thống.

                </p>

            </div>

            <span class="inline-flex items-center
                px-4 py-2
                rounded-xl
                bg-red-50
                border border-red-100
                text-red-600
                text-sm
                font-bold">

                {{ number_format($faculties->total()) }} khoa

            </span>

        </div>

        <table class="w-full">

            <thead class="bg-slate-50 border-b border-slate-200">

                <tr>

                    <th class="px-6 py-4 w-14">
                        <input type="checkbox" id="check-all" class="w-5 h-5 rounded border-slate-300 accent-amber-500">
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                        Khoa
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                        Trạng thái
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                        Thời gian xóa
                    </th>

                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                        Hành động
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-slate-100">
                @forelse($faculties as $faculty)

                <tr class="hover:bg-slate-50 transition-all duration-300">

                    <!-- CHECKBOX -->
                    <td class="px-6 py-5">

                        <input type="checkbox" name="faculty_ids[]" value="{{ $faculty->faculty_id }}"
                            form="restore-multiple-form" class="w-5 h-5 rounded border-slate-300 accent-amber-500">

                    </td>

                    <!-- FACULTY -->
                    <td class="px-6 py-5">

                        <div class="flex items-center gap-4">

                            <div class="w-11 h-11 rounded-xl
                                bg-amber-50
                                text-amber-600
                                flex items-center justify-center">

                                <i class="fa-solid fa-building-columns text-lg"></i>

                            </div>

                            <div>

                                <h4 class="text-sm font-bold text-slate-800">

                                    {{ $faculty->faculty_name }}

                                </h4>

                                <p class="mt-1 text-xs font-medium text-slate-500">

                                    {{ $faculty->faculty_code }}

                                </p>

                            </div>

                        </div>

                    </td>

                    <!-- STATUS -->
                    <td class="px-6 py-5">

                        <span class="inline-flex items-center gap-2
                            px-3 py-1.5
                            rounded-full
                            bg-red-50
                            border border-red-100
                            text-red-600
                            text-xs
                            font-bold">

                            <span class="w-2 h-2 rounded-full bg-red-500"></span>

                            Đã xóa

                        </span>

                    </td>

                    <!-- DELETE TIME -->
                    <td class="px-6 py-5">

                        <div>

                            <p class="text-sm font-semibold text-slate-700">

                                {{ optional($faculty->deleted_at)->format('d/m/Y') }}

                            </p>

                            <p class="text-xs text-slate-400 mt-1">

                                {{ optional($faculty->deleted_at)->format('H:i') }}

                            </p>

                        </div>

                    </td>

                    <!-- ACTION -->
                    <td class="px-6 py-5">

                        <div class="flex items-center justify-end gap-2">

                            <!-- Khôi phục -->
                            <form action="{{ route('admin.faculties.restore', $faculty->faculty_id) }}" method="POST">

                                @csrf
                                @method('PATCH')

                                <button type="submit" class="w-10 h-10
                                    rounded-xl
                                    border border-emerald-200
                                    bg-emerald-50
                                    text-emerald-600
                                    hover:bg-emerald-500
                                    hover:text-white
                                    hover:border-emerald-500
                                    transition-all duration-300
                                    flex items-center justify-center">

                                    <i class="fa-solid fa-rotate-left"></i>

                                </button>

                            </form>



                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="px-6 py-20 text-center">

                        <div class="w-20 h-20 mx-auto
                            rounded-2xl
                            bg-slate-100
                            text-slate-400
                            flex items-center justify-center">

                            <i class="fa-solid fa-building-columns text-3xl"></i>

                        </div>

                        <h3 class="mt-5 text-lg font-bold text-slate-700">

                            Không có khoa nào

                        </h3>

                        <p class="mt-2 text-sm font-medium text-slate-500">

                            Hiện tại chưa có khoa nào trong thùng rác.

                        </p>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>
        @if($faculties->hasPages())

        <div class="px-6 py-5 border-t border-slate-200 bg-slate-50">

            <div class="flex flex-col md:flex-row items-center justify-between gap-4">

                <p class="text-sm font-medium text-slate-500">

                    Hiển thị

                    <span class="font-bold text-slate-800">
                        {{ $faculties->firstItem() ?? 0 }}
                    </span>

                    -

                    <span class="font-bold text-slate-800">
                        {{ $faculties->lastItem() ?? 0 }}
                    </span>

                    trong tổng

                    <span class="font-bold text-slate-800">
                        {{ $faculties->total() }}
                    </span>

                    khoa

                </p>

                <div>

                    {{ $faculties->onEachSide(1)->links() }}

                </div>

            </div>

        </div>

        @endif

    </div>

</div>












@endsection