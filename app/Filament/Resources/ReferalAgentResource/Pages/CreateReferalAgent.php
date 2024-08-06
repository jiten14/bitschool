<?php

namespace App\Filament\Resources\ReferalAgentResource\Pages;

use App\Filament\Resources\ReferalAgentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReferalAgent extends CreateRecord
{
    protected static string $resource = ReferalAgentResource::class;

    protected static bool $canCreateAnother = false;
    
}
