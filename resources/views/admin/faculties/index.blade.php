@extends('layouts.admin')

@section('title', 'Quản lý khoa')
@section('page-title', 'Quản lý khoa')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between">

        <div>

            <h2 class="text-3xl font-black text-slate-800">
                Quản lý khoa
            </h2>

            <p class="text-slate-500 mt-1">
                Quản lý danh sách các khoa trong hệ thống.
            </p>

        </div>

        <a href="#" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl
            bg-cyan-500 hover:bg-cyan-600 text-white font-bold shadow-lg shadow-cyan-200 transition">

            <i class="fa-solid fa-plus"></i>

            Thêm khoa

        </a>

    </div>

    <!-- SEARCH -->
    <div class="bg-white rounded-3xl border border-cyan-100 shadow-sm p-6">

        <form method="GET" action="{{ route('admin.faculties.index') }}">

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">

                <div class="lg:col-span-2">

                    <input type="text" name="keyword" value="{{ request('keyword') }}"
                        placeholder="Tìm theo mã hoặc tên khoa..." class="w-full h-12 rounded-xl border border-cyan-100
                        bg-cyan-50 px-4 focus:ring-2 focus:ring-cyan-300">

                </div>

                <div>

                    <select name="status" class="w-full h-12 rounded-xl border border-cyan-100
                        bg-cyan-50 px-4">

                        <option value="">Tất cả trạng thái</option>

                        <option value="1" @selected(request('status')=='1' )>

                            Hoạt động

                        </option>

                        <option value="0" @selected(request('status')=='0' )>

                            Đã khóa

                        </option>

                    </select>

                </div>

                <div class="flex gap-3">

                    <button class="flex-1 rounded-xl bg-cyan-500 hover:bg-cyan-600
                        text-white font-bold transition">

                        <i class="fa-solid fa-search mr-2"></i>

                        Tìm

                    </button>

                    <a href="{{ route('admin.faculties.index') }}" class="px-5 rounded-xl border border-slate-200
                        flex items-center justify-center hover:bg-slate-50">

                        <i class="fa-solid fa-rotate-right"></i>

                    </a>

                </div>

            </div>

        </form>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-3xl border border-cyan-100 shadow-sm overflow-hidden">

        <table class="w-full">

            <thead class="bg-cyan-50">

                <tr class="text-left text-sm uppercase tracking-wide text-slate-500">

                    <th class="px-6 py-4 w-20">#</th>

                    <th>Mã khoa</th>

                    <th>Tên khoa</th>

                    <th class="text-center">Số môn</th>

                    <th class="text-center">Trạng thái</th>

                    <th class="text-center w-40">Thao tác</th>

                </tr>

            </thead>

            <tbody>

                @forelse($faculties as $faculty)

                <tr class="border-t hover:bg-cyan-50/50">

                    <td class="px-6 py-5">

                        {{ $loop->iteration }}

                    </td>

                    <td class="font-bold">

                        {{ $faculty->faculty_code }}

                    </td>

                    <td>

                        {{ $faculty->faculty_name }}

                    </td>

                    <td class="text-center">

                        <span class="inline-flex px-3 py-1 rounded-full
                            bg-cyan-100 text-cyan-700 text-xs font-bold">

                            {{ $faculty->subjects_count }}

                        </span>

                    </td>

                    <td class="text-center">

                        @if($faculty->is_active)

                        <span class="inline-flex px-3 py-1 rounded-full
                            bg-emerald-100 text-emerald-700
                            text-xs font-bold">

                            Hoạt động

                        </span>

                        @else

                        <span class="inline-flex px-3 py-1 rounded-full
                            bg-red-100 text-red-700
                            text-xs font-bold">

                            Đã khóa

                        </span>

                        @endif

                    </td>

                    <td>

                        <div class="flex justify-center gap-2">

                            <a href="#}" class="w-10 h-10 rounded-xl bg-amber-50
                                hover:bg-amber-500 hover:text-white
                                text-amber-600 flex items-center justify-center transition">

                                <i class="fa-solid fa-pen"></i>

                            </a>

                            <form action="#" method="POST">

                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Bạn có chắc muốn xóa?')" class="w-10 h-10 rounded-xl
                                    bg-red-50 hover:bg-red-500
                                    hover:text-white
                                    text-red-600 transition">

                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="text-center py-20 text-slate-500">

                        <i class="fa-solid fa-building-columns text-5xl mb-4"></i>

                        <p>Chưa có khoa nào.</p>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div>

        {{ $faculties->links() }}

    </div>

</div>

@endsection