<?php

namespace App\Filament\Exports;

use App\Models\Student;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class StudentExporter extends Exporter
{
    protected static ?string $model = Student::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('reg_no'),
            ExportColumn::make('referal_agent.full_name'),
            ExportColumn::make('academic_year.academic_year'),
            ExportColumn::make('admission_type.admission_type'),
            ExportColumn::make('branch.branch'),
            ExportColumn::make('full_name'),
            ExportColumn::make('parents_name'),
            ExportColumn::make('communication_address'),
            ExportColumn::make('parmanent_address'),
            ExportColumn::make('email'),
            ExportColumn::make('phone'),
            ExportColumn::make('student_status'),
            ExportColumn::make('payment_status'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your student export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
