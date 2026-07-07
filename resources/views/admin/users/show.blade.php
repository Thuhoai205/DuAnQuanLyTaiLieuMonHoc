@extends('layouts.admin')

@section('title', 'Chi tiết người dùng')
@section('page-title', 'Chi tiết người dùng')

@section('content')

@php
$userDocuments = $user->documents ?? collect();
$userSubjects = $user->subjects ?? collect();
$userDownloads = $user->downloadHistories ?? collect();
$userFavorites = $user->favorites ?? collect();
$userLogs = $user->activityLogs ?? collect();
$userSearches = $user->searchHistories ?? collect();

$totalDocuments = $totalDocuments ?? $userDocuments->count();
$totalSubjects = $totalSubjects ?? $userSubjects->count();
$totalDownloads = $totalDownloads ?? $userDownloads->count();
$totalFavorites = $totalFavorites ?? $userFavorites->count();
$totalLogs = $totalLogs ?? $userLogs->count();
$totalSearches = $totalSearches ?? $userSearches->count();

$isAdmin = $user->role_id == 1;
$isLecturer = $user->role_id == 2;
$isStudent = $user->role_id == 3;

$lecturerDownloadCount = $isLecturer ? $userDocuments->sum('download_count') : $totalDownloads;
@endphp
<div class="space-y-8">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <div>

                <h2 class="text-2xl font-extrabold text-slate-900">
                    Chi tiết người dùng
                </h2>

                <p class="mt-2 text-sm font-medium text-slate-500">
                    Xem thông tin tài khoản, vai trò và hoạt động của người dùng trong hệ thống.
                </p>

            </div>

            <div class="flex flex-wrap gap-3">

                <a href="{{ route('admin.users.edit',$user->user_id) }}" class="inline-flex items-center gap-2
                    h-11
                    px-5
                    rounded-xl
                    bg-slate-900
                    text-white
                    text-sm
                    font-semibold
                    transition-all duration-300
                    hover:bg-amber-500">

                    <i class="fa-solid fa-pen-to-square"></i>

                    Chỉnh sửa

                </a>

                <a href="{{ urldecode(request('return', route('admin.users.index'))) }}" class="inline-flex items-center gap-2
                    h-11
                    px-5
                    rounded-xl
                    border-2 border-amber-300
                    bg-white
                    text-slate-800
                    text-sm
                    font-semibold
                    transition-all duration-300
                    hover:bg-amber-50
                    hover:border-amber-500">

                    <i class="fa-solid fa-arrow-left"></i>

                    Quay lại

                </a>

            </div>

        </div>

    </div>


    <!-- USER PROFILE -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <!-- TOP -->
        <div class="bg-gradient-to-r from-slate-900 to-slate-800 px-8 py-8">

            <div class="flex flex-col md:flex-row items-center gap-8">

                <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->full_name).'&background=0f172a&color=fff' }}"
                    class="w-32 h-32 rounded-3xl border-4 border-white object-cover shadow-xl">

                <div class="flex-1">

                    <div class="flex flex-wrap gap-3 mb-4">

                        <span class="px-4 py-1 rounded-full
                        bg-amber-100
                        text-amber-700
                        border border-amber-300
                        text-xs
                        font-semibold">

                            {{ $user->role->role_name ?? 'Chưa có vai trò' }}

                        </span>

                        @if($user->is_active)

                        <span class="px-4 py-1 rounded-full
                        bg-emerald-100
                        text-emerald-700
                        border border-emerald-300
                        text-xs
                        font-semibold">

                            Hoạt động

                        </span>

                        @else

                        <span class="px-4 py-1 rounded-full
                        bg-red-100
                        text-red-600
                        border border-red-300
                        text-xs
                        font-semibold">

                            Bị khóa

                        </span>

                        @endif

                    </div>

                    <h2 class="text-3xl font-extrabold text-white">

                        {{ $user->full_name }}

                    </h2>

                    <p class="mt-3 text-sm text-slate-200">

                        {{ '@'.$user->username }}

                        •

                        {{ $user->email }}

                    </p>

                </div>

            </div>

        </div>

        <!-- INFO -->
        <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-slate-200">

            <div class="p-6">

                <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">
                    Mã người dùng
                </p>

                <h3 class="mt-2 text-2xl font-bold text-slate-900">

                    #{{ $user->user_id }}

                </h3>

            </div>

            <div class="p-6">

                <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">
                    Ngày tạo
                </p>

                <h3 class="mt-2 text-xl font-bold text-slate-800">

                    {{ optional($user->created_at)->format('d/m/Y') ?? 'Chưa có' }}

                </h3>

            </div>

            <div class="p-6">

                <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">
                    Cập nhật gần nhất
                </p>

                <h3 class="mt-2 text-xl font-bold text-slate-800">

                    {{ optional($user->updated_at)->format('d/m/Y') ?? 'Chưa có' }}

                </h3>

            </div>

        </div>

    </div>


    <!-- STATISTICS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @if($isLecturer)

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-all">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">
                        Tài liệu Upload
                    </p>

                    <h3 class="mt-3 text-3xl font-extrabold text-slate-900">
                        {{ number_format($totalDocuments) }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Tài liệu đã đăng tải
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-slate-900 text-white flex items-center justify-center">

                    <i class="fa-solid fa-file-lines text-xl"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-all">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">
                        Môn học
                    </p>

                    <h3 class="mt-3 text-3xl font-extrabold text-slate-900">
                        {{ number_format($totalSubjects) }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Môn học phụ trách
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-amber-500 text-white flex items-center justify-center">

                    <i class="fa-solid fa-book-open text-xl"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-all">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">
                        Lượt tải
                    </p>

                    <h3 class="mt-3 text-3xl font-extrabold text-slate-900">
                        {{ number_format($lecturerDownloadCount) }}
                    </h3>

                    <p class="mt-2 text-sm text-slate-500">
                        Lượt tải tài liệu
                    </p>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-emerald-500 text-white flex items-center justify-center">

                    <i class="fa-solid fa-download text-xl"></i>

                </div>

            </div>

        </div>

        @endif


        @if($isStudent)

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-all">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">
                        Lượt tải
                    </p>

                    <h3 class="mt-3 text-3xl font-extrabold text-slate-900">

                        {{ number_format($totalDownloads) }}

                    </h3>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-slate-900 text-white flex items-center justify-center">

                    <i class="fa-solid fa-download"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-all">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">
                        Yêu thích
                    </p>

                    <h3 class="mt-3 text-3xl font-extrabold text-slate-900">

                        {{ number_format($totalFavorites) }}

                    </h3>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-amber-500 text-white flex items-center justify-center">

                    <i class="fa-solid fa-heart"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-all">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">
                        Tìm kiếm
                    </p>

                    <h3 class="mt-3 text-3xl font-extrabold text-slate-900">

                        {{ number_format($totalSearches) }}

                    </h3>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-sky-500 text-white flex items-center justify-center">

                    <i class="fa-solid fa-magnifying-glass"></i>

                </div>

            </div>

        </div>

        @endif


        @if($isAdmin)

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-all">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">
                        Nhật ký
                    </p>

                    <h3 class="mt-3 text-3xl font-extrabold text-slate-900">

                        {{ number_format($totalLogs) }}

                    </h3>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-slate-900 text-white flex items-center justify-center">

                    <i class="fa-solid fa-clock-rotate-left"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-all">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">
                        Trạng thái
                    </p>

                    <h3 class="mt-3 text-2xl font-bold {{ $user->is_active ? 'text-emerald-600' : 'text-red-600' }}">

                        {{ $user->is_active ? 'Hoạt động' : 'Bị khóa' }}

                    </h3>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-emerald-500 text-white flex items-center justify-center">

                    <i class="fa-solid fa-shield-halved"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md transition-all">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">
                        Vai trò
                    </p>

                    <h3 class="mt-3 text-2xl font-bold text-slate-900">

                        Admin

                    </h3>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-amber-500 text-white flex items-center justify-center">

                    <i class="fa-solid fa-user-shield"></i>

                </div>

            </div>

        </div>

        @endif

    </div>


    <!-- MAIN DETAIL -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 items-start">

        <div class="xl:col-span-2 space-y-6">
            <!-- ACCOUNT INFO -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-200">

                    <h2 class="text-lg font-bold text-slate-900">

                        Thông tin tài khoản

                    </h2>

                    <p class="mt-1 text-sm text-slate-500">

                        Thông tin cơ bản của người dùng trong hệ thống.

                    </p>

                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="rounded-xl bg-slate-50 border border-slate-200 p-5">

                        <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">

                            Họ và tên

                        </p>

                        <h4 class="mt-2 text-lg font-bold text-slate-900">

                            {{ $user->full_name }}

                        </h4>

                    </div>

                    <div class="rounded-xl bg-slate-50 border border-slate-200 p-5">

                        <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">

                            Username

                        </p>

                        <h4 class="mt-2 text-lg font-bold text-slate-900">

                            {{ '@'.$user->username }}

                        </h4>

                    </div>

                    <div class="rounded-xl bg-slate-50 border border-slate-200 p-5">

                        <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">

                            Email

                        </p>

                        <h4 class="mt-2 text-lg font-bold text-slate-900">

                            {{ $user->email }}

                        </h4>

                    </div>

                    <div class="rounded-xl bg-slate-50 border border-slate-200 p-5">

                        <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">

                            Vai trò

                        </p>

                        <h4 class="mt-2 text-lg font-bold text-slate-900">

                            {{ $user->role->role_name ?? 'Chưa có vai trò' }}

                        </h4>

                    </div>

                </div>

            </div>


            @if($isLecturer)

            <!-- SUBJECTS -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-200">

                    <h2 class="text-lg font-bold text-slate-900">

                        Môn học phụ trách

                    </h2>

                </div>

                <div class="p-6 space-y-4">

                    @forelse($userSubjects as $subject)

                    <div class="flex items-center justify-between gap-5
                        rounded-xl
                        border border-slate-200
                        bg-slate-50
                        p-5">

                        <div>

                            <h3 class="text-base font-bold text-slate-900">

                                {{ $subject->subject_name }}

                            </h3>

                            <p class="mt-1 text-sm text-slate-500">

                                {{ $subject->subject_code }}

                            </p>

                        </div>

                        <a href="{{ route('admin.subjects.show',$subject->subject_code) }}" class="inline-flex items-center
                            gap-2
                            px-4 py-2
                            rounded-xl
                            bg-slate-900
                            text-white
                            text-sm
                            font-semibold
                            hover:bg-amber-500
                            transition-all">

                            <i class="fa-solid fa-eye"></i>

                            Xem

                        </a>

                    </div>

                    @empty

                    <p class="text-sm text-slate-500">

                        Giảng viên chưa được phân công môn học.

                    </p>

                    @endforelse

                </div>

            </div>


            <!-- DOCUMENTS -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-200">

                    <h2 class="text-lg font-bold text-slate-900">

                        Tài liệu đã Upload

                    </h2>

                </div>

                <div class="p-6 space-y-4">

                    @forelse($userDocuments as $document)

                    @php
                    $extension = $document->currentVersion->file_extension ?? 'FILE';
                    @endphp

                    <div class="flex items-center justify-between gap-5
                        rounded-xl
                        border border-slate-200
                        bg-slate-50
                        p-5">

                        <div>

                            <h3 class="text-base font-bold text-slate-900">

                                {{ $document->title }}

                            </h3>

                            <p class="mt-2 text-sm text-slate-500">

                                {{ strtoupper($extension) }}

                                •

                                {{ number_format($document->download_count) }}

                                lượt tải

                            </p>

                        </div>

                        <span class="px-4 py-2 rounded-full
                            text-xs font-semibold

                            {{ $document->is_active
                                ? 'bg-emerald-100 text-emerald-700'
                                : 'bg-red-100 text-red-600' }}">

                            {{ $document->is_active
                                ? 'Đang hiển thị'
                                : 'Đã ẩn' }}

                        </span>

                    </div>

                    @empty

                    <p class="text-sm text-slate-500">

                        Chưa có tài liệu nào.

                    </p>

                    @endforelse

                </div>

            </div>

            @endif


            @if($isStudent)

            <!-- STUDENT -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-200">

                    <h2 class="text-lg font-bold text-slate-900">

                        Thông tin học tập

                    </h2>

                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="rounded-xl bg-slate-50 border border-slate-200 p-5">

                        <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">

                            Lượt tải tài liệu

                        </p>

                        <h3 class="mt-3 text-3xl font-extrabold text-slate-900">

                            {{ number_format($totalDownloads) }}

                        </h3>

                    </div>

                    <div class="rounded-xl bg-slate-50 border border-slate-200 p-5">

                        <p class="text-xs uppercase tracking-wider font-semibold text-slate-400">

                            Tài liệu yêu thích

                        </p>

                        <h3 class="mt-3 text-3xl font-extrabold text-slate-900">

                            {{ number_format($totalFavorites) }}

                        </h3>

                    </div>

                </div>

            </div>

            @endif

        </div>
        <!-- RIGHT SIDEBAR -->
        <div class="space-y-6">

            <!-- QUICK ACTION -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-200">

                    <h2 class="text-lg font-bold text-slate-900">

                        Thao tác nhanh

                    </h2>

                    <p class="mt-1 text-sm text-slate-500">

                        Các thao tác quản trị dành cho tài khoản này.

                    </p>

                </div>

                <div class="p-6 space-y-4">

                    <!-- EDIT -->
                    <a href="{{ route('admin.users.edit',$user->user_id) }}" class="w-full inline-flex items-center justify-center gap-3
                        h-12
                        rounded-xl
                        bg-slate-900
                        text-white
                        text-sm
                        font-semibold
                        hover:bg-amber-500
                        transition-all duration-300">

                        <i class="fa-solid fa-pen"></i>

                        Chỉnh sửa người dùng

                    </a>

                    @if($user->user_id != auth()->id())

                    <!-- LOCK -->
                    <form action="{{ route('admin.users.status',$user->user_id) }}" method="POST">

                        @csrf
                        @method('PATCH')

                        <button type="submit" class="w-full inline-flex items-center justify-center gap-3
                            h-12
                            rounded-xl
                            border-2 border-amber-300
                            bg-white
                            text-amber-700
                            text-sm
                            font-semibold
                            hover:bg-amber-500
                            hover:text-white
                            transition-all duration-300">

                            <i class="fa-solid {{ $user->is_active ? 'fa-lock' : 'fa-lock-open' }}"></i>

                            {{ $user->is_active ? 'Khóa tài khoản' : 'Mở khóa tài khoản' }}

                        </button>

                    </form>

                    @if(!$isAdmin)

                    <!-- DELETE -->
                    <form action="{{ route('admin.users.destroy',$user->user_id) }}" method="POST"
                        class="delete-user-form">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="w-full inline-flex items-center justify-center gap-3
                            h-12
                            rounded-xl
                            border-2 border-red-300
                            bg-white
                            text-red-600
                            text-sm
                            font-semibold
                            hover:bg-red-500
                            hover:text-white
                            transition-all duration-300">

                            <i class="fa-solid fa-trash"></i>

                            Xóa người dùng

                        </button>

                    </form>

                    @endif

                    @endif

                </div>

            </div>


            <!-- OTHER STATS -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="px-6 py-5 border-b border-slate-200">

                    <h2 class="text-lg font-bold text-slate-900">

                        Thống kê khác

                    </h2>

                </div>

                <div class="p-6 space-y-5">

                    <div class="flex items-center justify-between">

                        <span class="text-sm font-medium text-slate-500">

                            Nhật ký hoạt động

                        </span>

                        <span class="text-base font-bold text-slate-900">

                            {{ number_format($totalLogs) }}

                        </span>

                    </div>

                    <div class="flex items-center justify-between">

                        <span class="text-sm font-medium text-slate-500">

                            Lượt tìm kiếm

                        </span>

                        <span class="text-base font-bold text-slate-900">

                            {{ number_format($totalSearches) }}

                        </span>

                    </div>

                    <div class="flex items-center justify-between">

                        <span class="text-sm font-medium text-slate-500">

                            Tài liệu yêu thích

                        </span>

                        <span class="text-base font-bold text-slate-900">

                            {{ number_format($totalFavorites) }}

                        </span>

                    </div>

                    <div class="border-t border-slate-200 pt-5">

                        <div class="flex items-center justify-between">

                            <span class="text-sm font-semibold text-slate-500">

                                Trạng thái

                            </span>

                            @if($user->is_active)

                            <span class="px-3 py-1 rounded-full
                                bg-emerald-100
                                text-emerald-700
                                text-xs
                                font-semibold">

                                Hoạt động

                            </span>

                            @else

                            <span class="px-3 py-1 rounded-full
                                bg-red-100
                                text-red-600
                                text-xs
                                font-semibold">

                                Bị khóa

                            </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- DELETE MODAL -->
<div id="delete-user-modal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm px-4">

    <div class="w-full max-w-md overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl">

        <!-- Header -->
        <div class="px-8 pt-8 text-center">

            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-red-100">

                <i class="fa-solid fa-trash-can text-2xl text-red-600"></i>

            </div>

            <h3 class="mt-5 text-2xl font-bold text-slate-900">

                Xóa người dùng?

            </h3>

            <p class="mt-3 text-sm leading-6 text-slate-500">

                Người dùng sẽ được chuyển vào

                <strong class="font-semibold text-slate-700">

                    Thùng rác

                </strong>

                và có thể khôi phục lại sau nếu cần.

            </p>

        </div>

        <!-- Buttons -->
        <div class="mt-8 border-t border-slate-200 px-8 py-6 flex gap-3">

            <button type="button" id="cancel-delete-user" class="flex-1 h-11 rounded-xl
                border border-slate-300
                bg-white
                text-slate-700
                text-sm
                font-semibold
                transition-all duration-300
                hover:bg-slate-100">

                Hủy

            </button>

            <button type="button" id="confirm-delete-user" class="flex-1 h-11 rounded-xl
                bg-red-600
                text-white
                text-sm
                font-semibold
                shadow-sm
                transition-all duration-300
                hover:bg-red-700">

                <i class="fa-solid fa-trash mr-2"></i>

                Xóa

            </button>

        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteModal = document.getElementById('delete-user-modal');
    const cancelDeleteBtn = document.getElementById('cancel-delete-user');
    const confirmDeleteBtn = document.getElementById('confirm-delete-user');

    let deleteForm = null;

    function openDeleteModal(formElement) {
        deleteForm = formElement;
        deleteModal.classList.remove('hidden');
        deleteModal.classList.add('flex');
    }

    function closeDeleteModal() {
        deleteForm = null;
        deleteModal.classList.add('hidden');
        deleteModal.classList.remove('flex');
    }

    document.addEventListener('submit', function(e) {
        const currentDeleteForm = e.target.closest('.delete-user-form');

        if (!currentDeleteForm) {
            return;
        }

        e.preventDefault();
        openDeleteModal(currentDeleteForm);
    });

    cancelDeleteBtn?.addEventListener('click', function() {
        closeDeleteModal();
    });

    confirmDeleteBtn?.addEventListener('click', function() {
        if (deleteForm) {
            deleteForm.submit();
        }
    });

    deleteModal?.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            closeDeleteModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
});
</script>
@endpush