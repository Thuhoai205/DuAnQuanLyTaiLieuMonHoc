@extends('layouts.admin')

@section('title', 'Chỉnh sửa loại tài liệu')
@section('page-title', 'Chỉnh sửa loại tài liệu')

@section('content')

@php
$icons = [
[
'label' => 'Đề cương môn học',
'value' => 'fa-solid fa-book-open'
],
[
'label' => 'Giáo trình',
'value' => 'fa-solid fa-book'
],
[
'label' => 'Slide bài giảng',
'value' => 'fa-solid fa-file-powerpoint'
],
[
'label' => 'Tài liệu tham khảo',
'value' => 'fa-solid fa-file-lines'
],
[
'label' => 'Bài tập',
'value' => 'fa-solid fa-pencil'
],
[
'label' => 'Bài thực hành',
'value' => 'fa-solid fa-laptop-code'
],
[
'label' => 'Đề thi',
'value' => 'fa-solid fa-file-circle-check'
],
[
'label' => 'Đáp án',
'value' => 'fa-solid fa-circle-check'
],
[
'label' => 'Video bài giảng',
'value' => 'fa-solid fa-video'
],
[
'label' => 'Mã nguồn',
'value' => 'fa-solid fa-code'
],
[
'label' => 'Tệp PDF',
'value' => 'fa-solid fa-file-pdf'
],
[
'label' => 'Tệp Word',
'value' => 'fa-solid fa-file-word'
],
];

$colors = [
'cyan' => 'Cyan',
'blue' => 'Blue',
'orange' => 'Orange',
'purple' => 'Purple',
'green' => 'Green',
'indigo' => 'Indigo',
'red' => 'Red',
'emerald' => 'Emerald',
];

$selectedIcon = old('icon', $documentType->icon ?? 'fa-solid fa-file-lines');
$selectedColor = old('color', $documentType->color ?? 'cyan');
@endphp
<style>
.ts-wrapper {
    width: 100%;
}

.ts-control {
    min-height: 56px !important;
    padding-left: 64px !important;
    padding-right: 40px !important;

    border-radius: 16px !important;
    border: 1px solid #e2e8f0 !important;

    background: #f8fafc !important;

    font-weight: 700 !important;
    font-size: 15px !important;

    box-shadow: none !important;
}

.ts-wrapper.focus .ts-control {
    border-color: #06b6d4 !important;
    box-shadow: 0 0 0 4px rgba(6, 182, 212, .1) !important;
}

.ts-dropdown {
    border-radius: 16px !important;
    border: 1px solid #e2e8f0 !important;

    overflow: hidden;
}

.ts-dropdown .option {
    padding: 12px 16px;
    font-weight: 600;
}

.ts-dropdown .active {
    background: #ecfeff !important;
    color: #0891b2 !important;
}
</style>
<div class="max-w-6xl mx-auto px-2 lg:px-4">

    <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="text-3xl font-black text-slate-900">
                Chỉnh sửa loại tài liệu
            </h1>

            <p class="text-slate-500 font-semibold mt-2">
                Cập nhật thông tin loại tài liệu dùng để phân loại học liệu.
            </p>
        </div>

        <a href="{{ route('admin.document-types.index') }}"
            class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-white border border-slate-200 text-slate-700 font-black shadow-sm hover:bg-slate-50 transition">
            <span class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">
                <i class="fa-solid fa-arrow-left"></i>
            </span>
            Quay lại
        </a>
    </div>

    @if ($errors->any())
    <div class="mb-6 rounded-2xl border border-red-100 bg-red-50 px-5 py-4 text-sm text-red-600 font-bold">
        <i class="fa-solid fa-circle-exclamation mr-2"></i>
        Vui lòng kiểm tra lại thông tin nhập.
    </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        <div class="xl:col-span-1">
            <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden sticky top-6">
                <div class="bg-gradient-to-r from-cyan-600 to-sky-500 px-6 py-7 text-white">
                    <div
                        class="w-20 h-20 rounded-3xl bg-white/20 border border-white/30 flex items-center justify-center mb-5">
                        <i id="previewIcon" class="{{ $selectedIcon }} text-3xl"></i>
                    </div>

                    <span
                        class="inline-flex px-4 py-2 rounded-full bg-white/20 text-white text-xs font-black border border-white/20 mb-4">
                        Mã loại #{{ $documentType->document_type_id }}
                    </span>

                    <h2 id="previewName" class="text-2xl font-black leading-tight">
                        {{ old('type_name', $documentType->type_name) }}
                    </h2>

                    <p id="previewDescription" class="text-cyan-50 font-semibold mt-3 line-clamp-3">
                        {{ old('description', $documentType->description ?: 'Chưa có mô tả cho loại tài liệu này.') }}
                    </p>
                </div>

                <div class="p-6 space-y-4">
                    <div
                        class="flex items-center justify-between rounded-2xl bg-cyan-50 border border-cyan-100 px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">Trạng thái</span>

                        @if($documentType->is_active)
                        <span class="text-sm font-black text-emerald-600">Hoạt động</span>
                        @else
                        <span class="text-sm font-black text-red-500">Ngừng</span>
                        @endif
                    </div>

                    <div
                        class="flex items-center justify-between rounded-2xl bg-slate-50 border border-slate-100 px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">Số tài liệu</span>
                        <span class="text-sm font-black text-slate-700">
                            {{ $documentType->documents_count ?? $documentType->documents?->count() ?? 0 }}
                        </span>
                    </div>

                    <div
                        class="rounded-2xl bg-amber-50 border border-amber-100 px-4 py-3 text-sm font-bold text-amber-700">
                        <i class="fa-solid fa-circle-info mr-2"></i>
                        Nếu loại tài liệu đang được dùng, hãy cân nhắc trước khi đổi tên.
                    </div>
                </div>
            </div>
        </div>

        <div class="xl:col-span-2">
            <form action="{{ route('admin.document-types.update', $documentType->document_type_id) }}" method="POST"
                class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden">
                @csrf
                @method('PUT')

                <div class="px-6 py-5 border-b border-cyan-100 bg-cyan-50/40">
                    <h2 class="text-xl font-black text-slate-900">
                        Thông tin chỉnh sửa
                    </h2>

                    <p class="text-sm text-slate-500 font-semibold mt-1">
                        Thay đổi tên, mô tả, icon, màu và trạng thái.
                    </p>
                </div>

                <div class="p-6 sm:p-8 space-y-7">

                    <div>
                        <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                            Tên loại tài liệu <span class="text-red-500">*</span>
                        </label>

                        <input type="text" name="type_name" id="typeName"
                            value="{{ old('type_name', $documentType->type_name) }}"
                            placeholder="VD: Giáo trình, Slide bài giảng..."
                            class="w-full h-12 px-5 rounded-xl bg-slate-50 border @error('type_name') border-red-400 @else border-slate-200 @enderror outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700">

                        @error('type_name')
                        <p class="text-red-500 text-sm font-bold mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                            Mô tả
                        </label>

                        <textarea name="description" id="description" rows="4"
                            placeholder="Nhập mô tả ngắn cho loại tài liệu..."
                            class="w-full px-5 py-4 rounded-xl bg-slate-50 border @error('description') border-red-400 @else border-slate-200 @enderror outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700 resize-none">{{ old('description', $documentType->description) }}</textarea>

                        @error('description')
                        <p class="text-red-500 text-sm font-bold mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                            ICON
                        </label>

                        <div class="relative">



                            <select name="icon" id="iconSelect">
                                @foreach($icons as $icon)
                                <option value="{{ $icon['value'] }}" @selected($selectedIcon===$icon['value'])>
                                    {{ $icon['label'] }}
                                </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    @php
                    $colorPalettes = [
                    'cyan' => [
                    'label' => 'Cyan',
                    'box' => 'bg-cyan-50 border-cyan-200 text-cyan-600',
                    'dot' => 'bg-cyan-500',
                    ],
                    'blue' => [
                    'label' => 'Blue',
                    'box' => 'bg-blue-50 border-blue-200 text-blue-600',
                    'dot' => 'bg-blue-500',
                    ],
                    'orange' => [
                    'label' => 'Orange',
                    'box' => 'bg-orange-50 border-orange-200 text-orange-600',
                    'dot' => 'bg-orange-500',
                    ],
                    'purple' => [
                    'label' => 'Purple',
                    'box' => 'bg-purple-50 border-purple-200 text-purple-600',
                    'dot' => 'bg-purple-500',
                    ],
                    'green' => [
                    'label' => 'Green',
                    'box' => 'bg-green-50 border-green-200 text-green-600',
                    'dot' => 'bg-green-500',
                    ],
                    'indigo' => [
                    'label' => 'Indigo',
                    'box' => 'bg-indigo-50 border-indigo-200 text-indigo-600',
                    'dot' => 'bg-indigo-500',
                    ],
                    'red' => [
                    'label' => 'Red',
                    'box' => 'bg-red-50 border-red-200 text-red-600',
                    'dot' => 'bg-red-500',
                    ],
                    'emerald' => [
                    'label' => 'Emerald',
                    'box' => 'bg-emerald-50 border-emerald-200 text-emerald-600',
                    'dot' => 'bg-emerald-500',
                    ],
                    ];
                    @endphp

                    <div>
                        <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                            Màu hiển thị
                        </label>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @foreach($colorPalettes as $value => $palette)
                            <label class="cursor-pointer">
                                <input type="radio" name="color" value="{{ $value }}" class="peer hidden"
                                    @checked($selectedColor===$value)>

                                <div class="h-14 rounded-2xl border flex items-center justify-between px-4 font-black text-sm transition
                    {{ $palette['box'] }}
                    peer-checked:ring-4 peer-checked:ring-cyan-500/10 peer-checked:border-cyan-400">
                                    <span class="flex items-center gap-2">
                                        <span class="w-4 h-4 rounded-full {{ $palette['dot'] }}"></span>
                                        {{ $palette['label'] }}
                                    </span>

                                    <i class="fa-solid fa-check hidden peer-checked:block"></i>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                            Trạng thái
                        </label>

                        <label
                            class="flex items-center justify-between gap-4 rounded-2xl bg-slate-50 border border-slate-200 px-5 py-4 cursor-pointer">
                            <div>
                                <p class="font-black text-slate-800">
                                    Cho phép sử dụng loại tài liệu này
                                </p>

                                <p class="text-sm text-slate-400 font-semibold mt-1">
                                    Nếu tắt, loại này sẽ không nên xuất hiện khi upload tài liệu mới.
                                </p>
                            </div>

                            <input type="checkbox" name="is_active" value="1" class="w-5 h-5 accent-cyan-600"
                                @checked(old('is_active', $documentType->is_active))>
                        </label>
                    </div>

                </div>

                <div
                    class="px-6 sm:px-8 py-5 border-t border-cyan-100 bg-slate-50/50 flex flex-col sm:flex-row items-center justify-end gap-3">
                    <a href="{{ route('admin.document-types.index') }}"
                        class="w-full sm:w-auto px-5 py-3 rounded-xl bg-white border border-slate-200 text-slate-700 font-black hover:bg-slate-50 transition text-center">
                        Hủy
                    </a>

                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-black shadow-lg shadow-cyan-100 transition">
                        <i class="fa-solid fa-floppy-disk mr-2"></i>
                        Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const previewIcon = document.getElementById('previewIcon');
    const iconClassText = document.getElementById('iconClassText');

    new TomSelect("#iconSelect", {
        render: {
            option: function(data, escape) {
                return `
                    <div class="flex items-center gap-3">
                        <i class="${data.value} text-cyan-600 w-5"></i>
                        <span>${escape(data.text)}</span>
                    </div>
                `;
            },
            item: function(data, escape) {
                return `
                    <div class="flex items-center gap-3">
                        <i class="${data.value} text-cyan-600 w-5"></i>
                        <span>${escape(data.text)}</span>
                    </div>
                `;
            }
        },
        onChange: function(value) {
            if (previewIcon) previewIcon.className = value + ' text-3xl';
            if (iconClassText) iconClassText.textContent = value;
        }
    });
});
</script>
@endsection