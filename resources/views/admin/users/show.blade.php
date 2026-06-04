@extends('layouts.admin')

@section('title', 'Chi tiết người dùng')
@section('page-title', 'Chi tiết người dùng')

@section('content')

@php
$totalDocuments = $totalDocuments ?? $user->documents->count();
$totalSubjects = $totalSubjects ?? $user->subjects->count();
$totalDownloads = $totalDownloads ?? $user->downloadHistories->count();
$totalFavorites = $totalFavorites ?? $user->favorites->count();
$totalLogs = $totalLogs ?? $user->activityLogs->count();
$totalSearches = $totalSearches ?? $user->searchHistories->count();
@endphp

<div class="max-w-7xl mx-auto px-2 lg:px-4">

    <section
        class="relative overflow-hidden rounded-[40px] bg-[#0891B2] text-white p-8 lg:p-10 mb-10 shadow-2xl shadow-cyan-200">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-cyan-300/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-sky-300/20 rounded-full blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
            <div class="flex items-center gap-6">
                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->full_name) . '&background=06b6d4&color=fff' }}"
                    class="w-28 h-28 rounded-[30px] object-cover border-4 border-white shadow-2xl">

                <div>
                    <span
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-700/60 border border-cyan-300/30 text-cyan-50 text-xs font-black mb-4">
                        <i class="fa-solid fa-user"></i>
                        User Profile
                    </span>

                    <h1 class="text-4xl md:text-5xl font-black leading-tight">
                        {{ $user->full_name }}
                    </h1>

                    <p class="text-cyan-100 font-semibold mt-2">
                        {{ '@' . $user->username }} • {{ $user->email }}
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.users.edit', $user->user_id) }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-cyan-300 text-cyan-950 font-black hover:bg-cyan-200 transition shadow-xl">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Chỉnh sửa
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-white/15 border border-white/20 text-white font-black hover:bg-white/25 transition">
                    <i class="fa-solid fa-arrow-left"></i>
                    Quay lại
                </a>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white rounded-[32px] p-7 border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <p class="text-sm font-black uppercase tracking-[0.18em] text-slate-400">Vai trò</p>
            <h3 class="text-3xl font-black text-cyan-950 mt-4">
                {{ $user->role->role_name ?? 'Chưa có role' }}
            </h3>
        </div>

        <div class="bg-white rounded-[32px] p-7 border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <p class="text-sm font-black uppercase tracking-[0.18em] text-slate-400">Trạng thái</p>

            <h3 class="text-3xl font-black mt-4 {{ $user->is_active ? 'text-emerald-600' : 'text-red-500' }}">
                {{ $user->is_active ? 'Hoạt động' : 'Bị khóa' }}
            </h3>
        </div>

        <div class="bg-white rounded-[32px] p-7 border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <p class="text-sm font-black uppercase tracking-[0.18em] text-slate-400">Ngày tạo</p>
            <h3 class="text-3xl font-black text-cyan-950 mt-4">
                {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Chưa có' }}
            </h3>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        @if($user->role_id == 2)
        <div class="bg-white rounded-[28px] p-6 border border-cyan-100">
            <p class="text-slate-400 text-xs font-black uppercase">Tài liệu upload</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">
                {{ number_format($totalDocuments) }}
            </h3>
        </div>

        <div class="bg-white rounded-[28px] p-6 border border-cyan-100">
            <p class="text-slate-400 text-xs font-black uppercase">Môn phụ trách</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">
                {{ number_format($totalSubjects) }}
            </h3>
        </div>
        @endif

        <div class="bg-white rounded-[28px] p-6 border border-cyan-100">
            <p class="text-slate-400 text-xs font-black uppercase">Lượt tải</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">
                {{ number_format($totalDownloads) }}
            </h3>
        </div>

        @if($user->role_id == 3)
        <div class="bg-white rounded-[28px] p-6 border border-cyan-100">
            <p class="text-slate-400 text-xs font-black uppercase">Tài liệu yêu thích</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">
                {{ number_format($totalFavorites) }}
            </h3>
        </div>

        <div class="bg-white rounded-[28px] p-6 border border-cyan-100">
            <p class="text-slate-400 text-xs font-black uppercase">Lịch sử tìm kiếm</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">
                {{ number_format($totalSearches) }}
            </h3>
        </div>
        @endif

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <div class="xl:col-span-2 space-y-8">
            <div
                class="bg-white rounded-[36px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] overflow-hidden">
                <div class="px-7 py-6 border-b border-cyan-100">
                    <h2 class="text-3xl font-black text-cyan-950">Thông tin tài khoản</h2>
                </div>

                <div class="p-7 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="p-5 rounded-3xl bg-cyan-50 border border-cyan-100">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400 mb-2">Họ và tên</p>
                        <h4 class="text-lg font-black text-slate-800">{{ $user->full_name }}</h4>
                    </div>

                    <div class="p-5 rounded-3xl bg-cyan-50 border border-cyan-100">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400 mb-2">Username</p>
                        <h4 class="text-lg font-black text-slate-800">{{ '@' . $user->username }}</h4>
                    </div>

                    <div class="p-5 rounded-3xl bg-cyan-50 border border-cyan-100">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400 mb-2">Email</p>
                        <h4 class="text-lg font-black text-slate-800">{{ $user->email }}</h4>
                    </div>

                    <div class="p-5 rounded-3xl bg-cyan-50 border border-cyan-100">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400 mb-2">Mã người dùng</p>
                        <h4 class="text-lg font-black text-slate-800">#{{ $user->user_id }}</h4>
                    </div>
                </div>
            </div>
            @if($user->role_id == 2)

            <div
                class="bg-white rounded-[36px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] overflow-hidden">
                <div class="px-7 py-6 border-b border-cyan-100">
                    <h2 class="text-3xl font-black text-cyan-950">Môn học phụ trách</h2>
                </div>

                <div class="p-7 space-y-4">
                    @forelse($user->subjects as $subject)
                    <div class="p-5 rounded-3xl bg-cyan-50 border border-cyan-100 flex items-center justify-between">
                        <div>
                            <h3 class="font-black text-slate-800">{{ $subject->subject_name }}</h3>
                            <p class="text-sm font-semibold text-slate-500">{{ $subject->subject_code }}</p>
                        </div>

                        <a href="{{ route('admin.subjects.show', $subject->subject_code) }}"
                            class="text-cyan-600 font-black hover:text-cyan-700">
                            Xem
                        </a>
                    </div>
                    @empty
                    <p class="text-slate-500 font-semibold">Người dùng này chưa được phân công môn học.</p>
                    @endforelse
                </div>
            </div>

            <div
                class="bg-white rounded-[36px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] overflow-hidden">
                <div class="px-7 py-6 border-b border-cyan-100">
                    <h2 class="text-3xl font-black text-cyan-950">Tài liệu đã upload</h2>
                </div>

                <div class="p-7 space-y-4">
                    @forelse($user->documents as $document)
                    <div class="p-5 rounded-3xl bg-cyan-50 border border-cyan-100">
                        <h3 class="font-black text-slate-800">{{ $document->title }}</h3>
                        <p class="text-sm font-semibold text-slate-500">
                            {{ $document->file_extension ?? 'file' }} • {{ number_format($document->download_count) }}
                            lượt tải
                        </p>
                    </div>
                    @empty
                    <p class="text-slate-500 font-semibold">Người dùng này chưa upload tài liệu.</p>
                    @endforelse
                </div>
            </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-[36px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-7">
                <h3 class="text-2xl font-black text-cyan-950 mb-5">Thao tác nhanh</h3>

                <div class="space-y-3">
                    <a href="{{ route('admin.users.edit', $user->user_id) }}"
                        class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-cyan-500 text-white font-black hover:bg-cyan-600 transition shadow-lg shadow-cyan-200">
                        <i class="fa-solid fa-pen"></i>
                        Chỉnh sửa người dùng
                    </a>

                    <form action="{{ route('admin.users.status', $user->user_id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-amber-50 text-amber-600 font-black hover:bg-amber-500 hover:text-white transition border border-amber-100">
                            <i class="fa-solid fa-lock"></i>
                            {{ $user->is_active ? 'Khóa tài khoản' : 'Mở khóa tài khoản' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST"
                        onsubmit="return confirm('Bạn có chắc muốn xóa người dùng này không?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-red-50 text-red-500 font-black hover:bg-red-500 hover:text-white transition border border-red-100">
                            <i class="fa-solid fa-trash"></i>
                            Xóa người dùng
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-[36px] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-7">
                <h3 class="text-2xl font-black text-cyan-950 mb-5">Thống kê khác</h3>

                <div class="space-y-4">
                    <div class="flex justify-between font-bold text-slate-600">
                        <span>Yêu thích</span>
                        <span>{{ number_format($totalFavorites) }}</span>
                    </div>

                    <div class="flex justify-between font-bold text-slate-600">
                        <span>Nhật ký</span>
                        <span>{{ number_format($totalLogs) }}</span>
                    </div>

                    <div class="flex justify-between font-bold text-slate-600">
                        <span>Tìm kiếm</span>
                        <span>{{ number_format($totalSearches) }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection