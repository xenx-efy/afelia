<?php

use App\Http\Controllers\CompositionController;
use App\Http\Controllers\TrackListController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/', [TrackListController::class, 'index']);

Route::prefix('async')->group(function () {
    Route::get('/tracks', [CompositionController::class, 'index']);
    Route::post('/tracks', [CompositionController::class, 'create']);
    Route::put('/tracks', [CompositionController::class, 'update']);
    Route::delete('/tracks', [CompositionController::class, 'delete']);
});

