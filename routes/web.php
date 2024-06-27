<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\HomeController;
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
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'events', 'as' => 'events.'], function () {
       Route::get('/', [EventController::class, 'index'])->name('index');
       Route::get('/create', [EventController::class, 'create'])->name('create');
       Route::post('/', [EventController::class, 'store'])->name('store');
       Route::get('/{id}/edit', [EventController::class, 'edit'])->name('edit');
       Route::put('/{id}/edit', [EventController::class, 'update'])->name('update');
       Route::delete('/{id}', [EventController::class, 'destroy'])->name('delete');
    });
});
