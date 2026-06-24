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

    <!-- HEADER -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-200 flex items-center justify-between">

            <div>
                <h2 class="text-sm font-black text-slate-700">
                    Chỉnh sửa môn học
                </h2>
                <p class="text-xs text-slate-400 font-semibold mt-1">
                    Cập nhật thông tin môn học và giảng viên phụ trách
                </p>
            </div>

            <a href="{{ url()->previous() }}"
                class="px-4 py-2 rounded-md bg-white border border-slate-200 text-slate-600 text-sm font-black hover:bg-slate-100 transition">
                <i class="fa-solid fa-arrow-left mr-1"></i>
                Quay lại
            </a>

        </div>
    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

        <!-- LEFT -->
        <div class="xl:col-span-4">
            <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">
                <div class="h-48 w-full overflow-hidden">
                    <img src="{{ $subject->thumbnail_url }}">
                </div>

                <div class="p-6 text-center bg-slate-50 border-b border-slate-200">

                    <div class="w-14 h-14 mx-auto rounded-xl flex items-center justify-center {{ $color }}">
                        <i class="{{ $subjectIcon }} text-xl"></i>
                    </div>
                    <h3 class="mt-4 text-lg font-black text-slate-700">
                        {{ $subject->subject_name }}
                    </h3>

                    <p class="text-sm text-slate-400 font-semibold mt-1">
                        {{ $subject->subject_code }}
                    </p>

                </div>

                <div class="p-5 space-y-2 text-sm font-semibold text-slate-500">
                    <p>📚 Tài liệu: {{ $subject->documents_count ?? 0 }}</p>
                    <p>👨‍🏫 Giảng viên: {{ $subject->lecturers->count() }}</p>
                    <p>📊 Trạng thái: {{ $subject->status }}</p>
                </div>

            </div>
        </div>

        <!-- RIGHT -->
        <div class="xl:col-span-8">
            <div class="bg-white border border-slate-200 rounded-md shadow-sm overflow-hidden">

                <div class="px-5 py-4 border-b border-slate-200 bg-slate-50">
                    <h3 class="text-sm font-black text-slate-700">
                        Thông tin môn học
                    </h3>
                </div>

                <form method="POST" action="{{ route('admin.subjects.update', $subject->subject_code) }}"
                    class="p-5 space-y-5">

                    @csrf
                    @method('PUT')

                    <!-- NAME -->
                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase">Tên môn học</label>
                        <input type="text" name="subject_name" value="{{ old('subject_name', $subject->subject_name) }}"
                            class="w-full mt-2 h-11 px-4 rounded-md bg-slate-50 border border-slate-200 text-sm font-semibold">
                    </div>

                    <!-- DESCRIPTION -->
                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase">Mô tả</label>
                        <textarea name="description" rows="3"
                            class="w-full mt-2 px-4 py-3 rounded-md bg-slate-50 border border-slate-200 text-sm font-semibold">{{ old('description', $subject->description) }}</textarea>
                    </div>

                    <!-- FACULTY + STATUS -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <select name="faculty_id" class="h-11 px-4 rounded-md bg-slate-50 border text-sm font-semibold">
                            <option value="">Chọn khoa</option>
                            @foreach($faculties as $faculty)
                            <option value="{{ $faculty->faculty_id }}" @selected($subject->faculty_id ==
                                $faculty->faculty_id)>
                                {{ $faculty->faculty_name }}
                            </option>
                            @endforeach
                        </select>

                        <select name="status" class="h-11 px-4 rounded-md bg-slate-50 border text-sm font-semibold">

                            <option value="active" @selected($subject->status == 'active')>
                                Hoạt động
                            </option>

                            <option value="archived" @selected($subject->status == 'archived')>
                                Đã khóa
                            </option>

                        </select>

                    </div>

                    <!-- ICON -->
                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase">Icon môn học</label>

                        <select name="icon"
                            class="w-full mt-2 h-11 px-4 rounded-md bg-slate-50 border text-sm font-semibold">

                            @foreach($icons as $value => $label)
                            <option value="{{ $value }}" @selected($subject->icon == $value)>
                                {{ $label }}
                            </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- COLOR -->
                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase">Màu sắc</label>

                        <select name="color"
                            class="w-full mt-2 h-11 px-4 rounded-md bg-slate-50 border text-sm font-semibold">

                            @foreach($colors as $color)
                            <option value="{{ $color }}" @selected($subject->color == $color)>
                                {{ ucfirst($color) }}
                            </option>
                            @endforeach

                        </select>
                    </div>
                    {{-- THUMBNAIL SELECT --}}
                    <div class="mt-6">
                        <label class="text-xs font-black text-slate-500 uppercase">
                            Ảnh môn học
                        </label>

                        <div class="mt-3 grid grid-cols-5 gap-4">

                            @foreach($subjectImages as $key => $img)

                            <label class="cursor-pointer group relative">

                                <input type="radio" name="thumbnail" value="{{ $img }}" class="hidden peer"
                                    @checked(old('thumbnail', $subject->thumbnail ?? '01.jpg') == $img)>

                                <div class="relative rounded-xl overflow-hidden border-2 border-slate-200
                        transition-all duration-200
                        group-hover:shadow-lg
                        peer-checked:border-sky-500
                        peer-checked:shadow-md
                        peer-checked:scale-[1.03]">

                                    <img src="{{ asset('img/subjects/' . $img) }}" class="w-full h-20 object-cover">

                                    <div class="absolute inset-0 bg-sky-500/0
                            peer-checked:bg-sky-500/10 transition"></div>

                                    <div class="absolute top-2 right-2 w-6 h-6 rounded-full bg-sky-500 text-white
                            flex items-center justify-center text-[10px]
                            opacity-0 scale-75
                            peer-checked:opacity-100 peer-checked:scale-100 transition">
                                        <i class="fa-solid fa-check"></i>
                                    </div>

                                </div>

                                <p
                                    class="text-[11px] text-center mt-1 font-semibold text-slate-500 group-hover:text-slate-700">
                                    Ảnh {{ $key }}
                                </p>

                            </label>

                            @endforeach

                        </div>
                    </div>
                    <!-- LECTURERS -->
                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase">
                            Giảng viên phụ trách
                        </label>

                        <!-- SEARCH -->
                        <div class="mt-2 relative">
                            <i
                                class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text" id="teacher-search" placeholder="Tìm giảng viên..."
                                class="w-full h-10 pl-9 pr-3 rounded-md bg-slate-50 border text-sm font-semibold">
                        </div>

                        <!-- LIST -->
                        <div class="mt-3 border rounded-md bg-white max-h-52 overflow-y-auto">

                            @foreach($teachers as $lecturer) <label
                                class="teacher-item flex items-center gap-3 px-3 py-2 hover:bg-slate-50 cursor-pointer border-b last:border-b-0">

                                <input type="checkbox" name="teacher_ids[]" value="{{ $lecturer->user_id }}"
                                    class="accent-sky-500 w-4 h-4" @checked($subject->lecturers->contains('user_id',
                                $lecturer->user_id))>

                                <div class="min-w-0">
                                    <p class="text-sm font-black text-slate-700 truncate">
                                        {{ $lecturer->full_name }}
                                    </p>
                                    <p class="text-xs text-slate-400 truncate">
                                        {{ $lecturer->email }}
                                    </p>
                                </div>

                            </label>
                            @endforeach

                        </div>
                    </div>

                    <!-- BUTTONS -->
                    <div class="flex justify-end gap-3 pt-5 border-t border-slate-200">

                        <a href="{{ url()->previous() }}"
                            class="px-4 py-2 rounded-md bg-slate-100 text-slate-600 text-sm font-black">
                            Hủy
                        </a>

                        <button type="submit" class="px-5 py-2 rounded-md bg-sky-500 text-white text-sm font-black">
                            Cập nhật
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>

</div>

@endsection