<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {

    if (!Auth::check()) {
        return redirect()->route('home');
    }

    return match (Auth::user()->role_id) {
        1 => redirect('/admin/dashboard'),
        2, 3 => redirect()->route('home'),
        default => redirect()->route('login')
    };

});
Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/subjects', function () {
    return view('subjects.index');
})->name('subjects.index');

Route::get('/subjects/{id}', function ($id) {
    return view('subjects.show', compact('id'));
})->name('subjects.show');


Route::get('/documents', function () {
    return view('documents.index');
})->name('documents.index');

Route::get('/documents/latest', function () {
    return view('documents.latest');
})->name('documents.latest');

Route::get('/tai-lieu-cua-toi', function () {
    return view('documents.my-documents');
})->name('documents.my-documents');

Route::get('/search', function () {
    return view('documents.search');
})->name('documents.search');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [AuthController::class, 'profile'])
        ->name('profile');

    Route::put('/profile/update', [AuthController::class, 'updateProfile'])
        ->name('profile.update');

    Route::put('/profile/password', [AuthController::class, 'updatePassword'])
        ->name('profile.password');

    Route::post('/profile/avatar', [AuthController::class, 'updateAvatar'])
        ->name('profile.update.avatar');
});