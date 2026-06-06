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

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        Route::get('/users/trashed', [UserController::class, 'trashed'])
            ->name('users.trashed');

        Route::post('/users/restore-multiple', [UserController::class, 'restoreMultiple'])
            ->name('users.restoreMultiple');

        Route::patch('/users/{id}/restore', [UserController::class, 'restore'])
            ->name('users.restore');

        Route::patch('/users/{id}/status', [UserController::class, 'toggleStatus'])
            ->name('users.status');

        Route::resource('users', UserController::class);

        /*
        |--------------------------------------------------------------------------
        | Subjects
        |--------------------------------------------------------------------------
        */

        Route::get('/subjects/trashed', [SubjectController::class, 'trashed'])
            ->name('subjects.trashed');

        Route::post('/subjects/restore-multiple', [SubjectController::class, 'restoreMultiple'])
            ->name('subjects.restoreMultiple');

        Route::patch('/subjects/{id}/restore', [SubjectController::class, 'restore'])
            ->name('subjects.restore');

        Route::resource('subjects', SubjectController::class);

        /*
        |--------------------------------------------------------------------------
        | Document Types
        |--------------------------------------------------------------------------
        */

        Route::get('/document-types/trashed', [DocumentTypeController::class, 'trashed'])
            ->name('document-types.trashed');

        Route::patch('/document-types/{id}/restore', [DocumentTypeController::class, 'restore'])
            ->name('document-types.restore');

        Route::patch('/document-types/{id}/status', [DocumentTypeController::class, 'toggleStatus'])
            ->name('document-types.status');

        Route::resource('document-types', DocumentTypeController::class);

        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        Route::get('/statistics', [StatisticsController::class, 'index'])
            ->name('statistics.index');

        /*
        |--------------------------------------------------------------------------
        | Logs
        |--------------------------------------------------------------------------
        */

        Route::get('/logs', [LogController::class, 'index'])
            ->name('logs.index');

        Route::post('/logs/read-all', [LogController::class, 'markAllAsRead'])
            ->name('logs.readAll');
    });