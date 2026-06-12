 @extends('layouts.admin')

 @section('title', 'Chi tiết loại tài liệu')
 @section('page-title', 'Chi tiết loại tài liệu')

 @section('content')

 @php
 $colorMap = [
 'cyan' => [
 'header' => 'from-cyan-600 to-sky-500',
 'iconBox' => 'bg-cyan-400/30 border-cyan-200/40',
 'soft' => 'bg-cyan-50 text-cyan-700 border-cyan-100',
 ],
 'blue' => [
 'header' => 'from-blue-600 to-sky-500',
 'iconBox' => 'bg-blue-400/30 border-blue-200/40',
 'soft' => 'bg-blue-50 text-blue-700 border-blue-100',
 ],
 'orange' => [
 'header' => 'from-orange-600 to-amber-500',
 'iconBox' => 'bg-orange-400/30 border-orange-200/40',
 'soft' => 'bg-orange-50 text-orange-700 border-orange-100',
 ],
 'purple' => [
 'header' => 'from-purple-600 to-violet-500',
 'iconBox' => 'bg-purple-400/30 border-purple-200/40',
 'soft' => 'bg-purple-50 text-purple-700 border-purple-100',
 ],
 'green' => [
 'header' => 'from-green-600 to-emerald-500',
 'iconBox' => 'bg-green-400/30 border-green-200/40',
 'soft' => 'bg-green-50 text-green-700 border-green-100',
 ],
 'indigo' => [
 'header' => 'from-indigo-600 to-blue-500',
 'iconBox' => 'bg-indigo-400/30 border-indigo-200/40',
 'soft' => 'bg-indigo-50 text-indigo-700 border-indigo-100',
 ],
 'red' => [
 'header' => 'from-red-600 to-rose-500',
 'iconBox' => 'bg-red-400/30 border-red-200/40',
 'soft' => 'bg-red-50 text-red-700 border-red-100',
 ],
 'emerald' => [
 'header' => 'from-emerald-600 to-green-500',
 'iconBox' => 'bg-emerald-400/30 border-emerald-200/40',
 'soft' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
 ],
 ];

 $color = $documentType->color ?: 'cyan';
 $theme = $colorMap[$color] ?? $colorMap['cyan'];

 $icon = $documentType->icon ?: 'fa-solid fa-file-lines';
 $count = $documentType->documents_count ?? 0;
 @endphp

 <div class="max-w-6xl mx-auto px-2 lg:px-4">

     <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
         <div>
             <h1 class="text-3xl font-black text-slate-900">
                 Chi tiết loại tài liệu
             </h1>

             <p class="text-slate-500 font-semibold mt-2">
                 Xem thông tin chi tiết của loại tài liệu trong hệ thống.
             </p>
         </div>

         <div class="flex flex-wrap items-center gap-3">
             <a href="{{ route('admin.document-types.index') }}"
                 class="inline-flex items-center gap-3 px-5 py-3 rounded-2xl bg-white border border-slate-200 text-slate-700 font-black shadow-sm hover:bg-slate-50 transition">
                 <span class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center">
                     <i class="fa-solid fa-arrow-left"></i>
                 </span>
                 Quay lại
             </a>


         </div>
     </div>

     <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

         <div class="xl:col-span-1">
             <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden">

                 <div class="bg-gradient-to-r {{ $theme['header'] }} px-6 py-8 text-white">
                     <div
                         class="w-24 h-24 rounded-3xl {{ $theme['iconBox'] }} border flex items-center justify-center mb-5">
                         <i class="{{ $icon }} text-4xl"></i>
                     </div>

                     <span
                         class="inline-flex px-4 py-2 rounded-full bg-white/20 text-white text-xs font-black border border-white/20 mb-4">
                         Mã loại #{{ $documentType->document_type_id }}
                     </span>

                     <h2 class="text-3xl font-black leading-tight">
                         {{ $documentType->type_name }}
                     </h2>

                     <p class="text-white/90 font-semibold mt-3 leading-6">
                         {{ $documentType->description ?: 'Chưa có mô tả cho loại tài liệu này.' }}
                     </p>
                 </div>

                 <div class="p-6 space-y-4">
                     <div class="flex items-center justify-between rounded-2xl {{ $theme['soft'] }} border px-4 py-3">
                         <span class="text-sm font-bold text-slate-500">
                             Màu hiển thị
                         </span>

                         <span class="text-sm font-black">
                             {{ ucfirst($color) }}
                         </span>
                     </div>

                     <div
                         class="flex items-center justify-between rounded-2xl bg-slate-50 border border-slate-100 px-4 py-3">
                         <span class="text-sm font-bold text-slate-500">
                             Icon
                         </span>

                         <span class="text-sm font-black text-slate-700">
                             <i class="{{ $icon }} mr-2"></i>
                             {{ $icon }}
                         </span>
                     </div>

                     <div
                         class="rounded-2xl bg-amber-50 border border-amber-100 px-4 py-3 text-sm font-bold text-amber-700">
                         <i class="fa-solid fa-circle-info mr-2"></i>
                         Loại tài liệu dùng để phân loại tài liệu khi giảng viên upload học liệu.
                     </div>
                 </div>

             </div>
         </div>

         <div class="xl:col-span-2 space-y-6">

             <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                 <div class="bg-white rounded-[28px] border border-cyan-100 p-6 shadow-sm">
                     <div class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-4">
                         <i class="fa-solid fa-file-lines text-xl"></i>
                     </div>

                     <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                         Số tài liệu
                     </p>

                     <h3 class="text-4xl font-black text-cyan-700 mt-2">
                         {{ number_format($count) }}
                     </h3>
                 </div>

                 <div class="bg-white rounded-[28px] border border-emerald-100 p-6 shadow-sm">
                     <div
                         class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
                         <i class="fa-solid fa-toggle-on text-xl"></i>
                     </div>

                     <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                         Trạng thái
                     </p>

                     @if($documentType->is_active)
                     <h3 class="text-xl font-black text-emerald-600 mt-3">
                         Hoạt động
                     </h3>
                     @else
                     <h3 class="text-xl font-black text-red-500 mt-3">
                         Ngừng hoạt động
                     </h3>
                     @endif
                 </div>

                 <div class="bg-white rounded-[28px] border border-purple-100 p-6 shadow-sm">
                     <div
                         class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center mb-4">
                         <i class="fa-solid fa-calendar-days text-xl"></i>
                     </div>

                     <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                         Ngày tạo
                     </p>

                     <h3 class="text-lg font-black text-purple-700 mt-3">
                         {{ $documentType->created_at ? $documentType->created_at->format('d/m/Y') : 'N/A' }}
                     </h3>
                 </div>
             </div>

             <div class="bg-white rounded-[32px] border border-cyan-100 shadow-sm overflow-hidden">
                 <div class="px-6 py-5 border-b border-cyan-100 bg-cyan-50/40">
                     <h2 class="text-xl font-black text-slate-900">
                         Thông tin chi tiết
                     </h2>

                     <p class="text-sm text-slate-500 font-semibold mt-1">
                         Các thông tin lưu trữ của loại tài liệu.
                     </p>
                 </div>

                 <div class="p-6 space-y-4">
                     <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-b border-slate-100 pb-4">
                         <div class="text-sm font-black text-slate-500">
                             Mã loại
                         </div>

                         <div class="md:col-span-2 text-sm font-bold text-slate-800">
                             #{{ $documentType->document_type_id }}
                         </div>
                     </div>

                     <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-b border-slate-100 pb-4">
                         <div class="text-sm font-black text-slate-500">
                             Tên loại tài liệu
                         </div>

                         <div class="md:col-span-2 text-sm font-bold text-slate-800">
                             {{ $documentType->type_name }}
                         </div>
                     </div>

                     <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-b border-slate-100 pb-4">
                         <div class="text-sm font-black text-slate-500">
                             Mô tả
                         </div>

                         <div class="md:col-span-2 text-sm font-bold text-slate-800 leading-6">
                             {{ $documentType->description ?: 'Chưa có mô tả' }}
                         </div>
                     </div>

                     <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-b border-slate-100 pb-4">
                         <div class="text-sm font-black text-slate-500">
                             Trạng thái
                         </div>

                         <div class="md:col-span-2">
                             @if($documentType->is_active)
                             <span
                                 class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 text-emerald-600 text-xs font-black border border-emerald-100">
                                 <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                 Hoạt động
                             </span>
                             @else
                             <span
                                 class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-50 text-red-500 text-xs font-black border border-red-100">
                                 <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                 Ngừng hoạt động
                             </span>
                             @endif
                         </div>
                     </div>

                     <div class="grid grid-cols-1 md:grid-cols-3 gap-4 border-b border-slate-100 pb-4">
                         <div class="text-sm font-black text-slate-500">
                             Ngày cập nhật
                         </div>

                         <div class="md:col-span-2 text-sm font-bold text-slate-800">
                             {{ $documentType->updated_at ? $documentType->updated_at->format('d/m/Y H:i') : 'N/A' }}
                         </div>
                     </div>

                     <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                         <div class="text-sm font-black text-slate-500">
                             Ngày tạo
                         </div>

                         <div class="md:col-span-2 text-sm font-bold text-slate-800">
                             {{ $documentType->created_at ? $documentType->created_at->format('d/m/Y H:i') : 'N/A' }}
                         </div>
                     </div>
                 </div>
             </div>

             <div class="flex flex-col sm:flex-row justify-end gap-3">
                 <form action="{{ route('admin.document-types.status', $documentType->document_type_id) }}"
                     method="POST">
                     @csrf
                     @method('PATCH')

                     <button type="submit" class="w-full sm:w-auto px-5 py-3 rounded-xl font-black transition
                        {{ $documentType->is_active
                            ? 'bg-orange-50 text-orange-600 hover:bg-orange-500 hover:text-white'
                            : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white' }}">
                         @if($documentType->is_active)
                         <i class="fa-solid fa-ban mr-2"></i>
                         Ngừng hoạt động
                         @else
                         <i class="fa-solid fa-rotate-left mr-2"></i>
                         Kích hoạt lại
                         @endif
                     </button>
                 </form>

                 <a href="{{ route('admin.document-types.edit', $documentType->document_type_id) }}"
                     class="w-full sm:w-auto px-5 py-3 rounded-xl bg-cyan-600 text-white font-black hover:bg-cyan-700 transition text-center">
                     <i class="fa-solid fa-pen mr-2"></i>
                     Chỉnh sửa
                 </a>
             </div>

         </div>

     </div>

 </div>

 @endsection