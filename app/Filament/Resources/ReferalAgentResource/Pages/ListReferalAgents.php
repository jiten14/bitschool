<?php

namespace App\Filament\Resources\ReferalAgentResource\Pages;

use App\Filament\Resources\ReferalAgentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReferalAgents extends ListRecords
{
    protected static string $resource = ReferalAgentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
