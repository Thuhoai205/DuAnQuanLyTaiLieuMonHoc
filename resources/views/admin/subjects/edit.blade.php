@extends('layouts.admin')

@section('title', 'Chỉnh sửa môn học')
@section('page-title', 'Chỉnh sửa môn học')

@section('content')

@php
$colors = ['blue','green','red','yellow','purple','cyan','gray'];

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

                <div class="p-6 text-center bg-slate-50 border-b border-slate-200">

                    <div class="w-16 h-16 mx-auto rounded-md bg-sky-50 flex items-center justify-center">
                        <i class="{{ $subject->icon ?? 'fa-solid fa-book-open' }} text-sky-600 text-xl"></i>
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
                            <option value="active" @selected($subject->status=='active')>Hoạt động</option>
                            <option value="inactive" @selected($subject->status=='inactive')>Ẩn</option>
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