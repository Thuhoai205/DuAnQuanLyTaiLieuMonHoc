@extends('layouts.app')

@section('title', 'Danh mục Môn học')

@section('content')
<style>
.banner-title {

    animation: titleZoom .8s ease;

}

.banner-subtitle {

    animation: titleZoom 1.2s ease;

}

@keyframes titleZoom {

    from {

        opacity: 0;

        transform:
            scale(.85) translateY(20px);

    }

    to {

        opacity: 1;

        transform:
            scale(1) translateY(0);

    }

}
</style>
<!-- Bọc toàn bộ main bằng font-roboto (Đảm bảo font Roboto đã được nhúng trong project của bạn) -->
<main class="min-h-screen " style="font-family: 'Roboto', sans-serif;">
    <!-- HERO BANNER: Khối banner ảnh nền chứa chữ "Giới thiệu" giống hệt image_5ea826.jpg -->
    <div class="relative w-full h-[260px] md:h-[320px] overflow-hidden">
        <!-- Ảnh nền (Đã được thay bằng hình ảnh thư viện học thuật/công nghệ số hiện đại) -->
        <img src="{{ asset('img/02.jpg') }}" alt="Educational Resources Banner"
            class="w-full h-full object-cover opacity-60">

        <!-- Lớp phủ tối (Overlay) để làm nổi bật chữ trắng phía trên giống hình mẫu -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Chữ "Giới thiệu" căn giữa tuyệt đối -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">

            <h1 class="banner-title italic text-5xl font-bold text-white drop-shadow-2xl">
                Danh mục Môn học
            </h1>

            <p class="banner-subtitle mt-3 text-white/90 text-lg md:text-xl font-medium max-w-2xl leading-relaxed">
                Khám phá danh mục các môn học và tài liệu liên quan
            </p>

        </div>
    </div>
    <div class="bg-slate-100 py-3 border-b border-slate-200">

        <div class="max-w-7xl mx-auto px-4 md:px-6 flex items-center text-sm">

            <a href="/" class="text-slate-500 hover:text-slate-900 transition-colors duration-300">

                Trang chủ

            </a>

            <span class="mx-3 text-slate-300">
                /
            </span>

            <span class="font-semibold text-slate-700">

                Danh mục Môn học

            </span>

        </div>

    </div>
    <section class="max-w-7xl mx-auto px-6 pt-10 pb-10">

        <!-- ================= HEADER ================= -->
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-12">

            <!-- Left -->
            <div>

                <div class="flex items-center gap-4">

                    <div class="w-14 h-14 rounded-2xl
bg-slate-100
border border-slate-200
flex items-center justify-center
transition-all duration-300
hover:bg-amber-50
hover:border-amber-300">

                        <i class="fa-solid fa-layer-group text-amber-500 text-2xl"></i>

                    </div>

                    <div>

                        <h1 class="text-3xl font-bold text-slate-900">
                            Danh mục Môn học
                        </h1>

                        <p class="mt-2 text-sm text-slate-500 leading-7 max-w-2xl">
                            Quản lý và truy cập kho học liệu theo từng môn học, chuyên ngành và lĩnh vực đào tạo.
                        </p>

                    </div>

                </div>

            </div>

            <!-- Right -->
            <div class="flex flex-col sm:flex-row gap-4">

                <!-- Search -->

                <div class="relative">

                    <div class="absolute inset-y-0 left-5 flex items-center">

                        <i class="fa-solid fa-magnifying-glass text-amber-500 text-lg"></i>

                    </div>

                    <input type="text" id="subjectSearch" onkeyup="searchSubjects()" placeholder="Tìm kiếm môn học..."
                        class="w-full
        rounded-2xl
        border
        border-slate-200
        py-4
        pl-14
        pr-5
        text-slate-700
        placeholder:text-slate-400
        focus:border-amber-400
        focus:ring-4
        focus:ring-amber-100">

                </div>


                @auth
                @if(auth()->user()->role->role_name === 'lecturer')

                <!-- Filter -->
                <div class="flex h-14 items-center rounded-2xl
    border border-slate-200
    bg-white
    p-1
    shadow-sm">

                    <!-- Tất cả -->
                    <button id="btnAll" onclick="filterSubjects('all')" class="rounded-xl px-5 py-2
        text-sm font-semibold
        bg-slate-900
        text-white
        transition-all duration-300
        hover:bg-amber-500">

                        Tất cả

                        <span class="ml-1 opacity-80">
                            ({{ $subjects->count() }})
                        </span>

                    </button>

                    <!-- Phụ trách -->
                    <button id="btnAssigned" onclick="filterSubjects('assigned')" class="rounded-xl px-5 py-2
        text-sm font-semibold
        text-slate-600
        hover:bg-slate-100
        hover:text-amber-600
        transition-all duration-300">

                        Phụ trách

                        <span class="ml-1 text-slate-500">
                            ({{ auth()->user()->subjects->count() }})
                        </span>

                    </button>

                </div>

                @endif
                @endauth

            </div>

        </div>
        <!-- GRID CHỨA CARD -->
        <div id="subjectGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($subjects as $subject)
            @php
            $documentCount = $subject->documents_count ?? 0;
            $teacherCount = $subject->lecturers->count();
            $active = $subject->status === 'active';
            $hasThumbnail = !empty($subject->thumbnail);
            @endphp

            <a href="{{ route('subjects.show', $subject->subject_code) }}"
                class="subject-card group overflow-hidden rounded-[2rem] bg-white border border-slate-200 shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between"
                data-assigned="{{ Auth::check() && Auth::user()->role->role_name === 'lecturer' && Auth::user()->subjects->contains('subject_code', $subject->subject_code) ? '1' : '0' }}">

                <div>

                    <!-- IMAGE -->
                    <div class="relative overflow-hidden h-48 w-full bg-slate-100">

                        <img src="{{ $subject->thumbnail_url }}" alt="{{ $subject->subject_name }}"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent"></div>

                        <!-- Badge khoa -->
                        @if($subject->faculty)

                        <div class="absolute top-4 left-4 z-10">

                            <span class="px-3 py-1.5 rounded-xl
                        bg-white/90
                        backdrop-blur-md
                        border border-slate-200
                        text-[10px]
                        font-bold
                        uppercase
                        tracking-wider
                        text-slate-700
                        shadow-sm
                        flex items-center gap-1">

                                <i class="fa-solid fa-graduation-cap text-amber-500"></i>

                                {{ $subject->faculty->faculty_name }}

                            </span>

                        </div>

                        @endif

                    </div>

                    <!-- CONTENT -->
                    <div class="p-6 pb-0">

                        <!-- CODE -->
                        <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block mb-1.5">

                            {{ $subject->subject_code }}

                        </span>

                        <!-- TITLE -->
                        <h3
                            class="subject-name font-bold text-base text-slate-800 leading-snug group-hover:text-amber-600 transition-colors duration-300 line-clamp-2 min-h-[48px]">

                            {{ $subject->subject_name }}

                        </h3>

                        <!-- DESCRIPTION -->
                        <p class="text-slate-500 text-xs font-medium mt-2 leading-relaxed line-clamp-2">

                            {{ $subject->description ?? 'Chưa có mô tả môn học.' }}

                        </p>

                    </div>

                </div>

                <!-- FOOTER -->
                <div class="p-6 pt-0">

                    <div class="my-4 border-t border-slate-100"></div>

                    <div class="flex items-center justify-between">

                        <!-- Statistics -->
                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl
                        bg-slate-100
                        border border-slate-200
                        text-slate-600
                        flex items-center justify-center">

                                <i class="fa-solid fa-folder-open text-base"></i>

                            </div>

                            <div>

                                <h4 class="text-sm font-black text-slate-900 leading-none mb-0.5">

                                    {{ number_format($documentCount) }}

                                </h4>

                                <p class="text-[10px] text-slate-500 font-semibold">

                                    Tài liệu sẵn có

                                </p>

                            </div>

                        </div>

                        <!-- Arrow -->
                        <div class="w-10 h-10 rounded-xl
                    bg-slate-100
                    border border-slate-200
                    text-slate-600
                    flex items-center justify-center
                    transition-all duration-300
                    group-hover:bg-slate-900
                    group-hover:text-white
                    group-hover:translate-x-1">

                            <i class="fa-solid fa-chevron-right text-xs"></i>

                        </div>

                    </div>

                </div>

            </a>

            @empty

            <div class="col-span-full py-16 text-center">

                <div class="w-20 h-20 mx-auto rounded-full bg-slate-100 flex items-center justify-center">

                    <i class="fa-solid fa-book-open text-3xl text-amber-500"></i>

                </div>

                <h3 class="mt-5 text-lg font-bold text-slate-800">

                    Chưa có môn học

                </h3>

                <p class="mt-2 text-sm text-slate-500">

                    Khoa này hiện chưa có môn học nào.

                </p>

            </div>

            @endforelse

            <!-- Không tìm thấy -->
            <div id="noSubjectResult" class="hidden col-span-full py-16 text-center">

                <div class="w-20 h-20 mx-auto rounded-full bg-slate-100 flex items-center justify-center">

                    <i class="fa-solid fa-magnifying-glass text-3xl text-amber-500"></i>

                </div>

                <h3 class="mt-5 text-lg font-bold text-slate-800">

                    Không tìm thấy môn học

                </h3>

                <p class="mt-2 text-sm text-slate-500">

                    Không có môn học nào phù hợp với từ khóa tìm kiếm.

                </p>

            </div>

        </div>

        <!-- PAGINATION -->
        @if ($subjects->hasPages())
        <div class="mt-10 flex items-center justify-center gap-2">

            {{-- Previous --}}
            @if ($subjects->onFirstPage())
            <span
                class="w-11 h-11 rounded-2xl bg-white border border-slate-100 text-slate-300 flex items-center justify-center cursor-not-allowed text-xs">
                <i class="fa-solid fa-chevron-left"></i>
            </span>
            @else
            <a href="{{ $subjects->previousPageUrl() }}"
                class="w-11 h-11 rounded-2xl bg-white border border-slate-100 text-slate-600 hover:bg-cyan-50 transition flex items-center justify-center text-xs">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            @endif

            {{-- Page Numbers --}}
            @foreach ($subjects->getUrlRange(1, $subjects->lastPage()) as $page => $url)
            @if ($page == $subjects->currentPage())
            <span
                class="w-11 h-11 rounded-2xl bg-cyan-500 text-white font-bold shadow-lg shadow-cyan-200 flex items-center justify-center text-xs">
                {{ $page }}
            </span>
            @else
            <a href="{{ $url }}"
                class="w-11 h-11 rounded-2xl bg-white border border-slate-100 text-slate-600 font-bold hover:bg-cyan-50 transition flex items-center justify-center text-xs">
                {{ $page }}
            </a>
            @endif
            @endforeach

            {{-- Next --}}
            @if ($subjects->hasMorePages())
            <a href="{{ $subjects->nextPageUrl() }}"
                class="w-11 h-11 rounded-2xl bg-white border border-slate-100 text-slate-600 hover:bg-cyan-50 transition flex items-center justify-center text-xs">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
            @else
            <span
                class="w-11 h-11 rounded-2xl bg-white border border-slate-100 text-slate-300 flex items-center justify-center cursor-not-allowed text-xs">
                <i class="fa-solid fa-chevron-right"></i>
            </span>
            @endif

        </div>
        @endif

    </section>
</main>

<!-- LOGIN REQUIRED MODAL -->
<!-- Bọc toàn bộ modal bằng font-roboto để đồng bộ trải nghiệm -->
<div id="loginRequiredModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/40 backdrop-blur-sm px-4"
    style="font-family: 'Roboto', sans-serif;">

    <div class="w-full max-w-md bg-white rounded-3xl p-8 text-center shadow-2xl border border-cyan-100">

        <div
            class="w-20 h-20 mx-auto rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-3xl mb-5">
            <i class="fa-solid fa-lock"></i>
        </div>

        <!-- Hạ tiêu đề modal từ text-2xl xuống text-lg font-bold để tạo cảm giác tinh tế, thanh thoát hơn -->
        <h3 class="text-lg font-bold text-slate-900 mb-3">
            Yêu cầu đăng nhập
        </h3>

        <!-- Hạ nội dung thông báo xuống text-xs font-medium giúp giao diện trông mềm mại -->
        <p class="text-slate-500 font-medium text-xs leading-relaxed mb-6">
            Bạn cần đăng nhập để tải tài liệu học tập.
        </p>

        <!-- Đồng bộ text của cụm button hành động về text-xs font-bold -->
        <div class="flex items-center justify-center gap-3">
            <button onclick="closeLoginRequiredModal()"
                class="px-5 py-2.5 rounded-xl border border-amber-100 text-slate-600 font-bold hover:bg-amber-50 transition text-xs">
                Đóng
            </button>

            <a href="{{ route('login') }}"
                class="px-5 py-2.5 rounded-xl bg-amber-500 text-white font-bold hover:bg-amber-600 transition shadow-lg shadow-amber-200 text-xs">
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

    // CẬP NHẬT: Thay đổi class gán động của nút khi active/inactive về text-xs font-bold tương ứng với cụm giao diện phía trên
    if (btnAssigned && btnAll) {

        btnAssigned.className =
            type === 'assigned' ?
            'rounded-xl px-5 py-2 text-sm font-semibold bg-slate-900 text-white transition-all duration-300 hover:bg-amber-500' :
            'rounded-xl px-5 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 hover:text-amber-600 transition-all duration-300';

        btnAll.className =
            type === 'all' ?
            'rounded-xl px-5 py-2 text-sm font-semibold bg-slate-900 text-white transition-all duration-300 hover:bg-amber-500' :
            'rounded-xl px-5 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 hover:text-amber-600 transition-all duration-300';

    }

    searchSubjects();

}

document.addEventListener('DOMContentLoaded', function() {
    searchSubjects();
});
</script>
@endpush