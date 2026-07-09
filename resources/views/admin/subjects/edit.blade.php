@extends('layouts.admin')

@section('title', 'Chỉnh sửa môn học')
@section('page-title', 'Chỉnh sửa môn học')

@section('content')

@php
$colors = ['blue','green','red','yellow','purple','cyan','gray'];
/**
* COLOR MAP (FIX TAILWIND DYNAMIC CLASS ISSUE)
*/
$colorClassMap = [
'blue' => 'bg-sky-50 text-sky-600',
'red' => 'bg-red-50 text-red-600',
'green' => 'bg-emerald-50 text-emerald-600',
'yellow' => 'bg-amber-50 text-amber-600',
'purple' => 'bg-violet-50 text-violet-600',
'cyan' => 'bg-cyan-50 text-cyan-600',
'gray' => 'bg-slate-50 text-slate-600',
];

$color = $colorClassMap[$subject->color] ?? $colorClassMap['blue'];

$subjectIcon = $subject->icon ?: 'fa-solid fa-book-open';
$icons = [
'fa-solid fa-book-open' => 'Book',
'fa-solid fa-code' => 'Code',
'fa-solid fa-database' => 'Database',
'fa-solid fa-network-wired' => 'Network',
'fa-solid fa-laptop-code' => 'Laptop',
'fa-solid fa-flask' => 'Science',
];
@endphp
<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm">

        <div class="px-6 py-5 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h2 class="text-2xl font-extrabold text-slate-900">

                    Chỉnh sửa môn học

                </h2>

                <p class="mt-2 text-sm font-medium text-slate-500">

                    Cập nhật thông tin môn học, khoa quản lý và giảng viên phụ trách.

                </p>

            </div>

            <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2
                h-11
                px-5
                rounded-xl
                border border-slate-200
                bg-white
                text-slate-700
                text-sm
                font-semibold
                hover:bg-amber-50
                hover:border-amber-300
                hover:text-amber-700
                transition-all duration-300">

                <i class="fa-solid fa-arrow-left"></i>

                Quay lại

            </a>

        </div>

    </div>

    <!-- MAIN -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

        <!-- LEFT -->
        <div class="xl:col-span-4">

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <!-- IMAGE -->
                <div class="relative h-56 overflow-hidden">

                    <img src="{{ $subject->thumbnail_url }}" class="w-full h-full object-cover">

                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent"></div>

                </div>

                <!-- SUBJECT INFO -->
                <div class="px-6 py-6 text-center border-b border-slate-200 bg-slate-50">

                    <div class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center shadow-sm {{ $color }}">

                        <i class="{{ $subjectIcon }} text-2xl"></i>

                    </div>

                    <h3 class="mt-5 text-xl font-extrabold text-slate-900">

                        {{ $subject->subject_name }}

                    </h3>

                    <p class="mt-2 text-sm font-medium text-slate-500">

                        {{ $subject->subject_code }}

                    </p>

                </div>

                <!-- STATISTICS -->
                <div class="p-6 space-y-4">

                    <div class="flex items-center justify-between">

                        <span class="text-sm font-medium text-slate-500">

                            Tài liệu

                        </span>

                        <span class="text-lg font-bold text-slate-900">

                            {{ number_format($subject->documents_count ?? 0) }}

                        </span>

                    </div>

                    <div class="flex items-center justify-between">

                        <span class="text-sm font-medium text-slate-500">

                            Giảng viên

                        </span>

                        <span class="text-lg font-bold text-slate-900">

                            {{ $subject->lecturers->count() }}

                        </span>

                    </div>

                    <div class="flex items-center justify-between">

                        <span class="text-sm font-medium text-slate-500">

                            Trạng thái

                        </span>

                        @if($subject->status == 'active')

                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold">

                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                            Hoạt động

                        </span>

                        @else

                        <span
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-xl bg-red-50 border border-red-200 text-red-600 text-xs font-bold">

                            <span class="w-2 h-2 rounded-full bg-red-500"></span>

                            Đã khóa

                        </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="xl:col-span-8">

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

                    <h3 class="text-lg font-bold text-slate-900">

                        Thông tin môn học

                    </h3>

                    <p class="mt-1 text-sm text-slate-500">

                        Cập nhật các thông tin cơ bản của môn học.

                    </p>

                </div>

                <form action="{{ route('admin.subjects.update',$subject->subject_code) }}" method="POST"
                    enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- TÊN MÔN HỌC -->
                    <div>

                        <label class="block text-xs font-bold uppercase tracking-wide text-slate-500">

                            Tên môn học

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text" name="subject_name" value="{{ old('subject_name', $subject->subject_name) }}"
                            placeholder="Nhập tên môn học..." class="w-full
                            mt-2
                            h-12
                            px-4
                            rounded-xl
                            border border-slate-200
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

                        @error('subject_name')

                        <p class="mt-2 text-xs font-medium text-red-500">

                            {{ $message }}

                        </p>

                        @enderror

                    </div>

                    <!-- MÔ TẢ -->
                    <div>

                        <label class="block text-xs font-bold uppercase tracking-wide text-slate-500">

                            Mô tả

                        </label>

                        <textarea name="description" rows="4" placeholder="Nhập mô tả môn học..." class="w-full
                            mt-2
                            px-4
                            py-3
                            rounded-xl
                            border border-slate-200
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
                            focus:ring-amber-100">{{ old('description', $subject->description) }}</textarea>

                        @error('description')

                        <p class="mt-2 text-xs font-medium text-red-500">

                            {{ $message }}

                        </p>

                        @enderror

                    </div>

                    <!-- KHOA + TRẠNG THÁI -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <!-- KHOA -->
                        <div>

                            <label class="block text-xs font-bold uppercase tracking-wide text-slate-500">

                                Khoa quản lý

                            </label>

                            <select id="faculty_id" name="faculty_id" class="w-full
    mt-2
    h-12
    px-4
    rounded-xl
    border border-slate-200
    bg-slate-50
    text-sm
    font-medium
    text-slate-700
    outline-none
    transition-all
    duration-300
    focus:bg-white
    focus:border-amber-500
    focus:ring-4
    focus:ring-amber-100">

                                <option value="">

                                    Chọn khoa

                                </option>

                                @foreach($faculties as $faculty)

                                <option value="{{ $faculty->faculty_id }}" @selected(old('faculty_id',$subject->
                                    faculty_id)==$faculty->faculty_id)>

                                    {{ $faculty->faculty_name }}

                                </option>

                                @endforeach

                            </select>

                            @error('faculty_id')

                            <p class="mt-2 text-xs font-medium text-red-500">

                                {{ $message }}

                            </p>

                            @enderror

                        </div>

                        <!-- TRẠNG THÁI -->
                        <div>

                            <label class="block text-xs font-bold uppercase tracking-wide text-slate-500">

                                Trạng thái

                            </label>

                            <select name="status" class="w-full
                                mt-2
                                h-12
                                px-4
                                rounded-xl
                                border border-slate-200
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

                                <option value="active" @selected(old('status',$subject->status)=='active')>

                                    Hoạt động

                                </option>

                                <option value="archived" @selected(old('status',$subject->status)=='archived')>

                                    Đã khóa

                                </option>

                            </select>

                            @error('status')

                            <p class="mt-2 text-xs font-medium text-red-500">

                                {{ $message }}

                            </p>

                            @enderror

                        </div>

                    </div>
                    <!-- ICON -->
                    <div>

                        <label class="block text-xs font-bold uppercase tracking-wide text-slate-500">

                            Biểu tượng môn học

                        </label>

                        <select name="icon" class="w-full
                            mt-2
                            h-12
                            px-4
                            rounded-xl
                            border border-slate-200
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

                            @foreach($icons as $value => $label)

                            <option value="{{ $value }}" @selected(old('icon',$subject->icon)==$value)>

                                {{ $label }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- COLOR -->
                    <div>

                        <label class="block text-xs font-bold uppercase tracking-wide text-slate-500">

                            Màu hiển thị

                        </label>

                        <select name="color" class="w-full
                            mt-2
                            h-12
                            px-4
                            rounded-xl
                            border border-slate-200
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

                            @foreach($colors as $item)

                            <option value="{{ $item }}" @selected(old('color',$subject->color)==$item)>

                                {{ ucfirst($item) }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- THUMBNAIL -->
                    <!-- THUMBNAIL -->
                    <div>

                        <label class="block text-xs font-bold uppercase tracking-wide text-slate-500">

                            Ảnh đại diện môn học

                        </label>

                        <p class="mt-2 text-sm text-slate-500">

                            Chọn một trong các ảnh mặc định hoặc tải ảnh mới từ máy tính.

                        </p>

                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mt-5">

                            @foreach($subjectImages as $key => $img)

                            <label class="cursor-pointer group">

                                <input type="radio" name="thumbnail" value="{{ $img }}" class="hidden peer"
                                    @checked(old('thumbnail',$subject->thumbnail ?? '01.jpg') == $img)>

                                <div class="relative
                                overflow-hidden
                                rounded-2xl
                                border-2
                                border-slate-200
                                bg-white
                                transition-all duration-300
                                group-hover:border-amber-300
                                group-hover:shadow-lg
                                peer-checked:border-amber-500
                                peer-checked:shadow-xl
                                peer-checked:scale-105">

                                    <img src="{{ asset('img/subjects/'.$img) }}" class="w-full h-24 object-cover">

                                    <!-- Overlay -->
                                    <div class="absolute inset-0
                    bg-amber-500/0
                    peer-checked:bg-amber-500/10
                    transition-all">
                                    </div>

                                    <!-- Check -->
                                    <div class="absolute
                    top-2
                    right-2
                    w-7
                    h-7
                    rounded-full
                    bg-amber-500
                    text-white
                    flex
                    items-center
                    justify-center
                    text-xs
                    opacity-0
                    scale-75
                    peer-checked:opacity-100
                    peer-checked:scale-100
                    transition-all duration-300">

                                        <i class="fa-solid fa-check"></i>

                                    </div>

                                </div>

                                <p class="mt-2
                                    text-xs
                                    text-center
                                    font-semibold
                                    text-slate-500
                                    group-hover:text-slate-700">

                                    Ảnh {{ $key }}

                                </p>

                            </label>

                            @endforeach

                            <!-- CUSTOM UPLOAD -->
                            <label for="thumbnail_upload" class="cursor-pointer group">

                                <input type="file" id="thumbnail_upload" name="thumbnail_upload"
                                    accept="image/png,image/jpeg,image/jpg,image/webp" class="hidden">

                                <div class="relative
                                                    h-24
                                                    rounded-2xl
                                                    border-2
                                                    border-dashed
                                                    border-slate-300
                                                    bg-slate-50
                                                    flex
                                                    flex-col
                                                    items-center
                                                    justify-center
                                                    transition-all duration-300
                                                    group-hover:border-amber-500
                                                    group-hover:bg-amber-50
                                                    group-hover:shadow-lg">

                                    <div class="w-11
                                                        h-11
                                                        rounded-full
                                                        bg-white
                                                        border
                                                        border-slate-200
                                                        flex
                                                        items-center
                                                        justify-center
                                                        group-hover:bg-amber-500
                                                        group-hover:text-white
                                                        transition-all">

                                        <i class="fa-solid fa-plus text-base"></i>

                                    </div>

                                    <span class="mt-3
                                                        text-xs
                                                        font-semibold
                                                        text-slate-500
                                                        group-hover:text-amber-700">

                                        Tải ảnh

                                    </span>

                                </div>

                            </label>

                        </div>

                        <!-- PREVIEW -->
                        <div class="mt-6">

                            <label class="block text-xs font-bold uppercase tracking-wide text-slate-500">

                                Ảnh xem trước

                            </label>

                            <div class="mt-3
                    w-64
                    rounded-2xl
                    overflow-hidden
                    border
                    border-slate-200
                    bg-slate-50">

                                <img id="thumbnail-preview" src="{{ $subject->thumbnail_url }}"
                                    class="w-full h-40 object-cover">

                            </div>

                            <p class="mt-2 text-xs text-slate-400">

                                Khi tải ảnh mới, ảnh xem trước sẽ được cập nhật ngay.

                            </p>

                        </div>

                    </div>
                    <!-- GIẢNG VIÊN -->
                    <div>

                        <label class="block text-xs font-bold uppercase tracking-wide text-slate-500">

                            Giảng viên phụ trách

                        </label>

                        <!-- SEARCH -->
                        <div class="relative mt-3">

                            <i class="fa-solid fa-magnifying-glass
                                absolute
                                left-4
                                top-1/2
                                -translate-y-1/2
                                text-slate-400
                                text-xs">
                            </i>

                            <input id="teacher-search" type="text" placeholder="Tìm kiếm giảng viên..." class="w-full
                                h-11
                                pl-10
                                pr-4
                                rounded-xl
                                border border-slate-200
                                bg-slate-50
                                text-sm
                                font-medium
                                outline-none
                                focus:bg-white
                                focus:border-amber-500
                                focus:ring-4
                                focus:ring-amber-100">

                        </div>

                        <!-- LIST -->
                        <div id="teacher-list" class="mt-4
    max-h-64
    overflow-y-auto
    rounded-2xl
    border border-slate-200
    bg-white">
                            @foreach($teachers as $lecturer)

                            <label class="teacher-item
                                flex
                                items-center
                                gap-3
                                px-4
                                py-3
                                border-b
                                last:border-b-0
                                hover:bg-amber-50
                                cursor-pointer
                                transition">

                                <input type="checkbox" name="teacher_ids[]" value="{{ $lecturer->user_id }}"
                                    class="w-4 h-4 accent-amber-500"
                                    @checked($subject->lecturers->contains('user_id',$lecturer->user_id))>

                                <div class="min-w-0">

                                    <p class="text-sm font-bold text-slate-800 truncate">

                                        {{ $lecturer->full_name }}

                                    </p>

                                    <p class="text-xs text-slate-500 truncate">

                                        {{ $lecturer->email }}

                                    </p>

                                </div>

                            </label>

                            @endforeach

                        </div>

                    </div>
                    <!-- ACTION BUTTONS -->
                    <div class="pt-6 border-t border-slate-200">

                        <div class="flex flex-col sm:flex-row items-center justify-end gap-3">

                            <!-- CANCEL -->
                            <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center gap-2
                                h-11
                                px-6
                                rounded-xl
                                border border-slate-200
                                bg-white
                                text-slate-700
                                text-sm
                                font-semibold
                                hover:bg-slate-50
                                hover:border-slate-300
                                transition-all duration-300">

                                <i class="fa-solid fa-arrow-left"></i>

                                Quay lại

                            </a>

                            <!-- SAVE -->
                            <button type="submit" class="inline-flex items-center justify-center gap-2
                                h-11
                                px-6
                                rounded-xl
                                bg-slate-900
                                text-white
                                text-sm
                                font-bold
                                shadow-lg shadow-slate-900/10
                                hover:bg-amber-500
                                hover:shadow-amber-500/20
                                transition-all duration-300">

                                <i class="fa-solid fa-floppy-disk"></i>

                                Lưu thay đổi

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // ==========================
    // TÌM KIẾM GIẢNG VIÊN
    // ==========================
    const search = document.getElementById('teacher-search');

    if (search) {

        search.addEventListener('input', function() {

            const keyword = this.value.toLowerCase().trim();

            document.querySelectorAll('.teacher-item').forEach(function(item) {

                const text = item.textContent.toLowerCase();

                item.style.display = text.includes(keyword) ? 'flex' : 'none';

            });

        });

    }

    // ==========================
    // PREVIEW ẢNH
    // ==========================
    const uploadInput = document.getElementById('thumbnail_upload');
    const preview = document.getElementById('thumbnail-preview');
    const defaultImages = document.querySelectorAll('input[name="thumbnail"]');

    if (uploadInput) {

        uploadInput.addEventListener('change', function() {

            if (!this.files.length) return;

            defaultImages.forEach(function(radio) {
                radio.checked = false;
            });

            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            reader.readAsDataURL(this.files[0]);

        });

    }

    defaultImages.forEach(function(radio) {

        radio.addEventListener('change', function() {

            if (!this.checked) return;

            if (uploadInput) {
                uploadInput.value = "";
            }

            preview.src = "{{ asset('img/subjects') }}/" + this.value;

        });

    });

    // ==========================
    // LOAD GIẢNG VIÊN THEO KHOA
    // ==========================
    const facultySelect = document.getElementById('faculty_id');
    const teacherList = document.getElementById('teacher-list');

    if (facultySelect && teacherList) {

        facultySelect.addEventListener('change', function() {

            const facultyId = this.value;

            if (!facultyId) {

                teacherList.innerHTML = `
                    <div class="p-4 text-center text-slate-500">
                        Vui lòng chọn khoa.
                    </div>
                `;

                return;
            }

            fetch(`/admin/faculties/${facultyId}/teachers`)
                .then(response => response.json())
                .then(data => {

                    teacherList.innerHTML = '';

                    if (data.length === 0) {

                        teacherList.innerHTML = `
                            <div class="p-4 text-center text-slate-500">
                                Không có giảng viên thuộc khoa này.
                            </div>
                        `;

                        return;
                    }

                    data.forEach(function(teacher) {

                        teacherList.innerHTML += `
                            <label class="teacher-item flex items-center gap-3 px-4 py-3 border-b hover:bg-amber-50 cursor-pointer">

                                <input
                                    type="checkbox"
                                    name="teacher_ids[]"
                                    value="${teacher.user_id}"
                                    class="w-4 h-4 accent-amber-500">

                                <div class="min-w-0">

                                    <p class="text-sm font-bold text-slate-800">

                                        ${teacher.full_name}

                                    </p>

                                    <p class="text-xs text-slate-500">

                                        ${teacher.email}

                                    </p>

                                </div>

                            </label>
                        `;

                    });

                });

        });

    }

});
</script>
@endpush