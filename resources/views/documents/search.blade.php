@extends('layouts.app')

@section('title', 'Kết quả tìm kiếm')

@section('content')

<main class="min-h-screen bg-slate-50">

    <!-- HEADER SEARCH -->
    <section class="bg-gradient-to-br from-blue-700 via-blue-600 to-cyan-500 text-white py-14">
        <div class="max-w-7xl mx-auto px-6">

            <a href="{{ url('/home') }}"
                class="inline-flex items-center gap-2 mb-8 px-5 py-2.5 bg-white/15 hover:bg-white/25 rounded-full text-sm font-bold transition">
                <i class="fas fa-arrow-left"></i>
                Quay lại trang chủ
            </a>

            <h1 class="text-4xl md:text-5xl font-black mb-4">
                Kết quả tìm kiếm
            </h1>

            <p class="text-blue-100 text-lg">
                Tìm thấy tài liệu phù hợp với từ khóa của bạn.
            </p>

            <!-- SEARCH BAR -->
            <div class="mt-8 bg-white rounded-3xl p-3 shadow-xl flex flex-col md:flex-row gap-3">
                <div class="relative flex-1">
                    <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" placeholder="Nhập tên tài liệu, đề thi hoặc từ khóa..."
                        class="w-full h-14 pl-14 pr-4 rounded-2xl bg-slate-50 text-slate-700 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                </div>

                <select class="h-14 px-5 rounded-2xl bg-slate-50 text-slate-700 font-bold focus:outline-none">
                    <option>Tất cả môn học</option>
                    <option>Lập trình Web</option>
                    <option>Cơ sở dữ liệu</option>
                    <option>Mạng máy tính</option>
                </select>

                <button
                    class="h-14 px-8 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-black tracking-widest transition">
                    TÌM KIẾM
                </button>
            </div>

        </div>
    </section>

    <!-- CONTENT -->
    <section class="max-w-7xl mx-auto px-6 py-10">

        <div class="flex flex-col lg:flex-row gap-8">

            <!-- FILTER SIDEBAR -->
            <aside class="lg:w-72">
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm sticky top-24">

                    <h3 class="text-lg font-black text-slate-900 mb-5">
                        Bộ lọc tìm kiếm
                    </h3>

                    <div class="mb-6">
                        <p class="text-xs font-black uppercase text-slate-400 mb-3">
                            Loại tài liệu
                        </p>

                        <div class="space-y-3 text-sm font-semibold text-slate-600">
                            <label class="flex items-center gap-3">
                                <input type="checkbox" checked class="accent-blue-600">
                                Slide bài giảng
                            </label>

                            <label class="flex items-center gap-3">
                                <input type="checkbox" class="accent-blue-600">
                                Bài tập
                            </label>

                            <label class="flex items-center gap-3">
                                <input type="checkbox" class="accent-blue-600">
                                Đề thi
                            </label>

                            <label class="flex items-center gap-3">
                                <input type="checkbox" class="accent-blue-600">
                                Tài liệu tham khảo
                            </label>
                        </div>
                    </div>


                </div>
            </aside>

            <!-- RESULT LIST -->
            <div class="flex-1">

                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-black text-slate-900">
                            Danh sách tài liệu
                        </h2>
                        <p class="text-slate-500 text-sm mt-1">
                            Hiển thị 12 kết quả phù hợp
                        </p>
                    </div>

                    <select
                        class="px-4 py-3 rounded-2xl bg-white border border-slate-200 text-sm font-bold text-slate-600">
                        <option>Mới nhất</option>
                        <option>Lượt tải nhiều nhất</option>
                        <option>Lượt xem nhiều nhất</option>
                    </select>
                </div>

                <div class="space-y-5">

                    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="divide-y divide-slate-100">

                            <!-- ITEM 1 -->
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

                                    <div
                                        class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                                        <span class="flex items-center">
                                            <i class="fas fa-book text-slate-400 mr-1.5"></i>
                                            Môn: Lập trình Web
                                        </span>

                                        <span class="text-slate-300">•</span>

                                        <span class="flex items-center">
                                            <i class="fas fa-user-graduate text-slate-400 mr-1.5"></i>
                                            GV: ThS. Trần Văn B
                                        </span>

                                        <span class="text-slate-300">•</span>

                                        <span class="flex items-center">
                                            <i class="fas fa-calendar-check text-slate-400 mr-1.5"></i>
                                            Hôm nay
                                        </span>
                                    </div>
                                </div>

                                <div class="shrink-0 flex items-center gap-2">

                                    @if(Auth::check())

                                    <button
                                        class="px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm shadow-sm shadow-blue-100">
                                        <i class="fas fa-cloud-download-alt"></i>
                                        Tải về
                                    </button>

                                    @else

                                    <button onclick="showLoginRequiredModal()"
                                        class="px-5 py-2.5 border-2 border-slate-300 text-slate-500 font-bold rounded-xl hover:border-blue-500 hover:text-blue-600 transition-all flex items-center gap-2 text-sm">
                                        <i class="fas fa-lock"></i>
                                        Đăng nhập để tải
                                    </button>

                                    @endif

                                    @if(Auth::check() && Auth::user()->role_id == 2)
                                    <button
                                        class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 hover:bg-amber-500 hover:text-white transition flex items-center justify-center">
                                        <i class="fas fa-pen"></i>
                                    </button>

                                    <button
                                        class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition flex items-center justify-center">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif

                                </div>

                            </div>

                            <!-- ITEM 2 -->
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

                                    <div
                                        class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                                        <span class="flex items-center">
                                            <i class="fas fa-book text-slate-400 mr-1.5"></i>
                                            Môn: Cơ sở dữ liệu
                                        </span>

                                        <span class="text-slate-300">•</span>

                                        <span class="flex items-center">
                                            <i class="fas fa-user-graduate text-slate-400 mr-1.5"></i>
                                            GV: TS. Lê Thị C
                                        </span>

                                        <span class="text-slate-300">•</span>

                                        <span class="flex items-center">
                                            <i class="fas fa-calendar-check text-slate-400 mr-1.5"></i>
                                            Hôm qua
                                        </span>
                                    </div>
                                </div>

                                <div class="shrink-0 flex items-center gap-2">
                                    @if(Auth::check())

                                    <button
                                        class="px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm shadow-sm shadow-blue-100">
                                        <i class="fas fa-cloud-download-alt"></i>
                                        Tải về
                                    </button>

                                    @else

                                    <button onclick="showLoginRequiredModal()"
                                        class="px-5 py-2.5 border-2 border-slate-300 text-slate-500 font-bold rounded-xl hover:border-blue-500 hover:text-blue-600 transition-all flex items-center gap-2 text-sm">
                                        <i class="fas fa-lock"></i>
                                        Đăng nhập để tải
                                    </button>

                                    @endif
                                    </button>

                                    @if(Auth::check() && Auth::user()->role_id == 2)
                                    <button
                                        class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 hover:bg-amber-500 hover:text-white transition flex items-center justify-center">
                                        <i class="fas fa-pen"></i>
                                    </button>

                                    <button
                                        class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition flex items-center justify-center">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif

                                </div>

                            </div>

                            <!-- ITEM 3 -->
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

                                    <div
                                        class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                                        <span class="flex items-center">
                                            <i class="fas fa-book text-slate-400 mr-1.5"></i>
                                            Môn: Mạng máy tính
                                        </span>

                                        <span class="text-slate-300">•</span>

                                        <span class="flex items-center">
                                            <i class="fas fa-user-graduate text-slate-400 mr-1.5"></i>
                                            GV: Phạm Văn D
                                        </span>

                                        <span class="text-slate-300">•</span>

                                        <span class="flex items-center">
                                            <i class="fas fa-calendar-check text-slate-400 mr-1.5"></i>
                                            2 ngày trước
                                        </span>
                                    </div>
                                </div>

                                <div class="shrink-0 flex items-center gap-2">

                                    @if(Auth::check())

                                    <button
                                        class="px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm shadow-sm shadow-blue-100">
                                        <i class="fas fa-cloud-download-alt"></i>
                                        Tải về
                                    </button>

                                    @else

                                    <button onclick="showLoginRequiredModal()"
                                        class="px-5 py-2.5 border-2 border-slate-300 text-slate-500 font-bold rounded-xl hover:border-blue-500 hover:text-blue-600 transition-all flex items-center gap-2 text-sm">
                                        <i class="fas fa-lock"></i>
                                        Đăng nhập để tải
                                    </button>

                                    @endif
                                    @if(Auth::check() && Auth::user()->role_id == 2)
                                    <button
                                        class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 hover:bg-amber-500 hover:text-white transition flex items-center justify-center">
                                        <i class="fas fa-pen"></i>
                                    </button>

                                    <button
                                        class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition flex items-center justify-center">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif

                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- PAGINATION -->
                <div class="mt-10 flex items-center justify-center gap-2">
                    <button class="w-11 h-11 rounded-2xl bg-white border text-slate-400">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <button class="w-11 h-11 rounded-2xl bg-blue-600 text-white font-bold">
                        1
                    </button>

                    <button class="w-11 h-11 rounded-2xl bg-white border text-slate-600 font-bold">
                        2
                    </button>

                    <button class="w-11 h-11 rounded-2xl bg-white border text-slate-600 font-bold">
                        3
                    </button>

                    <button class="w-11 h-11 rounded-2xl bg-white border text-slate-600">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

            </div>

        </div>

    </section>

</main>
<!-- LOGIN REQUIRED MODAL -->
<div id="loginRequiredModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/40 backdrop-blur-sm px-4">

    <div class="w-full max-w-md bg-white rounded-3xl p-8 text-center shadow-2xl">

        <div
            class="w-20 h-20 mx-auto rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-3xl mb-5">
            <i class="fas fa-lock"></i>
        </div>

        <h3 class="text-2xl font-black text-slate-900 mb-3">
            Yêu cầu đăng nhập
        </h3>

        <p class="text-slate-500 leading-relaxed mb-6">
            Bạn cần đăng nhập để tải tài liệu học tập.
        </p>

        <div class="flex items-center justify-center gap-3">

            <button onclick="closeLoginRequiredModal()"
                class="px-5 py-3 rounded-2xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition">
                Đóng
            </button>

            <a href="{{ route('login') }}"
                class="px-6 py-3 rounded-2xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition">
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
</script>