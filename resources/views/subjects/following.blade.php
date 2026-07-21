@extends('layouts.app')

@section('title', 'Môn học theo dõi')

@section('content')

<main class="min-h-screen bg-slate-50">

    {{-- Banner --}}
    <div class="relative h-64 overflow-hidden">

        <img src="{{ asset('img/02.jpg') }}" class="absolute inset-0 w-full h-full object-cover">

        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative h-full flex items-center justify-center">

            <div class="text-center text-white">

                <h1 class="text-5xl font-black italic drop-shadow-lg">
                    Môn học theo dõi
                </h1>

                <p class="mt-3 text-lg text-white/90">
                    Danh sách các môn học bạn đang theo dõi.
                </p>

            </div>

        </div>

    </div>

    {{-- Breadcrumb --}}
    <div class="bg-white border-b">

        <div class="max-w-7xl mx-auto px-6 py-3 text-sm">

            <a href="/" class="text-slate-500 hover:text-slate-900">
                Trang chủ
            </a>

            <span class="mx-2 text-slate-300">/</span>

            <span class="font-semibold text-slate-700">
                Môn học theo dõi
            </span>

        </div>

    </div>

    <div class="max-w-7xl mx-auto px-6 py-10">

        <div class="flex items-center justify-between mb-8">

            <div>

                <h2 class="text-3xl font-black text-slate-900">
                    Môn học theo dõi
                </h2>

                <p class="text-slate-500 mt-2">
                    Bạn đang theo dõi {{ $subjects->count() }} môn học.
                </p>

            </div>

        </div>

        @if($subjects->count())

        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">

            @foreach($subjects as $subject)

            <div
                class="bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-lg transition overflow-hidden">

                <img src="{{ $subject->thumbnail_url }}" class="w-full h-44 object-cover">

                <div class="p-6">

                    <div class="flex items-center gap-3 mb-4">

                        <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center">

                            <i class="{{ $subject->icon ?? 'fa-solid fa-book' }} text-2xl text-amber-500"></i>

                        </div>

                        <div>

                            <h3 class="font-bold text-lg text-slate-800">

                                {{ $subject->subject_name }}

                            </h3>

                            <p class="text-sm text-slate-500">

                                {{ $subject->subject_code }}

                            </p>

                        </div>

                    </div>

                    <p class="text-sm text-slate-600 line-clamp-3 mb-5">

                        {{ $subject->description ?: 'Chưa có mô tả.' }}

                    </p>

                    <div class="flex items-center justify-between">

                        <a href="{{ route('subjects.show',$subject->subject_code) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-500 text-white font-semibold hover:bg-amber-600 transition">

                            <i class="fa-solid fa-eye"></i>

                            Chi tiết

                        </a>

                        <form action="{{ route('subjects.unfollow',$subject->subject_code) }}" method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-red-200 text-red-600 hover:bg-red-50 transition">

                                <i class="fa-solid fa-bell-slash"></i>

                                Bỏ theo dõi

                            </button>

                        </form>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

        @else

        <div class="bg-white rounded-3xl border border-slate-200 p-16 text-center">

            <div class="w-24 h-24 rounded-full bg-slate-100 flex items-center justify-center mx-auto">

                <i class="fa-solid fa-user-check text-4xl text-slate-400"></i>

            </div>

            <h3 class="mt-6 text-2xl font-bold text-slate-800">

                Bạn chưa theo dõi môn học nào

            </h3>

            <p class="mt-3 text-slate-500">

                Hãy theo dõi các môn học để nhận thông báo khi có tài liệu mới.

            </p>

            <a href="{{ route('subjects.index') }}"
                class="inline-flex items-center gap-2 mt-8 px-6 py-3 rounded-xl bg-amber-500 text-white font-bold hover:bg-amber-600 transition">

                <i class="fa-solid fa-book"></i>

                Khám phá môn học

            </a>

        </div>

        @endif

    </div>

</main>

@endsection