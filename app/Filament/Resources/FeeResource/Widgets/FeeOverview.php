<?php

namespace App\Filament\Resources\FeeResource\Widgets;

use App\Filament\Resources\FeeResource\Pages\ListFees;
use App\Models\Fee;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FeeOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListFees::class;
    }

    protected function getStats(): array
    {
        return [
            //Stat::make('Fees Collected', $this->getPageTableQuery()->count()),
            Stat::make('Total Fees Collected', number_format($this->getPageTableQuery()->sum('amount'), 2)),
            Stat::make('Admission Fees', number_format($this->getPageTableQuery()->whereIn('fee_type_id', [1])->sum('amount'), 2)),
            Stat::make('Examination Fees', number_format($this->getPageTableQuery()->whereIn('fee_type_id', [2])->sum('amount'), 2)),
        ];
    }
}
