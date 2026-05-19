@extends('layouts.app')

@section('title', 'Chi tiết môn học')

@section('content')

<main id="view-course-detail" class="min-h-screen bg-slate-50">

    <!-- HERO -->
    <section class="relative overflow-hidden bg-gradient-to-br from-blue-700 via-blue-600 to-cyan-500 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="absolute -top-24 -left-24 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-300/20 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-14">

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

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                <div class="flex flex-col md:flex-row items-center md:items-start text-center md:text-left gap-6">

                    <div
                        class="w-24 h-24 bg-white/20 backdrop-blur rounded-3xl flex items-center justify-center text-4xl text-white shadow-xl border border-white/20">
                        <i class="fas fa-laptop-code"></i>
                    </div>

                    <div>
                        <p class="text-blue-100 text-sm font-bold uppercase tracking-[0.25em] mb-3">
                            Chi tiết môn học
                        </p>

                        <h1 class="text-4xl md:text-5xl font-black mb-4">
                            Lập trình Web
                        </h1>

                        <p class="text-blue-50 max-w-2xl text-lg leading-relaxed">
                            Làm chủ các Framework hiện đại như Laravel, ReactJS, VueJS.
                        </p>
                    </div>

                </div>

                @if(Auth::check() && Auth::user()->role_id == 2)
                <button onclick="openSubjectUploadModal()" class="inline-flex items-center justify-center gap-2
                    bg-white text-blue-700 px-8 py-4 rounded-2xl font-extrabold shadow-xl hover:-translate-y-1
                    hover:shadow-2xl transition-all">
                    <i class="fas fa-cloud-upload-alt"></i>
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

            <div class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-lg">
                <div
                    class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl mb-4">
                    <i class="fas fa-file-alt"></i>
                </div>
                <p class="text-slate-500 font-bold text-sm">Tổng tài liệu</p>
                <h3 class="text-3xl font-black text-slate-900 mt-1">2</h3>
            </div>

            <div class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-lg">
                <div
                    class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center text-2xl mb-4">
                    <i class="fas fa-download"></i>
                </div>
                <p class="text-slate-500 font-bold text-sm">Lượt tải</p>
                <h3 class="text-3xl font-black text-slate-900 mt-1">980</h3>
            </div>

        </div>
        <!-- TOOLBAR -->
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 mb-8">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <div>
                    <h4 class="text-2xl font-black text-slate-900">
                        Tài liệu môn học
                        <span class="text-blue-600">(2)</span>
                    </h4>
                    <p class="text-slate-500 text-sm mt-2">
                        Danh sách tài liệu, bài tập và slide của môn học.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-4">

                    <div class="relative w-full sm:w-80">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                        <input type="text" id="subjectSearch" onkeyup="searchSubjects()"
                            placeholder="Tìm theo tên tài liệu..."
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-semibold text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>

                    @if(Auth::check() && Auth::user()->role_id == 2)
                    <div class="flex items-center bg-slate-100 border border-slate-200 rounded-2xl p-1 shadow-sm">

                        <button
                            class="filter-btn px-5 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-bold transition-all">
                            Tất cả
                        </button>

                        <button
                            class="filter-btn px-5 py-2.5 rounded-xl text-slate-600 hover:bg-white text-sm font-bold transition-all">
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

                <div class="document-item p-6 hover:bg-slate-50 transition-colors flex items-center gap-5 group"
                    data-owner="mine">
                    <div
                        class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-blue-100">
                        <i class="fas fa-file-word text-2xl"></i>
                        <span class="text-[10px] font-black mt-1">W</span>
                    </div>

                    <div class="flex-grow min-w-0">
                        <h6
                            class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors truncate">
                            Bài tập thực hành tuần 2: CSS Grid/Flexbox
                        </h6>

                        <div class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                            <span><i class="fas fa-book text-slate-400 mr-1.5"></i>Môn: Lập trình Web</span>
                            <span class="text-slate-300">•</span>
                            <span><i class="fas fa-user-graduate text-slate-400 mr-1.5"></i>GV: Bạn</span>
                            <span class="text-slate-300">•</span>
                            <span><i class="fas fa-calendar-check text-slate-400 mr-1.5"></i>Hôm nay</span>
                        </div>
                    </div>

                    <div class="shrink-0 flex items-center gap-2">
                        <button
                            class="px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm">
                            <i class="fas fa-cloud-download-alt"></i> Tải về
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

                <div class="document-item p-6 hover:bg-slate-50 transition-colors flex items-center gap-5 group"
                    data-owner="other">
                    <div
                        class="w-16 h-16 bg-red-50 text-red-500 rounded-2xl flex flex-col items-center justify-center shrink-0 border border-red-100">
                        <i class="fas fa-file-pdf text-2xl"></i>
                        <span class="text-[10px] font-black mt-1">PDF</span>
                    </div>

                    <div class="flex-grow min-w-0">
                        <h6
                            class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors truncate">
                            Slide chương 1: HTML & CSS cơ bản
                        </h6>

                        <div class="flex flex-wrap items-center gap-3 text-slate-500 text-xs mt-2 font-medium">
                            <span><i class="fas fa-book text-slate-400 mr-1.5"></i>Môn: Lập trình Web</span>
                            <span class="text-slate-300">•</span>
                            <span><i class="fas fa-user-graduate text-slate-400 mr-1.5"></i>GV: Nguyễn Văn A</span>
                            <span class="text-slate-300">•</span>
                            <span><i class="fas fa-calendar-check text-slate-400 mr-1.5"></i>Hôm qua</span>
                        </div>
                    </div>

                    <div class="shrink-0">
                        <button
                            class="px-5 py-2.5 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all flex items-center gap-2 text-sm">
                            <i class="fas fa-cloud-download-alt"></i> Tải về
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- PAGINATION -->
        <div class="mt-10 flex justify-end">

            <div class="flex items-center gap-2">

                <button
                    class="w-11 h-11 flex items-center justify-center rounded-2xl bg-white border border-slate-200 text-slate-400 hover:bg-slate-50 transition">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <button
                    class="w-11 h-11 flex items-center justify-center rounded-2xl bg-blue-600 text-white font-bold shadow-md shadow-blue-500/20">
                    1
                </button>

                <button
                    class="w-11 h-11 flex items-center justify-center rounded-2xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-blue-50 hover:text-blue-600 transition">
                    2
                </button>

                <button
                    class="w-11 h-11 flex items-center justify-center rounded-2xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-blue-50 hover:text-blue-600 transition">
                    3
                </button>

                <span class="px-2 text-slate-400 font-bold">...</span>

                <button
                    class="w-11 h-11 flex items-center justify-center rounded-2xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-blue-50 hover:text-blue-600 transition">
                    6
                </button>

                <button
                    class="w-11 h-11 flex items-center justify-center rounded-2xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition">
                    <i class="fas fa-chevron-right"></i>
                </button>

            </div>

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
                    <i class="fas fa-cloud-upload-alt text-base"></i>
                </div>

                <div>
                    <h3 class="text-base font-extrabold text-slate-800 tracking-tight">
                        Upload tài liệu
                    </h3>
                    <p class="text-[11px] text-slate-400 font-semibold mt-0.5">
                        Thêm tài liệu vào môn Lập trình Web
                    </p>
                </div>
            </div>

            <button type="button" onclick="closeSubjectUploadModal()"
                class="w-8 h-8 rounded-full bg-slate-200/60 text-slate-500 hover:bg-red-500 hover:text-white transition-all duration-200 flex items-center justify-center active:scale-90">
                <i class="fas fa-times text-xs"></i>
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
                            <i class="fas fa-file-import text-sm"></i>
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

            <!-- MÔN HỌC + LOẠI HỌC LIỆU -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <!-- MÔN HỌC CỐ ĐỊNH -->
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-1.5">
                        Môn học
                    </label>

                    <div
                        class="w-full h-11 px-4 rounded-xl border border-blue-100 bg-blue-50 text-xs font-bold text-blue-700 flex items-center justify-between">

                        <span class="flex items-center gap-2">
                            <i class="fas fa-laptop-code text-blue-600"></i>
                            Lập trình Web
                        </span>

                        <i class="fas fa-lock text-blue-400 text-[10px]"></i>
                    </div>
                </div>

                <!-- LOẠI HỌC LIỆU -->
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-1.5">
                        Loại học liệu
                    </label>

                    <div class="relative flex items-center">
                        <select name="type"
                            class="w-full h-11 pl-4 pr-10 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-bold text-slate-600 focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all appearance-none cursor-pointer">
                            <option value="slide">Slide bài giảng</option>
                            <option value="exam">Đề thi / Đáp án</option>
                            <option value="assignment">Bài tập về nhà</option>
                            <option value="reference">Tài liệu tham khảo thêm</option>
                        </select>

                        <i
                            class="fas fa-chevron-down text-slate-400 text-[10px] absolute right-4 pointer-events-none"></i>
                    </div>
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
                    <i class="fas fa-trash-alt mr-1"></i>
                    Xóa dữ liệu
                </button>

                <div class="flex items-center gap-2.5">
                    <button type="button" onclick="closeSubjectUploadModal()"
                        class="px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-500 hover:bg-slate-50 active:scale-95 transition-all">
                        Hủy bỏ
                    </button>

                    <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-md shadow-blue-600/10 active:scale-95 transition-all">
                        <i class="fas fa-cloud-upload-alt mr-1"></i>
                        Upload tài liệu
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
<script>
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

    if (form) {
        form.reset();
    }
}


/* SEARCH */
function searchSubjects() {
    let input = document.getElementById('subjectSearch').value.toLowerCase();
    let documents = document.querySelectorAll('.document-item');

    documents.forEach(doc => {
        let title = doc.querySelector('h4').innerText.toLowerCase();
        doc.style.display = title.includes(input) ? 'block' : 'none';
    });
}
</script>

@endsection