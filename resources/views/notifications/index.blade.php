@extends('layouts.app')

@section('title', 'Thông báo')
@section('content')
<style>
.banner-title {

    animation: titleZoom .8s ease;

}

.banner-subtitle {

    animation: titleZoom 1.2s ease;

}

@keyframes titleZoom {

    from {

        opacity: 0;

        transform:
            scale(.85) translateY(20px);

    }

    to {

        opacity: 1;

        transform:
            scale(1) translateY(0);

    }

}
</style>

<main class="min-h-screen bg-white pb-20">
    <!-- HERO BANNER: Khối banner ảnh nền chứa chữ "Giới thiệu" giống hệt image_5ea826.jpg -->
    <div class="relative w-full h-[260px] md:h-[320px] overflow-hidden">
        <!-- Ảnh nền (Đã được thay bằng hình ảnh thư viện học thuật/công nghệ số hiện đại) -->
        <img src="{{ asset('img/02.jpg') }}" alt="Educational Resources Banner"
            class="w-full h-full object-cover opacity-60">

        <!-- Lớp phủ tối (Overlay) để làm nổi bật chữ trắng phía trên giống hình mẫu -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Chữ "Giới thiệu" căn giữa tuyệt đối -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">

            <h1 class="banner-title italic text-5xl font-bold text-white drop-shadow-2xl">
                Thông báo
            </h1>

            <p class="banner-subtitle mt-3 text-white/90 text-lg md:text-xl font-medium max-w-2xl leading-relaxed">
                Theo dõi các thông báo mới từ hệ thống.
            </p>

        </div>
    </div>
    <div class="bg-slate-100 py-3 border-b border-slate-200">

        <div class="max-w-7xl mx-auto px-4 md:px-6 flex items-center text-sm">

            <a href="/" class="text-slate-500 hover:text-slate-900 transition-colors duration-300">

                Trang chủ

            </a>

            <span class="mx-3 text-slate-300">
                /
            </span>

            <span class="font-semibold text-slate-700">

                Thông báo

            </span>

        </div>

    </div>
    <div class="max-w-7xl mx-auto px-6 pt-10 pb-10">

        <!-- ================= HEADER ================= -->
        <div class="flex items-end justify-between mb-8">

            <div>



                <h1 class="mt-2
                    text-3xl
                    font-black
                    tracking-tight
                    text-slate-900">

                    Thông báo

                </h1>

                <p class="mt-2
                    text-sm
                    leading-6
                    text-slate-500">

                    Theo dõi các thông báo mới từ hệ thống.

                </p>

            </div>

            @if($notifications->where('is_read', false)->count())

            <form action="{{ route('notifications.readAll') }}" method="POST">

                @csrf

                <button class="inline-flex
                    items-center
                    gap-2
                    rounded-xl
                    bg-slate-900
                    px-5
                    py-3
                    text-sm
                    font-semibold
                    text-white
                    transition-all
                    duration-300
                    hover:-translate-y-0.5
                    hover:bg-amber-500">

                    <i class="fa-solid fa-check-double"></i>

                    Đánh dấu tất cả đã đọc

                </button>

            </form>

            @endif

        </div>

        <!-- ================= LIST ================= -->

        <div class="overflow-hidden
            rounded-3xl
            border
            border-slate-200
            bg-white
            shadow-sm">

            @forelse($notifications as $notification)
            <a href="{{ route('notifications.read',$notification->notification_id) }}" class="flex
                items-start
                justify-between
                gap-6
                border-b
                border-slate-100
                px-6
                py-5
                transition-all
                duration-300
                hover:bg-slate-50">

                <!-- LEFT -->
                <div class="flex gap-4 flex-1">

                    <!-- ICON -->
                    <div class="flex
                        h-12
                        w-12
                        shrink-0
                        items-center
                        justify-center
                        rounded-2xl
                        border
                        border-slate-200
                        bg-slate-100">

                        <i class="fa-solid fa-bell text-amber-500"></i>

                    </div>

                    <!-- CONTENT -->
                    <div class="flex-1 min-w-0">

                        <div class="flex items-center gap-2">

                            <h3 class="text-base
                                font-bold
                                text-slate-900">

                                {{ $notification->title }}

                            </h3>

                            @if(!$notification->is_read)

                            <span class="inline-block
                                h-2.5
                                w-2.5
                                rounded-full
                                bg-red-500">

                            </span>

                            @endif

                        </div>

                        <p class="mt-2
                            text-sm
                            leading-6
                            text-slate-600">

                            {{ $notification->content }}

                        </p>

                        <p class="mt-3
                            text-xs
                            text-slate-400">

                            <i class="fa-regular fa-clock mr-1"></i>

                            {{ $notification->created_at->format('d/m/Y H:i') }}

                        </p>

                    </div>

                </div>



            </a>

            @empty <div class="py-20 text-center">

                <div class="mx-auto
                    flex
                    h-20
                    w-20
                    items-center
                    justify-center
                    rounded-full
                    bg-slate-100">

                    <i class="fa-regular fa-bell-slash text-3xl text-slate-400"></i>

                </div>

                <h3 class="mt-6 text-lg font-bold text-slate-800">

                    Chưa có thông báo

                </h3>

                <p class="mt-2 text-sm leading-6 text-slate-500">

                    Hiện tại bạn chưa có thông báo nào.

                </p>

            </div>

            @endforelse

        </div>

        <!-- Pagination -->
        @if($notifications->hasPages())

        <div class="mt-8">

            {{ $notifications->links() }}

        </div>

        @endif

    </div>

</main>

@endsection