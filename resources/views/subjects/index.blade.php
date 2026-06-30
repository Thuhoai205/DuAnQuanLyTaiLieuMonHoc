@extends('layouts.app')

@section('title', 'Danh mục Môn học')

@section('content')

<main class="min-h-screen bg-[#EAFBFF]">

    <section class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-14">

        <!-- BACK -->
        <div class="mb-10">
            <a href="javascript:history.back()"
                class="inline-flex items-center gap-2.5 px-6 py-3 bg-white border border-cyan-100 text-cyan-700 hover:text-cyan-800 font-bold text-xs uppercase tracking-wider rounded-full shadow-sm hover:shadow-cyan-200 transition-all duration-300">
                <i class="fa-solid fa-arrow-left"></i>
                Quay lại
            </a>
        </div>

        <!-- HEADER -->
        <div
            class="flex flex-col xl:flex-row xl:items-center justify-between gap-6 mb-12 pb-8 border-b border-cyan-100">

            <div>
                <div class="flex items-center mb-3">
                    <div
                        class="w-12 h-12 bg-cyan-500 rounded-2xl flex items-center justify-center text-white mr-4 shadow-lg shadow-cyan-200">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>

                    <h1 class="text-3xl font-black text-cyan-950 tracking-tight">
                        Danh mục Môn học
                    </h1>
                </div>

                <p class="text-slate-500 font-medium text-sm pl-[64px] max-w-2xl leading-relaxed">
                    Quản lý và truy cập kho học liệu theo từng môn học, chuyên ngành và lĩnh vực đào tạo.
                </p>
            </div>

            <div class="flex flex-col lg:flex-row items-stretch lg:items-center gap-4">

                <!-- SEARCH -->
                <div class="relative w-full lg:w-72">
                    <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-cyan-600 text-xs"></i>

                    <input type="text" id="subjectSearch" onkeyup="searchSubjects()" placeholder="Tìm theo tên môn..."
                        class="w-full pl-11 pr-4 py-3 bg-white border border-cyan-100 rounded-2xl text-sm font-semibold text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-300 focus:border-cyan-500 transition-all">
                </div>

                @auth
                @if(auth()->user()->role->role_name === 'lecturer')

                <div class="inline-flex p-1 bg-cyan-50 border border-cyan-100 rounded-2xl">

                    <button id="btnAssigned" onclick="filterSubjects('assigned')"
                        class="px-6 py-3 rounded-xl text-cyan-700 text-sm font-black transition">

                        Phụ trách ({{ auth()->user()->subjects->count() }})

                    </button>

                    <button id="btnAll" onclick="filterSubjects('all')"
                        class="px-6 py-3 rounded-xl bg-cyan-500 text-white text-sm font-black transition">

                        Tất cả ({{ $subjects->count() }})

                    </button>

                </div>

                @endif
                @endauth

            </div>
        </div>
        <div id="subjectGrid" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">

            @forelse($subjects as $subject)

            <a href="{{ route('subjects.show',$subject->subject_code) }}" class="subject-card group relative block bg-white rounded-[2rem] border border-cyan-100
                shadow-[0_15px_45px_rgba(8,145,178,0.08)]
                hover:shadow-[0_20px_60px_rgba(8,145,178,0.16)]
                hover:-translate-y-2 transition-all duration-500 overflow-hidden" data-assigned="{{ Auth::check()
        && Auth::user()->role->role_name === 'lecturer'
        && Auth::user()->subjects->contains('subject_code', $subject->subject_code)
            ? '1'
            : '0' }}">

                <div
                    class="absolute -top-10 -right-10 w-32 h-32 bg-cyan-100 rounded-full group-hover:scale-125 transition-transform duration-700">
                </div>

                <div class="p-8 relative z-10">
                    @php
                    $documentCount = $subject->documents_count ?? 0;
                    $teacherCount = $subject->lecturers->count();
                    $active = $subject->status === 'active';
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

                    <div
                        class="w-16 h-16 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center mb-6 border border-cyan-100 group-hover:bg-cyan-500 group-hover:text-white transition-all">

                        <i class="{{ $subject->icon ?? 'fa-solid fa-book' }} {{ $cls['text'] }} text-2xl"></i>

                    </div>

                    <h3 class="subject-name text-xl font-black text-slate-900 group-hover:text-cyan-600 transition">
                        {{ $subject->subject_name }}
                    </h3>

                    <p class="text-slate-500 text-sm mt-3 leading-relaxed min-h-[60px]">
                        {{ $subject->description ?? 'Chưa có mô tả.' }}
                    </p>

                    <div class="mt-6 flex items-center justify-between">

                        <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black">

                            {{ $subject->documents_count }} tài liệu

                        </span>

                        <span
                            class="w-11 h-11 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200 group-hover:bg-cyan-600 transition">

                            <i class="fa-solid fa-arrow-right"></i>

                        </span>

                    </div>

                </div>

            </a>

            @empty



            @endforelse
            <!-- THÔNG BÁO KHÔNG TÌM THẤY -->
            <div id="noSubjectResult" class="hidden col-span-full py-16 text-center">

                <div class="w-20 h-20 mx-auto rounded-full bg-cyan-50 flex items-center justify-center">
                    <i class="fa-solid fa-magnifying-glass text-3xl text-cyan-500"></i>
                </div>

                <h3 class="mt-5 text-xl font-black text-slate-800">
                    Không tìm thấy môn học
                </h3>

                <p class="mt-2 text-sm text-slate-500">
                    Không có môn học nào phù hợp với từ khóa tìm kiếm.
                </p>

            </div>

        </div>


        <!-- PAGINATION -->
        <div class="mt-10 flex items-center justify-center gap-2">
            <button class="w-11 h-11 rounded-2xl bg-white border border-cyan-100 text-slate-400 hover:bg-cyan-50">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <button class="w-11 h-11 rounded-2xl bg-cyan-500 text-white font-bold shadow-lg shadow-cyan-200">
                1
            </button>

            <button
                class="w-11 h-11 rounded-2xl bg-white border border-cyan-100 text-slate-600 font-bold hover:bg-cyan-50">
                2
            </button>

            <button
                class="w-11 h-11 rounded-2xl bg-white border border-cyan-100 text-slate-600 font-bold hover:bg-cyan-50">
                3
            </button>

            <button class="w-11 h-11 rounded-2xl bg-white border border-cyan-100 text-slate-600 hover:bg-cyan-50">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>

    </section>
</main>

<!-- LOGIN REQUIRED MODAL -->
<div id="loginRequiredModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/40 backdrop-blur-sm px-4">

    <div class="w-full max-w-md bg-white rounded-3xl p-8 text-center shadow-2xl border border-cyan-100">

        <div
            class="w-20 h-20 mx-auto rounded-full bg-cyan-50 text-cyan-600 flex items-center justify-center text-3xl mb-5">
            <i class="fa-solid fa-lock"></i>
        </div>

        <h3 class="text-2xl font-black text-slate-900 mb-3">
            Yêu cầu đăng nhập
        </h3>

        <p class="text-slate-500 leading-relaxed mb-6">
            Bạn cần đăng nhập để tải tài liệu học tập.
        </p>

        <div class="flex items-center justify-center gap-3">
            <button onclick="closeLoginRequiredModal()"
                class="px-5 py-3 rounded-2xl border border-cyan-100 text-slate-600 font-bold hover:bg-cyan-50 transition">
                Đóng
            </button>

            <a href="{{ route('login') }}"
                class="px-6 py-3 rounded-2xl bg-cyan-500 text-white font-bold hover:bg-cyan-600 transition shadow-lg shadow-cyan-200">
                Đăng nhập ngay
            </a>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let currentFilter = 'all';

function searchSubjects() {

    const keyword = document
        .getElementById('subjectSearch')
        .value
        .trim()
        .toLowerCase();

    const cards = document.querySelectorAll('.subject-card');
    const empty = document.getElementById('noSubjectResult');

    let hasVisible = false;

    cards.forEach(card => {

        const name = card.querySelector('.subject-name')
            .innerText
            .toLowerCase();

        const assigned = card.dataset.assigned === '1';

        const matchKeyword = name.includes(keyword);

        const matchFilter =
            currentFilter === 'all' ?
            true :
            assigned;

        if (matchKeyword && matchFilter) {

            card.style.display = '';
            hasVisible = true;

        } else {

            card.style.display = 'none';

        }

    });

    if (empty) {
        empty.style.display = hasVisible ? 'none' : 'block';
    }
}

function filterSubjects(type) {

    currentFilter = type;

    const btnAssigned = document.getElementById('btnAssigned');
    const btnAll = document.getElementById('btnAll');

    if (btnAssigned && btnAll) {

        btnAssigned.className =
            type === 'assigned' ?
            'px-6 py-3 rounded-xl bg-cyan-500 text-white text-sm font-black transition' :
            'px-6 py-3 rounded-xl text-cyan-700 text-sm font-black transition';

        btnAll.className =
            type === 'all' ?
            'px-6 py-3 rounded-xl bg-cyan-500 text-white text-sm font-black transition' :
            'px-6 py-3 rounded-xl text-cyan-700 text-sm font-black transition';

    }

    searchSubjects();

}

document.addEventListener('DOMContentLoaded', function() {
    searchSubjects();
});
</script>
@endpush