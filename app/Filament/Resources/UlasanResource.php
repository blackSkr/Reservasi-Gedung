<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UlasanResource\Pages;
use App\Filament\Resources\UlasanResource\Pages\EditUlasan;
use App\Filament\Resources\UlasanResource\RelationManagers;
use App\Models\Ulasan;
// use Filament\Actions\ActionGroup;
use Filament\Tables\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;


class UlasanResource extends Resource
{
    public static function getEloquentQuery(): Builder
    {
        $user = Filament::auth()->user();
    
        if (!$user) {
            return parent::getEloquentQuery()->whereRaw('1 = 0');
        }
    
        if ($user->hasRole('admin') || $user->hasRole('super_admin')) {
            return parent::getEloquentQuery();
        }
    
        return parent::getEloquentQuery()->where('user_id', $user->id);
    }
    protected static ?string $model = Ulasan::class;
    protected static ?string $navigationGroup = 'Reservasi';

    protected static ?string $pluralModelLabel = 'Ulasan';
    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                // Forms\Components\placeholder::make('user_nama')
                // ->label('User')
                // ->content(fn ($record) => $record?->user?->nama ?? '-'),
                Forms\Components\Hidden::make('user_id')
                ->default(fn () => Auth::id()) 
                ->dehydrated(true)
                ->required(),            
                Forms\Components\TextInput::make('judul_ulasan')
                    ->required()
                    ->maxLength(25)
                    ->label('Judul Ulasan')
                    ->placeholder('Masukan Judul Ulasan'),
                Forms\Components\TextInput::make('ulasan')
                    ->required()
                    ->maxLength(150)
                    ->label('Ulasan')
                    ->placeholder('Masukan Ulasan'),
                Forms\Components\Select::make('bintang')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',

                    ])
                    ->required()
                    ->native(false)
                    ->label('Rating'),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->required()
                    ->native(false)
                    ->options([
                        'Tampil' => 'Tampil',
                        'Tidak Tampil' => 'Tidak Tampil',
                    ])
                    ->visible(fn ($livewire) =>
                        $livewire instanceof EditUlasan &&
                        auth()->user()?->hasAnyRole(['admin', 'super_admin'])
                    )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.nama')
                    ->label('Nama Pembuat '),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email Pembuat '),
                Tables\Columns\TextColumn::make('judul_ulasan')
                    ->label('Nama Ulasan '),
                Tables\Columns\TextColumn::make('ulasan')
                    ->label('Ulasan '),
                Tables\Columns\TextColumn::make('bintang')
                    ->label('Rating')
                    ->formatStateUsing(function ($state) {
                        return str_repeat('⭐', (int) $state);
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                            'Tampil' => 'success',
                            'Tidak Tampil' => 'warning',
                        })
                        ->visible(fn ($livewire) =>
                        $livewire instanceof EditUlasan &&
                        auth()->user()?->hasAnyRole(['admin', 'super_admin'])
                    ),

            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    \Filament\Tables\Actions\ViewAction::make(),
                    \Filament\Tables\Actions\EditAction::make(),
                    \Filament\Tables\Actions\DeleteAction::make(),
                ])
                
                ->icon('heroicon-m-ellipsis-horizontal'),
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
            'index' => Pages\ListUlasans::route('/'),
            'create' => Pages\CreateUlasan::route('/create'),
            'edit' => Pages\EditUlasan::route('/{record}/edit'),
        ];
    }
}
