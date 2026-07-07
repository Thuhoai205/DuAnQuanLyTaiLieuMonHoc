@extends('layouts.admin')

@section('title', 'Nhật ký hệ thống')
@section('page-title', 'Nhật ký hệ thống')

@section('content')

<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h2 class="text-2xl font-black text-slate-800">

                    Nhật ký hệ thống

                </h2>

                <p class="mt-2 text-sm text-slate-500">

                    Theo dõi toàn bộ hoạt động của người dùng và hệ thống.

                </p>

            </div>

            <div class="w-14
                h-14
                rounded-xl
                bg-amber-50
                text-amber-500
                flex
                items-center
                justify-center">

                <i class="fa-solid fa-clock-rotate-left text-xl"></i>

            </div>

        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">

        <form method="GET" id="logsFilterForm" action="{{ route('admin.logs.index') }}"
            class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <!-- SEARCH -->
            <input type="text" name="keyword" id="keywordInput" value="{{ request('keyword') }}"
                placeholder="Tìm kiếm người dùng hoặc mô tả..." class="h-12
                px-4
                rounded-xl
                border
                border-slate-200
                bg-slate-50
                text-sm
                font-medium
                text-slate-700
                placeholder:text-slate-400
                outline-none
                transition-all
                duration-300
                focus:bg-white
                focus:border-amber-500
                focus:ring-4
                focus:ring-amber-100">

            <!-- ACTION -->
            <select name="action" id="actionSelect" class="h-12
                px-4
                rounded-xl
                border
                border-slate-200
                bg-slate-50
                text-sm
                font-medium
                text-slate-700
                outline-none
                transition-all
                duration-300
                focus:bg-white
                focus:border-amber-500
                focus:ring-4
                focus:ring-amber-100">

                <option value="">Tất cả hoạt động</option>

                <option value="login" @selected(request('action')=='login' )>

                    Đăng nhập

                </option>

                <option value="logout" @selected(request('action')=='logout' )>

                    Đăng xuất

                </option>

                <option value="register" @selected(request('action')=='register' )>

                    Đăng ký

                </option>

            </select>

            <!-- FILTER BUTTON -->
            <button type="submit" class="rounded-xl
                bg-amber-500
                text-white
                text-sm
                font-bold
                hover:bg-amber-600
                transition-all
                duration-300">

                Lọc dữ liệu

            </button>

            <!-- RESET -->
            <button type="button" id="resetLogsButton" class="rounded-xl
                border
                border-slate-200
                bg-white
                text-slate-700
                text-sm
                font-semibold
                hover:bg-slate-50
                transition-all
                duration-300">

                Đặt lại

            </button>

        </form>

    </div>

    <!-- TABLE -->
    <div id="logs-list-area" class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <!-- TABLE HEADER -->
                <thead class="bg-slate-50/80 border-b border-slate-200">

                    <tr class="text-[13px] font-black uppercase tracking-wide text-slate-600">

                        <!-- STT -->
                        <th class="w-16 px-6 py-4 text-center">

                            STT

                        </th>

                        <!-- USER -->
                        <th class="w-80 px-6 py-4 text-left">

                            Người dùng

                        </th>

                        <!-- ACTION -->
                        <th class="w-40 px-6 py-4 text-center">

                            Hoạt động

                        </th>

                        <!-- DESCRIPTION -->
                        <th class="px-6 py-4 text-left">

                            Nội dung

                        </th>

                        <!-- IP -->
                        <th class="w-44 px-6 py-4 text-center">

                            Địa chỉ IP

                        </th>

                        <!-- TIME -->
                        <th class="w-52 px-6 py-4 text-center">

                            Thời gian

                        </th>

                    </tr>

                </thead>

                <!-- TABLE BODY -->
                <tbody class="divide-y divide-slate-100">

                    @forelse($logs as $index => $log)

                    @php

                    $user = $log->user;

                    $name = $user->full_name ?? 'Hệ thống';

                    if($log->login_at && !$log->logout_at){

                    $action='Đăng nhập';
                    $badge='bg-emerald-50 text-emerald-600 border border-emerald-100';

                    }elseif($log->logout_at){

                    $action='Đăng xuất';
                    $badge='bg-orange-50 text-orange-600 border border-orange-100';

                    }else{

                    $action='Đăng ký';
                    $badge='bg-sky-50 text-sky-600 border border-sky-100';

                    }

                    $time = $log->logout_at ?? $log->login_at ?? $log->created_at;

                    @endphp

                    <tr class="hover:bg-amber-50/40 transition-all duration-300">

                        <!-- STT -->
                        <td class="px-6 py-5 text-center">

                            <span class="font-black text-slate-500">

                                {{ $logs->firstItem() + $index }}

                            </span>

                        </td>

                        <!-- USER -->
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <div class="w-11
                                    h-11
                                    rounded-full
                                    bg-amber-50
                                    text-amber-500
                                    flex
                                    items-center
                                    justify-center
                                    shrink-0">

                                    <i class="fa-solid fa-user"></i>

                                </div>

                                <div>

                                    <h4 class="text-sm font-black text-slate-800">

                                        {{ $name }}

                                    </h4>

                                    <p class="mt-1 text-xs text-slate-500">

                                        {{ $user->email ?? 'Tài khoản hệ thống' }}

                                    </p>

                                </div>

                            </div>

                        </td>
                        <!-- ACTION -->
                        <td class="px-6 py-5 text-center">

                            <span class="inline-flex
                                items-center
                                justify-center
                                min-w-[110px]
                                rounded-full
                                px-4
                                py-2
                                text-xs
                                font-bold
                                {{ $badge }}">

                                {{ $action }}

                            </span>

                        </td>

                        <!-- DESCRIPTION -->
                        <td class="px-6 py-5">

                            <p class="text-sm
                                text-slate-600
                                leading-6">

                                {{ $log->description ?? 'Không có mô tả.' }}

                            </p>

                        </td>

                        <!-- IP ADDRESS -->
                        <td class="px-6 py-5 text-center">

                            <span class="inline-flex
                                items-center
                                rounded-full
                                bg-slate-100
                                px-3
                                py-1
                                text-xs
                                font-semibold
                                text-slate-700">

                                {{ $log->ip_address ?? '---' }}

                            </span>

                        </td>

                        <!-- TIME -->
                        <td class="px-6 py-5 text-center">

                            <div class="flex
                                flex-col
                                items-center">

                                <span class="font-bold text-slate-700">

                                    {{ \Carbon\Carbon::parse($time)->format('d/m/Y') }}

                                </span>

                                <span class="mt-1 text-xs text-slate-500">

                                    {{ \Carbon\Carbon::parse($time)->format('H:i:s') }}

                                </span>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="py-20">

                            <div class="flex flex-col items-center">

                                <!-- ICON -->
                                <div class="w-20
                                h-20
                                rounded-full
                                bg-amber-50
                                flex
                                items-center
                                justify-center">

                                    <i class="fa-solid fa-clock-rotate-left text-3xl text-amber-400"></i>

                                </div>

                                <!-- TITLE -->
                                <h3 class="mt-5 text-lg font-black text-slate-800">

                                    Chưa có nhật ký nào

                                </h3>

                                <!-- DESCRIPTION -->
                                <p class="mt-2 text-sm font-medium text-slate-500">

                                    Hiện tại chưa có hoạt động nào được ghi nhận trong hệ thống.

                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if($logs->count())

        <div class="border-t border-slate-200 bg-slate-50 px-6 py-5">

            <div class="flex flex-col md:flex-row items-center justify-between gap-4">

                <!-- INFO -->
                <p class="text-sm font-medium text-slate-500">

                    Hiển thị

                    <span class="font-bold text-amber-500">
                        {{ $logs->firstItem() ?? 0 }}
                    </span>

                    -

                    <span class="font-bold text-amber-500">
                        {{ $logs->lastItem() ?? 0 }}
                    </span>

                    trong tổng

                    <span class="font-bold text-amber-500">
                        {{ $logs->total() }}
                    </span>

                    nhật ký

                </p>

                <!-- PAGINATION -->
                <div class="flex items-center gap-2">

                    {{-- Previous --}}
                    @if ($logs->onFirstPage())

                    <span class="w-10 h-10 rounded-xl
                bg-white
                border border-slate-200
                text-slate-300
                flex items-center justify-center
                cursor-not-allowed">

                        <i class="fa-solid fa-angle-left"></i>

                    </span>

                    @else

                    <a href="{{ $logs->previousPageUrl() }}" class="ajax-log-page
                w-10 h-10
                rounded-xl
                bg-white
                border border-slate-200
                text-slate-600
                hover:bg-amber-500
                hover:border-amber-500
                hover:text-white
                flex items-center justify-center
                transition-all duration-300">

                        <i class="fa-solid fa-angle-left"></i>

                    </a>

                    @endif


                    {{-- Page Number --}}
                    @for ($page = 1; $page <= max($logs->lastPage(),1); $page++)

                        @if ($page == $logs->currentPage())

                        <span class="w-10 h-10
                    rounded-xl
                    bg-amber-500
                    text-white
                    font-bold
                    flex items-center justify-center">

                            {{ $page }}

                        </span>

                        @else

                        <a href="{{ $logs->url($page) }}" class="ajax-log-page
                    w-10 h-10
                    rounded-xl
                    bg-white
                    border border-slate-200
                    text-slate-600
                    font-semibold
                    hover:bg-amber-500
                    hover:border-amber-500
                    hover:text-white
                    flex items-center justify-center
                    transition-all duration-300">

                            {{ $page }}

                        </a>

                        @endif

                        @endfor


                        {{-- Next --}}
                        @if ($logs->hasMorePages())

                        <a href="{{ $logs->nextPageUrl() }}" class="ajax-log-page
                w-10 h-10
                rounded-xl
                bg-white
                border border-slate-200
                text-slate-600
                hover:bg-amber-500
                hover:border-amber-500
                hover:text-white
                flex items-center justify-center
                transition-all duration-300">

                            <i class="fa-solid fa-angle-right"></i>

                        </a>

                        @else

                        <span class="w-10 h-10
                rounded-xl
                bg-white
                border border-slate-200
                text-slate-300
                flex items-center justify-center
                cursor-not-allowed">

                            <i class="fa-solid fa-angle-right"></i>

                        </span>

                        @endif

                </div>

            </div>

        </div>

        @endif

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

    //==========================
    // BUILD URL
    //==========================
    function buildUrl(page = null) {

        const params = new URLSearchParams();

        const kw = keyword.value.trim();
        const ac = action.value;

        if (kw) params.append('keyword', kw);
        if (ac) params.append('action', ac);

        if (page) {
            params.append('page', page);
        }

        return form.action + (params.toString() ? '?' + params.toString() : '');

    }

    //==========================
    // LOAD AJAX
    //==========================
    function load(url) {

        area.style.opacity = '.5';

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

                    history.pushState({}, '', url);

                }

            })
            .finally(() => {

                area.style.opacity = '1';

            });

    }

    //==========================
    // SEARCH
    //==========================
    keyword.addEventListener('input', function() {

        clearTimeout(timer);

        timer = setTimeout(() => {

            load(buildUrl());

        }, 400);

    });

    //==========================
    // FILTER
    //==========================
    action.addEventListener('change', function() {

        load(buildUrl());

    });

    //==========================
    // SUBMIT
    //==========================
    form.addEventListener('submit', function(e) {

        e.preventDefault();

        load(buildUrl());

    });

    //==========================
    // RESET
    //==========================
    reset.addEventListener('click', function() {

        form.reset();

        load(form.action);

    });

    //==========================
    // AJAX PAGINATION
    //==========================
    document.addEventListener('click', function(e) {

        const link = e.target.closest('.ajax-log-page');

        if (!link) return;

        e.preventDefault();

        load(link.href);

    });

    //==========================
    // BACK BUTTON
    //==========================
    window.addEventListener('popstate', function() {

        load(location.href);

    });

});
</script>
@endpush