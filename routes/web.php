<?php

use App\Http\Controllers\CompositionController;
use App\Http\Controllers\TrackListController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/track-list', [TrackListController::class, 'index'])->name('track-list');

Route::get('/', [TrackListController::class, 'index']);

Route::prefix('async')->group(function () {
    Route::get('/search-by-title', [TrackListController::class, 'searchByTitle']);
});

