 @extends('layouts.app')

 @section('title', 'Chi tiết khoa - EDU DOC')

 @section('content')
 @php
 $faculties = [
 'cntt' => [
 'code' => 'CNTT',
 'name' => 'Công nghệ thông tin',
 'description' => 'Khoa Công nghệ thông tin quản lý các môn học liên quan đến lập trình, cơ sở dữ liệu, mạng máy tính,
 phân tích thiết kế hệ thống và phát triển phần mềm.',
 'icon' => 'fa-solid fa-laptop-code',
 'subjects' => 8,
 'documents' => 126,
 ],
 'qtkd' => [
 'code' => 'QTKD',
 'name' => 'Quản trị kinh doanh',
 'description' => 'Khoa Quản trị kinh doanh cung cấp học liệu về quản trị, marketing, kinh doanh, tài chính và kỹ năng
 quản lý.',
 'icon' => 'fa-solid fa-briefcase',
 'subjects' => 6,
 'documents' => 84,
 ],
 'kt' => [
 'code' => 'KT',
 'name' => 'Kế toán',
 'description' => 'Khoa Kế toán lưu trữ tài liệu về nguyên lý kế toán, kế toán tài chính, kiểm toán và phân tích báo cáo
 tài chính.',
 'icon' => 'fa-solid fa-calculator',
 'subjects' => 5,
 'documents' => 73,
 ],
 'nn' => [
 'code' => 'NN',
 'name' => 'Ngoại ngữ',
 'description' => 'Khoa Ngoại ngữ cung cấp tài liệu tiếng Anh, kỹ năng giao tiếp, ngữ pháp và tài liệu học ngoại ngữ.',
 'icon' => 'fa-solid fa-language',
 'subjects' => 4,
 'documents' => 58,
 ],
 ];

 $faculty = $faculties[$code] ?? null;

 $subjectsByFaculty = [
 'cntt' => [
 [
 'id' => 'lap-trinh-web',
 'name' => 'Lập trình Web',
 'description' => 'Tài liệu HTML, CSS, JavaScript, Laravel và các kiến thức xây dựng website.',
 'icon' => 'fa-solid fa-globe',
 'documents' => 32,
 'teachers' => 2,
 ],
 [
 'id' => 'co-so-du-lieu',
 'name' => 'Cơ sở dữ liệu',
 'description' => 'Học liệu về mô hình dữ liệu, SQL, thiết kế CSDL và quản trị cơ sở dữ liệu.',
 'icon' => 'fa-solid fa-database',
 'documents' => 28,
 'teachers' => 2,
 ],
 [
 'id' => 'lap-trinh-java',
 'name' => 'Lập trình Java',
 'description' => 'Tài liệu về lập trình hướng đối tượng, class, object, kế thừa và xử lý ngoại lệ.',
 'icon' => 'fa-brands fa-java',
 'documents' => 24,
 'teachers' => 1,
 ],
 [
 'id' => 'phan-tich-thiet-ke',
 'name' => 'Phân tích thiết kế hệ thống',
 'description' => 'Tài liệu về UML, use case, activity diagram, class diagram và thiết kế hệ thống.',
 'icon' => 'fa-solid fa-diagram-project',
 'documents' => 21,
 'teachers' => 1,
 ],
 ],

 'qtkd' => [
 [
 'id' => 'quan-tri-hoc',
 'name' => 'Quản trị học',
 'description' => 'Tài liệu về nguyên lý quản trị, lập kế hoạch, tổ chức, lãnh đạo và kiểm soát.',
 'icon' => 'fa-solid fa-briefcase',
 'documents' => 20,
 'teachers' => 1,
 ],
 [
 'id' => 'marketing-can-ban',
 'name' => 'Marketing căn bản',
 'description' => 'Học liệu về thị trường, khách hàng, sản phẩm, giá, phân phối và truyền thông.',
 'icon' => 'fa-solid fa-bullhorn',
 'documents' => 18,
 'teachers' => 1,
 ],
 ],

 'kt' => [
 [
 'id' => 'nguyen-ly-ke-toan',
 'name' => 'Nguyên lý kế toán',
 'description' => 'Tài liệu về tài khoản, chứng từ, định khoản và lập báo cáo kế toán cơ bản.',
 'icon' => 'fa-solid fa-calculator',
 'documents' => 19,
 'teachers' => 1,
 ],
 [
 'id' => 'ke-toan-tai-chinh',
 'name' => 'Kế toán tài chính',
 'description' => 'Học liệu về báo cáo tài chính, tài sản, nguồn vốn, doanh thu và chi phí.',
 'icon' => 'fa-solid fa-chart-line',
 'documents' => 16,
 'teachers' => 1,
 ],
 ],

 'nn' => [
 [
 'id' => 'tieng-anh-co-ban',
 'name' => 'Tiếng Anh cơ bản',
 'description' => 'Tài liệu từ vựng, ngữ pháp, đọc hiểu và luyện tập tiếng Anh nền tảng.',
 'icon' => 'fa-solid fa-language',
 'documents' => 15,
 'teachers' => 1,
 ],
 [
 'id' => 'tieng-anh-giao-tiep',
 'name' => 'Tiếng Anh giao tiếp',
 'description' => 'Học liệu luyện nghe, nói, hội thoại và giao tiếp trong tình huống thực tế.',
 'icon' => 'fa-solid fa-comments',
 'documents' => 14,
 'teachers' => 1,
 ],
 ],
 ];

 $subjects = $subjectsByFaculty[$code] ?? [];
 @endphp

 <main class="min-h-screen bg-[#EAFBFF]">

     <section class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-14">

         <!-- BACK -->
         <div class="mb-10">
             <a href="{{ route('faculties.index') }}"
                 class="inline-flex items-center gap-2.5 px-6 py-3 bg-white border border-cyan-100 text-cyan-700 hover:text-cyan-800 font-bold text-xs uppercase tracking-wider rounded-full shadow-sm hover:shadow-cyan-200 transition-all duration-300">
                 <i class="fa-solid fa-arrow-left"></i>
                 Quay lại danh sách khoa
             </a>
         </div>

         @if($faculty)

         <!-- HEADER -->
         <div
             class="flex flex-col xl:flex-row xl:items-center justify-between gap-6 mb-12 pb-8 border-b border-cyan-100">

             <div>
                 <div class="flex items-center mb-3">
                     <div
                         class="w-12 h-12 bg-cyan-500 rounded-2xl flex items-center justify-center text-white mr-4 shadow-lg shadow-cyan-200">
                         <i class="{{ $faculty['icon'] }}"></i>
                     </div>

                     <div>
                         <h1 class="text-3xl font-black text-cyan-950 tracking-tight">
                             Khoa {{ $faculty['name'] }}
                         </h1>

                         <p class="text-xs font-black text-cyan-600 uppercase tracking-widest mt-1">
                             {{ $faculty['code'] }}
                         </p>
                     </div>
                 </div>

                 <p class="text-slate-500 font-medium text-sm pl-[64px] max-w-3xl leading-relaxed">
                     {{ $faculty['description'] }}
                 </p>
             </div>

             <div class="flex flex-col lg:flex-row items-stretch lg:items-center gap-4">

                 <!-- SEARCH -->
                 <div class="relative w-full lg:w-72">
                     <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-cyan-600 text-xs"></i>

                     <input type="text" id="subjectSearch" onkeyup="searchSubjects()" placeholder="Tìm môn học..."
                         class="w-full pl-11 pr-4 py-3 bg-white border border-cyan-100 rounded-2xl text-sm font-semibold text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-300 focus:border-cyan-500 transition-all">
                 </div>

                 <a href="{{ route('subjects.index') }}"
                     class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-cyan-500 hover:bg-cyan-600 text-white rounded-2xl text-sm font-black shadow-lg shadow-cyan-200 transition-all">
                     <i class="fa-solid fa-book-open"></i>
                     Xem tất cả môn học
                 </a>
             </div>
         </div>

         <!-- STATS -->
         <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

             <div class="bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-7">
                 <div class="flex items-center justify-between">
                     <div>
                         <p class="text-sm font-bold text-slate-500">Số môn học</p>
                         <h3 class="text-3xl font-black text-cyan-950 mt-2">
                             {{ $faculty['subjects'] }}
                         </h3>
                     </div>

                     <div class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                         <i class="fa-solid fa-book-open text-2xl"></i>
                     </div>
                 </div>
             </div>

             <div class="bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-7">
                 <div class="flex items-center justify-between">
                     <div>
                         <p class="text-sm font-bold text-slate-500">Số tài liệu</p>
                         <h3 class="text-3xl font-black text-cyan-950 mt-2">
                             {{ $faculty['documents'] }}
                         </h3>
                     </div>

                     <div class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                         <i class="fa-solid fa-file-lines text-2xl"></i>
                     </div>
                 </div>
             </div>

             <div class="bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-7">
                 <div class="flex items-center justify-between">
                     <div>
                         <p class="text-sm font-bold text-slate-500">Trạng thái</p>
                         <h3 class="text-2xl font-black text-cyan-950 mt-2">
                             Hoạt động
                         </h3>
                     </div>

                     <div class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                         <i class="fa-solid fa-circle-check text-2xl"></i>
                     </div>
                 </div>
             </div>

         </div>

         <!-- SECTION TITLE -->
         <div class="mb-7">
             <h2 class="text-2xl font-black text-cyan-950 tracking-tight">
                 Môn học thuộc khoa {{ $faculty['name'] }}
             </h2>

             <p class="text-slate-500 font-medium text-sm mt-2">
                 Danh sách các môn học và tài liệu liên quan thuộc khoa này.
             </p>
         </div>

         <!-- SUBJECT GRID -->
         <div id="subjectGrid" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">

             @foreach($subjects as $subject)
             <div
                 class="subject-card group relative bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] hover:shadow-[0_20px_60px_rgba(8,145,178,0.16)] hover:-translate-y-2 transition-all duration-500 overflow-hidden">

                 <div
                     class="absolute -top-10 -right-10 w-32 h-32 bg-cyan-100 rounded-full group-hover:scale-125 transition-transform duration-700">
                 </div>

                 <div class="p-8 relative z-10">
                     <div class="flex items-start justify-between gap-4 mb-6">
                         <div
                             class="w-16 h-16 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center border border-cyan-100 group-hover:bg-cyan-500 group-hover:text-white transition-all">
                             <i class="{{ $subject['icon'] }} text-2xl"></i>
                         </div>

                         <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black">
                             {{ $faculty['code'] }}
                         </span>
                     </div>

                     <h3 class="subject-name text-xl font-black text-slate-900 group-hover:text-cyan-600 transition">
                         {{ $subject['name'] }}
                     </h3>

                     <p class="text-slate-500 text-sm mt-3 leading-relaxed min-h-[72px]">
                         {{ $subject['description'] }}
                     </p>

                     <div class="mt-6 grid grid-cols-2 gap-3">
                         <div class="rounded-2xl bg-cyan-50/70 border border-cyan-100 p-4">
                             <p class="text-2xl font-black text-cyan-950">
                                 {{ $subject['documents'] }}
                             </p>
                             <p class="text-xs font-bold text-slate-500 mt-1">
                                 Tài liệu
                             </p>
                         </div>

                         <div class="rounded-2xl bg-cyan-50/70 border border-cyan-100 p-4">
                             <p class="text-2xl font-black text-cyan-950">
                                 {{ $subject['teachers'] }}
                             </p>
                             <p class="text-xs font-bold text-slate-500 mt-1">
                                 Giảng viên
                             </p>
                         </div>
                     </div>

                     <div class="mt-7 flex items-center justify-between">
                         <span class="text-xs font-black text-cyan-700 uppercase tracking-wider">
                             Có tài liệu
                         </span>

                         <a href="{{ route('subjects.show', $subject['id']) }}"
                             class="w-11 h-11 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200 hover:bg-cyan-600 transition">
                             <i class="fa-solid fa-arrow-right"></i>
                         </a>
                     </div>
                 </div>
             </div>
             @endforeach

         </div>

         @else

         <!-- NOT FOUND -->
         <div
             class="bg-white rounded-[2rem] border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)] p-10 text-center">
             <div class="w-20 h-20 mx-auto rounded-3xl bg-red-50 text-red-500 flex items-center justify-center mb-5">
                 <i class="fa-solid fa-triangle-exclamation text-3xl"></i>
             </div>

             <h1 class="text-2xl font-black text-slate-900">
                 Không tìm thấy khoa
             </h1>

             <p class="text-sm font-semibold text-slate-500 mt-3">
                 Khoa bạn đang truy cập không tồn tại trong giao diện mẫu.
             </p>

             <a href="{{ route('faculties.index') }}"
                 class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-cyan-500 hover:bg-cyan-600 text-white rounded-2xl text-sm font-black shadow-lg shadow-cyan-200 transition-all">
                 <i class="fa-solid fa-arrow-left"></i>
                 Quay lại danh sách khoa
             </a>
         </div>

         @endif

     </section>

 </main>
 @endsection

 @push('scripts')
 <script>
function searchSubjects() {
    const keyword = document.getElementById('subjectSearch').value.toLowerCase();
    const cards = document.querySelectorAll('.subject-card');

    cards.forEach(function(card) {
        const name = card.querySelector('.subject-name').innerText.toLowerCase();

        if (name.includes(keyword)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}
 </script>
 @endpush