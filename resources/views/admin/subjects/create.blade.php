@extends('layouts.admin')

@section('title', 'Thêm môn học')
@section('page-title', 'Thêm môn học')

@section('content')

@php
$selectedTeachers = old('teacher_ids', []);
$previewIcon = old('icon', 'fa-solid fa-book-open');
@endphp

<div class="max-w-6xl mx-auto px-2 lg:px-4">


    <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="text-3xl font-black text-slate-900">
                Thêm môn học mới
            </h1>

            <p class="text-slate-500 font-semibold mt-2">
                Tạo môn học mới, phân khoa và phân công giảng viên phụ trách.
            </p>
        </div>

        <a href="{{ route('admin.subjects.index') }}"
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

                <div class="bg-gradient-to-r from-cyan-600 to-sky-500 px-6 py-7 text-white">
                    <div
                        class="w-20 h-20 rounded-3xl bg-white/20 border border-white/30 flex items-center justify-center mb-5 overflow-hidden">
                        <i id="iconPreview" class="{{ $previewIcon }} text-3xl"></i>
                        <img id="thumbnailPreview" src="" class="hidden w-full h-full object-cover">
                    </div>

                    <span
                        class="inline-flex px-4 py-2 rounded-full bg-white/20 text-white text-xs font-black border border-white/20 mb-4">
                        New Subject
                    </span>

                    <h2 class="text-2xl font-black leading-tight">
                        Tạo môn học
                    </h2>

                    <p class="text-cyan-50 font-semibold mt-3">
                        Nhập thông tin môn học và chọn giảng viên phụ trách nếu có.
                    </p>
                </div>

                <div class="p-6 space-y-4">
                    <div
                        class="flex items-center justify-between rounded-2xl bg-cyan-50 border border-cyan-100 px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">
                            Giảng viên đã chọn
                        </span>

                        <span id="selectedTeacherCard" class="text-sm font-black text-cyan-700">
                            {{ count($selectedTeachers) }}
                        </span>
                    </div>

                    <div
                        class="flex items-center justify-between rounded-2xl bg-slate-50 border border-slate-100 px-4 py-3">
                        <span class="text-sm font-bold text-slate-500">
                            Trạng thái
                        </span>

                        <span class="text-sm font-black text-emerald-600">
                            Mới tạo
                        </span>
                    </div>

                    <div
                        class="rounded-2xl bg-amber-50 border border-amber-100 px-4 py-3 text-amber-700 text-sm font-bold">
                        <i class="fa-solid fa-circle-info mr-2"></i>
                        Mã môn học nên viết ngắn gọn, ví dụ: WEB101, DB101.
                    </div>
                </div>

            </div>
        </div>

        <div class="xl:col-span-2">
            <form action="{{ route('admin.subjects.store') }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden">

                @csrf

                <div class="px-6 py-5 border-b border-cyan-100 bg-cyan-50/40">
                    <h2 class="text-xl font-black text-slate-900">
                        Thông tin môn học
                    </h2>

                    <p class="text-sm text-slate-500 font-semibold mt-1">
                        Điền các thông tin cơ bản để tạo môn học mới.
                    </p>
                </div>

                <div class="p-6 sm:p-8 space-y-7">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                                Mã môn học
                            </label>

                            <input type="text" name="subject_code" value="{{ old('subject_code') }}"
                                placeholder="VD: WEB101" class="w-full h-12 px-5 rounded-xl bg-slate-50 border outline-none focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 font-semibold text-slate-700
                            @error('subject_code') border-red-400 @else border-slate-200 @enderror">

                            @error('subject_code')
                            <p class="text-red-500 text-sm font-bold mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-600 uppercase tracking-wider mb-3">
                                Tên môn học
                            </label>

                            <input type="text" name="subject_name" value="{{ old('subject_name') }}"
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
                                <option value="{{ $faculty->faculty_id }}" @selected(old('faculty_id')==$faculty->
                                    faculty_id)>
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

                                <option value="active" @selected(old('status', 'active' )==='active' )>
                                    Hoạt động
                                </option>

                                <option value="inactive" @selected(old('status')==='inactive' )>
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
                                value="{{ old('icon', 'fa-solid fa-book-open') }}"
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

                            <select name="color"
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
                                <option value="{{ $value }}" @selected(old('color', 'blue' )===$value)>
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
                        @error('description') border-red-400 @else border-slate-200 @enderror">{{ old('description') }}</textarea>

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
                    <a href="{{ route('admin.subjects.index') }}"
                        class="w-full sm:w-auto px-5 py-3 rounded-xl bg-white border border-slate-200 text-slate-700 font-black hover:bg-slate-50 transition text-center">
                        Hủy
                    </a>

                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white font-black shadow-lg shadow-cyan-100 transition">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Tạo môn học
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
    const selectedCard = document.getElementById('selectedTeacherCard');

    const iconInput = document.getElementById('subjectIconInput');
    const iconPreview = document.getElementById('iconPreview');

    function updateSelectedBadge() {
        const checkedCount = checkboxes.filter(item => item.checked).length;

        if (selectedBadge) {
            selectedBadge.textContent = checkedCount + ' đã chọn';
        }

        if (selectedCard) {
            selectedCard.textContent = checkedCount;
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

    updateSelectedBadge();
});
</script>

@endpush