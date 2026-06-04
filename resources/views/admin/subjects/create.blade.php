@extends('layouts.admin')

@section('title', 'Thêm môn học')
@section('page-title', 'Thêm môn học')

@section('content')

<div class="max-w-5xl mx-auto px-2 lg:px-4">

    <div class="mb-8 flex items-center justify-between gap-4">
        <div>
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-cyan-50 text-cyan-700 border border-cyan-100 text-xs font-black uppercase tracking-[0.18em] mb-4">
                <i class="fa-solid fa-plus"></i>
                Create Subject
            </span>

            <h1 class="text-4xl font-black text-slate-900">
                Thêm môn học mới
            </h1>

            <p class="text-slate-500 font-semibold mt-2">
                Tạo môn học và gán giảng viên phụ trách.
            </p>
        </div>

        <a href="{{ route('admin.subjects.index') }}"
            class="px-5 py-3 rounded-2xl bg-white border border-cyan-100 text-cyan-700 font-black hover:bg-cyan-50 transition">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Quay lại
        </a>
    </div>

    <form action="{{ route('admin.subjects.store') }}" method="POST"
        class="bg-white rounded-[36px] border border-cyan-100 p-8 shadow-[0_15px_45px_rgba(8,145,178,0.08)] space-y-7">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-black text-slate-600 mb-3">Mã môn học</label>
                <input type="text" name="ma_mon" value="{{ old('ma_mon') }}" placeholder="VD: WEB101"
                    class="w-full h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100 outline-none focus:ring-2 focus:ring-cyan-300 font-semibold">
                @error('ma_mon')
                <p class="text-red-500 text-sm font-bold mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-black text-slate-600 mb-3">Tên môn học</label>
                <input type="text" name="ten_mon" value="{{ old('ten_mon') }}" placeholder="VD: Lập trình Web"
                    class="w-full h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100 outline-none focus:ring-2 focus:ring-cyan-300 font-semibold">
                @error('ten_mon')
                <p class="text-red-500 text-sm font-bold mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-black text-slate-600 mb-3">Mô tả</label>
            <textarea name="mo_ta" rows="5" placeholder="Nhập mô tả môn học..."
                class="w-full px-5 py-4 rounded-2xl bg-cyan-50 border border-cyan-100 outline-none focus:ring-2 focus:ring-cyan-300 font-semibold resize-none">{{ old('mo_ta') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-black text-slate-600 mb-3">Giảng viên phụ trách</label>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($teachers as $teacher)
                <label
                    class="flex items-center gap-4 p-4 rounded-2xl bg-cyan-50 border border-cyan-100 cursor-pointer hover:bg-cyan-100 transition">
                    <input type="checkbox" name="giang_vien_ids[]" value="{{ $teacher->user_id }}"
                        class="w-5 h-5 accent-cyan-500" @checked(is_array(old('giang_vien_ids')) &&
                        in_array($teacher->user_id, old('giang_vien_ids')))>

                    <img src="{{ $teacher->avatar ? asset('storage/' . $teacher->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->full_name) . '&background=06b6d4&color=fff' }}"
                        class="w-11 h-11 rounded-2xl object-cover">

                    <div>
                        <p class="font-black text-slate-800">{{ $teacher->full_name }}</p>
                        <p class="text-xs font-semibold text-slate-400">{{ $teacher->email }}</p>
                    </div>
                </label>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end gap-4 pt-5 border-t border-cyan-100">
            <a href="{{ route('admin.subjects.index') }}"
                class="px-6 py-3 rounded-2xl bg-slate-100 text-slate-700 font-black hover:bg-slate-200 transition">
                Hủy
            </a>

            <button type="submit"
                class="px-7 py-3 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-black shadow-lg shadow-cyan-200 transition">
                <i class="fa-solid fa-plus mr-2"></i>
                Tạo môn học
            </button>
        </div>
    </form>

</div>

@endsection