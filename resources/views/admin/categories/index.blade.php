@extends('layouts.admin')

@section('title', 'Quản lý loại tài liệu')

@section('content')
<div class="min-h-screen bg-[#F6F7FB] px-6 py-8">

    <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Quản lý loại tài liệu
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Thêm, chỉnh sửa và quản lý các loại tài liệu trong hệ thống.
            </p>
        </div>

        <a href="{{ route('admin.categories.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-[#7C3AED] px-5 py-3 text-sm font-semibold text-white shadow-md shadow-violet-200 transition hover:bg-[#6D28D9]">
            <i class="fa-solid fa-plus"></i>
            Thêm loại tài liệu
        </a>
    </div>

    @if(session('success'))
    <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700">
        <i class="fa-solid fa-circle-check mr-2"></i>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-medium text-rose-700">
        <i class="fa-solid fa-circle-exclamation mr-2"></i>
        {{ session('error') }}
    </div>
    @endif

    <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <form action="{{ route('admin.categories.index') }}" method="GET" class="flex flex-col gap-4 md:flex-row">

            <div class="relative flex-1">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                <input type="text" name="keyword" value="{{ request('keyword') }}"
                    placeholder="Tìm kiếm theo tên loại tài liệu..."
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm text-slate-700 outline-none transition focus:border-violet-400 focus:bg-white focus:ring-4 focus:ring-violet-100">
            </div>

            <button type="submit"
                class="rounded-xl bg-slate-800 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-900">
                Tìm kiếm
            </button>

            <a href="{{ route('admin.categories.index') }}"
                class="rounded-xl border border-slate-200 px-6 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                Làm mới
            </a>
        </form>
    </div>

    <div id="categoryTable" class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">
            <div>
                <h2 class="font-bold text-slate-800">
                    Danh sách loại tài liệu
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Tổng số:
                    <span class="font-semibold text-violet-600">
                        {{ $loaiTaiLieus->total() }}
                    </span>
                    loại tài liệu
                </p>
            </div>
        </div>

        <div id="categoryTable">
            <table class="w-full min-w-[850px] text-left">
                <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-6 py-4">STT</th>
                        <th class="px-6 py-4">
                            <div class="flex items-center gap-3">

                                <span>LOẠI TÀI LIỆU</span>

                                <button id="sortBtn" type="button" data-sort="{{ request('sort', 'default') }}">

                                    <i id="sortIcon" class="fa-solid fa-chevron-down text-xs transition-transform duration-300
                {{ request('sort') === 'za' ? 'rotate-180' : '' }}">
                                    </i>

                                </button>

                            </div>
                        </th>
                        <th class="px-6 py-4">Mô tả</th>
                        <th class="px-6 py-4">Số tài liệu</th>
                        <th class="px-6 py-4 text-center">Thao tác</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($loaiTaiLieus as $index => $loai)
                    <tr class="transition hover:bg-violet-50/40">
                        <td class="px-6 py-5 text-sm text-slate-500">
                            {{ $loaiTaiLieus->firstItem() + $index }}
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-violet-100 text-violet-600">
                                    <i class="fa-solid fa-file-lines"></i>
                                </div>

                                <div>
                                    <p class="font-semibold text-slate-800">
                                        {{ $loai->ten_loai }}
                                    </p>
                                    <p class="text-xs text-slate-400">
                                        Mã loại: #{{ $loai->loai_id }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-5 text-sm text-slate-500">
                            {{ $loai->mo_ta ?? 'Chưa có mô tả' }}
                        </td>

                        <td class="px-6 py-5">
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                {{ $loai->taiLieus_count ?? $loai->taiLieus->count() }} tài liệu
                            </span>
                        </td>

                        <td class="px-6 py-5">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.categories.edit', $loai->loai_id) }}"
                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-600 transition hover:bg-amber-100"
                                    title="Chỉnh sửa">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <form action="{{ route('admin.categories.destroy', $loai->loai_id) }}" method="POST"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa loại tài liệu này?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" onclick="openDeleteModal(
        '{{ $loai->loai_id }}',
        '{{ $loai->ten_loai }}'
    )" class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-rose-50 text-rose-600 transition hover:bg-rose-100">

                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div
                                class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-violet-100 text-violet-500">
                                <i class="fa-solid fa-folder-open text-2xl"></i>
                            </div>
                            <h3 class="font-semibold text-slate-700">
                                Chưa có loại tài liệu nào
                            </h3>
                            <p class="mt-1 text-sm text-slate-500">
                                Hãy thêm loại tài liệu đầu tiên cho hệ thống.
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-200 px-6 py-4">
            {{ $loaiTaiLieus->appends(request()->query())->links() }}
        </div>
    </div>
</div>
<!-- DELETE MODAL -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">

    <div class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl">

        <!-- icon -->
        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-rose-100 text-rose-600">
            <i class="fa-solid fa-trash text-2xl"></i>
        </div>

        <!-- title -->
        <h2 class="text-center text-xl font-bold text-slate-800">
            Xác nhận xóa
        </h2>

        <!-- content -->
        <p class="mt-3 text-center text-sm leading-6 text-slate-500">
            Bạn có chắc muốn xóa loại tài liệu:
            <span id="deleteName" class="font-semibold text-slate-700">
            </span>
            ?
        </p>

        <p class="mt-2 text-center text-xs text-rose-500">
            Hành động này không thể hoàn tác.
        </p>

        <!-- buttons -->
        <div class="mt-6 flex items-center justify-center gap-3">

            <button type="button" onclick="closeDeleteModal()"
                class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                Hủy
            </button>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit"
                    class="rounded-xl bg-rose-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-rose-700">
                    Xóa
                </button>
            </form>

        </div>
    </div>
</div>
<script>
const sortButton = document.getElementById('sortButton');
const sortMenu = document.getElementById('sortMenu');

if (sortButton && sortMenu) {
    sortButton.addEventListener('click', () => {
        sortMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!sortButton.contains(e.target) && !sortMenu.contains(e.target)) {
            sortMenu.classList.add('hidden');
        }
    });
}
</script>
@endsection
<script>
document.addEventListener('DOMContentLoaded', () => {

    // xử lý click sort
    document.addEventListener('click', async function(e) {

        const sortBtn = e.target.closest('#sortBtn');

        if (!sortBtn) return;

        // lấy sort hiện tại
        let currentSort = sortBtn.dataset.sort || 'default';

        // đổi sort
        let nextSort =
            currentSort === 'az' ?
            'za' :
            'az';

        // loading nhẹ
        sortBtn.classList.add(
            'opacity-60',
            'pointer-events-none'
        );

        try {

            const url =
                `{{ route('admin.categories.index') }}?sort=${nextSort}`;

            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const html = await response.text();

            const parser = new DOMParser();

            const doc = parser.parseFromString(
                html,
                'text/html'
            );

            // lấy bảng mới
            const newTable =
                doc.querySelector('#categoryTable');

            // thay nội dung bảng
            document.querySelector('#categoryTable')
                .innerHTML = newTable.innerHTML;

            // đổi url nhưng không reload
            window.history.pushState({}, '', url);

        } catch (error) {

            console.error(error);

        } finally {

            sortBtn.classList.remove(
                'opacity-60',
                'pointer-events-none'
            );
        }
    });
});

function openDeleteModal(id, name) {
    const modal = document.getElementById('deleteModal');

    const deleteName =
        document.getElementById('deleteName');

    const deleteForm =
        document.getElementById('deleteForm');

    deleteName.innerText = name;

    deleteForm.action =
        `/admin/categories/${id}`;

    modal.classList.remove('hidden');

    modal.classList.add('flex');
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');

    modal.classList.remove('flex');

    modal.classList.add('hidden');
}

// click ra ngoài để đóng
document.addEventListener('click', function(e) {

    const modal =
        document.getElementById('deleteModal');

    if (e.target === modal) {

        closeDeleteModal();
    }
});
</script>