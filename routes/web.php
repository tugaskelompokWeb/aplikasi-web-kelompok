<?php

use App\Http\Controllers\GaransiController;
use App\Http\Controllers\MekanikController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
})->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');


    Route::get('/', function () {
        return view('pages/dashboard/index');
    })->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('mekanik', MekanikController::class);
    Route::resource('garansi', GaransiController::class);



