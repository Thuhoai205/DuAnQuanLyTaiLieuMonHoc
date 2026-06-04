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

$isAdmin = $user->role_id == 1;
$isLecturer = $user->role_id == 2;
$isStudent = $user->role_id == 3;
@endphp

<div class="max-w-7xl mx-auto px-2 lg:px-4">

    {{-- HEADER --}}
    <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
        <div>
            <h1 class="text-3xl font-black text-slate-900">
                Chi tiết người dùng
            </h1>

            <p class="text-slate-500 font-semibold mt-2">
                Xem thông tin tài khoản, vai trò và hoạt động của người dùng.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.users.edit', $user->user_id) }}"
                class="group inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-cyan-600 text-white font-black shadow-lg shadow-cyan-100 hover:bg-cyan-700 hover:-translate-y-0.5 transition-all">
                <span class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                    <i class="fa-solid fa-pen-to-square"></i>
                </span>
                Chỉnh sửa
            </a>

            <a href="{{ url()->previous() }}"
                class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-white border border-slate-200 text-slate-700 font-black shadow-sm hover:bg-slate-50 transition">
                <span class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">
                    <i class="fa-solid fa-arrow-left"></i>
                </span>
                Quay lại
            </a>
        </div>
    </div>

    {{-- PROFILE CARD --}}
    <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-cyan-600 to-sky-500 px-8 py-8 text-white">
            <div class="flex flex-col md:flex-row md:items-center gap-6">
                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->full_name) . '&background=06b6d4&color=fff' }}"
                    class="w-28 h-28 rounded-[30px] object-cover border-4 border-white shadow-xl">

                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-3 mb-3">
                        <span
                            class="px-4 py-2 rounded-full bg-white/20 text-white text-xs font-black border border-white/20">
                            {{ $user->role->role_name ?? 'Chưa có role' }}
                        </span>

                        @if($user->is_active)
                        <span
                            class="px-4 py-2 rounded-full bg-emerald-400/20 text-emerald-50 text-xs font-black border border-emerald-200/20">
                            Hoạt động
                        </span>
                        @else
                        <span
                            class="px-4 py-2 rounded-full bg-red-400/20 text-red-50 text-xs font-black border border-red-200/20">
                            Bị khóa
                        </span>
                        @endif
                    </div>

                    <h2 class="text-4xl font-black">
                        {{ $user->full_name }}
                    </h2>

                    <p class="text-cyan-50 font-semibold mt-2">
                        {{ '@' . $user->username }} • {{ $user->email }}
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-0 border-t border-cyan-100">
            <div class="p-6 border-b md:border-b-0 md:border-r border-cyan-100">
                <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">
                    Mã người dùng
                </p>
                <h3 class="text-2xl font-black text-slate-900 mt-2">
                    #{{ $user->user_id }}
                </h3>
            </div>

            <div class="p-6 border-b md:border-b-0 md:border-r border-cyan-100">
                <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">
                    Ngày tạo
                </p>
                <h3 class="text-2xl font-black text-slate-900 mt-2">
                    {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Chưa có' }}
                </h3>
            </div>

            <div class="p-6">
                <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">
                    Cập nhật gần nhất
                </p>
                <h3 class="text-2xl font-black text-slate-900 mt-2">
                    {{ $user->updated_at ? $user->updated_at->format('d/m/Y') : 'Chưa có' }}
                </h3>
            </div>
        </div>
    </div>

    {{-- STATISTICS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

        @if($isLecturer)
        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Tài liệu upload</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">
                {{ number_format($totalDocuments) }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Môn phụ trách</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">
                {{ number_format($totalSubjects) }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Lượt tải tài liệu</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">
                {{ number_format($totalDownloads) }}
            </h3>
        </div>
        @endif

        @if($isStudent)
        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Lượt tải</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">
                {{ number_format($totalDownloads) }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Tài liệu yêu thích</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">
                {{ number_format($totalFavorites) }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Lịch sử tìm kiếm</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">
                {{ number_format($totalSearches) }}
            </h3>
        </div>
        @endif

        @if($isAdmin)
        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Nhật ký hoạt động</p>
            <h3 class="text-4xl font-black text-cyan-700 mt-2">
                {{ number_format($totalLogs) }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Trạng thái</p>
            <h3 class="text-3xl font-black mt-2 {{ $user->is_active ? 'text-emerald-600' : 'text-red-500' }}">
                {{ $user->is_active ? 'Hoạt động' : 'Bị khóa' }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl border border-cyan-100 p-6 shadow-sm">
            <p class="text-xs font-black uppercase text-slate-400">Vai trò</p>
            <h3 class="text-3xl font-black text-cyan-700 mt-2">
                Admin
            </h3>
        </div>
        @endif

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        {{-- MAIN CONTENT --}}
        <div class="xl:col-span-2 space-y-8">

            {{-- ACCOUNT INFO --}}
            <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-cyan-100">
                    <h2 class="text-xl font-black text-slate-900">
                        Thông tin tài khoản
                    </h2>
                    <p class="text-sm text-slate-500 font-semibold mt-1">
                        Thông tin cơ bản của người dùng trong hệ thống.
                    </p>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="rounded-2xl bg-cyan-50 border border-cyan-100 p-5">
                        <p class="text-xs font-black uppercase text-slate-400">Họ và tên</p>
                        <h4 class="text-lg font-black text-slate-900 mt-2">{{ $user->full_name }}</h4>
                    </div>

                    <div class="rounded-2xl bg-cyan-50 border border-cyan-100 p-5">
                        <p class="text-xs font-black uppercase text-slate-400">Username</p>
                        <h4 class="text-lg font-black text-slate-900 mt-2">{{ '@' . $user->username }}</h4>
                    </div>

                    <div class="rounded-2xl bg-cyan-50 border border-cyan-100 p-5">
                        <p class="text-xs font-black uppercase text-slate-400">Email</p>
                        <h4 class="text-lg font-black text-slate-900 mt-2">{{ $user->email }}</h4>
                    </div>

                    <div class="rounded-2xl bg-cyan-50 border border-cyan-100 p-5">
                        <p class="text-xs font-black uppercase text-slate-400">Vai trò</p>
                        <h4 class="text-lg font-black text-slate-900 mt-2">
                            {{ $user->role->role_name ?? 'Chưa có role' }}</h4>
                    </div>
                </div>
            </div>

            {{-- LECTURER ONLY --}}
            @if($isLecturer)
            <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-cyan-100">
                    <h2 class="text-xl font-black text-slate-900">
                        Môn học phụ trách
                    </h2>
                </div>

                <div class="p-6 space-y-4">
                    @forelse($user->subjects as $subject)
                    <div class="p-5 rounded-2xl bg-cyan-50 border border-cyan-100 flex items-center justify-between">
                        <div>
                            <h3 class="font-black text-slate-900">{{ $subject->subject_name }}</h3>
                            <p class="text-sm font-semibold text-slate-500">{{ $subject->subject_code }}</p>
                        </div>

                        <a href="{{ route('admin.subjects.show', $subject->subject_code) }}"
                            class="px-4 py-2 rounded-xl bg-white text-cyan-700 font-black border border-cyan-100 hover:bg-cyan-600 hover:text-white transition">
                            Xem
                        </a>
                    </div>
                    @empty
                    <p class="text-slate-500 font-semibold">
                        Giảng viên này chưa được phân công môn học.
                    </p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-cyan-100">
                    <h2 class="text-xl font-black text-slate-900">
                        Tài liệu đã upload
                    </h2>
                </div>

                <div class="p-6 space-y-4">
                    @forelse($user->documents as $document)
                    <div class="p-5 rounded-2xl bg-cyan-50 border border-cyan-100">
                        <h3 class="font-black text-slate-900">{{ $document->title }}</h3>
                        <p class="text-sm font-semibold text-slate-500 mt-1">
                            {{ strtoupper($document->file_extension ?? 'FILE') }}
                            • {{ number_format($document->download_count) }} lượt tải
                        </p>
                    </div>
                    @empty
                    <p class="text-slate-500 font-semibold">
                        Giảng viên này chưa upload tài liệu.
                    </p>
                    @endforelse
                </div>
            </div>
            @endif

            {{-- STUDENT ONLY --}}
            @if($isStudent)
            <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-cyan-100">
                    <h2 class="text-xl font-black text-slate-900">
                        Thông tin học tập
                    </h2>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="rounded-2xl bg-cyan-50 border border-cyan-100 p-5">
                        <p class="text-xs font-black uppercase text-slate-400">Lượt tải tài liệu</p>
                        <h4 class="text-3xl font-black text-cyan-700 mt-2">{{ number_format($totalDownloads) }}</h4>
                    </div>

                    <div class="rounded-2xl bg-cyan-50 border border-cyan-100 p-5">
                        <p class="text-xs font-black uppercase text-slate-400">Tài liệu yêu thích</p>
                        <h4 class="text-3xl font-black text-cyan-700 mt-2">{{ number_format($totalFavorites) }}</h4>
                    </div>
                </div>
            </div>
            @endif

        </div>

        {{-- SIDEBAR --}}
        <div class="space-y-6">

            <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm p-6">
                <h3 class="text-xl font-black text-slate-900 mb-5">
                    Thao tác nhanh
                </h3>

                <div class="space-y-3">
                    <a href="{{ route('admin.users.edit', $user->user_id) }}"
                        class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-cyan-600 text-white font-black hover:bg-cyan-700 transition">
                        <i class="fa-solid fa-pen"></i>
                        Chỉnh sửa người dùng
                    </a>
                    @if($user->user_id != auth()->id())
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
                        onsubmit="return confirm('Người dùng sẽ bị xóa mềm và có thể khôi phục lại. Bạn có chắc không?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-red-50 text-red-500 font-black hover:bg-red-500 hover:text-white transition border border-red-100">
                            <i class="fa-solid fa-trash"></i>
                            Xóa người dùng
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm p-6">
                <h3 class="text-xl font-black text-slate-900 mb-5">
                    Thống kê khác
                </h3>

                <div class="space-y-4">
                    <div class="flex justify-between font-bold text-slate-600">
                        <span>Nhật ký</span>
                        <span>{{ number_format($totalLogs) }}</span>
                    </div>

                    <div class="flex justify-between font-bold text-slate-600">
                        <span>Tìm kiếm</span>
                        <span>{{ number_format($totalSearches) }}</span>
                    </div>

                    <div class="flex justify-between font-bold text-slate-600">
                        <span>Yêu thích</span>
                        <span>{{ number_format($totalFavorites) }}</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection