@extends('layouts.app')

@section('title', 'Chi tiết tài liệu')

@section('content')

<main class="min-h-screen bg-[#EAFBFF] py-12">

    <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16">

        <!-- BACK -->
        <a href="javascript:history.back()"
            class="inline-flex items-center gap-2 px-5 py-2.5 mb-8 rounded-full bg-white border border-cyan-100 text-cyan-700 font-bold text-sm hover:bg-cyan-50 transition">
            <i class="fa-solid fa-arrow-left"></i>
            Quay lại
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- LEFT: PREVIEW -->
            <section class="lg:col-span-2">

                <div
                    class="bg-white rounded-[32px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] overflow-hidden">

                    <!-- FILE HEADER -->
                    <div class="p-7 border-b border-cyan-100 flex items-center gap-5">
                        <div
                            class="w-20 h-20 rounded-3xl bg-red-50 text-red-500 flex flex-col items-center justify-center border border-red-100">
                            <i class="fa-solid fa-file-pdf text-3xl"></i>
                            <span class="text-[10px] font-black mt-1">PDF</span>
                        </div>

                        <div>
                            <h1 class="text-3xl font-black text-slate-900">
                                Slide HTML CSS
                            </h1>

                            <p class="text-slate-500 mt-2 font-semibold">
                                html-css.pdf
                            </p>
                        </div>
                    </div>

                    <!-- PREVIEW AREA -->
                    <div class="p-8 bg-cyan-50/50">
                        <div
                            class="min-h-[520px] bg-white border-2 border-dashed border-cyan-200 rounded-[28px] flex flex-col items-center justify-center text-center p-8">

                            <div
                                class="w-28 h-28 rounded-[32px] bg-red-50 text-red-500 flex items-center justify-center mb-6">
                                <i class="fa-solid fa-file-pdf text-5xl"></i>
                            </div>

                            <h2 class="text-2xl font-black text-slate-800 mb-3">
                                Xem trước tài liệu
                            </h2>

                            <p class="text-slate-500 max-w-md leading-relaxed font-medium">
                                Đây là khu vực preview file. Khi làm backend, bạn có thể nhúng PDF bằng iframe từ đường
                                dẫn:
                                <span class="text-cyan-600 font-bold">uploads/html-css.pdf</span>
                            </p>

                            <div class="mt-8 flex flex-wrap justify-center gap-3">
                                <a href="#"
                                    class="px-6 py-3 rounded-2xl bg-cyan-500 text-white font-black hover:bg-cyan-600 shadow-lg shadow-cyan-200 transition">
                                    <i class="fa-solid fa-eye mr-2"></i>
                                    Xem online
                                </a>

                                <a href="#"
                                    class="px-6 py-3 rounded-2xl bg-white border border-cyan-100 text-cyan-700 font-black hover:bg-cyan-50 transition">
                                    <i class="fa-solid fa-download mr-2"></i>
                                    Tải xuống
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <!-- RIGHT: INFO -->
            <aside class="space-y-6">

                <!-- ACTION CARD -->
                <div
                    class="bg-white rounded-[32px] border border-cyan-100 p-6 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">

                    <button
                        class="w-full py-4 rounded-2xl bg-cyan-500 text-white font-black hover:bg-cyan-600 shadow-lg shadow-cyan-200 transition">
                        <i class="fa-solid fa-cloud-arrow-down mr-2"></i>
                        Tải tài liệu
                    </button>

                    <!-- Nếu là tài liệu của giảng viên đang đăng nhập thì hiện Sửa/Xóa -->
                    @if(Auth::check() && Auth::user()->role_id == 2)
                    <div class="grid grid-cols-2 gap-3 mt-4">
                        <button
                            class="py-3 rounded-2xl bg-amber-50 text-amber-600 font-black border border-amber-100 hover:bg-amber-500 hover:text-white transition">
                            <i class="fa-solid fa-pen-to-square mr-2"></i>
                            Sửa
                        </button>

                        <button
                            class="py-3 rounded-2xl bg-red-50 text-red-500 font-black border border-red-100 hover:bg-red-500 hover:text-white transition">
                            <i class="fa-solid fa-trash mr-2"></i>
                            Xóa
                        </button>
                    </div>
                    @endif
                </div>

                <!-- INFO CARD -->
                <div
                    class="bg-white rounded-[32px] border border-cyan-100 p-6 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">

                    <h3 class="text-xl font-black text-cyan-950 mb-5">
                        Thông tin tài liệu
                    </h3>

                    <div class="space-y-4">

                        <div class="flex items-center gap-4">
                            <div
                                class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                                <i class="fa-solid fa-book"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-black uppercase">Môn học</p>
                                <p class="text-slate-800 font-bold">WEB101 - Lập trình Web</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div
                                class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                                <i class="fa-solid fa-layer-group"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-black uppercase">Loại tài liệu</p>
                                <p class="text-slate-800 font-bold">Slide bài giảng</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div
                                class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-black uppercase">Người upload</p>
                                <p class="text-slate-800 font-bold">Giảng viên #2</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div
                                class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                                <i class="fa-solid fa-file"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-black uppercase">Định dạng</p>
                                <p class="text-slate-800 font-bold">PDF</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div
                                class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                                <i class="fa-solid fa-hard-drive"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-black uppercase">Kích thước</p>
                                <p class="text-slate-800 font-bold">2 MB</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div
                                class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                                <i class="fa-solid fa-download"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-black uppercase">Lượt tải</p>
                                <p class="text-slate-800 font-bold">12 lượt</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div
                    class="bg-white rounded-[32px] border border-cyan-100 p-6 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
                    <h3 class="text-xl font-black text-cyan-950 mb-3">
                        Mô tả
                    </h3>

                    <p class="text-slate-600 leading-relaxed font-medium">
                        Slide HTML CSS cơ bản.
                    </p>
                </div>

            </aside>
        </div>

        <!-- RELATED -->
        <section class="mt-10">
            <h2 class="text-2xl font-black text-cyan-950 mb-5">
                Tài liệu liên quan
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div
                    class="bg-white rounded-[28px] border border-cyan-100 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-file-word text-2xl"></i>
                    </div>

                    <h3 class="font-black text-slate-800 mb-2">
                        Đề thi Java
                    </h3>

                    <p class="text-slate-500 text-sm font-semibold">
                        JAVA101 • DOCX • 5 lượt tải
                    </p>
                </div>

                <div
                    class="bg-white rounded-[28px] border border-cyan-100 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-14 h-14 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-file-pdf text-2xl"></i>
                    </div>

                    <h3 class="font-black text-slate-800 mb-2">
                        Slide HTML nâng cao
                    </h3>

                    <p class="text-slate-500 text-sm font-semibold">
                        WEB101 • PDF • 20 lượt tải
                    </p>
                </div>

                <div
                    class="bg-white rounded-[28px] border border-cyan-100 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">
                    <div
                        class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-file-powerpoint text-2xl"></i>
                    </div>

                    <h3 class="font-black text-slate-800 mb-2">
                        Slide CSS Layout
                    </h3>

                    <p class="text-slate-500 text-sm font-semibold">
                        WEB101 • PPTX • 18 lượt tải
                    </p>
                </div>

            </div>
        </section>

    </div>
</main>

@endsection