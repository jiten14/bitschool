<?php

namespace App\Filament\Resources\FeeResource\Pages;

use App\Filament\Resources\FeeResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListFees extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = FeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return FeeResource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'Admission Fee'  => Tab::make()->query(fn ($query) => $query->where('fee_type_id',1)),
            'Examination Fee' => Tab::make()->query(fn ($query) => $query->where('fee_type_id', 2)),
        ];
    }

}
