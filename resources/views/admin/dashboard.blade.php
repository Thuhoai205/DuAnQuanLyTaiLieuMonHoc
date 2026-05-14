@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('page-title', 'Tổng quan hệ thống')

@section('content')

<div class="grid grid-cols-4 gap-6">

    <div class="bg-white p-4 rounded shadow">
        <h3>Người dùng</h3>
        <p class="text-2xl font-bold">1240</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3>Môn học</h3>
        <p class="text-2xl font-bold">45</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3>Tài liệu</h3>
        <p class="text-2xl font-bold">856</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3>Lượt tải</h3>
        <p class="text-2xl font-bold">3521</p>
    </div>

</div>

@endsection