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

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

    Route::prefix('users')->name('users.')->group(function () {

    Route::get('/trashed', [UserController::class, 'trashed'])
        ->name('trashed');

    Route::post('/restore-multiple', [UserController::class, 'restoreMultiple'])
        ->name('restoreMultiple');

    Route::patch('/{user}/restore', [UserController::class, 'restore'])
        ->name('restore');

    Route::patch('/{user}/status', [UserController::class, 'toggleStatus'])
        ->name('status');
});
Route::resource('users', UserController::class);

        /*
        |--------------------------------------------------------------------------
        | SUBJECTS (FIXED FULL TRASH SYSTEM)
        |--------------------------------------------------------------------------
        */

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

        Route::resource('subjects', SubjectController::class);

        /*
        |--------------------------------------------------------------------------
        | DOCUMENT TYPES
        |--------------------------------------------------------------------------
        */

        Route::patch('/document-types/{document_type}/status', [DocumentTypeController::class, 'toggleStatus'])
            ->name('document-types.status');

        Route::resource('document-types', DocumentTypeController::class);

        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        Route::get('/statistics', [StatisticsController::class, 'index'])
            ->name('statistics.index');

        /*
        |--------------------------------------------------------------------------
        | LOGS
        |--------------------------------------------------------------------------
        */

        Route::get('/logs', [LogController::class, 'index'])
            ->name('logs.index');

        Route::post('/logs/read-all', [LogController::class, 'markAllAsRead'])
            ->name('logs.readAll');
    });