<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfilPerusahaanResource\Pages;
use App\Filament\Resources\ProfilPerusahaanResource\RelationManagers;
use App\Models\ProfilPerusahaan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfilPerusahaanResource extends Resource
{
    protected static ?string $model = ProfilPerusahaan::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $pluralModelLabel = 'Profil Perusahaan';
    protected static ?string $navigationGroup = "Perusahaan";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nama_perusahaan')
                    ->label('Nama Perusahaan')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('Email Perusahaan')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('nomor_telepon')
                    ->label("Nomor Telepon")
                    ->columnSpanFull()
                    ->maxLength(14)
                    ->numeric() 
                    ->rule('regex:/^[0-9]+$/') 
                    ->required(),
                Forms\Components\TextInput::make('alamat_jalan')
                    ->label('Alamat Jalan')
                    ->required(),
                Forms\Components\TextInput::make('alamat_gedung')
                    ->label('Alamat Gedung/Ruko')
                    ->required(),
                Forms\Components\TextInput::make('kota')
                    ->label('kota')
                    ->required(),
                Forms\Components\TextInput::make('provinsi')
                    ->label('Provinsi')
                    ->required(),
                Forms\Components\FileUpload::make('qr_pembayaran')
                    ->label('Masukkan QR Pembayaran')
                    ->directory('profil_perusahaan')
                    ->required(),
                Forms\Components\TextInput::make('nomor_rekening')
                    ->label('Nomor Rekening')
                    ->required(),
                Forms\Components\TextInput::make('nama_rekening')
                    ->label('Atas Nama')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->required()
                    ->native(false)
                    ->options([
                        'Tampil' => 'Tampil',
                        'Tidak Tampil' => 'Tidak Tampil',
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_perusahaan')
                    ->label('Nama Perusahaan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('alamat_jalan')
                    ->label('Alamat Jalan'),
                TextColumn::make('kota')
                    ->label('Alamat Kota'),
                ImageColumn::make('qr_pembayaran')
                    ->label('QR Pembayaran')
                    ->circular(),
                TextColumn::make('Status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                            'Tampil' => 'success',
                            'Tidak Tampil' => 'warning',
                        }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfilPerusahaans::route('/'),
            'create' => Pages\CreateProfilPerusahaan::route('/create'),
            'edit' => Pages\EditProfilPerusahaan::route('/{record}/edit'),
        ];
    }
}
