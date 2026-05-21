<nav
    class="sticky top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-slate-100 shadow-[0_8px_30px_rgba(15,23,42,0.06)]">
    <div class="container mx-auto px-4 h-20 flex items-center justify-between">

        <!-- LOGO -->
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div
                class="w-12 h-12 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200 group-hover:scale-105 transition-all">
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

        <!-- MENU -->
        <div class="hidden md:flex items-center gap-2 bg-slate-50 p-1.5 rounded-2xl border border-slate-100">
            <a href="{{ route('home') }}"
                class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all
                {{ request()->routeIs('home') ? 'bg-white text-cyan-600 shadow-sm' : 'text-slate-500 hover:text-cyan-600' }}">
                Trang chủ
            </a>

            <a href="{{ route('subjects.index') }}"
                class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all
                {{ request()->routeIs('subjects.*') ? 'bg-white text-cyan-600 shadow-sm' : 'text-slate-500 hover:text-cyan-600' }}">
                Môn học
            </a>
            <a href="{{ route('documents.index') }}"
                class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all
                {{ request()->routeIs('documents.*') ? 'bg-white text-cyan-600 shadow-sm' : 'text-slate-500 hover:text-cyan-600' }}">
                Tài liệu
            </a>
        </div>

        <!-- ACTION -->
        <div class="flex items-center gap-3">
            @guest
            <a href="{{ route('login') }}"
                class="px-5 py-2.5 rounded-xl text-sm font-bold text-slate-600 hover:text-cyan-600 hover:bg-cyan-50 transition">
                Đăng nhập
            </a>

            <a href="{{ route('register') }}"
                class="px-5 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-bold shadow-lg shadow-cyan-200 transition">
                Đăng ký
            </a>
            @endguest

            @auth
            @if(auth()->user()->role_id == 2)
            <button onclick="openSubjectUploadModal()"
                class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-bold shadow-lg shadow-cyan-200 transition">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                Đăng tải
            </button>
            @endif

            <!-- USER DROPDOWN -->
            <div class="relative group">
                <div
                    class="flex items-center gap-3 cursor-pointer bg-slate-50 hover:bg-cyan-50 border border-slate-100 rounded-2xl px-3 py-2 transition-all">
                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->full_name) }}"
                        class="w-10 h-10 rounded-full object-cover border-2 border-white shadow">

                    <div class="hidden sm:block leading-tight">
                        <p class="text-sm font-black text-slate-800">
                            {{ auth()->user()->full_name }}
                        </p>
                        <p class="text-xs font-bold text-cyan-600">
                            {{ auth()->user()->role_id == 2 ? 'Giảng viên' : 'Sinh viên' }}
                        </p>
                    </div>

                    <i class="fa-solid fa-chevron-down text-xs text-slate-400"></i>
                </div>

                <div
                    class="absolute right-0 mt-3 w-52 bg-white rounded-2xl shadow-xl border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible translate-y-2 group-hover:translate-y-0 transition-all duration-200 overflow-hidden">

                    <a href="{{ route('profile') }}"
                        class="flex items-center gap-3 px-5 py-3 text-sm font-bold text-slate-600 hover:bg-cyan-50 hover:text-cyan-600 transition">
                        <i class="fa-solid fa-user"></i>
                        Hồ sơ
                    </a>

                    @if(auth()->user()->role_id == 2)
                    <a href="{{ route('documents.my-documents') }}"
                        class="flex items-center gap-3 px-5 py-3 text-sm font-bold text-slate-600 hover:bg-cyan-50 hover:text-cyan-600 transition">
                        <i class="fa-solid fa-folder-open"></i>
                        Học liệu cá nhân
                    </a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 px-5 py-3 text-sm font-bold text-red-500 hover:bg-red-50 transition">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </div>
</nav>

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

                    <div class="relative flex items-center">
                        <select name="type"
                            class="w-full h-11 pl-4 pr-10 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-bold text-slate-600 focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all appearance-none cursor-pointer">
                            >
                            <option value="lap-trinh-web" selected>Lập trình Web</option>

                        </select>

                        <i
                            class="fas fa-chevron-down text-slate-400 text-[10px] absolute right-4 pointer-events-none"></i>
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