@extends('layouts.admin')

@section('title', 'Quản lý người dùng')
@section('page-title', 'Quản lý người dùng')

@section('content')

@php
$totalUsers = $totalUsers ?? $users->total();
$totalTeachers = $totalTeachers ?? 0;
$totalStudents = $totalStudents ?? 0;
$totalTrashedUsers = $totalTrashedUsers ?? 0;
@endphp

<div class="space-y-6">

    <!-- PAGE ACTIONS -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <h2 class="text-lg font-black text-slate-700">
                    Danh sách người dùng
                </h2>

                <p class="text-sm text-slate-500 font-semibold mt-1">
                    Quản lý tài khoản Admin, Giảng viên và Sinh viên trong hệ thống.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">

                <a href="{{ route('admin.users.trashed') }}"
                    class="inline-flex items-center gap-2 h-11 px-4 rounded-md bg-white border border-red-200 text-red-500 text-sm font-black hover:bg-red-500 hover:text-white transition">
                    <i class="fa-solid fa-trash-can-arrow-up"></i>

                    <span>Đã xóa</span>

                    @if($totalTrashedUsers > 0)
                    <span
                        class="min-w-6 h-6 px-2 rounded-full bg-red-500 text-white text-xs font-black flex items-center justify-center">
                        {{ $totalTrashedUsers }}
                    </span>
                    @endif
                </a>

                <a href="{{ route('admin.users.create') }}"
                    class="inline-flex items-center gap-2 h-11 px-4 rounded-md bg-sky-500 text-white text-sm font-black hover:bg-sky-600 transition">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Thêm người dùng</span>
                </a>

            </div>
        </div>
    </div>

    <!-- SUMMARY CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase text-slate-400">
                        Tổng người dùng
                    </p>

                    <h3 class="text-2xl font-black text-slate-700 mt-2">
                        {{ number_format($totalUsers) }}
                    </h3>

                    <p class="text-xs font-semibold text-slate-400 mt-1">
                        Tài khoản trong hệ thống
                    </p>
                </div>

                <div class="w-11 h-11 rounded-md bg-sky-500 text-white flex items-center justify-center">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase text-slate-400">
                        Giảng viên
                    </p>

                    <h3 class="text-2xl font-black text-slate-700 mt-2">
                        {{ number_format($totalTeachers) }}
                    </h3>

                    <p class="text-xs font-semibold text-slate-400 mt-1">
                        Tài khoản giảng viên
                    </p>
                </div>

                <div class="w-11 h-11 rounded-md bg-emerald-500 text-white flex items-center justify-center">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase text-slate-400">
                        Sinh viên
                    </p>

                    <h3 class="text-2xl font-black text-slate-700 mt-2">
                        {{ number_format($totalStudents) }}
                    </h3>

                    <p class="text-xs font-semibold text-slate-400 mt-1">
                        Tài khoản sinh viên
                    </p>
                </div>

                <div class="w-11 h-11 rounded-md bg-amber-500 text-white flex items-center justify-center">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">
        <form id="user-filter-form" method="GET" action="{{ route('admin.users.index') }}"
            class="grid grid-cols-1 md:grid-cols-5 gap-4">

            <div class="md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Tìm theo tên, email, username..."
                    class="w-full h-11 px-4 rounded-md bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-600 outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500">
            </div>

            <div>
                <select name="role_id"
                    class="w-full h-11 px-4 rounded-md bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-600 outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500">
                    <option value="">Tất cả vai trò</option>

                    @foreach($roles as $role)
                    <option value="{{ $role->role_id }}" @selected(request('role_id')==$role->role_id)>
                        {{ $role->role_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="h-11 rounded-md bg-sky-500 text-white text-sm font-black hover:bg-sky-600 transition">
                <i class="fa-solid fa-filter mr-2"></i>
                Lọc
            </button>

            <a href="{{ route('admin.users.index') }}" id="reset-user-filter"
                class="h-11 rounded-md bg-slate-100 text-slate-600 text-sm font-black flex items-center justify-center hover:bg-slate-200 transition">
                Reset
            </a>

        </form>
    </div>

    <!-- USERS LIST -->
    <div id="users-list-wrapper">

        <div id="users-table-wrapper" class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">

            <div
                class="px-5 py-4 border-b border-slate-200 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <div>
                    <h2 class="text-sm font-black text-slate-700">
                        Người dùng hệ thống
                    </h2>

                    <p class="text-xs text-slate-400 font-semibold mt-1">
                        Danh sách tài khoản đang hoạt động trong hệ thống.
                    </p>
                </div>

                <span class="px-3 py-1 rounded bg-sky-50 text-sky-600 text-xs font-black border border-sky-100 w-fit">
                    {{ number_format($users->total()) }} tài khoản
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-5 py-4 text-xs font-black uppercase text-slate-500">
                                Người dùng
                            </th>

                            <th class="px-5 py-4 text-xs font-black uppercase text-slate-500">
                                Email
                            </th>

                            <th class="px-5 py-4 text-xs font-black uppercase text-slate-500">
                                Vai trò
                            </th>

                            <th class="px-5 py-4 text-xs font-black uppercase text-slate-500">
                                Trạng thái
                            </th>

                            <th class="px-5 py-4 text-xs font-black uppercase text-slate-500 text-right">
                                Hành động
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse($users as $user)
                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->full_name) . '&background=0ea5e9&color=fff' }}"
                                        class="w-11 h-11 rounded-md object-cover border border-slate-200">

                                    <div class="min-w-0">
                                        <h4 class="font-black text-slate-700 truncate">
                                            {{ $user->full_name }}
                                        </h4>

                                        <p class="text-xs text-slate-400 font-semibold mt-1 truncate">
                                            {{ '@' . $user->username }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                <span class="text-sm font-semibold text-slate-600">
                                    {{ $user->email }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <span class="px-3 py-1 rounded bg-slate-100 text-slate-600 text-xs font-black">
                                    {{ $user->role->role_name ?? 'Chưa có role' }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <form action="{{ route('admin.users.status', $user->user_id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="px-3 py-1 rounded text-xs font-black transition
                                                {{ $user->is_active
                                                    ? 'bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white'
                                                    : 'bg-red-50 text-red-500 hover:bg-red-500 hover:text-white' }}">
                                        {{ $user->is_active ? 'Hoạt động' : 'Bị khóa' }}
                                    </button>
                                </form>
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">

                                    <a href="{{ route('admin.users.show', $user->user_id) }}"
                                        class="w-9 h-9 rounded-md bg-sky-50 text-sky-600 hover:bg-sky-500 hover:text-white flex items-center justify-center transition">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.users.edit', $user->user_id) }}"
                                        class="w-9 h-9 rounded-md bg-amber-50 text-amber-500 hover:bg-amber-500 hover:text-white flex items-center justify-center transition">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    @if($user->role_id != 1)
                                    <form action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST"
                                        class="delete-user-form">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="w-9 h-9 rounded-md bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition flex items-center justify-center">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif

                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center">
                                <div
                                    class="w-14 h-14 mx-auto rounded-md bg-slate-100 text-slate-400 flex items-center justify-center mb-3">
                                    <i class="fa-solid fa-users text-xl"></i>
                                </div>

                                <p class="text-sm font-bold text-slate-500">
                                    Không tìm thấy người dùng nào.
                                </p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        <!-- PAGINATION -->
        <div
            class="mt-5 bg-white border border-slate-200 rounded-md shadow-sm px-5 py-4 flex flex-col md:flex-row items-center justify-between gap-4">

            <p class="text-sm font-bold text-slate-500">
                Hiển thị
                <span class="text-sky-600">{{ $users->firstItem() ?? 0 }}</span>
                -
                <span class="text-sky-600">{{ $users->lastItem() ?? 0 }}</span>
                trong tổng
                <span class="text-sky-600">{{ $users->total() }}</span>
                người dùng
            </p>

            <div class="flex items-center gap-2">

                @if ($users->onFirstPage())
                <span
                    class="w-10 h-10 rounded-md bg-slate-50 border border-slate-200 text-slate-300 flex items-center justify-center cursor-not-allowed">
                    <i class="fa-solid fa-angle-left"></i>
                </span>
                @else
                <a href="{{ $users->previousPageUrl() }}"
                    class="ajax-user-page w-10 h-10 rounded-md bg-white border border-slate-200 text-slate-500 hover:bg-sky-500 hover:text-white hover:border-sky-500 flex items-center justify-center transition">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
                @endif

                @for ($page = 1; $page <= max($users->lastPage(), 1); $page++)
                    @if ($page == $users->currentPage())
                    <span
                        class="w-10 h-10 rounded-md bg-sky-500 text-white flex items-center justify-center font-black">
                        {{ $page }}
                    </span>
                    @else
                    <a href="{{ $users->url($page) }}"
                        class="ajax-user-page w-10 h-10 rounded-md bg-white border border-slate-200 text-slate-500 hover:bg-sky-500 hover:text-white hover:border-sky-500 flex items-center justify-center font-bold transition">
                        {{ $page }}
                    </a>
                    @endif
                    @endfor

                    @if ($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}"
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

<!-- DELETE MODAL -->
<div id="delete-user-modal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm px-4">

    <div class="w-full max-w-md bg-white rounded-md shadow-2xl border border-slate-200 overflow-hidden">

        <div class="p-6 text-center">
            <div class="w-14 h-14 mx-auto rounded-md bg-red-50 text-red-500 flex items-center justify-center mb-4">
                <i class="fa-solid fa-triangle-exclamation text-xl"></i>
            </div>

            <h3 class="text-xl font-black text-slate-700">
                Xóa người dùng?
            </h3>

            <p class="text-sm text-slate-500 font-semibold mt-3 leading-relaxed">
                Người dùng sẽ bị xóa mềm và có thể khôi phục lại trong mục người dùng đã xóa.
            </p>
        </div>

        <div class="px-6 pb-6 grid grid-cols-2 gap-3">
            <button type="button" id="cancel-delete-user"
                class="h-11 rounded-md bg-slate-100 text-slate-600 text-sm font-black hover:bg-slate-200 transition">
                Hủy
            </button>

            <button type="button" id="confirm-delete-user"
                class="h-11 rounded-md bg-red-500 text-white text-sm font-black hover:bg-red-600 transition">
                Xóa
            </button>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('user-filter-form');
    const resetBtn = document.getElementById('reset-user-filter');

    const deleteModal = document.getElementById('delete-user-modal');
    const cancelDeleteBtn = document.getElementById('cancel-delete-user');
    const confirmDeleteBtn = document.getElementById('confirm-delete-user');

    let deleteForm = null;

    async function loadUsers(url) {
        const wrapper = document.getElementById('users-list-wrapper');

        if (!wrapper) {
            return;
        }

        wrapper.classList.add('opacity-50', 'pointer-events-none');

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const html = await response.text();
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const newWrapper = doc.querySelector('#users-list-wrapper');

            if (newWrapper) {
                wrapper.innerHTML = newWrapper.innerHTML;
                window.history.pushState({}, '', url);
            }
        } catch (error) {
            console.error('Không thể tải danh sách người dùng:', error);
        } finally {
            wrapper.classList.remove('opacity-50', 'pointer-events-none');
        }
    }

    function openDeleteModal(formElement) {
        deleteForm = formElement;
        deleteModal.classList.remove('hidden');
        deleteModal.classList.add('flex');
    }

    function closeDeleteModal() {
        deleteForm = null;
        deleteModal.classList.add('hidden');
        deleteModal.classList.remove('flex');
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
        const link = e.target.closest('.ajax-user-page');

        if (!link) {
            return;
        }

        e.preventDefault();
        loadUsers(link.href);
    });

    document.addEventListener('submit', function(e) {
        const currentDeleteForm = e.target.closest('.delete-user-form');

        if (!currentDeleteForm) {
            return;
        }

        e.preventDefault();
        openDeleteModal(currentDeleteForm);
    });

    cancelDeleteBtn?.addEventListener('click', function() {
        closeDeleteModal();
    });

    confirmDeleteBtn?.addEventListener('click', function() {
        if (deleteForm) {
            deleteForm.submit();
        }
    });

    deleteModal?.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            closeDeleteModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
});
</script>
@endpush