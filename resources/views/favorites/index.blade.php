@extends('layouts.app')

@section('title','Tài liệu yêu thích')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-8">

        <div>


            <h1 class="mt-4 text-4xl font-black tracking-tight text-slate-900">

                Tài liệu yêu thích

            </h1>

            <p class="mt-3 text-slate-500 max-w-2xl leading-7">

                Danh sách những tài liệu bạn đã đánh dấu yêu thích để có thể
                truy cập nhanh và sử dụng lại bất cứ lúc nào.

            </p>

        </div>

        <a href="{{ route('documents.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-6 py-3 font-semibold text-white transition hover:bg-amber-500">

            <i class="fa-solid fa-arrow-left"></i>

            Quay lại kho tài liệu

        </a>

    </div>


    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-200 bg-slate-50">

            <div>

                <h3 class="text-lg font-bold text-slate-900">


                    Danh sách tài liệu

                </h3>

                <p class="mt-1 text-sm text-slate-500">

                    Bạn có {{ $favorites->total() }} tài liệu trong danh sách yêu thích.

                </p>

            </div>

        </div>

        @if($favorites->count())

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            STT
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Tài liệu
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Môn học
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-500">
                            Người đăng
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">
                            Lượt tải
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">
                            Ngày yêu thích
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-500">
                            Thao tác
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($favorites as $favorite)

                    @php
                    $document = $favorite->document;
                    @endphp

                    <tr class="border-t border-slate-200 hover:bg-slate-50 transition">

                        <!-- STT -->
                        <td class="px-6 py-5">

                            {{ $loop->iteration + ($favorites->currentPage()-1) * $favorites->perPage() }}

                        </td>

                        <!-- Tài liệu -->
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <div
                                    class="w-12 h-12 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center">

                                    <i class="fa-solid fa-file-lines text-xl text-amber-500"></i>

                                </div>

                                <div>

                                    <h4 class="font-semibold text-slate-900">

                                        {{ $document->title }}

                                    </h4>

                                    <div class="mt-2">

                                        <span
                                            class="inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-semibold text-sky-700">

                                            {{ $document->documentType?->type_name }}

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </td>

                        <!-- Môn học -->
                        <td class="px-6 py-5">

                            {{ $document->subject?->subject_name }}

                        </td>

                        <!-- Người đăng -->
                        <td class="px-6 py-5">

                            {{ $document->uploader?->full_name }}

                        </td>

                        <!-- Lượt tải -->
                        <td class="px-6 py-5 text-center">

                            <span class="inline-flex items-center gap-1">

                                <i class="fa-solid fa-download text-amber-500"></i>

                                {{ number_format($document->download_count) }}

                            </span>

                        </td>

                        <!-- Ngày yêu thích -->
                        <td class="px-6 py-5 text-center text-slate-600">

                            {{ optional($favorite->created_at)->format('d/m/Y H:i') }}

                        </td>

                        <!-- ACTION -->
                        <td class="px-6 py-5">

                            <div class="flex justify-center gap-2">

                                <!-- Xem -->
                                <a href="{{ route('documents.show',$document->document_id) }}" class="inline-flex items-center justify-center
                                w-10 h-10
                                rounded-xl
                                bg-slate-900
                                text-white
                                transition
                                hover:bg-amber-500">

                                    <i class="fa-solid fa-eye"></i>

                                </a>

                                <!-- Bỏ yêu thích -->
                                <button type="button" data-url="{{ route('favorites.toggle',$document->document_id) }}"
                                    class="favorite-btn
                                inline-flex
                                items-center
                                justify-center
                                w-10
                                h-10
                                rounded-xl
                                bg-red-500
                                text-white
                                transition
                                hover:bg-red-600">

                                    <i class="fa-solid fa-bookmark"></i>
                                </button>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        @else
        <!-- EMPTY -->
        <div class="py-24 text-center">

            <div
                class="mx-auto flex h-24 w-24 items-center justify-center rounded-full border border-red-100 bg-red-50">

                <i class="fa-solid fa-heart text-5xl text-red-400"></i>

            </div>

            <h3 class="mt-6 text-2xl font-bold text-slate-900">

                Chưa có tài liệu yêu thích

            </h3>

            <p class="mt-3 text-slate-500">

                Hãy thêm những tài liệu bạn yêu thích để truy cập nhanh hơn.

            </p>

            <a href="{{ route('documents.index') }}"
                class="mt-8 inline-flex items-center gap-2 rounded-xl bg-amber-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-amber-600">

                <i class="fa-solid fa-book"></i>

                Khám phá tài liệu

            </a>

        </div>

        @endif

        <!-- PAGINATION -->
        @if($favorites->hasPages())

        <div class="px-6 py-6 border-t border-slate-200">

            <div class="flex items-center justify-center gap-2">

                {{-- Previous --}}
                @if($favorites->onFirstPage())

                <span
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 text-slate-300">

                    <i class="fa-solid fa-chevron-left"></i>

                </span>

                @else

                <a href="{{ $favorites->previousPageUrl() }}"
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-100">

                    <i class="fa-solid fa-chevron-left"></i>

                </a>

                @endif

                {{-- Pages --}}
                @foreach($favorites->getUrlRange(1,$favorites->lastPage()) as $page => $url)

                @if($page == $favorites->currentPage())

                <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-900 font-bold text-white">

                    {{ $page }}

                </span>

                @else

                <a href="{{ $url }}"
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white font-semibold text-slate-600 transition hover:border-amber-300 hover:bg-amber-50 hover:text-amber-600">

                    {{ $page }}

                </a>

                @endif

                @endforeach

                {{-- Next --}}
                @if($favorites->hasMorePages())

                <a href="{{ $favorites->nextPageUrl() }}"
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-100">

                    <i class="fa-solid fa-chevron-right"></i>

                </a>

                @else

                <span
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50 text-slate-300">

                    <i class="fa-solid fa-chevron-right"></i>

                </span>

                @endif

            </div>

        </div>

        @endif

    </div>

</div>

@endsection

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {

    document.querySelectorAll('.favorite-btn').forEach(function(btn) {

        btn.addEventListener('click', function() {

            fetch(btn.dataset.url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {

                    if (data.success) {

                        const row = btn.closest('tr');

                        row.style.transition = 'all .3s ease';
                        row.style.opacity = '0';
                        row.style.transform = 'translateX(20px)';

                        setTimeout(() => {
                            row.remove();

                            // Nếu không còn dòng nào thì reload để hiện Empty State
                            if (document.querySelectorAll('tbody tr').length ===
                                0) {
                                location.reload();
                            }

                        }, 300);
                    }

                })
                .catch(error => {

                    console.error(error);

                    alert('Có lỗi xảy ra, vui lòng thử lại.');

                });

        });

    });

});
</script>

@endpush