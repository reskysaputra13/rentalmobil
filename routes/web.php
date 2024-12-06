<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {

    Route::middleware(['auth'])->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
    });

    Route::middleware(['guest'])->group(function () {
        Route::get('login', [AuthController::class, 'login'])->name('auth.login');
        Route::post('login', [AuthController::class, 'post'])->name('auth.login');
        Route::get('register', [AuthController::class, 'register'])->name('auth.register');
    });
});

/*
|--------------------------------------------------------------------------
| End Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth', 'checkUserDetail')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Users Routes
    |--------------------------------------------------------------------------
    */

    Route::prefix('users')->group(function () {
        Route::get('index', [UserController::class, 'index'])->name('users.index')->middleware('checkRole:SAD');
        Route::get('profile/{id}', [UserController::class, 'profile'])->name('users.profile');
        Route::put('profile/{id}', [UserController::class, 'update'])->name('users.profile');
    });

    /*
    |--------------------------------------------------------------------------
    | End Users Routes
    |--------------------------------------------------------------------------
    */
});
