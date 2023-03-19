<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;


Route::get('login/{provider}', [AuthController::class, 'redirectProvider']);
Route::post('login', [AuthController::class, 'login']);
Route::post('login/{provider}/callback', [AuthController::class, 'handleProviderCallback']);

Route::middleware(['auth.api'])->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);

    Route::prefix('payment')->group(function () {
        Route::get('/', [PaymentController::class, 'list']);
        Route::post('/', [PaymentController::class, 'create']);
        Route::put('/{id}', [PaymentController::class, 'update'])->where('invoice_id', '[0-9]+');
    });
});
