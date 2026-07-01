@php
$currentUser = auth()->user();
$roleId = $currentUser?->role_id;

$roleName = match ($roleId) {
1 => 'Quản trị viên',
2 => 'Giảng viên',
3 => 'Sinh viên',
default => 'Người dùng',
};

$canUploadDocument = in_array($roleId, [1, 2]);

$facultyUrl = \Illuminate\Support\Facades\Route::has('faculties.index')
? route('faculties.index')
: url('/faculties');

$subjectUrl = \Illuminate\Support\Facades\Route::has('subjects.index')
? route('subjects.index')
: url('/subjects');

$documentUrl = \Illuminate\Support\Facades\Route::has('documents.index')
? route('documents.index')
: url('/documents');

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

$unreadNotifications = 0;

if (Auth::check()) {
$unreadNotifications = Notification::where('user_id', Auth::id())
->where('is_read', false)
->count();
}
@endphp

<!-- BƯỚC NHÚNG FONT TỪ GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

<!-- CẬP NHẬT CLASS CHỮ THEO ĐÚNG ĐỊNH DẠNG IMAGE_B9C7E4.PNG: font-['Roboto',_sans-serif] -->
<nav
    class="sticky top-0 z-50 bg-white/25 backdrop-blur-md border-b border-white/20 shadow-[0_8px_30px_rgba(0,0,0,0.03)] font-['Roboto',_sans-serif]">
    <div class="max-w-7xl mx-auto px-4 lg:px-6">

        <div class="h-20 flex items-center">

            {{-- ================= LOGO ================= --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group flex-shrink-0">

                <div class="w-12 h-12 rounded-[18px]
                    bg-gradient-to-br
                    from-cyan-400 via-cyan-500 to-sky-600
                    text-white
                    flex items-center justify-center
                    shadow-lg shadow-cyan-500/25
                    ring-1 ring-white/10
                    group-hover:scale-105
                    transition-all duration-300">

                    <i class="fa-solid fa-graduation-cap text-xl"></i>

                </div>

                <div class="leading-tight">

                    <h1 class="text-2xl font-black tracking-tight">

                        <span class="text-slate-900">EDU</span><span class="text-cyan-600">DOC</span>

                    </h1>

                    <p class="text-[10px] font-bold uppercase tracking-[0.25em] text-slate-400">

                        Learning Resources

                    </p>

                </div>

            </a>

            {{-- ================= MENU ================= --}}
            <div class="hidden lg:flex items-center flex-1 ml-10">

                <a href="{{ route('home') }}" class="px-4 py-2.5 rounded-xl text-sm font-normal transition
    {{ request()->routeIs('home')
        ? 'bg-cyan-50 text-cyan-600'
        : 'text-slate-600 hover:bg-cyan-50 hover:text-cyan-600' }}">

                    <i class="fa-solid fa-house mr-2"></i>

                    Trang chủ

                </a>

                <a href="{{ $facultyUrl }}" class="ml-1 px-4 py-2.5 rounded-xl text-sm font-normal transition
                    {{ request()->is('faculties*') || request()->is('khoa*')
                        ? 'bg-cyan-50 text-cyan-600'
                        : 'text-slate-600 hover:bg-cyan-50 hover:text-cyan-600' }}">

                    <i class="fa-solid fa-building-columns mr-2"></i>

                    Khoa

                </a>

                <a href="{{ $subjectUrl }}" class="ml-1 px-4 py-2.5 rounded-xl text-sm font-normal transition
                    {{ request()->is('subjects*') || request()->is('mon-hoc*')
                        ? 'bg-cyan-50 text-cyan-600'
                        : 'text-slate-600 hover:bg-cyan-50 hover:text-cyan-600' }}">

                    <i class="fa-solid fa-book-open mr-2"></i>

                    Môn học

                </a>

                <a href="{{ $documentUrl }}" class="ml-1 px-4 py-2.5 rounded-xl text-sm font-normal transition
                    {{ request()->is('documents*') || request()->is('tai-lieu*')
                        ? 'bg-cyan-50 text-cyan-600'
                        : 'text-slate-600 hover:bg-cyan-50 hover:text-cyan-600' }}">

                    <i class="fa-solid fa-file-lines mr-2"></i>

                    Tài liệu

                </a>

                {{-- Phần 2 sẽ bắt đầu từ đây --}}
                <div class="ml-auto flex items-center gap-3">
                    @auth

                    {{-- NÚT ĐĂNG TẢI --}}
                    @if($canUploadDocument)


                    <a href="{{ route('documents.create') }}" class="hidden md:inline-flex items-center gap-2
    h-11 px-5
    rounded-xl
    bg-amber-500
    hover:bg-amber-600
    text-white
    text-sm
    font-normal
    shadow-lg shadow-amber-200
    transition">

                        <i class="fa-solid fa-cloud-arrow-up"></i>

                        <span>Đăng tải</span>

                    </a>

                    @endif


                    {{-- THÔNG BÁO --}}
                    @if(auth()->user()->role->role_name === 'lecturer')

                    <a href="{{ route('notifications.index') }}" class="relative flex items-center justify-center
    w-11 h-11
    rounded-xl
    border border-slate-200
    bg-white
    hover:bg-cyan-50
    hover:border-cyan-200
    transition">

                        <i class="fa-regular fa-bell text-xl text-slate-600"></i>

                        @if($unreadNotifications > 0)

                        <span class="absolute top-2 right-2
        w-2.5 h-2.5
        rounded-full
        bg-red-500
        ring-2 ring-white">
                        </span>

                        @endif

                    </a>

                    @endif


                    {{-- USER --}}
                    <div class="relative group">

                        <button class="flex items-center gap-3
        pl-2 pr-3 py-2
        rounded-2xl
        border border-slate-200
        bg-white
        hover:bg-cyan-50
        transition">

                            <img src="{{ $currentUser->avatar
                    ? asset('storage/'.$currentUser->avatar)
                    : 'https://ui-avatars.com/api/?name='.urlencode($currentUser->full_name).'&background=06b6d4&color=fff' }}"
                                class="w-10 h-10 rounded-full object-cover border border-slate-200">

                            <div class="hidden lg:block text-left leading-tight">

                                <p class="text-sm font-black text-slate-800">

                                    {{ $currentUser->full_name }}

                                </p>

                                <p class="text-xs font-normal text-cyan-600">

                                    {{ $roleName }}

                                </p>

                            </div>

                            <i class="fa-solid fa-chevron-down text-xs text-slate-400"></i>

                        </button>

                        <div class="absolute right-0 mt-3 w-64
                            bg-white
                            rounded-2xl
                            shadow-xl
                            border border-slate-200
                            overflow-hidden
                            opacity-0 invisible
                            group-hover:opacity-100
                            group-hover:visible
                            transition-all
                            z-50
                            text-sm">



                            <!-- PROFILE -->
                            <a href="{{ route('profile') }}"
                                class="flex items-center gap-3 px-5 py-3 hover:bg-cyan-50 font-medium text-slate-700 text-sm transition">

                                <i class="fa-solid fa-user w-5 text-sky-500 text-base"></i>

                                Hồ sơ cá nhân

                            </a>

                            <!-- MY DOCUMENT -->
                            @if($canUploadDocument && Route::has('documents.my-documents'))

                            <a href="{{ route('documents.my-documents') }}"
                                class="flex items-center gap-3 px-5 py-3 hover:bg-cyan-50 font-medium text-slate-700 text-sm transition">

                                <i class="fa-solid fa-folder-open w-5 text-cyan-500 text-base"></i>

                                Học liệu của tôi

                            </a>

                            @endif

                            <!-- ADMIN -->
                            @if($roleId == 1)

                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center gap-3 px-5 py-3 hover:bg-cyan-50 font-medium text-slate-700 text-sm transition">

                                <i class="fa-solid fa-shield-halved w-5 text-indigo-500 text-base"></i>

                                Admin Panel

                            </a>

                            @endif

                            <div class="border-t border-slate-100"></div>

                            <!-- LOGOUT -->
                            <form action="{{ route('logout') }}" method="POST">

                                @csrf

                                <button type="submit" class="w-full flex items-center gap-3 px-5 py-3
            text-red-500
            font-medium
            text-sm
            hover:bg-red-50
            transition">

                                    <i class="fa-solid fa-right-from-bracket w-5 text-base"></i>

                                    Đăng xuất

                                </button>

                            </form>

                        </div>

                    </div>

                    @endauth


                    @guest
                    <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-xl
    border border-slate-200
    text-slate-600
    text-sm
    font-bold
    hover:border-amber-500
    hover:text-amber-500
    hover:bg-amber-50/50
    transition-all duration-300">
                        Đăng nhập
                    </a>

                    @if(Route::has('register'))

                    <a href="{{ route('register') }}" class="hidden sm:inline-flex
    items-center
    px-5 py-2.5
    rounded-xl
    bg-amber-500
    text-white
    text-sm
    font-bold
    hover:bg-amber-600
    shadow-lg shadow-amber-500/20
    transition-all duration-300">

                        Đăng ký

                    </a>

                    @endif

                    @endguest

                </div>

            </div>

        </div>

    </div>

</nav>