@extends('layouts.app')

@section('title', 'Kho học liệu cá nhân')


@section('content')

<main class="max-w-7xl mx-auto px-6 py-12 bg-[#f8fafc]">
    <div class="mb-10">
        <a href="javascript:history.back()"
            class="group inline-flex items-center gap-2.5 px-6 py-3 bg-white border border-slate-100 text-slate-600 hover:text-orange-500 font-bold text-xs uppercase tracking-wider rounded-full shadow-[0_4px_20px_-4px_rgba(0,0,0,0.04)] hover:shadow-orange-500/20 hover:-translate-x-1 hover:border-orange-200 transition-all duration-300 active:scale-95">

            <i
                class="fas fa-arrow-left text-slate-400 group-hover:text-orange-500 transition-all duration-300 group-hover:-translate-x-0.5">
            </i>

            <span class="group-hover:text-orange-500 transition-colors duration-300">
                Quay lại
            </span>
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div
            class="bg-white p-7 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-white hover:border-blue-100 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">Tổng tài liệu</p>
                    <h3 class="text-3xl font-black text-slate-800">1,284</h3>
                </div>
                <div
                    class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-all">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs font-semibold text-green-500">
                <i class="fas fa-arrow-up mr-1"></i> +12% tháng này
            </div>
        </div>

        <div
            class="bg-white p-7 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-white hover:border-indigo-100 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">Môn học</p>
                    <h3 class="text-3xl font-black text-slate-800">42</h3>
                </div>
                <div
                    class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-all">
                    <i class="fas fa-graduation-cap text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs font-semibold text-slate-400">
                Cập nhật mới nhất hôm nay
            </div>
        </div>

        <div
            class="bg-white p-7 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-white hover:border-blue-100 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">Tổng lượt tải</p>
                    <h3 class="text-3xl font-black text-blue-600">8,902</h3>
                </div>
                <div
                    class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-all">
                    <i class="fas fa-cloud-download-alt text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs font-semibold text-blue-400">
                Tăng trưởng ổn định
            </div>
        </div>
    </div>

    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h2 class="text-4xl font-black text-slate-900 tracking-tight">Kho học liệu cá nhân</h2>
            <p class="text-slate-500 mt-2 text-lg">Quản lý và theo dõi các tài liệu đã đăng tải hiệu quả.</p>
        </div>
        <div
            class="flex flex-col lg:flex-row lg:items-center gap-4 bg-white shadow-sm border border-slate-200 rounded-2xl p-3 md:p-4">

            <!-- FILTER -->
            <select
                class="w-full lg:w-[200px] bg-transparent px-4 py-3 text-sm font-bold text-slate-600 outline-none border border-slate-100 rounded-xl cursor-pointer">
                <option>Tất cả loại</option>
                <option>Slide bài giảng</option>
                <option>Đề thi</option>
            </select>

            <!-- SEARCH -->
            <div class="relative flex-1 min-w-[200px]">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                <input type="text" placeholder="Tìm tên tài liệu..."
                    class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-100 rounded-xl text-sm text-slate-700 font-medium focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
            </div>

            <!-- BUTTON UPLOAD -->
            <button onclick="toggleModal('uploadModal')"
                class="w-full lg:w-auto shrink-0 flex items-center justify-center gap-3 px-6 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl font-bold text-sm shadow-lg hover:shadow-blue-500/30 transition-all active:scale-95">

                <div class="w-5 h-5 flex items-center justify-center bg-white/20 rounded-md">
                    <i class="fas fa-plus text-xs"></i>
                </div>

                <span>Tải lên tài liệu</span>

            </button>

        </div>
    </div>

    <div
        class="bg-white rounded-[32px] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-slate-100 overflow-hidden transition-all">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-separate border-spacing-0">
                <thead>
                    <tr class="bg-slate-50/80">
                        <th
                            class="px-10 py-5 text-[11px] font-black uppercase tracking-[0.1em] text-slate-400 border-b border-slate-100">
                            Thông tin tài liệu</th>
                        <th
                            class="px-10 py-5 text-[11px] font-black uppercase tracking-[0.1em] text-slate-400 border-b border-slate-100">
                            Môn học</th>
                        <th
                            class="px-10 py-5 text-[11px] font-black uppercase tracking-[0.1em] text-slate-400 border-b border-slate-100">
                            Ngày đăng</th>
                        <th
                            class="px-10 py-5 text-[11px] font-black uppercase tracking-[0.1em] text-slate-400 border-b border-slate-100 text-center">
                            Lượt tải</th>
                        <th
                            class="px-10 py-5 text-[11px] font-black uppercase tracking-[0.1em] text-slate-400 border-b border-slate-100 text-right">
                            Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                        <td class="px-10 py-7">
                            <a href="/duong-dan-den-file/de-cuong.pdf" target="_blank"
                                class="flex items-center cursor-pointer group/item">
                                <div
                                    class="w-14 h-14 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center shadow-sm group-hover:bg-red-500 group-hover:text-white transition-all duration-300">
                                    <i class="fas fa-file-pdf text-2xl"></i>
                                </div>
                                <div class="ml-5">
                                    <h4
                                        class="text-[16px] font-bold text-slate-800 leading-tight group-hover:text-blue-600 transition-colors">
                                        Đề cương ôn tập cuối kỳ</h4>
                                    <p class="text-[12px] text-slate-400 mt-1.5 font-semibold">PDF <span
                                            class="mx-1">•</span> 2.4 MB</p>
                                </div>
                            </a>
                        </td>
                        <td class="px-10 py-7">
                            <span
                                class="inline-flex items-center px-4 py-1.5 rounded-xl bg-indigo-50 text-indigo-600 text-[11px] font-black uppercase tracking-wider shadow-sm border border-indigo-100/50">
                                Lập trình hướng đối tượng
                            </span>
                        </td>
                        <td class="px-10 py-7 text-sm text-slate-500 font-bold">
                            20/10/2023
                        </td>
                        <td class="px-10 py-7 text-center">
                            <div
                                class="inline-flex items-center px-4 py-2 bg-slate-100 text-slate-700 rounded-2xl text-xs font-black shadow-inner">
                                <i class="fas fa-download mr-2 text-blue-500"></i>142
                            </div>
                        </td>
                        <td class="px-10 py-7 text-right">
                            <div class="flex justify-end items-center gap-3">
                                <button
                                    class="w-10 h-10 flex items-center justify-center text-blue-500 hover:bg-blue-600 hover:text-white rounded-xl transition-all shadow-sm bg-white border border-blue-50"
                                    title="Tải xuống">
                                    <i class="fas fa-cloud-download-alt"></i>
                                </button>
                                <button
                                    class="w-10 h-10 flex items-center justify-center text-amber-500 hover:bg-amber-600 hover:text-white rounded-xl transition-all shadow-sm bg-white border border-amber-50"
                                    title="Sửa">
                                    <i class="fas fa-pen-nib"></i>
                                </button>
                                <button
                                    class="w-10 h-10 flex items-center justify-center text-red-400 hover:bg-red-600 hover:text-white rounded-xl transition-all shadow-sm bg-white border border-red-50"
                                    title="Xóa">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="px-10 py-6 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between">
            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Trang <span
                    class="text-slate-800">1</span> của 5</p>
            <div class="flex gap-2">
                <button
                    class="px-5 py-2.5 text-xs font-black uppercase tracking-widest text-slate-500 hover:bg-white hover:shadow-sm rounded-xl transition-all border border-transparent">Trước</button>
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-blue-600 text-white font-black shadow-lg shadow-blue-200 text-sm">1</button>
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-xl text-slate-500 hover:bg-white hover:shadow-sm font-black text-sm transition-all border border-transparent">2</button>
                <button
                    class="px-5 py-2.5 text-xs font-black uppercase tracking-widest text-blue-600 hover:bg-white hover:shadow-sm rounded-xl transition-all border border-transparent">Sau</button>
            </div>
        </div>
    </div>
</main>
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
@endsection

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