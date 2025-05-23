<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GedungResource\Pages;
use App\Filament\Resources\GedungResource\RelationManagers;
use App\Models\Gedung;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Infolists\Components\TextEntry;
use App\Actions\ResetStars;
use Filament\Infolists\Components\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Support\Enums\ActionSize;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class GedungResource extends Resource
{
    protected static ?string $model = Gedung::class;
    protected static ?string $pluralModelLabel = "Gedung";
    
    // protected static ?string $navigationIcon = 'heroicon-m-building-library';

    protected static ?string $navigationGroup = 'Gedung';
    public static function form(Form $form): Form
    {
        // dump($form);
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('nama_gedung')
                    ->required()
                    ->maxLength(30)
                    ->label("Nama Gedung"),
                Forms\Components\TextInput::make('tipe_gedung')
                    ->required()
                    ->maxLength(35)
                    ->label("Tipe Gedung"),
                FileUpload::make('foto_gedung')
                    ->directory('foto'),
                Forms\Components\TextInput::make('harga')
                    ->required()
                    ->numeric()
                    ->maxLength(15)
                    ->label("Harga Sewa Gedung")
                    ->prefix('Rp'),
                Forms\Components\TextInput::make('kapasitas')
                    ->required()
                    ->numeric()
                    ->label('Kapasitas')
                    ->suffix('Orang'),            
                Forms\Components\TextInput::make('fasilitas')
                    ->required()
                    ->maxLength(50)
                    ->label("Fasilitas Yang Didapatkan"),
                Forms\Components\Textarea::make("deskripsi")
                    ->columnSpanFull()
                    ->label("Deskripsi Gedung")
                    ->maxLength(100)
                    ->required(),
                Section::make('Pilih Status Gedung')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'ready' => 'Ready',
                                'booked' => 'Booked',
                                'digunakan' => 'Digunakan',
                                'closed' => 'Closed',
                            ])
                            ->native(false)
                            ->default('closed'),
                        // ->disablePlaceholder(),
                            ]),
        // dd($form)

                ]);
    }

//     public static function getTableSearchPlaceholder(): ?string
// {
//     return 'Cari berdasarkan status';
// }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_gedung')
                    ->label('Nama Gedung')
                    ->searchable(),
                TextColumn::make('tipe_gedung')
                    ->label('Tipe Gedung'),
                // TextColumn::make('foto_gedung')->label('Foto Gedung'),
                ImageColumn::make('foto_gedung')
                    ->label("Foto Gedung")
                    ->square(),
                textColumn::make('harga')
                    ->label('Harga Sewa')
                    // ->prefix('RP ')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),
                textColumn::make('kapasitas')
                    ->label('Kapasitas')
                    ->sortable()
                    ->icon('heroicon-m-user-group'),
                // ->suffix(" Orang"),
                textColumn::make('fasilitas')
                    ->label('Fasilitas'),
                // textColumn::make('status')->label('Status'),
                // TextColumn::make('created_at')->label('Dibuat')->dateTime('d M Y H:i'),
                TextColumn::make('status')
                    ->badge()
                    ->sortable('status')
                    ->searchable( )
                    ->label("Status")
                    ->color(fn (string $state): string => match ($state) {
                        'ready' => 'success',
                        'booked' => 'warning',
                        'digunakan' => 'danger',
                        'closed' => 'gray',
                        'pending' => 'warning',
                    })
                ])  
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                    
                ])
                ->icon('heroicon-m-ellipsis-horizontal'),
            // ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            
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
        $hitungGedung = static::getEloquentQuery()->where('nama_gedung', 0)->count();
    
        return $hitungGedung > 0 ? strval($hitungGedung) : null;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGedungs::route('/'),
            'create' => Pages\CreateGedung::route('/create'),
            // 'edit' => Pages\EditGedung::route('/{record}/edit'),
        ];
    }
    
}
