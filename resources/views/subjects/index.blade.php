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
                @if(auth()->user()->role_id == 2)
                <div class="inline-flex p-1 bg-cyan-50 border border-cyan-100 rounded-2xl text-sm font-bold">
                    <button onclick="filterSubjects('assigned', this)"
                        class="tab-btn px-6 py-3 rounded-xl bg-cyan-500 text-white shadow-sm transition-all duration-300">
                        Phụ trách (1)
                    </button>

                    <button onclick="filterSubjects('all', this)"
                        class="tab-btn px-6 py-3 rounded-xl text-cyan-700 hover:bg-white transition-all duration-300">
                        Tất cả (2)
                    </button>
                </div>
                @endif
                @endauth
            </div>
        </div>

        <!-- GRID -->
        <div id="subjectGrid" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-8">

            <!-- CARD 1 -->
            <div
                class="subject-card assigned group relative bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] hover:shadow-[0_20px_60px_rgba(8,145,178,0.16)] hover:-translate-y-2 transition-all duration-500 overflow-hidden">

                <div
                    class="absolute -top-10 -right-10 w-32 h-32 bg-cyan-100 rounded-full group-hover:scale-125 transition-transform duration-700">
                </div>

                <div class="p-8 relative z-10">
                    <div
                        class="w-16 h-16 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center mb-6 border border-cyan-100 group-hover:bg-cyan-500 group-hover:text-white transition-all">
                        <i class="fa-solid fa-laptop-code text-2xl"></i>
                    </div>

                    <h3 class="text-xl font-black text-slate-900 group-hover:text-cyan-600 transition">
                        Lập trình Web
                    </h3>

                    <p class="text-slate-500 text-sm mt-3 leading-relaxed">
                        HTML, CSS, JavaScript, Laravel và các công nghệ phát triển website.
                    </p>

                    <div class="mt-6 flex items-center justify-between">
                        <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black">
                            120 tài liệu
                        </span>

                        <a href="{{ route('subjects.show', ['id' => 1]) }}"
                            class="w-11 h-11 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200 hover:bg-cyan-600 transition">
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- CARD 2 -->
            <div
                class="subject-card all group relative bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] hover:shadow-[0_20px_60px_rgba(8,145,178,0.16)] hover:-translate-y-2 transition-all duration-500 overflow-hidden">

                <div
                    class="absolute -top-10 -right-10 w-32 h-32 bg-cyan-100 rounded-full group-hover:scale-125 transition-transform duration-700">
                </div>

                <div class="p-8 relative z-10">
                    <div
                        class="w-16 h-16 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center mb-6 border border-cyan-100 group-hover:bg-cyan-500 group-hover:text-white transition-all">
                        <i class="fa-solid fa-database text-2xl"></i>
                    </div>

                    <h3 class="text-xl font-black text-slate-900 group-hover:text-cyan-600 transition">
                        Cơ sở dữ liệu
                    </h3>

                    <p class="text-slate-500 text-sm mt-3 leading-relaxed">
                        SQL, thiết kế cơ sở dữ liệu, truy vấn và quản trị dữ liệu.
                    </p>

                    <div class="mt-6 flex items-center justify-between">
                        <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black">
                            85 tài liệu
                        </span>

                        <a href="#"
                            class="w-11 h-11 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200 hover:bg-cyan-600 transition">
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- DOCUMENT LIST -->
        <div
            class="mt-14 bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] overflow-hidden">

            <div class="px-7 py-5 border-b border-cyan-100">
                <h2 class="text-2xl font-black text-cyan-950">
                    Tài liệu môn học
                </h2>
            </div>

            <div class="divide-y divide-cyan-100">

                <!-- ITEM -->
                <div class="p-6 flex flex-col lg:flex-row lg:items-center gap-5 hover:bg-cyan-50/60 transition">

                    <div
                        class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-file-word text-2xl"></i>
                    </div>

                    <a href="{{ route('documents.show', 1) }}" class="flex-1">
                        <h3 class="text-lg font-black text-slate-900 hover:text-cyan-700 transition">
                            Đề cương ôn tập giữa kỳ CSDL 2023-2024
                        </h3>

                        <div class="flex flex-wrap gap-3 mt-2 text-sm font-semibold text-slate-500">
                            <span><i class="fa-solid fa-book mr-1 text-cyan-600"></i> Cơ sở dữ liệu</span>
                            <span>•</span>
                            <span><i class="fa-solid fa-user-tie mr-1 text-cyan-600"></i> TS. Lê Thị C</span>
                            <span>•</span>
                            <span><i class="fa-solid fa-calendar mr-1 text-cyan-600"></i> Hôm qua</span>
                        </div>
                    </a>

                    <div class="shrink-0 flex items-center gap-2">
                        @if(Auth::check())
                        <button
                            class="px-5 py-2.5 bg-cyan-500 text-white font-bold rounded-xl hover:bg-cyan-600 transition-all flex items-center gap-2 text-sm shadow-lg shadow-cyan-200">
                            <i class="fa-solid fa-cloud-arrow-down"></i>
                            Tải về
                        </button>
                        @else
                        <button onclick="showLoginRequiredModal()"
                            class="px-5 py-2.5 border-2 border-cyan-100 text-cyan-700 font-bold rounded-xl hover:bg-cyan-50 transition-all flex items-center gap-2 text-sm">
                            <i class="fa-solid fa-lock"></i>
                            Đăng nhập để tải
                        </button>
                        @endif
                    </div>
                </div>

                <!-- ITEM CỦA GIẢNG VIÊN ĐANG ĐĂNG NHẬP -->
                <div class="p-6 flex flex-col lg:flex-row lg:items-center gap-5 hover:bg-cyan-50/60 transition">

                    <div class="w-16 h-16 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-file-pdf text-2xl"></i>
                    </div>

                    <div class="flex-1">
                        <h3 class="text-lg font-black text-slate-900 hover:text-cyan-700 transition">
                            Slide Bài 1: Tổng quan Laravel Framework
                        </h3>

                        <div class="flex flex-wrap gap-3 mt-2 text-sm font-semibold text-slate-500">
                            <span><i class="fa-solid fa-book mr-1 text-cyan-600"></i> Lập trình Web</span>
                            <span>•</span>
                            <span><i class="fa-solid fa-user-tie mr-1 text-cyan-600"></i> ThS. Trần Văn B</span>
                            <span>•</span>
                            <span><i class="fa-solid fa-calendar mr-1 text-cyan-600"></i> Hôm nay</span>
                        </div>
                    </div>


                    <div class="shrink-0 flex items-center gap-2">
                        @if(Auth::check())
                        <button
                            class="px-5 py-2.5 bg-cyan-500 text-white font-bold rounded-xl hover:bg-cyan-600 transition-all flex items-center gap-2 text-sm shadow-lg shadow-cyan-200">
                            <i class="fa-solid fa-cloud-arrow-down"></i>
                            Tải về
                        </button>
                        @else
                        <button onclick="showLoginRequiredModal()"
                            class="px-5 py-2.5 border-2 border-cyan-100 text-cyan-700 font-bold rounded-xl hover:bg-cyan-50 transition-all flex items-center gap-2 text-sm">
                            <i class="fa-solid fa-lock"></i>
                            Đăng nhập để tải
                        </button>
                        @endif

                        @if(Auth::check() && Auth::user()->role_id == 2)

                        <a href="{{ route('documents.edit', 1) }}" class="w-10 h-10 flex items-center justify-center
    text-amber-500 hover:bg-amber-500 hover:text-white
    rounded-xl transition-all duration-300
    shadow-sm bg-white border border-amber-100" title="Sửa">

                            <i class="fa-solid fa-pen-to-square text-sm"></i>
                        </a>
                        <button
                            class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition flex items-center justify-center border border-red-100">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                        @endif
                    </div>
                </div>

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

<script>
function showLoginRequiredModal() {
    const modal = document.getElementById('loginRequiredModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLoginRequiredModal() {
    const modal = document.getElementById('loginRequiredModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function searchSubjects() {
    const input = document.getElementById('subjectSearch');
    const keyword = input.value.toLowerCase();
    const cards = document.querySelectorAll('.subject-card');

    cards.forEach(card => {
        card.style.display = card.innerText.toLowerCase().includes(keyword) ? 'flex' : 'none';
    });
}

function filterSubjects(type, btn) {
    const cards = document.querySelectorAll('.subject-card');
    const buttons = document.querySelectorAll('.tab-btn');

    buttons.forEach(b => {
        b.classList.remove('bg-cyan-500', 'text-white');
        b.classList.add('text-cyan-700');
    });

    btn.classList.add('bg-cyan-500', 'text-white');
    btn.classList.remove('text-cyan-700');

    cards.forEach(card => {
        if (type === 'all') {
            card.style.display = 'flex';
        } else {
            card.style.display = card.classList.contains('assigned') ? 'flex' : 'none';
        }
    });
}
</script>