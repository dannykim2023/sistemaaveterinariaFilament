<?php

namespace App\Filament\Resources\NoneResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Patient;


class PatientTypeOverview extends BaseWidget
{
    protected function getCards(): array
    {
       return [
           Card::make('Cats', Patient::where('type', 'cat')->count()),
           Card::make('Dogs', Patient::where('type', 'dog')->count()),
           Card::make('Rabbits', Patient::where('type', 'rabbit')->count()),
           Card::make('Total Pacientes', Patient::count()),

       ];
    }
}
