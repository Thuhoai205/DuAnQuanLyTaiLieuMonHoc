 @extends('layouts.app')

 @section('title', 'Danh mục Khoa')

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
                         <i class="fa-solid fa-building-columns"></i>
                     </div>

                     <h1 class="text-3xl font-black text-cyan-950 tracking-tight">
                         Danh mục Khoa
                     </h1>
                 </div>

                 <p class="text-slate-500 font-medium text-sm pl-[64px] max-w-2xl leading-relaxed">
                     Khám phá các khoa đào tạo trong hệ thống, xem danh sách môn học và tài liệu học tập theo từng khoa.
                 </p>
             </div>

             <div class="flex flex-col lg:flex-row items-stretch lg:items-center gap-4">

                 <!-- SEARCH -->
                 <div class="relative w-full lg:w-72">
                     <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-cyan-600 text-xs"></i>

                     <input type="text" id="facultySearch" onkeyup="searchFaculties()"
                         placeholder="Tìm theo tên khoa..."
                         class="w-full pl-11 pr-4 py-3 bg-white border border-cyan-100 rounded-2xl text-sm font-semibold text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-300 focus:border-cyan-500 transition-all">
                 </div>

                 <!-- FILTER UI TĨNH -->
                 <div class="inline-flex p-1 bg-cyan-50 border border-cyan-100 rounded-2xl text-sm font-bold">
                     <button type="button"
                         class="px-6 py-3 rounded-xl bg-cyan-500 text-white shadow-sm transition-all duration-300">
                         Tất cả
                     </button>

                     <button type="button"
                         class="px-6 py-3 rounded-xl text-cyan-700 hover:bg-white transition-all duration-300">
                         Đang hoạt động
                     </button>
                 </div>
             </div>
         </div>

         <!-- OVERVIEW -->
         <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

             <div class="bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-7">
                 <div class="flex items-center justify-between">
                     <div>
                         <p class="text-sm font-bold text-slate-500">Tổng số khoa</p>
                         <h3 class="text-3xl font-black text-cyan-950 mt-2">6</h3>
                     </div>

                     <div class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                         <i class="fa-solid fa-building-columns text-2xl"></i>
                     </div>
                 </div>
             </div>

             <div class="bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-7">
                 <div class="flex items-center justify-between">
                     <div>
                         <p class="text-sm font-bold text-slate-500">Tổng môn học</p>
                         <h3 class="text-3xl font-black text-cyan-950 mt-2">32</h3>
                     </div>

                     <div class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                         <i class="fa-solid fa-book-open text-2xl"></i>
                     </div>
                 </div>
             </div>

             <div class="bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-7">
                 <div class="flex items-center justify-between">
                     <div>
                         <p class="text-sm font-bold text-slate-500">Tổng tài liệu</p>
                         <h3 class="text-3xl font-black text-cyan-950 mt-2">445</h3>
                     </div>

                     <div class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                         <i class="fa-solid fa-file-lines text-2xl"></i>
                     </div>
                 </div>
             </div>

         </div>

         <!-- GRID -->
         <div id="facultyGrid" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">

             <!-- CARD 1 -->
             <div
                 class="faculty-card group relative bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] hover:shadow-[0_20px_60px_rgba(8,145,178,0.16)] hover:-translate-y-2 transition-all duration-500 overflow-hidden">

                 <div
                     class="absolute -top-10 -right-10 w-32 h-32 bg-cyan-100 rounded-full group-hover:scale-125 transition-transform duration-700">
                 </div>

                 <div class="p-8 relative z-10">
                     <div class="flex items-start justify-between gap-4 mb-6">
                         <div
                             class="w-16 h-16 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center border border-cyan-100 group-hover:bg-cyan-500 group-hover:text-white transition-all">
                             <i class="fa-solid fa-laptop-code text-2xl"></i>
                         </div>

                         <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black">
                             CNTT
                         </span>
                     </div>

                     <h3 class="faculty-name text-xl font-black text-slate-900 group-hover:text-cyan-600 transition">
                         Công nghệ thông tin
                     </h3>

                     <p class="text-slate-500 text-sm mt-3 leading-relaxed min-h-[72px]">
                         Quản lý học liệu các môn về lập trình, cơ sở dữ liệu, mạng máy tính và phát triển phần mềm.
                     </p>

                     <div class="mt-6 grid grid-cols-2 gap-3">
                         <div class="rounded-2xl bg-cyan-50/70 border border-cyan-100 p-4">
                             <p class="text-2xl font-black text-cyan-950">8</p>
                             <p class="text-xs font-bold text-slate-500 mt-1">Môn học</p>
                         </div>

                         <div class="rounded-2xl bg-cyan-50/70 border border-cyan-100 p-4">
                             <p class="text-2xl font-black text-cyan-950">126</p>
                             <p class="text-xs font-bold text-slate-500 mt-1">Tài liệu</p>
                         </div>
                     </div>

                     <div class="mt-6 flex flex-wrap gap-2">
                         <span class="px-3 py-1.5 rounded-full bg-slate-50 text-slate-500 text-xs font-bold">
                             Lập trình Web
                         </span>
                         <span class="px-3 py-1.5 rounded-full bg-slate-50 text-slate-500 text-xs font-bold">
                             CSDL
                         </span>
                         <span class="px-3 py-1.5 rounded-full bg-slate-50 text-slate-500 text-xs font-bold">
                             Java
                         </span>
                     </div>

                     <div class="mt-7 flex items-center justify-between">
                         <span class="text-xs font-black text-cyan-700 uppercase tracking-wider">
                             Đang hoạt động
                         </span>

                         {{-- Công nghệ thông tin --}}
                         <a href="{{ route('faculties.show', 'cntt') }}"
                             class="w-11 h-11 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200 hover:bg-cyan-600 transition">
                             <i class="fa-solid fa-arrow-right"></i>
                         </a>
                     </div>
                 </div>
             </div>


             <!-- CARD 3 -->
             <div
                 class="faculty-card group relative bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] hover:shadow-[0_20px_60px_rgba(8,145,178,0.16)] hover:-translate-y-2 transition-all duration-500 overflow-hidden">

                 <div
                     class="absolute -top-10 -right-10 w-32 h-32 bg-cyan-100 rounded-full group-hover:scale-125 transition-transform duration-700">
                 </div>

                 <div class="p-8 relative z-10">
                     <div class="flex items-start justify-between gap-4 mb-6">
                         <div
                             class="w-16 h-16 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center border border-cyan-100 group-hover:bg-cyan-500 group-hover:text-white transition-all">
                             <i class="fa-solid fa-calculator text-2xl"></i>
                         </div>

                         <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black">
                             KT
                         </span>
                     </div>

                     <h3 class="faculty-name text-xl font-black text-slate-900 group-hover:text-cyan-600 transition">
                         Kế toán
                     </h3>

                     <p class="text-slate-500 text-sm mt-3 leading-relaxed min-h-[72px]">
                         Cung cấp học liệu về nguyên lý kế toán, kế toán tài chính, kiểm toán và phân tích báo cáo.
                     </p>

                     <div class="mt-6 grid grid-cols-2 gap-3">
                         <div class="rounded-2xl bg-cyan-50/70 border border-cyan-100 p-4">
                             <p class="text-2xl font-black text-cyan-950">5</p>
                             <p class="text-xs font-bold text-slate-500 mt-1">Môn học</p>
                         </div>

                         <div class="rounded-2xl bg-cyan-50/70 border border-cyan-100 p-4">
                             <p class="text-2xl font-black text-cyan-950">73</p>
                             <p class="text-xs font-bold text-slate-500 mt-1">Tài liệu</p>
                         </div>
                     </div>

                     <div class="mt-6 flex flex-wrap gap-2">
                         <span class="px-3 py-1.5 rounded-full bg-slate-50 text-slate-500 text-xs font-bold">
                             Kế toán tài chính
                         </span>
                         <span class="px-3 py-1.5 rounded-full bg-slate-50 text-slate-500 text-xs font-bold">
                             Kiểm toán
                         </span>
                     </div>

                     <div class="mt-7 flex items-center justify-between">
                         <span class="text-xs font-black text-cyan-700 uppercase tracking-wider">
                             Đang hoạt động
                         </span>

                         <a href="#"
                             class="w-11 h-11 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200 hover:bg-cyan-600 transition">
                             <i class="fa-solid fa-arrow-right"></i>
                         </a>
                     </div>
                 </div>
             </div>

         </div>

     </section>

 </main>
 @endsection

 @push('scripts')
 <script>
function searchFaculties() {
    const keyword = document.getElementById('facultySearch').value.toLowerCase();
    const cards = document.querySelectorAll('.faculty-card');

    cards.forEach(function(card) {
        const name = card.querySelector('.faculty-name').innerText.toLowerCase();

        if (name.includes(keyword)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}
 </script>
 @endpush