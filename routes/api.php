<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GIFController;
use App\Http\Controllers\GIFFavoriteController;

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('gifs', [GIFController::class, 'buscarGIFPorQuery']);
    Route::get('gifs/{id}', [GIFController::class, 'buscarGIFPorID']);
    Route::post('favorites', [GIFFavoriteController::class, 'guardarGIFFavorito']);
});
