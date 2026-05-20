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
            <button onclick="openUploadModal()"
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