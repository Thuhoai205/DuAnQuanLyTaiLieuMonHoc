@extends('layouts.admin')

@section('title', 'Chỉnh sửa môn học')
@section('page-title', 'Chỉnh sửa môn học')

@section('content')

<div class="max-w-5xl mx-auto px-2 lg:px-4">

    <div class="mb-8 flex items-center justify-between gap-4">
        <div>
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-cyan-50 text-cyan-700 border border-cyan-100 text-xs font-black uppercase tracking-[0.18em] mb-4">
                <i class="fa-solid fa-pen-to-square"></i>
                Edit Subject
            </span>

            <h1 class="text-4xl font-black text-slate-900">
                Chỉnh sửa môn học
            </h1>

            <p class="text-slate-500 font-semibold mt-2">
                Cập nhật thông tin môn học và giảng viên phụ trách.
            </p>
        </div>

        <a href="{{ request('redirect_back') ? urldecode(request('redirect_back')) : route('admin.subjects.index') }}"
            class="px-5 py-3 rounded-2xl bg-white border border-cyan-100 text-cyan-700 font-black hover:bg-cyan-50 transition">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Quay lại
        </a>
    </div>

    <form action="{{ route('admin.subjects.update', $subject->subject_code) }}" method="POST"
        class="bg-white rounded-[36px] border border-cyan-100 p-8 shadow-[0_15px_45px_rgba(8,145,178,0.08)] space-y-7">
        @csrf
        @method('PUT')

        <input type="hidden" name="redirect_back" value="{{ request('redirect_back') }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-black text-slate-600 mb-3">
                    Mã môn học
                </label>

                <input type="text" value="{{ $subject->subject_code }}" disabled
                    class="w-full h-14 px-5 rounded-2xl bg-slate-100 border border-slate-200 text-slate-500 font-black cursor-not-allowed">

                <p class="text-xs text-slate-400 font-semibold mt-2">
                    Mã môn học không nên thay đổi sau khi đã tạo.
                </p>
            </div>

            <div>
                <label class="block text-sm font-black text-slate-600 mb-3">
                    Tên môn học
                </label>

                <input type="text" name="subject_name" value="{{ old('subject_name', $subject->subject_name) }}"
                    placeholder="VD: Lập trình Web"
                    class="w-full h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100 outline-none focus:ring-2 focus:ring-cyan-300 font-semibold">

                @error('subject_name')
                <p class="text-red-500 text-sm font-bold mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-black text-slate-600 mb-3">
                Mô tả
            </label>

            <textarea name="description" rows="5" placeholder="Nhập mô tả môn học..."
                class="w-full px-5 py-4 rounded-2xl bg-cyan-50 border border-cyan-100 outline-none focus:ring-2 focus:ring-cyan-300 font-semibold resize-none">{{ old('description', $subject->description) }}</textarea>

            @error('description')
            <p class="text-red-500 text-sm font-bold mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-black text-slate-600 mb-3">
                Giảng viên phụ trách
            </label>

            <input type="text" id="teacherSearch" placeholder="Tìm nhanh tên hoặc email giảng viên..."
                class="w-full h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100 outline-none focus:ring-2 focus:ring-cyan-300 font-semibold mb-5">

            @php
            $selectedTeachers = old(
            'teacher_ids',
            $subject->lecturers ? $subject->lecturers->pluck('user_id')->toArray() : []
            );
            @endphp

            <div id="teachersList" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($teachers as $teacher)
                <label
                    class="teacher-item flex items-center gap-4 p-4 rounded-2xl bg-cyan-50 border border-cyan-100 cursor-pointer hover:bg-cyan-100 transition"
                    data-search="{{ strtolower($teacher->full_name . ' ' . $teacher->email) }}">

                    <input type="checkbox" name="teacher_ids[]" value="{{ $teacher->user_id }}"
                        class="w-5 h-5 accent-cyan-500" @checked(in_array($teacher->user_id, $selectedTeachers))>

                    <img src="{{ $teacher->avatar ? asset('storage/' . $teacher->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->full_name) . '&background=06b6d4&color=fff' }}"
                        class="w-11 h-11 rounded-2xl object-cover">

                    <div>
                        <p class="font-black text-slate-800">
                            {{ $teacher->full_name }}
                        </p>

                        <p class="text-xs font-semibold text-slate-400">
                            {{ $teacher->email }}
                        </p>
                    </div>
                </label>
                @empty
                <div class="md:col-span-2 p-6 rounded-2xl bg-amber-50 border border-amber-100 text-amber-600 font-bold">
                    <i class="fa-solid fa-triangle-exclamation mr-2"></i>
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
            <p class="text-red-500 text-sm font-bold mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-4 pt-5 border-t border-cyan-100">
            <a href="{{ request('redirect_back') ? urldecode(request('redirect_back')) : route('admin.subjects.index') }}"
                class="px-6 py-3 rounded-2xl bg-slate-100 text-slate-700 font-black hover:bg-slate-200 transition">
                Hủy
            </a>

            <button type="submit"
                class="px-7 py-3 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-black shadow-lg shadow-cyan-200 transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i>
                Lưu thay đổi
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('teacherSearch');
    const teacherItems = Array.from(document.querySelectorAll('.teacher-item'));
    const emptyBox = document.getElementById('teacherEmpty');

    searchInput.addEventListener('input', function() {
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

        emptyBox.classList.toggle('hidden', visibleCount > 0);
    });
});
</script>

@endsection