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
use Filament\Support\Enums\FontWeight;
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
                Forms\Components\Select::make('semester_id')
                    ->relationship('semester', 'semester')
                    ->required(),
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\Select::make('referal_agent_id')
                        ->relationship('referal_agent', 'full_name')
                        ->required(),
                Forms\Components\Select::make('student_status')
                        ->options([
                            'Applied' => 'Applied',
                            'Admitted' => 'Admitted',
                            'Rejected' => 'Rejected',
                            'Dropout' => 'Dropout',
                            'Passout' => 'Passout',
                        ])
                        ->required(),
                Forms\Components\Toggle::make('payment_status')
                        ->required(),
                ])->columns(3),
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
                    ->sortable(),
                Tables\Columns\TextColumn::make('student_status')
                    ->label('Status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Applied' => 'gray',
                        'Admitted' => 'info',
                        'Rejected' => 'warning',
                        'Passout' => 'success',
                        'Dropout' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('parents_name'),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
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
                Tables\Columns\TextColumn::make('semester.semester')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('referal_agent.full_name')
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
