<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StreamController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::controller(LoginController::class)->middleware('guest')->group(function () {
    Route::get('/login', 'index')->name('auth.login');
    Route::get('/login/twitch', 'twitch')->name('auth.twitch');
    Route::get('/login/twitch/redirect', 'twitchRedirect')->name('auth.twitch.redirect');
});

Route::post('/logout', [LoginController::class,'logout'])->middleware('auth:web')->name('auth.logout');

Route::middleware('auth:web')->group(function () {
    Route::get('/', [StreamController::class, 'index'])->name('home');
});
