@extends('layouts.admin')

@section('title', 'Thêm loại tài liệu')
@section('page-title', 'Thêm loại tài liệu')

@section('content')

@php
$icons = $icons ?? [];

$selectedIcon = old('icon', 'fa-solid fa-file-lines');
$selectedColor = old('color', 'cyan');
$isActive = old('is_active', 1);

$documentCount = 0;
$colorPalettes = [
'cyan' => [
'label' => 'Cyan',
'class' => 'bg-cyan-50 text-cyan-600 border-cyan-100',
],
'blue' => [
'label' => 'Blue',
'class' => 'bg-blue-50 text-blue-600 border-blue-100',
],
'orange' => [
'label' => 'Orange',
'class' => 'bg-orange-50 text-orange-600 border-orange-100',
],
'purple' => [
'label' => 'Purple',
'class' => 'bg-purple-50 text-purple-600 border-purple-100',
],
'green' => [
'label' => 'Green',
'class' => 'bg-green-50 text-green-600 border-green-100',
],
'red' => [
'label' => 'Red',
'class' => 'bg-red-50 text-red-600 border-red-100',
],
'emerald' => [
'label' => 'Emerald',
'class' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
],
];
@endphp

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-white border rounded-md shadow-sm p-5 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-black">Thêm loại tài liệu</h2>
            <p class="text-sm text-slate-500">Tạo mới loại tài liệu</p>
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
                        Tên loại tài liệu
                    </h3>

                    <p class="text-xs text-slate-400">
                        NEW
                    </p>
                </div>
            </div>

            <div class="space-y-3 text-sm">

                <div class="flex justify-between">
                    <span class="text-slate-500">Tài liệu</span>
                    <span class="font-black">0</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Trạng thái</span>
                    <span id="previewStatus"
                        class="px-2 py-1 rounded text-xs font-black bg-emerald-50 text-emerald-600">
                        Hoạt động
                    </span>
                </div>

            </div>

        </div>

        {{-- FORM --}}
        <div class="lg:col-span-2 bg-white border rounded-md shadow-sm p-5">

            <form action="{{ route('admin.document-types.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- NAME --}}
                <div>
                    <label class="text-sm font-black text-slate-600">Tên loại</label>
                    <input type="text" name="type_name" id="type_name" value="{{ old('type_name') }}"
                        class="w-full h-11 px-4 mt-2 bg-slate-50 border rounded-md font-semibold">
                </div>

                {{-- DESCRIPTION --}}
                <div>
                    <label class="text-sm font-black text-slate-600">Mô tả</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full px-4 py-3 mt-2 bg-slate-50 border rounded-md font-semibold"></textarea>
                </div>

                {{-- ICON SELECT (GIỐNG EDIT) --}}
                <div>
                    <label class="text-sm font-black text-slate-600">Icon</label>

                    <select name="icon" id="iconSelect"
                        class="w-full h-11 mt-2 bg-slate-50 border rounded-md font-semibold">
                        @foreach($icons as $icon)
                        <option value="{{ $icon['value'] }}">
                            {{ $icon['label'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- COLOR (GIỐNG EDIT STYLE CARD) --}}
                <div>
                    <label class="text-sm font-black text-slate-600">Màu</label>

                    <div class="grid grid-cols-3 gap-2 mt-2">
                        @foreach($colorPalettes as $key => $color)

                        <label class="cursor-pointer">
                            <input type="radio" name="color" value="{{ $key }}" class="hidden peer"
                                @checked($key=='cyan' )>

                            <div class="px-3 py-2 rounded-md border font-black text-sm transition
        {{ $color['class'] }}
        peer-checked:ring-2 peer-checked:ring-cyan-200">

                                {{ $color['label'] }}
                            </div>
                        </label>

                        @endforeach
                    </div>
                </div>

                {{-- STATUS (GIỐNG EDIT ICON TOGGLE) --}}
                <div>
                    <label class="text-sm font-black text-slate-600">Trạng thái</label>

                    <button type="button" id="statusBtn"
                        class="w-full flex items-center justify-between px-5 py-4 mt-2 rounded-md border bg-slate-50">

                        <div>
                            <p class="font-black">Bật / tắt loại tài liệu</p>
                            <p class="text-xs text-slate-400">Hiển thị trong hệ thống</p>
                        </div>

                        <i id="statusIcon" class="fa-solid fa-toggle-on text-emerald-500 text-2xl"></i>
                    </button>

                    <input type="hidden" name="is_active" id="is_active" value="1">
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.document-types.index') }}"
                        class="h-11 px-4 flex items-center bg-slate-100 rounded-md font-black">
                        Hủy
                    </a>

                    <button class="h-11 px-4 bg-sky-500 text-white rounded-md font-black">
                        Tạo mới
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection

{{-- SCRIPT --}}
@push('scripts')
<script>
const name = document.getElementById('type_name');
const desc = document.getElementById('description');

const previewName = document.getElementById('previewName');
const previewIcon = document.getElementById('previewIcon');
const previewStatus = document.getElementById('previewStatus');

const iconSelect = document.getElementById('iconSelect');

const statusBtn = document.getElementById('statusBtn');
const statusIcon = document.getElementById('statusIcon');
const hidden = document.getElementById('is_active');

// TEXT LIVE
name.addEventListener('input', e => {
    previewName.textContent = e.target.value || 'Tên loại tài liệu';
});

// ICON LIVE
iconSelect.addEventListener('change', e => {
    previewIcon.className = e.target.value + ' text-sky-600 text-lg';
});

// STATUS TOGGLE
statusBtn.addEventListener('click', () => {
    if (hidden.value == 1) {
        hidden.value = 0;
        previewStatus.className = "px-2 py-1 rounded text-xs font-black bg-red-50 text-red-500";
        previewStatus.textContent = "Ẩn";
        statusIcon.className = "fa-solid fa-toggle-off text-slate-400 text-2xl";
    } else {
        hidden.value = 1;
        previewStatus.className = "px-2 py-1 rounded text-xs font-black bg-emerald-50 text-emerald-600";
        previewStatus.textContent = "Hoạt động";
        statusIcon.className = "fa-solid fa-toggle-on text-emerald-500 text-2xl";
    }
});
</script>
@endpush