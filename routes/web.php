<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Welcome Page
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/*
|--------------------------------------------------------------------------
| Dashboard (Admin Only)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'isAdmin'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Home (Logged users)
|--------------------------------------------------------------------------
*/

Route::get('/home', [HomeController::class, 'index'])
    ->middleware(['auth', 'isAdmin'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Admin/User Management (Admin Only)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/user', [UserController::class, 'index'])->name('user');

    Route::get('/user/show/{id}', [UserController::class, 'show'])->name('user.show');

    Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');

    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');

    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');

    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

});