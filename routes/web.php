 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Teacher\DocumentController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/home', function () {
    return redirect()->route('home');
});

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Subjects
|--------------------------------------------------------------------------
*/

Route::get('/subjects', function () {
    return view('subjects.index');
})->name('subjects.index');

Route::get('/subjects/{id}', function ($id) {
    return view('subjects.show', compact('id'));
})->name('subjects.show');

/*
|--------------------------------------------------------------------------
| Documents
|--------------------------------------------------------------------------
*/

Route::get('/documents', function () {
    return view('documents.index');
})->name('documents.index');

Route::get('/documents/latest', function () {
    return view('documents.latest');
})->name('documents.latest');



Route::get(
    '/documents/{id}',
    [DocumentController::class, 'show']
)->name('documents.show');

Route::get('/documents/{id}/edit', function ($id) {
    return view('documents.edit', compact('id'));
})->name('documents.edit');

Route::get('/tai-lieu-cua-toi', [DocumentController::class, 'myDocuments'])
    ->name('documents.my-documents');

Route::get('/search', function () {
    return view('documents.search');
})->name('documents.search');

/*
|--------------------------------------------------------------------------
| Faculties
|--------------------------------------------------------------------------
*/

Route::view('/faculties', 'faculties.index')->name('faculties.index');

Route::get('/faculties/{code}', function ($code) {
    return view('faculties.show', compact('code'));
})->name('faculties.show');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

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
 