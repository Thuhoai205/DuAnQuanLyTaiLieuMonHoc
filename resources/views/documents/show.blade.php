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

                    <!-- HEADER -->
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
                                html-css.pdf • WEB101 • 12 lượt tải
                            </p>
                        </div>
                    </div>

                    <!-- PREVIEW -->
                    <div class="bg-cyan-50/50 p-6">

                        <div class="bg-white rounded-[28px] border border-cyan-100 overflow-hidden">

                            <!-- PREVIEW TOP BAR -->
                            <div class="px-5 py-4 bg-cyan-600 text-white flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-cyan-300 text-cyan-950 flex items-center justify-center">
                                        <i class="fa-solid fa-eye"></i>
                                    </div>

                                    <div>
                                        <h3 class="font-black">
                                            Xem trước tài liệu
                                        </h3>
                                        <p class="text-cyan-100 text-xs font-semibold">
                                            Sinh viên có thể xem nội dung trước khi tải
                                        </p>
                                    </div>
                                </div>

                                <span
                                    class="hidden sm:inline-flex px-3 py-1 rounded-full bg-cyan-700 text-cyan-50 text-xs font-bold">
                                    PDF Preview
                                </span>
                            </div>

                            <!-- PDF VIEWER MOCK -->
                            <div class="min-h-[560px] bg-slate-100 p-6 flex justify-center">

                                <a href="{{ route('documents.show', 1) }}"
                                    class="w-full max-w-3xl bg-white rounded-2xl shadow-lg border border-slate-200 p-8">

                                    <!-- Mock page -->
                                    <div class="border-b border-slate-200 pb-5 mb-6">
                                        <p class="text-xs font-black uppercase tracking-[0.2em] text-cyan-600">
                                            EDU DOC
                                        </p>

                                        <h2 class="text-3xl font-black text-slate-900 mt-3">
                                            Slide HTML CSS cơ bản
                                        </h2>

                                        <p class="text-slate-500 font-semibold mt-2">
                                            Môn học: Lập trình Web - WEB101
                                        </p>
                                    </div>

                                    <div class="space-y-5">
                                        <div>
                                            <h3 class="text-xl font-black text-cyan-700 mb-2">
                                                1. Giới thiệu HTML
                                            </h3>
                                            <p class="text-slate-600 leading-relaxed">
                                                HTML là ngôn ngữ đánh dấu dùng để xây dựng cấu trúc nội dung của trang
                                                web.
                                                Một tài liệu HTML thường bao gồm phần tiêu đề, nội dung và các thẻ định
                                                dạng.
                                            </p>
                                        </div>

                                        <div>
                                            <h3 class="text-xl font-black text-cyan-700 mb-2">
                                                2. Giới thiệu CSS
                                            </h3>
                                            <p class="text-slate-600 leading-relaxed">
                                                CSS được sử dụng để định dạng giao diện, màu sắc, bố cục và hiệu ứng
                                                hiển thị
                                                cho các thành phần HTML trên website.
                                            </p>
                                        </div>

                                        <div class="grid grid-cols-2 gap-4 mt-6">
                                            <div class="bg-cyan-50 border border-cyan-100 rounded-2xl p-5">
                                                <i class="fa-solid fa-code text-cyan-600 text-2xl mb-3"></i>
                                                <h4 class="font-black text-slate-800">HTML</h4>
                                                <p class="text-sm text-slate-500 mt-1">Xây dựng cấu trúc trang</p>
                                            </div>

                                            <div class="bg-cyan-50 border border-cyan-100 rounded-2xl p-5">
                                                <i class="fa-solid fa-palette text-cyan-600 text-2xl mb-3"></i>
                                                <h4 class="font-black text-slate-800">CSS</h4>
                                                <p class="text-sm text-slate-500 mt-1">Thiết kế giao diện</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-8 pt-5 border-t border-slate-200 text-center">
                                        <p class="text-slate-400 text-sm font-semibold">
                                            Trang xem trước UI mẫu - chưa kết nối backend
                                        </p>
                                    </div>
                                </a>
                            </div>



                        </div>
                    </div>
                </div>

            </section>

            <!-- RIGHT INFO -->
            <aside class="space-y-6">

                <!-- ACTION -->
                <div
                    class="bg-white rounded-[32px] border border-cyan-100 p-6 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
                    @if(Auth::check())
                    <button
                        class="px-5 py-2.5 bg-cyan-500 text-white font-bold rounded-xl hover:bg-cyan-600 transition-all flex items-center gap-2 text-sm shadow-lg shadow-cyan-200">
                        <i class="fa-solid fa-cloud-arrow-down"></i>
                        Tải về
                    </button>
                    @else
                    <button onclick="showLoginRequiredModal()"
                        class="px-5 py-2.5 border-2 border-cyan-100 text-cyan-700 font-bold rounded-xl hover:bg-cyan-50 transition-all flex items-center gap-2 text-sm">
                        <i class="fa-solid fa-lock"></i>
                        Đăng nhập để tải
                    </button>
                    @endif

                    @if(Auth::check() && Auth::user()->role_id == 2)
                    <div class="grid grid-cols-2 gap-3 mt-4">
                        <a href="{{ route('documents.edit', 1) }}"
                            class="py-3 rounded-2xl bg-amber-50 text-amber-600 font-black border border-amber-100 hover:bg-amber-500 hover:text-white transition text-center">
                            <i class="fa-solid fa-pen-to-square mr-1"></i>
                            Sửa
                        </a>

                        <button
                            class="py-3 rounded-2xl bg-red-50 text-red-500 font-black border border-red-100 hover:bg-red-500 hover:text-white transition">
                            <i class="fa-solid fa-trash mr-1"></i>
                            Xóa
                        </button>
                    </div>
                    @endif
                </div>

                <!-- INFO -->
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
                        Slide HTML CSS cơ bản, phù hợp cho sinh viên bắt đầu học lập trình giao diện web.
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

                <a href="{{ route('documents.show', 1) }}"
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
                </a>

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
<script>
function showLoginRequiredModal() {
    const modal = document.getElementById('loginRequiredModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLoginRequiredModal() {
    const modal = document.getElementById('loginRequiredModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}
</script>