<?php

namespace App\Filament\Resources\NoneResource\Pages;

use Filament\Pages\Page;
use App\Filament\Resources\NoneResource\Widgets\PatientTypeOverview;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            PatientTypeOverview::class,
        ];
    }
}
