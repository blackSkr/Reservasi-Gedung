<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservasiResource\Pages;
use App\Filament\Resources\ReservasiResource\Pages\EditReservasi;
use App\Filament\Resources\ReservasiResource\Pages\ListReservasi;
use App\Filament\Resources\ReservasiResource\RelationManagers;
use App\Models\Fasilitas;
use App\Models\Gedung;
use App\Models\Reservasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Carbon\Carbon;
use Closure;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Actions\Action as ActionsAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Actions\Action as TablesActionsAction;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Filament\Tables\Columns\IconColumn;

use function Laravel\Prompts\text;

 

class ReservasiResource extends Resource
{
    protected static ?string $model = Reservasi::class;
    protected static ?string $pluralModelLabel =" Reservasi";
    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $navigationGroup = 'Reservasi';

    // public static function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $data['batas_waktu_reservasi'] = now()->addDay(); 
    //     return $data;
    // }

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
        // dd($form)->torowsql();

        return $form
        ->schema([
            Forms\Components\Placeholder::make('user_nama')
                ->label('User')
                ->content(fn ($record) => $record?->user?->nama ?? '-'),
            Forms\Components\Hidden::make('user_id')
            ->label('Nama User')
                ->default(fn () => Auth::user()->nama)
                ->dehydrated(true)
                ->disabled(),
            Forms\Components\Select::make('gedung_id')
                ->label('Pilih Gedung')
                ->relationship(
                    name: 'gedung',
                    titleAttribute: 'nama_gedung'
                )
                ->preload()
                ->options(
                    Gedung::where('status', ['ready'])->pluck('nama_gedung', 'id')
                )
                ->required()
                ->searchable()
                ->reactive()
                ->afterStateUpdated(function ($state, Set $set, Get $get) {
                    $gedung = \App\Models\Gedung::find($state);
                    if ($gedung) {
                        $nominalLama = $get('nominal') ?? 0;
                        $totalLama = $get('total_reservasi') ?? 0;
                        $hargaBaru = $gedung->harga;
            
                        $set('nominal', $hargaBaru);
            
                        $set('total_reservasi', $totalLama - $nominalLama + $hargaBaru);
                    }
                }),            
        
    
            TextInput::make('nominal')
                ->label('Harga')
                ->disabled()
                ->dehydrated()
                ->prefix('Rp'), 
                
            
            DateTimePicker::make('waktu_reservasi')
                ->label('Tanggal Reservasi')
                ->default(now())
                ->disabled()
                ->dehydrated(),
                
            DateTimePicker::make('waktu_mulai')
                ->debounce(1000)
                ->label('Waktu Mulai')
                ->required()
                ->native(false)
                ->closeOnDateSelection()
                ->displayFormat('d/m/Y H:i')
                ->format('Y-m-d H:i:s'),
            
            DateTimePicker::make('waktu_selesai')
                ->label('Waktu Selesai')
                ->debounce(1000)
                ->required()
                ->reactive() 
                ->native(false)
                ->closeOnDateSelection()
                ->displayFormat('d/m/Y H:i')
                ->format('Y-m-d H:i:s')
                ->minDate(fn (Get $get) =>
                    $get('waktu_mulai')
                        ? Carbon::parse($get('waktu_mulai'))
                        : null
                )
                ->maxDate(fn (Get $get) =>
                    $get('waktu_mulai')
                        ? Carbon::parse($get('waktu_mulai'))->addHours(12)
                        : null
                )
                ->helperText('Waktu selesai maksimal 12 jam setelah waktu mulai.'),
            Textarea::make('catatan')
                ->label('Catatan')
                ->maxLength(200)
                ->placeholder('Catatan / Tambahan Bila ada')
                ->columnSpanFull(),
            Select::make('fasilitas_id')
                ->label('Fasilitas Tambahan')
                ->options(
                    Fasilitas::where('status', 'tersedia')->pluck('nama_fasilitas', 'id')
                )
                ->preload()
                ->searchable()
                ->reactive()
                ->dehydrated()
                ->reactive()
                ->afterStateUpdated(function ($state, Set $set, Get $get) {
                    if ($state) {
                        $fasilitas = Fasilitas::find($state);
                        $set('nama_fasilitas', $fasilitas->nama_fasilitas);
                        $total = $get('nominal') + $fasilitas->harga;
                        $set('total_reservasi', $total);
                    } else {
                        $set('total_reservasi', $get('nominal'));
                    }
                }),
            TextInput::make('nominal')
                ->label('Harga Gedung')
                ->disabled()
                ->dehydrated(),
            TextInput::make('total_reservasi')
                ->label('Total Biaya Reservasi')
                ->numeric()
                ->required()
                ->disabled()
                ->dehydrated(),
            FileUpload::make('bukti_pembayaran')
                // ->disk('local')
                ->columnSpanFull()
                ->directory('bukti_bayar')
                ->visible(fn ($livewire) =>
                $livewire instanceof ListReservasi &&
                auth()->user()?->hasAnyRole(['admin', 'super_admin', 'user'])
                ),
                
            Hidden::make('total_reservasi'), 
            DateTimePicker::make('batas_waktu_reservasi')
            ->label('Batas Waktu Pembayaran')
            ->default(now()->addDay())
            ->disabled()
            ->dehydrated()
            ->hint('Reservasi otomatis dibatalkan jika tidak dibayar dalam 24 jam.'),

            Select::make('status')
                ->label('Status')
                ->required()
                ->native(false)
                ->options([
                    'pending' => 'Pending',
                    'disetujui' => 'Disetujui',
                    'ditolak' => 'Ditolak',
                    'selesai' => 'Selesai',
                    'Sudah Membayar' => 'Sudah Membayar',
                ])
                ->visible(fn ($livewire) =>
                    // $livewire instanceof EditReservasi &&
                    auth()->user()?->hasAnyRole(['admin', 'super_admin'])
                )
                ]);

    }
    
    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                TextColumn::make('user.nama')
                    ->label('Nama Pengguna')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('gedung.nama_gedung')
                    ->label('Nama Gedung')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('catatan')
                    ->limit(15),
                TextColumn::make('waktu_reservasi')
                    ->label('Waktu Reservasi')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                // TextColumn::make('batas_waktu_reservasi')
                //     ->label('Batas Pembayaran')
                //     ->dateTime('d M Y, H:i'),
                TextColumn::make('total_reservasi')
                    ->label('Total')
                    ->money('idr')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextColumn::make('fasilitas.nama_fasilitas'),
                    // ->boolean(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                            'disetujui' => 'success',
                            'Sudah Membayar' => 'info',
                            'pending' => 'warning',
                            'ditolak' => 'danger',
                            'selesai' => 'info',
                        }),
            ]) 
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
                
            ])
            ->emptyStateIcon('heroicon-o-bookmark')
            ->emptyStateHeading('Kamu Belum Ada Reservasi gedung nih')
            ->actions([
                Tables\Actions\EditAction::make(),
                
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make()
                        ->label('Edit Reservasi')
                        ->visible(fn($record) => $record->status === 'pending' || auth()->user()->hasAnyRole(['admin', 'super_admin'])),
                        Action::make('cetak')
                        ->label('Cetak Reservasi')
                        ->icon('heroicon-o-printer')
                        ->url(fn ($record) => route('reservasi.cetak', $record->id))
                        ->visible(fn($record) => $record->status === 'disetujui' || auth()->user()->hasAnyRole(['admin', 'super_admin']))
                        // ->visible(fn($record) => $record->status === 'disetujui' && ($record->hasAnyRole(['admin', 'super_admin'])))
                        ->openUrlInNewTab(),
                    Action::make('bayar')
                        ->label('Bayar Reservasi')
                        ->icon('heroicon-m-paper-airplane')
                        ->url(fn ($record) => route('reservasi.bayar', $record->id))
                        ->openUrlInNewTab()
                        ->visible(fn ($record) => $record->status === 'pending'),
                    DeleteAction::make()
                        ->label('Hapus Reservasi'),
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
    public static function getNavigationBadge(): ?string
    {
        $pendingCount = static::getEloquentQuery()->where('status', 'pending')->count();
    
        return $pendingCount > 0 ? strval($pendingCount) : null;
    }
    
    
    

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReservasi::route('/'),
            'create' => Pages\CreateReservasi::route('/create'),
            // 'edit' => Pages\EditReservasi::route('/{record}/edit'),
        ];
    }
}
