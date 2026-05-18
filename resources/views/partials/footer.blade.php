<footer class="bg-slate-900 text-slate-300 py-16 mt-20 border-t-4 border-blue-600 ">
    <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            <div class="space-y-6">
                <div class="flex items-center gap-4">

                    <!-- ICON -->
                    <div
                        class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-700 shadow-lg shadow-blue-900/30 border border-white/10">

                        <i class="fas fa-graduation-cap text-white text-xl"></i>

                    </div>

                    <!-- LOGO -->
                    <a href="{{ route('home') }}"
                        class="flex items-center text-2xl font-extrabold tracking-tight leading-none">

                        <span class="text-white">
                            EDU
                        </span>

                        <span class="relative ml-1 text-blue-400">

                            DOC

                            <span
                                class="absolute -top-1.5 -right-4 text-[9px] font-bold uppercase tracking-wider text-blue-300">
                                HH
                            </span>

                        </span>

                    </a>

                </div>
                <p class="text-sm leading-relaxed text-slate-400 pr-4">
                    Nền tảng quản lý tài liệu tập trung, giúp giảm thiểu phân tán dữ liệu và tối ưu hiệu quả tìm
                    kiếm
                    cho sinh viên.
                </p>

            </div>

            <div>
                <h3 class="text-white font-bold mb-3 text-lg border-b border-blue-500/30 pb-2 inline-block">Tài liệu
                </h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center gap-2"><span>•</span>
                            Đề cương & Slide</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center gap-2"><span>•</span>
                            Bài tập & Ôn tập</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors flex items-center gap-2"><span>•</span>
                            Đề thi các năm</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-bold mb-3 text-lg border-b border-blue-500/30 pb-2 inline-block">Hệ thống
                </h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Dành cho Giảng viên</a>
                    </li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Tra cứu môn học</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Quản trị hệ thống </a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-bold mb-3 text-lg border-b border-blue-500/30 pb-2 inline-block">Hỗ trợ
                </h3>
                <div class="space-y-4 text-sm">
                    <p class="flex items-center gap-3">
                        <i class="fas fa-envelope text-blue-500"></i>
                        support@edudoc.vn
                    </p>
                    <p class="flex items-center gap-3 italic text-slate-500 text-xs">
                        GVHD: Thầy Đỗ Trung Thuậ
                    </p>
                </div>
            </div>
        </div>

        <div class="border-t border-slate-800 pt-8 mt-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-[12px] text-slate-500">
                    © 2026 <span class="font-semibold text-slate-400">Đồ án tốt nghiệp</span>: Xây dựng Website quản
                    lý
                    tài liệu môn học.
                </p>
                <div class="flex items-center gap-4 text-[11px] font-medium uppercase tracking-widest text-slate-600">
                    <span class="bg-slate-800 px-3 py-1 rounded-full">v1.0.0</span>
                    <span
                        class="bg-blue-900/30 text-blue-400 px-3 py-1 rounded-full border border-blue-500/20">Laravel</span>
                </div>
            </div>
        </div>
    </div>
</footer>