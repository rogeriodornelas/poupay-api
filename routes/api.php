<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;


Route::get('login/{provider}', [AuthController::class, 'redirectProvider']);
Route::post('login', [AuthController::class, 'login']);
Route::post('login/{provider}/callback', [AuthController::class, 'handleProviderCallback']);

Route::middleware(['auth.api'])->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);

    Route::prefix('payment')->group(function () {
        Route::get('/', [InvoiceController::class, 'list']);
        Route::post('/', [InvoiceController::class, 'create']);
        Route::put('/{id}', [InvoiceController::class, 'update'])->where('invoice_id', '[0-9]+');
    });
});
