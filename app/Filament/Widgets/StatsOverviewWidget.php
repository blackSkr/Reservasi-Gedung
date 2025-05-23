<?php

namespace App\Filament\Widgets;

use App\Models\Gedung;
use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class StatsOverviewWidget extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 0;

protected function getStats(): array
{
    $startDate = $this->filters['startDate'] ?? null;
    $endDate = $this->filters['endDate'] ?? now();

    // Konversi tanggal jika tersedia
    $startDate = $startDate ? Carbon::parse($startDate) : null;
    $endDate = $endDate ? Carbon::parse($endDate) : now();

    // Ambil data total gedung
    $totalGedung = Gedung::when($startDate, fn($q) => $q->whereDate('created_at', '>=', $startDate))
        ->when($endDate, fn($q) => $q->whereDate('created_at', '<=', $endDate))
        ->count();

    // Gedung ready
    $readyGedung = Gedung::when($startDate, fn($q) => $q->whereDate('created_at', '>=', $startDate))
        ->when($endDate, fn($q) => $q->whereDate('created_at', '<=', $endDate))
        ->where('status', 'ready')
        ->count();

    // Berdasarkan tipe gedung
    $gedungBesar = Gedung::where('tipe_gedung', 'Besar')->count();
    $gedungKecil = Gedung::where('tipe_gedung', 'Kecil')->count();
    $gedungSedang = Gedung::where('tipe_gedung', 'Sedang')->count();

    return [
        Stat::make('Total Gedung', $totalGedung)
            ->description('Jumlah semua gedung')
            ->descriptionIcon('heroicon-o-building-office')
            ->color('primary'),

        Stat::make('Gedung Ready', $readyGedung)
            ->description('Status: ready')
            ->descriptionIcon('heroicon-o-check-circle')
            ->color('success'),

        Stat::make('Gedung Besar', $gedungBesar)
            ->description('Tipe: Besar')
            ->descriptionIcon('heroicon-o-chart-bar')
            ->color('info'),

        Stat::make('Gedung Sedang', $gedungSedang)
            ->description('Tipe: Sedang')
            ->descriptionIcon('heroicon-o-chart-bar')
            ->color('warning'),

        Stat::make('Gedung Kecil', $gedungKecil)
            ->description('Tipe: Kecil')
            ->descriptionIcon('heroicon-o-chart-bar')
            ->color('danger'),
    ];
}


}