<?php

use App\Http\Controllers\StreamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(StreamController::class)->group(function () {
    Route::get('/streams-per-game', 'streamPerGame');
    Route::get('/top-games-by-viewer-count', 'topGamesByViewerCount');
    Route::get('/median-viewer-count', 'medianViewerCount');
    Route::get('/top-streams-by-viewer-count', 'topStreamsByViewerCount');
    Route::get('/number-of-streams-by-start-time', 'numberOfStreamsByStartTime');
    Route::get('/streams-followed-by-user', 'streamsFollowedByUser');
    Route::get('/viewers-for-stream-to-make-it-to-list', 'viewersNeededForLeastFollowed');
    Route::get('/shared-tags', 'sharedTags');
});

