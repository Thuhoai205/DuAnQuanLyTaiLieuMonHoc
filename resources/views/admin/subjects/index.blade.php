@extends('layouts.admin')

@section('title', 'Quản lý môn học')
@section('page-title', 'Quản lý môn học')

@section('content')

@php
$totalSubjects = $totalSubjects ?? $subjects->total();
$totalTeachers = $totalTeachers ?? 0;
$totalDocuments = $totalDocuments ?? 0;

$colorMap = [
'blue' => [
'iconBox' => 'bg-blue-50 text-blue-600 border-blue-100 group-hover:bg-blue-500',
'infoBox' => 'bg-blue-50 border-blue-100',
'text' => 'text-blue-700',
'link' => 'text-blue-600 hover:text-blue-700',
'border' => 'border-blue-100',
'accent' => 'bg-blue-500',
'soft' => 'bg-blue-50 text-blue-700 border-blue-100',
],
'green' => [
'iconBox' => 'bg-emerald-50 text-emerald-600 border-emerald-100 group-hover:bg-emerald-500',
'infoBox' => 'bg-emerald-50 border-emerald-100',
'text' => 'text-emerald-700',
'link' => 'text-emerald-600 hover:text-emerald-700',
'border' => 'border-emerald-100',
'accent' => 'bg-emerald-500',
'soft' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
],
'red' => [
'iconBox' => 'bg-red-50 text-red-600 border-red-100 group-hover:bg-red-500',
'infoBox' => 'bg-red-50 border-red-100',
'text' => 'text-red-700',
'link' => 'text-red-600 hover:text-red-700',
'border' => 'border-red-100',
'accent' => 'bg-red-500',
'soft' => 'bg-red-50 text-red-700 border-red-100',
],
'yellow' => [
'iconBox' => 'bg-yellow-50 text-yellow-600 border-yellow-100 group-hover:bg-yellow-500',
'infoBox' => 'bg-yellow-50 border-yellow-100',
'text' => 'text-yellow-700',
'link' => 'text-yellow-600 hover:text-yellow-700',
'border' => 'border-yellow-100',
'accent' => 'bg-yellow-500',
'soft' => 'bg-yellow-50 text-yellow-700 border-yellow-100',
],
'purple' => [
'iconBox' => 'bg-purple-50 text-purple-600 border-purple-100 group-hover:bg-purple-500',
'infoBox' => 'bg-purple-50 border-purple-100',
'text' => 'text-purple-700',
'link' => 'text-purple-600 hover:text-purple-700',
'border' => 'border-purple-100',
'accent' => 'bg-purple-500',
'soft' => 'bg-purple-50 text-purple-700 border-purple-100',
],
'cyan' => [
'iconBox' => 'bg-cyan-50 text-cyan-600 border-cyan-100 group-hover:bg-cyan-500',
'infoBox' => 'bg-cyan-50 border-cyan-100',
'text' => 'text-cyan-700',
'link' => 'text-cyan-600 hover:text-cyan-700',
'border' => 'border-cyan-100',
'accent' => 'bg-cyan-500',
'soft' => 'bg-cyan-50 text-cyan-700 border-cyan-100',
],
'gray' => [
'iconBox' => 'bg-slate-50 text-slate-600 border-slate-100 group-hover:bg-slate-500',
'infoBox' => 'bg-slate-50 border-slate-100',
'text' => 'text-slate-700',
'link' => 'text-slate-600 hover:text-slate-700',
'border' => 'border-slate-100',
'accent' => 'bg-slate-500',
'soft' => 'bg-slate-50 text-slate-700 border-slate-100',
],
];
@endphp

<div class="max-w-7xl mx-auto px-2 lg:px-4">

    <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="text-3xl font-black text-slate-900">
                Quản lý môn học
            </h1>

            <p class="text-slate-500 font-semibold mt-2">
                Quản lý danh sách môn học, khoa, giảng viên phụ trách và tài liệu liên quan.
            </p>
        </div>

        <a href="{{ route('admin.subjects.create') }}"
            class="group inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-cyan-600 text-white font-black shadow-lg shadow-cyan-100 hover:bg-cyan-700 hover:-translate-y-0.5 transition-all">

            <span class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                <i class="fa-solid fa-plus"></i>
            </span>

            <span>Thêm môn học</span>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
        <div
            class="group bg-white rounded-[28px] border border-cyan-100 p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-cyan-100/70 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                        Tổng môn học
                    </p>

                    <h3 class="text-4xl font-black text-cyan-700 mt-2">
                        {{ number_format($totalSubjects) }}
                    </h3>
                </div>

                <div
                    class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white transition">
                    <i class="fa-solid fa-book-open text-xl"></i>
                </div>
            </div>
        </div>

        <div
            class="group bg-white rounded-[28px] border border-emerald-100 p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-100/70 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                        Giảng viên
                    </p>

                    <h3 class="text-4xl font-black text-emerald-700 mt-2">
                        {{ number_format($totalTeachers) }}
                    </h3>
                </div>

                <div
                    class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition">
                    <i class="fa-solid fa-chalkboard-user text-xl"></i>
                </div>
            </div>
        </div>

        <div
            class="group bg-white rounded-[28px] border border-purple-100 p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-purple-100/70 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                        Tài liệu
                    </p>

                    <h3 class="text-4xl font-black text-purple-700 mt-2">
                        {{ number_format($totalDocuments) }}
                    </h3>
                </div>

                <div
                    class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center group-hover:bg-purple-500 group-hover:text-white transition">
                    <i class="fa-solid fa-file-lines text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div id="subjects-area" class="space-y-8">

        <div
            class="bg-white rounded-[34px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] overflow-hidden">
            <div
                class="px-7 py-6 bg-gradient-to-r from-cyan-50 to-sky-50 border-b border-cyan-100 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                <div class="flex items-start gap-4">
                    <div
                        class="w-14 h-14 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-100">
                        <i class="fa-solid fa-layer-group text-xl"></i>
                    </div>

                    <div>
                        <h2 class="text-2xl font-black text-slate-900">
                            Môn học hệ thống
                        </h2>

                        <p class="text-slate-500 font-semibold mt-1">
                            Danh sách môn học đang được quản lý trong hệ thống.
                        </p>
                    </div>
                </div>

                <span
                    class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-white text-cyan-700 text-sm font-black border border-cyan-100 shadow-sm">
                    {{ number_format($subjects->total()) }} môn học
                </span>
            </div>

            <div class="p-5">
                <form id="subjects-filter-form" method="GET" action="{{ route('admin.subjects.index') }}"
                    class="grid grid-cols-1 md:grid-cols-6 gap-4">

                    <div class="md:col-span-2 relative">
                        <i
                            class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-cyan-600"></i>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Tìm mã môn hoặc tên môn..."
                            class="w-full h-12 pl-14 pr-5 rounded-xl bg-slate-50 border border-slate-200 outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700">
                    </div>

                    <select name="faculty_id"
                        class="h-12 px-4 rounded-xl bg-slate-50 border border-slate-200 outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700">

                        <option value="">Tất cả khoa</option>

                        @isset($faculties)
                        @foreach($faculties as $faculty)
                        <option value="{{ $faculty->faculty_id }}" @selected(request('faculty_id')==$faculty->
                            faculty_id)>
                            {{ $faculty->faculty_name }}
                        </option>
                        @endforeach
                        @endisset
                    </select>

                    <select name="status"
                        class="h-12 px-4 rounded-xl bg-slate-50 border border-slate-200 outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700">

                        <option value="">Tất cả trạng thái</option>
                        <option value="active" @selected(request('status')==='active' )>
                            Hoạt động
                        </option>
                        <option value="inactive" @selected(request('status')==='inactive' )>
                            Ngừng hoạt động
                        </option>
                    </select>

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
        </div>

        <div class="min-h-[320px]">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-7">

                @forelse($subjects as $subject)

                @php
                $documentCount = $subject->documents_count ?? 0;
                $isActive = $subject->status === 'active';
                $icon = $subject->icon ?: 'fa-solid fa-book-open';
                $subjectColor = $subject->color ?: 'cyan';
                $theme = $colorMap[$subjectColor] ?? $colorMap['cyan'];
                @endphp

                <div
                    class="group relative bg-white rounded-[34px] border {{ $theme['border'] }} p-6 shadow-[0_15px_45px_rgba(8,145,178,0.08)] hover:-translate-y-1 hover:shadow-2xl hover:shadow-slate-200/80 transition-all overflow-hidden">

                    <div class="absolute top-0 left-0 right-0 h-1.5 {{ $theme['accent'] }}"></div>

                    <div class="flex items-start justify-between mb-6">
                        <div
                            class="w-16 h-16 rounded-3xl {{ $theme['iconBox'] }} flex items-center justify-center border group-hover:text-white transition overflow-hidden">
                            @if($subject->thumbnail)
                            <img src="{{ asset('storage/' . $subject->thumbnail) }}" class="w-full h-full object-cover">
                            @else
                            <i class="{{ $icon }} text-2xl"></i>
                            @endif
                        </div>

                        @if($isActive)
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 text-emerald-600 text-xs font-black border border-emerald-100">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Hoạt động
                        </span>
                        @else
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-50 text-red-500 text-xs font-black border border-red-100">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
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
                        <div class="rounded-2xl {{ $theme['infoBox'] }} border p-4">
                            <p class="text-xs text-slate-400 font-black uppercase">
                                Mã môn
                            </p>

                            <h4 class="font-black {{ $theme['text'] }} mt-1 truncate">
                                {{ $subject->subject_code }}
                            </h4>
                        </div>

                        <div class="rounded-2xl {{ $theme['infoBox'] }} border p-4">
                            <p class="text-xs text-slate-400 font-black uppercase">
                                Tài liệu
                            </p>

                            <h4 class="font-black {{ $theme['text'] }} mt-1">
                                {{ number_format($documentCount) }}
                            </h4>
                        </div>
                    </div>

                    <div class="mt-3 rounded-2xl bg-slate-50 border border-slate-100 p-4">
                        <p class="text-xs text-slate-400 font-black uppercase">
                            Khoa
                        </p>

                        <h4 class="font-black text-slate-700 mt-1 truncate">
                            {{ $subject->faculty->faculty_name ?? 'Chưa phân khoa' }}
                        </h4>
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

                    <div class="mt-6 pt-5 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('admin.subjects.show', $subject->subject_code) }}"
                            class="inline-flex items-center gap-2 {{ $theme['link'] }} font-black text-sm transition">
                            <i class="fa-solid fa-eye fa-fw"></i>
                            Xem chi tiết
                        </a>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.subjects.edit', $subject->subject_code) }}"
                                class="w-11 h-11 rounded-xl bg-amber-50 text-amber-500 hover:bg-amber-500 hover:text-white inline-flex items-center justify-center shrink-0 transition"
                                title="Chỉnh sửa">
                                <i class="fa-solid fa-pen fa-fw text-[16px] leading-none"></i>
                            </a>

                            <form action="{{ route('admin.subjects.status', $subject->subject_code) }}" method="POST"
                                class="subject-status-form m-0 p-0 inline-flex">
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="w-11 h-11 rounded-xl
                                        {{ $isActive
                                            ? 'bg-orange-50 text-orange-500 hover:bg-orange-500'
                                            : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-500' }}
                                        hover:text-white inline-flex items-center justify-center shrink-0 transition"
                                    title="{{ $isActive ? 'Ngừng hoạt động' : 'Kích hoạt lại' }}">

                                    @if($isActive)
                                    <i class="fa-solid fa-ban fa-fw text-[18px] leading-none"></i>
                                    @else
                                    <i class="fa-solid fa-rotate-left fa-fw text-[17px] leading-none"></i>
                                    @endif
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
        </div>

        <div
            class="px-7 py-6 bg-white rounded-[30px] border border-cyan-100 flex flex-col md:flex-row items-center justify-between gap-5 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
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

@endsection

@push('scripts')
<script>
document.addEventListener('submit', async function(e) {
    const filterForm = e.target.closest('#subjects-filter-form');

    if (filterForm) {
        e.preventDefault();

        const url = filterForm.action + '?' + new URLSearchParams(new FormData(filterForm)).toString();

        await loadSubjectsArea(url);
        return;
    }

    const statusForm = e.target.closest('.subject-status-form');

    if (statusForm) {
        e.preventDefault();

        await submitSubjectStatus(statusForm);
        return;
    }
});

document.addEventListener('click', async function(e) {
    const link = e.target.closest('.ajax-subject-page, #reset-subject-filter');

    if (!link) return;

    e.preventDefault();

    await loadSubjectsArea(link.href);
});

async function submitSubjectStatus(form) {
    const area = document.getElementById('subjects-area');
    const button = form.querySelector('button[type="submit"]');

    if (!area) return;

    area.classList.add('opacity-50', 'pointer-events-none');

    if (button) {
        button.disabled = true;
        button.classList.add('opacity-60', 'cursor-not-allowed');
    }

    try {
        await fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        await loadSubjectsArea(window.location.href);

    } catch (error) {
        console.error(error);
    } finally {
        area.classList.remove('opacity-50', 'pointer-events-none');

        if (button) {
            button.disabled = false;
            button.classList.remove('opacity-60', 'cursor-not-allowed');
        }
    }
}

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
@endpush