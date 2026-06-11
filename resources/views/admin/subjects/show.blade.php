 @extends('layouts.admin')

 @section('title', 'Chi tiết môn học')
 @section('page-title', 'Chi tiết môn học')

 @section('content')

 @php
 $totalDocuments = $subject->documents_count ?? ($subject->documents?->count() ?? 0);
 $totalLecturers = $subject->lecturers?->count() ?? 0;
 $isActive = $subject->status === 'active';
 $subjectIcon = $subject->icon ?: 'fa-solid fa-book-open';

 $colorMap = [
 'blue' => [
 'header' => 'from-blue-600 to-sky-500',
 'mainBg' => 'bg-blue-50',
 'mainText' => 'text-blue-700',
 'iconText' => 'text-blue-600',
 'border' => 'border-blue-100',
 'button' => 'bg-blue-600 hover:bg-blue-700 shadow-blue-100',
 'hoverBg' => 'hover:bg-blue-50/50',
 ],
 'green' => [
 'header' => 'from-emerald-600 to-green-500',
 'mainBg' => 'bg-emerald-50',
 'mainText' => 'text-emerald-700',
 'iconText' => 'text-emerald-600',
 'border' => 'border-emerald-100',
 'button' => 'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-100',
 'hoverBg' => 'hover:bg-emerald-50/50',
 ],
 'red' => [
 'header' => 'from-red-600 to-rose-500',
 'mainBg' => 'bg-red-50',
 'mainText' => 'text-red-700',
 'iconText' => 'text-red-600',
 'border' => 'border-red-100',
 'button' => 'bg-red-600 hover:bg-red-700 shadow-red-100',
 'hoverBg' => 'hover:bg-red-50/50',
 ],
 'yellow' => [
 'header' => 'from-yellow-500 to-amber-400',
 'mainBg' => 'bg-yellow-50',
 'mainText' => 'text-yellow-700',
 'iconText' => 'text-yellow-600',
 'border' => 'border-yellow-100',
 'button' => 'bg-yellow-500 hover:bg-yellow-600 shadow-yellow-100',
 'hoverBg' => 'hover:bg-yellow-50/50',
 ],
 'purple' => [
 'header' => 'from-purple-600 to-violet-500',
 'mainBg' => 'bg-purple-50',
 'mainText' => 'text-purple-700',
 'iconText' => 'text-purple-600',
 'border' => 'border-purple-100',
 'button' => 'bg-purple-600 hover:bg-purple-700 shadow-purple-100',
 'hoverBg' => 'hover:bg-purple-50/50',
 ],
 'cyan' => [
 'header' => 'from-cyan-600 to-sky-500',
 'mainBg' => 'bg-cyan-50',
 'mainText' => 'text-cyan-700',
 'iconText' => 'text-cyan-600',
 'border' => 'border-cyan-100',
 'button' => 'bg-cyan-600 hover:bg-cyan-700 shadow-cyan-100',
 'hoverBg' => 'hover:bg-cyan-50/50',
 ],
 'gray' => [
 'header' => 'from-slate-600 to-slate-500',
 'mainBg' => 'bg-slate-50',
 'mainText' => 'text-slate-700',
 'iconText' => 'text-slate-600',
 'border' => 'border-slate-100',
 'button' => 'bg-slate-600 hover:bg-slate-700 shadow-slate-100',
 'hoverBg' => 'hover:bg-slate-50/50',
 ],
 ];

 $theme = $colorMap[$subject->color ?? 'cyan'] ?? $colorMap['cyan'];
 @endphp

 <div class="max-w-7xl mx-auto px-2 lg:px-4">

     <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
         <div>
             <h1 class="text-3xl font-black text-slate-900">
                 Chi tiết môn học
             </h1>

             <p class="text-slate-500 font-semibold mt-2">
                 Xem thông tin môn học, khoa, giảng viên phụ trách và tài liệu liên quan.
             </p>
         </div>

         <div class="flex flex-wrap items-center gap-3">
             <a href="{{ route('admin.subjects.edit', $subject->subject_code) }}"
                 class="group inline-flex items-center gap-3 px-5 py-3 rounded-2xl {{ $theme['button'] }} text-white font-black shadow-lg hover:-translate-y-0.5 transition-all">
                 <span class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                     <i class="fa-solid fa-pen fa-fw"></i>
                 </span>
                 Chỉnh sửa
             </a>

             <a href="{{ route('admin.subjects.index') }}"
                 class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-white border {{ $theme['border'] }} text-slate-700 font-black shadow-sm {{ $theme['mainBg'] }} hover:text-slate-900 transition">
                 <span
                     class="w-10 h-10 rounded-xl {{ $theme['mainBg'] }} {{ $theme['iconText'] }} flex items-center justify-center">
                     <i class="fa-solid fa-arrow-left fa-fw"></i>
                 </span>
                 Quay lại
             </a>
         </div>
     </div>

     <div class="bg-white rounded-[32px] border {{ $theme['border'] }} shadow-sm overflow-hidden mb-8">
         <div class="bg-gradient-to-r {{ $theme['header'] }} px-8 py-8 text-white">
             <div class="flex flex-col md:flex-row md:items-center gap-6">

                 <div
                     class="w-28 h-28 rounded-[30px] bg-white/20 border border-white/30 flex items-center justify-center shadow-xl overflow-hidden">
                     @if($subject->thumbnail)
                     <img src="{{ asset('storage/' . $subject->thumbnail) }}" class="w-full h-full object-cover">
                     @else
                     <i class="{{ $subjectIcon }} text-5xl"></i>
                     @endif
                 </div>

                 <div class="flex-1 min-w-0">
                     <div class="flex flex-wrap items-center gap-3 mb-4">
                         <span
                             class="px-4 py-2 rounded-full bg-white/20 text-white text-xs font-black border border-white/20">
                             {{ $subject->subject_code }}
                         </span>

                         <span
                             class="px-4 py-2 rounded-full bg-white/20 text-white text-xs font-black border border-white/20">
                             {{ $subject->faculty->faculty_name ?? 'Chưa phân khoa' }}
                         </span>

                         @if($isActive)
                         <span
                             class="px-4 py-2 rounded-full bg-emerald-400/20 text-emerald-50 text-xs font-black border border-emerald-200/20">
                             Hoạt động
                         </span>
                         @else
                         <span
                             class="px-4 py-2 rounded-full bg-red-400/20 text-red-50 text-xs font-black border border-red-200/20">
                             Ngừng hoạt động
                         </span>
                         @endif
                     </div>

                     <h2 class="text-4xl font-black leading-tight">
                         {{ $subject->subject_name }}
                     </h2>

                     <p class="text-white/90 font-semibold mt-3 max-w-3xl line-clamp-2">
                         {{ $subject->description ?: 'Chưa có mô tả cho môn học này.' }}
                     </p>
                 </div>
             </div>
         </div>

         <div class="grid grid-cols-1 md:grid-cols-4 border-t {{ $theme['border'] }}">
             <div class="p-6 border-b md:border-b-0 md:border-r {{ $theme['border'] }}">
                 <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">
                     Mã môn học
                 </p>

                 <h3 class="text-2xl font-black {{ $theme['mainText'] }} mt-2">
                     {{ $subject->subject_code }}
                 </h3>
             </div>

             <div class="p-6 border-b md:border-b-0 md:border-r {{ $theme['border'] }}">
                 <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">
                     Khoa
                 </p>

                 <h3 class="text-lg font-black text-slate-900 mt-2 truncate">
                     {{ $subject->faculty->faculty_name ?? 'Chưa phân khoa' }}
                 </h3>
             </div>

             <div class="p-6 border-b md:border-b-0 md:border-r {{ $theme['border'] }}">
                 <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">
                     Slug
                 </p>

                 <h3 class="text-lg font-black text-slate-900 mt-2 break-all">
                     {{ $subject->slug }}
                 </h3>
             </div>

             <div class="p-6">
                 <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">
                     Ngày tạo
                 </p>

                 <h3 class="text-2xl font-black text-slate-900 mt-2">
                     {{ $subject->created_at ? $subject->created_at->format('d/m/Y') : 'Chưa có' }}
                 </h3>
             </div>
         </div>
     </div>

     <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
         <div class="bg-white rounded-2xl border {{ $theme['border'] }} p-6 shadow-sm">
             <p class="text-xs font-black uppercase text-slate-400">
                 Tài liệu
             </p>

             <h3 class="text-4xl font-black {{ $theme['mainText'] }} mt-2">
                 {{ number_format($totalDocuments) }}
             </h3>
         </div>

         <div class="bg-white rounded-2xl border {{ $theme['border'] }} p-6 shadow-sm">
             <p class="text-xs font-black uppercase text-slate-400">
                 Giảng viên
             </p>

             <h3 class="text-4xl font-black {{ $theme['mainText'] }} mt-2">
                 {{ number_format($totalLecturers) }}
             </h3>
         </div>

         <div class="bg-white rounded-2xl border {{ $theme['border'] }} p-6 shadow-sm">
             <p class="text-xs font-black uppercase text-slate-400">
                 Trạng thái
             </p>

             <h3 class="text-3xl font-black mt-2 {{ $isActive ? 'text-emerald-600' : 'text-red-500' }}">
                 {{ $isActive ? 'Hoạt động' : 'Ngừng' }}
             </h3>
         </div>
     </div>

     <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

         <div class="xl:col-span-2 space-y-8">

             <div class="bg-white rounded-[32px] border {{ $theme['border'] }} shadow-sm overflow-hidden">
                 <div class="px-6 py-5 border-b {{ $theme['border'] }}">
                     <h2 class="text-xl font-black text-slate-900">
                         Mô tả môn học
                     </h2>

                     <p class="text-sm text-slate-500 font-semibold mt-1">
                         Thông tin tổng quan về môn học.
                     </p>
                 </div>

                 <div class="p-6">
                     <div class="rounded-2xl {{ $theme['mainBg'] }} border {{ $theme['border'] }} p-5">
                         <p class="text-slate-600 leading-8 font-semibold">
                             {{ $subject->description ?: 'Chưa có mô tả cho môn học này.' }}
                         </p>
                     </div>
                 </div>
             </div>

             <div class="bg-white rounded-[32px] border {{ $theme['border'] }} shadow-sm overflow-hidden">
                 <div
                     class="px-6 py-5 border-b {{ $theme['border'] }} flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                     <div>
                         <h2 class="text-xl font-black text-slate-900">
                             Tài liệu môn học
                         </h2>

                         <p class="text-sm text-slate-500 font-semibold mt-1">
                             Danh sách học liệu thuộc môn học này.
                         </p>
                     </div>

                     <span
                         class="px-4 py-2 rounded-full {{ $theme['mainBg'] }} {{ $theme['mainText'] }} text-xs font-black border {{ $theme['border'] }}">
                         {{ number_format($totalDocuments) }} tài liệu
                     </span>
                 </div>

                 <div class="divide-y {{ $theme['border'] }}">
                     @forelse($subject->documents as $document)
                     @php
                     $extension = $document->currentVersion->file_extension ?? 'file';
                     $documentType = $document->documentType->type_name ?? 'Chưa phân loại';
                     @endphp

                     <div
                         class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-5 {{ $theme['hoverBg'] }} transition">
                         <div class="flex items-center gap-4 min-w-0">
                             <div
                                 class="w-12 h-12 rounded-2xl {{ $theme['mainBg'] }} {{ $theme['iconText'] }} flex items-center justify-center border {{ $theme['border'] }} flex-shrink-0">
                                 <i class="fa-solid fa-file-lines fa-fw"></i>
                             </div>

                             <div class="min-w-0">
                                 <h3 class="font-black text-slate-900 truncate">
                                     {{ $document->title }}
                                 </h3>

                                 <div class="flex flex-wrap items-center gap-2 mt-2">
                                     <span
                                         class="px-3 py-1 rounded-full {{ $theme['mainBg'] }} {{ $theme['mainText'] }} text-xs font-black border {{ $theme['border'] }} uppercase">
                                         {{ strtoupper($extension) }}
                                     </span>

                                     <span
                                         class="px-3 py-1 rounded-full bg-slate-50 text-slate-500 text-xs font-black border border-slate-100">
                                         {{ $documentType }}
                                     </span>

                                     <span
                                         class="px-3 py-1 rounded-full bg-slate-50 text-slate-500 text-xs font-black border border-slate-100">
                                         {{ number_format($document->download_count ?? 0) }} lượt tải
                                     </span>
                                 </div>
                             </div>
                         </div>

                         @if(Route::has('admin.documents.show'))
                         <a href="{{ route('admin.documents.show', $document->document_id) }}"
                             class="w-11 h-11 rounded-xl {{ $theme['mainBg'] }} {{ $theme['iconText'] }} hover:bg-slate-900 hover:text-white flex items-center justify-center transition"
                             title="Xem tài liệu">
                             <i class="fa-solid fa-eye fa-fw"></i>
                         </a>
                         @endif
                     </div>
                     @empty
                     <div class="px-6 py-16 text-center">
                         <div
                             class="w-20 h-20 mx-auto rounded-3xl {{ $theme['mainBg'] }} {{ $theme['iconText'] }} flex items-center justify-center mb-5">
                             <i class="fa-solid fa-file-circle-xmark text-3xl"></i>
                         </div>

                         <h3 class="text-2xl font-black text-slate-900">
                             Chưa có tài liệu
                         </h3>

                         <p class="text-slate-500 font-semibold mt-2">
                             Môn học này hiện chưa có học liệu nào.
                         </p>
                     </div>
                     @endforelse
                 </div>
             </div>

         </div>

         <div class="space-y-6">

             <div class="bg-white rounded-[32px] border {{ $theme['border'] }} shadow-sm overflow-hidden">
                 <div class="px-6 py-5 border-b {{ $theme['border'] }}">
                     <h2 class="text-xl font-black text-slate-900">
                         Giảng viên phụ trách
                     </h2>

                     <p class="text-sm text-slate-500 font-semibold mt-1">
                         Danh sách giảng viên được phân công.
                     </p>
                 </div>

                 <div class="p-6 space-y-4">
                     @forelse($subject->lecturers as $teacher)
                     <div
                         class="flex items-center gap-4 p-4 rounded-2xl {{ $theme['mainBg'] }} border {{ $theme['border'] }}">
                         <img src="{{ $teacher->avatar ? asset('storage/' . $teacher->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->full_name) . '&background=06b6d4&color=fff' }}"
                             class="w-12 h-12 rounded-2xl object-cover">

                         <div class="min-w-0">
                             <h3 class="font-black text-slate-900 truncate">
                                 {{ $teacher->full_name }}
                             </h3>

                             <p class="text-sm text-slate-500 font-semibold truncate">
                                 {{ $teacher->email }}
                             </p>
                         </div>
                     </div>
                     @empty
                     <div class="rounded-2xl bg-slate-50 border border-slate-100 p-5 text-slate-600 font-bold text-sm">
                         <i class="fa-solid fa-user-plus mr-2"></i>
                         Chưa phân công giảng viên.
                     </div>
                     @endforelse
                 </div>
             </div>

             <div class="bg-white rounded-[32px] border {{ $theme['border'] }} shadow-sm p-6">
                 <h2 class="text-xl font-black text-slate-900 mb-5">
                     Thao tác nhanh
                 </h2>

                 <div class="space-y-3">
                     <a href="{{ route('admin.subjects.edit', $subject->subject_code) }}"
                         class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl {{ $theme['button'] }} text-white font-black transition">
                         <i class="fa-solid fa-pen fa-fw"></i>
                         Chỉnh sửa môn học
                     </a>

                     <form action="{{ route('admin.subjects.status', $subject->subject_code) }}" method="POST">
                         @csrf
                         @method('PATCH')

                         <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl
                            {{ $isActive
                                ? 'bg-orange-50 text-orange-500 hover:bg-orange-500 border-orange-100'
                                : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-500 border-emerald-100' }}
                            hover:text-white transition border">

                             @if($isActive)
                             <i class="fa-solid fa-ban fa-fw"></i>
                             Ngừng hoạt động
                             @else
                             <i class="fa-solid fa-rotate-left fa-fw"></i>
                             Kích hoạt lại
                             @endif
                         </button>
                     </form>
                 </div>
             </div>

         </div>

     </div>

 </div>

 @endsection