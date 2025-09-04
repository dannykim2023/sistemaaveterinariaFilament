<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TreatmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'treatments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
        Forms\Components\TextInput::make('description')
            ->label('Descripción')
            ->required()
            ->maxLength(255)
            ->columnSpan('full'),

        Forms\Components\Textarea::make('notes')
            ->label('Notas')
            ->maxLength(500)
            ->columnSpan('full'),

        Forms\Components\TextInput::make('price')
            ->label('Precio')
            ->numeric() // asegura que sea un número
            ->minValue(0)
            ->step(0.01) // para decimales
            ->required()
            ->columnSpan('full'),
    ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('notes')
                    ->label('Notas')
                    ->limit(50) // Limita a 50 caracteres para la vista de tabla
                    ->wrap()    // Esto permite que el texto largo se haga wrap
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Precio')
                    ->money('PEN', true), // Ajusta según moneda

                Tables\Columns\TextColumn::make('patient.name')
                    ->label('Paciente')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
