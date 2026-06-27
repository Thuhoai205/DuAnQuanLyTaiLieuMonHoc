 @extends('layouts.app')

 @section('title', 'Chi tiết khoa')

 @section('content')

 <main class="min-h-screen bg-[#EAFBFF]">

     <section class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-14">

         <!-- BACK -->
         <div class="mb-10">
             <a href="{{ route('faculties.index') }}"
                 class="inline-flex items-center gap-2.5 px-6 py-3 bg-white border border-cyan-100 text-cyan-700 hover:text-cyan-800 font-bold text-xs uppercase tracking-wider rounded-full shadow-sm hover:shadow-cyan-200 transition-all duration-300">
                 <i class="fa-solid fa-arrow-left"></i>
                 Quay lại
             </a>
         </div>

         @if($faculty !== null)

         <!-- HEADER -->
         <div
             class="flex flex-col xl:flex-row xl:items-center justify-between gap-6 mb-12 pb-8 border-b border-cyan-100">

             <!-- LEFT -->
             <div>

                 <div class="flex items-center gap-4 mb-4">

                     <span
                         class="inline-flex items-center px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black uppercase tracking-wider">
                         {{ $faculty->faculty_code }}
                     </span>

                     <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black
                {{ $faculty->is_active
                    ? 'bg-emerald-50 text-emerald-600'
                    : 'bg-red-50 text-red-500' }}">
                         {{ $faculty->is_active ? 'Đang hoạt động' : 'Đã khóa' }}
                     </span>

                 </div>

                 <h1 class="text-4xl font-black text-cyan-950 tracking-tight">
                     {{ $faculty->faculty_name }}
                 </h1>

                 <p class="mt-4 max-w-3xl text-sm leading-7 text-slate-500">
                     {{ $faculty->description ?: 'Chưa có mô tả cho khoa này.' }}
                 </p>

             </div>

             <!-- RIGHT -->
             <div class="flex flex-col lg:flex-row items-stretch lg:items-center gap-4">

                 <!-- SEARCH -->
                 <div class="relative w-full lg:w-80">
                     <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-cyan-500 text-sm"></i>

                     <input type="text" id="subjectSearch" onkeyup="searchSubjects()" placeholder="Tìm kiếm môn học..."
                         class="w-full pl-11 pr-4 py-3 bg-white border border-cyan-100 rounded-2xl
                   text-sm font-semibold text-slate-700 shadow-sm
                   focus:outline-none focus:ring-2 focus:ring-cyan-300 focus:border-cyan-500 transition">
                 </div>

                 @if(auth()->check() && auth()->user()->role->role_name === 'lecturer')

                 <div class="inline-flex p-1 bg-cyan-50 border border-cyan-100 rounded-2xl">

                     <button id="btnAssigned" type="button" onclick="filterSubjects('assigned')"
                         class="px-6 py-3 rounded-xl text-cyan-700 text-sm font-black transition">

                         Phụ trách ({{ auth()->user()->subjects->count() }})

                     </button>

                     <button id="btnAll" type="button" onclick="filterSubjects('all')"
                         class="px-6 py-3 rounded-xl bg-cyan-500 text-white text-sm font-black transition">

                         Tất cả ({{ $faculty->subjects_count }})

                     </button>

                 </div>

                 @endif

             </div>
         </div>

         <!-- SECTION TITLE -->
         <div class="mb-7 flex items-center justify-between gap-6">

             <!-- LEFT -->
             <div>
                 <h2 class="text-2xl font-black text-cyan-950 tracking-tight">
                     Môn học thuộc khoa {{ $faculty->faculty_name }}
                 </h2>

                 <p class="text-slate-500 font-medium text-sm mt-2">
                     Danh sách các môn học và tài liệu thuộc khoa này.
                 </p>
             </div>

             <!-- RIGHT -->
             <div class="shrink-0">
                 <span
                     class="inline-flex items-center px-5 py-2 rounded-full bg-cyan-50 text-cyan-700 text-sm font-black border border-cyan-100">

                     {{ $faculty->subjects_count }} môn học

                 </span>
             </div>
         </div>

         <!-- SUBJECT GRID -->
         <div id="subjectGrid" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">

             @forelse($faculty->subjects as $subject)

             <div class="subject-card group relative bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] hover:shadow-[0_20px_60px_rgba(8,145,178,0.16)] hover:-translate-y-2 transition-all duration-500 overflow-hidden"
                 data-assigned="{{ Auth::check()
        && Auth::user()->role->role_name === 'lecturer'
        && Auth::user()->subjects->contains('subject_code', $subject->subject_code)
            ? '1'
            : '0' }}">
                 <div
                     class="absolute -top-10 -right-10 w-32 h-32 bg-cyan-100 rounded-full group-hover:scale-125 transition-transform duration-700">
                 </div>

                 <div class="p-8 relative z-10">

                     <!-- Header -->
                     <div class="flex items-start justify-between gap-4 mb-6">

                         <div
                             class="w-16 h-16 bg-cyan-50 rounded-2xl border border-cyan-100 flex items-center justify-center">

                             <i class="{{ $subject->icon ?? 'fa-solid fa-book-open' }} text-2xl text-cyan-600"></i>

                         </div>

                         <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black">
                             {{ $subject->subject_code }}
                         </span>

                     </div>

                     <!-- Subject -->
                     <h3 class="subject-name text-xl font-black text-slate-900 group-hover:text-cyan-600 transition">
                         {{ $subject->subject_name }}
                     </h3>

                     <p class="text-slate-500 text-sm mt-3 leading-relaxed min-h-[72px]">
                         {{ $subject->description ?: 'Chưa có mô tả môn học.' }}
                     </p>

                     <!-- Statistics -->
                     <div class="mt-6 grid grid-cols-2 gap-3">

                         <div class="rounded-2xl bg-cyan-50/70 border border-cyan-100 p-4">

                             <p class="text-2xl font-black text-cyan-950">
                                 {{ $subject->documents_count }}
                             </p>

                             <p class="text-xs font-bold text-slate-500 mt-1">
                                 Tài liệu
                             </p>

                         </div>

                         <div class="rounded-2xl bg-cyan-50/70 border border-cyan-100 p-4">

                             <p class="text-2xl font-black text-cyan-950">
                                 {{ $subject->lecturers->count() }}
                             </p>

                             <p class="text-xs font-bold text-slate-500 mt-1">
                                 Giảng viên
                             </p>

                         </div>

                     </div>

                     <!-- Footer -->
                     <div class="mt-7 flex items-center justify-between">

                         <span class="text-xs font-black uppercase tracking-wider
                    {{ $subject->documents_count > 0 ? 'text-cyan-700' : 'text-red-500' }}">

                             {{ $subject->documents_count > 0 ? 'Có tài liệu' : 'Chưa có tài liệu' }}

                         </span>

                         <a href="{{ route('subjects.show', $subject->subject_code) }}"
                             class="w-11 h-11 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200 hover:bg-cyan-600 transition">

                             <i class="fa-solid fa-arrow-right"></i>

                         </a>

                     </div>

                 </div>

             </div>

             @empty

             <div class="col-span-full py-16 text-center">

                 <div class="w-20 h-20 mx-auto rounded-full bg-cyan-50 flex items-center justify-center">

                     <i class="fa-solid fa-book-open text-3xl text-cyan-500"></i>

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
function searchSubjects() {

    const keyword = document.getElementById('subjectSearch').value.trim().toLowerCase();
    const cards = document.querySelectorAll('.subject-card');
    const empty = document.getElementById('emptySubjectResult');

    let hasVisible = false;

    cards.forEach(function(card) {

        const name = card.querySelector('.subject-name').innerText.toLowerCase();

        if (name.includes(keyword)) {

            card.style.display = '';
            hasVisible = true;

        } else {

            card.style.display = 'none';

        }

    });

    if (empty) {

        if (hasVisible) {

            empty.classList.add('hidden');

        } else {

            empty.classList.remove('hidden');

        }

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
        'px-6 py-3 rounded-xl bg-cyan-500 text-white text-sm font-black' :
        'px-6 py-3 rounded-xl text-cyan-700 text-sm font-black';

    document.getElementById('btnAll').className =
        type === 'all' ?
        'px-6 py-3 rounded-xl bg-cyan-500 text-white text-sm font-black' :
        'px-6 py-3 rounded-xl text-cyan-700 text-sm font-black';
}
 </script>
 @endpush