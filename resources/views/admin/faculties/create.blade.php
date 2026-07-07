@extends('layouts.admin')

@section('title', 'Thêm khoa')
@section('page-title', 'Thêm khoa')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h2 class="text-2xl font-extrabold text-slate-900">

                    Thêm khoa

                </h2>

                <p class="mt-2 text-sm font-medium text-slate-500">

                    Tạo mới một khoa để quản lý môn học trong hệ thống.

                </p>

            </div>

            <a href="{{ route('admin.faculties.index') }}" class="inline-flex items-center gap-2
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
                hover:text-amber-600
                transition-all duration-300">

                <i class="fa-solid fa-arrow-left"></i>

                <span>Quay lại</span>

            </a>

        </div>

    </div>

    <!-- FORM -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

        <!-- FORM HEADER -->
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

            <h3 class="text-lg font-bold text-slate-800">

                Thông tin khoa

            </h3>

            <p class="mt-1 text-sm font-medium text-slate-500">

                Nhập đầy đủ thông tin của khoa trước khi lưu vào hệ thống.

            </p>

        </div>

        <form action="{{ route('admin.faculties.store') }}" method="POST">

            @csrf

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Mã khoa -->
                <div>

                    <label class="block text-xs font-bold uppercase tracking-wide text-slate-500 mb-2">

                        Mã khoa <span class="text-red-500">*</span>

                    </label>

                    <input type="text" name="faculty_code" value="{{ old('faculty_code') }}" placeholder="Ví dụ: CNTT"
                        class="w-full
                        h-12
                        px-4
                        rounded-xl
                        bg-slate-50
                        border
                        @error('faculty_code') border-red-400 @else border-slate-200 @enderror
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

                    @error('faculty_code')

                    <p class="mt-2 text-xs font-semibold text-red-500">

                        {{ $message }}

                    </p>

                    @enderror

                </div>


                <!-- Tên khoa -->
                <div>

                    <label class="block text-xs font-bold uppercase tracking-wide text-slate-500 mb-2">

                        Tên khoa <span class="text-red-500">*</span>

                    </label>

                    <input type="text" name="faculty_name" value="{{ old('faculty_name') }}"
                        placeholder="Ví dụ: Công nghệ thông tin" class="w-full
                        h-12
                        px-4
                        rounded-xl
                        bg-slate-50
                        border
                        @error('faculty_name') border-red-400 @else border-slate-200 @enderror
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

                    @error('faculty_name')

                    <p class="mt-2 text-xs font-semibold text-red-500">

                        {{ $message }}

                    </p>

                    @enderror

                </div>


                <!-- Mô tả -->
                <div class="md:col-span-2">

                    <label class="block text-xs font-bold uppercase tracking-wide text-slate-500 mb-2">

                        Mô tả

                    </label>

                    <textarea name="description" rows="5" placeholder="Nhập mô tả về khoa..." class="w-full
                        rounded-xl
                        bg-slate-50
                        border
                        @error('description') border-red-400 @else border-slate-200 @enderror
                        p-4
                        text-sm
                        font-medium
                        text-slate-700
                        placeholder:text-slate-400
                        outline-none
                        transition-all duration-300
                        focus:bg-white
                        focus:border-amber-500
                        focus:ring-4
                        focus:ring-amber-100">{{ old('description') }}</textarea>

                    @error('description')

                    <p class="mt-2 text-xs font-semibold text-red-500">

                        {{ $message }}

                    </p>

                    @enderror

                </div>
                <!-- Trạng thái -->
                <div>

                    <label class="block text-xs font-bold uppercase tracking-wide text-slate-500 mb-2">

                        Trạng thái

                    </label>

                    <select name="is_active" class="w-full
                        h-12
                        px-4
                        rounded-xl
                        bg-slate-50
                        border border-slate-200
                        text-sm
                        font-medium
                        text-slate-700
                        outline-none
                        transition-all duration-300
                        focus:bg-white
                        focus:border-amber-500
                        focus:ring-4
                        focus:ring-amber-100">

                        <option value="1" {{ old('is_active',1)==1 ? 'selected' : '' }}>
                            Hoạt động
                        </option>

                        <option value="0" {{ old('is_active')=='0' ? 'selected' : '' }}>
                            Đã khóa
                        </option>

                    </select>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="border-t border-slate-200 bg-slate-50 px-6 py-5">

                <div class="flex flex-col sm:flex-row justify-end gap-3">

                    <a href="{{ route('admin.faculties.index') }}" class="inline-flex items-center justify-center
                        h-11
                        px-5
                        rounded-xl
                        border border-slate-200
                        bg-white
                        text-slate-700
                        text-sm
                        font-semibold
                        hover:bg-slate-100
                        transition-all duration-300">

                        Hủy

                    </a>

                    <button type="submit" class="inline-flex items-center justify-center gap-2
                        h-11
                        px-6
                        rounded-xl
                        bg-slate-900
                        text-white
                        text-sm
                        font-semibold
                        shadow-sm
                        hover:bg-amber-500
                        transition-all duration-300">

                        <i class="fa-solid fa-plus"></i>

                        <span>Thêm khoa</span>

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>







@endsection