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
    <div class="bg-white border border-slate-200 rounded-md shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <!-- LEFT -->
            <div>

                <h2 class="text-xl font-extrabold text-slate-900">

                    Danh sách người dùng

                </h2>

                <p class="mt-2 text-sm font-medium text-slate-500">

                    Quản lý tài khoản Admin, Giảng viên và Sinh viên trong hệ thống.

                </p>

            </div>

            <!-- RIGHT -->
            <div class="flex flex-wrap items-center gap-3">

                <!-- Thùng rác -->
                <a href="{{ route('admin.users.trashed') }}" class="inline-flex items-center gap-2
                h-11
                px-4
                rounded-xl
                border border-red-200
                bg-white
                text-red-500
                text-sm
                font-bold
                transition-all duration-300
                hover:bg-red-500
                hover:text-white">

                    <i class="fa-solid fa-trash-can-arrow-up"></i>

                    @if($totalTrashedUsers > 0)

                    <span class="min-w-6 h-6 px-2 rounded-full
                    bg-red-500
                    text-white
                    text-[11px]
                    font-black
                    flex items-center justify-center">

                        {{ $totalTrashedUsers }}

                    </span>

                    @endif

                </a>

                <!-- Thêm người dùng -->
                <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2
                h-11
                px-5
                rounded-xl
                bg-slate-900
                text-white
                text-sm
                font-bold
                shadow-sm
                transition-all duration-300
                hover:bg-amber-500">

                    <i class="fa-solid fa-user-plus"></i>

                    <span>Thêm người dùng</span>

                </a>

            </div>

        </div>

        <!-- SUMMARY CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-6">

            <!-- Tổng người dùng -->
            <div
                class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Tổng người dùng
                        </p>

                        <h3 class="mt-2 text-3xl font-black text-slate-900">
                            {{ number_format($totalUsers) }}
                        </h3>

                        <p class="mt-2 text-sm text-slate-500 font-medium">
                            Tài khoản trong hệ thống
                        </p>

                    </div>

                    <div
                        class="w-14 h-14 rounded-2xl bg-slate-900 text-white flex items-center justify-center shadow-sm">

                        <i class="fa-solid fa-users text-xl"></i>

                    </div>

                </div>

            </div>

            <!-- Giảng viên -->
            <div
                class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Giảng viên
                        </p>

                        <h3 class="mt-2 text-3xl font-black text-slate-900">
                            {{ number_format($totalTeachers) }}
                        </h3>

                        <p class="mt-2 text-sm text-slate-500 font-medium">
                            Tài khoản giảng viên
                        </p>

                    </div>

                    <div
                        class="w-14 h-14 rounded-2xl bg-amber-500 text-white flex items-center justify-center shadow-sm">

                        <i class="fa-solid fa-chalkboard-user text-xl"></i>

                    </div>

                </div>

            </div>

            <!-- Sinh viên -->
            <div
                class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Sinh viên
                        </p>

                        <h3 class="mt-2 text-3xl font-black text-slate-900">
                            {{ number_format($totalStudents) }}
                        </h3>

                        <p class="mt-2 text-sm text-slate-500 font-medium">
                            Tài khoản sinh viên
                        </p>

                    </div>

                    <div
                        class="w-14 h-14 rounded-2xl bg-blue-500 text-white flex items-center justify-center shadow-sm">

                        <i class="fa-solid fa-user-graduate text-xl"></i>

                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- FILTER -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">

        <form id="user-filter-form" method="GET" action="{{ route('admin.users.index') }}"
            class="grid grid-cols-1 md:grid-cols-5 gap-4">

            <!-- Search -->
            <div class="md:col-span-2">

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Tìm theo tên, email, username..." class="w-full h-11 px-4 rounded-md
                bg-slate-50
                border border-slate-200
                text-sm font-semibold text-slate-600
                outline-none
                focus:ring-2
                focus:ring-amber-200
                focus:border-amber-500">

            </div>

            <!-- Role -->
            <div>

                <select name="role_id" class="w-full h-11 px-4 rounded-md
                bg-slate-50
                border border-slate-200
                text-sm font-semibold text-slate-600
                outline-none
                focus:ring-2
                focus:ring-amber-200
                focus:border-amber-500">

                    <option value="">Tất cả vai trò</option>

                    @foreach($roles as $role)

                    <option value="{{ $role->role_id }}" @selected(request('role_id')==$role->role_id)>

                        {{ $role->role_name }}

                    </option>

                    @endforeach

                </select>

            </div>

            <!-- Filter -->
            <button type="submit" class="h-11 rounded-md
            bg-slate-900
            text-white
            text-sm font-black
            hover:bg-amber-500
            transition-all duration-300">

                <i class="fa-solid fa-filter mr-2"></i>

                Lọc

            </button>

            <!-- Reset -->
            <a href="{{ route('admin.users.index') }}" id="reset-user-filter" class="h-11 rounded-md
            border border-slate-300
            bg-white
            text-slate-600
            text-sm font-black
            flex items-center justify-center
            hover:border-amber-300
            hover:bg-amber-50
            hover:text-amber-600
            transition-all duration-300">

                Reset

            </a>

        </form>

    </div>
    <!-- USERS LIST -->
    <div id="users-list-wrapper">

        <div id="users-table-wrapper" class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

            <!-- HEADER -->
            <div
                class="px-6 py-5 border-b border-slate-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>

                    <h2 class="text-xl font-bold tracking-tight text-slate-900">

                        Người dùng hệ thống

                    </h2>

                    <p class="mt-1 text-sm font-medium text-slate-500">

                        Danh sách tài khoản đang hoạt động trong hệ thống.

                    </p>

                </div>

                <span class="px-3 py-1.5 rounded-full
                bg-amber-50
                border border-amber-200
                text-amber-600
                text-sm
                font-semibold
                tracking-wide
                w-fit">

                    {{ number_format($users->total()) }} tài khoản

                </span>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <!-- TABLE HEADER -->
                    <thead class="bg-slate-50 border-b border-slate-200">

                        <tr>

                            <!-- STT -->
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">

                                STT

                            </th>

                            <!-- USER -->
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">

                                Người dùng

                            </th>

                            <!-- EMAIL -->
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">

                                Email

                            </th>

                            <!-- ROLE -->
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">

                                Vai trò

                            </th>

                            <!-- STATUS -->
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">

                                Trạng thái

                            </th>

                            <!-- ACTION -->
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 ">

                                Hành động

                            </th>

                        </tr>

                    </thead>

                    <!-- TABLE BODY -->
                    <tbody class="divide-y divide-slate-100">
                        @forelse($users as $user)

                        <tr id="user-{{ $user->user_id }}" class="hover:bg-slate-50 transition-all duration-200">

                            <!-- STT -->
                            <td class="px-6 py-5 text-sm font-semibold text-slate-600">

                                {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}

                            </td>

                            <!-- USER -->
                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->full_name) . '&background=0f172a&color=fff' }}"
                                        class="w-11 h-11 rounded-xl object-cover border border-slate-200">

                                    <div class="min-w-0">

                                        <h4 class="text-sm font-bold text-slate-800 truncate">

                                            {{ $user->full_name }}

                                        </h4>

                                        <p class="mt-0.5 text-xs font-medium text-slate-500 truncate">

                                            {{ '@'.$user->username }}

                                        </p>

                                    </div>

                                </div>

                            </td>

                            <!-- EMAIL -->
                            <td class="px-6 py-5">

                                <span class="text-sm font-semibold text-slate-700">

                                    {{ $user->email }}

                                </span>

                            </td>

                            <!-- ROLE -->
                            <td class="px-6 py-5">

                                <span class="inline-flex items-center
                                px-3 py-1
                                rounded-full
                                bg-slate-100
                                text-slate-700
                                text-xs
                                font-semibold
                                tracking-wide">

                                    {{ $user->role->role_name ?? 'Chưa có role' }}

                                </span>

                            </td>

                            <!-- STATUS -->
                            <td class="px-6 py-5">

                                <form action="{{ route('admin.users.status',$user->user_id) }}" method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="px-4 py-1.5 rounded-full text-xs font-semibold tracking-wide transition-all duration-300

                            {{ $user->is_active
                                ? 'bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white'
                                : 'bg-red-50 text-red-600 hover:bg-red-500 hover:text-white' }}">

                                        {{ $user->is_active ? 'Hoạt động' : 'Bị khóa' }}

                                    </button>

                                </form>

                            </td>

                            <!-- ACTION -->
                            <td class="px-6 py-5">

                                <div class="relative flex items-center justify-center">
                                    <!-- BUTTON -->
                                    <button type="button" class="action-btn
           w-10 h-10
           rounded-xl
           border border-slate-200
           bg-white
           text-slate-500
           hover:bg-amber-50
           hover:text-amber-500
           transition-all duration-300" data-id="{{ $user->user_id }}">

                                        <i class="fa-solid fa-ellipsis-vertical"></i>

                                    </button>

                                    <!-- MENU -->
                                    <div id="action-menu-{{ $user->user_id }}"
                                        class="hidden absolute right-0 top-12 w-44 rounded-xl bg-white border border-slate-200 shadow-xl z-[9999] overflow-hidden">
                                        <!-- View -->
                                        <a href="{{ route('admin.users.show',[
                                        'user'=>$user->user_id,
                                        'return'=>urlencode(request()->fullUrl().'#user-'.$user->user_id)
                                           ]) }}" class="flex items-center gap-3
                                        px-4 py-3
                                        text-sm font-semibold
                                        text-slate-700
                                        hover:bg-slate-50">

                                            <i class="fa-solid fa-eye w-5 text-slate-500"></i>

                                            Xem chi tiết

                                        </a>

                                        <!-- Edit -->
                                        <a href="{{ route('admin.users.edit',$user->user_id) }}" class="flex items-center gap-3
                                            px-4 py-3
                                            text-sm font-semibold
                                            text-amber-600
                                            hover:bg-amber-50">

                                            <i class="fa-solid fa-pen w-5"></i>

                                            Chỉnh sửa

                                        </a>

                                        @if($user->role_id != 1)

                                        <form action="{{ route('admin.users.destroy',$user->user_id) }}" method="POST"
                                            class="delete-user-form" onclick="event.stopPropagation();">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" onclick="event.stopPropagation();"
                                                class="w-full flex items-center gap-3 px-4 py-3 text-sm font-semibold text-red-600 hover:bg-red-50">

                                                <i class="fa-solid fa-trash w-5"></i>
                                                Xóa

                                            </button>

                                        </form>

                                        @endif

                                    </div>

                                </div>

                            </td>
                        </tr>
                        @empty

                        <tr>

                            <td colspan="6" class="px-6 py-16 text-center">

                                <div class="mx-auto mb-4
                                flex h-16 w-16
                                items-center justify-center
                                rounded-2xl
                                bg-slate-100
                                text-slate-400">

                                    <i class="fa-solid fa-users text-2xl"></i>

                                </div>

                                <h3 class="text-lg font-bold text-slate-700">

                                    Không tìm thấy người dùng

                                </h3>

                                <p class="mt-2 text-sm font-medium text-slate-500">

                                    Không có dữ liệu phù hợp với điều kiện tìm kiếm.

                                </p>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- FOOTER -->
            <div class="mt-5
                    bg-white
                    border border-slate-200
                    rounded-2xl
                    shadow-sm
                    px-6 py-4
                    flex flex-col md:flex-row
                    items-center justify-between
                    gap-4">

                <!-- INFO -->
                <p class="text-sm font-medium text-slate-500">

                    Hiển thị

                    <span class="font-bold text-amber-600">

                        {{ $users->firstItem() ?? 0 }}

                    </span>

                    -

                    <span class="font-bold text-amber-600">

                        {{ $users->lastItem() ?? 0 }}

                    </span>

                    trong tổng

                    <span class="font-bold text-amber-600">

                        {{ $users->total() }}

                    </span>

                    người dùng

                </p>

                <!-- PAGINATION -->
                <div class="flex items-center gap-2">







                    @if ($users->onFirstPage())

                    <span class="w-10 h-10
                    rounded-xl
                    bg-slate-50
                    border border-slate-200
                    text-slate-300
                    flex items-center justify-center
                    cursor-not-allowed">

                        <i class="fa-solid fa-angle-left"></i>

                    </span>

                    @else

                    <a href="{{ $users->previousPageUrl() }}" class="ajax-user-page
                    w-10 h-10
                    rounded-xl
                    bg-white
                    border border-slate-200
                    text-slate-600
                    hover:bg-slate-900
                    hover:border-slate-900
                    hover:text-white
                    flex items-center justify-center
                    transition-all duration-300">

                        <i class="fa-solid fa-angle-left"></i>

                    </a>

                    @endif

                    {{-- PAGE NUMBER --}}
                    @for ($page = 1; $page <= max($users->lastPage(), 1); $page++)

                        @if ($page == $users->currentPage())

                        <span class="w-10 h-10
                        rounded-xl
                        bg-slate-900
                        text-white
                        text-sm
                        font-semibold
                        shadow-sm
                        flex items-center justify-center">

                            {{ $page }}

                        </span>

                        @else

                        <a href="{{ $users->url($page) }}" class="ajax-user-page
                        w-10 h-10
                        rounded-xl
                        bg-white
                        border border-slate-200
                        text-slate-600
                        text-sm
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

                        {{-- NEXT --}}
                        @if ($users->hasMorePages())

                        <a href="{{ $users->nextPageUrl() }}" class="ajax-user-page
                    w-10 h-10
                    rounded-xl
                    bg-white
                    border border-slate-200
                    text-slate-600
                    hover:bg-slate-900
                    hover:border-slate-900
                    hover:text-white
                    flex items-center justify-center
                    transition-all duration-300">

                            <i class="fa-solid fa-angle-right"></i>

                        </a>

                        @else

                        <span class="w-10 h-10
                    rounded-xl
                    bg-slate-50
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

    confirmDeleteBtn?.addEventListener('click', function(e) {

        e.preventDefault();
        e.stopPropagation();

        if (deleteForm) {

            const form = deleteForm;

            closeDeleteModal();

            form.submit();

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

function toggleActionMenu(event, id) {
    event.preventDefault();

    event.stopPropagation();

    document.querySelectorAll('[id^="action-menu-"]').forEach(menu => {

        if (menu.id !== 'action-menu-' + id) {
            menu.classList.add('hidden');
        }

    });

    document.getElementById('action-menu-' + id).classList.toggle('hidden');
}

document.addEventListener('click', function(e) {

    const btn = e.target.closest('.action-btn');

    // Đóng tất cả menu
    document.querySelectorAll('[id^="action-menu-"]').forEach(menu => {
        if (!btn || menu.id !== 'action-menu-' + btn.dataset.id) {
            menu.classList.add('hidden');
        }
    });

    if (!btn) return;

    e.stopPropagation();

    const id = btn.dataset.id;

    document
        .getElementById('action-menu-' + id)
        .classList.toggle('hidden');

});
</script>
@endpush