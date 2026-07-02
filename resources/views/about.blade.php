@extends('layouts.app')

@section('title', 'Giới thiệu Chương trình Tài nguyên Giáo dục')

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
<main id="view-about-with-banner" class="min-h-screen bg-white pb-20" style="font-family: 'Roboto', sans-serif;">

    <!-- HERO BANNER: Khối banner ảnh nền chứa chữ "Giới thiệu" giống hệt image_5ea826.jpg -->
    <div class="relative w-full h-[260px] md:h-[320px] overflow-hidden">
        <!-- Ảnh nền (Đã được thay bằng hình ảnh thư viện học thuật/công nghệ số hiện đại) -->
        <img src="https://i.pinimg.com/1200x/96/d3/c9/96d3c90189af11a192ba76519fb7cf2a.jpg"
            alt="Educational Resources Banner" class="w-full h-full object-cover opacity-60">

        <!-- Lớp phủ tối (Overlay) để làm nổi bật chữ trắng phía trên giống hình mẫu -->
        <div class="absolute inset-0 bg-black/30"></div>

        <!-- Chữ "Giới thiệu" căn giữa tuyệt đối -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">

            <h1 class="banner-title italic text-3xl md:text-4xl font-bold text-white tracking-wide drop-shadow-md">
                Giới thiệu
            </h1>

            <p class="banner-subtitle mt-3 text-cyan-100 text-base md:text-lg max-w-2xl leading-relaxed">
                Tìm hiểu thêm về hệ thống quản lý tài liệu môn học
            </p>

        </div>
    </div>
    <div class="bg-cyan-50 py-3 border-b border-cyan-100">
        <div class="max-w-7xl mx-auto px-4 md:px-6 flex items-center text-sm">
            <a href="/" class="text-slate-600 hover:text-cyan-600 transition">
                Trang chủ
            </a>

            <span class="mx-2 text-slate-400">
                /
            </span>

            <span class="font-medium text-cyan-600">
                Giới thiệu
            </span>
        </div>
    </div>

    <!-- MAIN ARTICLE CONTENT -->
    <!-- ================= MAIN CONTENT ================= -->
    <article class="max-w-7xl mx-auto px-4 md:px-6 py-14">

        <!-- Tiêu đề -->
        <div class="mb-10">
            <span
                class="inline-flex items-center px-3 py-1 rounded-full bg-cyan-50 text-cyan-600 text-sm font-semibold">
                Giới thiệu hệ thống
            </span>

            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-900">
                Website Quản lý Tài liệu Môn học
            </h2>

            <p class="mt-4 max-w-4xl text-slate-600 leading-8">
                Website Quản lý Tài liệu Môn học được xây dựng nhằm cung cấp một nền tảng tập trung
                giúp lưu trữ, quản lý và chia sẻ tài liệu học tập giữa giảng viên và sinh viên.
                Hệ thống giúp thay thế phương thức lưu trữ truyền thống trên Google Drive, Email
                hoặc các thiết bị cá nhân, từ đó nâng cao hiệu quả quản lý và khai thác nguồn học liệu.
            </p>
        </div>

        <!-- Grid -->
        <div class="grid lg:grid-cols-2 gap-8">

            <!-- Mục tiêu -->
            <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">

                <div class="flex items-center gap-3 mb-5">
                    <div class="w-12 h-12 rounded-2xl bg-cyan-50 flex items-center justify-center">
                        <i class="fa-solid fa-bullseye text-cyan-600 text-xl"></i>
                    </div>

                    <h3 class="text-xl font-bold text-slate-800">
                        Mục tiêu của hệ thống
                    </h3>
                </div>

                <p class="text-slate-600 leading-8">
                    Xây dựng một hệ thống quản lý học liệu tập trung, giúp giảng viên dễ dàng
                    đăng tải, cập nhật và quản lý tài liệu của các môn học được phân công,
                    đồng thời hỗ trợ sinh viên tìm kiếm và tải tài liệu học tập một cách
                    nhanh chóng, thuận tiện và chính xác.
                </p>

            </div>

            <!-- Đối tượng -->
            <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">

                <div class="flex items-center gap-3 mb-5">
                    <div class="w-12 h-12 rounded-2xl bg-cyan-50 flex items-center justify-center">
                        <i class="fa-solid fa-users text-cyan-600 text-xl"></i>
                    </div>

                    <h3 class="text-xl font-bold text-slate-800">
                        Đối tượng sử dụng
                    </h3>
                </div>

                <ul class="space-y-3 text-slate-600 leading-7">

                    <li>
                        <strong>Quản trị viên:</strong> Quản lý người dùng, môn học,
                        loại tài liệu và thống kê hệ thống.
                    </li>

                    <li>
                        <strong>Giảng viên:</strong> Đăng tải, chỉnh sửa, cập nhật
                        và quản lý tài liệu của các môn học được phân công.
                    </li>

                    <li>
                        <strong>Sinh viên:</strong> Tìm kiếm, xem thông tin và
                        tải xuống các tài liệu học tập phục vụ quá trình học tập.
                    </li>

                </ul>

            </div>

        </div>

        <!-- Chức năng -->
        <div class="mt-10 bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">

            <h3 class="text-2xl font-bold text-slate-800 mb-8">
                Chức năng nổi bật
            </h3>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="rounded-2xl bg-slate-50 p-6">
                    <i class="fa-solid fa-folder-tree text-3xl text-cyan-600"></i>

                    <h4 class="mt-4 font-semibold text-slate-800">
                        Quản lý môn học
                    </h4>

                    <p class="mt-2 text-sm text-slate-600">
                        Quản lý danh sách môn học và phân công giảng viên phụ trách.
                    </p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-6">
                    <i class="fa-solid fa-file-arrow-up text-3xl text-cyan-600"></i>

                    <h4 class="mt-4 font-semibold text-slate-800">
                        Quản lý tài liệu
                    </h4>

                    <p class="mt-2 text-sm text-slate-600">
                        Upload, cập nhật, chỉnh sửa và quản lý nhiều loại tài liệu học tập.
                    </p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-6">
                    <i class="fa-solid fa-magnifying-glass text-3xl text-cyan-600"></i>

                    <h4 class="mt-4 font-semibold text-slate-800">
                        Tra cứu thông minh
                    </h4>

                    <p class="mt-2 text-sm text-slate-600">
                        Tìm kiếm tài liệu theo tên, môn học hoặc loại tài liệu.
                    </p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-6">
                    <i class="fa-solid fa-cloud-arrow-down text-3xl text-cyan-600"></i>

                    <h4 class="mt-4 font-semibold text-slate-800">
                        Tải tài liệu
                    </h4>

                    <p class="mt-2 text-sm text-slate-600">
                        Sinh viên có thể tải tài liệu và hệ thống ghi nhận lượt tải.
                    </p>
                </div>

            </div>

        </div>

    </article>
</main>

@endsection