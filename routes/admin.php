<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\FacultyController;
/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------
        | DASHBOARD
        |--------------------------
        */
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------
        | USERS
        |--------------------------
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


        
        Route::get('/faculties', [FacultyController ::class, 'index'])
            ->name('faculties.index');






        
        /*
        |--------------------------
        | SUBJECTS
        |--------------------------
        */
        Route::prefix('subjects')->name('subjects.')->group(function () {

            Route::get('/trashed', [SubjectController::class, 'trashed'])
                ->name('trashed');

            Route::post('/restore-multiple', [SubjectController::class, 'restoreMultiple'])
                ->name('restoreMultiple');

            Route::patch('/{subject}/restore', [SubjectController::class, 'restore'])
                ->name('restore');

            Route::delete('/{subject}/force-delete', [SubjectController::class, 'forceDelete'])
                ->name('forceDelete');

            Route::patch('/{subject}/status', [SubjectController::class, 'toggleStatus'])
                ->name('status');
        });

        Route::resource('subjects', SubjectController::class);

        /*
        |--------------------------
        | DOCUMENT TYPES
        |--------------------------
        */
        Route::prefix('document-types')->name('document-types.')->group(function () {

            Route::get('/trashed', [DocumentTypeController::class, 'trashed'])
                ->name('trashed');

            Route::post('/restore-multiple', [DocumentTypeController::class, 'restoreMultiple'])
                ->name('restoreMultiple');

            Route::patch('/{document_type}/restore', [DocumentTypeController::class, 'restore'])
                ->name('restore');

            Route::delete('/{document_type}/force-delete', [DocumentTypeController::class, 'forceDelete'])
                ->name('forceDelete');

            Route::patch('/{document_type}/status', [DocumentTypeController::class, 'toggleStatus'])
                ->name('status');
        });

        Route::resource('document-types', DocumentTypeController::class);


        Route::prefix('documents')->name('documents.')->group(function () {

    Route::get('/trashed', [DocumentController::class, 'trashed'])
        ->name('trashed');

    Route::post('/restore-multiple', [DocumentController::class, 'restoreMultiple'])
        ->name('restoreMultiple');

    Route::patch('/{document}/restore', [DocumentController::class, 'restore'])
        ->name('restore');

    Route::delete('/{document}/force-delete', [DocumentController::class, 'forceDelete'])
        ->name('forceDelete');

    Route::patch('/{document}/status', [DocumentController::class, 'toggleStatus'])
        ->name('status');
});

Route::resource('documents', DocumentController::class);
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