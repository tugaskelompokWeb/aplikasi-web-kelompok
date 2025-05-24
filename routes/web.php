<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/', function () {
    return view('pages/dashboard/index');
})->name('dashboard');
