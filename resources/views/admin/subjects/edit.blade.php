@extends('layouts.admin')

@section('title', 'Chỉnh sửa môn học')
@section('page-title', 'Chỉnh sửa môn học')

@section('content')

@php
$selectedTeachers = old(
'teacher_ids',
$subject->lecturers ? $subject->lecturers->pluck('user_id')->toArray() : []
);

$backUrl = request('redirect_back')
? urldecode(request('redirect_back'))
: route('admin.subjects.index');

$documentCount = $subject->documents_count ?? ($subject->documents?->count() ?? 0);
$isActive = $subject->status === 'active';

$previewIcon = old('icon', $subject->icon ?: 'fa-solid fa-book-open');
$previewColor = old('color', $subject->color ?: 'cyan');

$colorClasses = [
'blue' => [
'header' => 'from-blue-600 to-sky-500',
'box' => 'bg-blue-400/30 border-blue-200/40',
'lightBox' => 'bg-blue-50 border-blue-100',
'text' => 'text-blue-700',
'iconText' => 'text-blue-600',
],
'green' => [
'header' => 'from-emerald-600 to-green-500',
'box' => 'bg-emerald-400/30 border-emerald-200/40',
'lightBox' => 'bg-emerald-50 border-emerald-100',
'text' => 'text-emerald-700',
'iconText' => 'text-emerald-600',
],
'red' => [
'header' => 'from-red-600 to-rose-500',
'box' => 'bg-red-400/30 border-red-200/40',
'lightBox' => 'bg-red-50 border-red-100',
'text' => 'text-red-700',
'iconText' => 'text-red-600',
],
'yellow' => [
'header' => 'from-yellow-500 to-amber-400',
'box' => 'bg-yellow-300/30 border-yellow-100/40',
'lightBox' => 'bg-yellow-50 border-yellow-100',
'text' => 'text-yellow-700',
'iconText' => 'text-yellow-600',
],
'purple' => [
'header' => 'from-purple-600 to-violet-500',
'box' => 'bg-purple-400/30 border-purple-200/40',
'lightBox' => 'bg-purple-50 border-purple-100',
'text' => 'text-purple-700',
'iconText' => 'text-purple-600',
],
'cyan' => [
'header' => 'from-cyan-600 to-sky-500',
'box' => 'bg-cyan-400/30 border-cyan-200/40',
'lightBox' => 'bg-cyan-50 border-cyan-100',
'text' => 'text-cyan-700',
'iconText' => 'text-cyan-600',
],
'gray' => [
'header' => 'from-slate-600 to-slate-500',
'box' => 'bg-slate-400/30 border-slate-200/40',
'lightBox' => 'bg-slate-50 border-slate-100',
'text' => 'text-slate-700',
'iconText' => 'text-slate-600',
],
];

$currentColor = $colorClasses[$previewColor] ?? $colorClasses['cyan'];
@endphp

<div class="max-w-6xl mx-auto px-2 lg:px-4">

    <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="text-3xl font-black text-slate-900">
                Chỉnh sửa môn học
            </h1>

            <p class="text-slate-500 font-semibold mt-2">
                Cập nhật thông tin môn học, khoa, trạng thái và giảng viên phụ trách.
            </p>
        </div>

        <a href="{{ $backUrl }}"
            class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-white border border-cyan-100 text-slate-700 font-black shadow-sm hover:bg-cyan-50 hover:text-cyan-700 transition">
            <span class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                <i class="fa-solid fa-arrow-left"></i>
            </span>

            <span>Quay lại</span>
        </a>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        <div class="xl:col-span-1">
            <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden sticky top-6">

                <div id="subjectPreviewHeader"
                    class="bg-gradient-to-r {{ $currentColor['header'] }} px-6 py-7 text-white">

                    <div id="subjectPreviewIconBox"
                        class="w-20 h-20 rounded-3xl {{ $currentColor['box'] }} border flex items-center justify-center mb-5 overflow-hidden">

                        @if($subject->thumbnail)
                        <img id="thumbnailPreview" src="{{ asset('storage/' . $subject->thumbnail) }}"
                            class="w-full h-full object-cover">

                        <i id="iconPreview" class="{{ $previewIcon }} text-3xl hidden"></i>
                        @else
                        <i id="iconPreview" class="{{ $previewIcon }} text-3xl"></i>

                        <img id="thumbnailPreview" src="" class="hidden w-full h-full object-cover">
                        @endif
                    </div>

                    <span
                        class="inline-flex px-4 py-2 rounded-full bg-white/20 text-white text-xs font-black border border-white/20 mb-4">
                        {{ $subject->subject_code }}
                    </span>

                    <h2 class="text-2xl font-black leading-tight">
                        {{ $subject->subject_name }}
                    </h2>

                    <p class="text-white/90 font-semibold mt-3 line-clamp-3">
                        {{ $subject->description ?: 'Chưa có mô tả cho môn học này.' }}
                    </p>
                </div>

                <div class="p-6 space-y-4">
                    <div id="subjectPreviewFacultyBox"
                        class="flex items-center justify-between rounded-2xl {{ $currentColor['lightBox'] }} border px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">
                            Khoa
                        </span>

                        <span id="subjectPreviewFacultyText"
                            class="text-sm font-black {{ $currentColor['text'] }} truncate max-w-[160px]">
                            {{ $subject->faculty->faculty_name ?? 'Chưa phân khoa' }}
                        </span>
                    </div>

                    <div id="subjectPreviewTeacherBox"
                        class="flex items-center justify-between rounded-2xl {{ $currentColor['lightBox'] }} border px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">
                            Giảng viên
                        </span>

                        <span id="subjectPreviewTeacherText" class="text-sm font-black {{ $currentColor['text'] }}">
                            {{ count($selectedTeachers) }}
                        </span>
                    </div>

                    <div
                        class="flex items-center justify-between rounded-2xl bg-slate-50 border border-slate-100 px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">
                            Tài liệu
                        </span>

                        <span class="text-sm font-black text-slate-700">
                            {{ number_format($documentCount) }}
                        </span>
                    </div>

                    <div
                        class="flex items-center justify-between rounded-2xl bg-slate-50 border border-slate-100 px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">
                            Trạng thái
                        </span>

                        @if($isActive)
                        <span class="text-sm font-black text-emerald-600">
                            Hoạt động
                        </span>
                        @else
                        <span class="text-sm font-black text-red-500">
                            Ngừng hoạt động
                        </span>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="xl:col-span-2">
            <form action="{{ route('admin.subjects.update', $subject->subject_code) }}" method="POST"
                enctype="multipart/form-data"
                class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden">

                @csrf
                @method('PUT')

                <input type="hidden" name="redirect_back" value="{{ request('redirect_back') }}">

                <div class="px-6 py-5 border-b border-cyan-100 bg-cyan-50/40">
                    <h2 class="text-xl font-black text-slate-900">
                        Thông tin chỉnh sửa
                    </h2>

                    <p class="text-sm text-slate-500 font-semibold mt-1">
                        Các trường thông tin chính của môn học.
                    </p>
                </div>

                <div class="p-6 sm:p-8 space-y-7">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                                Mã môn học
                            </label>

                            <input type="text" value="{{ $subject->subject_code }}" disabled
                                class="w-full h-12 px-5 rounded-xl bg-slate-100 border border-slate-200 text-slate-500 font-black cursor-not-allowed">

                            <p class="text-xs text-slate-400 font-semibold mt-2">
                                Mã môn học không nên thay đổi sau khi đã tạo.
                            </p>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                                Tên môn học
                            </label>

                            <input type="text" name="subject_name"
                                value="{{ old('subject_name', $subject->subject_name) }}"
                                placeholder="VD: Lập trình Web" class="w-full h-12 px-5 rounded-xl bg-slate-50 border outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700
                                @error('subject_name') border-red-400 @else border-slate-200 @enderror">

                            @error('subject_name')
                            <p class="text-red-500 text-sm font-bold mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                                Khoa
                            </label>

                            <select name="faculty_id" class="w-full h-12 px-5 rounded-xl bg-slate-50 border outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700
                                @error('faculty_id') border-red-400 @else border-slate-200 @enderror">

                                <option value="">Chưa phân khoa</option>

                                @isset($faculties)
                                @foreach($faculties as $faculty)
                                <option value="{{ $faculty->faculty_id }}" @selected(old('faculty_id', $subject->
                                    faculty_id) == $faculty->faculty_id)>
                                    {{ $faculty->faculty_name }}
                                </option>
                                @endforeach
                                @endisset
                            </select>

                            @error('faculty_id')
                            <p class="text-red-500 text-sm font-bold mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                                Trạng thái
                            </label>

                            <select name="status" class="w-full h-12 px-5 rounded-xl bg-slate-50 border outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700
                                @error('status') border-red-400 @else border-slate-200 @enderror">

                                <option value="active" @selected(old('status', $subject->status) === 'active')>
                                    Hoạt động
                                </option>

                                <option value="inactive" @selected(old('status', $subject->status) === 'inactive')>
                                    Ngừng hoạt động
                                </option>
                            </select>

                            @error('status')
                            <p class="text-red-500 text-sm font-bold mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                                Icon
                            </label>

                            <input type="text" name="icon" id="subjectIconInput"
                                value="{{ old('icon', $subject->icon ?: 'fa-solid fa-book-open') }}"
                                placeholder="VD: fa-solid fa-book-open" class="w-full h-12 px-5 rounded-xl bg-slate-50 border outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700
                                @error('icon') border-red-400 @else border-slate-200 @enderror">

                            <p class="text-xs text-slate-400 font-semibold mt-2">
                                Ví dụ: fa-solid fa-globe, fa-solid fa-database, fa-solid fa-mug-saucer.
                            </p>

                            @error('icon')
                            <p class="text-red-500 text-sm font-bold mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                                Màu hiển thị
                            </label>

                            <select name="color" id="subjectColorInput"
                                class="w-full h-12 px-5 rounded-xl bg-slate-50 border border-slate-200 outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700">

                                @php
                                $colors = [
                                'blue' => 'Xanh dương',
                                'green' => 'Xanh lá',
                                'red' => 'Đỏ',
                                'yellow' => 'Vàng',
                                'purple' => 'Tím',
                                'cyan' => 'Xanh cyan',
                                'gray' => 'Xám',
                                ];
                                @endphp

                                @foreach($colors as $value => $label)
                                <option value="{{ $value }}" @selected(old('color', $subject->color) === $value)>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                            Ảnh đại diện môn học
                        </label>

                        <input type="file" name="thumbnail" accept="image/*" onchange="previewThumbnail(this)" class="w-full rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-600
                            file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0
                            file:bg-cyan-50 file:text-cyan-700 file:font-black hover:file:bg-cyan-100">

                        <p class="text-xs text-slate-400 font-semibold mt-2">
                            Chỉ hỗ trợ JPG, JPEG, PNG, WEBP. Dung lượng tối đa 2MB.
                        </p>

                        @error('thumbnail')
                        <p class="text-red-500 text-sm font-bold mt-2">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                            Mô tả
                        </label>

                        <textarea name="description" rows="5" placeholder="Nhập mô tả môn học..."
                            class="w-full px-5 py-4 rounded-xl bg-slate-50 border outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700 resize-none
                            @error('description') border-red-400 @else border-slate-200 @enderror">{{ old('description', $subject->description) }}</textarea>

                        @error('description')
                        <p class="text-red-500 text-sm font-bold mt-2">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
                            <div>
                                <label class="block text-xs font-black text-slate-600 uppercase tracking-wider">
                                    Giảng viên phụ trách
                                </label>

                                <p class="text-sm text-slate-400 font-semibold mt-1">
                                    Chọn một hoặc nhiều giảng viên phụ trách môn học.
                                </p>
                            </div>

                            <span id="selectedTeacherBadge"
                                class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black border border-cyan-100">
                                {{ count($selectedTeachers) }} đã chọn
                            </span>
                        </div>

                        <div class="relative mb-5">
                            <i
                                class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-cyan-600"></i>

                            <input type="text" id="teacherSearch" placeholder="Tìm nhanh tên hoặc email giảng viên..."
                                class="w-full h-12 pl-14 pr-5 rounded-xl bg-slate-50 border border-slate-200 outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700">
                        </div>

                        <div id="teachersList"
                            class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-[420px] overflow-y-auto pr-1">

                            @forelse($teachers as $teacher)
                            <label
                                class="teacher-item group flex items-center gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-200 cursor-pointer hover:bg-cyan-50 hover:border-cyan-200 transition"
                                data-search="{{ strtolower($teacher->full_name . ' ' . $teacher->email) }}">

                                <input type="checkbox" name="teacher_ids[]" value="{{ $teacher->user_id }}"
                                    class="teacher-checkbox w-5 h-5 accent-cyan-600"
                                    @checked(in_array($teacher->user_id, $selectedTeachers))>

                                <img src="{{ $teacher->avatar ? asset('storage/' . $teacher->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->full_name) . '&background=06b6d4&color=fff' }}"
                                    class="w-12 h-12 rounded-2xl object-cover">

                                <div class="min-w-0">
                                    <p class="font-black text-slate-800 truncate">
                                        {{ $teacher->full_name }}
                                    </p>

                                    <p class="text-xs font-semibold text-slate-400 truncate">
                                        {{ $teacher->email }}
                                    </p>
                                </div>
                            </label>
                            @empty
                            <div
                                class="md:col-span-2 p-6 rounded-2xl bg-amber-50 border border-amber-100 text-amber-600 font-bold">
                                <i class="fa-solid fa-user-clock mr-2"></i>
                                Chưa có giảng viên nào để gán cho môn học.
                            </div>
                            @endforelse

                        </div>

                        <div id="teacherEmpty"
                            class="hidden mt-4 p-6 rounded-2xl bg-amber-50 border border-amber-100 text-amber-600 font-bold text-center">
                            <i class="fa-solid fa-magnifying-glass mr-2"></i>
                            Không tìm thấy giảng viên phù hợp.
                        </div>

                        @error('teacher_ids')
                        <p class="text-red-500 text-sm font-bold mt-2">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <div
                    class="px-6 sm:px-8 py-5 border-t border-cyan-100 bg-slate-50/50 flex flex-col sm:flex-row items-center justify-end gap-3">
                    <a href="{{ $backUrl }}"
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

@endsection

@push('scripts')
<script>
function previewThumbnail(input) {
    const thumbnailPreview = document.getElementById('thumbnailPreview');
    const iconPreview = document.getElementById('iconPreview');

    if (!thumbnailPreview) return;

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            thumbnailPreview.src = e.target.result;
            thumbnailPreview.classList.remove('hidden');

            if (iconPreview) {
                iconPreview.classList.add('hidden');
            }
        };

        reader.readAsDataURL(input.files[0]);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('teacherSearch');
    const teacherItems = Array.from(document.querySelectorAll('.teacher-item'));
    const emptyBox = document.getElementById('teacherEmpty');
    const checkboxes = Array.from(document.querySelectorAll('.teacher-checkbox'));
    const selectedBadge = document.getElementById('selectedTeacherBadge');
    const selectedTeacherText = document.getElementById('subjectPreviewTeacherText');

    const iconInput = document.getElementById('subjectIconInput');
    const iconPreview = document.getElementById('iconPreview');

    const colorInput = document.getElementById('subjectColorInput');
    const previewHeader = document.getElementById('subjectPreviewHeader');
    const previewIconBox = document.getElementById('subjectPreviewIconBox');
    const facultyBox = document.getElementById('subjectPreviewFacultyBox');
    const teacherBox = document.getElementById('subjectPreviewTeacherBox');
    const facultyText = document.getElementById('subjectPreviewFacultyText');

    const colorClasses = {
        blue: {
            header: 'from-blue-600 to-sky-500',
            box: 'bg-blue-400/30 border-blue-200/40',
            lightBox: 'bg-blue-50 border-blue-100',
            text: 'text-blue-700'
        },
        green: {
            header: 'from-emerald-600 to-green-500',
            box: 'bg-emerald-400/30 border-emerald-200/40',
            lightBox: 'bg-emerald-50 border-emerald-100',
            text: 'text-emerald-700'
        },
        red: {
            header: 'from-red-600 to-rose-500',
            box: 'bg-red-400/30 border-red-200/40',
            lightBox: 'bg-red-50 border-red-100',
            text: 'text-red-700'
        },
        yellow: {
            header: 'from-yellow-500 to-amber-400',
            box: 'bg-yellow-300/30 border-yellow-100/40',
            lightBox: 'bg-yellow-50 border-yellow-100',
            text: 'text-yellow-700'
        },
        purple: {
            header: 'from-purple-600 to-violet-500',
            box: 'bg-purple-400/30 border-purple-200/40',
            lightBox: 'bg-purple-50 border-purple-100',
            text: 'text-purple-700'
        },
        cyan: {
            header: 'from-cyan-600 to-sky-500',
            box: 'bg-cyan-400/30 border-cyan-200/40',
            lightBox: 'bg-cyan-50 border-cyan-100',
            text: 'text-cyan-700'
        },
        gray: {
            header: 'from-slate-600 to-slate-500',
            box: 'bg-slate-400/30 border-slate-200/40',
            lightBox: 'bg-slate-50 border-slate-100',
            text: 'text-slate-700'
        }
    };

    function removeColorClasses() {
        Object.values(colorClasses).forEach(function(item) {
            previewHeader?.classList.remove(...item.header.split(' '));
            previewIconBox?.classList.remove(...item.box.split(' '));

            facultyBox?.classList.remove(...item.lightBox.split(' '));
            teacherBox?.classList.remove(...item.lightBox.split(' '));

            facultyText?.classList.remove(item.text);
            selectedTeacherText?.classList.remove(item.text);
        });
    }

    function updatePreviewColor(color) {
        const selected = colorClasses[color] || colorClasses.cyan;

        removeColorClasses();

        previewHeader?.classList.add(...selected.header.split(' '));
        previewIconBox?.classList.add(...selected.box.split(' '));

        facultyBox?.classList.add(...selected.lightBox.split(' '));
        teacherBox?.classList.add(...selected.lightBox.split(' '));

        facultyText?.classList.add(selected.text);
        selectedTeacherText?.classList.add(selected.text);
    }

    function updateSelectedBadge() {
        const checkedCount = checkboxes.filter(item => item.checked).length;

        if (selectedBadge) {
            selectedBadge.textContent = checkedCount + ' đã chọn';
        }

        if (selectedTeacherText) {
            selectedTeacherText.textContent = checkedCount;
        }
    }

    searchInput?.addEventListener('input', function() {
        const keyword = this.value.toLowerCase().trim();
        let visibleCount = 0;

        teacherItems.forEach(function(item) {
            const text = item.dataset.search || '';

            if (text.includes(keyword)) {
                item.classList.remove('hidden');
                item.classList.add('flex');
                visibleCount++;
            } else {
                item.classList.add('hidden');
                item.classList.remove('flex');
            }
        });

        emptyBox?.classList.toggle('hidden', visibleCount > 0);
    });

    checkboxes.forEach(item => {
        item.addEventListener('change', updateSelectedBadge);
    });

    iconInput?.addEventListener('input', function() {
        if (!iconPreview) return;

        iconPreview.className = this.value + ' text-3xl';
    });

    colorInput?.addEventListener('change', function() {
        updatePreviewColor(this.value);
    });

    updateSelectedBadge();
});
</script>
@endpush