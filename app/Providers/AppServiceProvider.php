<?php

namespace App\Providers;

use App\Http\Livewire\TopGedung;
use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
            Livewire::component('grafik-reservasi-bulanan', \App\Http\Livewire\GrafikReservasiBulanan::class);
            Livewire::component('grafik-pendapatan', \App\Http\Livewire\GrafikPendapatan::class);
            Livewire::component('top-gedung', TopGedung::class);
            Livewire::component('pie-tipe-gedung', \App\Http\Livewire\PieTipeGedung::class);
            Livewire::component('reservasi-terakhir', \App\Http\Livewire\ReservasiTerakhir::class);

    }
}
