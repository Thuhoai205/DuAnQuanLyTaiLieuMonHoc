@extends('layouts.admin')

@section('title', 'Nhật ký hệ thống')
@section('page-title', 'Nhật ký hệ thống')

@section('content')

@php
$totalLogs = $totalLogs ?? \App\Models\ActivityLog::count();
$totalLoginLogs = $totalLoginLogs ?? \App\Models\ActivityLog::where('action', 'login')->count();
$totalLogoutLogs = $totalLogoutLogs ?? \App\Models\ActivityLog::where('action', 'logout')->count();
$unreadLogsCount = $unreadLogsCount ?? \App\Models\ActivityLog::where('is_read', false)->count();
@endphp

<div class="max-w-7xl mx-auto px-2 lg:px-4">

    <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="text-3xl font-black text-slate-900">
                Nhật ký hệ thống
            </h1>

            <p class="text-slate-500 font-semibold mt-2">
                Theo dõi lịch sử đăng nhập và đăng xuất của người dùng trong hệ thống.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            @if($unreadLogsCount > 0)
            <form action="{{ route('admin.logs.readAll') }}" method="POST">
                @csrf

                <button type="submit"
                    class="group inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-emerald-600 text-white font-black shadow-lg shadow-emerald-100 hover:bg-emerald-700 hover:-translate-y-0.5 transition-all">
                    <span class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                        <i class="fa-solid fa-check-double"></i>
                    </span>
                    Đánh dấu đã đọc
                </button>
            </form>
            @endif

            <div
                class="w-16 h-16 rounded-3xl bg-cyan-50 text-cyan-600 border border-cyan-100 flex items-center justify-center shadow-sm">
                <i class="fa-solid fa-clock-rotate-left text-2xl"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

        <div
            class="group bg-white rounded-[28px] border border-cyan-100 p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-cyan-100/70 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                        Tổng nhật ký
                    </p>

                    <h3 class="text-4xl font-black text-cyan-700 mt-2">
                        {{ number_format($totalLogs) }}
                    </h3>
                </div>

                <div
                    class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white transition">
                    <i class="fa-solid fa-list text-xl"></i>
                </div>
            </div>
        </div>

        <div
            class="group bg-white rounded-[28px] border border-emerald-100 p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-100/70 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                        Đăng nhập
                    </p>

                    <h3 class="text-4xl font-black text-emerald-700 mt-2">
                        {{ number_format($totalLoginLogs) }}
                    </h3>
                </div>

                <div
                    class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition">
                    <i class="fa-solid fa-right-to-bracket text-xl"></i>
                </div>
            </div>
        </div>

        <div
            class="group bg-white rounded-[28px] border border-orange-100 p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-orange-100/70 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                        Đăng xuất
                    </p>

                    <h3 class="text-4xl font-black text-orange-700 mt-2">
                        {{ number_format($totalLogoutLogs) }}
                    </h3>
                </div>

                <div
                    class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center group-hover:bg-orange-500 group-hover:text-white transition">
                    <i class="fa-solid fa-right-from-bracket text-xl"></i>
                </div>
            </div>
        </div>

        <div
            class="group bg-white rounded-[28px] border border-red-100 p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-red-100/70 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                        Chưa đọc
                    </p>

                    <h3 class="text-4xl font-black text-red-600 mt-2">
                        {{ number_format($unreadLogsCount) }}
                    </h3>
                </div>

                <div
                    class="w-14 h-14 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center group-hover:bg-red-500 group-hover:text-white transition">
                    <i class="fa-solid fa-bell text-xl"></i>
                </div>
            </div>
        </div>

    </div>

    <div
        class="bg-white rounded-[34px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] overflow-hidden mb-8">
        <div
            class="px-7 py-6 bg-gradient-to-r from-cyan-50 to-sky-50 border-b border-cyan-100 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div class="flex items-start gap-4">
                <div
                    class="w-14 h-14 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-100">
                    <i class="fa-solid fa-filter text-xl"></i>
                </div>

                <div>
                    <h2 class="text-2xl font-black text-slate-900">
                        Bộ lọc nhật ký
                    </h2>

                    <p class="text-slate-500 font-semibold mt-1">
                        Tìm kiếm theo người dùng, nội dung, hành động hoặc địa chỉ IP.
                    </p>
                </div>
            </div>

            <span
                class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-white text-cyan-700 text-sm font-black border border-cyan-100 shadow-sm">
                {{ number_format($logs->total()) }} bản ghi
            </span>
        </div>

        <div class="p-5">
            <form method="GET" action="{{ route('admin.logs.index') }}" id="logsFilterForm"
                class="grid grid-cols-1 md:grid-cols-6 gap-4">

                <div class="md:col-span-3 relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-cyan-600"></i>

                    <input type="text" name="keyword" id="keywordInput" value="{{ request('keyword') }}"
                        placeholder="Tìm theo tên người dùng, nội dung, IP..."
                        class="w-full h-12 pl-14 pr-5 rounded-xl bg-slate-50 border border-slate-200 outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700">
                </div>

                <select name="action" id="actionSelect"
                    class="h-12 px-4 rounded-xl bg-slate-50 border border-slate-200 outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700">
                    <option value="">Tất cả hành động</option>
                    <option value="login" @selected(request('action')==='login' )>Đăng nhập</option>
                    <option value="logout" @selected(request('action')==='logout' )>Đăng xuất</option>
                </select>

                <button type="submit"
                    class="h-12 rounded-xl bg-cyan-600 text-white font-black hover:bg-cyan-700 transition">
                    <i class="fa-solid fa-filter mr-2"></i>
                    Lọc
                </button>

                <button type="button" id="resetLogsButton"
                    class="h-12 rounded-xl bg-slate-100 text-slate-700 font-black flex items-center justify-center hover:bg-slate-200 transition">
                    Reset
                </button>
            </form>
        </div>
    </div>

    <div id="logs-list-area" class="transition-opacity duration-200">
        <div
            class="bg-white rounded-[34px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] overflow-hidden">

            <div
                class="px-7 py-6 border-b border-cyan-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-xl font-black text-slate-900">
                        Danh sách nhật ký
                    </h2>

                    <p class="text-sm text-slate-500 font-semibold mt-1">
                        Hiển thị lịch sử đăng nhập và đăng xuất mới nhất.
                    </p>
                </div>

                <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black border border-cyan-100">
                    {{ number_format($logs->total()) }} bản ghi
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[1050px] text-left">
                    <thead class="bg-slate-50 border-b border-cyan-100">
                        <tr>
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500">
                                STT
                            </th>

                            <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500">
                                Người dùng
                            </th>

                            <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500">
                                Hành động
                            </th>

                            <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500">
                                Nội dung
                            </th>

                            <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500">
                                Trạng thái
                            </th>

                            <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500">
                                IP
                            </th>

                            <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-500">
                                Thời gian
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse($logs as $index => $log)
                        @php
                        $action = $log->action ?? '-';

                        if ($action === 'login') {
                        $actionLabel = 'Đăng nhập';
                        $actionClass = 'bg-emerald-50 text-emerald-600 border-emerald-100';
                        $actionIcon = 'fa-solid fa-right-to-bracket';
                        $time = $log->login_at ?? $log->created_at;
                        } elseif ($action === 'logout') {
                        $actionLabel = 'Đăng xuất';
                        $actionClass = 'bg-orange-50 text-orange-600 border-orange-100';
                        $actionIcon = 'fa-solid fa-right-from-bracket';
                        $time = $log->logout_at ?? $log->created_at;
                        } else {
                        $actionLabel = $action;
                        $actionClass = 'bg-slate-100 text-slate-600 border-slate-200';
                        $actionIcon = 'fa-solid fa-circle-info';
                        $time = $log->created_at;
                        }

                        $user = $log->user;
                        $userName = $user->full_name ?? 'Hệ thống';
                        $userEmail = $user->email ?? null;
                        $avatar = $user->avatar ?? null;
                        $description = $log->description ?? 'Không có nội dung';
                        @endphp

                        <tr class="hover:bg-cyan-50/40 transition">
                            <td class="px-6 py-5 text-sm font-bold text-slate-500">
                                {{ $logs->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3 min-w-[230px]">
                                    @if($avatar)
                                    <img src="{{ asset('storage/' . $avatar) }}" alt="{{ $userName }}"
                                        class="w-11 h-11 rounded-2xl object-cover border border-cyan-100">
                                    @else
                                    <div
                                        class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 border border-cyan-100 flex items-center justify-center font-black">
                                        {{ mb_substr($userName, 0, 1) }}
                                    </div>
                                    @endif

                                    <div class="min-w-0">
                                        <p class="font-black text-slate-800 truncate">
                                            {{ $userName }}
                                        </p>

                                        <p class="text-xs text-slate-400 font-semibold truncate">
                                            {{ $userEmail ?? 'ID: ' . ($log->user_id ?? '-') }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-black border {{ $actionClass }}">
                                    <i class="{{ $actionIcon }}"></i>
                                    {{ $actionLabel }}
                                </span>
                            </td>

                            <td class="px-6 py-5 max-w-md">
                                <p class="text-sm font-semibold text-slate-600 truncate">
                                    {{ $description }}
                                </p>
                            </td>

                            <td class="px-6 py-5">
                                @if($log->is_read)
                                <span
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-100 text-slate-500 text-xs font-black border border-slate-200">
                                    <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                    Đã đọc
                                </span>
                                @else
                                <span
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-50 text-red-500 text-xs font-black border border-red-100">
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                    Chưa đọc
                                </span>
                                @endif
                            </td>

                            <td class="px-6 py-5 text-sm font-bold text-slate-500 whitespace-nowrap">
                                {{ $log->ip_address ?? '-' }}
                            </td>

                            <td class="px-6 py-5 text-sm font-bold text-slate-500 whitespace-nowrap">
                                @if($time)
                                {{ \Carbon\Carbon::parse($time)->format('d/m/Y H:i') }}
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div
                                    class="w-20 h-20 mx-auto rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-5">
                                    <i class="fa-solid fa-clock-rotate-left text-3xl"></i>
                                </div>

                                <h3 class="text-2xl font-black text-slate-900">
                                    Chưa có nhật ký nào
                                </h3>

                                <p class="text-slate-500 font-semibold mt-2">
                                    Các hoạt động đăng nhập và đăng xuất sẽ hiển thị tại đây.
                                </p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div
                class="px-7 py-6 border-t border-cyan-100 flex flex-col md:flex-row items-center justify-between gap-5">
                <p class="text-sm font-bold text-slate-500">
                    Hiển thị
                    <span class="text-cyan-700">{{ $logs->firstItem() ?? 0 }}</span>
                    -
                    <span class="text-cyan-700">{{ $logs->lastItem() ?? 0 }}</span>
                    trong tổng
                    <span class="text-cyan-700">{{ $logs->total() }}</span>
                    nhật ký
                </p>

                <div>
                    {{ $logs->withQueryString()->links() }}
                </div>
            </div>

        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#logsFilterForm');
    const keywordInput = document.querySelector('#keywordInput');
    const actionSelect = document.querySelector('#actionSelect');
    const resetButton = document.querySelector('#resetLogsButton');
    const logsListArea = document.querySelector('#logs-list-area');

    if (!form || !logsListArea) {
        console.log('Không tìm thấy form hoặc logs-list-area');
        return;
    }

    let searchTimer = null;

    function getFilterUrl() {
        const formData = new FormData(form);
        const params = new URLSearchParams();

        for (const [key, value] of formData.entries()) {
            const cleanValue = String(value).trim();

            if (cleanValue !== '') {
                params.append(key, cleanValue);
            }
        }

        const queryString = params.toString();

        if (queryString) {
            return form.getAttribute('action') + '?' + queryString;
        }

        return form.getAttribute('action');
    }

    function loadLogs(url, pushState = true) {
        logsListArea.classList.add('opacity-40', 'pointer-events-none');

        fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(function(response) {
                return response.text();
            })
            .then(function(html) {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newLogsListArea = doc.querySelector('#logs-list-area');

                if (newLogsListArea) {
                    logsListArea.innerHTML = newLogsListArea.innerHTML;

                    if (pushState) {
                        window.history.pushState({}, '', url);
                    }
                } else {
                    console.log('Không tìm thấy #logs-list-area trong response');
                }
            })
            .catch(function(error) {
                console.log(error);
                alert('Không thể tải dữ liệu nhật ký.');
            })
            .finally(function() {
                logsListArea.classList.remove('opacity-40', 'pointer-events-none');
            });
    }

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const url = getFilterUrl();
        loadLogs(url);
    });

    if (keywordInput) {
        keywordInput.addEventListener('input', function() {
            clearTimeout(searchTimer);

            searchTimer = setTimeout(function() {
                const url = getFilterUrl();
                loadLogs(url);
            }, 500);
        });
    }

    if (actionSelect) {
        actionSelect.addEventListener('change', function() {
            const url = getFilterUrl();
            loadLogs(url);
        });
    }

    if (resetButton) {
        resetButton.addEventListener('click', function() {
            if (keywordInput) {
                keywordInput.value = '';
            }

            if (actionSelect) {
                actionSelect.value = '';
            }

            loadLogs(form.getAttribute('action'));
        });
    }

    logsListArea.addEventListener('click', function(event) {
        const link = event.target.closest('a');

        if (!link) {
            return;
        }

        if (link.href && link.href.includes('/admin/logs')) {
            event.preventDefault();
            loadLogs(link.href);
        }
    });

    window.addEventListener('popstate', function() {
        loadLogs(window.location.href, false);
    });
});
</script>


@endsection