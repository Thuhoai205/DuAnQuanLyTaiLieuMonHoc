@extends('layouts.app')

@section('title', 'Danh mục Môn học')

@section('content')

<!-- BACKGROUND -->
<div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">

    <div
        class="absolute top-[-5%] left-[-10%] w-[600px] h-[600px] rounded-full bg-blue-500/5 blur-[130px] animate-[pulse_7s_infinite]">
    </div>

    <div
        class="absolute bottom-[15%] right-[-5%] w-[500px] h-[500px] rounded-full bg-cyan-500/5 blur-[120px] animate-[pulse_9s_infinite]">
    </div>

</div>

<!-- MAIN -->
<main class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-14">

    <!-- BACK BUTTON -->
    <div class="mb-10">

        <a href="javascript:history.back()"
            class="group inline-flex items-center gap-2.5 px-6 py-3 bg-white border border-slate-100 text-slate-600 hover:text-orange-500 font-bold text-xs uppercase tracking-wider rounded-full shadow-[0_4px_20px_-4px_rgba(0,0,0,0.04)] hover:shadow-orange-500/20 hover:-translate-x-1 hover:border-orange-200 transition-all duration-300 active:scale-95">

            <i
                class="fas fa-arrow-left text-slate-400 group-hover:text-orange-500 transition-all duration-300 group-hover:-translate-x-0.5">
            </i>

            <span class="group-hover:text-orange-500 transition-colors duration-300">
                Quay lại
            </span>

        </a>

    </div>

    <!-- HEADER -->
    <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-6 mb-12 pb-8 border-b border-slate-100">

        <!-- LEFT -->
        <div>

            <div class="flex items-center mb-3">

                <div
                    class="w-11 h-11 bg-blue-600 rounded-full flex items-center justify-center text-white mr-4 shadow-lg shadow-blue-200">

                    <i class="fas fa-layer-group"></i>

                </div>

                <h1 class="text-3xl font-black text-slate-800 tracking-tight">
                    Danh mục Môn học
                </h1>

            </div>

            <p class="text-slate-400 font-medium text-sm pl-[60px] max-w-2xl leading-relaxed">
                Quản lý và truy cập kho học liệu theo từng môn học, chuyên ngành và lĩnh vực đào tạo.
            </p>

        </div>

        <!-- RIGHT -->
        <div class="flex flex-col lg:flex-row items-stretch lg:items-center gap-4">

            <!-- SEARCH -->
            <div class="relative w-full lg:w-72">

                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>

                <input type="text" id="subjectSearch" onkeyup="searchSubjects()" placeholder="Tìm theo tên môn..."
                    class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-2xl text-sm font-semibold text-slate-700 shadow-sm focus:outline-none focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 transition-all">

            </div>

            <!-- FILTER TAB -->
            @auth
            @if(auth()->user()->role_id == 2)

            <div class="inline-flex p-1 bg-slate-100 border border-slate-200 rounded-2xl text-sm font-bold">

                <button onclick="filterSubjects('assigned', this)"
                    class="tab-btn px-6 py-3 rounded-xl bg-white text-blue-600 shadow-sm transition-all duration-300">

                    Phụ trách (1)

                </button>

                <button onclick="filterSubjects('all', this)"
                    class="tab-btn px-6 py-3 rounded-xl text-slate-500 hover:text-slate-800 transition-all duration-300">

                    Tất cả (2)

                </button>

            </div>

            @endif
            @endauth

        </div>

    </div>

    <!-- GRID -->
    <div id="subjectGrid" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-8">

        <!-- CARD -->
        <div
            class="subject-card assigned group relative bg-white rounded-[2.2rem] border border-slate-100 shadow-[0_12px_40px_-15px_rgba(0,0,0,0.03)] hover:shadow-[0_24px_60px_-15px_rgba(59,130,246,0.12)] hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between overflow-hidden">

            <!-- DECOR -->
            <div
                class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-blue-50 to-cyan-50/50 rounded-full group-hover:scale-125 transition-transform duration-700 ease-out">
            </div>

            <!-- STATUS -->
            <div class="absolute top-6 right-6 flex h-2 w-2">

                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75">
                </span>

                <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>

            </div>

            <!-- BODY -->
            <div class="p-8 relative z-10">

                <div
                    class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-[inset_0_2px_8px_rgba(59,130,246,0.06)] group-hover:bg-blue-600 group-hover:text-white group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">

                    <i class="fas fa-laptop-code text-2xl"></i>

                </div>

                <div class="space-y-3">

                    <h3
                        class="subject-title text-2xl font-black text-slate-900 group-hover:text-blue-600 transition-colors duration-300">

                        Lập trình Web

                    </h3>

                    <p class="text-slate-400 text-sm leading-relaxed font-medium">
                        Làm chủ Laravel, ReactJS, ASP.NET Core và các công nghệ phát triển Web hiện đại.
                    </p>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="px-8 py-6 border-t border-slate-100 relative z-10 flex items-center justify-between">

                <div>

                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                        Bài đã đăng
                    </span>

                    <div class="flex items-end gap-2 mt-1">

                        <span class="text-2xl font-black text-slate-800">
                            10/20
                        </span>

                        <span class="text-[10px] font-extrabold text-amber-600 bg-amber-50 px-2 py-1 rounded-md">
                            FILES
                        </span>

                    </div>

                </div>

                <a href="{{ route('subjects.show', ['id' => 1]) }}"
                    class="w-12 h-12 bg-slate-950 text-white rounded-full flex items-center justify-center group-hover:bg-amber-500 group-hover:shadow-lg group-hover:shadow-amber-500/20 active:scale-90 transition-all duration-300">

                    <i class="fas fa-arrow-right text-sm transform group-hover:translate-x-0.5 transition-transform">
                    </i>

                </a>

            </div>

        </div>

        <!-- CARD -->
        <div
            class="subject-card group relative bg-white rounded-[2.2rem] border border-slate-100 shadow-[0_12px_40px_-15px_rgba(0,0,0,0.03)] hover:shadow-[0_24px_60px_-15px_rgba(59,130,246,0.12)] hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between overflow-hidden">

            <div
                class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-cyan-50 to-blue-50/50 rounded-full group-hover:scale-125 transition-transform duration-700 ease-out">
            </div>

            <div class="p-8 relative z-10">

                <div
                    class="w-16 h-16 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center mb-6 shadow-[inset_0_2px_8px_rgba(34,211,238,0.06)] group-hover:bg-cyan-600 group-hover:text-white group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">

                    <i class="fas fa-network-wired text-2xl"></i>

                </div>

                <div class="space-y-3">

                    <h3
                        class="subject-title text-2xl font-black text-slate-900 group-hover:text-cyan-600 transition-colors duration-300">

                        Mạng máy tính

                    </h3>

                    <p class="text-slate-400 text-sm leading-relaxed font-medium">
                        Kiến thức nền tảng về TCP/IP, OSI, thiết kế hệ thống và quản trị mạng.
                    </p>

                </div>

            </div>

            <div class="px-8 py-6 border-t border-slate-100 relative z-10 flex items-center justify-between">

                <div>

                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                        Số lượng
                    </span>

                    <div class="flex items-end gap-2 mt-1">

                        <span class="text-2xl font-black text-slate-800">
                            42
                        </span>

                        <span class="text-[10px] font-extrabold text-cyan-600 bg-cyan-50 px-2 py-1 rounded-md">
                            FILES
                        </span>

                    </div>

                </div>

                <a href="#"
                    class="w-12 h-12 bg-slate-950 text-white rounded-full flex items-center justify-center group-hover:bg-cyan-500 group-hover:shadow-lg group-hover:shadow-cyan-500/20 active:scale-90 transition-all duration-300">

                    <i class="fas fa-arrow-right text-sm transform group-hover:translate-x-0.5 transition-transform">
                    </i>

                </a>

            </div>

        </div>

    </div>

</main>

@endsection

<script>
function filterSubjects(type, element) {

    const cards = document.querySelectorAll('.subject-card');
    const buttons = document.querySelectorAll('.tab-btn');

    buttons.forEach(btn => {

        btn.classList.remove('bg-white', 'text-blue-600', 'shadow-sm');
        btn.classList.add('text-slate-500');

    });

    element.classList.add('bg-white', 'text-blue-600', 'shadow-sm');
    element.classList.remove('text-slate-500');

    cards.forEach(card => {

        if (type === 'all') {

            card.classList.remove('hidden');

        } else if (type === 'assigned') {

            if (card.classList.contains('assigned')) {

                card.classList.remove('hidden');

            } else {

                card.classList.add('hidden');

            }

        }

    });

}

function searchSubjects() {

    const input = document.getElementById('subjectSearch').value.toUpperCase();
    const cards = document.querySelectorAll('.subject-card');

    cards.forEach(card => {

        const title = card.querySelector('.subject-title').innerText;

        if (title.toUpperCase().indexOf(input) > -1) {

            card.classList.remove('hidden');

        } else {

            card.classList.add('hidden');

        }

    });

}

document.addEventListener('DOMContentLoaded', () => {

    const defaultTab = document.querySelector('.tab-btn');

    if (defaultTab) {

        filterSubjects('assigned', defaultTab);

    }

});
</script>