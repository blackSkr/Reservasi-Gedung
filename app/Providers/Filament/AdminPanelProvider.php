<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Register;
use App\Filament\Widgets\NotifReservasi;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Widgets\ChartWidget;


class AdminPanelProvider extends PanelProvider

{

    public function panel(Panel $panel): Panel
    {
        return $panel
        
            // ->default()
            // ->homeUrl(fn () => route('filament.admin.pages.dashboard'))
            ->homeUrl(fn () => route('filament.admin.pages.dashboard'))
            ->id('admin')
            ->path('admin')
            ->login()
            ->registration(Register::class) 
            ->colors([
                // 'primary' => Color::Amber,
                'primary' => Color::hex('#3b82f6'),
            ])
            // ->brandLogo(fn()=>view('filament.pages.logo-reservasi'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                // Pages\Dashboard::class,
            ])
            ->navigationGroups([
                NavigationGroup::make()
                ->label('Gedung')
                ->icon('heroicon-o-building-office-2'),
                NavigationGroup::make()
                ->label('Reservasi')
                ->icon('heroicon-o-rectangle-stack'),
                NavigationGroup::make()
                ->label('Perusahaan')
                ->icon('heroicon-o-chart-bar'),
                NavigationGroup::make()
                ->label('Pengaturan')
                ->icon('heroicon-o-cog-8-tooth'),

            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // \App\Filament\Widgets\NotifReservasi::class,
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerRenderHook(
                'panels::global-search.after',
                fn (): string => view('components.notification-bell')->render(),
            );
        });
    }
}
