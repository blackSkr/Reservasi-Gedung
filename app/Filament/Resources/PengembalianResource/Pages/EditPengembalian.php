<?php

namespace App\Filament\Resources\PengembalianResource\Pages;

use App\Filament\Resources\PengembalianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengembalian extends EditRecord
{
    protected static string $resource = PengembalianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function canEdit(): bool
    {
        return in_array($this->record->status_pengembalian, ['menunggu_verifikasi']);
    }

}
