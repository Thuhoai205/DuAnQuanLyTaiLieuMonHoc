@extends('layouts.admin')

@section('title', 'Quản lý người dùng')

@section('page-title', 'Quản lý người dùng')

@section('content')

<div class="max-w-7xl mx-auto px-2 lg:px-4">

    <!-- HEADER -->
    <section
        class="relative overflow-hidden rounded-[40px] bg-[#0891B2] text-white p-8 lg:p-10 mb-10 shadow-2xl shadow-cyan-200">

        <div class="absolute inset-0 opacity-10">
            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1600"
                class="w-full h-full object-cover">
        </div>

        <div class="absolute inset-0 bg-[#0891B2]/90"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

            <div>
                <span
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-cyan-700/60 border border-cyan-300/30 text-cyan-50 text-sm font-bold mb-6">
                    <i class="fa-solid fa-users"></i>
                    Admin Users
                </span>

                <h1 class="text-4xl md:text-5xl font-black leading-tight mb-4">
                    Quản lý người dùng
                </h1>

                <p class="text-cyan-50/90 text-lg leading-relaxed max-w-2xl">
                    Quản lý tài khoản sinh viên, giảng viên và quản trị viên trong hệ thống học liệu.
                </p>
            </div>

            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center justify-center gap-3 px-7 py-4 rounded-2xl bg-cyan-300 text-cyan-950 font-black hover:bg-cyan-200 transition shadow-xl">
                <i class="fa-solid fa-user-plus"></i>
                Thêm người dùng
            </a>

        </div>
    </section>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white rounded-[32px] p-7 border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-black uppercase tracking-[0.18em] text-slate-400">
                        Tổng người dùng
                    </p>

                    <h3 class="text-5xl font-black text-cyan-950 mt-4">
                        {{ number_format($totalUsers) }}
                    </h3>
                </div>

                <div class="w-16 h-16 rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                    <i class="fa-solid fa-users text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[32px] p-7 border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-black uppercase tracking-[0.18em] text-slate-400">
                        Giảng viên
                    </p>

                    <h3 class="text-5xl font-black text-cyan-950 mt-4">
                        {{ number_format($totalTeachers) }}
                    </h3>
                </div>

                <div class="w-16 h-16 rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                    <i class="fa-solid fa-chalkboard-user text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[32px] p-7 border border-cyan-100 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-black uppercase tracking-[0.18em] text-slate-400">
                        Sinh viên
                    </p>

                    <h3 class="text-5xl font-black text-cyan-950 mt-4">
                        {{ number_format($totalStudents) }}
                    </h3>
                </div>

                <div class="w-16 h-16 rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                    <i class="fa-solid fa-user-graduate text-2xl"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white rounded-[32px] border border-cyan-100 p-5 mb-10 shadow-[0_15px_45px_rgba(8,145,178,0.08)]">
        <form method="GET" action="{{ route('admin.users.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div class="md:col-span-2 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-cyan-600"></i>

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Tìm theo tên, email, username..."
                    class="w-full h-14 pl-14 pr-5 rounded-2xl bg-cyan-50 border border-cyan-100 text-slate-700 font-semibold outline-none focus:ring-2 focus:ring-cyan-300">
            </div>

            <select name="role_id"
                class="h-14 px-5 rounded-2xl bg-cyan-50 border border-cyan-100 text-slate-700 font-bold outline-none focus:ring-2 focus:ring-cyan-300">
                <option value="">Tất cả vai trò</option>

                @foreach($roles as $role)
                <option value="{{ $role->role_id }}" @selected(request('role_id')==$role->role_id)>
                    {{ $role->role_name }}
                </option>
                @endforeach
            </select>

            <button type="submit"
                class="h-14 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-black shadow-lg shadow-cyan-200 transition">
                <i class="fa-solid fa-filter mr-2"></i>
                Lọc
            </button>

        </form>
    </div>

    <!-- TABLE -->
    <!-- TABLE -->
    <div id="users-table-wrapper"
        class="bg-white rounded-[36px] border border-cyan-100 overflow-hidden shadow-[0_15px_45px_rgba(8,145,178,0.08)]">

        <div
            class="px-7 py-6 border-b border-cyan-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-cyan-950 tracking-tight">
                    Người dùng hệ thống
                </h2>

                <p class="text-slate-500 text-sm font-semibold mt-2">
                    Danh sách tài khoản đang có trong hệ thống.
                </p>
            </div>

            <span class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black border border-cyan-100">
                {{ number_format($totalUsers) }} tài khoản
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-cyan-50/70">
                    <tr>
                        <th class="px-7 py-5 text-xs font-black uppercase tracking-[0.18em] text-slate-500">
                            Người dùng
                        </th>

                        <th class="px-7 py-5 text-xs font-black uppercase tracking-[0.18em] text-slate-500">
                            Email
                        </th>

                        <th class="px-7 py-5 text-xs font-black uppercase tracking-[0.18em] text-slate-500">
                            Vai trò
                        </th>

                        <th class="px-7 py-5 text-xs font-black uppercase tracking-[0.18em] text-slate-500">
                            Trạng thái
                        </th>

                        <th class="px-7 py-5 text-xs font-black uppercase tracking-[0.18em] text-slate-500 text-right">
                            Hành động
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-cyan-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-cyan-50/60 transition">
                        <td class="px-7 py-5">
                            <div class="flex items-center gap-4">
                                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->full_name) . '&background=06b6d4&color=fff' }}"
                                    class="w-12 h-12 rounded-2xl object-cover shadow-sm ring-2 ring-cyan-50">

                                <div>
                                    <h4 class="font-black text-slate-800">
                                        {{ $user->full_name }}
                                    </h4>

                                    <p class="text-sm text-slate-400 font-semibold">
                                        {{ '@' . $user->username }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-7 py-5 text-slate-600 font-semibold">
                            {{ $user->email }}
                        </td>

                        <td class="px-7 py-5">
                            <span
                                class="px-4 py-2 rounded-full bg-cyan-50 text-cyan-700 text-xs font-black border border-cyan-100">
                                {{ $user->role->role_name ?? 'Chưa có role' }}
                            </span>
                        </td>

                        <td class="px-7 py-5">
                            <form action="{{ route('admin.users.status', $user->user_id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                @if($user->is_active)
                                <button type="submit"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 text-emerald-600 text-xs font-black hover:bg-emerald-500 hover:text-white transition">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    Hoạt động
                                </button>
                                @else
                                <button type="submit"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-50 text-red-500 text-xs font-black hover:bg-red-500 hover:text-white transition">
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                    Bị khóa
                                </button>
                                @endif
                            </form>
                        </td>

                        <td class="px-7 py-5">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.show', $user->user_id) }}"
                                    class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 hover:bg-cyan-500 hover:text-white transition flex items-center justify-center">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="{{ route('admin.users.edit', $user->user_id) }}"
                                    class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 hover:bg-amber-500 hover:text-white transition flex items-center justify-center">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <form action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa người dùng này không?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition flex items-center justify-center">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-7 py-14 text-center">
                            <div
                                class="w-20 h-20 mx-auto rounded-3xl bg-cyan-50 text-cyan-600 flex items-center justify-center mb-4">
                                <i class="fa-solid fa-user-slash text-3xl"></i>
                            </div>

                            <p class="text-slate-600 font-black">
                                Không tìm thấy người dùng nào.
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div
            class="px-7 py-6 bg-cyan-50/40 border-t border-cyan-100 flex flex-col md:flex-row items-center justify-between gap-5">

            <p class="text-sm font-bold text-slate-500">
                Hiển thị {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }}
                trong tổng {{ $users->total() }} người dùng
            </p>

            <div class="flex items-center gap-3">

                @if ($users->onFirstPage())
                <span
                    class="w-12 h-12 rounded-2xl bg-white border border-slate-100 text-slate-300 flex items-center justify-center cursor-not-allowed">
                    <i class="fa-solid fa-angle-left"></i>
                </span>
                @else
                <a href="{{ $users->previousPageUrl() }}"
                    class="ajax-user-page w-12 h-12 rounded-2xl bg-white border border-cyan-100 text-slate-500 hover:bg-cyan-500 hover:text-white flex items-center justify-center transition-all">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
                @endif

                @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                @if ($page == $users->currentPage())
                <span
                    class="w-12 h-12 rounded-2xl bg-cyan-500 text-white shadow-lg shadow-cyan-200 flex items-center justify-center font-black">
                    {{ $page }}
                </span>
                @else
                <a href="{{ $url }}"
                    class="ajax-user-page w-12 h-12 rounded-2xl bg-white border border-cyan-100 text-slate-500 hover:bg-cyan-500 hover:text-white flex items-center justify-center font-bold transition-all">
                    {{ $page }}
                </a>
                @endif
                @endforeach

                @if ($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}"
                    class="ajax-user-page w-12 h-12 rounded-2xl bg-white border border-cyan-100 text-slate-500 hover:bg-cyan-500 hover:text-white flex items-center justify-center transition-all">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
                @else
                <span
                    class="w-12 h-12 rounded-2xl bg-white border border-slate-100 text-slate-300 flex items-center justify-center cursor-not-allowed">
                    <i class="fa-solid fa-angle-right"></i>
                </span>
                @endif

            </div>
        </div>
    </div>

    <script>
    document.addEventListener('click', async function(e) {
        const link = e.target.closest('.ajax-user-page');

        if (!link) return;

        e.preventDefault();

        const url = link.href;
        const wrapper = document.getElementById('users-table-wrapper');

        wrapper.classList.add('opacity-50', 'pointer-events-none');

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const html = await response.text();

            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            const newWrapper = doc.querySelector('#users-table-wrapper');

            if (newWrapper) {
                wrapper.innerHTML = newWrapper.innerHTML;
                window.history.pushState({}, '', url);
            }

        } catch (error) {
            console.error(error);
        } finally {
            wrapper.classList.remove('opacity-50', 'pointer-events-none');
        }
    });
    </script>
</div>

<script>
let asc = true;

function sortTable() {
    const tbody = document.querySelector("tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));

    rows.sort((a, b) => {
        const nameA = a.querySelector("h4")?.innerText.toLowerCase() || "";
        const nameB = b.querySelector("h4")?.innerText.toLowerCase() || "";

        return asc ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
    });

    rows.forEach(row => tbody.appendChild(row));

    asc = !asc;

    const icon = document.getElementById("sortIcon");
    icon.classList.toggle("fa-chevron-down");
    icon.classList.toggle("fa-chevron-up");
}

function toggleRoleMenu() {
    document.getElementById('roleMenu').classList.toggle('hidden');
}

function filterRole(role) {
    const rows = document.querySelectorAll("tbody tr");

    rows.forEach(row => {
        const roleText = row.querySelector(".role-name")?.innerText.trim().toLowerCase();

        if (role === 'all') {
            row.style.display = '';
        } else {
            row.style.display = roleText === role.toLowerCase() ? '' : 'none';
        }
    });

    document.getElementById('roleMenu').classList.add('hidden');
}
</script>

@endsection