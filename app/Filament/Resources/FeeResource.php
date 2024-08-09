<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeeResource\Pages;
use App\Filament\Resources\FeeResource\RelationManagers;
use App\Models\Fee;
use App\Models\Lead;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use App\Filament\Exports\FeeExporter;
use Filament\Tables\Actions\ExportAction;
use App\Filament\Imports\FeeImporter;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\Summarizers\Sum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class FeeResource extends Resource
{
    protected static ?string $model = Fee::class;

    protected static ?string $navigationGroup = 'Fees Collection';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'reg_no')
                    ->label('Student Reg. No.')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('fee_type_id')
                    ->relationship('fee_type', 'fee_type')
                    ->required(),
                Forms\Components\DatePicker::make('payment_date')
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->closeOnDateSelection()
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.reg_no')
                    ->label('Student Reg. No.')
                    ->weight(FontWeight::Bold)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('student.full_name')
                    ->label('Student Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Payment Date')
                    ->date('d M, Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->money('INR')
                    ->sortable()
                    ->summarize(Sum::make()->label('Total')->money('INR')),
                Tables\Columns\TextColumn::make('fee_type.fee_type')
                    ->label('Fee Type')
                    ->sortable(),
                /*Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
                    ->toggleable(isToggledHiddenByDefault: true),*/
            ])
            ->filters([
                Tables\Filters\Filter::make('payment_date')
                    ->form([
                        Forms\Components\DatePicker::make('payment_from')
                            ->native(false)
                            ->displayFormat('d M Y')
                            ->closeOnDateSelection()
                            ->placeholder(fn ($state): string => now()->subYear()->format('d M, Y')),
                        Forms\Components\DatePicker::make('payment_until')
                            ->native(false)
                            ->displayFormat('d M Y')
                            ->closeOnDateSelection()
                            ->placeholder(fn ($state): string => now()->format('d M, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['payment_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('payment_date', '>=', $date),
                            )
                            ->when(
                                $data['payment_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('payment_date', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['payment_from'] ?? null) {
                            $indicators['payment_from'] = 'Payment from ' . Carbon::parse($data['payment_from'])->toFormattedDateString();
                        }
                        if ($data['payment_until'] ?? null) {
                            $indicators['payment_until'] = 'Payment until ' . Carbon::parse($data['payment_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
                SelectFilter::make('student')
                    ->relationship('student', 'full_name')
                    ->searchable()
                    ->preload(),
            ], layout: FiltersLayout::AboveContent)->filtersFormColumns(2)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(FeeExporter::class)
                    ->label('Export'),
                ImportAction::make()
                    ->importer(FeeImporter::class)
                    ->color('primary')
                    ->label('Import'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            FeeResource\Widgets\FeeOverview::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFees::route('/'),
            'create' => Pages\CreateFee::route('/create'),
            'edit' => Pages\EditFee::route('/{record}/edit'),
        ];
    }
}
