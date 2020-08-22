<?php

use App\Http\Controllers\CompositionController;
use App\Http\Controllers\TrackListController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/', [TrackListController::class, 'index']);

Route::prefix('async')->group(function () {
    Route::get('/tracks', [CompositionController::class, 'index']);
});

