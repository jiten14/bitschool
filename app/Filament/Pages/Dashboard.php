<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-s-home';
    
    protected ?string $heading = 'KSET INTERNAL MANAGEMENT SYSTEM';

    protected ?string $subheading = 'Get Valuable Insights for informed decesions.';

    protected static string $view = 'filament.pages.dashboard';
}
