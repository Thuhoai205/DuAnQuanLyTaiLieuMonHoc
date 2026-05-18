<nav class="glass-nav border-b sticky top-0 z-50 bg-white/80 backdrop-blur-md">
    <div class="container mx-auto px-4 h-20 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div
                class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 shadow-lg shadow-blue-500/30">
                <i class="fas fa-graduation-cap text-white text-xl"></i>
            </div>
            <a href="{{ route('home') }}" class="mb-3 text-2xl font-extrabold tracking-tight flex items-center">
                <span class="text-black">EDU</span>
                <span class="relative text-blue-500 ml-1">
                    DOC
                    <span class="absolute -top-2 -right-4 text-[10px] text-blue-400 font-bold uppercase">HH</span>
                </span>
            </a>
        </div>

        <div class="hidden md:flex gap-6 text-sm font-semibold">
            <a href="{{ route('home') }}"
                class="pb-2 border-b-2 {{ request()->routeIs('home') ? 'text-blue-600 border-blue-600' : 'text-slate-500 border-transparent hover:text-blue-600 hover:border-blue-600' }}">
                Trang chủ
            </a>
            <a href="{{ route('subjects.index') }}"
                class="pb-2 border-b-2 {{ request()->routeIs('subjects.*') ? 'text-blue-600 border-blue-600' : 'text-slate-500 border-transparent hover:text-blue-600 hover:border-blue-600' }}">
                Môn học
            </a>
        </div>

        <div class="flex items-center gap-4">
            @guest
            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-blue-600">Đăng
                nhập</a>
            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-bold">Đăng
                ký</a>
            @endguest

            @auth
            @if(auth()->user()->role_id == 2)
            <button onclick="openUploadModal()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-colors">
                <i class="fas fa-cloud-upload-alt mr-2"></i> Đăng tải
            </button>
            @endif

            <div class="relative group">
                <div class="flex items-center gap-3 cursor-pointer group">
                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->full_name) }}"
                        class="w-10 h-10 rounded-full object-cover border-2 border-white shadow group-hover:ring-2 ring-blue-500 transition">
                    <div class="hidden sm:flex flex-col">
                        <div class="flex items-center gap-1">
                            <i class="fas fa-user text-slate-400 text-xs"></i>
                            <p class="text-sm font-semibold text-slate-800">{{ auth()->user()->full_name }}</p>
                        </div>
                        <div class="flex items-center gap-1">
                            <i class="fas fa-id-badge text-green-500 text-xs"></i>
                            <p class="text-xs font-medium text-green-600">
                                {{ auth()->user()->role_id == 2 ? 'Giảng viên' : 'Sinh viên' }}</p>
                        </div>
                    </div>
                </div>
                <div
                    class="absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-slate-100">
                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm hover:bg-slate-50 rounded-t-xl">Hồ
                        sơ</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button
                            class="w-full text-left px-4 py-2 text-sm hover:bg-slate-50 text-red-500 rounded-b-xl">Đăng
                            xuất</button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </div>
</nav>

<div id="uploadModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/40 backdrop-blur-[4px] px-4 transition-all duration-300">
    <div
        class="relative w-full max-w-xl bg-white rounded-[1.5rem] border border-slate-100 shadow-[0_25px_60px_-15px_rgba(15,23,42,0.15)] overflow-hidden animate-fadeIn">

        <div class="px-6 py-4.5 border-b border-slate-100 flex items-center justify-between bg-slate-50/60">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-sm">
                    <i class="fas fa-cloud-upload-alt text-base"></i>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-slate-800 tracking-tight">Upload tài liệu</h3>
                    <p class="text-[11px] text-slate-400 font-semibold mt-0.5">Thêm tài liệu mới vào hệ thống</p>
                </div>
            </div>
            <button onclick="closeUploadModal()"
                class="w-8 h-8 rounded-full bg-slate-200/60 text-slate-500 hover:bg-red-500 hover:text-white transition-all duration-200 flex items-center justify-center active:scale-90">
                <i class="fas fa-times text-xs"></i>
            </button>
        </div>

        <form action="#" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf

            <div>
                <label
                    class="group relative flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-200 hover:border-blue-400 bg-slate-50/50 hover:bg-blue-50/20 rounded-xl cursor-pointer transition-all duration-200">
                    <input type="file" name="file" id="fileInput" class="hidden" onchange="updateFileName(this)">
                    <div class="flex flex-col items-center justify-center pt-4 pb-3 text-center px-4">
                        <div
                            class="w-9 h-9 rounded-lg bg-blue-600 text-white flex items-center justify-center mb-2 shadow-md shadow-blue-500/10 group-hover:scale-110 transition-transform">
                            <i class="fas fa-file-import text-sm"></i>
                        </div>
                        <p id="uploadPrompt" class="text-xs font-bold text-slate-700">
                            Kéo thả file hoặc <span class="text-blue-600 group-hover:underline">click để chọn</span>
                        </p>
                        <p id="fileTypesHint" class="text-[10px] text-slate-400 font-semibold mt-1">PDF, DOCX, PPTX (Tối
                            đa 50MB)</p>
                    </div>
                </label>
            </div>

            <div>
                <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-1.5">Tên tài
                    liệu</label>
                <input type="text" name="title" placeholder="Nhập tên chi tiết của tài liệu..."
                    class="w-full h-11 px-4 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-semibold text-slate-700 placeholder-slate-400 focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-1.5">Môn
                        học</label>
                    <div class="relative flex items-center">
                        <select name="subject_id"
                            class="w-full h-11 pl-4 pr-10 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-bold text-slate-600 focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all appearance-none cursor-pointer">
                            <option value="" disabled selected>-- Chọn môn học áp dụng --</option>

                            <optgroup label="Công nghệ thông tin">
                                <option value="1">Lập trình Web (Laravel/ReactJS)</option>
                                <option value="2">Lập trình hướng đối tượng (OOP)</option>
                                <option value="3">Cơ sở dữ liệu hệ quản trị SQL</option>
                                <option value="4">Phát triển ứng dụng di động</option>
                            </optgroup>

                            <optgroup label="Kinh tế & Quản trị">
                                <option value="5">Kinh tế vĩ mô</option>
                                <option value="6">Marketing kỹ thuật số (Digital)</option>
                                <option value="7">Quản trị nguồn nhân lực</option>
                            </optgroup>

                            <optgroup label="Ngoại ngữ & Kỹ năng">
                                <option value="8">Tiếng Anh chuyên ngành Công nghệ</option>
                                <option value="9">Kỹ năng giao tiếp và thuyết trình</option>
                            </optgroup>
                        </select>
                        <i class="fas fa-book text-slate-400 text-[11px] absolute right-8 pointer-events-none"></i>
                        <i
                            class="fas fa-chevron-down text-slate-400 text-[10px] absolute right-4 pointer-events-none"></i>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-1.5">Loại học
                        liệu</label>
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

            <div>
                <label class="block text-[11px] font-black uppercase tracking-wider text-slate-500 mb-1.5">Mô tả tài
                    liệu</label>
                <textarea name="description" rows="2.5"
                    placeholder="Nhập tóm tắt nội dung tài liệu để người học dễ tìm kiếm..."
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 text-xs font-semibold text-slate-700 placeholder-slate-400 resize-none focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 transition-all"></textarea>
            </div>

            <div class="flex items-center justify-end gap-2.5 pt-2 border-t border-slate-50">
                <button type="button" onclick="closeUploadModal()"
                    class="px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-500 hover:bg-slate-50 active:scale-95 transition-all">
                    Hủy bỏ
                </button>
                <button type="submit"
                    class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl shadow-md shadow-blue-600/10 active:scale-95 transition-all">
                    Upload tài liệu
                </button>
            </div>
        </form>
    </div>
</div>

<style>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(.97) translateY(8px);
    }

    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

.animate-fadeIn {
    animation: fadeIn .25s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
</style>

<script>
// Hàm xử lý việc mở Modal an toàn bằng cách nhận diện ID
function openUploadModal() {
    const modal = document.getElementById('uploadModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
}

// Thay đổi logic gọi từ toggle sang đóng cố định để tránh lỗi giao diện
function closeUploadModal() {
    const modal = document.getElementById('uploadModal');
    if (modal) {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';

        // Làm sạch dữ liệu form sau khi đóng modal bảo vệ trải nghiệm người dùng
        document.getElementById('fileInput').value = "";
        document.getElementById('uploadPrompt').innerHTML =
            'Kéo thả file hoặc <span class="text-blue-600 group-hover:underline">click để chọn</span>';
        document.getElementById('fileTypesHint').innerText = 'PDF, DOCX, PPTX (Tối đa 50MB)';
    }
}

// Lắng nghe sự thay đổi của input file nhằm tối ưu hiển thị trạng thái đã chọn file thành công
function updateFileName(input) {
    const promptText = document.getElementById('uploadPrompt');
    const hintText = document.getElementById('fileTypesHint');

    if (input.files && input.files.length > 0) {
        const file = input.files[0];
        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);

        promptText.innerHTML =
            `<span class="text-emerald-600 font-extrabold"><i class="fas fa-check-circle mr-1"></i> Đã nhận dữ liệu file</span>`;
        hintText.innerText = `${file.name} (${fileSizeMB} MB)`;
        hintText.classList.remove('text-slate-400');
        hintText.classList.add('text-slate-700', 'font-bold');
    }
}

// Đóng modal khi nhấn ra vùng trống bên ngoài
window.addEventListener('click', function(e) {
    const modal = document.getElementById('uploadModal');
    if (e.target === modal) {
        closeUploadModal();
    }
});
</script>