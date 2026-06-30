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

             </div>
         </div>

         <!-- OVERVIEW -->
         <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

             <!-- Tổng khoa -->
             <div
                 class="bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] hover:-translate-y-1 hover:shadow-[0_20px_60px_rgba(8,145,178,0.15)] transition-all duration-300 p-7">

                 <div class="flex items-center justify-between">

                     <div>

                         <p class="text-sm font-bold text-slate-500">
                             Tổng số khoa
                         </p>

                         <h3 class="text-4xl font-black text-cyan-950 mt-2">
                             {{ number_format($totalFaculties) }}
                         </h3>

                         <p class="text-xs text-slate-400 mt-2">
                             Khoa đang hoạt động
                         </p>

                     </div>

                     <div class="w-16 h-16 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">

                         <i class="fa-solid fa-building-columns text-2xl"></i>

                     </div>

                 </div>

             </div>

             <!-- Tổng môn học -->
             <div
                 class="bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] hover:-translate-y-1 hover:shadow-[0_20px_60px_rgba(8,145,178,0.15)] transition-all duration-300 p-7">

                 <div class="flex items-center justify-between">

                     <div>

                         <p class="text-sm font-bold text-slate-500">
                             Tổng môn học
                         </p>

                         <h3 class="text-4xl font-black text-cyan-950 mt-2">
                             {{ number_format($totalSubjects) }}
                         </h3>

                         <p class="text-xs text-slate-400 mt-2">
                             Môn học đang sử dụng
                         </p>

                     </div>

                     <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">

                         <i class="fa-solid fa-book-open text-2xl"></i>

                     </div>

                 </div>

             </div>

             <!-- Tổng tài liệu -->
             <div
                 class="bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] hover:-translate-y-1 hover:shadow-[0_20px_60px_rgba(8,145,178,0.15)] transition-all duration-300 p-7">

                 <div class="flex items-center justify-between">

                     <div>

                         <p class="text-sm font-bold text-slate-500">
                             Tổng tài liệu
                         </p>

                         <h3 class="text-4xl font-black text-cyan-950 mt-2">
                             {{ number_format($totalDocuments) }}
                         </h3>

                         <p class="text-xs text-slate-400 mt-2">
                             Tài liệu đang lưu trữ
                         </p>

                     </div>

                     <div class="w-16 h-16 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center">

                         <i class="fa-solid fa-file-lines text-2xl"></i>

                     </div>

                 </div>

             </div>

         </div>
         <!-- GRID -->
         <!-- GRID -->
         <div id="facultyGrid" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">

             @forelse($faculties as $faculty)

             @php
             $documentCount = $faculty->documents_count ?? $faculty->subjects->sum('documents_count');
             @endphp

             <div class="faculty-card group relative
                    bg-white rounded-[2rem] border border-cyan-100
                    shadow-[0_15px_45px_rgba(8,145,178,0.08)]
                    hover:shadow-[0_20px_60px_rgba(8,145,178,0.16)]
                    hover:-translate-y-2
                    transition-all duration-500 overflow-hidden" data-name="{{ strtolower($faculty->faculty_name) }}"
                 data-code="{{ strtolower($faculty->faculty_code) }}">
                 <!-- Background -->
                 <div
                     class="absolute -top-10 -right-10 w-32 h-32 bg-cyan-100 rounded-full group-hover:scale-125 transition-transform duration-700">
                 </div>

                 <div class="p-8 relative z-10">

                     <!-- HEADER -->
                     <div class="flex items-start justify-between mb-6">

                         <div>
                             <span
                                 class="inline-flex items-center px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black uppercase tracking-wide">
                                 {{ $faculty->faculty_code }}
                             </span>
                         </div>

                         <span
                             class="text-xs font-black uppercase tracking-wider {{ $faculty->is_active ? 'text-emerald-600' : 'text-red-500' }}">
                             {{ $faculty->is_active ? 'Hoạt động' : 'Khóa' }}
                         </span>

                     </div>

                     <!-- TÊN KHOA -->
                     <h3
                         class="faculty-name text-2xl font-black text-slate-900 leading-tight group-hover:text-cyan-600 transition">
                         {{ $faculty->faculty_name }}
                     </h3>

                     <!-- MÔ TẢ -->
                     <p class="mt-4 text-sm text-slate-500 leading-7 min-h-[72px]">
                         {{ $faculty->description ?: 'Chưa có mô tả cho khoa này.' }}
                     </p>

                     <!-- THỐNG KÊ -->
                     <div class="mt-7 grid grid-cols-2 gap-4">

                         <div class="rounded-2xl border border-cyan-100 bg-cyan-50/70 p-5">

                             <p class="text-3xl font-black text-cyan-900">
                                 {{ $faculty->subjects_count }}
                             </p>

                             <p class="mt-2 text-xs font-bold uppercase tracking-wide text-slate-500">
                                 Môn học
                             </p>

                         </div>

                         <div class="rounded-2xl border border-cyan-100 bg-cyan-50/70 p-5">

                             <p class="text-3xl font-black text-cyan-900">
                                 {{ $documentCount }}
                             </p>

                             <p class="mt-2 text-xs font-bold uppercase tracking-wide text-slate-500">
                                 Tài liệu
                             </p>

                         </div>

                     </div>


                     <!-- FOOTER -->
                     <div class="mt-8 flex items-center justify-end">

                         <a href="{{ route('faculties.show', $faculty->faculty_id) }}"
                             class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-cyan-500 text-white text-sm font-bold shadow-lg shadow-cyan-200 hover:bg-cyan-600 transition">

                             Xem chi tiết

                             <i class="fa-solid fa-arrow-right text-xs"></i>

                         </a>

                     </div>


                 </div>

             </div>

             @empty

             <div class="col-span-full py-20 text-center">

                 <div class="w-20 h-20 mx-auto rounded-full bg-cyan-50 flex items-center justify-center mb-5">

                     <span class="text-4xl font-black text-cyan-500">
                         0
                     </span>

                 </div>

                 <h3 class="text-lg font-black text-slate-700">
                     Chưa có khoa nào
                 </h3>

                 <p class="mt-2 text-sm text-slate-500">
                     Hiện tại hệ thống chưa có dữ liệu khoa.
                 </p>

             </div>

             @endforelse
             <!-- THÔNG BÁO KHÔNG TÌM THẤY -->
             <div id="noFacultyResult" class="hidden py-16 text-center">

                 <div class="w-20 h-20 mx-auto rounded-full bg-cyan-50 flex items-center justify-center">
                     <i class="fa-solid fa-magnifying-glass text-3xl text-cyan-500"></i>
                 </div>

                 <h3 class="mt-5 text-lg font-black text-slate-700">
                     Không tìm thấy khoa
                 </h3>

                 <p class="mt-2 text-sm text-slate-500">
                     Không có khoa nào phù hợp với từ khóa tìm kiếm.
                 </p>

             </div>

     </section>

 </main>
 @endsection

 @push('scripts')
 <script>
function searchFaculties() {

    const keyword = document
        .getElementById('facultySearch')
        .value
        .trim()
        .toLowerCase();

    const cards = document.querySelectorAll('.faculty-card');

    let visible = 0;

    cards.forEach(card => {

        const name = card.dataset.name;
        const code = card.dataset.code;

        if (
            name.includes(keyword) ||
            code.includes(keyword)
        ) {

            card.style.display = "";

            visible++;

        } else {

            card.style.display = "none";

        }

    });

    document
        .getElementById('noFacultyResult')
        .classList.toggle('hidden', visible > 0);

}
 </script>
 @endpush