@extends('layouts.admin')

@section('title', 'Nhật ký hệ thống')
@section('page-title', 'Nhật ký hệ thống')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-white border rounded-xl shadow-sm p-6 flex justify-between items-center">
        <div>
            <h1 class="text-[16px] font-black text-slate-800">Nhật ký hệ thống</h1>
            <p class="text-[14px] text-slate-500 mt-1">
                Theo dõi hoạt động hệ thống
            </p>
        </div>

        <div class="w-12 h-12 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center border">
            <i class="fa-solid fa-clock-rotate-left"></i>
        </div>
    </div>

    {{-- FILTER --}}
    <div class="bg-white border rounded-xl p-6">

        <form method="GET" id="logsFilterForm" action="{{ route('admin.logs.index') }}"
            class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <input type="text" name="keyword" id="keywordInput" value="{{ request('keyword') }}" placeholder="Search..."
                class="h-12 px-4 rounded-xl bg-slate-50 border">

            <select name="action" id="actionSelect" class="h-12 px-4 rounded-xl bg-slate-50 border">

                <option value="">Tất cả</option>
                <option value="login" @selected(request('action')=='login' )>Login</option>
                <option value="logout" @selected(request('action')=='logout' )>Logout</option>
                <option value="register" @selected(request('action')=='register' )>Register</option>
            </select>

            <button class="h-12 bg-cyan-600 text-white font-black rounded-xl">
                Lọc
            </button>

            <button type="button" id="resetLogsButton" class="h-12 bg-slate-100 font-black rounded-xl">
                Reset
            </button>

        </form>
    </div>
    <div id="logs-list-area" class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">

        <div class="overflow-x-auto">



            <table class="w-full">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr class="text-xs font-black uppercase text-slate-500">

                        <!-- STT -->
                        <th class="w-16 px-4 py-4 text-center">
                            STT
                        </th>

                        <!-- Người dùng -->
                        <th class="w-72 px-4 py-4 text-left">
                            Người dùng
                        </th>

                        <!-- Hành động -->
                        <th class="w-36 px-4 py-4 text-center">
                            Hành động
                        </th>

                        <!-- Mô tả -->
                        <th class="px-4 py-4 text-left">
                            Mô tả
                        </th>

                        <!-- IP -->
                        <th class="w-40 px-4 py-4 text-center">
                            Địa chỉ IP
                        </th>

                        <!-- Thời gian -->
                        <th class="w-48 px-4 py-4 text-center">
                            Thời gian
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($logs as $index => $log)

                    @php

                    $user = $log->user;
                    $name = $user->full_name ?? 'System';

                    if($log->login_at && !$log->logout_at){

                    $action='LOGIN';
                    $badge='bg-emerald-50 text-emerald-600';

                    }elseif($log->logout_at){

                    $action='LOGOUT';
                    $badge='bg-orange-50 text-orange-600';

                    }else{

                    $action='REGISTER';
                    $badge='bg-sky-50 text-sky-600';

                    }

                    $time = $log->logout_at ?? $log->login_at ?? $log->created_at;

                    @endphp

                    <tr class="hover:bg-slate-50 transition">

                        <!-- STT -->
                        <td class="px-4 py-4 text-center">

                            <span class="font-black text-slate-500">

                                {{ $logs->firstItem() + $index }}

                            </span>

                        </td>

                        <!-- Người dùng -->
                        <td class="px-4 py-4">

                            <div class="flex items-center gap-3">

                                <div
                                    class="w-10 h-10 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center shrink-0">

                                    <i class="fa-solid fa-user"></i>

                                </div>

                                <span class="font-bold text-slate-700 whitespace-nowrap">

                                    {{ $name }}

                                </span>

                            </div>

                        </td>

                        <!-- Hành động -->
                        <td class="px-4 py-4 text-center">

                            <span
                                class="inline-flex items-center justify-center w-24 h-8 rounded-md text-xs font-black {{ $badge }}">

                                {{ $action }}

                            </span>

                        </td>

                        <!-- Mô tả -->
                        <td class="px-4 py-4">

                            <span class="text-sm text-slate-600">

                                {{ $log->description ?? '-' }}

                            </span>

                        </td>

                        <!-- IP -->
                        <td class="px-4 py-4 text-center whitespace-nowrap">

                            <span class="font-medium text-slate-600">

                                {{ $log->ip_address ?? '-' }}

                            </span>

                        </td>

                        <!-- Thời gian -->
                        <td class="px-4 py-4 text-center whitespace-nowrap">

                            <span class="font-semibold text-slate-700">

                                {{ \Carbon\Carbon::parse($time)->format('d/m/Y H:i') }}

                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="py-14 text-center">

                            <div
                                class="w-16 h-16 mx-auto rounded-md bg-slate-100 text-slate-400 flex items-center justify-center mb-3">

                                <i class="fa-solid fa-clock-rotate-left text-2xl"></i>

                            </div>

                            <p class="text-sm font-black text-slate-500">

                                Chưa có nhật ký nào

                            </p>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

            </table>
        </div>

        {{-- Phân trang giữ nguyên --}}

        <!-- PAGINATION -->
        <div
            class="mt-5 bg-white border border-slate-200 rounded-md shadow-sm px-5 py-4 flex flex-col md:flex-row items-center justify-between gap-4">

            <p class="text-sm font-bold text-slate-500">
                Hiển thị
                <span class="text-sky-600">{{ $logs->firstItem() ?? 0 }}</span>
                -
                <span class="text-sky-600">{{ $logs->lastItem() ?? 0 }}</span>
                trong tổng
                <span class="text-sky-600">{{ $logs->total() }}</span>
                người dùng
            </p>

            <div class="flex items-center gap-2">

                @if ($logs->onFirstPage())
                <span
                    class="w-10 h-10 rounded-md bg-slate-50 border border-slate-200 text-slate-300 flex items-center justify-center cursor-not-allowed">
                    <i class="fa-solid fa-angle-left"></i>
                </span>
                @else
                <a href="{{ $logs->previousPageUrl() }}"
                    class="ajax-user-page w-10 h-10 rounded-md bg-white border border-slate-200 text-slate-500 hover:bg-sky-500 hover:text-white hover:border-sky-500 flex items-center justify-center transition">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
                @endif

                @for ($page = 1; $page <= max($logs->lastPage(), 1); $page++)
                    @if ($page == $logs->currentPage())
                    <span
                        class="w-10 h-10 rounded-md bg-sky-500 text-white flex items-center justify-center font-black">
                        {{ $page }}
                    </span>
                    @else
                    <a href="{{ $logs->url($page) }}"
                        class="ajax-user-page w-10 h-10 rounded-md bg-white border border-slate-200 text-slate-500 hover:bg-sky-500 hover:text-white hover:border-sky-500 flex items-center justify-center font-bold transition">
                        {{ $page }}
                    </a>
                    @endif
                    @endfor

                    @if ($logs->hasMorePages())
                    <a href="{{ $logs->nextPageUrl() }}"
                        class="ajax-user-page w-10 h-10 rounded-md bg-white border border-slate-200 text-slate-500 hover:bg-sky-500 hover:text-white hover:border-sky-500 flex items-center justify-center transition">
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                    @else
                    <span
                        class="w-10 h-10 rounded-md bg-slate-50 border border-slate-200 text-slate-300 flex items-center justify-center cursor-not-allowed">
                        <i class="fa-solid fa-angle-right"></i>
                    </span>
                    @endif

            </div>
        </div>

    </div>

</div>

</div>

@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const form = document.getElementById('logsFilterForm');
    const keyword = document.getElementById('keywordInput');
    const action = document.getElementById('actionSelect');
    const reset = document.getElementById('resetLogsButton');
    const area = document.getElementById('logs-list-area');

    let timer = null;

    function buildUrl() {
        const params = new URLSearchParams();

        const kw = keyword.value.trim();
        const ac = action.value;

        if (kw) params.append('keyword', kw);
        if (ac) params.append('action', ac);

        return form.getAttribute('action') + (params.toString() ? '?' + params.toString() : '');
    }

    function load(url) {

        area.style.opacity = 0.5;

        fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.text())
            .then(html => {

                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                const newArea = doc.getElementById('logs-list-area');

                if (newArea) {
                    area.innerHTML = newArea.innerHTML;
                    window.history.pushState({}, '', url);
                }

            })
            .finally(() => {
                area.style.opacity = 1;
            });
    }

    // SEARCH (FIX debounce)
    keyword.addEventListener('input', function() {
        clearTimeout(timer);
        timer = setTimeout(() => {
            load(buildUrl());
        }, 400);
    });

    // FILTER
    action.addEventListener('change', function() {
        load(buildUrl());
    });

    // SUBMIT
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        load(buildUrl());
    });

    // RESET (FIX QUAN TRỌNG)
    reset.addEventListener('click', function() {
        keyword.value = '';
        action.value = '';
        load(form.getAttribute('action'));
    });

});
</script>
@endpush