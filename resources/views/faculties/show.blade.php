 @extends('layouts.app')

 @section('title', 'Chi tiết khoa')

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
         <div class="absolute inset-0 bg-black/30"></div>

         <!-- Chữ "Giới thiệu" căn giữa tuyệt đối -->
         <div class="absolute inset-0 flex flex-col items-center justify-center text-center">

             <h1 class="banner-title italic text-3xl md:text-4xl font-bold text-white tracking-wide drop-shadow-md">
                 {{ $faculty->faculty_name }}
             </h1>

             <p class="banner-subtitle mt-3 text-cyan-100 text-base md:text-lg max-w-2xl leading-relaxed">
                 {{ $faculty->description ?: 'Chưa có mô tả cho khoa này.' }} </p>

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

             <a href="/faculties" class="text-slate-500 hover:text-slate-900 transition-colors duration-300">

                 Danh mục khoa

             </a>

             <span class="mx-3 text-slate-300">
                 /
             </span>
             <span class="font-semibold text-slate-700">

                 Khoa {{ $faculty->faculty_name }}

             </span>

         </div>

     </div>
     <section class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
         @if($faculty !== null)

         <!-- HEADER -->
         <div
             class="flex flex-col xl:flex-row xl:items-center justify-between gap-6 mb-12 pb-8 border-b border-cyan-100">

             <!-- LEFT -->
             <div>

                 <h1 class="text-4xl font-black text-cyan-950 tracking-tight">
                     Khoa {{ $faculty->faculty_name }}

                 </h1>

                 <p class="mt-4 max-w-3xl text-sm leading-7 text-slate-500">
                     Danh sách các môn học và tài liệu thuộc khoa này. </p>

             </div>

             <!-- RIGHT -->
             <div class="flex flex-col lg:flex-row items-stretch lg:items-center gap-4">

                 <!-- SEARCH -->

                 <div class="relative">

                     <div class="absolute inset-y-0 left-5 flex items-center">

                         <i class="fa-solid fa-magnifying-glass text-amber-500 text-lg"></i>

                     </div>

                     <input type="text" id="subjectSearch" onkeyup="searchSubjects()" placeholder="Tìm kiếm môn học..."
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
                 @if(auth()->check() && auth()->user()->role->role_name === 'lecturer')

                 <div class="inline-flex p-1 bg-amber-50 border border-amber-100 rounded-2xl">

                     <button id="btnAssigned" type="button" onclick="filterSubjects('assigned')"
                         class="px-6 py-3 rounded-xl text-amber-700 text-sm font-black transition">

                         Phụ trách (
                         {{
                        auth()->user()->subjects
                            ->where('faculty_id', $faculty->faculty_id)
                            ->count()
                    }}
                         )
                     </button>

                     <button id="btnAll" type="button" onclick="filterSubjects('all')"
                         class="px-6 py-3 rounded-xl bg-amber-500 text-white text-sm font-black transition">

                         Tất cả ({{ $faculty->subjects_count }})

                     </button>

                 </div>

                 @endif

             </div>
         </div>

         <!-- SECTION TITLE -->
         <div class="mb-7 flex items-center justify-between gap-6">
             <!-- RIGHT -->
             <div class="shrink-0">
                 <span
                     class="inline-flex items-center px-5 py-2 rounded-full bg-amber-50 text-amber-700 text-sm font-black border border-amber-100">

                     {{ $faculty->subjects_count }} môn học

                 </span>
             </div>
         </div>

         <!-- SUBJECT GRID -->
         <div id="subjectGrid" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">

             @forelse($faculty->subjects as $subject)

             <div class="subject-card group relative bg-white rounded-[2rem] border border-slate-200 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 overflow-hidden"
                 data-name="{{ $subject->subject_name }}" data-code="{{ $subject->subject_code }}"
                 data-faculty="{{ $subject->faculty?->faculty_name }}" data-description="{{ $subject->description }}"
                 data-assigned="{{ Auth::check()
                    && Auth::user()->role->role_name === 'lecturer'
                    && Auth::user()->subjects->contains('subject_code', $subject->subject_code)
                    ? '1'
                    : '0' }}">
                 <div class="absolute -top-10 -right-10 w-32 h-32 rounded-full
                bg-slate-100
                opacity-70
                group-hover:bg-amber-50
                group-hover:scale-125
                transition-all duration-700">
                 </div>

                 <div class="p-8 relative z-10">

                     <!-- Header -->
                     <div class="flex items-start justify-between gap-4 mb-6">
                         @php
                         $documentCount = $subject->faculty_count ?? 0;
                         $teacherCount = $subject->lecturers->count();
                         $active = $subject->status === 'active';
                         $colorMap = [
                         'blue' => ['bg' => 'bg-sky-50', 'text' => 'text-sky-600'],
                         'green' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600'],
                         'red' => ['bg' => 'bg-red-50', 'text' => 'text-red-600'],
                         'yellow' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-600'],
                         'purple' => ['bg' => 'bg-purple-50', 'text' => 'text-purple-600'],
                         ];

                         $color = $subject->color ?? 'blue';
                         $cls = $colorMap[$color] ?? $colorMap['blue'];
                         @endphp
                         <div class="w-16 h-16 rounded-2xl
                            bg-slate-100
                            border border-slate-200
                            flex items-center justify-center
                            transition-all duration-300
                            group-hover:bg-amber-50
                            group-hover:border-amber-300">

                             <i
                                 class="{{ $subject->icon ?? 'fa-solid fa-book' }} text-slate-600 group-hover:text-amber-500 text-2xl"></i>

                         </div>

                         <span class="px-4 py-2 rounded-full bg-slate-100 text-slate-700 text-xs font-bold">
                             {{ $subject->subject_code }}
                         </span>

                     </div>

                     <!-- Subject -->
                     <h3 class="subject-name text-xl font-black text-slate-900 group-hover:text-slate-700 transition">
                         {{ $subject->subject_name }}
                     </h3>

                     <p class="text-slate-500 text-sm mt-3 leading-relaxed min-h-[72px]">
                         {{ $subject->description ?: 'Chưa có mô tả môn học.' }}
                     </p>

                     <!-- Statistics -->
                     <div class="mt-6 grid grid-cols-2 gap-3">

                         <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4">

                             <p class="text-2xl font-black text-amber-600">

                                 {{ $subject->documents_count }}

                             </p>

                             <p class="mt-1 text-xs font-bold text-slate-500">

                                 Tài liệu

                             </p>

                         </div>

                         <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4">
                             <p class="text-2xl font-black text-amber-950">
                                 {{ $subject->lecturers->count() }}
                             </p>

                             <p class="text-xs font-bold text-slate-900 mt-1">
                                 Giảng viên
                             </p>

                         </div>

                     </div>

                     <!-- Footer -->
                     <div class="mt-7 flex items-center justify-between">

                         <span class="text-xs font-black uppercase tracking-wider
                 {{ $subject->faculty_count > 0 ? 'text-emerald-600' : 'text-red-500' }}">

                             {{ $subject->faculty_count > 0 ? 'Có tài liệu' : 'Chưa có tài liệu' }}

                         </span>

                         <a href="{{ route('subjects.show', $subject->subject_code) }}"
                             class="w-11 h-11 rounded-2xl bg-amber-500 text-white flex items-center justify-center shadow-lg shadow-amber-200 hover:bg-amber-500 transition">

                             <i class="fa-solid fa-arrow-right"></i>

                         </a>

                     </div>

                 </div>

             </div>

             @empty

             <div class="col-span-full py-16 text-center">

                 <div class="w-20 h-20 mx-auto rounded-full bg-amber-50 flex items-center justify-center">

                     <i class="fa-solid fa-book-open text-3xl text-amber-500"></i>

                 </div>

                 <p class="mt-5 text-slate-500 font-bold">
                     Khoa này chưa có môn học nào.
                 </p>

             </div>

             @endforelse

         </div>
         <div id="emptySubjectResult" class="hidden col-span-full py-16 text-center">

             <div class="w-20 h-20 mx-auto rounded-full bg-red-50 flex items-center justify-center">
                 <i class="fa-solid fa-magnifying-glass text-3xl text-red-500"></i>
             </div>

             <h3 class="mt-5 text-xl font-black text-slate-800">
                 Không tìm thấy môn học
             </h3>

             <p class="mt-2 text-sm text-slate-500">
                 Không có môn học nào phù hợp với từ khóa bạn nhập.
             </p>

         </div>
         @endif

     </section>

 </main>
 @endsection

 @push('scripts')
 <script>
function removeVietnameseTones(str) {

    return (str || '')
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .replace(/đ/g, 'd')
        .replace(/Đ/g, 'D')
        .toLowerCase()
        .trim();

}

function searchSubjects() {

    const keyword = removeVietnameseTones(
        document.getElementById('subjectSearch').value
    );

    const cards = document.querySelectorAll('.subject-card');
    const empty = document.getElementById('emptySubjectResult');

    let hasVisible = false;

    cards.forEach(function(card) {

        const subjectName = removeVietnameseTones(card.dataset.name);

        const subjectCode = removeVietnameseTones(card.dataset.code);

        const facultyName = removeVietnameseTones(card.dataset.faculty);

        if (
            subjectName.includes(keyword) ||
            subjectCode.includes(keyword) ||
            facultyName.includes(keyword)
        ) {

            card.style.display = '';

            hasVisible = true;

        } else {

            card.style.display = 'none';

        }

    });

    if (empty) {

        empty.classList.toggle('hidden', hasVisible);

    }

}

function filterSubjects(type) {

    const cards = document.querySelectorAll('.subject-card');

    cards.forEach(card => {

        if (type === 'all') {

            card.style.display = '';

        } else {

            card.style.display =
                card.dataset.assigned === '1' ?
                '' :
                'none';

        }

    });

    // Đổi màu nút
    document.getElementById('btnAssigned').className =
        type === 'assigned' ?
        'px-6 py-3 rounded-xl bg-amber-500 text-white text-sm font-black' :
        'px-6 py-3 rounded-xl text-amber-700 text-sm font-black';

    document.getElementById('btnAll').className =
        type === 'all' ?
        'px-6 py-3 rounded-xl bg-amber-500 text-white text-sm font-black' :
        'px-6 py-3 rounded-xl text-amber-700 text-sm font-black';
}
 </script>
 @endpush