@extends('layouts.app')

@section('title', 'Học liệu cá nhân')

@section('content')

<main class="min-h-screen bg-gradient-to-br from-slate-50 via-cyan-50/30 to-sky-50 relative overflow-hidden">

    <!-- Background -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">

        <div class="absolute -top-32 -left-32 w-[420px] h-[420px] rounded-full bg-cyan-200/30 blur-3xl">
        </div>

        <div class="absolute bottom-[-120px] right-[-80px] w-[420px] h-[420px] rounded-full bg-sky-200/30 blur-3xl">
        </div>

    </div>

    <div class="relative max-w-7xl mx-auto px-5 lg:px-8 py-10">

        <!-- ================= HEADER ================= -->

        <section
            class="relative overflow-hidden rounded-[34px] bg-white border border-cyan-100 shadow-xl shadow-cyan-100/40 p-8">

            <div class="absolute top-0 right-0 w-64 h-64 bg-cyan-100/30 rounded-full blur-3xl">
            </div>

            <div class="absolute -bottom-16 -left-16 w-56 h-56 bg-sky-100/40 rounded-full blur-3xl">
            </div>

            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                <div>

                    <!-- Back -->

                    <a href="javascript:history.back()"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-slate-100 hover:bg-cyan-50 text-slate-600 hover:text-cyan-600 font-bold text-xs uppercase tracking-widest transition">

                        <i class="fa-solid fa-arrow-left"></i>

                        Quay lại

                    </a>

                    <!-- Title -->

                    <div class="flex items-center gap-5 mt-7">

                        <div
                            class="w-20 h-20 rounded-[28px] bg-gradient-to-br from-cyan-500 to-sky-500 text-white flex items-center justify-center shadow-xl shadow-cyan-300">

                            <i class="fa-solid fa-folder-open text-3xl"></i>

                        </div>

                        <div>

                            <p class="text-xs uppercase tracking-[0.35em] font-black text-cyan-500 mb-2">

                                Dashboard giảng viên

                            </p>

                            <h1 class="text-4xl lg:text-5xl font-black text-slate-900 leading-tight">

                                Học liệu cá nhân

                            </h1>

                            <p class="text-slate-500 text-lg mt-2 max-w-2xl">

                                Quản lý, chỉnh sửa và theo dõi toàn bộ học liệu bạn đã đăng tải.

                            </p>

                        </div>

                    </div>

                </div>

                <!-- Button Upload -->

                <button onclick="toggleModal('uploadModal')" class="shrink-0 inline-flex items-center gap-3 px-8 py-4 rounded-2xl
                    bg-gradient-to-r from-cyan-500 to-sky-500
                    hover:from-cyan-600 hover:to-sky-600
                    text-white font-black
                    shadow-xl shadow-cyan-200
                    transition-all duration-300
                    hover:-translate-y-1">

                    <span class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center">

                        <i class="fa-solid fa-plus"></i>

                    </span>

                    Đăng tải tài liệu

                </button>

            </div>

        </section>

        <!-- ================= STATS ================= -->

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

            <!-- Documents -->

            <div
                class="group rounded-[30px] bg-white border border-cyan-100 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 p-7">

                <div class="flex justify-between items-start">

                    <div>

                        <p class="text-slate-400 text-xs uppercase tracking-widest font-black">

                            Tài liệu

                        </p>

                        <h3 class="text-5xl font-black text-cyan-600 mt-3">

                            {{ number_format($totalDocuments) }}

                        </h3>

                    </div>

                    <div
                        class="w-16 h-16 rounded-3xl bg-cyan-100 text-cyan-600 flex items-center justify-center group-hover:rotate-6 transition">

                        <i class="fa-solid fa-file-lines text-2xl"></i>

                    </div>

                </div>

                <div class="mt-6 h-1 rounded-full bg-cyan-100 overflow-hidden">

                    <div class="h-full w-2/3 bg-cyan-500 rounded-full"></div>

                </div>

                <p class="mt-4 text-sm text-slate-500 font-semibold">

                    Tổng tài liệu bạn đã đăng.

                </p>

            </div>

            <!-- Subjects -->

            <div
                class="group rounded-[30px] bg-white border border-emerald-100 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 p-7">

                <div class="flex justify-between items-start">

                    <div>

                        <p class="text-slate-400 text-xs uppercase tracking-widest font-black">

                            Môn phụ trách

                        </p>

                        <h3 class="text-5xl font-black text-emerald-600 mt-3">

                            {{ number_format($totalSubjects) }}

                        </h3>

                    </div>

                    <div
                        class="w-16 h-16 rounded-3xl bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:rotate-6 transition">

                        <i class="fa-solid fa-graduation-cap text-2xl"></i>

                    </div>

                </div>

                <div class="mt-6 h-1 rounded-full bg-emerald-100 overflow-hidden">

                    <div class="h-full w-1/2 bg-emerald-500 rounded-full"></div>

                </div>

                <p class="mt-4 text-sm text-slate-500 font-semibold">

                    Các môn học được phân công.

                </p>

            </div>

            <!-- Downloads -->

            <div
                class="group rounded-[30px] bg-white border border-sky-100 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 p-7">

                <div class="flex justify-between items-start">

                    <div>

                        <p class="text-slate-400 text-xs uppercase tracking-widest font-black">

                            Lượt tải

                        </p>

                        <h3 class="text-5xl font-black text-sky-600 mt-3">

                            {{ number_format($totalDownloads) }}

                        </h3>

                    </div>

                    <div
                        class="w-16 h-16 rounded-3xl bg-sky-100 text-sky-600 flex items-center justify-center group-hover:rotate-6 transition">

                        <i class="fa-solid fa-cloud-arrow-down text-2xl"></i>

                    </div>

                </div>

                <div class="mt-6 h-1 rounded-full bg-sky-100 overflow-hidden">

                    <div class="h-full w-3/4 bg-sky-500 rounded-full"></div>

                </div>

                <p class="mt-4 text-sm text-slate-500 font-semibold">

                    Tổng lượt tải của tất cả tài liệu.

                </p>

            </div>

        </section>
        <!-- ================= FILTER ================= -->

        <section
            class="mt-8 bg-white rounded-[32px] border border-cyan-100 shadow-lg shadow-cyan-100/40 overflow-hidden">

            <div class="px-8 py-6 border-b border-slate-100">

                <h2 class="text-xl font-black text-slate-800">

                    Bộ lọc tài liệu

                </h2>

                <p class="text-sm text-slate-500 mt-1">

                    Tìm kiếm nhanh học liệu theo môn học, loại tài liệu hoặc từ khóa.

                </p>

            </div>

            <form id="filterForm" method="GET" action="{{ route('documents.my-documents') }}" class="p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-5">

                    <!-- SUBJECT -->

                    <div>

                        <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">

                            Môn học

                        </label>

                        <select name="subject_code"
                            class="w-full h-12 rounded-2xl border border-slate-200 bg-slate-50 px-4 font-semibold focus:ring-2 focus:ring-cyan-400">

                            <option value="">

                                Tất cả môn học

                            </option>

                            @foreach($subjects as $subject)

                            <option value="{{ $subject->subject_code }}"
                                {{ request('subject_code') == $subject->subject_code ? 'selected' : '' }}>

                                {{ $subject->subject_name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- DOCUMENT TYPE -->

                    <div>

                        <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">

                            Loại tài liệu

                        </label>

                        <select name="document_type_id"
                            class="w-full h-12 rounded-2xl border border-slate-200 bg-slate-50 px-4 font-semibold focus:ring-2 focus:ring-cyan-400">

                            <option value="">

                                Tất cả loại

                            </option>

                            @foreach($documentTypes as $type)

                            <option value="{{ $type->document_type_id }}"
                                {{ request('document_type_id') == $type->document_type_id ? 'selected' : '' }}>

                                {{ $type->type_name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- KEYWORD -->

                    <div class="xl:col-span-2">

                        <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">

                            Tìm kiếm

                        </label>

                        <div class="relative">

                            <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                            </i>

                            <input type="text" name="keyword" value="{{ request('keyword') }}"
                                placeholder="Nhập tên tài liệu..."
                                class="w-full h-12 rounded-2xl border border-slate-200 bg-slate-50 pl-11 pr-4 font-medium focus:ring-2 focus:ring-cyan-400">

                        </div>

                    </div>

                    <!-- BUTTON -->

                    <div class="flex items-end gap-3">

                        <button type="submit"
                            class="flex-1 h-12 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-black shadow-lg shadow-cyan-200 transition">

                            <i class="fa-solid fa-filter mr-2"></i>

                            Lọc

                        </button>

                        <a href="{{ route('documents.my-documents') }}"
                            class="w-12 h-12 rounded-2xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center">

                            <i class="fa-solid fa-rotate-right"></i>

                        </a>

                    </div>

                </div>

            </form>

        </section>





        <!-- ================= MODAL UPLOAD ================= -->

        <div id="uploadModal"
            class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 backdrop-blur-sm p-4">

            <div class="bg-white rounded-[32px] shadow-2xl w-full max-w-2xl overflow-hidden">

                <!-- Header -->

                <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center">

                    <div>

                        <h3 class="text-2xl font-black text-slate-800">

                            Đăng tải tài liệu

                        </h3>

                        <p class="text-slate-500 text-sm mt-1">

                            Chọn học liệu để tải lên hệ thống.

                        </p>

                    </div>

                    <button onclick="toggleModal('uploadModal')" class="w-10 h-10 rounded-xl hover:bg-slate-100">

                        <i class="fa-solid fa-xmark text-xl"></i>

                    </button>

                </div>

                <!-- Form -->

                <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-8 space-y-6">

                    @csrf

                    <!-- File -->

                    <div>

                        <label
                            class="flex flex-col items-center justify-center border-2 border-dashed border-cyan-200 rounded-[28px] bg-cyan-50 p-10 cursor-pointer hover:bg-cyan-100 transition">

                            <input type="file" name="file" class="hidden" required>

                            <div
                                class="w-16 h-16 rounded-2xl bg-cyan-500 text-white flex items-center justify-center mb-4">

                                <i class="fa-solid fa-cloud-arrow-up text-2xl"></i>

                            </div>

                            <h4 class="font-black text-cyan-700">

                                Chọn file tài liệu

                            </h4>

                            <p class="text-slate-500 text-sm mt-2">

                                PDF, DOCX, PPTX, XLSX (Tối đa 50MB)

                            </p>

                        </label>

                    </div>

                    <!-- Title -->

                    <div>

                        <label class="block text-sm font-black mb-2">

                            Tên tài liệu

                        </label>

                        <input type="text" name="title" required
                            class="w-full h-12 rounded-2xl border border-slate-200 px-4 focus:ring-2 focus:ring-cyan-400">

                    </div>

                    <!-- Subject + Type -->

                    <div class="grid grid-cols-2 gap-5">

                        <div>

                            <label class="block text-sm font-black mb-2">

                                Môn học

                            </label>

                            <select name="subject_code" required
                                class="w-full h-12 rounded-2xl border border-slate-200 px-4">

                                <option value="">

                                    Chọn môn học

                                </option>

                                @foreach($subjects as $subject)

                                <option value="{{ $subject->subject_code }}">

                                    {{ $subject->subject_name }}

                                </option>

                                @endforeach

                            </select>

                        </div>

                        <div>

                            <label class="block text-sm font-black mb-2">

                                Loại tài liệu

                            </label>

                            <select name="document_type_id" required
                                class="w-full h-12 rounded-2xl border border-slate-200 px-4">

                                <option value="">

                                    Chọn loại

                                </option>

                                @foreach($documentTypes as $type)

                                <option value="{{ $type->document_type_id }}">

                                    {{ $type->type_name }}

                                </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <!-- Description -->

                    <div>

                        <label class="block text-sm font-black mb-2">

                            Mô tả

                        </label>

                        <textarea name="description" rows="4"
                            class="w-full rounded-2xl border border-slate-200 p-4 resize-none focus:ring-2 focus:ring-cyan-400"></textarea>

                    </div>

                    <!-- Buttons -->

                    <div class="flex justify-end gap-4">

                        <button type="button" onclick="toggleModal('uploadModal')"
                            class="px-6 py-3 rounded-2xl border border-slate-300 font-bold">

                            Hủy

                        </button>

                        <button type="submit"
                            class="px-8 py-3 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-black shadow-lg">

                            <i class="fa-solid fa-cloud-arrow-up mr-2"></i>

                            Đăng tải

                        </button>

                    </div>

                </form>

            </div>

        </div>
        <!-- ================= DANH SÁCH TÀI LIỆU ================= -->

        <section
            class="mt-8 bg-white rounded-[32px] border border-cyan-100 shadow-lg shadow-cyan-100/30 overflow-hidden">

            <!-- Header -->

            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">

                <div>

                    <h2 class="text-2xl font-black text-slate-800">

                        Danh sách học liệu

                    </h2>

                    <p class="text-sm text-slate-500 mt-1">

                        Có <b>{{ $myDocuments->total() }}</b> tài liệu.

                    </p>

                </div>

            </div>

            <div id="tableContainer" class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="bg-slate-50">

                            <th class="px-8 py-5 text-left text-xs uppercase tracking-widest font-black text-slate-400">

                                Tài liệu

                            </th>

                            <th class="px-6 py-5 text-left text-xs uppercase tracking-widest font-black text-slate-400">

                                Môn học

                            </th>

                            <th
                                class="px-6 py-5 text-center text-xs uppercase tracking-widest font-black text-slate-400">

                                Loại

                            </th>

                            <th
                                class="px-6 py-5 text-center text-xs uppercase tracking-widest font-black text-slate-400">

                                Lượt tải

                            </th>

                            <th
                                class="px-6 py-5 text-center text-xs uppercase tracking-widest font-black text-slate-400">

                                Trạng thái

                            </th>

                            <th
                                class="px-8 py-5 text-right text-xs uppercase tracking-widest font-black text-slate-400">

                                Thao tác

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($myDocuments as $document)

                        @php

                        $version = $document->currentVersion;

                        $ext = strtolower($version?->file_extension ?? '');

                        @endphp

                        <tr class="border-t border-slate-100 hover:bg-cyan-50 transition">

                            <!-- FILE -->

                            <td class="px-8 py-6">

                                <a href="{{ route('documents.show',$document) }}" class="flex items-center gap-4">

                                    <!-- Icon -->

                                    @if($ext=='pdf')

                                    <div
                                        class="w-14 h-14 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center">

                                        <i class="fa-solid fa-file-pdf text-2xl"></i>

                                    </div>

                                    @elseif(in_array($ext,['doc','docx']))

                                    <div
                                        class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">

                                        <i class="fa-solid fa-file-word text-2xl"></i>

                                    </div>

                                    @elseif(in_array($ext,['xls','xlsx']))

                                    <div
                                        class="w-14 h-14 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center">

                                        <i class="fa-solid fa-file-excel text-2xl"></i>

                                    </div>

                                    @elseif(in_array($ext,['ppt','pptx']))

                                    <div
                                        class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center">

                                        <i class="fa-solid fa-file-powerpoint text-2xl"></i>

                                    </div>

                                    @else

                                    <div
                                        class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-500 flex items-center justify-center">

                                        <i class="fa-solid fa-file text-2xl"></i>

                                    </div>

                                    @endif

                                    <div>

                                        <h3 class="font-bold text-slate-800">

                                            {{ $document->title }}

                                        </h3>

                                        <p class="text-sm text-slate-400 mt-1">

                                            {{ $version?->original_file_name }}

                                        </p>

                                        <p class="text-xs text-slate-400 mt-1">

                                            {{ $document->created_at->format('d/m/Y H:i') }}

                                        </p>

                                    </div>

                                </a>

                            </td>

                            <!-- SUBJECT -->

                            <td class="px-6 py-6">

                                <span class="font-semibold text-slate-700">

                                    {{ $document->subject?->subject_name }}

                                </span>

                            </td>

                            <!-- TYPE -->

                            <td class="px-6 py-6 text-center">

                                <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-bold">

                                    {{ $document->documentType?->type_name }}

                                </span>

                            </td>

                            <!-- DOWNLOAD -->

                            <td class="px-6 py-6 text-center">

                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100">

                                    <i class="fa-solid fa-download text-cyan-600"></i>

                                    {{ number_format($document->download_count) }}

                                </span>

                            </td>

                            <!-- STATUS -->

                            <td class="px-6 py-6 text-center">

                                @if($document->is_active)

                                <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-xs font-black">

                                    Đang hiển thị

                                </span>

                                @else

                                <span class="px-4 py-2 rounded-full bg-red-100 text-red-600 text-xs font-black">

                                    Đã khóa

                                </span>

                                @endif

                            </td>

                            <!-- ACTION -->

                            <td class="px-8 py-6">

                                <div class="flex justify-end gap-3">

                                    <!-- View -->

                                    <a href="{{ route('documents.show',$document) }}"
                                        class="w-10 h-10 rounded-xl border border-cyan-100 text-cyan-600 hover:bg-cyan-500 hover:text-white flex items-center justify-center transition">

                                        <i class="fa-solid fa-eye"></i>

                                    </a>

                                    <!-- Edit -->

                                    <a href="{{ route('documents.edit',$document) }}"
                                        class="w-10 h-10 rounded-xl border border-amber-100 text-amber-500 hover:bg-amber-500 hover:text-white flex items-center justify-center transition">

                                        <i class="fa-solid fa-pen"></i>

                                    </a>

                                    <!-- Delete -->

                                    <form action="{{ route('documents.destroy',$document) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài liệu này?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="w-10 h-10 rounded-xl border border-red-100 text-red-500 hover:bg-red-500 hover:text-white transition">

                                            <i class="fa-solid fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="py-20 text-center">

                                <div class="flex flex-col items-center">

                                    <div
                                        class="w-24 h-24 rounded-full bg-cyan-50 text-cyan-500 flex items-center justify-center mb-6">

                                        <i class="fa-solid fa-folder-open text-4xl"></i>

                                    </div>

                                    <h3 class="text-2xl font-black text-slate-700">

                                        Chưa có tài liệu

                                    </h3>

                                    <p class="text-slate-400 mt-2">

                                        Hãy đăng tải tài liệu đầu tiên của bạn.

                                    </p>

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
        </section>
        <!-- ================= PAGINATION ================= -->

        @if($myDocuments->hasPages())

        <div
            class="px-8 py-6 border-t border-slate-100 bg-slate-50 flex flex-col lg:flex-row items-center justify-between gap-6">

            <div class="text-sm text-slate-500 font-medium">

                Hiển thị

                <span class="font-black text-slate-800">

                    {{ $myDocuments->firstItem() }}

                </span>

                -

                <span class="font-black text-slate-800">

                    {{ $myDocuments->lastItem() }}

                </span>

                trên

                <span class="font-black text-cyan-600">

                    {{ $myDocuments->total() }}

                </span>

                tài liệu

            </div>

            <div>

                {{ $myDocuments->onEachSide(1)->links() }}

            </div>

        </div>

        @endif

        </section>

    </div>

</main>





<!-- ================= SCRIPT ================= -->

<script>
function toggleModal(id) {

    const modal = document.getElementById(id);

    modal.classList.toggle("hidden");

    modal.classList.toggle("flex");

    document.body.style.overflow =

        modal.classList.contains("hidden")

        ?
        "auto"

        :
        "hidden";

}





/*
|--------------------------------------------------------------------------
| Click ngoài modal
|--------------------------------------------------------------------------
*/

window.addEventListener("click", function(e) {

    const modal = document.getElementById("uploadModal");

    if (e.target === modal) {

        toggleModal("uploadModal");

    }

});





/*
|--------------------------------------------------------------------------
| ESC
|--------------------------------------------------------------------------
*/

document.addEventListener("keydown", function(e) {

    if (e.key === "Escape") {

        const modal = document.getElementById("uploadModal");

        if (modal.classList.contains("flex")) {

            toggleModal("uploadModal");

        }

    }

});





/*
|--------------------------------------------------------------------------
| Hiển thị tên file
|--------------------------------------------------------------------------
*/

const input = document.querySelector('input[name="file"]');

if (input) {

    input.addEventListener("change", function() {

        if (this.files.length) {

            const label = this.closest("label");

            const p = label.querySelector("p");

            if (p) {

                p.innerHTML = this.files[0].name;

            }

        }

    });

}
const form = document.getElementById('filterForm');

form.addEventListener('submit', function(e) {

    e.preventDefault();

    let url = new URL(form.action);

    let params = new FormData(form);

    url.search = new URLSearchParams(params);

    fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(res => res.text())
        .then(html => {

            document
                .getElementById("tableContainer")
                .innerHTML = html;

        });

});
</script>

@endsection