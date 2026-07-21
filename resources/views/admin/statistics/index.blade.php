@extends('layouts.admin')

@section('title', 'Thống kê')
@section('page-title', 'Thống kê')

@section('content')

@php
$monthLabels = [
1 => 'T1',
2 => 'T2',
3 => 'T3',
4 => 'T4',
5 => 'T5',
6 => 'T6',
7 => 'T7',
8 => 'T8',
9 => 'T9',
10 => 'T10',
11 => 'T11',
12 => 'T12',
];

$chartMap = collect($chartData ?? [])->pluck('total', 'month');

$maxChartValue = max((int)($chartMap->max() ?? 0),1);

$topDownloads = $topDownloads ?? collect();
$topKeywords = $topKeywords ?? collect();
$documentsByType = $documentsByType ?? collect();
$recentDownloads = $recentDownloads ?? collect();
$topSubjects = $topSubjects ?? collect();

$maxSubjectValue = max((int) ($topSubjects->max('total_downloads') ?? 0), 1);
$maxTypeValue = max((int)($documentsByType->max('documents_count') ?? 0),1);
$maxKeywordValue = max((int)($topKeywords->max('total') ?? 0),1);
@endphp

<div class="max-w-7xl mx-auto px-2 lg:px-4">

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">

        <div>

            <h1 class="text-[18px] font-black text-slate-700">
                Thống kê hệ thống
            </h1>

            <p class="text-slate-500 font-semibold text-sm mt-1">
                Theo dõi tổng quan hệ thống quản lý tài liệu môn học.
            </p>

        </div>

        <div class="w-16 h-16 rounded-xl bg-cyan-50 border flex items-center justify-center shadow-sm">

            <i class="fa-solid fa-chart-column text-2xl text-cyan-600"></i>

        </div>

    </div>

    {{-- Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

        {{-- Tổng tài liệu --}}
        <div class="group bg-white rounded-md border p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase font-black tracking-wider text-slate-400">
                        Tổng tài liệu
                    </p>

                    <h3 class="text-4xl font-black text-cyan-700 mt-2">
                        {{ number_format($totalDocuments) }}
                    </h3>

                </div>

                <div class="w-12 h-12 rounded-xl bg-cyan-50 flex items-center justify-center">

                    <i class="fa-solid fa-file-lines text-cyan-600 text-xl"></i>

                </div>

            </div>

        </div>

        {{-- Lượt tải --}}
        <div class="group bg-white rounded-md border p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase font-black tracking-wider text-slate-400">
                        Tổng lượt tải
                    </p>

                    <h3 class="text-4xl font-black text-amber-700 mt-2">
                        {{ number_format($totalDownloads) }}
                    </h3>

                </div>

                <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center">

                    <i class="fa-solid fa-download text-amber-600 text-xl"></i>

                </div>

            </div>

        </div>

        {{-- Người dùng --}}
        <div class="group bg-white rounded-md border p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase font-black tracking-wider text-slate-400">
                        Người dùng
                    </p>

                    <h3 class="text-4xl font-black text-emerald-700 mt-2">
                        {{ number_format($totalUsers) }}
                    </h3>

                </div>

                <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center">

                    <i class="fa-solid fa-users text-emerald-600 text-xl"></i>

                </div>

            </div>

        </div>

        {{-- Bình luận --}}
        <div class="group bg-white rounded-md border p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase font-black tracking-wider text-slate-400">
                        Bình luận
                    </p>

                    <h3 class="text-4xl font-black text-violet-700 mt-2">
                        {{ number_format($totalComments ?? 0) }}
                    </h3>

                </div>

                <div class="w-12 h-12 rounded-xl bg-violet-50 flex items-center justify-center">

                    <i class="fa-solid fa-comments text-violet-600 text-xl"></i>

                </div>

            </div>

        </div>

    </div>

    {{-- Biểu đồ + Top tài liệu --}}
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 mb-8">

        {{-- Biểu đồ --}}
        <div class="xl:col-span-8 bg-white rounded-md border shadow-sm overflow-hidden">

            <div class="px-6 py-4 border-b flex items-center justify-between">

                <div>

                    <h2 class="font-black text-lg">
                        Lượt tải theo tháng
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Thống kê lượt tải tài liệu trong năm {{ now()->year }}
                    </p>

                </div>

                <span class="px-3 py-1 rounded bg-slate-100 text-xs font-bold">

                    {{ now()->year }}

                </span>

            </div>

            <div class="p-7">

                <div class="h-[320px] flex items-end gap-3 border-b">

                    @foreach($monthLabels as $month=>$label)

                    @php

                    $value=(int)$chartMap->get($month,0);

                    $percent=$maxChartValue>0
                    ?($value/$maxChartValue)*100
                    :0;

                    if($value<=0){ $height="h-[6px]" ; }elseif($percent<=20){ $height="h-[44px]" ;
                        }elseif($percent<=40){ $height="h-[88px]" ; }elseif($percent<=60){ $height="h-[132px]" ;
                        }elseif($percent<=80){ $height="h-[176px]" ; }else{ $height="h-[220px]" ; } @endphp <div
                        class="flex flex-1 flex-col items-center justify-end gap-3">

                        <span class="text-xs font-bold">

                            {{ $value }}

                        </span>

                        <div class="h-[220px] w-full flex items-end justify-center">

                            <div
                                class="w-full max-w-[42px] {{ $height }} rounded-t-xl bg-gradient-to-t from-cyan-600 to-sky-400">

                            </div>

                        </div>

                        <span class="pb-2 text-sm font-bold">

                            {{ $label }}

                        </span>

                </div>

                @endforeach

            </div>

        </div>

    </div>

    {{-- Top tài liệu --}}
    <div class="xl:col-span-4 bg-white rounded-md border shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b">

            <h2 class="font-black text-lg">

                Top 5 tài liệu

            </h2>

            <p class="text-sm text-slate-500 mt-1">

                Có lượt tải nhiều nhất

            </p>

        </div>

        <div class="p-5 space-y-4">

            @forelse($topDownloads as $index=>$doc)

            <div class="flex items-center gap-4 rounded-md bg-slate-50 p-4">

                <div class="w-10 h-10 rounded-lg bg-cyan-100 flex items-center justify-center font-black">

                    #{{ $index+1 }}

                </div>

                <div class="flex-1 min-w-0">

                    <p class="truncate font-black">

                        {{ $doc->title }}

                    </p>

                    <p class="text-sm text-slate-500">

                        {{ number_format($doc->download_count) }} lượt tải

                    </p>

                </div>

            </div>

            @empty

            <div class="text-center py-8 text-slate-500">

                Chưa có dữ liệu.

            </div>

            @endforelse

        </div>

    </div>

</div> {{-- Row 2 --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-8">

    <div class="bg-white rounded-md border shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b flex items-center justify-between">

            <div>

                <h2 class="text-lg font-black text-slate-900">
                    Top môn học
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Được tải nhiều nhất
                </p>

            </div>

            <i class="fa-solid fa-book-open-reader text-cyan-600 text-xl"></i>

        </div>

        <div class="p-6 space-y-4">

            @forelse($topSubjects as $index => $subject)

            @php
            $percent = $maxSubjectValue > 0
            ? ($subject->total_downloads / $maxSubjectValue) * 100
            : 0;
            @endphp

            <div class="rounded-lg bg-slate-50 border p-4">

                <div class="flex justify-between mb-2">

                    <span class="font-bold">

                        #{{ $index + 1 }}

                        {{ $subject->subject_name }}

                    </span>

                    <span class="text-cyan-700 font-black">

                        {{ $subject->total_downloads }}

                    </span>

                </div>

                <div class="w-full h-2 rounded-full bg-slate-200">

                    <div class="h-2 rounded-full bg-cyan-500" style="width: {{ $percent }}%">
                    </div>

                </div>

            </div>

            @empty

            <div class="text-center py-8 text-slate-500">

                Chưa có dữ liệu.

            </div>

            @endforelse

        </div>

    </div>


    {{-- Top từ khóa --}}
    <div class="bg-white rounded-md border shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b flex items-center justify-between">

            <div>

                <h2 class="text-lg font-black">

                    Top từ khóa

                </h2>

                <p class="text-sm text-slate-500 mt-1">

                    Được tìm kiếm nhiều nhất

                </p>

            </div>

            <i class="fa-solid fa-magnifying-glass text-violet-600 text-xl"></i>

        </div>

        <div class="p-5 space-y-4">

            @forelse($topKeywords as $index => $keyword)

            @php

            $word = $keyword->keyword ?? 'Không rõ';

            $count = (int)($keyword->total ?? 0);

            $percent = $maxKeywordValue > 0
            ? ($count / $maxKeywordValue) * 100
            : 0;

            @endphp

            <div class="bg-slate-50 rounded-lg p-4">

                <div class="flex justify-between mb-2">

                    <span class="font-bold truncate">

                        #{{ $index + 1 }} {{ $word }}

                    </span>

                    <span class="font-black text-violet-700">

                        {{ $count }}

                    </span>

                </div>

                <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">

                    <div class="h-full bg-violet-500 rounded-full" style="width: {{ $percent }}%">
                    </div>

                </div>

            </div>

            @empty

            <div class="text-center py-8 text-slate-500">

                Chưa có dữ liệu.

            </div>

            @endforelse

        </div>

    </div>



    {{-- Thống kê bình luận --}}
    <div class="bg-white rounded-md border shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b flex items-center justify-between">

            <div>

                <h2 class="text-lg font-black">
                    Thống kê bình luận
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Tổng quan tình trạng bình luận
                </p>

            </div>

            <i class="fa-solid fa-comments text-blue-600 text-xl"></i>

        </div>

        <div class="p-6 space-y-4">

            <div class="flex items-center justify-between bg-slate-50 rounded-lg p-4">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">

                        <i class="fa-solid fa-comments text-blue-600"></i>

                    </div>

                    <span class="font-semibold">
                        Tổng bình luận
                    </span>

                </div>

                <span class="font-black text-lg text-blue-700">
                    {{ number_format($totalComments) }}
                </span>

            </div>

            <div class="flex items-center justify-between bg-slate-50 rounded-lg p-4">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">

                        <i class="fa-solid fa-eye text-green-600"></i>

                    </div>

                    <span class="font-semibold">
                        Đang hiển thị
                    </span>

                </div>

                <span class="font-black text-lg text-green-700">
                    {{ number_format($activeComments) }}
                </span>

            </div>

            <div class="flex items-center justify-between bg-slate-50 rounded-lg p-4">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center">

                        <i class="fa-solid fa-eye-slash text-red-600"></i>

                    </div>

                    <span class="font-semibold">
                        Đã ẩn
                    </span>

                </div>

                <span class="font-black text-lg text-red-700">
                    {{ number_format($hiddenComments) }}
                </span>

            </div>

            <div class="flex items-center justify-between bg-slate-50 rounded-lg p-4">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">

                        <i class="fa-solid fa-reply text-purple-600"></i>

                    </div>

                    <span class="font-semibold">
                        Phản hồi
                    </span>

                </div>

                <span class="font-black text-lg text-purple-700">
                    {{ number_format($replyComments) }}
                </span>

            </div>

        </div>

    </div>

</div>
{{-- Row 3 --}}
<div class="bg-white rounded-md border shadow-sm overflow-hidden">

    <div class="px-6 py-4 border-b flex items-center justify-between">

        <div>

            <h2 class="text-lg font-black">
                Hoạt động tải gần đây
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                5 lượt tải tài liệu mới nhất trong hệ thống
            </p>

        </div>

        <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center">

            <i class="fa-solid fa-clock-rotate-left text-emerald-600"></i>

        </div>

    </div>

    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-slate-50">

                <tr>

                    <th class="px-6 py-3 text-left text-xs font-black uppercase tracking-wider text-slate-500">
                        Người dùng
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-black uppercase tracking-wider text-slate-500">
                        Tài liệu
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-black uppercase tracking-wider text-slate-500">
                        Phiên bản
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-black uppercase tracking-wider text-slate-500">
                        Thời gian
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($recentDownloads as $download)

                <tr class="hover:bg-slate-50 transition">

                    <td class="px-6 py-4">

                        <div class="font-semibold text-slate-700">

                            {{ $download->user->full_name ?? 'Khách' }}

                        </div>

                    </td>

                    <td class="px-6 py-4">

                        {{ $download->version?->document?->title ?? 'Không xác định' }}

                    </td>

                    <td class="px-6 py-4">

                        {{ $download->version?->version_name ?? '-' }}

                    </td>

                    <td class="px-6 py-4 text-slate-500">

                        @if($download->downloaded_at)

                        {{ \Carbon\Carbon::parse($download->downloaded_at)->format('d/m/Y H:i') }}

                        @else

                        -

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="py-10 text-center text-slate-500">

                        <i class="fa-solid fa-database text-4xl mb-3"></i>

                        <p>Chưa có dữ liệu tải xuống.</p>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</div>

@endsection