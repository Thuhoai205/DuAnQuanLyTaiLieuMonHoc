@extends('layouts.admin')

@section('title', 'Tổng quan hệ thống')
@section('page-title', 'Dashboard')

@section('content')

@php
$totalUsers = $totalUsers ?? 0;
$totalSubjects = $totalSubjects ?? 0;
$totalDocumentTypes = $totalDocumentTypes ?? 0;

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
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        <!-- USERS -->
        <a href="{{ $usersUrl }}"
            class="block bg-white border border-slate-200 rounded-md shadow-sm p-5 transition hover:-translate-y-0.5 hover:shadow-md cursor-pointer">
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
            class="block bg-white border border-slate-200 rounded-md shadow-sm p-5 transition hover:-translate-y-0.5 hover:shadow-md cursor-pointer">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase text-slate-400">
                        Môn học
                    </p>

                    <h3 class="text-2xl font-black text-slate-700 mt-2">
                        {{ number_format($totalSubjects) }}
                    </h3>

                    <p class="text-xs font-semibold text-slate-400 mt-1">
                        Quản lý danh sách môn học
                    </p>
                </div>

                <div class="w-11 h-11 rounded-md bg-emerald-500 text-white flex items-center justify-center shadow-sm">
                    <i class="fa-solid fa-book-open"></i>
                </div>
            </div>
        </a>

        <!-- DOCUMENT TYPES -->
        <a href="{{ $documentTypesUrl }}"
            class="block bg-white border border-slate-200 rounded-md shadow-sm p-5 transition hover:-translate-y-0.5 hover:shadow-md cursor-pointer">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase text-slate-400">
                        Loại tài liệu
                    </p>

                    <h3 class="text-2xl font-black text-slate-700 mt-2">
                        {{ number_format($totalDocumentTypes) }}
                    </h3>

                    <p class="text-xs font-semibold text-slate-400 mt-1">
                        Quản lý danh mục loại tài liệu
                    </p>
                </div>

                <div class="w-11 h-11 rounded-md bg-amber-500 text-white flex items-center justify-center shadow-sm">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
            </div>
        </a>

    </div>

    <!-- MAIN CONTENT -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 items-start">

        <!-- CHART -->
        <div class="xl:col-span-8 bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden self-start">
            <div class="px-5 py-4 border-b border-slate-200 flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-black text-slate-700">
                        Thống kê tăng trưởng
                    </h2>

                    <p class="text-xs font-semibold text-slate-400 mt-1">
                        Người dùng, môn học và loại tài liệu mới theo tháng
                    </p>
                </div>

                <span class="px-3 py-1 rounded bg-slate-100 text-slate-500 text-xs font-black">
                    Năm {{ now()->year }}
                </span>
            </div>

            <div class="p-5">
                <div class="h-[320px]">
                    <canvas id="adminGrowthChart"></canvas>
                </div>
            </div>
        </div>

        <!-- QUICK OVERVIEW -->
        <div class="xl:col-span-4 space-y-5 self-start">

            <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-200">
                    <h2 class="text-sm font-black text-slate-700">
                        Tổng quan hoạt động
                    </h2>

                    <p class="text-xs font-semibold text-slate-400 mt-1">
                        Theo dõi nhanh trạng thái quản trị
                    </p>
                </div>

                <div class="p-5 space-y-4">

                    <div class="flex items-center justify-between rounded-md bg-slate-50 border border-slate-200 p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-md bg-sky-500 text-white flex items-center justify-center">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                            </div>

                            <div>
                                <p class="text-sm font-black text-slate-700">
                                    Nhật ký hôm nay
                                </p>

                                <p class="text-xs font-semibold text-slate-400">
                                    Đăng ký / đăng nhập / đăng xuất
                                </p>
                            </div>
                        </div>

                        <span class="text-lg font-black text-slate-700">
                            {{ number_format($todayLogs) }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between rounded-md bg-slate-50 border border-slate-200 p-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-md bg-emerald-500 text-white flex items-center justify-center">
                                <i class="fa-solid fa-right-to-bracket"></i>
                            </div>

                            <div>
                                <p class="text-sm font-black text-slate-700">
                                    Lượt đăng nhập
                                </p>

                                <p class="text-xs font-semibold text-slate-400">
                                    Tổng lượt đăng nhập
                                </p>
                            </div>
                        </div>

                        <span class="text-lg font-black text-slate-700">
                            {{ number_format($totalLoginLogs) }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between rounded-md bg-slate-50 border border-slate-200 p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-md bg-orange-500 text-white flex items-center justify-center">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </div>

                            <div>
                                <p class="text-sm font-black text-slate-700">
                                    Lượt đăng xuất
                                </p>

                                <p class="text-xs font-semibold text-slate-400">
                                    Tổng lượt đăng xuất
                                </p>
                            </div>
                        </div>

                        <span class="text-lg font-black text-slate-700">
                            {{ number_format($totalLogoutLogs) }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between rounded-md bg-slate-50 border border-slate-200 p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-md bg-green-500 text-white flex items-center justify-center">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>

                            <div>
                                <p class="text-sm font-black text-slate-700">
                                    Trạng thái
                                </p>

                                <p class="text-xs font-semibold text-slate-400">
                                    Hệ thống đang vận hành
                                </p>
                            </div>
                        </div>

                        <span class="px-3 py-1 rounded bg-emerald-50 text-emerald-600 text-xs font-black">
                            Online
                        </span>
                    </div>

                </div>
            </div>

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
                            {{ \Carbon\Carbon::parse($time)->diffForHumans() }}
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