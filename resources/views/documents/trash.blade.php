@extends('layouts.app')

@section('title', 'Thùng rác')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Alert --}}
    @if(session('success'))
    <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-circle-check text-lg"></i>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-700">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-circle-exclamation text-lg"></i>
            <span class="font-semibold">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <!-- Header -->
    <div class="mb-8 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

        <div>

            <h1 class="text-4xl font-black text-slate-900">

                Thùng rác

            </h1>

            <p class="mt-3 text-slate-500 leading-7">

                Danh sách các tài liệu đã xóa. Bạn có thể khôi phục hoặc xóa vĩnh viễn.

            </p>

        </div>

        <a href="{{ route('documents.my-documents') }}"
            class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-5 py-3 font-semibold text-slate-700 transition hover:bg-slate-100">

            <i class="fa-solid fa-arrow-left"></i>

            Quay lại

        </a>

    </div>

    <!-- Card -->
    <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

        <!-- Header -->
        <div class="flex items-center justify-between border-b border-slate-200 bg-slate-50 px-6 py-5">

            <div>

                <h3 class="text-lg font-black text-slate-800">

                    Danh sách tài liệu đã xóa

                </h3>

                <p class="mt-1 text-sm text-slate-500">

                    Các tài liệu chỉ thuộc tài khoản của bạn.

                </p>

            </div>

            <span class="rounded-full bg-red-100 px-4 py-2 text-sm font-bold text-red-600">

                {{ $documents->total() }} tài liệu

            </span>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="border-b border-slate-200 bg-slate-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">

                            Tài liệu

                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">

                            Môn học

                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">

                            Đã xóa lúc

                        </th>

                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">

                            Trạng thái

                        </th>

                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">

                            Hành động

                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($documents as $document)

                    <tr class="transition hover:bg-slate-50">

                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100">

                                    <i class="fa-solid fa-file-lines text-amber-600"></i>

                                </div>

                                <div>

                                    <p class="font-bold text-slate-800">

                                        {{ $document->title }}

                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">

                                        {{ Str::limit($document->description,60) }}

                                    </p>

                                </div>

                            </div>

                        </td>

                        <td class="px-6 py-5">

                            <span class="font-medium text-slate-700">

                                {{ $document->subject->subject_name ?? '-' }}

                            </span>

                        </td>

                        <td class="px-6 py-5">

                            <span class="text-sm text-slate-500">

                                {{ optional($document->deleted_at)->format('d/m/Y H:i') }}

                            </span>

                        </td>

                        <td class="px-6 py-5 text-center">

                            <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-600">

                                Đã xóa

                            </span>

                        </td>

                        <td class="px-6 py-5">

                            <div class="flex justify-end gap-2">

                                {{-- Restore --}}
                                <form action="{{ route('documents.restore',$document->document_id) }}" method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        class="inline-flex items-center gap-2 rounded-xl bg-green-100 px-4 py-2 text-sm font-semibold text-green-700 transition hover:bg-green-600 hover:text-white">

                                        <i class="fa-solid fa-rotate-left"></i>

                                        Khôi phục

                                    </button>

                                </form>


                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="py-16 text-center">

                            <i class="fa-solid fa-trash-can text-5xl text-slate-300"></i>

                            <p class="mt-4 text-lg font-semibold text-slate-600">

                                Thùng rác đang trống

                            </p>

                            <p class="mt-2 text-sm text-slate-400">

                                Không có tài liệu nào đã bị xóa.

                            </p>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        @if($documents->hasPages())

        <div class="border-t border-slate-200 bg-slate-50 px-6 py-5">

            {{ $documents->links() }}

        </div>

        @endif

    </div>

</div>

@endsection