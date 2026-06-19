@extends('layouts.admin')

@section('title', 'Người dùng đã xóa')
@section('page-title', 'Người dùng đã xóa')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-white border rounded-md shadow-sm p-5 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-black text-slate-700">Người dùng đã xóa</h2>
            <p class="text-sm text-slate-500 mt-1">
                Danh sách tài khoản đã bị xóa mềm
            </p>
        </div>

        <a href="{{ route('admin.users.index') }}"
            class="px-4 py-2 bg-white border rounded-md text-slate-600 text-sm font-black hover:bg-slate-100">
            ← Quay lại
        </a>
    </div>

    {{-- BULK FORM --}}
    <form action="{{ route('admin.users.restoreMultiple') }}" method="POST" id="restore-multiple-form">
        @csrf
    </form>

    {{-- TABLE --}}
    <div class="bg-white border rounded-md shadow-sm overflow-hidden">

        <div class="p-4 border-b flex justify-between items-center">
            <span class="font-black text-slate-600">
                {{ $users->total() }} tài khoản
            </span>

            <button type="submit" form="restore-multiple-form" id="restore-selected-btn" disabled
                class="px-4 py-2 bg-emerald-50 text-emerald-600 rounded-md text-sm font-black opacity-50">
                Khôi phục đã chọn
            </button>
        </div>

        <table class="w-full">
            <thead class="bg-slate-50 text-xs text-slate-500">
                <tr>
                    <th class="p-3">
                        <input type="checkbox" id="check-all">
                    </th>
                    <th class="p-3">Người dùng</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Role</th>
                    <th class="p-3">Xóa lúc</th>
                    <th class="p-3 text-right">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                <tr class="border-t">

                    <td class="p-3">
                        <input type="checkbox" class="user-checkbox" name="user_ids[]" value="{{ $user->user_id }}"
                            form="restore-multiple-form">
                    </td>

                    <td class="p-3">
                        <div class="flex items-center gap-3">
                            <img src="{{ $user->avatar ? asset('storage/'.$user->avatar)
                                : 'https://ui-avatars.com/api/?name='.urlencode($user->full_name) }}"
                                class="w-10 h-10 rounded-md">

                            <div>
                                <p class="font-black">{{ $user->full_name }}</p>
                                <p class="text-xs text-slate-400">{{ '@'.$user->username }}</p>
                            </div>
                        </div>
                    </td>

                    <td class="p-3 text-sm text-slate-600">{{ $user->email }}</td>

                    <td class="p-3">
                        {{ $user->role->role_name ?? '-' }}
                    </td>

                    <td class="p-3 text-sm text-slate-500">
                        {{ $user->deleted_at }}
                    </td>

                    <td class="p-3 text-right">

                        {{-- SINGLE RESTORE --}}
                        <form action="{{ route('admin.users.restore', $user->user_id) }}" method="POST"
                            class="restore-user-form inline-block">
                            @csrf
                            @method('PATCH')

                            <button type="submit"
                                class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-md text-sm font-black">
                                Khôi phục
                            </button>
                        </form>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-10 text-slate-500">
                        Không có dữ liệu
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