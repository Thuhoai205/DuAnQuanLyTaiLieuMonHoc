@extends('layouts.admin')

@section('title', 'Quản lý người dùng')
@section('page-title', 'Quản lý người dùng')

@section('content')

@php
$totalUsers = $totalUsers ?? $users->total();
$totalTeachers = $totalTeachers ?? 0;
$totalStudents = $totalStudents ?? 0;
@endphp

<div class="max-w-7xl mx-auto px-2 lg:px-4">

    <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="text-3xl font-black text-slate-900">
                Quản lý người dùng
            </h1>
            <p class="text-slate-500 font-semibold mt-2">
                Quản lý tài khoản admin, giảng viên và sinh viên.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">

            <a href="{{ route('admin.users.trashed') }}"
                class="group inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-white border border-red-100 text-red-500 font-black shadow-sm hover:bg-red-500 hover:text-white hover:shadow-lg hover:shadow-red-100 transition-all">

                <span
                    class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center group-hover:bg-white/20 group-hover:text-white transition">
                    <i class="fa-solid fa-trash-restore"></i>
                </span>

                <span>Người dùng đã xóa</span>

                @if($totalTrashedUsers > 0)
                <span
                    class="min-w-7 h-7 px-2 rounded-full bg-red-500 text-white text-xs font-black flex items-center justify-center group-hover:bg-white group-hover:text-red-500 transition">
                    {{ $totalTrashedUsers }}
                </span>
                @endif
            </a>

            <a href="{{ route('admin.users.create') }}"
                class="group inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-cyan-600 text-white font-black shadow-lg shadow-cyan-100 hover:bg-cyan-700 hover:-translate-y-0.5 transition-all">

                <span class="w-10 h-10 rounded-xl bg-white/20 text-white flex items-center justify-center">
                    <i class="fa-solid fa-user-plus"></i>
                </span>

                <span>Thêm người dùng</span>
            </a>

        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Tổng người dùng</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">{{ number_format($totalUsers) }}</h3>
        </div>

        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Giảng viên</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">{{ number_format($totalTeachers) }}</h3>
        </div>

        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Sinh viên</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">{{ number_format($totalStudents) }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-cyan-100 p-5 mb-8 shadow-sm">
        <form id="user-filter-form" method="GET" action="{{ route('admin.users.index') }}"
            class="grid grid-cols-1 md:grid-cols-5 gap-4">

            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Tìm theo tên, email, username..."
                class="md:col-span-2 h-12 px-4 rounded-xl bg-slate-50 border border-slate-200 outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500">

            <select name="role_id"
                class="h-12 px-4 rounded-xl bg-slate-50 border border-slate-200 outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500">
                <option value="">Tất cả vai trò</option>
                @foreach($roles as $role)
                <option value="{{ $role->role_id }}" @selected(request('role_id')==$role->role_id)>
                    {{ $role->role_name }}
                </option>
                @endforeach
            </select>

            <button type="submit"
                class="h-12 rounded-xl bg-cyan-600 text-white font-black hover:bg-cyan-700 transition">
                <i class="fa-solid fa-filter mr-2"></i>
                Lọc
            </button>

            <a href="{{ route('admin.users.index') }}" id="reset-user-filter"
                class="h-12 rounded-xl bg-slate-100 text-slate-700 font-black flex items-center justify-center hover:bg-slate-200 transition">
                Reset
            </a>
        </form>
    </div>

    <div id="users-table-wrapper" class="bg-white rounded-2xl border border-cyan-100 shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-cyan-100 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-black text-slate-900">Người dùng hệ thống</h2>
                <p class="text-sm text-slate-500 font-semibold mt-1">
                    Danh sách tài khoản đang hoạt động trong hệ thống.
                </p>
            </div>

            <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black border border-cyan-100">
                {{ number_format($users->total()) }} tài khoản
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-cyan-50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-black uppercase text-slate-500">Người dùng</th>
                        <th class="px-6 py-4 text-xs font-black uppercase text-slate-500">Email</th>
                        <th class="px-6 py-4 text-xs font-black uppercase text-slate-500">Vai trò</th>
                        <th class="px-6 py-4 text-xs font-black uppercase text-slate-500">Trạng thái</th>
                        <th class="px-6 py-4 text-xs font-black uppercase text-slate-500 text-right">Hành động</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-cyan-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-cyan-50/50 transition">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->full_name) . '&background=06b6d4&color=fff' }}"
                                    class="w-12 h-12 rounded-2xl object-cover">

                                <div>
                                    <h4 class="font-black text-slate-800">{{ $user->full_name }}</h4>
                                    <p class="text-sm text-slate-400 font-semibold">{{ '@' . $user->username }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-5 font-semibold text-slate-600">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-5">
                            <span
                                class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black border border-cyan-100">
                                {{ $user->role->role_name ?? 'Chưa có role' }}
                            </span>
                        </td>

                        <td class="px-6 py-5">
                            <form action="{{ route('admin.users.status', $user->user_id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                    class="px-4 py-2 rounded-full text-xs font-black transition
                                            {{ $user->is_active ? 'bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white' : 'bg-red-50 text-red-500 hover:bg-red-500 hover:text-white' }}">
                                    {{ $user->is_active ? 'Hoạt động' : 'Bị khóa' }}
                                </button>
                            </form>
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.show', $user->user_id) }}"
                                    class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 hover:bg-cyan-500 hover:text-white flex items-center justify-center transition">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="{{ route('admin.users.edit', $user->user_id) }}"
                                    class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 hover:bg-amber-500 hover:text-white flex items-center justify-center transition">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                @if($user->role_id != 1)
                                <form action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST"
                                    class="delete-user-form">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition flex items-center justify-center">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500 font-bold">
                            Không tìm thấy người dùng nào.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>




    </div>
    <div
        class="mt-8 px-7 py-6 bg-white rounded-[30px] border border-cyan-100 flex flex-col md:flex-row items-center justify-between gap-5 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
        <p class="text-sm font-bold text-slate-500">
            Hiển thị
            <span class="text-cyan-700">{{ $users->firstItem() ?? 0 }}</span>
            -
            <span class="text-cyan-700">{{ $users->lastItem() ?? 0 }}</span>
            trong tổng
            <span class="text-cyan-700">{{ $users->total() }}</span>
            người dùng
        </p>

        <div class="flex items-center gap-3">
            @if ($users->onFirstPage())
            <span
                class="w-12 h-12 rounded-2xl bg-white border border-slate-100 text-slate-300 flex items-center justify-center cursor-not-allowed">
                <i class="fa-solid fa-angle-left"></i>
            </span>
            @else
            <a href="{{ $users->previousPageUrl() }}"
                class="ajax-user-page w-12 h-12 rounded-2xl bg-white border border-cyan-100 text-slate-500 hover:bg-cyan-500 hover:text-white flex items-center justify-center transition-all">
                <i class="fa-solid fa-angle-left"></i>
            </a>
            @endif

            @for ($page = 1; $page <= max($users->lastPage(), 1); $page++)
                @if ($page == $users->currentPage())
                <span
                    class="w-12 h-12 rounded-2xl bg-cyan-500 text-white shadow-lg shadow-cyan-200 flex items-center justify-center font-black">
                    {{ $page }}
                </span>
                @else
                <a href="{{ $users->url($page) }}"
                    class="ajax-user-page w-12 h-12 rounded-2xl bg-white border border-cyan-100 text-slate-500 hover:bg-cyan-500 hover:text-white flex items-center justify-center font-bold transition-all">
                    {{ $page }}
                </a>
                @endif
                @endfor

                @if ($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}"
                    class="ajax-user-page w-12 h-12 rounded-2xl bg-white border border-cyan-100 text-slate-500 hover:bg-cyan-500 hover:text-white flex items-center justify-center transition-all">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
                @else
                <span
                    class="w-12 h-12 rounded-2xl bg-white border border-slate-100 text-slate-300 flex items-center justify-center cursor-not-allowed">
                    <i class="fa-solid fa-angle-right"></i>
                </span>
                @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('user-filter-form');
    const resetBtn = document.getElementById('reset-user-filter');

    async function loadUsers(url) {
        const wrapper = document.getElementById('users-table-wrapper');
        if (!wrapper) return;

        wrapper.classList.add('opacity-50', 'pointer-events-none');

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const html = await response.text();
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const newWrapper = doc.querySelector('#users-table-wrapper');

            if (newWrapper) {
                wrapper.innerHTML = newWrapper.innerHTML;
                window.history.pushState({}, '', url);
            }
        } finally {
            wrapper.classList.remove('opacity-50', 'pointer-events-none');
        }
    }

    form?.addEventListener('submit', function(e) {
        e.preventDefault();

        const params = new URLSearchParams(new FormData(form));
        loadUsers(form.action + '?' + params.toString());
    });

    resetBtn?.addEventListener('click', function(e) {
        e.preventDefault();

        form.reset();
        loadUsers(resetBtn.href);
    });

    document.addEventListener('click', function(e) {
        const link = e.target.closest('#users-table-wrapper .pagination a');
        if (!link) return;

        e.preventDefault();
        loadUsers(link.href);
    });
});
document.addEventListener('DOMContentLoaded', function() {

    document.querySelectorAll('.delete-user-form').forEach(form => {

        form.addEventListener('submit', function(e) {

            e.preventDefault();

            Swal.fire({
                title: 'Xóa người dùng?',
                text: 'Người dùng sẽ bị xóa mềm và có thể khôi phục lại.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy',
                reverseButtons: true
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });

        });

    });

});
</script>

@endsection