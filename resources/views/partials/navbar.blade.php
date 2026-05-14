<nav class="glass-nav border-b sticky top-0 z-50 ">
    <div class="container mx-auto px-4 h-20 flex items-center justify-between">

        <!-- Logo -->
        <div class="flex items-center gap-3">

            <!-- Icon -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-700 
                p-2.5 rounded-2xl shadow-lg shadow-blue-500/30">
                <i class="fas fa-graduation-cap text-white text-xl"></i>
            </div>

            <!-- Logo -->
            <a href="{{ route('home') }}"
                class="text-2xl font-extrabold tracking-tight text-slate-800 flex items-center">

                EDU

                <!-- DOC + HH -->
                <span class="relative text-blue-600 ml-1">
                    DOC
                    <span class="absolute -top-2 -right-4 text-[10px] text-blue-400 font-bold">
                        HH
                    </span>
                </span>

            </a>

        </div>


        <!-- Menu -->
        <div class="hidden md:flex gap-6 text-sm font-semibold">
            <!-- Trang chủ -->
            <a href="{{ route('home') }}" class="pb-2 border-b-2 
             {{ request()->routeIs('home') 
            ? 'text-blue-600 border-blue-600' 
            : 'text-slate-500 border-transparent hover:text-blue-600 hover:border-blue-600' }}">
                Trang chủ
            </a>

            <!-- Môn học -->
            <a href="{{ route('subjects.index') }}" class="pb-2 border-b-2 
        {{ request()->routeIs('subjects.*') 
            ? 'text-blue-600 border-blue-600' 
            : 'text-slate-500 border-transparent hover:text-blue-600 hover:border-blue-600' }}">
                Môn học
            </a>

            <!-- Tài liệu -->
            <a href="{{ route('documents.index') }}" class="pb-2 border-b-2 
        {{ request()->routeIs('documents.*') 
            ? 'text-blue-600 border-blue-600' 
            : 'text-slate-500 border-transparent hover:text-blue-600 hover:border-blue-600' }}">
                Tài liệu
            </a>

        </div>

        <!-- User -->
        <div class="flex items-center gap-4">

            {{-- Guest --}}
            @guest
            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-blue-600">
                Đăng nhập
            </a>

            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-bold">
                Đăng ký
            </a>
            @endguest

            {{-- Auth --}}
            @auth

            @if(auth()->user()->role_id == 2)
            <button onclick="toggleModal('uploadModal')"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold">
                <i class="fas fa-cloud-upload-alt mr-2"></i> Đăng tải
            </button>
            @endif


            {{-- USER INFO --}}
            <div class="relative group">

                <!-- USER INFO -->
                <div class="flex items-center gap-3 cursor-pointer">
                    <div class="flex items-center gap-3 cursor-pointer group">

                        {{-- Avatar --}}
                        <img src="{{ auth()->user()->avatar 
            ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}" class="w-10 h-10 rounded-full object-cover border-2 border-white shadow 
               group-hover:ring-2 ring-blue-500 transition">

                        {{-- Info --}}
                        <div class="hidden sm:flex flex-col">

                            {{-- Name + Icon --}}
                            <div class="flex items-center gap-1">
                                <i class="fas fa-user text-slate-400 text-xs"></i>
                                <p class="text-sm font-semibold text-slate-800">
                                    {{ auth()->user()->full_name }}
                                </p>
                            </div>

                            {{-- Role --}}
                            <div class="flex items-center gap-1">
                                <i class="fas fa-id-badge text-green-500 text-xs"></i>
                                <p class="text-xs font-medium text-green-600">
                                    {{ auth()->user()->role_id == 2 ? 'Giảng viên' : 'Sinh viên' }}
                                </p>
                            </div>

                        </div>

                    </div>
                </div>

                <!-- DROPDOWN -->
                <div class="absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-lg 
                opacity-0 group-hover:opacity-100 transition">

                    <a href="#" class="block px-4 py-2 text-sm hover:bg-slate-100">
                        Hồ sơ
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="w-full text-left px-4 py-2 text-sm hover:bg-slate-100 text-red-500">
                            Đăng xuất
                        </button>
                    </form>

                </div>

            </div>


            @endauth

        </div>

    </div>
</nav>

<!-- MODAL UPLOAD -->
<div id="uploadModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 backdrop-blur-sm">

    <div class="bg-white w-full max-w-xl rounded-[2rem] shadow-2xl overflow-hidden animate-fadeIn">

        <!-- HEADER -->
        <div class="flex justify-between items-center px-6 py-5 border-b bg-slate-50">

            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-file-upload"></i>
                </div>

                <div>
                    <h3 class="text-sm font-bold uppercase">
                        Đăng tải học liệu mới
                    </h3>
                    <p class="text-xs text-slate-400">
                        Hệ thống lưu trữ tập trung
                    </p>
                </div>
            </div>

            <button onclick="toggleModal('uploadModal')" class="text-slate-400 hover:text-red-500 transition">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- BODY -->
        <form action="#" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf

            <!-- DROPZONE -->
            <label
                class="block border-2 border-dashed border-blue-300 rounded-2xl p-8 text-center cursor-pointer hover:bg-blue-50 transition">

                <input type="file" name="file" class="hidden">

                <div
                    class="w-14 h-14 mx-auto mb-3 bg-blue-600 text-white flex items-center justify-center rounded-xl shadow">
                    <i class="fas fa-file-import"></i>
                </div>

                <p class="text-sm font-semibold text-slate-700">
                    Kéo thả file hoặc click để chọn
                </p>

                <p class="text-xs text-slate-400 mt-1">
                    PDF, DOCX, PPTX (tối đa 50MB)
                </p>
            </label>

            <!-- TITLE + SUBJECT -->
            <div class="grid grid-cols-2 gap-4">

                <!-- TITLE -->
                <div>
                    <label class="text-xs text-slate-400 font-semibold">
                        Tiêu đề
                    </label>
                    <input type="text" name="ten_tai_lieu"
                        class="w-full mt-1 bg-slate-100 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="VD: Đề thi cuối kỳ...">
                </div>

                <!-- SUBJECT -->
                <div>
                    <label class="text-xs text-slate-400 font-semibold">
                        Môn học
                    </label>
                    <select name="ma_mon"
                        class="w-full mt-1 bg-slate-100 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn môn học</option>
                        <option value="1">Lập trình Web</option>
                        <option value="2">Cơ sở dữ liệu</option>
                        <option value="3">Mạng máy tính</option>
                    </select>
                </div>

            </div>

            <!-- TYPE -->
            <div>
                <label class="text-xs text-slate-400 font-semibold">
                    Loại học liệu
                </label>
                <select name="loai_id"
                    class="w-full mt-1 bg-slate-100 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Chọn loại học liệu</option>
                    <option value="1">Slide bài giảng</option>
                    <option value="2">Đề thi</option>
                    <option value="3">Đề cương</option>
                </select>
            </div>

            <!-- DESCRIPTION -->
            <div>
                <label class="text-xs text-slate-400 font-semibold">
                    Mô tả
                </label>
                <textarea name="mo_ta" rows="3"
                    class="w-full mt-1 bg-slate-100 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Nhập mô tả tài liệu..."></textarea>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-blue-800 text-white py-3 rounded-xl font-bold shadow-lg hover:scale-[1.02] transition">
                XÁC NHẬN ĐĂNG TÀI LIỆU
            </button>

        </form>
    </div>
</div>
<script>
function toggleModal(id) {
    const modal = document.getElementById(id);

    // Toggle class hidden để ẩn/hiện
    modal.classList.toggle('hidden');

    // Toggle class flex để căn giữa modal khi hiện
    modal.classList.toggle('flex');

    // Ngăn cuộn trang phía sau khi đang mở Modal
    if (!modal.classList.contains('hidden')) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = 'auto';
    }
}

// Đóng modal khi click ra ngoài vùng trắng (vùng nền đen)
window.onclick = function(event) {
    const modal = document.getElementById('uploadModal');
    if (event.target == modal) {
        toggleModal('uploadModal');
    }
}
</script>