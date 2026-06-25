@extends('layouts.app')

@section('title', 'Thông báo')

@section('content')

<main class="min-h-screen bg-[#EAFBFF] py-10">

    <div class="max-w-5xl mx-auto px-6">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8">

            <div>
                <h1 class="text-4xl font-black text-slate-800">
                    Thông báo
                </h1>

                <p class="text-slate-500 mt-2">
                    Các thông báo mới từ hệ thống
                </p>
            </div>

            @if($notifications->where('is_read', false)->count())
            <form action="{{ route('notifications.readAll') }}" method="POST">
                @csrf

                <button
                    class="px-5 py-3 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-bold shadow-lg shadow-cyan-200 transition">

                    <i class="fa-solid fa-check-double mr-2"></i>

                    Đánh dấu tất cả đã đọc

                </button>

            </form>
            @endif

        </div>

        <!-- Danh sách -->

        <div class="bg-white rounded-3xl shadow-lg border border-cyan-100 overflow-hidden">

            @forelse($notifications as $notification)

            <div class="p-6 border-b border-cyan-100 hover:bg-cyan-50 transition flex justify-between items-start">

                <div class="flex gap-4">

                    <div class="w-12 h-12 rounded-2xl bg-cyan-100 text-cyan-600 flex items-center justify-center">

                        <i class="fa-solid fa-bell"></i>

                    </div>

                    <div>

                        <h3 class="font-black text-slate-800">

                            {{ $notification->title }}

                            @if(!$notification->is_read)
                            <span class="ml-2 inline-block w-2.5 h-2.5 rounded-full bg-red-500"></span>
                            @endif

                        </h3>

                        <p class="text-slate-600 mt-2">

                            {{ $notification->content }}

                        </p>

                        <p class="text-sm text-slate-400 mt-3">

                            {{ $notification->created_at->format('d/m/Y H:i') }}

                        </p>

                    </div>

                </div>

                @if(!$notification->is_read)

                <form action="{{ route('notifications.read',$notification->notification_id) }}" method="POST">

                    @csrf

                    <button
                        class="px-4 py-2 rounded-xl border border-cyan-200 text-cyan-600 hover:bg-cyan-500 hover:text-white transition">

                        Đã đọc

                    </button>

                </form>

                @endif

            </div>

            @empty

            <div class="py-24 text-center">

                <i class="fa-regular fa-bell-slash text-6xl text-slate-300"></i>

                <h3 class="mt-5 text-2xl font-black text-slate-700">

                    Chưa có thông báo

                </h3>

                <p class="text-slate-500 mt-2">

                    Hiện tại bạn chưa có thông báo nào.

                </p>

            </div>

            @endforelse

        </div>

        <div class="mt-8">

            {{ $notifications->links() }}

        </div>

    </div>

</main>

@endsection