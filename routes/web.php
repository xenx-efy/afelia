<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
