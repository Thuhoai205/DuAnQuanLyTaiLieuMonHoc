@extends('layouts.admin')

@section('title', 'Thêm môn học')
@section('page-title', 'Thêm môn học')

@section('content')

@php
$selectedTeachers = old('teacher_ids', []);
$previewIcon = old('icon', 'fa-solid fa-book-open');

$colorMap = [
'blue' => 'sky',
'green' => 'emerald',
'red' => 'red',
'yellow' => 'amber',
'purple' => 'violet',
'cyan' => 'cyan',
'gray' => 'slate',
];

$previewColor = $colorMap[old('color', 'blue')] ?? 'sky';
@endphp
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-black text-slate-800">

                    Thêm môn học

                </h2>

                <p class="mt-2 text-sm text-slate-500">

                    Tạo mới môn học và phân công giảng viên phụ trách.

                </p>

            </div>

            <a href="{{ route('admin.subjects.index') }}" class="inline-flex items-center gap-2
                h-11
                px-5
                rounded-xl
                border border-slate-200
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

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- SIDEBAR --}}
        <div class="xl:col-span-1">

            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden sticky top-6">

                <!-- HEADER -->
                <div class="p-7 bg-gradient-to-b from-slate-50 to-white border-b border-slate-200">

                    <div class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center
                        bg-{{ $previewColor }}-50 text-{{ $previewColor }}-600 shadow-sm">

                        <i id="iconPreview" class="{{ $previewIcon }} text-2xl">
                        </i>

                        <img id="thumbnailPreview" class="hidden w-full h-full object-cover rounded-2xl">

                    </div>

                    <h3 class="mt-5 text-center text-lg font-black text-slate-800">

                        Xem trước môn học

                    </h3>

                    <p class="mt-2 text-center text-sm text-slate-500 leading-6">

                        Thông tin sẽ được cập nhật theo dữ liệu bạn nhập.

                    </p>

                </div>

                <!-- STATS -->
                <div class="p-6 space-y-5">

                    <div class="flex items-center justify-between">

                        <span class="text-sm font-semibold text-slate-500">

                            Giảng viên

                        </span>

                        <span id="selectedTeacherCard" class="text-lg font-black text-slate-800">

                            {{ count($selectedTeachers) }}

                        </span>

                    </div>

                    <div class="flex items-center justify-between">

                        <span class="text-sm font-semibold text-slate-500">

                            Trạng thái

                        </span>

                        <span class="inline-flex items-center
                            rounded-full
                            bg-emerald-50
                            px-3
                            py-1
                            text-xs
                            font-bold
                            text-emerald-600">

                            Mới tạo

                        </span>

                    </div>

                </div>

            </div>

        </div>

        {{-- FORM --}}
        <div class="xl:col-span-2">

            <form action="{{ route('admin.subjects.store') }}" method="POST" enctype="multipart/form-data"
                class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

                @csrf

                <!-- FORM HEADER -->
                <div class="px-6 py-5
                    border-b border-slate-200
                    bg-gradient-to-r
                    from-slate-50
                    to-white">

                    <h2 class="text-lg font-black text-slate-800">

                        Thông tin cơ bản

                    </h2>

                    <p class="mt-1 text-sm text-slate-500">

                        Nhập đầy đủ thông tin trước khi tạo môn học.

                    </p>

                </div>

                <div class="p-6 space-y-6">

                    {{-- MÃ + TÊN --}}
                    {{-- MÃ + TÊN --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- MÃ MÔN -->
                        <div>

                            <label class="block text-xs font-bold uppercase tracking-wide text-slate-500">

                                Mã môn học

                                <span class="text-red-500">*</span>

                            </label>

                            <input type="text" name="subject_code" value="{{ old('subject_code') }}"
                                placeholder="Ví dụ: CT101" class="w-full
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
            transition-all duration-300
            focus:bg-white
            focus:border-amber-500
            focus:ring-4
            focus:ring-amber-100">

                            @error('subject_code')

                            <p class="mt-2 text-xs font-medium text-red-500">

                                {{ $message }}

                            </p>

                            @enderror

                        </div>

                        <!-- TÊN MÔN -->
                        <div>

                            <label class="block text-xs font-bold uppercase tracking-wide text-slate-500">

                                Tên môn học

                                <span class="text-red-500">*</span>

                            </label>

                            <input type="text" name="subject_name" value="{{ old('subject_name') }}"
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
        transition-all duration-300
        focus:bg-white
        focus:border-amber-500
        focus:ring-4
        focus:ring-amber-100">{{ old('description') }}</textarea>

                    </div>

                    {{-- KHOA + TRẠNG THÁI --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- KHOA -->
                        <div>

                            <label class="block text-xs font-bold uppercase tracking-wide text-slate-500">

                                Khoa quản lý

                            </label>

                            <select name="faculty_id" class="w-full
            mt-2
            h-12
            px-4
            rounded-xl
            border border-slate-200
            bg-slate-50
            text-sm
            font-medium
            text-slate-700
            transition-all duration-300
            focus:bg-white
            focus:border-amber-500
            focus:ring-4
            focus:ring-amber-100">

                                <option value="">Chọn khoa</option>

                                @foreach($faculties as $faculty)

                                <option value="{{ $faculty->faculty_id }}" @selected(old('faculty_id')==$faculty->
                                    faculty_id)>

                                    {{ $faculty->faculty_name }}

                                </option>

                                @endforeach

                            </select>

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
            transition-all duration-300
            focus:bg-white
            focus:border-amber-500
            focus:ring-4
            focus:ring-amber-100">

                                <option value="active">

                                    Hoạt động

                                </option>

                                <option value="archived">

                                    Đã khóa

                                </option>

                            </select>

                        </div>

                    </div>

                    {{-- ICON + MÀU --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- ICON -->
                        <div>

                            <label class="block text-xs font-bold uppercase tracking-wide text-slate-500">

                                Biểu tượng môn học

                            </label>

                            <div class="mt-2 flex items-center gap-3">

                                <div class="w-12
                h-12
                rounded-xl
                border
                border-slate-200
                bg-slate-50
                flex
                items-center
                justify-center">

                                    <i id="iconPreview" class="fa-solid fa-book-open text-slate-600 text-lg">
                                    </i>

                                </div>

                                <select id="subjectIconInput" name="icon" class="flex-1
                h-12
                px-4
                rounded-xl
                border border-slate-200
                bg-slate-50
                text-sm
                font-medium
                transition-all duration-300
                focus:bg-white
                focus:border-amber-500
                focus:ring-4
                focus:ring-amber-100">

                                    <option value="fa-solid fa-book-open">Book Open</option>
                                    <option value="fa-solid fa-book">Book</option>
                                    <option value="fa-solid fa-code">Code</option>
                                    <option value="fa-solid fa-database">Database</option>
                                    <option value="fa-solid fa-network-wired">Network</option>
                                    <option value="fa-solid fa-laptop-code">Laptop</option>
                                    <option value="fa-solid fa-flask">Science</option>

                                </select>

                            </div>

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
            transition-all duration-300
            focus:bg-white
            focus:border-amber-500
            focus:ring-4
            focus:ring-amber-100">

                                <option value="blue">Blue</option>
                                <option value="green">Green</option>
                                <option value="red">Red</option>
                                <option value="yellow">Yellow</option>
                                <option value="purple">Purple</option>
                                <option value="cyan">Cyan</option>
                                <option value="gray">Gray</option>

                            </select>

                        </div>

                    </div>

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
                                    @checked(old('thumbnail','01.jpg')==$img)>

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

                                    <div class="absolute inset-0
                    bg-amber-500/0
                    peer-checked:bg-amber-500/10
                    transition-all">
                                    </div>

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
                            <!-- UPLOAD ẢNH -->
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

                        @error('thumbnail_upload')

                        <p class="mt-3 text-sm font-medium text-red-500">

                            {{ $message }}

                        </p>

                        @enderror

                        <!-- PREVIEW -->
                        <div class="mt-6">

                            <label class="block text-xs font-bold uppercase tracking-wide text-slate-500">

                                Ảnh xem trước

                            </label>

                            <div class="mt-3
            w-72
            rounded-2xl
            overflow-hidden
            border
            border-slate-200
            bg-slate-50">

                                <img id="thumbnail-preview" src="{{ asset('img/subjects/'.old('thumbnail','01.jpg')) }}"
                                    class="w-full h-44 object-cover">

                            </div>

                            <p class="mt-2 text-xs text-slate-400">

                                Khi tải ảnh mới hoặc chọn ảnh mặc định,
                                ảnh xem trước sẽ tự động thay đổi.

                            </p>

                        </div>

                    </div>

                    <!-- GIẢNG VIÊN -->
                    <div>

                        <label class="block text-xs font-bold uppercase tracking-wide text-slate-500">

                            Phân công giảng viên

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

                            <input id="teacher-search" type="text" placeholder="Nhập tên hoặc email giảng viên..."
                                class="w-full
            h-11
            pl-10
            pr-4
            rounded-xl
            border border-slate-200
            bg-slate-50
            text-sm
            font-medium
            outline-none
            transition-all duration-300
            focus:bg-white
            focus:border-amber-500
            focus:ring-4
            focus:ring-amber-100">

                        </div>

                        <!-- LIST -->
                        <div id="teacher-list" class="mt-4
        max-h-72
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
            transition-all">

                                <input type="checkbox" name="teacher_ids[]" value="{{ $lecturer->user_id }}"
                                    class="w-4 h-4 accent-amber-500"
                                    @checked(in_array($lecturer->user_id,$selectedLecturers ?? []))>

                                <div class="min-w-0">

                                    <p class="teacher-name text-sm font-bold text-slate-800 truncate">

                                        {{ $lecturer->full_name }}

                                    </p>

                                    <p class="teacher-email text-xs text-slate-500 truncate">

                                        {{ $lecturer->email }}

                                    </p>

                                </div>

                            </label>

                            @endforeach

                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="pt-6 border-t border-slate-200">

                        <div class="flex flex-col sm:flex-row items-center justify-end gap-3">

                            <!-- CANCEL -->
                            <a href="{{ route('admin.subjects.index') }}" class="inline-flex
            items-center
            justify-center
            gap-2
            h-11
            px-6
            rounded-xl
            border border-slate-200
            bg-white
            text-slate-700
            text-sm
            font-semibold
            hover:bg-slate-50
            transition-all duration-300">

                                <i class="fa-solid fa-arrow-left"></i>

                                Quay lại

                            </a>

                            <!-- SAVE -->
                            <button type="submit" class="inline-flex
            items-center
            justify-center
            gap-2
            h-11
            px-6
            rounded-xl
            bg-slate-900
            text-white
            text-sm
            font-bold
            shadow-lg
            shadow-slate-900/10
            hover:bg-amber-500
            hover:shadow-amber-500/20
            transition-all duration-300">

                                <i class="fa-solid fa-plus"></i>

                                Tạo môn học

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

    /*
    |--------------------------------------------------------------------------
    | ICON PREVIEW
    |--------------------------------------------------------------------------
    */

    const iconSelect = document.getElementById('subjectIconInput');

    if (iconSelect) {

        document.querySelectorAll('#iconPreview').forEach(icon => {
            icon.className = iconSelect.value + ' text-slate-600 text-xl';
        });

        iconSelect.addEventListener('change', function() {

            document.querySelectorAll('#iconPreview').forEach(icon => {
                icon.className = this.value + ' text-slate-600 text-xl';
            });

        });

    }

    /*
    |--------------------------------------------------------------------------
    | TEACHER SEARCH
    |--------------------------------------------------------------------------
    */

    const searchInput = document.getElementById('teacher-search');
    const items = document.querySelectorAll('.teacher-item');

    function removeVietnameseTones(str) {

        return str
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/đ/g, 'd')
            .replace(/Đ/g, 'D')
            .toLowerCase();

    }

    if (searchInput) {

        searchInput.addEventListener('input', function() {

            const keyword = removeVietnameseTones(this.value);

            items.forEach(item => {

                const name = removeVietnameseTones(
                    item.querySelector('.teacher-name').textContent
                );

                const email = removeVietnameseTones(
                    item.querySelector('.teacher-email').textContent
                );

                item.style.display =
                    (name.includes(keyword) || email.includes(keyword)) ?
                    'flex' :
                    'none';

            });

        });

    }

    /*
    |--------------------------------------------------------------------------
    | THUMBNAIL PREVIEW (UPLOAD)
    |--------------------------------------------------------------------------
    */

    const upload = document.getElementById('thumbnail_upload');
    const preview = document.getElementById('thumbnail-preview');

    if (upload && preview) {

        upload.addEventListener('change', function() {

            const file = this.files[0];

            if (!file) return;

            preview.src = URL.createObjectURL(file);

        });

    }

    /*
    |--------------------------------------------------------------------------
    | THUMBNAIL PREVIEW (DEFAULT IMAGE)
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('input[name="thumbnail"]').forEach(radio => {

        radio.addEventListener('change', function() {

            if (preview) {

                preview.src =
                    "{{ asset('img/subjects') }}/" + this.value;

            }

        });

    });

});
</script>
@endpush