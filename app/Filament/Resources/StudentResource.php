<?php

namespace App\Filament\Resources;

use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use App\Filament\Exports\StudentExporter;
use Filament\Tables\Actions\ExportAction;
use App\Filament\Imports\StudentImporter;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationGroup = 'Admission';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('reg_no')
                    ->label('Registration Number')
                    ->required()
                    ->maxLength(255)
                    ->hiddenOn('create')
                    ->disabled()
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('full_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('parents_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('communication_address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('parmanent_address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('academic_year_id')
                    ->relationship('academic_year', 'academic_year')
                    ->required(),
                Forms\Components\Select::make('admission_type_id')
                    ->relationship('admission_type', 'admission_type')
                    ->required(),
                Forms\Components\Select::make('branch_id')
                    ->relationship('branch', 'branch')
                    ->required(),
                Forms\Components\Select::make('referal_agent_id')
                    ->label('Refered By')
                    ->relationship('referal_agent', 'full_name')
                    ->searchable(),
            Forms\Components\Section::make()
                ->schema([
                Forms\Components\Select::make('student_status')
                        ->label('Admission Status.')
                        ->options([
                            'Hold' => 'Hold',
                            'Rejected' => 'Rejected',
                            'Admitted' => 'Admitted',
                        ])
                        ->required(),
                Forms\Components\Toggle::make('payment_status')
                        ->label('Admission Fees Paid?')
                        ->onColor('success')
                        ->offColor('danger')
                        ->onIcon('heroicon-m-check-circle')
                        ->offIcon('heroicon-m-x-circle')
                        ->required(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reg_no')
                    ->label('Registration No.')
                    ->weight(FontWeight::Bold)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('payment_status')
                    ->label('Payment')
                    ->boolean()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('student_status')
                    ->label('Status')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Hold' => 'warning',
                        'Admitted' => 'success',
                        'Rejected' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('parents_name'),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('communication_address')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('parmanent_address')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('academic_year.academic_year')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('admission_type.admission_type')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('branch.branch')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('referal_agent.full_name')
                    ->label('Refered By')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('payment_status')
                    ->label('Payment Status')
                    ->placeholder('All')
                    ->trueLabel('Fees Paid')
                    ->falseLabel('Fees Unpaid'),
                SelectFilter::make('academic_year')
                    ->relationship('academic_year', 'academic_year')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('admission_type')
                    ->relationship('admission_type', 'admission_type')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('branch')
                    ->relationship('branch', 'branch')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('referal_agent')
                    ->label('Refered By')
                    ->relationship('referal_agent', 'full_name')
                    ->searchable()
                    ->preload(),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(StudentExporter::class)
                    ->label('Export')
                    ->visible(fn () => Auth::user()->hasPermissionTo('Admission')),
                ImportAction::make()
                    ->importer(StudentImporter::class)
                    ->color('primary')
                    ->label('Import')
                    ->visible(fn () => Auth::user()->hasPermissionTo('Admission')),
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
            RelationManagers\FeesRelationManager::class,
        ];
    }

    public static function getWidgets(): array
    {
        return [
            StudentResource\Widgets\StudentOverview::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'view' => Pages\ViewStudent::route('/{record}'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make()
                    ->schema([
                    Infolists\Components\TextEntry::make('full_name'),
                    Infolists\Components\TextEntry::make('branch.branch'),
                    ])
                    ->columns(2),
            ]);
    }

}
