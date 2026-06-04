@extends('layouts.admin')

@section('title', 'Quản lý môn học')
@section('page-title', 'Quản lý môn học')

@section('content')

<div class="max-w-7xl mx-auto px-2 lg:px-4">

    <!-- HEADER -->
    <div class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
        <div>
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-cyan-50 text-cyan-700 border border-cyan-100 text-xs font-black uppercase tracking-[0.18em] mb-4">
                <i class="fa-solid fa-graduation-cap"></i>
                Subject Management
            </span>

            <h1 class="text-4xl font-black text-slate-900 tracking-tight">
                Quản lý môn học
            </h1>

            <p class="text-slate-500 font-semibold mt-3 max-w-2xl">
                Theo dõi danh sách môn học, giảng viên phụ trách và số lượng học liệu đã được đăng tải.
            </p>
        </div>

        <a href="{{ route('admin.subjects.create') }}"
            class="inline-flex items-center justify-center gap-3 px-6 py-3.5 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-black shadow-lg shadow-cyan-200 transition">
            <i class="fa-solid fa-plus"></i>
            Thêm môn học
        </a>
    </div>

    <!-- OVERVIEW -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-5 mb-8">
        <div class="lg:col-span-2 rounded-[34px] bg-cyan-600 text-white p-7 relative overflow-hidden">
            <div class="absolute -right-16 -top-16 w-56 h-56 bg-white/10 rounded-full"></div>

            <div class="relative">
                <p class="text-cyan-100 text-sm font-bold">Tổng quan môn học</p>

                <h2 class="text-5xl font-black mt-3">
                    {{ number_format($totalSubjects) }} môn
                </h2>

                <p class="text-cyan-50/90 mt-3 font-semibold">
                    Đang được quản lý trong hệ thống học liệu.
                </p>
            </div>
        </div>

        <div class="rounded-[34px] bg-white border border-cyan-100 p-7 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <div class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-5">
                <i class="fa-solid fa-chalkboard-user text-xl"></i>
            </div>

            <p class="text-slate-400 text-xs font-black uppercase tracking-[0.18em]">
                Giảng viên
            </p>

            <h3 class="text-4xl font-black text-slate-900 mt-2">
                {{ number_format($totalTeachers) }}
            </h3>
        </div>

        <div class="rounded-[34px] bg-white border border-cyan-100 p-7 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <div class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-5">
                <i class="fa-solid fa-file-lines text-xl"></i>
            </div>

            <p class="text-slate-400 text-xs font-black uppercase tracking-[0.18em]">
                Tài liệu
            </p>

            <h3 class="text-4xl font-black text-slate-900 mt-2">
                {{ number_format($totalDocuments) }}
            </h3>
        </div>
    </div>

    <!-- AJAX AREA -->
    <div id="subjects-area">

        <!-- FILTER -->
        <form id="subjects-filter-form" method="GET" action="{{ route('admin.subjects.index') }}"
            class="bg-white rounded-[30px] border border-cyan-100 p-4 mb-8 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">

            <div class="flex flex-col xl:flex-row xl:items-center gap-4">
                <div class="flex-1 relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-cyan-600"></i>

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm môn học..."
                        class="w-full h-14 pl-14 pr-5 rounded-2xl bg-cyan-50 border border-cyan-100 text-slate-700 font-semibold outline-none focus:ring-2 focus:ring-cyan-300">
                </div>

                <button type="submit"
                    class="px-6 h-14 rounded-2xl bg-cyan-500 text-white font-black shadow-lg shadow-cyan-200 hover:bg-cyan-600 transition">
                    <i class="fa-solid fa-filter mr-2"></i>
                    Lọc
                </button>
            </div>
        </form>

        <!-- SUBJECT BOARD -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-7">

            @forelse($subjects as $subject)

            <div
                class="group bg-white rounded-[34px] border border-cyan-100 p-6 shadow-[0_15px_45px_rgba(8,145,178,0.08)] hover:-translate-y-1 hover:shadow-[0_22px_60px_rgba(8,145,178,0.16)] transition-all">

                <div class="flex items-start justify-between mb-6">
                    <div
                        class="w-16 h-16 rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center border border-cyan-100 group-hover:bg-cyan-500 group-hover:text-white transition">
                        <i class="fa-solid fa-book-open text-2xl"></i>
                    </div>

                    <span class="px-4 py-2 rounded-full bg-emerald-50 text-emerald-600 text-xs font-black">
                        Hoạt động
                    </span>
                </div>

                <h3 class="text-2xl font-black text-slate-900">
                    {{ $subject->subject_name }} </h3>

                <p class="text-slate-500 text-sm font-semibold mt-2 line-clamp-2">
                    {{ $subject->description ?? 'Chưa có mô tả cho môn học này.' }} </p>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <div class="rounded-2xl bg-cyan-50 border border-cyan-100 p-4">
                        <p class="text-xs text-slate-400 font-black uppercase">Mã môn</p>
                        <h4 class="font-black text-cyan-700 mt-1">
                            {{ $subject->subject_code }} </h4>
                    </div>

                    <div class="rounded-2xl bg-cyan-50 border border-cyan-100 p-4">
                        <p class="text-xs text-slate-400 font-black uppercase">Tài liệu</p>
                        <h4 class="font-black text-cyan-700 mt-1">
                            {{ $subject->documents->count() }} </h4>
                    </div>
                </div>

                <div class="mt-5">
                    @if($subject->lecturers->count() > 0) <div class="flex items-center gap-3">
                        <div class="flex -space-x-3">
                            @foreach($subject->lecturers->take(3) as $teacher) <img
                                src="{{ $teacher->avatar ? asset('storage/' . $teacher->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->full_name) . '&background=06b6d4&color=fff' }}"
                                class="w-10 h-10 rounded-2xl border-2 border-white object-cover">
                            @endforeach
                        </div>

                        <div>
                            <p class="text-sm font-black text-slate-800">
                                {{ $subject->lecturers->pluck('full_name')->take(2)->join(', ') }}
                                @if($subject->lecturers->count() > 2)
                                +{{ $subject->lecturers->count() - 2 }}
                                @endif </p>

                            <p class="text-xs font-semibold text-slate-400">
                                Giảng viên phụ trách
                            </p>
                        </div>
                    </div>
                    @else
                    <div class="rounded-2xl bg-amber-50 border border-amber-100 p-4 text-amber-600 font-bold text-sm">
                        <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                        Chưa gán giảng viên
                    </div>
                    @endif
                </div>

                <div class="mt-6 pt-5 border-t border-cyan-100 flex items-center justify-between">
                    <a href="{{ route('admin.subjects.show', $subject->subject_code) }}"
                        class="text-cyan-600 font-black text-sm hover:text-cyan-700">
                        Xem chi tiết
                    </a>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.subjects.edit', $subject->subject_code) }}" class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 hover:bg-amber-500 hover:text-white
                            flex items-center justify-center transition">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                        <form action="{{ route('admin.subjects.destroy', $subject->subject_code) }}" method="POST"
                            onsubmit="return confirm('Bạn có chắc muốn xóa môn học này không?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
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
                    Hãy thêm môn học mới hoặc thử tìm kiếm bằng từ khóa khác.
                </p>
            </div>

            @endforelse

            <a href="{{ route('admin.subjects.create') }}"
                class="min-h-[360px] rounded-[34px] border-2 border-dashed border-cyan-200 bg-cyan-50/50 hover:bg-cyan-50 flex flex-col items-center justify-center text-center p-8 transition group">

                <div
                    class="w-20 h-20 rounded-3xl bg-white text-cyan-600 flex items-center justify-center shadow-sm group-hover:bg-cyan-500 group-hover:text-white transition">
                    <i class="fa-solid fa-plus text-3xl"></i>
                </div>

                <h3 class="text-xl font-black text-cyan-950 mt-5">
                    Thêm môn học mới
                </h3>

                <p class="text-sm text-slate-500 font-semibold mt-2 max-w-xs">
                    Tạo môn học và gán giảng viên phụ trách.
                </p>
            </a>

        </div>

        <!-- PAGINATION -->
        @if ($subjects->hasPages())
        <div
            class="mt-8 px-7 py-6 bg-white rounded-[30px] border border-cyan-100 flex flex-col md:flex-row items-center justify-between gap-5 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <p class="text-sm font-bold text-slate-500">
                Hiển thị {{ $subjects->firstItem() }} - {{ $subjects->lastItem() }}
                trong tổng {{ $subjects->total() }} môn học
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

                @foreach ($subjects->getUrlRange(1, $subjects->lastPage()) as $page => $url)
                @if ($page == $subjects->currentPage())
                <span
                    class="w-12 h-12 rounded-2xl bg-cyan-500 text-white shadow-lg shadow-cyan-200 flex items-center justify-center font-black">
                    {{ $page }}
                </span>
                @else
                <a href="{{ $url }}"
                    class="ajax-subject-page w-12 h-12 rounded-2xl bg-white border border-cyan-100 text-slate-500 hover:bg-cyan-500 hover:text-white flex items-center justify-center font-bold transition-all">
                    {{ $page }}
                </a>
                @endif
                @endforeach

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
        @endif

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
    const link = e.target.closest('.ajax-subject-page');

    if (!link) return;

    e.preventDefault();

    await loadSubjectsArea(link.href);
});

async function loadSubjectsArea(url) {
    const area = document.getElementById('subjects-area');

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