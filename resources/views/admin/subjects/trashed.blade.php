@extends('layouts.admin')

@section('title', 'Môn học đã xóa')
@section('page-title', 'Môn học đã xóa')

@section('content')

<div class="max-w-7xl mx-auto px-2 lg:px-4">

    <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="text-3xl font-black text-slate-900">
                Môn học đã xóa
            </h1>

            <p class="text-slate-500 font-semibold mt-2">
                Quản lý các môn học đã xóa mềm và khôi phục khi cần.
            </p>
        </div>

        <a href="{{ route('admin.subjects.index') }}"
            class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-white border border-slate-200 text-slate-700 font-black shadow-sm hover:bg-slate-50 transition">
            <span class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">
                <i class="fa-solid fa-arrow-left"></i>
            </span>
            Quay lại
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <div class="bg-white rounded-2xl border border-red-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Đã xóa mềm</p>
            <h3 class="text-4xl font-black text-red-500 mt-2">
                {{ number_format($subjects->total()) }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl border border-emerald-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Có thể khôi phục</p>
            <h3 class="text-4xl font-black text-emerald-600 mt-2">
                {{ number_format($subjects->count()) }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Trạng thái</p>
            <h3 class="text-3xl font-black text-cyan-700 mt-2">
                Thùng rác
            </h3>
        </div>
    </div>

    <form action="{{ route('admin.subjects.restoreMultiple') }}" method="POST" id="restore-multiple-form">
        @csrf
    </form>

    <div class="bg-white rounded-[32px] border border-red-100 shadow-sm overflow-hidden">

        <div
            class="px-6 py-5 border-b border-red-100 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h2 class="text-xl font-black text-slate-900">
                    Danh sách môn học đã xóa
                </h2>

                <p class="text-sm text-slate-500 font-semibold mt-1">
                    Chọn một hoặc nhiều môn học để khôi phục lại hệ thống.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <span class="px-4 py-2 rounded-full bg-red-50 text-red-500 text-xs font-black border border-red-100">
                    {{ number_format($subjects->total()) }} môn học
                </span>

                @if($subjects->count() > 0)
                <button type="submit" form="restore-multiple-form" id="restore-selected-btn" disabled
                    class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 font-black opacity-50 cursor-not-allowed transition">
                    <span class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                        <i class="fa-solid fa-rotate-left"></i>
                    </span>

                    Khôi phục đã chọn

                    <span id="selected-count"
                        class="hidden min-w-7 h-7 px-2 rounded-full bg-emerald-600 text-white text-xs font-black items-center justify-center">
                        0
                    </span>
                </button>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left table-fixed">
                <thead class="bg-red-50/70">
                    <tr>
                        <th class="w-[6%] px-6 py-4">
                            <input type="checkbox" id="check-all"
                                class="w-5 h-5 rounded border-red-200 accent-emerald-600">
                        </th>

                        <th class="w-[38%] px-6 py-4 text-xs font-black uppercase text-slate-500">
                            Môn học
                        </th>

                        <th class="w-[14%] px-6 py-4 text-xs font-black uppercase text-slate-500">
                            Mã môn
                        </th>

                        <th class="w-[14%] px-6 py-4 text-xs font-black uppercase text-slate-500">
                            Tài liệu
                        </th>

                        <th class="w-[16%] px-6 py-4 text-xs font-black uppercase text-slate-500">
                            Thời gian xóa
                        </th>

                        <th class="w-[12%] px-6 py-4 text-xs font-black uppercase text-slate-500 text-right">
                            Khôi phục
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-red-100">
                    @forelse($subjects as $subject)
                    <tr class="hover:bg-red-50/40 transition">
                        <td class="px-6 py-5">
                            <input type="checkbox" name="subject_codes[]" value="{{ $subject->subject_code }}"
                                form="restore-multiple-form"
                                class="subject-checkbox w-5 h-5 rounded border-red-200 accent-emerald-600">
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4 min-w-0">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center border border-red-100 flex-shrink-0">
                                    <i class="fa-solid fa-book-open"></i>
                                </div>

                                <div class="min-w-0">
                                    <h4 class="font-black text-slate-800 truncate">
                                        {{ $subject->subject_name }}
                                    </h4>

                                    <p class="text-sm text-slate-400 font-semibold truncate">
                                        {{ $subject->description ?? 'Chưa có mô tả cho môn học này.' }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            <span
                                class="inline-flex whitespace-nowrap px-4 py-2 rounded-full bg-slate-50 text-slate-600 text-xs font-black border border-slate-100">
                                {{ $subject->subject_code }}
                            </span>
                        </td>

                        <td class="px-6 py-5">
                            <span
                                class="inline-flex items-center whitespace-nowrap px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black border border-cyan-100">
                                {{ $subject->documents_count ?? 0 }} tài liệu
                            </span>
                        </td>

                        <td class="px-6 py-5 font-semibold text-slate-500 whitespace-nowrap">
                            {{ $subject->deleted_at ? $subject->deleted_at->format('d/m/Y H:i') : 'Không rõ' }}
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex items-center justify-end">
                                <form action="{{ route('admin.subjects.restore', $subject->subject_code) }}"
                                    method="POST"
                                    onsubmit="return confirm('Bạn có chắc muốn khôi phục môn học này không?')">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-50 text-emerald-600 font-black hover:bg-emerald-500 hover:text-white transition">
                                        <i class="fa-solid fa-rotate-left"></i>
                                        <span class="hidden xl:inline">Khôi phục</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div
                                class="w-20 h-20 mx-auto rounded-3xl bg-red-50 text-red-500 flex items-center justify-center mb-5">
                                <i class="fa-solid fa-trash-can text-3xl"></i>
                            </div>

                            <h3 class="text-2xl font-black text-slate-900">
                                Chưa có môn học đã xóa
                            </h3>

                            <p class="text-slate-500 font-semibold mt-2">
                                Khi admin xóa mềm môn học, môn học sẽ xuất hiện tại đây.
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($subjects->hasPages())
        <div class="px-6 py-5 border-t border-red-100">
            {{ $subjects->links() }}
        </div>
        @endif

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('check-all');
    const checkboxes = document.querySelectorAll('.subject-checkbox');
    const restoreBtn = document.getElementById('restore-selected-btn');
    const selectedCount = document.getElementById('selected-count');
    const restoreForm = document.getElementById('restore-multiple-form');

    function updateRestoreButton() {
        const checked = document.querySelectorAll('.subject-checkbox:checked').length;

        if (!restoreBtn) return;

        if (checked > 0) {
            restoreBtn.disabled = false;
            restoreBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            restoreBtn.classList.add('hover:bg-emerald-500', 'hover:text-white');

            selectedCount.textContent = checked;
            selectedCount.classList.remove('hidden');
            selectedCount.classList.add('inline-flex');
        } else {
            restoreBtn.disabled = true;
            restoreBtn.classList.add('opacity-50', 'cursor-not-allowed');
            restoreBtn.classList.remove('hover:bg-emerald-500', 'hover:text-white');

            selectedCount.textContent = 0;
            selectedCount.classList.add('hidden');
            selectedCount.classList.remove('inline-flex');
        }

        if (checkAll) {
            checkAll.checked = checked === checkboxes.length && checkboxes.length > 0;
        }
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

    restoreForm?.addEventListener('submit', function(e) {
        const checked = document.querySelectorAll('.subject-checkbox:checked').length;

        if (checked === 0) {
            e.preventDefault();
            alert('Vui lòng chọn ít nhất một môn học.');
            return;
        }

        if (!confirm('Bạn có chắc muốn khôi phục các môn học đã chọn không?')) {
            e.preventDefault();
        }
    });
});
</script>

@endsection