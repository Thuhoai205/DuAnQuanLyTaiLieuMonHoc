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

<nav
    class="sticky top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-cyan-100 shadow-[0_8px_30px_rgba(8,145,178,0.06)]">
    <div class="max-w-7xl mx-auto px-4 lg:px-6">
        <div class="h-20 flex items-center justify-between">

            <!-- LOGO -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div
                    class="w-12 h-12 rounded-[18px] bg-gradient-to-br from-cyan-400 via-cyan-500 to-sky-600 text-white flex items-center justify-center shadow-lg shadow-cyan-500/25 ring-1 ring-white/10 group-hover:scale-105 transition-all duration-300">
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

            <!-- MAIN MENU -->
            <div class="hidden lg:flex items-center gap-2">
                <a href="{{ route('home') }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-bold transition
                    {{ request()->routeIs('home') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-600 hover:bg-cyan-50 hover:text-cyan-600' }}">
                    <i class="fa-solid fa-house mr-2"></i>
                    Trang chủ
                </a>

                <a href="{{ $facultyUrl }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-bold transition
                    {{ request()->is('faculties*') || request()->is('khoa*') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-600 hover:bg-cyan-50 hover:text-cyan-600' }}">
                    <i class="fa-solid fa-building-columns mr-2"></i>
                    Khoa
                </a>

                <a href="{{ $subjectUrl }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-bold transition
                    {{ request()->is('subjects*') || request()->is('mon-hoc*') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-600 hover:bg-cyan-50 hover:text-cyan-600' }}">
                    <i class="fa-solid fa-book-open mr-2"></i>
                    Môn học
                </a>

                <a href="{{ $documentUrl }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-bold transition
                    {{ request()->is('documents*') || request()->is('tai-lieu*') ? 'bg-cyan-50 text-cyan-600' : 'text-slate-600 hover:bg-cyan-50 hover:text-cyan-600' }}">
                    <i class="fa-solid fa-file-lines mr-2"></i>
                    Tài liệu
                </a>
            </div>

            <!-- RIGHT -->
            <!-- RIGHT -->
            <div class="flex items-center gap-3">

                @auth

                @if($canUploadDocument)
                <a href="{{ route('documents.create') }}"
                    class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-bold shadow-lg shadow-cyan-200 transition">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    Đăng tải
                </a>
                @endif

                <!-- Notification -->
                <a href="{{ route('notifications.index') }}" class="relative flex items-center justify-center
            w-12 h-12 rounded-2xl bg-white border border-gray-200
            shadow hover:shadow-md transition">

                    <i class="fa-regular fa-bell text-[22px] text-gray-500"></i>

                    @if($unreadNotifications > 0)
                    <span class="absolute -bottom-1 -right-1 w-4 h-4 bg-red-500 rounded-full border-2 border-white">
                    </span>
                    @endif

                </a>

                <!-- USER -->
                <div class="relative group">

                    <div
                        class="flex items-center gap-3 cursor-pointer bg-slate-50 hover:bg-cyan-50 border border-slate-100 rounded-2xl px-3 py-2 transition-all">

                        <img src="{{ $currentUser->avatar ? asset('storage/'.$currentUser->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($currentUser->full_name).'&background=06b6d4&color=fff' }}"
                            class="w-10 h-10 rounded-full object-cover border-2 border-white shadow">

                        <div class="hidden sm:block leading-tight">

                            <p class="text-sm font-black text-slate-800">
                                {{ $currentUser->full_name }}
                            </p>

                            <p class="text-xs font-bold text-cyan-600">
                                {{ $roleName }}
                            </p>

                        </div>

                        <i class="fa-solid fa-chevron-down text-xs text-slate-400"></i>

                    </div>

                    <!-- MENU -->
                    <div
                        class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 overflow-hidden">

                        <div class="px-5 py-4 bg-cyan-50">

                            <p class="font-black text-slate-800">
                                {{ $currentUser->full_name }}
                            </p>

                            <p class="text-xs text-cyan-600">
                                {{ $roleName }}
                            </p>

                        </div>

                        <a href="{{ route('profile') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-cyan-50">
                            <i class="fa-solid fa-user w-4"></i>
                            Hồ sơ cá nhân
                        </a>

                        @if($canUploadDocument && Route::has('documents.my-documents'))
                        <a href="{{ route('documents.my-documents') }}"
                            class="flex items-center gap-3 px-5 py-3 hover:bg-cyan-50">
                            <i class="fa-solid fa-folder-open w-4"></i>
                            Học liệu của tôi
                        </a>
                        @endif

                        @if($roleId==1)
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-3 px-5 py-3 hover:bg-cyan-50">
                            <i class="fa-solid fa-shield-halved w-4"></i>
                            Admin Panel
                        </a>
                        @endif

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button class="w-full flex items-center gap-3 px-5 py-3 text-red-500 hover:bg-red-50">

                                <i class="fa-solid fa-right-from-bracket w-4"></i>

                                Đăng xuất

                            </button>

                        </form>

                    </div>

                </div>

                @else

                <a href="{{ route('login') }}"
                    class="px-5 py-2.5 rounded-xl border border-cyan-100 text-cyan-600 text-sm font-bold hover:bg-cyan-50 transition">

                    Đăng nhập

                </a>

                @if(Route::has('register'))

                <a href="{{ route('register') }}"
                    class="hidden sm:inline-flex px-5 py-2.5 rounded-xl bg-cyan-500 text-white text-sm font-bold hover:bg-cyan-600 shadow-lg shadow-cyan-200 transition">

                    Đăng ký

                </a>

                @endif

                @endauth

            </div>
        </div>
    </div>
</nav>