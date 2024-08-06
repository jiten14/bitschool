<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationGroup = 'Admission';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('lead_id')
                    ->relationship('lead', 'reg_no')
                    ->label('Registration Number')
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('referal_agent_id')
                    ->relationship('referal_agent', 'full_name')
                    ->required(),
                Forms\Components\Select::make('academic_year_id')
                    ->relationship('academic_year', 'academic_year')
                    ->required(),
                Forms\Components\Select::make('admission_type_id')
                    ->relationship('admission_type', 'admission_type')
                    ->required(),
                Forms\Components\Select::make('branch_id')
                    ->relationship('branch', 'branch')
                    ->required(),
                Forms\Components\Select::make('semester_id')
                    ->relationship('semester', 'semester')
                    ->required(),
                Forms\Components\Toggle::make('payment_status')
                    ->label('Fees Payment Status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('payment_status')
                    ->label('Fees Paid')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lead.reg_no')
                    ->label('Registration Number')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('referal_agent.full_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('academic_year.academic_year')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('admission_type.admission_type')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('branch.branch')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('semester.semester')
                    ->numeric()
                    ->sortable(),
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
