<?php

namespace App\Filament\Resources\GedungResource\Widgets;

use App\Models\Gedung;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GedungOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Gedung', Gedung::count())
                ->description('Jumlah Semua Gedung')
                ->descriptionIcon('heroicon-m-building-library')
                ->color('primary'),
        ];
    }
}
