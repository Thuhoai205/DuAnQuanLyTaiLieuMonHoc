@extends('layouts.app')

@section('title', 'Đăng tải tài liệu')

@section('content')

<div class="min-h-screen bg-slate-50 py-12">

```
<div class="max-w-5xl mx-auto px-6">

    <!-- HEADER -->
    <div class="mb-8">

        <div class="flex items-center gap-4">

            <div class="w-14 h-14 rounded-2xl bg-cyan-500 text-white flex items-center justify-center shadow-lg shadow-cyan-200">

                <i class="fa-solid fa-cloud-arrow-up text-xl"></i>

            </div>

            <div>

                <h1 class="text-4xl font-black text-cyan-950">
                    Đăng tải tài liệu
                </h1>

                <p class="text-slate-500 font-medium mt-1">
                    Tải lên học liệu cho các môn học bạn được phân công giảng dạy.
                </p>

            </div>

        </div>

    </div>

    <!-- SUCCESS -->
    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 rounded-2xl p-4">
        {{ session('success') }}
    </div>
    @endif

    <!-- ERROR -->
    @if($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-5">

        <h5 class="font-bold text-red-600 mb-3">
            Có lỗi xảy ra:
        </h5>

        <ul class="list-disc pl-5 text-red-500 space-y-1">

            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>
    @endif

    <!-- FORM -->
    <div class="bg-white rounded-[32px] border border-cyan-100 shadow-[0_20px_60px_rgba(8,145,178,0.12)] overflow-hidden">

        <div class="p-8">

            <form action="{{ route('documents.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- TÊN TÀI LIỆU -->
                    <div class="md:col-span-2">


                        <label class="block text-sm font-black text-slate-700 mb-2">
                            Tên tài liệu
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            class="w-full rounded-2xl border px-5 py-4
                            @error('title') border-red-400 @else border-cyan-100 @enderror
                            focus:ring-2 focus:ring-cyan-400">

                    <!-- MÔN HỌC -->
                    <div>

                        <label class="block text-sm font-black text-slate-700 mb-2">
                            Môn học <span class="text-red-500">*</span>
                        </label>

                        <select
                            name="subject_code"
                            class="w-full rounded-2xl border border-cyan-100 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-cyan-400">

                            <option value="">
                                -- Chọn môn học --
                            </option>

                            @foreach($subjects as $subject)

                            <option
                                value="{{ $subject->subject_code }}"
                                {{ old('subject_code') == $subject->subject_code ? 'selected' : '' }}>

                                {{ $subject->subject_name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- LOẠI TÀI LIỆU -->
                    <div>

                        <label class="block text-sm font-black text-slate-700 mb-2">
                            Loại tài liệu
                        </label>

                        <select
                            name="document_type_id"
                            class="w-full rounded-2xl border border-cyan-100 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-cyan-400">

                            <option value="">
                                -- Chọn loại tài liệu --
                            </option>

                            @foreach($documentTypes as $type)

                            <option
                                value="{{ $type->document_type_id }}"
                                {{ old('document_type_id') == $type->document_type_id ? 'selected' : '' }}>

                                {{ $type->type_name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- MÔ TẢ -->
                    <div class="md:col-span-2">

                        <label class="block text-sm font-black text-slate-700 mb-2">
                            Mô tả
                        </label>

                        <textarea
                            rows="5"
                            name="description"
                            placeholder="Nhập mô tả ngắn về tài liệu..."
                            class="w-full rounded-2xl border border-cyan-100 px-5 py-4 focus:outline-none focus:ring-2 focus:ring-cyan-400">{{ old('description') }}</textarea>

                    </div>

                    <!-- FILE -->
                    <div class="md:col-span-2">

                        <label class="block text-sm font-black text-slate-700 mb-3">
                            File tài liệu
                        </label>

                        <label
                            class="flex flex-col items-center justify-center border-2 border-dashed border-cyan-200 bg-cyan-50 rounded-[28px] p-10 cursor-pointer hover:bg-cyan-100 transition">

                            <div class="w-20 h-20 rounded-full bg-cyan-500 text-white flex items-center justify-center mb-5">

                                <i class="fa-solid fa-file-arrow-up text-3xl"></i>

                            </div>

                            <h4 class="font-black text-cyan-700 text-lg">
                                Chọn file để tải lên
                            </h4>

                            <p class="text-slate-500 text-sm mt-2">
                                PDF, DOCX, XLSX, PPTX, ZIP...
                            </p>

                            <input id="fileInput" type="file" name="file" required accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip" class="hidden">

                            <span
                                id="fileName"
                                class="mt-4 text-sm font-semibold text-cyan-600">
                                Chưa chọn file
                            </span>

                        </label>

                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-8 flex justify-end gap-4">

                    <a href="{{ url()->previous() }}"
                        class="px-6 py-3 rounded-2xl border border-slate-300 font-bold text-slate-600 hover:bg-slate-100">

                        Hủy

                    </a>

                    <button
                        type="submit"
                        class="px-8 py-3 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-black shadow-lg shadow-cyan-200">

                        <i class="fa-solid fa-cloud-arrow-up mr-2"></i>

                        Đăng tải tài liệu

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
```

</div>

<script>

document
.getElementById('fileInput')
.addEventListener('change', function () {

    const fileName = this.files && this.files.length
        ? this.files[0].name
        : 'Chưa chọn file';

    document.getElementById('fileName').innerText = fileName;
});

</script>

@endsection
