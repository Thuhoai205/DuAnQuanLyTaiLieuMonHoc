@extends('layouts.admin')

@section('title', 'Chỉnh sửa loại tài liệu')

@section('content')
<div class="min-h-screen bg-[#F6F7FB] px-6 py-8">

    <!-- Header -->
    <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Chỉnh sửa loại tài liệu
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Cập nhật thông tin loại tài liệu trong hệ thống.
            </p>
        </div>

        <a href="{{ route('admin.categories.index') }}"
            class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-100">
            <i class="fa-solid fa-arrow-left"></i>
            Quay lại danh sách
        </a>
    </div>

    <!-- Alert lỗi -->
    @if ($errors->any())
    <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700">
        <div class="mb-2 font-semibold">
            <i class="fa-solid fa-circle-exclamation mr-2"></i>
            Vui lòng kiểm tra lại thông tin
        </div>

        <ul class="list-inside list-disc space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">

        <!-- Form -->
        <div class="lg:col-span-8">
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="font-bold text-slate-800">
                        Thông tin loại tài liệu
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Mã loại: #{{ $loaiTaiLieu->loai_id }}
                    </p>
                </div>

                <form action="{{ route('admin.categories.update', $loaiTaiLieu->loai_id) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <!-- Tên loại -->
                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Tên loại tài liệu <span class="text-rose-500">*</span>
                        </label>

                        <div class="relative">
                            <i
                                class="fa-solid fa-folder-open absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <input type="text" name="ten_loai" value="{{ old('ten_loai', $loaiTaiLieu->ten_loai) }}"
                                placeholder="Ví dụ: Giáo trình, Slide bài giảng, Đề thi..."
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm text-slate-700 outline-none transition focus:border-violet-400 focus:bg-white focus:ring-4 focus:ring-violet-100">
                        </div>

                        @error('ten_loai')
                        <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mô tả -->
                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            Mô tả
                        </label>

                        <textarea name="mo_ta" rows="5" placeholder="Nhập mô tả ngắn cho loại tài liệu..."
                            class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-violet-400 focus:bg-white focus:ring-4 focus:ring-violet-100">{{ old('mo_ta', $loaiTaiLieu->mo_ta) }}</textarea>

                        @error('mo_ta')
                        <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end">
                        <a href="{{ route('admin.categories.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                            Hủy
                        </a>

                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#7C3AED] px-6 py-3 text-sm font-semibold text-white shadow-md shadow-violet-200 transition hover:bg-[#6D28D9]">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info card -->
        <div class="lg:col-span-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-violet-100 text-violet-600">
                    <i class="fa-solid fa-file-lines text-xl"></i>
                </div>

                <h3 class="font-bold text-slate-800">
                    Gợi ý chỉnh sửa
                </h3>

                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Tên loại tài liệu nên ngắn gọn, dễ hiểu và phản ánh đúng nhóm tài liệu.
                </p>

                <div class="mt-5 space-y-3 text-sm">
                    <div class="flex items-center gap-3 rounded-xl bg-slate-50 px-4 py-3 text-slate-600">
                        <i class="fa-solid fa-check text-emerald-500"></i>
                        Giáo trình
                    </div>

                    <div class="flex items-center gap-3 rounded-xl bg-slate-50 px-4 py-3 text-slate-600">
                        <i class="fa-solid fa-check text-emerald-500"></i>
                        Slide bài giảng
                    </div>

                    <div class="flex items-center gap-3 rounded-xl bg-slate-50 px-4 py-3 text-slate-600">
                        <i class="fa-solid fa-check text-emerald-500"></i>
                        Đề thi / Đề ôn tập
                    </div>
                </div>
            </div>

            <div class="mt-6 rounded-2xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-700">
                <div class="mb-2 font-semibold">
                    <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                    Lưu ý
                </div>
                Nếu loại tài liệu này đang được dùng bởi tài liệu khác, hãy cân nhắc trước khi đổi tên.
            </div>
        </div>
    </div>
</div>
@endsection