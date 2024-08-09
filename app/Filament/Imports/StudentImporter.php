<?php

namespace App\Filament\Imports;

use App\Models\Student;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class StudentImporter extends Importer
{
    protected static ?string $model = Student::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('referal_agent')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('academic_year')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('admission_type')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('branch')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('full_name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('parents_name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('communication_address')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('parmanent_address')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('email')
                ->requiredMapping()
                ->rules(['required', 'email', 'max:255']),
            ImportColumn::make('phone')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('student_status')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('payment_status')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
        ];
    }

    public function resolveRecord(): ?Student
    {
        // return Student::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Student();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your student import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
