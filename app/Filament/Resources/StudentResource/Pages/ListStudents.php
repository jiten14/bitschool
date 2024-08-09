<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListStudents extends ListRecords
{
    use ExposesTableToWidgets;
    
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return StudentResource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'Hold' => Tab::make()->query(fn ($query) => $query->where('student_status', 'Hold')),
            'Admitted' => Tab::make()->query(fn ($query) => $query->where('student_status', 'Admitted')),
            'Rejected'  => Tab::make()->query(fn ($query) => $query->where('student_status', 'Rejected')),
        ];
    }

}
