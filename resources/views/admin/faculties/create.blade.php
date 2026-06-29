@extends('layouts.admin')

@section('title', 'Thêm khoa')
@section('page-title', 'Thêm khoa')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm p-5">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-lg font-black text-slate-700">

                    Thêm khoa

                </h2>

                <p class="text-sm text-slate-500 mt-1">

                    Tạo mới một khoa trong hệ thống.

                </p>

            </div>

            <a href="{{ route('admin.faculties.index') }}" class="h-11 px-4 rounded-md border border-slate-200
                flex items-center gap-2 hover:bg-slate-100 transition">

                <i class="fa-solid fa-arrow-left"></i>

                Quay lại

            </a>

        </div>

    </div>

    <!-- FORM -->
    <div class="bg-white border border-slate-200 rounded-md shadow-sm">

        <form action="{{ route('admin.faculties.store') }}" method="POST">

            @csrf

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Mã khoa -->
                <div>

                    <label class="block text-sm font-black text-slate-700 mb-2">

                        Mã khoa <span class="text-red-500">*</span>

                    </label>

                    <input type="text" name="faculty_code" value="{{ old('faculty_code') }}" placeholder="Ví dụ: CNTT"
                        class="w-full h-11 px-4 rounded-md border border-slate-300
                        focus:border-sky-500 focus:ring-2 focus:ring-sky-200">

                    @error('faculty_code')

                    <p class="mt-2 text-sm text-red-500">

                        {{ $message }}

                    </p>

                    @enderror

                </div>

                <!-- Tên khoa -->
                <div>

                    <label class="block text-sm font-black text-slate-700 mb-2">

                        Tên khoa <span class="text-red-500">*</span>

                    </label>

                    <input type="text" name="faculty_name" value="{{ old('faculty_name') }}" placeholder="Nhập tên khoa"
                        class="w-full h-11 px-4 rounded-md border border-slate-300
                        focus:border-sky-500 focus:ring-2 focus:ring-sky-200">

                    @error('faculty_name')

                    <p class="mt-2 text-sm text-red-500">

                        {{ $message }}

                    </p>

                    @enderror

                </div>

                <!-- Mô tả -->
                <div class="md:col-span-2">

                    <label class="block text-sm font-black text-slate-700 mb-2">

                        Mô tả

                    </label>

                    <textarea name="description" rows="5" placeholder="Nhập mô tả khoa..." class="w-full rounded-md border border-slate-300 p-4
                        focus:border-sky-500 focus:ring-2 focus:ring-sky-200">{{ old('description') }}</textarea>

                    @error('description')

                    <p class="mt-2 text-sm text-red-500">

                        {{ $message }}

                    </p>

                    @enderror

                </div>
                <div>

                    <label class="block text-sm font-black text-slate-700 mb-2">

                        Trạng thái

                    </label>

                    <select name="is_active" class="w-full h-11 px-4 rounded-md border border-slate-300
        focus:border-sky-500 focus:ring-2 focus:ring-sky-200">

                        <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>
                            Hoạt động
                        </option>

                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>
                            Đã khóa
                        </option>

                    </select>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="border-t border-slate-200 px-6 py-5 flex justify-end gap-3">

                <a href="{{ route('admin.faculties.index') }}" class="h-11 px-5 rounded-md border border-slate-300
                    flex items-center font-black hover:bg-slate-100">

                    Hủy

                </a>

                <button type="submit" class="h-11 px-6 rounded-md bg-sky-500
                    hover:bg-sky-600 text-white font-black">

                    <i class="fa-solid fa-plus mr-2"></i>

                    Thêm khoa

                </button>

            </div>

        </form>

    </div>

</div>

@endsection