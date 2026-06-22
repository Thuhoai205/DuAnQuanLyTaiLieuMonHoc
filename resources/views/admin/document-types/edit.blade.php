@extends('layouts.admin')

@section('title', 'Chỉnh sửa loại tài liệu')
@section('page-title', 'Chỉnh sửa loại tài liệu')

@section('content')

@php
$isActive = $documentType->is_active;
$selectedIcon = old('icon', $documentType->icon);
$selectedColor = old('color', $documentType->color ?? 'cyan');

$documentCount = $documentType->documents_count ?? 0;

$colorPalettes = [
'cyan' => 'bg-cyan-50 text-cyan-600 border-cyan-100',
'blue' => 'bg-blue-50 text-blue-600 border-blue-100',
'orange' => 'bg-orange-50 text-orange-600 border-orange-100',
'purple' => 'bg-purple-50 text-purple-600 border-purple-100',
'green' => 'bg-green-50 text-green-600 border-green-100',
'red' => 'bg-red-50 text-red-600 border-red-100',
'emerald' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
];
@endphp

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-white border rounded-md shadow-sm p-5 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-black">Chỉnh sửa loại tài liệu</h2>
            <p class="text-sm text-slate-500">Cập nhật thông tin loại tài liệu</p>
        </div>

        <a href="{{ route('admin.document-types.index') }}"
            class="h-11 px-4 flex items-center bg-slate-100 text-slate-700 rounded-md font-black">
            ← Quay lại
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- PREVIEW --}}
        <div class="bg-white border rounded-md shadow-sm p-5">

            <div class="flex items-center gap-3 mb-4">

                <div class="w-10 h-10 rounded-md bg-sky-50 flex items-center justify-center">
                    <i id="previewIcon" class="{{ $selectedIcon }} text-sky-600 text-lg"></i>
                </div>

                <div>
                    <h3 id="previewName" class="font-black text-slate-700">
                        {{ $documentType->type_name }}
                    </h3>
                    <p class="text-xs text-slate-400">
                        ID: #{{ $documentType->document_type_id }}
                    </p>
                </div>
            </div>

            <div class="space-y-3 text-sm">

                <div class="flex justify-between">
                    <span class="text-slate-500">Tài liệu</span>
                    <span class="font-black">{{ $documentCount }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Trạng thái</span>
                    <span id="previewStatus" class="px-2 py-1 rounded text-xs font-black
                        {{ $isActive ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-500' }}">
                        {{ $isActive ? 'Hoạt động' : 'Ẩn' }}
                    </span>
                </div>

            </div>

        </div>

        {{-- FORM --}}
        <div class="lg:col-span-2 bg-white border rounded-md shadow-sm p-5">

            <form action="{{ route('admin.document-types.update', $documentType->document_type_id) }}" method="POST"
                class="space-y-5">

                @csrf
                @method('PUT')

                {{-- NAME --}}
                <div>
                    <label class="text-sm font-black text-slate-600">Tên loại</label>
                    <input type="text" name="type_name" value="{{ old('type_name', $documentType->type_name) }}"
                        class="w-full h-11 px-4 mt-2 bg-slate-50 border rounded-md font-semibold">
                </div>

                {{-- DESCRIPTION --}}
                <div>
                    <label class="text-sm font-black text-slate-600">Mô tả</label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-3 mt-2 bg-slate-50 border rounded-md font-semibold">{{ old('description', $documentType->description) }}</textarea>
                </div>

                {{-- ICON SELECT (FIX) --}}
                <div>
                    <label class="text-sm font-black text-slate-600">Icon</label>

                    <select name="icon" id="iconSelect"
                        class="w-full h-11 mt-2 bg-slate-50 border rounded-md font-semibold">
                        @foreach($icons as $icon)
                        <option value="{{ $icon['value'] }}" @selected($selectedIcon===$icon['value'])>
                            {{ $icon['label'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- COLOR --}}
                <div>
                    <label class="text-sm font-black text-slate-600">Màu</label>

                    <div class="grid grid-cols-3 gap-2 mt-2">
                        @foreach($colorPalettes as $key => $class)
                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="{{ $key }}" class="hidden peer"
                                @checked($selectedColor===$key)>

                            <div class="px-3 py-2 rounded-md border font-black text-sm
                                    {{ $class }}
                                    peer-checked:ring-2 peer-checked:ring-cyan-200">

                                {{ ucfirst($key) }}
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- STATUS (FIXED ONLY ONE) --}}
                <div>
                    <label class="text-sm font-black text-slate-600">Trạng thái</label>

                    <button type="button" id="statusBtn"
                        class="w-full flex items-center justify-between px-5 py-4 mt-2 rounded-md border bg-slate-50">

                        <div>
                            <p class="font-black">Bật / tắt loại tài liệu</p>
                            <p class="text-xs text-slate-400">Hiển thị trong hệ thống</p>
                        </div>

                        <i id="statusIcon"
                            class="fa-solid {{ $isActive ? 'fa-toggle-on text-emerald-500' : 'fa-toggle-off text-slate-400' }} text-2xl">
                        </i>
                    </button>

                    <input type="hidden" name="is_active" id="is_active" value="{{ $isActive ? 1 : 0 }}">
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.document-types.index') }}"
                        class="h-11 px-4 flex items-center bg-slate-100 rounded-md font-black">
                        Hủy
                    </a>

                    <button class="h-11 px-4 bg-sky-500 text-white rounded-md font-black">
                        Cập nhật
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// ICON PREVIEW (FIXED)
document.getElementById('iconSelect').addEventListener('change', function() {
    document.getElementById('previewIcon').className =
        this.value + " text-sky-600 text-lg";
});

// STATUS TOGGLE
document.getElementById('statusBtn').addEventListener('click', function() {

    const input = document.getElementById('is_active');
    const icon = document.getElementById('statusIcon');
    const badge = document.getElementById('previewStatus');

    if (input.value == 1) {
        input.value = 0;

        icon.className = "fa-solid fa-toggle-off text-slate-400 text-2xl";
        badge.className = "px-2 py-1 rounded text-xs font-black bg-red-50 text-red-500";
        badge.innerText = "Ẩn";

    } else {
        input.value = 1;

        icon.className = "fa-solid fa-toggle-on text-emerald-500 text-2xl";
        badge.className = "px-2 py-1 rounded text-xs font-black bg-emerald-50 text-emerald-600";
        badge.innerText = "Hoạt động";
    }
});
</script>
@endpush