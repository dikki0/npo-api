<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StreamEventController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->group(function () {
    Route::post('stream_events', [StreamEventController::class, 'store'])->name('stream_events.store');
});

//Route::post('stream_events', [StreamEventController::class, 'store'])->name('stream_events.store');

//Route::post('stream_events', 'StreamEventController@store');

//Route::apiResource('stream_events', StreamEventController::class);
