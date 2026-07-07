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

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h2 class="text-2xl font-black text-slate-800">

                    Chỉnh sửa loại tài liệu

                </h2>

                <p class="mt-2 text-sm text-slate-500">

                    Cập nhật thông tin và cấu hình loại tài liệu.

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
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

                <h3 class="text-base font-black text-slate-800">

                    Xem trước

                </h3>

                <p class="mt-1 text-sm text-slate-500">

                    Hiển thị thông tin sau khi chỉnh sửa.

                </p>

            </div>

            <div class="p-6">

                <div class="flex items-center gap-4">

                    <div class="w-14 h-14 rounded-xl bg-amber-50 flex items-center justify-center">

                        <i id="previewIcon" class="{{ $selectedIcon }} text-xl text-amber-500"></i>

                    </div>

                    <div>

                        <h3 id="previewName" class="text-lg font-black text-slate-800">

                            {{ $documentType->type_name }}

                        </h3>

                        <p class="mt-1 text-sm text-slate-400">

                            ID #{{ $documentType->document_type_id }}

                        </p>

                    </div>

                </div>

                <div class="mt-8 space-y-5">

                    <div class="flex items-center justify-between">

                        <span class="text-sm font-medium text-slate-500">

                            Tổng tài liệu

                        </span>

                        <span class="font-black text-amber-500">

                            {{ number_format($documentCount) }}

                        </span>

                    </div>

                    <div class="flex items-center justify-between">

                        <span class="text-sm font-medium text-slate-500">

                            Trạng thái

                        </span>

                        <span id="previewStatus" class="inline-flex
                            items-center
                            gap-2
                            rounded-full
                            px-3
                            py-1
                            text-xs
                            font-bold
                            {{ $isActive
                                ? 'bg-emerald-50 text-emerald-600'
                                : 'bg-red-50 text-red-600' }}">

                            <span class="w-2 h-2 rounded-full
                                {{ $isActive
                                    ? 'bg-emerald-500'
                                    : 'bg-red-500' }}"></span>

                            {{ $isActive ? 'Hoạt động' : 'Đã khóa' }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

        <!-- FORM -->
        <div class="xl:col-span-2 bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

                <h3 class="text-base font-black text-slate-800">

                    Thông tin loại tài liệu

                </h3>

                <p class="mt-1 text-sm text-slate-500">

                    Cập nhật đầy đủ thông tin của loại tài liệu.

                </p>

            </div>

            <form action="{{ route('admin.document-types.update',$documentType->document_type_id) }}" method="POST"
                class="p-6 space-y-6">

                @csrf
                @method('PUT')
                <!-- TÊN LOẠI -->
                <div>

                    <label class="block text-sm font-bold text-slate-700 mb-2">

                        Tên loại tài liệu <span class="text-red-500">*</span>

                    </label>

                    <input id="type_name" type="text" name="type_name"
                        value="{{ old('type_name',$documentType->type_name) }}" placeholder="Nhập tên loại tài liệu..."
                        class="w-full
                        h-12
                        px-4
                        rounded-xl
                        border
                        @error('type_name')
                            border-red-400
                        @else
                            border-slate-200
                        @enderror
                        bg-slate-50
                        text-slate-700
                        font-medium
                        placeholder:text-slate-400
                        focus:bg-white
                        focus:border-amber-500
                        focus:ring-4
                        focus:ring-amber-100
                        outline-none
                        transition-all">

                    @error('type_name')

                    <p class="mt-2 text-sm font-medium text-red-500">

                        {{ $message }}

                    </p>

                    @enderror

                </div>

                <!-- MÔ TẢ -->
                <div>

                    <label class="block text-sm font-bold text-slate-700 mb-2">

                        Mô tả

                    </label>

                    <textarea name="description" rows="4" placeholder="Nhập mô tả loại tài liệu..." class="w-full
                        px-4
                        py-3
                        rounded-xl
                        border
                        border-slate-200
                        bg-slate-50
                        text-slate-700
                        font-medium
                        placeholder:text-slate-400
                        focus:bg-white
                        focus:border-amber-500
                        focus:ring-4
                        focus:ring-amber-100
                        outline-none
                        transition-all">{{ old('description',$documentType->description) }}</textarea>

                </div>

                <!-- ICON -->
                <div>

                    <label class="block text-sm font-bold text-slate-700 mb-2">

                        Biểu tượng

                    </label>

                    <select name="icon" id="iconSelect" class="w-full
                        h-12
                        px-4
                        rounded-xl
                        border
                        border-slate-200
                        bg-slate-50
                        text-slate-700
                        font-medium
                        focus:bg-white
                        focus:border-amber-500
                        focus:ring-4
                        focus:ring-amber-100
                        outline-none
                        transition-all">

                        @foreach($icons as $icon)

                        <option value="{{ $icon['value'] }}" @selected($selectedIcon===$icon['value'])>

                            {{ $icon['label'] }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <!-- MÀU -->
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

                    <label class="block text-sm font-bold text-slate-700 mb-3">

                        Trạng thái

                    </label>

                    <button type="button" id="statusBtn" class="w-full
                        flex
                        items-center
                        justify-between
                        rounded-xl
                        border
                        border-slate-200
                        bg-slate-50
                        px-5
                        py-4
                        hover:border-amber-300
                        hover:bg-amber-50
                        transition-all
                        duration-300">

                        <div class="text-left">

                            <p class="font-black text-slate-800">

                                Hiển thị loại tài liệu

                            </p>

                            <p class="mt-1 text-sm text-slate-500">

                                Cho phép người dùng sử dụng loại tài liệu này.

                            </p>

                        </div>

                        <i id="statusIcon" class="fa-solid
                            {{ $isActive
                                ? 'fa-toggle-on text-emerald-500'
                                : 'fa-toggle-off text-slate-400'
                            }}
                            text-4xl
                            transition-all
                            duration-300">

                        </i>

                    </button>

                    <input type="hidden" name="is_active" id="is_active" value="{{ $isActive ? 1 : 0 }}">

                </div>

                <!-- BUTTON -->
                <div class="pt-2 border-t border-slate-200">

                    <div class="flex justify-end gap-3">

                        <!-- HỦY -->
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
                            transition-all
                            duration-300">

                            <i class="fa-solid fa-arrow-left"></i>

                            Hủy

                        </a>

                        <!-- SAVE -->
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
                            transition-all
                            duration-300">

                            <i class="fa-solid fa-floppy-disk"></i>

                            Cập nhật loại tài liệu

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
@push('scripts')

<script>
const typeName = document.getElementById('type_name');
const previewName = document.getElementById('previewName');

const iconSelect = document.getElementById('iconSelect');
const previewIcon = document.getElementById('previewIcon');

const statusBtn = document.getElementById('statusBtn');
const statusIcon = document.getElementById('statusIcon');
const previewStatus = document.getElementById('previewStatus');
const hiddenStatus = document.getElementById('is_active');


//==============================
// LIVE PREVIEW NAME
//==============================
if (typeName) {

    typeName.addEventListener('input', function() {

        previewName.textContent =
            this.value.trim() || 'Tên loại tài liệu';

    });

}


//==============================
// LIVE PREVIEW ICON
//==============================
if (iconSelect) {

    iconSelect.addEventListener('change', function() {

        previewIcon.className =
            this.value + ' text-xl text-amber-500';

    });

}


//==============================
// STATUS TOGGLE
//==============================
if (statusBtn) {

    statusBtn.addEventListener('click', function() {

        if (hiddenStatus.value == 1) {

            hiddenStatus.value = 0;

            statusIcon.className =
                'fa-solid fa-toggle-off text-4xl text-slate-400 transition-all duration-300';

            previewStatus.className =
                'inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-bold bg-red-50 text-red-600';

            previewStatus.innerHTML =
                '<span class="w-2 h-2 rounded-full bg-red-500"></span>Đã khóa';

        } else {

            hiddenStatus.value = 1;

            statusIcon.className =
                'fa-solid fa-toggle-on text-4xl text-emerald-500 transition-all duration-300';

            previewStatus.className =
                'inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-bold bg-emerald-50 text-emerald-600';

            previewStatus.innerHTML =
                '<span class="w-2 h-2 rounded-full bg-emerald-500"></span>Hoạt động';

        }

    });

}


//==============================
// LIVE COLOR PREVIEW
//==============================
document.querySelectorAll('input[name="color"]').forEach(function(item) {

    item.addEventListener('change', function() {

        previewIcon.parentElement.className =
            'w-14 h-14 rounded-xl flex items-center justify-center ' +
            this.parentElement.querySelector('div').className
            .replace('rounded-xl', '')
            .replace('border-2', '')
            .replace('p-4', '')
            .replace('text-center', '')
            .replace('transition-all', '')
            .replace('duration-300', '')
            .replace('peer-checked:ring-4', '')
            .replace('peer-checked:ring-amber-100', '')
            .replace('peer-checked:border-amber-500', '');

    });

});
</script>

@endpush