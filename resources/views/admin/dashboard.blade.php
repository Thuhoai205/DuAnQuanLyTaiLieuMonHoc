@extends('layouts.admin')

@section('title', 'Tổng quan hệ thống')
@section('page-title', 'Tổng quan hệ thống')

@section('content')

@php
$totalUsers = $totalUsers ?? 0;
$totalSubjects = $totalSubjects ?? 0;
$totalDocuments = $totalDocuments ?? 0;
$totalDownloads = $totalDownloads ?? 0;
$recentActivities = $recentActivities ?? collect();
@endphp

<div class="max-w-7xl mx-auto px-2 lg:px-4">

    <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="text-3xl font-black text-slate-900">
                Tổng quan hệ thống
            </h1>
            <p class="text-slate-500 font-semibold mt-2">
                Theo dõi người dùng, môn học, tài liệu và hoạt động trong hệ thống.
            </p>
        </div>

        <div
            class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-white border border-cyan-100 text-cyan-700 font-black shadow-sm">
            <span class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                <i class="fa-solid fa-circle-check"></i>
            </span>
            <span>Hệ thống đang hoạt động</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Người dùng</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">{{ number_format($totalUsers) }}</h3>
        </div>

        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Môn học</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">{{ number_format($totalSubjects) }}</h3>
        </div>

        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Tài liệu</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">{{ number_format($totalDocuments) }}</h3>
        </div>

        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Lượt tải</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">{{ number_format($totalDownloads) }}</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        <div class="xl:col-span-2 bg-white rounded-2xl border border-cyan-100 shadow-sm overflow-hidden">
            <div
                class="px-6 py-5 border-b border-cyan-100 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <div>
                    <h2 class="text-xl font-black text-slate-900">Tăng trưởng hệ thống</h2>
                    <p class="text-sm text-slate-500 font-semibold mt-1">
                        So sánh số tài liệu mới và người dùng đăng ký theo từng tháng.
                    </p>
                </div>

                <span
                    class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black border border-cyan-100 w-fit">
                    Năm {{ now()->year }}
                </span>
            </div>

            <div class="p-6">
                <div class="h-80 rounded-2xl bg-white border border-cyan-100 p-5">
                    <canvas id="growthChart"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-cyan-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-cyan-100">
                <h2 class="text-xl font-black text-slate-900">Hoạt động gần đây</h2>
                <p class="text-sm text-slate-500 font-semibold mt-1">
                    Lịch sử đăng nhập và đăng xuất.
                </p>
            </div>

            <div class="p-6 space-y-6">
                @forelse($recentActivities as $log)
                <div class="flex gap-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center shrink-0">
                        @if($log->logout_at)
                        <i class="fa-solid fa-right-from-bracket"></i>
                        @else
                        <i class="fa-solid fa-right-to-bracket"></i>
                        @endif
                    </div>

                    <div>
                        <h4 class="font-black text-slate-800">
                            {{ $log->user->full_name ?? 'Người dùng không xác định' }}
                        </h4>

                        <p class="text-sm text-slate-500 font-semibold mt-1">
                            @if($log->logout_at)
                            Đăng xuất hệ thống • {{ $log->logout_at->diffForHumans() }}
                            @elseif($log->login_at)
                            Đăng nhập hệ thống • {{ $log->login_at->diffForHumans() }}
                            @else
                            Hoạt động hệ thống
                            @endif
                        </p>
                    </div>
                </div>
                @empty
                <div class="text-center py-10">
                    <i class="fa-solid fa-clock-rotate-left text-4xl text-slate-300 mb-3"></i>
                    <p class="text-slate-500 font-bold">
                        Chưa có hoạt động nào.
                    </p>
                </div>
                @endforelse
            </div>
        </div>

    </div>

</div>
</div>

@endsection
<input type="hidden" id="chartLabelsData" value='@json($chartLabels ?? [])'>
<input type="hidden" id="documentChartData" value='@json($documentChartData ?? [])'>
<input type="hidden" id="userChartData" value='@json($userChartData ?? [])'>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('growthChart');

const chartLabels = JSON.parse(document.getElementById('chartLabelsData').value || '[]');
const documentChartData = JSON.parse(document.getElementById('documentChartData').value || '[]');
const userChartData = JSON.parse(document.getElementById('userChartData').value || '[]');

if (ctx) {
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                    label: 'Tài liệu mới',
                    data: documentChartData,
                    borderColor: '#06b6d4',
                    backgroundColor: 'rgba(6, 182, 212, 0.12)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6
                },
                {
                    label: 'Người đăng ký',
                    data: userChartData,
                    borderColor: '#8b5cf6',
                    backgroundColor: 'rgba(139, 92, 246, 0.10)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6
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
                    labels: {
                        usePointStyle: true,
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
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
                    ticks: {
                        precision: 0
                    },
                    grid: {
                        color: '#e2e8f0'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
}
</script>
@endpush