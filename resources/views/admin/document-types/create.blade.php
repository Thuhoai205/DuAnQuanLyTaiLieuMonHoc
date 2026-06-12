 @extends('layouts.admin')

 @section('title', 'Thêm loại tài liệu')
 @section('page-title', 'Thêm loại tài liệu')

 @section('content')

 @php
 $icons = [
 ['label' => 'Đề cương môn học', 'value' => 'fa-solid fa-book-open'],
 ['label' => 'Giáo trình', 'value' => 'fa-solid fa-book'],
 ['label' => 'Slide bài giảng', 'value' => 'fa-solid fa-file-powerpoint'],
 ['label' => 'Tài liệu tham khảo', 'value' => 'fa-solid fa-file-lines'],
 ['label' => 'Bài tập', 'value' => 'fa-solid fa-pencil'],
 ['label' => 'Bài thực hành', 'value' => 'fa-solid fa-laptop-code'],
 ['label' => 'Đề thi', 'value' => 'fa-solid fa-file-circle-check'],
 ['label' => 'Đáp án', 'value' => 'fa-solid fa-circle-check'],
 ['label' => 'Video bài giảng', 'value' => 'fa-solid fa-video'],
 ['label' => 'Mã nguồn', 'value' => 'fa-solid fa-code'],
 ['label' => 'Tệp PDF', 'value' => 'fa-solid fa-file-pdf'],
 ['label' => 'Tệp Word', 'value' => 'fa-solid fa-file-word'],
 ];

 $colorPalettes = [
 'cyan' => [
 'label' => 'Cyan',
 'header' => 'from-cyan-600 to-sky-500',
 'box' => 'bg-cyan-400/30 border-cyan-200/40',
 'soft' => 'bg-cyan-50 border-cyan-100',
 'dot' => 'bg-cyan-500',
 'radio' => 'bg-cyan-50 border-cyan-200 text-cyan-600',
 ],
 'blue' => [
 'label' => 'Blue',
 'header' => 'from-blue-600 to-sky-500',
 'box' => 'bg-blue-400/30 border-blue-200/40',
 'soft' => 'bg-blue-50 border-blue-100',
 'dot' => 'bg-blue-500',
 'radio' => 'bg-blue-50 border-blue-200 text-blue-600',
 ],
 'orange' => [
 'label' => 'Orange',
 'header' => 'from-orange-600 to-amber-500',
 'box' => 'bg-orange-400/30 border-orange-200/40',
 'soft' => 'bg-orange-50 border-orange-100',
 'dot' => 'bg-orange-500',
 'radio' => 'bg-orange-50 border-orange-200 text-orange-600',
 ],
 'purple' => [
 'label' => 'Purple',
 'header' => 'from-purple-600 to-violet-500',
 'box' => 'bg-purple-400/30 border-purple-200/40',
 'soft' => 'bg-purple-50 border-purple-100',
 'dot' => 'bg-purple-500',
 'radio' => 'bg-purple-50 border-purple-200 text-purple-600',
 ],
 'green' => [
 'label' => 'Green',
 'header' => 'from-green-600 to-emerald-500',
 'box' => 'bg-green-400/30 border-green-200/40',
 'soft' => 'bg-green-50 border-green-100',
 'dot' => 'bg-green-500',
 'radio' => 'bg-green-50 border-green-200 text-green-600',
 ],
 'indigo' => [
 'label' => 'Indigo',
 'header' => 'from-indigo-600 to-blue-500',
 'box' => 'bg-indigo-400/30 border-indigo-200/40',
 'soft' => 'bg-indigo-50 border-indigo-100',
 'dot' => 'bg-indigo-500',
 'radio' => 'bg-indigo-50 border-indigo-200 text-indigo-600',
 ],
 'red' => [
 'label' => 'Red',
 'header' => 'from-red-600 to-rose-500',
 'box' => 'bg-red-400/30 border-red-200/40',
 'soft' => 'bg-red-50 border-red-100',
 'dot' => 'bg-red-500',
 'radio' => 'bg-red-50 border-red-200 text-red-600',
 ],
 'emerald' => [
 'label' => 'Emerald',
 'header' => 'from-emerald-600 to-green-500',
 'box' => 'bg-emerald-400/30 border-emerald-200/40',
 'soft' => 'bg-emerald-50 border-emerald-100',
 'dot' => 'bg-emerald-500',
 'radio' => 'bg-emerald-50 border-emerald-200 text-emerald-600',
 ],
 ];

 $selectedIcon = old('icon', 'fa-solid fa-file-lines');
 $selectedColor = old('color', 'cyan');
 $currentColor = $colorPalettes[$selectedColor] ?? $colorPalettes['cyan'];
 $isActive = old('is_active', true) ? true : false;
 @endphp

 <style>
.ts-wrapper {
    width: 100%;
}

.ts-control {
    min-height: 56px !important;
    padding-left: 18px !important;
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
                 Thêm loại tài liệu
             </h1>

             <p class="text-slate-500 font-semibold mt-2">
                 Tạo mới loại tài liệu dùng để phân loại học liệu trong hệ thống.
             </p>
         </div>

         <a href="{{ route('admin.document-types.index') }}"
             class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-white border border-cyan-100 text-slate-700 font-black shadow-sm hover:bg-cyan-50 hover:text-cyan-700 transition">
             <span class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
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

                 <div id="previewHeader" class="bg-gradient-to-r {{ $currentColor['header'] }} px-6 py-7 text-white">

                     <div id="previewIconBox"
                         class="w-20 h-20 rounded-3xl {{ $currentColor['box'] }} border flex items-center justify-center mb-5">
                         <i id="previewIcon" class="{{ $selectedIcon }} text-3xl"></i>
                     </div>

                     <span
                         class="inline-flex px-4 py-2 rounded-full bg-white/20 text-white text-xs font-black border border-white/20 mb-4">
                         New Type
                     </span>

                     <h2 id="previewName" class="text-2xl font-black leading-tight">
                         {{ old('type_name', 'Tên loại tài liệu') }}
                     </h2>

                     <p id="previewDescription" class="text-white/90 font-semibold mt-3 line-clamp-3">
                         {{ old('description', 'Mô tả ngắn cho loại tài liệu này.') }}
                     </p>
                 </div>

                 <div class="p-6 space-y-4">
                     <div id="previewStatusBox"
                         class="flex items-center justify-between rounded-2xl {{ $currentColor['soft'] }} border px-4 py-3">
                         <span class="text-sm font-bold text-slate-500">
                             Trạng thái
                         </span>

                         <span id="previewStatusText"
                             class="text-sm font-black {{ $isActive ? 'text-emerald-600' : 'text-red-500' }}">
                             {{ $isActive ? 'Hoạt động' : 'Ngừng hoạt động' }}
                         </span>
                     </div>

                     <div
                         class="flex items-center justify-between rounded-2xl bg-slate-50 border border-slate-100 px-4 py-3">
                         <span class="text-sm font-bold text-slate-500">
                             Số tài liệu
                         </span>

                         <span class="text-sm font-black text-slate-700">
                             0
                         </span>
                     </div>

                     <div
                         class="rounded-2xl bg-amber-50 border border-amber-100 px-4 py-3 text-sm font-bold text-amber-700">
                         <i class="fa-solid fa-circle-info mr-2"></i>
                         Nên đặt tên ngắn gọn, dễ hiểu để giảng viên và sinh viên dễ tìm kiếm.
                     </div>
                 </div>

             </div>
         </div>

         <div class="xl:col-span-2">
             <form action="{{ route('admin.document-types.store') }}" method="POST"
                 class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden">
                 @csrf

                 <div class="px-6 py-5 border-b border-cyan-100 bg-cyan-50/40">
                     <h2 class="text-xl font-black text-slate-900">
                         Thông tin loại tài liệu
                     </h2>

                     <p class="text-sm text-slate-500 font-semibold mt-1">
                         Nhập tên, mô tả, icon, màu hiển thị và trạng thái.
                     </p>
                 </div>

                 <div class="p-6 sm:p-8 space-y-7">

                     <div>
                         <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                             Tên loại tài liệu <span class="text-red-500">*</span>
                         </label>

                         <input type="text" name="type_name" id="typeName" value="{{ old('type_name') }}"
                             placeholder="VD: Giáo trình, Slide bài giảng, Đề thi..." class="w-full h-12 px-5 rounded-xl bg-slate-50 border outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700
                            @error('type_name') border-red-400 @else border-slate-200 @enderror">

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
                             class="w-full px-5 py-4 rounded-xl bg-slate-50 border outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700 resize-none
                            @error('description') border-red-400 @else border-slate-200 @enderror">{{ old('description') }}</textarea>

                         @error('description')
                         <p class="text-red-500 text-sm font-bold mt-2">{{ $message }}</p>
                         @enderror
                     </div>

                     <div>
                         <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                             Icon
                         </label>

                         <select name="icon" id="iconSelect">
                             @foreach($icons as $icon)
                             <option value="{{ $icon['value'] }}" @selected($selectedIcon===$icon['value'])>
                                 {{ $icon['label'] }}
                             </option>
                             @endforeach
                         </select>

                         @error('icon')
                         <p class="text-red-500 text-sm font-bold mt-2">{{ $message }}</p>
                         @enderror
                     </div>

                     <div>
                         <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                             Màu hiển thị
                         </label>

                         <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                             @foreach($colorPalettes as $value => $palette)
                             <label class="cursor-pointer">
                                 <input type="radio" name="color" value="{{ $value }}" class="color-radio peer hidden"
                                     @checked($selectedColor===$value)>

                                 <div
                                     class="h-14 rounded-2xl border flex items-center justify-between px-4 font-black text-sm transition {{ $palette['radio'] }} peer-checked:ring-4 peer-checked:ring-cyan-500/10 peer-checked:border-cyan-400">
                                     <span class="flex items-center gap-2">
                                         <span class="w-4 h-4 rounded-full {{ $palette['dot'] }}"></span>
                                         {{ $palette['label'] }}
                                     </span>

                                     <i
                                         class="fa-solid fa-check {{ $selectedColor === $value ? '' : 'opacity-0' }}"></i>
                                 </div>
                             </label>
                             @endforeach
                         </div>

                         @error('color')
                         <p class="text-red-500 text-sm font-bold mt-2">{{ $message }}</p>
                         @enderror
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

                             <input type="checkbox" name="is_active" id="isActiveInput" value="1"
                                 class="w-5 h-5 accent-cyan-600" @checked(old('is_active', true))>
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
                         <i class="fa-solid fa-plus mr-2"></i>
                         Thêm loại tài liệu
                     </button>
                 </div>

             </form>
         </div>

     </div>

 </div>

 @endsection

 @push('scripts')
 <script>
document.addEventListener('DOMContentLoaded', function() {
    const previewIcon = document.getElementById('previewIcon');
    const previewHeader = document.getElementById('previewHeader');
    const previewIconBox = document.getElementById('previewIconBox');
    const previewStatusBox = document.getElementById('previewStatusBox');
    const previewStatusText = document.getElementById('previewStatusText');

    const typeName = document.getElementById('typeName');
    const description = document.getElementById('description');
    const previewName = document.getElementById('previewName');
    const previewDescription = document.getElementById('previewDescription');

    const isActiveInput = document.getElementById('isActiveInput');

    const colorClasses = {
        cyan: {
            header: 'from-cyan-600 to-sky-500',
            box: 'bg-cyan-400/30 border-cyan-200/40',
            soft: 'bg-cyan-50 border-cyan-100'
        },
        blue: {
            header: 'from-blue-600 to-sky-500',
            box: 'bg-blue-400/30 border-blue-200/40',
            soft: 'bg-blue-50 border-blue-100'
        },
        orange: {
            header: 'from-orange-600 to-amber-500',
            box: 'bg-orange-400/30 border-orange-200/40',
            soft: 'bg-orange-50 border-orange-100'
        },
        purple: {
            header: 'from-purple-600 to-violet-500',
            box: 'bg-purple-400/30 border-purple-200/40',
            soft: 'bg-purple-50 border-purple-100'
        },
        green: {
            header: 'from-green-600 to-emerald-500',
            box: 'bg-green-400/30 border-green-200/40',
            soft: 'bg-green-50 border-green-100'
        },
        indigo: {
            header: 'from-indigo-600 to-blue-500',
            box: 'bg-indigo-400/30 border-indigo-200/40',
            soft: 'bg-indigo-50 border-indigo-100'
        },
        red: {
            header: 'from-red-600 to-rose-500',
            box: 'bg-red-400/30 border-red-200/40',
            soft: 'bg-red-50 border-red-100'
        },
        emerald: {
            header: 'from-emerald-600 to-green-500',
            box: 'bg-emerald-400/30 border-emerald-200/40',
            soft: 'bg-emerald-50 border-emerald-100'
        }
    };

    function removeColorClasses() {
        Object.values(colorClasses).forEach(function(item) {
            previewHeader?.classList.remove(...item.header.split(' '));
            previewIconBox?.classList.remove(...item.box.split(' '));
            previewStatusBox?.classList.remove(...item.soft.split(' '));
        });
    }

    function updatePreviewColor(color) {
        const selected = colorClasses[color] || colorClasses.cyan;

        removeColorClasses();

        previewHeader?.classList.add(...selected.header.split(' '));
        previewIconBox?.classList.add(...selected.box.split(' '));
        previewStatusBox?.classList.add(...selected.soft.split(' '));

        document.querySelectorAll('.color-radio').forEach(function(input) {
            const checkIcon = input.closest('label')?.querySelector('.fa-check');

            if (checkIcon) {
                checkIcon.classList.toggle('opacity-0', !input.checked);
            }
        });
    }

    function updatePreviewText() {
        if (previewName) {
            previewName.textContent = typeName.value.trim() || 'Tên loại tài liệu';
        }

        if (previewDescription) {
            previewDescription.textContent = description.value.trim() || 'Mô tả ngắn cho loại tài liệu này.';
        }
    }

    function updatePreviewStatus() {
        if (!previewStatusText || !isActiveInput) return;

        if (isActiveInput.checked) {
            previewStatusText.textContent = 'Hoạt động';
            previewStatusText.className = 'text-sm font-black text-emerald-600';
        } else {
            previewStatusText.textContent = 'Ngừng hoạt động';
            previewStatusText.className = 'text-sm font-black text-red-500';
        }
    }

    if (window.TomSelect) {
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
                if (previewIcon) {
                    previewIcon.className = value + ' text-3xl';
                }
            }
        });
    } else {
        const iconSelect = document.getElementById('iconSelect');

        iconSelect?.addEventListener('change', function() {
            if (previewIcon) {
                previewIcon.className = this.value + ' text-3xl';
            }
        });
    }

    typeName?.addEventListener('input', updatePreviewText);
    description?.addEventListener('input', updatePreviewText);
    isActiveInput?.addEventListener('change', updatePreviewStatus);

    document.querySelectorAll('.color-radio').forEach(function(input) {
        input.addEventListener('change', function() {
            updatePreviewColor(this.value);
        });
    });

    updatePreviewText();
    updatePreviewStatus();
});
 </script>
 @endpush