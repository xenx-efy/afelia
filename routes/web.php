<?php

use App\Http\Controllers\ComposerController;
use App\Http\Controllers\CompositionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TrackListController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/', [TrackListController::class, 'index']);

Route::prefix('async')->group(function () {
    Route::get('/tracks', [CompositionController::class, 'index']);
    Route::post('/tracks', [CompositionController::class, 'store']);
    Route::put('/tracks', [CompositionController::class, 'update']);
    Route::delete('/tracks', [CompositionController::class, 'delete']);

    Route::get('/tags', [TagController::class, 'index']);
    Route::post('/tags', [TagController::class, 'store']);
    Route::put('/tags', [TagController::class, 'update']);
    Route::delete('/tags', [TagController::class, 'delete']);

    Route::get('/composers', [ComposerController::class, 'index']);
    Route::post('/composers', [ComposerController::class, 'store']);
    Route::put('/composers', [ComposerController::class, 'update']);
    Route::delete('/composers', [ComposerController::class, 'delete']);
});

Route::get('/user', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'store'])->name('create-user');
