<?php

namespace App\Filament\Pages;

use App\Filament\Resources\ReservasiResource;
use App\Filament\Widgets\CekKetersediaanGedung;
use App\Filament\Widgets\NotifReservasi;
// use App\Filament\Widgets\OrdersChart;
// use App\Filament\Widgets\UsersChart;
use App\Models\Gedung;
use App\Models\Reservasi;
use Filament\Pages\Page;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Dashboard as BaseDashboard;


class Dashboard extends BaseDashboard
{
    use BaseDashboard\Concerns\HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
    //  dd($form);   
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        // Select::make('businessCustomersOnly')
                            // ->boolean(),
                        DatePicker::make('startDate')
                            ->maxDate(fn (Get $get) => $get('endDate') ?: now()),
                        DatePicker::make('endDate')
                            ->minDate(fn (Get $get) => $get('startDate') ?: now())
                            ->maxDate(now()),
                    ])
                    ->columns(2),
            ]);
    }
}