<?php

use App\Http\Controllers\ComposerController;
use App\Http\Controllers\CompositionController;
use App\Http\Controllers\TrackListController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/', [TrackListController::class, 'index']);

Route::prefix('async')->group(function () {
    Route::get('/tracks', [CompositionController::class, 'index']);
    Route::post('/tracks', [CompositionController::class, 'store']);
    Route::put('/tracks/{id}', [CompositionController::class, 'update']);
    Route::delete('/tracks/{id}', [CompositionController::class, 'delete']);
    Route::post('/tracks/{id}', [CompositionController::class, 'nowPlayed']);

    Route::get('/tags', [TagController::class, 'index']);
    Route::post('/tags', [TagController::class, 'store']);
    Route::put('/tags/{id}', [TagController::class, 'update']);
    Route::delete('/tags/{id}', [TagController::class, 'delete']);

    Route::get('/composers', [ComposerController::class, 'index']);
    Route::post('/composers', [ComposerController::class, 'store']);
    Route::put('/composers/{id}', [ComposerController::class, 'update']);
    Route::delete('/composers/{id}', [ComposerController::class, 'delete']);

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);
});
