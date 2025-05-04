<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/email', [EmailController::class, 'showEmails'])->name('email');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request')->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'sendOTPAndVerify'])->name('forgot-password.submit');