@extends('layouts.admin')

@section('title', 'Người dùng đã xóa')
@section('page-title', 'Người dùng đã xóa')

@section('content')

<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h2 class="text-2xl font-extrabold text-slate-900">
                    Người dùng đã xóa
                </h2>

                <p class="mt-2 text-sm font-medium text-slate-500">
                    Danh sách các tài khoản đã bị xóa mềm và có thể khôi phục.
                </p>

            </div>

            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2
            h-11
            px-5
            rounded-xl
            border border-slate-300
            bg-white
            text-slate-700
            text-sm
            font-semibold
            transition-all duration-300
            hover:bg-slate-900
            hover:text-white">

                <i class="fa-solid fa-arrow-left"></i>

                Quay lại

            </a>

        </div>

    </div>

    {{-- BULK FORM --}}
    <form action="{{ route('admin.users.restoreMultiple') }}" method="POST" id="restore-multiple-form">
        @csrf
    </form>

    {{-- TABLE --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">

            <span class="inline-flex items-center
        px-4 py-2
        rounded-full
        bg-amber-50
        border border-amber-200
        text-amber-700
        text-sm
        font-semibold">

                {{ $users->total() }} tài khoản

            </span>

            <button type="submit" form="restore-multiple-form" id="restore-selected-btn" disabled class="inline-flex items-center gap-2
            h-11
            px-5
            rounded-xl
            bg-emerald-500
            text-white
            text-sm
            font-semibold
            opacity-50
            transition-all duration-300
            disabled:cursor-not-allowed">

                <i class="fa-solid fa-rotate-left"></i>

                Khôi phục đã chọn

            </button>

        </div>
        <table class="w-full">
            <thead class="bg-slate-50 border-b border-slate-200">

                <tr>

                    <th class="px-6 py-4 w-14 text-center">
                        <input type="checkbox" id="check-all"
                            class="w-5 h-5 rounded border-slate-300 accent-amber-500 cursor-pointer">
                    </th>


                    <th class="px-6 py-4 text-left text-xs uppercase tracking-wide font-semibold text-slate-500">
                        Người dùng
                    </th>

                    <th class="px-6 py-4 text-left text-xs uppercase tracking-wide font-semibold text-slate-500">
                        Email
                    </th>

                    <th class="px-6 py-4 text-left text-xs uppercase tracking-wide font-semibold text-slate-500">
                        Vai trò
                    </th>

                    <th class="px-6 py-4 text-left text-xs uppercase tracking-wide font-semibold text-slate-500">
                        Xóa lúc
                    </th>

                    <th class="px-6 py-4 text-right text-xs uppercase tracking-wide font-semibold text-slate-500">
                        Hành động
                    </th>

                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="border-t border-slate-100 hover:bg-slate-50 transition-all duration-300">
                    <td class="px-6 py-5 w-14 text-center">
                        <input type="checkbox"
                            class="user-checkbox w-5 h-5 rounded border-slate-300 accent-amber-500 cursor-pointer"
                            name="user_ids[]" value="{{ $user->user_id }}" form="restore-multiple-form">
                    </td>
                    <td class="p-3">
                        <div class="flex items-center gap-3">
                            <img src="{{ $user->avatar ? asset('storage/'.$user->avatar)
                                : 'https://ui-avatars.com/api/?name='.urlencode($user->full_name) }}"
                                class="w-10 h-10 rounded-md">

                            <div>
                                <p class="text-sm font-bold text-slate-800">
                                    {{ $user->full_name }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ '@'.$user->username }}
                                </p>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-5 text-sm font-medium text-slate-700">{{ $user->email }}</td>

                    <td class="px-6 py-5">

                        <span class="inline-flex items-center
                    px-3 py-1
                    rounded-full
                    bg-slate-100
                    text-slate-700
                    text-xs
                    font-semibold">

                            {{ $user->role->role_name ?? '-' }}

                        </span>

                    </td>
                    <td class="px-6 py-5 text-sm font-medium text-slate-500">

                        {{ $user->deleted_at }}

                    </td>

                    <td class="p-3 text-right">

                        {{-- SINGLE RESTORE --}}
                        <form action="{{ route('admin.users.restore', $user->user_id) }}" method="POST"
                            class="restore-user-form inline-block">
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="inline-flex items-center gap-2
                            px-4
                            py-2
                            rounded-xl
                            bg-emerald-500
                            text-white
                            text-sm
                            font-semibold
                            transition-all duration-300
                            hover:bg-emerald-600">

                                <i class="fa-solid fa-rotate-left"></i>

                                Khôi phục

                            </button>
                        </form>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-16 text-center">

                        <div class="mx-auto w-16 h-16 rounded-2xl
                            bg-slate-100
                            flex items-center justify-center
                            text-slate-400">

                            <i class="fa-solid fa-users text-2xl"></i>

                        </div>

                        <h3 class="mt-5 text-lg font-bold text-slate-700">

                            Không có người dùng đã xóa

                        </h3>

                        <p class="mt-2 text-sm text-slate-500">

                            Danh sách hiện đang trống.

                        </p>

                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-3">
            {{ $users->links() }}
        </div>
    </div>

</div>

{{-- MODAL --}}
<div id="restore-modal" class="fixed inset-0 hidden items-center justify-center bg-black/40">

    <div class="bg-white p-6 rounded-md w-[400px] text-center">

        <h2 class="text-lg font-black">Xác nhận khôi phục?</h2>
        <p class="text-sm text-slate-500 mt-2">
            Hành động này sẽ khôi phục người dùng
        </p>

        <div class="flex gap-3 mt-5 justify-center">

            <button id="cancel-btn" class="px-4 py-2 bg-slate-100 rounded-md">
                Hủy
            </button>

            <button id="confirm-btn" class="px-4 py-2 bg-emerald-500 text-white rounded-md">
                Xác nhận
            </button>

        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const checkAll = document.getElementById('check-all');
    const restoreBtn = document.getElementById('restore-selected-btn');
    const selectedCount = document.getElementById('selected-count');

    function updateUI() {
        const checked = document.querySelectorAll('.user-checkbox:checked').length;

        if (checked > 0) {
            restoreBtn.disabled = false;
            restoreBtn.classList.remove('opacity-50', 'cursor-not-allowed');

            if (selectedCount) {
                selectedCount.textContent = checked;
                selectedCount.classList.remove('hidden');
            }
        } else {
            restoreBtn.disabled = true;
            restoreBtn.classList.add('opacity-50', 'cursor-not-allowed');

            if (selectedCount) {
                selectedCount.textContent = 0;
                selectedCount.classList.add('hidden');
            }
        }

        if (checkAll) {
            const total = document.querySelectorAll('.user-checkbox').length;
            const checkedAll = document.querySelectorAll('.user-checkbox:checked').length;

            checkAll.checked = total > 0 && total === checkedAll;
        }
    }

    // ✅ EVENT DELEGATION (QUAN TRỌNG)
    document.addEventListener('change', function(e) {

        if (e.target.classList.contains('user-checkbox')) {
            updateUI();
        }

        if (e.target.id === 'check-all') {
            const isChecked = e.target.checked;

            document.querySelectorAll('.user-checkbox')
                .forEach(cb => cb.checked = isChecked);

            updateUI();
        }
    });

    // init
    updateUI();
});
</script>
@endpush