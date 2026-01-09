<?php

namespace App\Filament\Resources\Zones\Pages;

use App\Filament\Resources\Zones\ZoneResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditZone extends EditRecord
{
    protected static string $resource = ZoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
