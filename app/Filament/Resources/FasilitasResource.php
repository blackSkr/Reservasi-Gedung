<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FasilitasResource\Pages;
use App\Filament\Resources\FasilitasResource\RelationManagers;
use App\Models\Fasilitas;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

class FasilitasResource extends Resource
{
    protected static ?string $model = Fasilitas::class;

    // protected static ?string $navigationIcon = 'heroicon-m-squares-2x2';
    
    protected static ?string $navigationGroup = "Gedung";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    //
                    Forms\Components\TextInput::make('nama_fasilitas')
                        ->required()
                        ->maxLength(50)
                        ->label("Nama Fasilitas"),
                    Forms\Components\TextInput::make('jumlah')
                        ->required()
                        ->numeric()
                        ->label("Jumlah Fasilitas"),
                    Forms\Components\TextInput::make('harga')
                        ->required()
                        ->numeric()
                        ->maxLength(15)
                        ->label("Harga Fasilitas")
                        ->prefix('Rp')
                        ->formatStateUsing(function ($state) {
                            return $state ? 'Rp ' . number_format($state, 0, ',', '.') : '-';
                        }),
                    Select::make('status')
                        ->required()
                        ->label('Status')
                        ->native(false)
                        ->options([
                            'tidak tersedia' => 'Tidak Tersedia',
                            'tersedia' => 'Tersedia',
                        ]),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('nama_fasilitas')->label('Nama Fasiliass')
            ->searchable(),
            textColumn::make('jumlah')
            ->label('Jumlah'),
            TextColumn::make('harga')
            ->label('harga')
            ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
            TextColumn::make('status')
            ->badge()
            ->sortable('status')
            ->searchable( )
            ->label("Status")
            ->color(fn (string $state): string => match ($state) {
                'tersedia' => 'success',
                'tidak tersedia' => 'danger',
                })
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
    public static function getNavigationBadge(): ?string
    {
        $hitungFasilitas = static::getEloquentQuery()->where('nama_fasilitas', 0)->count();
    
        return $hitungFasilitas > 0 ? strval($hitungFasilitas) : null;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFasilitas::route('/'),
            'create' => Pages\CreateFasilitas::route('/create'),
            // 'edit' => Pages\EditFasilitas::route('/{record}/edit'),
        ];
    }
}
