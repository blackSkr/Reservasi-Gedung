<?php

namespace App\Filament\Resources\GedungResource\Pages;

use App\Filament\Resources\GedungResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\CreateAction;

class CreateGedung extends CreateRecord
{
    protected static string $resource = GedungResource::class;
    protected $table = "gedung";
    public function getHeading(): string
    {
        return 'Tambah Gedung';
    }
    protected function getCreateFormActions(): array
    {
        return [
            CreateAction::make()
                ->label('Simpan')
                ->createAnotherLabel('Simpan & Tambah Lagi')
                ->cancelLabel('Batal'),
        ];
    }
}