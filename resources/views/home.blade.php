@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

<!-- HERO -->
<header class="relative py-28 bg-white/20 text-white text-center overflow-hidden">

    <!-- Background Slider -->
    <div class="absolute inset-0">

        <!-- Slide 1 -->
        <img src="https://i.pinimg.com/736x/3f/3e/e6/3f3ee63d36c5938d1744264288d3c1cd.jpg"
            class="hero-slide absolute inset-0 w-full h-full object-cover active" />

        <!-- Slide 2 -->
        <img src="https://i.pinimg.com/1200x/e4/5f/a5/e45fa598385b82780c59d7fc382b709c.jpg"
            class="hero-slide absolute inset-0 w-full h-full object-cover" />

        <!-- Slide 3 -->
        <img src="https://i.pinimg.com/1200x/91/92/ec/9192ec49cbcbc1edf414963da9361909.jpg"
            class=" hero-slide absolute inset-0 w-full h-full object-cover" />

        <!-- Overlay -->
        <div class="absolute inset-0 bg-blue-950/75"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 max-w-4xl mx-auto px-4">

        <!-- TITLE -->
        <h2 class="text-white drop-shadow-lg text-4xl md:text-5xl font-extrabold mb-4 leading-tight">
            Khám phá kho tri thức học tập
        </h2>

        <!-- SUBTITLE -->
        <p class="text-slate-200 mb-10 text-lg opacity-95">
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

            <!-- Select -->
            <div class="flex items-center px-4 bg-slate-50 border-l">
                <i class="fas fa-book-open text-slate-400 mr-2"></i>
                <select class="bg-transparent py-4 text-slate-600 text-sm outline-none cursor-pointer">
                    <option>Tất cả môn học</option>
                    <option>Lập trình Web</option>
                    <option>Cơ sở dữ liệu</option>
                    <option>Mạng máy tính</option>
                </select>
            </div>

            <!-- Button -->
            <button
                class="bg-blue-600 hover:bg-blue-700 transition text-white font-bold px-8 py-4 text-sm uppercase tracking-widest">
                Tìm kiếm
            </button>

        </div>

        <!-- TREND TAG -->
        <div class="mt-6 text-sm">
            <span class="opacity-70 mr-2">Xu hướng:</span>

            <span class="bg-white/20 px-3 py-1 rounded-full text-xs mr-2">#ASP.NETCore</span>
            <span class="bg-white/20 px-3 py-1 rounded-full text-xs mr-2">#ĐềThiWeb</span>
            <span class="bg-white/20 px-3 py-1 rounded-full text-xs">#SQLServer</span>
        </div>

    </div>

</header>

<!-- STYLE -->
<style>
.hero-slide {
    opacity: 0;
    transition: opacity 1.0s ease-in-out, transform 8s ease;
    transform: scale(1.05);
}

.hero-slide.active {
    opacity: 1;
    transform: scale(1);
}
</style>

<!-- SCRIPT -->
<script>
const slides = document.querySelectorAll('.hero-slide');
let current = 0;

setInterval(() => {
    slides[current].classList.remove('active');

    current = (current + 1) % slides.length;

    slides[current].classList.add('active');
}, 5000);
</script>

<main class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-12">
    <!-- Phần khách vãng lai -->
    @guest
    <div class="relative py-20 my-10 overflow-hidden rounded-[3rem] bg-slate-50 border border-slate-100 shadow-inner">

        <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-100/50 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-cyan-100/50 rounded-full blur-3xl"></div>

        <div class="container relative z-10 mx-auto px-4">
            <div class="text-center mb-10">

                <h3
                    class="text-slate-900 text-4xl md:text-5xl lg:text-6xl font-black uppercase tracking-tight leading-[1.1] mb-8">
                    Một chạm – <span class="text-blue-600">Mở bừng</span> <br class="hidden md:block">
                    kho tri thức

                </h3>

                <div class="max-w-2xl mx-auto mb-8">
                    <p class="text-slate-500 text-lg md:text-xl font-medium leading-relaxed italic">
                        <i class="fas fa-quote-left text-blue-200 mr-2"></i>
                        Tìm kiếm những tài liệu học tập tốt nhất để đạt điểm cao trong suốt quá trình học tập.
                        <i class="fas fa-quote-right text-blue-200 ml-2"></i>
                    </p>
                </div>

                <div class="relative flex items-center justify-center mt-10 ">

                    <!-- Line trái -->
                    <div class="line left"></div>

                    <!-- Dot giữa -->
                    <div class="dot"></div>

                    <!-- Line phải -->
                    <div class="line right"></div>

                </div>

            </div>
        </div>
    </div>

    <div class="bg-slate-50 py-20">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div
                class="group bg-white p-10 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-slate-100 text-center transition-all duration-500 hover:shadow-2xl hover:shadow-blue-100 hover:-translate-y-3 relative overflow-hidden">
                <div
                    class="absolute -right-6 -bottom-6 w-32 h-32 bg-blue-50 rounded-full opacity-0 group-hover:opacity-100 group-hover:scale-150 transition-all duration-700">
                </div>

                <div class="relative z-10">
                    <div
                        class="w-20 h-20 bg-blue-50 text-blue-600 rounded-3xl flex items-center justify-center mx-auto mb-8 transform group-hover:rotate-12 group-hover:scale-110 transition-all duration-500 shadow-sm">
                        <i class="fas fa-file-invoice text-3xl"></i>
                    </div>
                    <h2
                        class="text-5xl font-black text-slate-800 mb-3 tracking-tighter group-hover:text-blue-600 transition-colors">
                        1,200+</h2>
                    <p class="text-slate-400 font-bold uppercase text-xs tracking-[0.2em]">Tài liệu đã đăng tải</p>
                </div>
            </div>
            <div
                class="group bg-white p-10 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-slate-100 text-center transition-all duration-500 hover:shadow-2xl hover:shadow-green-100 hover:-translate-y-3 relative overflow-hidden">
                <div
                    class="absolute -right-6 -bottom-6 w-32 h-32 bg-green-50 rounded-full opacity-0 group-hover:opacity-100 group-hover:scale-150 transition-all duration-700">
                </div>

                <div class="relative z-10">
                    <div
                        class="w-20 h-20 bg-green-50 text-green-600 rounded-3xl flex items-center justify-center mx-auto mb-8 transform group-hover:-rotate-12 group-hover:scale-110 transition-all duration-500 shadow-sm">
                        <i class="fas fa-book-reader text-3xl"></i>
                    </div>
                    <h2
                        class="text-5xl font-black text-slate-800 mb-3 tracking-tighter group-hover:text-green-600 transition-colors">
                        50+</h2>
                    <p class="text-slate-400 font-bold uppercase text-xs tracking-[0.2em]">Môn học hỗ trợ</p>
                </div>
            </div>
            <div
                class="group bg-white p-10 rounded-[2rem] shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] border border-slate-100 text-center transition-all duration-500 hover:shadow-2xl hover:shadow-cyan-100 hover:-translate-y-3 relative overflow-hidden">
                <div
                    class="absolute -right-6 -bottom-6 w-32 h-32 bg-cyan-50 rounded-full opacity-0 group-hover:opacity-100 group-hover:scale-150 transition-all duration-700">
                </div>

                <div class="relative z-10">
                    <div
                        class="w-20 h-20 bg-cyan-50 text-cyan-600 rounded-3xl flex items-center justify-center mx-auto mb-8 transform group-hover:rotate-12 group-hover:scale-110 transition-all duration-500 shadow-sm">
                        <i class="fas fa-bolt text-3xl"></i>
                    </div>
                    <h2
                        class="text-5xl font-black text-slate-800 mb-3 tracking-tighter group-hover:text-cyan-600 transition-colors">
                        5,000+</h2>
                    <p class="text-slate-400 font-bold uppercase text-xs tracking-[0.2em]">Lượt tải xuống</p>
                </div>
            </div>
        </div>

    </div>

    <div class="relative py-20 my-10 overflow-hidden rounded-[3rem] bg-slate-50 border border-slate-100 shadow-inner">

        <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-100/90 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-cyan-100/90 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-2xl mx-auto px-6 text-center">

            <div class="relative inline-block mb-8">
                <div
                    class="w-24 h-24 bg-white rounded-3xl shadow-xl flex items-center justify-center mx-auto transform rotate-12 group-hover:rotate-0 transition-transform duration-500">
                    <i class="fas fa-lock text-4xl text-blue-600"></i>
                </div>
                <span class="absolute -top-2 -right-2 flex h-6 w-6">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-6 w-6 bg-red-500 border-2 border-white"></span>
                </span>
            </div>

            <h3 class="text-3xl md:text-4xl font-black text-slate-800 mb-4 tracking-tight">
                Nội dung này đã được <span class="text-blue-600">Khóa</span>
            </h3>

            <p class="text-slate-500 text-lg mb-10 leading-relaxed font-medium">
                “Trở thành thành viên để dễ dàng truy cập, tìm kiếm và tải về kho tài liệu học tập miễn phí mọi lúc,
                mọi
                nơi.”
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('login') }}"
                    class="group relative inline-flex items-center justify-center px-10 py-4 font-bold text-white transition-all duration-300 bg-blue-600 rounded-2xl hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-200 active:scale-95 w-full sm:w-auto">
                    <span class="mr-2">ĐĂNG NHẬP NGAY</span>
                    <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                </a>

                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center px-10 py-4 font-bold text-blue-600 transition-all duration-300 bg-white border-2 border-blue-600 rounded-2xl hover:bg-blue-50 active:scale-95 w-full sm:w-auto">
                    Tạo tài khoản mới
                </a>
            </div>

            <p
                class="mt-8 text-xs text-slate-400 flex items-center justify-center gap-2 font-semibold uppercase tracking-widest">
                <i class="fas fa-shield-alt text-green-500"></i>
                Bảo mật & An toàn tuyệt đối
            </p>
        </div>
    </div>
    @endguest
    <!-- Phần Tài liệu sẽ chia quyền giảng viên và sinh viên -->
    @auth
    @if(auth()->user()->role_id !=1)
    <!--DANH MỤC MÔN HỌC (SINH VIÊN xem đc tất cả các file, giảng viên xem đc tất cả các file)-->
    <div class="mb-12 py-15 my-10">
        <div class="flex  items-center mb-6">
            <div
                class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white mr-3 shadow-lg shadow-blue-200">
                <i class="fas fa-layer-group"></i>
            </div>
            <h4 class="text-2xl font-extrabold text-slate-800">Danh mục Môn học</h4>
            <a href="{{ route('subjects.index') }}"
                class="ml-auto text-sm font-semibold text-blue-600 hover:text-blue-700 flex items-center gap-1 transition-colors">
                Xem tất cả <i class="fas fa-angle-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <a href="{{ route('subjects.show', ['id' => 1]) }}"
                class="group bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center cursor-pointer">
                <div
                    class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-laptop-code text-2xl"></i>
                </div>
                <h6 class="font-bold text-slate-800 mb-1 group-hover:text-blue-600 transition-colors">Lập trình Web
                </h6>
                <p class="text-xs text-slate-400 font-medium">120 tài liệu</p>
            </a>

            <a
                class="group bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center cursor-pointer">
                <div
                    class="w-16 h-16 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-database text-2xl"></i>
                </div>
                <h6 class="font-bold text-slate-800 mb-1 group-hover:text-green-600 transition-colors">Cơ sở dữ liệu
                </h6>
                <p class="text-xs text-slate-400 font-medium">85 tài liệu</p>
            </a>

            <a
                class="group bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center cursor-pointer">
                <div
                    class="w-16 h-16 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-network-wired text-2xl"></i>
                </div>
                <h6 class="font-bold text-slate-800 mb-1 group-hover:text-cyan-600 transition-colors">Mạng máy tính
                </h6>
                <p class="text-xs text-slate-400 font-medium">64 tài liệu</p>
            </a>

            <a
                class="group bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-center cursor-pointer">
                <div
                    class="w-16 h-16 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-project-diagram text-2xl"></i>
                </div>
                <h6 class="font-bold text-slate-800 mb-1 group-hover:text-red-600 transition-colors">Cấu trúc dữ
                    liệu
                </h6>
                <p class="text-xs text-slate-400 font-medium">150 tài liệu</p>
            </a>
        </div>
    </div>

    <!-- Phần Tài liệu sẽ chia quyền sinh viên -->
    @if(auth()->user()->role_id==3)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!--SV TÀI LIỆU MỚI NHẤT -->
        <div class="lg:col-span-2">
            <div class="flex items-center mb-6">
                <div
                    class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white mr-3 shadow-lg shadow-blue-200">
                    <i class="fas fa-clock"></i>
                </div>
                <h4 class="text-2xl font-extrabold text-slate-800">Tài liệu mới nhất</h4>
            </div>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="divide-y divide-slate-100">

                    <div class="p-6 hover:bg-slate-50 transition-colors flex items-center gap-5 group">
                        <div
                            class="w-16 h-16 bg-red-50 text-red-500 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-red-100">
                            <i class="fas fa-file-pdf text-2xl"></i>
                            <span class="text-[10px] font-black mt-1">PDF</span>
                        </div>
                        <div class="flex-grow min-w-0">
                            <h6
                                class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors truncate">
                                Slide Bài 1: Tổng quan về Laravel Framework
                            </h6>
                            <div class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                                <span class="flex items-center"><i class="fas fa-book text-slate-400 mr-1.5"></i>
                                    Môn:
                                    Lập trình Web</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-user-graduate text-slate-400 mr-1.5"></i> GV: ThS. Trần Văn
                                    B</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-calendar-check text-slate-400 mr-1.5"></i> Hôm nay</span>
                            </div>
                        </div>
                        <button
                            class="shrink-0 px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm shadow-sm shadow-blue-100">
                            <i class="fas fa-cloud-download-alt"></i> Tải về
                        </button>
                    </div>

                    <div class="p-6 hover:bg-slate-50 transition-colors flex items-center gap-5 group">
                        <div
                            class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-blue-100">
                            <i class="fas fa-file-word text-2xl"></i>
                            <span class="text-[10px] font-black mt-1">W</span>
                        </div>
                        <div class="flex-grow min-w-0">
                            <h6
                                class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors truncate">
                                Đề cương ôn tập giữa kỳ CSDL 2023-2024
                            </h6>
                            <div class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                                <span class="flex items-center"><i class="fas fa-book text-slate-400 mr-1.5"></i>
                                    Môn:
                                    Cơ sở dữ liệu</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-user-graduate text-slate-400 mr-1.5"></i> GV: TS. Lê Thị
                                    C</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-calendar-check text-slate-400 mr-1.5"></i> Hôm qua</span>
                            </div>
                        </div>
                        <button
                            class="shrink-0 px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm">
                            <i class="fas fa-cloud-download-alt"></i> Tải về
                        </button>
                    </div>

                    <div class="p-6 hover:bg-slate-50 transition-colors flex items-center gap-5 group">
                        <div
                            class="w-16 h-16 bg-green-50 text-green-600 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-green-100">
                            <i class="fas fa-file-excel text-2xl"></i>
                            <span class="text-[10px] font-black mt-1">X</span>
                        </div>
                        <div class="flex-grow min-w-0">
                            <h6
                                class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors truncate">
                                Danh sách chia nhóm & Bài tập lớn Mạng máy tính
                            </h6>
                            <div class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                                <span class="flex items-center"><i class="fas fa-book text-slate-400 mr-1.5"></i>
                                    Môn:
                                    Mạng máy tính</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-user-graduate text-slate-400 mr-1.5"></i> GV: Phạm Văn
                                    D</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-calendar-check text-slate-400 mr-1.5"></i> 2 ngày trước</span>
                            </div>
                        </div>
                        <button
                            class="shrink-0 px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm">
                            <i class="fas fa-cloud-download-alt"></i> Tải về
                        </button>
                    </div>
                </div>

                <div class="p-4 bg-slate-50/50 border-t border-slate-100 text-center">
                    <a href="{{ route('documents.index') }}"
                        class="text-blue-600 font-bold text-sm hover:text-blue-700 flex items-center justify-center gap-2">
                        Xem thêm tài liệu <i class="fas fa-arrow-down animate-bounce"></i>
                    </a>
                </div>
            </div>
        </div>
        <!--SV TÀI LIỆU TẢI NHIỀU -->
        <div>
            <div>
                <div class="flex items-center mb-6">
                    <div
                        class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center text-white mr-3 shadow-lg shadow-red-200">
                        <i class="fas fa-fire"></i>
                    </div>
                    <h4 class="text-2xl font-extrabold text-slate-800">Tài liệu tải nhiều</h4>
                </div>

                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden p-2">
                    <div class="flex flex-col">

                        <a href="#" class="flex items-center p-4 rounded-2xl hover:bg-slate-50 transition-all group">
                            <span class="text-2xl font-black text-orange-400 w-8 italic">1</span>
                            <div class="flex-grow min-w-0 px-3">
                                <div class="flex items-center gap-2">
                                    <h6
                                        class="font-bold text-slate-800 truncate group-hover:text-blue-600 transition-colors">
                                        Đề thi mẫu cuối kỳ CSDL...</h6>
                                    <span
                                        class="bg-yellow-400 text-[9px] text-white font-black px-1.5 py-0.5 rounded-md uppercase tracking-tighter">Hot</span>
                                </div>
                                <p class="text-xs text-slate-400 mt-1 font-medium"><i
                                        class="fas fa-download mr-1 text-slate-300"></i> 1,245 lượt tải</p>
                            </div>
                        </a>

                        <a href="#"
                            class="flex items-center p-4 rounded-2xl hover:bg-slate-50 transition-all group border-t border-slate-50">
                            <span class="text-2xl font-black text-slate-300 w-8 italic">2</span>
                            <div class="flex-grow min-w-0 px-3">
                                <h6
                                    class="font-bold text-slate-800 truncate group-hover:text-blue-600 transition-colors">
                                    Đồ
                                    án mẫu Lập trình We...</h6>
                                <p class="text-xs text-slate-400 mt-1 font-medium"><i
                                        class="fas fa-download mr-1 text-slate-300"></i> 980 lượt tải</p>
                            </div>
                        </a>

                        <a href="#"
                            class="flex items-center p-4 rounded-2xl hover:bg-slate-50 transition-all group border-t border-slate-50">
                            <span class="text-2xl font-black text-rose-400 w-8 italic">3</span>
                            <div class="flex-grow min-w-0 px-3">
                                <h6
                                    class="font-bold text-slate-800 truncate group-hover:text-blue-600 transition-colors">
                                    Giáo trình Mạng máy tín...</h6>
                                <p class="text-xs text-slate-400 mt-1 font-medium"><i
                                        class="fas fa-download mr-1 text-slate-300"></i> 750 lượt tải</p>
                            </div>
                        </a>

                        <a href="#"
                            class="flex items-center p-4 rounded-2xl hover:bg-slate-50 transition-all group border-t border-slate-50">
                            <span class="text-2xl font-black text-slate-300 w-8 italic">4</span>
                            <div class="flex-grow min-w-0 px-3">
                                <h6
                                    class="font-bold text-slate-800 truncate group-hover:text-blue-600 transition-colors">
                                    100 Câu hỏi trắc nghiệm...</h6>
                                <p class="text-xs text-slate-400 mt-1 font-medium"><i
                                        class="fas fa-download mr-1 text-slate-300"></i> 620 lượt tải</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Phần Tài liệu sẽ chia quyền  giảng viên -->
    @if(auth()->user()->role_id==2)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!--GV TÀI LIỆU BẠN ĐÃ ĐĂNG -->
        <div class="lg:col-span-2">
            <div class="flex items-center mb-6">
                <div
                    class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white mr-3 shadow-lg shadow-blue-200">
                    <i class="fas fa-clock"></i>
                </div>
                <h4 class="text-2xl font-extrabold text-slate-800">Tài liệu bạn đã đăng</h4>
            </div>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="divide-y divide-slate-100">

                    <div class="p-6 hover:bg-slate-50 transition-colors flex items-center gap-5 group">
                        <div
                            class="w-16 h-16 bg-red-50 text-red-500 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-red-100">
                            <i class="fas fa-file-pdf text-2xl"></i>
                            <span class="text-[10px] font-black mt-1">PDF</span>
                        </div>
                        <div class="flex-grow min-w-0">
                            <h6
                                class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors truncate">
                                Slide Bài 1: Tổng quan về Laravel Framework
                            </h6>
                            <div class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                                <span class="flex items-center"><i class="fas fa-book text-slate-400 mr-1.5"></i>
                                    Môn:
                                    Lập trình Web</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-user-graduate text-slate-400 mr-1.5"></i> GV: ThS. Trần Văn
                                    B</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-calendar-check text-slate-400 mr-1.5"></i> Hôm nay</span>
                            </div>
                        </div>
                        <button
                            class="shrink-0 px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm shadow-sm shadow-blue-100">
                            <i class="fas fa-cloud-download-alt"></i> Tải về
                        </button>
                    </div>

                    <div class="p-6 hover:bg-slate-50 transition-colors flex items-center gap-5 group">
                        <div
                            class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-blue-100">
                            <i class="fas fa-file-word text-2xl"></i>
                            <span class="text-[10px] font-black mt-1">W</span>
                        </div>
                        <div class="flex-grow min-w-0">
                            <h6
                                class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors truncate">
                                Đề cương ôn tập giữa kỳ CSDL 2023-2024
                            </h6>
                            <div class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                                <span class="flex items-center"><i class="fas fa-book text-slate-400 mr-1.5"></i>
                                    Môn:
                                    Cơ sở dữ liệu</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-user-graduate text-slate-400 mr-1.5"></i> GV: TS. Lê Thị
                                    C</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-calendar-check text-slate-400 mr-1.5"></i> Hôm qua</span>
                            </div>
                        </div>
                        <button
                            class="shrink-0 px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm">
                            <i class="fas fa-cloud-download-alt"></i> Tải về
                        </button>
                    </div>

                    <div class="p-6 hover:bg-slate-50 transition-colors flex items-center gap-5 group">
                        <div
                            class="w-16 h-16 bg-green-50 text-green-600 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-green-100">
                            <i class="fas fa-file-excel text-2xl"></i>
                            <span class="text-[10px] font-black mt-1">X</span>
                        </div>
                        <div class="flex-grow min-w-0">
                            <h6
                                class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors truncate">
                                Danh sách chia nhóm & Bài tập lớn Mạng máy tính
                            </h6>
                            <div class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                                <span class="flex items-center"><i class="fas fa-book text-slate-400 mr-1.5"></i>
                                    Môn:
                                    Mạng máy tính</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-user-graduate text-slate-400 mr-1.5"></i> GV: Phạm Văn
                                    D</span>
                                <span class="text-slate-300">•</span>
                                <span class="flex items-center"><i
                                        class="fas fa-calendar-check text-slate-400 mr-1.5"></i> 2 ngày trước</span>
                            </div>
                        </div>
                        <button
                            class="shrink-0 px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm">
                            <i class="fas fa-cloud-download-alt"></i> Tải về
                        </button>
                    </div>
                </div>

                <div class="p-4 bg-slate-50/50 border-t border-slate-100 text-center">
                    <a href="{{ route('documents.index') }}"
                        class="text-blue-600 font-bold text-sm hover:text-blue-700 flex items-center justify-center gap-2">
                        Xem thêm tài liệu <i class="fas fa-arrow-down animate-bounce"></i>
                    </a>
                </div>
            </div>
        </div>
        <!--GV Thống kê tương tác dạng biểu đồ đường -->
        <div>
            <div class="flex items-center mb-6">
                <div
                    class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center text-white mr-3 shadow-lg shadow-red-200">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h4 class="text-2xl font-extrabold text-slate-800">Thống kê tương tác</h4>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8 flex flex-col">
                <div class="flex-1 flex flex-col justify-center">
                    <div class="chart-container">
                        <canvas id="statChart"></canvas>
                    </div>
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <div class="bg-slate-50 p-4 rounded-xl text-center">
                            <p class="text-2xl font-black text-blue-600">1.2k</p>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Lượt tải</p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl text-center">
                            <p class="text-2xl font-black text-green-600">4.8</p>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Đánh giá</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endif
    @endif
    @endauth


</main>
@endsection