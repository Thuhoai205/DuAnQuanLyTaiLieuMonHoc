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
<main class="min-h-screen bg-[#EAFBFF]" style="font-family: 'Roboto', sans-serif;">
    <!-- HERO BANNER: Khối banner ảnh nền chứa chữ "Giới thiệu" giống hệt image_5ea826.jpg -->
    <div class="relative w-full h-[260px] md:h-[320px] overflow-hidden">
        <!-- Ảnh nền (Đã được thay bằng hình ảnh thư viện học thuật/công nghệ số hiện đại) -->
        <img src="https://i.pinimg.com/1200x/96/d3/c9/96d3c90189af11a192ba76519fb7cf2a.jpg"
            alt="Educational Resources Banner" class="w-full h-full object-cover opacity-60">

        <!-- Lớp phủ tối (Overlay) để làm nổi bật chữ trắng phía trên giống hình mẫu -->
        <div class="absolute inset-0 bg-black/30"></div>

        <!-- Chữ "Giới thiệu" căn giữa tuyệt đối -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">

            <h1 class="banner-title italic text-3xl md:text-4xl font-bold text-white tracking-wide drop-shadow-md">
                Danh mục Môn học
            </h1>

            <p class="banner-subtitle mt-3 text-cyan-100 text-base md:text-lg max-w-2xl leading-relaxed">
                Khám phá danh mục các môn học và tài liệu liên quan
            </p>

        </div>
    </div>
    <div class="bg-cyan-50 py-3 border-b border-cyan-100">
        <div class="max-w-7xl mx-auto px-4 md:px-6 flex items-center text-sm">
            <a href="/" class="text-slate-600 hover:text-cyan-600 transition">
                Trang chủ
            </a>

            <span class="mx-2 text-slate-400">
                /
            </span>

            <span class="font-medium text-cyan-600">
                Danh mục Môn học
            </span>
        </div>
    </div>
    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-16">

        <!-- ================= HEADER ================= -->
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-12">

            <!-- Left -->
            <div>

                <div class="flex items-center gap-4">

                    <div class="w-14 h-14 rounded-2xl bg-cyan-50 border border-cyan-100
                       flex items-center justify-center">

                        <i class="fa-solid fa-layer-group text-cyan-600 text-2xl"></i>

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
                <div class="relative w-full sm:w-80">

                    <i class="fa-solid fa-magnifying-glass
                       absolute left-5 top-1/2 -translate-y-1/2
                       text-cyan-500">
                    </i>

                    <input type="text" id="subjectSearch" onkeyup="searchSubjects()" placeholder="Tìm kiếm môn học..."
                        class="w-full h-14
                       rounded-2xl
                       border border-slate-200
                       bg-white
                       pl-12 pr-5
                       text-sm
                       placeholder:text-slate-400
                       shadow-sm
                       transition
                       focus:outline-none
                       focus:border-cyan-500
                       focus:ring-4
                       focus:ring-cyan-100">

                </div>

                @auth
                @if(auth()->user()->role->role_name === 'lecturer')

                <!-- Filter -->
                <div class="flex h-14 items-center rounded-2xl
                   border border-slate-200 bg-white p-1 shadow-sm">

                    <button id="btnAll" onclick="filterSubjects('all')" class="rounded-xl px-5 py-2 text-sm font-semibold
                       bg-cyan-500 text-white transition">

                        Tất cả
                        <span class="ml-1 opacity-80">
                            ({{ $subjects->count() }})
                        </span>

                    </button>

                    <button id="btnAssigned" onclick="filterSubjects('assigned')" class="rounded-xl px-5 py-2 text-sm font-semibold
                       text-slate-600 hover:bg-slate-100 transition">

                        Phụ trách
                        <span class="ml-1 text-cyan-600">
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
                class="subject-card group overflow-hidden rounded-[2rem] bg-white border border-slate-200/80 shadow-md hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between"
                data-assigned="{{ Auth::check() && Auth::user()->role->role_name === 'lecturer' && Auth::user()->subjects->contains('subject_code', $subject->subject_code) ? '1' : '0' }}">

                <div>
                    <!-- IMAGE SECTION -->
                    <div class="relative overflow-hidden h-48 w-full bg-slate-100">
                        <img src="{{ $hasThumbnail ? asset('img/subjects/'.$subject->thumbnail) : asset('images/default-subject.jpg') }}"
                            class="w-full h-full object-cover transition duration-700 ease-out group-hover:scale-105"
                            alt="{{ $subject->subject_name }}">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent"></div>

                        <!-- Tag Khoa (Faculty Badge) -->
                        @if($subject->faculty)
                        <div class="absolute top-4 left-4 z-10">
                            <!-- Đặt font-bold giúp tag khoa trông sắc nét và tinh gọn -->
                            <span
                                class="px-3 py-1.5 rounded-xl bg-white/80 backdrop-blur-md border border-white/40 text-[10px] font-bold uppercase tracking-wider text-slate-800 shadow-sm flex items-center gap-1">
                                <i class="fa-solid fa-graduation-cap text-cyan-600"></i>
                                {{ $subject->faculty->faculty_name }}
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- CONTENT SECTION -->
                    <div class="p-6 pb-0">
                        <!-- Mã môn học hạ về text-[11px] font-bold -->
                        <span class="text-[11px] font-bold text-cyan-600/80 uppercase tracking-wider block mb-1.5">
                            {{ $subject->subject_code }}
                        </span>

                        <!-- Tiêu đề môn học hạ từ text-xl xuống text-base font-bold để text Roboto hiển thị cân đối nhất -->
                        <h3
                            class="subject-name font-bold text-base text-slate-800 leading-snug group-hover:text-cyan-600 transition-colors duration-300 line-clamp-2 min-h-[48px]">
                            {{ $subject->subject_name }}
                        </h3>

                        <!-- Mô tả môn học chuyển về text-xs font-medium -->
                        <p class="text-slate-500 text-xs font-medium mt-2 leading-relaxed line-clamp-2">
                            {{ $subject->description ?? 'Chưa có mô tả môn học.' }}
                        </p>
                    </div>
                </div>

                <!-- FOOTER SECTION -->
                <div class="p-6 pt-0">
                    <div class="my-4 border-t border-slate-100"></div>

                    <div class="flex items-center justify-between">
                        <!-- Thống kê tài liệu -->
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                                <i class="fa-solid fa-folder-open text-base"></i>
                            </div>
                            <div>
                                <!-- Số lượng tài liệu đưa về text-sm font-black -->
                                <h4 class="text-sm font-black text-slate-800 leading-none mb-0.5">
                                    {{ number_format($documentCount) }}
                                </h4>
                                <p class="text-[10px] text-slate-400 font-bold">Tài liệu sẵn có</p>
                            </div>
                        </div>

                        <!-- Mũi tên hành động -->
                        <div
                            class="w-10 h-10 rounded-xl bg-slate-50 text-slate-400 flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white group-hover:translate-x-1 shadow-sm group-hover:shadow-lg group-hover:shadow-cyan-200 transition-all duration-300">
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </div>
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
                <h3 class="mt-5 text-lg font-bold text-slate-800">
                    Không tìm thấy môn học
                </h3>
                <p class="mt-2 text-xs text-slate-500 font-medium">
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
                class="w-11 h-11 rounded-2xl bg-white border border-cyan-100 text-slate-300 flex items-center justify-center cursor-not-allowed text-xs">
                <i class="fa-solid fa-chevron-left"></i>
            </span>
            @else
            <a href="{{ $subjects->previousPageUrl() }}"
                class="w-11 h-11 rounded-2xl bg-white border border-cyan-100 text-slate-600 hover:bg-cyan-50 transition flex items-center justify-center text-xs">
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
                class="w-11 h-11 rounded-2xl bg-white border border-cyan-100 text-slate-600 font-bold hover:bg-cyan-50 transition flex items-center justify-center text-xs">
                {{ $page }}
            </a>
            @endif
            @endforeach

            {{-- Next --}}
            @if ($subjects->hasMorePages())
            <a href="{{ $subjects->nextPageUrl() }}"
                class="w-11 h-11 rounded-2xl bg-white border border-cyan-100 text-slate-600 hover:bg-cyan-50 transition flex items-center justify-center text-xs">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
            @else
            <span
                class="w-11 h-11 rounded-2xl bg-white border border-cyan-100 text-slate-300 flex items-center justify-center cursor-not-allowed text-xs">
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
            class="w-20 h-20 mx-auto rounded-full bg-cyan-50 text-cyan-600 flex items-center justify-center text-3xl mb-5">
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
                class="px-5 py-2.5 rounded-xl border border-cyan-100 text-slate-600 font-bold hover:bg-cyan-50 transition text-xs">
                Đóng
            </button>

            <a href="{{ route('login') }}"
                class="px-5 py-2.5 rounded-xl bg-cyan-500 text-white font-bold hover:bg-cyan-600 transition shadow-lg shadow-cyan-200 text-xs">
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
            'px-5 py-2.5 rounded-xl bg-cyan-500 text-white text-xs font-bold transition' :
            'px-5 py-2.5 rounded-xl text-cyan-700 text-xs font-bold transition';

        btnAll.className =
            type === 'all' ?
            'px-5 py-2.5 rounded-xl bg-cyan-500 text-white text-xs font-bold transition' :
            'px-5 py-2.5 rounded-xl text-cyan-700 text-xs font-bold transition';

    }

    searchSubjects();

}

document.addEventListener('DOMContentLoaded', function() {
    searchSubjects();
});
</script>
@endpush