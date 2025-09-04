<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;



class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                


                     // Nombre del paciente
                TextInput::make('name')
                    ->label('Nombre del Paciente')
                    ->required()
                    ->maxLength(255),

                // Tipo de animal
                Select::make('type')
                    ->label('Tipo de Animal')
                    ->options([
                        'cat' => 'Gato',
                        'dog' => 'Perro',
                        'rabbit' => 'Conejo',
                        'chicken' => 'Gallina',
                    ])
                    ->required(),

                // Fecha de nacimiento
                DatePicker::make('date_of_birth')
                    ->label('Fecha de Nacimiento')
                    ->required(),

                // Dueño (Owner) - relación con Owner
                Select::make('owner_id')
                    ->label('Dueño')
                    ->relationship('owner', 'name') // Usa la relación owner() en el modelo Patient
                    ->searchable()
                    ->required()       
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name')->required()
                        ->label('Nombre del Dueño'),
                        TextInput::make('email')
                        ->required()
                        ->email()
                        ->label('Correo del Dueño'),
                        TextInput::make('phone')
                        ->required()
                        ->tel()
                        ->label('numero')         // <- esto hace que sea input type="tel",
                    ])
                    
                
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Nombre del paciente
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->sortable()     // permite ordenar
                    ->searchable(),  // permite buscar

                // Tipo de animal
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo de Animal')
                    ->sortable(),

                // Fecha de nacimiento
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->label('Fecha de Nacimiento')
                    ->sortable(),

                // Dueño (relación)
                Tables\Columns\TextColumn::make('owner.name')
                    ->label('Dueño')
                    ->sortable()
                    ->searchable(),

                // Fecha de creación del registro
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                    ])
                    
                    ->filters([
                        // Filtrar por tipo de animal
                        Tables\Filters\SelectFilter::make('type')
                            ->label('Tipo de Animal')
                            ->options([
                                'cat' => 'Gato',
                                'dog' => 'Perro',
                                'rabbit' => 'Conejo',
                                'chicken' => 'Gallina',
                            ]),

                            // Filtrar por dueño
                        Tables\Filters\SelectFilter::make('owner_id')
                            ->label('Dueño')
                            ->relationship('owner', 'name'),])

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
            RelationManagers\TreatmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
