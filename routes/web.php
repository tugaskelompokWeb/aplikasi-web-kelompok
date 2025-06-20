<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaransiController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\MekanikController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServisController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
})->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::middleware('role:developer')->group(function () {
            Route::resource('users', UserController::class);
            Route::resource('roles', RoleController::class);
        });

        Route::middleware('role:developer,admin')->group(function () {
            Route::resource('barang', BarangController::class);
            Route::resource('garansi', GaransiController::class);
            Route::resource('jasa', JasaController::class);
        });

            Route::resource('pelanggan', PelangganController::class);
            Route::resource('mekanik', MekanikController::class);
            Route::resource('servis', ServisController::class);
            Route::resource('kendaraan', KendaraanController::class);
            Route::resource('transaksi', TransaksiController::class);

        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });



