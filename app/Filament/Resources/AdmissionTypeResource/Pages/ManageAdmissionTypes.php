<?php

namespace App\Filament\Resources\AdmissionTypeResource\Pages;

use App\Filament\Resources\AdmissionTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAdmissionTypes extends ManageRecords
{
    protected static string $resource = AdmissionTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->createAnother(false),
        ];
    }
}
