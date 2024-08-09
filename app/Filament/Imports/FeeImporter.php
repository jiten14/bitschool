<?php

namespace App\Filament\Imports;

use App\Models\Fee;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class FeeImporter extends Importer
{
    protected static ?string $model = Fee::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('student')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('fee_type')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
            ImportColumn::make('payment_date')
                ->requiredMapping()
                ->rules(['required', 'date']),
            ImportColumn::make('amount')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
        ];
    }

    public function resolveRecord(): ?Fee
    {
        // return Fee::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Fee();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your fee import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
