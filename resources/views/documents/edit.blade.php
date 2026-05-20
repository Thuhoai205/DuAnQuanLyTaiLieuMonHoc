@extends('layouts.app')

@section('title', 'Chỉnh sửa tài liệu')

@section('content')

<main class="min-h-screen bg-[#EAFBFF] py-12">

    <div class="max-w-6xl mx-auto px-6 sm:px-10 lg:px-16">

        <!-- BACK -->
        <a href="javascript:history.back()"
            class="inline-flex items-center gap-2 px-5 py-2.5 mb-8 rounded-full bg-white border border-cyan-100 text-cyan-700 font-bold text-sm hover:bg-cyan-50 transition">
            <i class="fa-solid fa-arrow-left"></i>
            Quay lại
        </a>

        <!-- HEADER -->
        <section class="mb-8 rounded-[32px] bg-cyan-600 text-white p-8 shadow-xl shadow-cyan-200/70">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">

                <div class="flex items-center gap-5">
                    <div
                        class="w-20 h-20 rounded-3xl bg-cyan-300 text-cyan-950 flex items-center justify-center shadow-xl">
                        <i class="fa-solid fa-pen-to-square text-3xl"></i>
                    </div>

                    <div>
                        <p class="text-cyan-100 text-xs font-black uppercase tracking-[0.25em] mb-2">
                            Quản lý học liệu
                        </p>

                        <h1 class="text-4xl font-black">
                            Chỉnh sửa tài liệu
                        </h1>

                        <p class="text-cyan-50 mt-2 font-semibold">
                            Cập nhật thông tin học liệu đã đăng tải.
                        </p>
                    </div>
                </div>

                <span
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-700/60 border border-cyan-300/30 text-cyan-50 text-xs font-black">
                    <i class="fa-solid fa-file-pdf"></i>
                    html-css.pdf
                </span>
            </div>
        </section>

        <!-- FORM -->
        <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- LEFT FORM -->
            <div
                class="lg:col-span-2 bg-white rounded-[32px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-7">

                <h2 class="text-2xl font-black text-cyan-950 mb-6">
                    Thông tin tài liệu
                </h2>

                <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- TIÊU ĐỀ -->
                    <div>
                        <label class="block text-xs font-black uppercase tracking-[0.18em] text-slate-400 mb-2">
                            Tiêu đề tài liệu
                        </label>

                        <input type="text" name="tieu_de" value="Slide HTML CSS"
                            class="w-full h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100 text-slate-800 font-bold outline-none focus:ring-2 focus:ring-cyan-300 focus:border-cyan-500 transition">
                    </div>

                    <!-- MÔN + LOẠI -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="block text-xs font-black uppercase tracking-[0.18em] text-slate-400 mb-2">
                                Môn học
                            </label>

                            <select name="ma_mon"
                                class="w-full h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100 text-slate-800 font-bold outline-none focus:ring-2 focus:ring-cyan-300 focus:border-cyan-500 transition">
                                <option value="WEB101" selected>Lập trình Web</option>
                                <option value="JAVA101">Lập trình Java</option>
                                <option value="CSDL">Cơ sở dữ liệu</option>
                                <option value="CTDL">Cấu trúc dữ liệu</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase tracking-[0.18em] text-slate-400 mb-2">
                                Loại tài liệu
                            </label>

                            <select name="loai_id"
                                class="w-full h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100 text-slate-800 font-bold outline-none focus:ring-2 focus:ring-cyan-300 focus:border-cyan-500 transition">
                                <option value="1" selected>Slide bài giảng</option>
                                <option value="2">Đề thi</option>
                                <option value="3">Bài tập</option>
                                <option value="4">Giáo trình</option>
                            </select>
                        </div>

                    </div>

                    <!-- FILE HIỆN TẠI -->
                    <div>
                        <label class="block text-xs font-black uppercase tracking-[0.18em] text-slate-400 mb-2">
                            File hiện tại
                        </label>

                        <div
                            class="flex items-center justify-between gap-4 p-5 rounded-2xl bg-cyan-50 border border-cyan-100">

                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 rounded-2xl bg-red-50 text-red-500 flex flex-col items-center justify-center border border-red-100">
                                    <i class="fa-solid fa-file-pdf text-2xl"></i>
                                    <span class="text-[9px] font-black mt-0.5">PDF</span>
                                </div>

                                <div>
                                    <h4 class="font-black text-slate-800">
                                        html-css.pdf
                                    </h4>

                                    <p class="text-sm text-slate-500 font-semibold mt-1">
                                        2 MB • 12 lượt tải
                                    </p>
                                </div>
                            </div>

                            <a href="#"
                                class="px-4 py-2 rounded-xl bg-white border border-cyan-100 text-cyan-700 font-bold hover:bg-cyan-100 transition">
                                <i class="fa-solid fa-eye mr-1"></i>
                                Xem
                            </a>
                        </div>
                    </div>

                    <!-- THAY FILE -->
                    <div>
                        <label class="block text-xs font-black uppercase tracking-[0.18em] text-slate-400 mb-2">
                            Thay file mới
                        </label>

                        <label
                            class="block cursor-pointer rounded-[28px] border-2 border-dashed border-cyan-200 bg-cyan-50/70 p-8 text-center hover:bg-cyan-50 transition">

                            <input type="file" name="file" class="hidden">

                            <div
                                class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200">
                                <i class="fa-solid fa-cloud-arrow-up text-2xl"></i>
                            </div>

                            <h4 class="text-slate-800 font-black">
                                Click để chọn file mới
                            </h4>

                            <p class="text-slate-500 text-sm font-semibold mt-2">
                                PDF, DOCX, PPTX, XLSX tối đa 50MB
                            </p>
                        </label>
                    </div>

                    <!-- MÔ TẢ -->
                    <div>
                        <label class="block text-xs font-black uppercase tracking-[0.18em] text-slate-400 mb-2">
                            Mô tả tài liệu
                        </label>

                        <textarea name="mo_ta" rows="5"
                            class="w-full px-5 py-4 rounded-2xl bg-cyan-50 border border-cyan-100 text-slate-800 font-semibold outline-none focus:ring-2 focus:ring-cyan-300 focus:border-cyan-500 transition resize-none">Slide HTML CSS cơ bản</textarea>
                    </div>

                    <!-- PUBLIC -->
                    <div
                        class="flex items-center justify-between gap-4 p-5 rounded-2xl bg-cyan-50 border border-cyan-100">

                        <div>
                            <h4 class="font-black text-slate-800">
                                Công khai tài liệu
                            </h4>

                            <p class="text-sm text-slate-500 font-semibold mt-1">
                                Sinh viên có thể xem và tải tài liệu này.
                            </p>
                        </div>

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div
                                class="w-14 h-8 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:bg-cyan-500 transition">
                            </div>
                            <div
                                class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full transition peer-checked:translate-x-6 shadow">
                            </div>
                        </label>
                    </div>

                    <!-- ACTIONS -->
                    <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-4">

                        <a href="javascript:history.back()"
                            class="w-full sm:w-auto px-7 py-3 rounded-2xl border border-cyan-100 text-slate-600 font-black hover:bg-cyan-50 transition text-center">
                            Hủy
                        </a>

                        <button type="button"
                            class="w-full sm:w-auto px-8 py-3 rounded-2xl bg-cyan-500 text-white font-black hover:bg-cyan-600 shadow-lg shadow-cyan-200 transition">
                            <i class="fa-solid fa-floppy-disk mr-2"></i>
                            Lưu thay đổi
                        </button>
                    </div>

                </form>
            </div>

            <!-- RIGHT INFO -->
            <aside class="space-y-6">

                <!-- PREVIEW -->
                <div
                    class="bg-white rounded-[32px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-6">
                    <h3 class="text-xl font-black text-cyan-950 mb-5">
                        Xem nhanh
                    </h3>

                    <div
                        class="min-h-[260px] rounded-[28px] bg-cyan-50 border-2 border-dashed border-cyan-200 flex flex-col items-center justify-center text-center p-6">

                        <div class="w-20 h-20 rounded-3xl bg-red-50 text-red-500 flex items-center justify-center mb-4">
                            <i class="fa-solid fa-file-pdf text-4xl"></i>
                        </div>

                        <h4 class="font-black text-slate-800">
                            Slide HTML CSS
                        </h4>

                        <p class="text-slate-500 text-sm font-semibold mt-2">
                            uploads/html-css.pdf
                        </p>
                    </div>
                </div>

                <!-- META -->
                <div
                    class="bg-white rounded-[32px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-6">
                    <h3 class="text-xl font-black text-cyan-950 mb-5">
                        Thông tin hệ thống
                    </h3>

                    <div class="space-y-4">

                        <div class="flex items-center gap-4">
                            <div
                                class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                                <i class="fa-solid fa-link"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-black uppercase">Slug</p>
                                <p class="text-slate-800 font-bold">slide-html-css</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div
                                class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-black uppercase">Người upload</p>
                                <p class="text-slate-800 font-bold">Bạn</p>
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

                        <div class="flex items-center gap-4">
                            <div
                                class="w-11 h-11 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-black uppercase">Trạng thái</p>
                                <p class="text-cyan-600 font-black">Công khai</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- DANGER -->
                <div class="bg-white rounded-[32px] border border-red-100 shadow-sm p-6">
                    <h3 class="text-xl font-black text-red-500 mb-3">
                        Vùng nguy hiểm
                    </h3>

                    <p class="text-slate-500 text-sm font-semibold leading-relaxed mb-5">
                        Xóa tài liệu sẽ làm tài liệu không còn hiển thị trong hệ thống.
                    </p>

                    <button type="button"
                        class="w-full py-3 rounded-2xl bg-red-50 text-red-500 font-black border border-red-100 hover:bg-red-500 hover:text-white transition">
                        <i class="fa-solid fa-trash mr-2"></i>
                        Xóa tài liệu
                    </button>
                </div>

            </aside>

        </section>

    </div>
</main>

@endsection