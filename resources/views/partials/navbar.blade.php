@php
$currentUser = auth()->user();
$roleId = $currentUser?->role_id;

$roleName = match ($roleId) {
1 => 'Quản trị viên',
2 => 'Giảng viên',
3 => 'Sinh viên',
default => 'Người dùng',
};

$canUploadDocument = in_array($roleId, [1, 2]);

$facultyUrl = \Illuminate\Support\Facades\Route::has('faculties.index')
? route('faculties.index')
: url('/faculties');

$subjectUrl = \Illuminate\Support\Facades\Route::has('subjects.index')
? route('subjects.index')
: url('/subjects');

$documentUrl = \Illuminate\Support\Facades\Route::has('documents.index')
? route('documents.index')
: url('/documents');
@endphp

<nav
    class="sticky top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-cyan-100 shadow-[0_8px_30px_rgba(8,145,178,0.06)]">
    <div class="max-w-7xl mx-auto px-4 lg:px-6">
        <div class="h-20 flex items-center justify-between">

            <!-- LOGO -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div
                    class="w-12 h-12 rounded-[18px] bg-gradient-to-br from-cyan-400 via-cyan-500 to-sky-600 text-white flex items-center justify-center shadow-lg shadow-cyan-500/25 ring-1 ring-white/10 group-hover:scale-105 transition-all duration-300">
                    <i class="fa-solid fa-graduation-cap text-xl"></i>
                </div>
                <div class="leading-tight">
                    <h1 class="text-2xl font-black tracking-tight">
                        <span class="text-slate-900">EDU</span><span class="text-cyan-600">DOC</span>
                    </h1>

                    <p class="text-[10px] font-bold uppercase tracking-[0.25em] text-slate-400">
                        Learning Resources
                    </p>
                </div>
            </a>

            <!-- MAIN MENU -->
            <div class="hidden lg:flex items-center gap-2">
                <a href="{{ route('home') }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-bold transition
                    {{ request()->routeIs('home') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-600 hover:bg-cyan-50 hover:text-cyan-600' }}">
                    <i class="fa-solid fa-house mr-2"></i>
                    Trang chủ
                </a>

                <a href="{{ $facultyUrl }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-bold transition
                    {{ request()->is('faculties*') || request()->is('khoa*') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-600 hover:bg-cyan-50 hover:text-cyan-600' }}">
                    <i class="fa-solid fa-building-columns mr-2"></i>
                    Khoa
                </a>

                <a href="{{ $subjectUrl }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-bold transition
                    {{ request()->is('subjects*') || request()->is('mon-hoc*') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-600 hover:bg-cyan-50 hover:text-cyan-600' }}">
                    <i class="fa-solid fa-book-open mr-2"></i>
                    Môn học
                </a>

                <a href="{{ $documentUrl }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-bold transition
                    {{ request()->is('documents*') || request()->is('tai-lieu*') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-600 hover:bg-cyan-50 hover:text-cyan-600' }}">
                    <i class="fa-solid fa-file-lines mr-2"></i>
                    Tài liệu
                </a>
            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-3">

                @auth
                @if($canUploadDocument)
                <button type="button" onclick="openSubjectUploadModal()"
                    class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-bold shadow-lg shadow-cyan-200 transition">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    Đăng tải
                </button>
                @endif

                <!-- USER DROPDOWN -->
                <div class="relative group">
                    <div
                        class="flex items-center gap-3 cursor-pointer bg-slate-50 hover:bg-cyan-50 border border-slate-100 rounded-2xl px-3 py-2 transition-all">
                        <img src="{{ $currentUser->avatar ? asset('storage/' . $currentUser->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($currentUser->full_name) . '&background=06b6d4&color=fff' }}"
                            class="w-10 h-10 rounded-full object-cover border-2 border-white shadow">

                        <div class="hidden sm:block leading-tight max-w-[150px]">
                            <p class="text-sm font-black text-slate-800 truncate">
                                {{ $currentUser->full_name }}
                            </p>

                            <p class="text-xs font-bold text-cyan-600">
                                {{ $roleName }}
                            </p>
                        </div>

                        <i class="fa-solid fa-chevron-down text-xs text-slate-400"></i>
                    </div>

                    <!-- DROPDOWN MENU -->
                    <div
                        class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible translate-y-2 group-hover:translate-y-0 transition-all duration-200 overflow-hidden z-50">

                        <div class="px-5 py-4 bg-gradient-to-r from-cyan-50 to-sky-50 border-b border-cyan-100">
                            <div class="flex items-center gap-3">
                                <img src="{{ $currentUser->avatar ? asset('storage/' . $currentUser->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($currentUser->full_name) . '&background=06b6d4&color=fff' }}"
                                    class="w-12 h-12 rounded-2xl object-cover border-2 border-white shadow">

                                <div class="min-w-0">
                                    <p class="text-sm font-black text-slate-800 truncate">
                                        {{ $currentUser->full_name }}
                                    </p>

                                    <p class="text-xs font-bold text-cyan-600 truncate">
                                        {{ $roleName }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('profile') }}"
                            class="flex items-center gap-3 px-5 py-3 text-sm font-bold text-slate-600 hover:bg-cyan-50 hover:text-cyan-600 transition">
                            <i class="fa-solid fa-user w-4"></i>
                            Hồ sơ cá nhân
                        </a>

                        @if($canUploadDocument && \Illuminate\Support\Facades\Route::has('documents.my-documents'))
                        <a href="{{ route('documents.my-documents') }}"
                            class="flex items-center gap-3 px-5 py-3 text-sm font-bold text-slate-600 hover:bg-cyan-50 hover:text-cyan-600 transition">
                            <i class="fa-solid fa-folder-open w-4"></i>
                            Học liệu của tôi
                        </a>
                        @endif

                        @if($roleId == 1)
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-3 px-5 py-3 text-sm font-bold text-cyan-600 hover:bg-cyan-50 transition">
                            <i class="fa-solid fa-shield-halved w-4"></i>
                            Admin Panel
                        </a>
                        @endif

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit"
                                class="w-full flex items-center gap-3 px-5 py-3 text-sm font-bold text-red-500 hover:bg-red-50 transition">
                                <i class="fa-solid fa-right-from-bracket w-4"></i>
                                Đăng xuất
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}"
                    class="px-5 py-2.5 rounded-xl border border-cyan-100 text-cyan-600 text-sm font-bold hover:bg-cyan-50 transition">
                    Đăng nhập
                </a>

                @if(\Illuminate\Support\Facades\Route::has('register'))
                <a href="{{ route('register') }}"
                    class="hidden sm:inline-flex px-5 py-2.5 rounded-xl bg-cyan-500 text-white text-sm font-bold hover:bg-cyan-600 shadow-lg shadow-cyan-200 transition">
                    Đăng ký
                </a>
                @endif
                @endauth

            </div>
        </div>
    </div>
</nav>
<!-- UPLOAD MODAL UI - TRANG CHI TIẾT MÔN -->
<div id="subjectUploadModal"
    class="fixed inset-0 z-[999] hidden items-center justify-center bg-slate-950/40 backdrop-blur-[4px] px-4 transition-all duration-300">

    <div
        class="relative w-full max-w-2xl bg-white rounded-[1.5rem] border border-slate-100 shadow-[0_25px_60px_-15px_rgba(15,23,42,0.15)] overflow-hidden animate-fadeIn">

        <!-- HEADER -->
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/60">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center shadow-sm">
                    <i class="fa-solid fa-cloud-arrow-up text-base"></i>
                </div>

                <div>
                    <h3 class="text-base font-extrabold text-slate-800 tracking-tight">
                        Upload tài liệu
                    </h3>

                    <p class="text-[11px] text-slate-400 font-semibold mt-0.5">
                        Thêm tài liệu học tập vào hệ thống
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
                    class="group relative flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-200 hover:border-cyan-400 bg-slate-50/50 hover:bg-cyan-50/30 rounded-xl cursor-pointer transition-all duration-200">

                    <input type="file" name="file" id="subjectFileInput" class="hidden"
                        onchange="updateSubjectFileName(this)">

                    <div class="flex flex-col items-center justify-center pt-4 pb-3 text-center px-4">
                        <div
                            class="w-10 h-10 rounded-xl bg-cyan-600 text-white flex items-center justify-center mb-2 shadow-md shadow-cyan-500/20 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-file-arrow-up text-sm"></i>
                        </div>

                        <p id="subjectUploadPrompt" class="text-xs font-bold text-slate-700">
                            Kéo thả file hoặc
                            <span class="text-cyan-600 group-hover:underline">click để chọn</span>
                        </p>

                        <p id="subjectFileTypesHint" class="text-[10px] text-slate-400 font-semibold mt-1">
                            PDF, DOCX, PPTX, ZIP, RAR - Tối đa 50MB
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
                    class="w-full h-11 px-4 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-semibold text-slate-700 placeholder-slate-400 focus:outline-none focus:bg-white focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all">
            </div>

            <!-- KHOA + MÔN HỌC + LOẠI HỌC LIỆU -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                <!-- KHOA -->
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-1.5">
                        Khoa
                    </label>

                    <div class="relative flex items-center">
                        <select name="faculty"
                            class="w-full h-11 pl-4 pr-10 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-bold text-slate-600 focus:outline-none focus:bg-white focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all appearance-none cursor-pointer">
                            <option value="cntt" selected>Công nghệ thông tin</option>
                            <option value="qtkd">Quản trị kinh doanh</option>
                            <option value="kt">Kế toán</option>
                            <option value="nn">Ngoại ngữ</option>
                        </select>

                        <i
                            class="fa-solid fa-chevron-down text-slate-400 text-[10px] absolute right-4 pointer-events-none"></i>
                    </div>
                </div>

                <!-- MÔN HỌC -->
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-1.5">
                        Môn học
                    </label>

                    <div class="relative flex items-center">
                        <select name="subject"
                            class="w-full h-11 pl-4 pr-10 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-bold text-slate-600 focus:outline-none focus:bg-white focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all appearance-none cursor-pointer">
                            <option value="lap-trinh-web" selected>Lập trình Web</option>
                            <option value="co-so-du-lieu">Cơ sở dữ liệu</option>
                            <option value="java-oop">Java OOP</option>
                            <option value="phan-tich-thiet-ke">Phân tích thiết kế hệ thống</option>
                        </select>

                        <i
                            class="fa-solid fa-chevron-down text-slate-400 text-[10px] absolute right-4 pointer-events-none"></i>
                    </div>
                </div>

                <!-- LOẠI HỌC LIỆU -->
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-1.5">
                        Loại học liệu
                    </label>

                    <div class="relative flex items-center">
                        <select name="document_type"
                            class="w-full h-11 pl-4 pr-10 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-bold text-slate-600 focus:outline-none focus:bg-white focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all appearance-none cursor-pointer">
                            <option value="slide">Slide bài giảng</option>
                            <option value="exam">Đề thi / Đáp án</option>
                            <option value="assignment">Bài tập</option>
                            <option value="reference">Tài liệu tham khảo</option>
                            <option value="textbook">Giáo trình</option>
                        </select>

                        <i
                            class="fa-solid fa-chevron-down text-slate-400 text-[10px] absolute right-4 pointer-events-none"></i>
                    </div>
                </div>
            </div>

            <!-- MÔ TẢ -->
            <div>
                <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-1.5">
                    Mô tả tài liệu
                </label>

                <textarea name="description" rows="3"
                    placeholder="Nhập tóm tắt nội dung tài liệu để người học dễ tìm kiếm..."
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-semibold text-slate-700 placeholder-slate-400 resize-none focus:outline-none focus:bg-white focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all"></textarea>
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
                        class="px-5 py-2.5 bg-cyan-600 hover:bg-cyan-700 text-white text-xs font-bold rounded-xl shadow-md shadow-cyan-600/20 active:scale-95 transition-all">
                        <i class="fa-solid fa-cloud-arrow-up mr-1"></i>
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