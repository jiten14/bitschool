<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeesRelationManager extends RelationManager
{
    protected static ?string $title = 'Payment History';

    protected static string $relationship = 'fees';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                /*Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),*/
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                //Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('payment_date'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('fee_type.fee_type'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
