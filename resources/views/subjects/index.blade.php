@extends('layouts.app')

@section('title', 'Danh mục Môn học')

@section('content')

<!-- HERO -->
<header class="relative py-28 text-white text-center overflow-hidden">

    <!-- Background image -->
    <div class="absolute inset-0">
        <img src="https://cdn-media.sforum.vn/storage/app/media/giakhanh/h%C3%ACnh%20n%E1%BB%81n%20powerpoint%20ch%E1%BB%A7%20%C4%91%E1%BB%81%20gi%C3%A1o%20d%E1%BB%A5c/hinh-nen-powerpoint-chu-de-giao-duc-22.jpg"
            class="w-full h-full object-cover" />
        <div class="absolute inset-0 bg-blue-900/80"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-4">

        <!-- TITLE -->
        <h2 class="text-4xl md:text-5xl font-extrabold mb-4">
            Môn học không khó, vì đã có chúng tôi.
        </h2>

        <!-- SUBTITLE -->
        <p class="text-blue-100 mb-10 text-lg opacity-90">
            Tìm kiếm giáo trình, slide, đề thi và bài tập từ hàng nghìn môn học khác nhau.
        </p>

        <!-- SEARCH BOX -->
        <div class="flex flex-col md:flex-row items-center bg-white rounded-2xl overflow-hidden shadow-2xl">

            <!-- Input -->
            <div class="flex items-center flex-1 px-4">
                <i class="fas fa-search text-slate-400 mr-3"></i>
                <input type="text" placeholder="Nhập tên tài liệu, đề thi hoặc từ khóa..."
                    class="w-full py-4 text-slate-800 outline-none text-sm">
            </div>



            <!-- Button -->
            <button
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 text-sm uppercase tracking-widest">
                Tìm kiếm
            </button>
        </div>
    </div>

</header>

<main class="max-w-7xl mx-auto px-6 lg:px-8 py-20">
    <!-- Mục tìm kiếm -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
        <div>
            <div class="flex  items-center mb-3">
                <div
                    class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white mr-3 shadow-lg shadow-blue-200">
                    <i class="fas fa-layer-group"></i>
                </div>
                <h4 class="text-2xl font-extrabold text-slate-800">Danh mục Môn học</h4>

            </div>

            <p class="text-slate-500 font-medium text-lg md:text-left">Quản lý và cập nhật học liệu cho
                các
                chuyên ngành phụ trách.</p>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-4">
            <div class="relative w-72">
                <input type="text" id="subjectSearch" onkeyup="searchSubjects()" placeholder="Tìm theo tên..." class=" text-center w-full pl-11 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl 
               text-sm font-medium text-slate-700
               shadow-sm
               focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
               transition-all duration-200">

                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 
              text-slate-400 text-sm transition-colors duration-200"></i>
            </div>
            <div class="inline-flex p-1.5 bg-slate-100 rounded-2xl border border-slate-200">
                <button onclick="filterSubjects('assigned', this)"
                    class="tab-btn px-6 py-2.5 rounded-xl bg-white text-blue-600 font-bold shadow-sm transition-all duration-300 text-sm">
                    Phụ trách (2)
                </button>
                <button onclick="filterSubjects('all', this)"
                    class="tab-btn px-6 py-2.5 rounded-xl text-slate-500 font-bold hover:text-slate-700 transition-all duration-300 text-sm">
                    Tất cả (12)
                </button>
            </div>


        </div>
    </div>

    <!-- Grid môn học -->
    <div id="subjectGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">

        <div
            class="subject-card assigned group relative bg-white rounded-[2.5rem] border border-slate-100 shadow-[0_10px_30px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_50px_-20px_rgba(59,130,246,0.2)] hover:-translate-y-3 transition-all duration-500 cursor-pointer overflow-hidden">
            <div
                class="absolute -top-12 -right-12 w-32 h-32 bg-blue-50 rounded-full group-hover:bg-blue-100 transition-colors">
            </div>
            <div class="p-10 relative z-10">
                <div
                    class="w-20 h-20 bg-gradient-to-br from-blue-50 to-blue-100 text-blue-600 rounded-3xl flex items-center justify-center mb-8 shadow-inner transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-500">
                    <i class="fas fa-laptop-code text-3xl"></i>
                </div>
                <h3
                    class="subject-title text-2xl font-black text-slate-800 mb-3 leading-tight group-hover:text-blue-600 transition-colors">
                    Lập trình Web</h3>
                <p class="text-slate-500 text-[15px] mb-8 leading-relaxed font-medium">Làm chủ các Framework hiện
                    đại
                    nhất như Laravel, ReactJS...</p>
                <div class="flex items-center justify-between pt-8 border-t border-slate-50">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Bài đã
                            đăng</span>
                        <div class="flex items-center"><span
                                class="text-2xl font-black text-slate-800 mr-1.5">10/20</span><span
                                class="text-xs font-bold text-blue-500 bg-blue-50 px-2 py-0.5 rounded-md">FILES</span>
                        </div>
                    </div>
                    <a href="{{ route('subjects.show', ['id' => 1]) }}" class="w-14 h-14 bg-slate-900 group-hover:bg-blue-600 text-white rounded-2xl 
          flex items-center justify-center 
          transition-all duration-300 
          hover:scale-105 active:scale-95">

                        <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                </div>
            </div>
        </div>



        <div
            class="subject-card group relative bg-white rounded-[2.5rem] border border-slate-100 shadow-[0_10px_30px_-15px_rgba(0,0,0,0.05)] hover:shadow-[0_20px_50px_-20px_rgba(249,115,22,0.2)] hover:-translate-y-3 transition-all duration-500 cursor-pointer overflow-hidden">
            <div
                class="absolute -top-12 -right-12 w-32 h-32 bg-orange-50 rounded-full group-hover:bg-orange-100 transition-colors">
            </div>
            <div class="p-10 relative z-10">
                <div
                    class="w-20 h-20 bg-gradient-to-br from-orange-50 to-orange-100 text-orange-600 rounded-3xl flex items-center justify-center mb-8 shadow-inner transform group-hover:scale-110 group-hover:rotate-12 transition-all duration-500">
                    <i class="fas fa-network-wired text-3xl"></i>
                </div>
                <h3
                    class="subject-title text-2xl font-black text-slate-800 mb-3 leading-tight group-hover:text-orange-600 transition-colors">
                    Mạng máy tính</h3>
                <p class="text-slate-500 text-[15px] mb-8 leading-relaxed font-medium">Tìm hiểu kiến trúc mạng, các
                    tầng
                    giao thức TCP/IP...</p>
                <div class="flex items-center justify-between pt-8 border-t border-slate-50">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Số
                            lượng</span>
                        <div class="flex items-center"><span
                                class="text-2xl font-black text-slate-800 mr-1.5">42</span><span
                                class="text-xs font-bold text-orange-500 bg-orange-50 px-2 py-0.5 rounded-md">FILES</span>
                        </div>
                    </div>
                    <div
                        class="w-14 h-14 bg-slate-900 group-hover:bg-orange-600 text-white rounded-2xl flex items-center justify-center transition-all duration-500">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

@endsection
<script>
function filterSubjects(type, element) {
    const cards = document.querySelectorAll('.subject-card');
    const buttons = document.querySelectorAll('.tab-btn');

    // 1. Xử lý đổi màu nút bấm (Tabs)
    buttons.forEach(btn => {
        btn.classList.remove('bg-white', 'text-blue-600', 'shadow-sm');
        btn.classList.add('text-slate-500');
    });
    element.classList.add('bg-white', 'text-blue-600', 'shadow-sm');
    element.classList.remove('text-slate-500');

    // 2. Lọc các Card môn học
    cards.forEach(card => {
        if (type === 'all') {
            card.style.display = 'block'; // Hiện tất cả
        } else if (type === 'assigned') {
            if (card.classList.contains('assigned')) {
                card.style.display = 'block'; // Chỉ hiện môn phụ trách
            } else {
                card.style.display = 'none'; // Ẩn các môn khác
            }
        }
    });
}

// Tính năng tìm kiếm bổ trợ
function searchSubjects() {
    const input = document.getElementById('subjectSearch').value.toUpperCase();
    const cards = document.querySelectorAll('.subject-card');

    cards.forEach(card => {
        const title = card.querySelector('.subject-title').innerText;
        if (title.toUpperCase().indexOf(input) > -1) {
            card.style.display = "";
        } else {
            card.style.display = "none";
        }
    });
}

// Mặc định khi load trang hiển thị "Môn học phụ trách"
document.addEventListener('DOMContentLoaded', () => {
    // Nếu muốn mặc định hiện tất cả, hãy sửa thành filterSubjects('all', ...)
    const defaultTab = document.querySelector('.tab-btn');
    filterSubjects('assigned', defaultTab);
});
</script>