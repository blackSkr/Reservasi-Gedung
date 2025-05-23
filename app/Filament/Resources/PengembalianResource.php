<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengembalianResource\Pages;
use App\Filament\Resources\PengembalianResource\RelationManagers;
use App\Models\Pengembalian;
use Filament\Facades\Filament;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;

class PengembalianResource extends Resource
{
    protected static ?string $model = Pengembalian::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $pluralModelLabel = "Pengembalian";
    protected static ?string $navigationGroup = "Reservasi";
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
    
    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->default(auth()->id()),

                    
                    Forms\Components\Select::make('reservasi_id')
                    ->label('ID Reservasi')
                    ->options(function () {
                        if (!auth()->check()) return [];
                
                        $sudahDirefund = \App\Models\Pengembalian::pluck('reservasi_id')->toArray();
                
                        return \App\Models\Reservasi::where('user_id', auth()->id())
                            ->where('status', 'Sudah Membayar')
                            ->whereNotIn('id', $sudahDirefund)
                            ->pluck('id', 'id')
                            ->toArray();
                    })
                    ->required()
                    ->searchable()
                    ->afterStateUpdated(function ($state, Set $set) {
                        $reservasi = \App\Models\Reservasi::find($state);
                        if ($reservasi) {
                            $set('total_pengembalian', $reservasi->total_reservasi * 0.85);
                        }
                    }),
                Forms\Components\Textarea::make('keterangan')
                    ->label('Alasan Refund')
                    ->required()
                    ->maxLength(70),

                Forms\Components\TextInput::make('nama_pemilik')
                    ->label('Rekening A/N ')
                    ->maxLength(40)
                    ->required(),

                Forms\Components\TextInput::make('nomor_rekening')
                    ->numeric()
                    ->maxLength(20)
                    ->required(),

                Forms\Components\Select::make('nama_bank')
                    ->options([
                        'BCA' => 'BCA',
                        'Mandiri' => 'Mandiri',
                        'BNI' => 'BNI',
                        'BRI' => 'BRI',
                        'BTN' => 'BTN',
                        'Permata' => 'Permata',
                        'Danamon' => 'Danamon',
                        'CIMB' => 'CIMB Niaga',
                        'Bank Jatim' => 'Bank Jatim',
                    ])
                    ->required()
                    ->searchable(),

                Forms\Components\TextInput::make('total_pengembalian')
                    ->numeric()
                    ->reactive()
                    ->debounce(1000)
                    ->label('Total Pengembalian (Rp)')
                    ->disabled()
                    // ->readOnly()
                    ->dehydrated(),

                Forms\Components\Select::make('status_pengembalian')
                    ->native(false)
                    ->options([
                        'menunggu_verifikasi' => 'Menunggu Verifikasi',
                        'disetujui' => 'Disetujui',
                        'selesai' => 'Selesai',
                    ])
                    ->required()
                    ->visible(fn () => auth()->user()->hasRole('admin')),

                Forms\Components\FileUpload::make('bukti_pengembalian')
                    ->disk('public')
                    ->directory('bukti-refund')
                    ->label('Bukti Transfer')
                    // ->previewable()
                    ->columnSpanFull()
                    ->visible(fn () => auth()->user()->hasRole(['admin'])),                
                    
                Forms\Components\DateTimePicker::make('refunded_at')
                    ->label('Waktu Refund')
                    // ->readOnly()
                    ->hidden()
                    ->dehydrated()
                    ->visible(fn () => auth()->user()->hasRole('admin')),
            ]);
    }


    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reservasi_id')
                    ->label('ID Reservasi')
                    ->sortable()
                    ->searchable(),
    
                TextColumn::make('total_pengembalian')
                    ->label('Jumlah Refund')
                    ->money('IDR'),
    
                TextColumn::make('nama_pemilik')
                    ->label('Pemilik Rekening')
                    ->searchable(),
    
                TextColumn::make('nama_bank')
                    ->label('Bank')
                    ->sortable(),
    
                TextColumn::make('nomor_rekening')
                    ->label('No Rekening'),
    
                TextColumn::make('refunded_at')
                    ->label('Waktu Refund')
                    ->dateTime()
                    ->since()
                    ->sortable(),
                BadgeColumn::make('status_pengembalian')
                    ->label('Status')
                    ->colors([
                        'warning' => 'menunggu_verifikasi',
                        'success' => 'disetujui',
                        'primary' => 'selesai',
                    ])
                    ->formatStateUsing(fn ($state) => ucwords(str_replace('_', ' ', $state))),
                
                ImageColumn::make('bukti_pengembalian')
                    ->label('Bukti Transfer')
                    ->disk('public')
                    ->height(50)
                    ->circular()
                    ->visible(fn () => auth()->user()->hasRole(['admin','user'])),                
                    ])
                    ->emptyStateIcon('heroicon-o-bookmark')
                    ->emptyStateHeading('Belum ada mengajukan pengembalian')
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    
                    Tables\Actions\EditAction::make()
                        ->visible(fn ($record) =>
                            auth()->user()->hasRole('admin') ||
                            $record->status_pengembalian === 'menunggu_verifikasi'
                        ),
            
                    Tables\Actions\DeleteAction::make()
                        ->visible(fn ($record) =>
                            auth()->user()->hasRole('user') &&
                            $record->status_pengembalian === 'menunggu_verifikasi'
                        ),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
    

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        $pendingCount = static::getEloquentQuery()->where('status_pengembalian', 'menunggu_verifikasi')->count();
    
        return $pendingCount > 0 ? strval($pendingCount) : null;
    }
    

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengembalians::route('/'),
            'create' => Pages\CreatePengembalian::route('/create'),
            // 'edit' => Pages\EditPengembalian::route('/{record}/edit'),
        ];
    }
}
