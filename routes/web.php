<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessagerieController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TacheController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

# Socialite URLs

// La page où on présente les liens de redirection vers les providers
Route::get("login-register", [SocialiteController::class,'loginRegister']);

// La redirection vers le provider
Route::get("redirect/{provider}", [SocialiteController::class,'redirect'])->name('socialite.redirect');

// Le callback du provider
Route::get("callback/{provider}", [SocialiteController::class,'callback'])->name('socialite.callback');

Route::middleware(['auth'])->group(function() {
    Route::get('/home', [AdminController::class, 'index'])->name('home');
    //profil admin
    Route::get('/admin', [AdminController::class, 'profil'])->name('profil.index');
    Route::get('/admin/edit', [AdminController::class, 'edit'])->name('profil.edit');
    Route::put('/admin/update', [AdminController::class, 'update'])->name('profil.update');
    //liste entreprise et show details
    Route::get('/admin/entreprise', [AdminController::class, 'entreprises'])->name('entreprise.index');
    //CRUD task
    Route::get('/admin/task', [TacheController::class, 'index'])->name('tache.index');
    Route::get('/admin/task/create', [TacheController::class, 'create'])->name('tache.create');
    Route::post('/admin/task/store', [TacheController::class, 'store'])->name('tache.store');
    Route::get('/admin/task/edit/{id}', [TacheController::class, 'edit'])->name('tache.edit');
    Route::put('/admin/task/update/{id}', [TacheController::class, 'update'])->name('tache.update');
    Route::delete('/admin/task/delete/{id}', [TacheController::class, 'destroy'])->name('tache.destroy');

    //Message
    Route::get('/messages', [MessagerieController::class, 'index'])->name('messages.index');
    Route::get('/messages/show/{id}', [MessagerieController::class, 'show'])->name('messages.show');
    Route::post('/messages/store', [MessagerieController::class, 'store'])->name('messages.store');
    Route::get('/messages/create', [MessagerieController::class, 'create'])->name('messages.create');
});