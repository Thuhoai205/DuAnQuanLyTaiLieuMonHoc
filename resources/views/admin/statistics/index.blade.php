@extends('layouts.admin')

@section('title', 'Thống kê')

@section('content')
<div class="min-h-screen bg-[#F6F7FB] px-6 py-8">

    <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Thống kê hệ thống
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Theo dõi số tài liệu, lượt tải, top download và hoạt động tải gần đây.
            </p>
        </div>

        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-100 text-violet-600">
            <i class="fa-solid fa-chart-column text-xl"></i>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Tổng tài liệu</p>
                    <h3 class="mt-2 text-3xl font-bold text-slate-800">
                        {{ number_format($totalDocuments) }}
                    </h3>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600">
                    <i class="fa-solid fa-file-lines text-xl"></i>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Tổng lượt tải</p>
                    <h3 class="mt-2 text-3xl font-bold text-slate-800">
                        {{ number_format($totalDownloads) }}
                    </h3>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-100 text-amber-600">
                    <i class="fa-solid fa-download text-xl"></i>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Loại tài liệu</p>
                    <h3 class="mt-2 text-3xl font-bold text-slate-800">
                        {{ number_format($totalTypes) }}
                    </h3>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-violet-100 text-violet-600">
                    <i class="fa-solid fa-folder-tree text-xl"></i>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Người dùng</p>
                    <h3 class="mt-2 text-3xl font-bold text-slate-800">
                        {{ number_format($totalUsers) }}
                    </h3>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>
            </div>
        </div>

    </div>

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

    $chartMap = collect($chartData)->pluck('total', 'month');

    $maxChartValue = max($chartMap->max() ?? 0, 1);
    @endphp

    <div class="mt-8 grid grid-cols-1 gap-6 xl:grid-cols-12">

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-8">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="font-bold text-slate-800">
                        Biểu đồ lượt tải
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Lượt tải tài liệu trong năm {{ now()->year }}.
                    </p>
                </div>

                <span class="rounded-full bg-violet-50 px-3 py-1 text-xs font-semibold text-violet-600">
                    {{ now()->year }}
                </span>
            </div>

            <div class="flex h-72 items-end gap-4 border-b border-slate-200 px-2">
                @foreach($monthLabels as $monthNumber => $monthName)

                @php
                $value = $chartMap[$monthNumber] ?? 0;
                $height = ($value / $maxChartValue) * 100;
                $barHeight = $height > 0 ? $height : 3;
                @endphp

                <div class="flex flex-1 flex-col items-center justify-end gap-3">

                    <span class="text-xs font-semibold text-slate-500">
                        {{ $value }}
                    </span>

                    <div class="w-full max-w-[45px] rounded-t-2xl bg-gradient-to-t from-violet-600 to-violet-400 transition hover:opacity-80"
                        style="height: {{$barHeight}}%;">
                    </div>

                    <span class="pb-3 text-sm font-medium text-slate-500">
                        {{ $monthName }}
                    </span>

                </div>

                @endforeach
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-4">
            <div class="mb-5 flex items-center justify-between">
                <h2 class="font-bold text-slate-800">
                    Top Download
                </h2>
                <i class="fa-solid fa-ranking-star text-amber-500"></i>
            </div>

            <div class="space-y-4">
                @forelse($topDownloads as $index => $doc)
                <div class="flex items-center gap-4 rounded-xl bg-slate-50 p-4 transition hover:bg-violet-50">
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-100 text-sm font-bold text-indigo-600">
                        #{{ $index + 1 }}
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="truncate font-semibold text-slate-700">
                            {{ $doc->tieu_de }}
                        </p>
                        <p class="text-sm text-slate-500">
                            {{ $doc->lich_su_tais_count }} lượt tải
                        </p>
                    </div>
                </div>
                @empty
                <div class="py-10 text-center text-sm text-slate-500">
                    Chưa có dữ liệu tải xuống.
                </div>
                @endforelse
            </div>
        </div>

    </div>

    @php
    $maxTypeValue = max($documentsByType->max('tai_lieus_count') ?? 0, 1);
    @endphp

    <div class="mt-8 grid grid-cols-1 gap-6 xl:grid-cols-12">

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-7">
            <div class="mb-5 flex items-center justify-between">
                <h2 class="font-bold text-slate-800">
                    Tài liệu theo loại
                </h2>
                <i class="fa-solid fa-folder-tree text-violet-500"></i>
            </div>

            <div class="space-y-5">
                @forelse($documentsByType as $type)
                @php
                $percent = ($type->tai_lieus_count / $maxTypeValue) * 100;
                @endphp

                <div>
                    <div class="mb-2 flex items-center justify-between text-sm">
                        <span class="font-semibold text-slate-700">
                            {{ $type->ten_loai }}
                        </span>
                        <span class="text-slate-500">
                            {{ $type->tai_lieus_count }} tài liệu
                        </span>
                    </div>

                    <div class="h-3 overflow-hidden rounded-full bg-slate-100">
                        <div class="h-full rounded-full bg-violet-500" style="width: {{ $percent }}%">
                        </div>
                    </div>
                </div>
                @empty
                <div class="py-10 text-center text-sm text-slate-500">
                    Chưa có loại tài liệu nào.
                </div>
                @endforelse
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-5">
            <div class="mb-5 flex items-center justify-between">
                <h2 class="font-bold text-slate-800">
                    Hoạt động tải gần đây
                </h2>
                <i class="fa-solid fa-clock-rotate-left text-slate-400"></i>
            </div>

            <div class="space-y-4">
                @forelse($recentDownloads as $item)
                <div class="flex gap-3 rounded-xl bg-slate-50 p-4">
                    <div class="mt-1 h-2.5 w-2.5 rounded-full bg-emerald-500"></div>

                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-slate-700">
                            {{ $item->user->full_name ?? 'Khách' }}
                            đã tải
                            <span class="text-violet-600">
                                {{ $item->taiLieu->tieu_de ?? 'Tài liệu đã xóa' }}
                            </span>
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            {{ \Carbon\Carbon::parse($item->ngay_tai)->diffForHumans() }}
                        </p>
                    </div>
                </div>
                @empty
                <div class="py-10 text-center text-sm text-slate-500">
                    Chưa có hoạt động tải nào.
                </div>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection