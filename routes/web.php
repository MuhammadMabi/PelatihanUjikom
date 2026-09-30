<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;


Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('buku')->group(function () {
        Route::get('/', [BukuController::class, 'index'])->name('buku.index');
        Route::get('/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/createOrUpdate', [BukuController::class, 'createOrUpdate'])->name('buku.createOrUpdate');
        Route::get('/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
        Route::delete('/delete/{id}', [BukuController::class, 'delete'])->name('buku.delete');
    });

    Route::prefix('anggota')->group(function () {
        Route::get('/', [AnggotaController::class, 'index'])->name('anggota.index');
        Route::get('/create', [AnggotaController::class, 'create'])->name('anggota.create');
        Route::post('/createOrUpdate', [AnggotaController::class, 'createOrUpdate'])->name('anggota.createOrUpdate');
        Route::get('/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota.edit');
        Route::delete('/delete/{id}', [AnggotaController::class, 'delete'])->name('anggota.delete');
    });

    Route::prefix('transaksi')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('transaksi.index');
        Route::get('/create', [TransaksiController::class, 'create'])->name('transaksi.create');
        Route::post('/createOrUpdate', [TransaksiController::class, 'createOrUpdate'])->name('transaksi.createOrUpdate');
        Route::get('/edit/{id}', [TransaksiController::class, 'edit'])->name('transaksi.edit');
        Route::delete('/delete/{id}', [TransaksiController::class, 'delete'])->name('transaksi.delete');
    });

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});