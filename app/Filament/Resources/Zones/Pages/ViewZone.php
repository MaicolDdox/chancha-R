<?php

namespace App\Filament\Resources\Zones\Pages;

use App\Filament\Resources\Zones\ZoneResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewZone extends ViewRecord
{
    protected static string $resource = ZoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
