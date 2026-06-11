<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SettingController;

// 1. SISTEM AUTENTIKASI
require __DIR__.'/auth.php';

// 2. HALAMAN UTAMA (Tanpa Login)
Route::get('/', function () {
    return view('welcome');
});

// 3. KELOMPOK AKSES BERSAMA (Kasir & Admin Wajib Login)
Route::middleware('auth')->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['verified'])
        ->name('dashboard');
        
    // Manajemen Profil Pengguna
    Route::get('/setting', [App\Http\Controllers\SettingController::class, 'edit'])->name('setting.edit');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Fitur Operasional Kasir
    Route::resource('transaksi', TransaksiController::class);
    Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetakStruk'])->name('transaksi.cetak');
    Route::resource('pelanggan', PelangganController::class);
});

// 4. KELOMPOK AKSES KHUSUS (Hanya Admin yang Bisa Masuk)
Route::middleware(['auth', 'admin'])->group(function () {
    
    Route::post('/setting', [App\Http\Controllers\SettingController::class, 'update'])->name('setting.update');
    // Master Data Meja Billiard
    Route::resource('meja', MejaController::class);
    
    // Laporan Keuangan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    
    // Rute Asli Log Aktivitas
    Route::get('/activity-log', [DashboardController::class, 'activityLog'])->name('activity.log');
});