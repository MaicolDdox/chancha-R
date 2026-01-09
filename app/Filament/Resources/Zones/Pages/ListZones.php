<?php

namespace App\Filament\Resources\Zones\Pages;

use App\Filament\Resources\Zones\ZoneResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListZones extends ListRecords
{
    protected static string $resource = ZoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
