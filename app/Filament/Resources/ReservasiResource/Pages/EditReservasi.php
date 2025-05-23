<?php

namespace App\Filament\Resources\ReservasiResource\Pages;

use App\Filament\Resources\ReservasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Gedung;

class EditReservasi extends EditRecord
{
    protected static string $resource = ReservasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // protected function afterSave(): void
    // {
    //     $gedung = Gedung::find($this->data['gedung_id']);

    //     if (! $gedung) {
    //         return;
    //     }

    //     if ($this->data['status'] === 'disetujui') {
    //         $gedung->status = 'digunakan';
    //     } elseif ($this->data['status'] === 'ditolak') {
    //         $gedung->status = 'ready';
    //     } elseif($this->data['status'] === 'pending'){
    //         $gedung->status= 'pending';
    //     }

    //     $gedung->save();
    // }
}
