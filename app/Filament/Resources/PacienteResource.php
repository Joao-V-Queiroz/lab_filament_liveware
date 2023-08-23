<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PacienteResource\Pages;
use App\Filament\Resources\PacienteResource\RelationManagers;
use App\Models\Paciente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PacienteResource extends Resource
{
    protected static ?string $model = Paciente::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('nome')
                ->required()
                ->maxLength(255),
            Forms\Components\Select::make('tipo')
                ->placeholder('Selecione um animal') // Define o texto do espaço reservado
                ->options([
                    'gato' => 'Gato',
                    'cachorro' => 'Cachorro',
                    'coelho' => 'Coelho',
                ])
                ->required(),
            Forms\Components\DatePicker::make('data_de_aniversario')
               ->required()
               ->maxDate(now()),
            Forms\Components\Select::make('proprietario_id')
               ->placeholder('Selecione o proprietário')
               ->relationship('proprietario', 'nome')
               //os primeiros 50 proprietários na lista pesquisável (caso a lista seja longa)
               ->searchable()
               ->preload()
               //dá ao usuário a opção de criar um novo proprietário
               ->createOptionForm([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Endereço de email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telefone')
                    ->label('Número de telefone')
                    ->tel()
                    ->required(),
            ])
            ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                ->searchable(),
                Tables\Columns\TextColumn::make('tipo'),
                Tables\Columns\TextColumn::make('data_de_aniversario')
                ->sortable(), //classificável por idade
                Tables\Columns\TextColumn::make('proprietario.nome')
                ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListPacientes::route('/'),
            'create' => Pages\CreatePaciente::route('/create'),
            'edit' => Pages\EditPaciente::route('/{record}/edit'),
        ];
    }
}
