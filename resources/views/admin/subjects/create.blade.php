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
    <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">
        <div class="flex justify-between items-center">

            <div>
                <h2 class="text-lg font-black text-slate-800">
                    Thêm môn học
                </h2>
                <p class="text-sm text-slate-500">
                    Tạo môn học mới trong hệ thống
                </p>
            </div>

            <a href="{{ route('admin.subjects.index') }}"
                class="h-10 px-4 flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-md font-black text-slate-600 hover:bg-slate-100 transition">

                <i class="fa-solid fa-arrow-left"></i>
                Quay lại
            </a>

        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- SIDEBAR PREVIEW --}}
        <div class="xl:col-span-1">

            <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden sticky top-6">

                <div class="p-6 bg-slate-50 border-b border-slate-200">

                    <div class="w-14 h-14 rounded-md flex items-center justify-center
                        bg-{{ $previewColor }}-50 text-{{ $previewColor }}-600">

                        <i id="iconPreview" class="{{ $previewIcon }} text-xl"></i>

                        <img id="thumbnailPreview" class="hidden w-full h-full object-cover rounded-md">
                    </div>

                    <h2 class="text-lg font-black text-slate-800 mt-4">
                        Preview môn học
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Xem trước icon và thông tin
                    </p>

                </div>

                <div class="p-5 space-y-3">

                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500 font-semibold">Giảng viên</span>
                        <span id="selectedTeacherCard" class="font-black text-slate-800">
                            {{ count($selectedTeachers) }}
                        </span>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500 font-semibold">Trạng thái</span>
                        <span class="font-black text-emerald-600">Mới tạo</span>
                    </div>

                </div>

            </div>

        </div>

        {{-- FORM --}}
        <div class="xl:col-span-2">

            <form action="{{ route('admin.subjects.store') }}" method="POST" enctype="multipart/form-data"
                class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">

                @csrf

                {{-- HEADER --}}
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <h2 class="text-lg font-black text-slate-800">
                        Thông tin môn học
                    </h2>
                </div>

                <div class="p-6 space-y-6">

                    {{-- MÃ + TÊN --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="text-xs font-black text-slate-500 uppercase">Mã môn học</label>
                            <input type="text" name="subject_code"
                                class="w-full mt-2 h-11 px-4 rounded-md bg-slate-50 border border-slate-200 font-semibold"
                                value="{{ old('subject_code') }}">
                        </div>

                        <div>
                            <label class="text-xs font-black text-slate-500 uppercase">Tên môn học</label>
                            <input type="text" name="subject_name"
                                class="w-full mt-2 h-11 px-4 rounded-md bg-slate-50 border border-slate-200 font-semibold"
                                value="{{ old('subject_name') }}">
                        </div>

                    </div>

                    {{-- KHOA + TRẠNG THÁI --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="text-xs font-black text-slate-500 uppercase">Khoa</label>
                            <select name="faculty_id"
                                class="w-full mt-2 h-11 px-4 rounded-md bg-slate-50 border border-slate-200 font-semibold">

                                <option value="">Chọn khoa</option>
                                @foreach($faculties as $faculty)
                                <option value="{{ $faculty->faculty_id }}">
                                    {{ $faculty->faculty_name }}
                                </option>
                                @endforeach

                            </select>
                        </div>

                        <div>
                            <label class="text-xs font-black text-slate-500 uppercase">Trạng thái</label>
                            <select name="status"
                                class="w-full mt-2 h-11 px-4 rounded-md bg-slate-50 border border-slate-200 font-semibold">

                                <option value="active">Hoạt động</option>
                                <option value="inactive">Ẩn</option>

                            </select>
                        </div>

                    </div>

                    {{-- ICON + COLOR --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        {{-- ICON --}}
                        <div>
                            <label class="text-xs font-black text-slate-500 uppercase">Icon</label>

                            <div class="mt-2 flex items-center gap-3">

                                <div class="w-10 h-10 rounded-md bg-slate-100 flex items-center justify-center">
                                    <i id="iconPreview" class="fa-solid fa-book-open text-slate-600"></i>
                                </div>

                                <select name="icon" id="subjectIconInput"
                                    class="flex-1 h-11 px-4 rounded-md bg-slate-50 border border-slate-200 font-semibold">

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

                        {{-- COLOR --}}
                        <div>
                            <label class="text-xs font-black text-slate-500 uppercase">Màu sắc</label>

                            <select name="color"
                                class="w-full mt-2 h-11 px-4 rounded-md bg-slate-50 border border-slate-200 font-semibold">

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

                    {{-- THUMBNAIL (GOOGLE CLASSROOM FINAL FIX) --}}
                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase">
                            Ảnh môn học
                        </label>

                        <div class="mt-3 grid grid-cols-5 gap-4">

                            @foreach($subjectImages as $key => $img)

                            <label class="cursor-pointer group relative">

                                <input type="radio" name="thumbnail" value="{{ $img }}" class="hidden peer"
                                    @checked(old('thumbnail')==$img)>

                                {{-- CARD --}}
                                <div class="relative rounded-xl overflow-hidden border-2 border-slate-200
                        transition-all duration-200
                        group-hover:shadow-lg
                        peer-checked:border-sky-500
                        peer-checked:shadow-md
                        peer-checked:scale-[1.03]">

                                    <img src="{{ asset('img/subjects/' . $img) }}" class="w-full h-20 object-cover">
                                    {{-- overlay --}}
                                    <div class="absolute inset-0 bg-sky-500/0
                            peer-checked:bg-sky-500/10
                            transition"></div>

                                    {{-- check icon --}}
                                    <div class="absolute top-2 right-2 w-6 h-6 rounded-full bg-sky-500 text-white
                            flex items-center justify-center text-[10px]
                            opacity-0 scale-75
                            peer-checked:opacity-100 peer-checked:scale-100
                            transition">
                                        <i class="fa-solid fa-check"></i>
                                    </div>

                                </div>

                                {{-- LABEL --}}
                                <p class="text-[11px] text-center mt-1 font-semibold text-slate-500
                      group-hover:text-slate-700">
                                    {{ ucfirst($key) }}
                                </p>

                            </label>

                            @endforeach

                        </div>

                        <p class="text-xs text-slate-400 mt-2 font-semibold">
                            Chọn 1 ảnh đại diện cho môn học
                        </p>
                    </div>

                    {{-- FOOTER --}}
                    <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-3">

                        <a href="{{ route('admin.subjects.index') }}"
                            class="h-10 px-4 flex items-center rounded-md bg-slate-100 text-slate-600 font-black">
                            Hủy
                        </a>

                        <button type="submit"
                            class="h-10 px-4 bg-sky-500 text-white rounded-md font-black hover:bg-sky-600">
                            <i class="fa-solid fa-plus mr-2"></i>
                            Tạo môn học
                        </button>

                    </div>

            </form>
        </div>

    </div>

</div>

@endsection
<script>
document.getElementById('subjectIconInput')?.addEventListener('change', function() {
    const icon = document.getElementById('iconPreview');
    if (!icon) return;
    icon.className = this.value + ' text-slate-600';
});
</script>