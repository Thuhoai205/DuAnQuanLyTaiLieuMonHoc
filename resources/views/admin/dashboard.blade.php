@extends('layouts.admin')

@section('title', 'Tổng quan hệ thống')
@section('page-title', 'Dashboard')

@section('content')

@php
$totalUsers = $totalUsers ?? 0;
$totalSubjects = $totalSubjects ?? 0;
$totalDocumentTypes = $totalDocumentTypes ?? 0;

$totalDocuments = $totalDocuments ?? 0;
$totalDownloads = $totalDownloads ?? 0;
$topDocuments = $topDocuments ?? collect();

$totalLogs = $totalLogs ?? 0;
$totalLoginLogs = $totalLoginLogs ?? 0;
$totalLogoutLogs = $totalLogoutLogs ?? 0;
$todayLogs = $todayLogs ?? 0;

$recentActivities = $recentActivities ?? collect();

$chartLabels = $chartLabels ?? [];
$userChartData = $userChartData ?? [];
$subjectChartData = $subjectChartData ?? [];
$documentTypeChartData = $documentTypeChartData ?? [];

$usersUrl = \Illuminate\Support\Facades\Route::has('admin.users.index')
? route('admin.users.index')
: '#';

$subjectsUrl = \Illuminate\Support\Facades\Route::has('admin.subjects.index')
? route('admin.subjects.index')
: '#';

$documentTypesUrl = \Illuminate\Support\Facades\Route::has('admin.document-types.index')
? route('admin.document-types.index')
: '#';

$logsUrl = \Illuminate\Support\Facades\Route::has('admin.logs.index')
? route('admin.logs.index')
: '#';


@endphp

<div class="space-y-6">

    <!-- TOP SUMMARY -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-5 items-stretch">

        <!-- USERS -->
        <a href="{{ $usersUrl }}"
            class="h-full flex flex-col justify-between bg-white border border-slate-200 rounded-md shadow-sm p-5 transition hover:-translate-y-0.5 hover:shadow-md">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-bold uppercase text-slate-400">
                        Người dùng
                    </p>

                    <h3 class="text-2xl font-black text-slate-700 mt-2">
                        {{ number_format($totalUsers) }}
                    </h3>

                    <p class="text-xs font-semibold text-slate-400 mt-1">
                        Quản lý tài khoản hệ thống
                    </p>
                </div>

                <div class="w-11 h-11 rounded-md bg-sky-500 text-white flex items-center justify-center shadow-sm">
                    <i class="fa-solid fa-users"></i>
                </div>

            </div>
        </a>

        <!-- SUBJECTS -->
        <a href="{{ $subjectsUrl }}"
            class="h-full flex flex-col justify-between bg-white border border-slate-200 rounded-md shadow-sm p-5 transition hover:-translate-y-0.5 hover:shadow-md">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-bold uppercase text-slate-400">
                        Môn học
                    </p>

                    <h3 class="text-2xl font-black text-slate-700 mt-2">
                        {{ number_format($totalSubjects) }}
                    </h3>

                    <p class="text-xs font-semibold text-slate-400 mt-1">
                        Quản lý môn học
                    </p>
                </div>

                <div class="w-11 h-11 rounded-md bg-emerald-500 text-white flex items-center justify-center shadow-sm">
                    <i class="fa-solid fa-book-open"></i>
                </div>

            </div>
        </a>

        <!-- DOCUMENTS -->
        <div
            class="h-full flex flex-col justify-between bg-white border border-slate-200 rounded-md shadow-sm p-5 transition hover:-translate-y-0.5 hover:shadow-md">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-bold uppercase text-slate-400">
                        Tài liệu
                    </p>

                    <h3 class="text-2xl font-black text-slate-700 mt-2">
                        {{ number_format($totalDocuments) }}
                    </h3>

                    <p class="text-xs font-semibold text-slate-400 mt-1">
                        Quản lý tài liệu
                    </p>
                </div>

                <div class="w-11 h-11 rounded-md bg-purple-500 text-white flex items-center justify-center shadow-sm">
                    <i class="fa-solid fa-file-lines"></i>
                </div>

            </div>
        </div>

        <!-- DOCUMENT TYPES -->
        <a href="{{ $documentTypesUrl }}"
            class="h-full flex flex-col justify-between bg-white border border-slate-200 rounded-md shadow-sm p-5 transition hover:-translate-y-0.5 hover:shadow-md">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-bold uppercase text-slate-400">
                        Loại tài liệu
                    </p>

                    <h3 class="text-2xl font-black text-slate-700 mt-2">
                        {{ number_format($totalDocumentTypes) }}
                    </h3>

                    <p class="text-xs font-semibold text-slate-400 mt-1">
                        Phân loại tài liệu
                    </p>
                </div>

                <div class="w-11 h-11 rounded-md bg-amber-500 text-white flex items-center justify-center shadow-sm">
                    <i class="fa-solid fa-layer-group"></i>
                </div>

            </div>
        </a>

        <!-- DOWNLOADS -->
        <div
            class="h-full flex flex-col justify-between bg-white border border-slate-200 rounded-md shadow-sm p-5 transition hover:-translate-y-0.5 hover:shadow-md">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-bold uppercase text-slate-400">
                        Lượt tải
                    </p>

                    <h3 class="text-2xl font-black text-slate-700 mt-2">
                        {{ number_format($totalDownloads) }}
                    </h3>

                    <p class="text-xs font-semibold text-slate-400 mt-1">
                        Thống kê tải xuống
                    </p>
                </div>

                <div class="w-11 h-11 rounded-md bg-rose-500 text-white flex items-center justify-center shadow-sm">
                    <i class="fa-solid fa-download"></i>
                </div>

            </div>
        </div>

    </div>
    <!-- MAIN CONTENT -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 items-start">
        <!-- BIỂU ĐỒ -->
        <div class="xl:col-span-8 bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden self-start">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">

                <div>

                    <h2 class="text-base font-bold text-slate-800">
                        Thống kê tăng trưởng
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        Người dùng, môn học và loại tài liệu mới theo tháng
                    </p>

                </div>

                <span class="px-3 py-1 rounded-lg bg-slate-100 text-slate-600 text-xs font-semibold">

                    Năm {{ now()->year }}

                </span>

            </div>

            <!-- Chart -->
            <div class="p-5">

                <div class="h-[280px]">

                    <canvas id="adminGrowthChart"></canvas>

                </div>

            </div>

        </div>

        <!-- TỔNG QUAN -->
        <div class="xl:col-span-4 space-y-5 self-start">
            <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">
                <!-- Header -->
                <div class="px-6 py-4 border-b border-slate-200">

                    <h2 class="text-base font-bold text-slate-800">

                        Tổng quan hoạt động

                    </h2>

                    <p class="mt-1 text-xs text-slate-400">

                        Theo dõi nhanh trạng thái quản trị

                    </p>

                </div>

                <!-- Body -->
                <div class="p-4 space-y-3">

                    <!-- Nhật ký -->
                    <div
                        class="flex items-center justify-between rounded-xl border border-slate-200 px-4 py-3 hover:border-sky-300 hover:shadow-sm transition">

                        <div class="flex items-center gap-3">

                            <div class="w-9 h-9 rounded-lg bg-sky-500 text-white flex items-center justify-center">

                                <i class="fa-solid fa-clock-rotate-left"></i>

                            </div>

                            <div>

                                <p class="text-sm font-bold text-slate-700">

                                    Nhật ký hôm nay

                                </p>

                                <p class="text-xs text-slate-400">

                                    Đăng ký / đăng nhập / đăng xuất

                                </p>

                            </div>

                        </div>

                        <span class="text-base font-bold text-slate-700">

                            {{ number_format($todayLogs) }}

                        </span>

                    </div>

                    <!-- Login -->
                    <div
                        class="flex items-center justify-between rounded-xl border border-slate-200 px-4 py-3 hover:border-emerald-300 hover:shadow-sm transition">

                        <div class="flex items-center gap-3">

                            <div class="w-9 h-9 rounded-lg bg-emerald-500 text-white flex items-center justify-center">

                                <i class="fa-solid fa-right-to-bracket"></i>

                            </div>

                            <div>

                                <p class="text-sm font-bold text-slate-700">

                                    Lượt đăng nhập

                                </p>

                                <p class="text-xs text-slate-400">

                                    Tổng lượt đăng nhập

                                </p>

                            </div>

                        </div>

                        <span class="text-base font-bold text-slate-700">

                            {{ number_format($totalLoginLogs) }}

                        </span>

                    </div>

                    <!-- Logout -->
                    <div
                        class="flex items-center justify-between rounded-xl border border-slate-200 px-4 py-3 hover:border-orange-300 hover:shadow-sm transition">

                        <div class="flex items-center gap-3">

                            <div class="w-9 h-9 rounded-lg bg-orange-500 text-white flex items-center justify-center">

                                <i class="fa-solid fa-right-from-bracket"></i>

                            </div>

                            <div>

                                <p class="text-sm font-bold text-slate-700">

                                    Lượt đăng xuất

                                </p>

                                <p class="text-xs text-slate-400">

                                    Tổng lượt đăng xuất

                                </p>

                            </div>

                        </div>

                        <span class="text-base font-bold text-slate-700">

                            {{ number_format($totalLogoutLogs) }}

                        </span>

                    </div>

                    <!-- Status -->
                    <div
                        class="flex items-center justify-between rounded-xl border border-slate-200 px-4 py-3 hover:border-green-300 hover:shadow-sm transition">

                        <div class="flex items-center gap-3">

                            <div class="w-9 h-9 rounded-lg bg-green-500 text-white flex items-center justify-center">

                                <i class="fa-solid fa-circle-check"></i>

                            </div>

                            <div>

                                <p class="text-sm font-bold text-slate-700">

                                    Trạng thái

                                </p>

                                <p class="text-xs text-slate-400">

                                    Hệ thống đang vận hành

                                </p>

                            </div>

                        </div>

                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-600 text-xs font-bold">

                            Online

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">


        <!-- HEADER -->
        <div class="px-5 py-4 border-b border-slate-200 flex items-center justify-between">

            <div>
                <h2 class="text-sm font-black text-slate-700">
                    Tài liệu mới nhất
                </h2>

                <p class="text-xs text-slate-400 mt-1">
                    Danh sách tài liệu được tải lên gần đây
                </p>
            </div>

            <span class="px-3 py-1 rounded-md bg-sky-50 text-sky-600 text-xs font-black">
                {{ count($latestDocuments) }} tài liệu
            </span>

        </div>

        <!-- HEADER GRID -->
        <div class="px-6 py-4 bg-slate-50 border-b border-slate-200
            grid grid-cols-12 gap-4
            text-xs font-bold uppercase tracking-wide text-slate-500">

            <div class="col-span-1 ">
                STT
            </div>

            <div class="col-span-5">
                Tài liệu
            </div>

            <div class="col-span-2">
                Môn học
            </div>

            <div class="col-span-2">
                Người đăng
            </div>

            <div class="col-span-1 text-center">
                Ngày
            </div>

            <div class="col-span-1 text-center">
                Xem
            </div>

        </div>

        <!-- BODY -->
        <div class="divide-y divide-slate-100">

            @forelse($latestDocuments as $index => $document)

            @php
            $ext = strtolower($document->currentVersion->file_extension ?? '');
            @endphp
            <div class="grid grid-cols-12 gap-4 px-6 py-4 items-center hover:bg-slate-50 transition">

                <!-- STT -->
                <div class="col-span-1 flex ">

                    <span class="w-8 h-8 rounded-lg
                     bg-slate-100 text-slate-600
                     text-sm font-bold
                     flex items-center justify-center">

                        {{ $index + 1 }}

                    </span>

                </div>

                <!-- TÀI LIỆU -->
                <div class="col-span-5 flex items-center gap-3 min-w-0">

                    <div class="w-9 h-9 rounded-md flex items-center justify-center shrink-0

                            @if(in_array($ext,['pdf']))
                                bg-red-50 text-red-500
                            @elseif(in_array($ext,['doc','docx']))
                                bg-blue-50 text-blue-600
                            @elseif(in_array($ext,['xls','xlsx']))
                                bg-green-50 text-green-600
                            @elseif(in_array($ext,['ppt','pptx']))
                                bg-orange-50 text-orange-600
                            @elseif(in_array($ext,['zip','rar']))
                                bg-yellow-50 text-yellow-600
                            @elseif(in_array($ext,['jpg','jpeg','png','gif','webp']))
                                bg-pink-50 text-pink-600
                            @elseif(in_array($ext,['mp4','avi','mov']))
                                bg-purple-50 text-purple-600
                            @else
                                bg-slate-100 text-slate-500
                            @endif">

                        @if(in_array($ext,['pdf']))
                        <i class="fa-solid fa-file-pdf text-lg"></i>

                        @elseif(in_array($ext,['doc','docx']))
                        <i class="fa-solid fa-file-word text-lg"></i>

                        @elseif(in_array($ext,['xls','xlsx']))
                        <i class="fa-solid fa-file-excel text-lg"></i>

                        @elseif(in_array($ext,['ppt','pptx']))
                        <i class="fa-solid fa-file-powerpoint text-lg"></i>

                        @elseif(in_array($ext,['zip','rar']))
                        <i class="fa-solid fa-file-zipper text-lg"></i>

                        @elseif(in_array($ext,['jpg','jpeg','png','gif','webp']))
                        <i class="fa-solid fa-file-image text-lg"></i>

                        @elseif(in_array($ext,['mp4','avi','mov']))
                        <i class="fa-solid fa-file-video text-lg"></i>

                        @else
                        <i class="fa-solid fa-file text-lg"></i>
                        @endif

                    </div>
                    <div class="flex-1 min-w-0">

                        <h4 class="font-bold text-[15px] text-slate-700 truncate" title="{{ $document->title }}">

                            {{ $document->title }}

                        </h4>

                        <p class="mt-1 text-xs text-slate-400 truncate" title="{{ $document->description }}">

                            {{ $document->description }}

                        </p>

                    </div>

                </div>

                <!-- MÔN HỌC -->
                <div class="col-span-2 min-w-0">

                    <span class="block w-full
                     px-3 py-1
                     rounded-full
                     bg-emerald-50
                     text-emerald-600
                     text-xs font-semibold
                     truncate" title="{{ $document->subject->subject_name }}">

                        {{ $document->subject->subject_name }}

                    </span>

                </div>

                <!-- NGƯỜI ĐĂNG -->
                <div class="col-span-2">

                    <div class="flex items-center gap-2">

                        <div class="w-8 h-8 rounded-full
                        bg-sky-100 text-sky-600
                        flex items-center justify-center shrink-0">

                            <i class="fa-solid fa-user text-xs"></i>

                        </div>

                        <span class="text-sm font-medium text-slate-700 whitespace-nowrap">

                            {{ $document->uploader->full_name }}

                        </span>

                    </div>

                </div>

                <!-- NGÀY -->
                <div class="col-span-1 text-center">

                    <div class="text-sm font-semibold text-slate-700">

                        {{ $document->created_at->format('d/m') }}

                    </div>

                    <div class="text-xs text-slate-400">

                        {{ $document->created_at->format('H:i') }}

                    </div>

                </div>

                <!-- XEM -->
                @php
                $version = $document->currentVersion;
                @endphp

                <div class="col-span-1 flex justify-center">

                    <a href="{{ asset('storage/'.$version->preview_file) }}" target="_blank"
                        class="inline-flex items-center gap-2 h-11 px-4 rounded-md bg-sky-500 text-white text-sm font-bold hover:bg-sky-600">

                        <i class="fa-solid fa-eye"></i>
                        Xem

                    </a>


                </div>

            </div>

            @empty

            <div class="py-16 text-center">

                <div class="w-16 h-16 mx-auto rounded-xl
                bg-slate-100 text-slate-400
                flex items-center justify-center mb-4">

                    <i class="fa-solid fa-file-circle-xmark text-2xl"></i>

                </div>

                <p class="font-black text-slate-500">

                    Chưa có tài liệu nào được tải lên.

                </p>

            </div>

            @endforelse

        </div>
    </div>
    <!-- RECENT ACTIVITIES -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden self-start h-fit">
        <div class="px-5 py-4 border-b border-slate-200 flex items-center justify-between">
            <div>
                <h2 class="text-sm font-black text-slate-700">
                    Hoạt động gần đây
                </h2>

                <p class="text-xs font-semibold text-slate-400 mt-1">
                    Lịch sử đăng ký, đăng nhập và đăng xuất
                </p>
            </div>

            <a href="{{ $logsUrl }}" class="text-xs font-black text-sky-500 hover:text-sky-600">
                Xem tất cả
            </a>
        </div>

        <div class="p-5">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                @forelse($recentActivities as $log)
                @php
                $isLogin = !empty($log->login_at);
                $isLogout = !empty($log->logout_at);

                $time = $log->logout_at ?? $log->login_at ?? $log->created_at;

                if ($isLogout) {
                $iconClass = 'fa-solid fa-right-from-bracket';
                $boxClass = 'bg-orange-50 text-orange-500';
                $defaultDescription = 'Đăng xuất hệ thống';
                } elseif ($isLogin) {
                $iconClass = 'fa-solid fa-right-to-bracket';
                $boxClass = 'bg-emerald-50 text-emerald-500';
                $defaultDescription = 'Đăng nhập hệ thống';
                } else {
                $iconClass = 'fa-solid fa-user-plus';
                $boxClass = 'bg-sky-50 text-sky-500';
                $defaultDescription = 'Đăng ký tài khoản';
                }
                @endphp

                <div class="rounded-md border border-slate-200 bg-slate-50 p-4 flex gap-3">
                    <div class="w-10 h-10 rounded-md {{ $boxClass }} flex items-center justify-center shrink-0">
                        <i class="{{ $iconClass }}"></i>
                    </div>

                    <div class="min-w-0">
                        <h4 class="text-sm font-black text-slate-700 truncate">
                            {{ $log->user->full_name ?? 'Người dùng không xác định' }}
                        </h4>

                        <p class="text-xs font-semibold text-slate-500 mt-1">
                            {{ $log->description ?? $defaultDescription }}
                        </p>

                        <p class="text-[11px] font-bold text-slate-400 mt-1">
                            @if($time)
                            {{ \Carbon\Carbon::parse($time)->locale('vi')->diffForHumans() }}
                            @else
                            Không rõ thời gian
                            @endif
                        </p>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-8">
                    <div
                        class="w-14 h-14 mx-auto rounded-md bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                        <i class="fa-solid fa-clock-rotate-left text-xl"></i>
                    </div>

                    <p class="text-sm font-bold text-slate-500">
                        Chưa có hoạt động nào.
                    </p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection
@push('scripts')
<script type="application/json" id="chartLabelsJson">
@json($chartLabels ?? [])
</script>
<script type="application/json" id="userChartDataJson">
@json($userChartData ?? [])
</script>

<script type="application/json" id="subjectChartDataJson">
@json($subjectChartData ?? [])
</script>

<script type="application/json" id="documentTypeChartDataJson">
@json($documentTypeChartData ?? [])
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function readJsonData(id) {
        const element = document.getElementById(id);

        if (!element) {
            return [];
        }

        try {
            return JSON.parse(element.textContent.trim() || '[]');
        } catch (error) {
            console.error('JSON không hợp lệ:', id, error);
            return [];
        }
    }

    let chartLabels = readJsonData('chartLabelsJson');
    let userChartData = readJsonData('userChartDataJson');
    let subjectChartData = readJsonData('subjectChartDataJson');
    let documentTypeChartData = readJsonData('documentTypeChartDataJson');

    if (!Array.isArray(chartLabels) || chartLabels.length === 0) {
        chartLabels = ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'];
    }

    userChartData = Array.isArray(userChartData) ? userChartData.map(Number) : [];
    subjectChartData = Array.isArray(subjectChartData) ? subjectChartData.map(Number) : [];
    documentTypeChartData = Array.isArray(documentTypeChartData) ? documentTypeChartData.map(Number) : [];

    while (userChartData.length < chartLabels.length) {
        userChartData.push(0);
    }

    while (subjectChartData.length < chartLabels.length) {
        subjectChartData.push(0);
    }

    while (documentTypeChartData.length < chartLabels.length) {
        documentTypeChartData.push(0);
    }

    const ctx = document.getElementById('adminGrowthChart');

    if (!ctx) {
        console.error('Không tìm thấy canvas adminGrowthChart.');
        return;
    }

    if (typeof Chart === 'undefined') {
        console.error('Chart.js chưa được load. Kiểm tra layouts/admin.blade.php.');
        return;
    }

    const maxValue = Math.max(...userChartData, ...subjectChartData, ...documentTypeChartData, 1);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                    label: 'Người dùng mới',
                    data: userChartData,
                    borderColor: '#0ea5e9',
                    backgroundColor: 'rgba(14, 165, 233, 0.10)',
                    tension: 0.38,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    borderWidth: 3
                },
                {
                    label: 'Môn học mới',
                    data: subjectChartData,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.10)',
                    tension: 0.38,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    borderWidth: 3
                },
                {
                    label: 'Loại tài liệu mới',
                    data: documentTypeChartData,
                    borderColor: '#f59e0b',
                    backgroundColor: 'rgba(245, 158, 11, 0.10)',
                    tension: 0.38,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    borderWidth: 3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        boxWidth: 8,
                        boxHeight: 8,
                        color: '#64748b',
                        font: {
                            size: 12,
                            weight: '700'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: maxValue,
                    ticks: {
                        precision: 0,
                        color: '#94a3b8',
                        font: {
                            size: 11,
                            weight: '600'
                        }
                    },
                    grid: {
                        color: '#e2e8f0'
                    }
                },
                x: {
                    ticks: {
                        color: '#94a3b8',
                        font: {
                            size: 11,
                            weight: '600'
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
});
</script>

@endpush