@extends('layouts.app')

@section('title', 'Quản lý học liệu')

@section('content')
<main id="view-course-detail" class="py-12 bg-slate-50 min-h-screen  ">
    <div class="container mx-auto px-4 max-w-6xl">

        <button onclick="window.history.back()"
            class="mt-8 flex items-center text-blue-600 font-bold mb-8 hover:-translate-x-1 transition-transform group ">
            <i
                class="fas fa-arrow-left mr-2 bg-blue-100 p-2 rounded-full group-hover:bg-blue-600 group-hover:text-white transition-all"></i>
            Quay lại danh sách
        </button>

        <div
            class="bg-white/80 backdrop-blur-xl rounded-[2rem] border border-slate-100 shadow-lg p-8 md:p-10 mb-10 relative overflow-hidden">

            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">

                <div class="flex flex-col md:flex-row items-center md:items-start gap-6  md:text-left">

                    <div
                        class="w-20 h-20 bg-gradient-to-br from-blue-600 to-blue-500 rounded-2xl flex items-center justify-center text-3xl text-white shadow-lg">
                        <i class="fas fa-laptop-code"></i>
                    </div>

                    <div>
                        <h1 class="text-3xl md:text-4xl font-black text-slate-900 mb-3">
                            Lập trình Web
                        </h1>

                        <p class="text-slate-500 max-w-xl">
                            Làm chủ các Framework hiện đại như Laravel, ReactJS, VueJS.
                        </p>
                    </div>
                </div>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl font-bold shadow-md transition">
                    + Đăng tài liệu
                </button>

            </div>
        </div>

        <div class="flex items-center justify-between mb-8 gap-6 ">
            <div class="flex  items-center mb-3">

                <h4 class="text-2xl font-extrabold text-slate-800"> Tài liệu môn học (<span id="cd-count"
                        class="text-blue-600">4</span>)</h4>

            </div>
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <div class="relative w-72">
                    <input type="text" id="subjectSearch" onkeyup="searchSubjects()" placeholder="Tìm theo tên..."
                        class=" text-center w-full pl-11 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl 
               text-sm font-medium text-slate-700
               shadow-sm
               focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
               transition-all duration-200">

                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 
              text-slate-400 text-sm transition-colors duration-200"></i>
                </div>

                <!-- SEARCH -->



            </div>
        </div>

        <div class="grid grid-cols-1 gap-5" id="course-files-list">

            <div
                class="group bg-white p-6 rounded-[2rem] border border-slate-100 flex items-center justify-between shadow-sm hover:shadow-xl hover:shadow-blue-500/5 transition-all">
                <div class="flex items-center gap-5">
                    <div class="w-14 h-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center text-xl">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors">
                            Slide
                            Chương 1: Kiến trúc Client-Server</h4>
                        <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mt-1">
                            SLIDE <span class="mx-2 text-slate-200">•</span> Bởi: <span class="text-blue-500">Bạn</span>
                            <span class="mx-2 text-slate-200">•</span> 1200 lượt xem
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="px-6 py-2.5 rounded-xl bg-slate-50 text-slate-600 font-bold text-sm hover:bg-blue-600 hover:text-white transition-all">Tải
                        xuống</button>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-100 text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-100 text-slate-400 hover:text-red-500 hover:bg-red-50 transition-all">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>

            <div
                class="group bg-white p-6 rounded-[2rem] border border-slate-100 flex items-center justify-between shadow-sm hover:shadow-xl hover:shadow-blue-500/5 transition-all">
                <div class="flex items-center gap-5">
                    <div
                        class="w-14 h-14 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center text-xl">
                        <i class="fas fa-file-word"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors">Bài
                            tập
                            thực hành tuần 2: CSS Grid/Flexbox</h4>
                        <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mt-1">
                            BÀI TẬP <span class="mx-2 text-slate-200">•</span> Bởi: <span
                                class="text-blue-500">Bạn</span>
                            <span class="mx-2 text-slate-200">•</span> 850 lượt xem
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button
                        class="px-6 py-2.5 rounded-xl bg-slate-50 text-slate-600 font-bold text-sm hover:bg-blue-600 hover:text-white transition-all">Tải
                        xuống</button>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-100 text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-xl border border-slate-100 text-slate-400 hover:text-red-500 hover:bg-red-50 transition-all">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
</main>

<script>
function openUploadModal() {
    // Logica mở modal tải lên tài liệu ở đây [cite: 36]
    alert('Mở form upload tài liệu mới cho môn học này');
}
</script>
@endsection