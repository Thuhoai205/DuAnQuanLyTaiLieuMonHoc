 @extends('layouts.app')

 @section('title', 'Chi tiết môn học')

 @section('content')

 @php
 /*
 Vì bạn đang làm giao diện tĩnh nên để dữ liệu mẫu ở đây.
 Sau này có database thì thay bằng dữ liệu từ controller/model.
 */
 $subjectInfo = [
 'code' => 'WEB101',
 'name' => 'Lập trình Web',
 'description' => 'Làm chủ các framework hiện đại như Laravel, ReactJS, VueJS.',
 'teacher' => 'ThS. Trần Văn B',
 'documents' => 2,
 'downloads' => 980,
 ];

 $facultyInfo = [
 'code' => 'CNTT',
 'name' => 'Công nghệ thông tin',
 'description' => 'Khoa Công nghệ thông tin phụ trách các môn học liên quan đến lập trình, cơ sở dữ liệu, mạng máy tính
 và phát triển phần mềm.',
 'subjects' => 8,
 'documents' => 126,
 ];

 $user = auth()->user();

 /*
 Tạm thời giao diện:
 - Admin được upload tất cả môn
 - Giảng viên được xem như đang phụ trách môn này
 Sau này làm thật thì kiểm tra bảng subject_teachers.
 */
 $isAdmin = $user && (int) $user->role_id === 1;
 $isTeacherInCharge = $user && (int) $user->role_id === 2;

 $canUploadDocument = $isAdmin || $isTeacherInCharge;
 @endphp

 <main id="view-course-detail" class="min-h-screen bg-[#EAFBFF]">
     <!-- HERO -->
     <section class="relative overflow-hidden bg-[#0891B2] text-white">
         <div class="absolute inset-0 opacity-20">
             <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?q=80&w=1600"
                 class="w-full h-full object-cover">
         </div>

         <div class="absolute inset-0 bg-[#0891B2]/90"></div>

         <div class="relative max-w-7xl mx-auto px-6 py-16">

             <a href="javascript:history.back()"
                 class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-cyan-700/70 border border-cyan-300/30 text-cyan-50 text-xs font-black uppercase tracking-wider hover:bg-cyan-600 transition mb-8">
                 <i class="fa-solid fa-arrow-left"></i>
                 Quay lại
             </a>

             <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                 <div class="flex items-center gap-6">
                     <div
                         class="w-24 h-24 rounded-[28px] bg-cyan-300 text-cyan-950 flex items-center justify-center shadow-2xl">
                         <i class="fa-solid fa-laptop-code text-4xl"></i>
                     </div>

                     <div>
                         <p class="text-cyan-100 text-sm font-black uppercase tracking-[0.25em] mb-3">
                             Chi tiết môn học
                         </p>

                         <h1 class="text-4xl md:text-5xl font-black">
                             {{ $subjectInfo['name'] }}
                         </h1>

                         <p class="text-cyan-50/90 mt-4 text-lg max-w-2xl">
                             {{ $subjectInfo['description'] }}
                         </p>
                     </div>
                 </div>

                 @if($canUploadDocument)
                 <button type="button" onclick="openSubjectUploadModal()"
                     class="inline-flex items-center justify-center gap-2 px-7 py-4 rounded-2xl bg-cyan-300 text-cyan-950 font-black hover:bg-cyan-200 shadow-xl transition">
                     <i class="fa-solid fa-cloud-arrow-up"></i>
                     Đăng tài liệu
                 </button>
                 @endif

             </div>
         </div>
     </section>

     <!-- CONTENT -->
     <section class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-12">

         <!-- STATS -->
         <div class="grid grid-cols-1 md:grid-cols-2 gap-5 -mt-24 relative z-10 mb-10">

             <div class="bg-white rounded-[2rem] p-6 border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
                 <div
                     class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-2xl mb-4">
                     <i class="fa-solid fa-file-lines"></i>
                 </div>
                 <p class="text-slate-500 font-bold text-sm">Tổng tài liệu</p>
                 <h3 class="text-3xl font-black text-cyan-600 mt-1">
                     {{ $subjectInfo['documents'] }}
                 </h3>
             </div>

             <div class="bg-white rounded-[2rem] p-6 border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
                 <div
                     class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-2xl mb-4">
                     <i class="fa-solid fa-download"></i>
                 </div>
                 <p class="text-slate-500 font-bold text-sm">Lượt tải</p>
                 <h3 class="text-3xl font-black text-cyan-600 mt-1">
                     {{ $subjectInfo['downloads'] }}
                 </h3>
             </div>

         </div>

         <!-- FACULTY INFO -->
         <div class="bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-6 mb-8">
             <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                 <div class="flex items-start gap-5">
                     <div
                         class="w-16 h-16 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-2xl shrink-0 border border-cyan-100">
                         <i class="fa-solid fa-building-columns"></i>
                     </div>

                     <div>
                         <p class="text-cyan-600 text-xs font-black uppercase tracking-[0.25em] mb-2">
                             Thông tin khoa
                         </p>

                         <h3 class="text-2xl font-black text-slate-900">
                             Khoa {{ $facultyInfo['name'] }}
                         </h3>

                         <p class="text-slate-500 text-sm mt-3 leading-relaxed max-w-3xl">
                             {{ $facultyInfo['description'] }}
                         </p>
                     </div>
                 </div>

                 <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 lg:min-w-[420px]">
                     <div class="rounded-2xl bg-cyan-50/70 border border-cyan-100 p-4">
                         <p class="text-xs font-bold text-slate-500">Mã khoa</p>
                         <h4 class="text-xl font-black text-cyan-600 mt-1">
                             {{ $facultyInfo['code'] }}
                         </h4>
                     </div>

                     <div class="rounded-2xl bg-cyan-50/70 border border-cyan-100 p-4">
                         <p class="text-xs font-bold text-slate-500">Môn học</p>
                         <h4 class="text-xl font-black text-cyan-600 mt-1">
                             {{ $facultyInfo['subjects'] }}
                         </h4>
                     </div>

                     <div class="rounded-2xl bg-cyan-50/70 border border-cyan-100 p-4">
                         <p class="text-xs font-bold text-slate-500">Tài liệu</p>
                         <h4 class="text-xl font-black text-cyan-600 mt-1">
                             {{ $facultyInfo['documents'] }}
                         </h4>
                     </div>
                 </div>

             </div>

             <div
                 class="mt-5 pt-5 border-t border-cyan-100 flex flex-wrap items-center gap-3 text-sm font-semibold text-slate-500">


                 <span class="text-slate-300">•</span>

                 <span>
                     <i class="fa-solid fa-book text-cyan-600 mr-1.5"></i>
                     Môn hiện tại: {{ $subjectInfo['name'] }}
                 </span>

                 <span class="text-slate-300">•</span>

                 <span>
                     <i class="fa-solid fa-barcode text-cyan-600 mr-1.5"></i>
                     Mã môn: {{ $subjectInfo['code'] }}
                 </span>
             </div>
         </div>

         <!-- TOOLBAR -->
         <div class="bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-6 mb-8">

             <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                 <div>
                     <h4 class="text-2xl font-black text-slate-900">
                         Tài liệu môn học
                         <span class="text-cyan-600">({{ $subjectInfo['documents'] }})</span>
                     </h4>
                     <p class="text-slate-500 text-sm mt-2">
                         Danh sách tài liệu, bài tập và slide của môn học.
                     </p>
                 </div>

                 <div class="flex flex-col sm:flex-row items-center gap-4">

                     <div class="relative w-full sm:w-80">
                         <i
                             class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-cyan-600 text-sm"></i>

                         <input type="text" id="subjectSearch" onkeyup="searchSubjects()"
                             placeholder="Tìm theo tên tài liệu..."
                             class="w-full pl-11 pr-4 py-3 bg-cyan-50 border border-cyan-100 rounded-2xl text-sm font-semibold text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-300 focus:border-cyan-500 transition-all">
                     </div>

                     @if($canUploadDocument)
                     <div class="flex items-center bg-cyan-50 border border-cyan-100 rounded-2xl p-1 shadow-sm">

                         <button type="button"
                             class="filter-btn px-5 py-2.5 rounded-xl bg-cyan-500 text-white text-sm font-bold transition-all">
                             Tất cả
                         </button>

                         <button type="button"
                             class="filter-btn px-5 py-2.5 rounded-xl text-cyan-700 hover:bg-white text-sm font-bold transition-all">
                             Của tôi
                         </button>

                     </div>
                     @endif
                 </div>

             </div>

         </div>

         <!-- DOCUMENT LIST -->
         <div id="course-files-list" class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
             <div class="divide-y divide-slate-100">

                 <div class="document-item p-6 hover:bg-cyan-50/60 transition-colors flex items-center gap-5 group">
                     <div
                         class="w-16 h-16 bg-red-50 text-red-500 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-red-100">
                         <i class="fa-solid fa-file-pdf text-2xl"></i>
                     </div>

                     <a href="{{ route('documents.show', 1) }}" class="flex-grow min-w-0">
                         <h6
                             class="document-title font-bold text-slate-800 text-lg group-hover:text-cyan-600 transition-colors truncate">
                             Slide Bài 1: Tổng quan về Laravel Framework
                         </h6>

                         <div class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                             <span>
                                 <i class="fa-solid fa-book text-cyan-600 mr-1.5"></i>
                                 Môn: {{ $subjectInfo['name'] }}
                             </span>
                             <span class="text-slate-300">•</span>
                             <span>
                                 <i class="fa-solid fa-building-columns text-cyan-600 mr-1.5"></i>
                                 Khoa: {{ $facultyInfo['code'] }}
                             </span>
                             <span class="text-slate-300">•</span>
                             <span>
                                 <i class="fa-solid fa-user-graduate text-cyan-600 mr-1.5"></i>
                                 GV: {{ $subjectInfo['teacher'] }}
                             </span>
                             <span class="text-slate-300">•</span>
                             <span>
                                 <i class="fa-solid fa-calendar-check text-cyan-600 mr-1.5"></i>
                                 Hôm nay
                             </span>
                         </div>
                     </a>

                     <div class="shrink-0 flex items-center gap-2">
                         @if(auth()->check())
                         <button type="button"
                             class="px-5 py-2.5 bg-cyan-500 text-white font-bold rounded-xl hover:bg-cyan-600 transition-all flex items-center gap-2 text-sm shadow-lg shadow-cyan-200">
                             <i class="fa-solid fa-cloud-arrow-down"></i>
                             Tải về
                         </button>
                         @else
                         <button type="button" onclick="showLoginRequiredModal()"
                             class="px-5 py-2.5 border-2 border-cyan-100 text-cyan-700 font-bold rounded-xl hover:bg-cyan-50 transition-all flex items-center gap-2 text-sm">
                             <i class="fa-solid fa-lock"></i>
                             Đăng nhập để tải
                         </button>
                         @endif

                         @if($canUploadDocument)
                         <a href="{{ route('documents.edit', 1) }}"
                             class="w-10 h-10 flex items-center justify-center text-amber-500 hover:bg-amber-500 hover:text-white rounded-xl transition-all duration-300 shadow-sm bg-white border border-amber-100"
                             title="Sửa">
                             <i class="fa-solid fa-pen-to-square text-sm"></i>
                         </a>

                         <button type="button"
                             class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition flex items-center justify-center">
                             <i class="fa-solid fa-trash"></i>
                         </button>
                         @endif
                     </div>
                 </div>

             </div>
         </div>

         <!-- PAGINATION -->
         <div class="mt-10 flex items-center justify-center gap-2">
             <button type="button"
                 class="w-11 h-11 rounded-2xl bg-white border border-cyan-100 text-slate-400 hover:bg-cyan-50">
                 <i class="fa-solid fa-chevron-left"></i>
             </button>

             <button type="button"
                 class="w-11 h-11 rounded-2xl bg-cyan-500 text-white font-bold shadow-lg shadow-cyan-200">
                 1
             </button>

             <button type="button"
                 class="w-11 h-11 rounded-2xl bg-white border border-cyan-100 text-slate-600 font-bold hover:bg-cyan-50">
                 2
             </button>

             <button type="button"
                 class="w-11 h-11 rounded-2xl bg-white border border-cyan-100 text-slate-600 hover:bg-cyan-50">
                 <i class="fa-solid fa-chevron-right"></i>
             </button>
         </div>

     </section>
 </main>

 <!-- UPLOAD MODAL UI - TRANG CHI TIẾT MÔN -->
 <div id="subjectUploadModal"
     class="fixed inset-0 z-[999] hidden items-center justify-center bg-slate-950/40 backdrop-blur-[4px] px-4 transition-all duration-300">

     <div
         class="relative w-full max-w-xl bg-white rounded-[1.5rem] border border-slate-100 shadow-[0_25px_60px_-15px_rgba(15,23,42,0.15)] overflow-hidden animate-fadeIn">

         <!-- HEADER -->
         <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/60">
             <div class="flex items-center gap-3">
                 <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-sm">
                     <i class="fa-solid fa-cloud-arrow-up text-base"></i>
                 </div>

                 <div>
                     <h3 class="text-base font-extrabold text-slate-800 tracking-tight">
                         Upload tài liệu
                     </h3>
                     <p class="text-[11px] text-slate-400 font-semibold mt-0.5">
                         Thêm tài liệu vào môn {{ $subjectInfo['name'] }}
                     </p>
                 </div>
             </div>

             <button type="button" onclick="closeSubjectUploadModal()"
                 class="w-8 h-8 rounded-full bg-slate-200/60 text-slate-500 hover:bg-red-500 hover:text-white transition-all duration-200 flex items-center justify-center active:scale-90">
                 <i class="fa-solid fa-xmark text-xs"></i>
             </button>
         </div>

         <!-- FORM -->
         <form action="#" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
             @csrf

             <!-- FILE -->
             <div>
                 <label
                     class="group relative flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-200 hover:border-blue-400 bg-slate-50/50 hover:bg-blue-50/20 rounded-xl cursor-pointer transition-all duration-200">

                     <input type="file" name="file" id="subjectFileInput" class="hidden"
                         onchange="updateSubjectFileName(this)">

                     <div class="flex flex-col items-center justify-center pt-4 pb-3 text-center px-4">
                         <div
                             class="w-9 h-9 rounded-lg bg-blue-600 text-white flex items-center justify-center mb-2 shadow-md shadow-blue-500/10 group-hover:scale-110 transition-transform">
                             <i class="fa-solid fa-file-arrow-up text-sm"></i>
                         </div>

                         <p id="subjectUploadPrompt" class="text-xs font-bold text-slate-700">
                             Kéo thả file hoặc
                             <span class="text-blue-600 group-hover:underline">click để chọn</span>
                         </p>

                         <p id="subjectFileTypesHint" class="text-[10px] text-slate-400 font-semibold mt-1">
                             PDF, DOCX, PPTX (Tối đa 50MB)
                         </p>
                     </div>
                 </label>
             </div>

             <!-- TÊN TÀI LIỆU -->
             <div>
                 <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-1.5">
                     Tên tài liệu
                 </label>

                 <input type="text" name="title" placeholder="Nhập tên chi tiết của tài liệu..."
                     class="w-full h-11 px-4 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-semibold text-slate-700 placeholder-slate-400 focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all">
             </div>

             <!-- KHOA + MÔN HỌC -->
             <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                 <!-- KHOA CỐ ĐỊNH -->
                 <div>
                     <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-1.5">
                         Khoa
                     </label>

                     <div
                         class="w-full h-11 px-4 rounded-xl border border-blue-100 bg-blue-50 text-xs font-bold text-blue-700 flex items-center justify-between">

                         <span class="flex items-center gap-2">
                             <i class="fa-solid fa-building-columns text-blue-600"></i>
                             {{ $facultyInfo['name'] }}
                         </span>

                         <i class="fa-solid fa-lock text-blue-400 text-[10px]"></i>
                     </div>
                 </div>

                 <!-- MÔN HỌC CỐ ĐỊNH -->
                 <div>
                     <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-1.5">
                         Môn học
                     </label>

                     <div
                         class="w-full h-11 px-4 rounded-xl border border-blue-100 bg-blue-50 text-xs font-bold text-blue-700 flex items-center justify-between">

                         <span class="flex items-center gap-2">
                             <i class="fa-solid fa-laptop-code text-blue-600"></i>
                             {{ $subjectInfo['name'] }}
                         </span>

                         <i class="fa-solid fa-lock text-blue-400 text-[10px]"></i>
                     </div>
                 </div>
             </div>

             <!-- LOẠI HỌC LIỆU -->
             <div>
                 <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-1.5">
                     Loại học liệu
                 </label>

                 <div class="relative flex items-center">
                     <select name="document_type"
                         class="w-full h-11 pl-4 pr-10 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-bold text-slate-600 focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all appearance-none cursor-pointer">
                         <option value="slide">Slide bài giảng</option>
                         <option value="exam">Đề thi / Đáp án</option>
                         <option value="assignment">Bài tập về nhà</option>
                         <option value="reference">Tài liệu tham khảo thêm</option>
                     </select>

                     <i
                         class="fa-solid fa-chevron-down text-slate-400 text-[10px] absolute right-4 pointer-events-none"></i>
                 </div>
             </div>

             <!-- MÔ TẢ -->
             <div>
                 <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-1.5">
                     Mô tả tài liệu
                 </label>

                 <textarea name="description" rows="2"
                     placeholder="Nhập tóm tắt nội dung tài liệu để người học dễ tìm kiếm..."
                     class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-semibold text-slate-700 placeholder-slate-400 resize-none focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all"></textarea>
             </div>

             <!-- ACTION -->
             <div class="flex items-center justify-between gap-2.5 pt-3 border-t border-slate-100">

                 <button type="button" onclick="resetSubjectUploadModal()"
                     class="px-4 py-2.5 rounded-xl bg-red-50 text-red-500 text-xs font-bold hover:bg-red-500 hover:text-white active:scale-95 transition-all">
                     <i class="fa-solid fa-trash-can mr-1"></i>
                     Xóa dữ liệu
                 </button>

                 <div class="flex items-center gap-2.5">
                     <button type="button" onclick="closeSubjectUploadModal()"
                         class="px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-500 hover:bg-slate-50 active:scale-95 transition-all">
                         Hủy bỏ
                     </button>

                     <button type="submit"
                         class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-md shadow-blue-600/10 active:scale-95 transition-all">
                         <i class="fa-solid fa-cloud-arrow-up mr-1"></i>
                         Upload tài liệu
                     </button>
                 </div>

             </div>
         </form>
     </div>
 </div>

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
             <button type="button" onclick="closeLoginRequiredModal()"
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

 @push('scripts')
 <script>
function showLoginRequiredModal() {
    const modal = document.getElementById('loginRequiredModal');

    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
}

function closeLoginRequiredModal() {
    const modal = document.getElementById('loginRequiredModal');

    if (modal) {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

function openSubjectUploadModal() {
    const modal = document.getElementById('subjectUploadModal');

    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
}

function closeSubjectUploadModal() {
    const modal = document.getElementById('subjectUploadModal');

    if (modal) {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        resetSubjectUploadModal();
    }
}

function resetSubjectUploadModal() {
    const modal = document.getElementById('subjectUploadModal');
    const form = modal ? modal.querySelector('form') : null;
    const prompt = document.getElementById('subjectUploadPrompt');
    const hint = document.getElementById('subjectFileTypesHint');

    if (form) {
        form.reset();
    }

    if (prompt) {
        prompt.innerHTML = 'Kéo thả file hoặc <span class="text-blue-600 group-hover:underline">click để chọn</span>';
    }

    if (hint) {
        hint.innerText = 'PDF, DOCX, PPTX (Tối đa 50MB)';
    }
}

function updateSubjectFileName(input) {
    const prompt = document.getElementById('subjectUploadPrompt');
    const hint = document.getElementById('subjectFileTypesHint');

    if (input.files && input.files.length > 0) {
        const file = input.files[0];

        if (prompt) {
            prompt.innerText = file.name;
        }

        if (hint) {
            const sizeMB = (file.size / 1024 / 1024).toFixed(2);
            hint.innerText = 'Dung lượng: ' + sizeMB + ' MB';
        }
    }
}

/* SEARCH */
function searchSubjects() {
    const input = document.getElementById('subjectSearch');
    const keyword = input ? input.value.toLowerCase() : '';
    const documents = document.querySelectorAll('.document-item');

    documents.forEach(function(doc) {
        const title = doc.querySelector('.document-title');
        const titleText = title ? title.innerText.toLowerCase() : '';

        if (titleText.includes(keyword)) {
            doc.style.display = '';
        } else {
            doc.style.display = 'none';
        }
    });
}
 </script>
 @endpush