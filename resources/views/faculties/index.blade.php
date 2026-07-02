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
<main class="min-h-screen bg-[#EAFBFF]">
    <!-- HERO BANNER: Khối banner ảnh nền chứa chữ "Giới thiệu" giống hệt image_5ea826.jpg -->
    <div class="relative w-full h-[260px] md:h-[320px] overflow-hidden">
        <!-- Ảnh nền (Đã được thay bằng hình ảnh thư viện học thuật/công nghệ số hiện đại) -->
        <img src="https://i.pinimg.com/1200x/96/d3/c9/96d3c90189af11a192ba76519fb7cf2a.jpg"
            alt="Educational Resources Banner" class="w-full h-full object-cover opacity-60">

        <!-- Lớp phủ tối (Overlay) để làm nổi bật chữ trắng phía trên giống hình mẫu -->
        <div class="absolute inset-0 bg-black/30"></div>

        <!-- Chữ "Giới thiệu" căn giữa tuyệt đối -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">

            <h1 class="banner-title italic text-3xl md:text-4xl font-bold text-white tracking-wide drop-shadow-md">
                Khoa
            </h1>

            <p class="banner-subtitle mt-3 text-cyan-100 text-base md:text-lg max-w-2xl leading-relaxed">
                Khám phá các khoa đào tạo, xem danh sách môn học và tài liệu học tập
            </p>

        </div>
    </div>

    <div class="bg-cyan-50 py-3 border-b border-cyan-100">
        <div class="max-w-7xl mx-auto px-4 md:px-6 flex items-center text-sm">
            <a href="/" class="text-slate-600 hover:text-cyan-600 transition">
                Trang chủ
            </a>

            <span class="mx-2 text-slate-400">
                /
            </span>

            <span class="font-medium text-cyan-600">
                Khoa
            </span>
        </div>
    </div>


    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
        <!-- ================= HEADER ================= -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 mb-12">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-2xl bg-cyan-50 border border-cyan-100
                       flex items-center justify-center">

                    <i class="fa-solid fa-building-columns  text-cyan-600 text-2xl"></i>

                </div>

                <div>

                    <h1 class="text-3xl font-bold text-slate-900">
                        Danh mục Khoa
                    </h1>

                    <p class="mt-2 text-sm text-slate-500 leading-7 max-w-2xl">
                        Khám phá các khoa đào tạo, xem danh sách môn học và tài liệu học tập.
                    </p>

                </div>

            </div>
            <!-- Search -->
            <div class="w-full lg:w-80">

                <div class="relative">

                    <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-cyan-500"></i>

                    <input id="facultySearch" type="text" onkeyup="searchFaculties()" placeholder="Tìm kiếm khoa..."
                        class="h-14 w-full rounded-2xl border border-slate-200 bg-white
                pl-12 pr-5
                text-sm text-slate-700
                placeholder:text-slate-400
                transition
                focus:border-cyan-500
                focus:outline-none
                focus:ring-4
                focus:ring-cyan-100">

                </div>

            </div>

        </div>



        <div id="facultyGrid" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">

            @forelse($faculties as $faculty)

            @php
            $documentCount = $faculty->documents_count ?? $faculty->subjects->sum('documents_count');
            @endphp
            <div class="faculty-card" data-name="{{ strtolower($faculty->faculty_name) }}"
                data-code="{{ strtolower($faculty->faculty_code) }}">

                <div class="group relative h-full overflow-hidden rounded-3xl
               border border-slate-200 bg-white
               transition-all duration-300
               hover:-translate-y-2
               hover:border-cyan-300
               hover:shadow-[0_20px_45px_rgba(8,145,178,0.12)]">

                    <!-- TOP BAR -->
                    <div class="h-1 w-full bg-gradient-to-r from-cyan-500 via-sky-500 to-cyan-400">
                    </div>

                    <div class="p-7">

                        <!-- HEADER -->
                        <div class="flex items-start justify-between">

                            <div class="flex h-14 w-14 items-center justify-center
                           rounded-2xl bg-cyan-50
                           text-cyan-600">

                                <i class="fa-solid fa-building-columns text-2xl"></i>

                            </div>

                            @if($faculty->is_active)

                            <span class="inline-flex items-center gap-2
                           rounded-full bg-emerald-50
                           px-3 py-1 text-[11px]
                           font-semibold text-emerald-600">

                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                                Hoạt động

                            </span>

                            @else

                            <span class="inline-flex items-center gap-2
                           rounded-full bg-red-50
                           px-3 py-1 text-[11px]
                           font-semibold text-red-500">

                                <span class="h-2 w-2 rounded-full bg-red-500"></span>

                                Khóa

                            </span>

                            @endif

                        </div>

                        <!-- CODE -->
                        <span class="mt-6 inline-flex
                       rounded-lg
                       bg-slate-100
                       px-3 py-1
                       text-[11px]
                       font-bold
                       uppercase
                       tracking-wider
                       text-slate-600">

                            {{ $faculty->faculty_code }}

                        </span>

                        <!-- NAME -->
                        <h3 class="mt-4
                       text-2xl
                       font-bold
                       leading-tight
                       text-slate-900
                       transition
                       group-hover:text-cyan-600">

                            {{ $faculty->faculty_name }}

                        </h3>

                        <!-- DESCRIPTION -->
                        <p class="mt-4
                       min-h-[72px]
                       text-sm
                       leading-7
                       text-slate-500
                       line-clamp-3">

                            {{ $faculty->description ?: 'Khoa hiện chưa có mô tả.' }}

                        </p>

                        <!-- STATS -->
                        <div class="mt-7
                       rounded-2xl
                       bg-slate-50
                       p-5">

                            <div class="grid grid-cols-2">

                                <div>

                                    <p class="text-3xl
                                   font-bold
                                   text-slate-900">

                                        {{ $faculty->subjects_count }}

                                    </p>

                                    <p class="mt-1
                                   text-xs
                                   uppercase
                                   tracking-wide
                                   text-slate-500">

                                        Môn học

                                    </p>

                                </div>

                                <div class="border-l border-slate-200 pl-5">

                                    <p class="text-3xl
                                   font-bold
                                   text-cyan-600">

                                        {{ $documentCount }}

                                    </p>

                                    <p class="mt-1
                                   text-xs
                                   uppercase
                                   tracking-wide
                                   text-slate-500">

                                        Tài liệu

                                    </p>

                                </div>

                            </div>

                        </div>

                        <!-- BUTTON -->
                        <a href="{{ route('faculties.show',$faculty->faculty_id) }}" class="mt-7
                       flex
                       items-center
                       justify-between
                       rounded-2xl
                       border
                       border-slate-200
                       px-5
                       py-3
                       text-sm
                       font-semibold
                       text-slate-700
                       transition-all
                       group-hover:border-cyan-500
                       group-hover:bg-cyan-500
                       group-hover:text-white">

                            <span>Xem chi tiết</span>

                            <i class="fa-solid fa-arrow-right
                           transition-transform
                           group-hover:translate-x-1">
                            </i>

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

                <div class="w-20 h-20 mx-auto rounded-full bg-cyan-50 flex items-center justify-center">
                    <i class="fa-solid fa-magnifying-glass text-3xl text-cyan-500"></i>
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