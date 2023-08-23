<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TratamentoResource\Pages;
use App\Models\Tratamento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;



class TratamentoResource extends Resource
{
    protected static ?string $model = Tratamento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('descricao')
                ->required()
                ->maxLength(255)
                ->columnSpan('full'),
                Forms\Components\Textarea::make('Notas')
                ->maxLength(65535)
                ->columnSpan('full'),
                Forms\Components\TextInput::make('Preco')
                ->numeric()
                ->prefix('$')
                ->maxValue(42949672.95),
                Forms\Components\Select::make('paciente_id')
                ->placeholder('Selecione o paciente')
                ->relationship('paciente', 'nome')
                //os primeiros 50 proprietários na lista pesquisável (caso a lista seja longa)
                ->searchable()
                ->preload()
                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('descricao'),
                Tables\Columns\TextColumn::make('preco')
                    ->money('BR ')
                    ->sortable(),
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
            'index' => Pages\ListTratamentos::route('/'),
            'create' => Pages\CreateTratamento::route('/create'),
            'edit' => Pages\EditTratamento::route('/{record}/edit'),
        ];
    }
}
