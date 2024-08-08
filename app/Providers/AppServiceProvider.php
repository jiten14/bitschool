<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label('Admission')
                    ->icon('heroicon-s-academic-cap')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Fees Collection')
                    ->icon('heroicon-s-currency-rupee')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Setup')
                    ->icon('heroicon-s-cog')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Auth')
                    ->icon('heroicon-s-user-group')
                    ->collapsed(),
            ]);
        });

        FilamentAsset::register([
            Css::make('custom-stylesheet', __DIR__ . '/../../resources/css/custom.css'),
        ]);

    }
}
