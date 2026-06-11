@extends('layouts.admin')

@section('title', 'Người dùng đã xóa')
@section('page-title', 'Người dùng đã xóa')

@section('content')

<div class="max-w-7xl mx-auto px-2 lg:px-4">

    ```
    <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="text-3xl font-black text-slate-900">
                Người dùng đã xóa
            </h1>

            <p class="text-slate-500 font-semibold mt-2">
                Danh sách tài khoản đã bị xóa mềm. Admin có thể khôi phục lại khi cần.
            </p>
        </div>

        <a href="{{ route('admin.users.index') }}"
            class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-white border border-cyan-100 text-slate-700 font-black shadow-sm hover:bg-cyan-50 hover:text-cyan-700 transition">

            <span class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                <i class="fa-solid fa-arrow-left"></i>
            </span>

            <span>Quay lại</span>
        </a>
    </div>

    <form action="{{ route('admin.users.restoreMultiple') }}" method="POST" id="restore-multiple-form"
        class="restore-multiple-form">
        @csrf
    </form>

    <div class="bg-white rounded-[32px] border border-red-100 shadow-sm overflow-hidden">

        <div
            class="px-6 py-5 border-b border-red-100 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h2 class="text-xl font-black text-slate-900">
                    Danh sách tài khoản đã xóa
                </h2>

                <p class="text-sm text-slate-500 font-semibold mt-1">
                    Các tài khoản này đang bị ẩn khỏi danh sách người dùng chính.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <span class="px-4 py-2 rounded-full bg-red-50 text-red-500 text-xs font-black border border-red-100">
                    {{ number_format($users->total()) }} tài khoản
                </span>

                @if($users->count() > 0)
                <button type="submit" form="restore-multiple-form" id="restore-selected-btn" disabled
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 font-black opacity-50 cursor-not-allowed transition">

                    <i class="fa-solid fa-rotate-left"></i>
                    Khôi phục đã chọn

                    <span id="selected-count"
                        class="hidden min-w-6 h-6 px-2 rounded-full bg-emerald-600 text-white text-xs font-black items-center justify-center">
                        0
                    </span>
                </button>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-red-50/70">
                    <tr>
                        <th class="px-6 py-4 w-12">
                            @if($users->count() > 0)
                            <input type="checkbox" id="check-all"
                                class="w-5 h-5 rounded border-red-200 accent-emerald-600">
                            @endif
                        </th>

                        <th class="px-6 py-4 text-xs font-black uppercase text-slate-500">
                            Người dùng
                        </th>

                        <th class="px-6 py-4 text-xs font-black uppercase text-slate-500">
                            Email
                        </th>

                        <th class="px-6 py-4 text-xs font-black uppercase text-slate-500">
                            Vai trò
                        </th>

                        <th class="px-6 py-4 text-xs font-black uppercase text-slate-500">
                            Thời gian xóa
                        </th>

                        <th class="px-6 py-4 text-xs font-black uppercase text-slate-500 text-right">
                            Hành động
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-red-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-red-50/40 transition">
                        <td class="px-6 py-5">
                            <input type="checkbox" name="user_ids[]" value="{{ $user->user_id }}"
                                form="restore-multiple-form"
                                class="user-checkbox w-5 h-5 rounded border-red-200 accent-emerald-600">
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->full_name) . '&background=ef4444&color=fff' }}"
                                    class="w-12 h-12 rounded-2xl object-cover">

                                <div>
                                    <h4 class="font-black text-slate-800">
                                        {{ $user->full_name }}
                                    </h4>

                                    <p class="text-sm text-slate-400 font-semibold">
                                        {{ '@' . $user->username }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-5 font-semibold text-slate-600">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-5">
                            <span
                                class="px-4 py-2 rounded-full bg-slate-50 text-slate-600 text-xs font-black border border-slate-100">
                                {{ $user->role->role_name ?? 'Chưa có role' }}
                            </span>
                        </td>

                        <td class="px-6 py-5 font-semibold text-slate-500">
                            {{ $user->deleted_at ? $user->deleted_at->format('d/m/Y H:i') : 'Không rõ' }}
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex items-center justify-end gap-2">
                                <form action="{{ route('admin.users.restore', $user->user_id) }}" method="POST"
                                    class="restore-user-form">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-50 text-emerald-600 font-black hover:bg-emerald-500 hover:text-white transition">

                                        <i class="fa-solid fa-rotate-left"></i>
                                        Khôi phục
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-14 text-center">
                            <div
                                class="w-16 h-16 mx-auto rounded-2xl bg-red-50 text-red-500 flex items-center justify-center mb-4">
                                <i class="fa-solid fa-trash-can text-2xl"></i>
                            </div>

                            <h3 class="text-xl font-black text-slate-900">
                                Chưa có người dùng đã xóa
                            </h3>

                            <p class="text-slate-500 font-semibold mt-2">
                                Khi admin xóa mềm người dùng, tài khoản sẽ xuất hiện tại đây.
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
        <div class="px-6 py-5 border-t border-red-100">
            {{ $users->links() }}
        </div>
        @endif

    </div>
    ```

</div>

<div id="restore-user-modal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm px-4">

    ```
    <div class="w-full max-w-md bg-white rounded-[28px] shadow-2xl border border-emerald-100 overflow-hidden">

        <div class="p-7 text-center">
            <div
                class="w-16 h-16 mx-auto rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-5">
                <i class="fa-solid fa-rotate-left text-2xl"></i>
            </div>

            <h3 id="restore-modal-title" class="text-2xl font-black text-slate-900">
                Khôi phục người dùng?
            </h3>

            <p id="restore-modal-message" class="text-slate-500 font-semibold mt-3 leading-relaxed">
                Tài khoản sẽ được khôi phục và hiển thị lại trong danh sách người dùng chính.
            </p>
        </div>

        <div class="px-7 pb-7 grid grid-cols-2 gap-3">
            <button type="button" id="cancel-restore-user"
                class="h-12 rounded-2xl bg-slate-100 text-slate-700 font-black hover:bg-slate-200 transition">
                Hủy
            </button>

            <button type="button" id="confirm-restore-user"
                class="h-12 rounded-2xl bg-emerald-500 text-white font-black hover:bg-emerald-600 transition">
                Khôi phục
            </button>
        </div>

    </div>
    ```

</div>

@endsection

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('check-all');
    const checkboxes = document.querySelectorAll('.user-checkbox');
    const restoreBtn = document.getElementById('restore-selected-btn');
    const selectedCount = document.getElementById('selected-count');
    const restoreMultipleForm = document.getElementById('restore-multiple-form');

    const restoreModal = document.getElementById('restore-user-modal');
    const restoreModalTitle = document.getElementById('restore-modal-title');
    const restoreModalMessage = document.getElementById('restore-modal-message');
    const cancelRestoreBtn = document.getElementById('cancel-restore-user');
    const confirmRestoreBtn = document.getElementById('confirm-restore-user');

    let pendingRestoreForm = null;

    function updateRestoreButton() {
        const checked = document.querySelectorAll('.user-checkbox:checked').length;

        if (!restoreBtn) return;

        if (checked > 0) {
            restoreBtn.disabled = false;
            restoreBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            restoreBtn.classList.add('hover:bg-emerald-500', 'hover:text-white');

            if (selectedCount) {
                selectedCount.textContent = checked;
                selectedCount.classList.remove('hidden');
                selectedCount.classList.add('inline-flex');
            }
        } else {
            restoreBtn.disabled = true;
            restoreBtn.classList.add('opacity-50', 'cursor-not-allowed');
            restoreBtn.classList.remove('hover:bg-emerald-500', 'hover:text-white');

            if (selectedCount) {
                selectedCount.textContent = 0;
                selectedCount.classList.add('hidden');
                selectedCount.classList.remove('inline-flex');
            }
        }

        if (checkAll) {
            checkAll.checked = checked > 0 && checked === checkboxes.length;
        }
    }

    function openRestoreModal(formElement, type = 'single') {
        pendingRestoreForm = formElement;

        if (type === 'multiple') {
            const checked = document.querySelectorAll('.user-checkbox:checked').length;

            restoreModalTitle.textContent = 'Khôi phục người dùng đã chọn?';
            restoreModalMessage.textContent = 'Bạn đang khôi phục ' + checked +
                ' tài khoản. Các tài khoản này sẽ hiển thị lại trong danh sách người dùng chính.';
        } else {
            restoreModalTitle.textContent = 'Khôi phục người dùng?';
            restoreModalMessage.textContent =
                'Tài khoản sẽ được khôi phục và hiển thị lại trong danh sách người dùng chính.';
        }

        restoreModal.classList.remove('hidden');
        restoreModal.classList.add('flex');
    }

    function closeRestoreModal() {
        pendingRestoreForm = null;
        restoreModal.classList.add('hidden');
        restoreModal.classList.remove('flex');
    }

    checkAll?.addEventListener('change', function() {
        checkboxes.forEach(item => {
            item.checked = this.checked;
        });

        updateRestoreButton();
    });

    checkboxes.forEach(item => {
        item.addEventListener('change', updateRestoreButton);
    });

    document.addEventListener('submit', function(e) {
        const restoreUserForm = e.target.closest('.restore-user-form');
        const isRestoreMultipleForm = e.target === restoreMultipleForm;

        if (!restoreUserForm && !isRestoreMultipleForm) return;

        e.preventDefault();

        if (isRestoreMultipleForm) {
            const checked = document.querySelectorAll('.user-checkbox:checked').length;

            if (checked === 0) {
                return;
            }

            openRestoreModal(restoreMultipleForm, 'multiple');
            return;
        }

        openRestoreModal(restoreUserForm, 'single');
    });

    cancelRestoreBtn?.addEventListener('click', function() {
        closeRestoreModal();
    });

    confirmRestoreBtn?.addEventListener('click', function() {
        if (pendingRestoreForm) {
            pendingRestoreForm.submit();
        }
    });

    restoreModal?.addEventListener('click', function(e) {
        if (e.target === restoreModal) {
            closeRestoreModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeRestoreModal();
        }
    });

    updateRestoreButton();
});
</script>

@endpush