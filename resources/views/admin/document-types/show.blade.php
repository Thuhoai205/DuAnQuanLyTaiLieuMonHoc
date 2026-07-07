@extends('layouts.admin')

@section('title', 'Chi tiết loại tài liệu')
@section('page-title', 'Chi tiết loại tài liệu')

@section('content')

@php
$isActive = $documentType->is_active;
@endphp

<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

            <div>

                <h2 class="text-2xl font-black text-slate-800">

                    {{ $documentType->type_name }}

                </h2>

                <p class="mt-2 text-sm text-slate-500">

                    Thông tin chi tiết loại tài liệu trong hệ thống.

                </p>

            </div>

            <div class="flex items-center gap-3">

                <!-- STATUS -->
                <span class="inline-flex
                    items-center
                    gap-2
                    rounded-full
                    px-4
                    py-2
                    text-sm
                    font-bold
                    {{ $isActive
                        ? 'bg-emerald-50 text-emerald-600'
                        : 'bg-red-50 text-red-600' }}">

                    <span class="w-2 h-2 rounded-full
                        {{ $isActive
                            ? 'bg-emerald-500'
                            : 'bg-red-500' }}"></span>

                    {{ $isActive ? 'Hoạt động' : 'Đã khóa' }}

                </span>

                <!-- BACK -->
                <a href="{{ urldecode(request('return', route('admin.document-types.index'))) }}" class="inline-flex
                    items-center
                    gap-2
                    h-11
                    px-5
                    rounded-xl
                    border
                    border-slate-200
                    bg-white
                    text-slate-700
                    text-sm
                    font-semibold
                    hover:bg-slate-50
                    transition-all duration-300">

                    <i class="fa-solid fa-arrow-left"></i>

                    Quay lại

                </a>

            </div>

        </div>

    </div>

    <!-- MAIN CONTENT -->
    <div class="grid grid-cols-12 gap-6">

        <!-- LEFT -->
        <div class="col-span-12 xl:col-span-4 space-y-6">

            <!-- BASIC INFO -->
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

                <div class="px-6 py-5 bg-slate-50 border-b border-slate-200">

                    <h3 class="text-base font-black text-slate-800">

                        Thông tin cơ bản

                    </h3>

                </div>

                <div class="p-6 space-y-5">
                    <!-- TÊN LOẠI -->
                    <div class="flex justify-between items-center">

                        <span class="text-sm font-semibold text-slate-500">

                            Tên loại

                        </span>

                        <span class="font-black text-slate-800">

                            {{ $documentType->type_name }}

                        </span>

                    </div>

                    <!-- SỐ TÀI LIỆU -->
                    <div class="flex justify-between items-center">

                        <span class="text-sm font-semibold text-slate-500">

                            Số tài liệu

                        </span>

                        <span class="font-black text-amber-500">

                            {{ number_format($documentType->documents_count) }}

                        </span>

                    </div>

                    <!-- TRẠNG THÁI -->
                    <div class="flex justify-between items-center">

                        <span class="text-sm font-semibold text-slate-500">

                            Trạng thái

                        </span>

                        @if($isActive)

                        <span class="inline-flex
                            items-center
                            gap-2
                            rounded-full
                            bg-emerald-50
                            px-3
                            py-1
                            text-xs
                            font-bold
                            text-emerald-600">

                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>

                            Hoạt động

                        </span>

                        @else

                        <span class="inline-flex
                            items-center
                            gap-2
                            rounded-full
                            bg-red-50
                            px-3
                            py-1
                            text-xs
                            font-bold
                            text-red-600">

                            <span class="w-2 h-2 rounded-full bg-red-500"></span>

                            Đã khóa

                        </span>

                        @endif

                    </div>

                    <!-- NGÀY TẠO -->
                    <div class="flex justify-between items-center">

                        <span class="text-sm font-semibold text-slate-500">

                            Ngày tạo

                        </span>

                        <span class="font-bold text-slate-700">

                            {{ optional($documentType->created_at)->format('d/m/Y') }}

                        </span>

                    </div>

                    <!-- CẬP NHẬT -->
                    <div class="flex justify-between items-center">

                        <span class="text-sm font-semibold text-slate-500">

                            Cập nhật

                        </span>

                        <span class="font-bold text-slate-700">

                            {{ optional($documentType->updated_at)->format('d/m/Y') }}

                        </span>

                    </div>

                </div>

            </div>

            <!-- ACTION -->
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

                <div class="px-6 py-5 bg-slate-50 border-b border-slate-200">

                    <h3 class="text-base font-black text-slate-800">

                        Thao tác

                    </h3>

                </div>

                <div class="p-5 space-y-3">

                    <!-- EDIT -->
                    <a href="{{ route('admin.document-types.edit',$documentType->document_type_id) }}" class="w-full
                        inline-flex
                        items-center
                        gap-3
                        rounded-xl
                        bg-amber-50
                        px-4
                        py-3
                        text-sm
                        font-semibold
                        text-amber-600
                        hover:bg-amber-500
                        hover:text-white
                        transition-all duration-300">

                        <i class="fa-solid fa-pen w-5"></i>

                        Chỉnh sửa

                    </a>

                    <!-- STATUS -->
                    <button type="button" onclick="toggleStatus('{{ $documentType->document_type_id }}')" class="w-full
                        inline-flex
                        items-center
                        gap-3
                        rounded-xl
                        px-4
                        py-3
                        text-sm
                        font-semibold
                        transition-all duration-300

                        {{ $isActive
                            ? 'bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white'
                            : 'bg-yellow-50 text-yellow-600 hover:bg-yellow-500 hover:text-white'
                        }}">

                        <i class="fa-solid {{ $isActive ? 'fa-lock-open' : 'fa-lock' }} w-5"></i>

                        {{ $isActive ? 'Khóa loại tài liệu' : 'Mở khóa loại tài liệu' }}

                    </button>

                    <!-- BACK -->
                    <a href="{{ route('admin.document-types.index') }}" class="w-full
                        inline-flex
                        items-center
                        gap-3
                        rounded-xl
                        border
                        border-slate-200
                        bg-white
                        px-4
                        py-3
                        text-sm
                        font-semibold
                        text-slate-700
                        hover:bg-slate-50
                        transition-all duration-300">

                        <i class="fa-solid fa-list w-5"></i>

                        Danh sách loại tài liệu

                    </a>

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="col-span-12 xl:col-span-8 space-y-6">
            <!-- MÔ TẢ -->
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

                <!-- HEADER -->
                <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

                    <h3 class="text-base font-black text-slate-800">

                        Mô tả loại tài liệu

                    </h3>

                    <p class="mt-1 text-sm text-slate-500">

                        Thông tin mô tả và mục đích sử dụng của loại tài liệu.

                    </p>

                </div>

                <!-- BODY -->
                <div class="p-6">

                    @if($documentType->description)

                    <div class="leading-8 text-slate-700 text-[15px]">

                        {!! nl2br(e($documentType->description)) !!}

                    </div>

                    @else

                    <div class="flex flex-col items-center py-10">

                        <div class="w-16 h-16 rounded-full bg-amber-50 flex items-center justify-center">

                            <i class="fa-solid fa-align-left text-2xl text-amber-400"></i>

                        </div>

                        <h4 class="mt-4 font-black text-slate-700">

                            Chưa có mô tả

                        </h4>

                        <p class="mt-2 text-sm text-slate-500">

                            Loại tài liệu này chưa được cập nhật mô tả.

                        </p>

                    </div>

                    @endif

                </div>

            </div>

            <!-- DANH SÁCH TÀI LIỆU -->
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

                <!-- HEADER -->
                <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">

                    <div>

                        <h3 class="text-base font-black text-slate-800">

                            Tài liệu thuộc loại này

                        </h3>

                        <p class="mt-1 text-sm text-slate-500">

                            Hiển thị tối đa 5 tài liệu gần nhất.

                        </p>

                    </div>

                    <span class="inline-flex
                        items-center
                        rounded-full
                        bg-amber-50
                        border
                        border-amber-100
                        px-4
                        py-2
                        text-sm
                        font-bold
                        text-amber-600">

                        {{ $documentType->documents_count }} tài liệu

                    </span>

                </div>

                <!-- BODY -->
                <div class="divide-y divide-slate-100">

                    @forelse($documentType->documents->take(5) as $doc)

                    <div
                        class="flex items-center justify-between px-6 py-4 hover:bg-amber-50/40 transition-all duration-300">

                        <div class="flex items-center gap-4">

                            <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center">

                                <i class="fa-solid fa-file-lines text-amber-500"></i>

                            </div>

                            <div>

                                <h4 class="font-black text-slate-800">

                                    {{ $doc->title }}

                                </h4>

                                <p class="mt-1 text-xs text-slate-500">

                                    {{ optional($doc->subject)->subject_name ?? 'Không có môn học' }}

                                </p>

                            </div>

                        </div>

                        <div class="text-right">

                            <p class="text-sm font-semibold text-slate-600">

                                {{ optional($doc->created_at)->format('d/m/Y') }}

                            </p>

                            <p class="text-xs text-slate-400">

                                Ngày tạo

                            </p>

                        </div>

                    </div>

                    @empty

                    <div class="py-16">

                        <div class="flex flex-col items-center">

                            <div class="w-20 h-20 rounded-full bg-slate-100 flex items-center justify-center">

                                <i class="fa-solid fa-folder-open text-3xl text-slate-400"></i>

                            </div>

                            <h4 class="mt-5 text-lg font-black text-slate-700">

                                Chưa có tài liệu

                            </h4>

                            <p class="mt-2 text-sm text-slate-500">

                                Hiện tại chưa có tài liệu nào thuộc loại này.

                            </p>

                        </div>

                    </div>

                    @endforelse

                </div>

            </div>
        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>
async function toggleStatus(id) {
    try {

        const response = await fetch(`/admin/document-types/${id}/status`, {

            method: 'PATCH',

            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }

        });

        const data = await response.json();

        if (data.success) {

            Swal.fire({

                icon: 'success',

                title: 'Thành công',

                text: data.status ?
                    'Đã mở khóa loại tài liệu.' :
                    'Đã khóa loại tài liệu.',

                timer: 1200,

                showConfirmButton: false

            }).then(() => {

                location.reload();

            });

        } else {

            Swal.fire({

                icon: 'error',

                title: 'Lỗi',

                text: data.message ?? 'Không thể thay đổi trạng thái.'

            });

        }

    } catch (e) {

        Swal.fire({

            icon: 'error',

            title: 'Lỗi',

            text: 'Đã xảy ra lỗi trong quá trình xử lý.'

        });

    }

}
</script>

@endpush