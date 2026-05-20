<footer class="relative mt-24 overflow-hidden bg-slate-950 text-slate-300">

    <!-- Background glow -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-32 -left-20 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-[420px] h-[420px] bg-blue-600/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-16">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

            <!-- BRAND -->
            <div class="lg:col-span-1 space-y-6">
                <div class="flex items-center gap-4">
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-2xl bg-cyan-500 text-white shadow-lg shadow-cyan-500/25">
                        <i class="fa-solid fa-graduation-cap text-xl"></i>
                    </div>

                    <a href="{{ route('home') }}" class="leading-none">
                        <div class="text-2xl font-black tracking-tight">
                            <span class="text-white">EDU</span><span class="text-cyan-400">DOC</span>
                        </div>
                        <div class="mt-1 text-[10px] font-bold uppercase tracking-[0.28em] text-slate-500">
                            Learning Hub
                        </div>
                    </a>
                </div>

                <p class="text-sm leading-7 text-slate-400">
                    Nền tảng quản lý tài liệu môn học, hỗ trợ giảng viên đăng tải học liệu
                    và giúp sinh viên tìm kiếm tài liệu nhanh chóng, tập trung.
                </p>

                <div class="flex items-center gap-3">
                    <span
                        class="px-3 py-1.5 rounded-full bg-cyan-500/10 text-cyan-300 text-xs font-bold border border-cyan-500/20">
                        Laravel
                    </span>
                    <span
                        class="px-3 py-1.5 rounded-full bg-slate-800 text-slate-400 text-xs font-bold border border-slate-700">
                        v1.0.0
                    </span>
                </div>
            </div>

            <!-- DOCUMENTS -->
            <div>
                <h3 class="text-white font-black mb-6 text-base uppercase tracking-wider">
                    Tài liệu
                </h3>

                <ul class="space-y-4 text-sm">
                    <li>
                        <a href="#" class="group flex items-center gap-3 text-slate-400 hover:text-cyan-300 transition">
                            <span
                                class="w-8 h-8 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white transition">
                                <i class="fa-solid fa-file-lines text-xs"></i>
                            </span>
                            Đề cương & Slide
                        </a>
                    </li>

                    <li>
                        <a href="#" class="group flex items-center gap-3 text-slate-400 hover:text-cyan-300 transition">
                            <span
                                class="w-8 h-8 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white transition">
                                <i class="fa-solid fa-book-open text-xs"></i>
                            </span>
                            Bài tập & Ôn tập
                        </a>
                    </li>

                    <li>
                        <a href="#" class="group flex items-center gap-3 text-slate-400 hover:text-cyan-300 transition">
                            <span
                                class="w-8 h-8 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white transition">
                                <i class="fa-solid fa-file-circle-check text-xs"></i>
                            </span>
                            Đề thi các năm
                        </a>
                    </li>
                </ul>
            </div>

            <!-- SYSTEM -->
            <div>
                <h3 class="text-white font-black mb-6 text-base uppercase tracking-wider">
                    Hệ thống
                </h3>

                <ul class="space-y-4 text-sm">
                    <li>
                        <a href="#" class="group flex items-center gap-3 text-slate-400 hover:text-cyan-300 transition">
                            <span
                                class="w-8 h-8 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white transition">
                                <i class="fa-solid fa-chalkboard-user text-xs"></i>
                            </span>
                            Dành cho giảng viên
                        </a>
                    </li>

                    <li>
                        <a href="#" class="group flex items-center gap-3 text-slate-400 hover:text-cyan-300 transition">
                            <span
                                class="w-8 h-8 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white transition">
                                <i class="fa-solid fa-magnifying-glass text-xs"></i>
                            </span>
                            Tra cứu môn học
                        </a>
                    </li>

                    <li>
                        <a href="#" class="group flex items-center gap-3 text-slate-400 hover:text-cyan-300 transition">
                            <span
                                class="w-8 h-8 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white transition">
                                <i class="fa-solid fa-shield-halved text-xs"></i>
                            </span>
                            Quản trị hệ thống
                        </a>
                    </li>
                </ul>
            </div>

            <!-- SUPPORT -->
            <div>
                <h3 class="text-white font-black mb-6 text-base uppercase tracking-wider">
                    Hỗ trợ
                </h3>

                <div class="space-y-4 text-sm">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-9 h-9 rounded-xl bg-cyan-500/10 text-cyan-300 flex items-center justify-center border border-cyan-500/20">
                            <i class="fa-solid fa-envelope text-sm"></i>
                        </div>

                        <div>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">
                                Email
                            </p>
                            <p class="text-slate-300 font-semibold">
                                support@edudoc.vn
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div
                            class="w-9 h-9 rounded-xl bg-cyan-500/10 text-cyan-300 flex items-center justify-center border border-cyan-500/20">
                            <i class="fa-solid fa-user-tie text-sm"></i>
                        </div>

                        <div>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">
                                GVHD
                            </p>
                            <p class="text-slate-300 font-semibold">
                                Thầy Đỗ Trung Thuận
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BOTTOM -->
        <div class="mt-14 pt-8 border-t border-slate-800/80">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">

                <p class="text-xs text-slate-500 text-center md:text-left">
                    © 2026 <span class="text-slate-300 font-semibold">Đồ án tốt nghiệp</span> —
                    Xây dựng Website quản lý tài liệu môn học.
                </p>

                <div class="flex items-center gap-3 text-xs">
                    <span
                        class="px-3 py-1.5 rounded-full bg-slate-900 border border-slate-800 text-slate-500 font-bold">
                        ASP.NET / Laravel UI
                    </span>
                    <span
                        class="px-3 py-1.5 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-300 font-bold">
                        EDU DOC
                    </span>
                </div>

            </div>
        </div>

    </div>
</footer>