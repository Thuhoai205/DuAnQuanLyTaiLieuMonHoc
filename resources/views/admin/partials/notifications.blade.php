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
    <button type="button" id="adminNotificationButton" class="relative w-12 h-12 rounded-2xl bg-white border border-slate-200 text-slate-600
        hover:bg-cyan-50 hover:text-cyan-600 flex items-center justify-center shadow-sm transition">

        <i class="fa-solid fa-bell text-lg"></i>

        @if($notificationCount > 0)
        <span class="absolute bottom-0 right-0 translate-x-1 translate-y-1 flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
        </span>
        @endif
    </button>

    {{-- DROPDOWN --}}
    <div id="adminNotificationDropdown" class="hidden absolute right-0 mt-3 w-[380px] bg-white rounded-2xl border border-slate-200
        shadow-xl z-[9999] overflow-hidden">

        {{-- HEADER --}}
        <div class="px-5 py-4 bg-slate-50 border-b flex items-center justify-between">

            <div>
                <h3 class="font-black text-slate-800">
                    Thông báo
                </h3>

                <p class="text-xs text-slate-500 font-semibold mt-1">
                    {{ number_format($notificationCount) }} hoạt động hôm nay
                </p>
            </div>

            <div class="w-10 h-10 rounded-xl bg-cyan-500 text-white flex items-center justify-center">
                <i class="fa-solid fa-bell"></i>
            </div>

        </div>

        {{-- LIST --}}
        <div class="max-h-[360px] overflow-y-auto">

            @forelse($notifications as $notification)

            @php
            $userName = $notification->user->full_name ?? 'Hệ thống';

            // FIX LOGIC
            if ($notification->login_at && !$notification->logout_at) {
            $icon = 'fa-right-to-bracket';
            $color = 'bg-emerald-50 text-emerald-600 border-emerald-100';
            $label = 'Đăng nhập';
            $time = $notification->login_at;
            }
            elseif ($notification->logout_at && !$notification->login_at) {
            $icon = 'fa-right-from-bracket';
            $color = 'bg-orange-50 text-orange-600 border-orange-100';
            $label = 'Đăng xuất';
            $time = $notification->logout_at;
            }
            else {
            $icon = 'fa-circle-info';
            $color = 'bg-slate-50 text-slate-600 border-slate-100';
            $label = 'Hoạt động';
            $time = $notification->created_at;
            }
            @endphp

            <a href="{{ route('admin.logs.index') }}"
                class="flex gap-4 px-5 py-4 border-b hover:bg-cyan-50/40 transition">

                {{-- ICON --}}
                <div class="w-10 h-10 rounded-xl border flex items-center justify-center shrink-0 {{ $color }}">
                    <i class="fa-solid {{ $icon }}"></i>
                </div>

                {{-- CONTENT --}}
                <div class="flex-1 min-w-0">

                    <div class="flex items-center justify-between">
                        <p class="font-black text-slate-800 text-sm">
                            {{ $label }}
                        </p>
                    </div>

                    <p class="text-sm text-slate-600 font-semibold mt-1 truncate">
                        {{ $userName }} - {{ $notification->description ?? 'Không có mô tả' }}
                    </p>

                    <p class="text-xs text-slate-400 mt-2 font-bold">
                        {{ $time ? \Carbon\Carbon::parse($time)->diffForHumans() : 'Không rõ thời gian' }}
                    </p>

                </div>

            </a>

            @empty

            <div class="px-5 py-10 text-center">

                <div
                    class="w-14 h-14 mx-auto rounded-xl bg-slate-50 text-slate-400 flex items-center justify-center mb-3">
                    <i class="fa-solid fa-bell-slash"></i>
                </div>

                <p class="font-black text-slate-700">Chưa có thông báo</p>
                <p class="text-sm text-slate-500 mt-1">
                    Hoạt động hệ thống sẽ hiển thị tại đây
                </p>

            </div>

            @endforelse

        </div>

        {{-- FOOTER --}}
        <div class="px-5 py-3 bg-slate-50 border-t text-center">

            <a href="{{ route('admin.logs.index') }}" class="text-sm font-black text-cyan-600 hover:text-cyan-700">
                Xem tất cả
            </a>

        </div>

    </div>
</div>

{{-- SCRIPT FIX --}}
<script>
document.addEventListener('DOMContentLoaded', function() {

    const btn = document.getElementById('adminNotificationButton');
    const dropdown = document.getElementById('adminNotificationDropdown');

    if (!btn || !dropdown) return;

    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', function() {
        dropdown.classList.add('hidden');
    });

    dropdown.addEventListener('click', function(e) {
        e.stopPropagation();
    });

});
</script>