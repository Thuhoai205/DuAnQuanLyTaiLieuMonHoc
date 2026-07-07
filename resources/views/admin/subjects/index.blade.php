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

<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h2 class="text-2xl font-extrabold text-slate-900">

                    Danh sách môn học

                </h2>

                <p class="mt-2 text-sm font-medium text-slate-500">

                    Quản lý toàn bộ môn học trong hệ thống.

                </p>

            </div>

            <div class="flex items-center gap-3">

                <!-- THÙNG RÁC -->
                <a href="{{ route('admin.subjects.trashed') }}" class="inline-flex items-center gap-2
                h-11
                px-5
                rounded-xl
                border border-red-200
                bg-white
                text-red-600
                text-sm
                font-semibold
                hover:bg-red-500
                hover:text-white
                hover:border-red-500
                transition-all duration-300">

                    <i class="fa-solid fa-trash-can-arrow-up"></i>

                    @if($totalTrashedSubjects > 0)

                    <span class="min-w-6 h-6 px-2
                    rounded-full
                    bg-red-500
                    text-white
                    text-xs
                    font-bold
                    flex items-center justify-center">

                        {{ $totalTrashedSubjects }}

                    </span>

                    @endif

                </a>

                <!-- THÊM MÔN -->
                <a href="{{ route('admin.subjects.create') }}" class="inline-flex items-center gap-2
                h-11
                px-5
                rounded-xl
                bg-slate-900
                text-white
                text-sm
                font-semibold
                hover:bg-amber-500
                transition-all duration-300">

                    <i class="fa-solid fa-plus"></i>

                    Thêm môn học

                </a>

            </div>

        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

        <form id="subjects-filter-form" method="GET" action="{{ route('admin.subjects.index') }}"
            class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

            <!-- SEARCH -->
            <div class="md:col-span-5 relative">

                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Tìm theo mã môn hoặc tên môn..." class="w-full
                h-12
                pl-11
                pr-4
                rounded-xl
                bg-slate-50
                border border-slate-200
                text-sm
                font-medium
                text-slate-700
                placeholder:text-slate-400
                outline-none
                transition-all duration-300
                focus:bg-white
                focus:border-amber-500
                focus:ring-4
                focus:ring-amber-100">

            </div>

            <!-- FACULTY -->
            <div class="md:col-span-3">

                <select name="faculty_id" class="w-full
                h-12
                px-4
                rounded-xl
                bg-slate-50
                border border-slate-200
                text-sm
                font-medium
                text-slate-700
                outline-none
                transition-all duration-300
                focus:bg-white
                focus:border-amber-500
                focus:ring-4
                focus:ring-amber-100">

                    <option value="">Tất cả khoa</option>

                    @foreach($faculties as $faculty)

                    <option value="{{ $faculty->faculty_id }}" @selected(request('faculty_id')==$faculty->faculty_id)>

                        {{ $faculty->faculty_name }}

                    </option>

                    @endforeach

                </select>

            </div>

            <!-- STATUS -->
            <div class="md:col-span-2">

                <select name="status" class="w-full
                h-12
                px-4
                rounded-xl
                bg-slate-50
                border border-slate-200
                text-sm
                font-medium
                text-slate-700
                outline-none
                transition-all duration-300
                focus:bg-white
                focus:border-amber-500
                focus:ring-4
                focus:ring-amber-100">

                    <option value="">Trạng thái</option>

                    <option value="active" @selected(request('status')=='active' )>

                        Hoạt động

                    </option>

                    <option value="archived" @selected(request('status')=='archived' )>

                        Đã ẩn

                    </option>

                </select>

            </div>

            <!-- BUTTON -->
            <div class="md:col-span-1">

                <button type="submit" class="w-full
                h-12
                rounded-xl
                bg-slate-900
                text-white
                text-sm
                font-semibold
                hover:bg-amber-500
                transition-all duration-300">

                    Lọc

                </button>

            </div>

            <!-- RESET -->
            <div class="md:col-span-1">

                <a href="{{ route('admin.subjects.index') }}" id="reset-subject-filter" class="flex items-center justify-center
                h-12
                rounded-xl
                border border-slate-200
                bg-white
                text-slate-700
                text-sm
                font-semibold
                hover:bg-amber-50
                hover:text-amber-600
                hover:border-amber-300
                transition-all duration-300">

                    Reset

                </a>

            </div>

        </form>

    </div>

    <!-- TABLE -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-visible">
        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-200 bg-slate-50/70">

            <div>

                <h2 class="text-lg font-extrabold text-slate-900">

                    Danh sách môn học

                </h2>

                <p class="mt-1 text-sm font-medium text-slate-500">

                    Quản lý toàn bộ môn học trong hệ thống.

                </p>

            </div>

            <span class="inline-flex items-center
            px-4 py-2
            rounded-xl
            bg-amber-50
            border border-amber-200
            text-amber-700
            text-sm
            font-bold">

                <i class="fa-solid fa-book-open mr-2"></i>

                {{ $subjects->total() ?? 0 }} môn học

            </span>

        </div>

        <!-- HEADER GRID -->
        <div class="px-6 py-4 bg-slate-100 border-b border-slate-200">

            <div class="grid grid-cols-12 items-center text-xs font-bold uppercase tracking-wider text-slate-500">

                <div class="col-span-1">

                    STT

                </div>

                <div class="col-span-4">

                    Môn học

                </div>

                <div class="col-span-2 text-center">

                    Tài liệu

                </div>

                <div class="col-span-2 text-center">

                    Giảng viên

                </div>

                <div class="col-span-2 text-center">

                    Trạng thái

                </div>

                <div class="col-span-1 text-center">

                    Thao tác

                </div>

            </div>

        </div>

        <!-- BODY -->
        <div id="subjects-area" class="divide-y divide-slate-100">

            @forelse($subjects as $subject)

            @php
            $documentCount = $subject->documents_count ?? 0;
            $teacherCount = $subject->lecturers->count();
            $active = $subject->status === 'active';

            $colorMap = [
            'blue' => ['bg'=>'bg-sky-50','text'=>'text-sky-600'],
            'green'=>['bg'=>'bg-emerald-50','text'=>'text-emerald-600'],
            'red'=>['bg'=>'bg-red-50','text'=>'text-red-600'],
            'yellow'=>['bg'=>'bg-yellow-50','text'=>'text-yellow-600'],
            'purple'=>['bg'=>'bg-purple-50','text'=>'text-purple-600'],
            ];

            $color = $subject->color ?? 'blue';
            $cls = $colorMap[$color] ?? $colorMap['blue'];
            @endphp
            <div id="subject-{{ $subject->subject_code }}"
                class="grid grid-cols-12 items-center gap-4 px-6 py-5 hover:bg-slate-50 transition-all duration-300">

                <!-- STT -->
                <div class="col-span-1">

                    <span class="text-sm font-bold text-slate-500">

                        {{ ($subjects->currentPage() - 1) * $subjects->perPage() + $loop->iteration }}

                    </span>

                </div>

                <!-- SUBJECT -->
                <div class="col-span-4 flex items-center gap-4 min-w-0">

                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0
                    {{ $cls['bg'] }}">

                        <i class="{{ $subject->icon ?? 'fa-solid fa-book-open' }}
                        {{ $cls['text'] }} text-lg"></i>

                    </div>

                    <div class="min-w-0">

                        <h3 class="text-sm font-bold text-slate-800 truncate">

                            {{ $subject->subject_name }}

                        </h3>

                        <p class="mt-1 text-xs text-slate-500 truncate">

                            {{ $subject->description ?: 'Chưa có mô tả cho môn học.' }}

                        </p>

                        <div class="flex flex-wrap items-center gap-2 mt-2">

                            <span class="px-2.5 py-1 rounded-lg
                            bg-slate-100
                            text-slate-600
                            text-[11px]
                            font-semibold">

                                {{ $subject->subject_code }}

                            </span>

                            <span class="px-2.5 py-1 rounded-lg
                            bg-amber-50
                            text-amber-700
                            text-[11px]
                            font-semibold">

                                {{ $subject->faculty->faculty_name ?? 'Chưa có khoa' }}

                            </span>

                        </div>

                    </div>

                </div>

                <!-- DOCUMENT -->
                <div class="col-span-2 text-center">

                    <span class="text-base font-bold text-slate-800">

                        {{ number_format($documentCount) }}

                    </span>

                </div>

                <!-- LECTURER -->
                <div class="col-span-2 text-center">

                    <span class="text-base font-bold text-slate-800">

                        {{ number_format($teacherCount) }}

                    </span>

                </div>

                <!-- STATUS -->
                <div class="col-span-2 flex justify-center">

                    <span id="status-{{ $subject->subject_code }}" class="inline-flex items-center gap-2
                    px-3 py-1.5
                    rounded-xl
                    text-xs font-bold
                    {{ $active
                        ? 'bg-emerald-50 text-emerald-700 border border-emerald-200'
                        : 'bg-red-50 text-red-600 border border-red-200' }}">

                        <span class="w-2 h-2 rounded-full
                        {{ $active ? 'bg-emerald-500' : 'bg-red-500' }}">
                        </span>

                        {{ $active ? 'Hoạt động' : 'Đã khóa' }}

                    </span>

                </div>

                <!-- ACTION -->
                <div class="col-span-1 flex justify-center">
                    <div class="relative">

                        <!-- BUTTON -->
                        <button type="button" class="action-btn
                        w-10 h-10
                        rounded-xl
                        border border-slate-200
                        bg-white
                        text-slate-500
                        hover:bg-amber-50
                        hover:text-amber-500
                        transition-all duration-300" data-id="{{ $subject->subject_code }}">

                            <i class="fa-solid fa-ellipsis-vertical"></i>

                        </button>

                        <!-- MENU -->
                        <div id="action-menu-{{ $subject->subject_code }}"
                            class="hidden absolute right-0 top-12 w-48 rounded-xl bg-white border border-slate-200 shadow-xl z-[9999] overflow-hidden">

                            <!-- VIEW -->
                            <a href="{{ route('admin.subjects.show',[
                                'subject'=>$subject->subject_code,
                                'return'=>urlencode(request()->fullUrl().'#subject-'.$subject->subject_code)
                            ]) }}"
                                class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-50">

                                <i class="fa-solid fa-eye w-5 text-slate-500"></i>

                                Xem chi tiết

                            </a>

                            <!-- EDIT -->
                            <a href="{{ route('admin.subjects.edit',$subject->subject_code) }}"
                                class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-amber-600 hover:bg-amber-50">

                                <i class="fa-solid fa-pen w-5"></i>

                                Chỉnh sửa

                            </a>

                            <!-- STATUS -->
                            <button type="button" onclick="toggleStatus('{{ $subject->subject_code }}', this)" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium
                            {{ $active
                                ? 'text-emerald-600 hover:bg-emerald-50'
                                : 'text-yellow-600 hover:bg-yellow-50' }}">

                                <i class="fa-solid {{ $active ? 'fa-lock-open' : 'fa-lock' }} w-5"></i>

                                {{ $active ? 'Khóa môn học' : 'Mở khóa môn học' }}

                            </button>

                            <!-- DELETE -->
                            <form action="{{ route('admin.subjects.destroy',$subject->subject_code) }}" method="POST"
                                class="delete-subject-form">

                                @csrf
                                @method('DELETE')

                                <button type="button" onclick="deleteSubject('{{ $subject->subject_code }}')"
                                    class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-50">

                                    <i class="fa-solid fa-trash w-5"></i>

                                    Xóa

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

            @empty

            <div class="py-20 text-center">

                <div class="w-20 h-20 mx-auto rounded-2xl bg-slate-100 flex items-center justify-center">

                    <i class="fa-solid fa-book-open text-3xl text-slate-400"></i>

                </div>

                <h3 class="mt-5 text-lg font-bold text-slate-700">

                    Không có môn học

                </h3>

                <p class="mt-2 text-sm text-slate-500">

                    Hiện chưa có môn học nào trong hệ thống.

                </p>

            </div>

            @endforelse

        </div>
        <!-- PAGINATION -->
        <div class="border-t border-slate-200 bg-slate-50 px-6 py-5">

            <div class="flex flex-col md:flex-row items-center justify-between gap-4">

                <!-- INFO -->
                <p class="text-sm font-medium text-slate-500">

                    Hiển thị

                    <span class="font-bold text-slate-900">
                        {{ $subjects->firstItem() ?? 0 }}
                    </span>

                    -

                    <span class="font-bold text-slate-900">
                        {{ $subjects->lastItem() ?? 0 }}
                    </span>

                    trong tổng

                    <span class="font-bold text-slate-900">
                        {{ $subjects->total() }}
                    </span>

                    môn học

                </p>

                <!-- PAGINATION -->
                <div class="flex items-center gap-2">

                    {{-- Previous --}}
                    @if ($subjects->onFirstPage())

                    <span class="w-10 h-10 rounded-xl
                        bg-white
                        border border-slate-200
                        text-slate-300
                        flex items-center justify-center
                        cursor-not-allowed">

                        <i class="fa-solid fa-angle-left"></i>

                    </span>

                    @else

                    <a href="{{ $subjects->previousPageUrl() }}" class="ajax-subject-page
                        w-10 h-10
                        rounded-xl
                        bg-white
                        border border-slate-200
                        text-slate-600
                        hover:bg-amber-500
                        hover:border-amber-500
                        hover:text-white
                        flex items-center justify-center
                        transition-all duration-300">

                        <i class="fa-solid fa-angle-left"></i>

                    </a>

                    @endif


                    {{-- Page Number --}}
                    @for ($page = 1; $page <= max($subjects->lastPage(),1); $page++)

                        @if ($page == $subjects->currentPage())

                        <span class="w-10 h-10
                            rounded-xl
                            bg-slate-900
                            text-white
                            font-bold
                            flex items-center justify-center">

                            {{ $page }}

                        </span>

                        @else

                        <a href="{{ $subjects->url($page) }}" class="ajax-subject-page
                            w-10 h-10
                            rounded-xl
                            bg-white
                            border border-slate-200
                            text-slate-600
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


                        {{-- Next --}}
                        @if ($subjects->hasMorePages())

                        <a href="{{ $subjects->nextPageUrl() }}" class="ajax-subject-page
                        w-10 h-10
                        rounded-xl
                        bg-white
                        border border-slate-200
                        text-slate-600
                        hover:bg-amber-500
                        hover:border-amber-500
                        hover:text-white
                        flex items-center justify-center
                        transition-all duration-300">

                            <i class="fa-solid fa-angle-right"></i>

                        </a>

                        @else

                        <span class="w-10 h-10
                        rounded-xl
                        bg-white
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
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    // SEARCH + FILTER
    document.addEventListener('submit', function(e) {

        const form = e.target.closest('#subjects-filter-form');
        if (!form) return;

        e.preventDefault();

        const url = form.action + '?' + new URLSearchParams(new FormData(form));

        loadSubjects(url);

    });

    // RESET
    document.addEventListener('click', function(e) {

        const btn = e.target.closest('#reset-subject-filter');
        if (!btn) return;

        e.preventDefault();

        document.getElementById('subjects-filter-form').reset();

        loadSubjects(btn.href);

    });

    // PAGINATION AJAX
    document.addEventListener('click', function(e) {

        const link = e.target.closest('.ajax-subject-page');

        if (!link) return;

        e.preventDefault();

        loadSubjects(link.href);

    });

    // MENU BA CHẤM
    document.addEventListener('click', function(e) {

        const btn = e.target.closest('.action-btn');

        if (btn) {

            e.stopPropagation();

            const id = btn.dataset.id;

            document.querySelectorAll('[id^="action-menu-"]').forEach(menu => {

                if (menu.id === 'action-menu-' + id) {

                    menu.classList.toggle('hidden');

                } else {

                    menu.classList.add('hidden');

                }

            });

            return;

        }

        document.querySelectorAll('[id^="action-menu-"]').forEach(menu => {

            menu.classList.add('hidden');

        });

    });

});

async function loadSubjects(url) {

    const area = document.getElementById('subjects-area');

    if (!area) return;

    area.classList.add('opacity-50');

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

            history.pushState({}, '', url);

        }

    } catch (e) {

        console.error(e);

        alert('Không thể tải dữ liệu.');

    }

    area.classList.remove('opacity-50');

}

// BACK/FORWARD
window.addEventListener('popstate', () => {

    loadSubjects(location.href);

});

async function toggleStatus(id, btn) {

    try {

        const response = await fetch(`/admin/subjects/${id}/status`, {

            method: 'PATCH',

            headers: {

                'X-CSRF-TOKEN': '{{ csrf_token() }}',

                'Accept': 'application/json',

                'X-Requested-With': 'XMLHttpRequest'

            }

        });

        const data = await response.json();

        if (!data.success) {

            alert(data.message ?? 'Không thể cập nhật.');

            return;

        }

        loadSubjects(window.location.href);

    } catch (e) {

        console.error(e);

        alert('Có lỗi xảy ra.');

    }

}

async function deleteSubject(id) {

    if (!confirm('Bạn có chắc muốn xóa môn học này?')) {
        return;
    }

    try {

        const response = await fetch(`/admin/subjects/${id}`, {

            method: 'DELETE',

            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }

        });

        const data = await response.json();

        if (!response.ok || !data.success) {

            alert(data.message ?? 'Không thể thực hiện.');

            return;

        }

        // Nếu chuyển vào thùng rác
        if (data.action === 'deleted') {

            alert(data.message);

        }

        // Nếu bị khóa
        else if (data.action === 'archived') {

            alert(data.message);

        }

        loadSubjects(window.location.href);

    } catch (e) {

        console.error(e);

        alert('Có lỗi xảy ra.');

    }

}
</script>
@endpush