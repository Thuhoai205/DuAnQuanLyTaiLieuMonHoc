@extends('layouts.app')

@section('title', 'Danh mục Khoa')

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
<main class="min-h-screen ">
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
                Khoa
            </h1>

            <p class="banner-subtitle mt-3 text-white/90 text-lg md:text-xl font-medium max-w-2xl leading-relaxed">
                Khám phá các khoa đào tạo, xem danh sách môn học và tài liệu học tập.
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

                Danh mục Khoa

            </span>

        </div>

    </div>

    <section class="max-w-7xl mx-auto px-6 pt-10 pb-10">
        <!-- ================= HEADER ================= -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 mb-12">

            <div class="flex items-center gap-4">

                <div class="flex h-14 w-14 items-center justify-center
        rounded-2xl
        border border-slate-200
        bg-slate-100
        transition-all duration-300
        hover:border-amber-300
        hover:bg-amber-50">

                    <i class="fa-solid fa-building-columns text-2xl text-amber-500"></i>

                </div>

                <div>

                    <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                        Danh mục Khoa
                    </h1>

                    <p class="mt-2 max-w-2xl text-sm leading-7 text-slate-500">
                        Khám phá các khoa đào tạo, xem danh sách môn học và tài liệu học tập được quản lý trong hệ
                        thống.
                    </p>

                </div>

            </div>
            <!-- Search -->
            <div class="w-full lg:w-80">

                <div class="relative">

                    <div class="absolute inset-y-0 left-5 flex items-center">

                        <i class="fa-solid fa-magnifying-glass text-amber-500 text-lg"></i>

                    </div>

                    <input id="facultySearch" type="text" onkeyup="searchFaculties()" placeholder="Tìm kiếm khoa..."
                        class="w-full
        rounded-2xl
        border
        border-slate-200
        py-4
        pl-14
        pr-5
        text-slate-700
        placeholder:text-slate-400
        focus:border-amber-400
        focus:ring-4
        focus:ring-amber-100">

                </div>

            </div>

        </div>



        <div id="facultyGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($faculties as $faculty)

            @php
            $documentCount = $faculty->documents_count ?? $faculty->subjects->sum('documents_count');
            @endphp
            <div class="faculty-card" data-name="{{ strtolower($faculty->faculty_name) }}"
                data-code="{{ strtolower($faculty->faculty_code) }}">

                <div class="group h-full rounded-3xl border border-slate-200 bg-white
                    hover:border-amber-300 hover:shadow-xl hover:-translate-y-1
                    transition-all duration-300 overflow-hidden">

                    <!-- TOP -->
                    <div class="h-1 bg-amber-500"></div>
                    <div class="p-6 flex flex-col h-full">

                        <!-- Header -->
                        <div class="flex items-start justify-between">

                            <div class="w-12 h-12 rounded-2xl
    bg-white
    border border-slate-200
    shadow-sm
    flex items-center justify-center">

                                <i class="fa-solid fa-building-columns text-slate-700 text-xl"></i>

                            </div>
                            @if($faculty->is_active)

                            <span class="inline-flex items-center gap-1.5
                    rounded-full bg-emerald-50
                    px-2.5 py-1
                    text-[10px] font-semibold text-emerald-600">

                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                                Hoạt động

                            </span>

                            @else

                            <span class="inline-flex items-center gap-1.5
                    rounded-full bg-red-50
                    px-2.5 py-1
                    text-[10px] font-semibold text-red-500">

                                <span class="w-2 h-2 rounded-full bg-red-500"></span>

                                Không hoạt động

                            </span>

                            @endif

                        </div>

                        <!-- CODE -->
                        <span class="mt-5 inline-flex w-fit rounded-lg bg-slate-100
                px-3 py-1 text-[10px]
                font-bold tracking-wider uppercase
                text-slate-600">

                            {{ $faculty->faculty_code }}

                        </span>

                        <!-- NAME -->
                        <h3 class="mt-4 text-xl font-bold text-slate-900
                leading-snug line-clamp-2
                group-hover:text-amber-600 transition">

                            {{ $faculty->faculty_name }}

                        </h3>

                        <!-- DESCRIPTION -->
                        <p class="mt-3 text-sm leading-6 text-slate-500
                line-clamp-3 flex-1">

                            {{ $faculty->description ?: 'Khoa hiện chưa có mô tả.' }}

                        </p>

                        <!-- Stats -->
                        <div class="mt-6 grid grid-cols-2 divide-x divide-slate-200
                rounded-2xl bg-slate-50">

                            <div class="py-4 text-center">

                                <p class="text-2xl font-bold text-slate-900">
                                    {{ $faculty->subjects_count }}

                                </p>

                                <span class="text-[11px] text-slate-500">

                                    Môn học

                                </span>

                            </div>

                            <div class="py-4 text-center">

                                <p class="text-2xl font-bold text-cyan-600">

                                    {{ $documentCount }}

                                </p>

                                <span class="text-[11px] text-slate-500">

                                    Tài liệu

                                </span>

                            </div>

                        </div>

                        <!-- Button -->
                        <a href="{{ route('faculties.show',$faculty->faculty_id) }}" class="mt-6 flex items-center justify-center gap-2
rounded-2xl
bg-slate-900
py-3
text-sm font-semibold
text-white
transition-all duration-300
hover:bg-amber-500">

                            Xem chi tiết

                            <i class="fa-solid fa-arrow-right text-xs
                    group-hover:translate-x-1 transition-transform"></i>

                        </a>

                    </div>

                </div>

            </div>
            @empty
            <div class="col-span-full py-20 text-center">
                <div class="w-20 h-20 mx-auto rounded-full bg-slate-100 flex items-center justify-center">
                    <i class="fa-solid fa-building-columns text-3xl text-slate-400"></i>
                </div>

                <h3 class="mt-5 text-lg font-semibold text-slate-700">
                    Chưa có khoa nào
                </h3>

                <p class="mt-2 text-sm text-slate-500">
                    Hiện tại chưa có dữ liệu khoa.
                </p>
            </div>

            @endforelse


            <!-- Chỉ dùng cho tìm kiếm -->
            <div id="noFacultyResult" class="hidden col-span-full py-20 text-center">

                <div class="w-20 h-20 mx-auto rounded-full
bg-slate-100
border border-slate-200
flex items-center justify-center">

                    <i class="fa-solid fa-magnifying-glass text-3xl text-amber-500"></i>

                </div>
                <h3 class="mt-5 text-lg font-semibold text-slate-700">
                    Không tìm thấy khoa
                </h3>

                <p class="mt-2 text-sm text-slate-500">
                    Không có khoa nào phù hợp với từ khóa tìm kiếm.
                </p>

            </div>
        </div>

    </section>

</main>
@endsection

@push('scripts')
<script>
function searchFaculties() {

    const keyword = document
        .getElementById('facultySearch')
        .value
        .trim()
        .toLowerCase();

    const cards = document.querySelectorAll('.faculty-card');
    const noResult = document.getElementById('noFacultyResult');

    let visible = 0;

    cards.forEach(card => {

        const name = (card.dataset.name || "").toLowerCase();
        const code = (card.dataset.code || "").toLowerCase();

        if (
            keyword === "" ||
            name.includes(keyword) ||
            code.includes(keyword)
        ) {

            card.style.display = "";

            visible++;

        } else {

            card.style.display = "none";

        }

    });

    if (noResult) {

        if (visible === 0) {
            noResult.classList.remove("hidden");
        } else {
            noResult.classList.add("hidden");
        }

    }

}
</script>
@endpush