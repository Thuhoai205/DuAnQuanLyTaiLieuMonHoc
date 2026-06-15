@php
use App\Models\ActivityLog;

$notificationCount = ActivityLog::whereDate('created_at', today())->count();

$notifications = ActivityLog::with('user')
->orderByDesc('created_at')
->take(5)
->get();
@endphp

<div class="relative" id="adminNotificationWrapper">
    <button type="button" id="adminNotificationButton"
        class="relative w-12 h-12 rounded-2xl bg-white border border-cyan-100 text-slate-600 hover:bg-cyan-50 hover:text-cyan-600 flex items-center justify-center shadow-sm transition">

        <i class="fa-solid fa-bell text-lg"></i>

        @if($notificationCount > 0)
        <span
            class="absolute -top-1 -right-1 min-w-[22px] h-[22px] px-1 rounded-full bg-red-500 text-white text-[11px] font-black flex items-center justify-center border-2 border-white">
            {{ $notificationCount > 10 ? '10+' : $notificationCount }}
        </span>
        @endif
    </button>

    <div id="adminNotificationDropdown"
        class="hidden absolute right-0 mt-4 w-[380px] bg-white rounded-[28px] border border-cyan-100 shadow-2xl shadow-cyan-100/60 overflow-hidden z-50">

        <div
            class="px-5 py-4 bg-gradient-to-r from-cyan-50 to-sky-50 border-b border-cyan-100 flex items-center justify-between">
            <div>
                <h3 class="font-black text-slate-900">
                    Hoạt động gần đây
                </h3>

                <p class="text-xs font-semibold text-slate-500 mt-1">
                    {{ number_format($notificationCount) }} hoạt động hôm nay
                </p>
            </div>

            <div class="w-11 h-11 rounded-2xl bg-cyan-500 text-white flex items-center justify-center">
                <i class="fa-solid fa-bell"></i>
            </div>
        </div>

        <div class="max-h-[360px] overflow-y-auto">
            @forelse($notifications as $notification)
            @php
            if ($notification->login_at && !$notification->logout_at) {
            $icon = 'fa-solid fa-right-to-bracket';
            $iconClass = 'bg-emerald-50 text-emerald-600 border-emerald-100';
            $actionText = 'Đăng nhập';
            $time = $notification->login_at;
            } elseif ($notification->logout_at && !$notification->login_at) {
            $icon = 'fa-solid fa-right-from-bracket';
            $iconClass = 'bg-orange-50 text-orange-600 border-orange-100';
            $actionText = 'Đăng xuất';
            $time = $notification->logout_at;
            } else {
            $icon = 'fa-solid fa-circle-info';
            $iconClass = 'bg-slate-50 text-slate-600 border-slate-100';
            $actionText = 'Hoạt động';
            $time = $notification->created_at;
            }

            $userName = $notification->user->full_name ?? 'Hệ thống';
            $description = $notification->description ?? 'Có hoạt động mới trong hệ thống.';
            @endphp

            <a href="{{ route('admin.logs.index') }}"
                class="block px-5 py-4 border-b border-slate-100 hover:bg-cyan-50/60 transition">

                <div class="flex gap-4">
                    <div
                        class="w-11 h-11 rounded-2xl border flex items-center justify-center shrink-0 {{ $iconClass }}">
                        <i class="{{ $icon }}"></i>
                    </div>

                    <div class="min-w-0 flex-1">
                        <div class="flex items-center justify-between gap-3">
                            <p class="font-black text-slate-800 truncate">
                                {{ $actionText }}
                            </p>
                        </div>

                        <p class="text-sm font-semibold text-slate-600 mt-1 line-clamp-2">
                            {{ $userName }} - {{ $description }}
                        </p>

                        <p class="text-xs font-bold text-slate-400 mt-2">
                            @if($time)
                            {{ \Carbon\Carbon::parse($time)->diffForHumans() }}
                            @else
                            Không rõ thời gian
                            @endif
                        </p>
                    </div>
                </div>
            </a>
            @empty
            <div class="px-5 py-10 text-center">
                <div
                    class="w-16 h-16 mx-auto rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-4">
                    <i class="fa-solid fa-bell-slash text-2xl"></i>
                </div>

                <h4 class="font-black text-slate-800">
                    Chưa có hoạt động
                </h4>

                <p class="text-sm font-semibold text-slate-500 mt-2">
                    Các hoạt động đăng nhập và đăng xuất sẽ hiển thị tại đây.
                </p>
            </div>
            @endforelse
        </div>

        <div class="px-5 py-4 bg-slate-50 border-t border-cyan-100 flex items-center justify-between gap-3">
            <a href="{{ route('admin.logs.index') }}"
                class="text-sm font-black text-cyan-700 hover:text-cyan-800 transition">
                Xem tất cả
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('adminNotificationButton');
    const dropdown = document.getElementById('adminNotificationDropdown');
    const wrapper = document.getElementById('adminNotificationWrapper');

    if (!button || !dropdown || !wrapper) {
        return;
    }

    button.addEventListener('click', function(event) {
        event.stopPropagation();
        dropdown.classList.toggle('hidden');
    });

    dropdown.addEventListener('click', function(event) {
        event.stopPropagation();
    });

    document.addEventListener('click', function() {
        dropdown.classList.add('hidden');
    });
});
</script>