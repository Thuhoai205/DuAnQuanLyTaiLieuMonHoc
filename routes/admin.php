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
        | USERS TRASH (ĐẶT TRƯỚC RESOURCE)
        */
        Route::get('/users/trashed', [UserController::class, 'trashed'])
            ->name('users.trashed');

        Route::post('/users/restore-multiple', [UserController::class, 'restoreMultiple'])
            ->name('users.restoreMultiple');

        Route::patch('/users/{user}/restore', [UserController::class, 'restore'])
            ->name('users.restore');

        Route::patch('/users/{user}/status', [UserController::class, 'toggleStatus'])
            ->name('users.status');

        /*
        | RESOURCE
        */
        Route::resource('users', UserController::class);
        /*
        |--------------------------
        | SUBJECTS
        |--------------------------
        */
        Route::resource('subjects', SubjectController::class);

        Route::get('/subjects/trashed', [SubjectController::class, 'trashed'])
            ->name('subjects.trashed');

        Route::post('/subjects/restore-multiple', [SubjectController::class, 'restoreMultiple'])
            ->name('subjects.restoreMultiple');

        Route::patch('/subjects/{subject}/restore', [SubjectController::class, 'restore'])
            ->name('subjects.restore');

        Route::delete('/subjects/{subject}/force-delete', [SubjectController::class, 'forceDelete'])
            ->name('subjects.forceDelete');

        Route::patch('/subjects/{subject}/status', [SubjectController::class, 'toggleStatus'])
            ->name('subjects.status');

        /*
        |--------------------------
        | DOCUMENT TYPES
        |--------------------------
        */
        Route::resource('document-types', DocumentTypeController::class);

        Route::patch('/document-types/{document_type}/status', [DocumentTypeController::class, 'toggleStatus'])
            ->name('document-types.status');

        /*
        |--------------------------
        | STATISTICS
        |--------------------------
        */
        Route::get('/statistics', [StatisticsController::class, 'index'])
            ->name('statistics.index');

        /*
        |--------------------------
        | LOGS
        |--------------------------
        */
        Route::get('/logs', [LogController::class, 'index'])
            ->name('logs.index');

        Route::post('/logs/read-all', [LogController::class, 'markAllAsRead'])
            ->name('logs.readAll');
    });