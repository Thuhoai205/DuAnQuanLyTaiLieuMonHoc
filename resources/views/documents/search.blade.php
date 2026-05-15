@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

body {
    font-family: 'Inter', sans-serif;
}

.hero-slide {
    opacity: 0;
    transition: opacity 1s ease-in-out, transform 8s ease;
    transform: scale(1.05);
}

.hero-slide.active {
    opacity: 1;
    transform: scale(1);
}
</style>

<div class="bg-slate-50 min-h-screen">
    <header class="relative py-24 md:py-32 bg-slate-900 text-white text-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://i.pinimg.com/736x/3f/3e/e6/3f3ee63d36c5938d1744264288d3c1cd.jpg"
                class="hero-slide absolute inset-0 w-full h-full object-cover active" />
            <img src="https://i.pinimg.com/1200x/e4/5f/a5/e45fa598385b82780c59d7fc382b709c.jpg"
                class="hero-slide absolute inset-0 w-full h-full object-cover" />
            <img src="https://i.pinimg.com/1200x/91/92/ec/9192ec49cbcbc1edf414963da9361909.jpg"
                class="hero-slide absolute inset-0 w-full h-full object-cover" />
            <div class="absolute inset-0 bg-blue-950/80"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4">
            <h2 class="text-3xl md:text-6xl font-black mb-6 leading-tight tracking-tight">
                Khám phá kho tri thức học tập
            </h2>
            <p class="text-blue-100/80 mb-10 text-lg md:text-xl max-w-2xl mx-auto font-medium">
                Tìm kiếm giáo trình, slide, đề thi và bài tập từ hàng nghìn môn học khác nhau.
            </p>

            <form action="{{ route('documents.search') }}" method="GET" class="relative group">
                <div
                    class="bg-white rounded-2xl md:rounded-full shadow-2xl p-2 flex flex-col md:flex-row items-center gap-2 border border-white/20">
                    <div class="flex items-center flex-1 w-full px-6">
                        <i class="fas fa-search text-slate-400 mr-3 text-lg"></i>
                        <input type="text" name="keyword" placeholder="Nhập tên tài liệu, đề thi hoặc từ khóa..."
                            class="w-full py-4 text-slate-700 placeholder-slate-400 bg-transparent outline-none text-sm font-semibold">
                    </div>

                    <div class="hidden md:block w-px h-10 bg-slate-200"></div>

                    <div class="flex items-center px-4 w-full md:w-auto">
                        <i class="fas fa-book-open text-slate-400 mr-2 text-sm"></i>
                        <select name="subject_id"
                            class="w-full bg-transparent text-slate-700 text-sm font-bold border-none outline-none focus:ring-0 py-4 cursor-pointer">
                            <option value="">Tất cả môn học</option>
                            <option value="1">Lập trình Web</option>
                            <option value="2">Cơ sở dữ liệu</option>
                            <option value="3">Mạng máy tính</option>
                        </select>
                    </div>

                    <button type="submit"
                        class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-black px-10 py-4 rounded-xl md:rounded-full transition-all duration-300 uppercase text-xs tracking-widest shadow-lg shadow-blue-500/30 active:scale-95">
                        TÌM KIẾM
                    </button>
                </div>
            </form>

            <div class="mt-8 flex flex-wrap justify-center items-center gap-3 text-sm font-medium">
                <span class="text-blue-200/60">Xu hướng:</span>
                <a href="#"
                    class="bg-white/10 hover:bg-white/20 px-4 py-1.5 rounded-full text-xs transition-colors">#ASP.NETCore</a>
                <a href="#"
                    class="bg-white/10 hover:bg-white/20 px-4 py-1.5 rounded-full text-xs transition-colors">#ĐềThiWeb</a>
                <a href="#"
                    class="bg-white/10 hover:bg-white/20 px-4 py-1.5 rounded-full text-xs transition-colors">#SQLServer</a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-16">
        <div class="flex flex-col lg:flex-row gap-8 items-start">

            <aside class="w-full lg:w-1/4 sticky top-24">
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/60 p-8">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-xl font-black text-slate-800">Bộ lọc</h3>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mt-1">Tùy chỉnh kết quả
                            </p>
                        </div>
                        <div
                            class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-sm">
                            <i class="fas fa-sliders-h text-sm"></i>
                        </div>
                    </div>

                    <form action="#" method="GET" class="space-y-8">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-5">
                                Phân loại học liệu
                            </label>

                            <div class="space-y-4">
                                {{-- Slide bài giảng --}}
                                <label class="flex items-center group cursor-pointer">
                                    <div class="relative flex items-center">
                                        <input type="checkbox" name="types[]" value="slide" checked
                                            class="w-5 h-5 rounded-lg border-slate-300 text-blue-600 focus:ring-blue-500 transition-all">
                                    </div>
                                    <span
                                        class="ml-4 text-sm font-bold text-slate-600 group-hover:text-blue-600 transition-colors">
                                        Slide bài giảng
                                    </span>
                                </label>

                                {{-- Đề thi cũ --}}
                                <label class="flex items-center group cursor-pointer">
                                    <div class="relative flex items-center">
                                        <input type="checkbox" name="types[]" value="exam"
                                            class="w-5 h-5 rounded-lg border-slate-300 text-blue-600 focus:ring-blue-500 transition-all">
                                    </div>
                                    <span
                                        class="ml-4 text-sm font-bold text-slate-600 group-hover:text-blue-600 transition-colors">
                                        Đề thi cũ
                                    </span>
                                </label>

                                {{-- Bài tập lớn --}}
                                <label class="flex items-center group cursor-pointer">
                                    <div class="relative flex items-center">
                                        <input type="checkbox" name="types[]" value="project"
                                            class="w-5 h-5 rounded-lg border-slate-300 text-blue-600 focus:ring-blue-500 transition-all">
                                    </div>
                                    <span
                                        class="ml-4 text-sm font-bold text-slate-600 group-hover:text-blue-600 transition-colors">
                                        Bài tập lớn
                                    </span>
                                </label>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full py-4 rounded-2xl bg-slate-900 hover:bg-blue-600 text-white font-black text-xs uppercase tracking-widest transition-all duration-300 shadow-lg shadow-slate-200 active:scale-95">
                            ÁP DỤNG BỘ LỌC
                        </button>
                    </form>
                </div>
            </aside>

            <div class="flex-1 w-full">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10 px-2">
                    <div>
                        <h2 class="text-3xl font-black text-slate-800 tracking-tight">
                            Kết quả tìm thấy <span class="text-blue-600">(4)</span>
                        </h2>
                        <p class="text-slate-400 font-medium text-sm mt-1 italic">Dựa trên từ khóa và bộ lọc bạn đã chọn
                        </p>
                    </div>

                    <div
                        class="flex items-center bg-white border border-slate-100 rounded-2xl shadow-sm px-5 py-2 gap-4">
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Sắp xếp</span>
                        <div class="w-px h-4 bg-slate-200"></div>
                        <select
                            class="bg-transparent border-none outline-none focus:ring-0 text-sm font-bold text-slate-700 cursor-pointer pr-8">
                            <option>Mới nhất</option>
                            <option>Xem nhiều nhất</option>
                            <option>Tải nhiều nhất</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-6">


                    <div
                        class="group bg-white rounded-[2.5rem] border border-slate-100 p-6 shadow-sm hover:shadow-2xl hover:shadow-blue-500/10 hover:-translate-y-1.5 transition-all duration-500">
                        <div class="flex flex-col lg:flex-row items-center gap-8">
                            <div
                                class="w-24 h-24 rounded-[2rem] bg-blue-50 text-blue-500 flex items-center justify-center flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500 shadow-inner">
                                <i class="far fa-file-word text-4xl"></i>
                            </div>

                            <div class="flex-1 text-center lg:text-left">
                                <div class="flex flex-wrap justify-center lg:justify-start items-center gap-3 mb-3">
                                    <span
                                        class="px-4 py-1 rounded-full bg-slate-100 text-slate-500 text-[9px] font-black uppercase tracking-widest">BÀI
                                        TẬP</span>
                                    <span class="text-[10px] font-black uppercase tracking-widest text-blue-600">Cơ sở
                                        dữ liệu</span>
                                </div>
                                <h3
                                    class="text-2xl font-black text-slate-800 group-hover:text-blue-600 transition-colors mb-4 leading-tight">
                                    Bài tập thực hành SQL Server - Chương 4 & 5
                                </h3>
                                <div
                                    class="flex flex-wrap justify-center lg:justify-start items-center gap-x-6 gap-y-2 text-sm text-slate-400 font-semibold">
                                    <span class="flex items-center"><i
                                            class="far fa-user-circle mr-2 text-slate-300"></i> Bởi: <span
                                            class="ml-1 text-green-600">Giảng viên A</span></span>
                                    <span class="flex items-center"><i class="far fa-eye mr-2 text-slate-300"></i> 850
                                        lượt xem</span>
                                    <span class="flex items-center"><i
                                            class="far fa-calendar-alt mr-2 text-slate-300"></i> 12/04/2024</span>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">

                                @guest
                                <a href="{{ route('login') }}" onclick="alert('Vui lòng đăng nhập để tải tài liệu!')"
                                    class="w-full lg:w-auto flex items-center justify-center gap-3 bg-slate-400 hover:bg-slate-500 text-white font-black px-8 py-4 rounded-2xl transition-all shadow-lg">
                                    <i class="fas fa-lock text-sm"></i>
                                    <span class="uppercase text-xs tracking-widest">Đăng nhập để tải</span>
                                </a>
                                @endguest

                                @auth
                                <a href="#"
                                    class="w-full lg:w-auto flex items-center justify-center gap-3 bg-blue-600 hover:bg-blue-700 text-white font-black px-8 py-4 rounded-2xl transition-all shadow-lg shadow-blue-500/30">
                                    <i class="fas fa-cloud-download-alt text-lg"></i>
                                    <span class="uppercase text-xs tracking-widest">Tải xuống</span>
                                </a>

                                @if(auth()->user()->role_id ==2)
                                <div class="flex gap-2 w-full lg:w-auto">
                                    <a href="#" class=" flex-1 lg:flex-none p-4 bg-amber-500 hover:bg-amber-600 text-white
                                        rounded-2xl transition-all shadow-lg shadow-amber-500/20" title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="#" method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài liệu này?')"
                                        class="flex-1 lg:flex-none">

                                        <button type="submit"
                                            class="w-full p-4 bg-red-500 hover:bg-red-600 text-white rounded-2xl transition-all shadow-lg shadow-red-500/20"
                                            title="Xóa tài liệu">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                                @endif
                                @endauth

                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-16 flex items-center justify-center gap-3">
                    <button
                        class="w-12 h-12 rounded-2xl bg-white border border-slate-200 text-slate-400 hover:bg-blue-50 hover:text-blue-600 transition-all flex items-center justify-center"><i
                            class="fas fa-chevron-left"></i></button>
                    <button
                        class="w-12 h-12 rounded-2xl bg-blue-600 text-white font-black shadow-xl shadow-blue-200 flex items-center justify-center">1</button>
                    <button
                        class="w-12 h-12 rounded-2xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-blue-50 transition-all flex items-center justify-center">2</button>
                    <button
                        class="w-12 h-12 rounded-2xl bg-white border border-slate-200 text-slate-400 hover:bg-blue-50 hover:text-blue-600 transition-all flex items-center justify-center"><i
                            class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
// Hero Slider Logic
const slides = document.querySelectorAll('.hero-slide');
let current = 0;
setInterval(() => {
    slides[current].classList.remove('active');
    current = (current + 1) % slides.length;
    slides[current].classList.add('active');
}, 5000);
</script>
@endsection