 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SubjectTeacherController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SubjectFollowController;
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

Route::get('/subjects', [SubjectController::class, 'index'])
    ->name('subjects.index');

// Danh sách môn học theo dõi
Route::get('/subjects/following', [SubjectFollowController::class, 'index'])
    ->middleware('auth')
    ->name('subjects.following');

// Theo dõi môn học
Route::post('/subjects/{subject_code}/follow', [SubjectFollowController::class, 'store'])
    ->middleware('auth')
    ->name('subjects.follow');

// Bỏ theo dõi môn học
Route::delete('/subjects/{subject_code}/follow', [SubjectFollowController::class, 'destroy'])
    ->middleware('auth')
    ->name('subjects.unfollow');

// Chi tiết môn học (đặt cuối cùng)
Route::get('/subjects/{subject_code}', [SubjectController::class, 'show'])
    ->name('subjects.show');
/*
|--------------------------------------------------------------------------
| Documents
|--------------------------------------------------------------------------
*/

Route::get('/documents', [DocumentController::class, 'index'])
    ->name('documents.index');

Route::get('/documents/create', [DocumentController::class, 'create'])
    ->name('documents.create');

Route::post('/documents', [DocumentController::class, 'store'])
    ->name('documents.store');

Route::get('/documents/latest', function () {
    return view('documents.latest');
})->name('documents.latest');

Route::get('/documents/search', [DocumentController::class, 'search'])
    ->name('documents.search');

Route::get('/tai-lieu-cua-toi', [DocumentController::class, 'myDocuments'])
    ->name('documents.my-documents');

Route::get('/documents/{document}/download', [DocumentController::class, 'download'])
    ->name('documents.download');

Route::get('/documents/{document}/view', [DocumentController::class, 'view'])
    ->name('documents.view');
Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])
    ->name('documents.edit');
Route::put('/documents/{document}', [DocumentController::class, 'update'])
    ->name('documents.update');
Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])
    ->name('documents.destroy');
Route::get('/documents/{document}', [DocumentController::class, 'show'])
    ->name('documents.show');
Route::get('/tai-lieu-cua-toi/thung-rac', [DocumentController::class, 'trash'])
        ->name('documents.trash');
Route::patch('/tai-lieu/{document}/restore', [DocumentController::class, 'restore'])
    ->name('documents.restore');
Route::delete('/tai-lieu/{document}/force-delete', [DocumentController::class, 'forceDelete'])
    ->name('documents.forceDelete');
Route::get('/tai-lieu-cua-toi', [DocumentController::class, 'myDocuments'])
    ->name('documents.my-documents');

Route::delete('/tai-lieu-cua-toi/{document}', [DocumentController::class, 'destroyMyDocument'])
    ->name('documents.destroyMyDocument');
/*
|--------------------------------------------------------------------------
| Faculties
|--------------------------------------------------------------------------
*/

Route::get('/faculties', [FacultyController::class, 'index'])
    ->name('faculties.index');

Route::get('/faculties/{faculty}', [FacultyController::class, 'show'])
    ->name('faculties.show');

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





Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Notification
    |--------------------------------------------------------------------------
    */
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

   Route::get('/notifications/{id}/read', [NotificationController::class, 'read'])
    ->name('notifications.read');
    
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])
        ->name('notifications.readAll');


    /*
    |--------------------------------------------------------------------------
    | Subject Teacher
    |--------------------------------------------------------------------------
    */
    Route::post('/subject-teachers/assign', [SubjectTeacherController::class, 'assign'])
        ->name('subject-teachers.assign');

    Route::delete('/subject-teachers/{id}', [SubjectTeacherController::class, 'remove'])
        ->name('subject-teachers.remove');
    Route::get(
        '/my-downloads',
        [DownloadController::class, 'history']
    )->name('downloads.history');
    Route::get(
        '/my-favorites',
        [FavoriteController::class,'index']
    )->name('favorites.index');

    Route::post(
        '/favorites/{document}',
        [FavoriteController::class,'toggle']
    )->name('favorites.toggle');




        Route::post(
        '/tai-lieu/{document}/binh-luan',
        [CommentController::class, 'store']
    )->name('comments.store');

    Route::delete(
        '/binh-luan/{comment}',
        [CommentController::class, 'destroy']
    )->name('comments.destroy');

Route::post(
    '/comments/{comment}/reply',
    [CommentController::class,'reply']
)->name('comments.reply');





});   
Route::view('/about', 'about')->name('about');