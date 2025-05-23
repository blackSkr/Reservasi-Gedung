<?php

namespace App\Filament\Resources\UlasanResource\Pages;

use App\Filament\Resources\UlasanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Gedung;
class EditUlasan extends EditRecord
{
    protected static string $resource = UlasanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
