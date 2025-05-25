<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
})->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::middleware('auth')->group(function() {

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');


    Route::get('/', function () {
        return view('pages/dashboard/index');
    })->name('dashboard');
    Route::resource('users', UserController::class);


});


