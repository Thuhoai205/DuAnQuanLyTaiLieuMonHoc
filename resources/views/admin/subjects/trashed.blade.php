@extends('layouts.admin')

@section('title', 'Môn học đã xóa')
@section('page-title', 'Môn học đã xóa')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h2 class="text-2xl font-extrabold text-slate-900">
                    Môn học đã xóa
                </h2>

                <p class="mt-2 text-sm font-medium text-slate-500">
                    Danh sách các môn học đã bị xóa mềm và có thể khôi phục.
                </p>

            </div>

            <a href="{{ route('admin.subjects.index') }}"
                class="inline-flex items-center gap-2 h-11 px-5 rounded-xl border border-slate-300 bg-white text-slate-700 text-sm font-semibold hover:bg-slate-900 hover:text-white transition">

                <i class="fa-solid fa-arrow-left"></i>

                Quay lại

            </a>

        </div>

    </div>

    <form action="{{ route('admin.subjects.restoreMultiple') }}" method="POST" id="restore-multiple-form">

        @csrf

    </form>

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">

            <span
                class="inline-flex items-center px-4 py-2 rounded-full bg-amber-50 border border-amber-200 text-amber-700 text-sm font-semibold">

                {{ $subjects->total() }} môn học

            </span>

            <button type="submit" form="restore-multiple-form" id="restore-selected-btn" disabled
                class="inline-flex items-center gap-2 h-11 px-5 rounded-xl bg-emerald-500 text-white text-sm font-semibold opacity-50 disabled:cursor-not-allowed">

                <i class="fa-solid fa-rotate-left"></i>

                Khôi phục đã chọn

            </button>

        </div>

        <table class="w-full">

            <thead class="bg-slate-50 border-b border-slate-200">

                <tr>

                    <th class="w-14 text-center py-4">

                        <input type="checkbox" id="check-all" class="w-5 h-5 rounded accent-amber-500">

                    </th>

                    <th class="text-left px-6 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500">

                        Môn học

                    </th>

                    <th class="text-left px-6 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500">

                        Khoa

                    </th>

                    <th class="text-left px-6 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500">

                        Trạng thái

                    </th>

                    <th class="text-left px-6 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500">

                        Xóa lúc

                    </th>

                    <th class="text-right px-6 py-4 text-xs font-semibold uppercase tracking-wide text-slate-500">

                        Hành động

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($subjects as $subject)

                <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                    <td class="text-center">

                        <input type="checkbox" class="subject-checkbox w-5 h-5 accent-amber-500" name="subject_codes[]"
                            value="{{ $subject->subject_code }}" form="restore-multiple-form">

                    </td>

                    <td class="px-6 py-5">

                        <div class="flex items-center gap-4">

                            <div
                                class="w-11 h-11 rounded-md bg-emerald-500 text-white flex items-center justify-center shadow-sm">

                                <i class="fa-solid fa-book-open"></i>

                            </div>

                            <div>

                                <p class="font-bold text-slate-800">

                                    {{ $subject->subject_name }}

                                </p>

                                <p class="text-xs text-slate-500">

                                    {{ $subject->subject_code }}

                                </p>

                            </div>

                        </div>

                    </td>

                    <td class="px-6 py-5">

                        {{ $subject->faculty->faculty_name ?? '-' }}

                    </td>

                    <td class="px-6 py-5">

                        <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold">

                            {{ $subject->status == 'active' ? 'Hoạt động' : 'Lưu trữ' }}

                        </span>

                    </td>

                    <td class="px-6 py-5 text-sm text-slate-500">

                        {{ $subject->deleted_at->format('d/m/Y H:i') }}

                    </td>

                    <td class="px-6 py-5 text-right">

                        <form action="{{ route('admin.subjects.restore',$subject->subject_code) }}" method="POST"
                            class="inline-block">

                            @csrf
                            @method('PATCH')

                            <button
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-500 text-white text-sm font-semibold hover:bg-emerald-600">

                                <i class="fa-solid fa-rotate-left"></i>

                                Khôi phục

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="py-20 text-center">

                        <div class="mx-auto w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center">

                            <i class="fa-solid fa-book-open text-2xl text-slate-400"></i>

                        </div>

                        <h3 class="mt-5 text-lg font-bold text-slate-700">

                            Không có môn học đã xóa

                        </h3>

                        <p class="mt-2 text-sm text-slate-500">

                            Danh sách hiện đang trống.

                        </p>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        <div class="p-4">

            {{ $subjects->links() }}

        </div>

    </div>

</div>

@endsection