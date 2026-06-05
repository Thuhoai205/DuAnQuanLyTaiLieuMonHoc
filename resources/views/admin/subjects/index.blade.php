@extends('layouts.admin')

@section('title', 'Quản lý môn học')
@section('page-title', 'Quản lý môn học')

@section('content')

@php
$totalSubjects = $totalSubjects ?? $subjects->total();
$totalTeachers = $totalTeachers ?? 0;
$totalDocuments = $totalDocuments ?? 0;
$totalTrashedSubjects = $totalTrashedSubjects ?? 0;
@endphp

<div class="max-w-7xl mx-auto px-2 lg:px-4">

    <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="text-3xl font-black text-slate-900">Quản lý môn học</h1>
            <p class="text-slate-500 font-semibold mt-2">
                Quản lý danh sách môn học, giảng viên phụ trách và tài liệu liên quan.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.subjects.trashed') }}"
                class="group inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-white border border-red-100 text-red-500 font-black shadow-sm hover:bg-red-500 hover:text-white hover:shadow-lg hover:shadow-red-100 transition-all">
                <span
                    class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center group-hover:bg-white/20 group-hover:text-white transition">
                    <i class="fa-solid fa-trash-restore"></i>
                </span>

                <span>Môn học đã xóa</span>

                @if($totalTrashedSubjects > 0)
                <span
                    class="min-w-7 h-7 px-2 rounded-full bg-red-500 text-white text-xs font-black flex items-center justify-center group-hover:bg-white group-hover:text-red-500 transition">
                    {{ $totalTrashedSubjects }}
                </span>
                @endif
            </a>

            <a href="{{ route('admin.subjects.create') }}"
                class="group inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-cyan-600 text-white font-black shadow-lg shadow-cyan-100 hover:bg-cyan-700 hover:-translate-y-0.5 transition-all">
                <span class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-plus"></i>
                </span>
                Thêm môn học
            </a>
        </div>
    </div>

    <div id="subjects-area">

        <div class="bg-white rounded-2xl border border-cyan-100 p-5 mb-8 shadow-sm">
            <form id="subjects-filter-form" method="GET" action="{{ route('admin.subjects.index') }}"
                class="grid grid-cols-1 md:grid-cols-5 gap-4">

                <div class="md:col-span-3 relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-cyan-600"></i>

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Tìm theo mã môn hoặc tên môn học..."
                        class="w-full h-12 pl-14 pr-5 rounded-xl bg-slate-50 border border-slate-200 outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700">
                </div>

                <button type="submit"
                    class="h-12 rounded-xl bg-cyan-600 text-white font-black hover:bg-cyan-700 transition">
                    <i class="fa-solid fa-filter mr-2"></i>
                    Lọc
                </button>

                <a href="{{ route('admin.subjects.index') }}" id="reset-subject-filter"
                    class="h-12 rounded-xl bg-slate-100 text-slate-700 font-black flex items-center justify-center hover:bg-slate-200 transition">
                    Reset
                </a>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-7">

            @forelse($subjects as $subject)

            @php
            $documentCount = $subject->documents_count ?? $subject->documents->count();
            @endphp

            <div
                class="group bg-white rounded-[34px] border border-cyan-100 p-6 shadow-[0_15px_45px_rgba(8,145,178,0.08)] hover:-translate-y-1 hover:shadow-[0_22px_60px_rgba(8,145,178,0.16)] transition-all">

                <div class="flex items-start justify-between mb-6">
                    <div
                        class="w-16 h-16 rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center border border-cyan-100 group-hover:bg-cyan-500 group-hover:text-white transition">
                        <i class="fa-solid fa-book-open text-2xl"></i>
                    </div>

                    @if($subject->is_active)
                    <span class="px-4 py-2 rounded-full bg-emerald-50 text-emerald-600 text-xs font-black">
                        Hoạt động
                    </span>
                    @else
                    <span class="px-4 py-2 rounded-full bg-red-50 text-red-500 text-xs font-black">
                        Ngừng hoạt động
                    </span>
                    @endif
                </div>

                <div class="min-w-0">
                    <h3 class="text-2xl font-black text-slate-900 truncate">
                        {{ $subject->subject_name }}
                    </h3>

                    <p class="text-slate-500 text-sm font-semibold mt-2 truncate">
                        {{ $subject->description ?? 'Chưa có mô tả cho môn học này.' }}
                    </p>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <div class="rounded-2xl bg-cyan-50 border border-cyan-100 p-4">
                        <p class="text-xs text-slate-400 font-black uppercase">Mã môn</p>
                        <h4 class="font-black text-cyan-700 mt-1 truncate">
                            {{ $subject->subject_code }}
                        </h4>
                    </div>

                    <div class="rounded-2xl bg-cyan-50 border border-cyan-100 p-4">
                        <p class="text-xs text-slate-400 font-black uppercase">Tài liệu</p>
                        <h4 class="font-black text-cyan-700 mt-1">
                            {{ $documentCount }}
                        </h4>
                    </div>
                </div>

                <div class="mt-5 min-h-[44px]">
                    @if($subject->lecturers->count() > 0)
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="flex -space-x-3 flex-shrink-0">
                            @foreach($subject->lecturers->take(3) as $teacher)
                            <img src="{{ $teacher->avatar ? asset('storage/' . $teacher->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->full_name) . '&background=06b6d4&color=fff' }}"
                                class="w-10 h-10 rounded-2xl border-2 border-white object-cover">
                            @endforeach
                        </div>

                        <div class="min-w-0">
                            <p class="text-sm font-black text-slate-800 truncate">
                                {{ $subject->lecturers->pluck('full_name')->take(2)->join(', ') }}
                                @if($subject->lecturers->count() > 2)
                                +{{ $subject->lecturers->count() - 2 }}
                                @endif
                            </p>

                            <p class="text-xs font-semibold text-slate-400">
                                Giảng viên phụ trách
                            </p>
                        </div>
                    </div>
                    @else
                    <span
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-100 text-slate-600 text-sm font-bold">
                        <i class="fa-solid fa-user-plus"></i>
                        Chưa phân công giảng viên
                    </span>
                    @endif
                </div>

                <div class="mt-6 pt-5 border-t border-cyan-100 flex items-center justify-between">
                    <a href="{{ route('admin.subjects.show', $subject->subject_code) }}"
                        class="inline-flex items-center gap-2 text-cyan-600 font-black text-sm hover:text-cyan-700 transition">
                        <i class="fa-solid fa-eye"></i>
                        Xem chi tiết
                    </a>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.subjects.edit', $subject->subject_code) }}"
                            class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 hover:bg-amber-500 hover:text-white flex items-center justify-center transition"
                            title="Chỉnh sửa">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                        @if($documentCount > 0)
                        <form action="{{ route('admin.subjects.destroy', $subject->subject_code) }}" method="POST"
                            onsubmit="return confirm('Môn học này đã có tài liệu. Hệ thống sẽ chuyển sang trạng thái ngừng hoạt động. Bạn có muốn tiếp tục không?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="w-10 h-10 rounded-xl bg-orange-50 text-orange-500 hover:bg-orange-500 hover:text-white flex items-center justify-center transition"
                                title="Ngừng hoạt động">
                                <i class="fa-solid fa-ban"></i>
                            </button>
                        </form>
                        @else
                        <form action="{{ route('admin.subjects.destroy', $subject->subject_code) }}" method="POST"
                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa môn học này không?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition"
                                title="Xóa môn học">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>

            </div>

            @empty
            <div
                class="md:col-span-2 xl:col-span-3 bg-white rounded-[34px] border border-cyan-100 p-12 text-center shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
                <div
                    class="w-20 h-20 mx-auto rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-5">
                    <i class="fa-solid fa-book-open text-3xl"></i>
                </div>

                <h3 class="text-2xl font-black text-slate-900">
                    Không tìm thấy môn học
                </h3>

                <p class="text-slate-500 font-semibold mt-2">
                    Hãy thử từ khóa khác hoặc thêm môn học mới.
                </p>

                <div class="mt-6 flex justify-center gap-3">
                    <a href="{{ route('admin.subjects.index') }}"
                        class="px-5 py-3 rounded-2xl bg-slate-100 text-slate-700 font-black hover:bg-slate-200">
                        Reset tìm kiếm
                    </a>

                    <a href="{{ route('admin.subjects.create') }}"
                        class="px-5 py-3 rounded-2xl bg-cyan-600 text-white font-black hover:bg-cyan-700">
                        Thêm môn học mới
                    </a>
                </div>
            </div>
            @endforelse

        </div>

        <div
            class="mt-8 px-7 py-6 bg-white rounded-[30px] border border-cyan-100 flex flex-col md:flex-row items-center justify-between gap-5 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <p class="text-sm font-bold text-slate-500">
                Hiển thị
                <span class="text-cyan-700">{{ $subjects->firstItem() ?? 0 }}</span>
                -
                <span class="text-cyan-700">{{ $subjects->lastItem() ?? 0 }}</span>
                trong tổng
                <span class="text-cyan-700">{{ $subjects->total() }}</span>
                môn học
            </p>

            <div class="flex items-center gap-3">
                @if ($subjects->onFirstPage())
                <span
                    class="w-12 h-12 rounded-2xl bg-white border border-slate-100 text-slate-300 flex items-center justify-center cursor-not-allowed">
                    <i class="fa-solid fa-angle-left"></i>
                </span>
                @else
                <a href="{{ $subjects->previousPageUrl() }}"
                    class="ajax-subject-page w-12 h-12 rounded-2xl bg-white border border-cyan-100 text-slate-500 hover:bg-cyan-500 hover:text-white flex items-center justify-center transition-all">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
                @endif

                @for ($page = 1; $page <= max($subjects->lastPage(), 1); $page++)
                    @if ($page == $subjects->currentPage())
                    <span
                        class="w-12 h-12 rounded-2xl bg-cyan-500 text-white shadow-lg shadow-cyan-200 flex items-center justify-center font-black">
                        {{ $page }}
                    </span>
                    @else
                    <a href="{{ $subjects->url($page) }}"
                        class="ajax-subject-page w-12 h-12 rounded-2xl bg-white border border-cyan-100 text-slate-500 hover:bg-cyan-500 hover:text-white flex items-center justify-center font-bold transition-all">
                        {{ $page }}
                    </a>
                    @endif
                    @endfor

                    @if ($subjects->hasMorePages())
                    <a href="{{ $subjects->nextPageUrl() }}"
                        class="ajax-subject-page w-12 h-12 rounded-2xl bg-white border border-cyan-100 text-slate-500 hover:bg-cyan-500 hover:text-white flex items-center justify-center transition-all">
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

</div>

<script>
document.addEventListener('submit', async function(e) {
    const form = e.target.closest('#subjects-filter-form');

    if (!form) return;

    e.preventDefault();

    const url = form.action + '?' + new URLSearchParams(new FormData(form)).toString();

    await loadSubjectsArea(url);
});

document.addEventListener('click', async function(e) {
    const link = e.target.closest('.ajax-subject-page, #reset-subject-filter');

    if (!link) return;

    e.preventDefault();

    await loadSubjectsArea(link.href);
});

async function loadSubjectsArea(url) {
    const area = document.getElementById('subjects-area');

    if (!area) return;

    area.classList.add('opacity-50', 'pointer-events-none');

    try {
        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const html = await response.text();
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newArea = doc.querySelector('#subjects-area');

        if (newArea) {
            area.innerHTML = newArea.innerHTML;
            window.history.pushState({}, '', url);
        }
    } catch (error) {
        console.error(error);
    } finally {
        area.classList.remove('opacity-50', 'pointer-events-none');
    }
}
</script>

@endsection