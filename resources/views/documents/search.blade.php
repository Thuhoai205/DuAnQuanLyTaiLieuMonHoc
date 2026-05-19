@extends('layouts.app')

@section('title', 'Kho Học Liệu Môn Học')

@section('content')

<div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
    <div
        class="absolute top-[-5%] left-[-10%] w-[600px] h-[600px] rounded-full bg-blue-500/5 blur-[130px] animate-[pulse_7s_infinite]">
    </div>

    <div
        class="absolute bottom-[15%] right-[-5%] w-[500px] h-[500px] rounded-full bg-cyan-500/5 blur-[120px] animate-[pulse_9s_infinite]">
    </div>
</div>

<main class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-12">
    {{-- NÚT QUAY LẠI --}}
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

    {{-- HEADER --}}
    <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-10 gap-6 pb-6 border-b border-slate-100">

        <div class="space-y-1">
            <div class="flex items-center">
                <div
                    class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shadow-[inset_0_2px_8px_rgba(59,130,246,0.06)]">
                    <i class="fas fa-folder-open text-lg"></i>
                </div>

                <div class="ml-4">
                    <h4 class="text-2xl font-black text-slate-800 tracking-tight">
                        Kho tài liệu môn học
                    </h4>
                </div>
            </div>

            <p class="text-slate-400 font-semibold text-xs md:text-sm pl-16">
                Môn học:
                <span class="text-blue-600">Lập trình Web</span>
            </p>
        </div>

        {{-- BUTTON --}}
        @auth
        @if(in_array(auth()->user()->role_id, [1,2]))
        <button onclick="openUploadModal()"
            class="self-start lg:self-center px-6 py-3 bg-blue-600 text-white font-bold text-xs uppercase tracking-wider rounded-full shadow-lg shadow-blue-600/20 hover:bg-amber-500 transition-all active:scale-95 flex items-center gap-2">

            <i class="fas fa-plus"></i>

            Upload tài liệu
        </button>
        @endif
        @endauth

    </div>

    {{-- SEARCH + FILTER (FINAL CLEAN UI) --}}
    <div
        class="bg-white rounded-[2rem] border border-slate-100 shadow-[0_15px_50px_-15px_rgba(0,0,0,0.05)] p-6 lg:p-8 mb-10">

        <form id="searchForm" class="flex flex-col xl:flex-row xl:items-center gap-6">

            {{-- SEARCH INPUT --}}
            <div class="relative flex-1">

                <i class="fas fa-search absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                <input type="text" id="docKeyword" onkeyup="filterDocuments()"
                    placeholder="Tìm kiếm tài liệu, đề thi, bài giảng..." class="w-full h-14 pl-14 pr-5 bg-slate-50/60 border border-slate-100 rounded-2xl
                text-sm font-semibold text-slate-700
                focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500/40 focus:bg-white
                transition-all">

            </div>

            {{-- FILTER + BUTTON --}}
            <div class="flex flex-col sm:flex-row gap-4">

                {{-- TYPE FILTER --}}
                <div class="relative w-full sm:w-64">

                    <i class="fas fa-filter absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>

                    <select id="docType" onchange="filterDocuments()" class="w-full h-14 pl-12 pr-10 bg-slate-50/60 border border-slate-100 rounded-2xl
                    text-sm font-bold text-slate-600 appearance-none cursor-pointer
                    focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500/40 focus:bg-white
                    transition-all">

                        <option value="all">Tất cả tài liệu</option>
                        <option value="PDF">PDF</option>
                        <option value="DOC">DOC</option>
                        <option value="PPT">PPT</option>

                    </select>

                    <i
                        class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-[10px]"></i>

                </div>

                {{-- SEARCH BUTTON --}}
                <button type="button" onclick="filterDocuments()" class="h-14 px-8 bg-slate-900 text-white font-black text-xs uppercase tracking-wider
                rounded-2xl shadow-md shadow-slate-900/10
                hover:bg-blue-600 hover:shadow-blue-200
                transition-all active:scale-95 whitespace-nowrap">

                    Tìm kiếm

                </button>

            </div>

        </form>

    </div>
    {{-- TABLE --}}
    <div
        class="bg-white rounded-[2.2rem] border border-slate-100 shadow-[0_12px_40px_-15px_rgba(0,0,0,0.03)] overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full border-collapse min-w-[900px]">

                <thead>
                    <tr
                        class="border-b border-slate-100 bg-slate-50/50 text-[10px] font-black text-slate-400 uppercase tracking-widest">

                        <th class="py-5 px-8 text-left">
                            Thông tin tài liệu
                        </th>

                        <th class="py-5 px-6 text-left">
                            Loại học liệu
                        </th>

                        <th class="py-5 px-6 text-left">
                            Ngày đăng
                        </th>

                        <th class="py-5 px-6 text-center">
                            Lượt tải
                        </th>

                        <th class="py-5 px-8 text-right">
                            Hành động
                        </th>

                    </tr>
                </thead>

                <tbody id="documentTableBody" class="divide-y divide-slate-50 text-sm font-semibold text-slate-700">

                    {{-- ROW --}}
                    <tr class="document-row hover:bg-blue-50/20 transition-colors duration-200" data-type="slide">

                        <td class="py-6 px-8">

                            <div class="flex items-center gap-4">

                                <div
                                    class="w-12 h-12 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center shadow-inner shrink-0">

                                    <span class="font-black text-[11px]">
                                        PDF
                                    </span>

                                </div>

                                <div class="min-w-0">

                                    <h5
                                        class="doc-title font-extrabold text-slate-800 text-sm hover:text-blue-600 transition-colors cursor-pointer line-clamp-1">

                                        01_Slide_Tong_Quan_Ve_Web_Framework.pdf
                                    </h5>

                                    <div
                                        class="flex flex-wrap items-center gap-2 mt-1 text-[11px] text-slate-400 font-medium">

                                        <span>Kích thước: 4.2 MB</span>

                                        <span>•</span>

                                        <span>Lập trình Web</span>

                                    </div>

                                </div>

                            </div>

                        </td>

                        <td class="py-6 px-6">

                            <span
                                class="px-3 py-1 bg-blue-50 text-blue-600 font-bold text-[10px] rounded-full uppercase tracking-wider">

                                Slide bài giảng
                            </span>

                        </td>

                        <td class="py-6 px-6 text-slate-400 font-medium">
                            12/05/2026
                        </td>

                        <td class="py-6 px-6 text-center font-bold text-slate-800">
                            248
                        </td>

                        <td class="py-6 px-8">

                            <div class="flex items-center justify-end gap-2">

                                <a href="#"
                                    class="w-9 h-9 bg-slate-50 text-slate-600 rounded-full flex items-center justify-center hover:bg-amber-500 hover:text-white transition-all shadow-sm">

                                    <i class="fas fa-download text-[11px]"></i>
                                </a>

                                @auth
                                @if(in_array(auth()->user()->role_id, [1,2]))

                                <button
                                    class="w-9 h-9 bg-slate-50 text-slate-600 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">

                                    <i class="fas fa-pen text-[11px]"></i>
                                </button>

                                <button
                                    class="w-9 h-9 bg-slate-50 text-slate-600 rounded-full flex items-center justify-center hover:bg-red-500 hover:text-white transition-all shadow-sm">

                                    <i class="fas fa-trash text-[11px]"></i>
                                </button>

                                @endif
                                @endauth

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</main>

@endsection