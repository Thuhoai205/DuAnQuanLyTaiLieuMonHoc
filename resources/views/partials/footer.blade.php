<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">


<footer
    class="relative mt-12 overflow-hidden bg-slate-900 border-t border-slate-800 text-slate-300 font-['Roboto',_sans-serif]">

    <!-- Background -->
    <div class="absolute inset-0 pointer-events-none">

        <div class="absolute
            -top-32
            -left-20
            w-96
            h-96
            rounded-full
            bg-amber-500/10
            blur-3xl">
        </div>

        <div class="absolute
            bottom-0
            right-0
            w-[420px]
            h-[420px]
            rounded-full
            bg-slate-500/10
            blur-3xl">
        </div>

    </div>

    <div class="relative max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-10">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

            <!-- ================= BRAND ================= -->

            <div class="space-y-6">

                <a href="{{ route('home') }}" class="flex items-center gap-3 group">

                    <div class="w-12
                        h-12
                        rounded-[18px]
                        overflow-hidden
                        bg-white
                        ring-1
                        ring-slate-700
                        shadow-lg">

                        <img src="{{ asset('img/logo01.png') }}" class="w-full h-full object-cover">

                    </div>

                    <div class="leading-tight">

                        <h1 class="text-2xl font-black tracking-tight">

                            <span class="text-white">EDU</span>

                            <span class="text-amber-400">DOC</span>

                        </h1>

                        <p class="mt-0.5
                            text-[10px]
                            uppercase
                            tracking-[0.28em]
                            text-slate-500
                            font-semibold">

                            Learning Resources

                        </p>

                    </div>

                </a>

                <p class="text-sm leading-7 text-slate-400">

                    Nền tảng quản lý tài liệu môn học, hỗ trợ giảng viên đăng tải
                    học liệu và giúp sinh viên tìm kiếm tài liệu nhanh chóng,
                    tập trung và hiện đại.

                </p>



            </div>
            <!-- ================= TÀI LIỆU ================= -->

            <div>

                <h3 class="mb-6 text-base font-black uppercase tracking-wider text-white">

                    Tài liệu

                </h3>

                <ul class="space-y-4 text-sm">

                    <li>

                        <a href="#"
                            class="group flex items-center gap-3 text-slate-400 transition hover:text-amber-400">

                            <span
                                class="flex h-8 w-8 items-center justify-center rounded-xl border border-slate-700 bg-slate-800 transition group-hover:bg-amber-500 group-hover:text-white">

                                <i class="fa-solid fa-file-lines text-xs"></i>

                            </span>

                            Đề cương & Slide

                        </a>

                    </li>

                    <li>

                        <a href="#"
                            class="group flex items-center gap-3 text-slate-400 transition hover:text-amber-400">

                            <span
                                class="flex h-8 w-8 items-center justify-center rounded-xl border border-slate-700 bg-slate-800 transition group-hover:bg-amber-500 group-hover:text-white">

                                <i class="fa-solid fa-book-open text-xs"></i>

                            </span>

                            Bài tập & Ôn tập

                        </a>

                    </li>

                    <li>

                        <a href="#"
                            class="group flex items-center gap-3 text-slate-400 transition hover:text-amber-400">

                            <span
                                class="flex h-8 w-8 items-center justify-center rounded-xl border border-slate-700 bg-slate-800 transition group-hover:bg-amber-500 group-hover:text-white">

                                <i class="fa-solid fa-file-circle-check text-xs"></i>

                            </span>

                            Đề thi các năm

                        </a>

                    </li>

                </ul>

            </div>

            <!-- ================= HỆ THỐNG ================= -->

            <div>

                <h3 class="mb-6 text-base font-black uppercase tracking-wider text-white">

                    Hệ thống

                </h3>

                <ul class="space-y-4 text-sm">

                    <li>

                        <a href="#"
                            class="group flex items-center gap-3 text-slate-400 transition hover:text-amber-400">

                            <span
                                class="flex h-8 w-8 items-center justify-center rounded-xl border border-slate-700 bg-slate-800 transition group-hover:bg-amber-500 group-hover:text-white">

                                <i class="fa-solid fa-chalkboard-user text-xs"></i>

                            </span>

                            Dành cho giảng viên

                        </a>

                    </li>

                    <li>

                        <a href="#"
                            class="group flex items-center gap-3 text-slate-400 transition hover:text-amber-400">

                            <span
                                class="flex h-8 w-8 items-center justify-center rounded-xl border border-slate-700 bg-slate-800 transition group-hover:bg-amber-500 group-hover:text-white">

                                <i class="fa-solid fa-magnifying-glass text-xs"></i>

                            </span>

                            Tra cứu tài liệu

                        </a>

                    </li>

                    <li>

                        <a href="#"
                            class="group flex items-center gap-3 text-slate-400 transition hover:text-amber-400">

                            <span
                                class="flex h-8 w-8 items-center justify-center rounded-xl border border-slate-700 bg-slate-800 transition group-hover:bg-amber-500 group-hover:text-white">

                                <i class="fa-solid fa-shield-halved text-xs"></i>

                            </span>

                            Quản trị hệ thống

                        </a>

                    </li>

                </ul>

            </div> <!-- ================= HỖ TRỢ ================= -->

            <div>

                <h3 class="mb-6 text-base font-black uppercase tracking-wider text-white">

                    Hỗ trợ

                </h3>

                <div class="space-y-5 text-sm">

                    <!-- Email -->

                    <div class="flex items-start gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-700 bg-slate-800 text-amber-400">

                            <i class="fa-solid fa-envelope text-sm"></i>

                        </div>

                        <div>

                            <p class="mb-1 text-[11px] font-bold uppercase tracking-wider text-slate-500">

                                Email

                            </p>

                            <p class="font-semibold text-slate-300">

                                support@edudoc.vn

                            </p>

                        </div>

                    </div>

                    <!-- Lecturer -->

                    <div class="flex items-start gap-3">

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-700 bg-slate-800 text-amber-400">

                            <i class="fa-solid fa-user-tie text-sm"></i>

                        </div>

                        <div>

                            <p class="mb-1 text-[11px] font-bold uppercase tracking-wider text-slate-500">

                                GVHD

                            </p>

                            <p class="font-semibold text-slate-300">

                                Thầy Đỗ Trung Thuận

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- ================= FOOTER BOTTOM ================= -->

        <div class="mt-14 border-t border-slate-800 pt-8">

            <div class="flex flex-col items-center justify-between gap-4 md:flex-row">

                <p class="text-center text-xs text-slate-500 md:text-left">

                    © {{ date('Y') }}

                    <span class="font-semibold text-slate-300">

                        Đồ án tốt nghiệp

                    </span>

                    — Xây dựng Website quản lý tài liệu môn học.

                </p>

                <div class="flex items-center gap-3 text-xs">

                    <span
                        class="rounded-full border border-slate-700 bg-slate-800 px-3 py-1.5 font-bold text-slate-400">

                        Laravel 13

                    </span>

                    <span
                        class="rounded-full border border-amber-500/20 bg-amber-500/10 px-3 py-1.5 font-bold text-amber-400">

                        EDU DOC

                    </span>

                </div>

            </div>

        </div>

    </div>

</footer>