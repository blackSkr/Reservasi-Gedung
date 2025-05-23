<?php

namespace App\Filament\Resources\ReservasiResource\Widgets;

use App\Filament\Resources\ReservasiResource;
use App\Models\Reservasi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ReservasiOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Reservasi', Reservasi::count())
                ->description('Jumlah reservasi masuk')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary'),
        ];
    }
}
