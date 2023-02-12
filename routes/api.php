<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('login/{provider}', [AuthController::class, 'redirectProvider']);
Route::post('login', [AuthController::class, 'login']);
Route::post('login/{provider}/callback', [AuthController::class, 'handleProviderCallback']);

Route::middleware(['auth.api'])->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
});
