@extends('layouts.app')

@section('title', 'Chi tiết tài liệu')

@section('content')

<main class="min-h-screen bg-[#EAFBFF] py-12">

    <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16">
        @if(auth()->check() && auth()->user()->role_id == 1)

        <a href="{{ url()->previous() }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 mb-8 rounded-full bg-white border border-cyan-100 text-cyan-700 font-bold text-sm hover:bg-cyan-50 transition">
            <i class="fa-solid fa-arrow-left"></i>
            Quay về quản trị
        </a>
        @endif
        @if(auth()->check() && auth()->user()->role_id !=1)

        <!-- BACK -->
        <a href="javascript:history.back()"
            class="inline-flex items-center gap-2 px-5 py-2.5 mb-8 rounded-full bg-white border border-cyan-100 text-cyan-700 font-bold text-sm hover:bg-cyan-50 transition">
            <i class="fa-solid fa-arrow-left"></i>
            Quay lại
        </a>
        @endif
        <!-- HEADER -->
        <div class="p-7 border-b border-cyan-100 flex items-start justify-between gap-6">

            @php
            $ext = strtolower($document->currentVersion?->file_extension ?? '');

            switch($ext){
            case 'pdf':
            $icon='fa-file-pdf';
            $color='bg-red-50 text-red-500 border-red-100';
            break;

            case 'doc':
            case 'docx':
            $icon='fa-file-word';
            $color='bg-blue-50 text-blue-600 border-blue-100';
            break;

            case 'ppt':
            case 'pptx':
            $icon='fa-file-powerpoint';
            $color='bg-orange-50 text-orange-500 border-orange-100';
            break;

            case 'xls':
            case 'xlsx':
            $icon='fa-file-excel';
            $color='bg-green-50 text-green-600 border-green-100';
            break;

            default:
            $icon='fa-file-lines';
            $color='bg-cyan-50 text-cyan-600 border-cyan-100';
            }

            $isAdmin = auth()->check() &&
            auth()->user()->role->role_name == 'admin';

            $isOwner = auth()->check() &&
            auth()->user()->role->role_name == 'lecturer' &&
            auth()->id() == $document->uploaded_by;
            @endphp

            <!-- LEFT -->
            <div class="flex items-center gap-5">

                <div class="w-20 h-20 rounded-3xl flex flex-col items-center justify-center border {{ $color }}">

                    <i class="fa-solid {{ $icon }} text-3xl"></i>

                    <span class="text-[10px] font-black mt-1">
                        {{ strtoupper($ext) }}
                    </span>

                </div>

                <div>

                    <h1 class="text-3xl font-black text-slate-900">
                        {{ $document->title }}
                    </h1>

                    <p class="text-slate-500 mt-2 font-semibold">

                        {{ $document->currentVersion?->original_file_name }}

                        •

                        {{ number_format($document->download_count) }} lượt tải

                    </p>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-3 shrink-0">

                {{-- Download --}}
                @auth

                <a href="{{ route('documents.download',$document->document_id) }}"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-bold shadow-lg shadow-cyan-200 transition">

                    <i class="fa-solid fa-cloud-arrow-down"></i>

                    Tải về

                </a>

                @else

                <button onclick="showLoginRequiredModal()"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl border border-cyan-200 text-cyan-700 hover:bg-cyan-50 font-bold">

                    <i class="fa-solid fa-lock"></i>

                    Đăng nhập để tải

                </button>

                @endauth


                {{-- Edit/Delete --}}
                @auth

                @if($isAdmin || $isOwner)

                <a href="{{ route('documents.edit',$document->document_id) }}"
                    class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 text-amber-500 hover:bg-amber-500 hover:text-white flex items-center justify-center transition">

                    <i class="fa-solid fa-pen"></i>

                </a>

                <form action="#" method="POST">

                    @csrf
                    @method('DELETE')

                    <button onclick="return confirm('Bạn có chắc chắn muốn xóa tài liệu này?')"
                        class="w-12 h-12 rounded-2xl bg-red-50 border border-red-100 text-red-500 hover:bg-red-500 hover:text-white transition">

                        <i class="fa-solid fa-trash"></i>

                    </button>

                </form>

                @endif

                @endauth

            </div>

        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">

            <!-- ================= LEFT : PREVIEW ================= -->
            <div class="lg:col-span-2">

                <div class="bg-white rounded-[30px] border border-cyan-100 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-cyan-100 bg-cyan-50 flex items-center justify-between">

                        <h2 class="text-xl font-black text-slate-800">
                            <i class="fa-solid fa-eye text-cyan-600 mr-2"></i>
                            Xem trước tài liệu
                        </h2>

                        <span class="text-sm text-cyan-600 font-bold">
                            {{ strtoupper($document->currentVersion?->file_extension) }}
                        </span>

                    </div>
                    <div class="bg-slate-100">

                        @php
                        $version = $document->currentVersion;
                        $ext = strtolower($version?->file_extension ?? '');
                        @endphp

                        @if($version && $version->canPreview())

                        {{-- PDF preview --}}
                        @if(Str::endsWith(strtolower($version->preview_file), '.pdf'))

                        <iframe src="{{ asset('storage/'.$version->preview_file) }}" class="w-full h-[900px] bg-white">
                        </iframe>

                        {{-- Image preview --}}
                        @else

                        <div class="flex justify-center p-8 bg-slate-200">

                            <img src="{{ asset('storage/'.$version->preview_file) }}"
                                class="max-h-[900px] rounded-xl shadow-xl">

                        </div>

                        @endif

                        @elseif(in_array($ext,['mp4','mov','avi','webm']))

                        <div class="p-8">

                            <video controls class="w-full rounded-2xl shadow">

                                <source src="{{ asset('storage/'.$version->file_path) }}">

                            </video>

                        </div>

                        @else

                        <div class="h-[700px] flex flex-col items-center justify-center bg-white">

                            <div class="w-28 h-28 rounded-full bg-cyan-50 flex items-center justify-center">

                                <i class="fa-solid fa-file-lines text-5xl text-cyan-500"></i>

                            </div>

                            <h3 class="mt-6 text-2xl font-black text-slate-800">

                                Không hỗ trợ xem trước

                            </h3>

                            <p class="mt-3 text-slate-500 text-center max-w-lg">

                                Tài liệu này chưa có file xem trước hoặc định dạng
                                <strong>{{ strtoupper($ext) }}</strong>
                                không được hỗ trợ.

                            </p>

                            <a href="{{ route('documents.download',$document) }}"
                                class="mt-8 inline-flex items-center gap-2 px-7 py-3 rounded-xl bg-cyan-500 hover:bg-cyan-600 text-white font-bold shadow-lg shadow-cyan-200">

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

                <div class="bg-white rounded-[30px] border border-cyan-100 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-cyan-100 bg-cyan-50">

                        <h2 class="text-xl font-black text-slate-800">

                            <i class="fa-solid fa-circle-info text-cyan-600 mr-2"></i>

                            Thông tin tài liệu

                        </h2>

                    </div>

                    <div class="p-6 space-y-6">

                        <div>

                            <p class="text-xs uppercase text-slate-400 font-black">
                                Môn học
                            </p>

                            <p class="font-bold mt-1">
                                {{ $document->subject?->subject_name }}
                            </p>

                        </div>

                        <div>

                            <p class="text-xs uppercase text-slate-400 font-black">
                                Loại tài liệu
                            </p>

                            <p class="font-bold mt-1">
                                {{ $document->documentType?->type_name }}
                            </p>

                        </div>

                        <div>

                            <p class="text-xs uppercase text-slate-400 font-black">
                                Người đăng
                            </p>

                            <p class="font-bold mt-1">
                                {{ $document->uploader?->full_name }}
                            </p>

                        </div>

                        <div>

                            <p class="text-xs uppercase text-slate-400 font-black">
                                Ngày đăng
                            </p>

                            <p class="font-bold mt-1">
                                {{ $document->created_at->format('d/m/Y H:i') }}
                            </p>

                        </div>

                        <div>

                            <p class="text-xs uppercase text-slate-400 font-black">
                                Kích thước
                            </p>

                            <p class="font-bold mt-1">
                                {{ number_format($document->currentVersion?->file_size / 1024 /1024,2) }} MB
                            </p>

                        </div>

                        <div>

                            <p class="text-xs uppercase text-slate-400 font-black">
                                Lượt tải
                            </p>

                            <p class="font-bold mt-1">
                                {{ number_format($document->download_count) }}
                            </p>

                        </div>

                        @if($document->description)

                        <div>

                            <p class="text-xs uppercase text-slate-400 font-black mb-2">
                                Mô tả
                            </p>

                            <div class="rounded-xl bg-slate-50 border p-4">

                                {{ $document->description }}

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
                    <h2 class="text-2xl font-black text-cyan-950">
                        Tài liệu liên quan
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Các tài liệu cùng môn học
                    </p>
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                @forelse($relatedDocuments as $related)

                @php
                $ext = strtolower($related->currentVersion?->file_extension ?? '');

                switch ($ext) {
                case 'pdf':
                $icon = 'fa-file-pdf';
                $color = 'bg-red-50 text-red-500';
                break;

                case 'doc':
                case 'docx':
                $icon = 'fa-file-word';
                $color = 'bg-blue-50 text-blue-500';
                break;

                case 'xls':
                case 'xlsx':
                $icon = 'fa-file-excel';
                $color = 'bg-green-50 text-green-500';
                break;

                case 'ppt':
                case 'pptx':
                $icon = 'fa-file-powerpoint';
                $color = 'bg-orange-50 text-orange-500';
                break;

                case 'zip':
                case 'rar':
                $icon = 'fa-file-zipper';
                $color = 'bg-yellow-50 text-yellow-600';
                break;

                default:
                $icon = 'fa-file-lines';
                $color = 'bg-cyan-50 text-cyan-500';
                }
                @endphp

                <a href="{{ route('documents.show',$related->document_id) }}"
                    class="group bg-white rounded-[28px] border border-cyan-100 p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300">

                    <div class="w-14 h-14 rounded-2xl {{ $color }} flex items-center justify-center mb-5">

                        <i class="fa-solid {{ $icon }} text-2xl"></i>

                    </div>

                    <h3 class="font-black text-slate-800 group-hover:text-cyan-600 transition line-clamp-2">

                        {{ $related->title }}

                    </h3>

                    <div class="mt-4 space-y-2 text-sm text-slate-500">

                        <div>
                            <i class="fa-solid fa-book text-cyan-500 mr-2"></i>
                            {{ $related->subject?->subject_name }}
                        </div>

                        <div>
                            <i class="fa-solid fa-layer-group text-cyan-500 mr-2"></i>
                            {{ $related->documentType?->type_name }}
                        </div>

                        <div>
                            <i class="fa-solid fa-download text-cyan-500 mr-2"></i>
                            {{ number_format($related->download_count) }} lượt tải
                        </div>

                        <div>
                            <i class="fa-solid fa-calendar text-cyan-500 mr-2"></i>
                            {{ $related->created_at->format('d/m/Y') }}
                        </div>

                    </div>

                </a>

                @empty

                <div class="col-span-full">

                    <div class="bg-white rounded-[28px] border border-dashed border-cyan-200 py-14 text-center">

                        <div class="w-16 h-16 mx-auto rounded-full bg-cyan-50 flex items-center justify-center">

                            <i class="fa-solid fa-folder-open text-2xl text-cyan-500"></i>

                        </div>

                        <h3 class="mt-5 text-lg font-black text-slate-700">

                            Chưa có tài liệu liên quan

                        </h3>

                        <p class="mt-2 text-sm text-slate-500">

                            Hiện chưa có tài liệu khác thuộc môn học này.

                        </p>

                    </div>

                </div>

                @endforelse

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