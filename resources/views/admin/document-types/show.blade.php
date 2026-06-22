@extends('layouts.admin')

@section('title', 'Chi tiết loại tài liệu')
@section('page-title', 'Chi tiết loại tài liệu')

@section('content')

@php
$isActive = $documentType->is_active;
@endphp

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-white border rounded-md shadow-sm p-5 flex justify-between items-center">

        <div>
            <h2 class="text-lg font-black">
                {{ $documentType->type_name }}
            </h2>
            <p class="text-sm text-slate-500">
                Thông tin chi tiết loại tài liệu
            </p>
        </div>

        <div class="flex items-center gap-3">

            {{-- STATUS --}}
            <span class="text-xs px-3 py-1 rounded font-black inline-flex items-center gap-1
                {{ $isActive ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-500' }}">

                <span class="w-1.5 h-1.5 rounded-full
                    {{ $isActive ? 'bg-emerald-500' : 'bg-red-500' }}"></span>

                {{ $isActive ? 'Hoạt động' : 'Ẩn' }}
            </span>

            {{-- BACK --}}
            <a href="{{ route('admin.document-types.index') }}"
                class="h-10 px-4 flex items-center bg-slate-100 text-slate-700 rounded-md font-black hover:bg-slate-200 transition">
                ← Quay lại
            </a>

        </div>
    </div>

    {{-- GRID MAIN --}}
    <div class="grid grid-cols-12 gap-6">

        {{-- LEFT: INFO --}}
        <div class="col-span-12 md:col-span-4 space-y-6">

            {{-- INFO CARD --}}
            <div class="bg-white border rounded-md shadow-sm p-5">

                <h3 class="text-sm font-black text-slate-700 mb-4">
                    Thông tin cơ bản
                </h3>

                <div class="space-y-3 text-sm">

                    <div class="flex justify-between">
                        <span class="text-slate-500">Tên loại</span>
                        <span class="font-black">{{ $documentType->type_name }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-slate-500">Tổng tài liệu</span>
                        <span class="font-black">{{ $documentType->documents_count }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-slate-500">Trạng thái</span>
                        <span class="font-black {{ $isActive ? 'text-emerald-600' : 'text-red-500' }}">
                            {{ $isActive ? 'Hoạt động' : 'Ẩn' }}
                        </span>
                    </div>

                </div>
            </div>

            {{-- ACTION --}}
            <div class="bg-white border rounded-md shadow-sm p-5 flex justify-center gap-2">

                <a href="{{ route('admin.document-types.edit', $documentType->document_type_id) }}"
                    class="w-10 h-10 flex items-center justify-center rounded-md bg-amber-50 text-amber-500 hover:bg-amber-100 transition">
                    <i class="fa-solid fa-pen"></i>
                </a>

                <button type="button" onclick="toggleStatus('{{ $documentType->document_type_id }}', this)" class="w-10 h-10 flex items-center justify-center rounded-md
                        {{ $isActive ? 'bg-yellow-50 text-yellow-600' : 'bg-emerald-50 text-emerald-600' }}">

                    @if($isActive)
                    <i class="fa-solid fa-lock-open"></i>
                    @else
                    <i class="fa-solid fa-lock"></i>
                    @endif
                </button>

                <a href="{{ route('admin.document-types.index') }}"
                    class="w-10 h-10 flex items-center justify-center rounded-md bg-sky-50 text-sky-600 hover:bg-sky-100 transition">
                    <i class="fa-solid fa-list"></i>
                </a>

            </div>

        </div>

        {{-- RIGHT: DESCRIPTION + DOCUMENTS --}}
        <div class="col-span-12 md:col-span-8 space-y-6">

            {{-- DESCRIPTION --}}
            <div class="bg-white border rounded-md shadow-sm p-5">

                <h3 class="text-sm font-black text-slate-700 mb-4">
                    Mô tả
                </h3>

                <p class="text-sm text-slate-600 leading-relaxed">
                    {{ $documentType->description ?? 'Không có mô tả' }}
                </p>

            </div>

            {{-- DOCUMENT LIST --}}
            <div class="bg-white border rounded-md shadow-sm p-5">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm font-black text-slate-700">
                        Tài liệu thuộc loại này
                    </h3>
                </div>

                @if($documentType->documents->count() > 0)

                <div class="space-y-2">

                    @foreach($documentType->documents->take(5) as $doc)

                    <div
                        class="flex items-center justify-between p-3 bg-slate-50 rounded-md hover:bg-slate-100 transition">

                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-file text-sky-600"></i>
                            <span class="text-sm font-semibold">
                                {{ $doc->title }}
                            </span>
                        </div>

                        <span class="text-xs text-slate-500">
                            {{ $doc->created_at->format('d/m/Y') }}
                        </span>

                    </div>

                    @endforeach

                </div>

                @else
                <div class="text-sm text-slate-500">
                    Chưa có tài liệu nào
                </div>
                @endif

            </div>

        </div>

    </div>

</div>
@endsection


@push('scripts')
<script>
async function toggleStatus(id) {

    const res = await fetch(`/admin/document-types/${id}/status`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    });

    const data = await res.json();
    if (data.success) location.reload();
}
</script>
@endpush