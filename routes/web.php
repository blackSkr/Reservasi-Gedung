<?php

use App\Filament\Pages\Auth\Register;
use App\Http\Controllers\CetakReservasiController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ReservasiController;
use App\Providers\Filament\AdminPanelProvider;
use Filament\Pages\Auth\Register as AuthRegister;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::redirect('/admin', '/admin/dashboard');
Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::get('/reservasi/cetak/{id}', [CetakReservasiController::class, 'cetak'])->name('reservasi.cetak');
Route::match(['get', 'post'], '/reservasi/{reservation}/bayar', [ReservasiController::class, 'bayar'])
    ->middleware('auth')
    ->name('reservasi.bayar');




