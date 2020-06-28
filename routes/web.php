<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::resource('composition', 'CompositionController');

Route::get('/', 'HomeController@index');
