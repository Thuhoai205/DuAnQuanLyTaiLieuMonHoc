@php
use App\Models\ActivityLog;

$notificationCount = ActivityLog::whereDate('created_at', today())->count();

$notifications = ActivityLog::with('user')
->latest()
->take(5)
->get();
@endphp

<div class="relative" id="adminNotificationWrapper">

    {{-- BUTTON --}}
    <button type="button" id="adminNotificationButton" class="relative
        w-12
        h-12
        rounded-2xl
        border
        border-slate-200
        bg-white
        text-slate-600
        shadow-sm
        flex
        items-center
        justify-center
        hover:bg-amber-50
        hover:text-amber-500
        transition-all
        duration-300">

        <i class="fa-solid fa-bell text-lg"></i>

        @if($notificationCount > 0)

        <span class="absolute
            -top-1
            -right-1
            flex
            h-5
            min-w-[20px]
            items-center
            justify-center
            rounded-full
            bg-rose-500
            px-1
            text-[10px]
            font-bold
            text-white">

            {{ $notificationCount > 99 ? '99+' : $notificationCount }}

        </span>

        @endif

    </button>

    {{-- DROPDOWN --}}
    <div id="adminNotificationDropdown" class="hidden
        absolute
        right-0
        mt-3
        w-[400px]
        rounded-2xl
        border
        border-slate-200
        bg-white
        shadow-2xl
        overflow-hidden
        z-[9999]">

        {{-- HEADER --}}
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

            <div class="flex items-center justify-between">

                <div>

                    <h3 class="text-base font-black text-slate-800">

                        Thông báo hệ thống

                    </h3>

                    <p class="mt-1 text-sm text-slate-500">

                        Có

                        <span class="font-bold text-amber-500">

                            {{ number_format($notificationCount) }}

                        </span>

                        hoạt động mới hôm nay

                    </p>

                </div>

                <div class="w-11
                    h-11
                    rounded-xl
                    bg-amber-500
                    text-white
                    flex
                    items-center
                    justify-center">

                    <i class="fa-solid fa-bell"></i>

                </div>

            </div>

        </div>

        {{-- LIST --}}
        <div class="max-h-[420px] overflow-y-auto">
            @forelse($notifications as $notification)

            @php

            $userName = $notification->user->full_name ?? 'Hệ thống';

            if ($notification->login_at && !$notification->logout_at) {

            $icon = 'fa-right-to-bracket';
            $color = 'bg-emerald-50 text-emerald-600 border-emerald-100';
            $label = 'Đăng nhập';
            $time = $notification->login_at;

            } elseif ($notification->logout_at) {

            $icon = 'fa-right-from-bracket';
            $color = 'bg-orange-50 text-orange-600 border-orange-100';
            $label = 'Đăng xuất';
            $time = $notification->logout_at;

            } else {

            $icon = 'fa-circle-info';
            $color = 'bg-amber-50 text-amber-500 border-amber-100';
            $label = 'Hoạt động';
            $time = $notification->created_at;

            }

            @endphp

            <a href="{{ route('admin.logs.index') }}" class="flex
    gap-4
    px-6
    py-5
    border-b
    border-slate-100
    hover:bg-amber-50/40
    transition-all
    duration-300">

                {{-- ICON --}}
                <div class="w-11
        h-11
        rounded-xl
        border
        flex
        items-center
        justify-center
        shrink-0
        {{ $color }}">

                    <i class="fa-solid {{ $icon }}"></i>

                </div>

                {{-- CONTENT --}}
                <div class="flex-1 min-w-0">

                    <div class="flex items-center justify-between gap-3">

                        <h4 class="text-sm font-black text-slate-800">

                            {{ $label }}

                        </h4>

                        <span class="text-[11px] font-semibold text-slate-400 whitespace-nowrap">

                            {{ $time ? \Carbon\Carbon::parse($time)->diffForHumans() : '' }}

                        </span>

                    </div>

                    <p class="mt-2 text-sm text-slate-600 leading-6">

                        <span class="font-bold text-slate-800">

                            {{ $userName }}

                        </span>

                        <span class="mx-1 text-slate-300">•</span>

                        {{ $notification->description ?? 'Không có mô tả.' }}

                    </p>

                    <div class="mt-3 flex items-center gap-2">

                        <span class="inline-flex
                items-center
                rounded-full
                bg-slate-100
                px-3
                py-1
                text-[11px]
                font-semibold
                text-slate-600">

                            <i class="fa-solid fa-clock mr-1"></i>

                            {{ $time
                    ? \Carbon\Carbon::parse($time)->format('d/m/Y H:i')
                    : '--/--/----' }}

                        </span>

                        @if($notification->ip_address)

                        <span class="inline-flex
                items-center
                rounded-full
                bg-slate-100
                px-3
                py-1
                text-[11px]
                font-semibold
                text-slate-600">

                            <i class="fa-solid fa-globe mr-1"></i>

                            {{ $notification->ip_address }}

                        </span>

                        @endif

                    </div>

                </div>

            </a>

            @empty

            <div class="px-6 py-16 text-center">

                <!-- ICON -->
                <div class="w-20
        h-20
        mx-auto
        rounded-full
        bg-amber-50
        flex
        items-center
        justify-center">

                    <i class="fa-solid fa-bell-slash text-3xl text-amber-400"></i>

                </div>

                <!-- TITLE -->
                <h3 class="mt-5 text-lg font-black text-slate-800">

                    Chưa có thông báo

                </h3>

                <!-- DESCRIPTION -->
                <p class="mt-2 text-sm font-medium text-slate-500">

                    Hiện tại chưa có hoạt động nào được ghi nhận.

                </p>

            </div>

            @endforelse

        </div>

        {{-- FOOTER --}}
        <div class="px-6
    py-4
    border-t
    border-slate-200
    bg-slate-50">

            <a href="{{ route('admin.logs.index') }}" class="group
        flex
        items-center
        justify-center
        gap-2
        rounded-xl
        border
        border-slate-200
        bg-white
        px-4
        py-3
        text-sm
        font-bold
        text-slate-700
        hover:border-amber-500
        hover:bg-amber-50
        hover:text-amber-600
        transition-all
        duration-300">

                <i class="fa-solid fa-list"></i>

                Xem toàn bộ nhật ký

                <i
                    class="fa-solid fa-arrow-right text-xs transition-transform duration-300 group-hover:translate-x-1"></i>

            </a>

        </div>

    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function() {

    const wrapper = document.getElementById('adminNotificationWrapper');
    const button = document.getElementById('adminNotificationButton');
    const dropdown = document.getElementById('adminNotificationDropdown');

    if (!wrapper || !button || !dropdown) return;

    //==============================
    // OPEN / CLOSE
    //==============================
    function openDropdown() {

        dropdown.classList.remove('hidden');

        requestAnimationFrame(() => {

            dropdown.classList.remove('opacity-0', 'scale-95');
            dropdown.classList.add('opacity-100', 'scale-100');

        });

    }

    function closeDropdown() {

        dropdown.classList.remove('opacity-100', 'scale-100');
        dropdown.classList.add('opacity-0', 'scale-95');

        setTimeout(() => {

            dropdown.classList.add('hidden');

        }, 150);

    }

    function toggleDropdown() {

        if (dropdown.classList.contains('hidden')) {

            openDropdown();

        } else {

            closeDropdown();

        }

    }

    //==============================
    // INIT
    //==============================
    dropdown.classList.add(
        'transition-all',
        'duration-150',
        'origin-top-right',
        'opacity-0',
        'scale-95'
    );

    //==============================
    // BUTTON
    //==============================
    button.addEventListener('click', function(e) {

        e.stopPropagation();

        toggleDropdown();

    });

    //==============================
    // CLICK INSIDE
    //==============================
    dropdown.addEventListener('click', function(e) {

        e.stopPropagation();

    });

    //==============================
    // CLICK OUTSIDE
    //==============================
    document.addEventListener('click', function() {

        if (!dropdown.classList.contains('hidden')) {

            closeDropdown();

        }

    });

    //==============================
    // ESC KEY
    //==============================
    document.addEventListener('keydown', function(e) {

        if (e.key === 'Escape') {

            closeDropdown();

        }

    });

});
</script>