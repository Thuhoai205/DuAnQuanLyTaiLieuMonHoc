@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Inter', sans-serif;
}
</style>

<div class="min-h-screen bg-slate-100 py-10">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="mb-10 flex items-center justify-between flex-wrap gap-4">

            <div>
                <span
                    class="inline-flex items-center px-4 py-1.5 rounded-full bg-blue-50 text-blue-600 text-xs font-bold tracking-wide border border-blue-100">
                    TÀI KHOẢN
                </span>

                <h1 class="text-4xl font-black text-slate-800 mt-4 tracking-tight">
                    Quản lý hồ sơ
                </h1>

                <p class="text-slate-500 mt-2 text-sm">
                    Xem và cập nhật thông tin tài khoản của bạn
                </p>
            </div>

            <div
                class="hidden md:flex items-center gap-4 px-5 py-4 bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-lg transition-all duration-300">

                <!-- ICON -->
                <div
                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 via-green-500 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-emerald-500/25 shrink-0">

                    <i class="fas fa-shield-alt text-lg"></i>

                </div>

                <!-- CONTENT -->
                <div class="leading-tight">

                    <p class="text-sm font-extrabold text-slate-800 tracking-tight">
                        Bảo mật tài khoản
                    </p>

                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Dữ liệu được mã hóa và bảo vệ an toàn
                    </p>

                </div>

            </div>

        </div>

        {{-- SUCCESS --}}
        @if(session('success'))

        <div
            class="mb-8 bg-emerald-50 border border-emerald-200 rounded-3xl p-5 shadow-sm flex items-center justify-between">

            <div class="flex items-center gap-4">

                <div
                    class="w-14 h-14 rounded-2xl bg-emerald-500 text-white flex items-center justify-center shadow-lg shadow-emerald-200">

                    <i class="fas fa-check text-xl"></i>

                </div>

                <div>

                    <h4 class="font-black text-emerald-800 text-lg">
                        Cập nhật thành công
                    </h4>

                    <p class="text-sm text-emerald-700">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        </div>

        @endif

        {{-- ERROR --}}
        @if(session('error'))

        <div class="mb-8 bg-red-50 border border-red-200 rounded-3xl p-5 shadow-sm flex items-center gap-4">

            <div
                class="w-14 h-14 rounded-2xl bg-red-500 text-white flex items-center justify-center shadow-lg shadow-red-200">

                <i class="fas fa-xmark text-xl"></i>

            </div>

            <div>

                <h4 class="font-black text-red-700 text-lg">
                    Có lỗi xảy ra
                </h4>

                <p class="text-sm text-red-600">
                    {{ session('error') }}
                </p>

            </div>

        </div>

        @endif

        {{-- VALIDATION --}}
        @if ($errors->any())

        <div class="mb-8 bg-white border border-red-100 rounded-3xl p-6 shadow-sm">

            <div class="flex items-center gap-3 mb-4">

                <div class="w-12 h-12 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center">

                    <i class="fas fa-circle-exclamation text-lg"></i>

                </div>

                <div>

                    <h4 class="font-bold text-slate-800">
                        Dữ liệu chưa hợp lệ
                    </h4>

                    <p class="text-sm text-slate-400">
                        Vui lòng kiểm tra lại thông tin
                    </p>

                </div>

            </div>

            <ul class="space-y-2">

                @foreach ($errors->all() as $error)

                <li class="text-sm text-red-500 flex items-center gap-2">

                    <i class="fas fa-circle text-[8px]"></i>

                    {{ $error }}

                </li>

                @endforeach

            </ul>

        </div>

        @endif

        {{-- CONTENT --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            {{-- LEFT --}}
            <div class="lg:col-span-4 bg-white rounded-[2rem] overflow-hidden border border-slate-200 shadow-sm">

                {{-- TOP BG --}}
                <div class="h-36 bg-gradient-to-r from-blue-600 via-indigo-500 to-indigo-600"></div>

                <div class="px-8 pb-8 relative">

                    {{-- AVATAR --}}
                    <div class="flex justify-center -mt-16">

                        <form id="avatar-form" action="{{ route('profile.update.avatar') }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            <div class="relative group">

                                <label for="avatar-upload" class="cursor-pointer">

                                    <div class="w-32 h-32 rounded-full bg-white p-2 shadow-xl overflow-hidden">

                                        @if(Auth::user()->avatar)

                                        <img id="avatar-preview" src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                            class="w-full h-full rounded-full object-cover">

                                        @else

                                        <div id="avatar-placeholder"
                                            class="w-full h-full rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-4xl font-black">

                                            {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}

                                        </div>

                                        @endif

                                    </div>

                                    {{-- CAMERA --}}
                                    <div
                                        class="absolute bottom-1 right-1 w-10 h-10 rounded-full bg-white border border-slate-100 shadow-lg flex items-center justify-center text-slate-600 group-hover:text-blue-600 transition">

                                        <i class="fas fa-camera"></i>

                                    </div>

                                </label>

                                <input type="file" id="avatar-upload" name="avatar" class="hidden" accept="image/*"
                                    onchange="previewAndSubmit(this)">

                            </div>

                        </form>

                    </div>

                    {{-- USER INFO --}}
                    <div class="text-center mt-6">

                        <h2 class="text-2xl font-black text-slate-800">
                            {{ Auth::user()->full_name }}
                        </h2>

                        <p class="text-slate-400 mt-2 text-sm">
                            {{ Auth::user()->email }}
                        </p>

                        {{-- STATUS --}}
                        <div
                            class="mt-5 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 border border-emerald-200">

                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>

                            <span class="text-sm font-semibold text-emerald-600">
                                Đang hoạt động
                            </span>

                        </div>

                    </div>

                    {{-- STATS --}}
                    <div class="grid grid-cols-2 gap-4 mt-8">

                        <div class="bg-slate-50 rounded-2xl border border-slate-100 p-4 text-center">

                            <p class="text-xs text-slate-400 font-semibold uppercase">
                                Thành viên
                            </p>

                            <h4 class="mt-2 font-bold text-slate-700">
                                Chính thức
                            </h4>

                        </div>

                        <div class="bg-slate-50 rounded-2xl border border-slate-100 p-4 text-center">

                            <p class="text-xs text-slate-400 font-semibold uppercase">
                                Tham gia
                            </p>

                            <h4 class="mt-2 font-bold text-slate-700">
                                {{ Auth::user()->created_at ? Auth::user()->created_at->format('m/Y') : 'Mới' }}
                            </h4>

                        </div>

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="lg:col-span-8 space-y-8">

                {{-- PERSONAL --}}
                <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-8">

                    <div class="flex items-center justify-between mb-8">

                        <div>

                            <h3 class="text-2xl font-black text-slate-800">
                                Thông tin cá nhân
                            </h3>

                            <p class="text-sm text-slate-400 mt-2">
                                Cập nhật thông tin tài khoản
                            </p>

                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">

                            <i class="fas fa-user-edit text-xl"></i>

                        </div>

                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">

                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>

                                <label class="block text-sm font-bold text-slate-600 mb-3">
                                    Họ và tên
                                </label>

                                <div class="relative flex items-center">
                                    <i
                                        class="fa-solid fa-user absolute left-5 text-slate-400 text-lg pointer-events-none"></i>

                                    <input type="text" name="full_name"
                                        value="{{ Auth::user()->full_name ?? 'Giảng viên A' }}"
                                        class="w-full h-14 pl-14 pr-5 rounded-2xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-blue-500 focus:bg-white transition text-slate-700">
                                </div>
                            </div>

                            <div>

                                <label class="block text-sm font-bold text-slate-600 mb-3">
                                    Địa chỉ Email
                                </label>

                                <div class="relative flex items-center">
                                    <i
                                        class="fa-solid fa-envelope absolute left-5 text-slate-400 text-lg pointer-events-none"></i>

                                    <input type="email" name="email" value="{{ Auth::user()->email ?? 'gv@gmail.com' }}"
                                        class="w-full h-14 pl-14 pr-5 rounded-2xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-blue-500 focus:bg-white transition text-slate-700">
                                </div>

                            </div>

                        </div>

                        <div class="flex justify-end">

                            <button type="submit"
                                class="h-14 px-8 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold shadow-lg shadow-blue-200 transition-all active:scale-95">

                                <i class="fas fa-save mr-2"></i>

                                Lưu thay đổi

                            </button>

                        </div>

                    </form>

                </div>

                {{-- PASSWORD --}}
                <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm p-8">

                    <div class="flex items-center justify-between mb-8">

                        <div>

                            <h3 class="text-2xl font-black text-slate-800">
                                Bảo mật tài khoản
                            </h3>

                            <p class="text-sm text-slate-400 mt-2">
                                Đổi mật khẩu để bảo vệ tài khoản
                            </p>

                        </div>

                        <div
                            class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">

                            <i class="fas fa-shield-halved text-xl"></i>

                        </div>

                    </div>

                    <form action="{{ route('profile.password') }}" method="POST" class="space-y-6">

                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            <div>

                                <label class="block text-sm font-bold text-slate-600 mb-3">
                                    Mật khẩu hiện tại
                                </label>

                                <input type="password" name="current_password" placeholder="Nhập mật khẩu"
                                    class="w-full h-14 px-5 rounded-2xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-emerald-500 focus:bg-white transition">

                            </div>

                            <div>

                                <label class="block text-sm font-bold text-slate-600 mb-3">
                                    Mật khẩu mới
                                </label>

                                <input type="password" name="new_password" placeholder="Nhập mật khẩu mới"
                                    class="w-full h-14 px-5 rounded-2xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-emerald-500 focus:bg-white transition">

                            </div>

                            <div>

                                <label class="block text-sm font-bold text-slate-600 mb-3">
                                    Xác nhận mật khẩu
                                </label>

                                <input type="password" name="new_password_confirmation" placeholder="Nhập lại mật khẩu"
                                    class="w-full h-14 px-5 rounded-2xl bg-slate-50 border border-slate-200 focus:outline-none focus:border-emerald-500 focus:bg-white transition">

                            </div>

                        </div>

                        <div class="flex justify-end">

                            <button type="submit"
                                class="h-14 px-8 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold shadow-lg shadow-emerald-200 transition-all active:scale-95">

                                <i class="fas fa-lock mr-2"></i>

                                Đổi mật khẩu

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
function previewAndSubmit(input) {

    if (input.files && input.files[0]) {

        let reader = new FileReader();

        reader.onload = function(e) {

            let img = document.getElementById('avatar-preview');
            let placeholder = document.getElementById('avatar-placeholder');

            if (img) {

                img.src = e.target.result;

            } else if (placeholder) {

                let newImg = document.createElement('img');

                newImg.id = 'avatar-preview';
                newImg.src = e.target.result;
                newImg.className = 'w-full h-full rounded-full object-cover';

                placeholder.parentNode.replaceChild(newImg, placeholder);
            }

            document.getElementById('avatar-form').submit();
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection