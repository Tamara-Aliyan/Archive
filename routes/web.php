<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\ProfileController;
use App\Models\File;
use App\Models\Keyword;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/users', function () {
//     $userCount = User::count();
//     return view('userCount', ['userCount' => $userCount]);
// });

Route::get('/dashboard', function () {
    $userCount = User::count();
    $keywordCount = Keyword::count();
    $fileCount = File::count();
    return view('admin.dashboard',['userCount' => $userCount , 'keywordCount' => $keywordCount , 'fileCount' => $fileCount]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

// KeywordController
    Route::get('/keyword', [KeywordController::class,'index'])->name('k_index');
    Route::post('/keyword/store', [KeywordController::class,'store'])->name('k_store');
    Route::patch('/keyword/update',[KeywordController::class,'update'])->name('k_update');
    Route::delete('/keyword/destroy',[KeywordController::class,'destroy'])->name('k_destroy');

// FileController
    Route::get('/file', [FileController::class,'index'])->name('f_index');
    Route::post('/file/store', [FileController::class,'store'])->name('f_store');
    Route::get('/file/download/{filepath}',[FileController::class,'download'])->name('f_download');
    Route::get('/file/show/{id}',[FileController::class,'show'])->name('f_show');
    Route::get('file/search',[FileController::class,'search'])->name('f_search');
    Route::patch('/file/update',[FileController::class,'update'])->name('f_update');
    Route::delete('/file/destroy',[FileController::class,'destroy'])->name('f_destroy');

// UserController
    Route::get('/user', [UserController::class,'index'])->name('u_index');
    Route::post('/user/store', [UserController::class,'store'])->name('u_store');
    Route::patch('/user/update',[UserController::class,'update'])->name('u_update');
    Route::delete('/user/destroy',[UserController::class,'destroy'])->name('u_destroy');

//ProfileController
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
