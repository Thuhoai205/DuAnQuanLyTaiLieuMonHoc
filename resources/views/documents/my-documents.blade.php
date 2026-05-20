@extends('layouts.app')

@section('title', 'Học liệu cá nhân')

@section('content')

<main class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/40 to-indigo-50/50 relative overflow-hidden">

    <!-- BACKGROUND SÁNG -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-24 -left-24 w-[420px] h-[420px] bg-blue-200/45 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -right-20 w-[420px] h-[420px] bg-cyan-200/45 rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-120px] left-1/3 w-[520px] h-[520px] bg-indigo-200/35 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 md:px-6 py-10">

        <!-- HEADER -->
        <section class="mb-8 bg-white/85 backdrop-blur-xl border border-white rounded-[32px] shadow-sm p-6 md:p-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                <div>
                    <a href="javascript:history.back()"
                        class="inline-flex items-center gap-2 mb-6 px-5 py-2.5 rounded-full bg-slate-100 hover:bg-cyan-50 text-slate-600 hover:text-cyan-600 text-xs font-black uppercase tracking-wider transition-all">
                        <i class="fa-solid fa-arrow-left"></i>
                        Quay lại
                    </a>

                    <div class="flex items-center gap-4">
                        <div
                            class="w-16 h-16 rounded-3xl bg-cyan-100 text-cyan-600 flex items-center justify-center shadow-lg shadow-cyan-200/70">
                            <i class="fa-solid fa-folder-open text-2xl"></i>
                        </div>

                        <div>
                            <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                                Học liệu cá nhân
                            </h1>
                            <p class="text-slate-500 mt-2 text-base md:text-lg">
                                Quản lý tài liệu bạn đã đăng tải theo từng môn học.
                            </p>
                        </div>
                    </div>
                </div>
                <button onclick="toggleModal('uploadModal')" class="inline-flex items-center justify-center gap-3 px-7 py-4 rounded-2xl
    bg-cyan-500 hover:bg-cyan-600
    text-white font-bold text-sm
    shadow-lg shadow-cyan-200
    hover:shadow-cyan-300
    transition-all duration-300">

                    <span class="w-7 h-7 flex items-center justify-center
        bg-cyan-400 rounded-xl border border-cyan-300">

                        <i class="fas fa-plus text-sm text-white"></i>
                    </span>

                    Tải lên tài liệu
                </button>
            </div>
        </section>

        <!-- STATS -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div
                class="bg-white/90 backdrop-blur-xl p-7 rounded-[28px] shadow-sm border border-white hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-400 text-sm font-black uppercase tracking-wider mb-1">Tài liệu đã đăng</p>
                        <h3 class="text-3xl font-black text-slate-900">24</h3>
                    </div>
                    <div
                        class="w-16 h-16 bg-cyan-100 text-cyan-600 rounded-3xl flex items-center justify-center shadow-lg shadow-cyan-200/70">
                        <i class="fa-solid fa-file-lines text-2xl"></i>
                    </div>
                </div>
                <p class="mt-4 text-xs font-semibold text-slate-400">Tổng số học liệu của bạn</p>
            </div>

            <div
                class="bg-white/90 backdrop-blur-xl p-7 rounded-[28px] shadow-sm border border-white hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-400 text-sm font-black uppercase tracking-wider mb-1">Môn phụ trách</p>
                        <h3 class="text-3xl font-black text-slate-900">5</h3>
                    </div>
                    <div
                        class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-3xl flex items-center justify-center shadow-lg shadow-indigo-200/70">
                        <i class="fa-solid fa-graduation-cap text-2xl"></i>
                    </div>
                </div>
                <p class="mt-4 text-xs font-semibold text-slate-400">Lọc tài liệu theo môn học</p>
            </div>

            <div
                class="bg-white/90 backdrop-blur-xl p-7 rounded-[28px] shadow-sm border border-white hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-400 text-sm font-black uppercase tracking-wider mb-1">Tổng lượt tải</p>
                        <h3 class="text-3xl font-black text-cyan-600">1,420</h3>
                    </div>
                    <div
                        class="w-16 h-16 bg-sky-100 text-sky-600 rounded-3xl flex items-center justify-center shadow-lg shadow-sky-200/70">
                        <i class="fa-solid fa-cloud-arrow-down text-2xl"></i>
                    </div>
                </div>
                <p class="mt-4 text-xs font-semibold text-slate-400">Thống kê lượt tải tài liệu</p>
            </div>
        </section>

        <!-- FILTER THEO MÔN -->
        <section class="mb-8 bg-white/90 backdrop-blur-xl border border-white rounded-[28px] shadow-sm p-5">
            <form method="GET" action="{{ url()->current() }}"
                class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-4">

                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-slate-400 mb-2">
                        Môn học
                    </label>
                    <select name="ma_mon"
                        class="w-full h-12 px-4 rounded-2xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-700 outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        <option value="">Tất cả môn học</option>

                        {{-- UI mẫu khi chưa có backend --}}
                        <option value="WEB101">Lập trình Web</option>
                        <option value="CSDL">Cơ sở dữ liệu</option>
                        <option value="JAVA101">Lập trình Java</option>
                        <option value="CTDL">Cấu trúc dữ liệu</option>


                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-wider text-slate-400 mb-2">
                        Loại tài liệu
                    </label>
                    <select name="loai_id"
                        class="w-full h-12 px-4 rounded-2xl bg-slate-50 border border-slate-200 text-sm font-semibold text-slate-700 outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                        <option value="">Tất cả loại</option>
                        <option value="1">Slide bài giảng</option>
                        <option value="2">Đề thi</option>
                        <option value="3">Đề cương</option>
                        <option value="4">Bài tập</option>
                    </select>
                </div>

                <div class="xl:col-span-2">
                    <label class="block text-xs font-black uppercase tracking-wider text-slate-400 mb-2">
                        Tìm kiếm
                    </label>
                    <div class="relative">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                        <input type="text" name="keyword" value="{{ request('keyword') }}"
                            placeholder="Nhập tên tài liệu..."
                            class="w-full h-12 pl-11 pr-4 rounded-2xl bg-slate-50 border border-slate-200 text-sm text-slate-700 font-medium focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>
                </div>

                <div class="flex items-end gap-3">
                    <button type="submit"
                        class="flex-1 h-12 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-lg shadow-blue-100 transition-all">
                        <i class="fas fa-filter mr-2"></i>
                        Lọc
                    </button>

                    <a href="{{ url()->current() }}"
                        class="h-12 w-12 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center transition-all">
                        <i class="fas fa-rotate-right"></i>
                    </a>
                </div>
            </form>
        </section>

        <!-- TABLE -->
        <section class="bg-white/95 backdrop-blur-xl rounded-[32px] shadow-sm border border-white overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-0">
                    <thead>
                        <tr class="bg-slate-50/90">
                            <th
                                class="px-8 py-5 text-[11px] font-black uppercase tracking-[0.1em] text-slate-400 border-b border-slate-100">
                                Tài liệu</th>
                            <th
                                class="px-8 py-5 text-[11px] font-black uppercase tracking-[0.1em] text-slate-400 border-b border-slate-100">
                                Môn học</th>
                            <th
                                class="px-8 py-5 text-[11px] font-black uppercase tracking-[0.1em] text-slate-400 border-b border-slate-100">
                                Người đăng</th>
                            <th
                                class="px-8 py-5 text-[11px] font-black uppercase tracking-[0.1em] text-slate-400 border-b border-slate-100 text-center">
                                Lượt tải</th>
                            <th
                                class="px-8 py-5 text-[11px] font-black uppercase tracking-[0.1em] text-slate-400 border-b border-slate-100 text-right">
                                Hành động</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        {{-- DÒNG MẪU 1: Tài liệu của mình nên có nút Sửa/Xóa --}}
                        <tr class="group hover:bg-cyan-50/50 transition-all duration-300">
                            <td class="px-8 py-6">

                                <a href="{{ route('documents.show', 1) }}"
                                    class="group flex items-center rounded-2xl hover:bg-cyan-50/70 transition-all duration-300 p-3 -m-3">

                                    <!-- ICON -->
                                    <div class="w-14 h-14 rounded-2xl
            bg-red-50 text-red-500
            flex items-center justify-center
            shadow-sm
            group-hover:bg-red-500
            group-hover:text-white
            transition-all duration-300">

                                        <i class="fas fa-file-pdf text-2xl"></i>
                                    </div>

                                    <!-- CONTENT -->
                                    <div class="ml-5">

                                        <h4 class="text-[16px] font-bold text-slate-800
                leading-tight
                group-hover:text-cyan-600
                transition-colors">

                                            Đề cương ôn tập cuối kỳ
                                        </h4>

                                        <p class="text-[12px] text-slate-400 mt-1.5 font-semibold">

                                            PDF
                                            <span class="mx-1">•</span>

                                            2.4 MB
                                            <span class="mx-1">•</span>

                                            20/10/2026
                                        </p>

                                    </div>

                                </a>

                            </td>

                            <td class="px-8 py-6">
                                <span
                                    class="inline-flex items-center px-4 py-1.5 rounded-xl bg-indigo-50 text-indigo-600 text-[11px] font-black uppercase tracking-wider border border-indigo-100">
                                    Lập trình Web
                                </span>
                            </td>

                            <td class="px-8 py-6 text-sm text-slate-500 font-bold">
                                Bạn
                            </td>

                            <td class="px-8 py-6 text-center">
                                <div
                                    class="inline-flex items-center px-4 py-2 bg-slate-100 text-slate-700 rounded-2xl text-xs font-black">
                                    <i class="fas fa-download mr-2 text-blue-500"></i>
                                    142
                                </div>
                            </td>

                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end items-center gap-3">
                                    <button
                                        class="w-10 h-10 flex items-center justify-center text-blue-500 hover:bg-cyan-500 hover:text-white rounded-xl transition-all shadow-sm bg-white border border-blue-100"
                                        title="Tải xuống">
                                        <i class="fas fa-cloud-download-alt"></i>
                                    </button>

                                    <a href="{{ route('documents.edit', 1) }}" class="w-10 h-10 flex items-center justify-center
    text-amber-500 hover:bg-amber-500 hover:text-white
    rounded-xl transition-all duration-300
    shadow-sm bg-white border border-amber-100" title="Sửa">

                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    </a>
                                    <button
                                        class="w-10 h-10 flex items-center justify-center text-red-500 hover:bg-red-600 hover:text-white rounded-xl transition-all shadow-sm bg-white border border-red-100"
                                        title="Xóa">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div
                class="px-8 py-6 bg-slate-50/70 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">
                    Trang <span class="text-slate-800">1</span> của 5
                </p>

                <div class="flex gap-2">
                    <button
                        class="px-5 py-2.5 text-xs font-black uppercase tracking-widest text-slate-500 hover:bg-white hover:shadow-sm rounded-xl transition-all">
                        Trước
                    </button>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-xl bg-blue-600 text-white font-black shadow-lg shadow-cyan-200/70 text-sm">
                        1
                    </button>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-500 hover:bg-white hover:shadow-sm font-black text-sm transition-all">
                        2
                    </button>
                    <button
                        class="px-5 py-2.5 text-xs font-black uppercase tracking-widest text-cyan-600 hover:bg-white hover:shadow-sm rounded-xl transition-all">
                        Sau
                    </button>
                </div>
            </div>
        </section>
    </div>
</main>

<!-- MODAL UPLOAD -->
<div id="uploadModal"
    class="fixed inset-0 bg-slate-900/40 hidden items-center justify-center z-50 backdrop-blur-sm px-4">
    <div class="bg-white w-full max-w-xl rounded-[2rem] shadow-2xl overflow-hidden">
        <div class="flex justify-between items-center px-6 py-5 border-b bg-slate-50">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-cyan-100 to-sky-100 text-cyan-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-file-upload"></i>
                </div>

                <div>
                    <h3 class="text-sm font-bold uppercase text-slate-800">
                        Đăng tải học liệu mới
                    </h3>
                    <p class="text-xs text-slate-400">
                        Chọn môn học trước khi đăng tài liệu
                    </p>
                </div>
            </div>

            <button onclick="toggleModal('uploadModal')" class="text-slate-400 hover:text-red-500 transition">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form action="#" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf

            <label
                class="block border-2 border-dashed border-blue-300 rounded-2xl p-8 text-center cursor-pointer hover:bg-cyan-50 transition">
                <input type="file" name="file" class="hidden">

                <div
                    class="w-14 h-14 mx-auto mb-3 bg-blue-600 text-white flex items-center justify-center rounded-xl shadow">
                    <i class="fas fa-file-import"></i>
                </div>

                <p class="text-sm font-semibold text-slate-700">
                    Kéo thả file hoặc click để chọn
                </p>

                <p class="text-xs text-slate-400 mt-1">
                    PDF, DOCX, PPTX, XLSX tối đa 50MB
                </p>
            </label>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-slate-400 font-semibold">Tiêu đề</label>
                    <input type="text" name="ten_tai_lieu"
                        class="w-full mt-1 bg-slate-100 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="VD: Đề thi cuối kỳ...">
                </div>

                <div>
                    <label class="text-xs text-slate-400 font-semibold">Môn học</label>
                    <select name="ma_mon"
                        class="w-full mt-1 bg-slate-100 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Chọn môn học</option>
                        <option value="WEB101">Lập trình Web</option>
                        <option value="CSDL">Cơ sở dữ liệu</option>
                        <option value="JAVA101">Lập trình Java</option>
                        <option value="CTDL">Cấu trúc dữ liệu</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="text-xs text-slate-400 font-semibold">Loại học liệu</label>
                <select name="loai_id"
                    class="w-full mt-1 bg-slate-100 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Chọn loại học liệu</option>
                    <option value="1">Slide bài giảng</option>
                    <option value="2">Đề thi</option>
                    <option value="3">Đề cương</option>
                    <option value="4">Bài tập</option>
                </select>
            </div>

            <div>
                <label class="text-xs text-slate-400 font-semibold">Mô tả</label>
                <textarea name="mo_ta" rows="3"
                    class="w-full mt-1 bg-slate-100 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Nhập mô tả tài liệu..."></textarea>
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-sky-500 via-cyan-500 to-teal-500 text-white py-3 rounded-xl font-bold shadow-lg hover:scale-[1.02] transition">
                XÁC NHẬN ĐĂNG TÀI LIỆU
            </button>
        </form>
    </div>
</div>

@endsection

<script>
function toggleModal(id) {
    const modal = document.getElementById(id);
    modal.classList.toggle('hidden');
    modal.classList.toggle('flex');

    document.body.style.overflow = modal.classList.contains('hidden') ? 'auto' : 'hidden';
}

window.onclick = function(event) {
    const modal = document.getElementById('uploadModal');
    if (event.target == modal) {
        toggleModal('uploadModal');
    }
}
</script>