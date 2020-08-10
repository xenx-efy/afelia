<?php

use App\Http\Controllers\TrackListController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::resource('composition', 'CompositionController');

Route::get('/track-list', [TrackListController::class, 'index'])->name('track-list');

Route::get('/', 'HomeController@index');
