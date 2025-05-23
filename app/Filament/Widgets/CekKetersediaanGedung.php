<?php

namespace App\Filament\Widgets;

use App\Models\Gedung;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Database\Eloquent\Builder;

class CekKetersediaanGedung extends BaseWidget
{
    use InteractsWithPageFilters;

    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? now();

        $startDate = $startDate ? Carbon::parse($startDate) : null;
        $endDate = $endDate ? Carbon::parse($endDate) : now();

        return Gedung::query()
            ->where('status', 'ready')
            ->when($startDate, fn ($q) => $q->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->whereDate('created_at', '<=', $endDate));
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('nama_gedung')->label('Nama Gedung')->searchable(),
            Tables\Columns\TextColumn::make('tipe_gedung')->label('Tipe'),
            Tables\Columns\TextColumn::make('kapasitas')->label('Kapasitas'),
            Tables\Columns\TextColumn::make('harga')->label('Harga')->money('IDR'),
            Tables\Columns\TextColumn::make('created_at')->label('Tanggal Tambah')->date(),
        ];
    }
}
