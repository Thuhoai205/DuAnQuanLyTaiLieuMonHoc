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
        <img src="{{ asset('img/02.jpg') }}" alt="Educational Resources Banner"
            class="w-full h-full object-cover opacity-60">

        <!-- Lớp phủ tối (Overlay) để làm nổi bật chữ trắng phía trên giống hình mẫu -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Chữ "Giới thiệu" căn giữa tuyệt đối -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">

            <h1 class="banner-title italic text-5xl font-bold text-white drop-shadow-2xl">
                Giới thiệu
            </h1>

            <p class="banner-subtitle mt-3 text-white/90 text-lg md:text-xl font-medium max-w-2xl leading-relaxed">
                Tìm hiểu thêm về hệ thống quản lý tài liệu môn học
            </p>

        </div>
    </div>
    <div class="bg-slate-100 py-3 border-b border-slate-200">

        <div class="max-w-7xl mx-auto px-4 md:px-6 flex items-center text-sm">

            <a href="/" class="text-slate-500 hover:text-slate-900 transition-colors duration-300">

                Trang chủ

            </a>

            <span class="mx-3 text-slate-300">
                /
            </span>

            <span class="font-semibold text-slate-700">

                Giới thiệu

            </span>

        </div>

    </div>
    <!-- MAIN ARTICLE CONTENT -->
    <!-- ================= MAIN CONTENT ================= -->
    <article class="max-w-7xl mx-auto px-6 pt-10 pb-10">

        <!-- Tiêu đề -->
        <div class="mb-10">

            <span class="inline-flex items-center rounded-full
            border border-slate-200
            bg-slate-100
            px-4 py-1.5
            text-sm
            font-semibold
            text-slate-700">

                Giới thiệu hệ thống

            </span>

            <h2 class="mt-5 text-3xl md:text-4xl font-bold tracking-tight text-slate-900">
                Website Quản lý Tài liệu Môn học
            </h2>

            <p class="mt-5 max-w-4xl text-[16px] leading-8 text-slate-600">

                EDU DOC là nền tảng quản lý học liệu được phát triển nhằm hỗ trợ việc lưu trữ,
                quản lý và chia sẻ tài liệu môn học trong môi trường giáo dục.

                Hệ thống giúp giảng viên dễ dàng đăng tải, cập nhật và quản lý học liệu,
                đồng thời tạo điều kiện để sinh viên tìm kiếm, truy cập và tải tài liệu
                nhanh chóng trên một nền tảng tập trung, hiện đại và thuận tiện.

            </p>

        </div>

        <!-- Grid -->
        <div class="grid lg:grid-cols-2 gap-8">

            <!-- Mục tiêu -->
            <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">

                <div class="mb-5 flex items-center gap-4">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-slate-100">

                        <i class="fa-solid fa-bullseye text-xl text-amber-500"></i>

                    </div>

                    <h3 class="text-xl font-bold text-slate-800">

                        Mục tiêu của hệ thống

                    </h3>

                </div>

                <p class="leading-8 text-slate-600">

                    EDU DOC hướng đến việc xây dựng một kho học liệu tập trung,
                    hỗ trợ số hóa quá trình quản lý tài liệu môn học.

                    Hệ thống giúp giảm thời gian tìm kiếm,
                    hạn chế thất lạc tài liệu và tạo môi trường chia sẻ học liệu
                    hiệu quả giữa giảng viên và sinh viên.

                </p>

            </div>

            <!-- Đối tượng -->
            <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">

                <div class="mb-5 flex items-center gap-4">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-slate-100">

                        <i class="fa-solid fa-users text-xl text-amber-500"></i>

                    </div>

                    <h3 class="text-xl font-bold text-slate-800">

                        Đối tượng sử dụng

                    </h3>

                </div>

                <ul class="space-y-5 leading-7 text-slate-600">

                    <li>

                        <strong class="text-slate-800">
                            Quản trị viên:
                        </strong>

                        Quản lý người dùng, môn học, loại tài liệu và vận hành toàn bộ hệ thống.

                    </li>

                    <li>

                        <strong class="text-slate-800">
                            Giảng viên:
                        </strong>

                        Đăng tải, cập nhật và quản lý học liệu của các môn học được phân công.

                    </li>

                    <li>

                        <strong class="text-slate-800">
                            Sinh viên:
                        </strong>

                        Tìm kiếm, xem thông tin và tải tài liệu phục vụ quá trình học tập.

                    </li>

                </ul>

            </div>

        </div>
        <!-- Chức năng -->
        <div class="mt-10 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">

            <div class="mb-8">

                <h3 class="text-2xl font-bold text-slate-900">
                    Chức năng nổi bật
                </h3>

                <p class="mt-2 text-slate-500">
                    EDU DOC cung cấp đầy đủ các tính năng hỗ trợ quản lý, lưu trữ và khai thác
                    học liệu trong môi trường giáo dục.
                </p>

            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">

                <!-- Quản lý môn học -->
                <div
                    class="rounded-2xl border border-slate-200 bg-white p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-slate-100">

                        <i class="fa-solid fa-folder-tree text-xl text-amber-500"></i>

                    </div>

                    <h4 class="mt-5 text-lg font-semibold text-slate-900">
                        Quản lý môn học
                    </h4>

                    <p class="mt-3 text-sm leading-7 text-slate-600">
                        Quản lý danh sách môn học và phân công giảng viên phụ trách từng môn học.
                    </p>

                </div>

                <!-- Quản lý tài liệu -->
                <div
                    class="rounded-2xl border border-slate-200 bg-white p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-slate-100">

                        <i class="fa-solid fa-file-arrow-up text-xl text-amber-500"></i>

                    </div>

                    <h4 class="mt-5 text-lg font-semibold text-slate-900">
                        Quản lý tài liệu
                    </h4>

                    <p class="mt-3 text-sm leading-7 text-slate-600">
                        Hỗ trợ đăng tải, cập nhật và lưu trữ nhiều loại tài liệu học tập trên cùng
                        một hệ thống.
                    </p>

                </div>

                <!-- Tra cứu -->
                <div
                    class="rounded-2xl border border-slate-200 bg-white p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-slate-100">

                        <i class="fa-solid fa-magnifying-glass text-xl text-amber-500"></i>

                    </div>

                    <h4 class="mt-5 text-lg font-semibold text-slate-900">
                        Tra cứu tài liệu
                    </h4>

                    <p class="mt-3 text-sm leading-7 text-slate-600">
                        Tìm kiếm tài liệu nhanh chóng theo tên, môn học hoặc loại tài liệu với bộ
                        lọc trực quan.
                    </p>

                </div>

                <!-- Tải tài liệu -->
                <div
                    class="rounded-2xl border border-slate-200 bg-white p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-slate-100">

                        <i class="fa-solid fa-cloud-arrow-down text-xl text-amber-500"></i>

                    </div>

                    <h4 class="mt-5 text-lg font-semibold text-slate-900">
                        Tải tài liệu
                    </h4>

                    <p class="mt-3 text-sm leading-7 text-slate-600">
                        Cho phép sinh viên tải tài liệu học tập và hệ thống tự động ghi nhận lịch
                        sử cũng như số lượt tải xuống.
                    </p>

                </div>

            </div>

        </div>
        <!-- Quy trình sử dụng -->
        <div class="mt-10 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">

            <div class="mb-8">

                <h3 class="text-2xl font-bold text-slate-900">
                    Quy trình sử dụng
                </h3>

                <p class="mt-2 text-slate-500">
                    Chỉ với vài bước đơn giản, người dùng có thể tìm kiếm và khai thác tài liệu học tập một cách nhanh
                    chóng.
                </p>

            </div>

            <div class="grid gap-6 md:grid-cols-4">

                <!-- Step 1 -->
                <div class="text-center">

                    <div
                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-slate-200 bg-slate-100">

                        <i class="fa-solid fa-user-lock text-xl text-amber-500"></i>

                    </div>

                    <div
                        class="mx-auto mt-5 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-sm font-bold text-white">

                        1

                    </div>

                    <h4 class="mt-4 text-lg font-semibold text-slate-900">
                        Đăng nhập
                    </h4>

                    <p class="mt-2 text-sm leading-7 text-slate-600">
                        Đăng nhập bằng tài khoản để sử dụng đầy đủ các chức năng của hệ thống.
                    </p>

                </div>

                <!-- Step 2 -->
                <div class="text-center">

                    <div
                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-slate-200 bg-slate-100">

                        <i class="fa-solid fa-magnifying-glass text-xl text-amber-500"></i>

                    </div>

                    <div
                        class="mx-auto mt-5 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-sm font-bold text-white">

                        2

                    </div>

                    <h4 class="mt-4 text-lg font-semibold text-slate-900">
                        Tra cứu
                    </h4>

                    <p class="mt-2 text-sm leading-7 text-slate-600">
                        Tìm kiếm tài liệu theo môn học, từ khóa hoặc loại tài liệu.
                    </p>

                </div>

                <!-- Step 3 -->
                <div class="text-center">

                    <div
                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-slate-200 bg-slate-100">

                        <i class="fa-solid fa-file-lines text-xl text-amber-500"></i>

                    </div>

                    <div
                        class="mx-auto mt-5 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-sm font-bold text-white">

                        3

                    </div>

                    <h4 class="mt-4 text-lg font-semibold text-slate-900">
                        Xem thông tin
                    </h4>

                    <p class="mt-2 text-sm leading-7 text-slate-600">
                        Xem mô tả, môn học, giảng viên và các thông tin liên quan đến tài liệu.
                    </p>

                </div>

                <!-- Step 4 -->
                <div class="text-center">

                    <div
                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-slate-200 bg-slate-100">

                        <i class="fa-solid fa-download text-xl text-amber-500"></i>

                    </div>

                    <div
                        class="mx-auto mt-5 flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-sm font-bold text-white">

                        4

                    </div>

                    <h4 class="mt-4 text-lg font-semibold text-slate-900">
                        Tải tài liệu
                    </h4>

                    <p class="mt-2 text-sm leading-7 text-slate-600">
                        Tải tài liệu về thiết bị để phục vụ quá trình học tập và nghiên cứu.
                    </p>

                </div>

            </div>

        </div>


        <!-- ================= KẾT LUẬN ================= -->
        <section class="mt-10">

            <div class="rounded-3xl border border-slate-200 bg-white p-10 shadow-sm">

                <div class="mx-auto max-w-4xl text-center">

                    <div
                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-slate-200 bg-slate-100">

                        <i class="fa-solid fa-graduation-cap text-2xl text-amber-500"></i>

                    </div>

                    <h3 class="mt-6 text-3xl font-bold text-slate-900">

                        EDU DOC – Đồng hành cùng việc học tập và giảng dạy

                    </h3>

                    <p class="mt-5 leading-8 text-slate-600">

                        EDU DOC được xây dựng với mục tiêu trở thành nền tảng quản lý học liệu
                        tập trung, hỗ trợ giảng viên và sinh viên trong việc lưu trữ, chia sẻ
                        và khai thác tài liệu học tập một cách hiệu quả.

                    </p>

                    <p class="mt-4 leading-8 text-slate-600">

                        Với giao diện trực quan, khả năng tìm kiếm nhanh chóng và hệ thống
                        phân quyền rõ ràng, EDU DOC góp phần nâng cao hiệu quả quản lý tài liệu,
                        tiết kiệm thời gian và tạo môi trường học tập hiện đại, thuận tiện
                        cho mọi người dùng.

                    </p>

                    <div class="mt-8 flex justify-center">

                        <span
                            class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-100 px-5 py-2 text-sm font-semibold text-slate-700">

                            <i class="fa-solid fa-book-open text-amber-500"></i>

                            Học liệu tập trung • Quản lý hiệu quả • Tra cứu nhanh chóng

                        </span>

                    </div>

                </div>

            </div>

        </section>
        <div class="mt-10 border-t border-slate-200 pt-6 text-center">

            <p class="text-sm text-slate-500">

                Cảm ơn bạn đã quan tâm đến hệ thống <strong class="text-slate-800">EDU DOC</strong>.
                Chúng tôi luôn nỗ lực mang đến một môi trường học tập hiện đại, tiện lợi và hiệu quả.

            </p>

        </div>
    </article>
</main>

@endsection