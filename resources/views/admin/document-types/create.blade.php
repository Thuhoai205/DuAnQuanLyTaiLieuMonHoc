@extends('layouts.admin')

@section('title', 'Thêm loại tài liệu')
@section('page-title', 'Thêm loại tài liệu')

@section('content')

@php

$icons = $icons ?? [];

$selectedIcon = old('icon', 'fa-solid fa-file-lines');
$selectedColor = old('color', 'cyan');
$isActive = old('is_active', 1);

$colorPalettes = [

'cyan' => [
'label' => 'Cyan',
'class' => 'bg-cyan-50 text-cyan-600 border-cyan-100'
],

'blue' => [
'label' => 'Blue',
'class' => 'bg-blue-50 text-blue-600 border-blue-100'
],

'orange' => [
'label' => 'Orange',
'class' => 'bg-orange-50 text-orange-600 border-orange-100'
],

'purple' => [
'label' => 'Purple',
'class' => 'bg-purple-50 text-purple-600 border-purple-100'
],

'green' => [
'label' => 'Green',
'class' => 'bg-green-50 text-green-600 border-green-100'
],

'red' => [
'label' => 'Red',
'class' => 'bg-red-50 text-red-600 border-red-100'
],

'emerald' => [
'label' => 'Emerald',
'class' => 'bg-emerald-50 text-emerald-600 border-emerald-100'
],

];

@endphp

<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h2 class="text-2xl font-black text-slate-800">

                    Thêm loại tài liệu

                </h2>

                <p class="mt-2 text-sm text-slate-500">

                    Tạo loại tài liệu mới để phân loại tài liệu trong hệ thống.

                </p>

            </div>

            <a href="{{ route('admin.document-types.index') }}" class="inline-flex
                items-center
                gap-2
                h-11
                px-5
                rounded-xl
                border
                border-slate-200
                bg-white
                text-slate-700
                text-sm
                font-semibold
                hover:bg-slate-50
                transition-all duration-300">

                <i class="fa-solid fa-arrow-left"></i>

                Quay lại

            </a>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- PREVIEW -->
        <div>

            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden sticky top-6">

                <div class="p-6 bg-slate-50 border-b border-slate-200">

                    <div class="w-14 h-14 rounded-xl bg-amber-50 flex items-center justify-center">

                        <i id="previewIcon" class="{{ $selectedIcon }} text-amber-600 text-xl"></i>

                    </div>

                    <h3 id="previewName" class="mt-4 text-lg font-black text-slate-800">

                        Tên loại tài liệu

                    </h3>

                    <p class="mt-1 text-sm text-slate-500">

                        Xem trước thông tin hiển thị

                    </p>

                </div>

                <div class="p-5 space-y-4">

                    <div class="flex justify-between">

                        <span class="text-sm font-semibold text-slate-500">

                            Số tài liệu

                        </span>

                        <span class="font-black text-slate-800">

                            0

                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-sm font-semibold text-slate-500">

                            Trạng thái

                        </span>

                        <span id="previewStatus" class="inline-flex
                            items-center
                            gap-2
                            rounded-full
                            bg-emerald-50
                            px-3
                            py-1
                            text-xs
                            font-bold
                            text-emerald-600">

                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                            Hoạt động

                        </span>

                    </div>

                </div>

            </div>

        </div>

        <!-- FORM -->
        <div class="xl:col-span-2">

            <form action="{{ route('admin.document-types.store') }}" method="POST"
                class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

                @csrf

                <!-- CARD HEADER -->
                <div class="px-6 py-5 bg-slate-50 border-b border-slate-200">

                    <h3 class="text-lg font-black text-slate-800">

                        Thông tin loại tài liệu

                    </h3>

                </div>

                <div class="p-6 space-y-6">
                    <!-- TÊN LOẠI -->
                    <div>

                        <label class="text-xs font-black uppercase tracking-wide text-slate-500">

                            Tên loại tài liệu

                        </label>

                        <input id="type_name" type="text" name="type_name" value="{{ old('type_name') }}"
                            placeholder="Ví dụ: Bài giảng" class="w-full
                            mt-2
                            h-11
                            px-4
                            rounded-xl
                            border
                            @error('type_name')
                                border-red-400
                            @else
                                border-slate-200
                            @enderror
                            bg-slate-50
                            text-sm
                            font-medium
                            text-slate-700
                            placeholder:text-slate-400
                            outline-none
                            transition-all duration-300
                            focus:bg-white
                            focus:border-amber-500
                            focus:ring-4
                            focus:ring-amber-100">

                        @error('type_name')

                        <p class="mt-2 text-sm font-semibold text-red-500">

                            {{ $message }}

                        </p>

                        @enderror

                    </div>


                    <!-- MÔ TẢ -->
                    <div>

                        <label class="text-xs font-black uppercase tracking-wide text-slate-500">

                            Mô tả

                        </label>

                        <textarea id="description" name="description" rows="4"
                            placeholder="Nhập mô tả cho loại tài liệu..." class="w-full
                            mt-2
                            px-4
                            py-3
                            rounded-xl
                            border
                            border-slate-200
                            bg-slate-50
                            text-sm
                            font-medium
                            text-slate-700
                            placeholder:text-slate-400
                            resize-none
                            outline-none
                            transition-all duration-300
                            focus:bg-white
                            focus:border-amber-500
                            focus:ring-4
                            focus:ring-amber-100">{{ old('description') }}</textarea>

                    </div>


                    <!-- ICON -->
                    <div>

                        <label class="text-xs font-black uppercase tracking-wide text-slate-500">

                            Biểu tượng

                        </label>

                        <div class="mt-2 flex items-center gap-4">

                            <div class="w-11
                                h-11
                                rounded-xl
                                bg-amber-50
                                flex
                                items-center
                                justify-center">

                                <i id="iconPreview" class="{{ $selectedIcon }} text-amber-600"></i>

                            </div>

                            <select id="iconSelect" name="icon" class="flex-1
                                h-11
                                px-4
                                rounded-xl
                                border
                                border-slate-200
                                bg-slate-50
                                text-sm
                                font-medium
                                text-slate-700
                                outline-none
                                transition-all duration-300
                                focus:bg-white
                                focus:border-amber-500
                                focus:ring-4
                                focus:ring-amber-100">

                                @foreach($icons as $icon)

                                <option value="{{ $icon['value'] }}"
                                    @selected(old('icon',$selectedIcon)==$icon['value'])>

                                    {{ $icon['label'] }}

                                </option>

                                @endforeach

                            </select>

                        </div>

                    </div>
                    <!-- MÀU SẮC -->
                    <div>

                        <label class="text-xs font-black uppercase tracking-wide text-slate-500">

                            Màu hiển thị

                        </label>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-3">

                            @foreach($colorPalettes as $key => $color)

                            <label class="cursor-pointer group">

                                <input type="radio" name="color" value="{{ $key }}" class="hidden peer"
                                    @checked(old('color',$selectedColor)==$key)>

                                <div class="rounded-xl
                                    border-2
                                    px-4
                                    py-3
                                    text-center
                                    font-bold
                                    text-sm
                                    transition-all
                                    duration-300
                                    {{ $color['class'] }}
                                    peer-checked:border-amber-500
                                    peer-checked:ring-4
                                    peer-checked:ring-amber-100
                                    hover:scale-105">

                                    {{ $color['label'] }}

                                </div>

                            </label>

                            @endforeach

                        </div>

                    </div>


                    <!-- TRẠNG THÁI -->
                    <div>

                        <label class="text-xs font-black uppercase tracking-wide text-slate-500">

                            Trạng thái

                        </label>

                        <button type="button" id="statusBtn" class="w-full
                            mt-3
                            rounded-xl
                            border
                            border-slate-200
                            bg-slate-50
                            px-5
                            py-4
                            flex
                            items-center
                            justify-between
                            hover:bg-white
                            transition-all
                            duration-300">

                            <div class="text-left">

                                <h4 class="font-black text-slate-800">

                                    Hiển thị loại tài liệu

                                </h4>

                                <p class="text-sm text-slate-500 mt-1">

                                    Cho phép sử dụng loại tài liệu trong hệ thống.

                                </p>

                            </div>

                            <i id="statusIcon" class="fa-solid fa-toggle-on text-emerald-500 text-3xl"></i>

                        </button>

                        <input type="hidden" id="is_active" name="is_active" value="{{ $isActive }}">

                    </div>


                    <!-- FOOTER -->
                    <div class="pt-6 border-t border-slate-200">

                        <div class="flex justify-end gap-3">
                            <!-- HỦY -->
                            <a href="{{ route('admin.document-types.index') }}" class="inline-flex
                                items-center
                                justify-center
                                h-11
                                px-5
                                rounded-xl
                                border
                                border-slate-200
                                bg-white
                                text-slate-700
                                text-sm
                                font-semibold
                                hover:bg-slate-50
                                transition-all duration-300">

                                Hủy

                            </a>

                            <!-- SUBMIT -->
                            <button type="submit" class="inline-flex
                                items-center
                                gap-2
                                h-11
                                px-6
                                rounded-xl
                                bg-amber-500
                                text-white
                                text-sm
                                font-bold
                                hover:bg-amber-600
                                transition-all duration-300">

                                <i class="fa-solid fa-plus"></i>

                                Tạo loại tài liệu

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {

    const nameInput = document.getElementById('type_name');
    const previewName = document.getElementById('previewName');

    const iconSelect = document.getElementById('iconSelect');
    const previewIcon = document.getElementById('previewIcon');

    const statusBtn = document.getElementById('statusBtn');
    const statusIcon = document.getElementById('statusIcon');
    const previewStatus = document.getElementById('previewStatus');
    const hiddenStatus = document.getElementById('is_active');

    // ===========================
    // Preview tên
    // ===========================
    if (nameInput) {

        nameInput.addEventListener('input', function() {

            previewName.textContent =
                this.value || 'Tên loại tài liệu';

        });

    }

    // ===========================
    // Preview icon
    // ===========================
    if (iconSelect) {

        iconSelect.addEventListener('change', function() {

            previewIcon.className =
                this.value + ' text-amber-600 text-xl';

        });

    }

    // ===========================
    // Toggle Status
    // ===========================
    if (statusBtn) {

        statusBtn.addEventListener('click', function() {

            if (hiddenStatus.value == 1) {

                hiddenStatus.value = 0;

                statusIcon.className =
                    'fa-solid fa-toggle-off text-red-500 text-3xl';

                previewStatus.className =
                    'inline-flex items-center gap-2 rounded-full bg-red-50 px-3 py-1 text-xs font-bold text-red-600';

                previewStatus.innerHTML =
                    '<span class="w-2 h-2 rounded-full bg-red-500"></span>Đã khóa';

            } else {

                hiddenStatus.value = 1;

                statusIcon.className =
                    'fa-solid fa-toggle-on text-emerald-500 text-3xl';

                previewStatus.className =
                    'inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-600';

                previewStatus.innerHTML =
                    '<span class="w-2 h-2 rounded-full bg-emerald-500"></span>Hoạt động';

            }

        });

    }

});
</script>

@endpush