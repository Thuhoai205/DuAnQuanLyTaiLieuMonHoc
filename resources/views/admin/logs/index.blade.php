@extends('layouts.admin')

@section('title', 'Nhật ký hệ thống')

@section('content')
<div class="min-h-screen bg-[#F6F7FB] px-6 py-8">

    <!-- Header -->
    <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Nhật ký hệ thống
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Theo dõi hoạt động người dùng, thông báo và các thay đổi trong hệ thống.
            </p>
        </div>

        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-100 text-violet-600">
            <i class="fa-solid fa-clock-rotate-left text-xl"></i>
        </div>
    </div>

    <!-- Filter -->
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <form method="GET" action="{{ route('admin.logs.index') }}" class="grid grid-cols-1 gap-4 md:grid-cols-12">

            <div class="relative md:col-span-6">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                <input type="text" name="keyword" value="{{ request('keyword') }}"
                    placeholder="Tìm theo nội dung, hành động, đối tượng..."
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm text-slate-700 outline-none transition focus:border-violet-400 focus:bg-white focus:ring-4 focus:ring-violet-100">
            </div>

            <div class="md:col-span-3">
                <select name="hanh_dong"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-violet-400 focus:bg-white focus:ring-4 focus:ring-violet-100">
                    <option value="">Tất cả hành động</option>
                    <option value="Thêm" {{ request('hanh_dong') == 'Thêm' ? 'selected' : '' }}>Thêm</option>
                    <option value="Sửa" {{ request('hanh_dong') == 'Sửa' ? 'selected' : '' }}>Sửa</option>
                    <option value="Xóa" {{ request('hanh_dong') == 'Xóa' ? 'selected' : '' }}>Xóa</option>
                    <option value="Upload" {{ request('hanh_dong') == 'Upload' ? 'selected' : '' }}>Upload</option>
                    <option value="Tải xuống" {{ request('hanh_dong') == 'Tải xuống' ? 'selected' : '' }}>Tải xuống
                    </option>
                    <option value="Đăng nhập" {{ request('hanh_dong') == 'Đăng nhập' ? 'selected' : '' }}>Đăng nhập
                    </option>
                </select>
            </div>

            <div class="flex gap-3 md:col-span-3">
                <button type="submit"
                    class="flex-1 rounded-xl bg-violet-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-violet-700">
                    Lọc
                </button>

                <a href="{{ route('admin.logs.index') }}"
                    class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">
            <div>
                <h2 class="font-bold text-slate-800">
                    Danh sách nhật ký
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Tổng số:
                    <span class="font-semibold text-violet-600">
                        {{ $logs->total() }}
                    </span>
                    hoạt động
                </p>
            </div>

            <span class="rounded-full bg-violet-50 px-3 py-1 text-xs font-semibold text-violet-600">
                Logs
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px] text-left">
                <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-6 py-4">STT</th>
                        <th class="px-6 py-4">Người dùng</th>
                        <th class="px-6 py-4">Hành động</th>
                        <th class="px-6 py-4">Đối tượng</th>
                        <th class="px-6 py-4">Nội dung</th>
                        <th class="px-6 py-4">Trạng thái</th>
                        <th class="px-6 py-4">IP</th>
                        <th class="px-6 py-4">Thời gian</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($logs as $index => $log)
                    <tr class="transition hover:bg-violet-50/40">
                        <td class="px-6 py-5 text-sm text-slate-500">
                            {{ $logs->firstItem() + $index }}
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500">
                                    <i class="fa-solid fa-user"></i>
                                </div>

                                <div>
                                    <p class="font-semibold text-slate-800">
                                        {{ $log->user->full_name ?? 'Hệ thống' }}
                                    </p>
                                    <p class="text-xs text-slate-400">
                                        ID: {{ $log->user_id ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            <span class="rounded-full px-3 py-1 text-xs font-semibold
                                    @if($log->hanh_dong == 'Thêm')
                                        bg-emerald-50 text-emerald-600
                                    @elseif($log->hanh_dong == 'Sửa')
                                        bg-amber-50 text-amber-600
                                    @elseif($log->hanh_dong == 'Xóa')
                                        bg-rose-50 text-rose-600
                                    @elseif($log->hanh_dong == 'Upload')
                                        bg-indigo-50 text-indigo-600
                                    @elseif($log->hanh_dong == 'Tải xuống')
                                        bg-blue-50 text-blue-600
                                    @else
                                        bg-slate-100 text-slate-600
                                    @endif">
                                {{ $log->hanh_dong }}
                            </span>
                        </td>

                        <td class="px-6 py-5 text-sm text-slate-500">
                            {{ $log->doi_tuong ?? '-' }}
                        </td>

                        <td class="px-6 py-5 text-sm text-slate-600">
                            {{ $log->noi_dung }}
                        </td>

                        <td class="px-6 py-5">
                            @if($log->da_doc)
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-500">
                                Đã đọc
                            </span>
                            @else
                            <span class="rounded-full bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-600">
                                Chưa đọc
                            </span>
                            @endif
                        </td>

                        <td class="px-6 py-5 text-sm text-slate-500">
                            {{ $log->ip_address ?? '-' }}
                        </td>

                        <td class="px-6 py-5 text-sm text-slate-500">
                            {{ $log->created_at->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-16 text-center">
                            <div
                                class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                <i class="fa-solid fa-clock-rotate-left text-2xl"></i>
                            </div>
                            <h3 class="font-semibold text-slate-700">
                                Chưa có nhật ký nào
                            </h3>
                            <p class="mt-1 text-sm text-slate-500">
                                Các hoạt động trong hệ thống sẽ hiển thị tại đây.
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-200 px-6 py-4">
            {{ $logs->appends(request()->query())->links() }}
        </div>
    </div>

</div>
@endsection