<?php

namespace App\Filament\Resources\ProprietarioResource\Pages;

use App\Filament\Resources\ProprietarioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProprietarios extends ListRecords
{
    protected static string $resource = ProprietarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
