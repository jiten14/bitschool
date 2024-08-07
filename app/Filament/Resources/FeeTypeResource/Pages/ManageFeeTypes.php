<?php

namespace App\Filament\Resources\FeeTypeResource\Pages;

use App\Filament\Resources\FeeTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFeeTypes extends ManageRecords
{
    protected static string $resource = FeeTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->createAnother(false),
        ];
    }
}
