<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Pengguna;
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
use Spatie\Permission\Models\Role;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    // protected static ?string $navigationIcon = 'heroicon-m-user-group';
    protected static ?string $pluralModelLabel = "User";

    protected static ?string $navigationGroup = "Pengaturan";



    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            //
            Forms\Components\TextInput::make('nama')
            ->required()
            ->maxLength(40)
            ->label("Nama Pengguna"),
            Forms\Components\TextInput::make('email')
            // ->placeholder('')
            ->email()
            ->required()
            ->maxLength(20)
            ->label("Email"),
            Forms\Components\TextInput::make('no_hp')
            ->required()
            ->numeric()
            // ->step(3)
            // ->placeholder('Nomor HP Andas')
            ->tel()
            ->extraInputAttributes([
                'pattern' => '[0-9]*', 
                'inputmode' => 'numeric',
                'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')",
            ])
            ->maxLength(12)
            ->label("Nomor Telepon"),

            Forms\Components\TextInput::make('alamat')
            ->required()
            ->maxLength(100)
            ->columnSpanFull(),
            Forms\Components\TextInput::make('password')
            ->required()
            ->maxLength(20)
            ->password(),
            // Section::make('Pilih Roles ')
            // ->schema([
            //     Select::make('role_id')
            //     ->label('Role')
            //     ->options(fn () => Role::all()->pluck('name', 'id'))
            //     ->searchable()
            //     ->native(false)
            //     ->required(),            
            //         ]),
            Forms\Components\Select::make('roles')
            ->multiple()
            ->preload()
            ->relationship('roles', 'name'),
                ]);
                
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('nama')->label('Nama User')
                ->searchable(),
                TextColumn::make('email')
                    ->label('Email'),
                TextColumn::make('no_hp')
                    ->label('Nomor HP'),
                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(30),
                Tables\Columns\TextColumn::make('roles.name')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                // TextColumn::make('roles')->label('Role'),
                // TextColumn::make('password'),
                // TextColumn::make('roles'),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('roles')
                ->relationship('roles', 'name')
                ->preload()
                ->multiple(),
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
        $hitungUser = static::getEloquentQuery()->where('nama', 0)->count();
    
        return $hitungUser > 0 ? strval($hitungUser) : null;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
