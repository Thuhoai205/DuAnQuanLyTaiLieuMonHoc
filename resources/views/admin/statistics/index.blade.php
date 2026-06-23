 @extends('layouts.admin')

 @section('title', 'Thống kê')
 @section('page-title', 'Thống kê')

 @section('content')

 @php
 $monthLabels = [
 1 => 'T1',
 2 => 'T2',
 3 => 'T3',
 4 => 'T4',
 5 => 'T5',
 6 => 'T6',
 7 => 'T7',
 8 => 'T8',
 9 => 'T9',
 10 => 'T10',
 11 => 'T11',
 12 => 'T12',
 ];

 $chartMap = collect($chartData ?? [])->pluck('total', 'month');
 $maxChartValue = max((int) ($chartMap->max() ?? 0), 1);

 $topDownloads = $topDownloads ?? collect();
 $documentsByType = $documentsByType ?? collect();
 $recentDownloads = $recentDownloads ?? collect();

 $topDocumentTypes = $documentsByType->take(5);
 $latestDownloads = $recentDownloads->take(5);

 $maxTypeValue = max((int) ($topDocumentTypes->max('documents_count') ?? 0), 1);
 @endphp

 <div class="max-w-7xl mx-auto px-2 lg:px-4">

     <div class="mb-6 flex items-center justify-between">
         <div>
             <h1 class="text-2xl font-black text-slate-700"> Thống kê hệ thống
             </h1>

             <p class="text-slate-500 font-semibold mt-2">
                 Theo dõi tổng quan tài liệu, lượt tải, loại tài liệu và hoạt động tải gần đây.
             </p>
         </div>

         <div
             class="w-16 h-16 rounded-3xl bg-cyan-50 text-cyan-600 border rounded-md flex items-center justify-center shadow-sm">
             <i class="fa-solid fa-chart-column text-2xl"></i>
         </div>
     </div>

     <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

         <div
             class="group bg-white rounded-md border rounded-md p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-cyan-100/70 transition-all">
             <div class="flex items-center justify-between">
                 <div>
                     <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                         Tổng tài liệu
                     </p>

                     <h3 class="text-4xl font-black text-cyan-700 mt-2">
                         {{ number_format($totalDocuments ?? 0) }}
                     </h3>
                 </div>

                 <div
                     class="w-11 h-11 rounded-md bg-cyan-50 text-cyan-600 flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white transition">
                     <i class="fa-solid fa-file-lines text-xl"></i>
                 </div>
             </div>
         </div>

         <div
             class="group bg-white rounded-md border rounded-md p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-amber-100/70 transition-all">
             <div class="flex items-center justify-between">
                 <div>
                     <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                         Tổng lượt tải
                     </p>

                     <h3 class="text-4xl font-black text-amber-700 mt-2">
                         {{ number_format($totalDownloads ?? 0) }}
                     </h3>
                 </div>

                 <div
                     class="w-11 h-11 rounded-md bg-amber-50 text-amber-600 flex items-center justify-center group-hover:bg-amber-500 group-hover:text-white transition">
                     <i class="fa-solid fa-download text-xl"></i>
                 </div>
             </div>
         </div>

         <div
             class="group bg-white rounded-md border rounded-md p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-purple-100/70 transition-all">
             <div class="flex items-center justify-between">
                 <div>
                     <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                         Loại tài liệu
                     </p>

                     <h3 class="text-4xl font-black text-purple-700 mt-2">
                         {{ number_format($totalTypes ?? 0) }}
                     </h3>
                 </div>

                 <div
                     class="w-11 h-11 rounded-md bg-purple-50 text-purple-600 flex items-center justify-center group-hover:bg-purple-500 group-hover:text-white transition">
                     <i class="fa-solid fa-folder-tree text-xl"></i>
                 </div>
             </div>
         </div>

         <div
             class="group bg-white rounded-md border rounded-md p-6 shadow-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-100/70 transition-all">
             <div class="flex items-center justify-between">
                 <div>
                     <p class="text-xs font-black uppercase tracking-wider text-slate-400">
                         Người dùng
                     </p>

                     <h3 class="text-4xl font-black text-emerald-700 mt-2">
                         {{ number_format($totalUsers ?? 0) }}
                     </h3>
                 </div>

                 <div
                     class="w-11 h-11 rounded-md bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-slate-1000 group-hover:text-white transition">
                     <i class="fa-solid fa-users text-xl"></i>
                 </div>
             </div>
         </div>

     </div>

     <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">

         <div
             class="xl:col-span-8 bg-white rounded-md border rounded-md shadow-[0_15px_45px_rgba(8,145,178,0.08)] overflow-hidden">
             <div
                 class="px-5 py-4 border-b border-slate-200from-cyan-50 to-sky-50 border-b rounded-md flex items-center justify-between gap-4">
                 <div>
                     <h2 class="text-xl font-black text-slate-900">
                         Biểu đồ lượt tải
                     </h2>

                     <p class="text-sm text-slate-500 font-semibold mt-1">
                         Thống kê lượt tải tài liệu theo từng tháng trong năm {{ now()->year }}.
                     </p>
                 </div>

                 <span class="px-3 py-1 rounded bg-slate-100 text-slate-500 text-xs font-black"> {{ now()->year }}
                 </span>
             </div>

             <div class="p-7">
                 <div class="h-[320px] flex items-end gap-3 border-b border-slate-200 px-2">
                     @foreach($monthLabels as $monthNumber => $monthName)
                     @php
                     $value = (int) $chartMap->get($monthNumber, 0);
                     $percent = $maxChartValue > 0 ? ($value / $maxChartValue) * 100 : 0;

                     if ($value <= 0) { $heightClass='h-[6px]' ; } elseif ($percent <=20) { $heightClass='h-[44px]' ; }
                         elseif ($percent <=40) { $heightClass='h-[88px]' ; } elseif ($percent <=60) {
                         $heightClass='h-[132px]' ; } elseif ($percent <=80) { $heightClass='h-[176px]' ; } else {
                         $heightClass='h-[220px]' ; } @endphp <div
                         class="flex flex-1 h-full flex-col items-center justify-end gap-3">
                         <span class="text-xs font-black {{ $value > 0 ? 'text-cyan-700' : 'text-slate-400' }}">
                             {{ $value }}
                         </span>

                         <div class="h-[220px] w-full flex items-end justify-center">
                             <div
                                 class="w-full max-w-[46px] {{ $heightClass }} rounded-t-2xl bg-gradient-to-t from-cyan-600 to-sky-400 hover:opacity-80 transition">
                             </div>
                         </div>

                         <span class="pb-3 text-sm font-black text-slate-500">
                             {{ $monthName }}
                         </span>
                 </div>
                 @endforeach
             </div>

             @if(($totalDownloads ?? 0) == 0)
             <div class="mt-5 rounded-md bg-amber-50 border rounded-md px-5 py-4 text-sm font-bold text-amber-700">
                 <i class="fa-solid fa-circle-info mr-2"></i>
                 Chưa có dữ liệu lượt tải. Hãy seed dữ liệu vào bảng <span class="font-black">download_histories</span>.
             </div>
             @endif
         </div>
     </div>

     <div
         class="xl:col-span-4 bg-white rounded-md border rounded-md shadow-[0_15px_45px_rgba(245,158,11,0.08)] overflow-hidden">
         <div
             class="px-5 py-4 border-b border-slate-200from-amber-50 to-orange-50 border-b rounded-md flex items-center justify-between">
             <div>
                 <h2 class="text-xl font-black text-slate-900">
                     Top 5 Download
                 </h2>

                 <p class="text-sm text-slate-500 font-semibold mt-1">
                     5 tài liệu có lượt tải cao nhất.
                 </p>
             </div>

             <i class="fa-solid fa-ranking-star text-amber-500 text-xl"></i>
         </div>

         <div class="p-6 space-y-4">
             @forelse($topDownloads->take(5) as $index => $doc)
             @php
             $title = $doc->title ?? 'Không có tiêu đề';
             $downloads = (int) ($doc->download_count ?? 0);
             @endphp

             <div
                 class="flex items-center gap-4 rounded-md bg-slate-50 border border-slate-100 p-4 hover:bg-amber-50 hover:rounded-md transition">
                 <div
                     class="w-11 h-11 rounded-md bg-slate-100 text-amber-700 flex items-center justify-center text-sm font-black">
                     #{{ $index + 1 }}
                 </div>

                 <div class="min-w-0 flex-1">
                     <p class="truncate font-black text-slate-800">
                         {{ $title }}
                     </p>

                     <p class="text-sm text-slate-500 font-semibold mt-1">
                         {{ number_format($downloads) }} lượt tải
                     </p>
                 </div>
             </div>
             @empty
             <div class="py-12 text-center">
                 <div
                     class="w-16 h-16 rounded-3xl bg-amber-50 text-amber-500 mx-auto flex items-center justify-center mb-4">
                     <i class="fa-solid fa-download text-2xl"></i>
                 </div>

                 <p class="text-sm text-slate-500 font-bold">
                     Chưa có dữ liệu tải xuống.
                 </p>
             </div>
             @endforelse
         </div>
     </div>

 </div>

 <div class="mt-8 grid grid-cols-1 xl:grid-cols-12 gap-8">

     <div
         class="xl:col-span-7 bg-white rounded-md border rounded-md shadow-[0_15px_45px_rgba(168,85,247,0.08)] overflow-hidden">
         <div
             class="px-5 py-4 border-b border-slate-200from-purple-50 to-violet-50 border-b rounded-md flex items-center justify-between">
             <div>
                 <h2 class="text-xl font-black text-slate-900">
                     Top 5 loại tài liệu
                 </h2>

                 <p class="text-sm text-slate-500 font-semibold mt-1">
                     5 loại tài liệu có số lượng tài liệu cao nhất.
                 </p>
             </div>

             <i class="fa-solid fa-folder-tree text-purple-500 text-xl"></i>
         </div>

         <div class="p-7 space-y-6">
             @forelse($topDocumentTypes as $type)
             @php
             $typeName = $type->type_name ?? 'Không xác định';
             $typeCount = (int) ($type->documents_count ?? 0);
             $percent = $maxTypeValue > 0 ? ($typeCount / $maxTypeValue) * 100 : 0;

             if ($typeCount <= 0) { $widthClass='w-[2%]' ; } elseif ($percent <=20) { $widthClass='w-[20%]' ; } elseif
                 ($percent <=40) { $widthClass='w-[40%]' ; } elseif ($percent <=60) { $widthClass='w-[60%]' ; } elseif
                 ($percent <=80) { $widthClass='w-[80%]' ; } else { $widthClass='w-full' ; } @endphp <div>
                 <div class="mb-2 flex items-center justify-between gap-4">
                     <span class="font-black text-slate-800 truncate">
                         {{ $typeName }}
                     </span>

                     <span class="text-sm text-slate-500 font-bold whitespace-nowrap">
                         {{ number_format($typeCount) }} tài liệu
                     </span>
                 </div>

                 <div class="h-4 overflow-hidden rounded-full bg-slate-100">
                     <div class="h-full {{ $widthClass }} rounded-full bg-sky-500">
                     </div>
                 </div>
         </div>
         @empty
         <div class="py-12 text-center">
             <div
                 class="w-16 h-16 rounded-3xl bg-purple-50 text-purple-500 mx-auto flex items-center justify-center mb-4">
                 <i class="fa-solid fa-folder-open text-2xl"></i>
             </div>

             <p class="text-sm text-slate-500 font-bold">
                 Chưa có loại tài liệu nào.
             </p>
         </div>
         @endforelse
     </div>
 </div>

 <div
     class="xl:col-span-5 bg-white rounded-md border rounded-md shadow-[0_15px_45px_rgba(16,185,129,0.08)] overflow-hidden">
     <div
         class="px-5 py-4 border-b border-slate-200from-emerald-50 to-green-50 border-b rounded-md flex items-center justify-between">
         <div>
             <h2 class="text-xl font-black text-slate-900">
                 5 hoạt động tải gần đây
             </h2>

             <p class="text-sm text-slate-500 font-semibold mt-1">
                 5 lượt tải tài liệu mới nhất.
             </p>
         </div>

         <i class="fa-solid fa-clock-rotate-left text-emerald-500 text-xl"></i>
     </div>

     <div class="p-6 space-y-4">
         @forelse($latestDownloads as $item)
         @php
         $userName = $item->user->full_name ?? 'Khách';
         $documentTitle = $item->version?->document?->title ?? 'Tài liệu đã xóa';
         $downloadTime = $item->downloaded_at ?? null;
         @endphp

         <div
             class="flex gap-4 rounded-md bg-slate-50 border border-slate-100 p-4 hover:bg-slate-100 hover:rounded-md transition">
             <div class="mt-1 w-3 h-3 rounded-full bg-emerald-500 shrink-0"></div>

             <div class="min-w-0 flex-1">
                 <p class="text-sm font-bold text-slate-700 leading-6">
                     <span class="font-black text-slate-900">
                         {{ $userName }}
                     </span>
                     đã tải
                     <span class="font-black text-emerald-700">
                         {{ $documentTitle }}
                     </span>
                 </p>

                 <p class="mt-1 text-xs text-slate-400 font-bold">
                     @if($downloadTime)
                     {{ \Carbon\Carbon::parse($downloadTime)->diffForHumans() }}
                     @else
                     Không rõ thời gian
                     @endif
                 </p>
             </div>
         </div>
         @empty
         <div class="py-12 text-center">
             <div
                 class="w-16 h-16 rounded-3xl bg-emerald-50 text-emerald-500 mx-auto flex items-center justify-center mb-4">
                 <i class="fa-solid fa-clock text-2xl"></i>
             </div>

             <p class="text-sm text-slate-500 font-bold">
                 Chưa có hoạt động tải nào.
             </p>
         </div>
         @endforelse
     </div>
 </div>

 </div>

 </div>

 @endsection