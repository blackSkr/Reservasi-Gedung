<?php

namespace App\Filament\Resources\ReservasiResource\Pages;

use App\Filament\Resources\ReservasiResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;
use SebastianBergmann\CodeUnit\FunctionUnit;

class ListReservasi extends ListRecords
{
    protected static string $resource = ReservasiResource::class;
    use ExposesTableToWidgets;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label("Buat Reservasi"),
        ];
    }
        protected function getHeaderWidgets(): array
    {
        return ReservasiResource::getWidgets();
    }
        public function getTabs(): array
    {
        return [
            null => Tab::make('Semua'),
            'Pending' => Tab::make()->query(fn ($query) => $query->where('status', 'pending')),
            'Disetujui' => Tab::make()->query(fn ($query) => $query->where('status', 'disetujui')),
            'Sudah Membayar' => Tab::make()->query(fn ($query) => $query->where('status', 'Sudah Membayar')),
            'Ditolak' => Tab::make()->query(fn ($query) => $query->where('status', 'ditolak')),
            // 'shipped' => Tab::make()->query(fn ($query) => $query->where('status', 'shipped')),
        ];
    }

    // public function getTabs(): array
    // {
    //     return [
    //         'sudah_membayar' => Tab::make('Sudah Membayar')
    //         ->modifyQueriUsing(function($query){
    //             return $query->where('status', OrderStatus::sudah_membayar->value);
    //          }),
    //         ];
    // }
}
