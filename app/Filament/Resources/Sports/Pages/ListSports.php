<?php

namespace App\Filament\Resources\Sports\Pages;

use App\Filament\Resources\Sports\SportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSports extends ListRecords
{
    protected static string $resource = SportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
