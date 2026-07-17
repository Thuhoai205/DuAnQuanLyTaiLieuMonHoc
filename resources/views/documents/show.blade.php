@extends('layouts.app')

@section('title', 'Chi tiết tài liệu')

@section('content')

<main class="min-h-screen  py-12">

    <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16">
        <a href="javascript:history.back()" class="inline-flex items-center gap-2
            px-5 py-2.5
            rounded-xl

            bg-white
            border border-amber-300

            text-slate-800
            text-sm
            font-semibold

            shadow-sm
            transition-all duration-300

            hover:bg-amber-500
            hover:border-amber-500
            hover:text-white

            active:scale-95

            focus:outline-none
            focus:ring-4
            focus:ring-amber-200

            mb-8">

            <i class="fa-solid fa-arrow-left"></i>

            Quay lại

        </a>

        <!-- HEADER -->
        <div class="p-7 border-b border-cyan-100 flex items-start justify-between gap-6">

            @php


            $isAdmin = auth()->check() &&
            auth()->user()->role->role_name == 'admin';

            $isOwner = auth()->check() &&
            auth()->user()->role->role_name == 'lecturer' &&
            auth()->id() == $document->uploaded_by;
            @endphp

            <!-- LEFT -->
            <div class="flex items-center gap-5">

                <!-- ICON -->
                <div class="flex h-14 w-14 items-center justify-center
                rounded-2xl
                border border-slate-200
                bg-white
                text-slate-600
                shadow-sm
                transition-all duration-300
                group-hover:border-amber-300
                group-hover:bg-amber-50
                group-hover:text-amber-500">

                    <i class="fa-solid fa-folder-open text-xl"></i>

                </div>

                <!-- CONTENT -->
                <div>

                    <h1 class="text-3xl font-bold text-slate-900">

                        {{ $document->title }}

                    </h1>

                    <p class="mt-2 flex flex-wrap items-center gap-2 text-sm text-slate-500">

                        <span class="inline-flex items-center gap-1">

                            <i class="fa-solid fa-file text-amber-500"></i>

                            {{ $document->currentVersion?->original_file_name }}

                        </span>

                        <span class="text-slate-300">•</span>

                        <span class="inline-flex items-center gap-1">

                            <i class="fa-solid fa-download text-amber-500"></i>

                            {{ number_format($document->download_count) }} lượt tải

                        </span>
                        <span class="text-slate-300">•</span>

                        <span class="inline-flex items-center gap-1">

                            <i class="fa-solid fa-eye text-amber-500"></i>

                            {{ number_format($document->view_count) }} lượt xem


                        </span>

                    </p>

                </div>

            </div>
            <!-- RIGHT -->
            <div class="flex items-center gap-3 shrink-0">

                {{-- Download --}}
                @auth

                <a href="{{ route('documents.download',$document->document_id) }}" class="inline-flex items-center gap-2
        px-6 py-3
        rounded-2xl
        bg-slate-900
        hover:bg-amber-500
        text-white
        font-bold
        shadow-lg
        transition-all duration-300">

                    <i class="fa-solid fa-cloud-arrow-down"></i>

                    Tải xuống

                </a>

                @else

                <button type="button" onclick="showLoginRequiredModal()" class="inline-flex items-center gap-2
        rounded-xl
        border border-slate-300
        bg-white
        px-4 py-2
        text-sm font-semibold
        text-slate-700
        transition-all duration-300
        hover:border-yellow-600
        hover:bg-yellow-50
        hover:text-yellow-700
        shadow-sm">

                    <i class="fa-solid fa-lock text-xs"></i>

                    Đăng nhập để tải

                </button>

                @endauth


                @auth

                @php

                $isAdmin = Auth::user()->role->role_name === 'admin';

                $isOwner = $document->uploaded_by == Auth::id();

                $isAssigned = false;

                if (Auth::user()->role->role_name === 'lecturer') {

                $isAssigned = \App\Models\SubjectTeacher::where(
                'user_id',
                Auth::id()
                )
                ->where(
                'subject_code',
                $document->subject_code
                )
                ->exists();

                }

                $canManage = $isAdmin || ($isOwner && $isAssigned);

                @endphp


                {{-- Edit/Delete --}}
                @if($canManage)

                <!-- Edit -->
                <a href="{{ route('documents.edit',$document->document_id) }}" class="w-12 h-12
        rounded-2xl
        border border-slate-200
        bg-white
        text-slate-600
        hover:border-amber-300
        hover:bg-amber-50
        hover:text-amber-600
        flex items-center justify-center
        transition-all duration-300">

                    <i class="fa-solid fa-pen"></i>

                </a>

                <!-- Delete -->
                <form action="{{ route('documents.destroy',$document->document_id) }}" method="POST"
                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài liệu này?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="w-12 h-12
            rounded-2xl
            border border-red-200
            bg-white
            text-red-500
            hover:bg-red-500
            hover:text-white
            transition-all duration-300">

                        <i class="fa-solid fa-trash"></i>

                    </button>

                </form>

                @endif


                {{-- Favorite --}}
                @php

                $isFavorite = $document->favorites()
                ->where('user_id', auth()->id())
                ->exists();

                @endphp

                <button id="favoriteBtn" data-url="{{ route('favorites.toggle',$document) }}" class="inline-flex items-center gap-2 rounded-2xl px-5 py-3 border transition-all duration-300
        {{ $isFavorite
            ? 'bg-red-500 border-red-500 text-white'
            : 'bg-red-50 border-red-200 text-red-600 hover:bg-red-500 hover:text-white'
        }}">

                    @if($isFavorite)

                    <i class="fa-regular fa-bookmark"></i>

                    <span>Đã yêu thích</span>

                    @else

                    <i class="fa-solid fa-bookmark"></i>

                    <span>Yêu thích</span>

                    @endif

                </button>

                @endauth

            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
            <!-- ================= LEFT : PREVIEW ================= -->
            <div class="lg:col-span-2">

                <div class="bg-white rounded-[30px] border border-slate-200 shadow-sm overflow-hidden">

                    <!-- HEADER -->
                    <div class="px-6 py-5 border-b border-slate-200 bg-slate-50 flex items-center justify-between">

                        <h2 class="text-xl font-bold text-slate-900">

                            <i class="fa-solid fa-eye text-amber-500 mr-2"></i>

                            Xem trước tài liệu

                        </h2>

                        <span class="inline-flex items-center rounded-full
                            bg-slate-100
                            border border-slate-200
                            px-3 py-1
                            text-xs font-semibold
                            text-slate-600">

                            {{ strtoupper($document->currentVersion?->file_extension) }}

                        </span>

                    </div>

                    <div class="bg-slate-100">

                        @php
                        $version = $document->currentVersion;
                        $preview = $version?->preview_file;
                        $ext = strtolower($version?->file_extension ?? '');
                        @endphp

                        @if($version && $preview)

                        {{-- PDF --}}
                        @if(Str::endsWith(strtolower($preview), '.pdf'))

                        <iframe src="{{ asset('storage/'.$preview) }}" class="w-full h-[900px] bg-white"
                            frameborder="0">
                        </iframe>


                        {{-- Image --}}
                        @elseif(in_array($ext,['jpg','jpeg','png','gif','webp']))

                        <div class="flex justify-center p-8 bg-slate-100">

                            <img src="{{ asset('storage/'.$preview) }}" class="max-h-[900px] rounded-2xl shadow-lg">

                        </div>

                        @endif

                        {{-- Video --}}
                        @elseif(in_array($ext,['mp4','mov','avi','webm']))

                        <div class="p-8">

                            <video controls class="w-full rounded-2xl shadow-sm">

                                <source src="{{ asset('storage/'.$version->file_path) }}">

                            </video>

                        </div>

                        {{-- Không có preview --}}
                        @else

                        <div class="h-[700px] flex flex-col items-center justify-center bg-white">

                            <div
                                class="w-28 h-28 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center">

                                <i class="fa-solid fa-file-lines text-5xl text-amber-500"></i>

                            </div>

                            <h3 class="mt-6 text-2xl font-bold text-slate-900">

                                Không hỗ trợ xem trước

                            </h3>

                            <p class="mt-3 text-slate-500 text-center max-w-lg leading-7">

                                Tài liệu này chưa có file xem trước hoặc định dạng

                                <strong class="text-slate-700">

                                    {{ strtoupper($ext) }}

                                </strong>

                                không được hỗ trợ.

                            </p>

                            <a href="{{ route('documents.download',$document) }}"
                                class="mt-8 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition-all duration-300 hover:bg-amber-500">

                                <i class="fa-solid fa-download"></i>

                                Tải xuống

                            </a>


                        </div>

                        @endif

                    </div>

                </div>

            </div>


            <!-- ================= RIGHT : INFORMATION ================= -->
            <div>

                <div class="bg-white rounded-[30px] border border-slate-200 shadow-sm overflow-hidden">

                    <!-- HEADER -->
                    <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

                        <h2 class="text-xl font-bold text-slate-900">

                            <i class="fa-solid fa-circle-info text-amber-500 mr-2"></i>

                            Thông tin tài liệu

                        </h2>

                    </div>

                    <!-- CONTENT -->
                    <div class="p-6">

                        <div class="space-y-5">

                            <!-- Môn học -->
                            <div class="flex items-start justify-between gap-4">

                                <span class="text-sm font-semibold text-slate-500">
                                    Môn học
                                </span>

                                <span class="text-sm font-semibold text-slate-900 text-right">
                                    {{ $document->subject?->subject_name }}
                                </span>

                            </div>

                            <hr class="border-slate-100">

                            <!-- Loại tài liệu -->
                            <div class="flex items-start justify-between gap-4">

                                <span class="text-sm font-semibold text-slate-500">
                                    Loại tài liệu
                                </span>

                                <span
                                    class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">

                                    {{ $document->documentType?->type_name }}

                                </span>

                            </div>

                            <hr class="border-slate-100">

                            <!-- Người đăng -->
                            <div class="flex items-start justify-between gap-4">

                                <span class="text-sm font-semibold text-slate-500">
                                    Người đăng
                                </span>

                                <span class="text-sm font-semibold text-slate-900 text-right">

                                    {{ $document->uploader?->full_name }}

                                </span>

                            </div>

                            <hr class="border-slate-100">

                            <div class="flex items-start justify-between gap-4">

                                <span class="text-sm font-semibold text-slate-500">
                                    Cập nhật lần cuối
                                </span>

                                <span class="text-sm font-semibold text-slate-900 text-right">

                                    @if($document->currentVersion)

                                    {{ $document->currentVersion->uploader?->full_name }}

                                    <br>


                                    @else

                                    Chưa cập nhật

                                    @endif

                                </span>

                            </div>
                            <hr class="border-slate-100">

                            <!-- Ngày đăng -->
                            <div class="flex items-start justify-between gap-4">

                                <span class="text-sm font-semibold text-slate-500">
                                    Ngày đăng
                                </span>

                                <span class="text-sm font-semibold text-slate-900">

                                    {{ $document->created_at->format('d/m/Y H:i') }}

                                </span>

                            </div>

                            <hr class="border-slate-100">

                            <!-- Cập nhật lần cuối -->
                            <div class="flex items-start justify-between gap-4">

                                <span class="text-sm font-semibold text-slate-500">
                                    Cập nhật
                                </span>

                                <span class="text-sm font-semibold text-slate-900">

                                    {{ $document->updated_at->format('d/m/Y H:i') }}

                                </span>

                            </div>

                            <hr class="border-slate-100">

                            <!-- Kích thước -->
                            <div class="flex items-start justify-between gap-4">

                                <span class="text-sm font-semibold text-slate-500">
                                    Kích thước
                                </span>

                                <span
                                    class="inline-flex items-center rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">

                                    {{ number_format($document->currentVersion?->file_size / 1024 / 1024,2) }}
                                    MB

                                </span>

                            </div>

                            <hr class="border-slate-100">

                            <!-- Lượt tải -->
                            <div class="flex items-start justify-between gap-4">

                                <span class="text-sm font-semibold text-slate-500">
                                    Lượt tải
                                </span>

                                <span
                                    class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">

                                    <i class="fa-solid fa-download text-amber-500 mr-1"></i>

                                    {{ number_format($document->download_count) }}

                                </span>

                            </div>

                        </div>

                        @if($document->description)

                        <div class="mt-8">

                            <h3 class="mb-3 text-sm font-semibold text-slate-700">

                                Mô tả tài liệu

                            </h3>

                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">

                                <p class="text-sm leading-7 text-slate-600">

                                    {{ $document->description }}

                                </p>

                            </div>

                        </div>

                        @endif

                    </div>

                </div>

            </div>
        </div>
        <!-- RELATED -->
        <section class="mt-10">

            <div class="flex items-center justify-between mb-6">

                <div>

                    <h2 class="text-2xl font-bold text-slate-900">

                        Tài liệu liên quan

                    </h2>

                    <p class="mt-1 text-sm text-slate-500">

                        Các tài liệu thuộc cùng môn học

                    </p>

                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                @forelse($relatedDocuments as $related)

                @php
                $ext = strtolower($related->currentVersion?->file_extension ?? '');
                @endphp

                <a href="{{ route('documents.show',$related->document_id) }}"
                    class="group rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-amber-300 hover:shadow-xl">

                    <!-- ICON -->
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl
                bg-slate-100
                border border-slate-200
                text-slate-600
                transition-all duration-300
                group-hover:bg-amber-50
                group-hover:border-amber-300
                group-hover:text-amber-500">

                        @if($ext == 'pdf')

                        <i class="fa-solid fa-file-pdf text-2xl"></i>

                        @elseif(in_array($ext,['doc','docx']))

                        <i class="fa-solid fa-file-word text-2xl"></i>

                        @elseif(in_array($ext,['xls','xlsx']))

                        <i class="fa-solid fa-file-excel text-2xl"></i>

                        @elseif(in_array($ext,['ppt','pptx']))

                        <i class="fa-solid fa-file-powerpoint text-2xl"></i>

                        @elseif(in_array($ext,['zip','rar']))

                        <i class="fa-solid fa-file-zipper text-2xl"></i>

                        @else

                        <i class="fa-solid fa-file-lines text-2xl"></i>

                        @endif

                    </div>

                    <!-- TITLE -->
                    <h3
                        class="mt-5 line-clamp-2 text-lg font-bold text-slate-900 transition group-hover:text-amber-600">

                        {{ $related->title }}

                    </h3>

                    <!-- INFO -->
                    <div class="mt-5 flex flex-wrap gap-2">

                        <span
                            class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-700">

                            <i class="fa-solid fa-book mr-1 text-amber-500"></i>

                            {{ $related->subject?->subject_name }}

                        </span>

                        <span
                            class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-700">

                            <i class="fa-solid fa-layer-group mr-1 text-amber-500"></i>

                            {{ $related->documentType?->type_name }}

                        </span>

                    </div>

                    <!-- FOOTER -->
                    <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">

                        <span class="text-xs text-slate-500">

                            <i class="fa-solid fa-download text-amber-500 mr-1"></i>

                            {{ number_format($related->download_count) }}

                        </span>

                        <span class="text-xs text-slate-500">

                            <i class="fa-solid fa-calendar text-amber-500 mr-1"></i>

                            {{ $related->created_at->format('d/m/Y') }}

                        </span>
                        <div class="flex items-center gap-2 text-slate-500">

                            <i class="fa-solid fa-eye text-sky-500"></i>

                            <span>{{ number_format($related->view_count) }} lượt xem</span>

                        </div>

                    </div>

                </a>

                @empty

                <div class="col-span-full">

                    <div class="rounded-3xl border border-slate-200 bg-white py-16 text-center shadow-sm">

                        <div
                            class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-slate-100 border border-slate-200">

                            <i class="fa-solid fa-folder-open text-3xl text-amber-500"></i>

                        </div>

                        <h3 class="mt-6 text-2xl font-bold text-slate-900">

                            Chưa có tài liệu liên quan

                        </h3>

                        <p class="mx-auto mt-3 max-w-md text-slate-500 leading-7">

                            Hiện tại chưa có tài liệu nào khác thuộc môn học này.

                        </p>

                    </div>

                </div>

                @endforelse

            </div>

        </section>
    </div>
</main>
<!-- LOGIN REQUIRED MODAL -->
<div id="loginRequiredModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm">

    <div class="w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-2xl">

        <!-- HEADER -->
        <div class="px-8 py-7 border-b border-slate-200 bg-slate-50">

            <div class="mx-auto w-16 h-16 rounded-2xl bg-amber-50 flex items-center justify-center">

                <i class="fa-solid fa-lock text-2xl text-amber-500"></i>

            </div>

            <h2 class="mt-5 text-center text-2xl font-black text-slate-800">

                Yêu cầu đăng nhập

            </h2>

            <p class="mt-2 text-center text-sm text-slate-500 leading-6">

                Bạn cần đăng nhập để có thể tải xuống tài liệu này.

            </p>

        </div>

        <!-- CONTENT -->
        <div class="px-8 py-6">

            <div class="rounded-2xl border border-amber-100 bg-amber-50 p-4">

                <div class="flex items-start gap-3">

                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center">

                        <i class="fa-solid fa-circle-info text-amber-500"></i>

                    </div>

                    <div>

                        <h4 class="font-bold text-slate-800">

                            Tại sao cần đăng nhập?

                        </h4>

                        <p class="mt-1 text-sm text-slate-600 leading-6">

                            Sau khi đăng nhập, bạn có thể tải tài liệu, lưu lịch sử tải xuống
                            và sử dụng đầy đủ các chức năng của hệ thống.

                        </p>

                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-8 flex gap-3">

                <button type="button" onclick="closeLoginRequiredModal()" class="flex-1
                    h-11
                    rounded-xl
                    border
                    border-slate-200
                    bg-white
                    text-slate-700
                    text-sm
                    font-bold
                    hover:bg-slate-50
                    transition-all
                    duration-300">

                    Đóng

                </button>

                <a href="{{ route('login') }}" class="flex-1
                    h-11
                    rounded-xl
                    bg-amber-500
                    text-white
                    text-sm
                    font-bold
                    flex
                    items-center
                    justify-center
                    hover:bg-amber-600
                    transition-all
                    duration-300">

                    <i class="fa-solid fa-right-to-bracket mr-2"></i>

                    Đăng nhập

                </a>

            </div>

        </div>

    </div>

</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const modal = document.getElementById('loginRequiredModal');

    window.showLoginRequiredModal = function() {

        if (!modal) return;

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        document.body.style.overflow = 'hidden';
    }

    window.closeLoginRequiredModal = function() {

        if (!modal) return;

        modal.classList.remove('flex');
        modal.classList.add('hidden');

        document.body.style.overflow = '';
    }

    modal?.addEventListener('click', function(e) {

        if (e.target === modal) {
            closeLoginRequiredModal();
        }

    });

    document.addEventListener('keydown', function(e) {

        if (e.key === 'Escape') {
            closeLoginRequiredModal();
        }

    });

});
const btn = document.getElementById('favoriteBtn');

if (btn) {

    btn.addEventListener('click', function(e) {

        e.preventDefault();

        fetch(btn.dataset.url, {

                method: 'POST',

                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }

            })
            .then(response => response.json())
            .then(data => {

                if (data.favorite) {

                    btn.classList.remove(
                        'bg-red-50',
                        'border-red-200',
                        'text-red-600'
                    );

                    btn.classList.add(
                        'bg-red-500',
                        'border-red-500',
                        'text-white'
                    );

                    btn.innerHTML = `
                  <i class="fa-solid fa-bookmark"></i>
                    <span>Đã yêu thích</span>
                `;

                } else {

                    btn.classList.remove(
                        'bg-red-500',
                        'border-red-500',
                        'text-white'
                    );

                    btn.classList.add(
                        'bg-red-50',
                        'border-red-200',
                        'text-red-600'
                    );

                    btn.innerHTML = `
                 <i class="fa-regular fa-bookmark"></i>
                    <span>Yêu thích</span>
                `;

                }

            })
            .catch(error => {

                console.error(error);

            });

    });

}
</script>
@endpush