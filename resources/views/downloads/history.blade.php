@extends('layouts.app')

@section('title', 'Lịch sử tải tài liệu')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-900">

                Lịch sử tải tài liệu

            </h1>

            <p class="mt-2 text-slate-500">

                Danh sách các tài liệu bạn đã tải xuống.

            </p>

        </div>

        <a href="{{ route('documents.index') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-amber-500 transition">

            <i class="fa-solid fa-arrow-left"></i>

            Quay lại

        </a>

    </div>

    <!-- CARD -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

            <h3 class="text-lg font-bold text-slate-900">

                Danh sách lịch sử tải

            </h3>

        </div>

        @if($histories->count())

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500">

                            STT

                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500">

                            Tài liệu

                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500">

                            Môn học

                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500">

                            Loại tài liệu

                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500">

                            Thời gian tải

                        </th>

                        <th class="px-6 py-4 text-center text-xs font-bold uppercase text-slate-500">

                            Thao tác

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($histories as $history)

                    <tr class="border-t border-slate-200 hover:bg-slate-50">

                        <td class="px-6 py-5">

                            {{ $loop->iteration + ($histories->currentPage()-1) * $histories->perPage() }}

                        </td>

                        <td class="px-6 py-5">

                            <div class="font-semibold text-slate-800">

                                {{ $history->version->document->title }}

                            </div>

                        </td>

                        <td class="px-6 py-5">

                            {{ $history->version->document->subject->subject_name }}

                        </td>

                        <td class="px-6 py-5">

                            <span
                                class="inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold text-sky-700">

                                {{ $history->version->document->documentType->type_name }}

                            </span>

                        </td>

                        <td class="px-6 py-5 text-slate-600">

                            {{ $history->downloaded_at->format('d/m/Y H:i') }}

                        </td>

                        <td class="px-6 py-5">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('documents.show',$history->version->document->document_id) }}"
                                    class="inline-flex items-center gap-2 rounded-lg bg-amber-500 px-4 py-2 text-xs font-semibold text-white hover:bg-amber-600">

                                    <i class="fa-solid fa-eye"></i>

                                    Xem

                                </a>

                                <a href="{{ route('documents.download',$history->version->document->document_id) }}"
                                    class="inline-flex items-center gap-2 rounded-lg bg-slate-900 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-700">

                                    <i class="fa-solid fa-download"></i>

                                    Tải

                                </a>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        @if($histories->hasPages())
        <div class="px-6 py-6 border-t border-slate-200">

            <div class="flex items-center justify-center gap-2">

                {{-- Previous --}}
                @if($histories->onFirstPage())

                <span
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 text-slate-300 cursor-not-allowed">

                    <i class="fa-solid fa-chevron-left"></i>

                </span>

                @else

                <a href="{{ $histories->previousPageUrl() }}"
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:border-slate-300 hover:bg-slate-100">

                    <i class="fa-solid fa-chevron-left"></i>

                </a>

                @endif

                {{-- Page Number --}}
                @foreach($histories->getUrlRange(1, $histories->lastPage()) as $page => $url)

                @if($page == $histories->currentPage())

                <span
                    class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-900 text-white font-bold shadow-md">

                    {{ $page }}

                </span>

                @else

                <a href="{{ $url }}"
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white font-semibold text-slate-600 transition hover:border-amber-300 hover:text-amber-600 hover:bg-amber-50">

                    {{ $page }}

                </a>

                @endif

                @endforeach

                {{-- Next --}}
                @if($histories->hasMorePages())

                <a href="{{ $histories->nextPageUrl() }}"
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:border-slate-300 hover:bg-slate-100">

                    <i class="fa-solid fa-chevron-right"></i>

                </a>

                @else

                <span
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 text-slate-300 cursor-not-allowed">

                    <i class="fa-solid fa-chevron-right"></i>

                </span>

                @endif

            </div>

        </div>
        @endif

        @else

        <div class="py-20 text-center">

            <div class="w-24 h-24 mx-auto rounded-full bg-slate-100 flex items-center justify-center">

                <i class="fa-solid fa-clock-rotate-left text-4xl text-slate-400"></i>

            </div>

            <h3 class="mt-6 text-2xl font-bold text-slate-900">

                Chưa có lịch sử tải

            </h3>

            <p class="mt-3 text-slate-500">

                Bạn chưa tải tài liệu nào.

            </p>

            <a href="{{ route('documents.index') }}"
                class="mt-8 inline-flex items-center gap-2 rounded-xl bg-amber-500 px-6 py-3 font-semibold text-white hover:bg-amber-600">

                <i class="fa-solid fa-book"></i>

                Khám phá tài liệu

            </a>

        </div>

        @endif

    </div>

</div>

@endsection