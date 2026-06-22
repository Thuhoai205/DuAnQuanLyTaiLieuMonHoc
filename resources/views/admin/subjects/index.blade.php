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

    <!-- HEADER -->
    <div class="bg-white border rounded-md shadow-sm p-5">
        <div class="flex justify-between items-center">

            <div>
                <h2 class="text-lg font-black">Danh sách môn học</h2>
                <p class="text-sm text-slate-500">Danh sách môn học trong hệ thống</p>
            </div>

            <div class="flex items-center gap-3">

                <a href="{{ route('admin.subjects.trashed') }}" class="relative inline-flex items-center gap-2 h-11 px-4 rounded-md
          bg-red-50 text-red-600 border border-red-200
          font-black hover:bg-red-100 transition">

                    <!-- ICON -->
                    <i class="fa-solid fa-trash-can-arrow-up"></i>
                    <!-- BADGE -->

                    <span id="trash-count"
                        class="min-w-5 h-5 px-2 rounded-full bg-red-500 text-white text-[10px] flex items-center justify-center">
                        {{ $totalTrashedSubjects }}
                    </span>
                </a>

                <a href="{{ route('admin.subjects.create') }}"
                    class="h-11 px-4 flex items-center bg-sky-500 text-white rounded-md font-black hover:bg-sky-600 transition">

                    <i class="fa-solid fa-plus mr-2"></i>
                    Thêm môn học
                </a>

            </div>

        </div>
    </div>

    <!-- FILTER -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5 mb-6">

        <form id="subjects-filter-form" method="GET" action="{{ route('admin.subjects.index') }}"
            class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

            <div class="md:col-span-5 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Tìm theo mã môn, tên môn..."
                    class="w-full h-11 pl-11 pr-4 rounded-md bg-slate-50 border text-sm font-semibold">
            </div>

            <div class="md:col-span-3">
                <select name="faculty_id" class="w-full h-11 px-4 rounded-md bg-slate-50 border text-sm font-semibold">
                    <option value="">Tất cả khoa</option>
                    @foreach($faculties as $faculty)
                    <option value="{{ $faculty->faculty_id }}" @selected(request('faculty_id')==$faculty->faculty_id)>
                        {{ $faculty->faculty_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <select name="status" class="w-full h-11 px-4 rounded-md bg-slate-50 border text-sm font-semibold">
                    <option value="">Trạng thái</option>
                    <option value="active" @selected(request('status')=='active' )>Hoạt động</option>
                    <option value="archived" @selected(request('status')=='archived' )>Ẩn</option>
                </select>
            </div>

            <div class="md:col-span-1">
                <button type="submit" class="w-full h-11 bg-sky-500 text-white rounded-md text-sm font-black">
                    Lọc
                </button>
            </div>

            <a href="{{ route('admin.subjects.index') }}" id="reset-subject-filter"
                class="h-11 flex items-center justify-center bg-slate-100 text-slate-600 text-sm font-black rounded-md">
                Reset
            </a>

        </form>
    </div>

    <!-- TABLE -->
    <div class="bg-white border rounded-md shadow-sm overflow-hidden">

        <!-- HEADER -->
        <div class="px-5 py-4 border-b flex justify-between">
            <div>
                <h2 class="text-sm font-black">Môn học hệ thống</h2>
                <p class="text-xs text-slate-400">Thông tin môn học</p>
            </div>

            <span class="px-3 py-1 bg-sky-50 text-sky-600 text-xs font-black rounded-md border">
                {{ $subjects->total() ?? 0 }} môn học
            </span>
        </div>

        <!-- HEADER GRID -->
        <div class="px-5 py-3 bg-slate-50 border-b">
            <div class="grid grid-cols-12 text-xs font-black text-slate-500 uppercase">

                <div class="col-span-1">STT</div>
                <div class="col-span-4">Môn học</div>
                <div class="col-span-2">Tài liệu</div>
                <div class="col-span-2">Giảng viên</div>
                <div class="col-span-2">Trạng thái</div>
                <div class="col-span-1 text-right">Hành động</div>

            </div>
        </div>

        <!-- BODY -->
        <div id="subjects-area" class="divide-y">

            @forelse($subjects as $subject)

            @php
            $documentCount = $subject->documents_count ?? 0;
            $teacherCount = $subject->lecturers->count();
            $isActive = $subject->status === 'active';

            $colorMap = [
            'blue' => ['bg' => 'bg-sky-50', 'text' => 'text-sky-600'],
            'green' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600'],
            'red' => ['bg' => 'bg-red-50', 'text' => 'text-red-600'],
            'yellow' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-600'],
            'purple' => ['bg' => 'bg-purple-50', 'text' => 'text-purple-600'],
            ];

            $color = $subject->color ?? 'blue';
            $cls = $colorMap[$color] ?? $colorMap['blue'];
            @endphp

            <div class="px-5 py-4 hover:bg-slate-50 transition">
                <div class="grid grid-cols-12 items-center gap-4">

                    <div class="col-span-1 font-black text-slate-500">
                        {{ $loop->iteration }}
                    </div>

                    <div class="col-span-4 flex items-center gap-3 min-w-0">

                        <div class="w-9 h-9 rounded-md flex items-center justify-center shrink-0 {{ $cls['bg'] }}">
                            <i class="{{ $subject->icon ?? 'fa-solid fa-book' }} {{ $cls['text'] }} text-xs"></i>
                        </div>

                        <div class="min-w-0">
                            <h3 class="font-black text-slate-700 truncate text-sm">
                                {{ $subject->subject_name }}
                            </h3>

                            <p class="text-xs text-slate-500 truncate">
                                {{ $subject->description ?? 'Không có mô tả' }}
                            </p>

                            <div class="flex gap-2 mt-1">
                                <span class="text-[10px] bg-slate-100 px-2 rounded">
                                    {{ $subject->subject_code }}
                                </span>

                                <span class="text-[10px] bg-slate-100 px-2 rounded">
                                    {{ $subject->faculty->faculty_name ?? 'Chưa có khoa' }}
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="col-span-2 font-black text-slate-700">{{ $documentCount }}</div>
                    <div class="col-span-2 font-black text-slate-700">{{ $teacherCount }}</div>

                    <div class="col-span-2">
                        <span id="status-{{ $subject->subject_code }}" class="text-xs px-2 py-1 rounded font-black inline-flex items-center gap-1
    {{ $isActive ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-500' }}">

                            <span
                                class="w-1.5 h-1.5 rounded-full {{ $isActive ? 'bg-emerald-500' : 'bg-red-500' }}"></span>

                            {{ $isActive ? 'Hoạt động' : 'Ẩn' }}
                        </span>
                    </div>

                    <div class="col-span-1 flex justify-end">
                        <div class="flex items-center gap-2">

                            <!-- VIEW -->
                            <a href="{{ route('admin.subjects.show', $subject->subject_code) }}"
                                class="w-9 h-9 flex items-center justify-center rounded-md bg-sky-50 text-sky-600 hover:bg-sky-100 transition">
                                <i class="fa-solid fa-eye text-sm"></i>
                            </a>

                            <!-- EDIT -->
                            <a href="{{ route('admin.subjects.edit', $subject->subject_code) }}"
                                class="w-9 h-9 flex items-center justify-center rounded-md bg-amber-50 text-amber-500 hover:bg-amber-100 transition">
                                <i class="fa-solid fa-pen text-sm"></i>
                            </a>

                            <!-- TOGGLE STATUS (AJAX) -->
                            <button type="button" onclick="toggleSubjectStatus('{{ $subject->subject_code }}', this)"
                                class="w-9 h-9 flex items-center justify-center rounded-md {{ $isActive ? 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' : 'bg-yellow-50 text-yellow-600 hover:bg-yellow-100' }}">

                                @if($isActive)
                                <!-- ACTIVE = UNLOCK -->
                                <i class="fa-solid fa-lock-open text-sm"></i>
                                @else
                                <!-- INACTIVE = LOCK -->
                                <i class="fa-solid fa-lock text-sm"></i>
                                @endif
                            </button>

                            <!-- DELETE -->
                            <form action="{{ route('admin.subjects.destroy', $subject->subject_code) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="button" onclick="deleteSubject('{{ $subject->subject_code }}', this)"
                                    class="w-9 h-9 flex items-center justify-center rounded-md bg-red-50 text-red-500">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>

            @empty
            <div class="p-10 text-center text-slate-500">Không có môn học</div>
            @endforelse

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('submit', function(e) {
    const form = e.target.closest('#subjects-filter-form');
    if (!form) return;

    e.preventDefault();
    const url = form.action + '?' + new URLSearchParams(new FormData(form));
    loadSubjects(url);
});

document.addEventListener('click', function(e) {
    const link = e.target.closest('#reset-subject-filter');
    if (!link) return;

    e.preventDefault();

    const form = document.getElementById('subjects-filter-form');
    form.reset();

    loadSubjects(link.href);
});

async function loadSubjects(url) {
    const area = document.getElementById('subjects-area');
    area.classList.add('opacity-50');

    const res = await fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    });

    const html = await res.text();
    const doc = new DOMParser().parseFromString(html, 'text/html');
    const newArea = doc.querySelector('#subjects-area');

    if (newArea) {
        area.innerHTML = newArea.innerHTML;
        history.pushState({}, '', url);
    }

    area.classList.remove('opacity-50');
}
async function toggleSubjectStatus(id, btn) {
    const res = await fetch(`/admin/subjects/${id}/status`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    });

    const data = await res.json();
    if (!data.success) return;

    const badge = document.getElementById(`status-${id}`);

    if (data.status === 'active') {

        badge.className =
            "text-xs px-2 py-1 rounded font-black inline-flex items-center gap-1 bg-emerald-50 text-emerald-600";

        badge.innerHTML = `
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
            Hoạt động
        `;

        btn.className =
            "w-9 h-9 flex items-center justify-center rounded-md bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition";

        btn.innerHTML = `<i class="fa-solid fa-lock text-sm"></i>`;

    } else {

        badge.className =
            "text-xs px-2 py-1 rounded font-black inline-flex items-center gap-1 bg-red-50 text-red-500";

        badge.innerHTML = `
            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
            Ẩn
        `;

        btn.className =
            "w-9 h-9 flex items-center justify-center rounded-md bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition";

        btn.innerHTML = `<i class="fa-solid fa-lock-open text-sm"></i>`;
    }
}

async function deleteSubject(id, btn) {

    if (!confirm('Bạn có chắc muốn xóa?')) return;

    const res = await fetch(`/admin/subjects/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    });

    const data = await res.json();

    if (data.success) {

        // remove row
        const row = btn.closest('.px-5');
        if (row) row.remove();

        // update trash badge
        const badge = document.querySelector('.trash-count, #trash-count');

        if (badge) {
            badge.textContent = data.trashed_count;
        }
    }
}
</script>
@endpush