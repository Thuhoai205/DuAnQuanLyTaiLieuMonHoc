<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\LogController;

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('users', UserController::class);

        Route::patch('/users/{id}/status', [UserController::class, 'toggleStatus'])
            ->name('users.status');

        Route::resource('subjects', SubjectController::class);

        Route::resource('categories', DocumentTypeController::class);

        Route::get('/statistics', [StatisticsController::class, 'index'])
            ->name('statistics.index');

        Route::get('/logs', [LogController::class, 'index'])
            ->name('logs.index');

        Route::post('/logs/read-all', [LogController::class, 'markAllAsRead'])
            ->name('logs.readAll');
    });