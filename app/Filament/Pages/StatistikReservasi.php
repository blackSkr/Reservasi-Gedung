<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class StatistikReservasi extends Page
{
    // protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.pages.statistik-reservasi';
    protected static ?string $navigationGroup = 'Perusahaan';
    protected static ?string $title = 'Statistik Reservasi';

    // Batasi akses hanya untuk super_admin
public static function canAccess(): bool
{
    $user = auth()->user();

    // Logging (opsional untuk debug)
    \Log::info('User Permissions:', $user->getAllPermissions()->pluck('name')->toArray());

    // Cek apakah user punya permission dari Shield
    return $user->can('page_StatistikReservasi');
}

}
