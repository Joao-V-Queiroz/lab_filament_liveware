<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProprietarioResource\Pages;
use App\Filament\Resources\ProprietarioResource\RelationManagers;
use App\Models\Proprietario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProprietarioResource extends Resource
{
    protected static ?string $model = Proprietario::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                ->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('telefone'),
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
            'index' => Pages\ListProprietarios::route('/'),
            'create' => Pages\CreateProprietario::route('/create'),
            'edit' => Pages\EditProprietario::route('/{record}/edit'),
        ];
    }
}
