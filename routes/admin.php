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
use App\Http\Controllers\Admin\CommentController;
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
        
            /*
        |--------------------------------------------------------------------------
        | FACULTIES
        |--------------------------------------------------------------------------
        */
                

        Route::get('/faculties', [FacultyController::class, 'index'])
            ->name('faculties.index');

        Route::get('/faculties/create', [FacultyController::class, 'create'])
            ->name('faculties.create');

        Route::post('/faculties', [FacultyController::class, 'store'])
            ->name('faculties.store');

        Route::get('/faculties/trashed', [FacultyController::class, 'trashed'])
            ->name('faculties.trashed');

        Route::post('/faculties/restore-multiple', [FacultyController::class, 'restoreMultiple'])
            ->name('faculties.restoreMultiple');

        Route::patch('/faculties/{faculty}/restore', [FacultyController::class, 'restore'])
            ->name('faculties.restore');

        Route::delete('/faculties/{faculty}/force-delete', [FacultyController::class, 'forceDelete'])
            ->name('faculties.forceDelete');

        Route::get('/faculties/{faculty}', [FacultyController::class, 'show'])
            ->name('faculties.show');

        Route::get('/faculties/{faculty}/edit', [FacultyController::class, 'edit'])
            ->name('faculties.edit');

        Route::put('/faculties/{faculty}', [FacultyController::class, 'update'])
            ->name('faculties.update');

        Route::patch('/faculties/{faculty}/status', [FacultyController::class, 'toggleStatus'])
            ->name('faculties.toggle-status');

        Route::delete('/faculties/{faculty}', [FacultyController::class, 'destroy'])
            ->name('faculties.destroy');
 
        Route::get(
    '/faculties/{faculty}/teachers',
    [SubjectController::class, 'getTeachersByFaculty']
)->name('faculties.teachers');
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
        /*
        |--------------------------
        | DOCUMENT 
        |--------------------------
        */
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
            Route::resource('comments', CommentController::class);

Route::patch('comments/{comment}/status', [CommentController::class, 'toggleStatus'])->name('comments.status');
Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});