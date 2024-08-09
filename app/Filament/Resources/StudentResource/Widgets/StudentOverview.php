<?php

namespace App\Filament\Resources\StudentResource\Widgets;

use App\Filament\Resources\StudentResource\Pages\ListStudents;
use App\Models\Student;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StudentOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected function getTablePage(): string
    {
        return ListStudents::class;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', $this->getPageTableQuery()->count()),
            Stat::make('On Hold', $this->getPageTableQuery()->whereIn('student_status', ['Hold'])->count()),
            Stat::make('Admitted', $this->getPageTableQuery()->whereIn('student_status', ['Admitted'])->count()),
            Stat::make('Rejected', $this->getPageTableQuery()->whereIn('student_status', ['Rejected'])->count()),
        ];
    }
}
