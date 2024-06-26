<?php

use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;

# Public Routes
Route::get('/sign-up', [AuthenticationController::class, 'signUpForm'])->name('registration');
Route::post('/sign-up', [AuthenticationController::class, 'signUp'])->name('registration.submit');
Route::get('/sign-in', [AuthenticationController::class, 'signInForm'])->name('login');
Route::post('/sign-in', [AuthenticationController::class, 'signIn'])->name('login.submit');

# Private Routes
Route::group(['middleware' => 'auth'], function () {
    # Logout
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

    # Home
    Route::get('/', function () {
        return view('index');
    })->name('home');
});
