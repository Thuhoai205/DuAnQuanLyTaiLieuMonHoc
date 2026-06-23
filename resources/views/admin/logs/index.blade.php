@extends('layouts.admin')

@section('title', 'Nhật ký hệ thống')
@section('page-title', 'Nhật ký hệ thống')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-white border rounded-xl shadow-sm p-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Nhật ký hệ thống</h1>
            <p class="text-sm text-slate-500 mt-1">
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

    {{-- TABLE --}}
    <div id="logs-list-area" class="bg-white border rounded-xl overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left">

                <thead class="bg-slate-50 border-b">
                    <tr>
                        <th class="px-6 py-4">STT</th>
                        <th class="px-6 py-4">User</th>
                        <th class="px-6 py-4">Hành động</th>
                        <th class="px-6 py-4">Mô tả</th>
                        <th class="px-6 py-4">IP</th>
                        <th class="px-6 py-4">Thời gian</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($logs as $index => $log)

                    @php
                    $user = $log->user;
                    $name = $user->full_name ?? 'System';

                    if ($log->login_at && !$log->logout_at) {
                    $action = 'LOGIN';
                    $color = 'text-emerald-600';
                    } elseif ($log->logout_at) {
                    $action = 'LOGOUT';
                    $color = 'text-orange-600';
                    } else {
                    $action = 'REGISTER';
                    $color = 'text-sky-600';
                    }

                    $time = $log->logout_at ?? $log->login_at ?? $log->created_at;
                    @endphp

                    <tr class="hover:bg-slate-50">

                        <td class="px-6 py-4 font-bold text-slate-500">
                            {{ $logs->firstItem() + $index }}
                        </td>

                        <td class="px-6 py-4 font-semibold">
                            {{ $name }}
                        </td>

                        <td class="px-6 py-4 font-black {{ $color }}">
                            {{ $action }}
                        </td>

                        <td class="px-6 py-4 text-slate-600">
                            {{ $log->description ?? '-' }}
                        </td>

                        <td class="px-6 py-4 text-slate-500">
                            {{ $log->ip_address ?? '-' }}
                        </td>

                        <td class="px-6 py-4 text-slate-500">
                            {{ \Carbon\Carbon::parse($time)->format('d/m/Y H:i') }}
                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-slate-500">
                            Không có dữ liệu
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

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