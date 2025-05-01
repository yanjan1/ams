<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return route('login');
});


Route::get('/login', function () {
    return view('auth.login');
})->name('login');