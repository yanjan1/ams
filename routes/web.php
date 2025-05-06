<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');


Route::get('/email', [EmailController::class, 'showEmails'])->name('email');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request')->name('forgot-password');

Route::post('/forgot-password', [AuthController::class, 'sendOTPAndVerify'])->name('forgot-password.submit');

Route::get('/activation_otp_verify', [AuthController::class, 'sendOTPAndVerify'])->middleware(['auth', 'tokenExists'])->name('activation-otp-form');

Route::post('/activation-otp-verify', [AuthController::class, 'activationOTPCheck'])
->middleware('auth')->name('otp-activation-verify');

// dashboard starts here
Route::get('/dashboard', [DashboardController::class, 'getDashboard'])->middleware(['auth', 'activation'])->name('dashboard');

Route::post('/dashboard/roleselector', [DashboardController::class, 'roleselector'])->middleware(['auth', 'activation'])->name('role-selector');






// logout is here

Route::get('/logout', [AuthController::class, 'getLogout'])->middleware('auth')->name('getLogout');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


