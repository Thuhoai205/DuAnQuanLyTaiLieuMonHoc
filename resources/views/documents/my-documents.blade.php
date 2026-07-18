@extends('layouts.app')

@section('title', 'Tài liệu của tôi')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">


    <!-- ================= HEADER ================= -->
    <section class="from-slate-900 via-slate-800 to-slate-900">

        <div class="flex flex-col gap-6 mb-8 lg:flex-row lg:items-center lg:justify-between">

            <div>

                <h1 class="mt-4 text-4xl font-black tracking-tight text-slate-900">
                    Tài liệu của tôi
                </h1>

                <p class="mt-3 max-w-2xl leading-7 text-slate-500">
                    Hiển thị danh sách những tài liệu của bạn.
                </p>

            </div>

            <div class="flex items-center gap-3">

                <!-- Thùng rác -->
                <a href="{{ route('documents.trash') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-5 py-3 font-semibold text-slate-700 transition hover:border-red-500 hover:bg-red-50 hover:text-red-600">

                    <i class="fa-solid fa-trash-can"></i>

                    Thùng rác

                </a>

                <!-- Đăng tải -->
                <a href="{{ route('documents.create') }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-amber-500 px-6 py-3 font-bold text-white transition hover:bg-amber-600">

                    <i class="fa-solid fa-upload"></i>

                    Đăng tải tài liệu

                </a>

            </div>

        </div>

    </section>
    <!-- ================= CONTENT ================= -->
    <div class="max-w-7xl mx-auto px-6 py-5">

        <!-- SUMMARY -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

            <!-- Tài liệu -->
            <div
                class="bg-white border border-slate-200 rounded-md shadow-sm p-5 transition hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-bold uppercase text-slate-400">
                            Tài liệu
                        </p>

                        <h3 class="text-2xl font-black text-slate-700 mt-2">
                            {{ number_format($totalDocuments) }}
                        </h3>

                        <p class="text-xs font-semibold text-slate-400 mt-1">
                            Đã đăng tải
                        </p>

                    </div>

                    <div class="w-11 h-11 rounded-md bg-sky-500 text-white flex items-center justify-center shadow-sm">

                        <i class="fa-solid fa-file-lines"></i>

                    </div>

                </div>

            </div>

            <!-- Lượt xem -->
            <div
                class="bg-white border border-slate-200 rounded-md shadow-sm p-5 transition hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-bold uppercase text-slate-400">
                            Lượt xem
                        </p>

                        <h3 class="text-2xl font-black text-slate-700 mt-2">
                            {{ number_format($totalViews) }}
                        </h3>

                        <p class="text-xs font-semibold text-slate-400 mt-1">
                            Tổng lượt xem
                        </p>

                    </div>

                    <div
                        class="w-11 h-11 rounded-md bg-emerald-500 text-white flex items-center justify-center shadow-sm">

                        <i class="fa-solid fa-eye"></i>

                    </div>

                </div>

            </div>

            <!-- Lượt tải -->
            <div
                class="bg-white border border-slate-200 rounded-md shadow-sm p-5 transition hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-bold uppercase text-slate-400">
                            Lượt tải
                        </p>

                        <h3 class="text-2xl font-black text-slate-700 mt-2">
                            {{ number_format($totalDownloads) }}
                        </h3>

                        <p class="text-xs font-semibold text-slate-400 mt-1">
                            Tổng lượt tải
                        </p>

                    </div>

                    <div
                        class="w-11 h-11 rounded-md bg-amber-500 text-white flex items-center justify-center shadow-sm">

                        <i class="fa-solid fa-download"></i>

                    </div>

                </div>

            </div>

            <!-- Môn học -->
            <div
                class="bg-white border border-slate-200 rounded-md shadow-sm p-5 transition hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-bold uppercase text-slate-400">
                            Môn học
                        </p>

                        <h3 class="text-2xl font-black text-slate-700 mt-2">
                            {{ number_format($totalSubjects) }}
                        </h3>

                        <p class="text-xs font-semibold text-slate-400 mt-1">
                            Đang phụ trách
                        </p>

                    </div>

                    <div
                        class="w-11 h-11 rounded-md bg-purple-500 text-white flex items-center justify-center shadow-sm">

                        <i class="fa-solid fa-book-open"></i>

                    </div>

                </div>

            </div>

        </div>
        <!-- ================= FILTER ================= -->
        <div class="mt-8 bg-white border border-slate-200 rounded-md shadow-sm">

            <!-- Header -->
            <div class="px-6 py-4 border-b border-slate-200">

                <h2 class="text-sm font-black text-slate-700">

                    Bộ lọc tìm kiếm

                </h2>

                <p class="mt-1 text-xs font-semibold text-slate-400">

                    Tìm kiếm và quản lý các tài liệu bạn đã đăng tải

                </p>

            </div>

            <!-- Body -->
            <div class="p-6">

                <form id="document-container" action="{{ route('documents.my-documents') }}" method="GET"
                    class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

                    <!-- SEARCH -->
                    <div class="md:col-span-5">

                        <label class="block text-xs font-bold uppercase tracking-wide text-slate-500 mb-2">

                            Tìm kiếm

                        </label>

                        <div class="relative">

                            <i class="fa-solid fa-magnifying-glass
                        absolute
                        left-4
                        top-1/2
                        -translate-y-1/2
                        text-slate-400"></i>

                            <input type="text" name="keyword" value="{{ request('keyword') }}"
                                placeholder="Tên tài liệu..." class="w-full
                        h-11
                        pl-11
                        pr-4
                        rounded-xl
                        border border-slate-200
                        bg-slate-50
                        text-sm
                        font-medium
                        text-slate-700
                        placeholder:text-slate-400
                        focus:bg-white
                        focus:border-amber-500
                        focus:ring-4
                        focus:ring-amber-100">

                        </div>

                    </div>

                    <!-- SUBJECT -->
                    <div class="md:col-span-3">

                        <label class="block text-xs font-bold uppercase tracking-wide text-slate-500 mb-2">

                            Môn học

                        </label>

                        <select name="subject_code" class="w-full
                    h-11
                    px-4
                    rounded-xl
                    border border-slate-200
                    bg-slate-50
                    text-sm
                    font-medium
                    text-slate-700
                    focus:bg-white
                    focus:border-amber-500
                    focus:ring-4
                    focus:ring-amber-100">

                            <option value="">

                                Tất cả môn học

                            </option>

                            @foreach($subjects as $subject)

                            <option value="{{ $subject->subject_code }}" @selected(request('subject_code')==$subject->
                                subject_code)>

                                {{ $subject->subject_name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- DOCUMENT TYPE -->
                    <div class="md:col-span-2">

                        <label class="block text-xs font-bold uppercase tracking-wide text-slate-500 mb-2">

                            Loại tài liệu

                        </label>

                        <select name="document_type_id" class="w-full
                    h-11
                    px-4
                    rounded-xl
                    border border-slate-200
                    bg-slate-50
                    text-sm
                    font-medium
                    text-slate-700
                    focus:bg-white
                    focus:border-amber-500
                    focus:ring-4
                    focus:ring-amber-100">

                            <option value="">

                                Tất cả loại

                            </option>

                            @foreach($documentTypes as $type)

                            <option value="{{ $type->document_type_id }}" @selected(request('document_type_id')==$type->
                                document_type_id)>

                                {{ $type->type_name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- BUTTON -->
                    <div class="md:col-span-2 flex gap-3">

                        <button type="submit" class="flex-1
                    h-11
                    rounded-xl
                    bg-amber-500
                    hover:bg-amber-600
                    text-white
                    text-sm
                    font-bold
                    transition-all">

                            <i class="fa-solid fa-filter mr-2"></i>

                            Lọc

                        </button>

                        <a href="{{ route('documents.my-documents') }}" class="flex-1
                    h-11
                    rounded-xl
                    border border-slate-200
                    bg-slate-100
                    text-slate-700
                    text-sm
                    font-bold
                    hover:bg-slate-200
                    transition-all
                    flex
                    items-center
                    justify-center">

                            <i class="fa-solid fa-rotate-left mr-2"></i>

                            Đặt lại

                        </a>

                    </div>

                </form>

            </div>

        </div>
        <!-- ================= DANH SÁCH TÀI LIỆU ================= -->
        <div id="document-container" class="mt-8 bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">

            <!-- Header -->
            <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">

                <div>

                    <h2 class="text-sm font-black text-slate-700">

                        Danh sách tài liệu

                    </h2>

                    <p class="mt-1 text-xs font-semibold text-slate-400">

                        Có {{ number_format($documents->total()) }} tài liệu

                    </p>

                </div>

                <div class="text-xs text-slate-400">

                    Cập nhật mới nhất

                </div>

            </div>

            <!-- Header Table -->
            <div class="grid grid-cols-12 gap-4
                px-6 py-4
                bg-slate-50
                border-b border-slate-200
                text-xs
                font-bold
                uppercase
                tracking-wide
                text-slate-500">

                <!-- STT -->
                <div class="col-span-1 text-center">

                    STT

                </div>

                <!-- Tài liệu -->
                <div class="col-span-4">

                    Tài liệu

                </div>


                <!-- trạng thái -->
                <div class="col-span-2 text-center">

                    Trạng thái

                </div>


                <!-- View -->
                <div class="col-span-1 text-center">

                    Lượt xem

                </div>

                <!-- Download -->
                <div class="col-span-1 text-center">

                    Lượt tải

                </div>

                <!-- Version -->
                <div class="col-span-1 text-center">

                    Phiên bản

                </div>

                <!-- Date -->
                <div class="col-span-1 text-center">

                    Ngày đăng

                </div>

                <!-- Menu -->
                <div class="col-span-1 text-center">

                    Thao tác

                </div>

            </div>


            <!-- Body -->
            <div class="divide-y divide-slate-100">

                @forelse($documents as $index => $document)

                @php

                $version = $document->currentVersion;

                $ext = strtolower($version->file_extension ?? '');

                @endphp

                <div class="grid grid-cols-12 gap-4
                    px-6 py-4
                    items-center
                    hover:bg-slate-50
                    transition">
                    <!-- STT -->
                    <div class="col-span-1 flex justify-center">

                        <span class="w-8 h-8 rounded-md
                    bg-slate-100
                    text-slate-600
                    text-sm
                    font-bold
                    flex items-center justify-center">

                            {{ $documents->firstItem() + $index }}

                        </span>

                    </div>

                    <!-- TÀI LIỆU -->
                    <div class="col-span-4 flex items-center gap-3 min-w-0">

                        <div class="w-10 h-10 rounded-md flex items-center justify-center shrink-0

                    @if($ext=='pdf')
                        bg-red-50 text-red-500
                    @elseif(in_array($ext,['doc','docx']))
                        bg-blue-50 text-blue-600
                    @elseif(in_array($ext,['xls','xlsx']))
                        bg-green-50 text-green-600
                    @elseif(in_array($ext,['ppt','pptx']))
                        bg-orange-50 text-orange-600
                    @elseif(in_array($ext,['zip','rar']))
                        bg-yellow-50 text-yellow-600
                    @elseif(in_array($ext,['jpg','jpeg','png','gif','webp']))
                        bg-pink-50 text-pink-600
                    @elseif(in_array($ext,['mp4','avi','mov']))
                        bg-purple-50 text-purple-600
                    @else
                        bg-slate-100 text-slate-500
                    @endif">

                            @if($ext=='pdf')

                            <i class="fa-solid fa-file-pdf text-lg"></i>

                            @elseif(in_array($ext,['doc','docx']))

                            <i class="fa-solid fa-file-word text-lg"></i>

                            @elseif(in_array($ext,['xls','xlsx']))

                            <i class="fa-solid fa-file-excel text-lg"></i>

                            @elseif(in_array($ext,['ppt','pptx']))

                            <i class="fa-solid fa-file-powerpoint text-lg"></i>

                            @elseif(in_array($ext,['zip','rar']))

                            <i class="fa-solid fa-file-zipper text-lg"></i>

                            @elseif(in_array($ext,['jpg','jpeg','png','gif','webp']))

                            <i class="fa-solid fa-file-image text-lg"></i>

                            @elseif(in_array($ext,['mp4','avi','mov']))

                            <i class="fa-solid fa-file-video text-lg"></i>

                            @else

                            <i class="fa-solid fa-file text-lg"></i>

                            @endif

                        </div>

                        <div class="flex-1 min-w-0">

                            <h4 class="text-[15px] font-bold text-slate-700 truncate">
                                {{ $document->title }}
                            </h4>

                            <div class="mt-2 flex items-center gap-2 min-w-0">

                                <p class="text-xs text-slate-400 truncate">

                                    {{ $document->description ?: 'Không có mô tả' }}

                                </p>

                                <span class="inline-flex items-center
                                    px-2.5 py-1
                                    rounded-full
                                  
                                    text-emerald-600
                                    text-[11px]
                                    font-semibold
                                    shrink-0">

                                    {{ $document->subject->subject_name }}

                                </span>

                            </div>

                        </div>

                    </div>


                    @php
                    $isAssigned = $document->subject->lecturers()
                    ->where('users.user_id', Auth::id())
                    ->exists();
                    @endphp
                    <!-- Trạng thái -->
                    <div class="col-span-2 flex justify-center">

                        @if($isAssigned)

                        <span class="inline-flex items-center gap-1
                            px-3 py-1
                            rounded-full
                            bg-emerald-50
                            text-emerald-600
                            text-xs
                            font-semibold">

                            <i class="fa-solid fa-circle text-[8px]"></i>

                            Đang phụ trách

                        </span>

                        @else

                        <span class="inline-flex items-center gap-1
                            px-3 py-1
                            rounded-full
                            bg-red-50
                            text-red-600
                            text-xs
                            font-semibold">

                            <i class="fa-solid fa-circle text-[8px]"></i>

                            Không phụ trách

                        </span>

                        @endif

                    </div>

                    <!-- LƯỢT XEM -->
                    <div class="col-span-1 text-center">

                        <div class="font-bold text-slate-700">

                            {{ number_format($document->view_count) }}

                        </div>

                    </div>

                    <!-- LƯỢT TẢI -->
                    <div class="col-span-1 text-center">

                        <div class="font-bold text-slate-700">

                            {{ number_format($document->download_count) }}

                        </div>

                    </div>

                    <!-- PHIÊN BẢN -->
                    <div class="col-span-1 text-center">

                        <span class="inline-flex
                    items-center
                    justify-center
                    px-2.5 py-1
                    rounded-md
                    bg-sky-50
                    text-sky-600
                    text-xs
                    font-bold">

                            {{ $version->version_name ?? '1.0' }}

                        </span>

                    </div>

                    <!-- NGÀY ĐĂNG -->
                    <div class="col-span-1 text-center">

                        <div class="text-sm font-semibold text-slate-700">

                            {{ $document->created_at->format('d/m/Y') }}

                        </div>

                        <div class="text-xs text-slate-400 mt-1">

                            {{ $document->created_at->format('H:i') }}

                        </div>

                    </div>
                    @php

                    $isAssigned = true;

                    if(Auth::check() && Auth::user()->role->role_name == 'lecturer'){

                    $isAssigned = $document->subject
                    ->lecturers()
                    ->where('users.user_id', Auth::id())
                    ->exists();

                    }

                    @endphp

                    <!-- MENU -->
                    <div class="col-span-1 flex justify-center relative">
                        <button type="button" onclick="toggleMenu('{{ $document->document_id }}')" class="w-10 h-10
                            rounded-md
                            border border-slate-200
                            bg-white
                            text-slate-500
                            hover:bg-slate-100
                            hover:text-slate-700
                            transition">

                            <i class="fa-solid fa-ellipsis-vertical"></i>

                        </button>

                        <!-- Dropdown -->
                        <div id="menu-{{ $document->document_id }}" class="hidden absolute
                            right-0
                            top-12
                            w-52
                            bg-white
                            border border-slate-200
                            rounded-lg
                            shadow-xl
                            overflow-hidden
                            z-50">

                            <!-- Chi tiết -->
                            <a href="{{ route('documents.show',$document->document_id) }}" class="flex items-center gap-3
                                px-4 py-3
                                text-sm
                                text-slate-700
                                hover:bg-slate-50
                                transition">

                                <i class="fa-solid fa-eye w-4 text-sky-500"></i>

                                Chi tiết

                            </a>

                            @if(Auth::user()->role->role_name == 'admin' || $isAssigned)

                            <!-- Chỉnh sửa -->
                            <a href="{{ route('documents.edit',$document->document_id) }}" class="flex items-center gap-3
                        px-4 py-3
                        text-sm
                        text-slate-700
                        hover:bg-slate-50
                        transition">

                                <i class="fa-solid fa-pen w-4 text-amber-500"></i>

                                Chỉnh sửa

                            </a>

                            <div class="border-t border-slate-100"></div>

                            <!-- Xóa -->
                            <form action="{{ route('documents.destroy',$document->document_id) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài liệu này?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="w-full
                            flex
                            items-center
                            gap-3
                            px-4 py-3
                            text-sm
                            text-red-600
                            hover:bg-red-50
                            transition">

                                    <i class="fa-solid fa-trash w-4"></i>

                                    Xóa tài liệu

                                </button>

                            </form>

                            @else

                            <div class="border-t border-slate-100"></div>

                            <div class="px-4 py-3 text-xs text-slate-400 bg-slate-50">

                                <i class="fa-solid fa-lock mr-2"></i>

                                Bạn không còn phụ trách môn học này nên chỉ có quyền xem.

                            </div>

                            @endif

                        </div>

                    </div>

                </div>

                @empty


                <div class="py-20 text-center">

                    <div class="w-20 h-20 mx-auto
                        rounded-xl
                        bg-slate-100
                        text-slate-400
                        flex items-center justify-center">

                        <i class="fa-solid fa-file-circle-xmark text-3xl"></i>

                    </div>

                    <h3 class="mt-6 text-xl font-black text-slate-700">

                        Chưa có tài liệu nào

                    </h3>

                    <p class="mt-2 text-sm text-slate-400">

                        Bạn chưa đăng tải tài liệu nào hoặc không có kết quả phù hợp.

                    </p>

                    <a href="{{ route('documents.create') }}" class="inline-flex
                        items-center
                        gap-2
                        mt-6
                        px-6 py-3
                        rounded-xl
                        bg-sky-600
                        hover:bg-sky-700
                        text-white
                        font-bold
                        transition">

                        <i class="fa-solid fa-upload"></i>

                        Đăng tải tài liệu

                    </a>

                </div>

                @endforelse

            </div>

            @if ($documents->hasPages())

            <div class="border-t border-slate-200 bg-slate-50 px-6 py-5">

                <div class="flex items-center justify-between">

                    <p class="text-sm text-slate-500">
                        Hiển thị
                        <span class="font-semibold text-slate-700">{{ $documents->firstItem() }}</span>
                        -
                        <span class="font-semibold text-slate-700">{{ $documents->lastItem() }}</span>
                        trong tổng số
                        <span class="font-semibold text-slate-700">{{ $documents->total() }}</span>
                        tài liệu
                    </p>

                    <div class="flex items-center gap-2">

                        {{-- Previous --}}
                        @if ($documents->onFirstPage())

                        <span
                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-300">

                            <i class="fa-solid fa-chevron-left"></i>

                        </span>

                        @else

                        <a href="{{ $documents->previousPageUrl() }}"
                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 transition hover:border-amber-500 hover:bg-amber-500 hover:text-white">

                            <i class="fa-solid fa-chevron-left"></i>

                        </a>

                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($documents->getUrlRange(1, $documents->lastPage()) as $page => $url)

                        @if ($page == $documents->currentPage())

                        <span
                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-500 font-bold text-white">

                            {{ $page }}

                        </span>

                        @else

                        <a href="{{ $url }}"
                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white font-medium text-slate-700 transition hover:border-amber-500 hover:bg-amber-50">

                            {{ $page }}

                        </a>

                        @endif

                        @endforeach

                        {{-- Next --}}
                        @if ($documents->hasMorePages())

                        <a href="{{ $documents->nextPageUrl() }}"
                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 transition hover:border-amber-500 hover:bg-amber-500 hover:text-white">

                            <i class="fa-solid fa-chevron-right"></i>

                        </a>

                        @else

                        <span
                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-300">

                            <i class="fa-solid fa-chevron-right"></i>

                        </span>

                        @endif

                    </div>

                </div>

            </div>

            @endif
        </div>

    </div>

</div>


@endsection
@push('scripts')

<script>
function toggleMenu(id) {

    const currentMenu = document.getElementById("menu-" + id);

    // Đóng tất cả menu khác
    document.querySelectorAll("[id^='menu-']").forEach(menu => {

        if (menu !== currentMenu) {

            menu.classList.add("hidden");

        }

    });

    // Mở / đóng menu hiện tại
    currentMenu.classList.toggle("hidden");
}

// Click ra ngoài thì đóng menu
document.addEventListener("click", function(e) {

    if (
        !e.target.closest("[onclick^='toggleMenu']") &&
        !e.target.closest("[id^='menu-']")
    ) {

        document.querySelectorAll("[id^='menu-']").forEach(menu => {

            menu.classList.add("hidden");

        });

    }

});
</script>
@endpush